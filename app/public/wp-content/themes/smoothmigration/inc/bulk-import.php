<?php
/**
 * Bulk Import System: Upload folders/zip files to create services with logos
 * 
 * This system allows uploading folder structures like:
 * South Africa/
 *   ├── Airalo/
 *   │   ├── logo1.png
 *   │   └── logo2.png
 *   ├── Wise/
 *   │   └── wise-logo.png
 *   └── Remitly/
 *       └── remitly.png
 * 
 * Each subfolder represents a brand, and all images in that folder
 * are imported as logo variants for that service.
 * 
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register admin menu for bulk import
 */
function smoothmigration_register_bulk_import_menu() {
    add_management_page(
        'Bulk Service Import',
        'Bulk Service Import',
        'manage_options',
        'smoothmigration-bulk-import',
        'smoothmigration_render_bulk_import_page'
    );
}
add_action( 'admin_menu', 'smoothmigration_register_bulk_import_menu' );

/**
 * Enhanced brand mapping that includes folder name detection
 */
function smoothmigration_enhanced_brand_mapping( string $text ): array {
    // Use existing canonical mapping first
    $canonical = smoothmigration_map_canonical_brand( $text );
    
    // If we got a generic mapping, try folder-specific patterns
    if ( $canonical[1] === sanitize_title( $text ) ) {
        $normalized = strtolower( trim( $text ) );
        
        // Additional folder-name specific mappings
        $folder_map = array(
            'xe money transfers' => array('XE Money Transfer', 'xe-money-transfer'),
            'xe money transfer' => array('XE Money Transfer', 'xe-money-transfer'),
            'visitors coverage' => array('Visitors Coverage', 'visitors-coverage'),
            'figo pet insurance' => array('Figo Pet Insurance', 'figo-pet-insurance'),
            'international autosource' => array('International AutoSource', 'international-autosource'),
            'experts in moving' => array('Experts in Moving', 'experts-in-moving'),
            'sirelo(expertsinmoving)' => array('Experts in Moving', 'experts-in-moving'),
            'sirelo' => array('Experts in Moving', 'experts-in-moving'),
            'squareone tenant insurance' => array('SquareOne Insurance', 'squareone-insurance'),
            'boost mobile usa' => array('Boost Mobile', 'boost-mobile'),
            'visible by verizon' => array('Visible', 'visible'),
        );
        
        foreach ( $folder_map as $needle => $mapping ) {
            if ( str_contains( $normalized, $needle ) ) {
                return $mapping;
            }
        }
    }
    
    return $canonical;
}

/**
 * Process a folder structure and import services with logos
 */
function smoothmigration_process_folder_structure( string $base_path, string $region = '' ): array {
    $results = array(
        'success' => true,
        'message' => '',
        'processed' => 0,
        'errors' => array(),
        'services_created' => array()
    );
    
    if ( ! is_dir( $base_path ) ) {
        $results['success'] = false;
        $results['message'] = 'Base path is not a directory';
        return $results;
    }
    
    // Ensure core service terms exist
    smoothmigration_ensure_core_service_terms();
    
    // Get all subdirectories (brands)
    $brand_folders = array_filter( scandir( $base_path ), function( $item ) use ( $base_path ) {
        return $item !== '.' && $item !== '..' && is_dir( $base_path . '/' . $item );
    });
    
    foreach ( $brand_folders as $folder_name ) {
        $folder_path = $base_path . '/' . $folder_name;
        $brand_result = smoothmigration_process_brand_folder( $folder_path, $folder_name, $region );
        
        if ( $brand_result['success'] ) {
            $results['processed']++;
            $results['services_created'][] = $brand_result['service_name'];
        } else {
            $results['errors'][] = "Failed to process {$folder_name}: " . $brand_result['message'];
        }
    }
    
    $results['message'] = sprintf(
        'Processed %d brand folders. Created/updated %d services. %d errors.',
        count( $brand_folders ),
        $results['processed'],
        count( $results['errors'] )
    );
    
    return $results;
}

/**
 * Process a single brand folder and its images
 */
