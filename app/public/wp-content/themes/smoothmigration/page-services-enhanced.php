<?php
/**
 * Enhanced Services Page Template
 * Combines existing services with new landing page services
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
            
            <!-- Enhanced Services Grid -->
            <div class="row g-4 justify-content-center">
                
                <?php
                // Get existing service types from database
                $existing_service_types = get_terms( array(
                    'taxonomy'   => 'service_type',
                    'hide_empty' => false,
                ) );

                // Create enhanced services array combining existing + new
                $enhanced_services = array(
                    'housing' => array(
                        'name' => 'Housing & Real Estate',
                        'icon' => '🏠',
                        'description' => 'Find your perfect home with our vetted real estate partners and housing specialists.',
                        'existing' => 'realtor', 
                        'link' => '/service-type/realtor/'
                    ),
                    'banking' => array(
                        'name' => 'Banking & Financial',
                        'icon' => '🏦',
                        'description' => 'Complete banking setup and financial services for your new location.',
                        'existing' => 'banking',
                        'link' => '/service-type/banking/'
                    ),
                    'visas' => array(
                        'name' => 'Visas & Immigration',
                        'icon' => '📋',
                        'description' => 'Navigate complex visa requirements with expert immigration guidance.',
                        'existing' => false,
                        'link' => '/contact'
                    ),
                    'pet-relocation' => array(
                        'name' => 'Pet Relocation',
                        'icon' => '🐕',
                        'description' => 'Safe and stress-free relocation services for your beloved pets.',
                        'existing' => false,
                        'link' => '/contact'
                    ),
                    'international-moving' => array(
                        'name' => 'International Moving',
                        'icon' => '📦',
                        'description' => 'Professional international moving services with trusted global partners.',
                        'existing' => 'transfer',
                        'link' => '/service-type/transfer/'
                    ),
                    'school-search' => array(
                        'name' => 'School Search',
                        'icon' => '🎓',
                        'description' => 'Find the right schools and educational opportunities for your children.',
                        'existing' => false,
                        'link' => '/contact'
                    ),
                    'vehicle-import' => array(
                        'name' => 'Vehicle Services',
                        'icon' => '🚗',
                        'description' => 'Complete vehicle solutions including import, purchase, and registration.',
                        'existing' => 'vehicle',
                        'link' => '/service-type/vehicle/'
                    ),
                    'mobile-cellular' => array(
                        'name' => 'Mobile & Connectivity',
                        'icon' => '📱',
                        'description' => 'Mobile plans and connectivity solutions for seamless communication.',
                        'existing' => 'mobile',
                        'link' => '/service-type/mobile/'
                    ),
                    'insurance' => array(
                        'name' => 'Insurance & Protection',
                        'icon' => '🛡️',
                        'description' => 'Comprehensive insurance solutions for your peace of mind.',
                        'existing' => 'insurance',
                        'link' => '/service-type/insurance/'
                    ),
                    'more-services' => array(
                        'name' => 'Custom Solutions',
                        'icon' => '➕',
                        'description' => 'Need something specific? We provide custom relocation solutions tailored to your unique needs.',
                        'existing' => false,
                        'link' => '/contact'
                    ),
                );

                foreach ( $enhanced_services as $service_key => $service ) :
                    $has_existing_content = $service['existing'] !== false;
                    $cta_text = $has_existing_content ? 'View Services' : 'Contact Us';
                    $card_class = $has_existing_content ? 'service-card' : 'service-card service-card-coming-soon';
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="<?php echo esc_attr( $card_class ); ?> h-100">
                            <div class="service-icon-enhanced">
                                <span class="service-emoji"><?php echo $service['icon']; ?></span>
                            </div>
                            <h4 class="service-title"><?php echo esc_html( $service['name'] ); ?></h4>
                            <p class="service-description"><?php echo esc_html( $service['description'] ); ?></p>
                            
                            <div class="service-actions mt-auto">
                                <?php if ( $has_existing_content ) : ?>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="#" class="btn btn-primary btn-quick-view" 
                                           data-service-type="<?php echo esc_attr( $service['existing'] ); ?>" 
                                           data-service-type-name="<?php echo esc_attr( $service['name'] ); ?>">
                                           Quick View
                                        </a>
                                        <a href="<?php echo esc_url( $service['link'] ); ?>" class="btn btn-outline-primary">
                                            <?php echo esc_html( $cta_text ); ?>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $service['link'] ); ?>" class="btn btn-primary">
                                        <?php echo esc_html( $cta_text ); ?>
                                    </a>
                                    <small class="text-muted d-block mt-2">Service details available upon consultation</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
            
            <!-- Additional Info Section -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Need Something Else?</h5>
                        <p class="mb-2">International tax advice, business setup, legal services, or other specialized requirements?</p>
                        <a href="/contact" class="btn btn-outline-primary">Contact us for free expert guidance</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</main>

<?php
get_footer();
?> 