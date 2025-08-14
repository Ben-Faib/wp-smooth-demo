<?php
/**
 * Enqueue scripts and styles.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue styles and scripts.
 */
function smoothmigration_enqueue_assets() {
    // Bootstrap CSS & JS (via CDN)
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    
    // Font Awesome for icons
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
    
    // Google Fonts - Aileron (body) and a serif accent for headings (Playfair Display as an accessible, elegant serif)
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Aileron:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap', array(), null );

    // Theme stylesheet (depends on Bootstrap so we place it after)
    wp_enqueue_style( 'smoothmigration-style', get_stylesheet_uri(), array( 'bootstrap', 'font-awesome', 'google-fonts' ), SMOOTHMIGRATION_VERSION );

    // Bootstrap bundle (includes Popper)
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
    
    // Custom theme JavaScript
    wp_enqueue_script( 'smoothmigration-js', get_template_directory_uri() . '/assets/js/theme.js', array( 'bootstrap' ), SMOOTHMIGRATION_VERSION, true );

    // Landing Page specific styles and scripts (only load on front page)
    if ( is_front_page() ) {
        wp_enqueue_style( 'landing-page', get_template_directory_uri() . '/assets/css/landing-page.css', array( 'smoothmigration-style' ), SMOOTHMIGRATION_VERSION );
        wp_enqueue_script( 'landing-page-js', get_template_directory_uri() . '/assets/js/landing-page.js', array( 'bootstrap', 'smoothmigration-js' ), SMOOTHMIGRATION_VERSION, true );
        
        // Pass data to landing page JavaScript
        wp_localize_script( 'landing-page-js', 'smoothmigrationAjax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'smoothmigration_contact_nonce' )
        ) );
    }

    // Quick View Assets (only load if the quick view modal is likely to be used)
    if ( is_page( 'services' ) || is_singular( 'service' ) || is_tax( 'service_type' ) ) {
        wp_enqueue_style( 'quick-view', get_template_directory_uri() . '/assets/css/quick-view.css', array(), SMOOTHMIGRATION_VERSION );
        wp_enqueue_script( 'quick-view-js', get_template_directory_uri() . '/assets/js/quick-view.js', array( 'jquery' ), SMOOTHMIGRATION_VERSION, true );
        
        // Pass data to JavaScript
        wp_localize_script( 'quick-view-js', 'smoothmigration', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'smoothmigration_quick_view_nonce' )
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'smoothmigration_enqueue_assets' ); 