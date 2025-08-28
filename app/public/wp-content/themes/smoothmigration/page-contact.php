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
    <section id="contact-form" class="contact-form-section py-6 bg-light position-relative overflow-visible">

        <!-- Interactive Service Cubes Background (inline SVG) -->
        <div class="contact-service-cubes-background" aria-hidden="true">
            <div class="floating-contact-service-cubes">
                <?php
                $svg_path = get_template_directory() . '/assets/svg/contact-service-cubes.svg';
                if (file_exists($svg_path)) {
                    echo file_get_contents($svg_path);
                }
                ?>
            </div>
        </div>

        <div class="container position-relative z-2">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        <div class="form-header text-center mb-3">
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
                        
                        <div class="form-footer text-center mt-2">
                            <div class="privacy-notice">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                <small class="text-muted">
                                    Your information is secure and will only be used to respond to your inquiry. 
                                    View our <a href="/privacy" class="text-primary">Privacy Policy</a>.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Service Legend -->
                    <div class="service-legend">
                        <h5 class="legend-title">Our Services</h5>
                        <div class="legend-items">
                            <div class="legend-item">
                                <span class="legend-color housing"></span>
                                <span>Housing</span>
                </div>
                            <div class="legend-item">
                                <span class="legend-color banking"></span>
                                <span>Banking</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color phone"></span>
                                <span>Phone</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color insurance"></span>
                                <span>Insurance</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color shipping"></span>
                                <span>Shipping</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color vehicle"></span>
                                <span>Vehicles</span>
                            </div>
                        </div>
                        <small class="legend-note">Hover over cubes to learn more about each service</small>
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

<style>
/* Contact Page Specific Styles */
.contact-hero {
    min-height: 100vh;
}

/* Prevent decorative elements from being clipped */
.contact-hero.overflow-hidden { overflow: visible !important; }

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-contact {
    background: rgba(59, 130, 246, 0.2);
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 700;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 2px solid var(--primary-color);
}

.contact-highlights {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin: 2rem 0;
}

.highlight-item {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-2xl);
    font-weight: 600;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.highlight-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.contact-stats {
    display: flex;
    gap: 3rem;
    margin-top: 3rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    min-width: 140px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    white-space: nowrap;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 600;
    margin-top: 0.5rem;
}

.contact-graphic {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    position: relative;
}

.graphic-element {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.center-element {
    z-index: 2;
}

.contact-bubbles {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 320px;
    height: 320px;
}

.bubble {
    position: absolute;
    width: 80px;
    height: 80px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    animation: bubble-float 4s ease-in-out infinite;
    border: 2px solid var(--border-light);
}

.bubble span {
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 0.25rem;
}

.bubble-1 { top: 0; left: 50%; transform: translateX(-50%); animation-delay: 0s; }
.bubble-2 { top: 50%; right: 0; transform: translateY(-50%); animation-delay: 1s; }
.bubble-3 { bottom: 0; left: 50%; transform: translateX(-50%); animation-delay: 2s; }
.bubble-4 { top: 50%; left: 0; transform: translateY(-50%); animation-delay: 3s; }

@keyframes bubble-float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-10px) scale(1.05); }
}

.contact-method {
    background: var(--bg-white);
    padding: 3rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
    text-align: center;
    position: relative;
}

.contact-method:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.method-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
    box-shadow: var(--shadow-md);
}

.method-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.method-description {
    color: var(--text-light);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.method-action .btn {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    white-space: normal;
    min-width: 200px;
    max-width: 100%;
    width: 100%;
}

.business-hours {
    margin-top: 1rem;
}

.form-container {
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.06) 0%,
            rgba(255, 255, 255, 0.03) 25%,
            rgba(255, 255, 255, 0.01) 50%,
            rgba(255, 255, 255, 0.03) 75%,
            rgba(255, 255, 255, 0.06) 100%);
    backdrop-filter: blur(24px) saturate(180%) contrast(120%);
    -webkit-backdrop-filter: blur(24px) saturate(180%) contrast(120%);
    border-radius: 32px;
    padding: 2.5rem;
    border: 2px solid;
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.3) 0%,
        rgba(255, 255, 255, 0.1) 25%,
        rgba(59, 130, 246, 0.15) 50%,
        rgba(255, 255, 255, 0.1) 75%,
        rgba(255, 255, 255, 0.3) 100%) 1;
    box-shadow:
        0 16px 64px rgba(0, 0, 0, 0.08),
        0 8px 32px rgba(255, 255, 255, 0.12),
        inset 0 2px 0 rgba(255, 255, 255, 0.25),
        inset 0 -2px 0 rgba(0, 0, 0, 0.05);
    max-width: 100%;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.form-container:hover {
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.09) 0%,
            rgba(255, 255, 255, 0.04) 25%,
            rgba(255, 255, 255, 0.02) 50%,
            rgba(255, 255, 255, 0.04) 75%,
            rgba(255, 255, 255, 0.09) 100%);
    backdrop-filter: blur(28px) saturate(190%) contrast(130%);
    -webkit-backdrop-filter: blur(28px) saturate(190%) contrast(130%);
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.4) 0%,
        rgba(59, 130, 246, 0.2) 25%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(59, 130, 246, 0.2) 75%,
        rgba(255, 255, 255, 0.4) 100%) 1;
    box-shadow:
        0 20px 80px rgba(0, 0, 0, 0.12),
        0 12px 48px rgba(255, 255, 255, 0.15),
        inset 0 3px 0 rgba(255, 255, 255, 0.3),
        inset 0 -3px 0 rgba(0, 0, 0, 0.08);
    transform: translateY(-2px) scale(1.005);
}

.form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    z-index: 1;
}

.form-container::after {
    content: '';
    position: absolute;
    bottom: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background:
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.04) 0%, transparent 50%);
    opacity: 0.6;
    z-index: 0;
    animation: gentle-float-bg 15s ease-in-out infinite;
    pointer-events: none;
}

