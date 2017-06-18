<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_header(); ?>

	<section id="primary" class="content-area">

		<div id="content" class="site-content">

	<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<?php
				printf( '<h1 class="page-title">%s</h1>', esc_html( get_the_archive_title() ) );

				$description = get_the_archive_description();
				if ( ! empty( $description ) ) {
					printf( '<div class="taxonomy-description">%s</div>', esc_html( $description ) );
				} ?>

			</header><!-- .page-header -->

	<?php // Start the loop. ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		/**
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
			get_template_part( 'page-templates/template-parts/content', get_post_format() );
		?>

	<?php endwhile; // end the loop. ?>

	<?php else : ?>

				<?php get_template_part( 'page-templates/template-parts/content', 'none' ); ?>

	<?php endif; ?>

		</div><!-- #content -->

	</section><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
