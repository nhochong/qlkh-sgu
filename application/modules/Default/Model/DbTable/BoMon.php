<?php
class Default_Model_DbTable_BoMon extends Khcn_Db_Table{
	
	protected $_name = 'bo_mon';
	
	protected $_rowClass = 'Default_Model_BoMon';
	
	public function getBoMonsSelect($params = array())
	{
		$select = $this->select();
		
		if( !empty($params['don_vi_id']))
		{
			$select->where("don_vi_id = ?", $params['don_vi_id']);
		}
		$select->order('don_vi_id');
		return $select;
	}
  
  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
	public function getBoMonsPaginator($params = array())
	{
		$paginator = Zend_Paginator::factory($this->getBoMonsSelect($params));
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
	
	public function getBoMonByDonVi($don_vi_id){
		$select = $this->select()->where('don_vi_id = ?', $don_vi_id);
		return $this->fetchAll($select);
	}
	
	public function getBoMonByDonViAssoc($don_vi_id){
		$boMons = $this->getBoMonByDonVi($don_vi_id);
		$datas = array('' => '');
		foreach($boMons as $bo_mon){
			$datas[$bo_mon->getIdentity()] = $bo_mon->ten;
		}
		return $datas;
	}
}