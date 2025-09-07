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
    $theme_dir = get_template_directory();
    $child_dir = get_stylesheet_directory();

    $file_ver = function( $relative_path, $is_child = false ) use ( $theme_dir, $child_dir ) {
        $base = $is_child ? $child_dir : $theme_dir;
        $path = rtrim( $base, '/' ) . '/' . ltrim( $relative_path, '/' );
        $mtime = @filemtime( $path );
        if ( $mtime ) {
            return (string) $mtime;
        }
        // Fallback to theme version to avoid empty versions
        return defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0';
    };
    // Bootstrap CSS & JS (via CDN)
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    
    // Remove potential conflicting FA styles from plugins/builders
    $fa_conflicts = array(
        'fontawesome', 'font-awesome', 'fontawesome-free', 'fa'
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

    // Theme stylesheet (child-first if present)
    $style_ver = $file_ver( 'style.css', true );
    wp_enqueue_style( 'smoothmigration-style', get_stylesheet_uri(), array( 'bootstrap', 'smooth-fa', 'aileron-font', 'playfair-font' ), $style_ver );

    // Icon utilities (sizes, motion preferences)
    wp_enqueue_style( 'sm-icons', get_template_directory_uri() . '/assets/css/icons.css', array( 'smoothmigration-style' ), $file_ver( 'assets/css/icons.css' ) );

    // Widget fixes for floating elements and chat widgets
    wp_enqueue_style( 'widget-fixes', get_template_directory_uri() . '/assets/css/widget-fixes.css', array( 'smoothmigration-style' ), $file_ver( 'assets/css/widget-fixes.css' ) );

    // Bootstrap bundle (includes Popper)
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
    
    // Custom theme JavaScript
    wp_enqueue_script( 'smoothmigration-js', get_template_directory_uri() . '/assets/js/theme.js', array( 'bootstrap' ), $file_ver( 'assets/js/theme.js' ), true );

    // Enqueue guides system JavaScript on guides pages
    if ( is_page_template( 'page-guides-enhanced.php' ) || is_page_template( 'page-guides.php' ) || is_singular( 'guide' ) ) {
        wp_enqueue_script( 'smoothmigration-guides', get_template_directory_uri() . '/assets/js/guides.js', array( 'smoothmigration-js' ), $file_ver( 'assets/js/guides.js' ), true );
        
        // Localize guides script
        wp_localize_script( 'smoothmigration-guides', 'guideAjax', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'load_guides_nonce' )
        ) );
    }

    // If front page, ensure Lordicon web component is available for animated icons
    if ( is_front_page() ) {
        wp_enqueue_script( 'lordicon' );
    }

    // Global AJAX config (available site-wide)
    wp_localize_script( 'smoothmigration-js', 'smAjax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'smoothmigration_contact_nonce' )
    ) );

    // Landing Page specific styles and scripts (only load on front page)
    if ( is_front_page() ) {
        wp_enqueue_style( 'landing-page', get_template_directory_uri() . '/assets/css/landing-page.css', array( 'smoothmigration-style' ), $file_ver( 'assets/css/landing-page.css' ) );
        wp_enqueue_script( 'landing-page-js', get_template_directory_uri() . '/assets/js/landing-page.js', array( 'bootstrap', 'smoothmigration-js' ), $file_ver( 'assets/js/landing-page.js' ), true );
        
        // Pass data to landing page JavaScript
        wp_localize_script( 'landing-page-js', 'smoothmigrationAjax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'smoothmigration_contact_nonce' )
        ) );
    }

    // Quick View Assets (only load if the quick view modal is likely to be used)
    if ( is_page( 'services' ) || is_singular( 'service' ) || is_tax( 'service_type' ) ) {
        wp_enqueue_style( 'quick-view', get_template_directory_uri() . '/assets/css/quick-view.css', array(), $file_ver( 'assets/css/quick-view.css' ) );
        wp_enqueue_script( 'quick-view-js', get_template_directory_uri() . '/assets/js/quick-view.js', array( 'bootstrap' ), $file_ver( 'assets/js/quick-view.js' ), true );
        
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
        'fontawesome', 'font-awesome', 'fontawesome-free', 'fa'
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