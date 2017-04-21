<?php
/**
 * some_like_it_neat functions and definitions
 *
 * @package some_like_it_neat
 */

if ( ! function_exists( 'some_like_it_neat_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function some_like_it_neat_setup()
    {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        if ( ! isset( $content_width ) ) {
            $content_width = 640; /* pixels */
        }

        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on some_like_it_neat, use a find and replace
        * to change 'some-like-it-neat' to the name of your theme in all the template files
        */
        load_theme_textdomain( 'some-like-it-neat', get_template_directory() . '/library/languages' );

        /**
         * Add default posts and comments RSS feed links to head.
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * Enable HTML5 markup
         */
        add_theme_support( 'html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
        ) );

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
        add_theme_support( 'post-thumbnails' );

        /*
        * Enable title tag support for all posts.
        *
        * @link http://codex.wordpress.org/Title_Tag
        */
        add_theme_support( 'title-tag' );

        /*
        * Add Editor Style for adequate styling in text editor.
        *
        * @link http://codex.wordpress.org/Function_Reference/add_editor_style
        */
        add_editor_style( '/assets/css/editor-style.css' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'some-like-it-neat' ) );

        // Enable support for Post Formats.
        if ( 'yes' === get_theme_mod( 'some-like-it-neat_post_format_support' ) ) {
            add_theme_support( 'post-formats',
                array(
                    'aside',
                    'image', '
					video',
                    'quote',
                    'link',
                    'status',
                    'gallery',
                    'chat',
                    'audio'
                ) );
        }

        // Enable Support for Jetpack Infinite Scroll
        if ( 'yes' === get_theme_mod( 'some-like-it-neat_infinite_scroll_support' ) ) {
            $scroll_type = get_theme_mod( 'some-like-it-neat_infinite_scroll_type' );
            add_theme_support( 'infinite-scroll', array(
                'type'				=> $scroll_type,
                'footer_widgets'	=> false,
                'container'			=> 'content',
                'wrapper'			=> true,
                'render'			=> false,
                'posts_per_page' 	=> false,
                'render'			=> 'some_like_it_neat_infinite_scroll_render',
            ) );

            function some_like_it_neat_infinite_scroll_render() {
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    get_template_part( 'page-templates/template-parts/content', get_post_format() );
                endwhile;
                endif;
            }
        }

        // Setup the WordPress core custom background feature.
        add_theme_support(
            'custom-background', apply_filters(
                'some_like_it_neat_custom_background_args', array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        /**
         * Including CMB2 (https://github.com/WebDevStudios/CMB2).
         */
        if ( file_exists(  __DIR__ . '/library/vendors/cmb2/init.php' ) ) {
            require_once  __DIR__ . '/library/vendors/cmb2/init.php';
            include get_template_directory() . '/library/vendors/meta.php';
        } elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
            require_once  __DIR__ . '/CMB2/init.php';
            include get_template_directory() . '/library/vendors/meta.php';
        }

        /**
         * Including Theme Hook Alliance (https://github.com/zamoose/themehookalliance).
         */
        include get_template_directory() . '/library/vendors/theme-hook-alliance/tha-theme-hooks.php' ;

        /**
         * WP Customizer
         */
        include get_template_directory() . '/library/vendors/customizer/customizer.php';

        /**
         * Implement the Custom Header feature.
         */
        //require get_template_directory() . '/library/vendors/custom-header.php'

        /**
         * Custom template tags for this theme.
         */
        include get_template_directory() . '/library/vendors/template-tags.php';

        /**
         * Custom functions that act independently of the theme templates.
         */
        include get_template_directory() . '/library/vendors/extras.php';

        /**
         * Load Jetpack compatibility file.
         */
        include get_template_directory() . '/library/vendors/jetpack.php';

        /**
         * Including TGM Plugin Activation
         */
        include_once get_template_directory() . '/library/vendors/tgm-plugin-activation/class-tgm-plugin-activation.php' ;

        include_once get_template_directory() . '/library/vendors/tgm-plugin-activation/tgm-plugin-activation.php' ;

    }
endif; // some_like_it_neat_setup
add_action( 'after_setup_theme', 'some_like_it_neat_setup' );
