<?php
/**
 * Become a Partner Page Template
 * Modern partnership page with sophisticated design and clear value proposition
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main partner-page" role="main">

    <!-- Hero Section -->
    <section class="partner-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-partner"><?php echo sm_icon('handshake', 'solid', 'me-2 icon'); ?> Partnership Opportunity</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Become a Partner</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Join our global network of trusted service providers and help newcomers navigate their international relocations with confidence.</p>
                        
                        <div class="hero-stats d-flex flex-wrap gap-4 mb-4">
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_global_partners', '60+' ) ); ?></div>
                                <div class="stat-label">Global Partners</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?></div>
                                <div class="stat-label">Countries</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html( get_option( 'sm_successful_relocations', '2500+' ) ); ?></div>
                                <div class="stat-label">Successful Referrals</div>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="#partner-form" class="btn btn-accent btn-lg me-3">
                                <i class="fas fa-handshake me-2"></i>
                                Apply Now
                            </a>
                            <a href="#benefits" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-info-circle me-2"></i>
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="partnership-graphic">
                            <div class="graphic-element">
                                <i class="fas fa-globe display-1 text-accent"></i>
                                <div class="connecting-lines"></div>
                                <div class="partner-nodes">
                                    <div class="node node-1"><i class="fas fa-home"></i></div>
                                    <div class="node node-2"><i class="fas fa-car"></i></div>
                                    <div class="node node-3"><i class="fas fa-university"></i></div>
                                    <div class="node node-4"><i class="fas fa-shield-alt"></i></div>
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

    <!-- Partnership Benefits -->
    <section id="benefits" class="partner-benefits py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Why Partner With Us?</h2>
                    <p class="section-subtitle">Join a growing network of professionals who are making international relocation seamless for thousands relocating worldwide.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="benefit-card animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="benefit-title">Grow Your Business</h3>
                        <p class="benefit-description">Access a steady stream of high-quality leads from clients actively seeking your services.</p>
                        <ul class="benefit-features">
                            <li><i class="fas fa-check"></i> Qualified lead referrals</li>
                            <li><i class="fas fa-check"></i> Consistent revenue stream</li>
                            <li><i class="fas fa-check"></i> Market expansion opportunities</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="benefit-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="benefit-icon bg-secondary">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="benefit-title">Trusted Network</h3>
                        <p class="benefit-description">Become part of a vetted network of professionals known for excellence and reliability.</p>
                        <ul class="benefit-features">
                            <li><i class="fas fa-check"></i> Brand association benefits</li>
                            <li><i class="fas fa-check"></i> Quality assurance support</li>
                            <li><i class="fas fa-check"></i> Professional recognition</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="benefit-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="benefit-icon bg-success">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="benefit-title">Partnership Support</h3>
                        <p class="benefit-description">Receive comprehensive support including marketing materials and ongoing assistance.</p>
                        <ul class="benefit-features">
                            <li><i class="fas fa-check"></i> Marketing support</li>
                            <li><i class="fas fa-check"></i> Training resources</li>
                            <li><i class="fas fa-check"></i> Dedicated account management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Categories -->
    <section class="service-categories py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Partnership Opportunities</h2>
                    <p class="section-subtitle">We're looking for trusted professionals across various service categories.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('house', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Real Estate</h4>
                        <p class="category-description">Realtors, property managers, rental agencies</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('landmark', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Banking & Finance</h4>
                        <p class="category-description">Banks, financial advisors, money transfer services</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('truck-moving', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Moving Services</h4>
                        <p class="category-description">International movers, shipping companies</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('shield-halved', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Insurance</h4>
                        <p class="category-description">Health, property, and life insurance providers</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('clipboard-list', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Legal Services</h4>
                        <p class="category-description">Immigration lawyers, legal consultants</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('graduation-cap', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Education</h4>
                        <p class="category-description">Schools, universities, education consultants</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('car', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Transportation</h4>
                        <p class="category-description">Car dealers, vehicle registration services</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="category-card">
                        <div class="category-icon"><?php echo sm_icon('briefcase', 'solid', 'icon'); ?></div>
                        <h4 class="category-title">Business Services</h4>
                        <p class="category-description">Accountants, business setup consultants</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Requirements -->
    <section class="partner-requirements py-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="requirements-content">
                        <h2 class="section-title text-start">Partner Requirements</h2>
                        <p class="lead mb-4">We maintain high standards to ensure our clients receive exceptional service from all partners.</p>
                        
                        <div class="requirements-list">
                            <div class="requirement-item">
                                <div class="requirement-icon">
                                    <i class="fas fa-certificate text-primary"></i>
                                </div>
                                <div class="requirement-content">
                                    <h4>Professional Credentials</h4>
                                    <p>Valid licenses and certifications in your field of expertise.</p>
                                </div>
                            </div>
                            
                            <div class="requirement-item">
                                <div class="requirement-icon">
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                <div class="requirement-content">
                                    <h4>Proven Track Record</h4>
                                    <p>Minimum 2 years experience with positive client testimonials.</p>
                                </div>
                            </div>
                            
                            <div class="requirement-item">
                                <div class="requirement-icon">
                                    <i class="fas fa-comments text-success"></i>
                                </div>
                                <div class="requirement-content">
                                    <h4>Excellent Communication</h4>
                                    <p>Strong English communication skills and cultural awareness.</p>
                                </div>
                            </div>
                            
                            <div class="requirement-item">
                                <div class="requirement-icon">
                                    <i class="fas fa-clock text-info"></i>
                                </div>
                                <div class="requirement-content">
                                    <h4>Responsive Service</h4>
                                    <p>Commitment to timely responses and professional service delivery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="requirements-visual">
                        <div class="quality-badges">
                            <div class="quality-badge">
                                <i class="fas fa-award"></i>
                                <span>Quality Assured</span>
                            </div>
                            <div class="quality-badge">
                                <i class="fas fa-users"></i>
                                <span>Client Focused</span>
                            </div>
                            <div class="quality-badge">
                                <i class="fas fa-globe"></i>
                                <span>Global Network</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Application Form -->
    <section id="partner-form" class="partner-form-section py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        <div class="form-header text-center mb-5">
                            <h2 class="section-title">Apply for Partnership</h2>
                            <p class="section-subtitle">Apply to become a preferred partner by completing the application form below. Our team will review your application and respond within 2 business days.</p>
                        </div>
                        
                        <div class="forminator-integration">
                            <?php echo do_shortcode('[forminator_form id="5051"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="partner-stories py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Partner Success Stories</h2>
                    <p class="section-subtitle">Hear from our partners about their experience working with us.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="story-card">
                        <div class="story-quote">
                            <i class="fas fa-quote-left"></i>
                            <p>"Partnering with Smooth Migration has doubled our international client base. The quality of referrals is exceptional."</p>
                        </div>
                        <div class="story-author">
                            <div class="author-info">
                                <h5>Sarah Thompson</h5>
                                <span>Real Estate Agent, London</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="story-card">
                        <div class="story-quote">
                            <i class="fas fa-quote-left"></i>
                            <p>"The support team is incredible. They help with everything from client communication to marketing materials."</p>
                        </div>
                        <div class="story-author">
                            <div class="author-info">
                                <h5>Miguel Rodriguez</h5>
                                <span>Immigration Lawyer, Madrid</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="story-card">
                        <div class="story-quote">
                            <i class="fas fa-quote-left"></i>
                            <p>"Being part of this network has elevated our brand and brought us clients we never would have reached otherwise."</p>
                        </div>
                        <div class="story-author">
                            <div class="author-info">
                                <h5>Jennifer Kim</h5>
                                <span>Moving Company Owner, Singapore</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* Partner Page Specific Styles */
