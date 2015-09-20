<?php
class Default_Model_DbTable_Queue extends Khcn_Db_Table{
	
	protected $_name = 'queue';
	
	protected $_rowClass = 'Default_Model_Queue';
	
	public function getQueuesSelect($params = array())
	{
		$table = $this;
		$rName = $this->info('name');

		$userTable = Khcn_Api::_()->getDbTable('nguoi_dung', 'default');
		$userName = $userTable->info('name');

		$select = $table->select()
						->setIntegrityCheck(false)
						->from($rName)
						->joinLeft($userName, "$userName.id = $rName.nguoi_dung_id", array("$userName.ten_dang_nhap", "$userName.giang_vien_id"))
						->where("$userName.giang_vien_id = 0");
		
		if( !empty($params['ma_don_vi']) && is_numeric($params['ma_don_vi']) )
		{
			$select->where($rName.'.don_vi_id = ?', $params['ma_don_vi']);
		}

		if( !empty($params['ma']))
		{
			$select->where($rName.'.ma_giang_vien = ?', $params['ma']);
		}
		
		if( !empty($params['ho']) )
		{
			$select->where($userName.".ho LIKE ?", '%'.$params['ho'].'%');
		}
		
		if( !empty($params['ten']) )
		{
			$select->where($userName.".ten LIKE ?", '%'.$params['ten'].'%');
		}
		
		return $select;
	}
  
  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
	public function getQueuesPaginator($params = array())
	{
		$paginator = Zend_Paginator::factory($this->getQueuesSelect($params));
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
	
	public function getQueueByND($nguoi_dung_id){
		$select = $this->select()->where('nguoi_dung_id = ?', $nguoi_dung_id);
		$row = $this->fetchRow($select);
		if($row)
			return $row;
		return null;
	}
	
}