@keyframes gentle-float-bg {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
        opacity: 0.6;
    }
    33% {
        transform: translate(10px, -10px) rotate(1deg);
        opacity: 0.4;
    }
    66% {
        transform: translate(-5px, 15px) rotate(-1deg);
        opacity: 0.5;
    }
}

.response-promise {
    margin-top: 1rem;
}

.promise-badge {
    background: var(--success-lighter);
    color: var(--success-dark);
    padding: 1rem 2rem;
    border-radius: var(--border-radius-2xl);
    border: 2px solid var(--success-light);
    display: inline-flex;
    align-items: center;
    font-size: 0.95rem;
}

.forminator-integration {
    /* Ensure Forminator form inherits our styling */
}

.form-wrapper {
    position: relative;
    z-index: 2;
    padding: 1rem;
}

.form-wrapper::before {
    content: '';
    position: absolute;
    top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;
    background: linear-gradient(45deg,
        rgba(255, 255, 255, 0.03) 0%,
        rgba(59, 130, 246, 0.01) 25%,
        rgba(255, 119, 198, 0.01) 50%,
        rgba(34, 197, 94, 0.01) 75%,
        rgba(255, 255, 255, 0.03) 100%);
    border-radius: 28px;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.6s ease;
    pointer-events: none;
}

.form-container:hover .form-wrapper::before {
    opacity: 1;
}

.forminator-integration .forminator-ui {
    /* Style overrides for Forminator */
    border-radius: var(--border-radius-lg) !important;
}

.forminator-integration .forminator-field {
    margin-bottom: 1rem !important;
}

.forminator-integration .forminator-input,
.forminator-integration .forminator-textarea,
.forminator-integration .forminator-select {
    border: 2px solid !important;
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.2) 0%,
        rgba(255, 255, 255, 0.1) 50%,
        rgba(59, 130, 246, 0.1) 100%) 1 !important;
    border-radius: 20px !important;
    padding: 1.25rem 1.5rem !important;
    font-size: 1rem !important;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.04) 0%,
            rgba(255, 255, 255, 0.02) 50%,
            rgba(255, 255, 255, 0.04) 100%) !important;
    backdrop-filter: blur(16px) saturate(150%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(150%) !important;
    color: var(--text-dark) !important;
    position: relative;
    z-index: 2;
    box-shadow:
        0 4px 16px rgba(0, 0, 0, 0.04),
        0 2px 8px rgba(255, 255, 255, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

.forminator-integration .forminator-input::placeholder,
.forminator-integration .forminator-textarea::placeholder {
    color: rgba(0, 0, 0, 0.6) !important;
    opacity: 0.7 !important;
}

.forminator-integration .forminator-input:focus,
.forminator-integration .forminator-textarea:focus,
.forminator-integration .forminator-select:focus {
    border-image: linear-gradient(135deg,
        rgba(59, 130, 246, 0.4) 0%,
        rgba(59, 130, 246, 0.2) 50%,
        rgba(255, 255, 255, 0.3) 100%) 1 !important;
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.06) 0%,
            rgba(59, 130, 246, 0.02) 50%,
            rgba(255, 255, 255, 0.06) 100%) !important;
    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.1),
        0 8px 24px rgba(59, 130, 246, 0.15),
        0 4px 16px rgba(0, 0, 0, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
    outline: none !important;
}

/* Avoid text blur on focus: keep form container stable while interacting */
.form-container:hover:focus-within {
    transform: none;
}

.forminator-integration .forminator-button {
    background:
        linear-gradient(135deg,
            rgba(59, 130, 246, 0.7) 0%,
            rgba(30, 64, 175, 0.75) 25%,
            rgba(59, 130, 246, 0.7) 50%,
            rgba(30, 64, 175, 0.75) 75%,
            rgba(59, 130, 246, 0.7) 100%) !important;
    border: 2px solid !important;
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.4) 0%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0.4) 100%) 1 !important;
    border-radius: 24px !important;
    padding: 1rem 2.5rem !important;
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: white !important;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
    min-height: 52px !important;
    backdrop-filter: blur(16px) saturate(150%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(150%) !important;
    position: relative;
    overflow: hidden;
    z-index: 2;
    box-shadow:
        0 8px 32px rgba(59, 130, 246, 0.3),
        0 4px 16px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.forminator-integration .forminator-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s ease;
    z-index: -1;
}

.forminator-integration .forminator-button:hover {
    transform: translateY(-4px) scale(1.03) !important;
    box-shadow:
        0 12px 40px rgba(59, 130, 246, 0.35),
        0 8px 24px rgba(0, 0, 0, 0.12),
        inset 0 2px 0 rgba(255, 255, 255, 0.25) !important;
    background:
        linear-gradient(135deg,
            rgba(59, 130, 246, 0.8) 0%,
            rgba(30, 64, 175, 0.85) 25%,
            rgba(59, 130, 246, 0.8) 50%,
            rgba(30, 64, 175, 0.85) 75%,
            rgba(59, 130, 246, 0.8) 100%) !important;
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.6) 0%,
        rgba(255, 255, 255, 0.3) 50%,
        rgba(255, 255, 255, 0.6) 100%) 1 !important;
    backdrop-filter: blur(20px) saturate(170%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(170%) !important;
}

.forminator-integration .forminator-button:hover::before {
    left: 100%;
}

.forminator-integration .forminator-button:active {
    transform: translateY(-1px) scale(0.98) !important;
}

.privacy-notice {
    padding: 1rem;
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    position: relative;
    z-index: 2;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.privacy-notice:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.18);
    transform: translateY(-1px) scale(1.01);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
}

.form-header {
    position: relative;
    z-index: 2;
    text-align: center;
    margin-bottom: 2rem;
}

