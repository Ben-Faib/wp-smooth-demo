<?php
/**
 * Template Name: Realtor Form Page
 * Description: Two-column layout – left for page content, right for Forminator realtor form.
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main" role="main">
    <section class="realtor-form-section py-5">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <?php
                    // Page title and content go here so the editor can add helpful copy.
                    while ( have_posts() ) : the_post();
                        the_title( '<h1 class="display-5 mb-4">', '</h1>' );
                        the_content();
                    endwhile;
                    ?>
                </div>
                <div class="col-lg-6">
                    <div class="realtor-form-wrapper p-4 bg-white" style="box-shadow: var(--shadow-lg); border-radius: var(--border-radius);">
                        <?php
                        // Display the Forminator form directly. Update the ID if the form changes.
                        echo do_shortcode( '[forminator_form id="387"]' );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?> 