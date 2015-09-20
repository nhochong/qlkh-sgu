<?php
class Khcn_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract{
	protected $_acl = null;
	protected $_auth = null;

	public function __construct(Zend_Acl $acl,Zend_Auth $auth) {
	    $this->_acl = $acl;
	    $this->_auth = $auth;
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request){
    	if($this->_auth->hasIdentity()){
    		switch ($this->_auth->getIdentity()->ma_quyen){
				case '1':
    				$role = 'admin';
    				break;
    			case '2':
    				$role = 'mod';
    				break;
    			case '3':
    				$role = 'teacher';
    				break;
				case '4':
    				$role = 'member';
    				break;
				default:
					$role = 'guest';
					break;
    		}
    	}else{
    		$role = 'guest';
    	}
    	$controller = $request->getControllerName();
	    $action = $request->getActionName();
	    $module = $request->getModuleName();
	    $resource = $module . ':' . $controller;
	    if($module == 'admin'){
	    	if (!$this->_acl->isAllowed($role, $resource, $action)) {
	    		$this->_auth->clearIdentity();
	            $request->setModuleName('admin')
	            		->setControllerName('login')
	            		->setActionName('index');
	        }
	    }
    }
}