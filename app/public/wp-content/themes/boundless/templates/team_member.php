<?php

/**
 * Flexible Content Template: Guides
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 *
 *
 * @author Phil Neal <phil.neal@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2016 VERB Interactive Inc. (http://www.verbinteractive.com)
 */


	// gather all content

	$name 				= get_sub_field('name');
	$position 			= get_sub_field('position');
	$content 			= get_sub_field('content');
	$image 				= get_sub_field('image');
	$quote 				= get_sub_field('quote');
	$margin_top 		= get_sub_field('margin_top');
	$margin_bottom 		= get_sub_field('margin_bottom');

	// check filled out fields.

	if ($position) {
		$position = "<h4>" . $position . "</h4>" . PHP_EOL;
	}
	if ($content) {
		$content = '<div class="team-content-text">' . $content . '</div>' . PHP_EOL;
	}
	if (isset($margin_top) || isset($margin_bottom)) {
		$margins = 'style="padding-top:' . $margin_top . '; padding-bottom:' . $margin_bottom . ';"';
	}
	if ($image) {
		$imageurl = $image['sizes']['mobile_cta'];
		$imageoutput = '<img src="'.$imageurl.'" title="' . $image['title'] . '">' . PHP_EOL;
	}
	if ($quote) {
		$quote = '<div class="team-quote">' . $quote . '</div>' . PHP_EOL;
	}




?>
<section class="team-member" <?php echo $margins; ?> >
	<div>
		<div>
			<div class="col team-imgbox">
				<?php echo $imageoutput; ?>
				<?php echo $quote; ?>
			</div>
			<div class="col-main-content team-content">
				<h2><?php echo $name; ?></h2>
				<?php echo $position; ?>
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</section>