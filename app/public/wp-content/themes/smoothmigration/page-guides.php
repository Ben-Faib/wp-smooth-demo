<?php
/**
 * Template Name: Moving Guides
 * 
 * @package smoothmigration
 */

get_header();
?>

<style>
.guides-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 100px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.guides-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='0.1'%3E%3Cpolygon fill='white' points='50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40'/%3E%3C/g%3E%3C/svg%3E");
    background-size: 100px 100px;
}

.guides-content {
    background: #f8f9fa;
    padding: 60px 0;
}

.guide-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: block;
}

.guide-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    text-decoration: none;
    color: inherit;
}

.guide-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    margin-bottom: 20px;
}

.guide-title {
    color: #2c3e50;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.guide-description {
    color: #6c757d;
    line-height: 1.8;
    margin-bottom: 15px;
}

.guide-meta {
    display: flex;
    gap: 20px;
    font-size: 0.9rem;
    color: #95a5a6;
}

.guide-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.coming-soon-badge {
    display: inline-block;
    background: #ffc107;
    color: #856404;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-top: 10px;
}

.cta-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0;
    color: white;
    text-align: center;
}
</style>

<div class="guides-hero">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-3">Moving Guides</h1>
        <p class="lead">Comprehensive guides to help you navigate every aspect of your international relocation.</p>
    </div>
</div>

<div class="guides-content">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-3">Your Complete Relocation Resource</h2>
                <p class="lead text-muted">From planning to settling in, our expert guides cover everything you need to know for a successful international move.</p>
            </div>
        </div>

        <div class="row">
            <!-- Pre-Move Planning -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="guide-title">Pre-Move Planning</h3>
                    <p class="guide-description">Essential steps to take 3-6 months before your move. Timeline planning, documentation, and preparation checklist.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>15 min read</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-bookmark"></i>
                            <span>Most Popular</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Country Guides -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3 class="guide-title">Country-Specific Guides</h3>
                    <p class="guide-description">Detailed information about relocating to popular destinations including visa requirements and local customs.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-flag"></i>
                            <span><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?> Countries</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-update"></i>
                            <span>Updated Monthly</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Immigration & Visas -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-passport"></i>
                    </div>
                    <h3 class="guide-title">Immigration & Visas</h3>
                    <p class="guide-description">Navigate visa applications, work permits, and immigration requirements for your destination country.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Expert Verified</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>20 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Housing & Real Estate -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="guide-title">Finding Housing Abroad</h3>
                    <p class="guide-description">Tips for finding and securing accommodation, understanding rental markets, and avoiding common pitfalls.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-star"></i>
                            <span>Top Rated</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>12 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Banking & Finance -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h3 class="guide-title">Banking & Finance</h3>
                    <p class="guide-description">Set up bank accounts, understand tax obligations, and manage your finances across borders.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-calculator"></i>
                            <span>Interactive Tools</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>18 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Healthcare -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="guide-title">Healthcare & Insurance</h3>
                    <p class="guide-description">Understanding healthcare systems, finding insurance, and preparing medical documentation for your move.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-user-md"></i>
                            <span>Medical Experts</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>10 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Education -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="guide-title">Education & Schools</h3>
                    <p class="guide-description">Finding schools for children, understanding education systems, and university transfers.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-child"></i>
                            <span>Family Focused</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>15 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Cultural Integration -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="guide-title">Cultural Integration</h3>
                    <p class="guide-description">Tips for adapting to new cultures, building social networks, and overcoming culture shock.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-heart"></i>
                            <span>Community Tips</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>8 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Emergency Prep -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <i class="fas fa-first-aid"></i>
                    </div>
                    <h3 class="guide-title">Emergency Preparation</h3>
                    <p class="guide-description">Essential emergency contacts, contingency planning, and what to do when things don't go as planned.</p>
                    <div class="guide-meta">
                        <div class="guide-meta-item">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Must Read</span>
                        </div>
                        <div class="guide-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>5 min read</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>
        </div>
    </div>
</div>

<section class="cta-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-3">Need Personalized Guidance?</h2>
                <p class="lead mb-4">Our relocation experts are here to help you with tailored advice for your specific situation.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/contact" class="btn btn-light btn-lg">
                        <i class="fas fa-comments me-2"></i>
                        Get Expert Advice
                    </a>
                    <a href="/services" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-th-large me-2"></i>
                        Browse Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
