<?php
/**
 * Template part for the video post format.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<?php tha_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemprop="video" itemtype="http://schema.org/VideoObject">

	<?php tha_entry_top(); ?>

	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	<?php if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">

			<span class="genericon genericon-time"></span> <?php some_like_it_neat_posted_on(); ?>

		</div><!-- .entry-meta -->

	<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search. ?>

	<div class="entry-summary">

	<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content">

		<?php
		the_content(
			sprintf(
				/* translators: instructs visitor to continue reading content */
				esc_html( 'Continue reading%s &rarr;', 'some-like-it-neat' ),
				'<span class="screen-reader-text">  ' . get_the_title() . '</span>'
			)
		);
		?>

	<?php
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_attr( 'Pages:', 'some-like-it-neat' ),
			'after'  => '</div>',
		)
	);
	?>

	</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-meta">

		<?php some_like_it_neat_post_format_footer(); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) : ?>

			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'some-like-it-neat' ), esc_html( '1 Comment', 'some-like-it-neat' ), __( '% Comments', 'some-like-it-neat' ) ); ?></span>

		<?php endif; ?>

		<?php edit_post_link( esc_html( 'Edit', 'some-like-it-neat' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->

<?php tha_entry_after(); ?>
