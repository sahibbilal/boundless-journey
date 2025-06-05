<?php
/**
 * Flexible Content Template: Trip Itinerary Days
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Mike Annand <mike.annand@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2016 VERB Interactive Inc. (http://www.verbinteractive.com)
 */
$tripitinerary      = get_field('trip_itinerary');
$tripaccommodations = get_field('trip_accommodations');
$imagesize          = FULLIMG . 'cta';
$imagesize          = 'accom_thumb';

// Build array of accommodation IDs by itinerary day
$accommbyday = array();
if ($tripaccommodations) {
  foreach ($tripaccommodations as $tripaccommodation) {
    if (isset($tripaccommodation['day'])) {
      $key = $tripaccommodation['day'];
      if (!isset($accommbyday[$key])) {
        $accommbyday[$key] = array();
      }
      $accommbyday[$key][] = $tripaccommodation['accommodation_id'];
    }
  } // End foreach
}

if ($tripitinerary) {
  // Start HTML output
?>
<div class="tour-itinerary">
<?php
  foreach ($tripitinerary as $trip) {
    // Determine if spanning multiple days
    $multiple_days = ($trip['day'] != $trip['day_to']) ? true : false;
?>
  <div class="itinerary">
    <div class="wrap">
    <?php if (isset($trip['day']) && !empty($trip['day'])): ?>
      <h3>Day<?php echo $multiple_days ? 's' : ''; ?> <?php echo $trip['day']; ?><?php echo $multiple_days ? ' - ' . $trip['day_to'] : ''; ?></h3>
    <?php endif; ?>
    <?php if (isset($trip['headline']) && !empty($trip['headline'])): ?>
      <p class="location"><?php echo $trip['headline']; ?></p>
    <?php endif; ?>
      <ul class="itin-details">
      <?php if (isset($trip['activity_overview']) && !empty($trip['activity_overview'])): ?>
        <li><span>Activity Overview:</span> <?php echo strip_tags($trip['activity_overview']); ?></li>
      <?php endif; ?>
      <?php if (isset($trip['activity_level']) && !empty($trip['activity_level'])): ?>
        <li><span>Activity Level:</span> <?php echo $trip['activity_level']; ?></li>
      <?php endif; ?>
      <?php if (isset($trip['estimated_length']) && !empty($trip['estimated_length'])): ?>
        <li><span>Activity Length:</span> <?php echo $trip['estimated_length']; ?></li>
      <?php endif; ?>
        <?php if ($trip['breakfast'] || $trip['lunch'] || $trip['dinner']): ?>
          <?php 
          $meal = [];
          if ($trip['breakfast']) {
            $meal[] = 'Breakfast';
          }
          if ($trip['lunch']) {
            $meal[] = 'Lunch';
          }
          if ($trip['dinner']) {
            $meal[] = 'Dinner';
          }
          ?>
          <li><span>Included Meals:</span> <?php echo implode(', ', $meal); ?></li>
        <?php endif; ?>
      </ul>
      <div class="details">
      <?php if (isset($trip['itinerary_block']) && !empty($trip['itinerary_block'])): ?>
        <?php echo $trip['itinerary_block']; ?>
      <?php endif; ?>
      <?php if (isset($accommbyday[$trip['day']])): ?>
        <div class="accommodations">
          <h5>Accommodations</h5>
<?php
    // Loop through accommodations for this itinerary day
    foreach ($accommbyday[$trip['day']] as $accommodation_id) {
      // Get accommodation data
      $data = verb_tourcube_get_accommodation_output($accommodation_id, $imagesize);
      if (!empty($data)) {
        $image = isset($data->image) ? $data->image : '';
        $title = isset($data->title) ? $data->title : '';
        $location = isset($data->location) ? $data->location : '';
        $description = isset($data->desc) ? $data->desc : '';
        $destination = verb_tourcube_get_destination(get_field('destination_id', $data->pageID));
        $parentdest = wp_get_post_parent_id($destination->ID);
?>
          <div class="accomm clearfix">
          <?php if (!empty($image)): ?>
            <div class="img"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>"></div>
          <?php endif; ?>
            <div class="accommdetails">
            <?php if (!empty($title)): ?>
              <p class="title"><?php echo $title; ?><?php if (!empty($location)): ?><br><small><?php echo $location; ?></small><?php endif; ?></p>
            <?php endif; ?>
            <?php if (!empty($description)): ?>
              <?php echo $description; ?>
            <?php endif; ?>
            </div>
          </div>
<?php
      } // End if
    } // End foreach
?>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
<?php
  } // End foreach
?>
</div>
<?php
} // End if

// EOF