<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Abstract.php 9339 2011-09-29 23:03:01Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
abstract class Khcn_Model_Item_Abstract extends Khcn_Db_Table_Row implements Khcn_Model_Item_Interface
{
  /**
   * @var string The module name of this model (say that 12 times fast)
   */
  protected $_moduleName;

  /**
   * The unique identifier of this instance
   *
   * @var integer|mixed
   */
  protected $_identity;

  /**
   * The resource type, i.e. user, group<div class=""></div>, etc
   *
   * @var string
   */
  protected $_type;

  /**
   * The short resource type (last class suffix)
   * 
   * @var string
   */
  protected $_shortType;
  
  /**
   * The short resource type (last class suffix)
   * 
   * @var string
   */
  protected $_classType;
  
  /**
   * For mixin objects to have local storage
   * 
   * @var stdClass
   */
  protected $_store;

  /**
   * List of columns that, when changed, will cause the search indexer to update
   *
   * @var array
   */
  protected $_searchTriggers = array('search', 'ten', 'chu_de', 'tieu_de', 'mo_ta', 'noi_dung');

  /**
   * List of columns that, when changed, will cause the modified_date column to
   * be updated
   *
   * @var array
   */
  protected $_modifiedTriggers = array('ten', 'chu_de', 'tieu_de', 'mo_ta', 'noi_dung');

  /**
   * Disable internal hooks?
   * @var boolean
   */
  protected $_disableHooks = false;
  
  /**
   * Abstract constructor
   * 
   * @param mixed $identity
   */
  public function __construct($config = array())
  {
    parent::__construct($config);
	
    // Get identity
    $primary = $this->getTable()->info(Zend_Db_Table_Abstract::PRIMARY);
    if( count($primary) !== 1 ) {
      throw new Khcn_Exception(sprintf('Item tables must have only a single primary column, given: %s', join(', ', $primary)));
    }
    $prop = array_shift($primary);
    if( !isset($this->$prop) ) {
      //throw new Khcn_Exception(sprintf('Primary column "%s" not defined', $prop));
    } else if( isset($this->$prop) ) {
      $this->_identity = $this->$prop;
    }
  }

  /**
   * Get the module this model belongs to
   *
   * @return string The module name of this model
   */
  public function getModuleName()
  {
    if( empty($this->_moduleName) )
    {
      $class = get_class($this);
      if (preg_match('/^([a-z][a-z0-9]*)_/i', $class, $matches)) {
        $prefix = $matches[1];
      } else {
        $prefix = $class;
      }
      $this->_moduleName = $prefix;
    }
    return $this->_moduleName;
  }
  
