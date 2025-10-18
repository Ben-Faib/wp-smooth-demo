<?php
/**
 * Single Service Import Tool
 * 
 * Admin interface for importing/updating individual services from JSONL data
 * Supports domain-specific filtering and selective field updates
 * 
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register admin menu for single service import
 */
function smoothmigration_register_single_service_import_menu() {
    add_management_page(
        'Import Single Service',
        'Import Single Service',
        'manage_options',
        'smoothmigration-single-service-import',
        'smoothmigration_render_single_service_import_page'
    );
}
add_action( 'admin_menu', 'smoothmigration_register_single_service_import_menu' );

/**
 * Domain/Country mapping
 */
function smoothmigration_get_domain_country_map(): array {
    return array(
        'canada' => array(
            'label' => 'Canada (.ca)',
            'domains' => array( '.ca', 'smoothmigration.ca' ),
            'slug' => 'canada'
        ),
        'united-states' => array(
            'label' => 'United States (.com / .net)',
            'domains' => array( '.com', '.net', 'smoothmigration.com', 'smoothmigration.net' ),
            'slug' => 'united-states'
        ),
        'united-kingdom' => array(
            'label' => 'United Kingdom (.co.uk)',
            'domains' => array( '.co.uk', 'smoothmigration.co.uk' ),
            'slug' => 'united-kingdom'
        ),
        'australia' => array(
            'label' => 'Australia (.com.au)',
            'domains' => array( '.com.au', 'smoothmigration.com.au' ),
            'slug' => 'australia'
        ),
        'south-africa' => array(
            'label' => 'South Africa (.co.za)',
            'domains' => array( '.co.za', 'smoothmigration.co.za' ),
            'slug' => 'south-africa'
        ),
    );
}

/**
 * Render the import page
 */
