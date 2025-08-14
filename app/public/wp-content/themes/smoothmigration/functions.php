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

// Custom post types and taxonomies.
require_once get_template_directory() . '/inc/cpt-service.php';

// Integrations.
require_once get_template_directory() . '/inc/elementor.php';

// Demo content.
require_once get_template_directory() . '/inc/demo-content.php';

// Importer utilities for creating services from uploaded logos.
require_once get_template_directory() . '/inc/service-import.php';
// Helpers for logos and rendering choices
require_once get_template_directory() . '/inc/service-helpers.php';
// Options page for data-driven content
require_once get_template_directory() . '/inc/options.php';