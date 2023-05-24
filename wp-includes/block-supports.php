<?php

/**
 * Generates a string of attributes by applying to the current block being
 * rendered all of the features that the block supports.
 *
 * @since 5.6.0
 *
 * @param string[] $extra_attributes Optional. Array of extra attributes to render on the block wrapper.
 * @return string String of HTML attributes.
 */
function get_block_wrapper_attributes( $extra_attributes = array() ) {
	$new_attributes = WP_Block_Supports::get_instance()->apply_block_supports();

	if ( empty( $new_attributes ) && empty( $extra_attributes ) ) {
		return '';
	}

	// This is hardcoded on purpose.
	// We only support a fixed list of attributes.
	$attributes_to_merge = array( 'style', 'class', 'id' );
	$attributes          = array();
	foreach ( $attributes_to_merge as $attribute_name ) {
		if ( empty( $new_attributes[ $attribute_name ] ) && empty( $extra_attributes[ $attribute_name ] ) ) {
			continue;
		}

		if ( empty( $new_attributes[ $attribute_name ] ) ) {
			$attributes[ $attribute_name ] = $extra_attributes[ $attribute_name ];
			continue;
		}

		if ( empty( $extra_attributes[ $attribute_name ] ) ) {
			$attributes[ $attribute_name ] = $new_attributes[ $attribute_name ];
			continue;
		}

		$attributes[ $attribute_name ] = $extra_attributes[ $attribute_name ] . ' ' . $new_attributes[ $attribute_name ];
	}

	foreach ( $extra_attributes as $attribute_name => $value ) {
		if ( ! in_array( $attribute_name, $attributes_to_merge, true ) ) {
			$attributes[ $attribute_name ] = $value;
		}
	}

	if ( empty( $attributes ) ) {
		return '';
	}

	$normalized_attributes = array();
	foreach ( $attributes as $key => $value ) {
		$normalized_attributes[] = $key . '="' . esc_attr( $value ) . '"';
	}

	return implode( ' ', $normalized_attributes );
}
