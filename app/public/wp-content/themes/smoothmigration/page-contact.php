<?php
/**
 * Contact Page Template
 * Modern contact page with comprehensive information and professional styling
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main contact-page" role="main">

    <!-- Hero Section -->
    <section class="contact-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-contact"><?php echo sm_icon('comments', 'solid', 'me-2 icon'); ?> Get In Touch</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Contact Us</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Ready to start your international relocation journey? Our expert team is here to guide you through every step of the process.</p>
                        
                        <div class="contact-highlights mb-4">
                            <div class="highlight-item">
                                <i class="fas fa-clock me-2"></i>
                                <span>24h Response Time</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-globe me-2"></i>
                                <span>Global Coverage</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-users me-2"></i>
                                <span>Expert Team</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-shield-alt me-2"></i>
                                <span>Trusted Service</span>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="#contact-form" class="btn btn-accent btn-lg me-3">
                                <i class="fas fa-paper-plane me-2"></i>
                                Send Message
                            </a>
                            <a href="tel:+16042837626" class="btn btn-outline-light btn-lg" aria-label="Call us now at 604 283 7626">
                                <i class="fas fa-phone me-2"></i>
                                Call Now!
                            </a>
                        </div>
                        
                        <div class="contact-stats mt-4">
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_successful_relocations', '2500+' ) ); ?></div>
                                <div class="stat-label">Clients Helped</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_customer_satisfaction', '98%' ) ); ?></div>
                                <div class="stat-label">Satisfaction Rate</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?></div>
                                <div class="stat-label">Countries</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="contact-graphic">
                            <div class="graphic-element">
                                <div class="contact-bubbles">
                                    <div class="bubble bubble-1">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email</span>
                                    </div>
                                    <div class="bubble bubble-2">
                                        <i class="fas fa-phone"></i>
                                        <span>Phone</span>
                                    </div>
                                    <div class="bubble bubble-3">
                                        <i class="fas fa-calendar"></i>
                                        <span>Schedule</span>
                                    </div>
                                    <div class="bubble bubble-4">
                                        <i class="fas fa-comments"></i>
                                        <span>Chat</span>
                                    </div>
                                </div>
                                <div class="center-element">
                                    <i class="fas fa-headset display-1 text-accent"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- Contact Options -->
    <section id="contact-options" class="contact-options py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Contact Us</h2>
                    <p class="section-subtitle">Choose the contact method that works best for you. We're here to help with any questions about your relocation.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method animate-on-scroll">
                        <div class="method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="method-title">Email Us</h3>
                        <p class="method-description">Send us a detailed message and we'll respond within 24 hours.</p>
                        <div class="method-action">
                            <a href="mailto:contact@smoothmigration.net" class="btn btn-primary" aria-label="Email us at contact@smoothmigration.net">
                                <i class="fas fa-envelope me-2"></i>
                                Email Us!
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="method-icon bg-secondary">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="method-title">Call Us</h3>
                        <p class="method-description">Speak directly with our relocation experts for immediate assistance.</p>
                        <div class="method-action">
                            <a href="tel:+16042837626" class="btn btn-secondary" aria-label="Call us now at 604 283 7626">
                                <i class="fas fa-phone me-2"></i>
                                Call Now!
                            </a>
                        </div>
                        <div class="business-hours mt-2">
                            <small class="text-muted">Mon-Fri: 9AM-6PM EST</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="method-icon bg-success">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="method-title">Book a Call</h3>
                        <p class="method-description">Schedule a free consultation to discuss your specific needs.</p>
                        <div class="method-action">
                            <a href="#contact-form" class="btn btn-success">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Schedule Call
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="method-icon bg-info">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <h3 class="method-title">FAQ & Help</h3>
                        <p class="method-description">Find quick answers to common relocation questions.</p>
                        <div class="method-action">
                            <a href="/faq" class="btn btn-info">
                                <i class="fas fa-search me-2"></i>
                                Browse FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form" class="contact-form-section py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        <div class="form-header text-center mb-5">
                            <h2 class="section-title">Send Us a Message</h2>
                            <p class="section-subtitle">For any queries not listed, complete our contact form, our team will get back to you within 48 hours.</p>
                            <div class="response-promise">
                                <div class="promise-badge">
                                    <i class="fas fa-clock me-2"></i>
                                    <span><strong>We typically respond within 48 hours</strong></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-wrapper">
                            <!-- Forminator Form Integration -->
                            <div class="forminator-integration">
                                <?php echo do_shortcode('[forminator_form id="151"]'); ?>
                            </div>
                        </div>
                        
                        <div class="form-footer text-center mt-4">
                            <div class="privacy-notice">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                <small class="text-muted">
                                    Your information is secure and will only be used to respond to your inquiry. 
                                    View our <a href="/privacy" class="text-primary">Privacy Policy</a>.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust & Credibility -->
    <section class="trust-section py-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="trust-content">
                        <h2 class="section-title text-start">Why Choose Smooth Migration?</h2>
                        <p class="lead mb-4">We've helped thousands of families and professionals make successful international relocations with confidence and peace of mind.</p>
                        
                        <div class="trust-features">
                            <div class="trust-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-certificate text-primary"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Licensed & Certified</h4>
                                    <p>All our partners are fully licensed and vetted for quality assurance.</p>
                                </div>
                            </div>
                            
                            <div class="trust-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-globe text-success"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Global Experience</h4>
                                    <p>Extensive experience across 5+ countries and diverse cultures.</p>
                                </div>
                            </div>
                            
                            <div class="trust-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-handshake text-info"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Personal Support</h4>
                                    <p>Dedicated support throughout your entire relocation journey.</p>
                                </div>
                            </div>
                            
                            <div class="trust-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Timely Service</h4>
                                    <p>Quick response times and efficient service delivery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="office-info">
                        <div class="info-card">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                Our Office
                            </h3>
                            <div class="office-details">
                                <p class="address">
                                    <strong>Head Office</strong><br>
                                    1011-5307 Victoria Drive<br>
                                    Vancouver, BC<br>
                                    V5P 3V6<br>
                                    Canada
                                </p>
                                <p class="address mt-4">
                                    <strong>England Office</strong><br>
                                    Bournevale Rd,<br>
                                    London, England<br>
                                    SW16 2BA<br>
                                    United Kingdom
                                </p>
                                <p class="address mt-4">
                                    <strong>Call Centre Phone:</strong><br>
                                    <a href="tel:+16042837626" class="text-primary">604 283 7626</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <h3 class="card-title">
                                <i class="fas fa-clock me-2 text-success"></i>
                                Business Hours
                            </h3>
                            <div class="hours-list">
                                <div class="hours-item">
                                    <span class="day">Monday - Friday:</span>
                                    <span class="time">9:00 AM - 6:00 PM EST</span>
                                </div>
                                <div class="hours-item">
                                    <span class="day">Saturday:</span>
                                    <span class="time">10:00 AM - 4:00 PM EST</span>
                                </div>
                                <div class="hours-item">
                                    <span class="day">Sunday:</span>
                                    <span class="time">Closed</span>
                                </div>
                                <div class="emergency-note">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        For urgent matters outside business hours, email us and we'll respond first thing the next business day.
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <h3 class="card-title">
                                <i class="fas fa-users me-2 text-info"></i>
                                Our Team
                            </h3>
                            <p>Our experienced team of relocation specialists, immigration experts, and local partners work together to ensure your move is seamless and stress-free.</p>
                            <div class="team-stats">
                                <div class="team-stat">
                                    <strong>15+</strong><span>Years Experience</span>
                                </div>
                                <div class="team-stat">
                                    <strong>25</strong><span>Team Members</span>
                                </div>
                                <div class="team-stat">
                                    <strong><?php echo esc_html( get_option( 'sm_global_partners', '60+' ) ); ?></strong><span>Global Partners</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Contact -->
    <section class="additional-contact py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="contact-info">
                        <h4 class="contact-title">
                            <i class="fas fa-phone text-primary me-2"></i>
                            Need to Contact Us?
                        </h4>
                        <p class="contact-text">Get in touch with our team for any relocation questions or assistance:</p>
                        <div class="contact-actions">
                            <a href="tel:+16042837626" class="btn btn-primary me-3" aria-label="Call us now at 604 283 7626">
                                <i class="fas fa-phone me-2"></i>
                                Call Now!
                            </a>
                            <a href="mailto:contact@smoothmigration.net" class="btn btn-outline-primary" aria-label="Email us at contact@smoothmigration.net">
                                <i class="fas fa-envelope me-2"></i>
                                Email Us!
                            </a>
                        </div>
                        <small class="text-muted d-block mt-2">
                            We typically respond within 48 hours. For immediate assistance, please call during business hours.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

 </main><!-- .site-main -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const elementsToAnimate = document.querySelectorAll('.hero-content, .hero-visual, .contact-method, .trust-feature, .info-card');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Form accessibility enhancements
    const form = document.querySelector('.forminator-integration form');
    if (form) {
        // Add ARIA live region for form messages
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        liveRegion.id = 'form-status';
        form.appendChild(liveRegion);
        
        // Enhanced form validation feedback
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.setAttribute('aria-invalid', 'true');
                    this.style.borderColor = '#dc3545';
                } else {
                    this.removeAttribute('aria-invalid');
                    this.style.borderColor = '';
                }
            });
        });
    }
    
    // Phone number click tracking (analytics)
    const phoneLinks = document.querySelectorAll('a[href^="tel:"]');
    phoneLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Track phone clicks for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'phone_call', {
                    event_category: 'contact',
                    event_label: this.href.replace('tel:', '')
                });
            }
        });
    });
    
    // Email click tracking (analytics)
    const emailLinks = document.querySelectorAll('a[href^="mailto:"]');
    emailLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Track email clicks for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'email_click', {
                    event_category: 'contact',
                    event_label: this.href.replace('mailto:', '')
                });
            }
        });
    });
    
    // Business hours highlight for current time
    const hoursItems = document.querySelectorAll('.hours-item');
    const now = new Date();
    const currentDay = now.getDay(); // 0 = Sunday, 1 = Monday, etc.
    const currentHour = now.getHours();
    
    // Highlight current day (Monday = 1, Friday = 5)
    if (currentDay >= 1 && currentDay <= 5) {
        const mondayFridayItem = hoursItems[0]; // First item is Mon-Fri
        if (mondayFridayItem && currentHour >= 9 && currentHour < 18) {
            mondayFridayItem.classList.add('current-hours');
            mondayFridayItem.style.background = 'var(--success-lighter)';
            mondayFridayItem.style.borderColor = 'var(--success-color)';
        }
    } else if (currentDay === 6) { // Saturday
        const saturdayItem = hoursItems[1]; // Second item is Saturday
        if (saturdayItem && currentHour >= 10 && currentHour < 16) {
            saturdayItem.classList.add('current-hours');
            saturdayItem.style.background = 'var(--success-lighter)';
            saturdayItem.style.borderColor = 'var(--success-color)';
        }
    }
});
</script>

<?php
get_footer();
