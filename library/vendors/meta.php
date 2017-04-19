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
         'priority'      => 'low',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

	// Add other metaboxes as needed
	$cmb->add_field( array(
		// Hide Page Title on Per Post Basis
		'desc'	=> 'Useful for landing pages',
		'name'    => 'Hide Page Title',
		'id'      => 'some_like_it_neat_hide_title',
		'type'    => 'radio_inline',
		'default'    => 'no',
		'options' => array(
			'yes' => __( 'Yes', 'cmb2' ),
			'no'   => __( 'No', 'cmb2' ),
		),
	) );

	$cmb->add_field( array(
		// Hide Page Title on Per Post Basis
		'name'    => 'Hide Featured Image',
		'id'      => 'some_like_it_neat_hide_featured_image',
		'type'    => 'radio_inline',
		'default'    => 'no',
		'desc'		=> 'Hide featured image on singular post, while still using it throughout the rest of your site',
		'options' => array(
			'yes' => __( 'Yes', 'cmb2' ),
			'no'   => __( 'No', 'cmb2' ),
		),
	) );

 }

 /**
  * Enable/Disable Post Title on per-page basis
  */
 add_action( 'wp_head', 'some_like_it_neat_remove_title'  );
function some_like_it_neat_remove_title() {
	$key = 'some_like_it_neat_hide_title';
	$title_option = get_post_meta( get_the_id(), $key, true );

	if ( $title_option === 'yes') { ?>
		<style type="text/css">
			.entry-header {
				display: none;
			}
		</style>

	<?php }
 }

 /**
  * Enable/Disable Featured Image on per-page basis
  */
add_action( 'wp_head', 'some_like_it_neat_remove_featured_image'  );
function some_like_it_neat_remove_featured_image() {
	$key = 'some_like_it_neat_hide_featured_image';
	$image_option = get_post_meta( get_the_id(), $key, true );

	if ( $image_option === 'yes') { ?>
		<style type="text/css">
			.wp-post-image {
				display: none;
			}
		</style>

	<?php }
 }
