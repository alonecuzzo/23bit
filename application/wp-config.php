<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xIw)Sj+YFJ:[5u@{I*xZ=zeE(:@c0c>!JuWQG@*rlLNrmFEp=kGEy|$okWX0|P*B');
define('SECURE_AUTH_KEY',  'aQ[*1kn9#1ixXan]8vZWWXm2Q%Fn4gO@]Vg^V!X[Ok4 Pyrjz&Y,a837FSk/2_{M');
define('LOGGED_IN_KEY',    '+cw-M8tzTj@>Wdn0_4aO|ILZ`>!wCSp$EP64K|0 #-/87|6v&5+ew`0,Q/yEJ3kK');
define('NONCE_KEY',        '<Or>EGGC:je]rrFOS@6S$Jri5w-pJDXt--0+yPrH;hc!!m{oeFzxRz&+>P=FVgIk');
define('AUTH_SALT',        'H>,qHwC$^Zm^%g0$ff}HHl`j1+0),@)0#)7*-@KaG~Ip9Po(i3E+9IO><dv8OfNt');
define('SECURE_AUTH_SALT', '|]]aEJ1KmS7,])X (KaBVTlf-7bg{/tQ=0#sDsxTdF]d8R_c,|!XUMO7sO+.!k)G');
define('LOGGED_IN_SALT',   '$54XyePsWIG,-`.F*0OS]Z$u?{,uUgbr8?50bQT|m]C]Ieh!] | +V8:1Kc[]b_-');
define('NONCE_SALT',       'u|Kv$gd=fzr)dv,;BwPTR0P-C,7U<_0H^C:$cYXu1H+@9DjP1m-dpm&6*=-W7xI8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
