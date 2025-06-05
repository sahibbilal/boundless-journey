<?php
//custom items on this template.
$msu_title		= get_post_meta(SEGID, 'msu_title', true);
$msu_signup 	= get_post_meta(SEGID, 'msu_details', true);
$msu_place 		= get_post_meta(SEGID, 'msu_placeholder', true);
$msu_button		= get_post_meta(SEGID, 'msu_button', true);
?>
<h4><span><?php echo $msu_title; ?></span></h4>
<p><?php echo $msu_signup; ?></p>

<form action="/sign-up" id="email_optin_footer" method="GET">
<div>
	<input type="text" id="email" name="field3" placeholder="<?php echo $msu_place; ?>" />
	<button type="submit" id="email_optin_footer_submit" class="button"><?php echo $msu_button; ?></button>
</div>
</form>