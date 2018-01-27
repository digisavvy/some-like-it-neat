<?php
/**
 * Carbon Fields Meta
 */
use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action( 'carbon_fields_register_fields', 'crb_attach_post_meta' );
function crb_attach_post_meta() {

 	foreach ( get_post_types( ) as $post_type ) {
		Container::make( 'post_meta', __( 'Post Options', 'crb' ) )
			->where( 'post_type', '=', $post_type )
            ->set_context( 'side' )
			->set_priority( 'low' )
			->add_fields( array(
				Field::make( 'radio', 'some_like_it_neat_hide_title', 'Hide Page Title' )
                    ->set_help_text( 'Useful for Landing Pages' )
                    ->set_default_value( 'no' )
                    ->add_options( array(
                        'no' => 'No',
                        'yes' => 'Yes',
                    ) ),
                Field::make( 'radio', 'some_like_it_neat_hide_featured_image', 'Hide Featured Image' )
                    ->set_help_text( 'Hide featured image on singular post, while still using it throughout the rest of your site' )
                    ->set_default_value( 'no' )
                    ->add_options( array(
                        'no' => 'No',
                        'yes' => 'Yes',
                    ) )
			) );

    }

}

/**
 * Enable/Disable Post Title on per-page basis
 */
add_action( 'wp_head', 'some_like_it_neat_remove_title'  );
function some_like_it_neat_remove_title() {
	$title_option = carbon_get_the_post_meta( 'some_like_it_neat_hide_title' );

	if ( 'yes' == $title_option ) { ?>
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
	$image_option = carbon_get_the_post_meta( 'some_like_it_neat_hide_featured_image' );

	if ( $image_option === 'yes') { ?>
        <style type="text/css">
            .wp-post-image {
                display: none;
            }
        </style>

	<?php }
}