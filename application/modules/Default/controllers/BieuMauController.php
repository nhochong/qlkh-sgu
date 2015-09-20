<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Default_BieuMauController extends Khcn_Controller_Action_Standard
{   
    public function indexAction() {
        // TODO Auto-generated {0}::indexAction() default action
		$this->view->parent_id = $parent_id = $this->_getParam('ma_loai', 0);
		$params = array(
			'parent_id' => $parent_id,
			'is_dtsdh' => 0
		);
        $this->view->loaiBMs = $loaiBMs = Khcn_Api::_()->getDbTable('loai_bieu_mau', 'default')->getList($params);
    }
    
	public function danhSachAction(){
        // TODO Auto-generated {0}::indexAction() default action
        $id = $this->getRequest()->getParam('loai');
		$this->view->loai_bm = $loai_bm = Khcn_Api::_()->getItem('default_loai_bieu_mau', $id);
		if(!$loai_bm){
			$this->_redirect('bieu-mau/index');
		}
		$this->view->lists = $loai_bm->getDanhSachBieuMau();
		$this->view->childs = $childs = Khcn_Api::_()->getDbTable('loai_bieu_mau', 'default')->getByParent($loai_bm->getIdentity());
    }
}
