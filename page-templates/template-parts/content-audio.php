<?php
/**
 * @package some_like_it_neat
 */
?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/AudioObject">
	<?php tha_entry_top(); ?>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="genericon genericon-time"></span> <?php some_like_it_neat_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
	<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
	<?php
	the_content(
		sprintf(
			__( 'Continue reading%s &rarr;', 'some-like-it-neat' ),
			'<span class="screen-reader-text">  '.get_the_title().'</span>'
		)
	);
	?>

	<?php
	wp_link_pages(
		array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'some-like-it-neat' ),
				'after'  => '</div>',
		)
	);
	?>
	</div><!-- .entry-content -->
	<?php
endif; ?>

	<footer class="entry-meta">
	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
	<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'some-like-it-neat' ) );
	if ( $categories_list && some_like_it_neat_categorized_blog() ) :
	?>
	<span class="cat-links">
	<?php printf( __( 'Posted in %1$s', 'some-like-it-neat' ), $categories_list ); ?>
	</span>
	<?php
	endif; // End if categories ?>

	<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'some-like-it-neat' ) );
	if ( $tags_list ) :
	?>
	<span class="tags-links">
	<?php printf( __( 'Tagged %1$s', 'some-like-it-neat' ), $tags_list ); ?>
	</span>
	<?php
	endif; // End if $tags_list ?>
	<?php
endif; // End if 'post' == get_post_type() ?>

	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'some-like-it-neat' ), __( '1 Comment', 'some-like-it-neat' ), __( '% Comments', 'some-like-it-neat' ) ); ?></span>
	<?php
endif; ?>

	<?php edit_post_link( __( 'Edit', 'some-like-it-neat' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
