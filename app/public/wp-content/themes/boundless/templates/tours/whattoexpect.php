<div class="heading" id="heading-4">
	<div class="wrap">
		<div>What To <br /> Expect</div>
	</div>
</div>
<div class="content itinerary-expect" id="content-4">
	<div class="wrap">
		<h2 class="h1">What To Expect</h2>
		<?php
		$expect = verb_tourcube_get_what($post->ID);
		if($expect) {
			foreach($expect as $item){
				echo "<h4>" . $item['category_header'] . "</h4>\n";
				//echo wpautop($item['category_body']);
				echo $item['category_body'];
				if (strtolower($item['category_header']) == "weather" ) {
					echo verb_tourcube_get_weather($post->ID);
				}
			}
		}
		?>
	</div>
</div>
