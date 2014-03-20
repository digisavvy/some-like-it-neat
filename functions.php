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
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	if ( !function_exists('dg_register_nav_menus') ) :
		function dg_register_nav_menus() {

			register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'digistarter' ) );

		}
		add_action( 'init', 'dg_register_nav_menus' );
	endif;

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status', 'gallery', 'chat', 'audio' ) );

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
 * Enqueue scripts and styles.
 */
if ( !function_exists('digistarter_scripts') ) :
	function digistarter_scripts() {
		if (!is_admin()) {
			wp_enqueue_script('jquery');
		}

		// Main Style
		wp_enqueue_style( 'digistarter-style', get_stylesheet_uri() );

		// Superfish Style
		wp_enqueue_style( 'superfish', get_template_directory_uri() . '/library/css/superfish/superfish.css' );

		// Meanmenu Style
		wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/library/css/meanmenu/meanmenu.css' );

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
endif;

if ( !function_exists('dg_add_superfish') ) :
	function dg_add_superfish(){ ?>
		<script>
			// Init Superfish
			jQuery(document).ready(function() {
				jQuery('ul.sf-menu').superfish();
			});
		</script>
	<?php }
	add_action( 'wp_head', 'dg_add_superfish' );
endif;

if ( !function_exists('dg_add_meanmenu') ) :
	function dg_add_meanmenu() { ?>
		<script>
			// Init Mean Menu
			jQuery(document).ready(function () {
			    jQuery('header nav').meanmenu( {
			     meanScreenWidth: "480",
	   			 meanRevealPosition: "right",
	   			 meanExpand: "",
	   			 meanMenuContainer: "body",
	   			 meanMenuClose: "X"

			    } );
			});
		</script>
	<?php }
	add_action( 'wp_head', 'dg_add_meanmenu' );
endif;

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
 * Customizer Controls.
 */

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
 * Custom Hooks and Filters
 */
function neat_add_breadcrumbs() {
	if ( !is_front_page() ) {
		if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); }
	}
}
add_action( 'tha_content_top', 'neat_add_breadcrumbs' );

function neat_add_footer_divs() { ?>
	<div class="footer-left">
		 <?php echo get_theme_mod( 'neat_footer_left' ); ?>
	</div>
	<div class="footer-right">
		<?php echo get_theme_mod( 'neat_footer_right' ); ?>
	</div>
<?php }
add_action( 'tha_footer_bottom', 'neat_add_footer_divs' );



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/library/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'neat_theme_register_required_plugins' );

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
function neat_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        // array(
        //     'name'               => 'TGM Example Plugin', // The plugin name.
        //     'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
        //     'source'             => get_stylesheet_directory() . '/library/inc/tgm-plugin-activation/plugins/tgm-example-plugin.zip', // The plugin source.
        //     'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        //     'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
        //     'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
        //     'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        //     'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        // ),

        // // This is an example of how to include a plugin from a private repo in your theme.
        // array(
        //     'name'               => 'TGM New Media Plugin', // The plugin name.
        //     'slug'               => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
        //     'source'             => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
        //     'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        //     'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
        // ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Hensel & Gretel: Breadcrumb Generator',
            'slug'      => 'hansel-gretel',
            'required'  => false,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
