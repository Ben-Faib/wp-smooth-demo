<?php
/**
 * SEO Meta Tags for Landing Page
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add custom SEO meta tags for the front page
 */
function smoothmigration_add_landing_page_seo() {
    if ( is_front_page() ) {
        // Custom title for landing page
        add_filter( 'wp_title', 'smoothmigration_landing_page_title', 10, 2 );
        add_filter( 'document_title_parts', 'smoothmigration_landing_page_title_parts' );
        
        // Add meta description and other SEO tags
        add_action( 'wp_head', 'smoothmigration_landing_page_meta_tags', 1 );
    }
}
add_action( 'wp', 'smoothmigration_add_landing_page_seo' );

/**
 * Custom title for landing page
 */
function smoothmigration_landing_page_title( $title, $sep = '' ) {
    if ( is_front_page() ) {
        return 'International Relocation Services | Smooth Migration Global';
    }
    return $title;
}

/**
 * Custom title parts for landing page
 */
function smoothmigration_landing_page_title_parts( $title_parts ) {
    if ( is_front_page() ) {
        $title_parts['title'] = 'International Relocation Services';
        $title_parts['site'] = 'Smooth Migration Global';
    }
    return $title_parts;
}

/**
 * Add meta tags for landing page
 */
function smoothmigration_landing_page_meta_tags() {
    if ( ! is_front_page() ) {
        return;
    }
    
    $meta_description = 'Tailored, cost-effective relocation plans for individuals & companies. Housing, visas, banking, pet moves & more—expert support at every step.';
    $meta_keywords = 'international relocation, expat services, visa assistance, housing abroad, international moving, pet relocation, banking abroad, school search';
    $site_url = home_url();
    $logo_url = get_template_directory_uri() . '/assets/images/smooth-migration-logo.png';
    
    echo '<!-- SEO Meta Tags -->' . "\n";
    echo '<meta name="description" content="' . esc_attr( $meta_description ) . '">' . "\n";
    echo '<meta name="keywords" content="' . esc_attr( $meta_keywords ) . '">' . "\n";
    echo '<meta name="author" content="Smooth Migration Global">' . "\n";
    echo '<meta name="robots" content="index, follow">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $site_url ) . '">' . "\n";
    
    // Open Graph tags for social media
    echo '<!-- Open Graph Meta Tags -->' . "\n";
    echo '<meta property="og:title" content="International Relocation Services | Smooth Migration Global">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $meta_description ) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $site_url ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $logo_url ) . '">' . "\n";
    echo '<meta property="og:site_name" content="Smooth Migration Global">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";
    
    // Social preview meta (generic, no platform-specific branding)
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="International Relocation Services | Smooth Migration Global">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $meta_description ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $logo_url ) . '">' . "\n";
    
    // Additional SEO tags
    echo '<!-- Additional SEO Tags -->' . "\n";
    echo '<meta name="geo.region" content="Global">' . "\n";
    echo '<meta name="geo.placename" content="International">' . "\n";
    echo '<meta name="language" content="en">' . "\n";
    echo '<meta name="coverage" content="Worldwide">' . "\n";
    echo '<meta name="distribution" content="Global">' . "\n";
    echo '<meta name="rating" content="General">' . "\n";
    
    // Schema.org structured data
    echo '<!-- Schema.org Structured Data -->' . "\n";
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode( array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Smooth Migration Global',
        'url' => $site_url,
        'logo' => $logo_url,
        'description' => $meta_description,
        'foundingDate' => '2019',
        'serviceArea' => array(
            '@type' => 'Place',
            'name' => 'Worldwide'
        ),
        'services' => array(
            'International Relocation Services',
            'Visa Assistance',
            'Housing Services',
            'Banking Support',
            'Pet Relocation',
            'School Search',
            'Vehicle Import',
            'International Moving'
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'availableLanguage' => 'English'
        )
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
    echo '</script>' . "\n";
}

/**
 * Add breadcrumb schema for landing page sections
 */
function smoothmigration_add_breadcrumb_schema() {
    if ( ! is_front_page() ) {
        return;
    }
    
    $breadcrumbs = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url()
            ),
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'International Relocation Services',
                'item' => home_url() . '#services'
            )
        )
    );
    
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode( $breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
    echo '</script>' . "\n";
}
add_action( 'wp_head', 'smoothmigration_add_breadcrumb_schema', 20 ); 