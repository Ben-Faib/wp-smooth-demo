<?php
/**
 * Optimization filters and guards for caching/LSCache.
 * - Mark critical assets as no-optimize to avoid defer/delay/combination issues
 * - Provide filter-based excludes consumable by LiteSpeed Cache
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add data-no-optimize attributes to critical scripts/styles at render time.
 * This is a belt-and-suspenders in case plugin UI excludes aren't set.
 */
add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
    $critical = array(
        'sm-globe',
        'globe-gl',
        'landing-page-js',
        'smoothmigration-js',
    );
    if ( in_array( $handle, $critical, true ) ) {
        // Avoid duplicating attributes
        if ( strpos( $tag, 'data-no-optimize' ) === false ) {
            $tag = str_replace( '<script ', '<script data-no-optimize="1" ', $tag );
        }
        // Ensure async/defer is not forced by optimizers; rely on our enqueue
        $tag = str_replace( ' defer', '', $tag );
    }
    return $tag;
}, 10, 3 );

add_filter( 'style_loader_tag', function( $html, $handle, $href, $media ) {
    $critical = array(
        'sm-globe',
        'landing-page',
        'smoothmigration-style',
        'sm-icons',
    );
    if ( in_array( $handle, $critical, true ) ) {
        if ( strpos( $html, 'data-no-optimize' ) === false ) {
            $html = str_replace( '<link ', '<link data-no-optimize="1" ', $html );
        }
    }
    return $html;
}, 10, 4 );

/**
 * Hint LiteSpeed Cache to exclude certain URIs and assets when filters are supported.
 * These filters are safely ignored by other environments.
 */
add_filter( 'litespeed_optm_excludes', function( $excludes ) {
    // Exclude homepage from over-optimization
    $excludes['uri'][] = '^/$';
    $excludes['uri'][] = '/?$';

    // Exclude critical JS and CSS paths
    $excludes['js'][]  = '/assets/js/smooth-globe.js';
    $excludes['js'][]  = '/assets/js/landing-page.js';
    $excludes['css'][] = '/assets/css/smooth-globe.css';
    $excludes['css'][] = '/assets/css/landing-page.css';

    return $excludes;
} );


