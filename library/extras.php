<?php
/**
 * Functions for single post/page navigation
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

/**
 * Add Singular Post Template Navigation
 */
if (! function_exists('some_like_it_neat_post_navigation') ) :

    function some_like_it_neat_post_navigation() 
    {
        if (is_singular() && !is_page_template('page-templates/template-landing-page.php')  ) {
            echo get_the_post_navigation(
                array(
                    'prev_text'    => __('&larr; %title', 'some-like-it-neat'),
                    'next_text'    => __('%title &rarr;', 'some-like-it-neat'),
                    'screen_reader_text' => __('Page navigation', 'some-like-it-neat')
                )
            );
        }
    }

endif;
add_action('tha_entry_after', 'some_like_it_neat_post_navigation');
