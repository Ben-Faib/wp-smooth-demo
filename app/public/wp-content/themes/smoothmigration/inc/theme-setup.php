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

    // Register navigation menu.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'smoothmigration' ),
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