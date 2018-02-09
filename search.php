<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_header(); ?>

<section id="primary" class="content-area">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header><!-- .page-header -->

		<?php // Start of the loop. ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'page-templates/template-parts/content', 'search' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php else : ?>

		<?php get_template_part( 'page-templates/template-parts/content', 'none' ); ?>

	<?php endif; ?>

</section><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
