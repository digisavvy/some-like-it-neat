<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to some_like_it_neat_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php tha_comments_before(); ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">

		<?php
		$comment_count = get_comments_number();
		if ( 1 === $comment_count ) {
			printf(
				/* translators: 1: title. */
				esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', '_s' ),
				'<span>' . get_the_title() . '</span>'
			);
		} else {
			printf( // WPCS: XSS OK.
				/* translators: 1: comment count number, 2: title. */
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', '_s' ) ),
				number_format_i18n( $comment_count ),
				'<span>' . get_the_title() . '</span>'
			);
		}
		?>

		</h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

		<nav id="comment-nav-above" class="comment-navigation" role="navigation">

			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'some-like-it-neat' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'some-like-it-neat' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'some-like-it-neat' ) ); ?></div>

		</nav><!-- #comment-nav-above -->

	<?php endif; ?>

		<ol class="comment-list">

	<?php
	/**
	 * Loop through and list the comments. Tell wp_list_comments()
	 * to use some_like_it_neat_comment() to format the comments.
	 * If you want to override this in a child theme, then you can
	 * define some_like_it_neat_comment() and that will be used instead.
	 * See some_like_it_neat_comment() in inc/template-tags.php for more.
	 */
	wp_list_comments(
		array(
			'callback' => 'some_like_it_neat_comment',
		)
	);
	?>

		</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

		<nav id="comment-nav-below" class="comment-navigation" role="navigation">

			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'some-like-it-neat' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'some-like-it-neat' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'some-like-it-neat' ) ); ?></div>


		</nav><!-- #comment-nav-below -->
	<?php endif; ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'some-like-it-neat' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->

<?php tha_comments_after(); ?>
