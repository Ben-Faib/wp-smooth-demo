<?php
/**
 * Enhanced Modern Page Template
 * Provides sophisticated styling and layout for all standard pages
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main modern-page" role="main">
    <?php
    // Start the loop.
    while ( have_posts() ) :
        the_post();
        
        // Get page-specific data
        $page_title = get_the_title();
        $has_featured_image = has_post_thumbnail();
        $excerpt = get_the_excerpt();
        ?>
        
        <!-- Enhanced Page Header -->
        <section class="modern-page-header py-6 <?php echo $has_featured_image ? 'has-featured-image' : 'bg-gradient-primary'; ?> text-white position-relative overflow-hidden">
            <?php if ($has_featured_image) : ?>
                <div class="header-background">
                    <?php the_post_thumbnail('full', array('class' => 'header-bg-image')); ?>
                    <div class="header-overlay"></div>
                </div>
            <?php endif; ?>
            
            <div class="container position-relative z-2">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="page-header-content animate-on-scroll">
                            <h1 class="display-3 fw-bold mb-4"><?php echo esc_html($page_title); ?></h1>
                            <?php if ($excerpt) : ?>
                                <p class="lead fs-4 mb-4 opacity-90"><?php echo esc_html($excerpt); ?></p>
                            <?php endif; ?>
                            
                            <!-- Breadcrumb Navigation -->
                            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo home_url(); ?>" class="text-white-50">
                                            <i class="fas fa-home me-1"></i>Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active text-white" aria-current="page">
                                        <?php echo esc_html($page_title); ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Background Pattern -->
            <?php if (!$has_featured_image) : ?>
                <div class="header-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
            <?php endif; ?>
        </section>

        <!-- Page Content Section -->
        <section class="modern-page-content py-6">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                            <div class="page-content-wrapper">
                                <div class="page-content prose">
                                    <?php
                                    // Enhanced content rendering
                                    $content = get_the_content();
                                    
                                    // Apply WordPress content filters
                                    $content = apply_filters('the_content', $content);
                                    
                                    echo $content;
                                    ?>
                                </div>
                                
                                <?php
                                // Check if this is a contact-related page and add contact form
                                if (strpos(strtolower($page_title), 'contact') !== false) {
                                    echo '<div class="contact-form-section mt-5">';
                                    echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); // Adjust ID as needed
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            
                            <?php if ( comments_open() || get_comments_number() ) : ?>
                                <div class="comments-section mt-5 pt-5 border-top">
                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Pages or CTA Section -->
        <section class="page-cta py-6 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <h3 class="h2 fw-bold mb-3">Need More Information?</h3>
                            <p class="lead mb-4">Our expert team is here to help with personalized guidance and support for your relocation needs.</p>
                            <div class="cta-features d-flex flex-wrap gap-4">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="fas fa-phone-alt text-primary me-2"></i>
                                    <span>Free Consultation</span>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <span>24/7 Support</span>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <span>Expert Team</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="cta-actions">
                            <?php if (strpos(strtolower($page_title), 'contact') === false) : ?>
                                <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                                    <i class="fas fa-comments me-2"></i>
                                    Get in Touch
                                </a>
                            <?php endif; ?>
                            <a href="/become-a-partner" class="btn btn-accent btn-lg mb-3 w-100">
                                <i class="fas fa-handshake me-2"></i>
                                Become a Partner
                            </a>
                            <a href="/services" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list me-2"></i>
                                View All Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    <?php
    // End of the loop.
    endwhile;
    ?>
</main><!-- .site-main -->

<style>
/* Enhanced Modern Page Styles */
.modern-page-header {
    min-height: 50vh;
    display: flex;
    align-items: center;
    position: relative;
}

.modern-page-header.has-featured-image {
    background: transparent;
}

.header-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.header-bg-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.8), rgba(14, 116, 144, 0.8));
}

.header-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255, 255, 255, 0.6);
    font-weight: bold;
}

.breadcrumb a {
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb a:hover {
    color: white !important;
}

.page-article {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.page-content-wrapper {
    padding: 3rem;
}

.page-content.prose {
    line-height: 1.8;
    color: var(--text-medium);
}

.page-content.prose h1,
.page-content.prose h2,
.page-content.prose h3,
.page-content.prose h4,
.page-content.prose h5,
.page-content.prose h6 {
    color: var(--text-dark);
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.page-content.prose h1 {
    font-size: 2.5rem;
    border-bottom: 3px solid var(--primary-color);
    padding-bottom: 0.5rem;
    margin-bottom: 2rem;
}

.page-content.prose h2 {
    font-size: 2rem;
    color: var(--primary-color);
    position: relative;
    padding-left: 1.5rem;
}

.page-content.prose h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.3rem;
    width: 4px;
    height: 1.5rem;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.page-content.prose h3 {
    font-size: 1.5rem;
    color: var(--secondary-color);
}

.page-content.prose p {
    margin-bottom: 1.5rem;
    font-size: 1.05rem;
}

.page-content.prose ul,
.page-content.prose ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.page-content.prose li {
    margin-bottom: 0.5rem;
    line-height: 1.7;
}

.page-content.prose a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.page-content.prose a:hover {
    color: var(--primary-dark);
    border-bottom-color: var(--primary-color);
}

.page-content.prose blockquote {
    background: var(--bg-light);
    border-left: 4px solid var(--accent-color);
    padding: 1.5rem 2rem;
    margin: 2rem 0;
    border-radius: var(--border-radius-lg);
    font-style: italic;
    color: var(--text-medium);
    box-shadow: var(--shadow-sm);
}

.page-content.prose img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    margin: 2rem 0;
}

.page-content.prose table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background: var(--bg-white);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.page-content.prose th,
.page-content.prose td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-light);
}

.page-content.prose th {
    background: var(--bg-light);
    font-weight: 700;
    color: var(--text-dark);
}

.contact-form-section {
    background: var(--bg-light);
    padding: 3rem;
    border-radius: var(--border-radius-xl);
    border: 1px solid var(--border-light);
}

.comments-section {
    background: var(--bg-section);
    border-radius: var(--border-radius-xl);
    padding: 3rem;
}

.page-cta {
    background: var(--bg-light) !important;
}

.cta-features .feature-item {
    color: var(--text-medium);
    font-weight: 500;
}

.cta-features i {
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-page-header {
        min-height: 40vh;
        padding: 3rem 0;
    }
    
    .page-content-wrapper {
        padding: 2rem 1.5rem;
    }
    
    .page-content.prose h1 {
        font-size: 2rem;
    }
    
    .page-content.prose h2 {
        font-size: 1.5rem;
    }
    
    .contact-form-section,
    .comments-section {
        padding: 2rem 1.5rem;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
    }
    
    .cta-actions .btn {
        margin-bottom: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe page elements
    const elementsToAnimate = document.querySelectorAll('.page-header-content, .page-article, .page-cta');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<?php
get_footer(); 