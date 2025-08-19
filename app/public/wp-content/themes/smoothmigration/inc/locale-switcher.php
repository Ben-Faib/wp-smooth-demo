<?php
/**
 * Smooth Migration - Hard-coded Region/Language Switcher
 * - Glassmorphism UI (pill, chip, sheet)
 * - hreflang alternates across TLDs
 * - Client-side suggestion and routing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SM_Locale_Switcher' ) ) {
	class SM_Locale_Switcher {
		/**
		 * Hard-coded region map (domains reflect live properties)
		 */
		private static $regions = array(
			'us' => array(
				'domain'    => 'smoothmigration.net',
				'label'     => 'United States',
				'hreflang'  => array( 'en-US' ),
				'languages' => array( 'en' => 'English' ),
			),
			'ca' => array(
				'domain'    => 'smoothmigration.ca',
				'label'     => 'Canada',
				'hreflang'  => array( 'en-CA', 'fr-CA' ),
				'languages' => array( 'en' => 'English', 'fr' => 'Français' ),
			),
			'uk' => array(
				'domain'    => 'smoothmigration.co.uk',
				'label'     => 'United Kingdom',
				'hreflang'  => array( 'en-GB' ),
				'languages' => array( 'en-GB' => 'English (UK)' ),
			),
			'au' => array(
				'domain'    => 'smoothmigration.com.au',
				'label'     => 'Australia',
				'hreflang'  => array( 'en-AU' ),
				'languages' => array( 'en-AU' => 'English (AU)' ),
			),
			'za' => array(
				'domain'    => 'smoothmigration.co.za',
				'label'     => 'South Africa',
				'hreflang'  => array( 'en-ZA' ),
				'languages' => array( 'en-ZA' => 'English (ZA)' ),
			),
		);

		public static function init() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
			add_action( 'wp_head', array( __CLASS__, 'output_hreflang' ), 1 );
			add_action( 'wp_body_open', array( __CLASS__, 'render_ui' ) );
		}

		private static function allowed_domains() {
			return array_values( array_map( function ( $r ) { return $r['domain']; }, self::$regions ) );
		}

		private static function region_from_host() {
			$host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
			foreach ( self::$regions as $key => $cfg ) {
				$dom = strtolower( $cfg['domain'] );
				if ( $host === $dom || str_ends_with( $host, '.' . $dom ) ) {
					return $key;
				}
			}
			return 'us';
		}

		public static function enqueue_assets() {
			$ver  = defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0';
			$base = get_template_directory_uri();
			wp_enqueue_style( 'sm-locale', $base . '/assets/css/locale.css', array(), $ver );
			wp_enqueue_script( 'sm-locale', $base . '/assets/js/locale.js', array(), $ver, true );

			$data = array(
				'regions'        => self::public_regions(),
				'currentRegion'  => self::region_from_host(),
				'currentHost'    => isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '',
				'currentPath'    => isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/',
				'allowedDomains' => self::allowed_domains(),
				'xDefaultDomain' => self::$regions['us']['domain'],
			);
			wp_localize_script( 'sm-locale', 'SM_LOCALE_DATA', $data );
		}

		private static function public_regions() {
			$out = array();
			foreach ( self::$regions as $key => $cfg ) {
				$out[ $key ] = array(
					'domain'    => $cfg['domain'],
					'label'     => $cfg['label'],
					'languages' => $cfg['languages'],
					'hreflang'  => $cfg['hreflang'],
				);
			}
			return $out;
		}

		public static function output_hreflang() {
			$req     = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
			$current = wp_parse_url( $req );
			$path    = isset( $current['path'] ) ? $current['path'] : '/';
			$query   = array();
			if ( ! empty( $current['query'] ) ) parse_str( $current['query'], $query );
			unset( $query['localePrompt'], $query['resetLocale'], $query['feature.locale'], $query['region'] );

			foreach ( self::$regions as $key => $cfg ) {
				$domain = $cfg['domain'];
				foreach ( $cfg['hreflang'] as $hl ) {
					$q = $query;
					// Only use ?lang for CA French to disambiguate
					if ( $key === 'ca' && strtolower( $hl ) === 'fr-ca' ) {
						$q['lang'] = 'fr';
					} else {
						unset( $q['lang'] );
					}
					$url = 'https://' . $domain . $path;
					if ( ! empty( $q ) ) $url .= '?' . http_build_query( $q );
					echo '<link rel="alternate" hreflang="' . esc_attr( $hl ) . '" href="' . esc_url( $url ) . '" />' . "\n";
				}
			}
			$xd = 'https://' . self::$regions['us']['domain'] . $path . ( ! empty( $query ) ? '?' . http_build_query( $query ) : '' );
			echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $xd ) . '" />' . "\n";
		}

		public static function render_ui() {
			?>
			<div id="sm-locale-root" class="sm-locale-root" aria-live="polite">
				<button id="sm-locale-pill" class="sm-pill material" type="button" aria-haspopup="dialog" aria-controls="sm-locale-sheet">
					<span class="sm-pill-ico" aria-hidden="true">🌐</span>
					<span id="sm-pill-text">Region · Language</span>
				</button>

				<div id="sm-locale-chip" class="sm-chip material" hidden>
					<span id="sm-chip-text">Looks like Canada. Switch?</span>
					<div class="sm-chip-actions">
						<button id="sm-chip-switch" class="sm-btn sm-primary" type="button">Switch</button>
						<button id="sm-chip-stay" class="sm-btn" type="button">Stay</button>
					</div>
				</div>

				<div id="sm-locale-sheet" class="sm-sheet" role="dialog" aria-modal="true" aria-hidden="true">
					<div class="sm-sheet-backdrop" data-close="1"></div>
					<div class="sm-sheet-panel material" role="document" tabindex="-1">
						<header class="sm-sheet-header">
							<h2 class="sm-sheet-title">Region &amp; Language</h2>
							<button class="sm-close" data-close="1" aria-label="Close">✕</button>
						</header>
						<div class="sm-sheet-body">
							<section>
								<h3 class="sm-section-title">Region</h3>
								<div id="sm-region-grid" class="sm-region-grid"></div>
							</section>
							<section>
								<h3 class="sm-section-title">Language</h3>
								<div id="sm-lang-list" class="sm-lang-list"></div>
							</section>
						</div>
						<footer class="sm-sheet-footer">
							<button id="sm-go" class="sm-btn sm-primary" type="button">Go</button>
							<button id="sm-stay-here" class="sm-btn" type="button" data-close="1">Stay here</button>
						</footer>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

SM_Locale_Switcher::init();


