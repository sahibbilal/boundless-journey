<?php
/**
 * Flexible Content Template: Itineraries and Accommodations
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 * $Id$
 *
 * @author Phil Neal <phil.neal@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2016 VERB Interactive Inc. (http://www.verbinteractive.com)
 */

// Get ACF data for PDF
$pdf = get_field('trip_pdf');
// Get URL to PDF
$pdf_link = (isset($pdf['url']) && !empty($pdf['url'])) ? $pdf['url'] : '';

?>
<div class="heading" id="heading-2">
    <div class="wrap">
        <div>Itinerary &amp;<br /> Accommodations</div>
    </div>
</div>
<div class="content itinerary-itinerary" id="content-2">
    <div class="wrap">
        <div class="title-buttons">
            <h2 class='h1'>Itinerary &amp; Accommodations</h2>
            <div class="buttons">
                <a href="#" class="button small print" title="Print">Print</a>
                <?php if ($pdf_link): ?>
                    <a href="<?php echo esc_url($pdf_link); ?>" class="button small save" title="Save As PDF" target="_blank">Save As PDF</a>
                <?php endif; ?>
                <a href="#" class="button small expand" title="Expand All">Hide All</a>
            </div>
        </div>
        <?php get_template_part('templates/tours/days'); ?>
        <?php echo wpautop(get_post_meta(SEGID, 'scheduled_itinerary_footnote', true)); ?>
        <a class="button small back-to-top" title="Back To Top" href="#tour-tabs">Back To Top</a>
    </div>
</div>