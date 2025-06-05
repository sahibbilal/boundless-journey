<?php
	$image 		= get_sub_field("image");
	$size 		= FULLIMG . "full";
	$url 		= $image['sizes'][$size];
	$button 	= get_sub_field("button_text");
	$buttonurl 	= get_sub_field("button_link_value");
	$top 		= get_sub_field("margin_top");
	$bottom 	= get_sub_field("margin_bottom");
	$style 		= getMargins($top, $bottom);
	$max 		= get_sub_field("maximum_width");
	$align 		= get_sub_field("alignment");
	$content 	= get_sub_field("content");

	if( is_numeric($max) ){
		$max = $max . "px";
	}
?>

<section class="full-bg img" data-src="<?php echo $url; ?>" style="<?php echo $style; ?>">
	<div style="text-align: <?php echo $align; ?>">
		<div class="wrapper" style="max-width:<?php echo $max ?>; display:inline-block; ">
		<?php
			echo wpautop($content);
		?>
		<?php
		if($button){
		?>
		<a class="white button" href="<?php echo $buttonurl; ?>"><?php echo $button; ?></a>
		<?php } ?>
		</div>
	</div>
</section>
