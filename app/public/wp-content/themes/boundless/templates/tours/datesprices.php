<?php
/**
 * Flexible Content Template: Trip Dates & Prices
 *
 * @author Mike Annand <mike.annand@verbinteractive.com>
 * @copyright Copyright (c) 2004-2016 VERB Interactive Inc. (http://www.verbinteractive.com)
 * @license http://www.verbinteractive.com/development/license License
 * @version $Id$
 */

$supplement1     = '';
$supplement1next = '';

$includes        = verb_tourcube_get_trip_inclusions( $post->ID, 'i' );
$dates           = verb_tourcube_get_trip_departure_dates( $post->ID, true );
$supplement1     = get_field( 'single_supplement_price_1_caption' );
$supplement2     = get_field( 'single_supplement_price_2_caption' );
$supplement1next = get_field( 'single_supplement_price_1_caption_next_year' );
$supplement2next = get_field( 'single_supplement_price_2_caption_next_year' );

(int)$supplement1price     = verb_tourcube_format_money( get_field( 'single_supplement_price_1' ) );
(int)$supplement2price     = verb_tourcube_format_money( get_field( 'single_supplement_price_2' ) );
(int)$supplement1pricenext = verb_tourcube_format_money( get_field( 'single_supplement_price_1_next_year' ) );
(int)$supplement2pricenext = verb_tourcube_format_money( get_field( 'single_supplement_price_2_next_year' ) );

$price                  = verb_tourcube_format_money( get_field('price') );
$price_next_year        = verb_tourcube_format_money( get_field('price_next_year') );
$pricing_notes          = get_field( 'pricing_notes' );
$nxpricing_notes        = get_field( 'next_year_price_comment' );
$airprice               = verb_tourcube_format_money( get_field( 'air_price' ) );
$nxairprice             = verb_tourcube_format_money( get_field( 'air_price_next_year' ) );
$air_price_caption      = get_field( 'air_price_caption' );
$nxair_price_caption    = get_field( 'next_year_price_comment' );
$show_next_years_price  = get_field( 'show_next_years_price' );
$variable_pricing       = get_field( 'variable_pricing' );
$variable_pricing_note  = get_field( 'pricing_notes' );
$variable_pricing_title = get_field( 'variable_pricing_note' );

$nextyear    = date('Y', strtotime('+1 year'));
$newyear     = date('Y', strtotime('+1 year'));
$currentyear = (string)date('Y');
$oneyear     = (string)date('Y', strtotime('+1 year'));
$twoyear     = (string)date('Y', strtotime('+2 year'));
$datearray   = array();
$datetotal   = array();

$tripdates_additional = get_field( 'trip_dates_info' );

$yeardisplay = array();

// fees.
$fee1name    = get_field( 'fee_name_1' );
$fee1price   = get_field( 'fee_price_1' );
$fee2name    = get_field( 'fee_name_2' );
$fee2price   = get_field( 'fee_price_2' );
$fee3name    = get_field( 'fee_name_3' );
$fee3price   = get_field( 'fee_price_3' );

$nxfee1name  = get_field( 'next_year_fee_name_1' );
$nxfee1price = get_field( 'next_year_fee_price_1' );
$nxfee2name  = get_field( 'next_year_fee_name_2' );
$nxfee2price = get_field( 'next_year_fee_price_2' );
$nxfee3name  = get_field( 'next_year_fee_name_3' );
$nxfee3price = get_field( 'next_year_fee_price_3' );

if ( $fee1price ) {
	$fee1price = "$" . verb_tourcube_format_money( $fee1price );
}
if ( $fee2price ) {
	$fee2price = "$" . verb_tourcube_format_money( $fee2price );
}
if ( $fee3price ) {
	$fee3price = "$" . verb_tourcube_format_money( $fee3price );
}
if ( $nxfee1price ) {
	$nxfee1price = verb_tourcube_format_money( $nxfee1price );
}
if ( $nxfee2price ) {
	$nxfee2price = verb_tourcube_format_money( $nxfee2price );
}
if ( $nxfee3price ) {
	$nxfee3price = verb_tourcube_format_money( $nxfee3price );
}


