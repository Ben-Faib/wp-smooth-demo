<?php
/**
 * Demo content setup.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Create Elementor pages.
 */
function smoothmigration_create_elementor_pages() {
    if ( isset( $_POST['create_elementor_pages'] ) && check_admin_referer( 'smoothmigration_elementor_setup_nonce', 'smoothmigration_elementor_nonce' ) ) {
        // Create homepage
        smoothmigration_create_homepage_with_full_content();
        
        // Create about page
        $about_page = array(
            'post_title'   => 'About Us',
            'post_content' => '<!-- wp:paragraph --><p>Learn more about our company.</p><!-- /wp:paragraph -->',
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'page',
        );
        wp_insert_post( $about_page );
        
        // Create services page
        $services_page = array(
            'post_title'   => 'Services',
            'post_content' => '<!-- wp:paragraph --><p>Explore our services.</p><!-- /wp:paragraph -->',
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'page',
        );
        wp_insert_post( $services_page );

        // Redirect back to the setup page with a success message
        wp_redirect( admin_url( 'themes.php?page=elementor-setup&status=success' ) );
        exit;
    }
}
add_action( 'admin_init', 'smoothmigration_create_elementor_pages' );

/**
 * Create homepage with full content.
 */
function smoothmigration_create_homepage_with_full_content() {
    $homepage_content = '<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Welcome to Smooth Migration</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your trusted partner in relocation services.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->';
    
    $homepage = array(
        'post_title'   => 'Home',
        'post_content' => $homepage_content,
        'post_status'  => 'publish',
        'post_author'  => 1,
        'post_type'    => 'page',
    );
    $homepage_id = wp_insert_post( $homepage );

    // Set as homepage
    update_option( 'page_on_front', $homepage_id );
    update_option( 'show_on_front', 'page' );
}

/**
 * Setup demo content.
 */
function smoothmigration_setup_demo_content() {
    // Create sample services
    smoothmigration_create_sample_services();
    
    // Create service option pages
    smoothmigration_create_service_option_pages();
}
add_action( 'after_switch_theme', 'smoothmigration_setup_demo_content' );

/**
 * Create sample services.
 */
function smoothmigration_create_sample_services() {
    $services = array(
        array(
            'title' => 'Residential Moving',
            'content' => 'Full-service moving for your home.',
            'price' => '1200',
            'duration' => '1 day',
            'options' => "Packing\nUnpacking\nFurniture Assembly",
            'type' => 'moving'
        ),
        array(
            'title' => 'Commercial Moving',
            'content' => 'Office and business relocation.',
            'price' => '3500',
            'duration' => '2-3 days',
            'options' => "IT Setup\nCubicle Assembly\nSecure Document Shredding",
            'type' => 'moving'
        ),
        array(
            'title' => 'Packing Services',
            'content' => 'Professional packing for all your belongings.',
            'price' => '500',
            'duration' => '4-6 hours',
            'options' => "Fragile Items\nSpecialty Boxes\nLabeling",
            'type' => 'packing'
        ),
        array(
            'title' => 'Storage Solutions',
            'content' => 'Secure, climate-controlled storage.',
            'price' => '150/month',
            'duration' => 'Varies',
            'options' => "Short-term\nLong-term\n24/7 Access",
            'type' => 'storage'
        ),
    );

    foreach ( $services as $service ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $service['title'],
            'post_content' => $service['content'],
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'service',
        ) );

        if ( $post_id ) {
            // Add meta data
            update_post_meta( $post_id, '_service_price', $service['price'] );
            update_post_meta( $post_id, '_service_duration', $service['duration'] );
            update_post_meta( $post_id, '_service_options', $service['options'] );

            // Set service type
            wp_set_object_terms( $post_id, $service['type'], 'service_type' );
        }
    }
}

/**
 * Create service option pages.
 */
function smoothmigration_create_service_option_pages() {
    $pages = array(
        'packing-options' => 'Packing Options',
        'moving-options' => 'Moving Options',
        'storage-options' => 'Storage Options'
    );

    foreach( $pages as $slug => $title ) {
        wp_insert_post( array(
            'post_title' => $title,
            'post_name' => $slug,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => "This is a page for {$title}."
        ) );
    }
}

/**
 * Get demo content.
 */
function smoothmigration_get_demo_content( $slug ) {
    $content = array(
        'homepage' => '<!-- wp:paragraph --><p>Welcome to the homepage!</p><!-- /wp:paragraph -->',
        'about'    => '<!-- wp:paragraph --><p>This is the about page.</p><!-- /wp:paragraph -->',
        'services' => '<!-- wp:paragraph --><p>These are our services.</p><!-- /wp:paragraph -->',
    );
    
    return $content[$slug] ?? '';
}

/**
 * Fill rich content.
 */
function smoothmigration_fill_rich_content() {
    $homepage_content = smoothmigration_get_demo_content('homepage');
    $about_content = smoothmigration_get_demo_content('about');
    
    // Find pages by title
    $home_page = get_page_by_title( 'Home' );
    $about_page = get_page_by_title( 'About Us' );
    
    // Update pages
    if ( $home_page ) {
        wp_update_post( array(
            'ID' => $home_page->ID,
            'post_content' => $homepage_content
        ) );
    }
    
    if ( $about_page ) {
        wp_update_post( array(
            'ID' => $about_page->ID,
            'post_content' => $about_content
        ) );
    }
}

/**
 * Cleanup empty Elementor flags.
 */
function smoothmigration_cleanup_empty_elementor_flags() {
    global $wpdb;
    $wpdb->query( "DELETE FROM `{$wpdb->postmeta}` WHERE `meta_key` = '_elementor_edit_mode' AND `meta_value` = ''" );
} 