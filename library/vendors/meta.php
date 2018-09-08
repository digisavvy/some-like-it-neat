<?php
/**
 * Metaboxes.io Field Meta
 */

function some_like_it_neat_get_post_types() {
	return get_post_types( array( 'public' => true ) );
}

// Add Metabox.io Meta Boxes
add_filter( 'rwmb_meta_boxes', 'mb_composer_example_register_meta_boxes' );
function mb_composer_example_register_meta_boxes( $meta_boxes ) {
	$post_types = some_like_it_neat_get_post_types();

    $meta_boxes[] = array(
		'context'    => 'side',
		'post_types' => $post_types,
        'priority'   => 'low',
        'title'  => 'Post Options',
        'fields' => array(
            array(
                'name' => 'Hide Title',
				'id'   => 'some_like_it_neat_hide_title',
				'std'  => 'no', // setting default option
				'type' => 'radio',
				    'options' => array(
						'no' => 'Show Title',
						'yes' => 'Hide Title',
					),
				'inline' => false,
            ),
            array(
                'name' => 'Hide Featured Image',
				'id'   => 'some_like_it_neat_hide_featured_image',
				'std'  => 'no', // setting default option
				'type' => 'radio',
				    'options' => array(
						'no' => 'Show Featured Image',
						'yes' => 'Hide Featured Image',
					),
				'inline' => false,
            ),
		),
    );

    return $meta_boxes;
}

/**
 * Enable/Disable Post Title on per-page basis.
 */
add_action( 'wp_head', 'some_like_it_neat_remove_title'  );
function some_like_it_neat_remove_title() {

	$title_option = rwmb_meta( 'some_like_it_neat_hide_title' );
	if ( 'yes' == $title_option ) :
		?>
        <style type="text/css">
            .entry-header {
                display: none;
            }
        </style>
		<?php
	endif;
}

/**
 * Enable/Disable Featured Image on per-page basis.
 */
add_action( 'wp_head', 'some_like_it_neat_remove_featured_image'  );
function some_like_it_neat_remove_featured_image() {

	$image_option = rwmb_meta( 'some_like_it_neat_hide_featured_image' );

	if ( 'yes' === $image_option ) :
		?>
        <style type="text/css">
            .wp-post-image {
                display: none;
            }
        </style>
		<?php
	endif;
}