<?php

$left			= get_post_meta(SEGID, 'cr_segment1', true);
$address 		= get_post_meta(SEGID, 'cr_address', true);
$phone 			= get_post_meta(SEGID, 'cr_phone_number', true);
$email			= get_post_meta(SEGID, 'cr_email_address', true);

?>

<p class="copyright">Copyright <?php echo date('Y') . " " . $left; ?></p>
<p class="address"><?php echo $address; ?></p>
<p class="contact"><span class="number"><a href="tel:<?php echo str_replace('-', '', $phone); ?>"><?php echo $phone; ?></a></span> <span><a href="mailto:<?php echo $email; ?>" title="Email <?php echo $email; ?>" target="_blank"><?php echo $email; ?></a></span></p>

<ul>
	<li><a href="/site-map/" title="Site Map">Site Map</a></li>
	<li class="last"><a href="/privacy-statement/" title="Privacy Statement">Privacy Statement</a></li>
</ul>
