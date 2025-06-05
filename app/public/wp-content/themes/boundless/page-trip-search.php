  <?php
  /*
  Template Name: Tour Search
  Boundless Journeys: 2015 Responsive Template - Copyright VERB Interactive 2015
  */

  get_header();

  while( has_sub_field('special_page_content') ){
    ACF_Layout::render(get_row_layout());
  }

  if (function_exists('verb_tourcube_search_results')) {
   $output = verb_tourcube_search_results();
  } ?>



  <section class="tour-listing light-gray">
    <div class="clearfix">
      <div class="side">
        <div class="tour-filters">
        <?php
        if (function_exists('verb_tourcube_search_filter')) {
          verb_tourcube_search_filter();
        }
        ?>
        </div><!-- end of tour-filters -->
      </div> <!-- end of side -->


      <div class="tours">

        <div class="tour-sorting">
          <?php
          if (function_exists('verb_tourcube_search_sort_form')) {
            verb_tourcube_search_sort_form();
          } ?>
          <div class="pagination">
            <?php echo $output['pagination']; ?>
          </div>
        </div> <!-- end of tour sorting -->

        <div class="tour-holder clearfix">
          <?php
          echo $output['output'];
          ?>
        </div>

      </div> <!-- end of tours -->
      <div class="pagination">
        <?php echo $output['pagination']; ?>
      </div>
    </div><!-- end of clearfix -->
  </section>

  <?php

  get_footer();