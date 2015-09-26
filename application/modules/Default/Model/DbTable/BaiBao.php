<?php
class Default_Model_DbTable_BaiBao extends Khcn_Db_Table{
	
	protected $_name = 'bai_bao';
	
	protected $_rowClass = 'Default_Model_BaiBao';
	
	public function getBaiBaosSelect($params = array())
	{
		$table = $this;
		$rName = $this->info('name');

		$dvTable = Khcn_Api::_()->getDbTable('don_vi', 'default');
		$dvNameTable = $dvTable->info('name');
		
		$gvTable = Khcn_Api::_()->getDbTable('giang_vien', 'default');
		$gvNameTable = $gvTable->info('name');
		
		$tgTable = Khcn_Api::_()->getDbTable('tac_gia', 'default');
		$tgNameTable = $tgTable->info('name');
		
		$select = $table->select()
						->from($rName)
						->setIntegrityCheck(false)
						->joinLeft($tgNameTable, "$tgNameTable.bai_bao_id = $rName.bai_bao_id", null)
						->joinLeft($gvNameTable, "$tgNameTable.giang_vien_id = $gvNameTable.id", null);
		$select->group("$rName.bai_bao_id");
		if( !empty($params['ho']))
		{
			$select->where("$gvNameTable.ho like ?", "%" . $params['ho'] . "%");
		}
		if( !empty($params['ten']))
		{
			$select->where("$gvNameTable.ten like ?", "%" . $params['ten'] . "%");
		}
		if( !empty($params['don_vi_id']))
		{
			$select->where("$gvNameTable.don_vi_id = ?", $params['don_vi_id']);
		}
		
		return $select;
	}
  
  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
	public function getBaiBaosPaginator($params = array())
	{
		$paginator = Zend_Paginator::factory($this->getBaiBaosSelect($params));
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