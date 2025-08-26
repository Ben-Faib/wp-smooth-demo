<?php
/**
 * Guide helper functions
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Render a guide card HTML
 *
 * @param int $guide_id The guide post ID
 * @param string $type Card type ('normal', 'featured')
 * @return string HTML output
 */
function smoothmigration_render_guide_card( $guide_id, $type = 'normal' ) {
    if ( ! $guide_id ) {
        return '';
    }
    
    // Get guide data
    $guide = get_post( $guide_id );
    if ( ! $guide || $guide->post_type !== 'guide' ) {
        return '';
    }
    
    // Get meta data
    $summary = get_post_meta( $guide_id, '_guide_summary', true );
    $difficulty = get_post_meta( $guide_id, '_guide_difficulty', true );
    $duration = get_post_meta( $guide_id, '_guide_duration', true );
    $guide_type = get_post_meta( $guide_id, '_guide_type', true );
    $priority = get_post_meta( $guide_id, '_guide_priority', true );
    $coming_soon = get_post_meta( $guide_id, '_guide_coming_soon', true );
    $learning_outcomes = get_post_meta( $guide_id, '_guide_learning_outcomes', true );
    
    // Get taxonomies
    $categories = get_the_terms( $guide_id, 'guide_category' );
    $countries = get_the_terms( $guide_id, 'guide_country' );
    $timelines = get_the_terms( $guide_id, 'guide_timeline' );
    
    // Get featured image
    $thumbnail = get_the_post_thumbnail( $guide_id, 'medium' );
    
    // Determine card classes
    $card_classes = array( 'guide-card' );
    if ( $type === 'featured' ) {
        $card_classes[] = 'guide-card-featured';
    }
    if ( $coming_soon ) {
        $card_classes[] = 'guide-card-coming-soon';
    }
    
    // Get icon based on category or type
    $icon = smoothmigration_get_guide_icon( $categories, $guide_type );
    $icon_color = smoothmigration_get_guide_icon_color( $difficulty );
    
    ob_start();
    ?>
    <div class="<?php echo implode( ' ', $card_classes ); ?>" data-guide-id="<?php echo $guide_id; ?>">
        
        <?php if ( $priority && $priority !== 'Optional' ) : ?>
        <div class="priority-badge priority-<?php echo strtolower( $priority ); ?>">
            <?php echo esc_html( $priority ); ?>
        </div>
        <?php endif; ?>
        
        <div class="guide-card-header">
            <div class="guide-icon bg-<?php echo $icon_color; ?>">
                <i class="<?php echo esc_attr( $icon ); ?>"></i>
            </div>
            
            <div class="guide-meta">
                <?php if ( $difficulty ) : ?>
                <div class="guide-difficulty difficulty-<?php echo strtolower( $difficulty ); ?>">
                    <?php echo esc_html( $difficulty ); ?>
                </div>
                <?php endif; ?>
                
                <?php if ( $duration ) : ?>
                <div class="guide-duration mt-1">
                    <i class="fas fa-clock me-1"></i>
                    <?php echo esc_html( $duration ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="guide-card-body">
            <h3 class="guide-title">
                <?php echo esc_html( $guide->post_title ); ?>
            </h3>
            
            <?php if ( $summary ) : ?>
            <p class="guide-summary">
                <?php echo esc_html( wp_trim_words( $summary, 20 ) ); ?>
            </p>
            <?php elseif ( $guide->post_excerpt ) : ?>
            <p class="guide-summary">
                <?php echo esc_html( wp_trim_words( $guide->post_excerpt, 20 ) ); ?>
            </p>
            <?php endif; ?>
            
            <?php if ( $learning_outcomes && ! $coming_soon ) : ?>
            <div class="guide-learning-outcomes">
                <h6 class="outcomes-title">What You'll Learn:</h6>
                <ul class="learning-outcomes-list">
                    <?php
                    $outcomes = explode( "\n", $learning_outcomes );
                    $outcomes = array_filter( array_map( 'trim', $outcomes ) );
                    foreach ( array_slice( $outcomes, 0, 3 ) as $outcome ) {
                        echo '<li><i class="fas fa-check-circle text-' . $icon_color . ' me-1"></i>' . esc_html( $outcome ) . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if ( $coming_soon ) : ?>
            <div class="coming-soon-content">
                <div class="coming-soon-badge">
                    <i class="fas fa-clock me-2"></i>
                    Coming Soon
                </div>
                <p class="text-muted small mt-2">This comprehensive guide is being prepared by our experts and will be available soon.</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="guide-card-footer">
            <div class="guide-meta-row">
                <div class="guide-taxonomies">
                    <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                        <span class="guide-category">
                            <i class="fas fa-tag me-1"></i>
                            <?php echo esc_html( $categories[0]->name ); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $countries && ! is_wp_error( $countries ) && $countries[0]->slug !== 'global' ) : ?>
                        <span class="guide-country">
                            <i class="fas fa-globe me-1"></i>
                            <?php echo esc_html( $countries[0]->name ); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <?php if ( $guide_type ) : ?>
                <div class="guide-type">
                    <?php echo esc_html( $guide_type ); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="guide-actions">
                <?php if ( $coming_soon ) : ?>
                    <button class="btn btn-outline-secondary btn-sm flex-fill" disabled>
                        <i class="fas fa-clock me-1"></i>
                        Coming Soon
                    </button>
                    <button class="btn btn-outline-primary btn-sm" onclick="notifyWhenReady(<?php echo $guide_id; ?>)">
                        <i class="fas fa-bell"></i>
                        Notify Me
                    </button>
                <?php else : ?>
                    <a href="<?php echo get_permalink( $guide_id ); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-book-open me-1"></i>
                        Read Guide
                    </a>
                    <button class="btn btn-primary btn-sm" onclick="bookmarkGuide(<?php echo $guide_id; ?>)">
                        <i class="fas fa-bookmark"></i>
                        Save
                    </button>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Get appropriate icon for guide based on category or type
 *
 * @param array|false $categories Guide categories
 * @param string $guide_type Guide type
 * @return string Font Awesome icon class
 */
function smoothmigration_get_guide_icon( $categories, $guide_type = '' ) {
    // Icon mapping based on category
    $category_icons = array(
        'pre-move-planning' => 'fas fa-clipboard-list',
        'documentation-legal' => 'fas fa-file-contract',
        'housing-banking' => 'fas fa-home',
        'country-specific' => 'fas fa-globe-americas',
        'cultural-integration' => 'fas fa-users',
        'family-education' => 'fas fa-graduation-cap',
        'emergency-contingency' => 'fas fa-first-aid'
    );
    
    // Type-based icons
    $type_icons = array(
        'Checklist' => 'fas fa-tasks',
        'Step-by-step' => 'fas fa-list-ol',
        'Resource List' => 'fas fa-link',
        'Country Guide' => 'fas fa-flag',
        'Legal Guide' => 'fas fa-balance-scale'
    );
    
    // Check category first
    if ( $categories && ! is_wp_error( $categories ) ) {
        $category_slug = $categories[0]->slug;
        if ( isset( $category_icons[ $category_slug ] ) ) {
            return $category_icons[ $category_slug ];
        }
    }
    
    // Check type
    if ( $guide_type && isset( $type_icons[ $guide_type ] ) ) {
        return $type_icons[ $guide_type ];
    }
    
    // Default icon
    return 'fas fa-book';
}

/**
 * Get appropriate color scheme for guide based on difficulty
 *
 * @param string $difficulty Guide difficulty level
 * @return string Bootstrap color class
 */
function smoothmigration_get_guide_icon_color( $difficulty = '' ) {
    $color_map = array(
        'Beginner' => 'success',
        'Intermediate' => 'warning',
        'Advanced' => 'danger'
    );
    
    return isset( $color_map[ $difficulty ] ) ? $color_map[ $difficulty ] : 'primary';
}

/**
 * Get guide statistics for dashboard display
 *
 * @return array Guide statistics
 */
function smoothmigration_get_guide_stats() {
    $stats = array();
    
    // Total guides
    $total_guides = wp_count_posts( 'guide' );
    $stats['total'] = $total_guides->publish;
    
    // Coming soon guides
    $coming_soon = get_posts( array(
        'post_type' => 'guide',
        'meta_key' => '_guide_coming_soon',
        'meta_value' => '1',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ) );
    $stats['coming_soon'] = count( $coming_soon );
    
    // By difficulty
    $difficulties = array( 'Beginner', 'Intermediate', 'Advanced' );
    foreach ( $difficulties as $difficulty ) {
        $count = get_posts( array(
            'post_type' => 'guide',
            'meta_key' => '_guide_difficulty',
            'meta_value' => $difficulty,
            'posts_per_page' => -1,
            'fields' => 'ids'
        ) );
        $stats['difficulty'][ strtolower( $difficulty ) ] = count( $count );
    }
    
    // By category
    $categories = get_terms( array(
        'taxonomy' => 'guide_category',
        'hide_empty' => true
    ) );
    
    foreach ( $categories as $category ) {
        $stats['categories'][ $category->slug ] = $category->count;
    }
    
    return $stats;
}

/**
 * Get related guides based on categories and difficulty
 *
 * @param int $guide_id Current guide ID
 * @param int $limit Number of related guides to return
 * @return array Related guide IDs
 */
function smoothmigration_get_related_guides( $guide_id, $limit = 3 ) {
    $categories = get_the_terms( $guide_id, 'guide_category' );
    $difficulty = get_post_meta( $guide_id, '_guide_difficulty', true );
    
    $args = array(
        'post_type' => 'guide',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'post__not_in' => array( $guide_id )
    );
    
    // Add tax query if categories exist
    if ( $categories && ! is_wp_error( $categories ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'guide_category',
                'field' => 'term_id',
                'terms' => wp_list_pluck( $categories, 'term_id' )
            )
        );
    }
    
    // Prefer same difficulty level
    if ( $difficulty ) {
        $args['meta_query'] = array(
            array(
                'key' => '_guide_difficulty',
                'value' => $difficulty,
                'compare' => '='
            )
        );
    }
    
    $related_guides = get_posts( $args );
    
    // If we don't have enough related guides, get more without difficulty restriction
    if ( count( $related_guides ) < $limit && $difficulty ) {
        $remaining = $limit - count( $related_guides );
        $exclude_ids = wp_list_pluck( $related_guides, 'ID' );
        $exclude_ids[] = $guide_id;
        
        $additional_args = $args;
        unset( $additional_args['meta_query'] );
        $additional_args['posts_per_page'] = $remaining;
        $additional_args['post__not_in'] = $exclude_ids;
        
        $additional_guides = get_posts( $additional_args );
        $related_guides = array_merge( $related_guides, $additional_guides );
    }
    
    return $related_guides;
}

/**
 * Generate guide breadcrumbs
 *
 * @param int $guide_id Guide post ID
 * @return string Breadcrumb HTML
 */
function smoothmigration_get_guide_breadcrumbs( $guide_id ) {
    $breadcrumbs = array();
    $breadcrumbs[] = '<a href="' . home_url() . '">Home</a>';
    $breadcrumbs[] = '<a href="' . get_permalink( get_page_by_path( 'guides' ) ) . '">Moving Guides</a>';
    
    // Add category if exists
    $categories = get_the_terms( $guide_id, 'guide_category' );
    if ( $categories && ! is_wp_error( $categories ) ) {
        $category = $categories[0];
        $breadcrumbs[] = '<a href="' . get_term_link( $category ) . '">' . esc_html( $category->name ) . '</a>';
    }
    
    // Current guide
    $breadcrumbs[] = '<span class="current">' . get_the_title( $guide_id ) . '</span>';
    
    return '<nav class="guide-breadcrumbs"><ol class="breadcrumb">' . 
           '<li class="breadcrumb-item">' . implode( '</li><li class="breadcrumb-item">', $breadcrumbs ) . '</li>' .
           '</ol></nav>';
}

/**
 * Get guide progress for logged-in users
 *
 * @param int $guide_id Guide post ID
 * @param int $user_id User ID (optional, defaults to current user)
 * @return array Progress data
 */
function smoothmigration_get_guide_progress( $guide_id, $user_id = null ) {
    if ( ! $user_id ) {
        $user_id = get_current_user_id();
    }
    
    if ( ! $user_id ) {
        return array( 'progress' => 0, 'completed' => false );
    }
    
    $progress_key = 'guide_progress_' . $guide_id;
    $progress = get_user_meta( $user_id, $progress_key, true );
    
    return $progress ?: array( 'progress' => 0, 'completed' => false );
}

/**
 * Update guide progress for logged-in users
 *
 * @param int $guide_id Guide post ID
 * @param int $progress Progress percentage (0-100)
 * @param int $user_id User ID (optional, defaults to current user)
 * @return bool Success status
 */
function smoothmigration_update_guide_progress( $guide_id, $progress, $user_id = null ) {
    if ( ! $user_id ) {
        $user_id = get_current_user_id();
    }
    
    if ( ! $user_id ) {
        return false;
    }
    
    $progress_key = 'guide_progress_' . $guide_id;
    $progress_data = array(
        'progress' => intval( $progress ),
        'completed' => $progress >= 100,
        'last_updated' => current_time( 'mysql' )
    );
    
    return update_user_meta( $user_id, $progress_key, $progress_data );
}
