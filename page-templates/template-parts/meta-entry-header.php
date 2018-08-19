<?php
/**
 * Template part for entry headers.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<header class="entry-header">

    <?php if( is_single() ) { ?>	
        <h1 class="entry-title" itemprop="name" >
            <?php the_title(); ?>
        </h1>
    <?php } else { ?>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
    <?php } ?>

    <?php if ( 'post' === get_post_type() ) : ?>

        <?php get_template_part( 'page-templates/template-parts/content', 'meta' ); ?>

    <?php endif; ?>

</header><!-- .entry-header -->