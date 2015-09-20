<?php
class Default_Model_DbTable_HoiThao extends Khcn_Db_Table{
	
	protected $_name = 'hoi_thao';
	
	protected $_rowClass = 'Default_Model_HoiThao';
	
	public function getHoiThao($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getDSHT()
    {
    	$cols = array('id','chu_de','cap_quan_ly','doi_tac','ngay_to_chuc');
    	$tableInfo = array('ht' => 'hoi_thao');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = ht.don_vi_phu_trach',
    					  		 array('don_vi_phu_trach' => 'dv.ten')
    					  		)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_to_chuc DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function loc($params = array())
    {
    	$select = $this->select()
						->order('trang_thai DESC');
    	if(!empty($params['don_vi_id'])){
    		$select->where('don_vi_id = ?',$params['don_vi_id']);
    	}
    	if(!empty($params['nam'])){
    		$select->where('YEAR(ngay_to_chuc) = ?',$params['nam']);
    	}
		if(!empty($params['order'])){
			$select->order($params['order']." ".$params['direction']);
		}else{
    		$select->order('ht.id');
		}
    	return $this->fetchAll($select);
    }
    
    public function getSearch()
    {
    	$cols = array('id','chu_de','doi_tac','ngay_to_chuc');
    	$tableInfo = array('ht' => 'hoi_thao');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = ht.don_vi_phu_trach',
    					  		 array('don_vi_phu_trach' => 'dv.ten')
    					  		)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_to_chuc DESC');;
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getATB($id)
    {
    	$cols = array('id','anh_trang_bia');
    	$statement = $this->select()
    					  ->from('hoi_thao',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getTCBC($id)
    {
    	$cols = array('id','thong_cao_bao_chi');
    	$statement = $this->select()
    					  ->from('hoi_thao',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getAll()
    {
    	$cols = array('id','chu_de','cap_quan_ly','doi_tac','ngay_to_chuc','trang_thai');
    	$tableInfo = array('ht' => 'hoi_thao');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = ht.don_vi_phu_trach',
    					  		 array('don_vi_phu_trach' => 'dv.ten')
    					  		)
    					  ->order('trang_thai DESC')
    					  ->order('ngay_to_chuc DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function them($hoi_thao)
    {
    	$data = array(
            'chu_de' => $hoi_thao->getChuDe(),
            'cap_quan_ly' => $hoi_thao->getCapQuanLy(),
    		'doi_tac' => $hoi_thao->getDoiTac(),
    		'don_vi_phu_trach' => $hoi_thao->getDonViPhuTrach(), 	
    		'ngay_to_chuc' => $hoi_thao->getNgayToChuc(),
	    	'anh_trang_bia' => $hoi_thao->getAnhTrangBia(),
	    	'thong_cao_bao_chi' => $hoi_thao->getThongCaoBaoChi(),
    		'trang_thai' => $hoi_thao->getTrangThai()
        );
        return $this->insert($data);
    }
    
    public function sua($hoi_thao)
    {
    	$data = array(
            'chu_de' => $hoi_thao->getChuDe(),
            'cap_quan_ly' => $hoi_thao->getCapQuanLy(),
    		'doi_tac' => $hoi_thao->getDoiTac(),
    		'don_vi_phu_trach' => $hoi_thao->getDonViPhuTrach(), 	
    		'ngay_to_chuc' => $hoi_thao->getNgayToChuc(),
    		'trang_thai' => $hoi_thao->getTrangThai()
        );
        if($hoi_thao->getAnhTrangBia() != null)
        	$data['anh_trang_bia'] = $hoi_thao->getAnhTrangBia();
        if($hoi_thao->getThongCaoBaoChi() != null)
        	$data['thong_cao_bao_chi'] = $hoi_thao->getThongCaoBaoChi();
        return $this->update($data, 'id = '. (int)$hoi_thao->getId());
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
}