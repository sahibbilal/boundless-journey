<?php
  global $post;
  $content  = get_sub_field('content');
  $sidedesc = get_sub_field('featured_area_title');
  $items    = get_sub_field('featured_items');
  if (empty($content)) {
    $content = get_post_meta($post->ID, 'destination_description');
  }


if (!$content && !$items) {
?>
<section>
  <div>
    <div class="region-landing clearfix">
      <?php echo get_template_part('templates/guestquotes'); ?>
    </div>
  </div>
</section>

<?php
  } else {
?>

<section>
  <div>
    <div class="region-landing clearfix">
    <?php if ($content): ?>
      <div class="content"><?php echo wpautop($content); ?>
      <?php echo get_template_part('templates/guidequotes'); ?>
      </div>
    <?php endif; ?>
      <div class="side">
        <div class="featured-destinations">
        <?php if ($sidedesc): ?>
          <h3 class="h2"><?php echo $sidedesc; ?></h3>
        <?php endif; ?>
          <div>
<?php
  // Loop through items
  foreach ($items as $item):
    if($item['item']) {
      $url = get_permalink($item['item']->ID);
    }
    $image = isset($item['image']['sizes'][FULLIMG . 'feature']) ? $item['image']['sizes'][FULLIMG . 'feature'] : '';
    $description = isset($item['description']) ? $item['description'] : '';
    $featured_img_height = $item['image_height_override'];
    $btn_text = $item['button_text'];
    $form = isset($item['form_shortcode']) ? $item['form_shortcode'] : '';
?>
            <div class="feature">
              <?php if ($image): ?>
                <div class="img" <?= !empty($featured_img_height) ? 'style="height:' .$featured_img_height .'px;"' : '' ?> data-src="<?php echo esc_url($image); ?>" ></div>
              <?php endif; ?>
              <?php if ($description): ?>
                <p class="large"><?php echo $description; ?></p>
              <?php endif; ?>
              <?php if (isset($url) && $btn_text): ?>
                <a class="button small white" title="<?php echo esc_html($btn_text) ?>" href="<?php echo esc_url($url); ?>"><?php echo esc_html($btn_text) ?></a>
              <?php endif; ?>
              <?php if (!empty($form)): ?>
                <div class="form"><?= do_shortcode($form); ?></div>
              <?php endif; ?>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
