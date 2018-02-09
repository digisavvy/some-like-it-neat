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
 * Initializing Flexnav Menu System
 */
if ( ! function_exists( 'dg_add_flexnav' ) && ( 'flexnav' === get_theme_mod( 'some-like-it-neat_nav_style' ) ) ) :
	/**
	 * Adds Flexnav menu but only if flexnav is selected in the customizer.
	 */
	function dg_add_flexnav() {
		?>
		<script>
			// Init Flexnav Menu
			jQuery(document).ready(function($){
				$(".flexnav").flexNav({
					'animationSpeed' : 250, // default drop animation speed
					'transitionOpacity': true, // default opacity animation
					'buttonSelector': '.menu-button', // default menu button class
					'hoverIntent': true, // use with hoverIntent plugin
					'hoverIntentTimeout': 350, // hoverIntent default timeout
					'calcItemWidths': false // dynamically calcs top level nav item widths
				});
			});
		</script>
		<?php
	}
	add_action( 'wp_footer', 'dg_add_flexnav' );
endif;
