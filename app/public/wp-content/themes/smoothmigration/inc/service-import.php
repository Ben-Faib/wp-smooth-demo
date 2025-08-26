<?php
/**
 * Service Importer: Create/Update Service posts from uploaded brand logos
 *
 * - Ensures the 6 overarching `service_type` terms exist
 * - Scans uploads/services-logos/usa for brand files
 * - Creates/updates `service` posts per brand and assigns the best-fit type
 * - Attempts to attach a featured image by matching an existing media item by filename/title
 * - Sets affiliate links and rich content for known partners
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ensure core service_type terms exist.
 */
function smoothmigration_ensure_core_service_terms(): void {
	$terms = array(
		'realtor' => 'Realtor Locator',
		'money-services' => 'Banking Services',
		'telecommunication' => 'Telecommunication',
		'vehicles' => 'Vehicle Services',
		'international-moving' => 'International Moving',
		'insurance' => 'Insurance',
	);

	foreach ( $terms as $slug => $name ) {
		if ( ! term_exists( $slug, 'service_type' ) ) {
			wp_insert_term( $name, 'service_type', array( 'slug' => $slug ) );
		}
	}
}

/**
 * Guess a `service_type` slug from a filename.
 */
function smoothmigration_guess_type_from_filename( string $filename ): string {
    $lower = strtolower( $filename );
    // Priority keyword mapping for known brands
    $map = array(
        // Banking Services
        'wise' => 'money-services',
        'remit' => 'money-services',
        'chime' => 'money-services',
        'bank' => 'money-services',
        'homeloan' => 'money-services',
        'home loan' => 'money-services',

        // Telecommunication
        'verizon' => 'telecommunication',
        'visible' => 'telecommunication',
        'boost' => 'telecommunication',
        'mobile' => 'telecommunication',

        // Vehicles
        'carvana' => 'vehicles',
        'avis' => 'vehicles',
        'discovercars' => 'vehicles',
        'car ' => 'vehicles',

        // International Moving
        'sirelo' => 'international-moving',
        'intercoastal' => 'international-moving',
        'trigl' => 'international-moving',
        'move' => 'international-moving',

        // Insurance
        'lemonade' => 'insurance',
        'figo' => 'insurance',
        'visitor' => 'insurance',
        'visitors' => 'insurance',
        'insur' => 'insurance',

        // Realtor
        'realtor' => 'realtor',
    );

    foreach ( $map as $needle => $slug ) {
        if ( $needle !== '' && str_contains( $lower, $needle ) ) {
            return $slug;
        }
    }

    // Default fallback
    return 'insurance';
}

/**
 * Map arbitrary text (filename/title) to a canonical brand name and slug.
 */
function smoothmigration_map_canonical_brand( string $text ): array {
    $t = strtolower( $text );
    $map = array(
        // canonical => needles
        'Airalo' => array('airalo'),
        'Boost Mobile' => array('boost mobile', 'boost'),
        'Visible' => array('visible'),
        'Verizon' => array('verizon'),
        'Chime' => array('chime'),
        'Visitors Coverage' => array('visitorscoverage', 'visitors coverage', 'visitor insurance', 'visitors'),
        'Lemonade' => array('lemonade'),
        'Figo Pet Insurance' => array('figo'),
        'International AutoSource' => array('intlauto', 'international auto', 'auto source'),
        'Rentcars' => array('rentcars', 'discovercars'),
        'Wise' => array('wise', 'transferwise'),
        'Remitly' => array('remitly'),
        'XE Money Transfer' => array('xe'),
        'Experts in Moving' => array('experts in moving', 'sirelo', 'intercoastal', 'trigl'),
    );
    foreach ( $map as $canonical => $needles ) {
        foreach ( $needles as $needle ) {
            if ( $needle && str_contains( $t, $needle ) ) {
                return array( $canonical, sanitize_title( $canonical ) );
            }
        }
    }
    // Fallback: strip trailing digits and normalize
    $base = preg_replace('/\s+\d+$/', '', trim($text));
    $canonical = ucwords( $base );
    return array( $canonical, sanitize_title( $canonical ) );
}

