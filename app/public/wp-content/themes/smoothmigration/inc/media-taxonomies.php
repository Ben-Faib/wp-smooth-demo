<?php
/**
 * Media taxonomies for attachment organization (e.g., Brand Logos)
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register an attachment taxonomy `sm_asset_type` with a default term `Brand Logo`.
 */
function smoothmigration_register_media_taxonomies() : void {
    register_taxonomy(
        'sm_asset_type',
        'attachment',
        array(
            'hierarchical'      => false,
            'labels'            => array(
                'name'          => __( 'Asset Type', 'smoothmigration' ),
                'singular_name' => __( 'Asset Type', 'smoothmigration' ),
            ),
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => false,
            'show_in_rest'      => true,
        )
    );

    // Ensure default term exists
    if ( ! term_exists( 'brand-logo', 'sm_asset_type' ) ) {
        wp_insert_term( 'Brand Logo', 'sm_asset_type', array( 'slug' => 'brand-logo' ) );
    }
}
add_action( 'init', 'smoothmigration_register_media_taxonomies' );


