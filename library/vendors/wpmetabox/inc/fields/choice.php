<?php
/**
 * The abstract choice field.
 *
 * @package Meta Box
 */

/**
 * Abstract class for any kind of choice field.
 */
abstract class RWMB_Choice_Field extends RWMB_Field {
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		return '';
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
				'flatten' => true,
				'options' => array(),
			)
		);

		return $field;
	}

	/**
	 * Transform field options into the verbose format.
	 *
	 * @param array $options Field options.
	 *
	 * @return array
	 */
	public static function transform_options( $options ) {
		$transformed = array();
		$options     = (array) $options;
		foreach ( $options as $value => $label ) {
			$option = is_array( $label ) ? $label : array(
				'label' => (string) $label,
				'value' => (string) $value,
			);
			if ( isset( $option['label'] ) && isset( $option['value'] ) ) {
				$transformed[ $option['value'] ] = (object) $option;
			}
		}
		return $transformed;
	}

	/**
	 * Format a single value for the helper functions. Sub-fields should overwrite this method if necessary.
	 *
	 * @param array    $field   Field parameters.
	 * @param string   $value   The value.
	 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_single_value( $field, $value, $args, $post_id ) {
		$options = self::transform_options( $field['options'] );
		return isset( $options[ $value ] ) ? $options[ $value ]->label : '';
	}
}
