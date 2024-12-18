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
define( 'DB_NAME', 'wordpress_db' );

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
define( 'AUTH_KEY',         'XB|iIX]>euM{qhp2&5EBysloF:~<-C6ST=g6sBBcNzW;+`IO7> YRE6Ug..W|Rh ' );
define( 'SECURE_AUTH_KEY',  'xB7?N1bJT|w3xD~hrVH{Fxm-CuZ?w_wLsLTju/=6?:}dZ{-3pSZ~lA{l;1*RjwD_' );
define( 'LOGGED_IN_KEY',    'Yzw@]Lk9}!#M;~4y~~wo.:)|g-32q`:IaaAmes91)(~rM!NWj0X3Za~%QTkUr2Pg' );
define( 'NONCE_KEY',        ']*KP>qU .=R{RKNjXNS>-R]0h|W]<R<+p{vJR~*LXk4%e]:+Xq(TOY;cB8ID?-/;' );
define( 'AUTH_SALT',        '=hqN$Y>t+svy7?+Hpn`UQ)OEL lBQ)3O>M.c~$@aF0oYk,?tV4w#XVvo!HN{GD,n' );
define( 'SECURE_AUTH_SALT', 'jT|j4z~;?+`z NW-$+J$r`o!t5vmaF73O/E=%?L}7[v$wv9d0w]Fa[x,,|W3.Bi$' );
define( 'LOGGED_IN_SALT',   'M~aAlRUy4 ))~x9Fg>IkHL/*3?UA!uCf<|dE48J6KLn<%~)5&XT<JUZUY_nI@g8@' );
define( 'NONCE_SALT',       'A99jo?QEAAd4TJtpUBca~/*:hHwke0clxXDGolFnFF?hU`)t=71,hy7p6[kDv$`J' );

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
