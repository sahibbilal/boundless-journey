<?php

/**
 * Flexible Content Template: Guides
 * __      ________  ______ ______
 * \ \    / /  ____||  ___ \ ____ \   Use of this file is governed by a license
 *  \ \  / /| |____ | | __) |____) |  agreement. Please contact Andy MacLellan
 *   \ \/ / |  ____|| ||_  /______ <  at licensing@verbinteractive.com for more
 *    \  /  | |____ | |  \ \ _____) | information.
 *     \/   |______||_|   \_\______/
 *
 *
 *
 * @author Phil Neal <phil.neal@verbinteractive.com>
 * @copyright  Copyright (c) 2004-2016 VERB Interactive Inc. (http://www.verbinteractive.com)
 */


$side = verb_tourcube_builddetails($post->ID);
$type = strtolower(get_field('trip_type'));
$activityhighlight = get_field('activity_highlight');
$variable_pricing  = get_field('variable_pricing');
$sideclass = '';
$extensions = null;
//if (!empty(get_field('pricing_notes'))) {

$tripdates_additional = "";

$additional = get_field('trip_dates_info');
if (!empty($additional)) {
    $tripdates_additional = '<div class="additional">' . $additional . '</div>';
}

//}
// Get side info if it exists.
if (!empty($side['extend'])) {
    $sideclass = 'extend';
    $extensions = verb_tourcube_build_extensions($side['extend']);
}
// Split dates up
if (!empty($side['dates'])) {
    $initialdates   = array_slice($side['dates'], 0 , 10);
    $extradates   = array_slice($side['dates'], 10);
}
$urltitle = urlencode(htmlspecialchars_decode($post->post_title, ENT_QUOTES));
$parent = verb_tourcube_get_trip_destinations($post->ID);
$parentid = verb_tourcube_get_parent_destination_id($post->ID);

$totalcustom = 0;
if (function_exists('verb_tourcube_tourcount')) {
    $totalcustom = verb_tourcube_tourcount($parentid, 'Custom Tour');
}

