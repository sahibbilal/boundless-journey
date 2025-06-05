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
 * $Id$
 *
 * @author Phil Neal <phil.neal@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2015 VERB Interactive Inc. (http://www.verbinteractive.com)
 */

$guides = get_field('trip_guides');


$tmp_guide_img = '/wp-content/uploads/2015/09/guide-temp.png';

if (!empty($guides)) {
  ?>

  <div class="heading" id="heading-5">
  	<div class="wrap">
  		<div>Guides</div>
  	</div>
  </div>

  <div class="content itinerary-guides" id="content-5">
  	<div class="wrap">
  		<h2 class="h1">Featured Guides</h2>

  		<?php
  		foreach ($guides as $value) {
  			$guide = verb_tourcube_get_guide($value['guide_id']);
        if (empty($guide[0]) || !$guide[0]->post_title) break;
  			$image = get_field('guide_image', $guide[0]->ID);
  			if (isset($image['sizes']['thumbnail'])) {
  				$image = $image['sizes']['thumbnail'];
  			}
  			?>
    		<div class="featured-guides">
    			<div class="feature clearfix">
    				<div class="img-name">
    					<div class="img"><img src="<?php echo $image == '' ? $tmp_guide_img : $image ?>" alt="" /><h5><?php echo $guide[0]->post_title; ?></h5></div>
    				</div>
    				<div class="description">
    				<?php echo get_post_meta($guide[0]->ID, 'guide_description', true ); ?>
    				</div>
    			</div>
    		</div>
    		<?php
      }
      ?>
  		<div class="about-guides">
  			<h3>About Our Guides</h3>
  			<?php echo wpautop(get_post_meta(SEGID, 'about_guides_content', true)); ?>
  		</div>


  	</div>
  </div>

  <?php
} //end of the empty check
?>