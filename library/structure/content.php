<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

// Before Content Markup
function some_like_it_neat_do_before_content() 
{

    tha_content_before(); ?>

    <main id="main" class="site-main wrap" role="main">

        <?php tha_content_top();

}
add_action('some_like_it_neat_before_content', 'some_like_it_neat_do_before_content');

// After Content Markup
function some_like_it_neat_do_after_content() 
{

    tha_content_bottom(); ?>

    </main><!-- #main -->

<?php tha_content_after();

}
add_action('some_like_it_neat_after_content', 'some_like_it_neat_do_after_content');