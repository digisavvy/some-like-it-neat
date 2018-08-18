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

	<?php get_template_part( 'page-templates/template-parts/meta-entry', 'header' ); ?>

	<div class="entry-content" itemprop="articleBody" >

	<?php the_content(); ?>

	</div><!-- .entry-content -->

	<?php get_template_part( 'page-templates/template-parts/meta-entry', 'footer' ); ?>

	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->

<?php tha_entry_after(); ?>
