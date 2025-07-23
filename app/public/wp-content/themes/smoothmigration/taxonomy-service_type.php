<?php
/**
 * The template for displaying archive pages for the "service_type" taxonomy.
 *
 * @package smoothmigration
 */

get_header();

$term = get_queried_object();
?>

<header class="page-header bg-light py-5">
    <div class="container text-center">
        <h1 class="page-title display-5 fw-bold">
            <?php echo esc_html( $term->name ); ?>
        </h1>
        <?php if ( ! empty( $term->description ) ) : ?>
            <p class="lead text-muted"><?php echo esc_html( $term->description ); ?></p>
        <?php endif; ?>
    </div>
</header>

<main id="main" class="site-main py-5" role="main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="row g-4">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-lg-12">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title h4">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <?php if ( has_excerpt() ) : ?>
                                    <p class="card-text text-muted">
                                        <?php the_excerpt(); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination( array(
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'screen_reader_text' => 'Services navigation'
            ) );
            ?>

        <?php else : ?>
            <div class="text-center">
                <p>No services have been added to this category yet.</p>
                <a href="/services" class="btn btn-primary">Return to All Services</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer(); 