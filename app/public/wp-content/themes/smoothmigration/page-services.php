<?php
/**
 * Enhanced Modern Services Page Template
 * Displays all service types with sophisticated design and animations
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <!-- Minimal Header for Services -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">Our Services</h1>
                    <p class="text-muted mb-0">Everything you need for a smooth international move.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Services Grid -->
    <section class="services-grid py-6">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-7">
            <?php
            // Curated list of service categories (reduced set)
            $curated_slugs = array('realtor','banking-services','data-and-phone-plans','vehicles','international-moving','insurance');

            // Build curated service types array, including a virtual "realtor" card
            $service_types = array();
            foreach ( $curated_slugs as $slug ) {
                if ( $slug === 'realtor' ) {
                    $service_types[] = (object) array(
                        'slug' => 'realtor',
                        'name' => 'Realtor Locator',
                        'description' => 'Find your perfect home with our vetted real estate partners.',
                        '__virtual' => true,
                    );
                    continue;
                }

                $term = get_term_by( 'slug', $slug, 'service_type' );
                if ( $term && ! is_wp_error( $term ) ) {
                    $service_types[] = $term;
                }
            }

            // Enhanced service mapping with better icons and descriptions
            $service_enhancements = array(
                'banking-services' => array(
                    'icon' => 'fa-solid fa-credit-card',
                    'name' => 'Banking Services',
                    'description' => 'Banking and international transfers set up for expats.',
                    'features' => ['Account Opening', 'Cards & Payments', 'International Transfers'],
                    'timeline' => '1-2 weeks',
                    'color' => 'primary'
                ),
                'realtor' => array(
                    'icon' => 'fa-solid fa-house',
                    'name' => 'Realtor Locator',
                    'description' => 'Find your perfect home with our vetted real estate partners.',
                    'features' => ['Property Search', 'Virtual Tours', 'Legal Support'],
                    'timeline' => '2-4 weeks',
                    'color' => 'success'
                ),
                'insurance' => array(
                    'icon' => 'fa-solid fa-shield-heart',
                    'name' => 'Insurance Coverage',
                    'description' => 'Comprehensive insurance solutions for your peace of mind.',
                    'features' => ['Health Insurance', 'Property Coverage', 'Life Insurance'],
                    'timeline' => '1-3 weeks',
                    'color' => 'info'
                ),
                'vehicles' => array(
                    'icon' => 'fa-solid fa-car',
                    'name' => 'Vehicle Services',
                    'description' => 'Complete vehicle solutions including import, purchase, and registration.',
                    'features' => ['Import Services', 'Purchase Assistance', 'Registration'],
                    'timeline' => '3-6 weeks',
                    'color' => 'warning'
                ),
                'data-and-phone-plans' => array(
                    'icon' => 'fa-solid fa-mobile-screen',
                    'name' => 'Data and Phone Plans',
                    'description' => 'Mobile plans and connectivity solutions for seamless communication.',
                    'features' => ['Plan Selection', 'Device Setup', 'Network Optimization'],
                    'timeline' => '1 week',
                    'color' => 'secondary'
                ),
                
                'international-moving' => array(
                    'icon' => 'fa-solid fa-box',
                    'name' => 'International Moving',
                    'description' => 'Professional international moving services with trusted global partners.',
                    'features' => ['Packing Services', 'Customs Clearance', 'Door-to-Door'],
                    'timeline' => '6-8 weeks',
                    'color' => 'primary'
                ),
                'visas-immigration' => array(
                    'icon' => 'fa-solid fa-clipboard-list',
                    'name' => 'Visas & Immigration',
                    'description' => 'Navigate complex visa requirements with expert immigration guidance.',
                    'features' => ['Visa Applications', 'Document Preparation', 'Legal Support'],
                    'timeline' => '4-12 weeks',
                    'color' => 'info'
                ),
                'pet-relocation' => array(
                    'icon' => 'fa-solid fa-dog',
                    'name' => 'Pet Relocation',
                    'description' => 'Safe and stress-free relocation services for your beloved pets.',
                    'features' => ['Health Certificates', 'Travel Arrangements', 'Quarantine Support'],
                    'timeline' => '3-6 weeks',
                    'color' => 'warning'
                ),
                'school-search' => array(
                    'icon' => 'fa-solid fa-graduation-cap',
                    'name' => 'School Search',
                    'description' => 'Find the right schools and educational opportunities for your children.',
                    'features' => ['School Research', 'Application Support', 'Enrollment Assistance'],
                    'timeline' => '2-6 weeks',
                    'color' => 'success'
                ),
                'tax-legal' => array(
                    'icon' => 'fa-solid fa-scale-balanced',
                    'name' => 'Tax & Legal Services',
                    'description' => 'International tax advice and legal services for expats.',
                    'features' => ['Tax Planning', 'Legal Consultation', 'Compliance Support'],
                    'timeline' => '2-4 weeks',
                    'color' => 'secondary'
                ),
                'business-setup' => array(
                    'icon' => 'fa-solid fa-briefcase',
                    'name' => 'Business Setup',
                    'description' => 'Company formation and business setup in your new country.',
                    'features' => ['Company Registration', 'Banking Setup', 'Compliance'],
                    'timeline' => '4-8 weeks',
                    'color' => 'primary'
                ),
                'utilities-services' => array(
                    'icon' => 'fa-solid fa-bolt',
                    'name' => 'Utilities & Services',
                    'description' => 'Internet, electricity, water, and essential service connections.',
                    'features' => ['Utility Connections', 'Service Activation', 'Account Setup'],
                    'timeline' => '1-2 weeks',
                    'color' => 'info'
                )
            );

            if ( ! empty( $service_types ) && ! is_wp_error( $service_types ) ) :
            ?>
                <div class="row g-4" id="servicesGrid">
                    <?php
                    foreach ( $service_types as $index => $type ) :
                        $term_link = isset( $type->__virtual ) ? '/realtor-form' : get_term_link( $type );
                        $enhancement = $service_enhancements[$type->slug] ?? null;
                        
                        // Use enhanced data if available, otherwise fallback to original
                        $display_name = $enhancement ? $enhancement['name'] : $type->name;
                        $icon = $enhancement ? $enhancement['icon'] : 'fa-solid fa-wrench';
                        $description = $enhancement ? $enhancement['description'] : ($type->description ?: 'Explore our ' . strtolower($type->name) . ' options.');
                        $features = $enhancement ? $enhancement['features'] : ['Professional Service', 'Expert Support', 'Quality Guarantee'];
                        $timeline = $enhancement ? $enhancement['timeline'] : '2-4 weeks';
                        $color = $enhancement ? $enhancement['color'] : 'primary';
                    ?>
                        <div class="col-md-6">
                            <div class="enhanced-service-card animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                                <div class="service-card-header">
                                    <div class="service-icon-modern bg-<?php echo $color; ?>">
                                        <?php if ( strpos( $icon, 'fa-' ) !== false ) : ?>
                                            <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                        <?php else : ?>
                                            <span class="service-emoji"><?php echo esc_html( $icon ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="service-timeline">
                                        <small class="text-muted">Typical timeline</small>
                                        <strong class="text-<?php echo $color; ?>"><?php echo $timeline; ?></strong>
                                    </div>
                                </div>
                                
                                <div class="service-card-body">
                                    <h3 class="service-title"><?php echo esc_html( $display_name ); ?></h3>
                                    <p class="service-description"><?php echo esc_html( $description ); ?></p>
                                    
                                    <div class="service-features">
                                        <ul class="features-list">
                                            <?php foreach ($features as $feature) : ?>
                                                <li>
                                                    <i class="fas fa-check-circle text-<?php echo $color; ?>"></i>
                                                    <?php echo esc_html($feature); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="service-card-footer">
                                    <div class="service-actions">
                                        <a href="#" class="btn btn-outline-<?php echo $color; ?> btn-sm btn-quick-view" 
                                           data-service-type="<?php echo esc_attr( $type->slug ); ?>" 
                                           data-service-type-name="<?php echo esc_attr( $display_name ); ?>">
                                           <i class="fas fa-eye"></i> Quick View
                                        </a>
                                        <a href="<?php echo esc_url( $term_link ); ?>" class="btn btn-<?php echo $color; ?> btn-sm">
                                            <i class="fas fa-arrow-right"></i> View Services
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
            <?php else : ?>
                <div class="text-center py-5">
                    <div class="empty-state">
                        <div class="empty-icon mb-4">
                            <i class="fas fa-tools display-1 text-muted"></i>
                        </div>
                        <h3>Services Coming Soon</h3>
                        <p class="text-muted mb-4">We're setting up our comprehensive service catalog. Please check back soon or contact us directly for immediate assistance.</p>
                        <a href="/contact" class="btn btn-primary btn-lg">Contact Us</a>
                    </div>
                </div>
            <?php endif; ?>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <?php
                    $no_globe = isset($_GET['noglobe']) && $_GET['noglobe'] === '1';
                    if ( ! $no_globe ) : ?>
                        <div class="services-parallax-globe" id="services-globe-container">
                            <?php echo do_shortcode('[smooth_globe height="80vh" id="smooth-globe-services"]'); ?>
                        </div>
                    <?php else : ?>
                        <!-- World map SVG temporarily removed -->
                        <!-- <div class="services-sticky-globe sticky-top">
                            <?php
                            $map_path = get_template_directory() . '/assets/svg/world-map.svg';
                            if ( file_exists( $map_path ) ) {
                                echo file_get_contents( $map_path );
                            } else {
                                echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/svg/world-map.svg' ) . '" alt="" />';
                            }
                            ?>
                        </div> -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="services-cta py-6 bg-gradient-secondary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Need Something Else?</h2>
                        <p class="lead mb-4">Looking for specialized services like international tax advice, business setup, or other unique requirements? Our expert team is here to help with personalized solutions.</p>
                        <div class="cta-features d-flex flex-wrap gap-4 mb-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-phone-alt me-2"></i>
                                <span>Free Consultation</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-clock me-2"></i>
                                <span>24/7 Support</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-globe me-2"></i>
                                <span>Global Expertise</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-accent btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Get Expert Guidance
                        </a>
                        <a href="/about" class="btn btn-outline-light w-100">
                            <i class="fas fa-users me-2"></i>
                            Meet Our Team
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* Enhanced Services Page Styles */
/* Removed blue hero in favor of minimal header */

