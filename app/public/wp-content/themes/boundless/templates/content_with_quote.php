<?php

$content = get_sub_field('content');
$quote = get_sub_field('quote');
$author = get_sub_field('author');
$author_loc = get_sub_field('author_location');
$hdr_location = get_sub_field('location_for_headline');
$image 	= get_sub_field('image');
$is_a_guide = get_sub_field('is_a_guide');
if (isset($image['sizes']['thumbnail'])) {
	$thumb	= $image['sizes']['thumbnail'];
}
if (isset($image['name'])) {
	$name = $image['name'];
}
$quotetitle = get_sub_field('quote_title');

$extraquotes = get_sub_field('extra_quotes');

// determine title.
$title = '';
// quote title takes precedence over all. All hail quotetitle.
if ($quotetitle) {
  $title = $quotetitle;
}
elseif ($is_a_guide == 'yes') {
  $title = 'Why Our Guides Love ' . $hdr_location;
}
else {
  $suffix = (!empty($hdr_location)) ? $hdr_location : 'Us';
  $title = 'What Our Guests Say About ' . $suffix;
}

if (!empty($content)) {
?>

<section>
	<div>
		<div class="content-quote clearfix">
			<div class="col col-1">
			  <?php echo wpautop($content); ?>
			</div>
	  <?php if (!empty($quote)): ?>
			<div class="col col-2">
        <div class="guide-quote center-align guide-quote-non-slide">

          <?php if ($title): ?>
            <h3><?php echo esc_html($title); ?></h3>
          <?php endif; ?>



          <div class="quote-slider sidebar">
            <div class="wrapper">

              <div class="quotes">
                <div class="gallery-cell">
                  <?php echo wpautop($quote); ?>
                  <?php if (!empty($author) || !empty($author_loc)): ?>
                    <span><?php echo esc_html($author); ?>, <?php echo esc_html($author_loc); ?></span>
                </div>
              <?php endif; ?>
              <?php
              if (!empty($extraquotes)) {
                foreach($extraquotes as $value) {
                ?>
                <div class="gallery-cell">
                  <?php echo wpautop($value['quote']); ?>
                  <?php if (!empty($value->author) || !empty($value['location'])): ?>
                    <span><?php echo esc_html($value['author']); ?>, <?php echo esc_html($value['location']); ?></span>

                  <?php endif;?>
                </div>
                <?php
                  }
                }
                ?>
                </div>
              </div>
            </div>


          </div>
			 </div>
		<?php endif; ?>
		</div>
	</div>
</section>

<?php
} // End if

// EOF