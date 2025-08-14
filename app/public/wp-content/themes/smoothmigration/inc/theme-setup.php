<?php
/**
 * Theme setup and widget registration.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Theme setup.
 */
function smoothmigration_theme_setup() {
    // Make theme available for translation.
    load_theme_textdomain( 'smoothmigration', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Register navigation menus.
    register_nav_menus( array(
        'primary'                  => __( 'Primary Menu', 'smoothmigration' ),
        'country_flags'            => __( 'Country Flags', 'smoothmigration' ),
        'how_it_works_links'       => __( 'How It Works Links', 'smoothmigration' ),
        'featured_services'        => __( 'Featured Services', 'smoothmigration' ),
        'footer_categories'        => __( 'Footer Categories', 'smoothmigration' ),
        'social'                   => __( 'Social Links', 'smoothmigration' ),
        'partner_logos_global'     => __( 'Partner Logos (Global)', 'smoothmigration' ),
        'section_category_links'   => __( 'Section Category Links', 'smoothmigration' ),
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

    // Add support for custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Add support for wide alignment
    add_theme_support( 'align-wide' );
    
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for custom color palette
    add_theme_support( 'editor-color-palette' );
    
    // Add support for custom font sizes
    add_theme_support( 'editor-font-sizes' );
}
add_action( 'after_setup_theme', 'smoothmigration_theme_setup' );

/**
 * Improve accessibility attributes for specific menus
 */
function smoothmigration_accessible_menu_link_atts( $atts, $item, $args ) {
    if ( isset( $args->theme_location ) ) {
        // Add aria-labels for country flags menu for better screen reader support
        if ( 'country_flags' === $args->theme_location ) {
            $atts['aria-label'] = isset( $item->title ) ? wp_strip_all_tags( $item->title ) : __( 'Country', 'smoothmigration' );
        }
        // Ensure social icons have aria-labels
        if ( 'social' === $args->theme_location ) {
            $atts['aria-label'] = isset( $item->title ) ? wp_strip_all_tags( $item->title ) : __( 'Social link', 'smoothmigration' );
            $atts['target'] = '_blank';
            $atts['rel'] = 'noopener noreferrer';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'smoothmigration_accessible_menu_link_atts', 10, 3 );

/**
 * Ensure Canada flag appears first in the country flags menu without changing admin order.
 */
function smoothmigration_country_flags_canada_first( $items, $args ) {
    if ( isset( $args->theme_location ) && 'country_flags' === $args->theme_location && is_array( $items ) ) {
        usort( $items, function( $a, $b ) {
            $a_is_canada = ( stripos( $a->title ?? '', 'canada' ) !== false ) || ( isset( $a->url ) && stripos( $a->url, 'canada' ) !== false );
            $b_is_canada = ( stripos( $b->title ?? '', 'canada' ) !== false ) || ( isset( $b->url ) && stripos( $b->url, 'canada' ) !== false );
            if ( $a_is_canada === $b_is_canada ) { return 0; }
            return $a_is_canada ? -1 : 1;
        } );
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'smoothmigration_country_flags_canada_first', 10, 2 );

/**
 * Register widget area.
 */
function smoothmigration_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'smoothmigration' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'smoothmigration' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'smoothmigration_widgets_init' ); 