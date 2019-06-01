<?php
define ('WP_MEMORY_LIMIT', '2048M');

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kalpanasteel123');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         'uYuf^3FenG1Ayh?vI~) X;#}d5+21+)%-G8$lnFIOugZ|$D|}em@sp.*|B}C$p7P');
define('SECURE_AUTH_KEY',  'y_+68W6i*oh4SNtCW|;w|!<Tr4Q|F}y91imsx9D+J*qEM|sImQ]<`u`]GcWv>.[H');
define('LOGGED_IN_KEY',    '(vk0i]&-|t-@#M+Uo,1Y3[Q+LaZNG|c!jo/-hbc#<AKC6mpyt7O:+@3VVV*45OKl');
define('NONCE_KEY',        'Nk+VfQb/z[#X6}uN2-pUz[5k:?#|#ln3AE:!?7~6}PNfpKE&ZM${N9|4U:q3B8$2');
define('AUTH_SALT',        'e4;uM,o5ZLy_Lmn;od*/,-^A:Qhv< qf8iPkSE0Vh}tV4XdiOspo}%([o{tsKb8A');
define('SECURE_AUTH_SALT', ' 15lAeICr*O0GZ}%P .>pgH-Ds<1ho9HmHy~gd!k.QK}@#ad2zG{!c+|JEf/:j|Y');
define('LOGGED_IN_SALT',   '6-Idps9@oXa6r@?S{@C[/=iVKv6z~cyDp{n{Z9asqj).Bj&R0 a7nru=~u-jj$h ');
define('NONCE_SALT',       'm+zQ^RZG@9xSpFI5-(d}Jd?Nxf=WP8yl~nC6lxz9KYjV){3zSG7V3WAx-%q/OlNc');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_SITEURL', 'https://www.kalpanasteel.com/');
define('WP_HOME', 'https://www.kalpanasteel.com/');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD','direct');