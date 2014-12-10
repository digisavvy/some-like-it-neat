<?php
/**
 * digistarter functions and definitions
 *
 * @package digistarter
 */

if ( ! function_exists( 'digistarter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digistarter_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on digistarter, use a find and replace
	 * to change 'digistarter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'digistarter', get_template_directory() . '/library/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Add Editor Style for adequate styling in text editor.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style( '/assets/css/style.css' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'digistarter' ) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status', 'gallery', 'chat', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'digistarter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Including Theme Hook Alliance (https://github.com/zamoose/themehookalliance).
	 */
	include( 'library/vendors/tha-theme-hooks/tha-theme-hooks.php' );

	/**
	 * WP Customizer
	 */
	require get_template_directory() . '/library/vendors/wp-customizer/customizer.php';

	/**
	 * Implement the Custom Header feature.
	 */
	//require get_template_directory() . '/library/vendors/custom-header.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/library/vendors/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/library/vendors/extras.php';


	/**
	 * Load Jetpack compatibility file.
	 */
	require get_template_directory() . '/library/vendors/jetpack.php';

	/**
	 * Including TGM Plugin Activation
	 */
	require_once( get_template_directory() . '/library/vendors/tgm-plugin-activation/required-plugins.php' );

}
endif; // digistarter_setup
add_action( 'after_setup_theme', 'digistarter_setup' );

/**
 * Enqueue scripts and styles.
 */
if ( !function_exists('digistarter_scripts') ) :
	function digistarter_scripts() {

		if ( SCRIPT_DEBUG || WP_DEBUG ) :

			// Concatonated Scripts
			wp_enqueue_script( 'production-js', get_template_directory_uri() . '/assets/js/production.js', array( 'jquery' ), '1.0.0', false );

			// Main Style
			wp_enqueue_style( 'digistarter-style',  get_stylesheet_directory_uri() . '/assets/css/style.css' );

		else :
			// Concatonated Scripts
			wp_enqueue_script( 'production-js', get_template_directory_uri() . '/assets/js/production-min.js', array( 'jquery' ), '1.0.0', false );

			// Main Style
			wp_enqueue_style( 'digistarter-style',  get_stylesheet_directory_uri() . '/assets/css/style-min.css' );

		endif;

		// Dashicons
		 wp_enqueue_style( 'dashicons' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'digistarter_scripts' );
endif; // Enqueue Scripts and Styles

/**
 * Register widgetized area and update sidebar with default widgets.
 */
if ( !function_exists('digistarter_widgets_init') ) :
	function digistarter_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'digistarter' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'digistarter_widgets_init' );
endif;

/**
 * Initializing Flexnav Menu System
 */
if ( !function_exists('dg_add_flexnav') ) :
	function dg_add_flexnav() { ?>
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
	<?php }
	add_action( 'wp_head', 'dg_add_flexnav' );
endif;

/**
 * Custom Hooks and Filters
 */
if ( !function_exists('digistarter_add_breadcrumbs') ) :
	function digistarter_add_breadcrumbs() {
		if ( !is_front_page() ) {
			if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(array(
			  'prefix'     => __('You are here: ', 'digistarter'),
			  'last_link'  => true,
			  'separator'  => '|',
			  'excluded_taxonomies' => array(
			    'post_format'
			  ),
			  'taxonomy_excluded_terms' => array(
			    'category' => array('uncategorized')
			  ),
			  'post_types' => array(
			    'gizmo' => array(
			      'last_show'          => false,
			      'taxonomy_preferred' => 'category'
			    ),
			    'whatzit' => array(
			      'separator' => '&raquo;'
			    )
			  )
			)); }
		}
	}
	add_action( 'tha_content_top', 'digistarter_add_breadcrumbs' );
endif;

if ( !function_exists('digistarter_optional_scripts') ) :
	function digistarter_optional_scripts() {

		 // Link Color
		 if( get_theme_mod( 'digistarter_add_link_color' ) == '') {

		 } else { ?>
			<style type="text/css">
				a { color: <?php echo get_theme_mod( 'digistarter_add_link_color' ); ?>; }
			</style>
		<?php }


	}
	add_action( 'wp_head', 'digistarter_optional_scripts' );
endif;

if ( !function_exists('digistarter_mobile_styles') ) :
	function digistarter_mobile_styles() {
		$value = get_theme_mod( 'digistarter_mobile_hide_arrow' );

		 if( get_theme_mod( 'digistarter_mobile_hide_arrow' ) == 0 ) { ?>
			<style>
				.menu-button i.navicon {
					display: none;
				}
			</style>
		<?php  } else {

		 }
	}
	add_action('wp_head', 'digistarter_mobile_styles' );
endif;

if ( !function_exists('digistarter_add_footer_divs') ) :
	function digistarter_add_footer_divs() { ?>

		<div class="footer-left">
			 <?php echo esc_attr( get_theme_mod( 'digistarter_footer_left', __( '&copy; All Rights Reserved', 'digistarter' ) ) ); ?>

		</div>
		<div class="footer-right">
			<?php echo esc_attr( get_theme_mod( 'digistarter_footer_right', 'Footer Content Right' ) );  ?>
		</div>
<?php }
add_action( 'tha_footer_bottom', 'digistarter_add_footer_divs' );
endif;

add_action( 'tha_head_bottom', 'digistarter_add_selectivizr' );
function digistarter_add_selectivizr() { ?>
	<!--[if (gte IE 6)&(lte IE 8)]>
  		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/selectivizr/selectivizr-min.js"></script>
  		<noscript><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" /></noscript>
	<![endif]-->
<?php }

