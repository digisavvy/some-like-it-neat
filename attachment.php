<?php
/**
 * The template for displaying all attachments.
 *
 * This is the template that displays all attachments by default.
 * Please note that this is the WordPress construct of attachments
 * and that other 'attachments' on your WordPress site will use a
 * different template.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_header(); ?>

    <div id="primary" class="content-area">

        <div id="content" class="site-content">

    <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('page-templates/template-parts/content', 'attachment'); ?>

    <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->

    </div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
