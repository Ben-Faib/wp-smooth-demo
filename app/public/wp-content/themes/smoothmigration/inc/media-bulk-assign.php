<?php
/**
 * Simple admin tool to bulk-assign Asset Type to selected attachments.
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function smoothmigration_register_media_bulk_assign_page() : void {
    add_media_page(
        __( 'Bulk Assign Asset Type', 'smoothmigration' ),
        __( 'Bulk Assign Asset Type', 'smoothmigration' ),
        'upload_files',
        'sm-bulk-assign-asset-type',
        'smoothmigration_render_media_bulk_assign_page'
    );
}
add_action( 'admin_menu', 'smoothmigration_register_media_bulk_assign_page' );

function smoothmigration_render_media_bulk_assign_page() : void {
    if ( ! current_user_can( 'upload_files' ) ) {
        wp_die( __( 'You do not have permission to access this page.', 'smoothmigration' ) );
    }

    $terms = get_terms( array( 'taxonomy' => 'sm_asset_type', 'hide_empty' => false ) );
    if ( isset( $_POST['sm_bulk_assign_nonce'] ) && wp_verify_nonce( $_POST['sm_bulk_assign_nonce'], 'sm_bulk_assign' ) ) {
        $term_id = isset( $_POST['sm_asset_type_term'] ) ? (int) $_POST['sm_asset_type_term'] : 0;
        $ids     = isset( $_POST['sm_attachment_ids'] ) && is_array( $_POST['sm_attachment_ids'] ) ? array_map( 'intval', $_POST['sm_attachment_ids'] ) : array();
        $updated = 0;
        if ( $term_id && ! empty( $ids ) ) {
            foreach ( $ids as $aid ) {
                if ( get_post_type( $aid ) !== 'attachment' ) { continue; }
                wp_set_object_terms( $aid, array( $term_id ), 'sm_asset_type', false );
                $updated++;
            }
        }
        printf( '<div class="notice notice-success"><p>%s</p></div>', esc_html( sprintf( _n( 'Updated %d item.', 'Updated %d items.', $updated, 'smoothmigration' ), $updated ) ) );
    }

    // Query latest 200 image attachments (you can adjust via filter)
    $attachments = get_posts( array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => 200,
        'post_status'    => 'inherit',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
    ) );

    echo '<div class="wrap">';
    echo '<h1>' . esc_html__( 'Bulk Assign Asset Type', 'smoothmigration' ) . '</h1>';
    echo '<p>' . esc_html__( 'Select images and assign an Asset Type term (e.g., Brand Logo).', 'smoothmigration' ) . '</p>';
    echo '<form method="post">';
    wp_nonce_field( 'sm_bulk_assign', 'sm_bulk_assign_nonce' );

    echo '<p><label for="sm_asset_type_term"><strong>' . esc_html__( 'Asset Type', 'smoothmigration' ) . '</strong></label> ';
    echo '<select id="sm_asset_type_term" name="sm_asset_type_term" required>';
    foreach ( $terms as $t ) {
        printf( '<option value="%d">%s</option>', intval( $t->term_id ), esc_html( $t->name ) );
    }
    echo '</select></p>';

    echo '<p><label><input type="checkbox" id="sm_check_all" /> ' . esc_html__( 'Select all', 'smoothmigration' ) . '</label></p>';

    echo '<ul style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;max-width:1000px;margin:0;padding:0;list-style:none;">';
    foreach ( $attachments as $aid ) {
        $thumb = wp_get_attachment_image( $aid, array(120,120), true, array( 'style' => 'display:block;width:120px;height:120px;object-fit:contain;background:#fff;border:1px solid #e5e7eb;border-radius:6px;padding:4px;' ) );
        $title = get_the_title( $aid );
        echo '<li><label style="display:block;text-align:center;">';
        printf( '<input type="checkbox" name="sm_attachment_ids[]" value="%d" />', intval( $aid ) );
        echo '<div style="margin:6px auto 4px;">' . $thumb . '</div>';
        echo '<small style="display:block;word-break:break-word;max-width:120px;">' . esc_html( $title ) . '</small>';
        echo '</label></li>';
    }
    echo '</ul>';

    echo '<p><button type="submit" class="button button-primary">' . esc_html__( 'Assign Asset Type', 'smoothmigration' ) . '</button></p>';
    echo '</form>';

    // Simple JS to toggle all checkboxes
    echo '<script>document.getElementById("sm_check_all").addEventListener("change",function(){document.querySelectorAll("input[name=\\"sm_attachment_ids[]\\"]").forEach(cb=>cb.checked=this.checked);});</script>';
    echo '</div>';
}


