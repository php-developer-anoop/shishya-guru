<?php
/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
*/
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');
/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
*/
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');
/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
*/
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2_592_000);
defined('YEAR') || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);
/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
*/
defined('EXIT_SUCCESS') || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);
/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);
/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);
define('ADMINPATH', 'admin/');
define('TUTORPATH', 'tutor/');
define('LEADS_COUNT', '10');

//SMS API
defined('SMSKEY') OR define('SMSKEY', 'c441836a439b56dbfe5a3f7ce6c9cf59');
defined('SENDERID') OR define('SENDERID', 'DTECHS');
defined('ROOTID') OR define('ROOTID', '8');
defined('SMS_API_PATH') OR define('SMS_API_PATH', 'http://mysms.msgclub.net/');
defined('GOOGLE_MAP_API_KEY') || define('GOOGLE_MAP_API_KEY', 'AIzaSyAGTqD-jUhHoWafG22xe3K4lww_7dugFZw');
//PAYMENT MODE
defined('INSTAMOZO_MODE') OR define('INSTAMOZO_MODE', 'TEST');

if (INSTAMOZO_MODE == 'PROD') {
    defined('INSTAMOZO_API_KEY') OR define("INSTAMOZO_API_KEY", '');
    defined('INSTAMOZO_AUTH_TOKEN') OR define("INSTAMOZO_AUTH_TOKEN", '');
    defined('INSTAMOZO_URL') OR define("INSTAMOZO_URL", 'https://www.instamojo.com/api/1.1/payment-requests/');
   // defined('INSTAMOZO_URL_WEB') OR define("INSTAMOZO_URL_WEB", 'https://www.cashfree.com/checkout/post/submit');
} else {
    defined('INSTAMOZO_API_KEY') OR define("INSTAMOZO_API_KEY", 'test_e2dd5d69cf88f3b0b0197f939f2');
    defined('INSTAMOZO_AUTH_TOKEN') OR define("INSTAMOZO_AUTH_TOKEN", 'test_7e126748fe385ae70b4814911d1');
    defined('INSTAMOZO_URL') OR define("INSTAMOZO_URL", 'https://test.instamojo.com/api/1.1/payment-requests/');
   // defined('INSTAMOZO_URL_WEB') OR define("INSTAMOZO_URL_WEB", 'https://sandbox.cashfree.com/pg/orders');
}
