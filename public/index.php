<?php
/*uncomment this function if your host environment will not allow you to turn off magic_quotes
if (get_magic_quotes_gpc()) {
   function stripslashes_deep($value)
   {
       $value = is_array($value) ?
                   array_map('stripslashes_deep', $value) :
                   stripslashes($value);

       return $value;
   }

   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
   $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}/**/

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('LIBRARY_PATH')
    || define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/../library'));

if (strpos($_SERVER['SERVER_NAME'], '.local') || strpos($_SERVER['SERVER_NAME'], '.kfx2')) {
    define('APPLICATION_ENV','development');
}
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH,
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';  

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV, 
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()->run();