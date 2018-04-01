<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>
	<?php tha_sidebars_before(); ?>

	<div id="secondary" class="widget-area" role="complementary">

	<?php tha_sidebar_top(); ?>

	<?php do_action( 'before_sidebar' ); ?>

	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) :

		return;

	endif; // End sidebar widget area. ?>

	<?php tha_sidebar_bottom(); ?>

	</div><!-- #secondary -->

	<?php tha_sidebars_after(); ?>
