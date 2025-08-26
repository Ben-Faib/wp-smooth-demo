<?php
/**
 * Demo content creation for guides
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Create sample guides for demonstration
 */
function smoothmigration_create_sample_guides() {
    $sample_guides = array(
        array(
            'title' => 'Pre-Move Checklist: 90 Days Out',
            'content' => 'A comprehensive checklist to help you prepare for your international move starting 3 months before departure.',
            'meta' => array(
                '_guide_summary' => 'Essential planning steps to take 90 days before your international move to ensure nothing is forgotten.',
                '_guide_difficulty' => 'Beginner',
                '_guide_duration' => '15 min read',
                '_guide_type' => 'Checklist',
                '_guide_priority' => 'Essential',
                '_guide_featured' => '1',
                '_guide_learning_outcomes' => "Create a realistic timeline for your move\nIdentify all documents you'll need\nPlan your budget and financial transfers\nResearch housing options in your destination\nUnderstand visa and legal requirements",
                '_guide_who_for' => 'Anyone planning an international relocation who wants to stay organized and avoid last-minute stress.',
                '_guide_next_steps' => 'After completing this checklist, focus on securing your visa and booking temporary accommodation.'
            ),
            'categories' => array('Pre-Move Planning'),
            'countries' => array('Global'),
            'timeline' => array('Pre-Move')
        ),
        array(
            'title' => 'Opening Your First US Bank Account',
            'content' => 'Step-by-step guide to opening a bank account in the United States as a new resident or immigrant.',
            'meta' => array(
                '_guide_summary' => 'Learn exactly what documents you need and which banks are most welcoming to new US residents.',
                '_guide_difficulty' => 'Intermediate',
                '_guide_duration' => '20 min read',
                '_guide_type' => 'Step-by-step',
                '_guide_priority' => 'Essential',
                '_guide_featured' => '1',
                '_guide_learning_outcomes' => "Understand different types of US bank accounts\nKnow exactly which documents to bring\nCompare fees and benefits of major banks\nAvoid common mistakes that delay account opening\nSet up online banking and mobile apps",
                '_guide_who_for' => 'New US residents, immigrants, and international students who need to establish banking relationships.',
                '_guide_next_steps' => 'Once your account is open, set up direct deposit and explore credit-building options.'
            ),
            'categories' => array('Housing & Banking'),
            'countries' => array('United States'),
            'timeline' => array('First Month')
        ),
        array(
            'title' => 'UK Visa Requirements Guide 2024',
            'content' => 'Complete guide to UK visa types, requirements, and application processes for different categories of applicants.',
            'meta' => array(
                '_guide_summary' => 'Navigate the complex UK visa system with confidence using our comprehensive guide to requirements and processes.',
                '_guide_difficulty' => 'Advanced',
                '_guide_duration' => '30 min read',
                '_guide_type' => 'Legal Guide',
                '_guide_priority' => 'Essential',
                '_guide_learning_outcomes' => "Identify the correct visa type for your situation\nUnderstand processing times and costs\nPrepare all required documentation\nAvoid common application mistakes\nKnow your rights and obligations",
                '_guide_who_for' => 'Anyone planning to move to the UK for work, study, family reunification, or business.',
                '_guide_next_steps' => 'Book your visa appointment and begin gathering supporting documents.'
            ),
            'categories' => array('Documentation & Legal'),
            'countries' => array('United Kingdom'),
            'timeline' => array('Pre-Move')
        ),
        array(
            'title' => 'Finding Housing: Rentals vs. Buying',
            'content' => 'Compare the pros and cons of renting versus buying property in your new country.',
            'meta' => array(
                '_guide_summary' => 'Make an informed decision about housing by understanding the rental and purchase markets in your destination.',
                '_guide_difficulty' => 'Intermediate',
                '_guide_duration' => '25 min read',
                '_guide_type' => 'Resource List',
                '_guide_priority' => 'Recommended',
                '_guide_featured' => '1',
                '_guide_learning_outcomes' => "Understand rental market dynamics\nLearn about mortgage options for newcomers\nCalculate true costs of renting vs buying\nIdentify safe neighborhoods and good schools\nKnow your tenant and buyer rights",
                '_guide_who_for' => 'Individuals and families planning to relocate who need to make housing decisions.',
                '_guide_next_steps' => 'Contact local real estate agents and schedule virtual property tours.'
            ),
            'categories' => array('Housing & Banking'),
            'countries' => array('Global'),
            'timeline' => array('Pre-Move')
        ),
        array(
            'title' => 'Cultural Integration: Your First 30 Days',
            'content' => 'Essential tips for adapting to your new culture and building social connections.',
            'meta' => array(
                '_guide_summary' => 'Practical advice for navigating cultural differences and making meaningful connections in your new country.',
                '_guide_difficulty' => 'Beginner',
                '_guide_duration' => '10 min read',
                '_guide_type' => 'Step-by-step',
                '_guide_priority' => 'Recommended',
                '_guide_learning_outcomes' => "Understand local customs and etiquette\nFind community groups and social activities\nNavigate workplace culture differences\nBuild a local support network\nManage culture shock effectively",
                '_guide_who_for' => 'New arrivals who want to integrate successfully into their new community.',
                '_guide_next_steps' => 'Join local expat groups and sign up for community activities or language classes.'
            ),
            'categories' => array('Cultural Integration'),
            'countries' => array('Global'),
            'timeline' => array('First Month')
        ),
        array(
            'title' => 'Canadian Healthcare System Guide',
            'content' => 'Understanding how to access healthcare in Canada as a new resident.',
            'meta' => array(
                '_guide_summary' => 'Learn how to register for health insurance and access medical care in Canada.',
                '_guide_difficulty' => 'Intermediate',
                '_guide_duration' => '20 min read',
                '_guide_type' => 'Country Guide',
                '_guide_priority' => 'Essential',
                '_guide_coming_soon' => '1',
                '_guide_learning_outcomes' => "Apply for provincial health insurance\nFind family doctors and specialists\nUnderstand wait times and private options\nAccess emergency and urgent care\nNavigate prescription drug coverage",
                '_guide_who_for' => 'New Canadian residents and immigrants who need to understand the healthcare system.',
                '_guide_next_steps' => 'Apply for your health card and register with a family doctor.'
            ),
            'categories' => array('Country-Specific'),
            'countries' => array('Canada'),
            'timeline' => array('First Month')
        )
    );

    foreach ($sample_guides as $guide_data) {
        // Check if guide already exists
        $existing = get_posts(array(
            'title' => $guide_data['title'],
            'post_type' => 'guide',
            'post_status' => 'any',
            'posts_per_page' => 1,
            'fields' => 'ids'
        ));

        if (!empty($existing)) {
            continue; // Skip if already exists
        }

        // Create the guide post
        $post_id = wp_insert_post(array(
            'post_title' => $guide_data['title'],
            'post_content' => $guide_data['content'],
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'guide',
            'post_excerpt' => $guide_data['meta']['_guide_summary'] ?? ''
        ));

        if ($post_id && !is_wp_error($post_id)) {
            // Add meta data
            foreach ($guide_data['meta'] as $key => $value) {
                update_post_meta($post_id, $key, $value);
            }

            // Add categories
            if (!empty($guide_data['categories'])) {
                $category_ids = array();
                foreach ($guide_data['categories'] as $category_name) {
                    $term = get_term_by('name', $category_name, 'guide_category');
                    if ($term) {
                        $category_ids[] = $term->term_id;
                    }
                }
                if (!empty($category_ids)) {
                    wp_set_object_terms($post_id, $category_ids, 'guide_category');
                }
            }

            // Add countries
            if (!empty($guide_data['countries'])) {
                $country_ids = array();
                foreach ($guide_data['countries'] as $country_name) {
                    $term = get_term_by('name', $country_name, 'guide_country');
                    if ($term) {
                        $country_ids[] = $term->term_id;
                    }
                }
                if (!empty($country_ids)) {
                    wp_set_object_terms($post_id, $country_ids, 'guide_country');
                }
            }

            // Add timeline
            if (!empty($guide_data['timeline'])) {
                $timeline_ids = array();
                foreach ($guide_data['timeline'] as $timeline_name) {
                    $term = get_term_by('name', $timeline_name, 'guide_timeline');
                    if ($term) {
                        $timeline_ids[] = $term->term_id;
                    }
                }
                if (!empty($timeline_ids)) {
                    wp_set_object_terms($post_id, $timeline_ids, 'guide_timeline');
                }
            }

            // Add featured image if available
            $guide_thumbnails = array(
                'Pre-Move Checklist: 90 Days Out' => 'checklist-planning.jpg',
                'Opening Your First US Bank Account' => 'us-banking.jpg',
                'UK Visa Requirements Guide 2024' => 'uk-visa.jpg',
                'Finding Housing: Rentals vs. Buying' => 'housing-search.jpg',
                'Cultural Integration: Your First 30 Days' => 'cultural-integration.jpg',
                'Canadian Healthcare System Guide' => 'canada-healthcare.jpg'
            );

            if (isset($guide_thumbnails[$guide_data['title']])) {
                // You could add logic here to set featured images if you have them
            }
        }
    }
}