.form-header::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.6), transparent);
    border-radius: 1px;
}

/* Compact form layout optimizations */
.form-container .forminator-ui {
    margin: 0 !important;
}

.forminator-integration .forminator-row {
    margin-bottom: 0.5rem !important;
}

/* Ensure form doesn't exceed viewport height unnecessarily */
.contact-form-section {
    min-height: auto;
    padding: 4rem 0;
}

/* Prevent any horizontal scroll on the contact page */
body.page-template-page-contact,
.page-template-page-contact #main,
.page-template-page-contact .site-main,
.page-template-page-contact .contact-form-section {
    overflow-x: hidden !important;
}

/* Sticky submit button for long forms (shows when scrolled) */
.form-sticky-submit {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    background: var(--gradient-primary);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 0.9rem;
    box-shadow: var(--shadow-lg);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.3s ease;
    display: none;
}

.form-sticky-submit.visible {
    transform: translateY(0);
    opacity: 1;
}

.form-sticky-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
}

.trust-feature {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding: 2rem;
    background: var(--bg-white);
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.trust-feature:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
    background: var(--bg-section);
}

.feature-icon {
    min-width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.feature-content h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.feature-content p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
}

.office-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.info-card {
    background: var(--bg-white);
    padding: 2.5rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: var(--shadow-md);
    background: var(--bg-section);
}

.card-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1.5rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
}

.address {
    color: var(--text-medium);
    line-height: 1.8;
    margin: 0;
}

.hours-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-light);
}

.hours-item:last-child {
    border-bottom: none;
}

.day {
    font-weight: 600;
    color: var(--text-dark);
}

.time {
    color: var(--text-medium);
}

.emergency-note {
    margin-top: 1rem;
    padding: 1rem;
    background: var(--bg-section);
    border-radius: var(--border-radius);
}

.team-stats {
    display: flex;
    gap: 2rem;
    margin-top: 1.5rem;
}

.team-stat {
    text-align: center;
    display: flex;
    flex-direction: column;
}

.team-stat strong {
    font-size: 1.5rem;
    color: var(--primary-color);
    font-weight: 900;
}

.team-stat span {
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 600;
}

.additional-contact {
    border-top: 1px solid var(--border-light);
}

.contact-info {
    padding: 2rem;
    background: var(--bg-white);
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 2px solid var(--border-light);
}

/* Clean Green Floating Prefill Note */
.prefill-floating-note {
    position: fixed;
    left: 24px;
    top: 50%;
    transform: translateY(-50%);
    width: 320px;
    max-width: 38vw;
    background: rgba(34, 197, 94, 0.15);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 2px solid rgba(34, 197, 94, 0.3);
    box-shadow:
        0 8px 32px rgba(34, 197, 94, 0.15),
        0 4px 16px rgba(34, 197, 94, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    padding: 1.75rem 1.75rem;
    border-radius: 12px;
    z-index: 1050;
    display: none;
    transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    opacity: 0;
    transform: translateY(-50%) translateX(-24px);
}

.prefill-floating-note.show {
    display: block;
    opacity: 1;
    transform: translateY(-50%) translateX(0);
}

.prefill-floating-note.hide {
    opacity: 0;
    transform: translateY(-50%) translateX(-24px);
}

.prefill-floating-note::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.1) 0%,
        rgba(255, 255, 255, 0.05) 50%,
        rgba(255, 255, 255, 0.1) 100%
    );
    border-radius: 16px;
    pointer-events: none;
}

.prefill-floating-note .close-note {
    appearance: none;
    border: 0;
    background: rgba(34, 197, 94, 0.2);
    color: rgba(34, 197, 94, 0.9);
    font-size: 1.2rem;
    line-height: 1;
    position: absolute;
    top: 16px;
    right: 16px;
    cursor: pointer;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.15);
}

.prefill-floating-note .close-note:hover {
    background: rgba(34, 197, 94, 0.3);
    transform: scale(1.1);
    color: rgba(255, 255, 255, 0.9);
}

.prefill-floating-note .note-text {
    font-weight: 500;
    color: rgba(34, 42, 53, 0.9);
    line-height: 1.6;
    font-size: 0.95rem;
    position: relative;
    z-index: 1;
    margin-right: 44px;
}

/* Add green glow effect */
.prefill-floating-note.show {
    box-shadow:
        0 8px 32px rgba(34, 197, 94, 0.2),
        0 4px 16px rgba(34, 197, 94, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.3),
        0 0 20px rgba(34, 197, 94, 0.25);
}
@media (max-width: 992px) { .prefill-floating-note { display: none !important; } }

.contact-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
}

.contact-text {
    color: var(--text-medium);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.contact-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero {
        min-height: 80vh;
        text-align: center;
    }
    
    .contact-highlights {
        justify-content: center;
        gap: 1rem;
    }
    
    .highlight-item {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .contact-stats {
        justify-content: center;
        gap: 2rem;
    }
    
    .contact-graphic {
        height: 250px;
        margin-top: 2rem;
    }
    
    .contact-bubbles {
        width: 220px;
        height: 220px;
    }
    
    .bubble {
        width: 60px;
        height: 60px;
        font-size: 1.2rem;
    }
    
    .form-container {
        padding: 1.5rem 1rem;
    }
    
    .office-info {
        margin-top: 3rem;
    }
    
    .team-stats {
        justify-content: center;
        gap: 1.5rem;
    }
    
    .contact-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .contact-actions .btn {
        width: 100%;
        max-width: 300px;
    }
}



/* Contact Service Cubes Background Styles */
.contact-service-cubes-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 1; /* Behind form content to avoid intercepting clicks on fields */
    pointer-events: auto; /* Allow cube interactions; we'll scope inside SVG */
    overflow: hidden;
    max-width: 100vw; /* Ensure it never exceeds viewport width */
    max-height: 100vh; /* Ensure it never exceeds viewport height */
    /* Hard clip any scaled contents to avoid page-width changes */
    -webkit-clip-path: inset(0);
    clip-path: inset(0);
}

