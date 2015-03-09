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
				<h1 class="page-title">
			<?php
			if ( function_exists( 'get_the_archive_title' ) ) :
				echo get_the_archive_title();

				/*
				* TO-DO Might remove this code block at some point, since
				*   get_the_archive_title() does the same thing
				*   the below code does
				*/
						elseif ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
                            * what author we're dealing with (if that is the case).
                            */
							the_post();
							printf( __( 'Author: %s', 'some-like-it-neat' ), '<span class="vcard">' . get_the_author() . '</span>' );
							/* Since we called the_post() above, we need to
                            * rewind the loop back to the beginning that way
                            * we can run the loop properly, in full.
                            */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'some-like-it-neat' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'some-like-it-neat' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'some-like-it-neat' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'some-like-it-neat' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'some-like-it-neat' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'some-like-it-neat' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'some-like-it-neat' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'some-like-it-neat' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'some-like-it-neat' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'some-like-it-neat' );

						elseif ( is_tax() ) :
							+ single_term_title();

						else :
							_e( 'Archives', 'some-like-it-neat' );

						endif;
						/*
                        * END TO-DO
                        */
	?>
				</h1>
				<?php
					// Show an optional term description.
				if ( function_exists( 'get_the_archive_description' ) ) :
					echo '<div class="taxonomy-description">'.get_the_archive_description().'</div>';
					/*
					* TO-DO Might remove this code block at some point, since
					*   get_the_archive_description() does the same thing
					*   the below code does
					*/
					elseif ( $term_description = term_description() ) :
						printf( '<div class="taxonomy-description">%s</div>',     $term_description );
					endif;
				?>
			</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'page-templates/partials/content', get_post_format() );
				?>

		<?php
endwhile; ?>

			<?php else : ?>

			<?php get_template_part( 'page-templates/partials/content', 'none' ); ?>

			<?php
endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