// Start HTML output
?>
<div class="side">
    <div class="tour-details extend ">
        <div class="days-price">
            <?php if ($type == 'custom tour'): ?>
                <div class="price">
                    <span class="dollar">Price on Request</span>
                </div>
                <div class="days">Suggested: 6-10 Days</div>
                <a class="button" title="Start Planning" href="/custom-tour-reservation/?field468=<?php echo urlencode($post->post_title); ?>">Start Planning</a>
            <?php else: ?>
                <div class="price">
                    <?php echo $variable_pricing ? '<span class="pp">From</span> ' : ''; ?><span class="dollar">$</span><?php echo number_format( $side['price'] ); ?><span class="pp"> / person*</span> <span class="air">*airfare not included</span>
                </div>
                <div class="days"><?php echo $side['days']; ?> Days</div>
                <a class="button" title="Reserve This Tour" href="/request-a-reservation/?tourname=<?php echo $post->post_name; ?>&trip_id=<?php echo $post->ID; ?>">Reserve This Tour</a>
            <?php endif; ?>
            <?php if (!empty($side['dates'])): ?>
                <div class="schedule">
                    <ul>
                        <li><span class="lbl">Departure Dates:</span>
                            <?php
                            foreach ($side['dates'] as $key => $date) {
                                if ($key >= 1) {
                                    echo '<br>';
                                }
                                echo $date;
                            }
                            ?>
                        </li>

                    </ul>
                </div>
            <?php endif; ?>
            <?php echo $tripdates_additional; ?>
        </div>
        <?php if ($sideclass == 'extend'): ?>
            <div class="extend-tour">
                <div class="toggle">
                    <span class="hdr"><span>Extend <span>This</span> Tour</span></span>
                    <span class="sub">Complement this tour with other journeys</span>
                </div>
                <div class="extensions">
                    <div class="wrapper">
                        <?php foreach ($extensions as $value): ?>
                            <div class="extension">
                                <div class="img" style="background-image: url('<?php echo $value['image']; ?>');"></div>
                                <?php if ( ! empty( $value['destination'] ) && ! empty( $value['destination'][0] ) ) : ?>
                                    <span class="country"><?php echo $value['destination'][0]; ?></span>
                                <?php endif; ?>
                                <h4><?php echo $value['title']; ?></h4>
                                <p><?php echo rtrim($value['description'],",!.?"); ?>...</p>
                                <a href="<?php echo esc_url($value['url']); ?>" title="View Extension" class="button">View Extension</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="activity-dates">
            <div class="activity <?php echo esc_attr(strtolower($side['diff'])); ?>">
                <div class="wrapper">
                    <span class="hdr">Activity Level</span>
                    <span class="lvl"><?php echo str_replace('- ', '', $side['diffname']); ?></span>
                </div>
            </div>
            <?php if ($activityhighlight): ?>
                <div class="points"><?php echo $activityhighlight; ?></div>
            <?php else: ?>
                <?php if (!empty($side['activity'])): ?>
                    <ul class="line-bullet points">
                        <?php foreach ($side['activity'] as $item): ?>
                            <li><?php echo strip_tags($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
            <a href="/activity-levels/" class="button">Read about our Activity Levels</a>

            <?php if ($side['group']):  ?>
                <div class="schedule">
                    <ul>
                        <li><span class="lbl">Group Size:</span> <?php echo $side['group']; ?> Guests</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="tour-extras">
        <div class="start-planning">
            <?php if ($type != 'custom tour'): ?>



                <?php if ($totalcustom != 0) : ?>
                    <h4>Make it Your Own!</h4>
                    <p>This trip can be your own adventure by taking over one of our scheduled dates, or we can request a fresh one.</p>
                    <a href="/custom-tours/" title="Start Planning Today" class="button">Prefer a Custom Tour?</a>
                <?php else: ?>
                    <h4>Make it Your Own!</h4>
                    <p>This trip can be your own adventure by taking over one of our scheduled dates, or we can request a fresh one.</p>
                    <a href="/custom-tours/" title="Start Planning Today" class="button">Prefer a Custom Tour?</a>
                <?php endif; ?>



            <?php else: ?>
                <h4>Try a Scheduled Departure</h4>
                <p>Boundless Journeys has created dozens of pre-planned trips that make trip planning simple.</p>
                <a href="/tours/?offset=0&trip_type%5B%5D=Scheduled+Group+Tour&destination_id%5B%5D=<?php echo esc_url($parentid); ?>&sortby=alpha" title="Start Planning Today" class="button">Search Scheduled Departures</a>
            <?php endif; ?>
        </div>
        <div class="next-step center-align">
            <h3 class="line">Take The Next Step</h3>
            <a class="number colorfade" title="" href="tel:18009418010">Speak With A Tour Expert <span>1.800.941.8010</span></a>
            <ul>
                <?php if ($type != 'custom tour'): ?>
                    <li><a href="/request-a-reservation/?field1=<?php echo esc_url($urltitle); ?>" title="Reserve This Tour" class="bgfade">Reserve This Tour</a></li>
                <?php else: ?>
                    <li><a href="/custom-tour-reservation/?trip_id=<?php echo $post->ID; ?>" title="Reserve This Tour" class="bgfade">Start Planning</a></li>
                <?php endif; ?>
                <li><a href="/request-a-call" title="Request A Call" class=" bgfade">Request A Call</a></li>
                <li><a href="/email-an-expert" title="Email An Expert" class=" bgfade">Email An Expert</a></li>
            </ul>
        </div>
        <div class="share">

            <?php
            $pdf = get_field('trip_pdf');
            ?>
            <h5>Share This Trip:</h5>
            <ul class="soc">
                <li><a class="soc-twitter-x bgfade" href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()) ?>&amp;url=<?php echo get_permalink($post->ID)?>" target="_blank"></a></li>
                <li><a class="soc-facebook bgfade" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo get_permalink($post->ID)?>'), 'facebook-share-dialog', 'width=626,height=436'); return false;"></a></li>
                <li><a class="soc-pinterest" href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;https://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());"></a></li>
                <li><a class="soc-mail bgfade" href="mailto:?Subject=Check Out This Amazing Trip From Boundless Journeys - <?php echo str_replace("&amp;", "and", get_the_title()); ?>&amp;Body=I thought you’d be interested in this amazing adventure from Boundless Journeys! <?php echo get_permalink($post->ID); ?>"></a></li>
            </ul>
        </div>
    </div>
</div>