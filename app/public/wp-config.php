<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:10007' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);


/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'dL=(wtam7{q-p-2P%0F$x!Y?L)/KU?M@H4(O3?FrJ47)i<5)n&k[/g5NTYZWoD#v' );
define( 'SECURE_AUTH_KEY',   '$05bEPhmxZ97[Sg%az#Dyk~%B1,19d~x@=BUK$6!5#f,u=xK-E9;Y7HVP?(|V:6Z' );
define( 'LOGGED_IN_KEY',     'X?FV=OKsEk&+nA@(0|k>d5W_sw?#fFDE1HRa1<UB#Qp]8poQ1D!wJvBy3P{%;QLt' );
define( 'NONCE_KEY',         '#gbIJ!K`8s`,HSO[]3O[K[T#lQQ.T9Lo|3/ueb`|#L (Vq/0S0;u/Gc0hS-S_ktK' );
define( 'AUTH_SALT',         '{)Zo~<g.xARG~F7#I+@PdBM,5!]y(hIPF]e-V]PbNo P$K1Bu,u!7ooT57`t6])Q' );
define( 'SECURE_AUTH_SALT',  ' (%$SA`^5IyrZ2gxF)KY Mq+UYL%rLrteKw2Jm[0A:v1`Yh <ma!{.`)oWls/40Y' );
define( 'LOGGED_IN_SALT',    '*,~iMO9RA&!4RvSpqK!-evsqDunhToci16-NvRky1:Qm??d!A~lmig/]ir@;I[#[' );
define( 'NONCE_SALT',        'Iu^HN?fDe|aBmIa~v}(Ef^fS` gZ)O(4 R<^*:=wgU(W9IU$mo4!`pT}OYD[C/VY' );
define( 'WP_CACHE_KEY_SALT', 'rLKqWYL}S=ECM Y;$9b)Ar9zMIHJP]|y$D:QkI@^Y_J{=[4 g:le:q2UVb*1DAfq' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';