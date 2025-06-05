<?php
get_header();

$type = strtolower(get_field('trip_type'));



get_template_part( 'templates/tours/header' );


if ($type == "custom tour") {
    $customclass = "custom-itinerary";
} else {
    $customclass = "";
}




?>
<section class="tour-itinerary <?php echo $customclass; ?>">
	<div>
		<div class="accordion-tabs itinerary-tabs clearfix" id="tour-tabs">

			<?php
			if ($type == "custom tour") {
				get_template_part( 'templates/tours/overview' );
				get_template_part( 'templates/tours/suggested' );
				get_template_part( 'templates/tours/accomm' );
				get_template_part( 'templates/tours/whattoexpect' );
				get_template_part( 'templates/tours/guides' );
				get_template_part( 'templates/tours/side' );
			} else {
				get_template_part( 'templates/tours/overview' );
				get_template_part( 'templates/tours/itenandaccom' );
				get_template_part( 'templates/tours/datesprices' );
				get_template_part( 'templates/tours/whattoexpect' );
				get_template_part( 'templates/tours/guides' );
				get_template_part( 'templates/tours/side' );
			}
			?>
		</div>
	</div>
</section>
<?php
while( has_sub_field('special_page_content', $post->ID) ){
	ACF_Layout::render(get_row_layout());
}

//Common Layouts
while( has_sub_field('special_page_content', TRIPCOMMON) ){
	ACF_Layout::render(get_row_layout());
}

get_footer(); ?>