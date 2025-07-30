<?php
/**
 * About Us Page Template
 * Modern about page with team showcase and company story
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main about-page" role="main">

    <!-- Hero Section -->
    <section class="about-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-about">🌍 Our Story</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">About Smooth Migration</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Founded by expats, for expats. We understand the challenges of international relocation because we've lived them ourselves.</p>
                        
                        <div class="hero-stats d-flex flex-wrap gap-4 mb-4">
                            <div class="stat-item">
                                <div class="stat-number">2019</div>
                                <div class="stat-label">Founded</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Countries</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">3,200+</div>
                                <div class="stat-label">Happy Families</div>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="#our-story" class="btn btn-accent btn-lg me-3">
                                <i class="fas fa-book-open me-2"></i>
                                Our Journey
                            </a>
                            <a href="#team" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-users me-2"></i>
                                Meet the Team
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="about-graphic">
                            <div class="world-connections">
                                <div class="central-hub">
                                    <i class="fas fa-home display-3 text-accent"></i>
                                </div>
                                <div class="connection-lines"></div>
                                <div class="location-dots">
                                    <div class="dot dot-1" data-location="London">🇬🇧</div>
                                    <div class="dot dot-2" data-location="Singapore">🇸🇬</div>
                                    <div class="dot dot-3" data-location="Dubai">🇦🇪</div>
                                    <div class="dot dot-4" data-location="Toronto">🇨🇦</div>
                                    <div class="dot dot-5" data-location="Sydney">🇦🇺</div>
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

    <!-- Our Story Section -->
    <section id="our-story" class="our-story py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Our Story</h2>
                    <p class="section-subtitle">How a group of international expats came together to solve the relocation challenge.</p>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="story-content animate-on-scroll">
                        <div class="story-timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Problem</h4>
                                    <p>In 2018, our founders experienced firsthand the overwhelming complexity of international relocation. Countless hours were spent researching, comparing, and coordinating with dozens of service providers across multiple countries.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Solution</h4>
                                    <p>We realized there had to be a better way. By combining our collective expat experience with extensive research, we began building a platform that would streamline the entire relocation process.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Impact</h4>
                                    <p>Today, we've helped over 3,200 families successfully relocate to their new countries, building a network of trusted partners and creating resources that make international moves smooth and stress-free.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="story-stats-grid">
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>3,200+</h3>
                                    <p>Families Relocated</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>500+</h3>
                                    <p>Trusted Partners</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>98%</h3>
                                    <p>Satisfaction Rate</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>45</h3>
                                    <p>Avg. Days to Complete</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="our-values py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Our Values</h2>
                    <p class="section-subtitle">The principles that guide everything we do.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="value-title">Empathy First</h3>
                        <p class="value-description">We understand the emotional and practical challenges of international relocation because we've been there ourselves.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="value-icon bg-secondary">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="value-title">Trust & Transparency</h3>
                        <p class="value-description">We maintain complete transparency in our processes and only work with thoroughly vetted, trusted partners.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="value-icon bg-success">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="value-title">Innovation</h3>
                        <p class="value-description">We continuously improve our platform and services using data insights and customer feedback.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="value-icon bg-warning">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="value-title">Support</h3>
                        <p class="value-description">Our commitment doesn't end when you arrive. We provide ongoing support throughout your relocation journey.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="value-icon bg-info">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="value-title">Global Perspective</h3>
                        <p class="value-description">Our international team brings diverse cultural perspectives and local expertise to every relocation.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.5s;">
                        <div class="value-icon bg-danger">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="value-title">Excellence</h3>
                        <p class="value-description">We strive for excellence in every interaction, service delivery, and customer experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="our-team py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Meet Our Team</h2>
                    <p class="section-subtitle">The international expats behind Smooth Migration Global.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Sarah Chen</h4>
                            <p class="team-role">Co-Founder & CEO</p>
                            <p class="team-description">Former expat who moved from Toronto to Singapore. Passionate about making international relocation seamless for families worldwide.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Strategy</span>
                                <span class="expertise-tag">Operations</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Marcus Rodriguez</h4>
                            <p class="team-role">Co-Founder & CTO</p>
                            <p class="team-description">Tech entrepreneur who relocated from Madrid to London. Leads our technology development and platform innovation.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Technology</span>
                                <span class="expertise-tag">Product</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Priya Patel</h4>
                            <p class="team-role">Head of Customer Success</p>
                            <p class="team-description">Expat from Mumbai who moved to Dubai. Ensures every client receives personalized support throughout their journey.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Customer Success</span>
                                <span class="expertise-tag">Support</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">James Thompson</h4>
                            <p class="team-role">Head of Partnerships</p>
                            <p class="team-description">British expat living in Australia. Builds and maintains relationships with our global network of service partners.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Partnerships</span>
                                <span class="expertise-tag">Business Development</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Lisa Kim</h4>
                            <p class="team-role">Marketing Director</p>
                            <p class="team-description">Korean-American expat based in Berlin. Creates content and campaigns that resonate with the international community.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Marketing</span>
                                <span class="expertise-tag">Content</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.5s;">
                        <div class="team-photo">
                            <div class="photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Ahmed Hassan</h4>
                            <p class="team-role">Regional Manager - MENA</p>
                            <p class="team-description">Egyptian expat with extensive knowledge of Middle East and North Africa relocation requirements and cultural nuances.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Regional Expertise</span>
                                <span class="expertise-tag">Cultural Consulting</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision py-6 bg-gradient-secondary text-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="mission-content animate-on-scroll">
                        <div class="content-icon">
                            <i class="fas fa-bullseye display-3 text-accent"></i>
                        </div>
                        <h3 class="content-title">Our Mission</h3>
                        <p class="content-description">To eliminate the stress and complexity of international relocation by providing personalized, comprehensive support that makes every move smooth and successful.</p>
                        <div class="mission-points">
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Simplify complex processes</span>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Provide trusted partnerships</span>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Deliver personalized support</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-content animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="content-icon">
                            <i class="fas fa-eye display-3 text-accent"></i>
                        </div>
                        <h3 class="content-title">Our Vision</h3>
                        <p class="content-description">To become the world's most trusted platform for international relocation, empowering millions of families to pursue their global dreams with confidence.</p>
                        <div class="vision-goals">
                            <div class="goal-item">
                                <div class="goal-number">100+</div>
                                <div class="goal-label">Countries Covered</div>
                            </div>
                            <div class="goal-item">
                                <div class="goal-number">1M+</div>
                                <div class="goal-label">Families Served</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="contact-cta py-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Ready to Start Your Journey?</h2>
                        <p class="lead mb-4">Join thousands of families who have made their international relocation smooth and stress-free with our expert guidance.</p>
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
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Trusted Partners</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Get in Touch
                        </a>
                        <a href="/services" class="btn btn-outline-primary w-100">
                            <i class="fas fa-list me-2"></i>
                            View Our Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* About Page Specific Styles */
