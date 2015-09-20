<?php
class Bootstrap extends Khcn_Application_Bootstrap_Abstract
{
	protected function _initAutoload() 
    {
          $autoloader = new Zend_Application_Module_Autoloader(
                         array ('namespace' => '',
                               'basePath' => APPLICATION_PATH )
                         );
          return $autoloader;       
    }
    
    protected function _initDb ()
    {
        $dbOption = $this->getOption('resources');
        $dbOption = $dbOption['db'];
        $db = Zend_Db::factory($dbOption['adapter'], $dbOption['params']);
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        $db->query("SET NAMES 'utf8'");
        $db->query("SET CHARACTER SET 'utf8'");
        Zend_Registry::set('connectDB', $db);
        Zend_Registry::set('configDB', $dbOption['params']);
        //khi thiết lập chế độ này model mới có thể sử dụng
        Zend_Db_Table::setDefaultAdapter($db);
        //no thuoc kieu tra ve,nen phai luu trong bootsrtap
        return $db;
    }
    
	protected function _initDocType()
    {
        $this->bootstrap('View');
        $view = $this->getResource('View');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initControllers(){
    	//$frontController = Zend_Controller_Front::getInstance();    
    	//$acl = new Khcn_Model_Acl();
    	//$auth = Zend_Auth::getInstance();
    	//$frontController->registerPlugin(new Khcn_Controller_Plugin_Acl($acl, $auth));
    }
    
	public function _initSession(){      
		Zend_Session::start();
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
	
	protected function _initLayout()
	{
		// Create layout
		$layout = Zend_Layout::startMvc();

		return $layout;
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
		//$viewRenderer = new Engine_Controller_Action_Helper_ViewRenderer($view);
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
	
	/**
	* Adds the view helper path for this module to the view
	* 
	* @return Engine_Application_Bootstrap_Abstract
	*/
	public function initViewHelperPath()
	{
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$view = $viewRenderer->view;
		if( is_null($view) )
		{
			return $this;
			//throw new Zend_Application_Exception("Could not get an instance of the view object");
		}

		// Module Default
		$path = MODULE_PATH . '/Default/View/Helper/';
		$prefix = 'Default_View_Helper_';
		$view->addHelperPath($path, $prefix);
		
		// Module Admin
		$path = MODULE_PATH . '/Admin/View/Helper/';
		$prefix = 'Admin_View_Helper_';
		$view->addHelperPath($path, $prefix);

		// Default
		$path = APPLICATION_PATH_LIB . '/Khcn/View/Helper/';
		$prefix = 'Khcn_View_Helper_';
		$view->addHelperPath($path, $prefix);
		
		return $this;
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
  
	protected function _initFrontControllerModules()
	{
		$frontController = Zend_Controller_Front::getInstance();
		$path = APPLICATION_PATH . DIRECTORY_SEPARATOR ."modules";

		$enabledModuleNames = Khcn_Api::_()->getDbtable('modules', 'default')->getEnabledModuleNames();
		var_dump($enabledModuleNames);die;
		foreach( $enabledModuleNames as $module ) {
		  $moduleInflected = Engine_Api::inflect($module);
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
		$frontController->setDefaultModule('default');
	}
}
