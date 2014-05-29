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

    // Add Mobile Navigation Settings
    // $wp_customize->add_section(
    //     'neat_mobile_nav_settings',
    //     array(
    //         'title'     => 'Mobile Nav Settings',
    //         'priority'  => 200
    //     )
    // );
    $wp_customize->add_setting(
        'mobile_nav_text',
        array(
            'default'            => 'Main Menu'
        )
    );
    $wp_customize->add_control(
        'mobile_nav_text',
        array(
            'section'  => 'nav',
            'label'    => 'Mobile Nav Text',
            'type'     => 'text'
        )
    );

    $wp_customize->add_setting(
        'mobile_nav_width',
        array(
            'default'            => '800'
        )
    );
    $wp_customize->add_control(
        'mobile_nav_width',
        array(
            'section'  => 'nav',
            'label'    => 'Mobile Nav Resize Width',
            'type'     => 'text'
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
        'description' => 'Add-ons for your theme such as icon fonts, and a place to enter your Google Analytics Code. You can find how to get your Google Analytics Tracking Code by <a href="http://goo.gl/bx0iiF">Clicking Here</a><hr/> ',
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


/**
 * Additional Customizer Controls by Paul Underwood - www.paullund.co.uk
 *
 * Based on his project hosted here: https://github.com/paulund/wordpress-theme-customizer-custom-controls
 */

new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        // add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager_demo( $wp_manager )
    {
        $this->demo_section( $wp_manager );
        $this->custom_sections( $wp_manager );
    }

    /**
     * A section to show how you use the default customizer controls in WordPress
     *
     * @param  Obj $wp_manager - WP Manager
     *
     * @return Void
     */
    private function demo_section( $wp_manager )
    {
        // $wp_manager->add_section( 'customiser_demo_section', array(
        //     'title'          => 'Default Demo Controls',
        //     'priority'       => 35,
        // ) );

        // // Textbox control
        // $wp_manager->add_setting( 'textbox_setting', array(
        //     'default'        => 'Default Value',
        // ) );

        // $wp_manager->add_control( 'textbox_setting', array(
        //     'label'   => 'Text Setting',
        //     'section' => 'customiser_demo_section',
        //     'type'    => 'text',
        //     'priority' => 1
        // ) );

        // // Checkbox control
        // $wp_manager->add_setting( 'checkbox_setting', array(
        //     'default'        => '1',
        // ) );

        // $wp_manager->add_control( 'checkbox_setting', array(
        //     'label'   => 'Checkbox Setting',
        //     'section' => 'customiser_demo_section',
        //     'type'    => 'checkbox',
        //     'priority' => 2
        // ) );

        // // Radio control
        // $wp_manager->add_setting( 'radio_setting', array(
        //     'default'        => '1',
        // ) );

        // $wp_manager->add_control( 'radio_setting', array(
        //     'label'   => 'Radio Setting',
        //     'section' => 'customiser_demo_section',
        //     'type'    => 'radio',
        //     'choices' => array("1", "2", "3", "4", "5"),
        //     'priority' => 3
        // ) );

        // // Select control
        // $wp_manager->add_setting( 'select_setting', array(
        //     'default'        => '1',
        // ) );

        // $wp_manager->add_control( 'select_setting', array(
        //     'label'   => 'Select Dropdown Setting',
        //     'section' => 'customiser_demo_section',
        //     'type'    => 'select',
        //     'choices' => array("1", "2", "3", "4", "5"),
        //     'priority' => 4
        // ) );

        // // Dropdown pages control
        // $wp_manager->add_setting( 'dropdown_pages_setting', array(
        //     'default'        => '1',
        // ) );

        // $wp_manager->add_control( 'dropdown_pages_setting', array(
        //     'label'   => 'Dropdown Pages Setting',
        //     'section' => 'customiser_demo_section',
        //     'type'    => 'dropdown-pages',
        //     'priority' => 5
        // ) );

        // // Color control
        // $wp_manager->add_setting( 'color_setting', array(
        //     'default'        => '#000000',
        // ) );

        // $wp_manager->add_control( new WP_Customize_Color_Control( $wp_manager, 'color_setting', array(
        //     'label'   => 'Color Setting',
        //     'section' => 'customiser_demo_section',
        //     'settings'   => 'color_setting',
        //     'priority' => 6
        // ) ) );

        // // WP_Customize_Upload_Control
        // $wp_manager->add_setting( 'upload_setting', array(
        //     'default'        => '',
        // ) );

        // $wp_manager->add_control( new WP_Customize_Upload_Control( $wp_manager, 'upload_setting', array(
        //     'label'   => 'Upload Setting',
        //     'section' => 'customiser_demo_section',
        //     'settings'   => 'upload_setting',
        //     'priority' => 7
        // ) ) );

        // // WP_Customize_Image_Control
        // $wp_manager->add_setting( 'image_setting', array(
        //     'default'        => '',
        // ) );

        // $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'image_setting', array(
        //     'label'   => 'Image Setting',
        //     'section' => 'customiser_demo_section',
        //     'settings'   => 'image_setting',
        //     'priority' => 8
        // ) ) );

        // // WP_Customize_Background_Image_Control
        // $wp_manager->add_setting( 'background_image_setting', array(
        //     'default'        => '',
        // ) );

        // $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'background_image_setting', array(
        //     'label'   => 'Background Image Setting',
        //     'section' => 'customiser_demo_section',
        //     'settings'   => 'background_image_setting',
        //     'priority' => 9
        // ) ) );

        // // WP_Customize_Background_Image_Control
        // $wp_manager->add_setting( 'background_image_setting', array(
        //     'default'        => '',
        // ) );

        // $wp_manager->add_control( new WP_Customize_Background_Image_Control( $wp_manager, 'background_image_setting', array(
        //     'label'   => 'Background Image Setting',
        //     'section' => 'customiser_demo_section',
        //     'settings'   => 'background_image_setting',
        //     'priority' => 9
        // ) ) );
    }

    /**
     * Adds a new section to use custom controls in the WordPress customiser
     *
     * @param  Obj $wp_manager - WP Manager
     *
     * @return Void
     */
    private function custom_sections( $wp_manager )
    {
        // $wp_manager->add_section( 'customiser_demo_custom_section', array(
        //     'title'          => 'Custom Controls Demo',
        //     'priority'       => 36,
        // ) );

        // // Add A Date Picker
        // require_once dirname(__FILE__) . '/date/date-picker-custom-control.php';
        // $wp_manager->add_setting( 'date_picker_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Date_Picker_Custom_Control( $wp_manager, 'date_picker_setting', array(
        //     'label'   => 'Date Picker Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'date_picker_setting',
        //     'priority' => 1
        // ) ) );

        // Add A Layout Picker
        // require_once dirname(__FILE__) . '/layout/layout-picker-custom-control.php';
        // $wp_manager->add_setting( 'layout_picker_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Layout_Picker_Custom_Control( $wp_manager, 'layout_picker_setting', array(
        //     'label'   => 'Layout Picker Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'layout_picker_setting',
        //     'priority' => 2
        // ) ) );

        // Add a category dropdown control
        // require_once dirname(__FILE__) . '/select/category-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'category_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Category_Dropdown_Custom_Control( $wp_manager, 'category_dropdown_setting', array(
        //     'label'   => 'Category Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'category_dropdown_setting',
        //     'priority' => 3
        // ) ) );

        // Add a menu dropdown control
        // require_once dirname(__FILE__) . '/select/menu-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'menu_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Menu_Dropdown_Custom_Control( $wp_manager, 'menu_dropdown_setting', array(
        //     'label'   => 'Menu Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'menu_dropdown_setting',
        //     'priority' => 4
        // ) ) );

        // Add a post dropdown control
        // require_once dirname(__FILE__) . '/select/post-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'post_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Post_Dropdown_Custom_Control( $wp_manager, 'post_dropdown_setting', array(
        //     'label'   => 'Post Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'post_dropdown_setting',
        //     'priority' => 5
        // ) ) );

        // Add a post type dropdown control
        // require_once dirname(__FILE__) . '/select/post-type-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'post_type_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Post_Type_Dropdown_Custom_Control( $wp_manager, 'post_type_dropdown_setting', array(
        //     'label'   => 'Post Type Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'post_type_dropdown_setting',
        //     'priority' => 6
        // ) ) );

        // Add a tags dropdown control
        // require_once dirname(__FILE__) . '/select/tags-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'tags_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Tags_Dropdown_Custom_Control( $wp_manager, 'tags_dropdown_setting', array(
        //     'label'   => 'Tags Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'tags_dropdown_setting',
        //     'priority' => 7
        // ) ) );

        // Add a user dropdown control
        // require_once dirname(__FILE__) . '/select/user-dropdown-custom-control.php';
        // $wp_manager->add_setting( 'user_dropdown_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new User_Dropdown_Custom_Control( $wp_manager, 'user_dropdown_setting', array(
        //     'label'   => 'User Dropdown Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'user_dropdown_setting',
        //     'priority' => 9
        // ) ) );

        // Add a textarea control
        // require_once dirname(__FILE__) . '/text/textarea-custom-control.php';
        // $wp_manager->add_setting( 'neat_add_ga_tracking', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Textarea_Custom_Control( $wp_manager, 'neat_add_ga_tracking', array(
        //     'label'   => 'Google Analytics Tracking Code',
        //     'section' => 'neat_theme_addons',
        //     'settings'   => 'neat_add_ga_tracking',
        //     'priority' => 10,

        // ) ) );

        // // Add a text editor control
        // require_once dirname(__FILE__) . '/text/text-editor-custom-control.php';
        // $wp_manager->add_setting( 'text_editor_setting', array(
        //     'default'        => '',
        // ) );
        // $wp_manager->add_control( new Text_Editor_Custom_Control( $wp_manager, 'text_editor_setting', array(
        //     'label'   => 'Text Editor Setting',
        //     'section' => 'customiser_demo_custom_section',
        //     'settings'   => 'text_editor_setting',
        //     'priority' => 11
        // ) ) );

    }

}

?>