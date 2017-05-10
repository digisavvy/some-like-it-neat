<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package some_like_it_neat
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

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'page-templates/template-parts/content', get_post_format() );
				?>

		<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'page-templates/template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
