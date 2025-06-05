<?php
/**
 * Flexible Content Template: Guest Quote
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Phil Neal <phil.neal@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2015 VERB Interactive Inc. (http://www.verbinteractive.com)
 */

$reviews          = get_field('trip_guest_reviews');
$name             = get_field('guest_name');
$location         = get_field('guest_location');
$review           = get_field('guest_review');

if (empty($reviews)) {
  $reviews = array(
    array(
      'guest_name' => 'Sarah I',
      'guest_location' => 'Boundless Journeys',
      'guest_review' => 'I really had a great time! Our guides were amazing and made the trip unforgettable. By the end of the trip I stopped thinking of them as guides and considered them friends. I was very impressed with their knowledge, professionalism, friendliness, and generosity.',
    ),
    array(
      'guest_name' => 'Tim L',
      'guest_location' => 'Springboro, Ohio',
      'guest_review' => 'Boundless Journeys captures the essence of culture and travel.',
    ),
    array(
      'guest_name' => 'Margaret T',
      'guest_location' => 'El Paso, Texas',
      'guest_review' => 'Boundless Journeys is the first company I look to for trips because I’m confident that their trips are high quality and good value for the money.',
    ),
    array(
      'guest_name' => 'Carol H',
      'guest_location' => 'Boundless Journeys',
      'guest_review' => 'My enthusiasm for your product is boundless and I will recommend it to all my friends!',
    ),
    array(
      'guest_name' => 'Ruth Ann K',
      'guest_location' => 'Rapid City, South Dakota',
      'guest_review' => 'It was the dream adventure of a lifetime and I will tell all my friends to take a Boundless Journeys trip.',
    ),
    array(
      'guest_name' => 'Connor O',
      'guest_location' => 'California',
      'guest_review' => 'Karen Cleary was phenomenal. She put together a fantastic trip on a very reasonable budget. I have already referred two friends to her, and I will absolutely be coming back for future trips.',
    ),
    array(
      'guest_name' => 'Pat K',
      'guest_location' => 'Oxford, Ohio',
      'guest_review' => 'Having completed my 3rd trip with Boundless Journeys, I’m excited about my next adventure with them.',
    ),
    array(
      'guest_name' => 'Dianne M',
      'guest_location' => 'Boundless Journeys',
      'guest_review' => 'Thanks for all of your help. I have never worked with a more professional and competent agent for any trip in my life. You are the gold standard. I appreciate everything you’ve done for us; THIS TRIP WILL BE FANTASTIC!',
    ),
    array(
      'guest_name' => 'Susan K',
      'guest_location' => 'Maple City, Michigan',
      'guest_review' => 'Each trip has been unique and wonderful with its own charms. The area I have been repeatedly impressed with is the guides. Every guide has been exceptional! Very different personalities, but all knowledgeable, friendly, adaptive, good leaders, patient, and all amazing representatives of their countries.',
    ),
    array(
      'guest_name' => 'Joan W',
      'guest_location' => 'San Clemente, California',
      'guest_review' => 'Boundless Journeys is a 5-star company that I would travel with again and again.',
    ),
    array(
      'guest_name' => 'Veronica A',
      'guest_location' => 'Boundless Journeys',
      'guest_review' => 'Boundless Journeys provides an extraordinary learning experience about our amazing world and ourselves.',
    ),
    array(
      'guest_name' => 'Anne C',
      'guest_location' => 'Boundless Journeys',
      'guest_review' => 'Ashley did a great job planning our trip. We contacted Boundless Journeys and at least 20 other companies we found on the Internet. Ashley was the most responsive and helpful of all the people we initially contacted and that is the primary reason we went with Boundless.',
    ),
    array(
      'guest_name' => 'Barbara S',
      'guest_location' => 'Old Saybrook, Connecticut',
      'guest_review' => 'I was amazed that every time I called Boundless Journeys they knew who I was and could accommodate what I wanted. Very well informed and prepared to add value—bravo!',
    ),
    array(
      'guest_name' => 'Betty S',
      'guest_location' => 'Burlingame, California',
      'guest_review' => 'Boundless Journeys far exceeded our high expectations in the services and sights. It seemed as though the attention to details and the attention to us as guests was “boundless',
    ),
  );
}

if (is_array($reviews)) {
  // Randomize reviews
  shuffle($reviews);
}

if ( isset($reviews[0]['guest_name']) && isset($reviews[0]['guest_location']) && isset($reviews[0]['guest_review']) ) { ?>
	<a name="guest-quote"></a>

	<div class="guest-quote">

		<h3>What Our Guests Have To Say About This Tour</h3>

		<?php /*
		<div class="quote">
			<?php echo wpautop($reviews[0]['guest_review']); ?>
		</div>

		<div class="cite">
			<div class="name"><p><strong><?php echo $reviews[0]['guest_name']; ?></strong><br><em><?php echo $reviews[0]['guest_location']; ?></em></p></div>
		</div>

 		<?php */ ?>

		<div class="quote">
			<?php echo do_shortcode("[RICH_REVIEWS_SHOW num='1000' category='page']"); ?>
		</div>

		<script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="application/javascript"></script>
		<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

		<h3 id="review-form-toggle">Write a Review <span id="review-form-toggle-icon" class="ui-icon ui-icon-plusthick"></span></h3>
		<div id="review-form"> <?php echo do_shortcode("[RICH_REVIEWS_FORM]"); ?></div>

	</div>

	<script></script>

	<?php
}

// EOF