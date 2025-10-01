<?php
/**
 * AJAX handling.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add Quick View modal HTML to the footer.
 */
function smoothmigration_add_quick_view_modal() {
    // Only add modal on pages where it might be used
    if ( is_page( 'services' ) || is_singular( 'service' ) || is_tax( 'service_type' ) ) {
        echo '<!-- Quick View Modal -->
        <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="quickViewModalLabel">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Service details will be loaded here via AJAX -->
              </div>
            </div>
          </div>
        </div>';
    }
}
add_action( 'wp_footer', 'smoothmigration_add_quick_view_modal' );

/**
 * AJAX handler to get services for a specific service type.
 */
function smoothmigration_get_services_for_type() {
    // 1. Security check
    check_ajax_referer( 'smoothmigration_quick_view_nonce', 'nonce' );

    // 2. Get the service type slug from the AJAX request
    if ( ! isset( $_POST['service_type_slug'] ) ) {
        wp_send_json_error( array( 'message' => 'No service type specified.' ) );
    }
    $service_type_slug = sanitize_text_field( $_POST['service_type_slug'] );

    // 3. Query for services of that type
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1, // Get all services of this type
        'tax_query'      => array(
            array(
                'taxonomy' => 'service_type',
                'field'    => 'slug',
                'terms'    => $service_type_slug,
            ),
        ),
        'orderby'        => 'title',
        'order'          => 'ASC'
    );
    $services_query = new WP_Query( $args );

    // 4. Prepare the data to send back
    $services_data = array();
    if ( $services_query->have_posts() ) {
        while ( $services_query->have_posts() ) {
            $services_query->the_post();
            
            // Prioritize curated quick view from Service_Blurbs.xlsx
            $quick_view_meta = get_post_meta( get_the_ID(), '_service_quick_view', true );
            if ( ! empty( $quick_view_meta ) ) {
                $short = $quick_view_meta;
            } else {
                // Fallback: generate excerpt from post content
                $raw = has_excerpt() ? get_the_excerpt() : strip_tags( get_the_content() );
                $raw = preg_replace( '/^\s*(Overview|Summary)[:\s]+/i', '', (string) $raw );
                $short = wp_trim_words( trim( preg_replace( '/\s+/', ' ', (string) $raw ) ), 18, '…' );
            }
            
            $services_data[] = array(
                'title'   => get_the_title(),
                'excerpt' => $short,
            );
        }
    }
    wp_reset_postdata();

    // 5. Send the successful JSON response
    wp_send_json_success( $services_data );
}
add_action( 'wp_ajax_get_services_for_type', 'smoothmigration_get_services_for_type' ); // For logged-in users
add_action( 'wp_ajax_nopriv_get_services_for_type', 'smoothmigration_get_services_for_type' ); // For logged-out users

/**
 * AJAX handler for contact form submission.
 */