// make $datetotal is a multidimensional array. Loop through each key for each year.
// there has to be a better way to do this.
foreach ( $dates as $key => $value ) {
	if ( preg_match("/\b$currentyear\b/i", $value) ) {
		$datearray[]   = $value;
		$yeardisplay[] = $currentyear;
	}
}
if ( ! empty( $datearray ) ) {
	$datetotal[] = $datearray;
	unset($datearray);
	$datearray = array();
}

foreach ( $dates as $key => $value ) {
	if ( (preg_match("/\b$oneyear\b/i", $value)) && (!preg_match("/\b$currentyear\b/i", $value)) ) {
		$datearray[]   = $value;
		$yeardisplay[] = $oneyear;
	}
}
if ( ! empty( $datearray ) ) {
	$datetotal[] = $datearray;
	unset($datearray);
	$datearray = array();
}


foreach ($dates as $key => $value) {
	if(preg_match("/\b$twoyear\b/i", $value) && (!preg_match("/\b$oneyear\b/i", $value)) ) {
		$datearray[] = $value;
		$yeardisplay[] = $twoyear;
	}
}
if ( ! empty( $datearray ) ) {
	$datetotal[] = $datearray;
	unset($datearray);
	$datearray = array();
}

$yeardisplay = array_values(array_unique($yeardisplay,SORT_REGULAR));
$firstyear   = $yeardisplay[0] ?? '';
$secondyear  = $yeardisplay[1] ?? '';
$thirdyear   = $yeardisplay[2] ?? '';

// remove next year if Show Next years Price is checked off.
if ( $secondyear && $show_next_years_price == 0 ) {
	$secondyear = false;
}

// Start HTML output.
?>
<div class="heading itinerary-dates-prices-heading" id="heading-3">
	<div class="wrap">
		<div>Dates &amp;<br /> Prices</div>
	</div>
