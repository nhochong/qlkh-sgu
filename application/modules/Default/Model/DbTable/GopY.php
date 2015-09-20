<?php
class Default_Model_DbTable_GopY extends Khcn_Db_Table{
	
	protected $_name = 'gop_y';
	
	protected $_rowClass = 'Default_Model_GopY';
	
	public function getGopYsSelect($params = array())
	{
		$select = $this->select();
		
		if( !empty($params['loai_id']))
		{
			$select->where("loai_id = ?", $params['loai_id']);
		}
		
		if( !empty($params['tinh_trang']))
		{
			$select->where("tinh_trang = ?", $params['tinh_trang']);
		}
		
		$select->order('ngay_tao DESC');
		return $select;
	}
  
  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
	public function getGopYsPaginator($params = array())
	{
		$paginator = Zend_Paginator::factory($this->getGopYsSelect($params));
		if( !empty($params['page']) )
		{
		  $paginator->setCurrentPageNumber($params['page']);
		}
		if( !empty($params['limit']) )
		{
		  $paginator->setItemCountPerPage($params['limit']);
		}

		if( empty($params['limit']) )
		{
		  $paginator->setItemCountPerPage(10);
		}

		return $paginator;
	}
}