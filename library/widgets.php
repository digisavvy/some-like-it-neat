<?php
/**
 * Some_like_it_neat functions and definitions
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function some_like_it_neat_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'some-like-it-neat' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'some_like_it_neat_widgets_init' );
