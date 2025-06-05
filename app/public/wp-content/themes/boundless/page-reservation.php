  <?php
  /*
  Template Name: Trip Reservation
  Boundless Journeys: 2015 Responsive Template - Copyright VERB Interactive 2015
  */

  get_header(); ?>

  <?php
  while( has_sub_field('special_page_content') ){
  	ACF_Layout::render(get_row_layout());
  }
  ?>

  
<?php 
  get_footer();