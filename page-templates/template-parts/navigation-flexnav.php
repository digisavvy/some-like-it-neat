<?php
/**
 * @package some_like_it_neat
 */
?>

<nav id="primary-nav" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
    <button class="menu-button">
        <span class="dashicons <?php echo get_theme_mod( 'some_like_it_neat_mobile_nav_icon', 'dashicons-menu' ); ?>"></span><?php echo get_theme_mod( 'some_like_it_neat_mobile_nav_label', 'Menu' ); ?>
    </button>
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'primary-navigation',
            'menu_class' => 'flexnav', //Adding the class for FlexNav
            'items_wrap' => '<ul data-breakpoint=" '. esc_attr( get_theme_mod( 'some_like_it_neat_mobile_min_width', '768' ) ) .' " id="%1$s" class="%2$s">%3$s</ul>', // Adding data-breakpoint for FlexNav
        )
    );
    ?>

</nav><!-- #site-navigation -->

