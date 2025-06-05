<?php
/*
 * Template Name: Category
 */

get_header();

global $wp_query;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = array(
    'order'           => 'DESC',
    'orderby'         => 'date',
    'posts_per_page'  => 10,
    'paged'           => $paged,
    'cat'             => get_query_var('cat')
);

$the_query = new WP_Query( $args );
$total = $the_query->max_num_pages;
     //   print_r($the_query);

$big = 999999999;
  $pagination_args = array(
    'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'total'           => $total,
    'current'         => max( 1, get_query_var('paged') ),
    'prev_next'       => True,
    'prev_text'       => __('Previous'),
    'next_text'       => __('Next'),
    'type'            => 'list',
  );


?>
<section id="splash" class="header-593" data-speed="-2">
  <ul class="slideshowheader">
    <li class="slide-0 big-slide" style="background-image:url('/wp-content/uploads/2015/08/slide-1-1564x700.jpg')">
      <div>
        <div class="caption">
          <div class="tbl">
            <div class="tc">
              <span class="headline"><?php single_cat_title(); ?></span>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <div id="breadcrumb">
    <div>
      <a href="/">Home</a> &gt; <a href="/blog/" title="Return to the Blog Homepage">Blog</a> &gt; <strong class="current">Category:</strong> <?php single_cat_title(); ?>
    </div>
  </div>
</section>
<section>
  <div>
    <div class="content-subnav clearfix">
      <div class="col col-main-content">
				<h1>Category: <?php single_cat_title(); ?></h1>
<?php
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post(); $bj_post_author = get_the_author(); ?>
            <article class='listing bj-post post-<?php echo $post->ID; ?>'>
            <?php
              if (has_post_thumbnail()) {
               the_post_thumbnail('thumbnail');
              } else {
                $postcat = wp_get_post_categories(get_the_ID());
                $image = category_image_src(array('term_id'=>$postcat[0], 'size'=> "thumbnail"), false );
                if ($image) {
                  echo "<img src='".$image . "'>";
                }
              }
            ?>
              <h2><a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a></h2>
              <div class='post-meta'>
                <time>
                  <small><?php print date('F jS, Y', strtotime($post->post_date) ) . ' &bull; by ' . $bj_post_author; ?></small>
                </time>
              </div>
              <p><?php /* limit_words($post->post_content, 100); */ the_excerpt(); ?></p>
            </article>

        <?php
          endwhile;

        endif;
          ?>
        <div class="blog-posts-nav">
        <?php
        echo paginate_links($pagination_args);
        wp_reset_query();
        ?>
        </div>
      </div>
      <div class='col col-main-sidebar subnav cats'>
      <?php if (function_exists('printBJRecentPosts')): ?>
        <div class="bj-blog-sidebar-widget recent-posts-widget">
          <h4>Recent Posts</h4>
          <?php printBJRecentPosts(); ?>
        </div>
      <?php endif; ?>
      <?php if (function_exists('printBJCatDropDown')): ?>
        <div class="bj-blog-sidebar-widget">
          <h4>Find Posts by Category</h4>
          <?php printBJCatDropDown(); ?>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php

get_footer();

// EOF