/**
 * Create additional "coming soon" guides to show the full system
 */
function smoothmigration_create_coming_soon_guides() {
    $coming_soon_guides = array(
        array(
            'title' => 'International Tax Planning for Expats',
            'category' => 'Documentation & Legal',
            'difficulty' => 'Advanced',
            'duration' => '45 min read',
            'type' => 'Legal Guide',
            'priority' => 'Essential'
        ),
        array(
            'title' => 'Moving with Pets: Complete Guide',
            'category' => 'Family & Education',
            'difficulty' => 'Intermediate',
            'duration' => '30 min read',
            'type' => 'Step-by-step',
            'priority' => 'Recommended'
        ),
        array(
            'title' => 'Emergency Preparedness Abroad',
            'category' => 'Emergency & Contingency',
            'difficulty' => 'Beginner',
            'duration' => '15 min read',
            'type' => 'Checklist',
            'priority' => 'Essential'
        ),
        array(
            'title' => 'German Work Visa Application Guide',
            'category' => 'Documentation & Legal',
            'difficulty' => 'Advanced',
            'duration' => '35 min read',
            'type' => 'Country Guide',
            'priority' => 'Essential'
        ),
        array(
            'title' => 'School Systems Comparison: US vs UK vs Canada',
            'category' => 'Family & Education',
            'difficulty' => 'Intermediate',
            'duration' => '25 min read',
            'type' => 'Resource List',
            'priority' => 'Recommended'
        )
    );

    foreach ($coming_soon_guides as $guide_data) {
        // Check if guide already exists
        $existing = get_posts(array(
            'title' => $guide_data['title'],
            'post_type' => 'guide',
            'post_status' => 'any',
            'posts_per_page' => 1,
            'fields' => 'ids'
        ));

        if (!empty($existing)) {
            continue; // Skip if already exists
        }

        // Create the guide post
        $post_id = wp_insert_post(array(
            'post_title' => $guide_data['title'],
            'post_content' => 'This comprehensive guide is being prepared by our experts and will be available soon. It will provide detailed information and step-by-step instructions.',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'guide',
            'post_excerpt' => 'Coming soon - this guide is being prepared by our relocation experts.'
        ));

        if ($post_id && !is_wp_error($post_id)) {
            // Add meta data
            update_post_meta($post_id, '_guide_coming_soon', '1');
            update_post_meta($post_id, '_guide_difficulty', $guide_data['difficulty']);
            update_post_meta($post_id, '_guide_duration', $guide_data['duration']);
            update_post_meta($post_id, '_guide_type', $guide_data['type']);
            update_post_meta($post_id, '_guide_priority', $guide_data['priority']);
            update_post_meta($post_id, '_guide_summary', 'This comprehensive guide is being prepared by our experts and will be available soon.');

            // Add category
            $category_term = get_term_by('name', $guide_data['category'], 'guide_category');
            if ($category_term) {
                wp_set_object_terms($post_id, array($category_term->term_id), 'guide_category');
            }

            // Add global country
            $global_term = get_term_by('name', 'Global', 'guide_country');
            if ($global_term) {
                wp_set_object_terms($post_id, array($global_term->term_id), 'guide_country');
            }

            // Add pre-move timeline
            $premove_term = get_term_by('name', 'Pre-Move', 'guide_timeline');
            if ($premove_term) {
                wp_set_object_terms($post_id, array($premove_term->term_id), 'guide_timeline');
            }
        }
    }
}

/**
 * Run guide demo content creation
 */
function smoothmigration_setup_guide_demo_content() {
    // Only run if we don't have any guides yet
    $existing_guides = get_posts(array(
        'post_type' => 'guide',
        'posts_per_page' => 1,
        'post_status' => 'any',
        'fields' => 'ids'
    ));
    
    if (empty($existing_guides)) {
        smoothmigration_create_sample_guides();
        smoothmigration_create_coming_soon_guides();
    }
}

// Run after theme switch or when terms are created
add_action('smoothmigration_guide_terms_created', 'smoothmigration_setup_guide_demo_content');
add_action('after_switch_theme', 'smoothmigration_setup_guide_demo_content', 20);

/**
 * Trigger guide demo content creation after terms are set up
 */
function smoothmigration_trigger_guide_demo_content() {
    // Ensure terms exist first
    $categories = get_terms(array('taxonomy' => 'guide_category', 'hide_empty' => false));
    if (!empty($categories)) {
        do_action('smoothmigration_guide_terms_created');
    }
}
add_action('init', 'smoothmigration_trigger_guide_demo_content', 25);
