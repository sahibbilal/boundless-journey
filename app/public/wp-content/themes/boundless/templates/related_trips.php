<?php
	global $post;
	$top			= get_sub_field("margin_top");
	$bottom			= get_sub_field("margin_bottom");
	$style			= getMargins($top, $bottom);
	$title 			= get_sub_field("title");
	$button			= get_sub_field("show_more_trips_button");
  	$related_trips	= get_sub_field('related_trips');
	$top_bdr		= get_sub_field('related_trips_top_border');
?>

<section class="noprint<?= $top_bdr ? 'bdr-top-lfgt-grey' : ''; ?>" style="<?= $style; ?>">
	<div class="center-align related-trips">
		<?php if(!empty($title)) { ?>
			<h2><?= $title; ?></h2>
		<?php } ?>
		<?php if(!empty($related_trips)) { ?>
			<div class='cta-img-txt clearfix'>
				<?php foreach($related_trips AS $trip) { ?>
				<?php if ( 'publish' === $trip->post_status ) : ?>
					<?php
						if (!empty(get_field('thumbnail_image', $trip->ID))) {
							$image = get_field('thumbnail_image', $trip->ID);
							$image = $image['sizes']['htca'];
						} else {
							$image = wp_get_attachment_image_src(417, 'htca')[0];
						}
						$pageurl = esc_url(get_permalink($trip->ID));
					?>
					<div class="cta">
						<div class="img" data-src="<?= $image; ?>"><a class="fillable" href="<?= $pageurl; ?>"></a></div>
						<h3><a href="<?php echo $pageurl; ?>"><?php echo $trip->post_title; ?></a></h3>
						<p><?php echo limit_words(strip_tags(get_field('long_description', $trip->ID)), 30); ?>&hellip;</p>
						<p class="read-more">
							<a class="more" title="<?php echo esc_attr($trip->post_title); ?>" href="<?= $pageurl; ?>">View This Tour</a>
						</p>
					</div>

					<?php endif; ?>
				<?php } ?>
			</div>
			<?php } ?>
		<?php if($button) { ?>
			<div class='clearfix'><a href='/tours/' class='button gray' title='Show More Tours'>Show More Tours</a></div>
		<?php } ?>
	</div>
</section>
