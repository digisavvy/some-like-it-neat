<?php
/**
 * The template used for displaying attachment (image) content in attachment.php
 *
 * @package some_like_it_neat
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

	<div class="entry-caption">
	<?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>
	<?php if ( ! empty( $post->post_excerpt ) ) {
		the_excerpt();
}
	?>
		<p class='resolutions'> Downloads:
	<?php
	$images = array();
	$image_sizes = get_intermediate_image_sizes();
	array_unshift( $image_sizes, 'full' );
	foreach ( $image_sizes as $image_size ) {
		$image = wp_get_attachment_image_src( get_the_ID(), $image_size );
		$name = $image_size . ' (' . $image[1] . 'x' . $image[2] . ')';
		$images[] = '<a href="' . $image[0] . '">' . $name . '</a>';
	}

	echo implode( ' | ', $images );
	?>
		</p>
	</div>



	</div><!-- .entry-content -->
    <?php edit_post_link( __( 'Edit', 'some-like-it-neat' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
    <?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
