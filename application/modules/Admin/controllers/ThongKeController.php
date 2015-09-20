<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_ThongKeController extends Khcn_Controller_Action_Admin
{
	protected $giang_vien = null;
	
	public function init ()
    {
        $this->giang_vien = new Default_Model_GiangVien();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action\
    	$this->view->form = $form = new Admin_Form_FilterGV();
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
		$_SESSION['filterGV'] = $_SERVER['QUERY_STRING'];
		if( empty($params['order']) ) {
			$params['order'] = 'ho_ten';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'ASC';
		} 		
        $form->populate($params);
        $giangViens = $this->giang_vien->loc($params);
		if($giangViens == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}
        
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($giangViens);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
		$this->view->order = $params['order'];
		$this->view->direction = $params['direction'];
    }
	
	public function giangVienAction() 
    {
		$this->view->viewer = $viewer = Khcn_Api::_()->getViewer();
		$id = $this->_getParam('id',null);
		$this->view->giang_vien = $giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $id);
        if(!$giang_vien){
			return $this->_helper->requireSubject()->forward();
		}
		
		$deTais = $giang_vien->getDSDeTaiByGiangVien();
		$datas = array();
		foreach($deTais as $de_tai){
			$datas[$de_tai->getNam()][] = $de_tai;
		}
		krsort($datas, SORT_NUMERIC );
		$this->view->datas = $datas;
		$this->view->tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
    }
}
