<?php
/**
 * some_like_it_neat functions and definitions
 *
 * @package some_like_it_neat
 */

/**
 * Initializing Flexnav Menu System
 */
if ( ! function_exists( 'dg_add_flexnav' ) && ( 'flexnav' === get_theme_mod( 'some-like-it-neat_nav_style' ) ) ) :
    function dg_add_flexnav()
    {
        ?>
        <script>
            // Init Flexnav Menu
            jQuery(document).ready(function($){
                $(".flexnav").flexNav({
                    'animationSpeed' : 250, // default drop animation speed
                    'transitionOpacity': true, // default opacity animation
                    'buttonSelector': '.menu-button', // default menu button class
                    'hoverIntent': true, // use with hoverIntent plugin
                    'hoverIntentTimeout': 350, // hoverIntent default timeout
                    'calcItemWidths': false // dynamically calcs top level nav item widths
                });
            });
        </script>
        <?php
    }
    add_action( 'wp_footer', 'dg_add_flexnav' );
endif;