.about-hero {
    min-height: 100vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-about {
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

.about-graphic {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    position: relative;
}

.world-connections {
    position: relative;
    width: 300px;
    height: 300px;
}

.central-hub {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-2xl);
    z-index: 2;
}

.location-dots {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.dot {
    position: absolute;
    width: 50px;
    height: 50px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    animation: float-dot 4s ease-in-out infinite;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.dot:hover {
    transform: scale(1.2);
}

.dot-1 { top: 10px; left: 50%; transform: translateX(-50%); animation-delay: 0s; }
.dot-2 { top: 50%; right: 10px; transform: translateY(-50%); animation-delay: 0.8s; }
.dot-3 { bottom: 10px; right: 30%; animation-delay: 1.6s; }
.dot-4 { bottom: 10px; left: 30%; animation-delay: 2.4s; }
.dot-5 { top: 50%; left: 10px; transform: translateY(-50%); animation-delay: 3.2s; }

@keyframes float-dot {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.story-timeline {
    position: relative;
    padding-left: 2rem;
}

.story-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 3rem;
    position: relative;
}

.timeline-marker {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    margin-right: 2rem;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}

.timeline-content h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.timeline-content p {
    color: var(--text-light);
    line-height: 1.7;
    margin: 0;
}

.story-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.story-stat {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-md);
    text-align: center;
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.story-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.stat-details h3 {
    color: var(--primary-color);
    font-weight: 900;
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.stat-details p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
}

.value-card {
    background: var(--bg-white);
    padding: 3rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
    text-align: center;
}

.value-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.value-icon {
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

.value-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.value-description {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.team-card {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
}

.team-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
}

.team-photo {
    position: relative;
    height: 250px;
    background: var(--bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.photo-placeholder {
    width: 120px;
    height: 120px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    box-shadow: var(--shadow-lg);
}

.team-social {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-card:hover .team-social {
    opacity: 1;
}

.social-link {
    width: 40px;
    height: 40px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    text-decoration: none;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.social-link:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
}

.team-info {
    padding: 2rem;
}

.team-name {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.team-role {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.team-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.team-expertise {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.expertise-tag {
    background: var(--primary-lighter);
    color: var(--primary-color);
    padding: 0.3rem 0.8rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.8rem;
    font-weight: 600;
}

.mission-vision {
    background: var(--gradient-secondary) !important;
}

.content-icon {
    margin-bottom: 2rem;
}

.content-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    color: white;
}

.content-description {
    font-size: 1.1rem;
    line-height: 1.7;
    opacity: 0.95;
    margin-bottom: 2rem;
}

.mission-points {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.point-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.05rem;
    font-weight: 500;
}

.vision-goals {
    display: flex;
    gap: 3rem;
    margin-top: 2rem;
}

.goal-item {
    text-align: center;
}

.goal-number {
    font-size: 3rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.goal-label {
    font-size: 1rem;
    opacity: 0.9;
    font-weight: 600;
}

.contact-cta {
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
    .about-hero {
        min-height: 80vh;
        text-align: center;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .about-graphic {
        height: 250px;
        margin-top: 2rem;
    }
    
    .world-connections {
        width: 200px;
        height: 200px;
    }
    
    .central-hub {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .dot {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
    
    .story-timeline {
        padding-left: 0;
    }
    
    .story-timeline::before {
        display: none;
    }
    
    .timeline-item {
        flex-direction: column;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .timeline-marker {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .story-stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .vision-goals {
        gap: 2rem;
        justify-content: center;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
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
    const elementsToAnimate = document.querySelectorAll('.hero-content, .hero-visual, .story-content, .story-visual, .value-card, .team-card, .mission-content, .vision-content');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
    
    // Location dot tooltips
    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => {
        dot.addEventListener('mouseenter', function() {
            const location = this.dataset.location;
            if (location) {
                // Create a simple tooltip effect
                this.setAttribute('title', location);
            }
        });
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