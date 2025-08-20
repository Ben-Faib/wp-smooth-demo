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

<!-- Top Bar -->
<div class="top-bar">
    <div class="container d-flex justify-content-end align-items-center py-1 small">
        <?php if ( defined( 'SM_RLC_ENABLED' ) && SM_RLC_ENABLED ) { get_template_part( 'template-parts/region-language' ); } ?>
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
            
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="primary-menu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/about-us">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Resources
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="resourcesDropdown">
                            <li><a class="dropdown-item" href="/faq">FAQ</a></li>
                            <li><a class="dropdown-item" href="/guides">Guides</a></li>
                            <li><a class="dropdown-item" href="/case-studies">Case Studies</a></li>
                            <li><a class="dropdown-item" href="/how-it-works">How it works</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/services">All Services</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/realtor-locator">Realtor Locator</a></li>
                            <li><a class="dropdown-item" href="/service-type/money-services/">Money Services</a></li>
                            <li><a class="dropdown-item" href="/service-type/telecommunication/">Phone Plans</a></li>
                            <li><a class="dropdown-item" href="/service-type/vehicles/">Vehicle Services</a></li>
                            <li><a class="dropdown-item" href="/service-type/international-moving/">International Moving</a></li>
                            <li><a class="dropdown-item" href="/service-type/insurance/">Insurance</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ai-relocator">
                            <i class="fas fa-robot me-1"></i>
                            AI Relocator
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/become-a-partner">Want to Affiliate?</a>
                    </li>
                </ul>
                
                <!-- Right side utilities (reserved) -->
                <div class="navbar-nav ms-3 d-flex align-items-center gap-2"></div>
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
            <span class="nav-link disabled">Resources</span>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/faq">→ FAQ</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/guides">→ Guides</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/case-studies">→ Case Studies</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/how-it-works">→ How it works</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/services">Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/realtor-locator">→ Realtor Locator</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/service-type/money-services/">→ Money Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/service-type/telecommunication/">→ Phone Plans</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/service-type/vehicles/">→ Vehicle Services</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/service-type/international-moving/">→ International Moving</a>
        </li>
        <li class="nav-item ps-3">
            <a class="nav-link small" href="/service-type/insurance/">→ Insurance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/ai-relocator">
                <i class="fas fa-robot me-1"></i>
                AI Relocator
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/contact">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/become-a-partner">Want to Affiliate?</a>
        </li>
    </ul>
    <!-- Removed mobile Get Started button -->
  </div>
</div>

<script>
// Sticky header and top bar functionality (class-based, direction-aware)
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('masthead');
    const navbar = header.querySelector('.navbar');
    const topBar = document.querySelector('.top-bar');

    function setTopBarHeightVar() {
        const height = topBar ? topBar.offsetHeight : 0;
        document.documentElement.style.setProperty('--sm-topbar-height', height + 'px');
    }
    setTopBarHeightVar();
    window.addEventListener('resize', setTopBarHeightVar, { passive: true });

    let lastY = window.scrollY;
    let lock = null; // null | 'up' | 'down'
    function onScroll() {
        const y = window.scrollY;

        if (y > 100) {
            header.classList.add('scrolled');
            navbar.classList.add('navbar-scrolled');
            document.body.classList.add('header-scrolled');
        } else {
            header.classList.remove('scrolled');
            navbar.classList.remove('navbar-scrolled');
            document.body.classList.remove('header-scrolled');
        }

        const delta = y - lastY;
        if (Math.abs(delta) > 6) {
            if (delta > 0 && lock !== 'down') {
                document.body.classList.add('header-hide');
                lock = 'down';
            } else if (delta < 0 && lock !== 'up') {
                document.body.classList.remove('header-hide');
                lock = 'up';
            }
            lastY = y;
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
});
</script>