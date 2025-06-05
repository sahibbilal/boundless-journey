<?php

	// map
	$imagesize = FULLIMG . "full";
	$map 		= get_field('map_image');
	$sale 		= get_field('trip_savings_description');
	$salebl 	= get_field('trip_savings');
	if( $map ){
		$mapimage 	= $map['sizes'][$imagesize];
	}

	$tagline 				= get_field('tag_line');
	$longdescription		= get_field('long_description');
	$shortdescription		= get_field('short_description');

?>

<div class="heading" id="heading-1">
	<div class="wrap">
		<div>Overview</div>
	</div>
</div>

<div class="content itinerary-overview" id="content-1">
	<div class="wrap">
		<?php
			if ($salebl && isset($sale)) {
				echo "<div class='specialoffer'>" . PHP_EOL;
				echo "<h2>Special Offer*</h2>" . PHP_EOL;
				echo "<p>" . $sale . "</p>" . PHP_EOL;
				if (isset($shortdescription)) {
					echo "<a href='#'>View Terms + Conditions</a>";
					echo "<div class='hideterms'>" . $shortdescription . "</div>";
				} else {
					echo "<a href='/terms-and-conditions/'>View Terms + Conditions</a>";
				}
				echo "</div>" .PHP_EOL;
			}
		?>
		<?php if(isset($tagline)){
			echo "<h1>" . $tagline . "</h1>" . PHP_EOL;
		}
		?>

		<?php if(isset($mapimage)){ ?>
		<div class="itinerary-map">
			<img src="<?php echo $mapimage; ?>">
		</div>
		<?php } ?>

		<?php

		if(!isset($longdescription)){
			if( isset($shortdescription) ){
				echo wpautop($shortdescription);
			}
		}else{
			echo wpautop($longdescription);
		}
		?>

		<?php get_template_part( 'templates/tours/features' ); ?>
		<?php get_template_part( 'templates/tours/guestquote' ); ?>

	</div>

</div> <!-- end of content-1 -->