/* Debug helpers */
.contact-service-cubes-background.debug {
    z-index: 3;
}
.floating-contact-service-cubes.debug {
    opacity: 0.45 !important;
}

.floating-contact-service-cubes {
    width: 100% !important;
    height: 100% !important;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0.20;
    transform-origin: center;
    animation: none; /* Keep cubes bouncy but stop global float to avoid horizontal scroll */
    transition: opacity 0.4s ease;
    /* Allow hovering the cubes in side gutters */
    pointer-events: auto;
    max-width: 100%; /* Constrain to parent container */
    max-height: 100%; /* Constrain to parent container */
}

.floating-contact-service-cubes .floating-cube {
    pointer-events: auto;
}

.floating-contact-service-cubes svg {
    width: 100% !important;
    height: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
    position: absolute;
    top: 0;
    left: 0;
    /* Ensure SVG animations start immediately and don't get interrupted */
    animation: none; /* Disable CSS animations that might interfere */
    /* Preserve aspect ratio and prevent overflow */
    object-fit: contain;
    overflow: hidden;
    /* We'll restrict pointer events to the cube groups explicitly */
    pointer-events: auto;
    transform: translateY(140px) scale(1.6); /* Larger scale to sit beside the form */
    transform-origin: center center;
}

/* Disable pointer events for everything in the SVG by default, then re-enable for cubes */
.floating-contact-service-cubes svg * {
    pointer-events: none;
}

.floating-contact-service-cubes:hover {
    opacity: 0.28;
}

.floating-contact-service-cubes .floating-cube {
    transform-origin: center;
    opacity: 1;
    /* Remove transition that interferes with SVG animations */
    cursor: pointer;
    pointer-events: auto; /* Re-enable interaction on cube groups */
}

/* Ensure contact SVG cubes ignore any global scroll/floating animations */
.floating-contact-service-cubes .floating-cube,
.floating-contact-service-cubes .floating-cube.animate-on-scroll,
.floating-contact-service-cubes .floating-cube.animate-float,
.floating-contact-service-cubes .floating-cube.animate-in {
    opacity: 1 !important; /* Do not override transform/animation so SMIL bounciness remains */
}

.floating-contact-service-cubes .floating-cube:hover {
    transform: none !important; /* Stay stationary on hover */
}
/* Apply visual treatment to inner <g> so we don't override the SVG filter attribute */
.floating-contact-service-cubes .floating-cube:hover > g {
    filter: brightness(1.15);
}

/* Individual cube hover effects with color-specific glows */
.floating-contact-service-cubes .housing-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(59, 130, 246, 0.4));
}

.floating-contact-service-cubes .banking-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(16, 185, 129, 0.4));
}

.floating-contact-service-cubes .phone-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(139, 92, 246, 0.4));
}

.floating-contact-service-cubes .insurance-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(239, 68, 68, 0.4));
}

.floating-contact-service-cubes .shipping-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(245, 158, 11, 0.4));
}

.floating-contact-service-cubes .vehicle-cube:hover > g {
    filter: brightness(1.15) drop-shadow(0 0 8px rgba(6, 182, 212, 0.4));
}

.floating-contact-service-cubes .cube-connections {
    opacity: 0.22 !important; /* Slightly more visible */
    transition: opacity 0.3s ease;
}

.floating-contact-service-cubes:hover .cube-connections {
    opacity: 0.32 !important;
}

/* Individual cube hover effects - removed animation-duration changes that interrupt SVG animations */

/* Subtle floating animation for the entire background */
@keyframes gentle-float {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        transform: translate(-8px, -8px) rotate(0.3deg);
    }
    50% {
        transform: translate(8px, -12px) rotate(-0.3deg);
    }
    75% {
        transform: translate(-6px, -10px) rotate(0.2deg);
    }
}

/* Ensure form content stays above background */
.contact-form-section {
    overflow: visible !important;
}

.contact-form-section .container {
    z-index: 2;
    position: relative;
}

.form-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

/* Contact form background - Glass effect (always applied) */
.contact-form-section {
    background:
        radial-gradient(600px 300px at 50% 0%, rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0.2) 70%, transparent 100%),
        radial-gradient(1200px 800px at 50% 100%, rgba(59, 130, 246, 0.07), transparent 60%),
        conic-gradient(from 200deg at 60% 0%, rgba(255, 255, 255, 0.12), transparent 60%),
        linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 50%, rgba(139, 92, 246, 0.03) 100%);
}

/* Service Cube Tooltips */
.service-tooltip {
    position: fixed;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    box-shadow:
        0 8px 32px rgba(0, 0, 0, 0.12),
        0 4px 16px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    padding: 16px;
    max-width: 280px;
    z-index: 10001; /* Above cubes overlay */
    opacity: 0;
    transform: translate(-50%, -100%) scale(0.9);
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    pointer-events: none;
    margin-top: -10px;
}

.service-tooltip.show {
    opacity: 1;
    transform: translate(-50%, -100%) scale(1);
}

