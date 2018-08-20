<?php
/**
 * Functions for single post/page navigation
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * Wrap images in figure tag
 * @link https://wordpress.stackexchange.com/questions/174582/always-use-figure-for-post-images
 */
 
function some_like_it_neat_figure_wrap( $content ) { 
	$media_id = get_attached_media( 'image' );

    $content = preg_replace( 
        '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', 
        '<figure>$1</figure>', 
        $content 
    ); 
    return $content; 
} 
add_filter( 'the_content', 'some_like_it_neat_figure_wrap', 99 );

/**
 * Add Singular Post Template Navigation
 */

if ( 'no' === get_theme_mod( 'some-like-it-neat_hide_post_navigation' ) ) {
	if ( ! function_exists( 'some_like_it_neat_post_navigation' ) ) :
		/**
		 * Adds next / previous navigation to singular posts and pages, but not landing pages.
		 */
		function some_like_it_neat_post_navigation() {
			if ( is_singular() && ! is_page_template( 'page-templates/template-landing-page.php' ) ) {
				echo get_the_post_navigation(
					array(
						'prev_text'    => __( '&larr; %title', 'some-like-it-neat' ),
						'next_text'    => __( '%title &rarr;', 'some-like-it-neat' ),
						'screen_reader_text' => __( 'Page navigation', 'some-like-it-neat' ),
					)
				);
			}
		}

	endif;
	add_action( 'tha_entry_after', 'some_like_it_neat_post_navigation' );
}

if ( ! function_exists( 'some_like_it_neat_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function some_like_it_neat_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_s' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

	}
endif;

if ( ! function_exists( 'some_like_it_neat_post_format_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function some_like_it_neat_post_format_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'some-like-it-neat' ) );
			if ( $categories_list && some_like_it_neat_categorized_blog() ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'some-like-it-neat' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'some-like-it-neat' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'some-like-it-neat' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

/**
 * Add Headroom Script if Offcanvas option is selected
 */
if ( 'offcanvas' === get_theme_mod( 'some-like-it-neat_nav_style' ) ) {
	/**
	 * Adds headroom init function.
	 * Only loads when Offcanvas menu is selected in the customizer.
	 */
	function some_like_it_neat_add_headroomjs() {
		?>
		<script type="text/javascript">
			(function() {
				var header = document.querySelector("header#masthead");

				if(window.location.hash) {
					header.classList.add("headroom--unpinned");
				}

				var headroom = new Headroom(header, {
					tolerance: {
						down : 0,
						up : 0
					},
					offset : 0
				});
				headroom.init();

			}());
		</script>
	<?php }
	// Include Headroom.
	add_action( 'wp_footer', 'some_like_it_neat_add_headroomjs' );

}