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


