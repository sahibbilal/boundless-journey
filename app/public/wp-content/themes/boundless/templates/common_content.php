<?php
$commonitem = get_sub_field("common");
$commonitem = $commonitem[0];
$id = $commonitem->ID;
if ($commonitem->post_name == "accolades") {
	?>
		<section id="accolades">
		<div>
			<div class="accolades-holder clearfix">
				<?php outputAccolades(true); // lib/custom.php ?>
			</div>
		</div>
	</section>
	<?php
}
while( has_sub_field('special_page_content', $id) ){
	ACF_Layout::render(get_row_layout());
}





?>