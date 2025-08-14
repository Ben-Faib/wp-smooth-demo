<?php
/**
 * Header template - Enhanced
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
<header id="masthead" class="site-header sticky-header" role="banner">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="Smooth Migration Logo" class="header-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="primary-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'depth'           => 2,
                    'container'       => false,
                    'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );
                ?>

                <?php
                // Country flags menu (Canada first via menu order in Appearance > Menus)
                if ( has_nav_menu( 'country_flags' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'country_flags',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav country-flags-menu ms-lg-3',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                }
                ?>
                
                <!-- Get in Touch CTA Button -->
                <div class="navbar-nav">
                    <a href="/contact" class="btn btn-primary btn-sm nav-cta-btn">
                        <span class="cta-icon">💬</span>
                        Get in Touch
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
    <?php
      wp_nav_menu( array(
          'theme_location'  => 'primary',
          'menu_class'      => 'nav flex-column',
          'container'       => false,
          'depth'           => 2,
          'fallback_cb'     => '__return_false',
      ) );
    ?>
    <div class="mt-3">
        <a href="/contact" class="btn btn-primary btn-sm w-100">
            <span class="cta-icon">💬</span>
            Get in Touch
        </a>
    </div>
  </div>
</div>

<script>
// Sticky header functionality
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('masthead');
    const navbar = header.querySelector('.navbar');
    
    function handleScroll() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
            navbar.classList.add('navbar-scrolled');
        } else {
            header.classList.remove('scrolled');
            navbar.classList.remove('navbar-scrolled');
        }
    }
    
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Check initial state
});
</script> 