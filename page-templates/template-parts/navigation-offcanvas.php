<?php
/**
 * @package some_like_it_neat
 */
?>

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
