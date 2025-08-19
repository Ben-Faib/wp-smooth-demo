<?php
/**
 * Realtor Locator Service Page Template
 * Modern real estate service page with integrated property search form
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main realtor-locator-page" role="main">

    <!-- Hero Section -->
    <section class="realtor-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-80">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-realtor"><?php echo sm_icon('house', 'solid', 'me-2 icon'); ?> Property Services</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Find Your Perfect Home</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Connect with trusted real estate professionals who understand international relocations and can help you find the ideal property in your new country.</p>
                        
                        <div class="service-highlights mb-4">
                            <div class="highlight-item">
                                <i class="fas fa-home me-2"></i>
                                <span>Vetted Realtors</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-search me-2"></i>
                                <span>Property Search</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-video me-2"></i>
                                <span>Virtual Tours</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-handshake me-2"></i>
                                <span>Full Support</span>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="#property-search" class="btn btn-accent btn-lg me-3">
                                <i class="fas fa-search me-2"></i>
                                Start Property Search
                            </a>
                            <a href="#how-it-works" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-play me-2"></i>
                                How It Works
                            </a>
                        </div>
                        
                        <div class="trust-metrics mt-4">
                            <div class="metric-item">
                                <div class="metric-number">500+</div>
                                <div class="metric-label">Partner Realtors</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-number">98%</div>
                                <div class="metric-label">Success Rate</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-number">2-4 wks</div>
                                <div class="metric-label">Avg. Timeline</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="property-showcase">
                            <div class="property-card featured">
                                <div class="property-image">
                                    <div class="image-placeholder">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="property-badges">
                                        <span class="badge featured-badge">Featured</span>
                                        <span class="badge new-badge">New</span>
                                    </div>
                                </div>
                                <div class="property-info">
                                    <div class="property-price">$2,500/month</div>
                                    <div class="property-title">Modern 2BR Apartment</div>
                                    <div class="property-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Downtown District
                                    </div>
                                    <div class="property-features">
                                        <span>2 Bed</span>
                                        <span>2 Bath</span>
                                        <span>85 m²</span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-properties">
                                <div class="mini-property prop-1">
                                    <span class="mini-price">$1,800</span>
                                    <span class="mini-type">1BR</span>
                                </div>
                                <div class="mini-property prop-2">
                                    <span class="mini-price">$3,200</span>
                                    <span class="mini-type">3BR</span>
                                </div>
                                <div class="mini-property prop-3">
                                    <span class="mini-price">$2,100</span>
                                    <span class="mini-type">Studio</span>
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

    <!-- Property Search Form -->
    <section id="property-search" class="property-search-section py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-form-container">
                        <div class="form-header text-center mb-4">
                            <h2 class="section-title">Find Your Ideal Property</h2>
                            <p class="section-subtitle">Tell us about your preferences and we'll connect you with the perfect realtor and properties.</p>
                        </div>

                        <div class="forminator-integration">
                            <?php echo do_shortcode('[forminator_form id="387"]'); ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="how-it-works py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">How Our Realtor Service Works</h2>
                    <p class="section-subtitle">A simple, streamlined process to find your perfect home abroad.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="process-card animate-on-scroll">
                        <div class="process-icon">
                            <span class="step-number">1</span>
                            <i class="fas fa-edit"></i>
                        </div>
                        <h3 class="process-title">Share Your Needs</h3>
                        <p class="process-description">Complete our detailed form with your property preferences, budget, and timeline.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="process-icon">
                            <span class="step-number">2</span>
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="process-title">Meet Your Realtor</h3>
                        <p class="process-description">We match you with a local expert who specializes in helping international clients.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="process-icon">
                            <span class="step-number">3</span>
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="process-title">Property Search</h3>
                        <p class="process-description">View curated listings and take virtual tours from anywhere in the world.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-card animate-on-scroll" style="animation-delay: 0.6s;">
                        <div class="process-icon">
                            <span class="step-number">4</span>
                            <i class="fas fa-key"></i>
                        </div>
                        <h3 class="process-title">Secure Your Home</h3>
                        <p class="process-description">Complete the lease agreement and move into your new home with confidence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose py-6 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-content animate-on-scroll">
                        <h2 class="section-title text-start">Why Choose Our Realtor Network?</h2>
                        <p class="lead mb-4">We've carefully selected real estate professionals who understand the unique challenges of international relocation.</p>
                        
                        <div class="benefits-list">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div class="benefit-content">
                                    <h4>Vetted Professionals</h4>
                                    <p>All our realtors are licensed, experienced, and specifically trained to help international clients.</p>
                                </div>
                            </div>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="benefit-content">
                                    <h4>International Expertise</h4>
                                    <p>Our partners understand visa requirements, banking processes, and cultural considerations.</p>
                                </div>
                            </div>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="benefit-content">
                                    <h4>Remote-Friendly Service</h4>
                                    <p>Virtual tours, online signings, and remote communication make distance irrelevant.</p>
                                </div>
                            </div>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="benefit-content">
                                    <h4>Quality Guarantee</h4>
                                    <p>If you're not satisfied with your realtor, we'll match you with someone new at no extra cost.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="success-metrics">
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="metric-data">
                                    <h3>2,847</h3>
                                    <p>Properties Found</p>
                                </div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="metric-data">
                                    <h3>500+</h3>
                                    <p>Expert Realtors</p>
                                </div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="metric-data">
                                    <h3>4.9/5</h3>
                                    <p>Client Rating</p>
                                </div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="metric-data">
                                    <h3>14 days</h3>
                                    <p>Avg. Search Time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">What Our Clients Say</h2>
                    <p class="section-subtitle">Real experiences from families who found their perfect homes through our service.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card animate-on-scroll">
                        <div class="testimonial-content">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="testimonial-text">"Our realtor understood exactly what we needed as a family moving from London to Singapore. The virtual tours saved us so much time and stress."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <span>SC</span>
                            </div>
                            <div class="author-info">
                                <h5>Sophie Chen</h5>
                                <span>London → Singapore</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="testimonial-content">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="testimonial-text">"The entire process was seamless. From initial consultation to signing the lease, everything was handled professionally and efficiently."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <span>MR</span>
                            </div>
                            <div class="author-info">
                                <h5>Michael Rodriguez</h5>
                                <span>Madrid → Toronto</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="testimonial-content">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="testimonial-text">"Having a local expert who spoke our language and understood our cultural needs made all the difference. Highly recommend!"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <span>AP</span>
                            </div>
                            <div class="author-info">
                                <h5>Aisha Patel</h5>
                                <span>Mumbai → Dubai</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* Realtor Locator Page Specific Styles */
