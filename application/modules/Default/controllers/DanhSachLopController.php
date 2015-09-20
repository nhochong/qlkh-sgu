<?php

class Default_DanhSachLopController extends Khcn_Controller_Action_Standard
{
	/**
	 * The default action - show the home page
	 */
    
    public function indexAction() 
    {
		$loai = $this->_getParam('loai', 'dhsg');
		$table = Khcn_Api::_()->getDbTable('he_cao_hoc', 'default');
		$this->view->he_cao_hoc = $he_cao_hoc = $table->fetchRow($table->select()->where('name = ?', $loai));
		if(!$he_cao_hoc){
			$this->_redirect('index');
		}
		
        // TODO Auto-generated {0}::indexAction() default action
		$params = array(
			'trang_thai' => true,
			'limit' => 20,
			'he_cao_hoc' => $he_cao_hoc->getIdentity()
		);
        $danhSach = Khcn_Api::_()->getDbTable('danh_sach_lop', 'default')->getPaginator($params);
        
        $paginator = Zend_Paginator::factory($danhSach);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
    	$id = $this->getRequest()->getParam('id');
        if(!empty($id)){        	
        	$item = Khcn_Api::_()->getItem('default_danh_sach_lop', $id);
        	if($item != null){
        		$item->so_lan_xem += 1;
				$item->save();
	        	$this->view->item = $item;
        	}else{
        		$this->_redirect('danh-sach-lop/index');
        	}
        }else{
        	$this->_redirect('danh-sach-lop/index');
        }
                
    }
}