function smoothmigration_process_brand_folder( string $folder_path, string $folder_name, string $region = '' ): array {
    $result = array(
        'success' => false,
        'message' => '',
        'service_name' => '',
        'logos_imported' => 0
    );
    
    // Get canonical brand name and slug
    list( $brand_name, $brand_slug ) = smoothmigration_enhanced_brand_mapping( $folder_name );
    $result['service_name'] = $brand_name;
    
    // Find or create the service
    $service_id = smoothmigration_find_or_create_service( $brand_name, $brand_slug, $region );
    
    if ( ! $service_id ) {
        $result['message'] = 'Failed to create/find service';
        return $result;
    }
    
    // Get all image files in the folder
    $image_files = smoothmigration_get_image_files( $folder_path );
    
    if ( empty( $image_files ) ) {
        $result['message'] = 'No image files found in folder';
        return $result;
    }
    
    // Process each image file
    foreach ( $image_files as $image_file ) {
        $image_path = $folder_path . '/' . $image_file;
        $import_result = smoothmigration_import_brand_image( $image_path, $image_file, $service_id, $brand_name );
        
        if ( $import_result['success'] ) {
            $result['logos_imported']++;
        }
    }
    
    $result['success'] = true;
    $result['message'] = sprintf( 'Imported %d logos for %s', $result['logos_imported'], $brand_name );
    
    return $result;
}

/**
 * Find or create a service post
 */
function smoothmigration_find_or_create_service( string $brand_name, string $brand_slug, string $region = '' ): int {
    // First try to find existing service by canonical slug
    $existing_posts = get_posts( array(
        'post_type' => 'service',
        'posts_per_page' => 1,
        'meta_query' => array(
            array('key' => '_service_canonical', 'value' => $brand_slug, 'compare' => '=')
        ),
        'fields' => 'ids'
    ) );
    
    if ( ! empty( $existing_posts ) ) {
        $post_id = (int) $existing_posts[0];
        
        // Update region if provided
        if ( $region ) {
            $existing_regions = get_post_meta( $post_id, '_service_regions', true );
            $regions_array = $existing_regions ? explode( ',', $existing_regions ) : array();
            
            if ( ! in_array( $region, $regions_array ) ) {
                $regions_array[] = $region;
                update_post_meta( $post_id, '_service_regions', implode( ',', $regions_array ) );
            }
        }
        
        return $post_id;
    }
    
    // Create new service
    $type_slug = smoothmigration_guess_type_from_filename( $brand_name );
    
    // Get known affiliate links
    $affiliate_map = smoothmigration_get_affiliate_links();
    $affiliate_url = '';
    
    foreach ( $affiliate_map as $brand => $url ) {
        if ( strtolower( $brand_name ) === strtolower( $brand ) ) {
            $affiliate_url = $url;
            break;
        }
    }
    
    // Rich content for service
    $content = smoothmigration_generate_service_content( $brand_name );
    
    $post_data = array(
        'post_title' => $brand_name,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'service',
        'post_name' => $brand_slug,
    );
    
    $post_id = wp_insert_post( $post_data );
    
    if ( is_wp_error( $post_id ) || ! $post_id ) {
        return 0;
    }
    
    // Set taxonomy
    wp_set_object_terms( $post_id, $type_slug, 'service_type', false );
    
    // Set metadata
    update_post_meta( $post_id, '_service_canonical', $brand_slug );
    
    if ( $affiliate_url ) {
        update_post_meta( $post_id, '_service_affiliate_url', esc_url_raw( $affiliate_url ) );
    }
    
    if ( $region ) {
        update_post_meta( $post_id, '_service_regions', $region );
    }
    
    return $post_id;
}

/**
 * Import a single brand image and attach to service
 */
