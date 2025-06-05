<?php
global $post;
// because of the flat structure of the site we have to hard code the items that spill
// arbitrarily to different menu groups.

// legal items same as booked menu in footer.
$alreadybooked = array(26,28,30,32);

if(in_array($post->ID, $alreadybooked)) {
	initmenu_booked();
} else {

	initmenu_base();

}

?>