.badge-modern {
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

.enhanced-service-card {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    padding: 0;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}

.enhanced-service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.enhanced-service-card:hover::before {
    opacity: 1;
}

.enhanced-service-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.service-card-header {
    padding: 2rem 2rem 1rem;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

.service-icon-modern {
    width: 70px;
    height: 70px;
    border-radius: var(--border-radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.enhanced-service-card:hover .service-icon-modern {
    transform: scale(1.1);
    box-shadow: var(--shadow-lg);
}

.service-timeline {
    text-align: right;
}

.service-timeline small {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.service-card-body {
    padding: 0 2rem;
    flex: 1;
}

.service-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.enhanced-service-card:hover .service-title {
    color: var(--primary-color);
}

.service-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.features-list li {
    padding: 0.5rem 0;
    font-size: 0.9rem;
    color: var(--text-medium);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.service-card-footer {
    padding: 1rem 2rem 2rem;
    margin-top: auto;
}

.service-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: space-between;
}

.service-actions .btn {
    flex: 1;
    font-size: 0.9rem;
    font-weight: 600;
}

.empty-state {
    max-width: 500px;
    margin: 0 auto;
}

.services-cta {
    background: var(--gradient-secondary) !important;
}

.cta-features .feature-item {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

.services-filter .form-control {
    border-radius: var(--border-radius-lg);
    border: 2px solid var(--border-light);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.services-filter .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .service-card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .service-timeline {
        text-align: center;
    }
    
    .service-actions {
        flex-direction: column;
    }
    
    .cta-features {
        justify-content: center;
    }
}

/* Sticky globe spacing within services page */
.services-sticky-globe {
    top: calc(var(--sm-topbar-height, 0px) + 80px);
}

/* Tighten grid container to the left on xl screens */
@media (min-width: 1200px) {
    #servicesGrid { padding-right: 1rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // No search; grid is lean and focused
    
    // Quick view functionality
    const quickViewButtons = document.querySelectorAll('.btn-quick-view');
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const serviceType = this.dataset.serviceType;
            const serviceName = this.dataset.serviceTypeName;
            
            // Here you could implement a modal or redirect to a detailed view
            alert(`Quick view for ${serviceName} coming soon!`);
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
    
    // Observe service cards
    const serviceCards = document.querySelectorAll('.enhanced-service-card');
    serviceCards.forEach(card => {
        card.classList.add('animate-on-scroll');
        observer.observe(card);
    });
});
</script>

<?php
get_footer(); 