<?php
class Default_Model_DbTable_ThongBao extends Khcn_Db_Table{
	
	protected $_name = 'thong_bao';
	
	protected $_rowClass = 'Default_Model_ThongBao';
	
	public function getThongBao($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getSearch()
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getTBMoi()
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC')
    					  ->limit(15,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
    public function danhsachhienthi($loai)
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->where('loai = ?',$loai)
    					  ->order('ngay_tao DESC')
    					  ->limit(10,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function GetThongBaoByLoai($loai)
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->where('loai = ?',$loai)
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
    public function GetThongBaoCungChuDe($loai, $id)
    {
    	$select = $this->select()
    					  ->where('trang_thai = ?','1')
    					  ->where('loai = ?',$loai)
    					  ->where('id != ?',$id)
    					  ->order('ngay_tao DESC')
    					  ->limit(5,0);
    	return $this->fetchAll($select);
    }
    
    public function getDSTB()
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getDSTBForRSS()
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('thong_bao',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC')
    					  ->limit(15,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function loc($params = array())
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC');
    	if(isset($params['loai']) && $params['loai'] != '-1'){
    		$statement->where('loai = ?',$params['loai']);
    	}
		if(!empty($params['order'])){
			$statement->order($params['order']." ".$params['direction']);
		}else{
    		$statement->order('id');
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($thong_bao)
    {
    	$data = array(
    				 'tieu_de' => $thong_bao->getTieuDe(),
    				 'noi_dung' => Default_Model_Functions::strip_magic_slashes($thong_bao->getNoiDung()),
    				 'trang_thai' => $thong_bao->getTrangThai(),
    				 'loai' => $thong_bao->getLoai(),
    				 'ngay_tao' => $thong_bao->getNgayTao(),
    				 'ma_quan_tri' => $thong_bao->getMaQuanTri(),
    				 'so_lan_xem' => 1
        );
        return $this->insert($data);
    }
    
    public function sua($thong_bao)
    {
		$data = array(
    				 'tieu_de' => $thong_bao->getTieuDe(),
    				 'noi_dung' => Default_Model_Functions::strip_magic_slashes($thong_bao->getNoiDung()),
    				 'trang_thai' => $thong_bao->getTrangThai(),
    				 'loai' => $thong_bao->getLoai()
        );
        return $this->update($data, 'id = '. (int)$thong_bao->getId());
    }
    
    public function CapNhatTT($id,$status)
    {
    	$data = array(
	            'trang_thai' => 1 - $status,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
	public function CapNhatSLX($id,$so_lan_xem)
    {
    	$data = array(
	            'so_lan_xem' => $so_lan_xem + 1,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
	
	public function getDSThongBaos($params = array()){
		$select = $this->select();
		
		if(isset($params['trang_thai'])){
			$select->where('trang_thai = ?', $params['trang_thai']);
		}
		
		if(isset($params['loai'])){
			$select->where('loai = ?', $params['loai']);
		}
		
		if(isset($params['loais']) && is_array($params['loais'])){
			$select->where('loai IN (?)', $params['loais']);
		}
		
		if(isset($params['quan_trong'])){
			$select->where('quan_trong = ?', $params['quan_trong']);
		}
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		if(isset($params['order'])){
			$direction = isset($params['direction']) ? $params['direction'] : 'DESC';
			$select->order($params['order'] . ' ' . $direction);
		}
		
		$select->order('ngay_tao DESC');
		return $this->fetchAll($select);
	}
}