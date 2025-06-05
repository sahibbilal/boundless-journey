<?php

/*
Template Name: Blog Home
Boundless Journeys: Responsive Template - Copyright VERB Interactive 2015
*/

get_header();

while( has_sub_field('special_page_content') ){
	ACF_Layout::render(get_row_layout());
}

?>
<section>
	<div>
		<div class="content-subnav clearfix">

      <div class="col col-main-content">

        <?php
        global $wp_query;
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = array(
            'order'       => 'DESC',
            'orderby'       => 'date',
            'posts_per_page'  => 5,
            'paged'       => $paged
        );

        $the_query = new WP_Query( $args );

        $total = $the_query->max_num_pages;


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

        <!-- Recent posts -->
        <div class="bj-blog-sidebar-widget recent-posts-widget">
          <h4>Recent Posts</h4>
          <?php printBJRecentPosts(); ?>
        </div>

        <!-- Post Categories -->
        <div class="bj-blog-sidebar-widget">
          <h4>Find Posts by Category</h4>
          <?php printBJCatDropDown(); ?>
        </div>

			</div>

		</div>
	</div>
</section>

<?php
get_footer();
?>