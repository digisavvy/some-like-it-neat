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
            <span class="hamburger-label"><?php esc_html_e( 'Menu', 'perennial-pro' ); ?></span>
        </a>
    </div><!-- .hamburger-wrapper -->

    <div class="site-branding-wrapper">
        <?php
        // Site Custom Logo
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
        ?>

        <div class="site-branding">
            <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
                <p class="site-title" <?php // perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) :
                ?>
                <p class="site-description" <?php // perennial_schema( 'site-description' ); ?>><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div>
    </div><!-- .site-branding-wrapper -->

    <?php // if (  perennial_has_sidebar() ) : ?>
        <div class="sidebar-control-wrapper">
            <span class="screen-reader-text"><?php echo esc_html_e( 'Sidebar', 'perennial-pro' ); ?></span>
            <span class="sidebar-control-icon"></span>
        </div><!-- .sidebar-control-wrapper -->
    <?php // endif; ?>
</div><!-- .site-header-inside-wrapper -->

<nav id="site-navigation" class="main-navigation" role="navigation" <?php //perennial_schema( 'site-primary-menu' ); ?>>
    <div class="main-navigation-inside">
        <?php
        // Header Menu
        wp_nav_menu( apply_filters( 'perennial_header_menu_args', array(
            'container'       => 'div',
            'container_class' => 'site-header-menu',
            'theme_location'  => 'header-menu',
            'menu_class'      => 'header-menu',
            'menu_id'         => 'menu-1',
            'depth'           => 3,
        ) ) );
        ?>
    </div><!-- .main-navigation-inside -->
</nav><!-- .main-navigation -->
