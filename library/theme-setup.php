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
 * Including Metabox.io (https://github.com/wpmetabox/meta-box).
 */
function some_like_it_neat_crb_load() {

	$autoload = TEMPLATEPATH . '/library/vendors/wpmetabox/meta-box.php';
	if ( file_exists( $autoload ) ) :

		require_once( $autoload );

	endif;
}
add_action( 'after_setup_theme', 'some_like_it_neat_crb_load' );

function some_like_it_neat_crb_admin_notice() {

	// Only need on post edit screens.
	$current_screen = get_current_screen();
	if ( empty( $current_screen->base ) || 'post' != $current_screen->base ) {
		return;
	}

	// Only need for our Carbon post types.
	$post_types = some_like_it_neat_get_crb_post_types();
	if ( empty( $current_screen->post_type ) || ! in_array( $current_screen->post_type, $post_types ) ) {
		return;
	}

	?>
	<div class="notice-error error">
		<p><?php printf( __( 'Your theme requires that you run \'%1$s\' in order to manage your content. Refer to the \'%2$s\' in the theme\'s README.md file.', 'some_like_it_neat' ), 'composer install', 'Install Composer and NPM Dependencies' ); ?></p>
	</div>
	<?php
}

if ( ! function_exists( 'some_like_it_neat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function some_like_it_neat_setup() {

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
		add_theme_support(
			'html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
			)
		);

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
			add_theme_support(
				'post-formats',
				array(
					'aside',
					'image',
					'video',
					'quote',
					'link',
					'status',
					'gallery',
					'chat',
					'audio',
				)
			);
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
		 * Including Theme Hook Alliance (https://github.com/zamoose/themehookalliance).
		 */
		include get_template_directory() . '/library/vendors/theme-hook-alliance/tha-theme-hooks.php' ;

		/**
		 * WP Customizer
		 */
		include get_template_directory() . '/library/vendors/customizer/customizer.php';

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

		/**
		 * Adding Beaver Themer Support
		 */
		add_theme_support( 'fl-theme-builder-headers' );
		add_theme_support( 'fl-theme-builder-footers' );
		add_theme_support( 'fl-theme-builder-parts' );

	}

	if ( 'offcanvas' === get_theme_mod( 'some-like-it-neat_nav_style' ) ) {
		// Add offcanvas-nav to body classes.
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'offcanvas-nav' ) );
		} );
	}

endif; // some_like_it_neat_setup.
add_action( 'after_setup_theme', 'some_like_it_neat_setup' );

/**
 * Adding compatibility for Beaver Themer
 */
function some_like_it_neat_header_footer_render() {

	if ( class_exists( 'FLBuilder' ) ) {

		// Get the header ID.
		$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

		// If we have a header, remove the theme header and hook in Theme Builder's.
		if ( ! empty( $header_ids ) ) {
			remove_action( 'some_like_it_neat_header', 'some_like_it_neat_do_header' );
			add_action( 'some_like_it_neat_header', 'FLThemeBuilderLayoutRenderer::render_header' );
		}

		// Get the footer ID.
		$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

		// If we have a footer, remove the theme footer and hook in Theme Builder's.
		if ( ! empty( $footer_ids ) ) {
			remove_action( 'some_like_it_neat_footer', 'some_like_it_neat_do_footer' );
			add_action( 'some_like_it_neat_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );

		}
	}

}
add_action( 'wp', 'some_like_it_neat_header_footer_render' );

/**
 * Adding compatibility for Beaver Themer
 */
function some_like_it_neat_register_part_hooks() {

	if ( class_exists( 'FLBuilder' ) ) {

		return array(
			array(
				'label' => 'Header',
				'hooks' => array(
					'tha_header_before' => 'Before Header',
					'tha_header_after'  => 'After Header',
				),
			),
			array(
				'label' => 'Content',
				'hooks' => array(
					'tha_content_before' => 'Before Content',
					'tha_content_after'  => 'After Content',
				),
			),
			array(
				'label' => 'Footer',
				'hooks' => array(
					'tha_footer_before' => 'Before Footer',
					'tha_footer_after'  => 'After Footer',
				),
			),
		);

	}

}
add_filter( 'fl_theme_builder_part_hooks', 'some_like_it_neat_register_part_hooks' );

/**
 * Add align wide support for Gutenberg
 */
add_theme_support( 'align-wide' );

/**
 * Add default block styles support for Gutenberg
 */
add_theme_support( 'wp-block-styles' );

/**
 * Enqueue block editor style
 */
function some_like_it_neat_block_editor_styles() {
    wp_enqueue_style( 'some_like_it_neat_block-editor-styles', get_theme_file_uri( 'assets/css/editor.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'some_like_it_neat_block_editor_styles' );
