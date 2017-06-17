<?php
/**
 * Some Like it Neat functions and definitions
 *
 * @package Some_Like_It_Neat
 * @author  Alex Vasquez <alex@digisavvy.com>
 * @license GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link    https://github.com/digisavvy/some-like-it-neat
 *
 * The $some_like_it_neat_includes array includes a variety of scripts, styles, and functions among other
 * useful utilities for your theme.
 *
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * You don't have to include your code in these include files. You can insert your own code below as well.
 *
 * @link https://github.com/digisavvy/some-like-it-neat/commit/636baf7e8b2fefdcf79fd518622f35fa933c7e2f
 */

$some_like_it_neat_includes = [
    'library/assets.php',    // Scripts and stylesheets
    'library/widgets.php',    // Widgets
    'library/theme-setup.php',  // Theme setup
    'library/extras.php',    // Extra and nifty things
    'library/vendor.php',   // 3rd party scripts/code etc.
    'library/customizer-frontend-settings.php', // Theme customizer related
    'library/structure/header.php', // Include header markup, supports beaver themer
    'library/structure/footer.php', // Include footer markup, supports beaver themer
    'library/structure/content.php' // Include content area markup, supports beaver themer
];

foreach ($some_like_it_neat_includes as $file) {

    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'some_like_it_neat'), $file), E_USER_ERROR);
    }

    include_once $filepath;

}
unset($file, $filepath);