<?php
/**
 * Offcanvas Navigation Markup
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */
?>

<div class="site-header-inside-wrapper">
    <div class="hamburger-wrapper">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'perennial-pro'); ?></a>
        <a href="#header-menu-responsive" title="<?php esc_attr_e('Menu', 'perennial-pro'); ?>" class="hamburger">
            <span class="hamburger-icon"></span>
            <span class="hamburger-label"><?php echo esc_html(get_theme_mod('some_like_it_neat_mobile_nav_label', 'Menu')); ?></span>
        </a>
    </div><!-- .hamburger-wrapper -->

    <div class="site-branding-wrapper">

        <div class="site-branding">
            <?php if (is_front_page() && is_home() ) : ?>
                <h1 class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

        </div>
    </div><!-- .site-branding-wrapper -->

</div><!-- .site-header-inside-wrapper -->

<nav id="site-navigation" class="main-navigation" role="navigation">
    <div class="main-navigation-inside" style="margin-top: 148px; height: calc(100% - 148px);">
        <?php
        // Header Menu
        wp_nav_menu(
            apply_filters(
                'some-like-it-neat_header_menu_args', array(
                 'container'       => 'div',
                 'container_class' => 'site-header-menu',
                 'theme_location'  => 'primary-navigation',
                 'menu_class'      => 'header-menu',
                 'menu_id'         => 'menu-1',
                 'depth'           => 3,
                ) 
            ) 
        );
        ?>
    </div> <!-- .main-navigation-inside -->
</nav> <!-- #site-navigation -->

<div class="overlay"></div> <!-- .overlay -->