.service-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 8px solid rgba(255, 255, 255, 0.95);
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.tooltip-content h4 {
    color: var(--text-dark);
    font-size: 0.9rem;
    font-weight: 700;
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.tooltip-content p {
    color: var(--text-medium);
    font-size: 0.8rem;
    margin: 0;
    line-height: 1.4;
}

/* Service Legend */
.service-legend {
    margin-top: 3rem;
    padding: 1.75rem;
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.06) 0%,
            rgba(255, 255, 255, 0.03) 25%,
            rgba(255, 255, 255, 0.01) 50%,
            rgba(255, 255, 255, 0.03) 75%,
            rgba(255, 255, 255, 0.06) 100%);
    backdrop-filter: blur(16px) saturate(140%);
    -webkit-backdrop-filter: blur(16px) saturate(140%);
    border-radius: 20px;
    border: 2px solid;
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.25) 0%,
        rgba(255, 255, 255, 0.1) 50%,
        rgba(59, 130, 246, 0.1) 100%) 1;
    position: relative;
    z-index: 2;
    box-shadow:
        0 8px 32px rgba(0, 0, 0, 0.06),
        0 4px 16px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.service-legend:hover {
    background:
        linear-gradient(135deg,
            rgba(255, 255, 255, 0.09) 0%,
            rgba(255, 255, 255, 0.04) 25%,
            rgba(255, 255, 255, 0.02) 50%,
            rgba(255, 255, 255, 0.04) 75%,
            rgba(255, 255, 255, 0.09) 100%);
    backdrop-filter: blur(20px) saturate(150%);
    -webkit-backdrop-filter: blur(20px) saturate(150%);
    border-image: linear-gradient(135deg,
        rgba(255, 255, 255, 0.35) 0%,
        rgba(59, 130, 246, 0.15) 50%,
        rgba(255, 255, 255, 0.25) 100%) 1;
    box-shadow:
        0 12px 48px rgba(0, 0, 0, 0.08),
        0 8px 24px rgba(255, 255, 255, 0.12),
        inset 0 2px 0 rgba(255, 255, 255, 0.25);
    transform: translateY(-1px) scale(1.01);
}

.legend-title {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
    text-align: center;
}

.legend-items {
    display: flex;
    flex-wrap: nowrap;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
    overflow-x: auto;
    padding-bottom: 0.25rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--text-medium);
    padding: 0.25rem 0;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

