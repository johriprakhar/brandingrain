<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache



//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "johripra_brandingrain" );

/** MySQL database username */
define( 'DB_USER', "johripra_brandingrain" );

/** MySQL database password */
define( 'DB_PASSWORD', "8YP+=.Jq{!m)" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tw^>b;c8`%zYBBcsHRt7W4C1p:a+<$?|@%Fo1xj^?@TW|hTUl2|W1<;F(Ge%S{>1' );
define( 'SECURE_AUTH_KEY',  '}]xb1yA-1GwToRHs){#&(b(EN}smM3p3c5C{~c=K^fR]*%)OZpCBoBQb7,M<NP%+' );
define( 'LOGGED_IN_KEY',    '7!T]`bcx0WRHBNd!Z;KW/2XTM.^/NO/bHcyu{J!Cxc`[xJRW}LD<^`CGr|HlxWV3' );
define( 'NONCE_KEY',        'lS5CLZ>+HjvrIh V8<VtoFhN_:TG&%Zfn.;SbJX#kf@g2w@*dHmqKO,Y]*=Em#x=' );
define( 'AUTH_SALT',        'E1/+y^sqfr9LXZtQcuS/Cxn&xXb)(mZ H5KkKb;@5w0o8Lk4d|^a>>u~;;UFAEU1' );
define( 'SECURE_AUTH_SALT', ';U2=X~S w+6k8{D}[496}@IW4zpY5za=i0PXc#>u).xUNCv?)(<7Z3#={v676*xU' );
define( 'LOGGED_IN_SALT',   '$z(=f)4Ay[5QcFF-z/ldR89DHtppH=v>7}e6:YB 4xpm;a0*#2Mpb~%~)6_p0hTg' );
define( 'NONCE_SALT',       'R=/~mG?oosf-RKP(+P#.%Z @E&j.c$lVdHoX0f5t^)L*_ (yB6VtRV|LGecN9y)T' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dwiq686_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
