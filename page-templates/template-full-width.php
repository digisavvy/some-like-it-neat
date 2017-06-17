<?php
/**
 * Template Name: Full-Width, No Sidebars
 * Template Post Type: post, page
 * This template display content at full with, with no sidebars.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_header(); ?>

<div id="primary" class="content-area">

    <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('page-templates/template-parts/content', 'page'); ?>

    <?php
    // If comments are open or we have at least one comment, load up the comment template
    if (comments_open() || '0' != get_comments_number() ) :
        comments_template();
    endif; ?>

    <?php endwhile; // end of the loop. ?>

</div><!-- #primary -->

<?php get_footer(); ?>
