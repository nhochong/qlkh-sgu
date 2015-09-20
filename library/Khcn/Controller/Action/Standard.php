<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Standard.php 8233 2011-01-17 22:38:28Z steve $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
abstract class Khcn_Controller_Action_Standard extends Khcn_Controller_Action
{
	public $autoContext = true;
  
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{
		// Parent
        parent::__construct($request, $response, $invokeArgs);
	}
  
	public function preDispatch()
	{
		$layoutPath = APPLICATION_PATH . '/templates/default';
        $option = array('layout' => 'index', 'layoutPath' => $layoutPath);
        Zend_Layout::startMvc($option);
		
		$layoutHelper = $this->_helper->layout;
		if( 'index' == $layoutHelper->getLayout() && $this->_getParam('module', false) )
		{
			//66.249.77.211 IP bad
			if($_SERVER['REMOTE_ADDR'] != '66.249.77.211'){
				$bo_dem = new Default_Model_BoDem();			
				$bo_dem->setDiaChiIP($_SERVER['REMOTE_ADDR'])
					   ->setTrinhDuyet($_SERVER['HTTP_USER_AGENT'])
					   ->setThoiGian(new Zend_Db_Expr('NOW()'))
					   ->setUrl($_SERVER['REQUEST_URI']);
				$bo_dem->Add();
			}
		}
		
		
	}
}