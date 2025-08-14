<?php
/**
 * Custom Post Type for Services - Enhanced
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
        'show_in_rest'       => true, // Enable Gutenberg editor
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
        'show_in_rest'      => true,
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
    add_meta_box(
        'service_branding',
        __( 'Service Branding', 'smoothmigration' ),
        'smoothmigration_service_branding_callback',
        'service',
        'side',
        'default'
    );
    add_meta_box(
        'service_affiliate',
        __( 'Affiliate Link', 'smoothmigration' ),
        'smoothmigration_service_affiliate_callback',
        'service',
        'side',
        'default'
    );
    add_meta_box(
        'service_logos_variants',
        __( 'Logo Variants', 'smoothmigration' ),
        'smoothmigration_service_logo_variants_callback',
        'service',
        'side',
        'default'
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
    $featured = get_post_meta( $post->ID, '_service_featured', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="service_price"><?php _e( 'Price', 'smoothmigration' ); ?></label></th>
            <td><input type="text" id="service_price" name="service_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="service_duration"><?php _e( 'Duration', 'smoothmigration' ); ?></label></th>
            <td><input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr( $duration ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="service_featured"><?php _e( 'Featured Service', 'smoothmigration' ); ?></label></th>
            <td>
                <input type="checkbox" id="service_featured" name="service_featured" value="1" <?php checked( $featured, '1' ); ?>>
                <label for="service_featured"><?php _e( 'Show in carousel and featured sections', 'smoothmigration' ); ?></label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback function for the "Service Options" meta box.
 */
function smoothmigration_service_options_callback( $post ) {
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
 * Callback function for the "Service Branding" meta box.
 */
function smoothmigration_service_branding_callback( $post ) {
    // Get existing values.
    $company_logo = get_post_meta( $post->ID, '_service_company_logo', true );
    $company_name = get_post_meta( $post->ID, '_service_company_name', true );
    $company_url = get_post_meta( $post->ID, '_service_company_url', true );
    $brand_color = get_post_meta( $post->ID, '_service_brand_color', true );

    ?>
    <p>
        <label for="service_company_name"><?php _e( 'Company Name', 'smoothmigration' ); ?></label>
        <input type="text" id="service_company_name" name="service_company_name" value="<?php echo esc_attr( $company_name ); ?>" class="widefat">
    </p>
    <p>
        <label for="service_company_url"><?php _e( 'Company URL', 'smoothmigration' ); ?></label>
        <input type="url" id="service_company_url" name="service_company_url" value="<?php echo esc_attr( $company_url ); ?>" class="widefat">
    </p>
    <p>
        <label for="service_company_logo"><?php _e( 'Company Logo ID', 'smoothmigration' ); ?></label>
        <input type="number" id="service_company_logo" name="service_company_logo" value="<?php echo esc_attr( $company_logo ); ?>" class="widefat">
        <button type="button" class="button" onclick="openMediaUploader()"><?php _e( 'Select Logo', 'smoothmigration' ); ?></button>
        <div id="logo-preview">
            <?php if ( $company_logo ) {
                echo wp_get_attachment_image( $company_logo, 'thumbnail' );
            } ?>
        </div>
    </p>
    <p>
        <label for="service_brand_color"><?php _e( 'Brand Color', 'smoothmigration' ); ?></label>
        <input type="color" id="service_brand_color" name="service_brand_color" value="<?php echo esc_attr( $brand_color ?: '#175873' ); ?>" class="widefat">
    </p>
    
    <script>
    function openMediaUploader() {
        var mediaUploader = wp.media({
            title: 'Select Company Logo',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            document.getElementById('service_company_logo').value = attachment.id;
            document.getElementById('logo-preview').innerHTML = '<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 150px;">';
        });
        
        mediaUploader.open();
    }
    </script>
    <?php
}

/**
 * Callback for Affiliate Link meta box.
 */
function smoothmigration_service_affiliate_callback( $post ) {
    $affiliate_url = get_post_meta( $post->ID, '_service_affiliate_url', true );
    ?>
    <p>
        <label for="service_affiliate_url"><?php _e( 'Referral/Affiliate URL', 'smoothmigration' ); ?></label>
        <input type="url" id="service_affiliate_url" name="service_affiliate_url" value="<?php echo esc_attr( $affiliate_url ); ?>" class="widefat" placeholder="https://...">
    </p>
    <?php
}

/**
 * Logo variants meta box.
 */
function smoothmigration_service_logo_variants_callback( $post ) {
    $fields = array(
        'service_logo_primary' => 'Primary',
        'service_logo_on_light' => 'On Light Background',
        'service_logo_on_dark' => 'On Dark Background',
        'service_logo_square' => 'Square/Badge',
    );
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, '_' . $key, true );
        echo '<p><label for="'.$key.'">'.esc_html( $label ).'</label><br/>';
        echo '<input type="number" id="'.$key.'" name="'.$key.'" value="'.esc_attr( $val ).'" class="small-text" /> ';
        echo '<button type="button" class="button js-select-media" data-target="'.$key.'">Select</button></p>';
    }
    ?>
    <script>
    (function(){
        document.querySelectorAll('#service_logos_variants .js-select-media, .js-select-media').forEach(function(btn){
            btn.addEventListener('click', function(){
                var target = document.getElementById(this.dataset.target);
                var frame = wp.media({title: 'Select Logo', button: {text: 'Use this logo'}, multiple: false});
                frame.on('select', function(){ var a = frame.state().get('selection').first().toJSON(); target.value = a.id; });
                frame.open();
            });
        });
    })();
    </script>
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
    $fields = array(
        'service_price' => 'sanitize_text_field',
        'service_duration' => 'sanitize_text_field',
        'service_options' => 'sanitize_textarea_field',
        'service_company_name' => 'sanitize_text_field',
        'service_company_url' => 'esc_url_raw',
        'service_company_logo' => 'absint',
        'service_brand_color' => 'sanitize_hex_color',
        'service_affiliate_url' => 'esc_url_raw',
        'service_logo_primary' => 'absint',
        'service_logo_on_light' => 'absint',
        'service_logo_on_dark' => 'absint',
        'service_logo_square' => 'absint',
    );

    foreach ( $fields as $field => $sanitize_callback ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, $sanitize_callback( $_POST[$field] ) );
        }
    }

    // Handle checkbox
    $featured = isset( $_POST['service_featured'] ) ? '1' : '0';
    update_post_meta( $post_id, '_service_featured', $featured );
}
add_action( 'save_post', 'smoothmigration_save_service_meta' );

