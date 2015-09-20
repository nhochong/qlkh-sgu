<?php
class Default_Bootstrap extends Khcn_Application_Bootstrap_Abstract 
{
	public function __construct($application)
  {
    parent::__construct($application);

    date_default_timezone_set('UTC');

    if( function_exists('mb_internal_encoding') ) {
      mb_internal_encoding("UTF-8");
    }

    if( function_exists('iconv_set_encoding') ) {
      // Not sure if we want to do all of these
      iconv_set_encoding("input_encoding", "UTF-8");
      iconv_set_encoding("output_encoding", "UTF-8");
      iconv_set_encoding("internal_encoding", "UTF-8");
    }
  }

  public function run()
  {
    // Ensure frontcontroller and router are bootstrapped
    $this->bootstrap('frontcontroller');
    $this->bootstrap('router');
    $front = $this->getContainer()->frontcontroller;

    // Start main
    $default = $front->getDefaultModule();
    if (null === $front->getControllerDirectory($default)) {
        throw new Zend_Application_Bootstrap_Exception(
            'No default controller directory registered with front controller'
        );
    }
    // End main

    // Start main 2
    $front->setParam('bootstrap', $this);
    $front->dispatch();
    // End main 2
    
    // Close the session to prevent chicken-egg
    // http://bugs.php.net/bug.php?id=33772
    Zend_Session::writeClose();
  }

	protected function _initDb()
	{	
		$file = APPLICATION_PATH . '/settings/database.php';
		$options = include $file;

		$db = Zend_Db::factory($options['adapter'], $options['params']);
		Khcn_Db_Table::setDefaultAdapter($db);
		Khcn_Db_Table::setTablePrefix($options['tablePrefix']);
		
		// Non-production
		if( APPLICATION_ENV !== 'production' ) {
		  $db->setProfiler(array(
			'class' => 'Zend_Db_Profiler_Firebug',
			'enabled' => true
		  ));
		}

		// set DB to UTC timezone for this session
		switch( $options['adapter'] ) {
		  case 'mysqli':
		  case 'mysql':
		  case 'pdo_mysql': {
			  $db->query("SET time_zone = '+0:00'");
			  break;
		  }

		  case 'postgresql': {
			  $db->query("SET time_zone = '+0:00'");
			  break;
		  }

		  default: {
			// do nothing
		  }
		}

		// attempt to disable strict mode
		try {
		  $db->query("SET SQL_MODE = ''");
		} catch (Exception $e) {}

		$profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
		//$profiler->setEnabled(true);
		//$db->setProfiler($profiler);
		
		Zend_Registry::set('connectDB', $db);
        Zend_Registry::set('configDB', $options['params']);
		
		return $db;
	}

	protected function _initFrontController()
	{
		Zend_Controller_Action_HelperBroker::addPath("Khcn/Controller/Action/Helper/", 'Khcn_Controller_Action_Helper');

		$frontController = Zend_Controller_Front::getInstance();
		$frontController
		  //->addModuleDirectory(APPLICATION_PATH . "/application/modules/")
		  ->setDefaultModule('default')
		  ->setParam('viewSuffix', 'phtml')
		  ->setParam('prefixDefaultModule', 'true');

		// Add our special path for action helpers
		$this->initActionHelperPath();

		// Our virtual index hack confuses the request class, this other hack will
		// make it think it's in the root folder
		$request = new Zend_Controller_Request_Http();
		$script = $_SERVER['SCRIPT_NAME'];
		$_SERVER['SCRIPT_NAME'] = str_replace('/application/', '/', $script);
		$frontController->setBaseUrl($request->getBaseUrl());
		$_SERVER['SCRIPT_NAME'] = $script;
		
		// Save to registy and local container
		Zend_Registry::set('Zend_Controller_Front', $frontController);
		return $frontController;
	}

	protected function _initLog()
	{
		$log = new Zend_Log();
		$log->setEventItem('domain', 'error');

		// Non-production
		if( APPLICATION_ENV !== 'production' ) {
			$log->addWriter(new Zend_Log_Writer_Firebug());
		}
		
		// Get log config
		try {
			$log->addWriter(new Zend_Log_Writer_Stream(WEB_ROOT . '/temporary/log/main.log'));
		} catch( Exception $e ) {
		  // Check directory
		  if( !@is_dir(WEB_ROOT . '/temporary/log') &&
			  @mkdir(WEB_ROOT . '/temporary/log', 0777, true) ) {
			$log->addWriter(new Zend_Log_Writer_Stream(WEB_ROOT . '/temporary/log/main.log'));
		  } else {
			// Silence ...
			if( APPLICATION_ENV !== 'production' ) {
			  $log->log($e->__toString(), Zend_Log::CRIT);
			} else {
			  // Make sure logging doesn't cause exceptions
			  $log->addWriter(new Zend_Log_Writer_Null());
			}
		  }
		}
			
		// Save to registry
		Zend_Registry::set('Zend_Log', $log);

		return $log;
	}

