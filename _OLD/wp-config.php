<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'host720720_wp701' );

/** Database username */
define( 'DB_USER', 'host720720_wp701' );

/** Database password */
define( 'DB_PASSWORD', '[CH4p@S)3l8b' );

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
define( 'AUTH_KEY',         'wnmgmonvpztgquoosuuoqjbldpjw62asznvekixj9vaqtzjjwomy5lpka5hqre6e' );
define( 'SECURE_AUTH_KEY',  'u9fttozsjaoqr6pov1fmoibdu8aruzjcl6vsvfdgln2783qflbtk91nibo66ca2k' );
define( 'LOGGED_IN_KEY',    'mwrgrjw8x26wgmboz3f1unkom5wekgtpfveyq9nnhpjejgn4z3t4cxetbh9ehuzv' );
define( 'NONCE_KEY',        'qpne5u0uuszknuwyphx5l2bpfsvymbplejllkzkcupbbpaahhgpmwi9r7cljunyy' );
define( 'AUTH_SALT',        'yxqlyof7jtlzk03fpnmqnlhk4vnr0iugzyinc5rqr3aenxr4rkyrez7irldccv39' );
define( 'SECURE_AUTH_SALT', 'buyanuf3uftsb9hqcsoosrm5of1jkey9j7mlnsvwfhuty1npwdyzzkkvzvao6ock' );
define( 'LOGGED_IN_SALT',   'zpmdtuco5kubxabyx0tb6cshtn2ms4c9wvq9f9gjcunrragcyoxcpxjstmiox9ty' );
define( 'NONCE_SALT',       'gmsf6pt6hrwyglgd9kwjnjs1q0aygk3gu7ngzggz32pdpxnilwnddlh3zyxdnfy6' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp8q_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
