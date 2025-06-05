<?php
	$image 			= get_sub_field("image");
	$size 			= FULLIMG . "full";
	$url 			= $image['sizes'][$size];
	$top 			= get_sub_field("margin_top");
	$bottom 		= get_sub_field("margin_bottom");
	$style 			= getMargins($top, $bottom);
	$header 		= get_sub_field("header");
	$leftcontent 	= get_sub_field("left_side");
	$rightcontent 	= get_sub_field("right_side");
	$max = get_sub_field("maximum_width");
	if( is_numeric($max) ){
		$max = $max . "px";
	}
	$align = get_sub_field("alignment");

?>

<section class="full-bg center-align" id="full-bg-boundless-advantage" style="background-image: url('<?php echo $url; ?>'); <?php echo $style; ?>">
	<div>
		<div class="wrapper">
		<?php
			echo wpautop($header);
		?>
			<div class="col-2-layout clearfix">
				<div class="col col-1">
				<?php
				echo wpautop($leftcontent);
				?>
				</div>
				<div class="col col-2">
				<?php
				echo wpautop($rightcontent);
				?>
				</div>
			</div>
		</div>
	</div>
</section>
