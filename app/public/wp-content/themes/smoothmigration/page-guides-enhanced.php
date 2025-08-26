<?php
/**
 * Template Name: Enhanced Moving Guides
 * Modern, filterable guide system with search and categorization
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main guides-main" role="main">

    <!-- Enhanced Hero Section for Guides -->
    <section class="guides-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="guides-hero-content animate-on-scroll">
                        <h1 class="display-2 fw-bold mb-4">Moving Guides</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Comprehensive step-by-step guides to help you navigate every aspect of your international relocation journey.</p>
                        
                        <!-- Hero Search Bar -->
                        <div class="hero-search-wrapper mb-4">
                            <div class="hero-search-container">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control hero-search-input" id="heroGuideSearch" placeholder="Search guides, topics, or countries...">
                                    <button class="btn btn-accent" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="search-suggestions mt-3">
                                    <span class="search-suggestion-tag" data-search="pre-move planning">Pre-Move Planning</span>
                                    <span class="search-suggestion-tag" data-search="visa requirements">Visa Requirements</span>
                                    <span class="search-suggestion-tag" data-search="banking">Banking Setup</span>
                                    <span class="search-suggestion-tag" data-search="housing">Housing</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Guide Stats -->
                        <div class="guide-stats d-flex flex-wrap justify-content-center gap-3 mb-4">
                            <?php
                            $guide_count = wp_count_posts('guide')->publish;
                            $coming_soon_count = get_posts(array(
                                'post_type' => 'guide',
                                'meta_key' => '_guide_coming_soon',
                                'meta_value' => '1',
                                'posts_per_page' => -1,
                                'fields' => 'ids'
                            ));
                            $coming_soon_count = count($coming_soon_count);
                            $total_guides = $guide_count + $coming_soon_count;
                            ?>
                            <span class="badge-modern">
                                <i class="fas fa-book me-2"></i> 
                                <?php echo $guide_count; ?> Guides Available
                            </span>
                            <span class="badge-modern">
                                <i class="fas fa-clock me-2"></i> 
                                <?php echo $coming_soon_count; ?> More Coming Soon
                            </span>
                            <span class="badge-modern">
                                <i class="fas fa-globe me-2"></i> 
                                Multiple Countries
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- Advanced Filter Section -->
    <section class="guides-filter py-4 bg-light border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="filter-intro">
                        <h3 class="h5 mb-1">Find Your Guide</h3>
                        <p class="text-muted small mb-0">Filter by your specific needs</p>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="filter-controls d-flex flex-wrap gap-3">
                        <!-- Category Filter -->
                        <div class="filter-group">
                            <select class="form-select filter-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'guide_category',
                                    'hide_empty' => false
                                ));
                                foreach ($categories as $category) {
                                    echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Difficulty Filter -->
                        <div class="filter-group">
                            <select class="form-select filter-select" id="difficultyFilter">
                                <option value="">All Levels</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                        
                        <!-- Timeline Filter -->
                        <div class="filter-group">
                            <select class="form-select filter-select" id="timelineFilter">
                                <option value="">All Timelines</option>
                                <?php
                                $timelines = get_terms(array(
                                    'taxonomy' => 'guide_timeline',
                                    'hide_empty' => false
                                ));
                                foreach ($timelines as $timeline) {
                                    echo '<option value="' . esc_attr($timeline->slug) . '">' . esc_html($timeline->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Country Filter -->
                        <div class="filter-group">
                            <select class="form-select filter-select" id="countryFilter">
                                <option value="">All Countries</option>
                                <?php
                                $countries = get_terms(array(
                                    'taxonomy' => 'guide_country',
                                    'hide_empty' => false
                                ));
                                foreach ($countries as $country) {
                                    echo '<option value="' . esc_attr($country->slug) . '">' . esc_html($country->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Clear Filters -->
                        <button class="btn btn-outline-secondary btn-sm" id="clearFilters">
                            <i class="fas fa-times me-1"></i>
                            Clear All
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Guides Section -->
    <?php
    $featured_guides = new WP_Query(array(
        'post_type' => 'guide',
        'posts_per_page' => 3,
        'meta_key' => '_guide_featured',
        'meta_value' => '1',
        'post_status' => 'publish'
    ));
    
    if ($featured_guides->have_posts()) :
    ?>
    <section class="featured-guides py-5 bg-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="display-6 fw-bold mb-3">Essential Guides</h2>
                    <p class="lead text-muted">Start with these must-read guides for a successful relocation</p>
                </div>
            </div>
            <div class="row g-4">
                <?php while ($featured_guides->have_posts()) : $featured_guides->the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <?php echo smoothmigration_render_guide_card(get_the_ID(), 'featured'); ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <!-- Main Guides Grid -->
    <section class="guides-content py-6">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3">Complete Guide Library</h2>
                    <p class="lead text-muted">Everything you need to know for your international move, organized by category and difficulty level.</p>
                </div>
            </div>
            
            <!-- Results Info -->
            <div class="results-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="results-count">
                        <span id="resultsCount" class="text-muted">Loading guides...</span>
                    </div>
                    <div class="sort-controls">
                        <select class="form-select form-select-sm" id="sortGuides">
                            <option value="date">Newest First</option>
                            <option value="title">Alphabetical</option>
                            <option value="difficulty">By Difficulty</option>
                            <option value="duration">By Reading Time</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Guides Grid -->
            <div class="guides-grid" id="guidesGrid">
                <div class="row g-4" id="guidesContainer">
                    <!-- Guides will be loaded here via JavaScript -->
                </div>
                
                <!-- Loading State -->
                <div class="loading-state text-center py-5" id="loadingState">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted">Loading guides...</p>
                </div>
                
                <!-- No Results State -->
                <div class="no-results-state text-center py-5" id="noResultsState" style="display: none;">
                    <div class="empty-icon mb-4">
                        <i class="fas fa-search display-1 text-muted"></i>
                    </div>
                    <h3>No Guides Found</h3>
                    <p class="text-muted mb-4">Try adjusting your filters or search terms to find the guides you're looking for.</p>
                    <button class="btn btn-primary" id="resetFilters">
                        <i class="fas fa-rotate-right me-2"></i>
                        Show All Guides
                    </button>
                </div>
            </div>
            
            <!-- Load More -->
            <div class="load-more-container text-center mt-5" id="loadMoreContainer">
                <button class="btn btn-outline-primary btn-lg" id="loadMoreGuides">
                    <i class="fas fa-plus me-2"></i>
                    Load More Guides
                </button>
            </div>
        </div>
    </section>

    <!-- Service Integration CTA -->
    <section class="guides-service-cta py-6 bg-gradient-secondary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Need Hands-On Help?</h2>
                        <p class="lead mb-4">Our guides provide the knowledge, but sometimes you need professional assistance. Connect with our verified service partners for personalized support with your relocation needs.</p>
                        <div class="cta-features d-flex flex-wrap gap-4 mb-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-user-tie me-2"></i>
                                <span>Expert Consultation</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-handshake me-2"></i>
                                <span>Verified Partners</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-check me-2"></i>
                                <span>Quality Guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/services" class="btn btn-accent btn-lg mb-3 w-100">
                            <i class="fas fa-tools me-2"></i>
                            Browse Services
                        </a>
                        <a href="/contact" class="btn btn-outline-light w-100">
                            <i class="fas fa-comments me-2"></i>
                            Get Expert Advice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->
<?php
get_footer();
?>