.realtor-hero {
    min-height: 90vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-realtor {
    background: rgba(16, 185, 129, 0.2);
    color: var(--success-color);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 700;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 2px solid var(--success-color);
}

.service-highlights {
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

.trust-metrics {
    display: flex;
    gap: 3rem;
    margin-top: 3rem;
}

.metric-item {
    text-align: center;
}

.metric-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.metric-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 600;
    margin-top: 0.5rem;
}

.property-showcase {
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

.property-card {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-2xl);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
    animation: float 6s ease-in-out infinite;
}

.property-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-2xl);
}

.property-image {
    height: 200px;
    background: var(--bg-light);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-placeholder {
    width: 80px;
    height: 80px;
    background: var(--gradient-success);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
}

.property-badges {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.property-badges .badge {
    padding: 0.3rem 0.8rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.75rem;
    font-weight: 700;
}

.featured-badge {
    background: var(--gradient-accent);
    color: var(--text-dark);
}

.new-badge {
    background: var(--gradient-primary);
    color: white;
}

.property-info {
    padding: 1.5rem;
}

.property-price {
    color: var(--success-color);
    font-size: 1.5rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
}

.property-title {
    color: var(--text-dark);
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.property-location {
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.property-features {
    display: flex;
    gap: 1rem;
}

.property-features span {
    background: var(--bg-section);
    color: var(--text-medium);
    padding: 0.3rem 0.8rem;
    border-radius: var(--border-radius);
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid var(--border-light);
}

.floating-properties {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.mini-property {
    position: absolute;
    background: var(--bg-white);
    padding: 0.8rem;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-lg);
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    min-width: 80px;
    border: 1px solid var(--border-light);
    animation: float 4s ease-in-out infinite;
}

.prop-1 { top: 10%; left: -10%; animation-delay: 0s; }
.prop-2 { top: 30%; right: -15%; animation-delay: 1.3s; }
.prop-3 { bottom: 20%; left: -5%; animation-delay: 2.6s; }

.mini-price {
    color: var(--success-color);
    display: block;
    font-weight: 900;
}

.mini-type {
    color: var(--text-light);
    font-size: 0.7rem;
}

.search-form-container {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    padding: 3rem;
    box-shadow: var(--shadow-2xl);
    border: 1px solid var(--border-light);
}

.form-progress {
    margin-bottom: 3rem;
}

.progress-bar {
    background: var(--bg-light);
    height: 6px;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 1rem;
}

.progress-fill {
    background: var(--gradient-primary);
    height: 100%;
    transition: width 0.5s ease;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
}

.step {
    background: var(--bg-light);
    color: var(--text-light);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-lg);
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid var(--border-light);
}

.step.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.step.completed {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.form-step {
    display: none;
}

.form-step.active {
    display: block;
    animation: fadeInForm 0.5s ease-in;
}

@keyframes fadeInForm {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}

.step-title {
    color: var(--text-dark);
    font-weight: 800;
    font-size: 1.8rem;
    margin-bottom: 2rem;
    text-align: center;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.75rem;
    display: block;
    font-size: 1.05rem;
}

.form-control {
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius-lg);
    padding: 1rem 1.25rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    background: var(--bg-white);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    outline: none;
}

.feature-checkboxes,
.budget-includes {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.feature-group,
.include-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--bg-section);
    border-radius: var(--border-radius-lg);
    border: 2px solid var(--border-light);
    transition: all 0.3s ease;
    cursor: pointer;
}

.feature-group:hover,
.include-group:hover {
    border-color: var(--primary-light);
    background: var(--primary-lighter);
}

.feature-group input[type="checkbox"],
.include-group input[type="checkbox"] {
    width: 20px;
    height: 20px;
    accent-color: var(--primary-color);
}

.feature-group label,
.include-group label {
    font-weight: 600;
    color: var(--text-dark);
    cursor: pointer;
    flex: 1;
    margin: 0;
}

.form-check {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--bg-section);
    border-radius: var(--border-radius-lg);
    border: 2px solid var(--border-light);
}

.form-check-input {
    width: 20px;
    height: 20px;
    margin: 0;
    accent-color: var(--primary-color);
}

.form-check-label {
    color: var(--text-medium);
    line-height: 1.5;
    font-size: 0.95rem;
}

.form-check-label a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.form-check-label a:hover {
    text-decoration: underline;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-light);
}

