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
<a class="skip-link" href="#main" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">Skip to main content</a>

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
            <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'header-logo', 'alt' => '' ) );
                else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="" class="header-logo" style="height: 40px; width: auto;">
                <?php endif; ?>
                <span class="site-title ms-2" style="font-weight: 600; font-size: 1.25rem;"><?php bloginfo( 'name' ); ?></span>
            </a>
            
            <button class="navbar-toggler mobile-menu-trigger" type="button" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
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
                            <li><a class="dropdown-item" href="/service-type/banking-services/">Banking Services</a></li>
                            <li><a class="dropdown-item" href="/service-type/data-and-phone-plans/">Data and Phone Plans</a></li>
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
                        <a class="nav-link" href="/become-a-partner">Become a Partner</a>
                    </li>
                </ul>
                
                <!-- Right side utilities -->
                <div class="navbar-nav ms-3 d-flex align-items-center gap-2">
                    <button type="button" id="theme-toggle" class="btn btn-ghost btn-sm" aria-label="Toggle dark mode" title="Toggle dark mode">
                        <svg class="theme-icon sun-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5"/>
                            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                        </svg>
                        <svg class="theme-icon moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Enhanced Mobile Menu -->
<div class="mobile-menu-backdrop" id="mobileMenuBackdrop" aria-hidden="true"></div>
<nav class="mobile-menu" id="mobileNav" aria-labelledby="mobileNavLabel">
  <div class="mobile-menu-header">
    <div class="mobile-menu-brand">
      <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'mobile-logo', 'alt' => '' ) );
      else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="" class="mobile-logo">
      <?php endif; ?>
      <span class="mobile-menu-title" id="mobileNavLabel"><?php bloginfo( 'name' ); ?></span>
    </div>
    <button type="button" class="mobile-menu-close" aria-label="Close menu">
      <span class="close-line"></span>
      <span class="close-line"></span>
    </button>
  </div>
  
  <div class="mobile-menu-content">
    <ul class="mobile-menu-items">
      <li class="mobile-menu-item" style="--item-index: 0">
        <a class="mobile-menu-link" href="/about-us">
          <i class="fas fa-users"></i>
          <span>About</span>
        </a>
      </li>
      <li class="mobile-menu-item mobile-menu-group" style="--item-index: 1">
        <button class="mobile-menu-toggle" type="button" aria-expanded="false">
          <i class="fas fa-book-open"></i>
          <span>Resources</span>
          <i class="fas fa-chevron-down mobile-menu-chevron"></i>
        </button>
        <ul class="mobile-submenu">
          <li class="mobile-submenu-item" style="--item-index: 0">
            <a class="mobile-menu-link" href="/faq">FAQ</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 1">
            <a class="mobile-menu-link" href="/guides">Guides</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 2">
            <a class="mobile-menu-link" href="/case-studies">Case Studies</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 3">
            <a class="mobile-menu-link" href="/how-it-works">How it works</a>
          </li>
        </ul>
      </li>
      <li class="mobile-menu-item mobile-menu-group" style="--item-index: 2">
        <button class="mobile-menu-toggle" type="button" aria-expanded="false">
          <i class="fas fa-concierge-bell"></i>
          <span>Services</span>
          <i class="fas fa-chevron-down mobile-menu-chevron"></i>
        </button>
        <ul class="mobile-submenu">
          <li class="mobile-submenu-item" style="--item-index: 0">
            <a class="mobile-menu-link" href="/services">All Services</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 1">
            <a class="mobile-menu-link" href="/realtor-locator">Realtor Locator</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 2">
            <a class="mobile-menu-link" href="/service-type/banking-services/">Banking Services</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 3">
            <a class="mobile-menu-link" href="/service-type/data-and-phone-plans/">Data and Phone Plans</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 4">
            <a class="mobile-menu-link" href="/service-type/vehicles/">Vehicle Services</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 5">
            <a class="mobile-menu-link" href="/service-type/international-moving/">International Moving</a>
          </li>
          <li class="mobile-submenu-item" style="--item-index: 6">
            <a class="mobile-menu-link" href="/service-type/insurance/">Insurance</a>
          </li>
        </ul>
      </li>
      <li class="mobile-menu-item" style="--item-index: 3">
        <a class="mobile-menu-link" href="/ai-relocator">
          <i class="fas fa-robot"></i>
          <span>AI Relocator</span>
        </a>
      </li>
      <li class="mobile-menu-item" style="--item-index: 4">
        <a class="mobile-menu-link" href="/contact">
          <i class="fas fa-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li>
      <li class="mobile-menu-item" style="--item-index: 5">
        <a class="mobile-menu-link" href="/become-a-partner">
          <i class="fas fa-handshake"></i>
          <span>Become a Partner</span>
        </a>
      </li>
    </ul>
  </div>
  
  <div class="mobile-menu-footer">
    <button type="button" id="mobile-theme-toggle" class="mobile-theme-btn" aria-label="Toggle dark mode" title="Toggle dark mode">
      <svg class="theme-icon sun-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="5"/>
        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
      </svg>
      <svg class="theme-icon moon-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
      </svg>
      <span>Theme</span>
    </button>
  </div>
</nav>

