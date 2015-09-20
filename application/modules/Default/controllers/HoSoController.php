<?php
class Default_HoSoController extends Khcn_Controller_Action_Standard
{
	public function indexAction(){
		$this->view->loaiHSs = Khcn_Api::_()->getDbTable('loai_ho_so', 'default')->fetchAll();
    }
    
	public function caoHocAction() {
        // TODO Auto-generated {0}::indexAction() default action
		$ho_so_id = 1;
        $this->view->hoSos = Khcn_Api::_()->getDbTable('ho_so', 'default')->getDanhSachHoSo(array('ma_loai' => $ho_so_id));
		$this->view->loai_ho_so = Khcn_Api::_()->getItem('default_loai_ho_so', $ho_so_id);
    }
	
	public function ncsAction(){
		$ho_so_id = 2;
        $this->view->hoSos = Khcn_Api::_()->getDbTable('ho_so', 'default')->getDanhSachHoSo(array('ma_loai' => $ho_so_id));
		$this->view->loai_ho_so = Khcn_Api::_()->getItem('default_loai_ho_so', $ho_so_id);
    }
	
	public function danhSachAction(){
		// TODO Auto-generated {0}::indexAction() default action
        $ma_loai = $this->getRequest()->getParam('ma_loai');
		$this->view->loai_hs = $loai_hs = Khcn_Api::_()->getItem('default_loai_ho_so', $ma_loai);
		if(!$loai_hs){
			$this->_redirect('index');
		}
		$this->view->danhSachHs = Khcn_Api::_()->getDbTable('ho_so', 'default')->getHSsByLoai($ma_loai);
	}
}