/**
 * Classify a logo filename into a variant slot.
 * Returns one of: primary|on_light|on_dark|square
 */
function smoothmigration_classify_logo_variant( string $filename ): string {
    $f = strtolower( $filename );
    // square/badge first
    if ( preg_match('/(square|icon|badge|mark)/i', $f) ) {
        return 'square';
    }
    // dark background logos often contain 'white', 'light', 'invert'
    if ( preg_match('/(white|light|invert|inverted)/i', $f) ) {
        return 'on_dark';
    }
    // light background versions
    if ( preg_match('/(black|dark|color|regular)/i', $f) ) {
        return 'on_light';
    }
    return 'primary';
}

/**
 * Convert filename to a readable brand title.
 */
function smoothmigration_brand_title_from_filename( string $filename ): string {
	$base = pathinfo( $filename, PATHINFO_FILENAME );
	$base = preg_replace( '/[_-]+/', ' ', $base );
	$base = preg_replace( '/\s+usa\b/i', '', $base );
	$base = trim( $base );
	return ucwords( $base );
}

/**
 * Try to find an attachment ID by matching filename or title.
 */
function smoothmigration_find_attachment_id_by_filename( string $filename ): int {
	global $wpdb;
	$like = '%' . $wpdb->esc_like( $filename ) . '%';
	$attachment_id = (int) $wpdb->get_var( $wpdb->prepare(
		"SELECT post_id FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
		 WHERE pm.meta_key = '_wp_attached_file' AND pm.meta_value LIKE %s AND p.post_type = 'attachment' LIMIT 1",
		$like
	) );
	if ( $attachment_id ) {
		return $attachment_id;
	}
	// Fallback: search by sanitized title guess
	$title_guess = smoothmigration_brand_title_from_filename( $filename );
	$attachment = get_page_by_title( $title_guess, OBJECT, 'attachment' );
	return $attachment ? (int) $attachment->ID : 0;
}

/**
 * Create or update a Service post and set taxonomy + featured image when available.
 */
