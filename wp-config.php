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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '>fF9*z4wvq!j[u<yOQ2|=:SKzI0gQeS:qfs4DAhIKa=L)|k6+dJMoR:#U9$;h~_U');
define('SECURE_AUTH_KEY',  'bgdd;h~[!@z/yqIi>&&AXTXG062r9/bzh6}Yah}`{^m:TOL-30xHxte]mK4Z|]*U');
define('LOGGED_IN_KEY',    '&UUqN};65w}32R4tXz%RA{A/7T;]U7qONG)mldodBD| TQWh];YE~P&sjtxc2N8f');
define('NONCE_KEY',        'LcnE-[GNT$;sVD8IzDmDqBY__GgTIb1.3*TA,H7[ iLDbPid3Nb@lU=)Zr>p3#rK');
define('AUTH_SALT',        'H-0fbN>TFi~jU3X]9Fh ow{@vh2{#lkaj@Pd92@pW(7!+6`sWx=CFl8[-_xJYj+R');
define('SECURE_AUTH_SALT', '@0z-TPh&5YJzcLx9^i1THRD_G)f&r+  ,QFp:::8d+bwGD?nWpyu`uSM(K  K]:Q');
define('LOGGED_IN_SALT',   '*8z4|?l97 2,X(jYl5|(hkz.#)xm2 Yy{icPETGk3),Y0K(OYGJHVL/yz>T`|^-3');
define('NONCE_SALT',       'RXl-*b(gK)|v^xr&~m5%XB$|B9_!`!sR?MRkg43mSl^-EABZSZMeFutW~*[cd}GQ');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
