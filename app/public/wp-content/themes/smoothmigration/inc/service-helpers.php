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

	// Explicit admin-selected overrides from Service Tools
	if ( $context === 'list' ) {
		$override_list = (int) get_post_meta( $post_id, '_service_image_list_override', true );
		if ( $valid( $override_list ) ) {
			return $override_list;
		}
	}
	if ( $context === 'dark' || $context === 'hero' || $context === 'header' ) {
		$override_header = (int) get_post_meta( $post_id, '_service_image_header_override', true );
		if ( $valid( $override_header ) ) {
			return $override_header;
		}
	}

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

	// Try taxonomy-backed fallback using sm_asset_type tags (service-*, type-*, brand-logo)
	if ( function_exists( 'smoothmigration_pick_best_logo_candidate' ) ) {
		$tax_id = (int) smoothmigration_pick_best_logo_candidate( $post_id, $context );
		if ( $valid( $tax_id ) ) {
			return $tax_id;
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

/**
 * Get a service's canonical slug, falling back to post_name/title when meta is absent.
 */
function smoothmigration_get_service_canonical_slug( int $service_id ): string {
	$slug = (string) get_post_meta( $service_id, '_service_canonical', true );
	if ( $slug === '' ) {
		$p = get_post( $service_id );
		if ( $p ) {
			$slug = sanitize_title( (string) ( $p->post_name ?: $p->post_title ) );
		}
	}
	return $slug;
}

/**
 * Tag an attachment for a Service using sm_asset_type taxonomy.
 * Terms applied:
 * - brand-logo
 * - service-{canonical-slug}
 * - type-{service_type_slug}
 *
 * Terms are appended (non-destructive).
 */
function smoothmigration_tag_attachment_for_service( int $attachment_id, int $service_id ): void {
	if ( get_post_type( $attachment_id ) !== 'attachment' ) {
		return;
	}

	$terms = array( 'brand-logo' );

	// Ensure Service-specific term exists and add it
	$service_slug = smoothmigration_get_service_canonical_slug( $service_id );
	if ( $service_slug ) {
		$service_term_slug = 'service-' . $service_slug;
		if ( ! term_exists( $service_term_slug, 'sm_asset_type' ) ) {
			wp_insert_term(
				'Service: ' . ucwords( str_replace( '-', ' ', $service_slug ) ),
				'sm_asset_type',
				array( 'slug' => $service_term_slug )
			);
		}
		$terms[] = $service_term_slug;
	}

	// Ensure Type term exists and add it
	$type_slugs = wp_get_post_terms( $service_id, 'service_type', array( 'fields' => 'slugs' ) );
	if ( ! empty( $type_slugs ) ) {
		$type_slug = (string) $type_slugs[0];
		$type_term_slug = 'type-' . $type_slug;
		if ( ! term_exists( $type_term_slug, 'sm_asset_type' ) ) {
			$term_obj = get_term_by( 'slug', $type_slug, 'service_type' );
			$label = $term_obj ? $term_obj->name : ucwords( str_replace( '-', ' ', $type_slug ) );
			wp_insert_term(
				'Type: ' . $label,
				'sm_asset_type',
				array( 'slug' => $type_term_slug )
			);
		}
		$terms[] = $type_term_slug;
	}

	// Append terms without removing any existing Asset Type terms on the attachment
	wp_set_object_terms( $attachment_id, $terms, 'sm_asset_type', true );
}


/**
 * Build candidate logo attachments from sm_asset_type tags for a service.
 */
function smoothmigration_get_service_logo_candidates( int $service_id ): array {
	$slug = smoothmigration_get_service_canonical_slug( $service_id );
	$brand_title = (string) get_the_title( $service_id );
	$brand_title_lower = strtolower( $brand_title );
	$brand_slug = (string) $slug;

	// Helper to build candidate array from IDs
	$build_candidates = static function( array $ids ): array {
		$out = array();
		foreach ( $ids as $aid ) {
			$mime = (string) get_post_mime_type( $aid );
			if ( $mime && strpos( $mime, 'image/' ) !== 0 && $mime !== 'image/svg+xml' ) {
				continue;
			}
			$file_rel = (string) get_post_meta( $aid, '_wp_attached_file', true );
			$basename = $file_rel ? basename( $file_rel ) : sanitize_title( (string) get_the_title( $aid ) );
			$variant  = function_exists( 'smoothmigration_classify_logo_variant' )
				? smoothmigration_classify_logo_variant( $basename )
				: ( preg_match( '/(white|light|invert|inverted)/i', $basename ) ? 'on_dark'
					: ( preg_match( '/(black|dark|color|regular)/i', $basename ) ? 'on_light'
						: ( preg_match( '/(square|icon|badge|mark)/i', $basename ) ? 'square' : 'primary' ) ) );
			$out[] = array(
				'id'      => (int) $aid,
				'variant' => $variant,
				'mime'    => $mime,
				'name'    => $basename,
			);
		}
		return $out;
	};

	// 1) Strict: attachments tagged for THIS service (brand-logo AND service-{slug})
	$strict_ids = get_posts( array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'numberposts'    => -1,
		'fields'         => 'ids',
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'sm_asset_type',
				'field'    => 'slug',
				'terms'    => array( 'brand-logo' ),
			),
			array(
				'taxonomy' => 'sm_asset_type',
				'field'    => 'slug',
				'terms'    => array( 'service-' . $slug ),
			),
		),
	) );
	if ( ! empty( $strict_ids ) ) {
		return $build_candidates( $strict_ids );
	}

	// 2) Fallback: brand-logo assets filtered by brand tokens in title or filename
	$broad_ids = get_posts( array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'numberposts'    => -1,
		'fields'         => 'ids',
		's'              => $brand_title,
		'tax_query'      => array(
			array(
				'taxonomy' => 'sm_asset_type',
				'field'    => 'slug',
				'terms'    => array( 'brand-logo' ),
			),
		),
	) );

	$filtered = array();
	foreach ( $broad_ids as $aid ) {
		$title = strtolower( (string) get_the_title( $aid ) );
		$file_rel = (string) get_post_meta( $aid, '_wp_attached_file', true );
		$basename = strtolower( $file_rel ? basename( $file_rel ) : '' );
		$compact  = str_replace( array( ' ', '-' ), '', $brand_title_lower );
		if (
			( $brand_title_lower !== '' && ( strpos( $title, $brand_title_lower ) !== false || strpos( $basename, $brand_title_lower ) !== false ) )
			|| ( $brand_slug !== '' && ( strpos( $title, $brand_slug ) !== false || strpos( $basename, $brand_slug ) !== false ) )
			|| ( $compact !== '' && ( strpos( $title, $compact ) !== false || strpos( $basename, $compact ) !== false ) )
		) {
			$filtered[] = $aid;
		}
	}
	if ( ! empty( $filtered ) ) {
		return $build_candidates( $filtered );
	}

	// 3) Last resort: any attachment strictly tagged with service-{slug}
	$service_only_ids = array();
	if ( $slug ) {
		$service_only_ids = get_posts( array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'numberposts'    => -1,
			'fields'         => 'ids',
			'tax_query'      => array(
				array(
					'taxonomy' => 'sm_asset_type',
					'field'    => 'slug',
					'terms'    => array( 'service-' . $slug ),
				),
			),
		) );
	}
	return $build_candidates( $service_only_ids );
}

