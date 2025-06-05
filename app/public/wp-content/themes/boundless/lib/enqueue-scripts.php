<?php
/**
 * Enqueue all styles and scripts. Using the foundation enque setup.
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package WordPress
 * @subpackage Boundless Journeys
 * @since Boundless Journeys 1.0
 */

if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function foundationpress_scripts() {

	// Enqueue the main Stylesheet.
	wp_enqueue_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/css/foundation.css' );
	wp_enqueue_style( 'eight29-stylesheet', get_stylesheet_directory_uri() . '/css/eight29-styles.css' );
    wp_enqueue_style( 'jquery-ui-css', get_stylesheet_directory_uri() . '/css/jquery-ui.min.css' );

	// Deregister the jquery version bundled with WordPress.
	wp_deregister_script( 'jquery' );

	// Modernizr is used for polyfills and feature detection. Must be placed in header. (Not required).
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.8.3', false );

	// Fastclick removes the 300ms delay on click events in mobile environments. Must be placed in header. (Not required).
	//wp_register_script( 'fastclick', get_template_directory_uri() . '/js/fastclick.js', array(), '1.0.0', false );

	// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '2.1.0', false );

	// If you'd like to cherry-pick the foundation components you need in your project, head over to Gruntfile.js and see lines 67-88.
	// It's a good idea to do this, performance-wise. No need to load everything if you're just going to use the grid anyway, you know :)
	wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.js', array('jquery'), '5.5.3', true );
	wp_register_script( 'eight29-scripts', get_template_directory_uri() . '/js/custom/eight29-scripts.js', array('jquery', 'foundation'), '', true );

  //wp_register_script( 'jq-validation', get_template_directory_uri() . '/js/vendor/jquery.validate.min.js', array('jquery'), '1.14.0', true );

	// Enqueue all registered scripts.
	wp_enqueue_script( 'modernizr' );
//	wp_enqueue_script( 'fastclick' );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'foundation' );
    wp_enqueue_script( 'eight29-scripts' );
//	wp_enqueue_script( 'jq-validation' );

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );
endif;

?>
