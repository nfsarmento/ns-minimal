<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
if ( ! function_exists( 'ns_minimal_page_menu_args' ) ) :
function ns_minimal_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ns_minimal_page_menu_args' );
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'ns_minimal_body_classes' ) ) :
function ns_minimal_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'ns_minimal_body_classes' );
endif;