/**
 * Pick the best candidate by context and file type.
 */
function smoothmigration_pick_best_logo_candidate( int $service_id, string $context = 'card' ): int {
	$candidates = smoothmigration_get_service_logo_candidates( $service_id );
	if ( empty( $candidates ) ) {
		return 0;
	}

	// Variant weights per context
	switch ( $context ) {
		case 'dark':
		case 'hero':
			$vw = array( 'on_dark' => 100, 'primary' => 80, 'square' => 70, 'on_light' => 60 );
			break;
		case 'square':
		case 'badge':
			$vw = array( 'square' => 100, 'primary' => 80, 'on_light' => 70, 'on_dark' => 60 );
			break;
		case 'list':
		case 'card':
		default:
			$vw = array( 'on_light' => 100, 'primary' => 80, 'square' => 70, 'on_dark' => 60 );
			break;
	}

	$mw = array(
		'image/svg+xml' => 50,
		'image/png'     => 40,
		'image/webp'    => 35,
		'image/jpeg'    => 30,
		'image/gif'     => 10,
	);

	$best = 0; $best_score = -1;
	foreach ( $candidates as $c ) {
		$variant = isset( $c['variant'] ) ? (string) $c['variant'] : 'primary';
		$mime    = isset( $c['mime'] ) ? (string) $c['mime'] : '';
		$score   = (int) ( $vw[ $variant ] ?? 50 ) + (int) ( $mw[ $mime ] ?? 20 );
		if ( isset( $c['name'] ) && stripos( (string) $c['name'], 'logo' ) !== false ) {
			$score += 3;
		}
		if ( $score > $best_score ) {
			$best_score = $score;
			$best = (int) $c['id'];
		}
	}
	return $best;
}

/**
 * Derive sm_asset_type terms from a filename.
 * Examples: [brand-logo], [banner, banner-300x250], [animated], [format-png]
 */
function smoothmigration_get_asset_type_terms( string $filename ): array {
    $terms = array();
    $f = strtolower( $filename );
    $ext = strtolower( (string) pathinfo( $filename, PATHINFO_EXTENSION ) );

    if ( $ext !== '' ) {
        $terms[] = 'format-' . $ext;
    }

    // Brand logo signals
    if ( preg_match( '/\b(logo|brand|mark|icon)\b/i', $f ) ) {
        $terms[] = 'brand-logo';
    }

    // Banner/creative signals (GDN sizes, common ad dimensions, or keywords)
    $dimension_terms = array();
    if ( preg_match_all( '/(\d{2,4})[xX](\d{2,4})/', $f, $matches, PREG_SET_ORDER ) ) {
        foreach ( $matches as $m ) {
            $w = isset( $m[1] ) ? (string) $m[1] : '';
            $h = isset( $m[2] ) ? (string) $m[2] : '';
            if ( $w !== '' && $h !== '' ) {
                $dimension_terms[] = 'banner-' . $w . 'x' . $h;
            }
        }
    }
    if ( ! empty( $dimension_terms ) || strpos( $f, 'banner' ) !== false || strpos( $f, 'gdn' ) !== false || preg_match( '/\b(ad|ads)\b/i', $f ) ) {
        $terms[] = 'banner';
        $terms = array_merge( $terms, $dimension_terms );
    }

    // Animated
    if ( $ext === 'gif' ) {
        $terms[] = 'animated';
    }

    return array_values( array_unique( $terms ) );
}

