<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbepu' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'L<mQ2O EmG6&nA.IEIO9qJwqurGQ44S_%e_Y=(Vg~}]2;Qa_QhGmP0K3YtV6J<;;' );
define( 'SECURE_AUTH_KEY',  '>|f2z#.Tq`NTlX>k:{^3od wR/-5_>MM3=-DL|5n;9ra`C#zacm;dat)Q@lP*?Ux' );
define( 'LOGGED_IN_KEY',    'Lc*[[-{~T$OwlTE76B$Xh0m%)wp9iwb:L=F-iC`s2RQf-ax]K9XbuabyoK:jD%Z-' );
define( 'NONCE_KEY',        '5hrb|Z6ytZcn1t3S_m|1a%Z?E5.#}O,ONA,dM.i>ojDVK=b#*!bj,BENS]P7BZ{8' );
define( 'AUTH_SALT',        '2Z]XFLITNU|Vt&lcHp^HFb.ae_OQay_R3Kbe01N,hWa]w6X^?h]b1Wlp{Lp4yR.y' );
define( 'SECURE_AUTH_SALT', 'U,nmiGtv;eU)6vXTa:<p~>Xfp~=s@Cf=r];#<6*l4eO}R&ER6KNgG=Rg^4UOMm|U' );
define( 'LOGGED_IN_SALT',   'R#+Cim:lylkl[L~) lHUSJu6<fw(hSbQ0fY)x5_JYWwdu]Jc9aunxinaAB]8YNN/' );
define( 'NONCE_SALT',       'EVuj)`&i0TEXaAMv/#32w&Bs-dB)Z ED6hT@_<}#5Kjkyh|Chq7rE0>=0XpQ69gL' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
define('WP_HTTP_BLOCK_EXTERNAL', false);
define( 'WP_ENVIRONMENT_TYPE', 'development' );



/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
