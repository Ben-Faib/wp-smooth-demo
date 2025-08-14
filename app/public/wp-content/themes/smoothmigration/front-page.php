<?php
/**
 * Front Page Template - Smooth Migration Global Landing Page
 *
 * @package smoothmigration
 */

get_header(); ?>

<a class="skip-link" href="#main-content">Skip to main content</a>

<!-- 1. Enhanced Hero Section -->
<section class="hero-landing">
    <div class="hero-overlay-dark" aria-hidden="true"></div>
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8">
                <div class="hero-content">
                    <!-- Trust Signals -->
                    <div class="trust-signals mb-4">
                        <div class="trust-badges">
                            <span class="trust-badge">🇺🇸 🇬🇧 🇨🇦 🇦🇺 🇿🇦</span>
                            <span class="trust-metric"><?php echo esc_html( get_option( 'sm_avg_relocation_time', '45 days' ) ); ?></span>
                            <span class="trust-metric"><?php echo esc_html( get_option( 'sm_successful_relocations', '2500+' ) ); ?> successful relocations</span>
                        </div>
                    </div>
                    <div class="small text-light" style="opacity:.9">No additional or hidden costs.</div>
                    
                    <h1 class="hero-headline">Moving to a new country? We understand the overwhelm.</h1>
                    <p class="hero-subheadline">Let's make it smooth together. Our expert team turns relocation chaos into a clear, step-by-step plan—tailored specifically to your destination and timeline.</p>
                    
                    <!-- Enhanced CTA Group with Self-Segmentation -->
                    <div class="hero-cta-group">
                        <a href="/services" class="btn btn-primary btn-lg cta-relocating">
                            <span class="cta-icon">🏠</span>
                            Get My Personal Moving Plan
                        </a>
                        <a href="/contact" class="btn btn-secondary btn-lg cta-employer">
                            <span class="cta-icon">🏢</span>
                            Relocate My Team
                        </a>
                        <a href="/become-a-partner" class="btn btn-accent btn-lg cta-partner">
                            <span class="cta-icon">🤝</span>
                            Become a Partner
                        </a>
                    </div>
                    <div class="small text-light" style="opacity:.95">100% free to use. We’re paid by partners for referrals—and we rigorously vet every partner. No hidden costs.</div>
                    <!-- Urgency without pressure -->
                    <div class="urgency-signals mt-3">
                        <p class="urgency-text">
                            <strong>Join <?php echo esc_html( get_option( 'sm_monthly_signups', '200+' ) ); ?> families who started their move this month</strong><br>
                            <small class="text-light">Next available consultation: Today at 3 PM</small>
                        </p>
                    </div>
                    
                    <!-- Scroll Cue -->
                    <div class="scroll-cue">
                        <span class="scroll-text">Scroll to discover</span>
                        <div class="scroll-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 5v14M19 12l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php $expats = trim( (string) get_option( 'sm_expats_count', '' ) ); if ( $expats !== '' ) : ?>
            <div class="stat-item">
                <div class="stat-number"><?php echo esc_html( $expats ); ?></div>
                <div class="stat-label">Expats In Our Community</div>
            </div>
            <?php endif; ?>
        </div>
        <?php $updated = trim( (string) get_option( 'sm_stats_last_updated', '' ) ); if ( $updated !== '' ) : ?>
        <p class="text-muted small mt-2"><?php echo esc_html( $updated ); ?> <a class="text-muted" href="/methodology" aria-label="See methodology details">Methodology</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- 2. Interactive How It Works Section -->
