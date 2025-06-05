<?php

$top = get_sub_field("margin_top");
$bottom = get_sub_field("margin_bottom");
$style = getMargins($top, $bottom);
$content = get_sub_field("centered_text_block_content");
$top_bdr = get_sub_field("add_top_border");
$top_pad = get_sub_field("top_padding");
$bot_pad = get_sub_field("bottom_padding");
$left_align_copy = get_sub_field("left_align_copy");

$pad_override = '';

if($top_pad != ''):
  $pad_override = ' padding-top:' . $top_pad .  ';';
elseif($bot_pad != ''):
  $pad_override = ' padding-bottom:' . $bot_pad .  ';';
elseif($bot_pad != '' && $top_pad != ''):
  $pad_override = ' padding:' . $top_pad .  ' 0 ' . $bot_pad . ';';
endif;

if (empty($left_align_copy[0])) {
  $left_align_copy[0] = 'no';
}

if (empty($top_bdr[0])) {
  $top_bdr[0] = 'no';
}

?>

<section class="<?php echo $bot_pad == 0 ? 'snug-centered-content' : ''; ?><?php echo $left_align_copy[0] == 'yes' ? ' left-aligned-override' : ''; ?><?php echo $top_bdr[0] == 'yes' ? ' bdr-top-lfgt-grey' : ''; ?>" style="<?php echo $style . $pad_override; ?>">
	<div class="container">
	  <div class="centered-content">
      <?php
        echo wpautop($content);
      ?>
    </div>
	</div>
</section>
