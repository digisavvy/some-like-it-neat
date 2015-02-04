<?php
/**
 * digistarter Theme Customizer
 *
 * @package digistarter
 * Look, I'm sorry about this messy file, mmkay? Saw Paul Underwood's  repo for extended customizer controls and had a
 * "moment." Okay? Below, just copy the controls you need to use and go bonkers, customize as needed. I started things
 * off by adding a Textarea for GA.
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function digistarter_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'digistarter_customize_register' );

/**
 * Customizer Sanitization Functions
 */
function digistarter_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function digistarter_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Customizer Some Like it Neat Additions
 */

function digistarter_add_customizer_theme_options($wp_customize) {

// Remove Default Sections, Settings and Controls
$wp_customize->remove_section( 'nav');

// Changing panels for default Customizer settings
$wp_customize->get_section('static_front_page')->panel = 'site_content';
$wp_customize->get_section('colors')->panel = 'color_panel';
$wp_customize->get_section('title_tagline')->panel = 'site_content';
$wp_customize->get_section('background_image')->panel = 'site_content';

/**
* Adding Panels for Home Page and Colors
*/
$wp_customize->add_panel( 'site_content', array(
    'priority' => 5,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'General Site Content Settings', 'digistarter' ),
    'description' => __( 'Navigation related settings and config.', 'digistarter' ),
) );

/* Color controls */
// General Link Colors
$wp_customize->add_panel( 'color_panel', array(
    'priority' => 10,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'Color Palette Settings', 'digistarter' ),
    'description' => __( 'Color palette related settings and config.', 'digistarter' ),
) );

$wp_customize->add_setting( 'digistarter_add_link_color', array(
	'default'			=> '#000000',
	'sanitize_callback' 	=> 'maybe_hash_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize, 'digistarter_add_link_color', array(
		'label'			=> __('Body Link Color', 'digistarter'),
		'section'		=> 'colors',
		'settings'		=> 'digistarter_add_link_color',
		'priority'		=> 6
	)
)
);
/**
* Mobile Navigation Settings and Options
*/
$wp_customize->add_panel( 'navigation_panel', array(
    'priority' => 15,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'Navigation Settings', 'digistarter' ),
    'description' => __( 'Navigation related settings and config.', 'digistarter' ),
) );

	$wp_customize->add_section( 'navigation_section', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Navigation Setup', 'digistarter' ),
	    'description' => '',
	    'panel' => 'navigation_panel',
	) );

// Mobile nav label
$wp_customize->add_setting(
	'digistarter_mobile_nav_label',
		array(
			'default'			=> 'Menu',
			'sanitize_callback' => 'digistarter_sanitize_text'
		)
);
$wp_customize->add_control(
	'digistarter_mobile_nav_label',
	array(
		'section'			=> 'navigation_section',
		'label'				=> __('Mobile Navigation Label', 'digistarter'),
		'type'				=> 'text',
	)
);

// Mobile Nav Min Width
$wp_customize->add_setting(
	'digistarter_mobile_min_width',
	array(
		'default'            => '768',
		'sanitize_callback'	=> 'absint'
	)
);
$wp_customize->add_control(
	'digistarter_mobile_min_width',
	array(
		'section'	=> 'navigation_section',
		'label'		=> __('Mobile Navigation Min-Width (numeric value)', 'digistarter'),
		'type'		=> 'text',
	)
);

// Mobile Nav Icon Text
$wp_customize->add_setting(
'digistarter_mobile_nav_icon',
	array(
		'default'		=> "dashicons-menu",
		'sanitize_callback' => 'digistarter_sanitize_text'
	)
);

$dashicons = '<a href="https://developer.wordpress.org/resource/dashicons/#pressthis" title="Dashicons Link" target="_blank">Dashicons Link</a>';
$wp_customize->add_control(
'digistarter_mobile_nav_icon',
	array(
		'section'			=> 'navigation_section',
		'label'				=> __('Mobile Navigation Icon', 'digistarter'),
		'type'				=> 'text',
		'description' =>  __('Dashicons are enabled and you can use them here! '.$dashicons.'', 'digistarter'),
	)
);

