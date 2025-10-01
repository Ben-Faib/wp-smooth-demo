<?php
/**
 * Plugin Name: Smooth Migration Title Format
 * Description: Forces the document <title> to "Smooth Migration - {Context Title}" site‑wide.
 * Version: 1.0.0
 * Author: System
 */

if (!defined('ABSPATH')) {
    exit;
}

// Internal helpers
function smt_is_disabled() {
    return (defined('SM_TITLE_OFF') && SM_TITLE_OFF) || isset($_GET['sm_title_off']);
}

function smt_get_context_title($fallback) {
    $site_name = 'Smooth Migration';

    if (is_front_page() && is_home()) {
        return $site_name;
    } elseif (is_front_page()) {
        $t = get_the_title(get_queried_object_id());
        return $t !== '' ? $t : $site_name;
    } elseif (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        return $posts_page_id ? get_the_title($posts_page_id) : __('Blog');
    } elseif (is_singular()) {
        return single_post_title('', false);
    } elseif (is_search()) {
        return sprintf(__('Search results for "%s"'), get_search_query());
    } elseif (is_category() || is_tag() || is_tax()) {
        return single_term_title('', false);
    } elseif (is_post_type_archive()) {
        return post_type_archive_title('', false);
    } elseif (is_author()) {
        $author = get_queried_object();
        return $author && isset($author->display_name) ? $author->display_name : __('Author');
    } elseif (is_year()) {
        return get_the_date(_x('Y', 'yearly archives date format'));
    } elseif (is_month()) {
        return get_the_date(_x('F Y', 'monthly archives date format'));
    } elseif (is_day()) {
        return get_the_date();
    } elseif (is_404()) {
        return __('Page not found');
    }

    return $fallback ?: '';
}

function smt_build_title($context_title) {
    $site_name = 'Smooth Migration';
    $context_title = trim((string) $context_title);
    if ($context_title === '' || $context_title === $site_name) {
        return $site_name;
    }
    return $site_name . ' - ' . $context_title;
}

// 1) Final override for modern themes and many SEO plugins
add_filter('pre_get_document_title', function ($title) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000);

// 2) Adjust parts so themes that assemble titles still get the desired result
add_filter('document_title_parts', function ($parts) {
    if (smt_is_disabled()) {
        return $parts;
    }
    $context = smt_get_context_title(isset($parts['title']) ? $parts['title'] : '');
    return array(
        'title' => smt_build_title($context),
    );
}, 1000);

// 3) Keep the separator consistent for any theme still using it
add_filter('document_title_separator', function ($sep) {
    return ' - ';
}, 1000);

// 4) Legacy wp_title (older themes)
add_filter('wp_title', function ($title, $sep) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000, 2);

// 5) Popular SEO plugins specific filters (safe to exist even if plugin missing)
// Yoast SEO
add_filter('wpseo_title', function ($title) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000);

// Rank Math
add_filter('rank_math/frontend/title', function ($title) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000);

// All in One SEO
add_filter('aioseo_title', function ($title) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000);
add_filter('aioseo_title_full', function ($title) {
    if (smt_is_disabled()) {
        return $title;
    }
    return smt_build_title(smt_get_context_title($title));
}, 1000);


