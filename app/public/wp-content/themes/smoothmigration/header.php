<?php
/**
 * Header template - Enhanced with Top Bar
 *
 * @package smoothmigration
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar with Flags -->
<div class="top-bar bg-light border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div class="top-bar-left">
                <small class="text-muted">
                    <i class="fas fa-globe me-1"></i>
                    Select your Relocation Destination:
                </small>
            </div>
            <div class="top-bar-right">
                <?php
                // Country flags menu
                if ( has_nav_menu( 'country_flags' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'country_flags',
                        'container'      => false,
                        'menu_class'     => 'country-flags-menu d-flex gap-2 mb-0',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                } else {
                    // Fallback flags if menu not set
                    ?>
                    <div class="country-flags-menu d-flex gap-2">
                        <a href="https://www.smoothmigration.ca" class="flag-link" title="Canada" aria-label="Canada">
                            <img src="https://flagcdn.com/24x18/ca.png" alt="Canada" width="24" height="18">
                        </a>
                        <a href="https://www.smoothmigration.net" class="flag-link" title="United States" aria-label="United States">
                            <img src="https://flagcdn.com/24x18/us.png" alt="USA" width="24" height="18">
                        </a>
                        <a href="https://www.smoothmigration.co.uk" class="flag-link" title="United Kingdom" aria-label="United Kingdom">
                            <img src="https://flagcdn.com/24x18/gb.png" alt="UK" width="24" height="18">
                        </a>
                        <a href="https://www.smoothmigration.com.au" class="flag-link" title="Australia" aria-label="Australia">
                            <img src="https://flagcdn.com/24x18/au.png" alt="Australia" width="24" height="18">
                        </a>
                        <a href="https://www.smoothmigration.co.za" class="flag-link" title="South Africa" aria-label="South Africa">
                            <img src="https://flagcdn.com/24x18/za.png" alt="South Africa" width="24" height="18">
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header id="masthead" class="site-header sticky-header" role="banner">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'header-logo', 'alt' => get_bloginfo( 'name', 'display' ) ) );
                ?>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $logo_img; ?></a>
            <?php else : ?>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="Smooth Migration Logo" class="header-logo">
                </a>
            <?php endif; ?>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="primary-menu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/about-us">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/services">All Services</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/realtor-locator">Realtor Locator</a></li>
                            <li><a class="dropdown-item" href="/services#money-services">Money Services</a></li>
                            <li><a class="dropdown-item" href="/services#phone-plans">Phone Plans</a></li>
                            <li><a class="dropdown-item" href="/services#vehicles">Vehicle Services</a></li>
                            <li><a class="dropdown-item" href="/services#international-moving">International Moving</a></li>
                            <li><a class="dropdown-item" href="/services#insurance">Insurance</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/become-a-partner">Partner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ai-relocator">
                            <i class="fas fa-robot me-1"></i>
                            AI Relocation Plan
                        </a>
                    </li>
                </ul>
                
                <!-- Get in Touch CTA Button -->
                <div class="navbar-nav ms-3">
                    <a href="/contact" class="btn btn-primary btn-sm nav-cta-btn">
                        <span class="icon-glow me-2"><?php echo sm_icon('comment-dots', 'solid', ''); ?></span>
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile off-canvas menu -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileNavLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="/about-us">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/services">Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/realtor-locator">→ Realtor Locator</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/services#money-services">→ Money Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/services#phone-plans">→ Phone Plans</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/services#vehicles">→ Vehicle Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/services#international-moving">→ International Moving</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/services#insurance">→ Insurance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/become-a-partner">Partner</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/ai-relocator">
                <i class="fas fa-robot me-1"></i>
                AI Relocation Plan
            </a>
        </li>
    </ul>
    <div class="mt-3">
        <a href="/contact" class="btn btn-primary btn-sm w-100">
            <span class="icon-glow me-2"><?php echo sm_icon('comment-dots', 'solid', ''); ?></span>
            Get Started
        </a>
    </div>
  </div>
</div>

<script>
// Sticky header and top bar functionality
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('masthead');
    const navbar = header.querySelector('.navbar');
    const topBar = document.querySelector('.top-bar');
    
    function handleScroll() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
            navbar.classList.add('navbar-scrolled');
            document.body.classList.add('header-scrolled');
            // Hide top bar when scrolled
            if (topBar) {
                topBar.style.transform = 'translateY(-100%)';
            }
        } else {
            header.classList.remove('scrolled');
            navbar.classList.remove('navbar-scrolled');
            document.body.classList.remove('header-scrolled');
            // Show top bar when at top
            if (topBar) {
                topBar.style.transform = 'translateY(0)';
            }
        }
    }
    
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Check initial state
    
    // Removed forced body padding that caused a white gap under the header
});
</script> 