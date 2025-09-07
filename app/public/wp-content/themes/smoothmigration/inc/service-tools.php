<?php
/**
 * Service Tools: Unified admin utilities for Services
 * - Bulk Import (reuses existing handlers)
 * - Single Service Delete
 * - Multi Service Delete
 * - Service Type Delete (deletes services in selected types, preserves the terms)
 * - Full Delete (deletes all service posts, preserves service types)
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Service Tools page under Tools.
 */
function smoothmigration_register_service_tools_menu() {
	add_management_page(
		'Service Tools',
		'Service Tools',
		'manage_options',
		'smoothmigration-service-tools',
		'smoothmigration_render_service_tools_page'
	);
}
add_action( 'admin_menu', 'smoothmigration_register_service_tools_menu' );

/**
 * Hide legacy individual menu items so everything lives under Service Tools.
 */
function smoothmigration_hide_legacy_service_tool_menus() {
	// Slugs registered elsewhere that we want to keep functional but hide from the Tools menu
	remove_submenu_page( 'tools.php', 'smoothmigration-bulk-import' );
	remove_submenu_page( 'tools.php', 'smoothmigration-service-importer' );
}
add_action( 'admin_menu', 'smoothmigration_hide_legacy_service_tool_menus', 999 );

/**
 * AJAX: search services by name and/or service type query.
 * Returns: [{ id, title, types: 'Type A, Type B' }]
 */
function smoothmigration_ajax_search_services() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Insufficient permissions.' ), 403 );
	}
	check_ajax_referer( 'smoothmigration_service_tools', 'nonce' );

	$q = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
	$max = 50;

	$ids = array();

	// 1) Title search
	$by_title = get_posts( array(
		'post_type' => 'service',
		's' => $q,
		'posts_per_page' => $max,
		'fields' => 'ids',
		'post_status' => 'any',
	) );
	foreach ( $by_title as $pid ) { $ids[ $pid ] = true; }

	// 2) Service type search (match term by name via search, then pull posts in those terms)
	if ( $q !== '' ) {
		$matched_terms = get_terms( array(
			'taxonomy' => 'service_type',
			'hide_empty' => false,
			'number' => 20,
			'search' => $q,
		) );
		if ( ! is_wp_error( $matched_terms ) && ! empty( $matched_terms ) ) {
			$term_ids = wp_list_pluck( $matched_terms, 'term_id' );
			$by_tax = get_posts( array(
				'post_type' => 'service',
				'posts_per_page' => $max,
				'fields' => 'ids',
				'post_status' => 'any',
				'tax_query' => array(
					array(
						'taxonomy' => 'service_type',
						'field' => 'term_id',
						'terms' => $term_ids,
					),
				),
			) );
			foreach ( $by_tax as $pid ) { $ids[ $pid ] = true; }
		}
	}

	$ids = array_keys( $ids );
	if ( empty( $ids ) ) {
		wp_send_json_success( array() );
	}

	$items = array();
	foreach ( $ids as $pid ) {
		$title = get_the_title( $pid );
		$terms = get_the_terms( $pid, 'service_type' );
		$type_names = $terms && ! is_wp_error( $terms ) ? implode( ', ', wp_list_pluck( $terms, 'name' ) ) : '';
		$items[] = array(
			'id' => $pid,
			'title' => $title,
			'types' => $type_names,
		);
	}

	// Sort by title asc for stability
	usort( $items, function( $a, $b ) {
		return strcasecmp( (string) $a['title'], (string) $b['title'] );
	} );

	wp_send_json_success( $items );
}
add_action( 'wp_ajax_smoothmigration_search_services', 'smoothmigration_ajax_search_services' );

/**
 * Collect attachment IDs related to a Service post (logo variants + featured image).
 */
