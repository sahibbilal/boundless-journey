<?php

get_header();
while( has_sub_field('special_page_content') ){
	ACF_Layout::render(get_row_layout());
}

get_footer();

?>