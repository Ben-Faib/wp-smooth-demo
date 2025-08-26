<?php
/**
 * Bulk Import Demo Script
 * 
 * This script demonstrates how the bulk import system would work with
 * the South Africa folder structure provided by the user.
 * 
 * Usage: Add ?bulk_import_demo=1 to any admin page URL to test
 * 
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Demo activation via query parameter
if ( isset( $_GET['bulk_import_demo'] ) && $_GET['bulk_import_demo'] === '1' && is_admin() && current_user_can( 'manage_options' ) ) {
    add_action( 'admin_notices', 'smoothmigration_bulk_import_demo_notice' );
    add_action( 'admin_init', 'smoothmigration_run_bulk_import_demo' );
}

function smoothmigration_bulk_import_demo_notice() {
    ?>
    <div class="notice notice-info">
        <h3>🚀 Bulk Import Demo Mode Active</h3>
        <p><strong>Simulating import of South Africa folder structure...</strong></p>
        <p>This demo shows how the system would process your folder structure:</p>
        <pre style="background: #f6f7f7; padding: 10px; border-radius: 3px;">
4-Layer Structure Example:
South Africa/
├── Money Services/
│   ├── Wise/ (5 images)
│   ├── Remitly/ (6 images)
│   └── XE Money transfers/ (7 images)
├── Telecommunication/
│   └── Airalo/ (3 images)
├── Vehicle Services/
│   ├── Rentcars.com/ (10 images)
│   └── Expat Ride/ (5 images)
├── International Moving/
│   └── Sirelo(expertsinmoving)/ (8 images)
└── Insurance/
    └── Covermore/ (4 images)
        </pre>
        <p><strong>Debug Info:</strong> Each folder would be processed as a separate service with automatic logo variant assignment.</p>
    </div>
    <?php
}

function smoothmigration_run_bulk_import_demo() {
    // Simulate the folder structure processing
    $demo_folders = array(
        'Airalo' => array('logo-primary.png', 'logo-white.png', 'logo-square.png'),
        'Wise' => array('wise-logo.png', 'wise-dark.png', 'wise-light.png', 'wise-badge.png', 'wise-horizontal.png'),
        'Remitly' => array('remitly-logo.png', 'remitly-white.png', 'remitly-dark.png', 'remitly-square.png', 'remitly-horizontal.png', 'remitly-vertical.png'),
        'Rentcars.com' => array('rentcars-1.png', 'rentcars-2.png', 'rentcars-logo.png', 'rentcars-white.png', 'rentcars-dark.png', 'rentcars-square.png', 'rentcars-badge.png', 'rentcars-horizontal.png', 'rentcars-vertical.png', 'rentcars-icon.png'),
        'XE Money transfers' => array('xe-logo.png', 'xe-white.png', 'xe-dark.png', 'xe-square.png', 'xe-badge.png', 'xe-horizontal.png', 'xe-vertical.png'),
        'Sirelo(expertsinmoving)' => array('sirelo-logo.png', 'sirelo-white.png', 'sirelo-dark.png', 'sirelo-square.png', 'sirelo-badge.png', 'sirelo-horizontal.png', 'sirelo-vertical.png', 'sirelo-experts.png'),
        'Expat Ride' => array('expatride-logo.png', 'expatride-white.png', 'expatride-dark.png', 'expatride-square.png', 'expatride-badge.png'),
        'Covermore' => array('covermore-logo.png', 'covermore-white.png', 'covermore-dark.png', 'covermore-square.png')
    );
    
    // Demo the brand mapping process
    foreach ( $demo_folders as $folder_name => $images ) {
        list( $canonical_brand, $brand_slug ) = smoothmigration_enhanced_brand_mapping( $folder_name );
        $service_type = smoothmigration_guess_type_from_filename( $canonical_brand );
        
        // Demo logo variant classification
        $variants = array();
        foreach ( $images as $image ) {
            $variant = smoothmigration_classify_logo_variant( $image );
            $variants[] = $variant;
        }
        
        // Store demo results for display
        update_option( 'bulk_import_demo_results', array(
            'folder_name' => $folder_name,
            'canonical_brand' => $canonical_brand,
            'brand_slug' => $brand_slug,
            'service_type' => $service_type,
            'image_count' => count( $images ),
            'variants' => array_count_values( $variants ),
            'sample_images' => array_slice( $images, 0, 3 )
        ));
    }
    
    // Show detailed results
    add_action( 'admin_notices', 'smoothmigration_bulk_import_demo_results' );
}

function smoothmigration_bulk_import_demo_results() {
    $results = get_option( 'bulk_import_demo_results', array() );
    
    if ( empty( $results ) ) {
        return;
    }
    ?>
    <div class="notice notice-success">
        <h3>✅ Demo Processing Complete</h3>
        <p><strong>Last processed folder:</strong> <?php echo esc_html( $results['folder_name'] ); ?></p>
        <table style="background: white; border: 1px solid #ddd; margin: 10px 0;">
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Original Folder</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo esc_html( $results['folder_name'] ); ?></td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Canonical Brand</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo esc_html( $results['canonical_brand'] ); ?></td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Brand Slug</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo esc_html( $results['brand_slug'] ); ?></td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Service Type</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo esc_html( ucwords( str_replace( '-', ' ', $results['service_type'] ) ) ); ?></td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Images Found</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo intval( $results['image_count'] ); ?></td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Logo Variants</th>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    <?php 
                    foreach ( $results['variants'] as $variant => $count ) {
                        echo esc_html( ucwords( str_replace( '_', ' ', $variant ) ) ) . ': ' . intval( $count ) . '<br>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">Sample Images</th>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo esc_html( implode( ', ', $results['sample_images'] ) ); ?></td>
            </tr>
        </table>
        <p><strong>✅ This service would be created/updated with region "South Africa" and all logos imported as variants.</strong></p>
        <p><em>Remove ?bulk_import_demo=1 from the URL to exit demo mode.</em></p>
    </div>
    <?php
    
    // Clear demo results after display
    delete_option( 'bulk_import_demo_results' );
}
