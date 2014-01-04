<?php
/**
 * digistarter Theme Customizer
 *
 * @package digistarter
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
 * Customizer
 */
function tcx_register_theme_customizer( $wp_customize ) {
    $wp_customize->add_setting(
	    'tcx_link_color',
	    array(
	        'default'     => '#000000',
	    )
	);

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'link_color',
	        array(
	            'label'      => __( 'Link Color', 'tcx' ),
	            'section'    => 'colors',
	            'settings'   => 'tcx_link_color'
	        )
	    )
	);

	$wp_customize->add_section(
	    'tcx_display_options',
	    array(
	        'title'     => 'Display Options',
	        'priority'  => 200
	    )
	);

	$wp_customize->add_setting(
	    'tcx_display_header',
	    array(
	        'default'    =>  'true'
	    )
	);

	$wp_customize->add_control(
	    'tcx_display_header',
	    array(
	        'section'   => 'tcx_display_options',
	        'label'     => 'Display Header?',
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'tcx_color_scheme',
	    array(
	        'default'   => 'normal'
	    )
	);

	$wp_customize->add_control(
	    'tcx_color_scheme',
	    array(
	        'section'  => 'tcx_display_options',
	        'label'    => 'Color Scheme',
	        'type'     => 'radio',
	        'choices'  => array(
	            'normal'    => 'Normal',
	            'inverse'   => 'Inverse'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'tcx_font',
	    array(
	        'default'   => 'times'
	    )
	);

	$wp_customize->add_control(
	    'tcx_font',
	    array(
	        'section'  => 'tcx_display_options',
	        'label'    => 'Theme Font',
	        'type'     => 'select',
	        'choices'  => array(
	            'times'     => 'Times New Roman',
	            'arial'     => 'Arial',
	            'courier'   => 'Courier New'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'tcx_footer_copyright_text',
	    array(
	        'default'            => 'All Rights Reserved',
	        'sanitize_callback'  => 'tcx_sanitize_copyright'
	    )
	);

	$wp_customize->add_control(
	    'tcx_footer_copyright_text',
	    array(
	        'section'  => 'tcx_display_options',
	        'label'    => 'Copyright Message',
	        'type'     => 'text'
	    )
	);
}
add_action( 'customize_register', 'tcx_register_theme_customizer' );

function tcx_sanitize_copyright( $input ) {
    return strip_tags( stripslashes( $input ) );
}

function tcx_customizer_css() {
    ?>
    <style type="text/css">
		#primary { font-family: <?php echo get_theme_mod( 'tcx_font' ); ?>; }

        a { color: <?php echo get_theme_mod( 'tcx_link_color' ); ?>; }

        <?php if( false === get_theme_mod( 'tcx_display_header' ) ) { ?>
		    #masthead { display: none; }
		<?php } // end if ?>

		<?php if ( 'normal' === get_theme_mod( 'tcx_color_scheme' ) ) { ?>

		    background: #000;
		    color:      #fff;

		<?php } else { ?>

		    background: #fff;
		    color:      #000;

		<?php } // end if/else ?>
		}


    </style>

    <?php
}
add_action( 'wp_head', 'tcx_customizer_css' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function digistarter_customize_preview_js() {
	wp_enqueue_script( 'digistarter_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'digistarter_customize_preview_js' );
