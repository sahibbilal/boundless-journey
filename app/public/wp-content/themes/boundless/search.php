<?php

get_header();

global $wp_query, $query_string;

// Get excluded pages
$site_search_excluded_pages = get_field('site_search_excluded_pages', 'options');
// Get current page, default to 1
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
// Build query for main search results
$search_query = array(
  'posts_per_page'  => 10,
  'paged'           => $paged,
  'post_type'       => array('page', 'post'),
  'post__not_in'    => $site_search_excluded_pages
);

$splitvar = '';
// Parse query string
$query_args = explode("&", $query_string);
foreach ($query_args as $key => $string) {
  $query_split = explode("=", $string);
  if ($query_split[0] == "s") {
    $splitvar = urldecode($query_split[1]);
  }
  // Modify search query
  $search_query[$query_split[0]] = urldecode($query_split[1]);
} // End foreach

// Get WP content search results
$search = new WP_Query($search_query);

// Get tour search results for first page of results
if ($paged == 1) {
  $tour_results = verb_tourcube_search_results(0, 6, FALSE, TRUE, $splitvar);
}

// Build arguments for pagination
$pagination_args = array(
  'total'     => $search->max_num_pages,
  'current'   => max(1, get_query_var('paged')),
  'show_all'  => FALSE,
  'prev_next' => TRUE,
  'prev_text' => __('Previous'),
  'next_text' => __('Next'),
  'type'      => 'array',
);
// Get pagination links
$pagination = paginate_links($pagination_args);
// Get first element in array
$prev = $pagination[0];
// Get last element in array
$next = "";
if (is_array($pagination) && !empty($pagination)) {
  $next = end($pagination);
}

// Start HTML output
?>
<section id="splash" class="header-390" data-speed="-2">
  <ul class="slideshowheader">
    <li class='slide-0 big-slide' style="background-image: url('/wp-content/uploads/2015/09/africa-botswana-1920x700.jpeg')">
      <div>
        <div class="caption">
          <div class="tbl">
            <div class="tc">
              <span class="headline">Search Results</span>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <div id='breadcrumb'>
    <div>
      <a href="/">Home</a> &gt; <strong class="current">Search Results</strong>
    </div>
  </div>
</section>

<?php if (isset($tour_results['output']) && !empty($tour_results['output'])): ?>
<section class="light-gray">
  <div>
    <h2>Tour results for <?php echo $splitvar ?></h2>
    <div class="related-tours clearfix">
      <?php echo $tour_results['output']; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section>
  <div>
    <h2>Search Results Across the site</h2>
<?php
  foreach ($search->posts as $key => $post) {
    $odd = ($key % 2) ? 'odd' : 'even';
    //content will most likely be empty.
    if (empty($post->post_content)) {
      $content = get_sub_field('content', $post->ID);
      while (has_sub_field('special_page_content')) {
        $content .= get_sub_field("content");
      } // End while
      $post->post_content = $content;
    } // End if
    // Start HTML output
?>
    <div class="result <?php echo $odd; ?>">
      <h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3>
      <p><?php echo limit_words($post->post_content, 50); ?></p>
    </div>
<?php
  } // End foreach

  if (empty($search->posts)) { ?>
    <div class="result <?php echo $odd; ?>">
      <h3>No Results were Found</h3>
      <p>Head back to the <a href="/">Boundless Journeys</a> front page</p>
    </div>
  <?php }


  // Display previous link, if it's a link and not span
  if (!strpos($prev, 'span')) {
    echo $prev;
  }
  // Display next link, if it's a link and not span
  if (!strpos($next, 'span')) {
    echo $next;
  }
?>
  </div>
</section>
<?php

get_footer();

// EOF