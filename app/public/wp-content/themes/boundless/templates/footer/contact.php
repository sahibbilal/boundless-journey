<?php
	$title 		= get_post_meta(SEGID, 'contact_title', true);
	$subtitle 	= get_post_meta(SEGID, 'contact_sub_title', true);
	$phone		= get_post_meta(SEGID, 'contact_phone', true);
?>

<h2><span><?php echo $title;?></span></h2>
<p><?php echo $subtitle;?></p>
<p class="number"><a href="tel:<?php echo str_replace('-', '', $phone);?>" title="Call Now" class="fade"><?php echo $phone ;?></a></p>
<ul>
<?php outputContactButtons(true); ?>
</ul>