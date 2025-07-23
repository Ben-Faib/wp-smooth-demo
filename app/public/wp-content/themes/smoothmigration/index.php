<?php get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        // If no content, include the "No posts found" template.
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
</main>

<?php get_footer(); ?> 