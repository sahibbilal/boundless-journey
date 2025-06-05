<?php
	global $post;
	$top 		  = get_sub_field("margin_top");
	$bottom  	= get_sub_field("margin_bottom");
	$style 		= getMargins($top, $bottom);
	$title 		= get_sub_field("title");
	$button 	= get_sub_field("show_continue_reading_button");
  	$dest     = get_field('trip_destinations');
	$top_bdr 	= get_sub_field('related_articles_top_border');

	if (empty($top_bdr[0])) {
		$top_bdr[0] = 'no';
	}

	// grab categories
	$cats 		= get_sub_field("related_categories");
	$posttype 	= "post";

	// button setup
	if($button[0] == "yes"){
		$buttondisplay = "<div class='clearfix'><a href='".SITEURL."/blog' class='button gray' title='Continue Reading Our Travel Blog'>Continue Reading Our Travel Blog</a></div>" . PHP_EOL;
	}else{
		$buttondisplay = null;
	}
?>
<section class="noprint<?php echo $top_bdr[0] == 'yes' ? ' bdr-top-lfgt-grey' : ''; ?>" style="<?php echo $style; ?>">
	<div class="center-align related-articles">
	<h2><?php echo $title; ?></h2>
		<div class='cta-img-txt clearfix'>
		<?php
		// if vtc trip that means we pull the destination to show related articles to this trip.
		if (($post->post_type == "vtc_trip") && $dest) {
			$posttype = "repeatedcontent";
			$cats = array();
			// loop through and get all the destinations themselves
			foreach ($dest as $value) {
				$destdata = verb_tourcube_get_destination($value['destination_id']);
				$catvalue = get_cat_ID($destdata->post_title);
				if($catvalue > 0){
					$cats[] = $catvalue;
				}
			}
		}
		//get articles is in the lib/custom.php
		getArticles($cats, 3, $posttype);
		?>
		</div>
		<?php echo $buttondisplay; ?>
	</div>
</section>
