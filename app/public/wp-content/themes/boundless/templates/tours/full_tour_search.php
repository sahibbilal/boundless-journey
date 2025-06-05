<?php
/**
 * Flexible Content Template: Trip Search
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
$output = ''; 

if (function_exists('verb_tourcube_search_results')) {
  $output = verb_tourcube_search_results();
}

$pagination = isset($output['pagination']) ? $output['pagination'] : '';
$results    = isset($output['output']) ? $output['output'] : '';

// HTML output
?>
<section class="tour-listing light-gray">
  <div class="clearfix">
    <form id="vtc-trip-sort">
      <div class="side">
      <?php if (function_exists('verb_tourcube_search_filter')): ?>
        <div class="tour-filters">
          <?php verb_tourcube_search_filter(); ?>
        </div>
      <?php endif; ?>
      </div>
      <div class="tours">
      <?php if (function_exists('verb_tourcube_search_sort_form')): ?>
        <div class="tour-sorting">
          <?php verb_tourcube_search_sort_form(); ?>
        <?php if (!empty($pagination)): ?>
          <div class="pagination">
            <?php echo $pagination; ?>
          </div>
        <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($results)): ?>
        <div class="tour-holder hidden clearfix">
          <?php echo $results; ?>
        </div>
      <?php endif; ?>
        <div class="tour-sorting bottom-sorting">
        <?php if (!empty($pagination)): ?>
          <div class="pagination">
            <?php echo $pagination; ?>
          </div>
        <?php endif; ?>
        </div>
      </div>
    </form>
  </div>
</section>
<?php

// EOF