<?php
/**
 * Template Name: Contact Page
 * The template for displaying the Contact page.
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="contact-page-container" style="padding: 4rem 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="contact-info-wrapper" style="background: var(--bg-light); border-radius: var(--border-radius); padding: 2rem; box-shadow: var(--shadow-md); height: 100%;">
                        <h1 class="display-5" style="color: var(--primary-color);">Get in Touch</h1>
                        <p class="lead" style="color: var(--text-light);">We're here to help you with your move. Reach out to us anytime.</p>
                        
                        <div class="contact-details mt-4">
                            <p>Smooth Migration is a premier relocation company committed to helping its customers however it can. Feel free to reach out to us either at the phone number below, email below, or our mailing address. Alternatively leave a message in the contact form on the website.</p>
                            <hr style="border-color: var(--border-light);">
                            <p><strong><i class="fas fa-phone-alt" style="color: var(--primary-color); margin-right: 10px;"></i>Phone:</strong> 555-555-5555</p>
                            <p><strong><i class="fas fa-envelope" style="color: var(--primary-color); margin-right: 10px;"></i>Email:</strong> contact@smoothmigration.com</p>
                            <p><strong><i class="fas fa-map-marker-alt" style="color: var(--primary-color); margin-right: 10px;"></i>Address:</strong> 123 Relocation Drive, Moville, USA</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-wrapper" style="background: #fff; border-radius: var(--border-radius); padding: 2rem; box-shadow: var(--shadow-lg);">
                        <h2 class="wp-block-heading">Send us a Message</h2>
                        <?php echo do_shortcode('[forminator_form id="151"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- .site-main -->

<?php
get_footer(); 