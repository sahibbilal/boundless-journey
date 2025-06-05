<?php
$quotes = get_sub_field("quotes");
$quotetitle = get_sub_field("quote_title");
if($quotetitle) {
	$title = "<h3 class=\"h2\">" . $quotetitle . "</h3>";
}else{
	$pagetitle = get_the_title();

	$title = "<h3 class=\"h2\">Why Our Guests Love ".$pagetitle."</h3>";

	if (strtolower($pagetitle) == "why travel with us") {
		$title = "<h3 class='h2'>Why Our Guests Love to Travel With Us</h3>";
	}

}

if (!empty($quotes)) {
?>
<div class="guide-quote center-align">
	<?php echo $title; ?>
	<div class="quote-slider">
		<div class="wrapper">
			<div class="quotes">
				<?php foreach ($quotes as $quote) : ?>
					<div class="gallery-cell">
					<?php echo wpautop($quote['quote']); ?>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="cites">
				<?php foreach ($quotes as $quote) : ?>
					<div class="gallery-cell">
						<div class="name">
							<div class="tbl">
								<div class="tc">
									<span><?php echo $quote['guide']; ?></span>
									<?php echo $quote['tour_text']; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>
<?php } ?>