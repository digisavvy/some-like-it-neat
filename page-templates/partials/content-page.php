<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package digistarter
 */
?>
<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/WebPage">
	<?php tha_entry_top(); ?>
	<header class="entry-header">

		<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>

	</header><!-- .entry-header -->


	<div class="entry-content" itemprop="mainContentOfPage">

		<?php the_content(); ?>

		<?php if ( function_exists( 'get_the_post_navigation' ) ) {

				echo get_the_post_navigation( array(
					'prev_text'	=> __('&larr; Previous Page', 'digistarter'),
					'next_text'	=> __( 'Next Page &rarr;', 'digistarter'),
					'screen_reader_text' => __( 'Page navigation', 'digistarter' )
				));

			} else {

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'digistarter' ),
					'after'  => '</div>',
					) );

			} ?>


	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'digistarter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
