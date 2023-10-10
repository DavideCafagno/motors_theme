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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'motors_theme' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '~a*Dh6+RI1b3]]@V$PL1%LYv#>z|L n7sxF)J*ab-_M7}?Co!l>=>sML@#A15q}.' );
define( 'SECURE_AUTH_KEY',  'y*z`zs#,_r3$}+`Fr@rFm=FIF~S[$97HI=Gew j@Fi%h9:.jRthi.a>`RP;MIw%u' );
define( 'LOGGED_IN_KEY',    '>x@>o0]HhWC~D{B?8(A).P^pcx)zCY2~POXaB(_?MGTy4ldG>0UoO=nMz#=D@*9f' );
define( 'NONCE_KEY',        ' FwZ/B,8Iy<CDP?B-TVzHK@]*=ol[g1yRM F!N0F1lCb6QGOaq>]VE52/i VF4~F' );
define( 'AUTH_SALT',        'HqTO7nMd}g%+u61,%He*-$8r}Olq}rtr_NrXw_!L.t+:iu#,w-;qfCV5]0:%/I[B' );
define( 'SECURE_AUTH_SALT', '5&^r=8^~UjEq7IV+2SCnd5<&BNQoc&}3J}PG]e|BXMn1QrvS#gnrF^h,WOX*5[K%' );
define( 'LOGGED_IN_SALT',   'eG<Iall. ?5+p[MW*`|5qj(UnpE808Q.0(vYl>u*-:$}@k>F%2/CpA1W[ZlGw_Ct' );
define( 'NONCE_SALT',       '7BBCa]*3?c}r-rYlW#X:(r?:sY`pT>cnq-8<)t~m$$T2C|bj)95yFvr1*x!pm63R' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
