<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: RequireUser.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Controller_Action_Helper_RequireUser extends
  Khcn_Controller_Action_Helper_RequireAbstract
{
  protected $_errorAction = array('requireuser', 'error', 'default');
  
  public function checkRequire()
  {
    try
    {
      $viewer = Khcn_Api::_()->getViewer();
    }
    catch( Exception $e )
    {
      $viewer = null;
    }
	
    $ret = false;
    if( $viewer instanceof Khcn_Model_Item_Abstract && $viewer->getIdentity() )
    {
      $ret = true;
    }

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