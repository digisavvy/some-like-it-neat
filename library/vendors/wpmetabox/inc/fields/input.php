<?php
/**
 * The abstract input field which is used for all <input> fields.
 *
 * @package Meta Box
 */

/**
 * Abstract input field class.
 */
abstract class RWMB_Input_Field extends RWMB_Field {
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$attributes = self::call( 'get_attributes', $field, $meta );
		return sprintf( '<input %s>%s', self::render_attributes( $attributes ), self::datalist( $field ) );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'autocomplete' => false,
				'size'         => 30,
				'datalist'     => false,
				'readonly'     => false,
			)
		);
		if ( $field['datalist'] ) {
			$field['datalist'] = wp_parse_args(
				$field['datalist'],
				array(
					'id'      => $field['id'] . '_list',
					'options' => array(),
				)
			);
		}
		return $field;
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes = parent::get_attributes( $field, $value );
		$attributes = wp_parse_args(
			$attributes,
			array(
				'autocomplete' => $field['autocomplete'],
				'list'         => $field['datalist'] ? $field['datalist']['id'] : false,
				'readonly'     => $field['readonly'],
				'value'        => $value,
				'placeholder'  => $field['placeholder'],
				'type'         => $field['type'],
				'size'         => $field['size'],
			)
		);

		return $attributes;
	}

	/**
	 * Create datalist, if any.
	 *
	 * @param array $field Field parameters.
	 * @return string
	 */
	protected static function datalist( $field ) {
		if ( empty( $field['datalist'] ) ) {
			return '';
		}

		$datalist = $field['datalist'];
		$html     = sprintf( '<datalist id="%s">', $datalist['id'] );
		foreach ( $datalist['options'] as $option ) {
			$html .= sprintf( '<option value="%s"></option>', $option );
		}
		$html .= '</datalist>';
		return $html;
	}
}
