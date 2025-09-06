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
    // Normalize partner labels (strip disclaimers like "(hold listing...)" and harmonize variants)
    $text = smoothmigration_normalize_partner_label( $text );

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
            // Helpful Canada harmonization
            'national bank of canada' => array('National Bank of Canada', 'national-bank-of-canada'),
            'ownr company set up' => array('Ownr', 'ownr'),
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
 * Normalize partner labels by removing disclaimers and harmonizing frequent variants.
 */
function smoothmigration_normalize_partner_label( string $text ): string {
    $out = trim( $text );

    // Remove trailing parentheses that are disclaimers: (hold ...), (update ...), (pending ...)
    $out = preg_replace( '/\s*\((?:hold|update|pending|contract|listing)[^)]+\)\s*$/i', '', $out );

    // Common harmonizations
    $map = array(
        '/\bairalo\s*e[\s-]*sim\b/i' => 'Airalo',
        '/\bxe\s*money\s*transfers?\b/i' => 'XE Money Transfer',
        '/\bownr\s*company\s*set\s*up\b/i' => 'Ownr',
        '/\bnational\s*bank\s*of\s*canada\b/i' => 'National Bank of Canada',
    );
    foreach ( $map as $pattern => $replacement ) {
        $out = preg_replace( $pattern, $replacement, $out );
    }

    // Collapse internal whitespace
    $out = preg_replace( '/\s+/', ' ', $out );
    return trim( $out );
}

/**
 * Find the folder that contains the folder structure and determine if it's 3-layer or 4-layer
 */
function smoothmigration_find_brand_container_folder( string $base_path ): string {
    $main_folders = array_filter( scandir( $base_path ), function( $item ) use ( $base_path ) {
        $full_path = $base_path . '/' . $item;
        return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
    });
    
    // If there's only one non-system folder, it's likely the country container (e.g., "South Africa")
    if ( count( $main_folders ) === 1 ) {
        $country_folder = reset( $main_folders );
        $country_path = $base_path . '/' . $country_folder;
        
        return $country_path;
    }
    
    return $base_path;
}

/**
 * Check if a folder is a system folder that should be ignored
 */
function smoothmigration_is_system_folder( string $folder_name ): bool {
    $system_folders = array( '__MACOSX', '.DS_Store', 'Thumbs.db', '.git', '.svn' );
    return in_array( $folder_name, $system_folders, true ) || strpos( $folder_name, '.' ) === 0;
}

/**
 * Detect if the folder structure is 3-layer or 4-layer
 * 3-layer: Country/Brand/Images
 * 4-layer: Country/ServiceType/Brand/Images
 */
function smoothmigration_detect_folder_structure( string $country_path ): array {
    $subfolders = array_filter( scandir( $country_path ), function( $item ) use ( $country_path ) {
        $full_path = $country_path . '/' . $item;
        return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
    });
    
    if ( empty( $subfolders ) ) {
        return array( 'type' => 'none', 'folders' => array() );
    }
    
    // Check first folder to determine structure
    $first_folder = reset( $subfolders );
    $first_folder_path = $country_path . '/' . $first_folder;
    
    $first_folder_contents = array_filter( scandir( $first_folder_path ), function( $item ) use ( $first_folder_path ) {
        $full_path = $first_folder_path . '/' . $item;
        return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
    });
    
    // If first folder contains subfolders, check if those contain images (4-layer)
    // or if they contain more subfolders (which would be unusual)
    if ( ! empty( $first_folder_contents ) ) {
        $sample_subfolder = reset( $first_folder_contents );
        $sample_subfolder_path = $first_folder_path . '/' . $sample_subfolder;
        
        // Check if this subfolder contains images
        $image_files = smoothmigration_get_image_files( $sample_subfolder_path );
        
        if ( ! empty( $image_files ) ) {
            // 4-layer structure: Country/ServiceType/Brand/Images
            return array( 'type' => '4-layer', 'service_types' => $subfolders );
        }
    }
    
    // Check if the main folders themselves contain images (3-layer structure)
    $image_files = smoothmigration_get_image_files( $first_folder_path );
    if ( ! empty( $image_files ) ) {
        // 3-layer structure: Country/Brand/Images
        return array( 'type' => '3-layer', 'brands' => $subfolders );
    }
    
    // If we can't determine, assume 4-layer for safety
    return array( 'type' => '4-layer', 'service_types' => $subfolders );
}

/**
 * Map service type folder names to taxonomy slugs
 */
