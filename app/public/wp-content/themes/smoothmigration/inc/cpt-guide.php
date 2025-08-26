<?php
/**
 * Custom Post Type for Guides - Enhanced
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register the "Guide" custom post type.
 */
function smoothmigration_register_guides_cpt() {
    $labels = array(
        'name'               => _x( 'Guides', 'post type general name', 'smoothmigration' ),
        'singular_name'      => _x( 'Guide', 'post type singular name', 'smoothmigration' ),
        'menu_name'          => _x( 'Moving Guides', 'admin menu', 'smoothmigration' ),
        'name_admin_bar'     => _x( 'Guide', 'add new on admin bar', 'smoothmigration' ),
        'add_new'            => _x( 'Add New', 'guide', 'smoothmigration' ),
        'add_new_item'       => __( 'Add New Guide', 'smoothmigration' ),
        'new_item'           => __( 'New Guide', 'smoothmigration' ),
        'edit_item'          => __( 'Edit Guide', 'smoothmigration' ),
        'view_item'          => __( 'View Guide', 'smoothmigration' ),
        'all_items'          => __( 'All Guides', 'smoothmigration' ),
        'search_items'       => __( 'Search Guides', 'smoothmigration' ),
        'parent_item_colon'  => __( 'Parent Guides:', 'smoothmigration' ),
        'not_found'          => __( 'No guides found.', 'smoothmigration' ),
        'not_found_in_trash' => __( 'No guides found in Trash.', 'smoothmigration' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'guide' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
        'menu_icon'          => 'dashicons-book-alt',
        'show_in_rest'       => true, // Enable Gutenberg editor
    );

    register_post_type( 'guide', $args );
}
add_action( 'init', 'smoothmigration_register_guides_cpt' );

/**
 * Register Guide taxonomies.
 */
function smoothmigration_register_guide_taxonomies() {
    // Guide Categories
    $category_labels = array(
        'name'              => _x( 'Guide Categories', 'taxonomy general name', 'smoothmigration' ),
        'singular_name'     => _x( 'Guide Category', 'taxonomy singular name', 'smoothmigration' ),
        'search_items'      => __( 'Search Guide Categories', 'smoothmigration' ),
        'all_items'         => __( 'All Guide Categories', 'smoothmigration' ),
        'parent_item'       => __( 'Parent Guide Category', 'smoothmigration' ),
        'parent_item_colon' => __( 'Parent Guide Category:', 'smoothmigration' ),
        'edit_item'         => __( 'Edit Guide Category', 'smoothmigration' ),
        'update_item'       => __( 'Update Guide Category', 'smoothmigration' ),
        'add_new_item'      => __( 'Add New Guide Category', 'smoothmigration' ),
        'new_item_name'     => __( 'New Guide Category Name', 'smoothmigration' ),
        'menu_name'         => __( 'Categories', 'smoothmigration' ),
    );

    $category_args = array(
        'hierarchical'      => true,
        'labels'            => $category_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'guide-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'guide_category', array( 'guide' ), $category_args );

    // Guide Countries
    $country_labels = array(
        'name'              => _x( 'Countries', 'taxonomy general name', 'smoothmigration' ),
        'singular_name'     => _x( 'Country', 'taxonomy singular name', 'smoothmigration' ),
        'search_items'      => __( 'Search Countries', 'smoothmigration' ),
        'all_items'         => __( 'All Countries', 'smoothmigration' ),
        'edit_item'         => __( 'Edit Country', 'smoothmigration' ),
        'update_item'       => __( 'Update Country', 'smoothmigration' ),
        'add_new_item'      => __( 'Add New Country', 'smoothmigration' ),
        'new_item_name'     => __( 'New Country Name', 'smoothmigration' ),
        'menu_name'         => __( 'Countries', 'smoothmigration' ),
    );

    $country_args = array(
        'hierarchical'      => false,
        'labels'            => $country_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'guide-country' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'guide_country', array( 'guide' ), $country_args );

    // Guide Timeline
    $timeline_labels = array(
        'name'              => _x( 'Timelines', 'taxonomy general name', 'smoothmigration' ),
        'singular_name'     => _x( 'Timeline', 'taxonomy singular name', 'smoothmigration' ),
        'search_items'      => __( 'Search Timelines', 'smoothmigration' ),
        'all_items'         => __( 'All Timelines', 'smoothmigration' ),
        'edit_item'         => __( 'Edit Timeline', 'smoothmigration' ),
        'update_item'       => __( 'Update Timeline', 'smoothmigration' ),
        'add_new_item'      => __( 'Add New Timeline', 'smoothmigration' ),
        'new_item_name'     => __( 'New Timeline Name', 'smoothmigration' ),
        'menu_name'         => __( 'Timelines', 'smoothmigration' ),
    );

    $timeline_args = array(
        'hierarchical'      => false,
        'labels'            => $timeline_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'guide-timeline' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'guide_timeline', array( 'guide' ), $timeline_args );
}
add_action( 'init', 'smoothmigration_register_guide_taxonomies', 0 );

/**
 * Add custom meta boxes for the "Guide" post type.
 */
function smoothmigration_add_guide_meta_boxes() {
    add_meta_box(
        'guide_details',
        __( 'Guide Details', 'smoothmigration' ),
        'smoothmigration_guide_details_callback',
        'guide',
        'normal',
        'high'
    );
    
    add_meta_box(
        'guide_content_structure',
        __( 'Content Structure', 'smoothmigration' ),
        'smoothmigration_guide_content_structure_callback',
        'guide',
        'normal',
        'high'
    );
    
    add_meta_box(
        'guide_settings',
        __( 'Guide Settings', 'smoothmigration' ),
        'smoothmigration_guide_settings_callback',
        'guide',
        'side',
        'default'
    );
    
    add_meta_box(
        'guide_resources',
        __( 'Resources & Tools', 'smoothmigration' ),
        'smoothmigration_guide_resources_callback',
        'guide',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'smoothmigration_add_guide_meta_boxes' );

/**
 * Callback function for the "Guide Details" meta box.
 */
function smoothmigration_guide_details_callback( $post ) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'smoothmigration_save_guide_meta', 'smoothmigration_guide_meta_nonce' );

    // Get existing values.
    $difficulty = get_post_meta( $post->ID, '_guide_difficulty', true );
    $duration = get_post_meta( $post->ID, '_guide_duration', true );
    $type = get_post_meta( $post->ID, '_guide_type', true );
    $priority = get_post_meta( $post->ID, '_guide_priority', true );
    $featured = get_post_meta( $post->ID, '_guide_featured', true );
    $summary = get_post_meta( $post->ID, '_guide_summary', true );
    $learning_outcomes = get_post_meta( $post->ID, '_guide_learning_outcomes', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="guide_summary"><?php _e( 'Quick Summary', 'smoothmigration' ); ?></label></th>
            <td><textarea id="guide_summary" name="guide_summary" class="widefat" rows="3" placeholder="Brief 2-3 sentence summary of the guide..."><?php echo esc_textarea( $summary ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="guide_difficulty"><?php _e( 'Difficulty Level', 'smoothmigration' ); ?></label></th>
            <td>
                <select id="guide_difficulty" name="guide_difficulty" class="regular-text">
                    <option value=""><?php _e( 'Select Difficulty', 'smoothmigration' ); ?></option>
                    <option value="Beginner" <?php selected( $difficulty, 'Beginner' ); ?>><?php _e( 'Beginner', 'smoothmigration' ); ?></option>
                    <option value="Intermediate" <?php selected( $difficulty, 'Intermediate' ); ?>><?php _e( 'Intermediate', 'smoothmigration' ); ?></option>
                    <option value="Advanced" <?php selected( $difficulty, 'Advanced' ); ?>><?php _e( 'Advanced', 'smoothmigration' ); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="guide_duration"><?php _e( 'Reading Time', 'smoothmigration' ); ?></label></th>
            <td>
                <select id="guide_duration" name="guide_duration" class="regular-text">
                    <option value=""><?php _e( 'Select Duration', 'smoothmigration' ); ?></option>
                    <option value="5 min read" <?php selected( $duration, '5 min read' ); ?>><?php _e( '5 min read', 'smoothmigration' ); ?></option>
                    <option value="10 min read" <?php selected( $duration, '10 min read' ); ?>><?php _e( '10 min read', 'smoothmigration' ); ?></option>
                    <option value="15 min read" <?php selected( $duration, '15 min read' ); ?>><?php _e( '15 min read', 'smoothmigration' ); ?></option>
                    <option value="20 min read" <?php selected( $duration, '20 min read' ); ?>><?php _e( '20 min read', 'smoothmigration' ); ?></option>
                    <option value="30 min read" <?php selected( $duration, '30 min read' ); ?>><?php _e( '30 min read', 'smoothmigration' ); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="guide_type"><?php _e( 'Guide Type', 'smoothmigration' ); ?></label></th>
            <td>
                <select id="guide_type" name="guide_type" class="regular-text">
                    <option value=""><?php _e( 'Select Type', 'smoothmigration' ); ?></option>
                    <option value="Checklist" <?php selected( $type, 'Checklist' ); ?>><?php _e( 'Checklist', 'smoothmigration' ); ?></option>
                    <option value="Step-by-step" <?php selected( $type, 'Step-by-step' ); ?>><?php _e( 'Step-by-step', 'smoothmigration' ); ?></option>
                    <option value="Resource List" <?php selected( $type, 'Resource List' ); ?>><?php _e( 'Resource List', 'smoothmigration' ); ?></option>
                    <option value="Country Guide" <?php selected( $type, 'Country Guide' ); ?>><?php _e( 'Country Guide', 'smoothmigration' ); ?></option>
                    <option value="Legal Guide" <?php selected( $type, 'Legal Guide' ); ?>><?php _e( 'Legal Guide', 'smoothmigration' ); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="guide_priority"><?php _e( 'Priority Level', 'smoothmigration' ); ?></label></th>
            <td>
                <select id="guide_priority" name="guide_priority" class="regular-text">
                    <option value=""><?php _e( 'Select Priority', 'smoothmigration' ); ?></option>
                    <option value="Essential" <?php selected( $priority, 'Essential' ); ?>><?php _e( 'Essential', 'smoothmigration' ); ?></option>
                    <option value="Recommended" <?php selected( $priority, 'Recommended' ); ?>><?php _e( 'Recommended', 'smoothmigration' ); ?></option>
                    <option value="Optional" <?php selected( $priority, 'Optional' ); ?>><?php _e( 'Optional', 'smoothmigration' ); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="guide_learning_outcomes"><?php _e( 'Learning Outcomes', 'smoothmigration' ); ?></label></th>
            <td>
                <textarea id="guide_learning_outcomes" name="guide_learning_outcomes" class="widefat" rows="4" placeholder="List key outcomes (one per line)..."><?php echo esc_textarea( $learning_outcomes ); ?></textarea>
                <p class="description"><?php _e( 'Enter key learning outcomes, one per line', 'smoothmigration' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="guide_featured"><?php _e( 'Featured Guide', 'smoothmigration' ); ?></label></th>
            <td>
                <input type="checkbox" id="guide_featured" name="guide_featured" value="1" <?php checked( $featured, '1' ); ?>>
                <label for="guide_featured"><?php _e( 'Show in featured sections and homepage', 'smoothmigration' ); ?></label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback function for the "Content Structure" meta box.
 */
function smoothmigration_guide_content_structure_callback( $post ) {
    $who_for = get_post_meta( $post->ID, '_guide_who_for', true );
    $prerequisites = get_post_meta( $post->ID, '_guide_prerequisites', true );
    $next_steps = get_post_meta( $post->ID, '_guide_next_steps', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="guide_who_for"><?php _e( 'Who This Guide Is For', 'smoothmigration' ); ?></label></th>
            <td><textarea id="guide_who_for" name="guide_who_for" class="widefat" rows="3" placeholder="Target audience description..."><?php echo esc_textarea( $who_for ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="guide_prerequisites"><?php _e( 'Prerequisites', 'smoothmigration' ); ?></label></th>
            <td><textarea id="guide_prerequisites" name="guide_prerequisites" class="widefat" rows="3" placeholder="What should readers have done first? (optional)"><?php echo esc_textarea( $prerequisites ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="guide_next_steps"><?php _e( 'Next Steps', 'smoothmigration' ); ?></label></th>
            <td><textarea id="guide_next_steps" name="guide_next_steps" class="widefat" rows="3" placeholder="What should readers do after completing this guide?"><?php echo esc_textarea( $next_steps ); ?></textarea></td>
        </tr>
    </table>
    <?php
}

/**
 * Callback function for the "Guide Settings" meta box.
 */
function smoothmigration_guide_settings_callback( $post ) {
    $coming_soon = get_post_meta( $post->ID, '_guide_coming_soon', true );
    $enable_comments = get_post_meta( $post->ID, '_guide_enable_comments', true );
    $enable_sharing = get_post_meta( $post->ID, '_guide_enable_sharing', true );
    $enable_print = get_post_meta( $post->ID, '_guide_enable_print', true );
    
    ?>
    <p>
        <input type="checkbox" id="guide_coming_soon" name="guide_coming_soon" value="1" <?php checked( $coming_soon, '1' ); ?>>
        <label for="guide_coming_soon"><?php _e( 'Coming Soon Badge', 'smoothmigration' ); ?></label>
    </p>
    <p>
        <input type="checkbox" id="guide_enable_comments" name="guide_enable_comments" value="1" <?php checked( $enable_comments, '1' ); ?>>
        <label for="guide_enable_comments"><?php _e( 'Enable Comments', 'smoothmigration' ); ?></label>
    </p>
    <p>
        <input type="checkbox" id="guide_enable_sharing" name="guide_enable_sharing" value="1" <?php checked( $enable_sharing, '1' ); ?>>
        <label for="guide_enable_sharing"><?php _e( 'Enable Social Sharing', 'smoothmigration' ); ?></label>
    </p>
    <p>
        <input type="checkbox" id="guide_enable_print" name="guide_enable_print" value="1" <?php checked( $enable_print, '1' ); ?>>
        <label for="guide_enable_print"><?php _e( 'Enable Print/Download', 'smoothmigration' ); ?></label>
    </p>
    <?php
}

/**
 * Callback function for the "Resources & Tools" meta box.
 */
function smoothmigration_guide_resources_callback( $post ) {
    $external_resources = get_post_meta( $post->ID, '_guide_external_resources', true );
    $downloadable_file = get_post_meta( $post->ID, '_guide_downloadable_file', true );
    $related_services = get_post_meta( $post->ID, '_guide_related_services', true );
    
    ?>
    <p>
        <label for="guide_external_resources"><?php _e( 'External Resources', 'smoothmigration' ); ?></label>
        <textarea id="guide_external_resources" name="guide_external_resources" class="widefat" rows="4" placeholder="External links and resources (one per line)"><?php echo esc_textarea( $external_resources ); ?></textarea>
    </p>
    <p>
        <label for="guide_downloadable_file"><?php _e( 'Downloadable Resource ID', 'smoothmigration' ); ?></label>
        <input type="number" id="guide_downloadable_file" name="guide_downloadable_file" value="<?php echo esc_attr( $downloadable_file ); ?>" class="widefat">
        <button type="button" class="button" onclick="openGuideMediaUploader()"><?php _e( 'Select File', 'smoothmigration' ); ?></button>
    </p>
    <p>
        <label for="guide_related_services"><?php _e( 'Related Service IDs', 'smoothmigration' ); ?></label>
        <input type="text" id="guide_related_services" name="guide_related_services" value="<?php echo esc_attr( $related_services ); ?>" class="widefat" placeholder="1,5,12 (comma-separated)">
    </p>
    
    <script>
    function openGuideMediaUploader() {
        var mediaUploader = wp.media({
            title: 'Select Downloadable Resource',
            button: {
                text: 'Use this file'
            },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            document.getElementById('guide_downloadable_file').value = attachment.id;
        });
        
        mediaUploader.open();
    }
    </script>
    <?php
}

/**
 * Save meta box data.
 */
function smoothmigration_save_guide_meta( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['smoothmigration_guide_meta_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['smoothmigration_guide_meta_nonce'], 'smoothmigration_save_guide_meta' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'guide' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Sanitize and save the data.
    $fields = array(
        'guide_summary' => 'sanitize_textarea_field',
        'guide_difficulty' => 'sanitize_text_field',
        'guide_duration' => 'sanitize_text_field',
        'guide_type' => 'sanitize_text_field',
        'guide_priority' => 'sanitize_text_field',
        'guide_learning_outcomes' => 'sanitize_textarea_field',
        'guide_who_for' => 'sanitize_textarea_field',
        'guide_prerequisites' => 'sanitize_textarea_field',
        'guide_next_steps' => 'sanitize_textarea_field',
        'guide_external_resources' => 'sanitize_textarea_field',
        'guide_downloadable_file' => 'absint',
        'guide_related_services' => 'sanitize_text_field',
    );

    foreach ( $fields as $field => $sanitize_callback ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, $sanitize_callback( $_POST[$field] ) );
        }
    }

    // Handle checkboxes
    $checkboxes = array( 'guide_featured', 'guide_coming_soon', 'guide_enable_comments', 'guide_enable_sharing', 'guide_enable_print' );
    foreach ( $checkboxes as $checkbox ) {
        $value = isset( $_POST[$checkbox] ) ? '1' : '0';
        update_post_meta( $post_id, '_' . $checkbox, $value );
    }
}
add_action( 'save_post', 'smoothmigration_save_guide_meta' );

/**
 * Enqueue media uploader on guide edit pages
 */
function smoothmigration_enqueue_guide_media_uploader( $hook ) {
    global $post_type;
    
    if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
        if ( 'guide' === $post_type ) {
            wp_enqueue_media();
        }
    }
}
add_action( 'admin_enqueue_scripts', 'smoothmigration_enqueue_guide_media_uploader' );

/**
 * Add custom columns to guides admin list
 */
function smoothmigration_guide_columns( $columns ) {
    $columns['guide_category'] = __( 'Category', 'smoothmigration' );
    $columns['guide_difficulty'] = __( 'Difficulty', 'smoothmigration' );
    $columns['guide_duration'] = __( 'Duration', 'smoothmigration' );
    $columns['guide_priority'] = __( 'Priority', 'smoothmigration' );
    $columns['featured'] = __( 'Featured', 'smoothmigration' );
    $columns['coming_soon'] = __( 'Status', 'smoothmigration' );
    return $columns;
}
add_filter( 'manage_guide_posts_columns', 'smoothmigration_guide_columns' );

/**
 * Display custom column content
 */
function smoothmigration_guide_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'guide_category':
            $terms = get_the_terms( $post_id, 'guide_category' );
            if ( $terms ) {
                $names = wp_list_pluck( $terms, 'name' );
                echo implode( ', ', $names );
            } else {
                echo '—';
            }
            break;
            
        case 'guide_difficulty':
            $difficulty = get_post_meta( $post_id, '_guide_difficulty', true );
            if ( $difficulty ) {
                $colors = array(
                    'Beginner' => '#10b981',
                    'Intermediate' => '#f59e0b',
                    'Advanced' => '#ef4444'
                );
                $color = isset( $colors[$difficulty] ) ? $colors[$difficulty] : '#6b7280';
                echo '<span style="color: ' . $color . '; font-weight: 600;">' . $difficulty . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'guide_duration':
            $duration = get_post_meta( $post_id, '_guide_duration', true );
            echo $duration ?: '—';
            break;
            
        case 'guide_priority':
            $priority = get_post_meta( $post_id, '_guide_priority', true );
            if ( $priority ) {
                $colors = array(
                    'Essential' => '#ef4444',
                    'Recommended' => '#f59e0b',
                    'Optional' => '#6b7280'
                );
                $color = isset( $colors[$priority] ) ? $colors[$priority] : '#6b7280';
                echo '<span style="color: ' . $color . '; font-weight: 600;">' . $priority . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'featured':
            $featured = get_post_meta( $post_id, '_guide_featured', true );
            echo $featured ? '<span style="color: #10b981;">★ Featured</span>' : '—';
            break;
            
        case 'coming_soon':
            $coming_soon = get_post_meta( $post_id, '_guide_coming_soon', true );
            if ( $coming_soon ) {
                echo '<span style="color: #f59e0b; font-weight: 600;">Coming Soon</span>';
            } else {
                echo '<span style="color: #10b981; font-weight: 600;">Published</span>';
            }
            break;
    }
}
add_action( 'manage_guide_posts_custom_column', 'smoothmigration_guide_column_content', 10, 2 );

/**
 * Create default guide categories and terms on activation
 */
function smoothmigration_create_default_guide_terms() {
    // Guide Categories
    $categories = array(
        'Pre-Move Planning' => 'Essential steps for planning your move 3-6 months ahead',
        'Documentation & Legal' => 'Visa requirements, permits, and legal documentation',
        'Housing & Banking' => 'Finding accommodation and setting up financial accounts',
        'Country-Specific' => 'Destination-specific guides and requirements',
        'Cultural Integration' => 'Adapting to new cultures and building networks',
        'Family & Education' => 'Moving with family, schools, and healthcare',
        'Emergency & Contingency' => 'Backup plans and emergency preparedness'
    );
    
    foreach ( $categories as $name => $description ) {
        if ( ! term_exists( $name, 'guide_category' ) ) {
            wp_insert_term( $name, 'guide_category', array(
                'description' => $description
            ) );
        }
    }
    
    // Guide Countries
    $countries = array( 'United States', 'Canada', 'United Kingdom', 'Australia', 'Germany', 'Netherlands', 'Global' );
    foreach ( $countries as $country ) {
        if ( ! term_exists( $country, 'guide_country' ) ) {
            wp_insert_term( $country, 'guide_country' );
        }
    }
    
    // Guide Timelines
    $timelines = array( 'Pre-Move', 'Moving Week', 'First Month', 'First 3 Months', 'Settling In', 'Long-term' );
    foreach ( $timelines as $timeline ) {
        if ( ! term_exists( $timeline, 'guide_timeline' ) ) {
            wp_insert_term( $timeline, 'guide_timeline' );
        }
    }
}

// Run on theme activation
add_action( 'after_switch_theme', 'smoothmigration_create_default_guide_terms' );
