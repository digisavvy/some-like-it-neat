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

/* Color controls */
// General Link Colors
$wp_customize->add_setting( 'digistarter_add_link_color', array(
	'default'			=> '#000000',
	'sanitize_callback' 	=> 'maybe_hash_hex_color',

) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize, 'digistarter_add_link_color', array(
		'label'			=> 'Body Link Color',
		'section'		=> 'colors',
		'settings'		=> 'digistarter_add_link_color',
		'priority'		=> 6
	)
)
);
/**
* Mobile Navigation Settings and Options
*/

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
		'section'			=> 'nav',
		'label'				=> 'Mobile Navigation Label',
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
		'section'	=> 'nav',
		'label'		=> 'Mobile Navigation Min-Width (numeric value)',
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
$wp_customize->add_control(
'digistarter_mobile_nav_icon',
	array(
		'section'			=> 'nav',
		'label'				=> 'Mobile Navigation Icon',
		'type'				=> 'text'
	)
);

// Mobile genesis_pre_load_favicon
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
		'label'				=> 'Mobile Navigation Hide Right Arrow',
		'type'				=> 'radio',
		'choices'			=> array("Yes", "No"),
	)
);

// Add Footer Section and Settings
$wp_customize->add_section(
'digistarter_footer_section_settings',
	array(
		'title'		=> 'Footer Settings',
		'priority'	=> 200
	)
);
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
		'label'		=> 'Left Footer',
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
		'label'		=> 'Right Footer',
		'type'		=> 'text'
	)
);

}
add_action( 'customize_register', 'digistarter_add_customizer_theme_options' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function digistarter_customize_preview_js() {
    wp_enqueue_script( 'digistarter_customizer', get_template_directory_uri() . '/library/vendors/wp-customizer/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'digistarter_customize_preview_js' );
