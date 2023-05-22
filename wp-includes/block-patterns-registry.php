<?php

/**
 * Registers a new pattern category.
 *
 * @since 5.5.0
 *
 * @param string $category_name       Pattern category name including namespace.
 * @param array  $category_properties List of properties for the block pattern.
 *                                    See WP_Block_Pattern_Categories_Registry::register() for
 *                                    accepted arguments.
 * @return bool True if the pattern category was registered with success and false otherwise.
 */
function register_block_pattern_category( $category_name, $category_properties ) {
	return WP_Block_Pattern_Categories_Registry::get_instance()->register( $category_name, $category_properties );
}

/**
 * Unregisters a pattern category.
 *
 * @since 5.5.0
 *
 * @param string $category_name Pattern category name including namespace.
 * @return bool True if the pattern category was unregistered with success and false otherwise.
 */
function unregister_block_pattern_category( $category_name ) {
	return WP_Block_Pattern_Categories_Registry::get_instance()->unregister( $category_name );
}