function smoothmigration_map_service_type_folder( string $folder_name ): string {
    $folder_lower = strtolower( trim( $folder_name ) );
    
    $mapping = array(
        'banking services' => 'banking-services',
        'money' => 'banking-services',
        'banking' => 'banking-services',
        'financial' => 'banking-services',
        'finance' => 'banking-services',
        'remittance' => 'banking-services',
        
        'data and phone plans' => 'data-and-phone-plans',
        'telecommunication' => 'data-and-phone-plans',
        'telecom' => 'data-and-phone-plans',
        'mobile' => 'data-and-phone-plans',
        'phone' => 'data-and-phone-plans',
        'communication' => 'data-and-phone-plans',
        
        'vehicle services' => 'vehicles',
        'vehicles' => 'vehicles',
        'cars' => 'vehicles',
        'automotive' => 'vehicles',
        'rental' => 'vehicles',
        'transport' => 'vehicles',
        'transportation' => 'vehicles',
        
        'international moving' => 'international-moving',
        'moving' => 'international-moving',
        'relocation' => 'international-moving',
        'shipping' => 'international-moving',
        'freight' => 'international-moving',
        
        'insurance' => 'insurance',
        'travel insurance' => 'insurance',
        'health insurance' => 'insurance',
        'pet insurance' => 'insurance',
        'home insurance' => 'insurance',
        'tenant insurance' => 'insurance',
        
        'realtor' => 'realtor',
        'real estate' => 'realtor',
        'property' => 'realtor',
        'housing' => 'realtor',
    );
    
    foreach ( $mapping as $keyword => $slug ) {
        if ( str_contains( $folder_lower, $keyword ) ) {
            return $slug;
        }
    }
    
    // Default fallback
    return 'insurance';
}

/**
 * Process a folder structure and import services with logos
 * Supports both 3-layer and 4-layer structures
 */
function smoothmigration_process_folder_structure( string $base_path, string $region = '' ): array {
    $results = array(
        'success' => true,
        'message' => '',
        'processed' => 0,
        'errors' => array(),
        'services_created' => array(),
        'structure_type' => '',
    );
    
    if ( ! is_dir( $base_path ) ) {
        $results['success'] = false;
        $results['message'] = 'Base path is not a directory';
        return $results;
    }
    
    // Ensure core service terms exist
    smoothmigration_ensure_core_service_terms();
    
    // Detect folder structure
    $structure = smoothmigration_detect_folder_structure( $base_path );
    $results['structure_type'] = $structure['type'];
    
    if ( $structure['type'] === 'none' ) {
        $results['success'] = false;
        $results['message'] = 'No valid folders found in the structure';
        return $results;
    }
    
    if ( $structure['type'] === '3-layer' ) {
        // Country/Brand/Images structure
        foreach ( $structure['brands'] as $brand_folder ) {
            $brand_path = $base_path . '/' . $brand_folder;
            $brand_result = smoothmigration_process_brand_folder( $brand_path, $brand_folder, $region );
            
            if ( $brand_result['success'] ) {
                $results['processed']++;
                $results['services_created'][] = $brand_result['service_name'];
            } else {
                $results['errors'][] = "Failed to process {$brand_folder}: " . $brand_result['message'];
            }
        }
        
        $results['message'] = sprintf(
            'Processed %d brand folders (3-layer structure) from "%s". Created/updated %d services. %d errors.',
            count( $structure['brands'] ),
            basename( $base_path ),
            $results['processed'],
            count( $results['errors'] )
        );
        
    } elseif ( $structure['type'] === '4-layer' ) {
        // Country/ServiceType/Brand/Images structure
        foreach ( $structure['service_types'] as $service_type_folder ) {
            $service_type_path = $base_path . '/' . $service_type_folder;
            $service_type_slug = smoothmigration_map_service_type_folder( $service_type_folder );
            
            // Get brand folders within this service type
            $brand_folders = array_filter( scandir( $service_type_path ), function( $item ) use ( $service_type_path ) {
                $full_path = $service_type_path . '/' . $item;
                return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
            });
            
            foreach ( $brand_folders as $brand_folder ) {
                $brand_path = $service_type_path . '/' . $brand_folder;
                $brand_result = smoothmigration_process_brand_folder( $brand_path, $brand_folder, $region, $service_type_slug );
                
                if ( $brand_result['success'] ) {
                    $results['processed']++;
                    $results['services_created'][] = $brand_result['service_name'] . ' (' . $service_type_folder . ')';
                } else {
                    $results['errors'][] = "Failed to process {$service_type_folder}/{$brand_folder}: " . $brand_result['message'];
                }
            }
        }
        
        $results['message'] = sprintf(
            'Processed %d service type folders (4-layer structure) from "%s". Created/updated %d services. %d errors.',
            count( $structure['service_types'] ),
            basename( $base_path ),
            $results['processed'],
            count( $results['errors'] )
        );
    }
    
    // Add debugging info
    $results['debug'] = sprintf(
        "Structure: %s | Found: %s",
        $structure['type'],
        $structure['type'] === '3-layer' 
            ? implode( ', ', $structure['brands'] ?? array() )
            : implode( ', ', $structure['service_types'] ?? array() )
    );
    
    return $results;
}