.partner-hero {
    min-height: 100vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-partner {
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

.hero-stats {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
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

.partnership-graphic {
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

.partner-nodes {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 300px;
}

.node {
    position: absolute;
    width: 60px;
    height: 60px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    animation: pulse 3s ease-in-out infinite;
}

.node-1 { top: 0; left: 50%; transform: translateX(-50%); }
.node-2 { top: 50%; right: 0; transform: translateY(-50%); }
.node-3 { bottom: 0; left: 50%; transform: translateX(-50%); }
.node-4 { top: 50%; left: 0; transform: translateY(-50%); }

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.benefit-card {
    background: var(--bg-white);
    padding: 3rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
    text-align: center;
}

.benefit-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.benefit-icon {
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

.benefit-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
}

.benefit-description {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.benefit-features {
    list-style: none;
    padding: 0;
    text-align: left;
}

.benefit-features li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    color: var(--text-medium);
    font-size: 0.95rem;
}

.benefit-features i {
    color: var(--success-color);
    font-size: 0.8rem;
}

.category-card {
    background: var(--bg-white);
    padding: 2rem 1.5rem;
    border-radius: var(--border-radius-xl);
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    height: 100%;
}

.category-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    background: var(--bg-section);
}

.category-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

.category-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.category-description {
    color: var(--text-light);
    font-size: 0.9rem;
    margin: 0;
}

.requirement-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--bg-white);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.requirement-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
}

.requirement-icon {
    min-width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.requirement-content h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.requirement-content p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
}

.quality-badges {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    align-items: center;
    padding: 3rem;
}

.quality-badge {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 250px;
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.quality-badge:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-2xl);
}

.quality-badge i {
    font-size: 2rem;
    color: var(--primary-color);
}

.quality-badge span {
    font-weight: 700;
    color: var(--text-dark);
}

.form-container {
    background: var(--bg-white);
    padding: 3rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
}

.form-section-title {
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius-lg);
    padding: 0.875rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    outline: none;
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.story-card {
    background: var(--bg-white);
    padding: 2.5rem 2rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
}

.story-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.story-quote {
    margin-bottom: 2rem;
}

.story-quote i {
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.story-quote p {
    font-style: italic;
    color: var(--text-medium);
    line-height: 1.6;
    margin: 0;
}

.story-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-info h5 {
    color: var(--text-dark);
    font-weight: 700;
    margin: 0;
}

.author-info span {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .partner-hero {
        min-height: 80vh;
        text-align: center;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .partnership-graphic {
        height: 250px;
        margin-top: 2rem;
    }
    
    .partner-nodes {
        width: 200px;
        height: 200px;
    }
    
    .node {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .form-container {
        padding: 2rem 1.5rem;
    }
    
    .quality-badges {
        padding: 2rem 1rem;
    }
    
    .quality-badge {
        min-width: auto;
        width: 100%;
    }
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
    
    // Observe elements
    const elementsToAnimate = document.querySelectorAll('.hero-content, .hero-visual, .benefit-card, .category-card, .requirement-item, .story-card');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
    
    // Form submission
    const form = document.getElementById('partnerApplicationForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Add loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            submitBtn.disabled = true;
            
            // Simulate form submission (replace with actual form handling)
            setTimeout(() => {
                alert('Thank you for your application! We will review it and get back to you within 48 hours.');
                form.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }
    
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