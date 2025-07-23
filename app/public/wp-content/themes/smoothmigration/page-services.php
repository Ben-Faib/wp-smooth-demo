<?php
/**
 * Enhanced Services Page Template
 * Displays all service types with improved icons and descriptions
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <header class="page-header-services text-center py-5 bg-light">
        <div class="container">
            <h1 class="page-title display-4 fw-bold">Our Services</h1>
            <p class="lead text-muted">Comprehensive relocation services designed to make your international move seamless and stress-free.</p>
        </div>
    </header>

    <div class="page-content py-5">
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
                    'description' => 'Complete banking setup and financial services for your new location.'
                ),
                'realtor' => array(
                    'icon' => '🏠',
                    'name' => 'Realtor Locator',
                    'description' => 'Find your perfect home with our vetted real estate partners.'
                ),
                'insurance' => array(
                    'icon' => '🛡️',
                    'name' => 'Insurance Coverage',
                    'description' => 'Comprehensive insurance solutions for your peace of mind.'
                ),
                'vehicles' => array(
                    'icon' => '🚗',
                    'name' => 'Vehicle',
                    'description' => 'Complete vehicle solutions including import, purchase, and registration.'
                ),
                'telecommunication' => array(
                    'icon' => '📱',
                    'name' => 'Mobile & Cellular Plans',
                    'description' => 'Mobile plans and connectivity solutions for seamless communication.'
                ),
                'money-transfer' => array(
                    'icon' => '💸',
                    'name' => 'International Transfers',
                    'description' => 'Secure and efficient international money transfer services.'
                ),
                'international-moving' => array(
                    'icon' => '📦',
                    'name' => 'International Moving',
                    'description' => 'Professional international moving services with trusted global partners.'
                ),
                // New service types
                'visas-immigration' => array(
                    'icon' => '📋',
                    'name' => 'Visas & Immigration',
                    'description' => 'Navigate complex visa requirements with expert immigration guidance.'
                ),
                'pet-relocation' => array(
                    'icon' => '🐕',
                    'name' => 'Pet Relocation',
                    'description' => 'Safe and stress-free relocation services for your beloved pets.'
                ),
                'school-search' => array(
                    'icon' => '🎓',
                    'name' => 'School Search',
                    'description' => 'Find the right schools and educational opportunities for your children.'
                ),
                'tax-legal' => array(
                    'icon' => '⚖️',
                    'name' => 'Tax & Legal Services',
                    'description' => 'International tax advice and legal services for expats.'
                ),
                'business-setup' => array(
                    'icon' => '💼',
                    'name' => 'Business Setup',
                    'description' => 'Company formation and business setup in your new country.'
                ),
                'utilities-services' => array(
                    'icon' => '⚡',
                    'name' => 'Utilities & Services',
                    'description' => 'Internet, electricity, water, and essential service connections.'
                )
            );

            if ( ! empty( $service_types ) && ! is_wp_error( $service_types ) ) :
            ?>
                <div class="row g-4 justify-content-center">
                    <?php
                    foreach ( $service_types as $type ) :
                        $term_link = get_term_link( $type );
                        $enhancement = $service_enhancements[$type->slug] ?? null;
                        
                        // Use enhanced data if available, otherwise fallback to original
                        $display_name = $enhancement ? $enhancement['name'] : $type->name;
                        $icon = $enhancement ? $enhancement['icon'] : '🔧';
                        $description = $enhancement ? $enhancement['description'] : ($type->description ?: 'Explore our ' . strtolower($type->name) . ' options.');
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card h-100">
                                <div class="service-icon-enhanced">
                                    <span class="service-emoji"><?php echo $icon; ?></span>
                                </div>
                                <h4 class="service-title"><?php echo esc_html( $display_name ); ?></h4>
                                <p class="service-description"><?php echo esc_html( $description ); ?></p>
                                <div class="service-actions mt-auto">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="#" class="btn btn-primary btn-quick-view" 
                                           data-service-type="<?php echo esc_attr( $type->slug ); ?>" 
                                           data-service-type-name="<?php echo esc_attr( $display_name ); ?>">
                                           Quick View
                                        </a>
                                        <a href="<?php echo esc_url( $term_link ); ?>" class="btn btn-outline-primary">
                                            View All Services
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Additional Services Section -->
                <div class="row mt-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Need Something Else?</h5>
                            <p class="mb-2">Looking for specialized services like international tax advice, business setup, or other unique requirements?</p>
                            <a href="/contact" class="btn btn-outline-primary">Contact us for free expert guidance</a>
                        </div>
                    </div>
                </div>
                
            <?php else : ?>
                <div class="text-center">
                    <div class="alert alert-warning">
                        <h4>Services Coming Soon</h4>
                        <p>We're setting up our comprehensive service catalog. Please check back soon or contact us directly for immediate assistance.</p>
                        <a href="/contact" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</main><!-- .site-main -->

<?php
get_footer(); 