/**
 * Enqueue media uploader on service edit pages
 */
function smoothmigration_enqueue_media_uploader( $hook ) {
    global $post_type;
    
    if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
        if ( 'service' === $post_type ) {
            wp_enqueue_media();
        }
    }
}
add_action( 'admin_enqueue_scripts', 'smoothmigration_enqueue_media_uploader' );

/**
 * Add custom columns to services admin list
 */
function smoothmigration_service_columns( $columns ) {
    $columns['service_type'] = __( 'Service Type', 'smoothmigration' );
    $columns['featured'] = __( 'Featured', 'smoothmigration' );
    $columns['company'] = __( 'Company', 'smoothmigration' );
    $columns['logo'] = __( 'Logo', 'smoothmigration' );
    return $columns;
}
add_filter( 'manage_service_posts_columns', 'smoothmigration_service_columns' );

/**
 * Display custom column content
 */
function smoothmigration_service_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'service_type':
            $terms = get_the_terms( $post_id, 'service_type' );
            if ( $terms ) {
                $names = wp_list_pluck( $terms, 'name' );
                echo implode( ', ', $names );
            }
            break;
            
        case 'featured':
            $featured = get_post_meta( $post_id, '_service_featured', true );
            echo $featured ? '✓' : '—';
            break;
            
        case 'company':
            $company_name = get_post_meta( $post_id, '_service_company_name', true );
            echo $company_name ?: '—';
            break;
            
        case 'logo':
            $logo_id = get_post_meta( $post_id, '_service_company_logo', true );
            if ( $logo_id ) {
                echo wp_get_attachment_image( $logo_id, array( 40, 40 ) );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_service_posts_custom_column', 'smoothmigration_service_column_content', 10, 2 ); 