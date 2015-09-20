<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Admin_IndexController extends Khcn_Controller_Action_Admin
{   
    public function indexAction ()
    {
        // TODO Auto-generated {0}::indexAction() default action
    }
    
	public function logoutAction ()
    {
        $auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    	$this->_redirect('/admin/login/index');
    }
}
