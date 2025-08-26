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
require_once get_template_directory() . '/inc/icons.php';
// Locale switcher (hard-coded region/domain map and glass UI)
require_once get_template_directory() . '/inc/locale-switcher.php';

// Custom post types and taxonomies.
require_once get_template_directory() . '/inc/cpt-service.php';
require_once get_template_directory() . '/inc/cpt-guide.php';

// Guide helper functions.
require_once get_template_directory() . '/inc/guide-helpers.php';
require_once get_template_directory() . '/inc/guide-demo-content.php';

// Integrations.
require_once get_template_directory() . '/inc/elementor.php';

// Demo content.
require_once get_template_directory() . '/inc/demo-content.php';

// Importer utilities for creating services from uploaded logos.
require_once get_template_directory() . '/inc/service-import.php';
// Bulk import system for folder/zip uploads
require_once get_template_directory() . '/inc/bulk-import.php';
// Demo script for bulk import (add ?bulk_import_demo=1 to test)
require_once get_template_directory() . '/bulk-import-demo.php';
// Helpers for logos and rendering choices
require_once get_template_directory() . '/inc/service-helpers.php';
// Options page for data-driven content
require_once get_template_directory() . '/inc/options.php';
// Stats helpers and shortcodes
require_once get_template_directory() . '/inc/stats.php';

// Media taxonomies (Asset Type: Brand Logo)
require_once get_template_directory() . '/inc/media-taxonomies.php';
// Media bulk assignment tool
require_once get_template_directory() . '/inc/media-bulk-assign.php';