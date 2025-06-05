<?php
$quotes = get_sub_field("quotes");
$quotetitle = get_sub_field("quote_title");
if($quotetitle) {
	$title = "<h3>" . $quotetitle . "</h3>";
}else{
	$pagetitle = get_the_title();
	$title = "<h3>Why Our Guests Love ".$pagetitle."</h3>";
}

if (!empty($quotes)) {
?>
<div class="guide-quotes center-align">
	<div class="quote-slider">
		<?php echo $title; ?>
		<div class="wrapper">
			<div class="quotes">
				<?php foreach ($quotes as $quote) : ?>
					<div class="gallery-cell">
					<?php echo wpautop($quote['quote']); ?>
					<div class="cites">
						<div class="name">
								<div class="tbl">
									<div class="tc">
										<span><?php echo $quote['guide']; ?></span>
										<?php echo $quote['tour_text']; ?>
									</div>
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