<?php
/**
 * Template part for footer metas.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<?php if ( 'post' === get_post_type() ) : ?>
    <footer class="entry-meta" itemprop="keywords" >

        <?php some_like_it_neat_footer(); ?>

        <?php edit_post_link( __( 'Edit Post', 'some-like-it-neat' ), '<div class="edit-link">', '</div>' ); ?>

    </footer><!-- .entry-meta -->
<?php endif; ?>