function smoothmigration_import_brand_image( string $image_path, string $filename, int $service_id, string $brand_name ): array {
    $result = array( 'success' => false, 'attachment_id' => 0, 'message' => '' );
    
    // Check if file exists
    if ( ! file_exists( $image_path ) ) {
        $result['message'] = 'Image file does not exist';
        return $result;
    }
    
    // Import to media library
    $attachment_id = smoothmigration_import_image_to_media( $image_path, $filename, $brand_name );
    
    if ( ! $attachment_id ) {
        $result['message'] = 'Failed to import image to media library';
        return $result;
    }
    
    $result['attachment_id'] = $attachment_id;
    
    // Set Asset Type taxonomy
    wp_set_object_terms( $attachment_id, array( 'brand-logo' ), 'sm_asset_type', false );
    
    // Determine logo variant slot
    $variant = smoothmigration_classify_logo_variant( $filename );
    
    // Assign to service
    smoothmigration_assign_logo_to_service( $service_id, $attachment_id, $variant );
    
    $result['success'] = true;
    $result['message'] = "Imported {$filename} as {$variant} variant";
    
    return $result;
}

/**
 * Import image file to WordPress media library
 */
function smoothmigration_import_image_to_media( string $image_path, string $filename, string $brand_name ): int {
    $wp_upload_dir = wp_upload_dir();
    
    // Create a unique filename to avoid conflicts
    $pathinfo = pathinfo( $filename );
    $base_name = sanitize_file_name( $pathinfo['filename'] );
    $extension = $pathinfo['extension'];
    $new_filename = $brand_name . '-' . $base_name . '.' . $extension;
    $new_filename = sanitize_file_name( $new_filename );
    
    // Copy file to uploads directory
    $upload_path = $wp_upload_dir['path'] . '/' . $new_filename;
    
    if ( ! copy( $image_path, $upload_path ) ) {
        return 0;
    }
    
    // Create attachment
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . $new_filename,
        'post_mime_type' => wp_check_filetype( $new_filename )['type'],
        'post_title' => $brand_name . ' Logo',
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attachment_id = wp_insert_attachment( $attachment, $upload_path );
    
    if ( ! $attachment_id ) {
        return 0;
    }
    
    // Generate attachment metadata
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_path );
    wp_update_attachment_metadata( $attachment_id, $attachment_data );
    
    return $attachment_id;
}

/**
 * Assign a logo to a service in the appropriate variant slot
 */
function smoothmigration_assign_logo_to_service( int $service_id, int $attachment_id, string $variant ): void {
    $meta_key = '_service_logo_' . $variant;
    
    // Only assign if the slot is empty
    if ( ! get_post_meta( $service_id, $meta_key, true ) ) {
        update_post_meta( $service_id, $meta_key, $attachment_id );
        
        // Set as featured image if no featured image exists
        if ( ! has_post_thumbnail( $service_id ) ) {
            set_post_thumbnail( $service_id, $attachment_id );
        }
    }
}

/**
 * Get image files from a directory
 */