<main id="main-content">
<section class="how-it-works py-5" aria-labelledby="how-it-works-title">
    <div class="container">
        <div class="text-center mb-5">
            <h2 id="how-it-works-title" class="section-title">How It Works</h2>
            <p class="section-subtitle">Answer a few questions, get a plan, and connect to vetted partners—see quick category links below.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="step-card interactive-card text-center" tabindex="0">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Complete our questionnaire</h3>
                    <p class="step-description">Tell us your relocation specifics—destination, timing, family, and priorities.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="step-card interactive-card text-center" tabindex="0">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Select services from your plan</h3>
                    <p class="step-description">Use your custom plan to pick services and see tasks at each stage. Try the <a href="/ai-relocator" class="text-primary fw-bold">AI Relocator</a> for suggestions.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="step-card interactive-card text-center" tabindex="0">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Get preferred-rate quotes</h3>
                    <p class="step-description">Receive quotes directly from our vetted partners—often at preferred expat rates.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <?php if ( has_nav_menu( 'how_it_works_links' ) ) : ?>
                <nav aria-label="How it works quick links">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'how_it_works_links',
                        'container'      => false,
                        'menu_class'     => 'nav justify-content-center gap-2 mb-3',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </nav>
            <?php endif; ?>
            <a href="/services" class="btn btn-outline-primary">Browse all categories (free) →</a>
        </div>
    </div>
</section>

<!-- 3. Limited Services Snapshot (3x2 Grid) -->
<section class="services-snapshot py-5 bg-light" aria-labelledby="services-title">
    <div class="container">
        <div class="text-center mb-5">
            <h2 id="services-title" class="section-title">Core Services</h2>
            <p class="section-subtitle">Everything you need for a smooth international move — and it’s free to use.</p>
        </div>
        
        <div class="row g-4 services-grid-limited">
            <!-- Left: Money Services (taxonomy link) -->
            <div class="col-lg-4 col-md-6">
                <a href="/service-type/money-services/" class="service-card-link">
                    <div class="service-card interactive-card" aria-describedby="money-services-desc">
                        <div class="service-illustration" aria-hidden="true"><i class="fa-solid fa-money-bill-transfer"></i></div>
                        <div class="service-content">
                            <h3 class="service-title">Money Services</h3>
                            <p id="money-services-desc" class="service-description">Banking, transfers, and multi-currency accounts set up for expats.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Center: Realtor Locator (core) -->
            <div class="col-lg-4 col-md-6">
                <a href="/realtor-form" class="service-card-link">
                    <div class="service-card service-card--core interactive-card" aria-describedby="realtor-core-desc">
                        <span class="core-badge">Core</span>
                        <div class="service-illustration" aria-hidden="true"><i class="fa-solid fa-house-chimney-user"></i></div>
                        <div class="service-content">
                            <h3 class="service-title">Realtor Locator</h3>
                            <p id="realtor-core-desc" class="service-description">Match with a vetted local realtor fast—get pre-arrival walk-throughs and insights.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Right: Insurance Coverage (taxonomy link) -->
            <div class="col-lg-4 col-md-6">
                <a href="/service-type/insurance/" class="service-card-link">
                    <div class="service-card interactive-card" aria-describedby="insurance-desc">
                        <div class="service-illustration" aria-hidden="true"><i class="fa-solid fa-shield-heart"></i></div>
                        <div class="service-content">
                            <h3 class="service-title">Insurance Coverage</h3>
                            <p id="insurance-desc" class="service-description">Health and travel insurance options tailored for international moves.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-muted">Need something else—like international tax advice or business setup? <a href="/contact" class="text-primary">Contact us</a> for free, expert guidance.</p>
            <a href="/services" class="btn btn-primary mt-2">View All Services →</a>
        </div>
    </div>
</section>

<!-- 4. Why Smooth Migration Global -->
<section class="why-us py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Smooth Migration Global?</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon">👥</div>
                    <div class="feature-content">
                        <h3>Founded by expats who've done this move themselves</h3>
                        <p>We understand the challenges because we've lived them firsthand.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon">📊</div>
                    <div class="feature-content">
                        <h3>4 years of data-driven research</h3>
                        <p>Insights from thousands of successful relocations inform every recommendation.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon">💰</div>
                    <div class="feature-content">
                        <h3>Up to 30% cheaper than going direct</h3>
                        <p>Preferred pricing from top international brands saves you money.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon">🎯</div>
                    <div class="feature-content">
                        <h3>One login, one support team</h3>
                        <p>Every stage covered with consistent, personalized support throughout your journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Enhanced Social Proof with Service Logos Carousel -->
