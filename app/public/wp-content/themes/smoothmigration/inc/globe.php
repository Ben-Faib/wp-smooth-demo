<?php
/**
 * Smooth Globe: shortcode + asset registration
 * Stripe-globe-inspired arcs using Globe.gl (MIT) with reduced-motion support
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function sm_globe_register_assets() {
    // Core library (Three.js bundled inside globe.gl)
    wp_register_script(
        'globe-gl',
        'https://cdn.jsdelivr.net/npm/globe.gl@2.30.0/dist/globe.gl.min.js',
        array(),
        null,
        true
    );

    // Our glue script
    wp_register_script(
        'sm-globe',
        get_template_directory_uri() . '/assets/js/smooth-globe.js',
        array( 'globe-gl' ),
        ( @filemtime( get_template_directory() . '/assets/js/smooth-globe.js' ) ?: ( defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0' ) ),
        true
    );

    // Styles
    wp_register_style(
        'sm-globe',
        get_template_directory_uri() . '/assets/css/smooth-globe.css',
        array(),
        ( @filemtime( get_template_directory() . '/assets/css/smooth-globe.css' ) ?: ( defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0' ) )
    );
}
add_action( 'wp_enqueue_scripts', 'sm_globe_register_assets' );

/**
 * [smooth_globe height="60vh" id="smooth-globe"]
 */
function sm_globe_shortcode( $atts = array() ) {
    $atts = shortcode_atts( array(
        'height' => '60vh',
        'id'     => 'smooth-globe'
    ), $atts );

    // Only enqueue once per page to prevent duplicates
    static $globe_enqueued = false;
    if ( !$globe_enqueued ) {
        wp_enqueue_script( 'globe-gl' );
        wp_enqueue_script( 'sm-globe' );
        wp_enqueue_style( 'sm-globe' );
        $globe_enqueued = true;
    }

    // Example routes; replace with analytics-driven corridors later
    $arcs = array(
        array('startLat'=>51.5074,'startLng'=>-0.1278,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#7c3aed','colorEnd'=>'#22d3ee'), // UK -> AU
        array('startLat'=>40.7128,'startLng'=>-74.0060,'endLat'=>51.5074,'endLng'=>-0.1278,'colorStart'=>'#22c55e','colorEnd'=>'#eab308'), // US -> UK
        array('startLat'=>48.8566,'startLng'=>2.3522,'endLat'=>-34.6037,'endLng'=>-58.3816,'colorStart'=>'#ef4444','colorEnd'=>'#60a5fa'),   // FR -> AR
    );

    $points = array(
        array('lat'=>51.5074,'lng'=>-0.1278,'name'=>'UK'),
        array('lat'=>-33.8688,'lng'=>151.2093,'name'=>'Australia'),
        array('lat'=>40.7128,'lng'=>-74.0060,'name'=>'USA'),
        array('lat'=>48.8566,'lng'=>2.3522,'name'=>'France'),
    );

    $reduced = ( isset($_GET['reduced']) && $_GET['reduced'] === '1' );

    $data = array(
        'arcs'    => $arcs,
        'points'  => $points,
        'reduced' => $reduced,
    );

    // Only add inline script once to prevent conflicts
    static $inline_script_added = false;
    if ( !$inline_script_added ) {
        wp_add_inline_script( 'sm-globe', 'window.SmoothGlobeData = ' . wp_json_encode( $data ) . ';', 'before' );
        $inline_script_added = true;
    }

    $style = 'style="height:' . esc_attr( $atts['height'] ) . ';"';

    return '<div class="smooth-globe-wrap"><div id="' . esc_attr( $atts['id'] ) . '" class="smooth-globe" ' . $style . '></div></div>';
}
add_shortcode( 'smooth_globe', 'sm_globe_shortcode' );

// Optional overlay injection: ?globe=1 will append a globe near top of body
add_action( 'wp_body_open', function() {
    if ( isset($_GET['globe']) && $_GET['globe'] === '1' ) {
        echo do_shortcode('[smooth_globe height="60vh"]');
    }
}, 20 );