function smoothmigration_get_image_files( string $directory ): array {
    $allowed_extensions = array( 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' );
    $files = scandir( $directory );
    
    return array_filter( $files, function( $file ) use ( $directory, $allowed_extensions ) {
        if ( $file === '.' || $file === '..' ) {
            return false;
        }
        
        $full_path = $directory . '/' . $file;
        if ( ! is_file( $full_path ) ) {
            return false;
        }
        
        $extension = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
        return in_array( $extension, $allowed_extensions );
    });
}

/**
 * Get affiliate links mapping
 */
function smoothmigration_get_affiliate_links(): array {
    return array(
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
}

/**
 * Generate rich content for service
 */
function smoothmigration_generate_service_content( string $brand_name ): string {
    $why = 'We recommend this partner for consistent quality, transparent pricing, and strong expat support.';
    $what = 'Comprehensive solutions tailored to international relocations, with digital-first onboarding and global coverage.';
    $since = 'Serving customers for years with positive reviews across major platforms.';
    
    return '<div class="service-rich">'
        . '<h2>About ' . esc_html( $brand_name ) . '</h2>'
        . '<p>' . esc_html( $what ) . '</p>'
        . '<h3>Why Smooth Migration Recommends</h3>'
        . '<p>' . esc_html( $why ) . '</p>'
        . '<h3>Track Record</h3>'
        . '<p>' . esc_html( $since ) . '</p>'
        . '</div>';
}

/**
 * Handle zip file upload and extraction
 */
function smoothmigration_handle_zip_upload( array $zip_file, string $region = '' ): array {
    $result = array( 'success' => false, 'message' => '', 'extracted_path' => '' );
    
    // Validate zip file
    if ( ! isset( $zip_file['tmp_name'] ) || ! is_uploaded_file( $zip_file['tmp_name'] ) ) {
        $result['message'] = 'Invalid zip file upload';
        return $result;
    }
    
    // Create temporary extraction directory
    $upload_dir = wp_upload_dir();
    $temp_dir = $upload_dir['basedir'] . '/temp-import-' . wp_generate_uuid4();
    
    if ( ! wp_mkdir_p( $temp_dir ) ) {
        $result['message'] = 'Could not create temporary directory';
        return $result;
    }
    
    // Extract zip
    $zip = new ZipArchive();
    if ( $zip->open( $zip_file['tmp_name'] ) !== TRUE ) {
        $result['message'] = 'Could not open zip file';
        return $result;
    }
    
    $zip->extractTo( $temp_dir );
    $zip->close();
    
    $result['success'] = true;
    $result['extracted_path'] = $temp_dir;
    
    return $result;
}

/**
 * Clean up temporary files
 */
function smoothmigration_cleanup_temp_files( string $temp_path ): void {
    if ( strpos( $temp_path, 'temp-import-' ) !== false && is_dir( $temp_path ) ) {
        smoothmigration_recursive_rmdir( $temp_path );
    }
}

/**
 * Recursively remove directory
 */
function smoothmigration_recursive_rmdir( string $dir ): void {
    if ( is_dir( $dir ) ) {
        $objects = scandir( $dir );
        foreach ( $objects as $object ) {
            if ( $object != "." && $object != ".." ) {
                $path = $dir . "/" . $object;
                if ( is_dir( $path ) ) {
                    smoothmigration_recursive_rmdir( $path );
                } else {
                    unlink( $path );
                }
            }
        }
        rmdir( $dir );
    }
}

/**
 * Render the bulk import admin page
 */
function smoothmigration_render_bulk_import_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Insufficient permissions.' );
    }
    
    // Handle form submission
    if ( isset( $_POST['smoothmigration_bulk_import'] ) && check_admin_referer( 'smoothmigration_bulk_import' ) ) {
        $results = smoothmigration_handle_bulk_import_submission();
        echo '<div class="notice notice-' . ( $results['success'] ? 'success' : 'error' ) . '">';
        echo '<p>' . esc_html( $results['message'] ) . '</p>';
        if ( ! empty( $results['services_created'] ) ) {
            echo '<p><strong>Services created/updated:</strong> ' . esc_html( implode( ', ', $results['services_created'] ) ) . '</p>';
        }
        if ( ! empty( $results['errors'] ) ) {
            echo '<p><strong>Errors:</strong></p><ul>';
            foreach ( $results['errors'] as $error ) {
                echo '<li>' . esc_html( $error ) . '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
    }
    
    ?>
    <div class="wrap">
        <h1>Bulk Service Import</h1>
        <p>Import services by uploading a folder structure or zip file. Each subfolder should represent a brand, with logo images inside.</p>
        
        <div class="card">
            <h2>Folder Structure Example</h2>
            <pre>
South Africa/
├── Airalo/
│   ├── logo-primary.png
│   ├── logo-white.png
│   └── logo-square.png
├── Wise/
│   └── wise-logo.png
└── Remitly/
    └── remitly-dark.png
            </pre>
            <p><strong>How it works:</strong></p>
            <ul>
                <li>Each subfolder name becomes a service (e.g., "Airalo", "Wise")</li>
                <li>All images in the subfolder are imported as logo variants</li>
                <li>Filenames determine the logo variant (primary, on_dark, on_light, square)</li>
                <li>Services are automatically categorized and affiliate links are added when known</li>
                <li>Region information is stored for geographic targeting</li>
            </ul>
        </div>
        
        <form method="post" enctype="multipart/form-data" class="bulk-import-form">
            <?php wp_nonce_field( 'smoothmigration_bulk_import' ); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="import_method">Import Method</label>
                    </th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="radio" name="import_method" value="zip" checked>
                                Upload ZIP file
                            </label><br>
                            <label>
                                <input type="radio" name="import_method" value="existing">
                                Use existing server folder
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr class="zip-upload-row">
                    <th scope="row">
                        <label for="zip_file">ZIP File</label>
                    </th>
                    <td>
                        <input type="file" name="zip_file" id="zip_file" accept=".zip">
                        <p class="description">Upload a ZIP file containing the folder structure with brand subfolders and logo images.</p>
                    </td>
                </tr>
                <tr class="folder-path-row" style="display: none;">
                    <th scope="row">
                        <label for="folder_path">Server Folder Path</label>
                    </th>
                    <td>
                        <input type="text" name="folder_path" id="folder_path" class="regular-text">
                        <p class="description">Enter the absolute path to a folder on the server (for testing/development).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="region">Region/Country</label>
                    </th>
                    <td>
                        <input type="text" name="region" id="region" class="regular-text" placeholder="e.g., South Africa, USA, Canada">
                        <p class="description">Optional: Specify the region/country for these services to enable geographic targeting.</p>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="smoothmigration_bulk_import" class="button button-primary" value="Import Services">
            </p>
        </form>
        
        <style>
        .bulk-import-form .form-table th {
            width: 200px;
        }
        .card pre {
            background: #f6f7f7;
            padding: 15px;
            border-radius: 3px;
            overflow-x: auto;
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="import_method"]');
            const zipRow = document.querySelector('.zip-upload-row');
            const folderRow = document.querySelector('.folder-path-row');
            
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'zip') {
                        zipRow.style.display = '';
                        folderRow.style.display = 'none';
                    } else {
                        zipRow.style.display = 'none';
                        folderRow.style.display = '';
                    }
                });
            });
        });
        </script>
    </div>
    <?php
}

