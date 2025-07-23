<?php
/**
 * Footer template
 *
 * @package smoothmigration
 */
?>
<footer class="site-footer mt-auto">
  <div class="container text-center">
    <p class="mb-1">&copy; <?php echo date_i18n( 'Y' ); ?> Smooth Migration. <?php _e( 'All Rights Reserved', 'smoothmigration' ); ?></p>
    <nav class="my-2">
      <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class'     => 'nav justify-content-center',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => '__return_false',
        ) );
      ?>
    </nav>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 