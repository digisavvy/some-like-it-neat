<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package digistarter
 */
?>
<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php tha_entry_top(); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'digistarter' ),
				'after'  => '</div>',
			) );
		?>
		<?php tha_entry_bottom(); ?>
	</div><!-- .entry-content -->
	<?php tha_entry_bottom(); ?>
	<?php edit_post_link( __( 'Edit', 'digistarter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
