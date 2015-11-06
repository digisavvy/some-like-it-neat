<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package some_like_it_neat
 */
?>
	<?php tha_sidebars_before(); ?>

	<div id="secondary" class="widget-area" role="complementary">

		<?php tha_sidebar_top(); ?>

		<?php do_action( 'before_sidebar' ); ?>

		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">

				<?php get_search_form(); ?>

			</aside>

			<aside id="archives" class="widget">

				<h4 class="widget-title"><?php _e( 'Archives', 'some-like-it-neat' ); ?></h4>

				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>

			</aside>

			<aside id="meta" class="widget">

				<h4 class="widget-title"><?php _e( 'Meta', 'some-like-it-neat' ); ?></h4>

				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>

			</aside>

    <?php endif; // end sidebar widget area ?>

    <?php tha_sidebar_bottom(); ?>

	</div><!-- #secondary -->

    <?php tha_sidebars_after(); ?>
