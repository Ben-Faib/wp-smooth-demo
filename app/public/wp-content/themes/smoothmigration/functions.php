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

// On-demand widget cleanup toggle (?sm_clean_widgets=1 in wp-admin).
add_action( 'admin_init', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( empty( $_GET['sm_clean_widgets'] ) ) {
        return;
    }

    $flag = sanitize_text_field( wp_unslash( $_GET['sm_clean_widgets'] ) );
    if ( $flag !== '1' ) {
        return;
    }

    if ( ! function_exists( 'smoothmigration_cleanup_service_widgets' ) ) {
        return;
    }

    $result = smoothmigration_cleanup_service_widgets();

    update_option( 'smoothmigration_widget_cleanup_notice', array(
        'time'          => time(),
        'processed'     => (int) ( $result['processed'] ?? 0 ),
        'removed_ids'   => (array) ( $result['removed_ids'] ?? array() ),
        'kept_ids'      => (array) ( $result['kept_ids'] ?? array() ),
        'forced_ids'    => (array) ( $result['forced_ids'] ?? array() ),
        'toggled_ids'   => (array) ( $result['toggled_ids'] ?? array() ),
        'allowed_slugs' => (array) ( $result['allowed_slugs'] ?? array() ),
    ) );

    wp_safe_redirect( remove_query_arg( 'sm_clean_widgets' ) );
    exit;
} );

add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $notice = get_option( 'smoothmigration_widget_cleanup_notice' );
    if ( empty( $notice['time'] ) ) {
        return;
    }

    delete_option( 'smoothmigration_widget_cleanup_notice' );

    $removed_count = isset( $notice['removed_ids'] ) ? count( (array) $notice['removed_ids'] ) : 0;
    $forced_count  = isset( $notice['forced_ids'] ) ? count( (array) $notice['forced_ids'] ) : 0;
    $toggled_count = isset( $notice['toggled_ids'] ) ? count( (array) $notice['toggled_ids'] ) : 0;
    $allowed_slugs = isset( $notice['allowed_slugs'] ) ? implode( ', ', (array) $notice['allowed_slugs'] ) : '';

    $kept_count = isset( $notice['kept_ids'] ) ? count( (array) $notice['kept_ids'] ) : 0;

    $message  = sprintf(
        'Widget cleanup finished. Removed %1$d widgets; kept %2$d (forced: %3$d, manual off cleared: %4$d).',
        $removed_count,
        $kept_count,
        $forced_count,
        $toggled_count
    );

    if ( $allowed_slugs ) {
        $message .= ' Allowed slugs: ' . $allowed_slugs . '.';
    }

    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html( $message ) . '</p></div>';
} );