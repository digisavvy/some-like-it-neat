<?php
/**
 * Header structural elements
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

add_action('some_like_it_neat_header', 'some_like_it_neat_do_header');

function some_like_it_neat_do_header() 
{

    tha_header_before(); ?>

<?php if ('flexnav' === get_theme_mod('some-like-it-neat_nav_style') ) {

        get_template_part('page-templates/template-parts/navigation', 'flexnav');

} else {

    get_template_part('page-templates/template-parts/navigation', 'offcanvas');

}
?>

<?php tha_header_after();

}