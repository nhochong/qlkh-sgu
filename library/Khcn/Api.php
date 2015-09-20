<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 9401 2011-10-18 21:03:49Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Api
{
  protected static $_instance;
  
  protected static $_errorCode = null;
  
  /**
   * @var array User objects by id
   */
  protected $_users = array();

  /**
   * @var arraay User ids by email or id or username
   */
  protected $_indexes = array();

  /**
   * @var User_Model_User Contains the current viewer instance
   */
  protected $_viewer;

  /**
   * @var Zend_Auth Authentication object
   */
  protected $_auth;

  /**
   * @var Zend_Auth_Adapter_Interface Authentication adapter object
   */
  protected $_authAdapter;

  /**
   * The internal error reporting level mask
   * 
   * @var integer
   */
  protected static $_errorReporting = E_ALL;

  /**
   * The current application instance
   * 
   * @var Engine_Application
   */
  protected $_application;

  /**
   * An array of module api objects
   * 
   * @var array
   */
  protected $_modules = array();
  
  /**
   * Contains the current set module name
   * @var string
   */
  protected $_currentModuleName;
  
  /**
   * @var array assoc map of item type => module
   */
  protected $_itemTypes;
  
  /**
   * Get or create the current api instance
   * 
   * @return Engine_Api
   */
  public static function getInstance()
  {
    if( is_null(self::$_instance) ) {
      self::$_instance = new self();
    }
    
    return self::$_instance;
  }

  /**
   * Shorthand for getInstance
   *
   * @return Engine_Api
   */
  public static function _()
  {
    return self::getInstance();
  }

  /**
   * Set or unset the current api instance
   * 
   * @param Engine_Api $api
   * @return Engine_Api
   */
  public static function setInstance(Khcn_Api $api = null) 
  {
    return self::$_instance = $api;
  }

  public function getAutoloader()
  {
    if( null === $this->_autoloader )
    {
      throw new Exception('Autoloader not set');
    }

    return $this->_autoloader;
  }

  public function setAutoloader(Khcn_Application_Autoloader $autoloader)
  {
    $this->_autoloader = $autoloader;
    return $this;
  }



  // Application
  
  /**
   * Sets the current application instance
   * 
   * @param Engine_Application $application
   * @return Engine_Api
   */
  public function setApplication(Khcn_Application $application)
  {
    $this->_application = $application;
    return $this;
  }

  /**
   * Gets the current application object
   * 
   * @return Engine_Application
   * @throws Engine_Api_Exception If application is not set
   */
  public function getApplication()
  {
    if( null === $this->_application ) {
      throw new Khcn_Api_Exception('Application instance not set');
    }
    
    return $this->_application;
  }



  // Bootstraps
  
  /**
   * Checks if the specfied module has been bootstrapped
   * 
   * @param string $name The module name
   * @return bool
   */
  public function hasModuleBootstrap($name)
  {
    return isset($this->_modules[$name]);
  }

  /**
   * Sets the local copy of a module bootstrap
   * 
   * @param Zend_Application_Module_Bootstrap $bootstrap
   * @return Engine_Api
   */
  public function setModuleBootstrap(Khcn_Application_Bootstrap_Abstract $bootstrap)
  {
    $name = strtolower($bootstrap->getModuleName());
    $this->_modules[$name] = $bootstrap;
    return $this;
  }

  /**
   * Gets a module bootstrap
   * 
   * @param string $name The module name
   * @return Zend_Application_Module_Bootstrap|Zend_Application_Bootstrap_Bootstrap
   * @throws Engine_Api_Exception If module not found
   */
  public function getModuleBootstrap($name = null)
  {
    if( !$name )
    {
      $name = Zend_Controller_Front::getInstance()->getDefaultModule();
    }

    if( !isset($this->_modules[$name]) )
    {
      // Special case, default module can be detected and set
      if( $name == Zend_Controller_Front::getInstance()->getDefaultModule() )
      {
        $this->_modules[$name] = $this->getApplication()->getBootstrap();
      }

      // Normal modules must be registered manually
      else
      {
        throw new Khcn_Api_Exception(sprintf('Module "%s" not found', $name));
      }
    }

    return $this->_modules[$name];
  }
  
  /**
   * Shorthand for loadModuleApi
   *
   * @return Engine_Application_Module_Api
   * @throws Engine_Api_Exception If given improper arguments or module is missing
   */
  public function __call($method, $args)
  {
    if( 'get' == substr($method, 0, 3) )
    {
      $type = strtolower(substr($method, 3));
      if( empty($args) )
      {
        throw new Khcn_Api_Exception("Cannot load resources; no resource specified");
      }
      $resource = array_shift($args);
      $module = array_shift($args);
      if( $module === null )
      {
        if( $this->_currentModuleName === null )
        {
          throw new Khcn_Api_Exception("Cannot load resources; no module specified");
        }
        else
        {
          $module = $this->_currentModuleName;
          $this->_currentModuleName = null;
        }
      }
      
      return $this->load($module, $type, $resource);
    }

    // Backwards
    return $this->load($method, 'api', 'core');
  }
  
  public function load($module, $type, $resource)
  {
    if( strtolower($type) == 'dbtable' ) {
      $type = 'Model_DbTable';
    }
    return Khcn_Loader::getInstance()->load(ucfirst($module) . '_' . ucfirst($type) . '_' . ucfirst($resource), true);
  }
  
  // Users

  /**
   * Gets an instance of a user
   *
   * @param mixed $identity An id, username, or email
   * @return User_Model_User
   */
  public function getUser($identity)
  {
    // Identity is already a user!
    if( $identity instanceof Default_Model_NguoiDung ) {
      return $identity;
    }

    // Lookup in index
    $user = $this->_lookupUser($identity);
    if( $user instanceof Default_Model_NguoiDung ) {
      return $user;
    }
    
    // Create new instance
    $user = $this->_getUser($identity);
    if( null === $user ) {
      $user = new Default_Model_NguoiDung(array());
    } else {
      $this->_indexUser($user);
    }

    return $user;
  }
  
  /**
   * Gets an instance of multiple users
   *
   * @param array $ids
   * @return array An array of Core_Model_Item_Abstract
   */
  public function getUserMulti(array $ids)
  {
    // Remove any non-numeric values and already retv rows
    $getIds = array();
    foreach( $ids as $index => $value ) {
      if( !is_numeric($value) ) {
        unset($ids[$index]);
      } else if( !isset($this->_users[$value]) ) {
        $getIds[] = $value;
      }
    }

    // Now get any remaining rows, if necessary
    if( !empty($getIds) ) {
      foreach( Engine_Api::_()->getItemTable('user')->find($getIds) as $row ) {
        $this->_indexUser($this->_getUser($row));
      }
    }

    // Now build the return data
    $users = array();
    foreach( $ids as $id ) {
      if( isset($this->_users[$id]) ) {
        $users[] = $this->_users[$id];
      }
    }
    
    return $users;
  }



  // Viewer

  /**
   * Gets the current viewer instance using the authentication storage
   *
   * @return User_Model_User
   */
  public function getViewer()
  {
    if( null === $this->_viewer ){
		$identity = $this->getAuth()->getIdentity();
		$this->_viewer = $this->_getUser($identity);
	}
	return $this->_viewer;
  }

  public function setViewer(User_Model_User $viewer = null)
  {
    $this->_viewer = $viewer;
    return $this;
  }



  // Authentication

  /**
   * Authenticate user
   *
   * @param string $identity Email
   * @param string $credential Password
   * @return Zend_Auth_Result
   */
  public function authenticate($identity, $credential)
  {
    // Translate email
    $userTable = Khcn_Api::_()->getItemTable('default_nguoi_dung');
    $userIdentity = $userTable->select()
      ->from($userTable, 'id')
      ->where('`ten_dang_nhap` = ?', $identity)
      ->limit(1)
      ->query()
      ->fetchColumn(0)
      ;

    $authAdapter = $this->getAuthAdapter()
      ->setIdentity($userIdentity)
      ->setCredential(md5($credential));

    return $this->getAuth()->authenticate($authAdapter);
  }

  /**
   * Get the authentication object
   *
   * @return Zend_Auth
   */
  public function getAuth()
  {
    if( null === $this->_auth ) {
      $this->_auth = Zend_Auth::getInstance();
    }
    return $this->_auth;
  }

  /**
   * Set the authentication object
   *
   * @param Zend_Auth $auth
   * @return User_Api_Core
   */
  public function setAuth(Zend_Auth $auth)
  {
    $this->_auth = $auth;
    return $this;
  }

  /**
   * Get the authentication adapter
   *
   * @return Zend_Auth_Adapter_Interface
   */
  public function getAuthAdapter()
  {
    if( null === $this->_authAdapter ) {
      $db = Khcn_Db_Table::getDefaultAdapter();
      $tablePrefix = Khcn_Db_Table::getTablePrefix();

      $this->_authAdapter = new Zend_Auth_Adapter_DbTable(
        $db,
        Khcn_Api::_()->getItemTable('default_nguoi_dung')->info('name'),
        'id',
        'mat_khau'
      );
    }
    return $this->_authAdapter;
  }

  /**
   * Set the authentication adapter object
   *
   * @param Zend_Auth_Adapter_Interface $authAdapter
   * @return Zend_Auth
   */
  public function setAuthAdapter(Zend_Auth_Adapter_Interface $authAdapter)
  {
    $this->_authAdapter = $authAdapter;
    return $this;
  }



  /* Utility */

  /**
   * Indexes a user object internally by id, username, email
   *
   * @param User_Model_User $user A user object
   * @return void
   */
  protected function _indexUser(User_Model_User $user)
  {
    // Ignore if not an actual user or user is already set
    if( !empty($user->user_id) && !isset($this->_users[$user->user_id]) ) {
      $this->_indexes[$user->user_id] = $user->user_id;

      if ( !empty($user->email)){
        $this->_indexes[$user->email] = $user->user_id;
      }

      if ( !empty($user->username)){
        $this->_indexes[$user->username] = $user->user_id;
      }
      
      $this->_users[$user->user_id] = $user;
    }
  }

  /**
   * Looks up a user by id, username, email
   *
    * @param mixed $identity
   * @return integer|false
   */
  protected function _lookupUser($identity)
  {
    $index = null;
    if( is_scalar($identity) && isset($this->_indexes[$identity]) ) {
      $index = $identity;
    } else if( $identity instanceof Zend_Db_Table_Row_Abstract && isset($identity->user_id) ) {
      $index = $identity->id;
    } else if( is_array($identity) && is_string($identity[0]) && is_numeric($identity[1]) ) {
      $index = $identity[1];
    }

    if( isset($this->_indexes[$index]) && isset($this->_users[$this->_indexes[$index]]) ) {
      return $this->_users[$this->_indexes[$index]];
    }

    return null;
  }

  protected function _getUser($identity)
  {
    if( !$identity ) {
      $user = new Default_Model_NguoiDung(array(
        'table' => Khcn_Api::_()->getItemTable('default_nguoi_dung'),
      ));
    } else if( $identity instanceof Default_Model_NguoiDung ) {
      $user = $identity;
    } else if( is_numeric($identity) ) {
      $user = $this->getItemTable('default_nguoi_dung')->find($identity)->current();
    } else if( is_string($identity) && strpos($identity, '@') !== false ) {
      $user = $this->getItemTable('default_nguoi_dung')->fetchRow(array(
        'email = ?' => $identity,
      ));
    } else /* if( is_string($identity) ) */ {
      $user = Khcn_Api::_()->getItemTable('default_nguoi_dung')->fetchRow(array(
        'ten_dang_nhap = ?' => $identity,
      ));
    }
	
    // Empty user?
    if( null === $user ) {
      return new Default_Model_NguoiDung(array());
    }
    
    return $user;
  }

  public function randomPass($len)
  {
    $code = NULL;
    $lchar = '';
    $pass = '';
    for( $i=0; $i<$len; $i++ ) {
      $char = chr(rand(48,122));
      while( !preg_match("[a-zA-Z0-9]", $char) ) {
        if( $char == $lchar ) {
          continue;
        }
        $char = chr(rand(48,90));
      }
      $pass .= $char;
      $lchar = $char;
    }
    return $pass;
  }
  
  
 /**
   * Loads a singleton instance of a module resource using a full class name
   *
   * @param string $class The class name
   * @return mixed The requested singleton object
   */
  public function loadClass($class)
  {
    return Khcn_Loader::getInstance()->load($class);
  }
  
  /**
   * Gets the class of the dbtable that an item type belongs to
   *
   * @param string $type The item type
   * @return string The table class name
   */
  public function getItemTableClass($type)
  {
	list($module, $resourceName)
      = explode('_', $type, 2);
	  
    // Generate item table class manually
    $class = ucwords($module) . '_Model_DbTable_' . self::typeToClassSuffix($type, $module);
	
    return $class;
  }
  
  /**
   * Gets a singleton instance of the dbtable an item type belongs to
   *
   * @param string $type The item type
   * @return Khcn_Db_Table The table object
   */
  public function getItemTable($type){
    
    $class = $this->getItemTableClass($type);
    return $this->loadClass($class);
  }
  
  /**
   * Gets a singleton instance of the dbtable an item type belongs to
   *
   * @param string $type The item type
   * @return Khcn_Db_Table The table object
   */
  public function getDbTable($name, $module){
    $type = $module . '_' . $name;
	$class = $this->getItemTableClass($type);
    return new $class;
  }
  
  /**
   * Used to inflect item class to type.
   * 
   * @param string $class
   * @param string $module
   * @return string
   * @throws Engine_Api_Exception If given improper arguments
   */
  static public function classToType($class, $module)
  {
    list($classModule, $resourceType, $resourceName)
      = explode('_', $class, 3);

    // Throw stuff
    if( strtolower($classModule) != strtolower($module) )
    {
      throw new Khcn_Api_Exception('class and module do not match');
    }
    else if( $resourceType != 'Model' )
    {
      throw new Khcn_Api_Exception('resource type must be a model');
    }
	 
    // Parse camel case
    preg_match_all('/([A-Z][a-z]+)/', $resourceName, $matches);
    if( empty($matches[0]) )
    {
      throw new Khcn_Exception('resource name not useable');
    }
    $matches = $matches[0];
	
    // Append module name if first not equal
    if( strtolower($matches[0]) != strtolower($module) )
    {
      array_unshift($matches, $module);
    }
    $type = strtolower(join('_', $matches));
    return $type;
  }
  
  /**
   * Used to inflect item types to class suffix.
   * 
   * @param string $type
   * @param string $module
   * @return string
   */
  static public function typeToClassSuffix($type, $module)
  {
    $parts = explode('_', $type);
    if( count($parts) > 1 && $parts[0] === strtolower($module) )
    {
      array_shift($parts);
    }
    $partial = str_replace(' ', '', ucwords(join(' ', $parts)));
    return $partial;
  }
  
  
  public function getItem($type, $identity)
  {
    return $this->getItemTable($type)->find($identity)->current();
  }
  
  /**
   * Creates a random error code
   * 
   * @param bool $reset
   */
  static public function getErrorCode($reset = false)
  {
    if( $reset === true || self::$_errorCode == null ){
      $code = md5(uniqid('', true));
      self::$_errorCode = substr($code, 0, 2)
                        . substr($code, 15, 2)
                        . substr($code, 30, 2);
    }
    return self::$_errorCode;
  }
  
  public function subPhrase($string, $length = 0) {
		if (strlen ( $string ) <= $length)
			return $string;
		$pos = $length;
		for($i = $length - 1; $i >= 0; $i --) {
			if ($string [$i] == " ") {
				$pos = $i + 1;
				break;
			}
		}
		return substr ( $string, 0, $pos ) . "...";
  }
  
  // Utility

  static public function inflect($string)
  {
    return str_replace(' ', '', ucwords(str_replace(array('.', '-'), ' ' , $string)));
  }

  static public function deflect($string)
  {
    return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2', $string), '-. '));
    //return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2', preg_replace('/[^A-Za-z0-9-]/', '', $string)), '-. '));
  }
}
