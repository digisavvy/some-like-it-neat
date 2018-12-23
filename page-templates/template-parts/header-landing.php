<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

?>

<!DOCTYPE html>

<?php tha_html_before(); ?>

<html <?php language_attributes(); ?>>

<head>

	<?php tha_head_top(); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<style type="text/css">

	<?php if ( 'no' === get_theme_mod( 'some-like-it-neat_post_format_support' ) ) : ?>
		h1.entry-title:before {
			display: none;
		}
	<?php endif; ?>

	</style>

	<?php tha_head_bottom(); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php tha_body_top(); ?>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'some-like-it-neat' ); ?></a>

	<?php tha_header_before(); ?>

	<?php tha_header_top(); ?>

	<?php tha_header_after(); ?>

	<?php tha_content_before(); ?>

		<main id="main" class="site-main wrap" role="main">

	<?php tha_content_top(); ?>
