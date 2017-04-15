<?php
/**
 * @package some_like_it_neat
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation">
    <div class="main-navigation-inside" style="margin-top: 148px; height: calc(100% - 148px);">
        <?php
        // Header Menu
        wp_nav_menu( apply_filters( 'some-like-it-neat_header_menu_args', array(
            'container'       => 'div',
            'container_class' => 'site-header-menu',
            'theme_location'  => 'primary-navigation',
            'menu_class'      => 'header-menu',
            'menu_id'         => 'menu-1',
            'depth'           => 3,
        ) ) );
        ?>
    </div> <!-- .main-navigation-inside -->
</nav> <!-- #site-navigation -->

<div class="overlay"></div> <!-- .overlay -->