function smoothmigration_render_single_service_import_page() {
    // Handle form submission
    $import_result = null;
    if ( isset( $_POST['smoothmigration_import_single_service'] ) && check_admin_referer( 'smoothmigration_single_import', 'smoothmigration_single_import_nonce' ) ) {
        $import_result = smoothmigration_process_single_service_import();
    }
    
    $countries = smoothmigration_get_domain_country_map();
    ?>
    <div class="wrap">
        <h1>Import Single Service</h1>
        <p>Import or update a single service from JSONL data. This tool allows you to update specific services per domain without affecting other services.</p>
        
        <?php if ( $import_result ) : ?>
            <div class="notice notice-<?php echo $import_result['success'] ? 'success' : 'error'; ?> is-dismissible">
                <p><?php echo esc_html( $import_result['message'] ); ?></p>
                <?php if ( ! empty( $import_result['details'] ) ) : ?>
                    <ul>
                        <?php foreach ( $import_result['details'] as $detail ) : ?>
                            <li><?php echo esc_html( $detail ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="card" style="max-width: 900px; margin-top: 20px;">
            <form method="post" action="" id="single-service-import-form">
                <?php wp_nonce_field( 'smoothmigration_single_import', 'smoothmigration_single_import_nonce' ); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="country">Country/Domain</label></th>
                        <td>
                            <select name="country" id="country" class="regular-text">
                                <option value="">Select Country...</option>
                                <?php foreach ( $countries as $slug => $data ) : ?>
                                    <option value="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $data['label'] ); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description">Select the target country/domain for this service</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="import_method">Import Method</label></th>
                        <td>
                            <label style="display: block; margin-bottom: 10px;">
                                <input type="radio" name="import_method" value="jsonl" checked>
                                Paste JSONL Data
                            </label>
                            <label style="display: block;">
                                <input type="radio" name="import_method" value="file">
                                Upload JSONL File (coming soon)
                            </label>
                        </td>
                    </tr>
                    
                    <tr id="jsonl_paste_row">
                        <th scope="row"><label for="jsonl_data">JSONL Data</label></th>
                        <td>
                            <textarea name="jsonl_data" id="jsonl_data" rows="10" class="large-text code" placeholder='{"country": "Canada", "partner": "National Bank of Canada", "category": "Banking Services", ...}'></textarea>
                            <p class="description">Paste a single line of JSONL data or the entire file content. Each service should be on its own line.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Fields to Update</th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">Select fields to update</legend>
                                <label><input type="checkbox" name="update_fields[]" value="title" checked> Partner Name (Title)</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="category" checked> Category (Service Type)</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="overview" checked> Overview (Content)</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="why_recommend" checked> Why We Recommend</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="how_helps" checked> How It Helps</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="link" checked> Affiliate Link</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="quick_view" checked> Quick View (Excerpt)</label><br>
                                <label><input type="checkbox" name="update_fields[]" value="country_meta" checked> Country Meta</label><br>
                            </fieldset>
                            <p class="description">Uncheck fields you want to preserve (won't be overwritten)</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Import Options</th>
                        <td>
                            <label><input type="checkbox" name="create_if_not_exists" value="1" checked> Create service if it doesn't exist</label><br>
                            <label><input type="checkbox" name="preview_only" value="1"> Preview only (don't save changes)</label><br>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <input type="submit" name="smoothmigration_import_single_service" id="submit" class="button button-primary" value="Import Service">
                </p>
            </form>
        </div>
        
        <div class="card" style="max-width: 900px; margin-top: 20px; padding: 15px;">
            <h2>Quick Reference</h2>
            <h3>JSONL Format Example:</h3>
            <pre style="background: #f5f5f5; padding: 10px; overflow-x: auto;"><code>{"country": "Canada", "partner": "National Bank of Canada", "category": "Banking Services", "text": "Country: Canada\nPartner: National Bank of Canada\nCategory: Banking Services\nOverview: One of Canada's 6 major banks...\nWhy we recommend: Trusted institution...\nHow it helps: Makes settling easier...\nLink: https://www.nbc.ca/...", "metadata": {"link": "https://...", "quick_view": "Short description..."}}</code></pre>
            
            <h3>How It Works:</h3>
            <ol>
                <li>Select the target country/domain</li>
                <li>Paste JSONL data (one service per line, or entire file)</li>
                <li>Choose which fields to update</li>
                <li>Preview or import the service</li>
            </ol>
            
            <h3>Tips:</h3>
            <ul>
                <li>The tool will search for existing services by partner name</li>
                <li>If multiple services match, the first one will be updated</li>
                <li>Use "Preview only" to see what changes will be made</li>
                <li>Uncheck fields you want to keep unchanged</li>
            </ul>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Toggle import method UI
        $('input[name="import_method"]').on('change', function() {
            if ($(this).val() === 'jsonl') {
                $('#jsonl_paste_row').show();
            } else {
                $('#jsonl_paste_row').hide();
            }
        });
    });
    </script>
    
    <style>
    .card { background: #fff; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .form-table th { width: 200px; }
    pre code { font-size: 12px; }
    </style>
    <?php
}

/**
 * Process the import
 */
function smoothmigration_process_single_service_import() {
    $country = sanitize_text_field( $_POST['country'] ?? '' );
    $jsonl_data = wp_unslash( $_POST['jsonl_data'] ?? '' );
    $update_fields = $_POST['update_fields'] ?? array();
    $create_if_not_exists = ! empty( $_POST['create_if_not_exists'] );
    $preview_only = ! empty( $_POST['preview_only'] );
    
    $result = array(
        'success' => false,
        'message' => '',
        'details' => array()
    );
    
    // Validate inputs
    if ( empty( $country ) ) {
        $result['message'] = 'Please select a country/domain.';
        return $result;
    }
    
    if ( empty( $jsonl_data ) ) {
        $result['message'] = 'Please provide JSONL data.';
        return $result;
    }
    
    // Parse JSONL (can be multiple lines or single line)
    $lines = array_filter( explode( "\n", trim( $jsonl_data ) ) );
    $services_imported = 0;
    $services_updated = 0;
    $services_created = 0;
    $errors = array();
    
    foreach ( $lines as $line_num => $line ) {
        $line = trim( $line );
        if ( empty( $line ) ) continue;
        
        // Decode JSON
        $data = json_decode( $line, true );
        if ( json_last_error() !== JSON_ERROR_NONE ) {
            $errors[] = "Line " . ($line_num + 1) . ": Invalid JSON - " . json_last_error_msg();
            continue;
        }
        
        // Extract service data
        $partner_name = $data['partner'] ?? '';
        if ( empty( $partner_name ) ) {
            $errors[] = "Line " . ($line_num + 1) . ": Missing partner name";
            continue;
        }
        
        // Parse the text field for structured data
        $parsed = smoothmigration_parse_service_text( $data['text'] ?? '' );
        $metadata = $data['metadata'] ?? array();
        
        // Try to find existing service
        $existing_service = smoothmigration_find_service_by_partner_name( $partner_name );
        
        if ( $existing_service ) {
            // Update existing service
            $updates = smoothmigration_prepare_service_updates( $existing_service->ID, $data, $parsed, $metadata, $update_fields, $country );
            
            if ( ! $preview_only ) {
                smoothmigration_apply_service_updates( $existing_service->ID, $updates );
                $services_updated++;
                $result['details'][] = "Updated: {$partner_name} (ID: {$existing_service->ID})";
            } else {
                $result['details'][] = "Preview: Would update {$partner_name} (ID: {$existing_service->ID})";
            }
        } elseif ( $create_if_not_exists ) {
            // Create new service
            if ( ! $preview_only ) {
                $new_id = smoothmigration_create_service_from_data( $data, $parsed, $metadata, $country );
                if ( $new_id ) {
                    $services_created++;
                    $result['details'][] = "Created: {$partner_name} (ID: {$new_id})";
                } else {
                    $errors[] = "Failed to create service: {$partner_name}";
                }
            } else {
                $result['details'][] = "Preview: Would create {$partner_name}";
            }
        } else {
            $errors[] = "Service not found: {$partner_name} (create option disabled)";
        }
        
        $services_imported++;
    }
    
    // Build result message
    if ( $preview_only ) {
        $result['success'] = true;
        $result['message'] = "Preview complete: {$services_imported} service(s) would be processed";
    } elseif ( $services_updated > 0 || $services_created > 0 ) {
        $result['success'] = true;
        $parts = array();
        if ( $services_updated > 0 ) $parts[] = "{$services_updated} updated";
        if ( $services_created > 0 ) $parts[] = "{$services_created} created";
        $result['message'] = "Import complete: " . implode( ', ', $parts );
    } else {
        $result['message'] = "No services were imported";
    }
    
    if ( ! empty( $errors ) ) {
        $result['details'] = array_merge( $result['details'], array( '--- Errors ---' ), $errors );
    }
    
    return $result;
}

/**
 * Find service by partner name
 */
function smoothmigration_find_service_by_partner_name( string $partner_name ) {
    $args = array(
        'post_type' => 'service',
        'post_status' => array( 'publish', 'draft' ),
        'posts_per_page' => 1,
        'title' => $partner_name, // Exact title match doesn't work well, so we'll search
    );
    
    // First try exact title match
    $services = get_posts( $args );
    if ( ! empty( $services ) ) {
        return $services[0];
    }
    
    // Try fuzzy search
    $args['s'] = $partner_name;
    unset( $args['title'] );
    $services = get_posts( $args );
    
    // Filter by exact title match
    foreach ( $services as $service ) {
        if ( strtolower( trim( $service->post_title ) ) === strtolower( trim( $partner_name ) ) ) {
            return $service;
        }
    }
    
    // Return first result if any
    return ! empty( $services ) ? $services[0] : null;
}

/**
 * Parse service text field into structured data
 */
function smoothmigration_parse_service_text( string $text ): array {
    $parsed = array(
        'overview' => '',
        'why_recommend' => '',
        'how_helps' => '',
    );
    
    // Split by newlines and parse sections
    $lines = explode( "\n", $text );
    $current_section = '';
    $buffer = array();
    
    foreach ( $lines as $line ) {
        $line = trim( $line );
        
        // Detect section headers
        if ( preg_match( '/^(Country|Partner|Category|Overview|Why we recommend|How it helps|Link):\s*/i', $line, $matches ) ) {
            // Save previous section
            if ( $current_section && ! empty( $buffer ) ) {
                $content = implode( "\n", $buffer );
                if ( stripos( $current_section, 'overview' ) !== false ) {
                    $parsed['overview'] = $content;
                } elseif ( stripos( $current_section, 'why' ) !== false ) {
                    $parsed['why_recommend'] = $content;
                } elseif ( stripos( $current_section, 'how' ) !== false ) {
                    $parsed['how_helps'] = $content;
                }
            }
            
            $current_section = strtolower( trim( $matches[1] ) );
            $buffer = array( preg_replace( '/^' . preg_quote( $matches[0], '/' ) . '/', '', $line ) );
        } else {
            $buffer[] = $line;
        }
    }
    
    // Save last section
    if ( $current_section && ! empty( $buffer ) ) {
        $content = implode( "\n", $buffer );
        if ( stripos( $current_section, 'overview' ) !== false ) {
            $parsed['overview'] = $content;
        } elseif ( stripos( $current_section, 'why' ) !== false ) {
            $parsed['why_recommend'] = $content;
        } elseif ( stripos( $current_section, 'how' ) !== false ) {
            $parsed['how_helps'] = $content;
        }
    }
    
    return $parsed;
}

/**
 * Prepare service updates based on selected fields
 */
function smoothmigration_prepare_service_updates( int $post_id, array $data, array $parsed, array $metadata, array $update_fields, string $country ): array {
    $updates = array(
        'post_data' => array(),
        'post_meta' => array(),
        'taxonomy' => array(),
    );
    
    if ( in_array( 'title', $update_fields ) && ! empty( $data['partner'] ) ) {
        $updates['post_data']['post_title'] = sanitize_text_field( $data['partner'] );
    }
    
    if ( in_array( 'overview', $update_fields ) && ! empty( $parsed['overview'] ) ) {
        $updates['post_data']['post_content'] = wp_kses_post( $parsed['overview'] );
    }
    
    if ( in_array( 'quick_view', $update_fields ) && ! empty( $metadata['quick_view'] ) ) {
        $updates['post_data']['post_excerpt'] = sanitize_textarea_field( $metadata['quick_view'] );
    }
    
    if ( in_array( 'why_recommend', $update_fields ) && ! empty( $parsed['why_recommend'] ) ) {
        $updates['post_meta']['_service_why_recommend'] = sanitize_textarea_field( $parsed['why_recommend'] );
    }
    
    if ( in_array( 'how_helps', $update_fields ) && ! empty( $parsed['how_helps'] ) ) {
        $updates['post_meta']['_service_how_helps'] = sanitize_textarea_field( $parsed['how_helps'] );
    }
    
    if ( in_array( 'link', $update_fields ) && ! empty( $metadata['link'] ) ) {
        $updates['post_meta']['_service_affiliate_url'] = esc_url_raw( $metadata['link'] );
    }
    
    if ( in_array( 'country_meta', $update_fields ) ) {
        $updates['post_meta']['_service_country'] = sanitize_text_field( $country );
    }
    
    if ( in_array( 'category', $update_fields ) && ! empty( $data['category'] ) ) {
        $updates['taxonomy']['service_type'] = sanitize_text_field( $data['category'] );
    }
    
    return $updates;
}

/**
 * Apply updates to service
 */
function smoothmigration_apply_service_updates( int $post_id, array $updates ): void {
    // Update post data
    if ( ! empty( $updates['post_data'] ) ) {
        $updates['post_data']['ID'] = $post_id;
        wp_update_post( $updates['post_data'] );
    }
    
    // Update post meta
    if ( ! empty( $updates['post_meta'] ) ) {
        foreach ( $updates['post_meta'] as $key => $value ) {
            update_post_meta( $post_id, $key, $value );
        }
    }
    
    // Update taxonomy
    if ( ! empty( $updates['taxonomy']['service_type'] ) ) {
        $term = get_term_by( 'name', $updates['taxonomy']['service_type'], 'service_type' );
        if ( ! $term ) {
            // Try slug
            $term = get_term_by( 'slug', sanitize_title( $updates['taxonomy']['service_type'] ), 'service_type' );
        }
        if ( $term ) {
            wp_set_post_terms( $post_id, array( $term->term_id ), 'service_type' );
        }
    }
}

/**
 * Create new service from data
 */
function smoothmigration_create_service_from_data( array $data, array $parsed, array $metadata, string $country ) {
    $post_data = array(
        'post_title' => sanitize_text_field( $data['partner'] ?? 'Untitled Service' ),
        'post_content' => wp_kses_post( $parsed['overview'] ?? '' ),
        'post_excerpt' => sanitize_textarea_field( $metadata['quick_view'] ?? '' ),
        'post_status' => 'draft', // Create as draft for review
        'post_type' => 'service',
    );
    
    $post_id = wp_insert_post( $post_data );
    
    if ( ! is_wp_error( $post_id ) && $post_id > 0 ) {
        // Add meta
        if ( ! empty( $parsed['why_recommend'] ) ) {
            update_post_meta( $post_id, '_service_why_recommend', sanitize_textarea_field( $parsed['why_recommend'] ) );
        }
        if ( ! empty( $parsed['how_helps'] ) ) {
            update_post_meta( $post_id, '_service_how_helps', sanitize_textarea_field( $parsed['how_helps'] ) );
        }
        if ( ! empty( $metadata['link'] ) ) {
            update_post_meta( $post_id, '_service_affiliate_url', esc_url_raw( $metadata['link'] ) );
        }
        update_post_meta( $post_id, '_service_country', sanitize_text_field( $country ) );
        
        // Add category
        if ( ! empty( $data['category'] ) ) {
            $term = get_term_by( 'name', $data['category'], 'service_type' );
            if ( ! $term ) {
                $term = get_term_by( 'slug', sanitize_title( $data['category'] ), 'service_type' );
            }
            if ( $term ) {
                wp_set_post_terms( $post_id, array( $term->term_id ), 'service_type' );
            }
        }
        
        return $post_id;
    }
    
    return 0;
}

