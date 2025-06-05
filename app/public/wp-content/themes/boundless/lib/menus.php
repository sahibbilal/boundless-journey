<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package WordPress
 * @subpackage Boundless Journeys
 * @since Boundless Journeys 1.0
 */

register_nav_menus(array(
	'discover' 	=> 'Discover Menu', // Registers the menu in the WordPress admin menu editor.
	'planning' 	=> 'Planning Menu',
	'booked' 	=> 'Already Booked Menu',
	'support' 	=> 'Primary Support',
	'primary' 	=> 'Primary Menu',
	'base'		=> 'Base Content',
	'mobile' 	=> 'Mobile',
	'megaact'   => 'Mega Activities'
));

/* discover menu setup */
if ( ! function_exists( 'initmenu_discover' ) ) {
	function initmenu_discover() {
		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'discover',					// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 1,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
	));
	}
}

/* discover menu setup */
if ( ! function_exists( 'initmenu_megaact' ) ) {
	function initmenu_megaact() {
		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'megaact',					// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 3,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
			'walker'	=> new MegaSpans
	));
	}
}


/* discover menu setup */
if ( ! function_exists( 'initmenu_mobile' ) ) {
	function initmenu_mobile() {
		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'mobile',					// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 3,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
	));
	}
}


/* planning menu setup */
if ( ! function_exists( 'initmenu_base' ) ) {

	function initmenu_base() {

		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'base',						// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 1,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
		));

	}

}


/* planning menu setup */
if ( ! function_exists( 'initmenu_planning' ) ) {

	function initmenu_planning() {

		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'planning',					// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 1,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
		));

	}

}

/* planning menu setup */
if ( ! function_exists( 'initmenu_booked' ) ) {
	function initmenu_booked() {
		wp_nav_menu(array(
			'container' => false,							// Remove nav container
			'container_class' => '',						// Class of container
			'menu' => '',									// Menu name
			'theme_location' => 'booked',					// Where it's located in the theme
			'before' => '',									// Before each link <a>
			'after' => '',									// After each link </a>
			'link_before' => '',							// Before each link text
			'link_after' => '',								// After each link text
			'depth' => 1,									// Limit the depth of the nav
			'fallback_cb' => false,							// Fallback function (see below)
	));
	}
}

/* planning menu setup */
if ( ! function_exists( 'initmenu_primary' ) ) {
	function initmenu_primary() {
		wp_nav_menu(array(
			'container' => false,
			'menu_class' => 'primary_nav',                      // Remove nav container
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', // Class of container
			'theme_location' => 'primary',                   // Where it's located in the theme
			'depth' => 2,                                   // Limit the depth of the nav
			'fallback_cb' => false,                         // Fallback function (see below)
			'walker'	=> new AddSpans
	));
	}
}


/* planning menu setup */
if ( ! function_exists( 'initmenu_support' ) ) {
	function initmenu_support() {
		wp_nav_menu(array(
			'container' => '',
			'items_wrap' => '%3$s',                           // Remove nav container
			//'items_warp' => '<ul id="%1$s" class="%2$s"><li>%3$s</ul>', // Class of container
			'theme_location' => 'support',                   // Where it's located in the theme
			'depth' => 1,                                   // Limit the depth of the nav
			'fallback_cb' => false,                         // Fallback function (see below)
	));
	}
}



class MegaSpans extends Walker_Nav_Menu {

	private $itemcount;

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item));
		! empty ( $class_names ) and $class_names = ' '. esc_attr( $class_names ) . '';

		$attributes  = '';
		! empty( $item->attr_title )
		    and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
		! empty( $item->target )
		    and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
		! empty( $item->xfn )
		    and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
		! empty( $item->url )
		    and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$this->itemcount++;
		$output .= "<div class=\"mm-item txt-link ".$class_names."\" id=\"mm-item-".$item->post_name."\"> ";

		$item_output = $args->before
						. "<a $attributes class=\"fade\"><span>"
						. $args->link_before
						. $title
						. '</span></a> '
						. $args->link_after
						. $description
						. $args->after;

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
		    'walker_nav_menu_start_el'
		,   $item_output
		,   $item
		,   $depth
		,   $args
		);

	}

	function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0) {
		$output .= "</div>\n";
	}

}



class AddSpans extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item));
        ! empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';

		$attributes  = '';
        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

		$output .= "<li $classnames>";

		$item_output = $args->before
						. "<a $attributes><span>"
						. $args->link_before
						. $title
						. '</span></a> '
						. $args->link_after
						. $description
						. $args->after;

      	// Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
	}

}

?>
