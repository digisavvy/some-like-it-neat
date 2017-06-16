<?php
/**
 * some_like_it_neat header structural elements
 *
 * @package some_like_it_neat
 * @author  Alex Vasquez
 * @license GPL-2.0+
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

add_action( 'some_like_it_neat_header', 'some_like_it_neat_do_header' );

function some_like_it_neat_do_header() {

tha_header_before(); ?>

    <header id="masthead" class="site-header wrap <?php echo get_theme_mod( 'some-like-it-neat_nav_style' ); ?>-nav" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

        <?php tha_header_top(); ?>

        <?php if ( 'flexnav' === get_theme_mod( 'some-like-it-neat_nav_style' ) ) {

            get_template_part( 'page-templates/template-parts/navigation', 'flexnav' );

        } else {

            get_template_part( 'page-templates/template-parts/navigation', 'offcanvas' );

        }
        ?>

        <?php tha_header_bottom(); ?>

    </header><!-- #masthead -->

<?php tha_header_after();

}