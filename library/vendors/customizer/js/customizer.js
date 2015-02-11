/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	//Display Option
	wp.customize( 'tcx_display_header', function( value ) {
	    value.bind( function( to ) {
	        false === to ? $( '#header' ).hide() : $( '#header' ).show();
	    } );
	} );

	wp.customize( 'tcx_color_scheme', function( value ) {
	    value.bind( function( to ) {

	        if ( 'inverse' === to ) {

	            $( 'body' ).css({
	                background: '#000',
	                color:      '#fff'
	            });

	        } else {

	            $( 'body' ).css({
	                background: '#fff',
	                color:      '#000'
	            });

	        }

	    });
	});

	wp.customize( 'tcx_font', function( value ) {
	    value.bind( function( to ) {

	        switch( to.toString().toLowerCase() ) {

	            case 'times':
	                sFont = 'Times New Roman';
	                break;

	            case 'arial':
	                sFont = 'Arial';
	                break;

	            case 'courier':
	                sFont = 'Courier New, Courier';
	                break;

	            case 'helvetica':
	                sFont = 'Helvetica';
	                break;

	            default:
	                sFont = 'Times New Roman';
	                break;

	        }

	        $( 'body' ).css({
	            fontFamily: sFont
	        });

	    });

	});

	wp.customize( 'some_like_it_neat_footer_left', function( value ) {
	    value.bind( function( to ) {
	        $( '.footer-left' ).text( to );
	    });
	});
	wp.customize( 'some_like_it_neat_footer_right', function( value ) {
	    value.bind( function( to ) {
	        $( '.footer-right' ).text( to );
	    });
	});

} )( jQuery );