.legend-color.housing { background: #3b82f6; }
.legend-color.banking { background: #10b981; }
.legend-color.phone { background: #8b5cf6; }
.legend-color.insurance { background: #ef4444; }
.legend-color.shipping { background: #f59e0b; }
.legend-color.vehicle { background: #06b6d4; }

.legend-note {
    display: block;
    text-align: center;
    color: var(--text-light);
    font-size: 0.75rem;
    margin-top: 0.5rem;
    font-style: italic;
}



/* Responsive adjustments for contact service cubes */
@media (max-width: 992px) {
    .floating-contact-service-cubes {
        opacity: 0.16;
        animation: none; /* prevent horizontal drift */
    }

    .floating-contact-service-cubes svg {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        top: 0 !important;
        left: 0 !important;
        /* Ensure proper scaling on tablets */
        object-fit: contain;
        overflow: hidden;
        transform: translateY(60px) scale(1.2) !important; /* Lighter scale on tablet */
    }

    .contact-service-cubes-background {
        max-width: 100vw;
        max-height: 100vh;
    }
}

@media (max-width: 768px) {
    .floating-contact-service-cubes {
        opacity: 0.14;
        animation: none; /* prevent horizontal drift */
    }

    .floating-contact-service-cubes svg {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        top: 0 !important;
        left: 0 !important;
        /* Ensure proper scaling on mobile */
        object-fit: contain;
        overflow: hidden;
        transform: translateY(20px) scale(1.05) !important; /* Subtle on mobile to avoid obstruction */
    }

    .contact-service-cubes-background {
        max-width: 100vw;
        max-height: 100vh;
    }
}

/* Responsive animation keyframes */
@keyframes gentle-float-tablet {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        transform: translate(-6px, -6px) rotate(0.2deg);
    }
    50% {
        transform: translate(6px, -9px) rotate(-0.2deg);
    }
    75% {
        transform: translate(-4px, -7px) rotate(0.15deg);
    }
}

@keyframes gentle-float-mobile {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        transform: translate(-4px, -4px) rotate(0.15deg);
    }
    50% {
        transform: translate(4px, -6px) rotate(-0.15deg);
    }
    75% {
        transform: translate(-3px, -5px) rotate(0.1deg);
    }
}

/* Responsive Service Legend */
@media (max-width: 768px) {
    .legend-items {
        gap: 1.25rem;
        justify-content: center;
    }

    .legend-item {
        font-size: 0.8rem;
        justify-content: center;
    }

    .service-legend {
        margin-top: 2rem;
        padding: 1rem;
    }

    .service-tooltip {
        max-width: 250px;
        padding: 12px;
    }

    .tooltip-content h4 {
        font-size: 0.85rem;
    }

    .tooltip-content p {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .legend-items {
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .legend-item {
        font-size: 0.75rem;
        justify-content: center;
    }
}

/* Accessibility improvements */
@media (prefers-reduced-motion: reduce) {
    .hero-pattern,
    .bubble,
    .contact-method:hover,
    .trust-feature:hover,
    .floating-contact-service-cubes {
        animation: none !important;
        transform: none !important;
    }

    .floating-contact-service-cubes svg {
        animation: none !important;
        transform: none !important;
    }

    .service-tooltip {
        transition: none;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .contact-method,
    .trust-feature,
    .info-card {
        border: 2px solid var(--text-dark);
    }

    .floating-contact-service-cubes {
        opacity: 0.03;
    }

    .floating-contact-service-cubes svg {
        opacity: 0.03;
    }
}

/* Prevent horizontal overflow on contact page */
body.page-template-page-contact,
.page-template-page-contact #main,
.page-template-page-contact .site-main {
    overflow-x: hidden;
    width: 100%;
    max-width: 100%;
    position: relative; /* Ensure proper positioning context */
}

/* Ensure root also never expands horizontally on this page */
html { overflow-x: hidden; }

.contact-form-section {
    overflow-x: hidden;
    position: relative; /* Ensure proper positioning context */
}

/* Additional overflow prevention for all sections */
.contact-hero,
.contact-options,
.trust-section,
.additional-contact {
    overflow-x: hidden;
    max-width: 100%;
}

/* Ensure all containers stay within viewport */
.contact-service-cubes-background {
    contain: layout style paint;
}

/* Prevent CSS animations from interfering with SVG animations */
.floating-contact-service-cubes svg * {
    animation-fill-mode: none !important;
    animation-play-state: running !important;
}

/* Ensure SVG animations maintain their timing */
.floating-contact-service-cubes .floating-cube {
    will-change: auto; /* Prevent browser optimizations that might interfere */
}
</style>

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

    // Initialize compact form functionality
    initializeCompactForm();

    // Initialize service cube tooltips
    initializeServiceCubeTooltips();



    // Prefill Forminator form fields from URL query params
    (function prefillForminator() {
        const params = new URLSearchParams(window.location.search);
        if ([...params.keys()].length === 0) return;

        function onceFormReady(cb, tries = 0) {
            const form = document.querySelector('.forminator-integration form, .forminator-ui form');
            if (form) return cb(form);
            if (tries > 40) return; // ~2s
            setTimeout(() => onceFormReady(cb, tries + 1), 50);
        }

        function setValue(el, val) {
            if (!el) return false;
            try {
                const tag = (el.tagName || '').toLowerCase();
                if (tag === 'select') {
                    // try by value, fallback by text
                    const opt = [...el.options].find(o => (o.value || '').toLowerCase() === val.toLowerCase())
                        || [...el.options].find(o => (o.text || '').toLowerCase() === val.toLowerCase());
                    if (opt) { el.value = opt.value; }
                    else { el.value = el.value; }
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                } else if (tag === 'input' || tag === 'textarea') {
                    el.value = val;
                    el.dispatchEvent(new Event('input', { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                }
                return true;
            } catch(e) { return false; }
        }

        function selectOptionLike(el, patterns) {
            if (!el) return false;
            const p = patterns.map(s => s.toLowerCase());
            const opt = [...el.options].find(o => {
                const t = (o.text || '').toLowerCase();
                const v = (o.value || '').toLowerCase();
                return p.some(k => t.includes(k) || v.includes(k));
            });
            if (opt) {
                el.value = opt.value;
                el.dispatchEvent(new Event('change', { bubbles: true }));
                return true;
            }
            return false;
        }

        function findByLabelContains(form, variants) {
            const labels = form.querySelectorAll('label[for]');
            for (const label of labels) {
                const text = (label.textContent || '').trim().toLowerCase();
                if (variants.some(v => text.includes(v))) {
                    const input = form.querySelector('#' + label.getAttribute('for'))
                        || form.querySelector(`[name="${label.getAttribute('for')}"]`);
                    if (input) return input;
                }
            }
            return null;
        }

        function findByNameGuess(form, keys) {
            const sel = keys.map(k => `[name*="${k}"]`).join(',');
            return form.querySelector(sel);
        }

        function applyPrefill(form) {
            const from = params.get('from');
            const to = params.get('to');
            const date = params.get('date');
            const interest = params.get('interest');
            const message = params.get('message');
            const services = params.get('services');

            let did = false;
            if (from) {
                const el = findByLabelContains(form, ['moving from','from country','from']) || findByNameGuess(form, ['from','movingfrom','origin']);
                did = setValue(el, from) || did;
            }
            if (to) {
                const el = findByLabelContains(form, ['moving to','to country','to']) || findByNameGuess(form, ['to','movingto','destination']);
                did = setValue(el, to) || did;
            }
            if (date) {
                const el = form.querySelector('input[type="date"]')
                    || findByLabelContains(form, ['move date','target date','date'])
                    || findByNameGuess(form, ['date','move_date']);
                did = setValue(el, date) || did;
            }
            if (interest) {
                const el = findByLabelContains(form, ['primary interest','interest','service','category'])
                    || findByNameGuess(form, ['interest','service','category']);
                did = setValue(el, interest) || did;
            }

            // Ensure Topic is set to Support Request
            const topicField = findByLabelContains(form, ['topic']) || findByNameGuess(form, ['topic','subject']);
            if (topicField && topicField.tagName && topicField.tagName.toLowerCase() === 'select') {
                did = selectOptionLike(topicField, ['support request','support']) || did;
            }

            // Handle message field prefill
            const msg = form.querySelector('textarea, textarea[name*="message"]');
            if (msg) {
                // If direct message parameter is provided, use it
                if (message) {
                    // Decode the message to restore line breaks and special characters
                    msg.value = decodeURIComponent(message);
                    msg.dispatchEvent(new Event('input', { bubbles: true }));
                    did = true;
                }
                // Otherwise, append helpful lines for wizard-generated requests
                else if (from || to || date || interest) {
                    // Avoid duplicating if already inserted
                    const snapshot = `${from}|${to}|${date}|${interest}`;
                    if (!msg.value || !msg.value.includes('From:')) {
                    // Humanize interest slug
                    const interestMap = {
                        'banking-services': 'Banking Services',
                        'realtor': 'Realtor Locator',
                        'data-and-phone-plans': 'Data and Phone Plans',
                        'vehicles': 'Vehicle Services',
                        'international-moving': 'International Moving',
                        'insurance': 'Insurance Coverage'
                    };
                    const niceInterest = interestMap[interest] || (interest ? interest.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase()) : '');

                    // Format date nicely if YYYY-MM-DD
                    function prettifyDate(d) {
                        if (!d || !/^\d{4}-\d{2}-\d{2}$/.test(d)) return d || '';
                        try {
                            const [Y,M,D] = d.split('-').map(Number);
                            const dt = new Date(Date.UTC(Y, M-1, D));
                            return dt.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: '2-digit' });
                        } catch(e) { return d; }
                    }

                    const lines = [];
                    if (from) lines.push(`From: ${from}`);
                    if (to) lines.push(`To: ${to}`);
                    if (date) lines.push(`Target move date: ${prettifyDate(date)}`);
                    if (niceInterest) lines.push(`Primary interest: ${niceInterest}`);

                        const prefix = msg.value && msg.value.trim().length ? '\n\n' : '';
                        msg.value = (msg.value || '') + prefix + lines.join('\n');
                        msg.dataset.prefillSnapshot = snapshot;
                        msg.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                }
            }

            if (did) {
                // Visual note - floating sidebar
                createFloatingPrefillNote();

                // Scroll down to the form smoothly
                const formSection = document.getElementById('contact-form');
                const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                if (formSection && !prefersReduced) {
                    setTimeout(() => formSection.scrollIntoView({ behavior: 'smooth', block: 'start' }), 120);
                }

                // Focus first name field specifically for better UX during prefill
                const firstNameField = findByLabelContains(form, ['first name', 'firstname', 'given name', 'name'])
                    || findByNameGuess(form, ['firstname', 'first_name', 'fname', 'given_name']);

                if (firstNameField) {
                    setTimeout(() => {
                        firstNameField.focus({ preventScroll: true });
                        // If it's a text input, also select the text for easy replacement
                        if (firstNameField.tagName.toLowerCase() === 'input' && firstNameField.type === 'text') {
                            firstNameField.select();
                        }
                    }, 400);
                } else {
                    // Fallback to first required field if first name not found
                    const firstRequired = form.querySelector('input[required], textarea[required], select[required]');
                    if (firstRequired) {
                        setTimeout(() => firstRequired.focus({ preventScroll: true }), 400);
                    }
                }

                // Analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'form_prefilled', { event_category: 'contact', source: params.get('source') || 'unknown' });
                }
            }
        }

        onceFormReady(applyPrefill);
    })();

    function createFloatingPrefillNote() {
        if (document.querySelector('.prefill-floating-note')) return;
        const box = document.createElement('div');
        box.className = 'prefill-floating-note show';
        box.innerHTML = '<button class="close-note" aria-label="Dismiss">×</button>'+
                        '<div class="note-text">We pre-filled details from your previous selection. Please review and submit.</div>';
        document.body.appendChild(box);
        const close = box.querySelector('.close-note');
        close.addEventListener('click', () => box.remove());

        // Auto-hide after 4 seconds
        setTimeout(() => {
            box.classList.remove('show');
            box.classList.add('hide');
            // Remove from DOM after slide-out animation completes (0.4s)
            setTimeout(() => {
                if (box.parentNode) {
                    box.remove();
                }
            }, 400);
        }, 4000);
    }

    // Compact form layout and sticky submit button functionality
    function initializeCompactForm() {
        const formContainer = document.querySelector('.form-container');
        const formSection = document.querySelector('.contact-form-section');

        if (!formContainer || !formSection) return;

        // Create sticky submit button
        const stickySubmit = document.createElement('button');
        stickySubmit.className = 'form-sticky-submit';
        stickySubmit.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit Form';
        stickySubmit.onclick = () => {
            const submitBtn = formContainer.querySelector('.forminator-button[type="submit"]');
            if (submitBtn) {
                submitBtn.click();
            }
        };
        document.body.appendChild(stickySubmit);

        // Show/hide sticky submit button based on scroll position
        function toggleStickySubmit() {
            const formRect = formContainer.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Show sticky button when form is long and user has scrolled past the submit button
            if (formRect.bottom < windowHeight - 100) {
                stickySubmit.classList.add('visible');
            } else {
                stickySubmit.classList.remove('visible');
            }
        }

        // Throttle scroll events for better performance
        let scrollTimer;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(toggleStickySubmit, 100);
        });

        // Initial check
        toggleStickySubmit();

        // Hide sticky button on mobile (too small)
        if (window.innerWidth <= 768) {
            stickySubmit.style.display = 'none';
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                stickySubmit.style.display = 'none';
            } else {
                stickySubmit.style.display = '';
                toggleStickySubmit();
            }
        });
    }

    function initializeServiceCubeTooltips() {
        const cubes = document.querySelectorAll('.floating-cube');
        const tooltip = document.createElement('div');
        tooltip.className = 'service-tooltip';
        tooltip.setAttribute('role', 'tooltip');
        tooltip.setAttribute('aria-hidden', 'true');
        tooltip.id = 'service-tooltip';
        tooltip.innerHTML = '<div class="tooltip-content"><h4></h4><p></p></div>';
        document.body.appendChild(tooltip);

        const services = {
            'housing-cube': { title: 'Housing Services', description: 'Find your perfect home with our vetted realtors and housing specialists.' },
            'banking-cube': { title: 'Banking & Finance', description: 'International money transfers, banking setup, and financial planning.' },
            'phone-cube': { title: 'Telecom & Data', description: 'Mobile plans, data packages, and communication solutions.' },
            'insurance-cube': { title: 'Insurance Coverage', description: 'Health, home, vehicle, and specialty insurance for expatriates.' },
            'shipping-cube': { title: 'Shipping & Moving', description: 'Professional relocation services with trusted moving partners.' },
            'vehicle-cube': { title: 'Vehicle Services', description: 'Car rentals, leasing, and vehicle import services for expats.' }
        };

        function getServiceKeyFromCube(el) {
            return Array.from(el.classList).find(c => c !== 'floating-cube' && /-cube$/.test(c)) || '';
        }

        function clamp(n, min, max) { return Math.max(min, Math.min(max, n)); }

        function positionTooltip(x, y) {
            const margin = 12;
            const vw = window.innerWidth;
            const vh = window.innerHeight;
            const rect = tooltip.getBoundingClientRect();
            const tx = clamp(x, margin + rect.width / 2, vw - margin - rect.width / 2);
            const ty = clamp(y - 16, margin + rect.height, vh - margin);
            tooltip.style.left = tx + 'px';
            tooltip.style.top = ty + 'px';
        }

        cubes.forEach(cube => {
            // Make focusable for keyboard users
            cube.setAttribute('tabindex', '0');
            cube.setAttribute('role', 'button');
            cube.setAttribute('aria-describedby', 'service-tooltip');

            // Pause bobbing SMIL <animateTransform> on hover/focus and resume on leave/blur
            function setSMILPlayState(el, play) {
                try {
                    // The animateTransform is a sibling inside each cube group
                    const anim = el.querySelector('animateTransform');
                    if (!anim) return;
                    const svgRoot = el.ownerSVGElement || document.querySelector('.floating-contact-service-cubes svg');
                    if (!svgRoot || typeof svgRoot.pauseAnimations !== 'function') return;
                    // Pause only this element's animation by toggling beginElement/endElement if supported is limited;
                    // fallback: pause all and resume all quickly to emulate pause-per-element is not possible,
                    // so we adjust the element's style to stop transformation while hovered (already handled in CSS).
                    // Prefer pausing the entire SVG only while a cube is hovered to keep it simple.
                    if (play) { svgRoot.unpauseAnimations(); }
                    else { svgRoot.pauseAnimations(); }
                } catch (e) {}
            }

            function showTooltipAtPointer(e) {
                const key = getServiceKeyFromCube(cube);
                const service = services[key];
                if (!service) return;
                const content = tooltip.querySelector('.tooltip-content');
                content.querySelector('h4').textContent = service.title;
                content.querySelector('p').textContent = service.description;
                positionTooltip(e.clientX, e.clientY);
                tooltip.classList.add('show');
                tooltip.setAttribute('aria-hidden', 'false');
            }

            function showTooltipAtCenter() {
                const key = getServiceKeyFromCube(cube);
                const service = services[key];
                if (!service) return;
                const content = tooltip.querySelector('.tooltip-content');
                content.querySelector('h4').textContent = service.title;
                content.querySelector('p').textContent = service.description;
                const r = cube.getBoundingClientRect();
                positionTooltip(r.left + r.width / 2, r.top);
                tooltip.classList.add('show');
                tooltip.setAttribute('aria-hidden', 'false');
            }

            function hideTooltip() {
                tooltip.classList.remove('show');
                tooltip.setAttribute('aria-hidden', 'true');
            }

            cube.addEventListener('mouseenter', (e) => { showTooltipAtCenter(e); setSMILPlayState(cube, false); });
            cube.addEventListener('mousemove', showTooltipAtPointer);
            cube.addEventListener('mouseleave', (e) => { hideTooltip(e); setSMILPlayState(cube, true); });
            cube.addEventListener('focus', (e) => { showTooltipAtCenter(e); setSMILPlayState(cube, false); });
            cube.addEventListener('blur', (e) => { hideTooltip(e); setSMILPlayState(cube, true); });
            cube.addEventListener('touchstart', function(e) {
                if (e.touches && e.touches[0]) {
                    showTooltipAtPointer(e.touches[0]);
                } else {
                    showTooltipAtCenter();
                }
            }, { passive: true });
            cube.addEventListener('touchend', (e) => { hideTooltip(e); setSMILPlayState(cube, true); });
        });
    }

    // Ensure SVG animations start properly and don't get interrupted
    function initializeSVGCubes() {
        const svgElement = document.querySelector('.floating-contact-service-cubes svg');
        if (!svgElement) return;
        // Keep SMIL/animateTransform bounciness; only remove global CSS animation classes
        svgElement.querySelectorAll('.floating-cube').forEach((g) => {
            g.classList.remove('animate-on-scroll', 'animate-float', 'animate-in');
            g.style.opacity = '1';
        });
        // Ensure the wrapper itself doesn't animate globally
        const wrapper = document.querySelector('.floating-contact-service-cubes');
        if (wrapper) {
            wrapper.style.animation = 'none';
            wrapper.style.transform = 'none';
        }
        svgElement.style.animation = 'none';
        svgElement.style.transition = 'none';
    }

    // Initialize SVG cubes on page load
    initializeSVGCubes();

    // Respect reduced-motion: pause SMIL animations
    try {
        const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const svgRoot = document.querySelector('.floating-contact-service-cubes svg');
        if (prefersReduced && svgRoot && typeof svgRoot.pauseAnimations === 'function') {
            svgRoot.pauseAnimations();
        }
    } catch(e) {}

    // Removed click re-initialization to prevent first-click shifts

    // Optional debug/activation controls via query params
    (function cubesDebugControls() {
        try {
            const params = new URLSearchParams(window.location.search);
            const bg = document.querySelector('.contact-service-cubes-background');
            const fc = document.querySelector('.floating-contact-service-cubes');
            if (!bg || !fc) return;

            const cubesParam = params.get('cubes');
            const debugParam = params.get('debug') || params.get('cubes_debug');

            if (cubesParam && /^(off|0|false)$/i.test(cubesParam)) {
                bg.remove();
                return;
            }

            if (debugParam && /^(cubes|1|true|on)$/i.test(debugParam)) {
                bg.classList.add('debug');
                fc.classList.add('debug');
                // Add a small non-interactive badge
                const badge = document.createElement('div');
                badge.setAttribute('style', 'position:fixed;right:12px;bottom:12px;padding:6px 10px;border-radius:8px;background:rgba(59,130,246,.15);border:1px solid rgba(59,130,246,.35);color:#1e3a8a;font-weight:700;font-size:11px;z-index:99999;pointer-events:none;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif');
                badge.textContent = 'Cubes Debug ON';
                document.body.appendChild(badge);
            }
        } catch (e) {}
    })();
});
</script>

<?php
get_footer();
