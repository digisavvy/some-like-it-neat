<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package digistarter
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function some_like_it_neat_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'some_like_it_neat_jetpack_setup' );
