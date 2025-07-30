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
            $services_data[] = array(
                'title'   => get_the_title(),
                'excerpt' => has_excerpt() ? get_the_excerpt() : '',
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
    $to = get_option( 'admin_email' ); // You can change this to a specific email
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
        'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>',
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