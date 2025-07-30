<?php
/**
 * FAQ Page Template
 * Modern FAQ page with interactive accordion and search functionality
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main faq-page" role="main">

    <!-- Hero Section -->
    <section class="faq-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-faq">❓ Frequently Asked Questions</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">FAQ</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Find answers to common questions about international relocation and our services.</p>
                        
                        <!-- Search Box -->
                        <div class="faq-search mb-4">
                            <div class="search-wrapper">
                                <input type="text" id="faqSearch" class="form-control" placeholder="Search frequently asked questions...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                        
                        <div class="hero-stats d-flex flex-wrap justify-content-center gap-4">
                            <div class="stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Questions Answered</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">95%</div>
                                <div class="stat-label">Find Their Answer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- FAQ Categories -->
    <section class="faq-categories py-4 bg-light border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="category-filters d-flex flex-wrap justify-content-center gap-2">
                        <button class="category-btn active" data-category="all">All Questions</button>
                        <button class="category-btn" data-category="general">General</button>
                        <button class="category-btn" data-category="services">Services</button>
                        <button class="category-btn" data-category="pricing">Pricing</button>
                        <button class="category-btn" data-category="process">Process</button>
                        <button class="category-btn" data-category="support">Support</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="faq-content py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-accordion" id="faqAccordion">
                        
                        <!-- General Questions -->
                        <div class="faq-section" data-category="general">
                            <h3 class="section-title">General Questions</h3>
                            
                            <div class="faq-item" data-faq-id="1">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <h4 class="faq-question">What is Smooth Migration Global?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq1" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Smooth Migration Global is a comprehensive relocation platform founded by expats, for expats. We provide personalized support and trusted service connections to make international moves seamless and stress-free.</p>
                                        <p>Our platform connects you with vetted professionals across 50+ countries, offering everything from housing and banking to visa support and school searches.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="2">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <h4 class="faq-question">How is Smooth Migration different from other relocation companies?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq2" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>We're founded by expats who have personally experienced international relocation. This gives us unique insights into the real challenges families face.</p>
                                        <ul>
                                            <li>Personal experience-driven approach</li>
                                            <li>Technology-enabled efficiency</li>
                                            <li>Transparent pricing with no hidden fees</li>
                                            <li>Global network of vetted partners</li>
                                            <li>24/7 support throughout your journey</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="3">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <h4 class="faq-question">Which countries do you cover?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq3" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>We currently serve 50+ countries across all major continents, with our strongest presence in:</p>
                                        <div class="country-list">
                                            <div class="country-group">
                                                <strong>Europe:</strong> UK, Germany, France, Spain, Netherlands, Switzerland, Ireland
                                            </div>
                                            <div class="country-group">
                                                <strong>Asia-Pacific:</strong> Singapore, Australia, Japan, Hong Kong, New Zealand, Malaysia
                                            </div>
                                            <div class="country-group">
                                                <strong>North America:</strong> United States, Canada
                                            </div>
                                            <div class="country-group">
                                                <strong>Middle East:</strong> UAE, Qatar, Saudi Arabia
                                            </div>
                                        </div>
                                        <p>Don't see your destination? <a href="/contact">Contact us</a> - we're constantly expanding our network.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Services Questions -->
                        <div class="faq-section" data-category="services">
                            <h3 class="section-title">Services</h3>
                            
                            <div class="faq-item" data-faq-id="4">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <h4 class="faq-question">What services do you offer?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq4" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>We offer comprehensive relocation services including:</p>
                                        <div class="services-grid">
                                            <div class="service-item">🏠 Housing & Real Estate</div>
                                            <div class="service-item">🏦 Banking & Finance</div>
                                            <div class="service-item">📋 Visa & Immigration</div>
                                            <div class="service-item">🛡️ Insurance</div>
                                            <div class="service-item">🚚 International Moving</div>
                                            <div class="service-item">🎓 School Search</div>
                                            <div class="service-item">🐕 Pet Relocation</div>
                                            <div class="service-item">📱 Telecommunications</div>
                                            <div class="service-item">🚗 Vehicle Services</div>
                                            <div class="service-item">💼 Business Setup</div>
                                        </div>
                                        <p><a href="/services">View all services</a> for detailed information.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="5">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    <h4 class="faq-question">Can I choose individual services or do I need a complete package?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq5" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>You have complete flexibility! You can:</p>
                                        <ul>
                                            <li>Select individual services as needed</li>
                                            <li>Choose pre-designed packages for common scenarios</li>
                                            <li>Work with our team to create a custom package</li>
                                            <li>Add or modify services throughout your relocation process</li>
                                        </ul>
                                        <p>Our platform is designed to adapt to your unique needs and timeline.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="6">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    <h4 class="faq-question">How do you vet your service partners?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq6" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>We have a rigorous vetting process for all partners:</p>
                                        <ul>
                                            <li>Verification of licenses and certifications</li>
                                            <li>Reference checks and testimonials</li>
                                            <li>Financial stability assessment</li>
                                            <li>Quality of service evaluation</li>
                                            <li>Ongoing performance monitoring</li>
                                            <li>Regular client feedback reviews</li>
                                        </ul>
                                        <p>Only partners who meet our high standards become part of our network.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Questions -->
                        <div class="faq-section" data-category="pricing">
                            <h3 class="section-title">Pricing</h3>
                            
                            <div class="faq-item" data-faq-id="7">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq7">
                                    <h4 class="faq-question">How much do your services cost?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq7" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Our pricing varies based on:</p>
                                        <ul>
                                            <li>Services selected</li>
                                            <li>Destination country</li>
                                            <li>Timeline requirements</li>
                                            <li>Complexity of your move</li>
                                        </ul>
                                        <p>We offer:</p>
                                        <div class="pricing-options">
                                            <div class="pricing-item">
                                                <strong>Individual Services:</strong> Starting from $299 per service
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Basic Package:</strong> $1,999 (3-5 core services)
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Complete Package:</strong> $3,999 (comprehensive support)
                                            </div>
                                        </div>
                                        <p><a href="/contact">Contact us</a> for a personalized quote based on your specific needs.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="8">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq8">
                                    <h4 class="faq-question">Are there any hidden fees?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq8" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p><strong>No hidden fees, ever.</strong> We believe in complete transparency.</p>
                                        <p>Your quote includes:</p>
                                        <ul>
                                            <li>Service coordination and management</li>
                                            <li>Partner vetting and quality assurance</li>
                                            <li>24/7 customer support</li>
                                            <li>Progress tracking and updates</li>
                                            <li>Documentation and reporting</li>
                                        </ul>
                                        <p>The only additional costs would be third-party fees (like government charges for visas) which are clearly itemized upfront.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="9">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq9">
                                    <h4 class="faq-question">Do you offer payment plans?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq9" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Yes! We offer flexible payment options:</p>
                                        <ul>
                                            <li><strong>Pay as you go:</strong> Pay for each service as it's delivered</li>
                                            <li><strong>Milestone payments:</strong> Split into 2-3 payments based on progress</li>
                                            <li><strong>Monthly installments:</strong> Spread costs over 6-12 months</li>
                                            <li><strong>Corporate billing:</strong> Direct billing to employers</li>
                                        </ul>
                                        <p>We accept all major credit cards, bank transfers, and corporate payment methods.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Process Questions -->
                        <div class="faq-section" data-category="process">
                            <h3 class="section-title">Process</h3>
                            
                            <div class="faq-item" data-faq-id="10">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq10">
                                    <h4 class="faq-question">How does the process work?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq10" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Our streamlined 4-step process:</p>
                                        <div class="process-steps">
                                            <div class="process-step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h5>Consultation</h5>
                                                    <p>Free 30-minute consultation to understand your needs, timeline, and destination.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h5>Custom Plan</h5>
                                                    <p>We create a personalized relocation plan with recommended services and timeline.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">3</div>
                                                <div class="step-content">
                                                    <h5>Service Delivery</h5>
                                                    <p>Our vetted partners execute your plan while we coordinate and monitor progress.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">4</div>
                                                <div class="step-content">
                                                    <h5>Arrival Support</h5>
                                                    <p>Continued support for 90 days after arrival to ensure smooth settling-in.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="11">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq11">
                                    <h4 class="faq-question">How long does the relocation process take?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq11" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Timelines vary by destination and services required:</p>
                                        <div class="timeline-examples">
                                            <div class="timeline-item">
                                                <strong>Express (4-6 weeks):</strong> Basic services for simple relocations
                                            </div>
                                            <div class="timeline-item">
                                                <strong>Standard (8-12 weeks):</strong> Comprehensive package with most services
                                            </div>
                                            <div class="timeline-item">
                                                <strong>Complex (16-20 weeks):</strong> Full-service including visas, business setup, family needs
                                            </div>
                                        </div>
                                        <p>Our average completion time is 45 days for standard relocations. We'll provide a detailed timeline during your consultation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Support Questions -->
                        <div class="faq-section" data-category="support">
                            <h3 class="section-title">Support</h3>
                            
                            <div class="faq-item" data-faq-id="12">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq12">
                                    <h4 class="faq-question">What kind of support do you provide?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq12" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Comprehensive support throughout your journey:</p>
                                        <ul>
                                            <li><strong>Dedicated Account Manager:</strong> Single point of contact</li>
                                            <li><strong>24/7 Emergency Support:</strong> For urgent issues</li>
                                            <li><strong>Progress Tracking:</strong> Real-time updates on all services</li>
                                            <li><strong>Documentation Support:</strong> Help with paperwork and applications</li>
                                            <li><strong>Cultural Orientation:</strong> Tips for adapting to your new country</li>
                                            <li><strong>Post-Arrival Support:</strong> 90 days of continued assistance</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="13">
                                <div class="faq-header" data-bs-toggle="collapse" data-bs-target="#faq13">
                                    <h4 class="faq-question">How can I contact support?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq13" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <p>Multiple ways to reach us:</p>
                                        <div class="contact-methods">
                                            <div class="contact-method">
                                                <i class="fas fa-phone"></i>
                                                <div>
                                                    <strong>Phone Support</strong>
                                                    <p>24/7 hotline: +1-800-SMOOTH-1</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-envelope"></i>
                                                <div>
                                                    <strong>Email Support</strong>
                                                    <p>support@smoothmigration.global</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-comments"></i>
                                                <div>
                                                    <strong>Live Chat</strong>
                                                    <p>Available on our website 9 AM - 9 PM GMT</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-mobile-alt"></i>
                                                <div>
                                                    <strong>WhatsApp</strong>
                                                    <p>Quick messages and updates</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- No Results Message -->
                    <div id="noResults" class="no-results text-center py-5" style="display: none;">
                        <div class="no-results-icon">
                            <i class="fas fa-search display-1 text-muted"></i>
                        </div>
                        <h3>No Results Found</h3>
                        <p class="text-muted mb-4">We couldn't find any questions matching your search. Try different keywords or browse all categories.</p>
                        <button class="btn btn-outline-primary" onclick="clearSearch()">Clear Search</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Still Have Questions CTA -->
    <section class="questions-cta py-6 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Still Have Questions?</h2>
                        <p class="lead mb-4">Can't find what you're looking for? Our expert team is here to help with personalized answers and guidance.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-phone-alt text-primary me-2"></i>
                                <span>Free Consultation</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <span>24/7 Support</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span>Expert Team</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Ask a Question
                        </a>
                        <a href="/services" class="btn btn-outline-primary w-100">
                            <i class="fas fa-list me-2"></i>
                            View Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* FAQ Page Specific Styles */
