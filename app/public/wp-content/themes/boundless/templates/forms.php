<?php

$side = get_sub_field("side_bar");
$content = get_sub_field("content");
$form = get_sub_field("form_type");
$class = "";
//$forminclude = ""


if( isset($side) && $side != "" ){
	$class = "lead-in-inspired";
}
?>


<section>
	<div class="<?php echo $class; ?> clearfix">
		<div class="col col-1"><?php echo $content . $forminclude; ?>
		<?php
			include_once('forms/form-'.$form . ".php");
		?>
		</div>
		<?php

		if(isset($side) && $side != ""){
			echo "<div class='col col-2'>". $side ."</div>\n";
		}
		?>


	</div>
</section>

