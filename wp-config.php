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
define( 'DB_NAME', "wp_adj" );

/** Database username */
define( 'DB_USER', "root" );

/** Database password */
define( 'DB_PASSWORD', "" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'W0Kh=(SIa#w%$C?x`Clg^Bo9n< SrV~CV@*bw0+7n33e(^RKZH=N,~i@ds[R8 e$' );
define( 'SECURE_AUTH_KEY',  't;!.X|F5Sso*+*VT%@fxBO1g^&Pc*ADM:kG)lBx~m0Lkr9 .vnOQPK)`GR}5ijl@' );
define( 'LOGGED_IN_KEY',    'vR+6vp^i#:X,F7zi4Q]Hs8XS5m)jDraW>B-=Rc/b?BCHjV[}Pxu*>==SF02//@rM' );
define( 'NONCE_KEY',        'gQCcu%StR_o8cQ$Rv!};!]V%MbF<gaucneT<:3]A<IY=tzdJ~O- b~F<iaT/d$f,' );
define( 'AUTH_SALT',        '?CJ7AYO0x-NvJh})`A:J5~,P}u>%B`Ai=XlE7q ~^A.zPef8u4Y=VOMVI7(]8Ynj' );
define( 'SECURE_AUTH_SALT', 'Fo)wVV}$1 _21dd!Zq2^A7MCQI/I6lnIByS({wAQ[0OFzM=7*3ebHjw% e]Tc#n.' );
define( 'LOGGED_IN_SALT',   '[GB8U79ZCZGT}&&WWwmq#EHmsDyaz%Sa T*Oq1Cyr}<.j64$AACP~Cu{lOUP8C`/' );
define( 'NONCE_SALT',       'Wr6;,Lu;v4)TJwBj/auRP}Im9K:+ !qr8+#.X8Gj5&9LZ^-I)2axgx&CNa}QQ2bE' );

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



define( 'WP_SITEURL', 'http://localhost/adj-cr/' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
