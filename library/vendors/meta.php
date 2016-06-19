<?php
/**
 * CMB2 Custom Metaboxes and Fields
 * See: https://github.com/WebDevStudios/CMB2
 * Adding a simple field or two to the theme for enhanced functionality.
 *
 * @package some_like_it_neat
 */

 add_action( 'cmb2_admin_init', 'some_like_it_neat_cmb2_add_metaboxes' );
 /**
  * Define the metabox and field configurations.
  */
 function some_like_it_neat_cmb2_add_metaboxes() {

	 // Start with an underscore to hide fields from custom fields list
     $prefix = '_yourprefix_';

     /**
      * Initiate the metabox
      */
     $cmb = new_cmb2_box( array(
         'id'            => 'post_options',
         'title'         => __( 'Post Options', 'cmb2' ),
         'object_types'  => array( 'page', ), // Post type
         'context'       => 'side',
         'priority'      => 'core',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

       // Add other metaboxes as needed
	   $cmb->add_field( array(
		    'name'    => 'Hide Page Title',
		    'id'      => 'some_like_it_neat_hide_title',
		    'type'    => 'radio_inline',
		    'default'    => 'no',
		    'options' => array(
		        'yes' => __( 'Yes', 'cmb2' ),
		        'no'   => __( 'No', 'cmb2' ),
		    ),
		) );
 }