  /**
   * Gets the resource type of the current object. 
   * User_Model_User -> user
   * Album_Model_Photo -> album_photo
   *
   * @return string The type identifier (i.e. user, group, etc)
   */
  public function getType($inflect = false)
  {
    if( null === $this->_type )
    {
      $this->_type = Khcn_Api::classToType(get_class($this), $this->getModuleName());
    }

    if( $inflect )
    {
      return str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_type)));
    }
	
    return $this->_type;
  }
  
  /**
   * Get a short type (used for id column prefixes)
   * User_Model_User -> user
   * Album_Model_Photo -> photo
   * 
   * @param boolean $inflect
   * @return string
   */
  public function getShortType($inflect = false)
  {
    if( null === $this->_shortType )
    {
      $this->_shortType = ltrim(strrchr(strtolower(get_class($this)), '_'), '_');
    }

    if( $inflect )
    {
      return str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_shortType)));
    }

    return $this->_shortType;
  }
  
  public function getClassType($inflect = false){
	if( null === $this->_classType )
    {
	  $type = $this->getType();
	  $this->_classType = ltrim(strstr($type, '_'), '_');
    }

    if( $inflect )
    {
      return str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_classType)));
    }
	
    return $this->_classType;
  }
  
  /**
   * Gets the numeric unique identifier for this object
   *
   * @return integer|mixed
   */
  public function getIdentity()
  {
    return (int) $this->_identity;
  }

  /**
   * Gets a globally unique identitfier
   *
   * @param bool $asArray Return guid as an array of length two
   * @return string|array The guid
   */
  public function getGuid($asArray = false)
  {
    if( $asArray )
    {
      return array($this->getType(), $this->getIdentity());
    }

    else
    {
      return sprintf('%s_%d', $this->getType(), $this->getIdentity());
    }
  }

  /**
   * Gets an absolute URL to this resource
   *
   * @return string The URL
   */
  public function getHref()
  {
    return null;
    //throw new Khcn_Exception('getHref must be defined in child classes');
  }

  /**
   * Gets the title of the item. This would be a name for users
   *
   * @return string The title
   */
  public function getTitle()
  {
	if( isset($this->ten) )
    {
      return $this->ten;
    }
	if( isset($this->chu_de) )
    {
      return $this->chu_de;
    }
	if( isset($this->tieu_de) )
    {
      return $this->tieu_de;
    }
    if( isset($this->title) )
    {
      return $this->title;
    }
    return null;
  }

  /**
   * Gets a url slug for this item, based on it's title
   *
   * @return string The slug
   */
  public function getSlug($str = null)
  {
    if( null === $str ) {
      $str = $this->getTitle();
    }
    if( strlen($str) > 32 ) {
      $str = Khcn_String::substr($str, 0, 32) . '...';
    }
    
    $search  = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
    $replace = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
    $str = str_replace($search, $replace, $str);
    
    $str = preg_replace('/([a-z])([A-Z])/', '$1 $2', $str);
    $str = strtolower($str);
    $str = preg_replace('/[^a-z0-9-]+/i', '-', $str);
    $str = preg_replace('/-+/', '-', $str);
    $str = trim($str, '-');
    if( !$str ) {
      $str = '-';
    }
    return $str;
  }

  /**
   * Gets the description of the item. This might be about me for users (todo
   *
   * @return string The description
   */
  public function getDescription()
  {
	if( isset($this->mo_ta) )
    {
      return $this->mo_ta;
    }
	if( isset($this->noi_dung) )
    {
      return $this->noi_dung;
    }
    if( isset($this->description) )
    {
      return $this->description;
    }
    return '';
  }

  /**
   * Gets a url to the current photo representing this item. Return null if none
   * set
   *
   * @param string The photo type (null -> main, thumb, icon, etc);
   * @return string The photo url
   */
  public function getPhotoUrl($type = null)
  {
	// Remove files
	$column = null;
	if(isset($this->ten_file)){
		$column = 'ten_file';
	}
	if(isset($this->file)){
		$column = 'file';
	}
		
    if(empty($column) || empty($this->$column)){
      return null;
    }

    return Zend_Registry::get('Zend_View')->getBaseUrl() . '/upload/files/' . $this->getClassType() . '/' . $this->$column;
  }
  
  /**
   * Checks if this item is searchable
   * 
   * @return bool
   */
  public function isSearchable()
  {
    return ( (!isset($this->search) || $this->search) && !empty($this->_searchTriggers) && is_array($this->_searchTriggers) );
  }
  
  // Meta

  /**
   * Gets the primary table model associated with this class.
   *
   * @return Zend_Db_Table_Abstract
   */
  public function getTable()
  {
    return $this->_getTable();
  }

  /**
   * 
   * @return Zend_Db_Table_Abstract
   */
  protected function _getTable()
  {
    if( null === $this->_table )
    {
      $this->_table = Khcn_Api::_()->getItemTable($this->getType());
    }
    return $this->_table;
  }

  // Misc

  /**
   * Returns the local storage object
   *
   * @return stdClass
   */
  public function store()
  {
    return $this->_store;
  }

  /**
   * Checks if the passed item has the same guid as the object
   * 
   * @param Core_Model_Item_Abstract $item
   * @return bool
   */
  public function isSelf(Khcn_Model_Item_Abstract $item)
  {
    return ( $item->getGuid() === $this->getGuid() );
  }
  
  // Data type convertors
  
  /**
   * Experimetnal string accessor. Returns an html string representation of the
   * object
   * 
   * @return string
   */
  public function toString($attribs = array())
  {
    $href = $this->getHref();
    $title = $this->getTitle();
    $view = Zend_Registry::isRegistered('Zend_View') ? Zend_Registry::get('Zend_View') : null;
    
    if( !$href ) {
      return $title;
    } else if( !$view ) {
      return '<a href="'.$href.'">'.$title.'</a>';
    } else {
      return $view->htmlLink($href, $title, $attribs);
    }
  }

  /**
   * Magic Method for {self::toString()}
   * 
   * @return string
   */
  public function __toString()
  {
    try {
      return $this->toString();
    } catch( Exception $e ) {
      Zend_Registry::get('Zend_Log')->log($e, Zend_Log::ERR);
      return '';
    }
  }
  
  /**
   * Disable hooks. Sometimes required to prevent infinite loops in hooks.
   *
   * @param bool $flag
   * @return self
   */
  public function disableHooks($flag = true)
  {
    $this->_disableHooks = (bool) $flag;
    return $this;
  }
  
  /**
   * Pre-insert hook. If overridden, should be called at end of function.
   * 
   * @return void
   */
  protected function _insert()
  {
    if( $this->_disableHooks ) return;
    
    parent::_insert();

    if( isset($this->ngay_tao) ) {
      $this->ngay_tao = date('Y-m-d H:i:s');
    }
    
    // Should updated be initialized on creation or be left null?
    if( isset($this->ngay_sua) ) {
      $this->ngay_sua = date('Y-m-d H:i:s');
    }
  }

  /**
   * Post-insert hook. If overridden, should be called at end of function.
   *
   * @return void
   */
  protected function _postInsert()
  {
    if( $this->_disableHooks ) return;
    
    parent::_postInsert();

    // Get identity
    $primary = $this->getTable()->info(Zend_Db_Table_Abstract::PRIMARY);
    if( count($primary) !== 1 ) {
		throw new Khcn_Exception(sprintf('Item tables must have only a single primary column, given: %s', join(', ', $primary)));
    }
    $prop = array_shift($primary);
    $this->_identity = $this->$prop;
    
    // Search indexer
    if( $this->isSearchable() &&
        is_array($this->_searchTriggers) /* We don't need to check on insert &&
        count(array_intersect_key((array)@$this->_modifiedFields, array_flip($this->_searchTriggers))) > 0 */ ) {
		// Index
		Khcn_Api::_()->getApi('search', 'default')->index($this);
    }
  }

  /**
   * Pre-update hook. If overridden, should be called at end of function.
   *
   * @return void
   */
  protected function _update()
  {
    if( $this->_disableHooks ) return;

    parent::_update();
  }

  /**
   * Post-insert hook. If overridden, should be called at end of function.
   *
   * @return void
   */
  protected function _postUpdate()
  {
    if( $this->_disableHooks ) return;
    
    parent::_postUpdate();
	
    // Search indexer
    if( !$this->isSearchable() ) {
      // De-index
      Khcn_Api::_()->getApi('search', 'default')->unindex($this);
    } else if( $this->isSearchable() && is_array($this->_searchTriggers) ) {
      // Re-index
      Khcn_Api::_()->getApi('search', 'default')->index($this);
    }
  }

  /**
   * Pre-delete hook. If overridden, should be called at end of function.
   *
   * @return void
   */
  protected function _delete()
  {
    if( $this->_disableHooks ) return;
    
    parent::_delete();
    
    // Unindex from search
    Khcn_Api::_()->getApi('search', 'default')->unindex($this);
	
	// Remove files
	$column = null;
	if(isset($this->ten_file)){
		$column = 'ten_file';
	}
	if(isset($this->file)){
		$column = 'file';
	}
	if(!empty($column) && !empty($this->$column)){
		if(file_exists( BASE_PATH . '/upload/files/' . $this->getClassType() . '/' . $this->$column))
			unlink( BASE_PATH . '/upload/files/' . $this->getClassType() . '/' . $this->$column);
	}
  }

  /**
   * Post-insert hook. If overridden, should be called at end of function.
   *
   * @return void
   */
  protected function _postDelete()
  {
    if( $this->_disableHooks ) return;
    
    parent::_postDelete();
  }
}
