<?php
/**
 * digistarter functions and definitions
 *
 * @package digistarter
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'digistarter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digistarter_setup() {

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
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'digistarter' ),
		'menu_class'      => 'sf-menu',
		'items_wrap'      => '<ul id="%1$s" class="sf-menu">%3$s</ul>'
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'digistarter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // digistarter_setup
add_action( 'after_setup_theme', 'digistarter_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
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

/**
 * Enqueue scripts and styles.
 */
function digistarter_scripts() {
	if (!is_admin()) {
		wp_enqueue_script('jquery');
	}

	// Main Style
	wp_enqueue_style( 'digistarter-style', get_stylesheet_uri() );

	// Genericons Style
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/library/css/genericons.css' );

	// Superfish Style
	wp_enqueue_style( 'superfish', get_template_directory_uri() . '/library/css/superfish/superfish.css' );

	// Navigation
	wp_enqueue_script( 'digistarter-navigation', get_template_directory_uri() . '/library/js/navigation.js', array(), '20120206', true );

	// Skiplink Focus Fi
	wp_enqueue_script( 'digistarter-skip-link-focus-fix', get_template_directory_uri() . '/library/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Selectivizr Scripts
	wp_register_script( 'selectivizr', get_stylesheet_directory_uri() . '/library/js/selectivizr-min.js', array(), '1.0.0', false );
	wp_enqueue_script( 'selectivizr' );

	// Superfish Scripts
	wp_register_script( 'hoverintent', get_template_directory_uri() . '/library/js/hoverIntent.js', array(), '1.0.0', false );
	wp_enqueue_script( 'hoverintent' );

	wp_register_script( 'superfish', get_template_directory_uri() . '/library/js/superfish.js', array(), '1.0.0', false );
	wp_enqueue_script( 'superfish' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'digistarter_scripts' );

function dg_add_fontawesome() {
	echo '<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">';
	echo "<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Oswald' rel='stylesheet' type='text/css'>";
}
add_action( 'wp_head', 'dg_add_fontawesome' );

function dg_add_superfish(){ ?>
	<script>
		jQuery(document).ready(function() {
			jQuery('ul.sf-menu').superfish();
		});
	</script>
<?php }
add_action( 'wp_head', 'dg_add_superfish' );

/**
 * Including Theme Hook Alliance (https://github.com/zamoose/themehookalliance).
 */
include( 'library/tha-theme-hooks.php' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/library/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/library/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/library/inc/extras.php';

/**
 * WP Customizer additions.
 */
require get_template_directory() . '/library/inc/customizer.php';

function dg_customizer_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here


}
add_action( 'customize_register', 'dg_customizer_register' );


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/library/inc/jetpack.php';




