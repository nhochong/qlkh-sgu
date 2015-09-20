<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Default_QuiDinhController extends Khcn_Controller_Action_Standard
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->hdcn = Khcn_Api::_()->getDbTable('qui_dinh', 'default')->getQDByLoai(1);
        $this->view->sdh = Khcn_Api::_()->getDbTable('qui_dinh', 'default')->getQDByLoai(2);
    }
    
	public function danhSachAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $loai = $this->getRequest()->getParam('loai');
        $quiDinhs = Default_Model_Constraints::quidinh_loai();
        if(!array_key_exists($loai, $quiDinhs))
        	$this->_redirect('qui-dinh/index');
        else
        {
        	$ten_loais = Default_Model_Constraints::quidinh_loai();
        	$this->view->ten_loai = $ten_loais[$loai];
        	$this->view->lists = Khcn_Api::_()->getDbTable('qui_dinh', 'default')->getQDByLoai($loai);
        }
    }
    
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $id = $this->getRequest()->getParam('id');
        if(!empty($id)){
	        $qui_dinh = Khcn_Api::_()->getItem('default_qui_dinh', $id);
	        if($qui_dinh == null){
	        	$this->_redirect('qui-dinh/index');
	        }else{
	        	$cau_hinh = new Default_Model_CauHinh();	        	
	        	$this->view->domain = Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', '');
	        	$this->view->qui_dinh = $qui_dinh;
	        }
        }else{
        	$this->_redirect('qui-dinh/index');
        }
    }
    
}
