<?php
/**
 * Globe integration: registers assets, shortcode, and optional overlay toggle.
 *
 * Usage: [smooth_globe height="60vh" id="smooth-globe"]
 * Debug: add ?globe=1 to any URL to overlay the globe; add ?reduced=1 to reduce motion
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register globe assets (do not enqueue globally).
 */
function sm_globe_register_assets() {
	// Globe.gl (bundles three.js)
	wp_register_script(
		'globe-gl',
		'https://unpkg.com/globe.gl@2.30.0/globe.gl.min.js',
		array(),
		'2.30.0',
		true
	);

	// Our globe controller
	wp_register_script(
		'sm-globe',
		get_template_directory_uri() . '/assets/js/smooth-globe.js',
		array( 'globe-gl' ),
		SMOOTHMIGRATION_VERSION,
		true
	);

	// Styles
	wp_register_style(
		'sm-globe',
		get_template_directory_uri() . '/assets/css/smooth-globe.css',
		array(),
		SMOOTHMIGRATION_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'sm_globe_register_assets' );

/**
 * Shortcode renderer.
 *
 * @param array $atts
 * @return string
 */
function sm_globe_shortcode( $atts = array() ) {
	$atts = shortcode_atts( array(
		'height' => '60vh',
		'id' => 'smooth-globe',
	), $atts );

	wp_enqueue_script( 'globe-gl' );
	wp_enqueue_script( 'sm-globe' );
	wp_enqueue_style( 'sm-globe' );

	$reduced = ( isset( $_GET['reduced'] ) && $_GET['reduced'] === '1' );

	// Demo arcs and points; replace/augment with real corridors as needed.
	$data = array(
		'arcs' => array(
			array( 'startLat' => 51.5074, 'startLng' => -0.1278, 'endLat' => -33.8688, 'endLng' => 151.2093, 'colorStart' => '#7c3aed', 'colorEnd' => '#22d3ee' ),
			array( 'startLat' => 40.7128, 'startLng' => -74.0060, 'endLat' => -37.8136, 'endLng' => 144.9631, 'colorStart' => '#22c55e', 'colorEnd' => '#eab308' ),
			array( 'startLat' => 48.8566, 'startLng' => 2.3522, 'endLat' => -34.6037, 'endLng' => -58.3816, 'colorStart' => '#ef4444', 'colorEnd' => '#60a5fa' ),
		),
		'points' => array(
			array( 'lat' => 51.5074, 'lng' => -0.1278, 'name' => 'UK' ),
			array( 'lat' => -33.8688, 'lng' => 151.2093, 'name' => 'Australia' ),
			array( 'lat' => 40.7128, 'lng' => -74.0060, 'name' => 'USA' ),
			array( 'lat' => -37.8136, 'lng' => 144.9631, 'name' => 'Melbourne' ),
		),
		'reduced' => $reduced,
	);

	wp_add_inline_script( 'sm-globe', 'window.SmoothGlobeData = ' . wp_json_encode( $data ) . ';', 'before' );

	$style = 'style="height:' . esc_attr( $atts['height'] ) . ';"';

	return '<div class="smooth-globe-wrap"><div id="' . esc_attr( $atts['id'] ) . '" class="smooth-globe" ' . $style . '></div></div>';
}
add_shortcode( 'smooth_globe', 'sm_globe_shortcode' );

// Optional overlay: ?globe=1 will inject the globe at the start of <body>
add_action( 'wp_body_open', function() {
	if ( isset( $_GET['globe'] ) && $_GET['globe'] === '1' ) {
		echo do_shortcode( '[smooth_globe height="60vh"]' );
	}
}, 20 );


