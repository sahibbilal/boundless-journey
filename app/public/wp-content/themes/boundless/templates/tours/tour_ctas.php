<?php
/*******************************************************************************
 * Flexible Content sub-template file for Tour Result Callouts
 ******************************************************************************/
$output     = '';
$buttontext = get_sub_field('button_text');
if (empty($buttontext)) {
  $buttontext = 'Search All Tours';
}
$bg_color   = get_sub_field('section_background_color');
$headline   = get_sub_field('headline');
$ctatype    = get_sub_field('cta_type');
$horiz      = ($ctatype == 'Complex') ? TRUE : FALSE;

if (function_exists('verb_tourcube_search_results')) {
  // Default number of results to display
  $count = get_sub_field('display_count');
  if ($count == NULL) {
    $count = 4;
  }
  // Check for destination
  $country  = get_sub_field('country__area');
  $destination_id = isset($country[0]) ? get_field('destination_id', $country[0]) : 0;
  if ($destination_id) {
    // Set _POST value for verb_tourcube_search_results()
    $_GET['destination_id'] = array($destination_id);
  }
  // Check for activity
  $activity = get_sub_field('activities');
  $activity_id    = isset($activity[0]) ? get_field('activity_id', $activity[0]) : 0;
  if ($activity_id) {
    // Set _POST value for verb_tourcube_search_results()
    $_GET['activity_id'] = array($activity_id);
  }
  // Check for type
  $type = get_sub_field('triptype');
  $triptype  = isset($type) ? $type : 0;
  if ($triptype) {
    // Set _POST value for verb_tourcube_search_results()
    $_GET['trip_type'] = array($triptype);
  }
  if ($destination_id || $activity_id) {
    $random = false;
  } else {
    $random = true;
  }


  $output = verb_tourcube_search_results(0, $count, FALSE, $horiz, NULL, $random);
}

// Check for output
if (isset($output['output']) && !empty($output['output'])) {
  if ($ctatype == 'Complex') {
?>
<section class="noprint<?php echo ' ' . esc_attr($bg_color); ?>">
  <div>
    <div class="related-tours">
      <?php if ($headline): ?>
      <div class="title center-align">
        <h2><?php echo $headline; ?></h2>
        <a href="/tours" class="button small" title="<?php echo esc_attr($buttontext); ?>"><?php echo $buttontext; ?></a>
      </div>
      <?php endif; ?>
      <div class="tours clearfix">
        <?php echo $output['output']; ?>
      </div>
    </div>
  </div>
</section>
<?php
  }
  else {
?>
<section class="noprint<?php echo ' ' . esc_attr($bg_color); ?>">
  <div>
    <div class="tours-ctas">
      <?php if ($headline): ?>
      <div class="title center-align">
        <h2><?php echo $headline; ?></h2>
        <a href="/tours" class="button small" title="<?php echo esc_attr($buttontext); ?>"><?php echo $buttontext; ?></a>
      </div>
      <?php endif; ?>
      <div class="wrapper clearfix">
        <?php echo $output['output']; ?>
      </div>
    </div>
  </div>
</section>
<?php
  } // End if
}

// EOF