function smoothmigration_upsert_service_from_logo( string $filename, string $absolute_dir ): void {
	$brand_title = smoothmigration_brand_title_from_filename( $filename );
	$type_slug = smoothmigration_guess_type_from_filename( $filename );

	// Known affiliate links mapping (from user-provided list)
	$affiliate_map = array(
		'Airalo' => 'https://airalo.pxf.io/7m4YGA',
		'Boost Mobile' => 'https://boostmobile.sjv.io/5bvKPn',
		'Visible' => 'https://visible.pxf.io/WD7BJZ',
		'Chime' => 'https://chime.pxf.io/7aOqAd',
		'Visitors Coverage' => 'https://visitorscoverageinc.pxf.io/Qjbxvz',
		'Lemonade' => 'https://imp.i146998.net/xk33Vdlemonade',
		'Figo Pet Insurance' => 'https://figopetinsurance.com/?p=J9H5C',
		'International AutoSource' => 'https://go.intlauto.com/smooth-migration.html',
		'Rentcars' => 'https://www.rentcars.com/en/?requestorid=9323&utm_source=smoothmigration.ca&utm_medium=afiliado',
		'Wise' => 'https://wise.prf.hn/click/camref:1011lq4nL',
		'Remitly' => 'https://remitly.tod8mp.net/Jr6DAv',
		'XE Money Transfer' => 'https://xe-money-transfer.sjv.io/9WNvNe',
		'Experts in Moving' => 'https://www.expertsinmoving.com/?so=a&ca=8ddabfceef8192200632f66a00293f9c',
	);

	// Normalization helpers
    list($resolved_brand, $canonical_slug) = smoothmigration_map_canonical_brand( $brand_title );

    // Find an existing canonical post without deleting others
    $post_id = 0;
    $existing_posts = get_posts( array(
        'post_type' => 'service',
        'posts_per_page' => 1,
        'meta_query' => array(
            array('key' => '_service_canonical', 'value' => $canonical_slug, 'compare' => '=')
        ),
        'fields' => 'ids'
    ) );
    if ( ! empty( $existing_posts ) ) {
        $post_id = (int) $existing_posts[0];
    } else {
        $existing = get_page_by_title( $resolved_brand, OBJECT, 'service' );
        $post_id = $existing ? (int) $existing->ID : 0;
    }
	// Rich intro content scaffold
	$why = 'We recommend this partner for consistent quality, transparent pricing, and strong expat support.';
	$what = 'Comprehensive solutions tailored to international relocations, with digital-first onboarding and global coverage.';
	$since = 'Serving customers for years with positive reviews across major platforms.';
	$content = '<div class="service-rich">'
		. '<h2>About ' . esc_html( $resolved_brand ) . '</h2>'
		. '<p>' . esc_html( $what ) . '</p>'
		. '<h3>Why Smooth Migration Recommends</h3>'
		. '<p>' . esc_html( $why ) . '</p>'
		. '<h3>Track Record</h3>'
		. '<p>' . esc_html( $since ) . '</p>'
		. '</div>';

    $postarr = array(
        'post_title' => $resolved_brand,
		'post_content' => $content,
		'post_status' => 'publish',
		'post_type' => 'service',
        'post_name' => $canonical_slug,
	);

    if ( $post_id ) {
		$postarr['ID'] = $post_id;
		$post_id = wp_update_post( $postarr );
	} else {
		$post_id = wp_insert_post( $postarr );
	}

	if ( ! $post_id || is_wp_error( $post_id ) ) {
		return;
	}

	// Assign taxonomy
	wp_set_object_terms( $post_id, $type_slug, 'service_type', false );

    // Attach logo as a variant based on filename hints
    $attachment_id = smoothmigration_find_attachment_id_by_filename( $filename );
    if ( $attachment_id ) {
        $slot = smoothmigration_classify_logo_variant( $filename );
        switch ( $slot ) {
            case 'on_dark':
                if ( ! get_post_meta( $post_id, '_service_logo_on_dark', true ) ) {
                    update_post_meta( $post_id, '_service_logo_on_dark', $attachment_id );
                }
                break;
            case 'on_light':
                if ( ! get_post_meta( $post_id, '_service_logo_on_light', true ) ) {
                    update_post_meta( $post_id, '_service_logo_on_light', $attachment_id );
                }
                break;
            case 'square':
                if ( ! get_post_meta( $post_id, '_service_logo_square', true ) ) {
                    update_post_meta( $post_id, '_service_logo_square', $attachment_id );
                }
                break;
            case 'primary':
            default:
                if ( ! get_post_meta( $post_id, '_service_logo_primary', true ) ) {
                    update_post_meta( $post_id, '_service_logo_primary', $attachment_id );
                }
                break;
        }
        // Set featured image only if none exists
        if ( ! has_post_thumbnail( $post_id ) ) {
            set_post_thumbnail( $post_id, $attachment_id );
        }
    }

	// Set affiliate URL when known
	foreach ( $affiliate_map as $brand => $url ) {
		if ( strtolower( $resolved_brand ) === strtolower( $brand ) ) {
			update_post_meta( $post_id, '_service_affiliate_url', esc_url_raw( $url ) );
			break;
		}
	}
    // Persist canonical for dedupe
    update_post_meta( $post_id, '_service_canonical', $canonical_slug );
}

/**
 * Import all services from uploads/services-logos/usa
 */
