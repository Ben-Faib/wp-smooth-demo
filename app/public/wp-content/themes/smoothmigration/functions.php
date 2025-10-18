<?php
/**
 * Smooth Migration Theme functions and definitions
 *
 * @package smoothmigration
 */

if ( ! defined( 'SMOOTHMIGRATION_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'SMOOTHMIGRATION_VERSION', '1.0.0' );
}

// Core theme functions.
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/ajax.php';
require_once get_template_directory() . '/inc/seo-meta.php';
// Enforce consistent document titles across all pages
require_once get_template_directory() . '/inc/title-format.php';
require_once get_template_directory() . '/inc/icons.php';
// Performance/optimization filters (LiteSpeed exclusions, script attrs)
require_once get_template_directory() . '/inc/optimize-filters.php';
// Locale switcher (hard-coded region/domain map and glass UI)
require_once get_template_directory() . '/inc/locale-switcher.php';

// Custom post types and taxonomies.
require_once get_template_directory() . '/inc/cpt-service.php';
require_once get_template_directory() . '/inc/cpt-guide.php';

// Guide helper functions.
require_once get_template_directory() . '/inc/guide-helpers.php';
require_once get_template_directory() . '/inc/guide-demo-content.php';

// Integrations.
// Elementor integration removed

// Demo content.
require_once get_template_directory() . '/inc/demo-content.php';

// Importer utilities for creating services from uploaded logos.
require_once get_template_directory() . '/inc/service-import.php';
// Bulk import system for folder/zip uploads
require_once get_template_directory() . '/inc/bulk-import.php';
// Single service import tool for domain-specific updates
require_once get_template_directory() . '/inc/service-single-import.php';
// Demo script for bulk import (add ?bulk_import_demo=1 to test)
require_once get_template_directory() . '/bulk-import-demo.php';
// 4-layer structure conversion guide (add ?test_4layer=1 to test)
require_once get_template_directory() . '/test-4layer-structure.php';
// Helpers for logos and rendering choices
require_once get_template_directory() . '/inc/service-helpers.php';
// NBC-specific content sections and shortcodes
require_once get_template_directory() . '/inc/nbc-sections.php';
// Options page for data-driven content
require_once get_template_directory() . '/inc/options.php';
// Stats helpers and shortcodes
require_once get_template_directory() . '/inc/stats.php';
// Globe shortcode and assets
require_once get_template_directory() . '/inc/globe.php';
// Unified Service Tools (bulk import + delete UIs)
require_once get_template_directory() . '/inc/service-tools.php';

// Media taxonomies (Asset Type: Brand Logo)
require_once get_template_directory() . '/inc/media-taxonomies.php';
// Media bulk assignment tool
require_once get_template_directory() . '/inc/media-bulk-assign.php';

// Allow SVG uploads for vector logos
add_filter( 'upload_mimes', function( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
} );

// Redirect old telecommunication slug to new data-and-phone-plans
add_action( 'template_redirect', function() {
    if ( is_tax( 'service_type', 'telecommunication' ) ) {
        wp_redirect( home_url( '/service-type/data-and-phone-plans/' ), 301 );
        exit;
    }
    if ( is_tax( 'service_type', 'money-services' ) ) {
        wp_redirect( home_url( '/service-type/banking-services/' ), 301 );
        exit;
    }
});