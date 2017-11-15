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
define('DB_NAME', 'wordpress_2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'T^lL<Q99zgJ3}p!CU`h07^]4@GJP=7aoB9$kYspui``DjcWQm9=Om1=|!kC}]]0(');
define('SECURE_AUTH_KEY',  '#^t86pP]Duh=$/UMHKU$>t5pMQnB$m9[K$5XLevF~&ZeE]vyc)^^v2>vbtKHBp$(');
define('LOGGED_IN_KEY',    'jr9@c:]GAZ!/$H0G:0@0pr&YZ&Cj@Xg;Pj9lercvhQQ7P<Kx5aLn{1`:|`#L122V');
define('NONCE_KEY',        'aBc#}}]LuEyKoZ Id8Xg6Yy.1}@f1cB6R?[a|#Q2b~P^7j*h(+g%*%VIF4/f4rmk');
define('AUTH_SALT',        'Z:)+,tIKn ;cq:2<^D>e4Da+Q%WM[px#9jt$Cut!]D,N-Z4zr]sekHs6K*`Rt-2H');
define('SECURE_AUTH_SALT', 'qp0sl.LwMSWb0t.<v~Btb(/=(:$7hkhK^Su:RmD_Ql9PvGZecWBY<qNa0pE!h:`0');
define('LOGGED_IN_SALT',   'Ub{*svK|=n4S+>~c4y.:e4P4aq`Na)E8_2;(t[SD<[PnLL(63c,?<6~zWAzytZXH');
define('NONCE_SALT',       'pp8Fx+YlQ ~ya*L{m5Z.;[9(*`p0o88y%> I$*A5iE;4.o@Q6Rw?+B:inQh$)h;y');

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
