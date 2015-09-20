<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
 
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('PS') || define('PS', PATH_SEPARATOR);
defined('_ENGINE') || define('_ENGINE', true);
defined('_ENGINE_REQUEST_START') || 
    define('_ENGINE_REQUEST_START', microtime(true));
	
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Define base path obtainable throughout the whole application
    defined('BASE_PATH')
        || define('BASE_PATH', realpath(dirname(__FILE__)));
/**
* Define path to Web Root
* 
* Định nghĩa đường dẫn tới webroot
*/
defined('WEB_ROOT')
    || define('WEB_ROOT', realpath(dirname(dirname(__FILE__))));
    
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('APPLICATION_PATH_LIB') || 
    define('APPLICATION_PATH_LIB', WEB_ROOT . DS . 'library');
	
/**
* Define path to Application directory
* 
* Định nghĩa đường dẫn tới thư mục application
*/     
defined('MODULE_PATH')
    || define('MODULE_PATH', APPLICATION_PATH . '/modules');

/**
* Define path to public_html directory
* 
* Định nghĩa đường dẫn tới thư mục public_html
*/
defined('PUBLIC_PATH')
    || define('PUBLIC_PATH', BASE_PATH);
    
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

defined('APPLICATION_NAME') || define('APPLICATION_NAME', 'Default');
defined('APPLICATION_PATH_COR') || 
    define('APPLICATION_PATH_COR', APPLICATION_PATH);
	
defined('APPLICATION_PATH_BTS') || 
    define('APPLICATION_PATH_BTS', APPLICATION_PATH_COR . DS . 'bootstraps');
defined('APPLICATION_PATH_LIB') || 
    define('APPLICATION_PATH_LIB', APPLICATION_PATH_COR . DS . 'libraries');
defined('APPLICATION_PATH_MOD') || 
    define('APPLICATION_PATH_MOD', APPLICATION_PATH_COR . DS . 'modules');
defined('APPLICATION_PATH_PLU') || 
    define('APPLICATION_PATH_PLU', APPLICATION_PATH_COR . DS . 'plugins');
defined('APPLICATION_PATH_SET') || 
    define('APPLICATION_PATH_SET', APPLICATION_PATH_COR . DS . 'settings');
defined('APPLICATION_PATH_WID') || 
    define('APPLICATION_PATH_WID', APPLICATION_PATH_COR . DS . 'widgets');
	
// Ensure library/ is on include_path
/*set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    //APPLICATION_PATH . '/modules/default/models',
	APPLICATION_PATH . '/modules/',
    get_include_path(),
)));*/

set_include_path(
  APPLICATION_PATH_LIB . PS .
  APPLICATION_PATH_LIB . DS . 'PEAR' . PS .
  '.' // get_include_path()
);

// get general config
if( file_exists(APPLICATION_PATH_SET . DS . 'general.php') ) {
  $generalConfig = include APPLICATION_PATH_SET . DS . 'general.php';
} else {
  $generalConfig = array('environment_mode' => 'production');
}

  // maintenance mode
if( !defined('_ENGINE_R_MAINTENANCE') || _ENGINE_R_MAINTENANCE ) {
  if( !empty($generalConfig['maintenance']['enabled']) && !empty($generalConfig['maintenance']['code']) ) {
    $code = $generalConfig['maintenance']['code'];
    if( @$_REQUEST['en4_maint_code'] == $code ) {
      if( @$_COOKIE['en4_maint_code'] !== $code ) {
        setcookie('en4_maint_code', $code, time() + (86400 * 7), '/');
      }
    } else {
      echo file_get_contents(APPLICATION_PATH . DS . 'maintenance.html');
      exit();
    }
  }
}

// development mode
$application_env = @$generalConfig['environment_mode'];
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (
  !empty($_SERVER['_ENGINE_ENVIRONMENT']) ? $_SERVER['_ENGINE_ENVIRONMENT'] : (
  $application_env ? $application_env :
  'production'
)));

// Sub apps
if( !defined('_ENGINE_R_MAIN') && !defined('_ENGINE_R_INIT') ) {
  if( isset($_GET['m']) && @$_GET['m'] == 'css' ) {
    define('_ENGINE_R_MAIN', 'css.php');
    define('_ENGINE_R_INIT', false);
  } else if( isset($_GET['m']) && @$_GET['m'] == 'lite' ) {
    define('_ENGINE_R_MAIN', 'lite.php');
    define('_ENGINE_R_INIT', true);
  } else {
    define('_ENGINE_R_MAIN', false);
    define('_ENGINE_R_INIT', true);
  }
}

// Boot
if( _ENGINE_R_INIT ) {
	// Application
	require_once 'Khcn/Loader.php';
	require_once 'Khcn/Application.php';

	// Create application, bootstrap, and run
	$application = new Khcn_Application(
	array(
	  'environment' => APPLICATION_ENV,
	  'bootstrap' => array(
		'path' => APPLICATION_PATH . DS . 'modules' . DS . APPLICATION_NAME . DS . 'Bootstrap.php',
		'class' => ucfirst(APPLICATION_NAME) . '_Bootstrap',
	  ),
	  'autoloaderNamespaces' => array(
		'Zend'      => APPLICATION_PATH_LIB . DS . 'Zend',
		'Engine'    => APPLICATION_PATH_LIB . DS . 'Khcn',
		'Classes'  => APPLICATION_PATH_LIB . DS . 'Classes',
		'PHPExcel'  => APPLICATION_PATH_LIB . DS . 'Classes/PHPExcel',

		'Bootstrap' => APPLICATION_PATH_BTS,
		'Plugin'    => APPLICATION_PATH_PLU,
		'Widget'    => APPLICATION_PATH_WID,
	  ),
	)
	);
	Khcn_Application::setInstance($application);
	Khcn_Api::getInstance()->setApplication($application);
}

// config mode
if( defined('_ENGINE_R_CONF') && _ENGINE_R_CONF ) {
  return;
}


// Sub apps
if( _ENGINE_R_MAIN ) {
  require APPLICATION_PATH . DS . _ENGINE_R_MAIN;
  exit();
}

// Main app
else {
  $application->bootstrap();
  $application->run();
}