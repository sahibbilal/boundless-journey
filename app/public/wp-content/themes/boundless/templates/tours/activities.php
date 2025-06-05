<?php
/**
 * Flexible Content Template: Trip Activities
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Your Name <mike.annand@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2015 VERB Interactive Inc. (http://www.verbinteractive.com)
 */
$tripitinerary = get_field('trip_itinerary');

if (!empty($tripitinerary)) {
  // Start HTML output
?>
<div class="tour-itinerary">
  <?php foreach($tripitinerary as $trip): ?>
  <div class="itinerary">
    <div class="wrap">
    <?php if (isset($trip['day'])): ?>
      <h3>Day <?php echo $trip['day']; ?></h3>
    <?php endif; ?>
    <?php if (isset($trip['headline'])): ?>
      <p class="location"><?php echo $trip['headline']; ?></p>
    <?php endif; ?>
      <ul class="itin-details">
      <?php if (isset($trip['activity_overview'])): ?>
        <li><span>Activity Overview:</span> <?php echo $trip['activity_overview']; ?></li>
      <?php endif; ?>
      <?php if (isset($trip['activity_level'])): ?>
        <li><span>Activity Level:</span> <?php echo $trip['activity_level']; ?></li>
      <?php endif; ?>
      <?php if (isset($trip['estimated_length'])): ?>
        <li><span>Activity Length:</span> About <?php echo $trip['estimated_length']; ?></li>
      <?php endif; ?>
      </ul>
      <div class="details">
      <?php if (isset($trip['itinerary_block'])): ?>
        <?php echo $trip['itinerary_block']; ?>
      <?php endif; ?>
        <div class="accommodations">
        <h5>Accommodations</h5>
        <div class="accomm clearfix">
          <div class="img"><img src="http://placehold.it/700x467" alt="" /></div>
            <div class="accommdetails">
              <p class="title">Hostería del Monasterio de San Millán, San Millán de la Cogolla, La Rioja, Spain</p>
              <p>This four-star hotel is located in a wing of the famous Yuso Monastery in San Millán de la Cogolla, in the heart of the high Rioja, a region known to produce some of the world’s finest wines.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php
} // End if

// EOF