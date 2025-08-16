<?php
/**
 * Icon utilities: Font Awesome helpers, Lordicon & Lottie shortcodes.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Lordicon & Lottie web components (from CDN) and preconnects.
 */
function sm_register_icon_components() {
    // Keep CDN for web component runtime only; JSON assets are self-hosted
    wp_register_script( 'lordicon', 'https://cdn.lordicon.com/lordicon.js', array(), null, true );
    wp_register_script( 'lottie-player', 'https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player@latest/dist/lottie-player.js', array(), null, true );
}
add_action( 'init', 'sm_register_icon_components' );

/**
 * Conditionally enqueue animation libraries when used via content.
 */
function sm_enqueue_icon_libs_conditionally() {
    $needs_lordicon = false;
    $needs_lottie   = false;

    if ( is_singular() ) {
        $post = get_post();
        if ( $post ) {
            $html = isset( $post->post_content ) ? $post->post_content : '';
            if ( has_shortcode( $html, 'lordicon' ) || strpos( $html, '<lord-icon' ) !== false ) {
                $needs_lordicon = true;
            }
            if ( has_shortcode( $html, 'lottie' ) || strpos( $html, '<lottie-player' ) !== false ) {
                $needs_lottie = true;
            }
        }
    }

    if ( $needs_lordicon ) {
        wp_enqueue_script( 'lordicon' );
    }
    if ( $needs_lottie ) {
        wp_enqueue_script( 'lottie-player' );
    }
}
add_action( 'wp_enqueue_scripts', 'sm_enqueue_icon_libs_conditionally' );

/**
 * Helper to output a Font Awesome 6 icon.
 *
 * @param string $name   Icon name (without leading fa-).
 * @param string $style  One of: solid, regular, brands.
 * @param string $classes Extra classes for sizing/color.
 * @return string HTML for the icon.
 */
function sm_icon( $name, $style = 'solid', $classes = '' ) {
    $style = in_array( $style, array( 'solid', 'regular', 'brands' ), true ) ? $style : 'solid';
    $name  = preg_replace( '/^fa-/', '', (string) $name );
    $class = sprintf( 'fa-%s fa-%s', $style, $name );
    return sprintf( '<i class="%s %s" aria-hidden="true"></i>', esc_attr( $class ), esc_attr( $classes ) );
}

/**
 * [icon] shortcode wrapper for sm_icon().
 *
 * Usage: [icon name="phone" style="solid" class="text-primary icon"]
 */
function sm_icon_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'name'  => '',
        'style' => 'solid',
        'class' => 'icon',
    ), $atts, 'icon' );
    return sm_icon( $atts['name'], $atts['style'], $atts['class'] );
}
add_shortcode( 'icon', 'sm_icon_shortcode' );

/**
 * [lordicon] shortcode for micro-animations.
 *
 * Attributes:
 * - src: JSON URL (CDN or theme asset)
 * - trigger: hover | in-view | loop | click | auto
 * - primary, secondary: hex colors
 * - size: integer px (applies to width/height)
 * - class: extra classes
 * - stroke: 1–3
 * - delay: ms
 * - target: window | element selector
 */
function sm_lordicon_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'src'       => '',
        'trigger'   => 'none',
        'primary'   => '',
        'secondary' => '',
        'size'      => '32',
        'class'     => 'icon',
        'stroke'    => '2',
        'delay'     => '0',
        'target'    => '',
    ), $atts, 'lordicon' );

    $colors = array();
    if ( ! empty( $atts['primary'] ) ) {
        $colors[] = 'primary:' . $atts['primary'];
    }
    if ( ! empty( $atts['secondary'] ) ) {
        $colors[] = 'secondary:' . $atts['secondary'];
    }
    $colors_attr = $colors ? ' colors="' . esc_attr( implode( ',', $colors ) ) . '"' : '';

    if ( ! empty( $atts['src'] ) ) {
        wp_enqueue_script( 'lordicon' );

        $trigger_attr = '';
        if ( ! empty( $atts['trigger'] ) && strtolower( (string) $atts['trigger'] ) !== 'none' ) {
            $trigger_attr = ' trigger="' . esc_attr( $atts['trigger'] ) . '"';
        }

        $target_attr = '';
        if ( ! empty( $atts['target'] ) && strtolower( (string) $atts['target'] ) !== 'none' ) {
            $target_attr = ' target="' . esc_attr( $atts['target'] ) . '"';
        }

        return sprintf(
            '<lord-icon src="%s"%s%s style="width:%spx;height:%spx" class="%s" stroke="%s" delay="%s"%s aria-hidden="true"></lord-icon>',
            esc_url( $atts['src'] ),
            $trigger_attr,
            $colors_attr,
            esc_attr( $atts['size'] ),
            esc_attr( $atts['size'] ),
            esc_attr( $atts['class'] ),
            esc_attr( $atts['stroke'] ),
            esc_attr( $atts['delay'] ),
            $target_attr
        );
    }
    return '';
}
add_shortcode( 'lordicon', 'sm_lordicon_shortcode' );

/**
 * Optional Lottie shortcode for larger illustrations.
 */
function sm_lottie_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'src'      => '',
        'loop'     => 'true',
        'autoplay' => 'true',
        'speed'    => '1',
        'style'    => 'width:100%;max-width:300px;height:auto;',
        'class'    => 'd-block',
    ), $atts, 'lottie' );

    if ( ! empty( $atts['src'] ) ) {
        wp_enqueue_script( 'lottie-player' );
        return sprintf(
            '<lottie-player src="%s" loop="%s" autoplay="%s" speed="%s" style="%s" class="%s" aria-hidden="true"></lottie-player>',
            esc_url( $atts['src'] ),
            esc_attr( $atts['loop'] ),
            esc_attr( $atts['autoplay'] ),
            esc_attr( $atts['speed'] ),
            esc_attr( $atts['style'] ),
            esc_attr( $atts['class'] )
        );
    }
    return '';
}
add_shortcode( 'lottie', 'sm_lottie_shortcode' );


