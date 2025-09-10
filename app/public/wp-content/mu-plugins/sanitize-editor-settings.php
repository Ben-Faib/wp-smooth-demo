<?php
/*
Plugin Name: Sanitize Editor Settings
Description: Prevents invalid editor settings from causing warnings by unsetting non-array values.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'block_editor_settings_all', function ( $settings ) {
    if ( isset( $settings['fontSizes'] ) && ! is_array( $settings['fontSizes'] ) ) {
        unset( $settings['fontSizes'] );
    }
    if ( isset( $settings['colors'] ) && ! is_array( $settings['colors'] ) ) {
        unset( $settings['colors'] );
    }
    if ( isset( $settings['gradients'] ) && ! is_array( $settings['gradients'] ) ) {
        unset( $settings['gradients'] );
    }
    return $settings;
}, 5 );


