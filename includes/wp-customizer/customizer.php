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
 * Customizer Some Like it Neat Additions
 */

function neat_add_customizer_theme_options($wp_customize) {

	/* Color controls */
	// General Link Colors
	$wp_customize->add_setting( 'neat_add_link_color', array(
	    'default'        => '#000000',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'neat_add_link_color', array(
			    'label'   => 'Body Link Color',
			    'section' => 'colors',
			    'settings'   => 'neat_add_link_color',
			    'priority' => 6
			)
		)
	);
    /**
     * Mobile Navigation Settings and Options
     */

    // Mobile nav label
    $wp_customize->add_setting(
        'neat_mobile_nav_label',
        array(
            'default'            => 'Menu'
        )
    );
    $wp_customize->add_control(
        'neat_mobile_nav_label',
        array(
            'section'  => 'nav',
            'label'    => 'Mobile Navigation Label',
            'type'     => 'text'
        )
    );

    // Mobile Nav Min Width
     $wp_customize->add_setting(
        'neat_mobile_min_width',
        array(
            'default'            => '768'
        )
    );
    $wp_customize->add_control(
        'neat_mobile_min_width',
        array(
            'section'  => 'nav',
            'label'    => 'Mobile Navigation Min-Width (numeric value)',
            'type'     => 'text'
        )
    );

    // Mobile Nav Hide Right Arrow
     $wp_customize->add_setting(
        'neat_mobile_hide_arrow',
        array(
            'default'            => "No"
        )
    );
    $wp_customize->add_control(
        'neat_mobile_hide_arrow',
        array(
            'section'  => 'nav',
            'label'    => 'Mobile Navigation Hide Right Arrow',
            'type'    => 'radio',
            'choices' => array("Yes", "No")
        )
    );

    // Add Footer Section and Settings
    $wp_customize->add_section(
        'neat_footer_section_settings',
        array(
            'title'     => 'Footer Settings',
            'priority'  => 200
        )
    );
    $wp_customize->add_setting(
        'neat_footer_left',
        array(
            'default'            => '&copy; All Rights Reserved'
        )
    );
    $wp_customize->add_control(
        'neat_footer_left',
        array(
            'section'  => 'neat_footer_section_settings',
            'label'    => 'Left Footer',
            'type'     => 'text'
        )
    );

    $wp_customize->add_setting(
        'neat_footer_right',
        array(
            'default'            => 'Footer Content Right'
        )
    );
    $wp_customize->add_control(
        'neat_footer_right',
        array(
            'section'  => 'neat_footer_section_settings',
            'label'    => 'Right Footer',
            'type'     => 'text'
        )
    );

    // Add-Ons
    $wp_customize->add_section('neat_theme_addons' , array(
        'description' => 'Add-ons for your theme such as icon fonts. ',
        'title'     => __('Theme Add-Ons', 'digistarter'),
        'priority'  => 1020
    ));

        $wp_customize->add_setting('add_fontawesome_icons', array(
            'default'    => '0'
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'add_fontawesome_icons',
                array(
                    'label'     => __('Enable Fontawesome Icons', 'digistarter'),
                    'section'   => 'neat_theme_addons',
                    'settings'  => 'add_fontawesome_icons',
                    'type'      => 'checkbox',
                )
            )
        );

        $wp_customize->add_setting('neat_add_genericon_icons', array(
            'default'    => '0'
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'neat_add_genericon_icons',
                array(
                    'label'     => __('Enable Genericon Icons', 'digistarter'),
                    'section'   => 'neat_theme_addons',
                    'settings'  => 'neat_add_genericon_icons',
                    'type'      => 'checkbox',
                )
            )
        );

}
add_action( 'customize_register', 'neat_add_customizer_theme_options' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function digistarter_customize_preview_js() {
    wp_enqueue_script( 'digistarter_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'digistarter_customize_preview_js' );