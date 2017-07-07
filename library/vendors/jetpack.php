<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package some_like_it_neat
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
if ( 'yes' === get_theme_mod( 'some-like-it-neat_infinite_scroll_support' ) ) {
	$scroll_type = get_theme_mod( 'some-like-it-neat_infinite_scroll_type' );
	add_theme_support(
		'infinite-scroll', array(
			'type'           => $scroll_type,
			'footer'         => 'page',
			'footer_widgets' => false,
			'container'      => 'main',
			'wrapper'        => true,
			'render'         => 'some_like_it_neat_infinite_scroll_render',
			'posts_per_page' => false,
		)
	);
}

/**
 * Grabs posts while posts exists for infinite loop.
 */
function some_like_it_neat_infinite_scroll_render() {
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		get_template_part( 'page-templates/template-parts/content', get_post_format() );
	endwhile;
	endif;
}