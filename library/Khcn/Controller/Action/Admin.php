<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Admin.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
abstract class Khcn_Controller_Action_Admin extends Khcn_Controller_Action_User
{
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{

		// Parent
		/*
		parent::__construct($request, $response, $invokeArgs);
		 */
		$this->setRequest($request)
			 ->setResponse($response)
			 ->_setInvokeArgs($invokeArgs);
		$this->_helper = new Zend_Controller_Action_HelperBroker($this);
		$this->init();

		// Normal
		if( !$this->_helper->requireAdmin->checkRequire() ) {
			if( !$this->_helper->requireUser()->isValid() ) {
				return;
			}
			$this->_helper->requireAdmin();
			return;
		}
	}
  
	public function preDispatch()
	{
		$layoutPath = APPLICATION_PATH . '/templates/admin';
        $option = array('layout' => 'index', 'layoutPath' => $layoutPath);
        Zend_Layout::startMvc($option);
	}
}