<?php
/**
 * Template Name: Landing Page, no header, footer, or sidebars
 * Template Post Type: post, page
 * This template display content at full with, with no sidebars, header, or footer.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

get_template_part( 'page-templates/template-parts/header', 'landing' ); ?>

 <div id="primary" class="content-area">

	<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'page-templates/template-parts/content', 'page' ); ?>

	<?php endwhile; // End of the loop. ?>

 </div><!-- #primary -->

	<?php get_template_part( 'page-templates/template-parts/footer', 'landing' ); ?>
