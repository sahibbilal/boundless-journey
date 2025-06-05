<?php

$tripitinerary = get_field('trip_itinerary');
$imagesize = FULLIMG . "cta";
$count = 0;
if($tripitinerary){ ?>
	<?php foreach ($tripitinerary as $trip) {

		$h1 = ($count === 0) ? "h1" : "";
	?>
	<div class="itinerary">
		<div class="tbl clearfix">
			<div class="tc">
				<h1 class="<?php echo $h1; ?>"><?php echo $trip['headline']; ?></h1>

                <?php // start destinations
                if ($trip['destinations']) {
                    $destinationIDs = array();
                    // build an array of Destination post IDs
                    foreach ($trip['destinations'] as $k => $destinationID) {
                        $destinationIDs[] = $destinationID['destination'];

                    }

                    // use the array to query for the posts
                    $args = array(
                        'post_type'     => 'vtc_destination',
                        'post__in'      => $destinationIDs,
                        'post_per_page' => -1
                    );
                    $destinations = new WP_Query($args);?>
                    <div id="destination-tabs-<?php echo $trip['day']?>">
                        <h3>Regions Visited:</h3>
                        <ul>
                            <?php
                            // write out the tabs
                            foreach($destinations->posts as $destination) {
                                $destination_name = $destination->post_title;
                                $destination_id = get_field('destination_id', $destination->ID);
                                ?>
                                <li><a href="#destination-<?php echo $trip['day'] ?>-<?php echo $destination_id ?>"><?php echo $destination_name ?></a> <span class="border-spacer">&#160;</span></li>
                            <?php } ?>
                        </ul>


                        <?php
                        // write out the tab contents
                        foreach($destinations->posts as $destination) {
                            $destination_name = $destination->post_title;
                            $destination_description = get_field('destination_description', $destination->ID);
                            $destination_id = get_field('destination_id', $destination->ID);
                            $destination_image = '';
                            if (get_field('destination_image', $destination->ID)) {
                                $destination_image = get_field('destination_image', $destination->ID);
                            }

                            if ($destination_image!=='') {
                                $destination_image = $destination_image['sizes']['itinerary_destination'];
                            }
                            $testimage = "/wp-content/uploads/tourcube/vtc_trip/7966/trip_highlights/nbepal-highlight-3-390x309.jpg";
                            if ($destination_id == '155') {
                                $testimage = "/wp-content/uploads/tourcube/vtc_trip/7907/trip_highlights/namibia-high-555-390x309.jpg";
                            }
                            //print_r($destination_image);
                            ?>
                            <div id="destination-<?php echo $trip['day'] ?>-<?php echo $destination_id ?>">
                                <?php if ($destination_image!=='') {?>
                                <div class="itinerary-image-frame">
                                    <img class="itinerary-image" src="<?php echo $destination_image ?>">
                                    <img class="itinerary-mask" src="/wp-content/themes/boundless/images/itinerary.mask.png">
                                </div>
                                <?php } ?>
                                <h3><?php echo $destination_name ?></h3>
                                <?php echo $destination_description ?>
                            </div>

                        <?php }?>
                    </div>
                <?php } // end destinations ?>

				<?php if (isset($trip['itinerary_block'])) : ?>
				<p class='large'><?php echo wpautop($trip['itinerary_block']); ?></p>
				<?php endif ?>
				<p class="sub"><?php echo wpautop($trip['web_callout']); ?></p>
			</div>
			<!--
			<div class="tc tc-img">
			</div>
			-->


		</div>
	</div>



	<?php $count++;
	} ?>
    <script>

        jQuery(document).ready( function() {
            <?php

            foreach ($tripitinerary as $trip) {?>
            var destinationtabs<?php echo $trip['day']?> = jQuery('#destination-tabs-<?php echo $trip['day']?>');


            // the itinerary tabs section occurs (in the design) right in the middle of a data field that includes the intro paragraph and the itinerary by day. There is a placeholder pipe-separated list of destinations where the tabs should go; here we replace the placeholder list DOM node with the tab section.
            var destinationlist<?php echo $trip['day']?> = destinationtabs<?php echo $trip['day']?>.parent().find("p:contains('|')");
            destinationlist<?php echo $trip['day']?>.replaceWith(destinationtabs<?php echo $trip['day']?>);
            // initialize the tabs
            destinationtabs<?php echo $trip['day']?>.tabs();

        // the paragraph following the itinerary tab section is the itinerary by day; us eht existing JS to make this section collapsible.
            var itinerarybyday<?php echo $trip['day']?> = destinationtabs<?php echo $trip['day']?>.next("p");
            itinerarybyday<?php echo $trip['day']?>.wrap('<div class="wrap"></div>');
            itinerarybyday<?php echo $trip['day']?>.wrap('<div class="details""></div>');
            itinerarybyday<?php echo $trip['day']?>.parent().parent('div.wrap').prepend('<h4>Itinerary By Day</h4>');
            itinerarybyday<?php echo $trip['day']?>.find('div.details').hide();



            <?php } ?>

        })
    </script>
<?php } ?>