.faq-hero {
    min-height: 80vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-faq {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.faq-search {
    max-width: 600px;
    margin: 0 auto;
}

.search-wrapper {
    position: relative;
}

.search-wrapper .form-control {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius-2xl);
    padding: 1rem 3rem 1rem 1.5rem;
    font-size: 1.1rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: var(--text-dark);
}

.search-wrapper .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
    outline: none;
}

.search-icon {
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    font-size: 1.2rem;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.hero-stats .stat-item {
    text-align: center;
}

.hero-stats .stat-number {
    font-size: 2rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.hero-stats .stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

.category-filters {
    background: var(--bg-white);
    padding: 1rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
}

.category-btn {
    background: transparent;
    border: 2px solid var(--border-light);
    color: var(--text-medium);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.category-btn:hover,
.category-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.faq-section {
    margin-bottom: 3rem;
}

.faq-section .section-title {
    color: var(--primary-color);
    font-weight: 800;
    margin-bottom: 2rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid var(--primary-lighter);
    position: relative;
}

.faq-section .section-title::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 60px;
    height: 3px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.faq-item {
    background: var(--bg-white);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius-xl);
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.faq-item:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--primary-light);
}

.faq-header {
    padding: 1.5rem 2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    user-select: none;
}

.faq-header:hover {
    background: var(--bg-section);
}

.faq-question {
    color: var(--text-dark);
    font-weight: 700;
    margin: 0;
    font-size: 1.1rem;
    flex: 1;
    padding-right: 1rem;
}

.faq-icon {
    color: var(--primary-color);
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.faq-header[aria-expanded="true"] .faq-icon {
    transform: rotate(45deg);
}

.faq-answer {
    padding: 0 2rem 2rem;
    color: var(--text-medium);
    line-height: 1.7;
}

.faq-answer p {
    margin-bottom: 1rem;
}

.faq-answer ul {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.faq-answer li {
    margin-bottom: 0.5rem;
}

.faq-answer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.faq-answer a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.country-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1rem 0;
}

.country-group {
    padding: 0.75rem;
    background: var(--bg-section);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary-color);
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin: 1rem 0;
}

.service-item {
    background: var(--bg-section);
    padding: 0.75rem;
    border-radius: var(--border-radius);
    text-align: center;
    font-weight: 600;
    border: 1px solid var(--border-light);
}

.pricing-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin: 1rem 0;
}