function smoothmigration_get_service_attachment_ids( int $service_id ): array {
	$keys = array( '_service_logo_primary', '_service_logo_on_light', '_service_logo_on_dark', '_service_logo_square', '_service_company_logo' );
	$ids_map = array();
	foreach ( $keys as $k ) {
		$val = (int) get_post_meta( $service_id, $k, true );
		if ( $val ) { $ids_map[ $val ] = true; }
	}
	$thumb = (int) get_post_thumbnail_id( $service_id );
	if ( $thumb ) { $ids_map[ $thumb ] = true; }
	return array_map( 'intval', array_keys( $ids_map ) );
}

/**
 * Determine whether an attachment is still referenced by any other Service post.
 */
function smoothmigration_is_attachment_used_by_other_services( int $attachment_id, array $exclude_service_ids = array() ): bool {
	// Check other Service posts via logo meta and featured image
	$args = array(
		'post_type' => 'service',
		'post_status' => 'any',
		'posts_per_page' => 1,
		'fields' => 'ids',
	);
	if ( ! empty( $exclude_service_ids ) ) {
		$args['post__not_in'] = array_map( 'intval', $exclude_service_ids );
	}
	$meta_query = array( 'relation' => 'OR' );
	foreach ( array( '_service_logo_primary', '_service_logo_on_light', '_service_logo_on_dark', '_service_logo_square', '_service_company_logo', '_thumbnail_id' ) as $k ) {
		$meta_query[] = array( 'key' => $k, 'value' => $attachment_id, 'compare' => '=' );
	}
	$args['meta_query'] = $meta_query;
	$found = get_posts( $args );
	if ( ! empty( $found ) ) { return true; }

	// Also check ANY other post type that uses this attachment as a featured image
	$found_other = get_posts( array(
		'post_type' => 'any',
		'post_status' => 'any',
		'posts_per_page' => 1,
		'fields' => 'ids',
		'post__not_in' => array_map( 'intval', $exclude_service_ids ),
		'meta_key' => '_thumbnail_id',
		'meta_value' => $attachment_id,
	) );
	return ! empty( $found_other );
}

/**
 * Delete a Service and remove its related images if not used elsewhere.
 * Returns the number of attachments removed.
 */
function smoothmigration_delete_service_and_images( int $service_id ): int {
	// Collect attachments referenced via meta and featured image
	$ids_map = array();
	foreach ( smoothmigration_get_service_attachment_ids( $service_id ) as $aid ) {
		$ids_map[ (int) $aid ] = true;
	}

	// Also include attachments tagged with sm_asset_type: service-{canonical-slug}
	$service_slug = function_exists( 'smoothmigration_get_service_canonical_slug' ) ? smoothmigration_get_service_canonical_slug( $service_id ) : '';
	if ( $service_slug ) {
		$tag_slug = 'service-' . $service_slug;
		$tagged = get_posts( array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'numberposts'    => -1,
			'fields'         => 'ids',
			'tax_query'      => array(
				array(
					'taxonomy' => 'sm_asset_type',
					'field'    => 'slug',
					'terms'    => array( $tag_slug ),
				),
			),
		) );
		foreach ( $tagged as $aid ) { $ids_map[ (int) $aid ] = true; }
	}

	$attachments = array_map( 'intval', array_keys( $ids_map ) );

	// Delete the service first (permanent)
	wp_delete_post( $service_id, true );
	$deleted = 0;
	foreach ( $attachments as $aid ) {
		$att = get_post( $aid );
		if ( ! $att || $att->post_type !== 'attachment' ) { continue; }
		if ( smoothmigration_is_attachment_used_by_other_services( $aid ) ) { continue; }
		wp_delete_attachment( $aid, true );
		$deleted++;
	}
	return $deleted;
}

/**
 * Render Service Tools page with Bulk Import and Delete utilities.
 */
