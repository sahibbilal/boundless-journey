<?php
/**
 * Author: Verb Interactive (Mike Annand, Phil Neal)
 * URL: http://verbinteractive.com
 *
 * Boundless Journeys functions and definitions. Some foundation
 * Items are used in this for cleanup and organization
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

// define the IDs to the common content post and the tripcommon post
define('SEGID', 49);
define('TRIPCOMMON' ,5086);
define('SITEURL', site_url());
// OPEN MOBILE VERSION OR NO
if (function_exists('wpmd_is_phone') && wpmd_is_phone()) {
	define('FULLIMG', 'mobile_');
}
else {
	define('FULLIMG', 'desktop_');
}

/** flexible content templates */
require('lib/ACF_Layout.php');

/** Various clean up functions */
require_once( 'lib/cleanup.php' );

/** enqueue required styles and scripts */
require_once( 'lib/enqueue-scripts.php' );

/** register and configure menus used for the theme */
require_once( 'lib/menus.php' );

/** setup theme related post types */
require_once( 'lib/post-types.php' );

/** custom theme functions */
require_once( 'lib/custom.php' );

add_filter('use_block_editor_for_post', '__return_false', 10);

/***************************************************************
* General Settings page
***************************************************************/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'General Settings Page',
		'menu_title' => 'General Settings',
		'menu_slug' => 'general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}

/******************************************************************************************************************************
* Filter is used to disable the inclusion of the Map It link when displaying the Address field value.
******************************************************************************************************************************/
add_filter( 'gform_disable_address_map_link', '__return_true' );