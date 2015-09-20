<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_BoDem extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'bo_dem';
	
    public function getBoDem($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function add($bo_dem)
    {
    	$data = array('dia_chi_ip' => $bo_dem->getDiaChiIP(),
    				  'trinh_duyet' => $bo_dem->getTrinhDuyet(),
    				  'thoi_gian' => $bo_dem->getThoiGian(),
    				  'url' => $bo_dem->getUrl()
    	);
    	$this->insert($data);
    }
    
	public function so_luong_hom_nay()
    {
    	$form = date('Y-m-d 0:0:0');
		$to = date('Y-m-d 23:59:59');
		$cols = array('count' => 'count(*)');
    	$statement = $this->select()
    					  ->from('bo_dem',$cols)
    					  ->where('thoi_gian >= ?',$form)
    					  ->where('thoi_gian <= ?',$to);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
    
    public function reset()
    {
    	$date = date('Y-m-1 0:0:0');
    	$date = '"' . $date . '"';
    	$this->delete('thoi_gian < ' . $date);	
    }
    
	public function so_luong_tuan_nay()
    {
    	$x = date('w') - 1;
    	if($x < 0)
    		$x = 6;
		$tsg = strtotime('-' . $x . ' days');
		$form = date('Y-m-d 0:0:0',$tsg);
		$to = date('Y-m-d 23:59:59');
		$cols = array('count' => 'count(*)');
    	$statement = $this->select()
    					  ->from('bo_dem',$cols)
    					  ->where('thoi_gian >= ?',$form)
    					  ->where('thoi_gian <= ?',$to);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
    
	public function so_luong_thang_nay()
    {
    	$form = date('Y-m-1 0:0:0');
		$to = date('Y-m-d 23:59:59');
		$cols = array('count' => 'count(*)');
    	$statement = $this->select()
    					  ->from('bo_dem',$cols)
    					  ->where('thoi_gian >= ?',$form)
    					  ->where('thoi_gian <= ?',$to);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
    
	public function so_luong()
    {
		$cols = array('count' => 'count(*)');
    	$statement = $this->select()
    					  ->from('bo_dem',$cols);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
    
	public function so_luong_theo_ngay($ngay)
    {
    	$form = $ngay .' 0:0:0';
		$to = $ngay .' 23:59:59';
    	$cols = array('count' => 'count(*)');
    	$statement = $this->select()
    					  ->from('bo_dem',$cols)
    					  ->where('thoi_gian >= ?',$form)
    					  ->where('thoi_gian <= ?',$to);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
}
