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

// Change the entire computed document title to the desired format.
add_filter('pre_get_document_title', function ($title) {
    // Allow quick disable for testing: add ?sm_title_off=1 or define('SM_TITLE_OFF', true);
    $is_disabled = (defined('SM_TITLE_OFF') && SM_TITLE_OFF) || isset($_GET['sm_title_off']);
    if ($is_disabled) {
        return $title;
    }

    $site_name = 'Smooth Migration';

    // Determine a context-appropriate page title (mirrors core logic in a simplified way)
    if (is_front_page() && is_home()) {
        // Default homepage shows latest posts
        $context_title = $site_name;
    } elseif (is_front_page()) {
        $context_title = get_the_title(get_queried_object_id());
        if ($context_title === '') {
            $context_title = $site_name;
        }
    } elseif (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        $context_title = $posts_page_id ? get_the_title($posts_page_id) : __('Blog');
    } elseif (is_singular()) {
        $context_title = single_post_title('', false);
    } elseif (is_search()) {
        $context_title = sprintf(__('Search results for "%s"'), get_search_query());
    } elseif (is_category() || is_tag() || is_tax()) {
        $context_title = single_term_title('', false);
    } elseif (is_post_type_archive()) {
        $context_title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $author = get_queried_object();
        $context_title = $author && isset($author->display_name) ? $author->display_name : __('Author');
    } elseif (is_year()) {
        $context_title = get_the_date(_x('Y', 'yearly archives date format'));
    } elseif (is_month()) {
        $context_title = get_the_date(_x('F Y', 'monthly archives date format'));
    } elseif (is_day()) {
        $context_title = get_the_date();
    } elseif (is_404()) {
        $context_title = __('Page not found');
    } else {
        // Fallback to original computed title parts minus the site name if possible
        $context_title = $title ?: '';
    }

    $context_title = trim((string) $context_title);

    if ($context_title === '' || $context_title === $site_name) {
        return $site_name;
    }

    return $site_name . ' - ' . $context_title;
}, 20);

// Ensure separator consistency for any themes/plugins that still use parts joining.
add_filter('document_title_separator', function ($sep) {
    return ' - ';
}, 20);


