<?php
/**
 * Front Page Template - Smooth Migration Global Landing Page
 *
 * @package smoothmigration
 */

get_header(); ?>

<a class="skip-link" href="#main">Skip to main content</a>

<!-- 1. Enhanced Hero Section -->
<section class="hero-landing">
    <div class="hero-overlay-dark" aria-hidden="true"></div>
    
    <!-- World map moved to right column; service cubes relocated below hero -->
    <div class="container">
        <div class="row align-items-start min-vh-75">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="hero-headline">Your international relocation,<br>made simple.</h1>
                    <p class="hero-subheadline">
                        <span class="hero-line">Get your clear, step-by-step plan with preferred rates from global providers.</span>
                        <span class="hero-line">Tailored to your destination, timing, and budget.</span>
                        <span class="hero-line">Even if you're moving internationally for the first time, you'll have expert guidance every step of the way.</span>
                    </p>
                    <!-- Enhanced CTA Group with Self-Segmentation -->
                    <div class="hero-cta-group">
                        <a href="/services" class="btn btn-primary btn-lg cta-relocating">
                            <span class="icon-glow me-2"><?php echo sm_icon('house', 'solid', ''); ?></span>
                            Get My Personal Moving Plan
                        </a>
                        <a href="/become-a-partner" class="btn btn-accent btn-lg cta-partner">
                            <span class="icon-glow me-2"><?php echo sm_icon('handshake', 'solid', ''); ?></span>
                            Become a Partner

                        </a>
                        <div style="justify-content: center; text-align: center; font-size: 0.9rem; color: #ddd;">
                            <img src="wp-content\themes\smoothmigration\assets\images\duns_4.png" alt="Dun & Bradstreet 40 Under 40 Logo" class="duns-logo mt-3" loading="lazy" style="width: 100px;">
                        <br><p>DUNS Number<br> 243276421</p>
                        </div>
                        

                    </div>
                    
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
            <div class="col-lg-4 d-none d-lg-block">
                <div class="hero-map-container" aria-hidden="true">
                    <?php echo do_shortcode('[smooth_globe height="420px" id="smooth-globe-hero"]'); ?>
                </div>
                <?php $expats = trim( (string) get_option( 'sm_expats_count', '' ) ); if ( $expats !== '' ) : ?>
                <div class="stat-item mt-4">
                    <div class="stat-number"><?php echo esc_html( $expats ); ?></div>
                    <div class="stat-label">Expats In Our Community</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $updated = trim( (string) get_option( 'sm_stats_last_updated', '' ) ); if ( $updated !== '' ) : ?>
        <p class="text-muted small mt-2"><?php echo esc_html( $updated ); ?> <a class="text-muted" href="/methodology" aria-label="See methodology details">Methodology</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- 2. Interactive How It Works Section - REMOVED -->
<main id="main">

<!-- 3. Limited Services Snapshot (3x2 Grid) -->
<section class="services-snapshot py-5 bg-light position-relative" aria-labelledby="services-title">
    <!-- Decorative services cubes background -->
    <div class="services-cubes-bg d-none d-md-block" aria-hidden="true">
        <?php
        $cubes_path = get_template_directory() . '/assets/svg/service-cubes.svg';
        if ( file_exists( $cubes_path ) ) {
            echo file_get_contents( $cubes_path );
        }
        ?>
    </div>
    <div class="container">
        <div class="text-center mb-5">
            <h2 id="services-title" class="section-title">Our Core Services</h2>
            <p class="section-subtitle">Everything you need for your smooth international move — and it's free. Even if you only need one service, you'll get expert guidance and world class providers.</p>
        </div>
        
        <div class="row g-4 services-grid-limited">
            <!-- Left: Banking Services (taxonomy link) -->
            <div class="col-lg-4 col-md-6">
                <a href="/service-type/banking-services/" class="service-card-link">
                    <div class="service-card interactive-card" aria-describedby="banking-services-desc">
                        <div class="service-illustration" aria-hidden="true"><i class="fa-solid fa-money-bill-transfer"></i></div>
                        <div class="service-content">
                            <h3 class="service-title">Banking Services</h3>
                            <p id="banking-services-desc" class="service-description">Banking, transfers, and multi-currency accounts set up for expats.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Center: Realtor Locator -->
            <div class="col-lg-4 col-md-6">
                <a href="/realtor-locator" class="service-card-link">
                    <div class="service-card interactive-card" aria-describedby="realtor-core-desc">
                        <div class="service-illustration" aria-hidden="true"><span class="icon-glow"><?php
                        $realtor_accent = get_template_directory() . '/assets/lottie/realtor-accent.json';
                        if ( file_exists( $realtor_accent ) ) {
                            echo do_shortcode('[lottie src="' . get_template_directory_uri() . '/assets/lottie/realtor-accent.json" loop="false" autoplay="false" speed="1" class="d-inline-block" style="width:36px;height:36px;"]');
                        } else {
                            echo sm_icon('house', 'solid', '');
                        }
                        ?></span></div>
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
            <p class="text-muted">Looking for specialized services like international tax advice, business setup, or other services not listed? Our expert team is here to help with personalized solutions within our preferred network providers. <a href="/contact" class="text-primary">Contact us</a>.</p>
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
                    <div class="feature-icon"><span class="icon-glow"><?php echo sm_icon('house', 'solid', ''); ?></span></div>
                    <div class="feature-content">
                        <h3>Founder and team with extensive first hand experience</h3>
                        <p>We understand the challenges because we've lived them firsthand.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon"><span class="icon-glow"><?php echo sm_icon('building', 'solid', ''); ?></span></div>
                    <div class="feature-content">
                        <h3>4 years of data-driven research</h3>
                        <p>Insights from thousands of successful relocations inform every recommendation.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon"><span class="icon-glow"><?php echo sm_icon('rocket', 'solid', ''); ?></span></div>
                    <div class="feature-content">
                        <h3>Up to 30% cheaper than going direct</h3>
                        <p>Preferred pricing from top international brands saves you money.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-item interactive-card">
                    <div class="feature-icon"><span class="icon-glow"><?php echo sm_icon('handshake', 'solid', ''); ?></span></div>
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
                    <div class="stat-number"><?php echo esc_html( get_option( 'sm_customer_satisfaction', '98%' ) ); ?></div>
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
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="testimonial-card">
                    <div class="testimonial-text">“Smooth Migration consistently delivers for our clients. Their team anticipates needs, keeps communication tight, and makes every relocation feel supported from day one.”</div>
                    <div class="testimonial-author">— Diane – Owner, New Routes Canada</div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-8">
                <div class="testimonial-card">
                    <div class="testimonial-text">“Homewise and Smooth Migration have guided dozens of newcomers together. Their team keeps clients informed, organized, and confident throughout the mortgage journey.”</div>
                    <div class="testimonial-author">— Jesse Abrams – Co Founder, CEO of Homewise</div>
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
                    <p>In 2019, a group of internationally qualified newcomers set out to fix the broken relocation experience. Having navigated multiple international moves ourselves, we knew there had to be a better way.</p>
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
                        <div class="resource-icon"><span class="icon-glow"><?php echo sm_icon('rocket', 'solid', ''); ?></span></div>
                        <div class="resource-content">
                            <h4>Start Building Your Plan</h4>
                            <p>Browse our services and create a customized relocation package.</p>
                            <a href="/services" class="btn btn-primary">Explore Services →</a>
                        </div>
                    </div>
                    
                    <div class="resource-item">
                        <div class="resource-icon"><span class="icon-glow"><?php echo sm_icon('comment-dots', 'solid', ''); ?></span></div>
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
                            <span class="resource-link-icon"><span class="icon-glow"><?php echo sm_icon('robot', 'solid', ''); ?></span></span>
                            <div class="resource-link-content">
                                <strong>AI Relocator Assistant</strong>
                                <small>Intelligent relocation planning</small>
                            </div>
                        </a>
                        
                        <a href="/guides" class="resource-link">
                            <span class="resource-link-icon"><span class="icon-glow"><?php echo sm_icon('book-open', 'solid', ''); ?></span></span>
                            <div class="resource-link-content">
                                <strong>Moving Guides</strong>
                                <small>Country-specific advice</small>
                            </div>
                        </a>
                        
                        <a href="/faq" class="resource-link">
                            <span class="resource-link-icon"><span class="icon-glow"><?php echo sm_icon('circle-question', 'solid', ''); ?></span></span>
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

