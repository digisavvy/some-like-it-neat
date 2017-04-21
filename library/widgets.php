<?php
/**
 * some_like_it_neat functions and definitions
 *
 * @package some_like_it_neat
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