</div>
<div class="content itinerary-dates-prices" id="content-3">
	<div class="wrap">
		<h2 class="h1">Dates And Prices</h2>
		<div class="content-tabs">
			<div class="content-tab-heading">
				<div><?php echo $firstyear; ?></div>
			</div>
			<div class="content-tab-content price-details">
				<div class="tbl clearfix">
					<div class="tr">
						<div class="tc trip-length">
							<h5>Trip Length</h5>
							<p><span><?php echo get_field('days'); ?></span> Days</p>
						</div>
						<div class="tc trip-dates">
							<h5>Trip Dates</h5>
							<?php
							if ( ! empty( $datetotal[0] ) ) {
								foreach ($datetotal[0] as $date) {
									?>
									<p class="large"><?php echo $date; ?></p>
									<?php
								}
							}
							?>
							<?php
							if ( $tripdates_additional ) {
								echo '<p class="adddates">' . $tripdates_additional . '</p>';
							}
							?>
						</div>
					</div>
					<div class="tr">
						<div class="tc land-cost">
							<?php if ( $price ): ?>
								<h5><?php echo $firstyear ?> Land Cost</h5>
								<p><?php echo $variable_pricing ? 'From ' : ''; ?><span><span>$</span><?php echo number_format( $price ); ?></span> Per Person</p>
								<?php if ($pricing_notes): ?>
									<p class="policy"><?php // echo $pricing_notes; ?></p>
								<?php endif; ?>
								<br>
							<?php endif; ?>
							<?php if ($airprice): ?>
								<h5>Internal Airfare</h5>
								<p><span><span>$</span><?php echo number_format( $airprice ); ?></span> Per Person</p>
								<?php if ($air_price_caption): ?>
									<p class="policy"><?php echo $air_price_caption; ?></p>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="tc single-supplement">
							<h5>Single Supplement</h5>
							<p><?php echo $supplement1; ?><span><span>$</span><?php echo number_format( $supplement1price ); ?></span></p>

							<?php if (!empty($supplement2)): ?>
								<p><?php echo $supplement2; ?><span><span>$</span><?php echo number_format( $supplement2price ); ?></span></p>
							<?php endif; ?>
							<p class="policy"><a href="#supplementpolicy">See single supplement policy below</a>.</p>

							<?php if ( $fee1name && $fee1price ) : ?>
								<h5>Additional Fees</h5>
								<p><?php echo $fee1name; ?> <span><?php echo $fee1price; ?></span></p>
							<?php endif; ?>
							<?php if ($fee2name && $fee2price) : ?>
								<p><?php echo $fee2name; ?> <span><?php echo $fee2price; ?></span></p>
							<?php endif; ?>
							<?php if ($fee3name && $fee3price) : ?>
								<p><?php echo $fee3name; ?> <span><?php echo $fee3price; ?></span></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if ( isset($datetotal[1]) && $show_next_years_price ): ?>
				<div class="content-tab-heading">
					<div><?php echo $secondyear; ?></div>
				</div>
				<div class="content-tab-content price-details">
					<div class="tbl clearfix">
						<div class="tr">
							<div class="tc trip-length">
								<h5>Trip Length</h5>
								<p><span><?php echo get_field('days'); ?></span> Days</p>
							</div>
							<div class="tc trip-dates">
								<h5>Trip Dates</h5>
								<?php foreach ($datetotal[1] as $date): ?>
									<p class="large"><?php echo $date; ?></p>
								<?php endforeach; ?>
								<?php
								if ( $tripdates_additional ) {
									echo '<p class="adddates">' . $tripdates_additional . '</p>';
								}
								?>
							</div>
						</div>
						<div class="tr">
							<div class="tc land-cost">
								<?php if ( $price_next_year ): ?>
									<h5><?php echo $secondyear; ?> Land Cost</h5>
									<p><span><span>$</span><?php echo number_format( $price_next_year ); ?></span> Per Person</p>
									<br>
								<?php endif; ?>
								<?php if ( $nxairprice ): ?>
									<h5>Internal Airfare</h5>
									<p><span><span>$</span><?php echo number_format( $nxairprice ); ?></span> Per Person</p>
								<?php endif; ?>
								<?php if ( $nxair_price_caption && $nxairprice ): ?>
									<p class="policy"><?php echo $nxair_price_caption; ?></p>
								<?php endif; ?>
							</div>
							<div class="tc single-supplement">
								<h5>Single Supplement</h5>
								<p><?php echo $supplement1next; ?><span><span>$</span><?php echo number_format( $supplement1pricenext ); ?></span></p>
								<?php if (!empty($supplement2next)) : ?>
									<p><?php echo $supplement2next; ?><span><span>$</span><?php echo number_format( $supplement2pricenext ); ?></span></p>
								<?php endif; ?>
								<?php if ( $supplement1 || ( $supplement1pricenext >= 0 ) ) : ?>
									<p class="policy"><a href="#supplementpolicy">See single supplement policy below</a>.</p>
								<?php endif; ?>
								<?php if ( $nxfee1name && $nxfee1price ) : ?>
									<h5>Additional Fees</h5>
									<p><?php echo $nxfee1name; ?> <span><span>$</span><?php echo number_format( $nxfee1price ); ?></span></p>
								<?php endif; ?>
								<?php if ( $nxfee2name && $nxfee2price ) : ?>
									<p><?php echo $nxfee2name; ?> <span><span>$</span><?php echo number_format( $nxfee2price ); ?></span></p>
								<?php endif; ?>
								<?php if ( $nxfee3name && $nxfee3price ) : ?>
									<p><?php echo $nxfee3name; ?> <span><span>$</span><?php echo number_format( $nxfee3price ); ?></span></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $variable_pricing && $variable_pricing_note ): ?>
			<div class="pricing-notes">
				<?php if ($variable_pricing_title): ?>
					<h3><?php echo strip_tags($variable_pricing_title); ?></h3>
				<?php else: ?>
					<h3>Pricing Notes</h3>
				<?php endif; ?>
				<?php echo strip_tags($variable_pricing_note, '<p><strong><em>'); ?>
			</div>
		<?php endif; ?>
		<div class="included">
			<h3>What's Included</h3>
				<ul class="arrow">
					<?php foreach( $includes as $include ): ?>
						<li><?php echo $include; ?></li>
					<?php endforeach; ?>
				</ul>
		</div>
		<div class="single-supplement" id="supplementpolicy">
			<?php echo wpautop( get_post_meta( SEGID, 'single_supplement_policy', true ) ); ?>
		</div>
	</div>
</div>
