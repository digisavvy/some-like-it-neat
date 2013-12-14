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

	class My_Walker extends Walker_Nav_Menu {

		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a><br /><span class="sub">' . $item->attr_title. '</span>'; /* This is where I changed things. */
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
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

	// Meanmenu Style
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/library/css/meanmenu/meanmenu.css' );

	// Navigation
	wp_enqueue_script( 'digistarter-navigation', get_template_directory_uri() . '/library/js/navigation.js', array(), '20120206', true );

	// Skiplink Focus Fi
	wp_enqueue_script( 'digistarter-skip-link-focus-fix', get_template_directory_uri() . '/library/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Selectivizr Scripts
	wp_register_script( 'selectivizr', get_stylesheet_directory_uri() . '/library/js/selectivizr/selectivizr-min.js', array(), '1.0.0', false );
	wp_enqueue_script( 'selectivizr' );

	// Superfish Scripts
	wp_register_script( 'hoverintent', get_template_directory_uri() . '/library/js/superfish/hoverintent.js', array(), '1.0.0', false );
	wp_enqueue_script( 'hoverintent' );

	wp_register_script( 'supersubs', get_template_directory_uri() . '/library/js/superfish/supersubs.js', array(), '1.0.0', false );
	wp_enqueue_script( 'supersubs' );

	wp_register_script( 'superfish', get_template_directory_uri() . '/library/js/superfish/superfish.js', array(), '1.0.0', false );
	wp_enqueue_script( 'superfish' );

	// Meanmenu Script
	wp_register_script( 'meanmenu', get_template_directory_uri() . '/library/js/meanmenu/jquery.meanmenu.js', array(), '1.0.0', false );
	wp_enqueue_script( 'meanmenu' );

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

		// Init Mean Menu
		jQuery(document).ready(function () {
		    jQuery('header nav').meanmenu(

		    );
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
 * TGM Plugin Activation Class.
 */
require_once dirname( __FILE__ ) . '/library/inc/class-tgm-plugin-activation.php';

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

/**
 * TGM Class for recommended or required plugins.
 */
add_action( 'tgmpa_register', 'neat_recommended_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function neat_recommended_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Hensel and Gretel Breadcrumbs', // The plugin name
			'slug'     				=> 'hensel-gretel', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/library/plugins/hansel-gretel.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
		// 	'name' 		=> 'BuddyPress',
		// 	'slug' 		=> 'buddypress',
		// 	'required' 	=> false,
		// ),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'digistarter';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     		=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'		=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  			=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    		=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'		=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 				=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  	=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 					=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'					=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

/**
 * Custom Hooks and Filters
 */
add_action( 'tha_content_top', 'neat_add_breadcrumbs' ); {
	function neat_add_breadcrumbs() {
		if ( !is_front_page() ) {
			if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); }
		}
	}
}