function smoothmigration_submit_contact_form() {
    // Security check
    check_ajax_referer( 'smoothmigration_contact_nonce', 'nonce' );

    // Sanitize and validate input data
    $name = sanitize_text_field( $_POST['name'] ?? '' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    $moving_from = sanitize_text_field( $_POST['movingFrom'] ?? '' );
    $moving_to = sanitize_text_field( $_POST['movingTo'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    // Basic validation
    $errors = array();
    
    if ( empty( $name ) ) {
        $errors[] = 'Name is required.';
    }
    
    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors[] = 'Valid email is required.';
    }
    
    if ( empty( $message ) ) {
        $errors[] = 'Message is required.';
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'message' => implode( ' ', $errors ) ) );
    }

    // Prepare email content
    $to = 'contact@smoothmigration.net';
    $subject = 'New Contact Form Submission - ' . get_bloginfo( 'name' );
    
    $email_content = "New contact form submission:\n\n";
    $email_content .= "Name: {$name}\n";
    $email_content .= "Email: {$email}\n";
    $email_content .= "Moving From: {$moving_from}\n";
    $email_content .= "Moving To: {$moving_to}\n";
    $email_content .= "Message:\n{$message}\n\n";
    $email_content .= "Submitted from: " . home_url() . "\n";
    $email_content .= "Date: " . current_time( 'mysql' );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <hello@smoothmigration.net>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Send email
    $mail_sent = wp_mail( $to, $subject, $email_content, $headers );

    if ( $mail_sent ) {
        // Optionally store in database for backup
        $contact_data = array(
            'name' => $name,
            'email' => $email,
            'moving_from' => $moving_from,
            'moving_to' => $moving_to,
            'message' => $message,
            'submitted_at' => current_time( 'mysql' ),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? ''
        );
        
        // You could store this in a custom table or as post meta
        // For now, we'll just send the success response
        
        wp_send_json_success( array( 
            'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.' 
        ) );
    } else {
        wp_send_json_error( array( 
            'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.' 
        ) );
    }
}
add_action( 'wp_ajax_submit_contact_form', 'smoothmigration_submit_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'smoothmigration_submit_contact_form' ); 

/**
 * AJAX handler for Realtor Locator submissions.
 */
function smoothmigration_submit_realtor_form() {
    check_ajax_referer( 'smoothmigration_contact_nonce', 'nonce' );

    $name         = sanitize_text_field( $_POST['name'] ?? '' );
    $email        = sanitize_email( $_POST['email'] ?? '' );
    $phone        = sanitize_text_field( $_POST['phone'] ?? '' );
    $country      = sanitize_text_field( $_POST['country'] ?? '' );
    $city         = sanitize_text_field( $_POST['city'] ?? '' );
    $propertyType = sanitize_text_field( $_POST['propertyType'] ?? '' );
    $budgetMin    = sanitize_text_field( $_POST['budgetMin'] ?? '' );
    $budgetMax    = sanitize_text_field( $_POST['budgetMax'] ?? '' );
    $message      = sanitize_textarea_field( $_POST['message'] ?? '' );

    $to      = 'realtor@smoothmigration.net';
    $subject = 'Realtor Locator Submission - ' . get_bloginfo( 'name' );

    $email_content  = "New Realtor Locator submission:\n\n";
    $email_content .= "Name: {$name}\n";
    $email_content .= "Email: {$email}\n";
    $email_content .= "Phone: {$phone}\n";
    $email_content .= "Country: {$country}\n";
    $email_content .= "City: {$city}\n";
    $email_content .= "Property Type: {$propertyType}\n";
    $email_content .= "Budget: {$budgetMin} - {$budgetMax}\n";
    $email_content .= "Message:\n{$message}\n\n";
    $email_content .= 'Submitted from: ' . home_url() . "\n";
    $email_content .= 'Date: ' . current_time( 'mysql' );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <hello@smoothmigration.net>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    $mail_sent = wp_mail( $to, $subject, $email_content, $headers );

    if ( $mail_sent ) {
        wp_send_json_success( array( 'message' => 'Thanks! We’ll match you with a vetted realtor within 24 hours.' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Sorry, there was an error sending your request. Please try again.' ) );
    }
}
add_action( 'wp_ajax_submit_realtor_form', 'smoothmigration_submit_realtor_form' );
add_action( 'wp_ajax_nopriv_submit_realtor_form', 'smoothmigration_submit_realtor_form' );

/**
 * AJAX handler for loading guides with filtering and pagination
 */
function smoothmigration_load_guides() {
    // Security check
    check_ajax_referer( 'load_guides_nonce', 'nonce' );
    
    // Get parameters
    $page = absint( $_POST['page'] ?? 1 );
    $search = sanitize_text_field( $_POST['search'] ?? '' );
    $category = sanitize_text_field( $_POST['category'] ?? '' );
    $difficulty = sanitize_text_field( $_POST['difficulty'] ?? '' );
    $timeline = sanitize_text_field( $_POST['timeline'] ?? '' );
    $country = sanitize_text_field( $_POST['country'] ?? '' );
    $sort = sanitize_text_field( $_POST['sort'] ?? 'date' );
    $per_page = 9;
    
    // Build query arguments
    $args = array(
        'post_type' => 'guide',
        'post_status' => 'publish',
        'posts_per_page' => $per_page,
        'paged' => $page
    );
    
    // Search
    if ( ! empty( $search ) ) {
        $args['s'] = $search;
    }
    
    // Tax queries
    $tax_query = array();
    
    if ( ! empty( $category ) ) {
        $tax_query[] = array(
            'taxonomy' => 'guide_category',
            'field' => 'slug',
            'terms' => $category
        );
    }
    
    if ( ! empty( $timeline ) ) {
        $tax_query[] = array(
            'taxonomy' => 'guide_timeline',
            'field' => 'slug',
            'terms' => $timeline
        );
    }
    
    if ( ! empty( $country ) ) {
        $tax_query[] = array(
            'taxonomy' => 'guide_country',
            'field' => 'slug',
            'terms' => $country
        );
    }
    
    if ( ! empty( $tax_query ) ) {
        $args['tax_query'] = $tax_query;
    }
    
    // Meta queries
    $meta_query = array();
    
    if ( ! empty( $difficulty ) ) {
        $meta_query[] = array(
            'key' => '_guide_difficulty',
            'value' => $difficulty,
            'compare' => '='
        );
    }
    
    if ( ! empty( $meta_query ) ) {
        $args['meta_query'] = $meta_query;
    }
    
    // Sorting
    switch ( $sort ) {
        case 'title':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'difficulty':
            $args['meta_key'] = '_guide_difficulty';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'ASC';
            break;
        case 'duration':
            $args['meta_key'] = '_guide_duration';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'ASC';
            break;
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }
    
    // Execute query
    $guides_query = new WP_Query( $args );
    
    if ( $guides_query->have_posts() ) {
        $guides_html = '';
        $guides_data = array();
        
        while ( $guides_query->have_posts() ) {
            $guides_query->the_post();
            $guide_id = get_the_ID();
            
            $guides_data[] = array(
                'id' => $guide_id,
                'title' => get_the_title(),
                'link' => get_permalink()
            );
            
            // Render guide card
            ob_start();
            echo '<div class="col-lg-4 col-md-6 mb-4">';
            echo smoothmigration_render_guide_card( $guide_id );
            echo '</div>';
            $guides_html .= ob_get_clean();
        }
        
        wp_reset_postdata();
        
        wp_send_json_success( array(
            'html' => $guides_html,
            'guides' => $guides_data,
            'total' => $guides_query->found_posts,
            'pages' => $guides_query->max_num_pages,
            'current_page' => $page
        ) );
    } else {
        wp_send_json_error( array(
            'message' => 'No guides found matching your criteria.'
        ) );
    }
}
add_action( 'wp_ajax_load_guides', 'smoothmigration_load_guides' );
add_action( 'wp_ajax_nopriv_load_guides', 'smoothmigration_load_guides' );