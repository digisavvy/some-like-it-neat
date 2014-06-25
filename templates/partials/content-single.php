<?php
/**
 * @package digistarter
 */
?>
<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/BlogPosting">
	<?php tha_entry_top(); ?>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="name" ><?php the_title(); ?></h1>

		<div class="entry-meta">

			<span class="genericon genericon-time"></span> <?php digistarter_posted_on(); ?>

		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="articleBody" >
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'digistarter' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-meta" itemprop="keywords" >
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'digistarter' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'digistarter' ) );

			if ( ! digistarter_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'digistarter' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'digistarter' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'digistarter' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'digistarter' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
