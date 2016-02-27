<?php
/**
 * Template Name: Landing Page, no header, footer, or sidebars
 *
 * This template display content at full with, with no sidebars, header, or footer.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package some_like_it_neat
 */

get_template_part( 'page-templates/template-parts/header', 'landing' ); ?>

 <div id="primary" class="content-area">

 		<?php while ( have_posts() ) : the_post(); ?>

 		<?php get_template_part( 'page-templates/template-parts/content', 'page' ); ?>

 		<?php endwhile; // end of the loop. ?>

 </div><!-- #primary -->

 <?php get_template_part( 'page-templates/template-parts/footer', 'landing' ); ?>
