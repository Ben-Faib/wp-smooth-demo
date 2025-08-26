<?php
/**
 * Template Name: Moving Guides (Legacy - Redirects to Enhanced)
 * 
 * @package smoothmigration
 */

// Redirect to enhanced guides page
$enhanced_guides_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-guides-enhanced.php',
    'posts_per_page' => 1
));

if (!empty($enhanced_guides_page)) {
    wp_redirect(get_permalink($enhanced_guides_page[0]->ID), 301);
    exit;
}

get_header();
?>

<div class="guides-hero bg-gradient-primary py-6 text-white position-relative overflow-hidden">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-3">Moving Guides</h1>
        <p class="lead opacity-90">Comprehensive guides to help you navigate every aspect of your international relocation.</p>
    </div>
</div>

<div class="guides-content bg-section py-6">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                            <i class="fas fa-rotate-right"></i>
                            <span>Updated Monthly</span>
                        </div>
                    </div>
                    <span class="coming-soon-badge">Coming Soon</span>
                </a>
            </div>

            <!-- Immigration & Visas -->
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="guide-card">
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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
                    <div class="guide-icon bg-gradient-primary">
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

<section class="cta-section bg-gradient-primary">
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
