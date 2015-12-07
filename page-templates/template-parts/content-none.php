<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package some_like_it_neat
 */
?>
<?php tha_entry_before(); ?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'some-like-it-neat' ); ?></h1>
	</header><!-- .page-header -->
	<?php tha_content_before(); ?>
	<div class="page-content">
	<?php tha_entry_top(); ?>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'some-like-it-neat' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'some-like-it-neat' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'some-like-it-neat' ); ?></p>

	<?php get_search_form(); ?>

	<?php endif; ?>
	<?php tha_entry_bottom(); ?>
	</div><!-- .page-content -->
	<?php tha_content_after(); ?>
</section><!-- .no-results -->
<?php tha_entry_after(); ?>
