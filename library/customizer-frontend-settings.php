<?php
/**
 * Some_like_it_neat functions and definitions
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * Customizer-selected frontend styles.
 */

if ( ! function_exists( 'some_like_it_neat_optional_scripts' ) ) :
	/**
	 * Sets up theme defaults and registers initial states for some customizer settings.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function some_like_it_neat_optional_scripts() {
		// Link Color.
		$link_color = get_theme_mod( 'some_like_it_neat_add_link_color' );
		if ( get_theme_mod( 'some_like_it_neat_add_link_color' ) === $link_color ) { ?>
			<style type="text/css">
				a { color: <?php echo esc_html( $link_color ); ?> !important; }
			</style>
		<?php }

	}
	add_action( 'wp_head', 'some_like_it_neat_optional_scripts' );

endif;

if ( ! function_exists( 'some_like_it_neat_mobile_styles' ) ) :
	/**
	 * Adds ability to hide a dropdown arrow for flexnav navigation option.
	 */
	function some_like_it_neat_mobile_styles() {
		$arrow = get_theme_mod( 'some_like_it_neat_mobile_hide_arrow' );

		if ( get_theme_mod( 'some_like_it_neat_mobile_hide_arrow' ) === $arrow ) { ?>
			<style>
				.menu-button i.navicon {
					display: none;
				}
			</style>
		<?php }
	}
	add_action( 'wp_head', 'some_like_it_neat_mobile_styles' );

endif;

if ( ! function_exists( 'some_like_it_neat_add_footer_divs' ) ) :
	/**
	 * Adds left and right footer modules.
	 */
	function some_like_it_neat_add_footer_divs() {
		?>

		<div class="footer-left">
			<?php echo esc_attr( get_theme_mod( 'some_like_it_neat_footer_left', __( '&copy; All Rights Reserved', 'some-like-it-neat' ) ) ); ?>
		</div>
		<div class="footer-right">
			<?php echo esc_attr( get_theme_mod( 'some_like_it_neat_footer_right', 'Footer Content Right' ) );  ?>
		</div>
		<?php
	}
	add_action( 'tha_footer_bottom', 'some_like_it_neat_add_footer_divs' );

endif;
