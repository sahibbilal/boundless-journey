<?php
/**
 * Template: Primary Navigation
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Johnny Ash <johnny.ash@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2015 VERB Interactive Inc. (http://www.verbinteractive.com)
 */

/**
 * Add active class to parent menu item
 *
 * @param   int       $menuID
 * @return  void
 */
function activeTrail($menuID) {
  global $post;
  // Get post ID of current page
  $currentpage = $post->ID;
  // Get child posts for current page
  $currentpageparents = get_post_ancestors($currentpage);
  // Array of WordPress page IDs that are "faked" child pages.  These are pages that need to appear as children, but aren't.
  $compare = array();
  // Compare current page ID with one off pages
  switch ($menuID) {
    // Tour Finder
    case 9090:
      // Append post IDs for "faked" child pages
      $compare[] = 6210;                // Scheduled Tours
      //$compare[] = 11399;               // Special Departures
      // Build WP Query args
      $args = array(
        'post_type'       => 'vtc_trip',
        'posts_per_page'  => -1,
      );
      // Get posts
      $loop = new WP_Query($args);
      while ($loop->have_posts()) {
        $loop->the_post();
        // Append trip post ID as "faked" child page
        $compare[] = get_the_ID();
      } // End while
      // Reset post data
      wp_reset_postdata();
      break;
    // Destinations
    case 20:
      // Array of top level destinations
      $parent_destinations = array(
        5098,                           // Africa
        5141,                           // Asia
        5172,                           // Europe
        5206,                           // Latin America
        5220,                           // South Pacific
      );
      // Build WP Query args
      $args = array(
        'post_parent__in' => $parent_destinations,
        'post_type'       => 'page',
        'posts_per_page'  => -1,
      );
      // Get posts
      $destinations = new WP_Query($args);
      // Loop through child pages
      while ($destinations->have_posts()) {
        $destinations->the_post();
        // Append child page ID
        $compare[] = get_the_ID();
      }
      // Reset post data
      wp_reset_postdata();
      // Merge child destinations with parents
      $compare = array_merge($parent_destinations, $compare);
      break;
    // Ways to Travel
    case 367:
      // Append post IDs for "faked" child pages
      $compare[] = 5359;                // Hiking & Walking
      $compare[] = 5361;                // Nature Tours & African Safaris
      $compare[] = 5351;                // Cultural Encounters
      $compare[] = 5363;                // Trekking
      $compare[] = 5353;                // Expedition Cruising
      $compare[] = 5525;                // Custom Tours
      $compare[] = 11399;               // Special Departures
      //$compare[] = 5868;                // Special Events
      break;
    // Why Travel With Us
    case 8:
      // Append post IDs for "faked" child pages
      $compare[] = 6;                   // About Boundless Journeys
      $compare[] = 10;                  // Responsible Travel
      $compare[] = 12;                  // Meet Our Guides
      $compare[] = 14;                  // Media Gallery
      $compare[] = 6036;                // The Boundless Advantage
      $compare[] = 6040;                // Our Core Values
      $compare[] = 6053;                // Awards & Accolades
      $compare[] = 6133;                // The Home Team
      $compare[] = 22844;               // Ways to Save ID on live only.
      break;
    default:
      break;
  }
  // Conditions for active-trail to display
  $isSamePage = ($menuID == $currentpage) ? TRUE : FALSE;
  $isChildPage = in_array($menuID, $currentpageparents) ? TRUE : FALSE;
  $isFakeChild = in_array($currentpage, $compare) ? TRUE : FALSE;
  // Check conditions to determine if active-parent class is required
  $active = ($isSamePage || $isChildPage || $isFakeChild) ? ' active-parent' : '';
  // Display active trail class
  if (!empty($active)) {
    echo $active;
  }
}


// Check if we have special departures to show in mega menu
$haveSpecialDepartures = FALSE;
$condition = array(
  'key'     => 'special_departure',
  'value'   => array('1'),
  'type'    => 'char',
  'compare' => 'IN',
);
// Get count of special departures
$count = verb_special_count_search($condition);
if ($count > 0) {
  // We have special departures
  $haveSpecialDepartures = TRUE;
   }

// Start HTML output

// Display desktop megamenu markup
if (method_exists('VERB_ACF_MegaMenu', 'getMegaMenu')) {
  $menu_name_id = get_field( 'menu_name' );

  VERB_ACF_MegaMenu::getMegaMenu($menu_name_id);
}
?>
<!-- end of mega menu -->
<?php
// EOF
