<?php
/**
 * Template for displaying the Form Test Page
 *
 * @package smoothmigration
 */

get_header(); ?>

<main class="site-main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class="container my-5">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5' ); ?>>
                <header class="entry-header mb-4">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="comments-section mt-5">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>
        </div>
        
    <?php endwhile; else : ?>
        
        <div class="container my-5">
            <p><?php _e( 'No content found.', 'smoothmigration' ); ?></p>
        </div>
        
    <?php endif; ?>
</main>

<?php get_footer(); ?> 