// Mobile Settings
$wp_customize->add_setting(
	'digistarter_mobile_hide_arrow',
	array(
		'default'		=> "No",
		'sanitize_callback'	=> 'digistarter_sanitize_checkbox'
	)
);


$wp_customize->add_control(
	'digistarter_mobile_hide_arrow',
	array(
		'section'			=> 'nav',
		'label'				=> __('Mobile Navigation Hide Right Arrow', 'digistarter'),
		'type'				=> 'radio',
		'choices'			=> array("Yes", "No"),
	)
);

// Add Footer Section and Settings
$wp_customize->add_panel( 'footer_settings_panel', array(
    'priority' => 25,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'Footer Settings', 'digistarter' ),
    'description' => __( 'Settings related to the Footer Section.', 'digistarter' ),
) );

$wp_customize->add_section( 'digistarter_footer_section_settings', array(
    'priority' => 10,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'Footer Area Settings', 'digistarter' ),
    'description' => 'Enter copy for right, left and colophon footer areas',
    'panel' => 'footer_settings_panel',
) );

$wp_customize->add_setting(
'digistarter_footer_left',
	array(
		'sanitize_callback'	=> 'digistarter_sanitize_text',
		'default'			=> '&copy; All Rights Reserved'
	)
);
$wp_customize->add_control(
'digistarter_footer_left',
	array(
		'section'	=> 'digistarter_footer_section_settings',
		'label'		=> __('Left Footer', 'digistarter'),
		'type'		=> 'text'
	)
);

$wp_customize->add_setting(
'digistarter_footer_right',
	array(
		'default'			=> 'Footer Content Right',
		'sanitize_callback'	=> 'digistarter_sanitize_text'
	)
);
$wp_customize->add_control(
'digistarter_footer_right',
	array(
		'section'	=> 'digistarter_footer_section_settings',
		'label'		=> __('Right Footer', 'digistarter'),
		'type'		=> 'text'
	)
);

$wp_customize->add_setting(
'digistarter_footer_colophon',
	array(
		'default'			=> 'Some Like it Neat, by Alex Vasquez',
		'sanitize_callback'	=> 'digistarter_sanitize_text'
	)
);
$wp_customize->add_control(
'digistarter_footer_colophon',
	array(
		'section'		=> 'digistarter_footer_section_settings',
		'label'			=> __('Footer Colophon', 'digistarter'),
		'type'			=> 'text',
		'transport'	=> 'postMessage'
	)
);

/* Example Section and 4.0 customizer controls
*  @link — https://gist.github.com/devinsays/e9c6754340a5253c3ec9
*  @author — devinsays
*/
$wp_customize->add_panel( 'panel_id', array(
	    'priority' => 1000,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Example Panel', 'digistarter' ),
	    'description' => __( 'Description of what this panel does.', 'digistarter' ),
	) );

	$wp_customize->add_section( 'section_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Example Section', 'digistarter' ),
	    'description' => '',
	    'panel' => 'panel_id',
	) );

	$wp_customize->add_setting( 'textarea_field_id', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'digistarter_sanitize_text',
	) );

	$wp_customize->add_control( 'textarea_field_id', array(
	    'type' => 'textarea',
	    'priority' => 10,
	    'section' => 'section_id',
	    'label' => __( 'Textarea Field', 'digistarter' ),
	    'description' => '',
	) );


}
add_action( 'customize_register', 'digistarter_add_customizer_theme_options' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function digistarter_customize_preview_js() {
    wp_enqueue_script( 'digistarter_customizer', get_template_directory_uri() . '/library/vendors/wp-customizer/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'digistarter_customize_preview_js' );
