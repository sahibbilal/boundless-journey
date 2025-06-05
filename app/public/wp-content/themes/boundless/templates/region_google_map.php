<?php

/* Layout for the Regions Google Map */

$map_headline = get_sub_field("map_headline");
$map_content = get_sub_field("map_points");

_printGoogleMap($map_content);