<?php

	global $template;
	$content = get_sub_field("content");
	$quote = get_sub_field("quote");
	$author = get_sub_field('author');
	$image 	= get_sub_field('image');
	if (isset( $image['sizes']['thumbnail'] )){
		$thumb 	= $image['sizes']['thumbnail'];
	}
	if (isset($image['name'])) {
		$name = $image['name'];
	}
	$ignore = get_sub_field("ignore_menu");
	$margin_top 			= get_sub_field('margin_top');
	$margin_bottom 			= get_sub_field('margin_bottom');

	if (isset($margin_bottom)) {
		$style = 'style="padding-bottom:' . $margin_bottom . ';"';
	}

	if ( empty( $ignore[0] ) ) {
		$ignore[0] = 'no';
	}

	if(isset($content)) : ?>
<section <?php echo $style; ?>>
	<div>
    	<?php if ($ignore[0] != "yes" || basename($template) === 'page-reservation.php'){ ?>
			<div class="content-subnav clearfix">
				<div class="col-main-content col">
				<?= $content; ?>
				</div>
				<div class="col col-main-sidebar subnav cats">
					<?php if (basename($template) === 'page-reservation.php') { ?>
						<?php 
							$trip_image = get_field("trip_image"); 
							$trip_text = get_field("trip_text"); 
						?>
						<?php if(!empty($trip_image)){ ?>
							<div class="trip-image">
								<img src="<?php echo $trip_image['sizes']['large']; ?>" alt="<?php echo $trip_image['alt']; ?>">
							</div>
						<?php } ?>
						<?php if(!empty($trip_text)){ ?>
							<div class="trip-text">
								<?php echo wp_kses_post($trip_text) ?>
							</div>
						<?php } ?>
						<?php } else { ?>
						<?php get_template_part( 'templates/nav/base' ); ?>
					<?php } ?>
				</div>
			</div>
        <?php } else {
        	echo $content;
        } ?>
	</div>
</section>

<?php endif; ?>