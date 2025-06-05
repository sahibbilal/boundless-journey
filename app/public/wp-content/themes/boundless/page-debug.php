<?php

/*
Template Name: Debug Remote
Boundless Journeys: Responsive Template - Copyright VERB Interactive 2015
*/

get_header();

while( has_sub_field('special_page_content') ){
	ACF_Layout::render(get_row_layout());
}

?>
<section>
	<div>
		<div class="content-subnav clearfix">

      <div class="col col-main-content">
<?php


// URL to fetch
$url = 'https://www.boundlessjourneys.com'; // Replace with your desired URL

// Make the request
$response = wp_remote_get($url);

if (is_wp_error($response)) {
    echo 'Error: ' . $response->get_error_message();
} else {
    // Output the fetched content
    echo wp_remote_retrieve_body($response);
}

?>
			</div>

		</div>
	</div>
</section>

<?php
get_footer();
?>