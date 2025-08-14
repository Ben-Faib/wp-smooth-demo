<?php
/**
 * Theme Options (Admin) for data-driven stats and configuration
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register settings, sections, and fields.
 */
function smoothmigration_register_settings() {
    // Register options
    register_setting( 'smoothmigration_options', 'sm_successful_relocations', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '2500+',
    ) );
    register_setting( 'smoothmigration_options', 'sm_avg_relocation_time', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '45 days',
    ) );
    register_setting( 'smoothmigration_options', 'sm_monthly_signups', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '200+',
    ) );
    register_setting( 'smoothmigration_options', 'sm_countries_served', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '5+',
    ) );
    register_setting( 'smoothmigration_options', 'sm_default_timeline', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Typical timeline: 2–6 weeks', 'smoothmigration' ),
    ) );
    register_setting( 'smoothmigration_options', 'sm_expats_count', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
    register_setting( 'smoothmigration_options', 'sm_stats_last_updated', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );

    add_settings_section(
        'smoothmigration_stats_section',
        __( 'Homepage Statistics', 'smoothmigration' ),
        function() {
            echo '<p>' . esc_html__( 'Control the data points displayed in the homepage hero and stats blocks.', 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options'
    );

    add_settings_field(
        'sm_successful_relocations',
        __( 'Successful relocations', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_successful_relocations', '2500+' );
            echo '<input type="text" class="regular-text" name="sm_successful_relocations" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "Example: 2500+", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_avg_relocation_time',
        __( 'Average relocation time', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_avg_relocation_time', '45 days' );
            echo '<input type="text" class="regular-text" name="sm_avg_relocation_time" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "Example: 45 days", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_monthly_signups',
        __( 'Monthly families started', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_monthly_signups', '200+' );
            echo '<input type="text" class="regular-text" name="sm_monthly_signups" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "Example: 200+", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_countries_served',
        __( 'Countries served', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_countries_served', '5+' );
            echo '<input type="text" class="regular-text" name="sm_countries_served" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "Example: 5+", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_default_timeline',
        __( 'Default service timeline text', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_default_timeline', __( 'Typical timeline: 2–6 weeks', 'smoothmigration' ) );
            echo '<input type="text" class="regular-text" name="sm_default_timeline" value="' . esc_attr( $val ) . '" />';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_expats_count',
        __( 'Expats in the group (optional)', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_expats_count', '' );
            echo '<input type="text" class="regular-text" name="sm_expats_count" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "Leave blank to hide.", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );

    add_settings_field(
        'sm_stats_last_updated',
        __( 'Stats last updated (optional note)', 'smoothmigration' ),
        function() {
            $val = get_option( 'sm_stats_last_updated', '' );
            echo '<input type="text" class="regular-text" name="sm_stats_last_updated" value="' . esc_attr( $val ) . '" />';
            echo '<p class="description">' . esc_html__( "e.g., Updated Aug 2025", 'smoothmigration' ) . '</p>';
        },
        'smoothmigration_options',
        'smoothmigration_stats_section'
    );
}
add_action( 'admin_init', 'smoothmigration_register_settings' );

/**
 * Add options page under Settings.
 */
function smoothmigration_add_options_page() {
    add_options_page(
        __( 'Smooth Migration Options', 'smoothmigration' ),
        __( 'Smooth Migration', 'smoothmigration' ),
        'manage_options',
        'smoothmigration-options',
        'smoothmigration_render_options_page'
    );
}
add_action( 'admin_menu', 'smoothmigration_add_options_page' );

/**
 * Render the options page.
 */
function smoothmigration_render_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Smooth Migration Options', 'smoothmigration' ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'smoothmigration_options' );
            do_settings_sections( 'smoothmigration_options' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


