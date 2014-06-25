<?php
/**
 * @package digistarter
 */
?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
	<?php tha_entry_top(); ?>
	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'digistarter' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'digistarter' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( is_single() ) : ?>
			<?php digistarter_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>

			<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

		<?php else : ?>
			<div class="entry-meta">
				<span class="genericon genericon-time"></span> <?php digistarter_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php edit_post_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>
		<?php endif; // is_single() ?>
	</footer><!-- .entry-meta -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post -->
<?php tha_entry_after(); ?>
