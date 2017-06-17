<?php
/**
 * some_like_it_neat footer structural elements
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 */

add_action('some_like_it_neat_footer', 'some_like_it_neat_do_footer');

function some_like_it_neat_do_footer() 
{

    tha_footer_before(); ?>

    <footer id="colophon" class="site-footer wrap" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

        <?php tha_footer_top(); ?>

        <section class="site-info">

            <?php do_action('some_like_it_neat_credits'); ?>

            <?php if ('no' === get_theme_mod('some-like-it-neat_hide_WordPress_credits') ) : ?>
                <a class="wordpress" href="http://wordpress.org/" rel="generator"><?php printf(__('Proudly powered by %s WordPress', 'some-like-it-neat'), '<span class="genericon genericon-wordpress"></span>'); ?></a>
                <span class="sep"> | </span>
            <?php endif; ?>

            <?php echo esc_attr(get_theme_mod('some_like_it_neat_footer_colophon', __('Some Like it Neat, by Alex Vasquez', 'some-like-it-neat')));  ?><br />

            <?php tha_footer_bottom(); ?>

        </section><!-- .site-info -->

    </footer><!-- #colophon -->

<?php tha_footer_after();

}

