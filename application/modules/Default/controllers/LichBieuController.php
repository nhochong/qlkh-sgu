<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Default_LichBieuController extends Khcn_Controller_Action_Standard
{
	protected $lich_bieu = null;
	
	public function init ()
    {
        $this->lich_bieu = new Default_Model_LichBieu();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->lbs = $this->lich_bieu->getDSLB();
    }
    
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $id = $this->getRequest()->getParam('id');
        if($id != null){
        	$lichBieu = $this->lich_bieu->getLBById($id);
        	if($lichBieu != null){
	        	$cau_hinh = new Default_Model_CauHinh();      	
	        	$this->view->domain = Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', '');
        		$this->view->lich_bieu = $lichBieu;
        	}
        	else 
        		$this->_redirect('lich-bieu/index');
        }else{
        	$this->_redirect('lich-bieu/index');
        }
    }
    
}