<script>
// Enhanced header management with proper timing and error handling
(function() {
    'use strict';

    let headerManager = {
        header: null,
        navbar: null,
        topBar: null,
        resizeTimeout: null,
        isInitialized: false,
        lastTopBarHeight: 0,
        lastHeaderHeight: 0,
        lastScrollY: 0,

        init: function() {
            this.header = document.getElementById('masthead');
            this.navbar = this.header ? this.header.querySelector('.navbar') : null;
            this.topBar = document.querySelector('.top-bar');

            if (!this.header) {
                console.warn('Header element not found');
                return;
            }

            // Wait for CSS to load before calculating heights
            this.waitForCSS().then(() => {
                this.setHeaderOffsets();
                this.bindEvents();
                this.isInitialized = true;
            });
        },

        waitForCSS: function() {
            return new Promise((resolve) => {
                // Check if CSS is loaded by testing if our custom property exists
                const testEl = document.createElement('div');
                testEl.style.position = 'absolute';
                testEl.style.visibility = 'hidden';
                testEl.style.top = 'var(--sm-topbar-height, -9999px)';
                document.body.appendChild(testEl);

                function checkCSS() {
                    const computed = window.getComputedStyle(testEl);
                    const topValue = computed.getPropertyValue('top');

                    if (topValue !== '-9999px') {
                        // CSS is loaded
                        document.body.removeChild(testEl);
                        resolve();
                    } else {
                        // Wait a bit more
                        setTimeout(checkCSS, 10);
                    }
                }

                // Also set a fallback timeout in case CSS detection fails
                setTimeout(() => {
                    if (document.body.contains(testEl)) {
                        document.body.removeChild(testEl);
                        resolve();
                    }
                }, 100);

                checkCSS();
            });
        },

        setHeaderOffsets: function() {
            if (!this.header) return;

            const topBarHeight = this.topBar ? this.topBar.offsetHeight : 0;
            const headerHeight = this.header.offsetHeight;

            // Only update if values have changed to prevent unnecessary reflows
            if (topBarHeight !== this.lastTopBarHeight || headerHeight !== this.lastHeaderHeight) {
                document.documentElement.style.setProperty('--sm-topbar-height', topBarHeight + 'px');
                document.body.style.paddingTop = (topBarHeight + headerHeight) + 'px';

                this.lastTopBarHeight = topBarHeight;
                this.lastHeaderHeight = headerHeight;
            }
        },

        debounceResize: function() {
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(() => {
                this.setHeaderOffsets();
            }, 100);
        },

        bindEvents: function() {
            // Debounced resize handler
            window.addEventListener('resize', () => this.debounceResize(), { passive: true });

            // Scroll handler with throttling
            let ticking = false;
            const scrollHandler = () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        this.handleScroll();
                        ticking = false;
                    });
                    ticking = true;
                }
            };

            window.addEventListener('scroll', scrollHandler, { passive: true });
            this.handleScroll(); // Initial call

            // Dropdown positioning
            this.initDropdowns();

            // Theme toggle
            this.initThemeToggle();
        },

        handleScroll: function() {
            if (!this.header || !this.navbar) return;

            const y = window.scrollY;

            if (y > 100) {
                this.header.classList.add('scrolled');
                this.navbar.classList.add('navbar-scrolled');
                document.body.classList.add('header-scrolled');
            } else {
                this.header.classList.remove('scrolled');
                this.navbar.classList.remove('navbar-scrolled');
                document.body.classList.remove('header-scrolled');
            }

            // Direction-aware hide/show (simplified)
            const delta = y - this.lastScrollY;
            if (Math.abs(delta) > 6) {
                if (delta > 0 && !document.body.classList.contains('header-hide')) {
                    document.body.classList.add('header-hide');
                } else if (delta < 0 && document.body.classList.contains('header-hide')) {
                    document.body.classList.remove('header-hide');
                }
            }
            this.lastScrollY = y;
        },

        initDropdowns: function() {
            const dropdowns = document.querySelectorAll('.navbar-nav .dropdown');

            const positionTriangle = (dropdown) => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (!toggle || !menu) return;

                const toggleRect = toggle.getBoundingClientRect();
                const menuRect = menu.getBoundingClientRect();
                let left = (toggleRect.left + toggleRect.width / 2) - menuRect.left;
                left = Math.max(12, Math.min(left, menuRect.width - 12));
                menu.style.setProperty('--triangle-left', left + 'px');
            };

            dropdowns.forEach(dropdown => {
                positionTriangle(dropdown);
                dropdown.addEventListener('mouseenter', () => positionTriangle(dropdown), { passive: true });
                dropdown.addEventListener('focusin', () => positionTriangle(dropdown));
            });

            window.addEventListener('resize', () => {
                dropdowns.forEach(positionTriangle);
            }, { passive: true });
        },

        initThemeToggle: function() {
            const themeToggle = document.getElementById('theme-toggle');
            if (!themeToggle) return;

            const html = document.documentElement;
            const currentTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-theme', currentTheme);

            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);

                // Animation feedback
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => headerManager.init());
    } else {
        headerManager.init();
    }

    // Fallback: try to initialize after a short delay if DOMContentLoaded hasn't fired
    setTimeout(() => {
        if (!headerManager.isInitialized) {
            headerManager.init();
        }
    }, 100);
})();
</script>