<?php
/**
 * Flexible Content Template: Trip Accommodations
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
global $wpdb;

$imagesize = "accom_thumb";

// Start HTML output
?>
<div class="heading" id="heading-3">
	<div class="wrap">
		<div>Where to Stay</div>
	</div>
</div>
<div class="content tour-itinerary custom-tour" id="content-3">
	<div class="wrap">
		<div>

<?php
	$region_ids = array();

	if ( have_rows( 'trip_destinations' ) ) :
		while( have_rows( 'trip_destinations' ) ) : the_row();
			$region_ids[] = get_sub_field( 'destination_id' );
		endwhile;
	endif;

	if ( !empty($region_ids) ) {

		// Loop through regions
		foreach ( $region_ids as $region_id ) :
			// Get destinations for region
			$region_post_id = get_posts( array(
				'post_type'      => 'vtc_destination',
				'posts_per_page' => 1,
				'meta_query'     => array(
					array(
						'key' => 'destination_id',
						'value' => $region_id,
						'compare' => '=',
					),
				),
				'fields'  => 'ids',
			) );
		
			if ( !empty( $region_post_id ) ) :
				$parent_post_id = wp_get_post_parent_id( $region_post_id[0] );
		
				if ( $parent_post_id ) {
					$destination_post_ids = get_posts( array(
						'post_type' => 'vtc_destination',
						'posts_per_page' => -1,
						'post_parent' => $region_post_id[0],
						'fields' => 'ids',
						'orderby' => 'title',
						'order'   => 'ASC',
					) );	
				}
			endif;
		
			if ( !empty( $destination_post_ids ) ) :
				// Loop through destinations
				foreach ($destination_post_ids as $destination_post_id) :
					$destination_id = get_field('destination_id', $destination_post_id);
					
					// Get accommodations for destination
					$accommodation_post_ids = get_posts( array(
						'post_type'      => 'vtc_accommodation',
						'posts_per_page' => -1,
						'fields'         => 'ids',
						'orderby'        => 'title',
						'order'          => 'ASC',
						'meta_query'     => array(
							array(
								'key'     => 'destination_id',
								'value'   => $destination_id,
								'compare' => '=',
							),
						),
					) );
				
					if (!empty($accommodation_post_ids)) :
						// Display destination name
						// we need both a description and a name in order to show the item otherwise u will have an empty country title.
				
						#todo cuba has been hardcoded out since its still being fed in via tourcube. There is no way to remove it otherwise.
				
						$destination_name = get_the_title( $destination_post_id );
						$destination_description = get_field( 'destination_description', $destination_post_id );
				
						if ( isset( $destination_name ) && !empty( $destination_name ) ) :
							if ( $destination_name == "Cuba" ) continue;
				
							echo '<div class="clear-fix region">' . PHP_EOL;
							echo '<h2>' . $destination_name . '</h2>' . PHP_EOL;

							// Show destination description
							if ( isset( $destination_description ) && !empty( $destination_description ) ) :
								echo '<p>' . $destination_description . '</p>' . PHP_EOL;
							endif;
						endif;
						
						if ( !empty( $accommodation_post_ids ) ) :
							// Loop through accommodations
							// foreach ($accommodations as $accommodation) {
							foreach ($accommodation_post_ids as $accommodation_post_id) :
								$accommodation_service_grade = get_field( 'service_grade', $accommodation_post_id );
								$accommodation_id = get_field( 'accommodation_id', $accommodation_post_id );
					
								// Get accommodation details
								$data = verb_tourcube_get_accommodation_output($accommodation_id, $imagesize);
								if ( !empty( $data ) ) :
									$image = isset($data->image) ? $data->image : '';
									$title = isset($data->title) ? $data->title : '';
									$description = isset($data->desc) ? $data->desc : '';
									$grade = isset($accommodation_service_grade) ? $accommodation_service_grade : '';
									$location = isset($data->location) ? $data->location : '';
									
									switch($grade) {
										case 'D':
											$gradeoutput = "<span>Deluxe</span>";
											break;
										case 'L':
											$gradeoutput = "<span>Luxury</span>";
											break;
										case 'C':
											$gradeoutput = "<span>Classic</span>";
											break;
										default:
											$gradeoutput = "";
									} ?>
									<div class="itinerary">
										<div class="accomm">
										<?php if (!empty($image)): ?>
											<div class="img"><img src="<?php echo esc_url($image); ?>"></div>
										<?php endif; ?>
										<?php if (!empty($title)): ?>
											<h4><?php echo $title; ?><?php echo $gradeoutput; ?></h4>
										<?php endif; ?>
										<?php if (!empty($location)): ?>
											<p><small><?php echo $location; ?></small></p>
										<?php endif; ?>
										<?php if (!empty($description)): ?>
											<?php echo $description; ?>
										<?php endif; ?>
										</div>
									</div>
								<?php endif;
							endforeach;
						endif;

						if ( isset( $destination_name ) && !empty( $destination_name ) ) :
							echo '</div>' . PHP_EOL;
						endif;
					endif;
				endforeach;
			endif;
		endforeach;
	}
?>
		</div>
	</div>
</div>