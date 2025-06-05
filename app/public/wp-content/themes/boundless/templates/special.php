<?php
/* Special Departures Template */

function lightordark($hex){
	$hex = str_replace("#", "", $hex);
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));

	if($r + $g + $b > 382){
    	return "darkfont";
	}else{
    	return "brightfont";
	}

}



$show = get_field('show_special_departure', SEGID);

if ($show === true) {
	$content = get_field('content', SEGID);
	$button = get_field('button', SEGID);
	$bgcolor = get_field('background_color', SEGID);
	$buttonhtml = "";
	$style = " background-color: " . $bgcolor;





	if (isset($button[0]['text']) && isset($button[0]['link'])) {
		$target = "";
		if ($button[0]['new_window'] === true) {
			$target = 'target="_blank"';
		}
		if ($button[0]['text']) {
			$buttonhtml = '<a class="button" href="'.$button[0]['link'].'" '.$target.'>'.$button[0]['text'].'</a>';
		}

	}
?>
		<section class="specialheader closed loading <?php echo lightordark($bgcolor); ?>" style="<?php echo $style; ?>">
			<div>
				<?php echo $content; ?>
				<?php echo $buttonhtml; ?>
				<span class="close">close</span>
			</div>
		</section>

<?php
}
?>