/**
 * Handle bulk import form submission
 */
function smoothmigration_handle_bulk_import_submission(): array {
    $method = sanitize_text_field( $_POST['import_method'] ?? 'zip' );
    $region = sanitize_text_field( $_POST['region'] ?? '' );
    
    if ( $method === 'zip' ) {
        if ( ! isset( $_FILES['zip_file'] ) || $_FILES['zip_file']['error'] !== UPLOAD_ERR_OK ) {
            return array( 'success' => false, 'message' => 'No zip file uploaded or upload error occurred.' );
        }
        
        // Handle zip upload
        $zip_result = smoothmigration_handle_zip_upload( $_FILES['zip_file'], $region );
        if ( ! $zip_result['success'] ) {
            return $zip_result;
        }
        
        // Find the main folder in extracted content
        $extracted_path = $zip_result['extracted_path'];
        $main_folders = array_filter( scandir( $extracted_path ), function( $item ) use ( $extracted_path ) {
            return $item !== '.' && $item !== '..' && is_dir( $extracted_path . '/' . $item );
        });
        
        // Use the first folder found, or the extracted path itself if it contains brand folders directly
        if ( count( $main_folders ) === 1 ) {
            $import_path = $extracted_path . '/' . reset( $main_folders );
        } else {
            $import_path = $extracted_path;
        }
        
        // Process the folder structure
        $results = smoothmigration_process_folder_structure( $import_path, $region );
        
        // Clean up temporary files
        smoothmigration_cleanup_temp_files( $extracted_path );
        
        return $results;
        
    } elseif ( $method === 'existing' ) {
        $folder_path = sanitize_text_field( $_POST['folder_path'] ?? '' );
        
        if ( ! $folder_path || ! is_dir( $folder_path ) ) {
            return array( 'success' => false, 'message' => 'Invalid folder path specified.' );
        }
        
        return smoothmigration_process_folder_structure( $folder_path, $region );
    }
    
    return array( 'success' => false, 'message' => 'Invalid import method.' );
}
