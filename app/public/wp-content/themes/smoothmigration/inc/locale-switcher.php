<?php
/**
 * Smooth Migration - Region/Language Switcher
 * - Modern, compact UI: floating pill, suggestion chip, modal sheet
 * - Emits hreflang/og:locale tags unless SEO plugin handles them
 * - Client-side suggestion and routing between country TLDs
 *
 * QA/Debug toggles (append to any URL):
 *   ?localeOpen=1         Open the modal immediately
 *   ?localePrompt=1       Force show country suggestion chip
 *   ?region=ca&lang=fr    Preselect region/language in UI
 *   ?resetLocale=1        Clear locale cookies/storage
 *   ?localeDebug=1        Show debug overlay
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
				'languages' => array( 'en' => 'English', 'fr' => 'Français', 'es' => 'Español', 'de' => 'Deutsch' ),
			),
			'ca' => array(
				'domain'    => 'smoothmigration.ca',
				'label'     => 'Canada',
				'hreflang'  => array( 'en-CA', 'fr-CA' ),
				'languages' => array( 'en' => 'English', 'fr' => 'Français', 'es' => 'Español', 'de' => 'Deutsch' ),
			),
			'uk' => array(
				'domain'    => 'smoothmigration.uk',
				'label'     => 'United Kingdom',
				'hreflang'  => array( 'en-GB' ),
				'languages' => array( 'en-GB' => 'English (UK)', 'fr' => 'Français', 'es' => 'Español', 'de' => 'Deutsch' ),
			),
			'au' => array(
				'domain'    => 'smoothmigration.com.au',
				'label'     => 'Australia',
				'hreflang'  => array( 'en-AU' ),
				'languages' => array( 'en-AU' => 'English (AU)', 'fr' => 'Français', 'es' => 'Español', 'de' => 'Deutsch' ),
			),
			'za' => array(
				'domain'    => 'smoothmigration.co.za',
				'label'     => 'South Africa',
				'hreflang'  => array( 'en-ZA' ),
				'languages' => array( 'en-ZA' => 'English (ZA)', 'fr' => 'Français', 'es' => 'Español', 'de' => 'Deutsch' ),
			),
		);

		public static function init() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
			add_action( 'wp_head', array( __CLASS__, 'output_hreflang' ), 1 );
			add_action( 'wp_head', array( __CLASS__, 'output_og_locale' ), 2 );
			add_action( 'wp_body_open', array( __CLASS__, 'render_ui' ) );
			add_action( 'send_headers', array( __CLASS__, 'output_hreflang_headers' ) );
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
			$base_uri = get_template_directory_uri();
			$base_dir = get_template_directory();
			$css_rel  = '/assets/css/locale.css';
			$js_rel   = '/assets/js/locale.js';
			$css_ver  = @filemtime( $base_dir . $css_rel ) ?: ( defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0' );
			$js_ver   = @filemtime( $base_dir . $js_rel ) ?: ( defined( 'SMOOTHMIGRATION_VERSION' ) ? SMOOTHMIGRATION_VERSION : '1.0.0' );

			wp_enqueue_style( 'sm-locale', $base_uri . $css_rel, array(), $css_ver );
			wp_enqueue_script( 'sm-locale', $base_uri . $js_rel, array(), $js_ver, true );

			$data = array(
				'regions'           => self::public_regions(),
				'currentRegion'     => self::region_from_host(),
				'currentHost'       => isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '',
				'currentPath'       => isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/',
				'allowedDomains'    => self::allowed_domains(),
				'xDefaultDomain'    => self::$regions['us']['domain'],
				'debugEnabled'      => self::is_debug_enabled(),
				'langInPath'        => (bool) apply_filters( 'sm_locale_lang_in_path', false ),
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
			$emit = self::should_emit_hreflang();
			if ( ! $emit ) return;
			$req     = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
			$current = wp_parse_url( $req );
			$path    = isset( $current['path'] ) ? $current['path'] : '/';
			$query   = array();
			if ( ! empty( $current['query'] ) ) parse_str( $current['query'], $query );
			unset( $query['localePrompt'], $query['resetLocale'], $query['feature.locale'], $query['region'], $query['localeDebug'] );

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

		public static function output_og_locale() {
			if ( ! self::should_emit_og_locale() ) return;
			// Open Graph locale tags
			$current_region = self::region_from_host();
			$hreflang = isset( self::$regions[ $current_region ]['hreflang'][0] ) ? self::$regions[ $current_region ]['hreflang'][0] : 'en-US';
			echo '<meta property="og:locale" content="' . esc_attr( $hreflang ) . '" />' . "\n";
			foreach ( self::$regions as $key => $cfg ) {
				foreach ( $cfg['hreflang'] as $hl ) {
					if ( $hl === $hreflang ) continue;
					echo '<meta property="og:locale:alternate" content="' . esc_attr( $hl ) . '" />' . "\n";
				}
			}
		}

		public static function output_hreflang_headers() {
			$emit_headers = (bool) apply_filters( 'sm_locale_emit_hreflang_headers', false );
			if ( ! $emit_headers || headers_sent() ) return;
			$req     = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
			$current = wp_parse_url( $req );
			$path    = isset( $current['path'] ) ? $current['path'] : '/';
			$query   = array();
			if ( ! empty( $current['query'] ) ) parse_str( $current['query'], $query );
			unset( $query['localePrompt'], $query['resetLocale'], $query['feature.locale'], $query['region'], $query['localeDebug'] );

			foreach ( self::$regions as $key => $cfg ) {
				$domain = $cfg['domain'];
				foreach ( $cfg['hreflang'] as $hl ) {
					$q = $query;
					if ( $key === 'ca' && strtolower( $hl ) === 'fr-ca' ) {
						$q['lang'] = 'fr';
					} else {
						unset( $q['lang'] );
					}
					$url = 'https://' . $domain . $path;
					if ( ! empty( $q ) ) $url .= '?' . http_build_query( $q );
					header( sprintf( 'Link: <%s>; rel="alternate"; hreflang="%s"', esc_url_raw( $url ), esc_attr( $hl ) ), false );
				}
			}
			$xd = 'https://' . self::$regions['us']['domain'] . $path . ( ! empty( $query ) ? '?' . http_build_query( $query ) : '' );
			header( sprintf( 'Link: <%s>; rel="alternate"; hreflang="x-default"', esc_url_raw( $xd ) ), false );
		}

		private static function should_emit_hreflang() {
			$seo_plugin_present = defined( 'WPSEO_VERSION' ) || class_exists( '\\RankMath' ) || defined( 'RANK_MATH_VERSION' );
			$default = $seo_plugin_present ? false : true;
			return (bool) apply_filters( 'sm_locale_emit_hreflang', $default );
		}

		private static function should_emit_og_locale() {
			$seo_plugin_present = defined( 'WPSEO_VERSION' ) || class_exists( '\\RankMath' ) || defined( 'RANK_MATH_VERSION' );
			$default = $seo_plugin_present ? false : true;
			return (bool) apply_filters( 'sm_locale_emit_og_locale', $default );
		}

		private static function is_debug_enabled() {
			$qs_debug = isset( $_GET['localeDebug'] ) && $_GET['localeDebug'] === '1';
			return (bool) apply_filters( 'sm_locale_debug_enabled', $qs_debug );
		}

		public static function render_ui() {
			?>
			<div id="sm-locale-root" class="sm-locale-root" aria-live="polite">
				<button id="sm-locale-pill" class="sm-pill" type="button" aria-haspopup="dialog" aria-controls="sm-locale-sheet">
					<span class="sm-pill-ico" aria-hidden="true">🌐</span>
					<span id="sm-pill-text">Region · Language</span>
				</button>

				<div id="sm-locale-chip" class="sm-chip" hidden>
					<span id="sm-chip-text">Looks like Canada. Switch?</span>
					<div class="sm-chip-actions">
						<button id="sm-chip-switch" class="sm-btn sm-primary" type="button">Switch</button>
						<button id="sm-chip-stay" class="sm-btn" type="button">Stay</button>
					</div>
				</div>

				<div id="sm-locale-sheet" class="sm-sheet" role="dialog" aria-modal="true" aria-hidden="true">
					<div class="sm-sheet-backdrop" data-close="1"></div>
					<div class="sm-sheet-panel" role="document" tabindex="-1" aria-labelledby="sm-sheet-title">
						<header class="sm-sheet-header">
							<h2 id="sm-sheet-title" class="sm-sheet-title">Region &amp; language</h2>
							<div style="display: flex; align-items: center; gap: 8px;">
								<button id="sm-done" class="sm-done-btn" type="button" disabled>Done</button>
								<button class="sm-close" data-close="1" aria-label="Close dialog">✕</button>
							</div>
						</header>
						<div class="sm-sheet-content">
							<div class="sm-sheet-body">
								<section class="sm-regions-section">
									<h3 id="sm-regions-title" class="sm-section-title">Region</h3>
									<div id="sm-region-grid" class="sm-region-grid" role="radiogroup" aria-labelledby="sm-regions-title"></div>
								</section>
								<section class="sm-languages-section">
									<h3 id="sm-languages-title" class="sm-section-title">Language</h3>
									<div id="sm-lang-list" class="sm-lang-list" role="radiogroup" aria-labelledby="sm-languages-title"></div>
								</section>
							</div>
						</div>
					</div>
				</div>

				<noscript>
					<div class="sm-noscript-links">
						<ul>
							<?php
							$req     = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
							$current = wp_parse_url( $req );
							$path    = isset( $current['path'] ) ? $current['path'] : '/';
							$query   = array();
							if ( ! empty( $current['query'] ) ) parse_str( $current['query'], $query );
							unset( $query['localePrompt'], $query['resetLocale'], $query['feature.locale'], $query['region'], $query['localeDebug'] );
							foreach ( self::$regions as $key => $cfg ) {
								$domain = $cfg['domain'];
								$url = 'https://' . $domain . $path;
								$qs = $query;
								if ( $key === 'ca' ) { $qs['lang'] = 'en'; }
								if ( ! empty( $qs ) ) $url .= '?' . http_build_query( $qs );
								echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $cfg['label'] ) . '</a></li>';
							}
							?>
						</ul>
					</div>
				</noscript>
			</div>
			<?php
		}
	}
}

SM_Locale_Switcher::init();


