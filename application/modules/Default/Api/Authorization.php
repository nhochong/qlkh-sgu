<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 9072 2011-07-21 01:09:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Default_Api_Authorization extends Khcn_Api_Abstract
{
	/**
   * Gets the specified permission for the context
   *
   * @param Core_Model_Item_Abstract|string $resource The resource type or object that is being accessed
   * @param Core_Model_Item_Abstract $role The item (user) performing the action
   * @param string $action The name of the action being performed
   * @return mixed 0/1 for allowed, or data for settings
   */
	public function isAllowed($resource, $role, $action = 'view')
	{
		if( null === $resource ) {
			return false;
		}
		
		if( null === $role ) {
		  $viewer = Khcn_Api::_()->getViewer();
		  if( null !== $viewer && $viewer->getIdentity() ) {
			$role = $viewer;
		  } else {
			$role = 'everyone';
		  }
		}
		
		if( !is_string($action) )
		{
		  throw new Khcn_Api_Exception('action must be a string');
		}
		
		// Iterate over each adapter and check permission
		$final = Default_Model_DbTable_Permissions::LEVEL_DISALLOW;
		
		$adapter = Khcn_Api::_()->getDbtable('permissions', 'default');

		$result = $adapter->isAllowed($resource, $role, $action);

		switch( $result ) {
			// Unknown value, ignore, nonboolean
			case Default_Model_DbTable_Permissions::LEVEL_DISALLOW:
			  return Default_Model_DbTable_Permissions::LEVEL_DISALLOW;
			  break;
			case Default_Model_DbTable_Permissions::LEVEL_MODERATE:
			  return Default_Model_DbTable_Permissions::LEVEL_ALLOW;
			  break;
			case Default_Model_DbTable_Permissions::LEVEL_ALLOW:
			  $final = Default_Model_DbTable_Permissions::LEVEL_ALLOW;
			  break;
		}

		return $final;
	}
}