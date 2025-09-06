<?php
/**
 * Helper functions for Service logos and rendering contexts.
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Choose the best logo attachment ID for a service based on context.
 */
function smoothmigration_get_service_logo_id( int $post_id, string $context = 'card' ): int {
	$primary = (int) get_post_meta( $post_id, '_service_logo_primary', true );
	$on_light = (int) get_post_meta( $post_id, '_service_logo_on_light', true );
	$on_dark = (int) get_post_meta( $post_id, '_service_logo_on_dark', true );
	$square = (int) get_post_meta( $post_id, '_service_logo_square', true );

	switch ( $context ) {
		case 'hero':
		case 'dark':
			if ( $on_dark ) return $on_dark;
			if ( $primary ) return $primary;
			break;
		case 'square':
		case 'badge':
			if ( $square ) return $square;
			if ( $primary ) return $primary;
			break;
		case 'list':
		case 'card':
		default:
			if ( $on_light ) return $on_light;
			if ( $primary ) return $primary;
			// Fallbacks to ensure a logo appears on listings even if only dark/square variants exist
			if ( $on_dark ) return $on_dark;
			if ( $square ) return $square;
	}

	return (int) get_post_thumbnail_id( $post_id );
}

/**
 * Render an <img> tag for a logo in a given context.
 */
function smoothmigration_get_service_logo( int $post_id, string $context = 'card', $size = 'medium', array $attrs = array() ): string {
	$logo_id = smoothmigration_get_service_logo_id( $post_id, $context );
	if ( $logo_id ) {
		return wp_get_attachment_image( $logo_id, $size, false, $attrs );
	}
	return '';
}