.process-card {
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

.process-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.process-icon {
    position: relative;
    margin-bottom: 2rem;
}

.step-number {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 30px;
    height: 30px;
    background: var(--gradient-accent);
    color: var(--text-dark);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 0.9rem;
    box-shadow: var(--shadow-md);
}

.process-icon i {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin: 0 auto;
    box-shadow: var(--shadow-lg);
}

.process-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.process-description {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.benefit-item {
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

.benefit-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
    background: var(--bg-section);
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-success);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
    box-shadow: var(--shadow-md);
}

.benefit-content h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-size: 1.2rem;
}

.benefit-content p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.success-metrics {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.metric-card {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    text-align: center;
    transition: all 0.3s ease;
}

.metric-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.metric-card .metric-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.metric-data h3 {
    color: var(--primary-color);
    font-weight: 900;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.metric-data p {
    color: var(--text-light);
    margin: 0;
    font-weight: 600;
    font-size: 0.9rem;
}

.testimonial-card {
    background: var(--bg-white);
    padding: 2.5rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.testimonial-content {
    margin-bottom: 2rem;
}

.quote-icon {
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.testimonial-text {
    color: var(--text-medium);
    font-style: italic;
    line-height: 1.7;
    font-size: 1.05rem;
    margin: 0;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    background: var(--gradient-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
}

.author-info h5 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.author-info span {
    color: var(--text-light);
    font-size: 0.9rem;
    display: block;
    margin-bottom: 0.5rem;
}

.rating {
    display: flex;
    gap: 0.2rem;
}

.rating i {
    color: var(--accent-color);
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .realtor-hero {
        min-height: 80vh;
        text-align: center;
    }
    
    .service-highlights {
        justify-content: center;
        gap: 1rem;
    }
    
    .highlight-item {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .trust-metrics {
        justify-content: center;
        gap: 2rem;
    }
    
    .property-showcase {
        margin-top: 3rem;
        max-width: 350px;
    }
    
    .search-form-container {
        padding: 2rem 1.5rem;
    }
    
    .progress-steps {
        gap: 0.5rem;
    }
    
    .step {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .step-title {
        font-size: 1.5rem;
    }
    
    .feature-checkboxes,
    .budget-includes {
        grid-template-columns: 1fr;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-navigation .btn {
        width: 100%;
    }
    
    .success-metrics {
        grid-template-columns: 1fr;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-step form functionality (legacy form only)
    const form = document.getElementById('propertySearchForm');
    if (form) {
        const steps = document.querySelectorAll('.form-step');
        const progressSteps = document.querySelectorAll('.progress-steps .step');
        const progressFill = document.querySelector('.progress-fill');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        let currentStep = 1;
        const totalSteps = steps.length;

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            if (progressFill) {
                progressFill.style.width = progress + '%';
            }
            progressSteps.forEach((step, index) => {
                step.classList.remove('active', 'completed');
                if (index + 1 < currentStep) {
                    step.classList.add('completed');
                } else if (index + 1 === currentStep) {
                    step.classList.add('active');
                }
            });
        }

        function showStep(step) {
            steps.forEach(s => s.classList.remove('active'));
            if (steps[step - 1]) {
                steps[step - 1].classList.add('active');
            }
            if (prevBtn) prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
            if (nextBtn) nextBtn.style.display = step === totalSteps ? 'none' : 'inline-block';
            if (submitBtn) submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';
            updateProgress();
        }

        function validateStep(step) {
            const currentStepElement = steps[step - 1];
            if (!currentStepElement) return true;
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            for (let field of requiredFields) {
                if (!field.value.trim()) {
                    field.focus();
                    field.style.borderColor = 'var(--danger-color, #dc3545)';
                    setTimeout(() => {
                        field.style.borderColor = '';
                    }, 3000);
                    return false;
                }
            }
            return true;
        }

        nextBtn && nextBtn.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });

        prevBtn && prevBtn.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateStep(currentStep)) {
                return;
            }
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                submitBtn.disabled = true;
            }
            const formData = new FormData(form);
            formData.append('action', 'submit_realtor_form');
            formData.append('nonce', (window.smAjax && smAjax.nonce) ? smAjax.nonce : '');
            fetch((window.smAjax && smAjax.ajax_url) ? smAjax.ajax_url : '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(resp => {
                if (resp && resp.success) {
                    alert('Thank you for your property search request! We\'ll match you with a qualified realtor within 24 hours.');
                    form.reset();
                    currentStep = 1;
                    showStep(currentStep);
                } else {
                    alert((resp && resp.data && resp.data.message) ? resp.data.message : 'Sorry, there was an error. Please try again.');
                }
            })
            .catch(() => alert('Sorry, there was an error sending your request. Please try again.'))
            .finally(() => {
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-search me-2"></i>Find My Property';
                    submitBtn.disabled = false;
                }
            });
        });

        showStep(currentStep);
    }
    
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
    
    // Observe elements
    const elementsToAnimate = document.querySelectorAll('.hero-content, .hero-visual, .search-form-container, .process-card, .why-content, .why-visual, .testimonial-card');
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
});
</script>

<?php
get_footer(); 