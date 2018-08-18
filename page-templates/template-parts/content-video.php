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

	<?php get_template_part( 'page-templates/template-parts/meta-entry', 'header' ); ?>

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

	<?php get_template_part( 'page-templates/template-parts/meta-entry', 'footer' ); ?>

	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->

<?php tha_entry_after(); ?>