	protected function _initFrontControllerModules()
	{
		$frontController = Zend_Controller_Front::getInstance();
		$path = APPLICATION_PATH . DIRECTORY_SEPARATOR ."modules";

		$enabledModuleNames = Khcn_Api::_()->getDbtable('modules', 'default')->getEnabledModuleNames();
		foreach( $enabledModuleNames as $module ) {
		  $moduleInflected = Khcn_Api::inflect($module);
		  $moduleDir = $path . DIRECTORY_SEPARATOR . $moduleInflected;
		  if( is_dir($moduleDir) ) {
			$moduleDir .= DIRECTORY_SEPARATOR . $frontController->getModuleControllerDirectoryName();
			$frontController->addControllerDirectory($moduleDir, $module);
		  } else {
			// Maybe we should log modules that fail to load?
			if( APPLICATION_ENV == 'development' ) {
			  throw new Engine_Exception('failed to load module "' . $module . '"');
			}
		  }
		}

		$frontController
		  ->setDefaultModule('default');
	}

	protected function _initSession()
	{
		Zend_Session::start();
	}
	
	protected function _initRouter()
	{
		$router = $this->getContainer()->frontcontroller->getRouter();
		
		// Add default routes
		$router->addDefaultRoutes();
		
		return $router;
	}
	
	protected function _initView()
	{
		// Create view
		$view = new Zend_View();

		// Set encoding (@todo maybe use configuration?)
		$view->setEncoding('utf-8');

		$view->addScriptPath(APPLICATION_PATH);

		// Setup and register viewRenderer
		// @todo we may not need to override zend's
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer($view);
		$viewRenderer->setViewSuffix('phtml');
		Zend_Controller_Action_HelperBroker::getStack()->offsetSet(-80, $viewRenderer);

		// Add default helper paths
		$view->addHelperPath('Khcn/View/Helper/', 'Khcn_View_Helper_');
		$this->initViewHelperPath();
	
		// Set doctype
		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_STRICT');
		
		// Add to local container and registry
		Zend_Registry::set('Zend_View', $view);
		return $view;
	}
  
	protected function _initLayout()
	{
		// Create layout
		$layout = Zend_Layout::startMvc();

		return $layout;
	}
	
	/**
	* Initializes translator
	*
	* @return Zend_Translate_Adapter
	*/
	public function _initTranslate()
	{
		$log = new Zend_Log();
		if( APPLICATION_ENV == 'development' ) {
		  $log = new Zend_Log();
		  $log->addWriter(new Zend_Log_Writer_Firebug());
		  //$log->addWriter(new Zend_Log_Writer_Stream(APPLICATION_PATH . '/temporary/log/translate.log'));
		} else {
		  $log->addWriter(new Zend_Log_Writer_Null());
		}
		$params['log'] = $log;
		
		// Create the object and add a language
		$translate = new Zend_Translate('Array', APPLICATION_PATH . '/languages/vi/vi.php', 'vi_VN');
		// Add another translation
		$translate->addTranslation(APPLICATION_PATH . '/languages/en/en.php', 'en_US');
		// Set nb_NO as default translation
		$translate->setLocale('vi_VN');
		Zend_Registry::set('Zend_Translate',$translate);
		
		Zend_Validate_Abstract::setDefaultTranslator($translate);
		Zend_Form::setDefaultTranslator($translate);
		Zend_Controller_Router_Route::setDefaultTranslator($translate);
		
		return $translate;
	}

	protected function _initPaginator()
	{
		// Set up default paginator options
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial(array(
		  'pagination/search.tpl',
		  'default'
		));
	}

	protected function _initApi()
	{
		return Khcn_Api::_();
	}

	protected function _initModules()
	{
		//$front = null;
		//$default = 'core';
		//if( isset($this->getContainer()->frontcontroller) ) {
		  $front = $this->getContainer()->frontcontroller;
		  $default = $front->getDefaultModule();
		//}
		$bootstraps = new ArrayObject();

		// Prepare data
		$enabledModuleNames = Khcn_Api::_()->getDbtable('modules', 'default')->getEnabledModuleNames();
		$baseDir = WEB_ROOT;
		//$baseUrl = preg_replace('/[\/]*index\.php[\/]*/', '/', $front->getBaseUrl());

		foreach( $enabledModuleNames as $module ) {
		  $moduleInflected = Khcn_Api::inflect($module);
		  $moduleDir = $baseDir . DIRECTORY_SEPARATOR . 'application' 
			  . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $moduleInflected;
		
		  // Default module is already bootstrapped, but bootstrap others
		  
		  if( strtolower($module) === strtolower($default) ) {
			continue;
		  }
		  
		  $bootstrapClass = $moduleInflected . '_Bootstrap';
		  if( !class_exists($bootstrapClass, false) ) {
			$bootstrapPath  = $moduleDir . '/Bootstrap.php';
			if( file_exists($bootstrapPath) ) {
			  include_once $bootstrapPath;
			  if( !class_exists($bootstrapClass, false) ) {
				throw new Zend_Application_Resource_Exception('Bootstrap file found for module "' . $module . '" but bootstrap class "' . $bootstrapClass . '" not found');
			  }
			} else {
			  continue;
			}
		  }

		  $moduleBootstrap = new $bootstrapClass($this);
		  $moduleBootstrap->bootstrap();
		  $bootstraps[$module] = $moduleBootstrap;
		}

		return $bootstraps;
	}
}