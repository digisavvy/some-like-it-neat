/*!
 * Custom v1.0
 * Contains handlers for the offcanvas menu
 *
 * @package some_like_it_neat
 * Code generously borrowed with modification from https://designorbital.com
 */

 ( function( $ ) {

    'use strict';

    var slin = {

        // Site Menu
        menuInit: function() {

            // Add dropdown toggle that display child menu items.
            $('.site-header-menu .page_item_has_children > a, .site-header-menu .menu-item-has-children > a').append('<button class="dropdown-toggle" aria-expanded="false"/>');
            $('.site-header-menu .dropdown-toggle').off('click').on(
                'click', function( e ) {
                    e.preventDefault();
                    $(this).toggleClass('toggle-on');
                    $(this).parent().next('.children, .sub-menu').toggleClass('toggle-on');
                    $(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'false' ? 'true' : 'false');
                } 
            );

        },

        // Off-Canvas Menu
        offCanvasMenuInit: function() {

            // Elements
            var siteHeader = $('.site-header');
            var mainNav    = $('.main-navigation-inside');

            // Off-Canvas Menu Logic
            setTimeout(
                function() {

                        var siteHeaderHeight = siteHeader.outerHeight();
                        mainNav.css(
                            {
                                'margin-top' : siteHeaderHeight,
                                'height'     : 'calc(100% - ' + siteHeaderHeight+ 'px)'
                            }
                        );

                }, 500 
            );

        },

        // Overlay
        overlayInit: function() {

            // Elements
            var overlay      = $('.overlay');
            var hamburger    = $('.hamburger');
            var sidebarOpen  = $('.sidebar-control-wrapper');
            var sidebarClose = $('.sidebar-close-control');

            // Hamburger Event
            hamburger.off('click').on(
                'click', function( e ) {

                    // Prevent Default
                    e.preventDefault();
                    e.stopPropagation();

                    // Overlay Action
                    slin.overlayActionInit('menu');

                } 
            );

            // Sidebar Open Event
            sidebarOpen.off('click').on(
                'click', function( e ) {

                    // Prevent Default
                    e.preventDefault();
                    e.stopPropagation();

                    // Overlay Action
                    slin.overlayActionInit('sidebar');

                } 
            );

            // Sidebar CLose Event
            sidebarClose.off('click').on(
                'click', function() {
                    slin.overlayActionInit('close');
                } 
            );

            // Overlay Event
            overlay.off('click').on(
                'click', function() {
                    slin.overlayActionInit('close');
                } 
            );

        },

        // Overlay Action
        overlayActionInit: function( overlayAction ) {

            // Elements
            var body         = $('body');
            var hamburger    = $('.hamburger');
            var sidebarClose = $('.sidebar-close-control');

            // If the overlay already opened.
            if (body.hasClass('has-overlay-open') ) {

                // Reset Menu Classes
                hamburger.removeClass('active');
                body.removeClass('has-menu-open');

                // Reset Sidebar Classes
                body.removeClass('has-sidebar-open');
                sidebarClose.removeClass('active');

                // Reset Overlay
                body.removeClass('has-overlay-open');

            } else {

                if ('menu' === overlayAction ) {

                    // Set Menu Classes
                    hamburger.addClass('active');
                    body.addClass('has-menu-open');

                    // Set Overlay Class
                    body.addClass('has-overlay-open');

                } else if ('sidebar' === overlayAction ) {

                    // Set Sidebar Classes
                    body.addClass('has-sidebar-open');
                    setTimeout(
                        function() {
                                sidebarClose.addClass('active');
                        }, 1000 
                    );

                    // Set Overlay Class
                    body.addClass('has-overlay-open');

                }

            }

        }

    };

    // Document Ready
    $(document).ready(
        function() {

                // Menu
                slin.menuInit();

                // Off-Canvas Menu
                slin.offCanvasMenuInit();


                // Overlay
                slin.overlayInit();


        } 
    );

    // Window Resize
    $(window).on(
        'debouncedresize', function() {

            // Off-Canvas Menu
            slin.offCanvasMenuInit();

        }
    );
    

    // Document Keyup
    $(document).keyup(
        function( e ) {

                // Escape Key
            if (e.keyCode === 27 ) {

                // Make the escape key to close the menu
                slin.overlayActionInit('esc');

            }

        } 
    );

} )( jQuery );
