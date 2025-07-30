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

    <!-- Enhanced Hero Section for Services -->
    <section class="services-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="services-hero-content animate-on-scroll">
                        <h1 class="display-2 fw-bold mb-4">Our Services</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Comprehensive relocation services designed to make your international move seamless and stress-free.</p>
                        <div class="hero-badges d-flex flex-wrap justify-content-center gap-3 mb-4">
                            <span class="badge-modern">✨ 50+ Countries Served</span>
                            <span class="badge-modern">🏆 3,200+ Successful Moves</span>
                            <span class="badge-modern">⚡ 98% Customer Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- Services Filter Section -->
    <section class="services-filter py-4 bg-light border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="filter-intro">
                        <h3 class="h5 mb-2">Find Your Perfect Service</h3>
                        <p class="text-muted mb-0">Browse by category or search for specific needs</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="search-filter">
                        <div class="input-group">
                            <input type="text" class="form-control" id="serviceSearch" placeholder="Search services...">
                            <button class="btn btn-outline-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Services Grid -->
    <section class="services-grid py-6">
        <div class="container">
            <?php
            // Get all service types
            $service_types = get_terms( array(
                'taxonomy'   => 'service_type',
                'hide_empty' => false,
                'orderby'    => 'name',
                'order'      => 'ASC'
            ) );

            // Enhanced service mapping with better icons and descriptions
            $service_enhancements = array(
                'banking' => array(
                    'icon' => '🏦',
                    'name' => 'Banking Services',
                    'description' => 'Complete banking setup and financial services for your new location.',
                    'features' => ['Account Opening', 'Credit Setup', 'Investment Options'],
                    'timeline' => '1-2 weeks',
                    'color' => 'primary'
                ),
                'realtor' => array(
                    'icon' => '🏠',
                    'name' => 'Realtor Locator',
                    'description' => 'Find your perfect home with our vetted real estate partners.',
                    'features' => ['Property Search', 'Virtual Tours', 'Legal Support'],
                    'timeline' => '2-4 weeks',
                    'color' => 'success'
                ),
                'insurance' => array(
                    'icon' => '🛡️',
                    'name' => 'Insurance Coverage',
                    'description' => 'Comprehensive insurance solutions for your peace of mind.',
                    'features' => ['Health Insurance', 'Property Coverage', 'Life Insurance'],
                    'timeline' => '1-3 weeks',
                    'color' => 'info'
                ),
                'vehicles' => array(
                    'icon' => '🚗',
                    'name' => 'Vehicle Services',
                    'description' => 'Complete vehicle solutions including import, purchase, and registration.',
                    'features' => ['Import Services', 'Purchase Assistance', 'Registration'],
                    'timeline' => '3-6 weeks',
                    'color' => 'warning'
                ),
                'telecommunication' => array(
                    'icon' => '📱',
                    'name' => 'Mobile & Cellular Plans',
                    'description' => 'Mobile plans and connectivity solutions for seamless communication.',
                    'features' => ['Plan Selection', 'Device Setup', 'Network Optimization'],
                    'timeline' => '1 week',
                    'color' => 'secondary'
                ),
                'money-transfer' => array(
                    'icon' => '💸',
                    'name' => 'International Transfers',
                    'description' => 'Secure and efficient international money transfer services.',
                    'features' => ['Currency Exchange', 'Wire Transfers', 'Multi-Currency Accounts'],
                    'timeline' => '1-2 days',
                    'color' => 'success'
                ),
                'international-moving' => array(
                    'icon' => '📦',
                    'name' => 'International Moving',
                    'description' => 'Professional international moving services with trusted global partners.',
                    'features' => ['Packing Services', 'Customs Clearance', 'Door-to-Door'],
                    'timeline' => '6-8 weeks',
                    'color' => 'primary'
                ),
                'visas-immigration' => array(
                    'icon' => '📋',
                    'name' => 'Visas & Immigration',
                    'description' => 'Navigate complex visa requirements with expert immigration guidance.',
                    'features' => ['Visa Applications', 'Document Preparation', 'Legal Support'],
                    'timeline' => '4-12 weeks',
                    'color' => 'info'
                ),
                'pet-relocation' => array(
                    'icon' => '🐕',
                    'name' => 'Pet Relocation',
                    'description' => 'Safe and stress-free relocation services for your beloved pets.',
                    'features' => ['Health Certificates', 'Travel Arrangements', 'Quarantine Support'],
                    'timeline' => '3-6 weeks',
                    'color' => 'warning'
                ),
                'school-search' => array(
                    'icon' => '🎓',
                    'name' => 'School Search',
                    'description' => 'Find the right schools and educational opportunities for your children.',
                    'features' => ['School Research', 'Application Support', 'Enrollment Assistance'],
                    'timeline' => '2-6 weeks',
                    'color' => 'success'
                ),
                'tax-legal' => array(
                    'icon' => '⚖️',
                    'name' => 'Tax & Legal Services',
                    'description' => 'International tax advice and legal services for expats.',
                    'features' => ['Tax Planning', 'Legal Consultation', 'Compliance Support'],
                    'timeline' => '2-4 weeks',
                    'color' => 'secondary'
                ),
                'business-setup' => array(
                    'icon' => '💼',
                    'name' => 'Business Setup',
                    'description' => 'Company formation and business setup in your new country.',
                    'features' => ['Company Registration', 'Banking Setup', 'Compliance'],
                    'timeline' => '4-8 weeks',
                    'color' => 'primary'
                ),
                'utilities-services' => array(
                    'icon' => '⚡',
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
                        $term_link = get_term_link( $type );
                        $enhancement = $service_enhancements[$type->slug] ?? null;
                        
                        // Use enhanced data if available, otherwise fallback to original
                        $display_name = $enhancement ? $enhancement['name'] : $type->name;
                        $icon = $enhancement ? $enhancement['icon'] : '🔧';
                        $description = $enhancement ? $enhancement['description'] : ($type->description ?: 'Explore our ' . strtolower($type->name) . ' options.');
                        $features = $enhancement ? $enhancement['features'] : ['Professional Service', 'Expert Support', 'Quality Guarantee'];
                        $timeline = $enhancement ? $enhancement['timeline'] : '2-4 weeks';
                        $color = $enhancement ? $enhancement['color'] : 'primary';
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="enhanced-service-card animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                                <div class="service-card-header">
                                    <div class="service-icon-modern bg-<?php echo $color; ?>">
                                        <span class="service-emoji"><?php echo $icon; ?></span>
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
.services-hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('serviceSearch');
    const servicesGrid = document.getElementById('servicesGrid');
    
    if (searchInput && servicesGrid) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const serviceCards = servicesGrid.querySelectorAll('.col-lg-4');
            
            serviceCards.forEach(card => {
                const title = card.querySelector('.service-title')?.textContent.toLowerCase() || '';
                const description = card.querySelector('.service-description')?.textContent.toLowerCase() || '';
                const features = Array.from(card.querySelectorAll('.features-list li')).map(li => li.textContent.toLowerCase()).join(' ');
                
                const isMatch = title.includes(searchTerm) || description.includes(searchTerm) || features.includes(searchTerm);
                
                if (isMatch) {
                    card.style.display = 'block';
                    card.classList.add('animate-in');
                } else {
                    card.style.display = 'none';
                    card.classList.remove('animate-in');
                }
            });
        });
    }
    
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