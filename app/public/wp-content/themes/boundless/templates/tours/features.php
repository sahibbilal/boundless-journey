<?php
/**
 * Flexible Content Template: Trip Features & Highlights
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Your Name <mike.annand@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2015 VERB Interactive Inc. (http://www.verbinteractive.com)
 */
// Get trip highlights data
$highlights = get_field('trip_highlights');

// Start HMTL output
if (!empty($highlights)) {
?>
<div class="featured-highlights">
  <h3><?php echo str_replace("Custom Tours","", $post->post_title); ?> Highlights</h3>
  <div class="slider flexslider">
    <ul class="slides">
<?php
    foreach ($highlights as $item) {
     // print_r($item['image']);
      $image = isset($item['image']['sizes'][FULLIMG . 'feature']) ? $item['image']['sizes'][FULLIMG . 'feature'] : '';
      // Make sure we have an image
      if ($image) {
        $desc  = isset($item['description']) ? $item['description'] : '';
        $text  = isset($item['highlight_text']) ? strip_tags($item['highlight_text'], '<a><em><strong><i>') : '';
        // If no highlight text and we have a description, use description.
        if (!$text && $desc) {
          $text = $desc;
        }
        // Start HTML output
?>
      <li>
        <div class="img" style="background-image:url('<?php echo esc_url($image); ?>');">
          <a href="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($desc); ?>" class="enlarge">Expand</a>
        </div>
      <?php if (!empty($text)): ?>
        <div class="caption"><?php echo $text; ?></div>
      <?php endif; ?>
      </li>
<?php
      } // End if
    } // End foreach
?>

<?php
    foreach ($highlights as $item) {
     // print_r($item['image']);
      $image = isset($item['image']['sizes'][FULLIMG . 'feature']) ? $item['image']['sizes'][FULLIMG . 'feature'] : '';
      // Make sure we have an image
      if ($image) {
        $desc  = isset($item['description']) ? $item['description'] : '';
        $text  = isset($item['highlight_text']) ? strip_tags($item['highlight_text'], '<a><em><strong><i>') : '';
        // If no highlight text and we have a description, use description.
        if (!$text && $desc) {
          $text = $desc;
        }
        // Start HTML output
?>
      <li>
        <div class="img" style="background-image:url('<?php echo esc_url($image); ?>');">
          <a href="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($desc); ?>" class="enlarge">Expand</a>
        </div>
      <?php if (!empty($text)): ?>
        <div class="caption"><?php echo $text; ?></div>
      <?php endif; ?>
      </li>
<?php
      } // End if
    } // End foreach
?>




    </ul>
  </div>
</div>
<?php
} // End if


// EOF