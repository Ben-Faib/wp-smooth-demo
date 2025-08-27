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

    // Immigration routes FROM various countries TO our 5 supported destinations
    $arcs = array(
        // BRAZIL -> Our countries
        array('startLat'=>-23.5505,'startLng'=>-46.6333,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#ff6b6b','colorEnd'=>'#00b894'), // Brazil -> Sydney AU
        array('startLat'=>-23.5505,'startLng'=>-46.6333,'endLat'=>40.7128,'endLng'=>-74.0060,'colorStart'=>'#ff6b6b','colorEnd'=>'#3f51b5'), // Brazil -> New York US
        array('startLat'=>-23.5505,'startLng'=>-46.6333,'endLat'=>43.6532,'endLng'=>-79.3832,'colorStart'=>'#ff6b6b','colorEnd'=>'#ffc107'), // Brazil -> Toronto CA

        // RUSSIA -> Our countries
        array('startLat'=>55.7558,'startLng'=>37.6176,'endLat'=>51.5074,'endLng'=>-0.1278,'colorStart'=>'#ff9500','colorEnd'=>'#9c27b0'), // Russia -> London UK
        array('startLat'=>55.7558,'startLng'=>37.6176,'endLat'=>-26.2041,'endLng'=>28.0473,'colorStart'=>'#ff9500','colorEnd'=>'#4caf50'), // Russia -> Johannesburg ZA

        // JAPAN -> Our countries (enhanced Australia paths)
        array('startLat'=>35.6762,'startLng'=>139.6503,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#ff1493','colorEnd'=>'#00b894'), // Japan -> Sydney AU (primary)
        array('startLat'=>35.6762,'startLng'=>139.6503,'endLat'=>-37.8136,'endLng'=>144.9631,'colorStart'=>'#ff1493','colorEnd'=>'#00b894'), // Japan -> Melbourne AU
        array('startLat'=>35.6762,'startLng'=>139.6503,'endLat'=>43.6532,'endLng'=>-79.3832,'colorStart'=>'#ff1493','colorEnd'=>'#ffc107'), // Japan -> Toronto CA

        // INDIA -> Our countries
        array('startLat'=>28.6139,'startLng'=>77.2090,'endLat'=>51.5074,'endLng'=>-0.1278,'colorStart'=>'#ff6347','colorEnd'=>'#9c27b0'), // India -> London UK
        array('startLat'=>28.6139,'startLng'=>77.2090,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#ff6347','colorEnd'=>'#00b894'), // India -> Sydney AU
        array('startLat'=>28.6139,'startLng'=>77.2090,'endLat'=>40.7128,'endLng'=>-74.0060,'colorStart'=>'#ff6347','colorEnd'=>'#3f51b5'), // India -> New York US

        // CHINA -> Our countries (enhanced Australia focus)
        array('startLat'=>39.9042,'startLng'=>116.4074,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#ff4500','colorEnd'=>'#00b894'), // China -> Sydney AU (primary)
        array('startLat'=>39.9042,'startLng'=>116.4074,'endLat'=>-37.8136,'endLng'=>144.9631,'colorStart'=>'#ff4500','colorEnd'=>'#00b894'), // China -> Melbourne AU
        array('startLat'=>39.9042,'startLng'=>116.4074,'endLat'=>51.5074,'endLng'=>-0.1278,'colorStart'=>'#ff4500','colorEnd'=>'#9c27b0'), // China -> London UK

        // MEXICO -> Our countries
        array('startLat'=>19.4326,'startLng'=>-99.1332,'endLat'=>40.7128,'endLng'=>-74.0060,'colorStart'=>'#32cd32','colorEnd'=>'#3f51b5'), // Mexico -> New York US
        array('startLat'=>19.4326,'startLng'=>-99.1332,'endLat'=>34.0522,'endLng'=>-118.2437,'colorStart'=>'#32cd32','colorEnd'=>'#3f51b5'), // Mexico -> Los Angeles US
        array('startLat'=>19.4326,'startLng'=>-99.1332,'endLat'=>-26.2041,'endLng'=>28.0473,'colorStart'=>'#32cd32','colorEnd'=>'#4caf50'), // Mexico -> Johannesburg ZA

        // GERMANY -> Our countries
        array('startLat'=>52.5200,'startLng'=>13.4050,'endLat'=>51.5074,'endLng'=>-0.1278,'colorStart'=>'#ffd700','colorEnd'=>'#9c27b0'), // Germany -> London UK
        array('startLat'=>52.5200,'startLng'=>13.4050,'endLat'=>45.5017,'endLng'=>-73.5673,'colorStart'=>'#ffd700','colorEnd'=>'#ffc107'), // Germany -> Montreal CA

        // FRANCE -> Our countries
        array('startLat'=>48.8566,'startLng'=>2.3522,'endLat'=>43.6532,'endLng'=>-79.3832,'colorStart'=>'#87ceeb','colorEnd'=>'#ffc107'), // France -> Toronto CA
        array('startLat'=>48.8566,'startLng'=>2.3522,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#87ceeb','colorEnd'=>'#00b894'), // France -> Sydney AU
        array('startLat'=>48.8566,'startLng'=>2.3522,'endLat'=>40.7128,'endLng'=>-74.0060,'colorStart'=>'#87ceeb','colorEnd'=>'#3f51b5'), // France -> New York US

        // Cross-migrations between our supported countries (secondary)
        array('startLat'=>51.5074,'startLng'=>-0.1278,'endLat'=>-33.8688,'endLng'=>151.2093,'colorStart'=>'#9c27b0','colorEnd'=>'#00b894'), // UK -> AU
        array('startLat'=>-33.8688,'startLng'=>151.2093,'endLat'=>43.6532,'endLng'=>-79.3832,'colorStart'=>'#00b894','colorEnd'=>'#ffc107'), // AU -> CA
        array('startLat'=>40.7128,'startLng'=>-74.0060,'endLat'=>-26.2041,'endLng'=>28.0473,'colorStart'=>'#3f51b5','colorEnd'=>'#4caf50'), // US -> ZA
    );

    $points = array(
        // Our 5 supported countries - multiple nodes for visibility
        array('lat'=>51.5074,'lng'=>-0.1278,'name'=>'London, UK','code'=>'GB','color'=>'#9c27b0','flag'=>'🇬🇧','services'=>'Banking, Legal, Property, Immigration','size'=>0.25),
        array('lat'=>55.8642,'lng'=>-4.2518,'name'=>'Glasgow, UK','code'=>'GB','color'=>'#9c27b0','flag'=>'🇬🇧','services'=>'Banking, Legal, Property, Immigration','size'=>0.20),

        array('lat'=>-33.8688,'lng'=>151.2093,'name'=>'Sydney, AU','code'=>'AU','color'=>'#00b894','flag'=>'🇦🇺','services'=>'Property, Banking, Education, Healthcare','size'=>0.25),
        array('lat'=>-37.8136,'lng'=>144.9631,'name'=>'Melbourne, AU','code'=>'AU','color'=>'#00b894','flag'=>'🇦🇺','services'=>'Property, Banking, Education, Healthcare','size'=>0.20),

        array('lat'=>40.7128,'lng'=>-74.0060,'name'=>'New York, USA','code'=>'US','color'=>'#3f51b5','flag'=>'🇺🇸','services'=>'Banking, Insurance, Vehicles, Business','size'=>0.25),
        array('lat'=>34.0522,'lng'=>-118.2437,'name'=>'Los Angeles, USA','code'=>'US','color'=>'#3f51b5','flag'=>'🇺🇸','services'=>'Banking, Insurance, Vehicles, Business','size'=>0.20),

        array('lat'=>43.6532,'lng'=>-79.3832,'name'=>'Toronto, CA','code'=>'CA','color'=>'#ffc107','flag'=>'🇨🇦','services'=>'Healthcare, Banking, Education, Immigration','size'=>0.25),
        array('lat'=>45.5017,'lng'=>-73.5673,'name'=>'Montreal, CA','code'=>'CA','color'=>'#ffc107','flag'=>'🇨🇦','services'=>'Healthcare, Banking, Education, Immigration','size'=>0.20),

        array('lat'=>-26.2041,'lng'=>28.0473,'name'=>'Johannesburg, ZA','code'=>'ZA','color'=>'#4caf50','flag'=>'🇿🇦','services'=>'Business, Banking, Property, Legal','size'=>0.25),
        array('lat'=>-33.9249,'lng'=>18.4241,'name'=>'Cape Town, ZA','code'=>'ZA','color'=>'#4caf50','flag'=>'🇿🇦','services'=>'Business, Banking, Property, Legal','size'=>0.20),

        // Source countries (smaller nodes)
        array('lat'=>-23.5505,'lng'=>-46.6333,'name'=>'São Paulo','code'=>'BR','color'=>'#666666','flag'=>'🇧🇷','size'=>0.12),
        array('lat'=>55.7558,'lng'=>37.6176,'name'=>'Moscow','code'=>'RU','color'=>'#666666','flag'=>'🇷🇺','size'=>0.12),
        array('lat'=>35.6762,'lng'=>139.6503,'name'=>'Tokyo','code'=>'JP','color'=>'#666666','flag'=>'🇯🇵','size'=>0.12),
        array('lat'=>28.6139,'lng'=>77.2090,'name'=>'Delhi','code'=>'IN','color'=>'#666666','flag'=>'🇮🇳','size'=>0.12),
        array('lat'=>39.9042,'lng'=>116.4074,'name'=>'Beijing','code'=>'CN','color'=>'#666666','flag'=>'🇨🇳','size'=>0.12),
        array('lat'=>19.4326,'lng'=>-99.1332,'name'=>'Mexico City','code'=>'MX','color'=>'#666666','flag'=>'🇲🇽','size'=>0.12),
        array('lat'=>52.5200,'lng'=>13.4050,'name'=>'Berlin','code'=>'DE','color'=>'#666666','flag'=>'🇩🇪','size'=>0.12),
        array('lat'=>48.8566,'lng'=>2.3522,'name'=>'Paris','code'=>'FR','color'=>'#666666','flag'=>'🇫🇷','size'=>0.12),
    );

    $reduced = ( isset($_GET['reduced']) && $_GET['reduced'] === '1' );
    $show_dots = !isset($_GET['no_dots']); // Allow disabling animated dots with ?no_dots=1

    $data = array(
        'arcs'      => $arcs,
        'points'    => $points,
        'reduced'   => $reduced,
        'show_dots' => $show_dots,
    );

    // Only add inline script once to prevent conflicts
    static $inline_script_added = false;
    if ( !$inline_script_added ) {
        wp_add_inline_script( 'sm-globe', 'window.SmoothGlobeData = ' . wp_json_encode( $data ) . ';', 'before' );
        $inline_script_added = true;
    }

    $style = 'style="height:' . esc_attr( $atts['height'] ) . ';"';

    // Add debug info if requested
    $debug_info = '';
    if (isset($_GET['globe_debug']) && $_GET['globe_debug'] === '1') {
        $debug_info = '<div style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.8);color:white;padding:10px;border-radius:5px;font-size:12px;z-index:1000;max-width:300px;">';
        $debug_info .= '<strong>Globe Debug Info:</strong><br>';
        $debug_info .= 'Points: ' . count($points) . '<br>';
        $debug_info .= 'Arcs: ' . count($arcs) . '<br>';
        $debug_info .= 'Reduced: ' . ($reduced ? 'Yes' : 'No') . '<br>';
        $debug_info .= 'Show Dots: ' . ($show_dots ? 'Yes' : 'No') . '<br>';
        $debug_info .= '</div>';
    }

    return '<div class="smooth-globe-wrap">' . $debug_info . '<div id="' . esc_attr( $atts['id'] ) . '" class="smooth-globe" ' . $style . '></div></div>';
}
add_shortcode( 'smooth_globe', 'sm_globe_shortcode' );

// Optional overlay injection: ?globe=1 will append a globe near top of body
add_action( 'wp_body_open', function() {
    if ( isset($_GET['globe']) && $_GET['globe'] === '1' ) {
        echo do_shortcode('[smooth_globe height="60vh"]');
    }
}, 20 );


