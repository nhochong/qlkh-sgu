<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: RequireAdmin.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Controller_Action_Helper_RequireAdmin extends
  Khcn_Controller_Action_Helper_RequireAbstract
{
	protected $_errorAction = array('requireadmin', 'error', 'default');

	public function checkRequire()
	{
		// @todo admin stuff
		$ret = false;
		$ret = Khcn_Api::_()->getApi('authorization','default')->isAllowed('admin', null, 'view');

		if( !$ret && APPLICATION_ENV == 'development' && Zend_Registry::isRegistered('Zend_Log') && ($log = Zend_Registry::get('Zend_Log')) instanceof Zend_Log )
		{
		  $target = $this->getRequest()->getModuleName() . '.' .
				  $this->getRequest()->getControllerName() . '.' .
				  $this->getRequest()->getActionName();
		  $log->log('Require class '.get_class($this).' failed check for: '.$target, Zend_Log::DEBUG);
		}

		return $ret;
	}
}