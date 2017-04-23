<?php
/**
 * some_like_it_neat functions and definitions
 *
 * @package some_like_it_neat
 */

/**
 * Customizer-selected frontend styles.
 */

if ( ! function_exists( 'some_like_it_neat_optional_scripts' ) ) :
    function some_like_it_neat_optional_scripts()
    {
        // Link Color
        if ( '' != get_theme_mod( 'some_like_it_neat_add_link_color' )  ) {
        } ?>
        <style type="text/css">
            a { color: <?php echo get_theme_mod( 'some_like_it_neat_add_link_color' ); ?>; }
        </style>
        <?php
    }
    add_action( 'wp_head', 'some_like_it_neat_optional_scripts' );
endif;

if ( ! function_exists( 'some_like_it_neat_mobile_styles' ) ) :
    function some_like_it_neat_mobile_styles() {

        $value = get_theme_mod( 'some_like_it_neat_mobile_hide_arrow' );

        if ( 0 == get_theme_mod( 'some_like_it_neat_mobile_hide_arrow' ) ) { ?>
            <style>
                .menu-button i.navicon {
                    display: none;
                }
            </style>
        <?php } else {

        }
    }
    add_action( 'wp_head', 'some_like_it_neat_mobile_styles' );

endif;

if ( ! function_exists( 'some_like_it_neat_add_footer_divs' ) ) :
    function some_like_it_neat_add_footer_divs()
    {
        ?>

        <div class="footer-left">
            <?php echo esc_attr( get_theme_mod( 'some_like_it_neat_footer_left', __( '&copy; All Rights Reserved', 'some-like-it-neat' ) ) ); ?>
        </div>
        <div class="footer-right">
            <?php echo esc_attr( get_theme_mod( 'some_like_it_neat_footer_right', 'Footer Content Right' ) );  ?>
        </div>
        <?php
    }
    add_action( 'tha_footer_bottom', 'some_like_it_neat_add_footer_divs' );

endif;
