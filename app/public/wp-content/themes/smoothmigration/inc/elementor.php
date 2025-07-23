<?php
/**
 * Elementor integration.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Theme Support
 */
function smoothmigration_elementor_support() {
    // Add Elementor support for all post types
    add_post_type_support( 'page', 'elementor' );
    add_post_type_support( 'post', 'elementor' );
    add_post_type_support( 'service', 'elementor' );
    
    // Remove default Elementor container width
    update_option( 'elementor_container_width', '1200' );
    
    // Set default Elementor color scheme
    update_option( 'elementor_scheme_color', [
        '1' => '#6610f2', // Primary color
        '2' => '#dc3545', // Secondary color
        '3' => '#ffffff', // Text color
        '4' => '#212529', // Accent color
    ] );
    
    // Set default Elementor typography
    update_option( 'elementor_scheme_typography', [
        '1' => [
            'font_family' => 'Inter',
            'font_weight' => '400',
        ],
        '2' => [
            'font_family' => 'Inter',
            'font_weight' => '500',
        ],
        '3' => [
            'font_family' => 'Inter',
            'font_weight' => '600',
        ],
        '4' => [
            'font_family' => 'Inter',
            'font_weight' => '700',
        ],
    ] );
}
add_action( 'init', 'smoothmigration_elementor_support' );

/**
 * Elementor disable default stylesheet
 */
function smoothmigration_elementor_disable_default_stylesheet() {
    // Disable Elementor default stylesheet if needed
    // This allows the theme to handle all styling
    // update_option( 'elementor_disable_color_schemes', 'yes' );
    // update_option( 'elementor_disable_typography_schemes', 'yes' );
}
add_action( 'elementor/init', 'smoothmigration_elementor_disable_default_stylesheet' );

/**
 * Add admin page for Elementor setup
 */
function smoothmigration_add_elementor_setup_page() {
    add_theme_page(
        'Elementor Setup',
        'Elementor Setup',
        'manage_options',
        'elementor-setup',
        'smoothmigration_elementor_setup_page'
    );
}
add_action( 'admin_menu', 'smoothmigration_add_elementor_setup_page' );

/**
 * Elementor setup page content.
 */
function smoothmigration_elementor_setup_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p>This page helps you set up the initial Elementor pages for the Smooth Migration theme.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field( 'smoothmigration_elementor_setup_nonce', 'smoothmigration_elementor_nonce' ); ?>
            <button type="submit" name="create_elementor_pages" class="button button-primary">Create Elementor Pages</button>
        </form>
    </div>
    <?php
} 