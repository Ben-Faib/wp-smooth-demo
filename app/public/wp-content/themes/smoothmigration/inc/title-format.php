<?php
/**
 * Title formatting: Force "Smooth Migration - {Context Title}" across the site.
 * Hooks multiple filters (core + popular SEO plugins) with late priority.
 * Disable per-request with ?sm_title_off=1 or define('SM_TITLE_OFF', true).
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function sm_theme_title_is_disabled() {
    return ( defined( 'SM_TITLE_OFF' ) && SM_TITLE_OFF ) || isset( $_GET['sm_title_off'] );
}

function sm_theme_title_context( $fallback ) {
    $site_name = 'Smooth Migration';

    if ( is_front_page() && is_home() ) {
        return $site_name;
    } elseif ( is_front_page() ) {
        $t = get_the_title( get_queried_object_id() );
        return $t !== '' ? $t : $site_name;
    } elseif ( is_home() ) {
        $posts_page_id = (int) get_option( 'page_for_posts' );
        return $posts_page_id ? get_the_title( $posts_page_id ) : __( 'Blog' );
    } elseif ( is_singular() ) {
        return single_post_title( '', false );
    } elseif ( is_search() ) {
        return sprintf( __( 'Search results for "%s"' ), get_search_query() );
    } elseif ( is_category() || is_tag() || is_tax() ) {
        return single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        return post_type_archive_title( '', false );
    } elseif ( is_author() ) {
        $author = get_queried_object();
        return ( $author && isset( $author->display_name ) ) ? $author->display_name : __( 'Author' );
    } elseif ( is_year() ) {
        return get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        return get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        return get_the_date();
    } elseif ( is_404() ) {
        return __( 'Page not found' );
    }

    return $fallback ?: '';
}

function sm_theme_title_build( $context_title ) {
    $site_name    = 'Smooth Migration';
    $context_title = trim( (string) $context_title );
    if ( $context_title === '' || $context_title === $site_name ) {
        return $site_name;
    }
    return $site_name . ' - ' . $context_title;
}

// Core: final computed title
add_filter( 'pre_get_document_title', function( $title ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000 );

// Core: parts-based assembly
add_filter( 'document_title_parts', function( $parts ) {
    if ( sm_theme_title_is_disabled() ) {
        return $parts;
    }
    $context = sm_theme_title_context( isset( $parts['title'] ) ? $parts['title'] : '' );
    return array( 'title' => sm_theme_title_build( $context ) );
}, 1000 );

add_filter( 'document_title_separator', function( $sep ) {
    return ' - ';
}, 1000 );

// Legacy
add_filter( 'wp_title', function( $title, $sep ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000, 2 );

// SEO plugins
add_filter( 'wpseo_title', function( $title ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000 );

add_filter( 'rank_math/frontend/title', function( $title ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000 );

add_filter( 'aioseo_title', function( $title ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000 );

add_filter( 'aioseo_title_full', function( $title ) {
    if ( sm_theme_title_is_disabled() ) {
        return $title;
    }
    return sm_theme_title_build( sm_theme_title_context( $title ) );
}, 1000 );



