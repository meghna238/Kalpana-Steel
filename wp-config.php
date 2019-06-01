<?php
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
define('DB_NAME', 'kalpnasteel123');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'vse[6e16iTR:(|FNH{rGRBC4!1D6@rd|Ij<Sv(eLyO;8.+mQtI?u3ynPm4nBgAP}');
define('SECURE_AUTH_KEY',  'QAC?Y^slwxI=R7=Fj2I{G)W_d0(K3kRo5l6A0lc}3Q<_4pLk]-H~7Krk9xZv $Sv');
define('LOGGED_IN_KEY',    'dZd`$<E}zqjblXC*JRm$G)S4,q`?oG*L!c4sdZ68Ojj>$>TV;J701.r#k`HV1N96');
define('NONCE_KEY',        'EO@2%wmzXg7D/SMXe^J696$(0f,2O%,%s2Pbq&Nm.@#x=Brlm9W24 u:2S$H!7,L');
define('AUTH_SALT',        'o=^xnum8XQs$lTHF44Vg^+j/vZC-58y8xV~)xM^.)k>t-m.e}Tp:1H5P_r&6-xK~');
define('SECURE_AUTH_SALT', 'a`TxA^hirBs<p7]0dTj?6p1H?V3]p{2^22q]9az$[$+h*)Le@Eyw?IYJIMx_dp}Y');
define('LOGGED_IN_SALT',   'Ahdx:azI]@SuhX3L!6K0?IjR)rB/CnZ^3#waSD;2Cp})fdd*7apsVQgox(;:9# 9');
define('NONCE_SALT',       'Z)R8!upqQkCcCFJOt2.T41.sODCph9[<Uk}9K:qlqp|sdV{AqUYzc6exSs(>LBp?');

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
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD','direct');