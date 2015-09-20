<?php
class Default_Model_DbTable_Quyen extends Khcn_Db_Table{
	
	protected $_name = 'quyen';
	
	protected $_publicLevel;

	protected $_defaultLevel;

	public function getPublicLevel()
	{
		if( null === $this->_publicLevel ) {
		  $select = $this->select()
			->where('loai = ?', 'public')
			->limit(1);
		  $this->_publicLevel = $this->fetchRow($select);

		  if( null === $this->_publicLevel ) {
			throw new Exception('No public level found');
		  }
		}

		return $this->_publicLevel;
	}

	public function getDefaultLevel()
	{
		if( null === $this->_defaultLevel ) {
		  $select = $this->select()
			->where('loai = ?', 'user')
			->limit(1);
		  $this->_defaultLevel = $this->fetchRow($select);

		  if( null === $this->_defaultLevel ) {
			throw new Exception('No default level found');
		  }
		}

		return $this->_defaultLevel;
	}
  
	public function getLevelsAssoc()
	{
		$levels = $this->select()
			->from($this, array('id', 'ten'))
			->order('id ASC')
			->query()
			->fetchAll();
		
		$data = array();
		foreach( $levels as $level ) {
		  $data[$level['id']] = $level['ten'];
		}
		
		return $data;
	}
	
	public function getLevelIdByType($loai = null){
		if($loai == null)
			return null;
		$select = $this->select()
						->where('loai = ?', $loai)
						->limit(1);
		$row = $this->fetchRow($select);
		if($row) 
			return $row->id;
		return null;
	}
}