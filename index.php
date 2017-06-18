<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<div id="content" class="site-content">

	<?php if ( have_posts() ) : ?>

	<?php // start of the loop. ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		/**
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */

			get_template_part( 'page-templates/template-parts/content', get_post_format() );
		?>

	<?php endwhile; // end of the loop. ?>

	<?php else : ?>

	<?php get_template_part( 'page-templates/template-parts/content', 'none' ); ?>

	<?php endif; ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
