<?php
/**
 * Custom Post Type for Services.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register the "Service" custom post type.
 */
function smoothmigration_register_services_cpt() {
    $labels = array(
        'name'               => _x( 'Services', 'post type general name', 'smoothmigration' ),
        'singular_name'      => _x( 'Service', 'post type singular name', 'smoothmigration' ),
        'menu_name'          => _x( 'Services', 'admin menu', 'smoothmigration' ),
        'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'smoothmigration' ),
        'add_new'            => _x( 'Add New', 'service', 'smoothmigration' ),
        'add_new_item'       => __( 'Add New Service', 'smoothmigration' ),
        'new_item'           => __( 'New Service', 'smoothmigration' ),
        'edit_item'          => __( 'Edit Service', 'smoothmigration' ),
        'view_item'          => __( 'View Service', 'smoothmigration' ),
        'all_items'          => __( 'All Services', 'smoothmigration' ),
        'search_items'       => __( 'Search Services', 'smoothmigration' ),
        'parent_item_colon'  => __( 'Parent Services:', 'smoothmigration' ),
        'not_found'          => __( 'No services found.', 'smoothmigration' ),
        'not_found_in_trash' => __( 'No services found in Trash.', 'smoothmigration' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'service' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-admin-tools',
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'smoothmigration_register_services_cpt' );

/**
 * Register the "Service Type" custom taxonomy.
 */
function smoothmigration_register_service_taxonomy() {
    $labels = array(
        'name'              => _x( 'Service Types', 'taxonomy general name', 'smoothmigration' ),
        'singular_name'     => _x( 'Service Type', 'taxonomy singular name', 'smoothmigration' ),
        'search_items'      => __( 'Search Service Types', 'smoothmigration' ),
        'all_items'         => __( 'All Service Types', 'smoothmigration' ),
        'parent_item'       => __( 'Parent Service Type', 'smoothmigration' ),
        'parent_item_colon' => __( 'Parent Service Type:', 'smoothmigration' ),
        'edit_item'         => __( 'Edit Service Type', 'smoothmigration' ),
        'update_item'       => __( 'Update Service Type', 'smoothmigration' ),
        'add_new_item'      => __( 'Add New Service Type', 'smoothmigration' ),
        'new_item_name'     => __( 'New Service Type Name', 'smoothmigration' ),
        'menu_name'         => __( 'Service Types', 'smoothmigration' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-type' ),
    );

    register_taxonomy( 'service_type', array( 'service' ), $args );
}
add_action( 'init', 'smoothmigration_register_service_taxonomy', 0 );

/**
 * Add custom meta boxes for the "Service" post type.
 */
function smoothmigration_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __( 'Service Details', 'smoothmigration' ),
        'smoothmigration_service_details_callback',
        'service',
        'normal',
        'high'
    );
    add_meta_box(
        'service_options',
        __( 'Service Options', 'smoothmigration' ),
        'smoothmigration_service_options_callback',
        'service',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'smoothmigration_add_service_meta_boxes' );

/**
 * Callback function for the "Service Details" meta box.
 */
function smoothmigration_service_details_callback( $post ) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'smoothmigration_save_service_meta', 'smoothmigration_service_meta_nonce' );

    // Get existing values.
    $price = get_post_meta( $post->ID, '_service_price', true );
    $duration = get_post_meta( $post->ID, '_service_duration', true );

    ?>
    <p>
        <label for="service_price"><?php _e( 'Price', 'smoothmigration' ); ?></label>
        <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr( $price ); ?>" class="widefat">
    </p>
    <p>
        <label for="service_duration"><?php _e( 'Duration', 'smoothmigration' ); ?></label>
        <input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr( $duration ); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Callback function for the "Service Options" meta box.
 */
function smoothmigration_service_options_callback( $post ) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'smoothmigration_save_service_meta', 'smoothmigration_service_meta_nonce' );

    // Get existing values.
    $options = get_post_meta( $post->ID, '_service_options', true );

    ?>
    <p>
        <label for="service_options"><?php _e( 'Options (one per line)', 'smoothmigration' ); ?></label>
        <textarea id="service_options" name="service_options" class="widefat" rows="5"><?php echo esc_textarea( $options ); ?></textarea>
    </p>
    <?php
}

/**
 * Save meta box data.
 */
function smoothmigration_save_service_meta( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['smoothmigration_service_meta_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['smoothmigration_service_meta_nonce'], 'smoothmigration_save_service_meta' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'service' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Sanitize and save the data.
    if ( isset( $_POST['service_price'] ) ) {
        update_post_meta( $post_id, '_service_price', sanitize_text_field( $_POST['service_price'] ) );
    }

    if ( isset( $_POST['service_duration'] ) ) {
        update_post_meta( $post_id, '_service_duration', sanitize_text_field( $_POST['service_duration'] ) );
    }

    if ( isset( $_POST['service_options'] ) ) {
        update_post_meta( $post_id, '_service_options', sanitize_textarea_field( $_POST['service_options'] ) );
    }
}
add_action( 'save_post', 'smoothmigration_save_service_meta' ); 