<script>
function downloadChecklist() {
    // Redirect to AI Relocator page
    window.location.href = '/ai-relocator';
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
    
    // Enhanced Partners Carousel with Infinite Scroll
    const carousel = document.getElementById('partnersCarousel');
    if (carousel) {
        // Duplicate carousel content for seamless infinite scroll
        const originalItems = Array.from(carousel.children);
        const duplicatedItems = originalItems.map(item => item.cloneNode(true));
        duplicatedItems.forEach(item => carousel.appendChild(item));
        
        // Keyboard navigation support
        carousel.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                e.preventDefault();
                const focusableItems = carousel.querySelectorAll('.partner-link');
                const currentIndex = Array.from(focusableItems).indexOf(document.activeElement);
                
                if (currentIndex !== -1) {
                    let nextIndex;
                    if (e.key === 'ArrowLeft') {
                        nextIndex = (currentIndex - 1 + focusableItems.length) % focusableItems.length;
                    } else {
                        nextIndex = (currentIndex + 1) % focusableItems.length;
                    }
                    focusableItems[nextIndex].focus();
                }
            }
        });
        
        // Enhanced accessibility - announce carousel state
        const announceCarousel = () => {
            const totalItems = originalItems.length;
            carousel.setAttribute('aria-live', 'polite');
            carousel.setAttribute('aria-label', `Partner carousel with ${totalItems} partners. Use arrow keys to navigate.`);
        };
        
        announceCarousel();
        
        // Enhanced hover pause functionality
        carousel.addEventListener('mouseenter', () => {
            carousel.style.animationPlayState = 'paused';
        });
        
        carousel.addEventListener('mouseleave', () => {
            if (!carousel.matches(':focus-within')) {
                carousel.style.animationPlayState = 'running';
            }
        });
        
        // Pause on focus for accessibility
        carousel.addEventListener('focusin', () => {
            carousel.style.animationPlayState = 'paused';
        });
        
        carousel.addEventListener('focusout', (e) => {
            // Resume animation if focus moves completely outside the carousel
            setTimeout(() => {
                if (!carousel.contains(document.activeElement) && !carousel.matches(':hover')) {
                    carousel.style.animationPlayState = 'running';
                }
            }, 100);
        });
        
        // Respect reduced motion preferences
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            carousel.style.animation = 'none';
        }
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
    const sectionsToAnimate = document.querySelectorAll('.services-snapshot, .why-us, .social-proof, .about-snippet, .resources-section');
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

    // Debug toggles for services cubes overlay
    const urlParams = new URLSearchParams(window.location.search);
    const cubesBg = document.querySelector('.services-cubes-bg');
    if (cubesBg) {
        if (urlParams.has('nocubes')) {
            cubesBg.style.display = 'none';
        }
        if (urlParams.has('showcubes')) {
            cubesBg.style.display = '';
        }
    }
});
</script>

<?php get_footer(); ?> 