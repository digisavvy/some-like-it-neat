<?php
/**
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */
?>

<?php tha_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php tha_entry_top(); ?>

	<?php get_template_part( 'page-templates/template-parts/meta-entry', 'header' ); ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>

	<div class="entry-summary">

	<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content">

	<?php
	the_content(
		sprintf(
			__( 'Continue reading%s &rarr;', 'some-like-it-neat' ),
			'<span class="screen-reader-text">  ' . get_the_title() . '</span>'
		)
	);
	?>

	<?php
	wp_link_pages(
		array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'some-like-it-neat' ),
		'after'  => '</div>',
		)
	);
	?>

	</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-meta">

	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

	<?php
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'some-like-it-neat' ) );
	if ( $categories_list && some_like_it_neat_categorized_blog() ) :
	?>

	<span class="cat-links">

	<?php printf( __( 'Posted in %1$s', 'some-like-it-neat' ), $categories_list ); ?>

	</span>

	<?php endif; // End if categories ?>

	<?php
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ', ', 'some-like-it-neat' ) );
	if ( $tags_list ) :
	?>

	<span class="tags-links">

	<?php printf( __( 'Tagged %1$s', 'some-like-it-neat' ), $tags_list ); ?>

	</span>

	<?php endif; // End if $tags_list ?>

	<?php endif; // End if 'post' == get_post_type() ?>

	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>

		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'some-like-it-neat' ), __( '1 Comment', 'some-like-it-neat' ), __( '% Comments', 'some-like-it-neat' ) ); ?></span>

	<?php endif; ?>

	<?php edit_post_link( __( 'Edit', 'some-like-it-neat' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->

<?php tha_entry_after(); ?>