.pricing-item {
    background: var(--bg-section);
    padding: 1rem;
    border-radius: var(--border-radius);
    border-left: 4px solid var(--success-color);
}

.process-steps {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin: 1rem 0;
}

.process-step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--bg-section);
    padding: 1.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-light);
}

.step-number {
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.step-content h5 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.step-content p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.95rem;
}

.timeline-examples {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1rem 0;
}

.timeline-item {
    background: var(--bg-section);
    padding: 1rem;
    border-radius: var(--border-radius);
    border-left: 4px solid var(--secondary-color);
}

.contact-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin: 1rem 0;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--bg-section);
    padding: 1.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-light);
}

.contact-method i {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-top: 0.25rem;
}

.contact-method strong {
    color: var(--text-dark);
    display: block;
    margin-bottom: 0.25rem;
}

.contact-method p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
}

.no-results {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    padding: 3rem;
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-sm);
}

.no-results-icon {
    margin-bottom: 1.5rem;
}

.questions-cta {
    background: var(--bg-light);
}

.cta-features .feature-item {
    color: var(--text-medium);
    font-weight: 500;
}

.cta-features i {
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .faq-hero {
        min-height: 70vh;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .category-filters {
        padding: 0.5rem;
    }
    
    .category-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .faq-header {
        padding: 1rem 1.5rem;
    }
    
    .faq-answer {
        padding: 0 1.5rem 1.5rem;
    }
    
    .faq-question {
        font-size: 1rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .process-step {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .contact-methods {
        grid-template-columns: 1fr;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const faqSections = document.querySelectorAll('.faq-section');
    const noResults = document.getElementById('noResults');
    
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        let hasResults = false;
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide sections based on results
        faqSections.forEach(section => {
            const visibleItems = section.querySelectorAll('.faq-item[style="display: block"], .faq-item:not([style*="display: none"])');
            section.style.display = visibleItems.length > 0 ? 'block' : 'none';
        });
        
        // Show/hide no results message
        noResults.style.display = hasResults ? 'none' : 'block';
    });
    
    // Category filtering
    const categoryButtons = document.querySelectorAll('.category-btn');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            
            // Show/hide sections based on category
            faqSections.forEach(section => {
                if (category === 'all' || section.dataset.category === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
            
            // Reset search
            searchInput.value = '';
            faqItems.forEach(item => item.style.display = 'block');
            noResults.style.display = 'none';
        });
    });
    
    // Accordion functionality
    const faqHeaders = document.querySelectorAll('.faq-header');
    
    faqHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const targetId = this.dataset.bsTarget;
            const targetElement = document.querySelector(targetId);
            const icon = this.querySelector('.faq-icon');
            
            // Toggle aria-expanded
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle collapse
            if (targetElement.classList.contains('show')) {
                targetElement.classList.remove('show');
                icon.style.transform = 'rotate(0deg)';
            } else {
                // Close other open items
                document.querySelectorAll('.collapse.show').forEach(openItem => {
                    if (openItem !== targetElement) {
                        openItem.classList.remove('show');
                        const openHeader = document.querySelector(`[data-bs-target="#${openItem.id}"]`);
                        if (openHeader) {
                            openHeader.setAttribute('aria-expanded', 'false');
                            openHeader.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                        }
                    }
                });
                
                targetElement.classList.add('show');
                icon.style.transform = 'rotate(45deg)';
            }
        });
    });
    
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
    const elementsToAnimate = document.querySelectorAll('.hero-content, .faq-section, .questions-cta');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
});

// Clear search function
function clearSearch() {
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const faqSections = document.querySelectorAll('.faq-section');
    const noResults = document.getElementById('noResults');
    
    searchInput.value = '';
    faqItems.forEach(item => item.style.display = 'block');
    faqSections.forEach(section => section.style.display = 'block');
    noResults.style.display = 'none';
    
    // Reset to "All Questions" category
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector('.category-btn[data-category="all"]').classList.add('active');
}
</script>

<?php
get_footer(); 