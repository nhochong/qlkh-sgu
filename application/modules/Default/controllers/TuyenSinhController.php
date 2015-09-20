<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Default_TuyenSinhController extends Khcn_Controller_Action_Standard
{
	protected $tuyen_sinh = null;
	
	public function init ()
    {
        $this->tuyen_sinh = new Default_Model_TuyenSinh();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->tss = $this->tuyen_sinh->getDSTS();
    }
    
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $id = $this->getRequest()->getParam('id');
        if($id != null){
        	$tuyenSinh = $this->tuyen_sinh->getTSById($id);
        	if($tuyenSinh != null){
	        	$cau_hinh = new Default_Model_CauHinh();        	
	        	$this->view->domain = Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', '');
        		$this->view->tuyen_sinh = $tuyenSinh;
        	}
        	else 
        		$this->_redirect('tuyen-sinh/index');
        }else{
        	$this->_redirect('tuyen-sinh/index');
        }
    }
    
}
