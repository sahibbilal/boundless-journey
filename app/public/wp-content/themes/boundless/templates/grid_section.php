<?php

// functions for the grid layout

$grids = get_sub_field("grids");
$inspired = get_sub_field("inspired");
$idname = "";
$output = "";
$classname = "cta-boxes";
$clearclass = "";
$centeropen = "";
$centerclose = "";
$cards_remain = "";
$top = get_sub_field("margin_top");
$bottom = get_sub_field("margin_bottom");
$style = getMargins($top, $bottom);
$style .= get_sub_field("text_color");
// detect if these are inspired boxes or not. Inspired ctas are larger typically.
//print_r($inspired);

if (! empty($inspired[0]) && $inspired[0] == "yes") {
	$idname = " id='cta-boxes-inspired' ";
}
$top_pad = get_sub_field("padding_top");
$bot_pad = get_sub_field("padding_bottom");
$header = '';
$footer = '';

$pad_override = '';
if($top_pad != ''):
  $pad_override = ' padding-top:' . $top_pad .  ';';
elseif($bot_pad != ''):
  $pad_override = ' padding-bottom:' . $bot_pad .  ';';
elseif($bot_pad != '' && $top_pad != ''):
  $pad_override = ' padding:' . $top_pad .  ' 0 ' . $bot_pad . ';';
endif;

// loop through the grid system

$gridtype = '';
$grids_count = count($grids);
if(fmod($grids_count, 2) == 1) {
    $cards_remain = " one-last";
}

foreach ($grids as $item) {
	if ($item['acf_fc_layout'] == "image_with_overlay") {
		$classname = "cta-images";
	}
	if ($item['acf_fc_layout'] == "textandbutton") {
		$classname 		= false;
		$idname 		= false;
		$clearclass 	= "cta-img-txt ";
		$centeropen		= "<div class='center-align'>";
		$centerclose 	= "</div>\n";
		$gridtype = "textandbutton";

	}

	$output .= grid_getType($item);
}

$sizer = "<div class='ctasizer'></div>";

if ($gridtype == "textandbutton") {
	$sizer = "";
}

$header = "<section class='noprint ".$classname.$cards_remain."' ".$idname." style='".$style.$pad_override."'>".$centeropen."<div class='".$clearclass."clearfix'>" . $sizer;
$footer .= "</div>".$centerclose."</section>\n";
// merge header output and footer
echo $header . $output . $footer;
?>