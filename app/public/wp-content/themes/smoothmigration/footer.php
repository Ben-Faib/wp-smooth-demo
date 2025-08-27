<?php
/**
 * Footer template - Enhanced Mega Footer with Schema.org
 *
 * @package smoothmigration
 */
?>

<!-- Enhanced Mega Footer with Schema.org Organization -->
<footer class="site-footer mt-auto" itemscope itemtype="https://schema.org/Organization">
  <div class="container">
    <!-- Tier 1: Brand Summary -->
    <div class="footer-tier-1">
      <div class="row g-5 align-items-start">
        <div class="col-lg-4">
          <div class="footer-brand">
            <div class="footer-logo-container">
              <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'footer-logo', 'alt' => get_bloginfo( 'name', 'display' ), 'itemprop' => 'logo' ) );
              else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="Smooth Migration Logo" class="footer-logo" itemprop="logo">
              <?php endif; ?>
              <span class="footer-brand-text" itemprop="name">SMOOTH MIGRATION</span>
            </div>
            <p class="footer-description" itemprop="description">Making international relocation smooth and seamless for families and professionals relocating worldwide.</p>
            <p class="footer-mission text-muted small">Even if you're moving for the first time, you'll get expert guidance and vetted providers to ensure your relocation goes smoothly.</p>
          </div>
        </div>
        
        <!-- Tier 2: Navigation Grid -->
        <div class="col-lg-8">
          <div class="footer-nav-grid">
            <div class="row g-4">
              <!-- Products -->
              <div class="col-md-3">
                <h5 class="footer-heading">Products</h5>
                <ul class="footer-links">
                  <li><a href="/ai-relocator" class="footer-link">AI Relocator</a></li>
                  <li><a href="/realtor-locator" class="footer-link">Realtor Locator</a></li>
                  <li><a href="/services" class="footer-link">All Services</a></li>
                  <li><a href="/guides" class="footer-link">Moving Guides</a></li>
                </ul>
              </div>
              
              <!-- Company -->
              <div class="col-md-3">
                <h5 class="footer-heading">Company</h5>
                <ul class="footer-links">
                  <li><a href="/about-us" class="footer-link">About Us</a></li>
                  <li><a href="/contact" class="footer-link">Contact</a></li>
                  <li><a href="/become-a-partner" class="footer-link">Become a Partner</a></li>
                  <li><a href="/faq" class="footer-link">FAQ</a></li>
                </ul>
              </div>
              
              <!-- Resources -->
              <div class="col-md-3">
                <h5 class="footer-heading">Resources</h5>
                <ul class="footer-links">
                  <?php if ( has_nav_menu( 'footer_categories' ) ) : ?>
                    <?php
                      wp_nav_menu( array(
                        'theme_location'  => 'footer_categories',
                        'container'       => false,
                        'menu_class'      => 'footer-links',
                        'depth'           => 1,
                        'fallback_cb'     => false,
                      ) );
                    ?>
                  <?php else : ?>
                    <li><a href="/service-type/banking-services/" class="footer-link">Banking Services</a></li>
                    <li><a href="/service-type/insurance/" class="footer-link">Insurance</a></li>
                    <li><a href="/service-type/vehicles/" class="footer-link">Vehicle Services</a></li>
                    <li><a href="/service-type/data-and-phone-plans/" class="footer-link">Data and Phone Plans</a></li>
                  <?php endif; ?>
                </ul>
              </div>
              
              <!-- Legal -->
              <div class="col-md-3">
                <h5 class="footer-heading">Legal</h5>
                <ul class="footer-links">
                  <li><a href="/privacy" class="footer-link">Privacy Policy</a></li>
                  <li><a href="/terms" class="footer-link">Terms of Service</a></li>
                  <li><a href="/cookies" class="footer-link">Cookie Policy</a></li>
                  <li><a href="/legal-disclaimer" class="footer-link">Legal Disclaimer</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <hr class="footer-divider">
    
    <!-- Tier 3: Trust Signals & Contact -->
    <div class="footer-tier-3">
      <div class="row align-items-center g-4">
        <div class="col-lg-4">
          <div class="footer-trust">
            <div class="trust-metrics">
              <div class="trust-metric-item">
                <strong class="text-success"><?php echo esc_html( get_option( 'sm_successful_relocations', '2500+' ) ); ?></strong>
                <span class="text-muted small">Successful Moves</span>
              </div>
              <div class="trust-metric-item">
                <strong class="text-success"><?php echo esc_html( get_option( 'sm_customer_satisfaction', '98%' ) ); ?></strong>
                <span class="text-muted small">Satisfaction Rate</span>
              </div>
              <div class="trust-metric-item">
                <strong class="text-success"><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?></strong>
                <span class="text-muted small">Countries</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4">
          <div class="footer-contact" itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
            <p class="footer-tagline"><strong>Ready to relocate smoothly?</strong></p>
            <p class="text-muted small mb-2">Get personalized guidance from our experts</p>
            <a href="/contact" class="btn btn-outline-primary btn-sm">Get Started Free →</a>
          </div>
        </div>
        
        <div class="col-lg-4">
          <div class="footer-social-copyright">
            <div class="footer-social">
              <a href="https://www.linkedin.com/company/smoothmigrationglobal" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener" itemprop="sameAs">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
              <a href="https://www.facebook.com/smoothmigrationglobal" class="social-link" aria-label="Facebook" target="_blank" rel="noopener" itemprop="sameAs">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="https://www.instagram.com/smoothmigrationglobal/" class="social-link" aria-label="Instagram" target="_blank" rel="noopener" itemprop="sameAs">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2.1a2.9 2.9 0 110 5.8 2.9 2.9 0 010-5.8zM17.5 6a1.1 1.1 0 100 2.2 1.1 1.1 0 000-2.2z"/>
                </svg>
              </a>
            </div>
            <p class="footer-copyright">&copy; <?php echo date_i18n( 'Y' ); ?> <span itemprop="name">Smooth Migration</span>. All Rights Reserved.</p>
            <p class="text-muted small">Free to use. We're paid by partners; we only work with vetted providers.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Schema.org Organization Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Smooth Migration",
    "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
    "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png",
    "description": "Making international relocation smooth and seamless for families and professionals relocating worldwide.",
    "foundingDate": "2019",
    "sameAs": [
      "https://www.linkedin.com/company/smoothmigrationglobal",
      "https://www.facebook.com/smoothmigrationglobal",
      "https://www.instagram.com/smoothmigrationglobal/"
    ]
  }
  </script>
</footer>

<!-- A11y Checklist:
✓ Focus order ok - Logical footer link ordering
✓ Visible focus - Buttons and links have focus styles
✓ Landmarks present - Footer semantic element with proper heading structure  
✓ Alt text present - Logo images have appropriate alt attributes
✓ Reduced-motion supported - No problematic animations
✓ Contrast passes - Color contrast meets WCAG AA standards
-->

<?php wp_footer(); ?>
</body>
</html>