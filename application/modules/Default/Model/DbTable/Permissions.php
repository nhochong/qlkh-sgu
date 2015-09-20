<?php
class Default_Model_DbTable_Permissions extends Khcn_Db_Table{
	
	protected $_name = 'permissions';
	
	const LEVEL_DISALLOW = 0;
	const LEVEL_ALLOW = 1;
	const LEVEL_MODERATE = 2;
  
	static protected $_constants = array(
		0 => 'disallow',
		1 => 'allow',
		2 => 'moderate',
		3 => 'nonboolean',
		4 => 'ignore',
		5 => 'serialized',
	);
  
	static public function getConstantKey($constantValue)
	{
		if( is_scalar($constantValue) && isset(self::$_constants[$constantValue]) ) {
		  return self::$_constants[$constantValue];
		}

		return null;
	}
  
	public function isAllowed($resource, $role, $action)
	{
		// Get
		$row = $this->_getAllowed($resource, $role, $action);

		// Row was not found
		if( !is_object($row) ) {
		  return self::LEVEL_DISALLOW;
		}

		// Params not correct
		if( null === self::getConstantKey($row->value) )
		{
		  return self::LEVEL_DISALLOW;
		}
		
		return $row->value;
  }

  public function getAllowed($resource, $role, $action)
  {
	$data = $this->_getAllowed($resource, $role, $action);
  
	$rawData = array();
	foreach( $data as $row ) {
          $rawData[$row->name] = $row->value;
	}
	return $rawData;
  }

  public function setAllowed($resource, $role, $action, $value = null)
  {
    // Can set multiple actions
    if( is_array($action) )
    {
      foreach( $action as $key => $value )
      {
        $this->setAllowed($resource, $role, $key, $value);
      }

      return $this;
    }

    // Check type
    $type = $this->_getResourceType($resource);
    if( !$type )
    {
      throw new Exception("Resource must be an instance of Khcn_Model_Item_Abstract or a resource type string");
    }

    // Role must be a level id or a user object with a level id
    if( $role instanceof Khcn_Model_Item_Abstract )
    {
      $level_id = ( isset($role->ma_quyen) ? $role->ma_quyen : 0 );
    }

    else if( is_numeric($role) )
    {
      $level_id = $role;
    }

    if( !$level_id )
    {
      throw new Exception("Role must be an instance of Khcn_Model_Item_Abstract with a level_id or a level id");
    }

    // If value not specified, set to disallow
    if( $value === null )
    {
      $value = self::LEVEL_DISALLOW;
    }

    // Set info
    // Check for existing row
    $row = $this->fetchRow(array(
      'level_id = ?' => $level_id,
      'type = ?' => $type,
      'name = ?' => $action
    ));

    if( is_null($row) )
    {
      $row = $this->createRow();
      $row->level_id = $level_id;
      $row->type = $type;
      $row->name = $action;
    }
    
    if( null !== self::getConstantKey($value) )
    {
      $row->value = $value;
      $row->params = null;
    }
    
    $row->save();

    return $this;
  }



  // Utility

  protected function _getAllowed($resource, $role, $action)
  {
    // Must get a user object and a resource type
    $type = $this->_getResourceType($resource);
    if( null === $type )
    {
      return null;
    }

    // Role must be a level id or a user object with a level id
    if( $role instanceof Khcn_Model_Item_Abstract )
    {
      $level_id = ( isset($role->ma_quyen) ? $role->ma_quyen : 0 );
    }

    else if( is_numeric($role) )
    {
      $level_id = $role;
    }

    if( empty($level_id) )
    {
      $level_id = Khcn_Api::_()->getDbtable('quyen', 'default')->getPublicLevel()->id;
    }

    // Lookup permission
    $select = $this->select()
      ->where('level_id = ?', $level_id)
      ->where('type = ?', $type)
      ;

    $return = null;
    if( null === $action ) {
      // get everything?
      $return = $this->fetchAll($select);
    } else if( is_array($action) ) {
      if( empty($action) ) {
        // get everything?
        $return = $this->fetchAll($select);
      } else {
        $select->where('name IN(?)', $action);
        $return = $this->fetchAll($select);
      }
    } else if( is_scalar($action) ) {
      $select->where('name = ?', $action);
      $return = $this->fetchRow($select);
    } else {
      throw new Exception('invalid action passed to _getAllowed()');
    }
    
    return $return;
  }
  
  protected function _getLevel($level)
  {
    if( is_numeric($level) ) {
      return $level;
    } else if( $level instanceof Zend_Db_Table_Row_Abstract && isset($level->id) && is_numeric($level->id) ) {
      return $level->id;
    } else {
      throw new Exception('Invalid level id');
    }
  }
  
  protected function _getResourceType($resource)
  {
    if( is_string($resource) )
    {
      return $resource;
    }

    else if( is_array($resource) && isset($resource[0]) )
    {
      return $resource[0];
    }

    else if( $resource instanceof Khcn_Model_Item_Abstract )
    {
      return $resource->getType();
    }

    else
    {
      return null;
    }
  }
  
  protected function _getResourceIdentity($resource)
  {
    if( is_numeric($resource) )
    {
      return $resource;
    }

    else if( is_array($resource) && isset($resource[1]) )
    {
      return $resource[1];
    }

    else if( $resource instanceof Khcn_Model_Item_Abstract )
    {
      return $resource->getIdentity();
    }

    else
    {
      return null;
    }
  }
}