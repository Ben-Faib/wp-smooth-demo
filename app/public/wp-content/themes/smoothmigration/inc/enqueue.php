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
    $asset_nonce = get_option( 'sm_asset_nonce', '1' );
    $ver = SMOOTHMIGRATION_VERSION . '-' . $asset_nonce;
    // Bootstrap CSS & JS (via CDN)
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    
    // Remove potential conflicting FA styles from plugins/builders
    $fa_conflicts = array(
        'fontawesome', 'font-awesome', 'fontawesome-free', 'fa', 'elementor-icons-fa-solid',
        'elementor-icons-fa-regular', 'elementor-icons-fa-brands', 'elementor-icons-shared-0'
    );
    foreach ( $fa_conflicts as $handle ) {
        wp_dequeue_style( $handle );
        wp_deregister_style( $handle );
    }
    // Our Font Awesome (v6) - enqueue under a unique handle to avoid collisions
    wp_enqueue_style( 'smooth-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
    
    // Typography: Aileron (via CDNFonts) and Playfair Display (Google)
    wp_enqueue_style( 'aileron-font', 'https://fonts.cdnfonts.com/css/aileron', array(), null );
    wp_enqueue_style( 'playfair-font', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap', array(), null );

    // Theme stylesheet (depends on Bootstrap and fonts so we place it after)
    wp_enqueue_style( 'smoothmigration-style', get_stylesheet_uri(), array( 'bootstrap', 'smooth-fa', 'aileron-font', 'playfair-font' ), $ver );

    // Bootstrap bundle (includes Popper)
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
    
    // Custom theme JavaScript
    wp_enqueue_script( 'smoothmigration-js', get_template_directory_uri() . '/assets/js/theme.js', array( 'bootstrap' ), $ver, true );

    // Landing Page specific styles and scripts (only load on front page)
    if ( is_front_page() ) {
        wp_enqueue_style( 'landing-page', get_template_directory_uri() . '/assets/css/landing-page.css', array( 'smoothmigration-style' ), $ver );
        wp_enqueue_script( 'landing-page-js', get_template_directory_uri() . '/assets/js/landing-page.js', array( 'bootstrap', 'smoothmigration-js' ), $ver, true );
        
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

// Late pass to ensure no plugin re-adds old FA after our enqueue
function smoothmigration_ensure_fa_last() {
    $fa_conflicts = array(
        'fontawesome', 'font-awesome', 'fontawesome-free', 'fa', 'elementor-icons-fa-solid',
        'elementor-icons-fa-regular', 'elementor-icons-fa-brands', 'elementor-icons-shared-0'
    );
    foreach ( $fa_conflicts as $handle ) {
        wp_dequeue_style( $handle );
        wp_deregister_style( $handle );
    }
    if ( ! wp_style_is( 'smooth-fa', 'enqueued' ) ) {
        wp_enqueue_style( 'smooth-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
    }
}
add_action( 'wp_enqueue_scripts', 'smoothmigration_ensure_fa_last', 999 );