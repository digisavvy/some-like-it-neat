/*!
 * Custom v1.0
 * Contains handlers for the different site functions
 *
 * Copyright (c) 2013-2016 DesignOrbital.com
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

( function( $ ) {

    var perennial = {

        // Site Menu
        menuInit: function() {

            // Add dropdown toggle that display child menu items.
            $( '.site-header-menu .page_item_has_children > a, .site-header-menu .menu-item-has-children > a' ).append( '<button class="dropdown-toggle" aria-expanded="false"/>' );
            $( '.site-header-menu .dropdown-toggle' ).off( 'click' ).on( 'click', function( e ) {
                e.preventDefault();
                $( this ).toggleClass( 'toggle-on' );
                $( this ).parent().next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
                $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            } );

        },

        // Off-Canvas Menu
        offCanvasMenuInit: function() {

            // Elements
            var siteHeader = $( '.site-header' );
            var mainNav    = $( '.main-navigation-inside' );

            // Off-Canvas Menu Logic
            setTimeout( function() {

                var siteHeaderHeight = siteHeader.outerHeight();
                mainNav.css({
                    'margin-top' : siteHeaderHeight,
                    'height'     : 'calc(100% - ' + siteHeaderHeight+ 'px)'
                });

            }, 500 );

        },

        // Site Hero Mouse
        siteHeroMouseInit: function() {

            $( '.site-hero-mouse-control' ).off( 'click' ).on( 'click', function( e ) {

                // Prevent Default
                e.preventDefault();
                e.stopPropagation();

                // Button Action
                $( 'html, body' ).animate({
                    scrollTop: $( '.site-content' ).offset().top
                }, 1000);

            } );

        },

        // Overlay
        overlayInit: function() {

            // Elements
            var overlay      = $( '.overlay' );
            var hamburger    = $( '.hamburger' );
            var sidebarOpen  = $( '.sidebar-control-wrapper' );
            var sidebarClose = $( '.sidebar-close-control' );

            // Hamburger Event
            hamburger.off( 'click' ).on( 'click', function( e ) {

                // Prevent Default
                e.preventDefault();
                e.stopPropagation();

                // Overlay Action
                perennial.overlayActionInit( 'menu' );

            } );

            // Sidebar Open Event
            sidebarOpen.off( 'click' ).on( 'click', function( e ) {

                // Prevent Default
                e.preventDefault();
                e.stopPropagation();

                // Overlay Action
                perennial.overlayActionInit( 'sidebar' );

            } );

            // Sidebar CLose Event
            sidebarClose.off( 'click' ).on( 'click', function() {
                perennial.overlayActionInit( 'close' );
            } );

            // Overlay Event
            overlay.off( 'click' ).on( 'click', function() {
                perennial.overlayActionInit( 'close' );
            } );

        },

        // Overlay Action
        overlayActionInit: function( overlayAction ) {

            // Elements
            var body         = $( 'body' );
            var hamburger    = $( '.hamburger' );
            var sidebarClose = $( '.sidebar-close-control' );

            // If the overlay already opened.
            if ( body.hasClass( 'has-overlay-open' ) ) {

                // Reset Menu Classes
                hamburger.removeClass( 'active' );
                body.removeClass( 'has-menu-open' );

                // Reset Sidebar Classes
                body.removeClass( 'has-sidebar-open' );
                sidebarClose.removeClass( 'active' );

                // Reset Overlay
                body.removeClass( 'has-overlay-open' );

            } else {

                if ( 'menu' === overlayAction ) {

                    // Set Menu Classes
                    hamburger.addClass( 'active' );
                    body.addClass( 'has-menu-open' );

                    // Set Overlay Class
                    body.addClass( 'has-overlay-open' );

                } else if ( 'sidebar' === overlayAction ) {

                    // Set Sidebar Classes
                    body.addClass( 'has-sidebar-open' );
                    setTimeout( function() {
                        sidebarClose.addClass( 'active' );
                    }, 1000 );

                    // Set Overlay Class
                    body.addClass( 'has-overlay-open' );

                }

            }

        },

        // Site Hero Init
        siteHeroInit: function( siteHeroAction ) {

            // For Android OS
            var ua = navigator.userAgent.toLowerCase();
            var isAndroid = ua.indexOf( 'android' ) > -1;
            if ( isAndroid ) {

                // Elements
                var siteHeroWrapper   = $( '.site-hero-wrapper' );
                var siteHeroImg       = $( '.entry-image-site-hero' );
                var postWrapperSingle = $( '.post-wrapper-single' );

                if ( 'orientationchange' === siteHeroAction ) {

                    // Remove Class
                    siteHeroWrapper.removeClass( 'hero-transition' );
                    siteHeroImg.removeClass( 'hero-transition' );
                    postWrapperSingle.removeClass( 'hero-single-transition' );

                    // Add Class
                    setTimeout( function() {

                        siteHeroWrapper.addClass( 'hero-transition' );
                        siteHeroImg.addClass( 'hero-transition' );
                        postWrapperSingle.addClass( 'hero-single-transition' );

                    }, 1000 );

                } else {

                    // Add Class
                    siteHeroWrapper.addClass( 'hero-transition' );
                    siteHeroImg.addClass( 'hero-transition' );
                    postWrapperSingle.addClass( 'hero-single-transition' );

                }

            }

        },

        // Widget Logic
        widgetLogicInit: function() {

            // Social Menu Widget
            $( '.widget_nav_menu > div[class^="menu-social-"] > ul > li > a' ).wrapInner( '<span class="screen-reader-text"></span>' );

            // Custom Menu Widget
            $( '.widget_nav_menu .menu-item-has-children > a' ).append( '<span class="custom-menu-toggle" aria-expanded="false"></span>' );
            $( '.widget_nav_menu .custom-menu-toggle' ).off( 'click' ).on( 'click', function( e ) {
                e.preventDefault();
                $( this ).toggleClass( 'toggle-on' );
                $( this ).parent().next( '.sub-menu' ).toggleClass( 'toggle-on' );
                $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            } );

            // Pages Widget
            $( '.widget_pages .page_item_has_children > a' ).append( '<span class="page-toggle" aria-expanded="false"></span>' );
            $( '.widget_pages .page-toggle' ).off( 'click' ).on( 'click', function( e ) {
                e.preventDefault();
                $( this ).toggleClass( 'toggle-on' );
                $( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
                $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            } );

            // Categories Widget
            $( '.widget_categories' ).find( '.children' ).parent().addClass( 'category_item_has_children' );
            $( '.widget_categories .category_item_has_children > a' ).append( '<span class="category-toggle" aria-expanded="false"></span>' );
            $( '.widget_categories .category-toggle' ).off( 'click' ).on( 'click', function( e ) {
                e.preventDefault();
                $( this ).toggleClass( 'toggle-on' );
                $( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
                $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            } );

        }
    };

    // Document Ready
    $( document ).ready( function() {

        // Menu
        perennial.menuInit();

        // Off-Canvas Menu
        perennial.offCanvasMenuInit();

        // Site Hero Mouse
        perennial.siteHeroMouseInit();

        // Overlay
        perennial.overlayInit();

        // Site Hero
        perennial.siteHeroInit( 'ready' );

        // Widgets
        perennial.widgetLogicInit();

    } );

    // Window Resize
    $( window ).on( 'debouncedresize', function() {

        // Off-Canvas Menu
        perennial.offCanvasMenuInit();

    });

    // Listen for orientation changes
    $( window ).on( 'orientationchange', function() {

        // Site Hero
        perennial.siteHeroInit( 'orientationchange' );

    });


    // Document Keyup
    $( document ).keyup( function( e ) {

        // Escape Key
        if ( e.keyCode === 27 ) {

            // Make the escape key to close the menu
            perennial.overlayActionInit( 'esc' );

        }

    } );

} )( jQuery );
