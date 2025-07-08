<?php
try {
   (@include_once 'get-dotenvs.php') //# symlink /.common/includes/get_dotenvs/? -> always in base
   || (@include_once '../get-dotenvs.php') 
   || (include_once __DIR__.'/get-dotenvs.php')
   || (@include_once '/get-dotenvs.php')
   ;
   echo "<script>console.info('✅ENV load success.')</script>";
} catch (\Throwable $e1) {
   echo "<script>alert('".$e1->getMessage()."')</script>";   
}
#
### DEV_MODEs: 0-Prod(Staging), 1-Alert/NoCache(Beta), 2-&Debug(Dev), 3-&Die
define('DEV_MODE', (int)getenv('ENV_DEV_MODE')?(int)getenv('ENV_DEV_MODE'):0); //must default 0

if (($_SERVER['SERVER_NAME']=="localhost") && (!getenv('ENV_WP_HOME'))) 
   die("Localhost: Please initialize ENV_WP_HOME!");

$realcwd = str_replace("\\","/",realpath(getcwd()));
$_SERVER['DOCUMENT_ROOT'] = $realcwd;

if (DEV_MODE > 0) {
   #clear cache
   $cacheDir = ".\wp-content\cache";
   function delTree($dir) {
      if (is_dir($dir)) {
         $files = array_diff(scandir($dir), array('.','..'));
         foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
         }
         return rmdir($dir);
      }
   };
   delTree($cacheDir);
   echo '<script>alert("'
      . '👉👉 CACHE DELETED!! 👈👈'
      . '\nDevMode: '.(int)DEV_MODE
      . '\nHost:         '.$_SERVER['HTTP_HOST']
      . '\nDocRoot:   '.$_SERVER['DOCUMENT_ROOT']
      . '\nCWD:         '.$realcwd      // Current Working Directory/subdir
      . '\nDB:            '.strtoupper(ENV_DB_NAME).' (on '.ENV_DB_HOST.')'
      . '")</script>';
}
#--------------------------------- 

/** Enable W3 Total Cache */
define('WP_CACHE', (DEV_MODE > 0) ? false : true ); // Added by W3 Total Cache; //vw-no Cache if debug;

define('ITSEC_ENCRYPTION_KEY', 'IHpufDIkT191VTolelFVcn1wMmBdSzFmYWlUIzhAZVhrJD0vRllsMmxzMF5IQXVgUm8mbUw3WyN0L2AoTSp0KA==');

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
define('DB_NAME',          getenv('ENV_DB_NAME'));
define('DB_USER',          getenv('ENV_DB_USER'));
define('DB_PASSWORD',      getenv('ENV_DB_PASSWORD'));
define('DB_HOST',          getenv('ENV_DB_HOST'));
define('DB_CHARSET',       getenv('ENV_DB_CHARSET'));
define('DB_COLLATE',       getenv('ENV_DB_COLLATE'));

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
define('AUTH_KEY',         getenv('ENV_AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('ENV_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('ENV_LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('ENV_NONCE_KEY'));
define('AUTH_SALT',        getenv('ENV_AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('ENV_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('ENV_LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('ENV_NONCE_SALT'));
/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv('ENV_TABLE_PREFIX');

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
# define( 'WP_DEBUG', false ); // Added by Defender;
define('WP_DEBUG', DEV_MODE > 1 ? true : false); // vw

/* -------------------------------------------------------------------- */
/* Add any custom values between this line and the "stop editing" line. */

getenv('ENV_WP_HOME')    ? define('WP_HOME',    getenv('ENV_WP_HOME'))    :null;
getenv('ENV_WP_SITEURL') ? define('WP_SITEURL', getenv('ENV_WP_SITEURL')) :null;
getenv('ENV_WP_CONTENT_URL') ? define('WP_CONTENT_URL', getenv('ENV_WP_CONTENT_URL')) :null;

#special
#if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', ENV_WP_HOME.'/wp-content/uploads');

define('WP_DEBUG_LOG',     WP_DEBUG);
define('WP_DEBUG_DISPLAY', WP_DEBUG);
#define('FORCE_SSL_ADMIN', true);
#define('DISALLOW_FILE_EDIT', true);

## ---------------- VW: App-version Date ---------------
$mtime = -1;
function getMTime($dirName,$ltime) {
    $d=dir($dirName);
    while ($entry = $d->read()) {
        if (!is_link($dirName."/".$entry) && $entry != "." && $entry != "..") {
            if (!is_dir($dirName."/".$entry)) {
                $ltime = ($ltime<filemtime($dirName."/".$entry)) ? filemtime($dirName."/".$entry):$ltime;
            }
            else if (is_dir($dirName."/".$entry)) {
                $ltime = getMTime($dirName."/".$entry,$ltime);
            }
        }
    }
    $d->close();
    return $ltime;
}
$mtime = getMTime($realcwd,$mtime);

define('APP_VER', (getenv('ENV_APP_VER'))
   ?(string)(getenv('ENV_APP_VER'). date(".mdHi", $mtime))
   :null
);
echo '<script>console.info("🚩App_ver: '.APP_VER.'")</script>';

$cur_dir = defined('WP_SITEURL') ? str_replace('_', '', basename(WP_SITEURL)) : $realcwd ;

#--------------------------- vw.Debugging
if (! defined('ABSPATH')) {           //-vw: copied here as need for Debuginfo
   define('ABSPATH', __DIR__ . '/');
}
echo (DEV_MODE > 0)
   ? '<script>console.log("'
   . 'CACHE:      '.(is_dir(".\wp-content\cache")?"not cleared!🚧":"is empty!💢")
   . '\nDevMode:    ' . DEV_MODE . ' (Debug:'.json_encode(WP_DEBUG).',Cache:'.json_encode(WP_CACHE). ')'
   . '\nDatabase:   ' . strtoupper(ENV_DB_NAME) .' (on '. ENV_DB_HOST.')'
   . '\nWPHome:     ' . (defined('WP_HOME')?WP_HOME:'')        // Site url
   . '\nWPSite:     ' . (defined('WP_SITEURL')?WP_SITEURL:'')  // WordPress Address (subdir?)
   . '\nServer:     ' . $_SERVER['SERVER_NAME']. ' (Protocol:' . $_SERVER['SERVER_PROTOCOL'].')'
   . '\nReq.Scheme: ' . $_SERVER['REQUEST_SCHEME'] . ' (Port:' . $_SERVER['SERVER_PORT'].')'
   . '\nHost:       ' . $_SERVER['HTTP_HOST']
   . '\nDocRoot:    ' . $_SERVER['DOCUMENT_ROOT']
   . '\nABSPATH:    ' . str_replace("\\","/",ABSPATH)
   . '\nCWD:        ' . $realcwd  // Current Working Directory/subdir
   . '\ncur_dir:    ' . $cur_dir  // basename
   . '\nReqURI:     ' . $_SERVER['REQUEST_URI']
   . '\nPHPSelf:    ' . $_SERVER['PHP_SELF']
   . '")</script>'
   : '';

if (DEV_MODE > 2) {
   echo '<br>🚩WP_HOME: ';
   var_dump(WP_HOME);
   echo '<br>🚩GLOBALS: ';
   var_dump($GLOBALS);
   die("<br>🛑here90 - DIE!");
};

/* That's all, stop editing! Happy publishing. */
/* ------------------------------------------- */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
   define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
