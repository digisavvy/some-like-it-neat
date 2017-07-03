<?php
/**
 * some_like_it_neat functions and definitions
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * Enqueue scripts.
 */
if (! function_exists('some_like_it_neat_scripts') ) :

    function some_like_it_neat_scripts() 
    {

        // Vendor Scripts
        wp_register_script('modernizr-js', get_theme_file_uri('/assets/js/vendor/modernizr/modernizr.js'), array( 'jquery' ), '2.8.2', false);
        wp_enqueue_script('modernizr-js');

        wp_register_script('selectivizr-js', get_theme_file_uri('/assets/js/vendor/selectivizr/selectivizr.js'), array( 'jquery' ), '1.0.2b', false);
        wp_enqueue_script('selectivizr-js');
        wp_script_add_data('selectivizr-js', 'conditional', '(gte IE 6)&(lte IE 8)');

        if ('flexnav' === get_theme_mod('some-like-it-neat_nav_style') ) {
            // Flexnav Style
            wp_enqueue_style('offcanvas', get_theme_file_uri('/assets/css/vendor/flexnav.css'));

            // Flexnav Scripts
            wp_register_script('flexnav-js', get_theme_file_uri('/assets/js/vendor/flexnav/jquery.flexnav.js'), array( 'jquery' ), '1.3.3', true);
            wp_enqueue_script('flexnav-js');

            wp_register_script('hoverintent-js', get_theme_file_uri('/assets/js/vendor/hoverintent/jquery.hoverIntent.js'), array( 'jquery' ), '1.0.0', true);
            wp_enqueue_script('hoverintent-js');
        } else {
            // Offcanvas Style
            wp_enqueue_style('offcanvas', get_theme_file_uri('/assets/css/layouts/navigation-offcanvas.css'));

            // Offcanvas Nav Script
            wp_enqueue_script('some-like-it-neat_custom', get_template_directory_uri() . '/assets/js/vendor/custom-offcanvas.js', array('jquery'), '1.0', true);
            wp_enqueue_script('some-like-it-neat_custom');

            // Headroom Style
            wp_enqueue_style('headroom', get_theme_file_uri('/assets/css/vendor/headroom-min.css'));

            // Headroom Script
            wp_enqueue_script('some-like-it-neat_headroom', get_template_directory_uri() . '/assets/js/vendor/headroom/headroom-min.js', array('jquery'), '0.9.3', false);
            wp_enqueue_script('some-like-it-neat_headroom');
        }

        // Dashicons
        wp_enqueue_style('dashicons');

        if (is_singular() && comments_open() && get_option('thread_comments') ) {
            wp_enqueue_script('comment-reply');
        }

        /**
         * Concatenate Scripts. Checks the directory below for js files. If there are js files they will be concatenated and minified in either
         * development.js or production.js. NOTE - You will have to stop and restart gulp. Also, these scripts run on all pages. Make sure
         * your scripts actually need to run on all pages before concatenating.
         */
        $directory = get_template_directory() . '/assets/js/app/';
        $files = glob($directory . '*.js');
        if ($files !== false ) {
            $filecount = count($files);

            if (! $filecount == 0 ) {
                if (SCRIPT_DEBUG || WP_DEBUG ) :
                    // Concatonated Scripts
                    wp_enqueue_script('some_like_it_neat-js', get_theme_file_uri('/assets/js/development.js'), array( 'jquery' ), '1.0.0', false);
                else :
                    // Concatonated Scripts
                    wp_enqueue_script('some_like_it_neat-js', get_theme_file_uri('/assets/js/production-min.js'), array( 'jquery' ), '1.0.0', false);
                endif;
            }
        }
    }
    add_action('wp_enqueue_scripts', 'some_like_it_neat_scripts');

endif; // Enqueue scripts

/**
 * Enqueue styles.
 */
if (! function_exists('some_like_it_neat_styles') ) :

    function some_like_it_neat_styles() 
    {
    	if ( !is_rtl() ) {

			if (SCRIPT_DEBUG || WP_DEBUG ) :
			    wp_register_style(
			        'some_like_it_neat-style', // handle name
			        get_parent_theme_file_uri('/assets/css/style.css'), '', '1.2', 'screen'
			    );
			    wp_enqueue_style('some_like_it_neat-style');

			else :
			    wp_register_style(
			        'some_like_it_neat-style', // handle name
			        get_parent_theme_file_uri('/assets/css/style-min.css'), '', '1.2', 'screen'
			    );
			    wp_enqueue_style('some_like_it_neat-style');
			endif;

	    } else {

		    if (SCRIPT_DEBUG || WP_DEBUG ) :
			    wp_register_style(
				    'some_like_it_neat-style', // handle name
				    get_parent_theme_file_uri('/assets/css/rtl.css'), '', '1.2', 'screen'
			    );
			    wp_enqueue_style('some_like_it_neat-style');

		    else :
			    wp_register_style(
				    'some_like_it_neat-style', // handle name
				    get_parent_theme_file_uri('/assets/css/rtl-min.css'), '', '1.2', 'screen'
			    );
			    wp_enqueue_style('some_like_it_neat-style');
		    endif;

	    }

    }
    add_action('wp_enqueue_scripts', 'some_like_it_neat_styles');

endif; // Enqueue styles