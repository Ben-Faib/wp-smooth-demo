<?php
/**
 * Stats helpers and shortcodes
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a standardized stat value by logical key.
 *
 * @param string $key     Logical key (e.g., 'successful_relocations').
 * @param string $default Default value if option not set.
 * @return string
 */
function sm_get_stat( $key, $default = '' ) {
	$map = array(
		'successful_relocations' => 'sm_successful_relocations',
		'clients_helped'         => 'sm_successful_relocations', // alias
		'countries_served'       => 'sm_countries_served',
		'global_partners'        => 'sm_global_partners',
		'customer_satisfaction'  => 'sm_customer_satisfaction',
		'expats_count'           => 'sm_expats_count',
		'last_updated'           => 'sm_stats_last_updated',
	);
	$opt = isset( $map[ $key ] ) ? $map[ $key ] : $key;
	$val = get_option( $opt, $default );
	return is_string( $val ) ? $val : (string) $val;
}

/**
 * Shortcode: [sm_stat key="successful_relocations" prefix="" suffix="" default=""]
 */
function sm_stat_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'key'     => '',
			'prefix'  => '',
			'suffix'  => '',
			'default' => '',
		),
		$atts,
		'sm_stat'
	);
	if ( empty( $atts['key'] ) ) {
		return '';
	}
	$val = sm_get_stat( $atts['key'], $atts['default'] );
	if ( $val === '' ) {
		return '';
	}
	return esc_html( $atts['prefix'] . $val . $atts['suffix'] );
}
add_shortcode( 'sm_stat', 'sm_stat_shortcode' );

/**
 * Shortcode: [sm_last_updated prefix="Updated "]
 */
function sm_last_updated_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'prefix' => '',
		),
		$atts,
		'sm_last_updated'
	);
	$val = trim( (string) sm_get_stat( 'last_updated', '' ) );
	if ( $val === '' ) {
		return '';
	}
	return esc_html( $atts['prefix'] . $val );
}
add_shortcode( 'sm_last_updated', 'sm_last_updated_shortcode' );

/**
 * Shortcode: [sm_stat_item key="successful_relocations" label="Clients Helped" prefix="" suffix="" default=""]
 * Renders a .stat-item block.
 */
function sm_stat_item_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'key'     => '',
			'label'   => '',
			'prefix'  => '',
			'suffix'  => '',
			'default' => '',
		),
		$atts,
		'sm_stat_item'
	);
	if ( empty( $atts['key'] ) || empty( $atts['label'] ) ) {
		return '';
	}
	$val = sm_get_stat( $atts['key'], $atts['default'] );
	if ( $val === '' ) {
		return '';
	}
	ob_start();
	?>
	<div class="stat-item">
		<div class="stat-number"><?php echo esc_html( $atts['prefix'] . $val . $atts['suffix'] ); ?></div>
		<div class="stat-label"><?php echo esc_html( $atts['label'] ); ?></div>
	</div>
	<?php
	return trim( ob_get_clean() );
}
add_shortcode( 'sm_stat_item', 'sm_stat_item_shortcode' );