function smoothmigration_render_service_tools_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}

	// Handle actions
	if ( isset( $_POST['smoothmigration_service_tools_action'] ) && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'smoothmigration_service_tools' ) ) {
		$action = sanitize_text_field( wp_unslash( $_POST['smoothmigration_service_tools_action'] ) );

		if ( $action === 'single_delete' ) {
			$service_id = isset( $_POST['single_service_id'] ) ? absint( $_POST['single_service_id'] ) : 0;
			if ( $service_id ) {
				$removed_images = smoothmigration_delete_service_and_images( $service_id );
				echo '<div class="notice notice-warning"><p>Deleted service ID ' . intval( $service_id ) . ' and removed ' . intval( $removed_images ) . ' related image(s).</p></div>';
			}
		}

		if ( $action === 'multi_delete' ) {
			$ids_raw = isset( $_POST['multi_service_ids'] ) ? (string) wp_unslash( $_POST['multi_service_ids'] ) : '';
			$ids = array();
			if ( $ids_raw !== '' ) {
				// Accept comma-separated or JSON array
				if ( str_starts_with( $ids_raw, '[' ) ) {
					$decoded = json_decode( $ids_raw, true );
					if ( is_array( $decoded ) ) {
						$ids = array_map( 'absint', $decoded );
					}
				} else {
					$ids = array_map( 'absint', array_filter( array_map( 'trim', explode( ',', $ids_raw ) ) ) );
				}
			}
			$deleted = 0;
			$images_removed = 0;
			foreach ( $ids as $sid ) {
				if ( $sid ) { $images_removed += smoothmigration_delete_service_and_images( $sid ); $deleted++; }
			}
			echo '<div class="notice notice-warning"><p>Deleted ' . intval( $deleted ) . ' service(s) and removed ' . intval( $images_removed ) . ' related image(s).</p></div>';
		}

		if ( $action === 'type_delete' ) {
			$term_ids = isset( $_POST['service_type_ids'] ) && is_array( $_POST['service_type_ids'] ) ? array_map( 'absint', $_POST['service_type_ids'] ) : array();
			$deleted = 0;
			$images_removed = 0;
			if ( ! empty( $term_ids ) ) {
				$posts = get_posts( array(
					'post_type' => 'service',
					'post_status' => 'any',
					'numberposts' => -1,
					'fields' => 'ids',
					'tax_query' => array(
						array(
							'taxonomy' => 'service_type',
							'field' => 'term_id',
							'terms' => $term_ids,
						),
					),
				) );
				foreach ( $posts as $pid ) { $images_removed += smoothmigration_delete_service_and_images( $pid ); $deleted++; }
			}
			echo '<div class="notice notice-error"><p>Deleted ' . intval( $deleted ) . ' service(s) in selected Service Types and removed ' . intval( $images_removed ) . ' related image(s). Service Type terms were preserved.</p></div>';
		}

		if ( $action === 'full_delete' ) {
			$deleted = 0;
			$images_removed = 0;
			$posts = get_posts( array( 'post_type' => 'service', 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids' ) );
			foreach ( $posts as $pid ) { $images_removed += smoothmigration_delete_service_and_images( $pid ); $deleted++; }

			// After removing all services, sweep remaining Brand Logo attachments.
			// Note: Currently scoped to image attachments only. If/when non-image assets
			// (e.g., PDFs, embeds) are introduced for services, extend this sweep to include
			// additional mime types or a dedicated taxonomy for non-image assets.
			$brand_logo_attachments = get_posts( array(
				'post_type'      => 'attachment',
				'post_status'    => 'inherit',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'tax_query'      => array(
					array(
						'taxonomy' => 'sm_asset_type',
						'field'    => 'slug',
						'terms'    => array( 'brand-logo' ),
					),
				),
			) );
			foreach ( $brand_logo_attachments as $aid ) {
				$att = get_post( $aid );
				if ( ! $att || $att->post_type !== 'attachment' ) { continue; }
				// Skip if used as featured image anywhere or referenced by any Service post
				if ( smoothmigration_is_attachment_used_by_other_services( (int) $aid ) ) { continue; }
				wp_delete_attachment( (int) $aid, true );
				$images_removed++;
			}
			echo '<div class="notice notice-error"><p>Deleted ALL ' . intval( $deleted ) . ' services and removed ' . intval( $images_removed ) . ' related image(s). Service Type terms preserved.</p></div>';
		}

		if ( $action === 'bulk_import' ) {
			// Reuse existing handler from bulk-import.php
			if ( function_exists( 'smoothmigration_handle_bulk_import_submission' ) ) {
				$results = smoothmigration_handle_bulk_import_submission();
				$cls = ! empty( $results['success'] ) ? 'success' : 'error';
				echo '<div class="notice notice-' . esc_attr( $cls ) . '"><p>' . esc_html( (string) ( $results['message'] ?? '' ) ) . '</p>';
				if ( ! empty( $results['services_created'] ) ) {
					echo '<p><strong>Services created/updated:</strong> ' . esc_html( implode( ', ', (array) $results['services_created'] ) ) . '</p>';
				}
				if ( ! empty( $results['structure_type'] ) ) {
					echo '<p><strong>Structure detected:</strong> ' . esc_html( ucwords( str_replace( '-', ' ', (string) $results['structure_type'] ) ) ) . '</p>';
				}
				if ( ! empty( $results['errors'] ) ) {
					echo '<p><strong>Errors:</strong></p><ul>';
					foreach ( (array) $results['errors'] as $error ) {
						echo '<li>' . esc_html( (string) $error ) . '</li>';
					}
					echo '</ul>';
				}
				if ( ! empty( $results['debug'] ) ) {
					echo '<div style="background:#f6f7f7;padding:12px;border-radius:3px;margin:10px 0;"><pre style="white-space:pre-wrap;font-family:monospace;font-size:12px;">' . esc_html( (string) $results['debug'] ) . '</pre></div>';
				}
				echo '</div>';
			}
		}
	}

	$ajax_nonce = wp_create_nonce( 'smoothmigration_service_tools' );
	$ajax_url = admin_url( 'admin-ajax.php' );

	// Preload service types for type-delete UI
	$service_types = get_terms( array( 'taxonomy' => 'service_type', 'hide_empty' => false ) );
	if ( is_wp_error( $service_types ) ) { $service_types = array(); }

	?>
	<div class="wrap">
		<h1>Service Tools</h1>
		<p>Manage imports and safe deletions for <em>Services</em>. Deletions never remove <strong>Service Type</strong> terms.</p>

		<style>
			.smst-grid { display:grid; grid-template-columns: 1fr; gap:16px; }
			@media (min-width: 1100px) { .smst-grid { grid-template-columns: 1fr 1fr; } }
			.smst-card { background:#fff; border:1px solid #dcdcde; border-radius:4px; padding:16px; }
			.smst-card h2 { margin-top:0; }
			.button-yellow { background:#ffeb3b; color:#1d2327; border-color:#e0cf2d; }
			.button-orange { background:#ff9800; color:#1d2327; border-color:#e58900; }
			.button-red { background:#dc3545; color:#fff; border-color:#c12a39; }
			.button-dark-red { background:#8b0000; color:#fff; border-color:#6f0000; }
			.smst-search { width:100%; max-width:420px; }
			.smst-select { width:100%; max-width:420px; }
			.smst-chip { display:inline-block; background:#f6f7f7; border:1px solid #ccd0d4; border-radius:999px; padding:4px 10px; margin:4px 6px 0 0; }
			.smst-chip button { margin-left:8px; }
			.smst-muted { color:#6c757d; font-size:12px; }
			/* Emphasis + collapsible sections */
			.smst-import-card { border-left:4px solid #2271b1; box-shadow: 0 1px 0 rgba(0,0,0,.04); }
			.smst-actions { display:flex; flex-wrap:wrap; gap:8px; margin:16px 0; }
			.smst-actions .button { font-weight:600; }
			.smst-collapse { display:none; }
			.smst-collapse.open { display:block; }
		</style>

		<div class="smst-card smst-import-card">
			<h2>Bulk Service Import</h2>
			<p>Upload a ZIP or point to a server folder to import brand logos and create/update Services. Uses the same logic as the dedicated Bulk Import page.</p>
			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field( 'smoothmigration_service_tools' ); ?>
				<input type="hidden" name="smoothmigration_service_tools_action" value="bulk_import">
				<table class="form-table">
					<tr>
						<th scope="row"><label>Import Method</label></th>
						<td>
							<label><input type="radio" name="import_method" value="zip" checked> Upload ZIP file</label><br>
							<label><input type="radio" name="import_method" value="existing"> Use existing server folder</label><br>
							<label><input type="radio" name="import_method" value="debug"> Debug Mode (analyze ZIP without importing)</label>
						</td>
					</tr>
					<tr class="smst-zip-row">
						<th scope="row"><label for="smst-zip">ZIP File</label></th>
						<td><input type="file" id="smst-zip" name="zip_file" accept=".zip"></td>
					</tr>
					<tr class="smst-folder-row" style="display:none;">
						<th scope="row"><label for="smst-folder">Server Folder Path</label></th>
						<td><input type="text" id="smst-folder" name="folder_path" class="regular-text" placeholder="/absolute/path/to/folder"></td>
					</tr>
					<tr>
						<th scope="row"><label for="smst-region">Region/Country</label></th>
						<td><input type="text" id="smst-region" name="region" class="regular-text" placeholder="e.g., South Africa, USA, Canada"></td>
					</tr>
					<tr>
						<th scope="row"><label for="smst-overwrite">Overwrite Content</label></th>
						<td><label><input type="checkbox" id="smst-overwrite" name="overwrite_content" value="1" checked> Overwrite existing service content with JSONL content</label></td>
					</tr>
				</table>
				<p><button type="submit" class="button button-primary">Import Services</button></p>
			</form>
		</div>

		<div class="smst-actions" role="toolbar" aria-label="Service delete options">
			<button type="button" class="button button-yellow smst-toggle" data-target="smst-sec-single" aria-expanded="false" aria-controls="smst-sec-single">Single Service Delete</button>
			<button type="button" class="button button-orange smst-toggle" data-target="smst-sec-multi" aria-expanded="false" aria-controls="smst-sec-multi">Multi Service Delete</button>
			<button type="button" class="button button-red smst-toggle" data-target="smst-sec-type" aria-expanded="false" aria-controls="smst-sec-type">Service Type Delete</button>
			<button type="button" class="button button-dark-red smst-toggle" data-target="smst-sec-full" aria-expanded="false" aria-controls="smst-sec-full">Full Delete</button>
		</div>

		<div id="smst-sec-single" class="smst-card smst-collapse" aria-hidden="true">
			<h2>Single Service Delete</h2>
			<p>Search by service name or service type, then select a single service to delete.</p>
			<form method="post" onsubmit="return SMST.confirmSingle();">
				<?php wp_nonce_field( 'smoothmigration_service_tools' ); ?>
				<input type="hidden" name="smoothmigration_service_tools_action" value="single_delete">
				<p><input type="text" id="smst-single-search" class="regular-text smst-search" placeholder="Search services or service types..."></p>
				<p>
					<select id="smst-single-select" class="smst-select"></select>
					<input type="hidden" id="smst-single-id" name="single_service_id" value="">
				</p>
				<p><button type="submit" class="button button-yellow">Delete Selected Service</button></p>
				<p class="smst-muted">This deletes only the selected service post and keeps its Service Type term.</p>
			</form>
		</div>

		<div id="smst-sec-multi" class="smst-card smst-collapse" aria-hidden="true">
			<h2>Multi Service Delete</h2>
			<p>Search and click to mark multiple services for deletion. Marked services remain listed below when you search again.</p>
			<form method="post" onsubmit="return SMST.confirmMulti();">
				<?php wp_nonce_field( 'smoothmigration_service_tools' ); ?>
				<input type="hidden" name="smoothmigration_service_tools_action" value="multi_delete">
				<input type="hidden" id="smst-multi-ids" name="multi_service_ids" value="[]">
				<p><input type="text" id="smst-multi-search" class="regular-text smst-search" placeholder="Search services or service types..."></p>
				<p>
					<select id="smst-multi-select" class="smst-select" size="6" style="height:auto;"></select>
				</p>
				<div id="smst-multi-selected"></div>
				<p><button type="submit" class="button button-orange">Delete Marked Services</button></p>
				<p class="smst-muted">Only services are deleted. Service Type terms are preserved.</p>
			</form>
		</div>

		<div id="smst-sec-type" class="smst-card smst-collapse" aria-hidden="true">
			<h2>Service Type Delete</h2>
			<p>Select one or more Service Types to delete all services within them. The Service Type terms themselves are <strong>not</strong> deleted.</p>
			<form method="post" onsubmit="return SMST.confirmType();">
				<?php wp_nonce_field( 'smoothmigration_service_tools' ); ?>
				<input type="hidden" name="smoothmigration_service_tools_action" value="type_delete">
				<p><input type="text" id="smst-type-filter" class="regular-text smst-search" placeholder="Filter service types..."></p>
				<div id="smst-type-list" style="max-height:220px; overflow:auto; border:1px solid #dcdcde; padding:8px;">
					<?php foreach ( $service_types as $t ) : ?>
						<label style="display:block; margin-bottom:6px;"><input type="checkbox" class="smst-type-item" name="service_type_ids[]" value="<?php echo esc_attr( (string) $t->term_id ); ?>"> <?php echo esc_html( $t->name ); ?></label>
					<?php endforeach; ?>
				</div>
				<p><button type="submit" class="button button-red">Delete Services in Selected Types</button></p>
			</form>
		</div>

		<div id="smst-sec-full" class="smst-card smst-collapse" aria-hidden="true">
			<h2>Full Delete</h2>
			<p>Deletes <strong>all</strong> Service posts. Service Type terms remain intact.</p>
			<form method="post" onsubmit="return SMST.confirmFull();">
				<?php wp_nonce_field( 'smoothmigration_service_tools' ); ?>
				<input type="hidden" name="smoothmigration_service_tools_action" value="full_delete">
				<p><button type="submit" class="button button-dark-red">Delete ALL Services (keep Service Types)</button></p>
			</form>
		</div>

		<script>
		(function(){
			const ajaxUrl = <?php echo json_encode( $ajax_url ); ?>;
			const nonce = <?php echo json_encode( $ajax_nonce ); ?>;

			function debounce(fn, delay){ let t; return function(){ clearTimeout(t); const a=arguments; t=setTimeout(()=>fn.apply(this,a), delay); }; }

			function fetchServices(q, cb){
				const url = ajaxUrl + '?action=smoothmigration_search_services&nonce=' + encodeURIComponent(nonce) + '&q=' + encodeURIComponent(q||'');
				fetch(url, { credentials: 'same-origin' }).then(r=>r.json()).then(data=>{ if(data && data.success){ cb(data.data||[]); } else { cb([]); } }).catch(()=>cb([]));
			}

			// Single delete widgets
			const singleSearch = document.getElementById('smst-single-search');
			const singleSelect = document.getElementById('smst-single-select');
			const singleHidden = document.getElementById('smst-single-id');

			if (singleSearch && singleSelect) {
				const updateSingle = debounce(function(){
					fetchServices(singleSearch.value, function(items){
						singleSelect.innerHTML = '';
						items.forEach(function(it){
							const opt = document.createElement('option');
							opt.value = String(it.id);
							opt.textContent = it.title + (it.types ? ' (' + it.types + ')' : '');
							singleSelect.appendChild(opt);
						});
						if (items.length){ singleHidden.value = String(items[0].id); }
					});
				}, 250);
				singleSearch.addEventListener('input', updateSingle);
				singleSelect.addEventListener('change', function(){ singleHidden.value = singleSelect.value || ''; });
				updateSingle();
			}

			// Multi delete widgets
			const multiSearch = document.getElementById('smst-multi-search');
			const multiSelect = document.getElementById('smst-multi-select');
			const multiSelected = document.getElementById('smst-multi-selected');
			const multiHidden = document.getElementById('smst-multi-ids');
			const selectedMap = new Map();

			function renderChips(){
				multiSelected.innerHTML = '';
				Array.from(selectedMap.values()).forEach(function(it){
					const chip = document.createElement('span');
					chip.className = 'smst-chip';
					chip.textContent = it.title;
					const btn = document.createElement('button');
					btn.type = 'button'; btn.className = 'button-link-delete'; btn.textContent = '×';
					btn.addEventListener('click', function(){ selectedMap.delete(String(it.id)); renderChips(); saveHidden(); });
					chip.appendChild(btn);
					multiSelected.appendChild(chip);
				});
			}
			function saveHidden(){ multiHidden.value = JSON.stringify(Array.from(selectedMap.keys())); }

			if (multiSearch && multiSelect) {
				const updateMulti = debounce(function(){
					fetchServices(multiSearch.value, function(items){
						multiSelect.innerHTML = '';
						items.forEach(function(it){
							const opt = document.createElement('option');
							opt.value = String(it.id);
							opt.textContent = it.title + (it.types ? ' (' + it.types + ')' : '');
							multiSelect.appendChild(opt);
						});
					});
				}, 250);
				multiSearch.addEventListener('input', updateMulti);
				multiSelect.addEventListener('change', function(){
					const id = multiSelect.value; if(!id) return;
					const opt = multiSelect.options[multiSelect.selectedIndex];
					selectedMap.set(String(id), { id: id, title: opt.textContent });
					renderChips(); saveHidden();
					// Clear selection so subsequent clicks can re-trigger change
					multiSelect.selectedIndex = -1;
				});
				updateMulti();
			}

			// Type filter
			const typeFilter = document.getElementById('smst-type-filter');
			if (typeFilter) {
				typeFilter.addEventListener('input', function(){
					const q = this.value.toLowerCase();
					document.querySelectorAll('#smst-type-list .smst-type-item').forEach(function(cb){
						const label = cb.parentElement; const text = label.textContent.toLowerCase();
						label.style.display = text.indexOf(q) !== -1 ? 'block' : 'none';
					});
				});
			}

			// Bulk Import toggles
			document.querySelectorAll('input[name="import_method"]').forEach(function(r){
				r.addEventListener('change', function(){
					const zipRow = document.querySelector('.smst-zip-row');
					const folderRow = document.querySelector('.smst-folder-row');
					if (this.value === 'existing') { zipRow.style.display = 'none'; folderRow.style.display = ''; }
					else { zipRow.style.display = ''; folderRow.style.display = 'none'; }
				});
			});

			// Confirm helpers
			window.SMST = {
				confirmSingle: function(){ return confirm('Delete the selected service? This cannot be undone.'); },
				confirmMulti: function(){ return confirm('Delete all marked services? This cannot be undone.'); },
				confirmType: function(){ return confirm('Delete all services within the selected Service Types? Service Type terms will be preserved.'); },
				confirmFull: function(){ return confirm('This will delete ALL individual services but keep Service Types. Are you sure?'); }
			};

			// Collapsible toggle behavior for delete sections
			document.querySelectorAll('.smst-toggle').forEach(function(btn){
				btn.addEventListener('click', function(){
					var targetId = this.getAttribute('data-target');
					if (!targetId) return;
					var el = document.getElementById(targetId);
					if (!el) return;
					var isOpen = el.classList.contains('open');
					el.classList.toggle('open');
					this.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
					el.setAttribute('aria-hidden', isOpen ? 'true' : 'false');
				});
			});
		})();
		</script>
	</div>
	<?php
}