function smoothmigration_import_services_from_logos(): array {
	smoothmigration_ensure_core_service_terms();

	$absolute_dir = trailingslashit( WP_CONTENT_DIR ) . 'uploads/services-logos/usa';
	if ( ! is_dir( $absolute_dir ) ) {
		return array( 'success' => false, 'message' => 'Filesystem logo folder not found. Use the Media Library importer instead.' );
	}

	$files = array_values( array_filter( scandir( $absolute_dir ), function( $f ) use ( $absolute_dir ) {
		return ! in_array( $f, array( '.', '..' ), true ) && is_file( $absolute_dir . DIRECTORY_SEPARATOR . $f );
	} ) );

	$count = 0;
	foreach ( $files as $file ) {
		smoothmigration_upsert_service_from_logo( $file, $absolute_dir );
		$count++;
	}

	return array( 'success' => true, 'message' => sprintf( 'Processed %d filesystem logo files.', $count ) );
}

/**
 * Import services by scanning the Media Library for likely brand logos.
 */
function smoothmigration_import_services_from_media_library(): array {
	smoothmigration_ensure_core_service_terms();

	$keywords = array(
		'wise','remit','remitly','chime','bank','homeloan','home loan','xe',
		'verizon','visible','boost','mobile',
		'carvana','avis','discovercars','rentcars','intlauto','international auto',
		'sirelo','intercoastal','trigl','experts in moving','move',
		'lemonade','figo','visitor','visitors','insur',
		'airalo','realtor'
	);

	$attachments = get_posts( array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'posts_per_page' => -1,
		'post_status'    => 'inherit',
		'fields'         => 'ids',
		'tax_query'      => array(
			array(
				'taxonomy' => 'sm_asset_type',
				'field'    => 'slug',
				'terms'    => array( 'brand-logo' ),
			),
		),
	) );

	$processed = 0; $skipped = 0;
	foreach ( $attachments as $att_id ) {
		$file_rel = get_post_meta( $att_id, '_wp_attached_file', true );
		$filename = $file_rel ? basename( $file_rel ) : basename( (string) get_attached_file( $att_id ) );
		$title    = get_the_title( $att_id );
		$haystack = strtolower( $filename . ' ' . $title );
		$matched  = false;
		foreach ( $keywords as $k ) { if ( $k !== '' && strpos( $haystack, strtolower( $k ) ) !== false ) { $matched = true; break; } }
		if ( ! $matched ) { $skipped++; continue; }
		smoothmigration_upsert_service_from_logo( $filename, '' );
		$processed++;
	}

	return array( 'success' => true, 'message' => sprintf( 'Processed %d Brand Logo attachments, skipped %d.', $processed, $skipped ) );
}

/**
 * Admin page to trigger import.
 */
function smoothmigration_register_service_importer_menu(): void {
	add_management_page(
		'Import Services from Logos',
		'Import Services from Logos',
		'manage_options',
		'smoothmigration-service-importer',
		'smoothmigration_render_service_importer_page'
	);
}
add_action( 'admin_menu', 'smoothmigration_register_service_importer_menu' );

// Ensure core terms are present on init so front-end links work even before import.
add_action( 'init', 'smoothmigration_ensure_core_service_terms' );

