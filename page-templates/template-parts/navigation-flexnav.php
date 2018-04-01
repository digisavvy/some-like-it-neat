<?php
/**
 * Flexnav Navigation Markup
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<header id="masthead" class="site-header wrap <?php echo get_theme_mod('some-like-it-neat_nav_style'); ?>-nav" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

    <?php tha_header_top(); ?>

    <section class="site-branding">

        <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>

        <div class="site-description"><?php bloginfo( 'description' ); ?></div>

    </section>

    <nav id="primary-nav" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

        <button class="menu-button">

            <span class="dashicons <?php echo esc_attr( get_theme_mod( 'some_like_it_neat_mobile_nav_icon', 'dashicons-menu' ) ); ?>"></span><?php echo esc_attr( get_theme_mod( 'some_like_it_neat_mobile_nav_label', 'Menu' ) ); ?>

        </button>

        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary-navigation',
                'menu_class' => 'flexnav',
                'items_wrap' => '<ul data-breakpoint=" ' . esc_attr( get_theme_mod( 'some_like_it_neat_mobile_min_width', '768' ) ) . ' " id="%1$s" class="%2$s">%3$s</ul>',
            )
        );
        ?>

    </nav><!-- #site-navigation -->

    <?php tha_header_bottom(); ?>

</header><!-- #masthead -->