<section class="social-proof py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number"><?php echo esc_html( preg_replace('/\D+$/', '', get_option( 'sm_successful_relocations', '2500+' ) ) ); ?>+<sup class="ms-1"><a class="text-muted" href="/methodology" aria-label="See methodology">*</a></sup></div>
                    <div class="stat-label">Successful Moves</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Customer Satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?><sup class="ms-1"><a class="text-muted" href="/methodology" aria-label="See methodology">*</a></sup></div>
                    <div class="stat-label">Countries Served</div>
                </div>
            </div>
        </div>
        
        <!-- Service Partners Carousel -->
        <div class="partners-carousel mb-5">
            <h3 class="text-center mb-4">Trusted Service Partners</h3>
            <div class="carousel-container">
                <div class="carousel-track" id="partnersCarousel">
                    <?php
                    // Get services with featured images for logo carousel
                    $services = get_posts(array(
                        'post_type' => 'service',
                        'posts_per_page' => 12,
                        'meta_query' => array(
                            array(
                                'key' => '_thumbnail_id',
                                'compare' => 'EXISTS'
                            )
                        )
                    ));
                    
                    if ($services) {
                        foreach ($services as $service) {
                            $thumbnail = get_the_post_thumbnail($service->ID, 'medium', array('class' => 'partner-logo', 'loading' => 'lazy'));
                            if ($thumbnail) {
                                echo '<div class="partner-item" data-service-id="' . $service->ID . '">';
                                echo '<a href="' . get_permalink($service->ID) . '" class="partner-link">';
                                echo $thumbnail;
                                echo '<span class="partner-name">' . get_the_title($service->ID) . '</span>';
                                echo '</a>';
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-text">"Smooth Migration made our move effortless. Their team handled everything perfectly — and the service was free."</div>
                    <div class="testimonial-author">— Sarah M., UK → Canada</div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-text">"The cost savings alone paid for their service twice over. Highly recommend — free guidance, trusted partners."</div>
                    <div class="testimonial-author">— James R., SA → Canada</div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-text">"Finally, someone who understands the expat experience. The guidance was free and spot‑on for our move."</div>
                    <div class="testimonial-author">— Maria L., UK → Canada</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. About Us Story Snippet -->
<section class="about-snippet py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="section-title">Our Story</h2>
                <div class="story-content">
                    <p>In 2019, a group of internationally qualified expats set out to fix the broken relocation experience. Having navigated multiple international moves ourselves, we knew there had to be a better way.</p>
                    <p>We combined our firsthand experience with extensive research and data from thousands of relocations to create a platform that actually works for real people making real moves.</p>
                    <a href="/about" class="btn btn-outline-primary">Read our full story →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Resources & Next Steps Section -->
<section class="resources-section py-5 bg-light">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Ready to Get Started?</h2>
                <p class="section-subtitle mb-4">Choose your path to a successful international relocation.</p>
                
                <div class="resource-options">
                    <div class="resource-item">
                        <div class="resource-icon">🚀</div>
                        <div class="resource-content">
                            <h4>Start Building Your Plan</h4>
                            <p>Browse our services and create a customized relocation package.</p>
                            <a href="/services" class="btn btn-primary">Explore Services →</a>
                        </div>
                    </div>
                    
                    <div class="resource-item">
                        <div class="resource-icon">💬</div>
                        <div class="resource-content">
                            <h4>Talk to an Expert</h4>
                            <p>Get personalized guidance from our relocation specialists.</p>
                            <a href="/contact" class="btn btn-outline-primary">Get in Touch →</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="resources-card">
                    <h3 class="resources-title">Free Resources</h3>
                    <p class="resources-description">Get started with our helpful tools and guides.</p>
                    
                    <div class="resources-list">
                        <a href="/ai-relocator" class="resource-link">
                            <span class="resource-link-icon">🤖</span>
                            <div class="resource-link-content">
                                <strong>AI Relocator Assistant</strong>
                                <small>Intelligent relocation planning</small>
                            </div>
                        </a>
                        
                        <a href="/guides" class="resource-link">
                            <span class="resource-link-icon">📚</span>
                            <div class="resource-link-content">
                                <strong>Moving Guides</strong>
                                <small>Country-specific advice</small>
                            </div>
                        </a>
                        
                        <a href="/faq" class="resource-link">
                            <span class="resource-link-icon">❓</span>
                            <div class="resource-link-content">
                                <strong>FAQ</strong>
                                <small>Common questions answered</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<!-- Sticky consult box -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div class="toast show shadow" role="status" aria-live="polite" aria-atomic="true">
        <div class="toast-body d-flex align-items-center gap-3">
            <div class="flex-shrink-0" aria-hidden="true">💬</div>
            <div>
                <strong>Consult available services</strong>
                <div class="small text-muted">Talk to a specialist today</div>
            </div>
            <a class="btn btn-primary btn-sm" href="/contact">Book now</a>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Dismiss"></button>
        </div>
    </div>
    <script>document.addEventListener('DOMContentLoaded',function(){var t=document.querySelector('.toast'); if(t&&bootstrap?.Toast){ new bootstrap.Toast(t,{autohide:false}).show(); }});</script>
</div>

<script>
function downloadChecklist() {
    // Implement checklist download
    alert('Relocation checklist download coming soon!');
}

// Enhanced button state management and scroll animations
document.addEventListener('DOMContentLoaded', function() {
    // Handle all button clicks to prevent loading state issues
    const buttons = document.querySelectorAll('.btn[href]');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Don't prevent default - let the link work normally
            // Just add a subtle visual feedback
            this.style.opacity = '0.8';
            this.style.pointerEvents = 'none';
            
            // Reset after a short delay in case navigation fails
            setTimeout(() => {
                this.style.opacity = '';
                this.style.pointerEvents = '';
            }, 1000);
        });
    });
    
    // Auto-scroll carousel
    const carousel = document.getElementById('partnersCarousel');
    if (carousel) {
        let scrollAmount = 0;
        const scrollSpeed = 1;
        
        function autoScroll() {
            scrollAmount += scrollSpeed;
            if (scrollAmount >= carousel.scrollWidth - carousel.clientWidth) {
                scrollAmount = 0;
            }
            carousel.scrollLeft = scrollAmount;
        }
        
        const scrollInterval = setInterval(autoScroll, 50);
        
        // Pause on hover
        carousel.addEventListener('mouseenter', () => clearInterval(scrollInterval));
        carousel.addEventListener('mouseleave', () => {
            setInterval(autoScroll, 50);
        });
    }
    
    // Scroll animations for sections
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
    
    // Add animation classes to sections and observe them
    const sectionsToAnimate = document.querySelectorAll('.how-it-works, .services-snapshot, .why-us, .social-proof, .about-snippet, .resources-section');
    sectionsToAnimate.forEach((section, index) => {
        section.classList.add('animate-on-scroll');
        section.style.animationDelay = `${index * 0.2}s`;
        observer.observe(section);
    });
    
    // Add staggered animation to cards
    const cards = document.querySelectorAll('.service-card, .step-card, .feature-item, .testimonial-card');
    cards.forEach((card, index) => {
        card.classList.add('animate-on-scroll');
        card.style.animationDelay = `${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Enhanced parallax effect for hero section
    const heroSection = document.querySelector('.hero-landing');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = scrolled * 0.5;
            heroSection.style.transform = `translateY(${parallax}px)`;
        });
    }
    
    // Add smooth scrolling to anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add loading states to CTAs
    const ctaButtons = document.querySelectorAll('.btn-cta, .btn-primary');
    ctaButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.add('loading');
            setTimeout(() => {
                this.classList.remove('loading');
            }, 2000);
        });
    });
});
</script>

<?php get_footer(); ?> 