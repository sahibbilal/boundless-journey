<?php
/**
 * Flexible Content Template: Header
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

global $post;

$imagesize = FULLIMG . 'full';
$image = get_field('header_image');
// Check that image for specific size exists
if (!empty($image) && isset($image['sizes'][$imagesize])) {
	$image = $image['sizes'][$imagesize];
}
else {
	// Use default image
	$image = wp_get_attachment_image_src(417, $imagesize);
	$image = $image[0];
}

// Arguments for breadcrumb function
$args = array(
  'type'			=> 'string',
  'elm_id'		    => 'breadcrumb',
  'post_type_label' => 'Tours',
);

?>
<section id="splash" class="header-478" data-speed="-2">
	<ul class="slideshowheader">
		<li class="slide-593 big-slide" style="background-image: url('<?php echo esc_url($image); ?>')">
			<div>
				<div class="caption">
					<div class="tbl">
						<div class="tc">
							<span class="headline"><?php the_title(); ?></span>
							<img src="<?php echo esc_url($image); ?>" style="position:absolute; top:0; left:0; z-index:-1000; opacity:0;">
						</div>
					</div>
				</div>
			</div>
		</li>
	</ul>
	<div id="breadcrumb">
	  <div>
<?php
  if (function_exists('verb_tourcube_trip_breadcrumb')) {
    verb_tourcube_trip_breadcrumb();
  }
?>
	  </div>
	</div>
</section>
