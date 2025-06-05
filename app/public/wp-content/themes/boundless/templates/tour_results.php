<?php
/*******************************************************************************
 * Flexible Content template file for Tour Results
 ******************************************************************************/
$full = get_sub_field('full_tour_search');

if (isset($full[0]) && $full[0] == 'yes') {
	get_template_part('templates/tours/full_tour_search');
}
else {
	get_template_part('templates/tours/tour_ctas');
}

// EOF