function smoothmigration_render_service_importer_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}
    if ( isset( $_POST['smoothmigration_consolidate'] ) && check_admin_referer( 'smoothmigration_service_import' ) ) {
        // Consolidate by moving logos from duplicate posts into variant slots on a single canonical post.
        $grouped = array();
        $services = get_posts( array( 'post_type' => 'service', 'numberposts' => -1 ) );
        foreach ( $services as $p ) {
            list($brand, $slug) = smoothmigration_map_canonical_brand( $p->post_title );
            $grouped[$slug] = $grouped[$slug] ?? array();
            $grouped[$slug][] = $p;
        }
        $removed = 0; $updated = 0;
        foreach ( $grouped as $slug => $posts ) {
            if ( count($posts) < 2 ) continue;
            // Choose the earliest post as canonical
            usort($posts, function($a,$b){ return strtotime($a->post_date_gmt) <=> strtotime($b->post_date_gmt); });
            $canonical = array_shift($posts);
            $cid = $canonical->ID;
            update_post_meta( $cid, '_service_canonical', $slug );
            foreach ( $posts as $dup ) {
                $did = $dup->ID;
                // Try to capture its featured image into a free variant slot
                $thumb = (int) get_post_thumbnail_id( $did );
                if ( $thumb ) {
                    // Heuristic from title for variant placement
                    $slot = smoothmigration_classify_logo_variant( $dup->post_title );
                    if ( $slot === 'on_dark' && ! get_post_meta($cid,'_service_logo_on_dark',true) ) update_post_meta($cid,'_service_logo_on_dark',$thumb);
                    elseif ( $slot === 'on_light' && ! get_post_meta($cid,'_service_logo_on_light',true) ) update_post_meta($cid,'_service_logo_on_light',$thumb);
                    elseif ( $slot === 'square' && ! get_post_meta($cid,'_service_logo_square',true) ) update_post_meta($cid,'_service_logo_square',$thumb);
                    elseif ( ! get_post_meta($cid,'_service_logo_primary',true) ) update_post_meta($cid,'_service_logo_primary',$thumb);
                }
                wp_delete_post( $did, true );
                $removed++;
            }
            // Normalize canonical title/slug
            wp_update_post( array('ID'=>$cid,'post_name'=>$slug,'post_title'=>smoothmigration_map_canonical_brand($canonical->post_title)[0]) );
            $updated++;
        }
        echo '<div class="notice notice-success"><p>Consolidated services by brand. Updated canonicals: '.intval($updated).', Removed extra posts: '.intval($removed).'.</p></div>';
    }
	if ( isset( $_POST['smoothmigration_delete_all_services'] ) && check_admin_referer( 'smoothmigration_service_import' ) ) {
		$deleted = 0;
		$services = get_posts( array( 'post_type' => 'service', 'numberposts' => -1, 'fields' => 'ids' ) );
		foreach ( $services as $sid ) {
			wp_delete_post( $sid, true );
			$deleted++;
		}
		echo '<div class="notice notice-warning"><p>Deleted ' . intval( $deleted ) . ' service posts. Service Types preserved.</p></div>';
	}
	if ( isset( $_POST['smoothmigration_run_import'] ) && check_admin_referer( 'smoothmigration_service_import' ) ) {
		$result = smoothmigration_import_services_from_media_library();
		$message = $result['message'] ?? '';
		$ok = ! empty( $result['success'] );
		echo '<div class="notice notice-' . ( $ok ? 'success' : 'error' ) . '"><p>' . esc_html( $message ) . '</p></div>';
	}
	?>
	<div class="wrap">
		<h1>Import Services from Media Library</h1>
		<p>This tool creates/updates Service posts by scanning your Media Library for brand logos (Wise, XE, Lemonade, etc.). It auto-assigns the Service Type and attaches the logo.</p>
		<p><strong>How to use:</strong> Upload brand logos to the Media Library, set <em>Asset Type</em> to <strong>Brand Logo</strong> on each logo, then click <em>Run Import from Media Library</em>. Filenames like <code>wise.png</code> help with matching.</p>
		<form method="post" style="margin-bottom:1rem;">
			<?php wp_nonce_field( 'smoothmigration_service_import' ); ?>
			<p><input type="submit" name="smoothmigration_delete_all_services" class="button button-secondary" value="Delete ALL Services (keep Service Types)" onclick="return confirm('Delete all service posts? This cannot be undone.');"></p>
		</form>
        <form method="post" style="margin-bottom:1rem;">
            <?php wp_nonce_field( 'smoothmigration_service_import' ); ?>
            <p><input type="submit" name="smoothmigration_consolidate" class="button" value="Consolidate Services by Brand (merge logos, keep one)"></p>
        </form>
		<form method="post">
			<?php wp_nonce_field( 'smoothmigration_service_import' ); ?>
			<p><input type="submit" name="smoothmigration_run_import" class="button button-primary" value="Run Import from Media Library"></p>
		</form>
	</div>
	<?php
}


