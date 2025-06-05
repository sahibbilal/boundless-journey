<?php
/*
 * Template Name: Single
 */

get_header();

?>
<section id="splash" class="header-593" data-speed="-2">
  <ul class="slideshowheader">
    <li class="slide-0 big-slide" style="background-image:url('/wp-content/uploads/2015/08/slide-1-1564x700.jpg')">
      <div>
        <div class="caption">
          <div class="tbl">
            <div class="tc">
              <span class="headline">Blog</span>
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
<?php
  if (have_posts()) {
    while (have_posts()) {
      the_post($args);
      $bj_post_author = get_the_author();
?>
        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
          <time>
            <small><?php print date('F jS, Y', strtotime($post->post_date)) . ' &bull; by ' . $bj_post_author; ?></small>
          </time>
        </div>
<?php
      the_content();
    } // End while
    $prev_index = ( $loop->current_post == 0 ) ? count( $loop->posts ) - 1 : $loop->current_post - 1;
    $next_index = ( $loop->current_post == count( $loop->posts ) - 1 ) ? 0 : $loop->current_post + 1;
    $prev_post = $loop->posts[$prev_index];
    $next_post = $loop->posts[$next_index];
    echo $next_post->post_title;
    echo $next_post->post_title;
  } // End if
?>
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