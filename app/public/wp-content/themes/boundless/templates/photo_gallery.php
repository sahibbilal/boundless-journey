<?php
$title 		= get_sub_field("gallery_title");
$gallery 	= get_sub_field("gallery");
?>

<section>
	<div>
		<div class="gallery-main clearfix">
			<?php if (isset($title)) echo "<h2>" . $title . "</h2>" . PHP_EOL; ?>
			<div class="zoom-gallery">
				<div class="sizer"></div>
				<?php
				foreach ($gallery as $item) {
					$customurl_link = "";
					$customurl = get_post_meta( $item['id'], '_gallery_link_url', true );
					if ($customurl) {
						$customurl_link = " data-link='".$customurl."' ";
					}

					echo "<a class='gallery-item' " . $customurl_link . " title='".$item['alt']."' href='".$item['sizes'][FULLIMG . 'full']."'>".PHP_EOL;
					echo "<img src='".$item['sizes']['mobile_cta']."'>" . PHP_EOL;
					echo "</a>" . PHP_EOL;
				}
				?>
			</div>
		</div>
	</div>
</section>