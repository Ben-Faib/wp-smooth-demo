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
	$primary    = (int) get_post_meta( $post_id, '_service_logo_primary', true );
	$on_light   = (int) get_post_meta( $post_id, '_service_logo_on_light', true );
	$on_dark    = (int) get_post_meta( $post_id, '_service_logo_on_dark', true );
	$square     = (int) get_post_meta( $post_id, '_service_logo_square', true );
	$company_id = (int) get_post_meta( $post_id, '_service_company_logo', true );

	// Helper to validate an attachment ID is usable for an <img>
	$valid = static function( $attachment_id ): bool {
		$attachment_id = (int) $attachment_id;
		if ( ! $attachment_id ) return false;
		$attachment = get_post( $attachment_id );
		if ( ! $attachment || $attachment->post_type !== 'attachment' ) return false;
		$mime = get_post_mime_type( $attachment_id );
		if ( ! $mime ) return true;
		if ( strpos( $mime, 'image/' ) === 0 ) return true;
		if ( $mime === 'image/svg+xml' ) return true;
		return false;
	};

	// Build candidate lists by context, preferring variants suitable for background
	$candidates = array();
	switch ( $context ) {
		case 'hero':
		case 'dark':
			$candidates = array( $on_dark, $primary, $square, $on_light, $company_id );
			break;
		case 'square':
		case 'badge':
			$candidates = array( $square, $primary, $on_light, $on_dark, $company_id );
			break;
		case 'list':
		case 'card':
		default:
			// On light backgrounds prefer on_light/primary, then square before dark for better contrast
			$candidates = array( $on_light, $primary, $square, $on_dark, $company_id );
			break;
	}

	foreach ( $candidates as $candidate_id ) {
		if ( $valid( $candidate_id ) ) {
			return (int) $candidate_id;
		}
	}

	$thumb = (int) get_post_thumbnail_id( $post_id );
	if ( $valid( $thumb ) ) {
		return $thumb;
	}

	return 0;
}

/**
 * Render an <img> tag for a logo in a given context.
 */
function smoothmigration_get_service_logo( int $post_id, string $context = 'card', $size = 'medium', array $attrs = array() ): string {
	$logo_id = smoothmigration_get_service_logo_id( $post_id, $context );
	if ( $logo_id ) {
		$mime = get_post_mime_type( $logo_id );
		$render_size = ( $mime === 'image/svg+xml' ) ? 'full' : $size;
		return wp_get_attachment_image( $logo_id, $render_size, false, $attrs );
	}
	// Final fallback to featured image if available
	$thumb_id = get_post_thumbnail_id( $post_id );
	if ( $thumb_id ) {
		return wp_get_attachment_image( $thumb_id, $size, false, $attrs );
	}
	return '';
}


/**
 * Locate a likely Brand Logo attachment for a service using its canonical slug or title.
 * Helps when variant meta is not yet set on the post.
 */
// (Intentionally no media-library fallback; logos must be assigned via logo variant meta or featured image.)

