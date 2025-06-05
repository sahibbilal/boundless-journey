<?php

$split_content_image = get_sub_field("split_content_image");
$split_content_image = $split_content_image['sizes'][FULLIMG . "cta"];
$split_content_copy_background = get_sub_field("split_content_copy_background");
$content = get_sub_field("split_content_copy");

?>

<section class="split-content <?php echo esc_attr($split_content_copy_background); ?>">
  <div class="split-content-img img" data-src="<?php echo $split_content_image; ?>"></div>
	<div class="split-content-copy">
    <?php
      echo $content;
    ?>
  </div>
</section>
