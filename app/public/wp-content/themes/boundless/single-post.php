<?php
/*
 * Template Name: Single Post
 */

get_header();

// check for featured image.
$image = wp_get_attachment_image_src( get_post_thumbnail_id(), FULLIMG . "full" );

$image = (isset($image[0])) ? $image[0] : '/wp-content/uploads/2015/08/slide-1-1564x700.jpg';

?>
<section id="splash" class="header-593" data-speed="-2">
  <ul class="slideshowheader">
    <li class="slide-0 big-slide" style="background-image: url('<?php echo $image; ?>')">
      <div>
        <div class="caption">
          <div class="tbl">
            <div class="tc">
              <span class="headline">The Curious Traveler</span>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <div id="breadcrumb">
    <div>
      <a href="/">Home</a> &gt; <a href="/blog/" title="Return to the Blog Homepage">Blog</a> &gt; <strong class="current"><?php the_title(); ?></strong>
    </div>
  </div>
</section>
<section>
  <div>
    <div class="content-subnav clearfix">
      <div class="col col-main-content col-single-post">
        <article class="bj-post post-<?php echo esc_attr($post->ID); ?>">
<?php
  if (have_posts()) {
    while (have_posts()) {
      the_post($args);
      $bj_post_author = get_the_author();
?>
          <h1><?php the_title(); ?></h1>
          <div class='post-meta'>
            <time>
              <small><?php print date('F jS, Y', strtotime($post->post_date) ) . ' &bull; by ' . $bj_post_author; ?></small>
            </time>
          </div>
          <?php the_content(); ?>
        </article>
<?php
    } // End while
?>
        <div class="blog-post-nav">
          <ul>
<?php
    if (get_adjacent_post(false, '', true)) {
      previous_post_link('<li class="older-posts-btn">%link</li>', 'Older Post');
    }

    if (get_adjacent_post(false, '', false)) {
      next_post_link('<li class="newer-posts-btn">%link</li>', 'Newer Post');
    }

?>
          </ul>
        </div>
<?php
  } // End if
?>
      </div>
      <div class="col col-main-sidebar subnav cats">
      <?php if (function_exists('printBJRecentPosts')): ?>
        <div class="bj-blog-sidebar-widget recent-posts-widget">
          <h4>Recent Posts</h4>
          <?php printBJRecentPosts(); ?>
        </div>
      <?php endif; ?>
      <?php if (function_exists('printBJCatDropDown')): ?>
        <div class="bj-blog-sidebar-widget">
          <h4>Find Posts by Category</h4>
          <ul><?php printBJCatDropDown(); ?></ul>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php

get_footer();

// EOF