/**
 * Process a single brand folder and its images
 */
function smoothmigration_process_brand_folder( string $folder_path, string $folder_name, string $region = '', string $service_type_override = '' ): array {
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
    $service_id = smoothmigration_find_or_create_service( $brand_name, $brand_slug, $region, $service_type_override );
    
    if ( ! $service_id ) {
        $result['message'] = 'Failed to create/find service';
        return $result;
    }
    
    // Get all image files in the folder
    $image_files = smoothmigration_get_image_files( $folder_path );
    
    if ( empty( $image_files ) ) {
        // Get more details for debugging
        $all_files = is_dir( $folder_path ) ? scandir( $folder_path ) : array();
        $all_files = array_filter( $all_files, function( $file ) {
            return $file !== '.' && $file !== '..';
        });
        
        $result['message'] = sprintf( 
            'No image files found in folder. Found %d total files: %s', 
            count( $all_files ),
            implode( ', ', array_slice( $all_files, 0, 5 ) ) . ( count( $all_files ) > 5 ? '...' : '' )
        );
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
function smoothmigration_find_or_create_service( string $brand_name, string $brand_slug, string $region = '', string $service_type_override = '', bool $create_if_missing = true ): int {
    // 1) Prefer canonical meta lookup
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

        // Append region if provided
        if ( $region ) {
            $existing_regions = get_post_meta( $post_id, '_service_regions', true );
            $regions_array = $existing_regions ? array_map( 'trim', explode( ',', $existing_regions ) ) : array();
            if ( ! in_array( $region, $regions_array, true ) ) {
                $regions_array[] = $region;
                update_post_meta( $post_id, '_service_regions', implode( ', ', $regions_array ) );
            }
        }

        // Ensure type set if provided and currently missing
        if ( $service_type_override ) {
            $current_types = wp_get_post_terms( $post_id, 'service_type', array( 'fields' => 'ids' ) );
            if ( empty( $current_types ) ) {
                wp_set_object_terms( $post_id, $service_type_override, 'service_type', false );
            }
        }

        return $post_id;
    }

    // 2) Fallback: find by slug (existing post without canonical meta)
    $by_slug = get_page_by_path( $brand_slug, OBJECT, 'service' );
    if ( $by_slug ) {
        $post_id = (int) $by_slug->ID;
        update_post_meta( $post_id, '_service_canonical', $brand_slug );

        if ( $region ) {
            $existing_regions = get_post_meta( $post_id, '_service_regions', true );
            $regions_array = $existing_regions ? array_map( 'trim', explode( ',', $existing_regions ) ) : array();
            if ( ! in_array( $region, $regions_array, true ) ) {
                $regions_array[] = $region;
                update_post_meta( $post_id, '_service_regions', implode( ', ', $regions_array ) );
            }
        }

        if ( $service_type_override ) {
            $current_types = wp_get_post_terms( $post_id, 'service_type', array( 'fields' => 'ids' ) );
            if ( empty( $current_types ) ) {
                wp_set_object_terms( $post_id, $service_type_override, 'service_type', false );
            }
        }

        return $post_id;
    }

    // 3) Fallback: find by title (case-normalized)
    $by_title = get_page_by_title( $brand_name, OBJECT, 'service' );
    if ( $by_title ) {
        $post_id = (int) $by_title->ID;

        // Normalize slug and store canonical
        wp_update_post( array( 'ID' => $post_id, 'post_name' => $brand_slug ) );
        update_post_meta( $post_id, '_service_canonical', $brand_slug );

        if ( $region ) {
            $existing_regions = get_post_meta( $post_id, '_service_regions', true );
            $regions_array = $existing_regions ? array_map( 'trim', explode( ',', $existing_regions ) ) : array();
            if ( ! in_array( $region, $regions_array, true ) ) {
                $regions_array[] = $region;
                update_post_meta( $post_id, '_service_regions', implode( ', ', $regions_array ) );
            }
        }

        if ( $service_type_override ) {
            $current_types = wp_get_post_terms( $post_id, 'service_type', array( 'fields' => 'ids' ) );
            if ( empty( $current_types ) ) {
                wp_set_object_terms( $post_id, $service_type_override, 'service_type', false );
            }
        }

        return $post_id;
    }

    // 4) Stop here when not allowed to create (e.g., JSONL-only enrichment)
    if ( ! $create_if_missing ) {
        return 0;
    }

    // 5) Create new service
    $type_slug = $service_type_override ?: smoothmigration_guess_type_from_filename( $brand_name );

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
    if ( $type_slug ) {
        wp_set_object_terms( $post_id, $type_slug, 'service_type', false );
    }

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
 * Import services from a country-level *_context.jsonl file if present in the container path.
 *
 * Each JSONL line is expected to look like the user's example with keys:
 * - text: multi-line string containing sections like Overview:/Why we recommend:/How it helps:/Link:
 * - metadata: { country, partner, category, widget? }
 *
 * Behavior:
 * - Upsert a `service` per partner (using canonical mapping)
 * - Assign taxonomy from metadata.category when available
 * - Set/append region (country)
 * - Set affiliate URL from Link: in text when present
 * - Build post_content from the parsed sections; overwrite only if requested or if empty
 * - Store optional widget HTML (sanitized) into _service_widget_html meta and append to content
 */
function smoothmigration_import_services_from_country_jsonl( string $container_path, string $region = '', bool $overwrite = false ): array {
    $result = array(
        'success' => true,
        'message' => '',
        'processed' => 0,
        'errors' => array(),
        'debug' => '',
    );

    // Find *_context.jsonl in the container folder
    $pattern = rtrim( $container_path, '/\\' ) . '/*_context.jsonl';
    $matches = glob( $pattern );

    if ( empty( $matches ) ) {
        $result['message'] = 'No JSONL context file found.';
        return $result;
    }

    $jsonl_path = $matches[0];
    $lines_processed = 0;

    $fh = @fopen( $jsonl_path, 'r' );
    if ( ! $fh ) {
        return array( 'success' => false, 'message' => 'Could not open JSONL file for reading.', 'processed' => 0, 'errors' => array(), 'debug' => '' );
    }

    while ( ( $line = fgets( $fh ) ) !== false ) {
        $line = trim( $line );
        if ( $line === '' ) { continue; }
        $row = json_decode( $line, true );
        if ( ! is_array( $row ) ) { continue; }

        $text     = (string) ( $row['text'] ?? '' );
        $meta     = (array)  ( $row['metadata'] ?? array() );
        $partner  = trim( (string) ( $meta['partner'] ?? '' ) );
        $country  = trim( (string) ( $meta['country'] ?? $region ) );
        $category = trim( (string) ( $meta['category'] ?? '' ) );
        $widget   = isset( $meta['widget'] ) ? (string) $meta['widget'] : '';

        if ( $partner === '' ) { continue; }

        // Extract sections from `$text`
        $overview = '';
        $why      = '';
        $how      = '';
        $link     = '';

        if ( preg_match( '/Overview:\s*(.+?)(?:\n[A-Z][^\n]+:|\Z)/si', $text, $m ) ) {
            $overview = trim( $m[1] );
        }
        if ( preg_match( '/Why\s+we\s+recommend:\s*(.+?)(?:\n[A-Z][^\n]+:|\Z)/si', $text, $m ) ) {
            $why = trim( $m[1] );
        }
        if ( preg_match( '/How\s+it\s+helps:\s*(.+?)(?:\n[A-Z][^\n]+:|\Z)/si', $text, $m ) ) {
            $how = trim( $m[1] );
        }
        if ( preg_match( '/Link:\s*([^\s]+)/i', $text, $m ) ) {
            $link = esc_url_raw( trim( $m[1] ) );
        }

        // Canonical brand mapping and service type
        list( $brand_name, $brand_slug ) = smoothmigration_enhanced_brand_mapping( $partner );
        $type_slug = $category ? smoothmigration_map_service_type_folder( $category ) : smoothmigration_guess_type_from_filename( $brand_name );

        // Find existing service only (do not create from JSONL)
        $service_id = smoothmigration_find_or_create_service( $brand_name, $brand_slug, $country, $type_slug, false );

        // Fallback: try normalized partner label if initial lookup failed (handles parentheses, etc.)
        if ( ! $service_id ) {
            $normalized_partner = smoothmigration_normalize_partner_label( $partner );
            if ( $normalized_partner !== $partner ) {
                list( $brand_name, $brand_slug ) = smoothmigration_enhanced_brand_mapping( $normalized_partner );
                $service_id = smoothmigration_find_or_create_service( $brand_name, $brand_slug, $country, $type_slug, false );
            }
        }

        if ( ! $service_id ) {
            $result['errors'][] = 'Skipped JSONL update; service not initialized from folders: ' . $brand_name;
            continue;
        }

        // Build content from sections
        $content_parts = array();
        if ( $overview !== '' ) { $content_parts[] = '<h2>Overview</h2><p>' . wp_kses_post( $overview ) . '</p>'; }
        if ( $why !== '' )      { $content_parts[] = '<h3>Why we recommend</h3><p>' . wp_kses_post( $why ) . '</p>'; }
        if ( $how !== '' )      { $content_parts[] = '<h3>How it helps</h3><p>' . wp_kses_post( $how ) . '</p>'; }

        // Optional widget (limited allowed tags/attrs)
        if ( $widget ) {
            $allowed = array(
                'object' => array( 'data' => true, 'width' => true, 'height' => true, 'type' => true, 'title' => true, 'class' => true ),
                'param'  => array( 'name' => true, 'value' => true ),
                'embed'  => array( 'src' => true, 'type' => true, 'width' => true, 'height' => true, 'allowfullscreen' => true, 'allowscriptaccess' => true ),
                'iframe' => array( 'src' => true, 'width' => true, 'height' => true, 'frameborder' => true, 'allow' => true, 'allowfullscreen' => true, 'title' => true, 'class' => true ),
            );
            $widget_safe = wp_kses( $widget, $allowed );
            if ( $widget_safe ) {
                update_post_meta( $service_id, '_service_widget_html', $widget_safe );
            }
        }

        $new_content = implode( "\n", $content_parts );

        // Respect overwrite flag or only fill if empty
        $existing = get_post( $service_id );
        $existing_content = $existing ? (string) $existing->post_content : '';
        if ( $overwrite || $existing_content === '' ) {
            wp_update_post( array( 'ID' => $service_id, 'post_content' => $new_content ) );
        }

        // Affiliate URL from JSONL text has precedence when present
        if ( $link ) {
            update_post_meta( $service_id, '_service_affiliate_url', $link );
        }

        // Ensure taxonomy assignment and regions
        if ( $type_slug ) {
            $current_types = wp_get_post_terms( $service_id, 'service_type', array( 'fields' => 'ids' ) );
            if ( $overwrite || empty( $current_types ) ) {
                wp_set_object_terms( $service_id, $type_slug, 'service_type', false );
            }
        }
        if ( $country ) {
            $existing_regions = (string) get_post_meta( $service_id, '_service_regions', true );
            $regions_array = array_filter( array_map( 'trim', explode( ',', $existing_regions ) ) );
            if ( ! in_array( $country, $regions_array, true ) ) {
                $regions_array[] = $country;
                update_post_meta( $service_id, '_service_regions', implode( ', ', $regions_array ) );
            }
        }

        $lines_processed++;
    }

    fclose( $fh );

    $result['processed'] = $lines_processed;
    $result['message'] = 'Processed ' . intval( $lines_processed ) . ' JSONL records.';
    $result['debug'] = 'JSONL file: ' . basename( $jsonl_path );

    return $result;
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
 * Debug folder structure without importing
 */
function smoothmigration_debug_folder_structure( string $base_path ): array {
    $debug_info = array();
    
    // Analyze the extracted content
    $all_items = scandir( $base_path );
    $folders = array_filter( $all_items, function( $item ) use ( $base_path ) {
        return $item !== '.' && $item !== '..' && is_dir( $base_path . '/' . $item );
    });
    
    $debug_info[] = "=== ROOT LEVEL ANALYSIS ===";
    $debug_info[] = "Base path: " . $base_path;
    $debug_info[] = "Total items found: " . count( $all_items );
    $debug_info[] = "Folders found: " . implode( ', ', $folders );
    
    // Find the container folder
    $container_path = smoothmigration_find_brand_container_folder( $base_path );
    $debug_info[] = "Selected container path: " . $container_path;
    
    if ( $container_path !== $base_path ) {
        $debug_info[] = "Container folder detected: " . basename( $container_path );
    }
    
    // Detect structure type
    $structure = smoothmigration_detect_folder_structure( $container_path );
    $debug_info[] = "Structure detected: " . $structure['type'];

    // JSONL presence summary
    $jsonl_matches = glob( rtrim( $container_path, '/\\' ) . '/*_context.jsonl' );
    if ( ! empty( $jsonl_matches ) ) {
        $debug_info[] = "JSONL found: " . basename( $jsonl_matches[0] );
        // Count lines quickly
        $line_count = 0;
        $fh = @fopen( $jsonl_matches[0], 'r' );
        if ( $fh ) { while ( fgets( $fh ) !== false ) { $line_count++; } fclose( $fh ); }
        $debug_info[] = "JSONL records: " . $line_count;
    } else {
        $debug_info[] = "JSONL found: none";
    }
    
    if ( $structure['type'] === '3-layer' ) {
        // Analyze brand folders directly
        $debug_info[] = "";
        $debug_info[] = "=== 3-LAYER STRUCTURE ANALYSIS ===";
        $debug_info[] = "Brand folders found: " . count( $structure['brands'] );
        $debug_info[] = "Brand folder names: " . implode( ', ', $structure['brands'] );
        
        foreach ( $structure['brands'] as $brand_folder ) {
            $brand_path = $container_path . '/' . $brand_folder;
            $debug_info = array_merge( $debug_info, smoothmigration_debug_brand_folder( $brand_path, $brand_folder ) );
        }
        
    } elseif ( $structure['type'] === '4-layer' ) {
        // Analyze service type folders, then brand folders within
        $debug_info[] = "";
        $debug_info[] = "=== 4-LAYER STRUCTURE ANALYSIS ===";
        $debug_info[] = "Service type folders found: " . count( $structure['service_types'] );
        $debug_info[] = "Service type folder names: " . implode( ', ', $structure['service_types'] );
        
        foreach ( $structure['service_types'] as $service_type_folder ) {
            $service_type_path = $container_path . '/' . $service_type_folder;
            $service_type_slug = smoothmigration_map_service_type_folder( $service_type_folder );
            
            $debug_info[] = "";
            $debug_info[] = "=== SERVICE TYPE: " . $service_type_folder . " ===";
            $debug_info[] = "Mapped to taxonomy: " . $service_type_slug;
            
            $brand_folders = array_filter( scandir( $service_type_path ), function( $item ) use ( $service_type_path ) {
                $full_path = $service_type_path . '/' . $item;
                return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
            });
            
            $debug_info[] = "Brand folders in " . $service_type_folder . ": " . implode( ', ', $brand_folders );
            
            foreach ( $brand_folders as $brand_folder ) {
                $brand_path = $service_type_path . '/' . $brand_folder;
                $debug_info = array_merge( $debug_info, smoothmigration_debug_brand_folder( $brand_path, $brand_folder, $service_type_folder, $service_type_slug ) );
            }
        }
    }
    
    // System folders found
    $system_folders = array_filter( $folders, function( $folder ) {
        return smoothmigration_is_system_folder( $folder );
    });
    
    if ( ! empty( $system_folders ) ) {
        $debug_info[] = "";
        $debug_info[] = "=== SYSTEM FOLDERS (IGNORED) ===";
        $debug_info[] = implode( ', ', $system_folders );
    }
    
    $total_brands = 0;
    if ( $structure['type'] === '3-layer' ) {
        $total_brands = count( $structure['brands'] ?? array() );
    } elseif ( $structure['type'] === '4-layer' ) {
        foreach ( $structure['service_types'] ?? array() as $service_type_folder ) {
            $service_type_path = $container_path . '/' . $service_type_folder;
            $brand_folders = array_filter( scandir( $service_type_path ), function( $item ) use ( $service_type_path ) {
                $full_path = $service_type_path . '/' . $item;
                return $item !== '.' && $item !== '..' && is_dir( $full_path ) && ! smoothmigration_is_system_folder( $item );
            });
            $total_brands += count( $brand_folders );
        }
    }
    
    return array(
        'success' => true,
        'message' => sprintf( 'Debug analysis complete. Found %s structure with %d total brand folders.', $structure['type'], $total_brands ),
        'debug' => implode( "\n", $debug_info ),
        'processed' => 0,
        'errors' => array()
    );
}

/**
 * Debug a single brand folder
 */
function smoothmigration_debug_brand_folder( string $brand_path, string $brand_folder, string $service_type_folder = '', string $service_type_slug = '' ): array {
    $debug_info = array();
    
    $debug_info[] = "";
    $debug_info[] = "--- Brand: " . $brand_folder . " ---";
    
    list( $canonical_brand, $brand_slug ) = smoothmigration_enhanced_brand_mapping( $brand_folder );
    $debug_info[] = "Canonical name: " . $canonical_brand;
    $debug_info[] = "Slug: " . $brand_slug;
    
    if ( $service_type_slug ) {
        $debug_info[] = "Service type (from folder): " . $service_type_slug;
    } else {
        $service_type = smoothmigration_guess_type_from_filename( $canonical_brand );
        $debug_info[] = "Service type (guessed): " . $service_type;
    }
    
    // Analyze images
    $all_brand_files = is_dir( $brand_path ) ? scandir( $brand_path ) : array();
    $brand_files = array_filter( $all_brand_files, function( $file ) {
        return $file !== '.' && $file !== '..';
    });
    
    $image_files = smoothmigration_get_image_files( $brand_path );
    
    $debug_info[] = "Total files in folder: " . count( $brand_files );
    $debug_info[] = "All files: " . implode( ', ', array_slice( $brand_files, 0, 5 ) ) . ( count( $brand_files ) > 5 ? '...' : '' );
    $debug_info[] = "Image files found: " . count( $image_files );
    
    if ( ! empty( $image_files ) ) {
        $debug_info[] = "Image files: " . implode( ', ', $image_files );
        
        // Analyze variants
        $variants = array();
        foreach ( $image_files as $image ) {
            $variant = smoothmigration_classify_logo_variant( $image );
            $variants[] = $image . " -> " . $variant;
        }
        $debug_info[] = "Logo variants: " . implode( ', ', array_slice( $variants, 0, 3 ) ) . ( count( $variants ) > 3 ? '...' : '' );
    } else {
        $debug_info[] = "❌ No image files found in this brand folder";
    }
    
    return $debug_info;
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
        if ( ! empty( $results['structure_type'] ) ) {
            echo '<p><strong>Structure detected:</strong> ' . esc_html( ucwords( str_replace( '-', ' ', $results['structure_type'] ) ) ) . '</p>';
        }
        if ( ! empty( $results['errors'] ) ) {
            echo '<p><strong>Errors:</strong></p><ul>';
            foreach ( $results['errors'] as $error ) {
                echo '<li>' . esc_html( $error ) . '</li>';
            }
            echo '</ul>';
        }
        if ( ! empty( $results['debug'] ) ) {
            echo '<div style="background: #f6f7f7; padding: 15px; border-radius: 3px; margin: 10px 0;">';
            echo '<p><strong>Debug Info:</strong></p>';
            echo '<pre style="white-space: pre-wrap; font-family: monospace; font-size: 12px;">' . esc_html( $results['debug'] ) . '</pre>';
            echo '</div>';
        }
        echo '</div>';
    }
    
    ?>
    <div class="wrap">
        <h1>Bulk Service Import</h1>
        <p>Import services by uploading a folder structure or zip file. Each subfolder should represent a brand, with logo images inside.</p>
        
        <div class="card">
            <h2>Supported Folder Structures</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <h3>4-Layer Structure (Recommended)</h3>
                    <pre style="font-size: 11px;">
South Africa/
├── Banking Services/
│   ├── Wise/
│   │   ├── logo-primary.png
│   │   └── logo-white.png
│   └── Remitly/
│       └── remitly-dark.png
├── Telecommunication/
│   └── Airalo/
│       └── airalo-logo.png
└── Vehicle Services/
    └── Rentcars/
        └── rentcars-logo.png
                    </pre>
                </div>
                <div>
                    <h3>3-Layer Structure (Legacy)</h3>
                    <pre style="font-size: 11px;">
South Africa/
├── Airalo/
│   ├── logo-primary.png
│   └── logo-white.png
├── Wise/
│   └── wise-logo.png
└── Remitly/
    └── remitly-dark.png
                    </pre>
                </div>
            </div>
            <p><strong>4-Layer Benefits:</strong></p>
            <ul>
                <li><strong>Automatic categorization</strong> - Service types determined from folder names</li>
                <li><strong>Better organization</strong> - Group services by type (Money, Telecom, etc.)</li>
                <li><strong>Accurate taxonomy assignment</strong> - No more guessing service categories</li>
                <li><strong>Scalable structure</strong> - Easy to add new service types</li>
            </ul>
            <p><strong>🐞 Troubleshooting:</strong> Use <strong>Debug Mode</strong> to analyze your folder structure and see which format is detected.</p>
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
                            </label><br>
                            <label>
                                <input type="radio" name="import_method" value="debug">
                                Debug Mode (analyze folder structure without importing)
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
                <tr>
                    <th scope="row">
                        <label for="overwrite_content">Overwrite Content</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="overwrite_content" id="overwrite_content" value="1">
                            Overwrite existing service content with JSONL content (if JSONL is present)
                        </label>
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
                    if (this.value === 'zip' || this.value === 'debug') {
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
    $overwrite = ! empty( $_POST['overwrite_content'] );
    
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
        $import_path = smoothmigration_find_brand_container_folder( $extracted_path );

        // First, process the folder structure to initialize services (logos + slugs/types)
        $folder_results = smoothmigration_process_folder_structure( $import_path, $region );

        // Then, enrich with JSONL-driven content if present (no new services created)
        $jsonl_results = smoothmigration_import_services_from_country_jsonl( $import_path, $region, $overwrite );

        // Merge results for display
        $results = array(
            'success' => ( ! empty( $folder_results['success'] ) && ! empty( $jsonl_results['success'] ) ),
            'message' => trim( ( $folder_results['message'] ? '[LOGOS] ' . $folder_results['message'] : '' ) . ' ' . ( $jsonl_results['message'] ? '[JSONL] ' . $jsonl_results['message'] : '' ) ),
            'processed' => intval( $folder_results['processed'] ?? 0 ) + intval( $jsonl_results['processed'] ?? 0 ),
            'errors' => array_merge( $folder_results['errors'] ?? array(), $jsonl_results['errors'] ?? array() ),
            'services_created' => $folder_results['services_created'] ?? array(),
            'structure_type' => $folder_results['structure_type'] ?? '',
            'debug' => trim( ( $folder_results['debug'] ?? '' ) . "\n" . ( $jsonl_results['debug'] ?? '' ) ),
        );
        
        // Clean up temporary files
        smoothmigration_cleanup_temp_files( $extracted_path );
        
        return $results;
        
    } elseif ( $method === 'existing' ) {
        $folder_path = sanitize_text_field( $_POST['folder_path'] ?? '' );
        
        if ( ! $folder_path || ! is_dir( $folder_path ) ) {
            return array( 'success' => false, 'message' => 'Invalid folder path specified.' );
        }

        // Align behavior with ZIP: process logos, then enrich via JSONL if present
        $import_path = smoothmigration_find_brand_container_folder( $folder_path );
        $folder_results = smoothmigration_process_folder_structure( $import_path, $region );
        $jsonl_results = smoothmigration_import_services_from_country_jsonl( $import_path, $region, $overwrite );

        return array(
            'success' => ( ! empty( $folder_results['success'] ) && ! empty( $jsonl_results['success'] ) ),
            'message' => trim( ( $folder_results['message'] ? '[LOGOS] ' . $folder_results['message'] : '' ) . ' ' . ( $jsonl_results['message'] ? '[JSONL] ' . $jsonl_results['message'] : '' ) ),
            'processed' => intval( $folder_results['processed'] ?? 0 ) + intval( $jsonl_results['processed'] ?? 0 ),
            'errors' => array_merge( $folder_results['errors'] ?? array(), $jsonl_results['errors'] ?? array() ),
            'services_created' => $folder_results['services_created'] ?? array(),
            'structure_type' => $folder_results['structure_type'] ?? '',
            'debug' => trim( ( $folder_results['debug'] ?? '' ) . "\n" . ( $jsonl_results['debug'] ?? '' ) ),
        );
    
    } elseif ( $method === 'debug' ) {
        if ( ! isset( $_FILES['zip_file'] ) || $_FILES['zip_file']['error'] !== UPLOAD_ERR_OK ) {
            return array( 'success' => false, 'message' => 'No zip file uploaded or upload error occurred for debug mode.' );
        }
        
        // Handle zip upload for debugging
        $zip_result = smoothmigration_handle_zip_upload( $_FILES['zip_file'], $region );
        if ( ! $zip_result['success'] ) {
            return $zip_result;
        }
        
        // Analyze the folder structure without importing
        $extracted_path = $zip_result['extracted_path'];
        $debug_results = smoothmigration_debug_folder_structure( $extracted_path );
        
        // Clean up temporary files
        smoothmigration_cleanup_temp_files( $extracted_path );
        
        return $debug_results;
    }
    
    return array( 'success' => false, 'message' => 'Invalid import method.' );
}
