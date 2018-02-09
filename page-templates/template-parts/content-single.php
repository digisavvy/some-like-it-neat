<?php
/**
 * Template part for the single/default post format.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<?php tha_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/BlogPosting">

	<?php tha_entry_top(); ?>

	<header class="entry-header">

		<h1 class="entry-title" itemprop="name" ><?php the_title(); ?></h1>

		<div class="entry-meta">

			<span class="genericon genericon-time"></span> <?php some_like_it_neat_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="articleBody" >

	<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-meta" itemprop="keywords" >

		<?php some_like_it_neat_entry_footer(); ?>

		<?php edit_post_link( __( 'Edit', 'some-like-it-neat' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->

<?php tha_entry_after(); ?>
