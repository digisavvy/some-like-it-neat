/* global tinymce, quicktags */

jQuery( function ( $ ) {
	'use strict';

	/**
	 * Update date picker element
	 * Used for static & dynamic added elements (when clone)
	 */
	function update() {
		var $this = $( this ),
			$wrapper = $this.closest( '.wp-editor-wrap' ),
			id = $this.attr( 'id' );

		// Ignore existing editor.
		if ( tinyMCEPreInit.mceInit[id] ) {
			return;
		}

		// Get id of the original editor to get its tinyMCE and quick tags settings
		var originalId = getOriginalId( $this );
		if ( ! originalId ) {
			return;
		}

		// Update the DOM
		$this.show();
		updateDom( $wrapper, id );

		// TinyMCE
		if ( tinyMCEPreInit.mceInit.hasOwnProperty( originalId ) ) {
			var settings = tinyMCEPreInit.mceInit[originalId],
				editor = new tinymce.Editor(id, settings, tinymce.EditorManager);
			editor.render();
		}

		// Quick tags
		if ( typeof quicktags === 'function' && tinyMCEPreInit.qtInit.hasOwnProperty( originalId ) ) {
			var qtSettings = tinyMCEPreInit.qtInit[originalId];
			qtSettings.id = id;
			quicktags( qtSettings );
			QTags._buttonsInit();
		}
	}

	/**
	 * Get original ID of the textarea
	 * The ID will be used to reference to tinyMCE and quick tags settings
	 * @param $el Current cloned textarea
	 */
	function getOriginalId( $el ) {
		var $clone = $el.closest( '.rwmb-clone' ),
			currentId = $clone.find( '.rwmb-wysiwyg' ).attr( 'id' );

		if ( /_\d+$/.test( currentId ) ) {
			currentId = currentId.replace( /_\d+$/, '' );
		}
		if ( tinyMCEPreInit.mceInit.hasOwnProperty( currentId ) || tinyMCEPreInit.qtInit.hasOwnProperty( currentId ) ) {
			return currentId;
		}

		return '';
	}

	/**
	 * Update id, class, [data-] attributes, ... of the cloned editor.
	 * @param $wrapper Editor wrapper element
	 * @param id       Editor ID
	 */
	function updateDom( $wrapper, id ) {
		// Wrapper div and media buttons
		$wrapper.attr( 'id', 'wp-' + id + '-wrap' )
		        .removeClass( 'html-active' ).addClass( 'tmce-active' ) // Active the visual mode by default
		        .find( '.mce-container' ).remove().end()               // Remove rendered tinyMCE editor
		        .find( '.wp-editor-tools' ).attr( 'id', 'wp-' + id + '-editor-tools' )
		        .find( '.wp-media-buttons' ).attr( 'id', 'wp-' + id + '-media-buttons' )
		        .find( 'button' ).data( 'editor', id ).attr( 'data-editor', id );

		// Editor tabs
		$wrapper.find( '.switch-tmce' )
		        .attr( 'id', id + 'tmce' )
		        .data( 'wp-editor-id', id ).attr( 'data-wp-editor-id', id ).end()
		        .find( '.switch-html' )
		        .attr( 'id', id + 'html' )
		        .data( 'wp-editor-id', id ).attr( 'data-wp-editor-id', id );

		// Quick tags
		$wrapper.find( '.wp-editor-container' ).attr( 'id', 'wp-' + id + '-editor-container' )
		        .find( '.quicktags-toolbar' ).attr( 'id', 'qt_' + id + '_toolbar' ).html( '' );
	}

	/**
	 * Handles updating tiny mce instances when saving a gutenberg post.
	 * https://metabox.io/support/topic/data-are-not-saved-into-the-database/
	 * https://github.com/WordPress/gutenberg/issues/7176
	 */
	function ensureSave() {
		if ( ! wp.data || ! wp.data.hasOwnProperty( 'subscribe' ) || ! window.tinyMCE ) {
			return;
		}
		wp.data.subscribe( function() {
			var editor = wp.data.hasOwnProperty( 'select' ) ? wp.data.select( 'core/editor' ) : {};

			if ( editor && editor.isSavingPost && editor.isSavingPost() ) {
				window.tinyMCE.triggerSave();
			}
		} );
	}

	$( '.rwmb-wysiwyg' ).each( update );
	$( document ).on( 'clone', '.rwmb-wysiwyg', update );
	ensureSave();
} );
