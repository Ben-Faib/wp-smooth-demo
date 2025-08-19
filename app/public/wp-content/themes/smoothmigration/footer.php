<?php
/**
 * Footer template - Improved & Simplified
 *
 * @package smoothmigration
 */
?>

<!-- Improved Footer -->
<footer class="site-footer mt-auto">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-5">
        <div class="footer-brand">
          <div class="footer-logo-container">
            <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'footer-logo', 'alt' => get_bloginfo( 'name', 'display' ) ) );
            else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="Smooth Migration Logo" class="footer-logo">
            <?php endif; ?>
            <span class="footer-brand-text">SMOOTH MIGRATION</span>
          </div>
          <p class="footer-description">Making international relocation smooth and seamless for relocating worldwide.</p>
        </div>
      </div>
      
      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-4">
            <h5 class="footer-heading">Quick Links</h5>
            <ul class="footer-links">
              <li><a href="/services" class="footer-link">Services</a></li>
              <li><a href="/contact" class="footer-link">Contact</a></li>
              <li><a href="/about" class="footer-link">About Us</a></li>
              <li><a href="/become-a-partner" class="footer-link">Partner Contact</a></li>
            </ul>
            <?php if ( has_nav_menu( 'footer_categories' ) ) : ?>
              <h5 class="footer-heading mt-4">Top Categories</h5>
              <?php
                wp_nav_menu( array(
                  'theme_location'  => 'footer_categories',
                  'container'       => false,
                  'menu_class'      => 'footer-links',
                  'depth'           => 1,
                  'fallback_cb'     => false,
                ) );
              ?>
            <?php endif; ?>
          </div>
          
          <div class="col-md-4">
            <h5 class="footer-heading">Resources</h5>
            <ul class="footer-links">
              <li><a href="/ai-relocator" class="footer-link">AI Relocator</a></li>
              <li><a href="/guides" class="footer-link">Moving Guides</a></li>
              <li><a href="/faq" class="footer-link">FAQ</a></li>
            </ul>
          </div>
          
          <div class="col-md-4">
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
    
    <hr class="footer-divider">
    
    <div class="row align-items-center">
      <div class="col-md-6">
        <p class="footer-copyright">&copy; <?php echo date_i18n( 'Y' ); ?> Smooth Migration. <?php _e( 'All Rights Reserved', 'smoothmigration' ); ?></p>
      </div>
      <div class="col-md-6">
        <div class="footer-social">
          <?php if ( has_nav_menu( 'social' ) ) : ?>
            <?php
              wp_nav_menu( array(
                'theme_location'  => 'social',
                'container'       => false,
                'menu_class'      => 'footer-links d-none',
                'depth'           => 1,
                'fallback_cb'     => false,
                'link_before'     => '',
                'link_after'      => '',
              ) );
            ?>
          <?php endif; ?>
          <a href="https://www.linkedin.com/company/smoothmigrationglobal" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
          </a>
          
          <a href="https://www.facebook.com/smoothmigrationglobal" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <a href="https://www.instagram.com/smoothmigrationglobal/" class="social-link" aria-label="Instagram" target="_blank" rel="noopener">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2.1a2.9 2.9 0 110 5.8 2.9 2.9 0 010-5.8zM17.5 6a1.1 1.1 0 100 2.2 1.1 1.1 0 000-2.2z"/>
            </svg>
          </a>
        </div>
        <p class="text-end text-muted small mb-0 d-none d-md-block">Smooth Migration is free to use. We’re paid by partners; we only work with vetted providers.</p>
      </div>
    </div>
  </div>
</footer>



<?php wp_footer(); ?>
</body>
</html> 