<?php
class Default_HoiThaoController extends Khcn_Controller_Action_Standard
{
    /**
     * The default action - show the home page
     */
	protected $hoi_thao = null;
	
    public function init ()
    {
        $this->hoi_thao = new Default_Model_HoiThao();
    }
    
    public function indexAction()
    {
		$table = Khcn_Api::_()->getDbTable('hoi_thao', 'default');
		$select = $table->select()->where('trang_thai = 1')->order('ngay_to_chuc DESC');
    	$hoiThaos = $table->fetchAll($select);
        
        $paginator = Zend_Paginator::factory($hoiThaos);
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
        $this->view->paginator = $paginator;
		$this->view->capQLs = $capQLs = Default_Model_Constraints::hoithao_capquanly();
    }
    
	public function chiTietAction()
    {
        $id = $this->getRequest()->getParam('id');
		$this->view->hoi_thao = $hoi_thao = Khcn_Api::_()->getItem('default_hoi_thao', $id);
		if(!$hoi_thao){
			return $this->_helper->requireSubject()->forward();
		}
		$this->view->capQLs = $capQLs = Default_Model_Constraints::hoithao_capquanly();
    }
}