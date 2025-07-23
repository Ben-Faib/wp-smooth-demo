<?php
/**
 * Header template
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
<header id="masthead" class="site-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smooth-migration-logo.png" alt="Smooth Migration Logo" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'depth'           => 2,
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'primary-menu',
                'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ) );
            ?>
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
  </div>
</div> 