<?php
/**
 * @package some_like_it_neat
 */
?>

<div class="site-header-inside-wrapper">
    <div class="hamburger-wrapper">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'perennial-pro' ); ?></a>
        <a href="#header-menu-responsive" title="<?php esc_attr_e( 'Menu', 'perennial-pro' ); ?>" class="hamburger">
            <span class="hamburger-icon"></span>
            <span class="hamburger-label"><?php echo esc_html( get_theme_mod( 'some_like_it_neat_mobile_nav_label', 'Menu' ) ); ?></span>
        </a>
    </div><!-- .hamburger-wrapper -->

    <div class="site-branding-wrapper">

        <div class="site-branding">
            <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
                <p class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; ?>

        </div>
    </div><!-- .site-branding-wrapper -->

</div><!-- .site-header-inside-wrapper -->

