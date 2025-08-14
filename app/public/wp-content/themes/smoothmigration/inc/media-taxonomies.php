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

/**
 * Bulk actions in Media Library (list view) to assign/clear Asset Type on multiple attachments.
 */
function smoothmigration_media_bulk_actions( array $actions ) : array {
    // Add an action per Asset Type term to set the taxonomy in bulk
    $terms = get_terms( array( 'taxonomy' => 'sm_asset_type', 'hide_empty' => false ) );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $actions[ 'sm_set_asset_type_' . intval( $term->term_id ) ] = sprintf( /* translators: %s term name */ __( 'Set Asset Type: %s', 'smoothmigration' ), $term->name );
        }
    }
    // Clear relationship
    $actions['sm_clear_asset_type'] = __( 'Clear Asset Type', 'smoothmigration' );
    return $actions;
}
add_filter( 'bulk_actions-upload', 'smoothmigration_media_bulk_actions' );

function smoothmigration_handle_media_bulk_actions( string $redirect_to, string $doaction, array $post_ids ) : string {
    if ( strpos( $doaction, 'sm_set_asset_type_' ) === 0 ) {
        $term_id = (int) str_replace( 'sm_set_asset_type_', '', $doaction );
        $count = 0;
        foreach ( $post_ids as $pid ) {
            if ( get_post_type( $pid ) !== 'attachment' ) { continue; }
            wp_set_object_terms( $pid, array( $term_id ), 'sm_asset_type', false );
            $count++;
        }
        return add_query_arg( array( 'sm_bulk_set_asset_type' => $count ), $redirect_to );
    }
    if ( $doaction === 'sm_clear_asset_type' ) {
        $count = 0;
        foreach ( $post_ids as $pid ) {
            if ( get_post_type( $pid ) !== 'attachment' ) { continue; }
            wp_delete_object_term_relationships( $pid, 'sm_asset_type' );
            $count++;
        }
        return add_query_arg( array( 'sm_bulk_cleared_asset_type' => $count ), $redirect_to );
    }
    return $redirect_to;
}
add_filter( 'handle_bulk_actions-upload', 'smoothmigration_handle_media_bulk_actions', 10, 3 );

function smoothmigration_media_bulk_notices() : void {
    if ( isset( $_REQUEST['sm_bulk_set_asset_type'] ) ) {
        $n = (int) $_REQUEST['sm_bulk_set_asset_type'];
        printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', esc_html( sprintf( _n( 'Asset Type set on %d item.', 'Asset Type set on %d items.', $n, 'smoothmigration' ), $n ) ) );
    }
    if ( isset( $_REQUEST['sm_bulk_cleared_asset_type'] ) ) {
        $n = (int) $_REQUEST['sm_bulk_cleared_asset_type'];
        printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', esc_html( sprintf( _n( 'Cleared Asset Type on %d item.', 'Cleared Asset Type on %d items.', $n, 'smoothmigration' ), $n ) ) );
    }
}
add_action( 'admin_notices', 'smoothmigration_media_bulk_notices' );


