<?php
// get all variables for this section.
$size 			= get_sub_field("size");
$content 		= get_sub_field("header");
$slides 		= array();


$imagesize = ($size == 974) ? FULLIMG . "full_large" : FULLIMG . "full";
$bread_crumbs 	= get_sub_field("bread_crumbs");
global $post;
?>


<section id="splash" class="header-<?php echo $size; ?> " data-speed="-2">
	<ul class="slideshowheader">

	<?php

	if($content) {
		foreach($content as $key => $value){
			$primary    	= $value['primary_text'] ?? '';
			$secondary  	= $value['secondary_text'] ?? '';
			$prefix     	= $value['prefix_text'] ?? '';
			$image      	= $value['image']['sizes'][$imagesize] ?? '';
			$video 			= $value['video'] ?? '';
			$button 		= $value['button'] ?? '';
			$button_url 	= $value['button_url'] ?? '';
			$cite 			= $value['photo_credit'] ?? '';

	?>


	<?php if(!empty($image)) { ?>

		<li class='slide big-slide show' style="background-image: url('<?php echo esc_url($image); ?>');">

			<div>
				<div class="caption">
					<div class="tbl">
					<?php if( isset($video) && $video != "" ) : ?>
					<video preload autoplay loop>
						<source src="<?php echo $video; ?>.mp4" type="video/mp4; codecs=avc1.42E01E,mp4a.40.2" />
						<source src="<?php echo $video; ?>.webm" type="video/webm; codecs=vp8,vorbis"/>
						<source src="<?php echo $video; ?>.ogv" type="video/ogg; codecs=theora,vorbis" />
					</video>
					<?php endif; ?>
						<div class="tc">
		        			<?php if ( $prefix != '' ): ?>
		        			<span class="subheadline"><?php echo esc_html($prefix); ?></span>
		        			<?php endif; ?>
							<h1 class="headline"><?php echo $primary; ?></h1>
							<?php if( isset($button) && $button != "") : ?>
								<a class="cta-button" title="" href="<?php echo SITEURL;?><?php echo $button_url ?>"><?php echo $button ?></a>
							<?php endif; ?>
						</div>
					</div>
					<?php if(isset($cite) && $cite != "" ) : ?>
					<div class="container">
		      			<div class='note'><?php echo $cite ?></div>
		    		</div>
					<?php endif; ?>
				</div>
			</div>
		</li>

	<?php
		} else {
		//default header.
		?>

		<li class='slide big-slide' style="background-image: url('/wp-content/themes/boundless/images/default.jpg')">
			<div>
				<div class="caption">
					<div class="tbl">
						<div class="tc">
							<h1 class="headline"><?php echo $post->post_title; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</li>
			<?php }	?>
		<?php } ?>

	<?php } // end of foreach loop

?>

	</ul>

	<?php //use breadcrumb plugin
	if ((! empty($bread_crumbs[0]) && $bread_crumbs[0] == 'Yes') || $post->post_type == 'vtc_destination') {
		echo "<div id='breadcrumb'><div>\n";
		if ( function_exists( 'bread_crumb' ) ) {
			bread_crumb(array(
				"type"				=> "string",
				"elm_id"			=> "breadcrumb",
				"post_type_label"	=> $post->post_type
			));
		}
		echo "</div></div>\n";
	}else{
		echo '<div class="bottom-mask"></div>';
	}
	?>

</section>