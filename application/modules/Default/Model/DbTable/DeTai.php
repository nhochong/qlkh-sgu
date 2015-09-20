<?php
class Default_Model_DbTable_DeTai extends Khcn_Db_Table{
	
	protected $_name = 'de_tai';
	
	protected $_rowClass = 'Default_Model_DeTai';
	
	public function getDeTai($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getChiTietDeTai($id)
    {
    	$id = (int) $id;
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','thoi_gian_hoan_thanh','tinh_trang','so_thang_gia_han','kinh_phi','cap_quan_ly','xep_loai','ghi_chu'); 	
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('ten_cn' => 'gv.ten',
    					  			  'ho_cn' => 'gv.ho'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'))
    					  ->join(array('loai' => 'loai_de_tai'),
    					  		'loai.id = dt.ma_loai',
    					  		array('ten_loai' => 'loai.ten'))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		))
    					  ->where('dt.id = ?',$id);
		return $this->fetchRow($statement); 	
    }
    
	
	public function getDSDT($params)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang','cap_quan_ly','xep_loai');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('ten_cn' => 'gv.ten',
    					  			  'ho_cn' => 'gv.ho'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'dt.ma_linh_vuc = lv.id',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		));

		if(!empty($params['ma_don_vi'])){
			$statement->where('dt.ma_don_vi = ?',$params['ma_don_vi']);
		}
		if(!empty($params['tinh_trang'])){
			$statement->where('dt.tinh_trang = ?',$params['tinh_trang']);
		}
		if(!empty($params['ma_linh_vuc'])){
			$statement->where('dt.ma_linh_vuc = ?',$params['ma_linh_vuc']);
		}
		if(!empty($params['cap_quan_ly'])){
			$statement->where('dt.cap_quan_ly = ?',$params['cap_quan_ly']);
		}
		if(!empty($params['nam'])){
			$statement->where("dt.nam >= ?",$params['nam']);
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
	
	public function getDSDTCapTruong($params)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang','cap_quan_ly','xep_loai');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
						  ->where('dt.cap_quan_ly = 2')
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('ten_cn' => 'gv.ten',
    					  			  'ho_cn' => 'gv.ho'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'dt.ma_linh_vuc = lv.id',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		));

		if(!empty($params['ma_don_vi'])){
			$statement->where('dt.ma_don_vi = ?',$params['ma_don_vi']);
		}
		if(!empty($params['tinh_trang'])){
			$statement->where('dt.tinh_trang = ?',$params['tinh_trang']);
		}
		if(!empty($params['ma_linh_vuc'])){
			$statement->where('dt.ma_linh_vuc = ?',$params['ma_linh_vuc']);
		}
		if(!empty($params['cap_quan_ly'])){
			$statement->where('dt.cap_quan_ly = ?',$params['cap_quan_ly']);
		}
		if(!empty($params['from'])){
			$statement->where('dt.nam >= ?',$params['from']);
		}
		if(!empty($params['to'])){
			$statement->where('dt.nam <= ?',$params['to']);
		}
		$direction = $params['direction'];
		if(!empty($params['order'])){
			if($params['order'] == 'ma')
				$statement->order("SUBSTRING(dt.ma FROM 8) $direction");
			if($params['order'] == 'nam')
				$statement->order("dt.nam $direction");
		}else{
			$statement->order("dt.nam $direction");
			$statement->order("SUBSTRING(dt.ma FROM 8) $direction");
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
	
	public function getDSDTCapKhoa($params)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang','cap_quan_ly','xep_loai');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
						  ->where('dt.cap_quan_ly = 1')
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('ten_cn' => 'gv.ten',
    					  			  'ho_cn' => 'gv.ho'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'dt.ma_linh_vuc = lv.id',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array(
									'ma_don_vi' => 'dv.ma',
									'ten_don_vi' => 'dv.ten'
    					  		));

		if(!empty($params['ma_don_vi'])){
			$statement->where('dt.ma_don_vi = ?',$params['ma_don_vi']);
		}
		if(!empty($params['tinh_trang'])){
			$statement->where('dt.tinh_trang = ?',$params['tinh_trang']);
		}
		if(!empty($params['ma_linh_vuc'])){
			$statement->where('dt.ma_linh_vuc = ?',$params['ma_linh_vuc']);
		}
		if(!empty($params['cap_quan_ly'])){
			$statement->where('dt.cap_quan_ly = ?',$params['cap_quan_ly']);
		}
		if(!empty($params['from'])){
			$statement->where('YEAR(dt.thoi_gian_bat_dau) >= ?',$params['from']);
		}
		if(!empty($params['to'])){
			$statement->where('YEAR(dt.thoi_gian_bat_dau) <= ?',$params['to']);
		}
		$direction = $params['direction'];
		$statement->order("YEAR(dt.thoi_gian_bat_dau) $direction");
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
	
	public function getDSDTCapNgoaiTruong($params)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang','cap_quan_ly','xep_loai');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
						  ->where('dt.cap_quan_ly = 3')
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('ten_cn' => 'gv.ten',
    					  			  'ho_cn' => 'gv.ho'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'dt.ma_linh_vuc = lv.id',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array(
									'ma_don_vi' => 'dv.ma',
									'ten_don_vi' => 'dv.ten'
    					  		));

		if(!empty($params['ma_don_vi'])){
			$statement->where('dt.ma_don_vi = ?',$params['ma_don_vi']);
		}
		if(!empty($params['tinh_trang'])){
			$statement->where('dt.tinh_trang = ?',$params['tinh_trang']);
		}
		if(!empty($params['ma_linh_vuc'])){
			$statement->where('dt.ma_linh_vuc = ?',$params['ma_linh_vuc']);
		}
		if(!empty($params['cap_quan_ly'])){
			$statement->where('dt.cap_quan_ly = ?',$params['cap_quan_ly']);
		}
		if(!empty($params['from'])){
			$statement->where('YEAR(dt.thoi_gian_bat_dau) >= ?',$params['from']);
		}
		if(!empty($params['to'])){
			$statement->where('YEAR(dt.thoi_gian_bat_dau) <= ?',$params['to']);
		}
		$direction = $params['direction'];
		$statement->order("YEAR(dt.thoi_gian_bat_dau) $direction");
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getDSDTByLVN($linh_vuc,$nam,$arr = array())
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		))
    					  ->where('ma_linh_vuc = ?',$linh_vuc)
    					  ->where("dt.nam = ?",$nam)
    					  ->order('thoi_gian_bat_dau DESC');
    	foreach ($arr as $id)
    		$statement->where('dt.id != ?',$id);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getDSDTByHDD($ma_hd_duyet)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','tinh_trang');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		))
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->order('thoi_gian_bat_dau DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function KiemTraLV($ma_linh_vuc)
    {
    	$ma_linh_vuc = (int) $ma_linh_vuc;
        $row = $this->fetchRow('ma_linh_vuc = ' . $ma_linh_vuc);
        if($row)
        	return true;
        return false;
    }
    
	public function KiemTraLDT($ma_loai)
    {
    	$ma_linh_vuc = (int) $ma_linh_vuc;
        $row = $this->fetchRow('ma_loai = ' . $ma_loai);
        if($row)
        	return true;
        return false;
    }
    
	public function KiemTraHDD($ma_hd_duyet)
    {
    	$ma_hd_duyet = (int) $ma_hd_duyet;
        $row = $this->fetchRow('ma_hd_duyet = ' . $ma_hd_duyet);
        if($row)
        	return true;
        return false;
    }
    
	public function kiem_tra_ma($ma)
    {
    	$statement = $this->select()
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	$statement = $this->select()
    					  ->where('id != ?',(int)$id)
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function kiem_tra_cung_linh_vuc($deTais)
    {
    	$cols = array('ma_linh_vuc');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('id IN (?)',$deTais)
    					  ->group('ma_linh_vuc');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getAll()
    {
    	$cols = array('id','ma','ten','tinh_trang');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		))
    					  ->order('dt.id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($de_tai)
    {
    	$data = array(
    				 'ma' => $de_tai->getMa(),
    				 'ten' => $de_tai->getTen(),
    				 'ma_linh_vuc' => $de_tai->getMaLinhVuc(),
    				 'cap_quan_ly' => $de_tai->getCapQuanLy(),
    				 'ma_loai' => $de_tai->getMaLoai(),
    				 'thoi_gian_bat_dau' => $de_tai->getThoiGianBatDau(),
    				 'thoi_gian_hoan_thanh' => $de_tai->getThoiGianHoanThanh(),
    				 'tinh_trang' => $de_tai->getTinhTrang(),
    				 'xep_loai' => $de_tai->getXepLoai(),
    				 'so_thang_gia_han' => $de_tai->getSoThangGiaHan(),
    				 'kinh_phi' => $de_tai->getKinhPhi(),
    				 'ma_don_vi' => $de_tai->getMaDonVi(),
    				 'ghi_chu' => $de_tai->getGhiChu()
        );
        return $this->insert($data);
    }
    
    public function sua($de_tai)
    {
    	$data = array(
    				 'ma' => $de_tai->getMa(),
    				 'ten' => $de_tai->getTen(),
    				 'ma_linh_vuc' => $de_tai->getMaLinhVuc(),
    				 'cap_quan_ly' => $de_tai->getCapQuanLy(),
    				 'ma_loai' => $de_tai->getMaLoai(),
    				 'thoi_gian_bat_dau' => $de_tai->getThoiGianBatDau(),
    				 'thoi_gian_hoan_thanh' => $de_tai->getThoiGianHoanThanh(),
    				 'tinh_trang' => $de_tai->getTinhTrang(),
    				 'xep_loai' => $de_tai->getXepLoai(),
    				 'so_thang_gia_han' => $de_tai->getSoThangGiaHan(),
    				 'kinh_phi' => $de_tai->getKinhPhi(),
    				 'ma_don_vi' => $de_tai->getMaDonVi(),
    				 'ghi_chu' => $de_tai->getGhiChu()
        );
        return $this->update($data, 'id = '. (int)$de_tai->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
    public function loc($params)
    {
    	$cols = array('id','ma','ten','tinh_trang');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'
    					  		))
    					  ->join(array('dv' => 'don_vi'),
    					  		'dv.id = dt.ma_don_vi',
    					  		array('ten_don_vi' => 'dv.ten'
    					  		));
		
    	if(isset($params['tinh_trang']) && !empty($params['tinh_trang']))
    		$statement->where('tinh_trang = ?', $params['tinh_trang']);
    	if(!empty($params['ma_don_vi']))
    		$statement->where('ma_don_vi = ?', $params['ma_don_vi']);
    	if(!empty($params['ma_linh_vuc']))
    		$statement->where('ma_linh_vuc = ?', $params['ma_linh_vuc']);
		if(!empty($params['cap_quan_ly']))
    		$statement->where('cap_quan_ly = ?', $params['cap_quan_ly']);
		if(!empty($params['bo_mon_id']))
    		$statement->where('bo_mon_id = ?', $params['bo_mon_id']);
		if(!empty($params['loai_linh_vuc'])){
			$statement->join(array('llv' => 'loai_linh_vuc'),
							'lv.ma_loai = llv.id AND llv.id = ' . $params['loai_linh_vuc'],null
			);
		}
		if(!empty($params['expired'])){
			$expired = $params['expired'];
    		$statement->where(" DATE_ADD(CURDATE(),INTERVAL $expired MONTH) >= dt.thoi_gian_hoan_thanh ");
		}
		if(!empty($params['cap_quan_ly']) && $params['cap_quan_ly'] == 2){
			if(!empty($params['nam']))
				$statement->where('dt.nam = ?',$params['nam']);
			if(!empty($params['order'])){
				if($params['order'] == 'ma'){
					$statement->order("SUBSTRING(dt.ma FROM 8) " . $params['direction']);
				}else{
					$statement->order("dt." . $params['order']." ".$params['direction']);
				}
			}else{
				$statement->order('dt.id DESC');
			}
		}else{
			if(!empty($params['nam']))
				$statement->where('dt.nam = ?',$params['nam']);
			if(!empty($params['order'])){
				$statement->order("dt." . $params['order']." ".$params['direction']);
			}else{
				$statement->order('dt.id DESC');
			}
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function CapNhatTT($id,$status)
    {
    	$data = array(
    				 'tinh_trang' => $status,
        );
        return $this->update($data, 'id = '. (int)$id);
    }
    
	public function capNhatHdd($id,$ma_hd_duyet)
    {
    	$data = array(
    				 'ma_hd_duyet' => $ma_hd_duyet,
        );
        return $this->update($data, 'id = '. (int)$id);
    }
    
	public function clearHdd($ma_hd_duyet)
    {
    	$data = array(
    				 'ma_hd_duyet' => null,
        );
        return $this->update($data, 'ma_hd_duyet = '. (int)$ma_hd_duyet);
    }   
    
    public function getDSDV($nam = null,$cap_quan_ly = null,$ma_loai = null)
    {
    	$cols = array('ma_don_vi');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols) 
						  ->setIntegrityCheck(false)
    					  ->group('ma_don_vi')
    					  ->order('dt.id');
		
		if(!empty($ma_loai)){
			$statement->join(array('lv' => 'linh_vuc'),
							"lv.id = dt.ma_linh_vuc and lv.ma_loai = $ma_loai",
							null);
		}
    	if(!empty($nam))
    		$statement->where("dt.nam = ?",$nam);
    	if(!empty($cap_quan_ly))
    		$statement->where('cap_quan_ly = ?',$cap_quan_ly);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getDSDVByHDD($nam,$ma_hd_duyet)
    {
    	$cols = array('ma_don_vi');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols) 
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->where('cap_quan_ly = 2')					  
    					  ->group('ma_don_vi')
    					  ->order('dt.id');
    	if($nam != '0')
    		$statement->where('dt.nam = ?',$nam);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
    public function getDSDTChapThuan($ma_don_vi,$nam,$cap_quan_ly,$ma_loai = null)
    {
    	$cols = array('dt.id','dt.ma','dt.ten','thoi_gian_bat_dau','thoi_gian_hoan_thanh','kinh_phi');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols)
						  //->setIntegrityCheck(false)
    					  ->where('ma_don_vi = ?', $ma_don_vi)
    					  ->where('cap_quan_ly = ?', $cap_quan_ly)
    					  ->where('tinh_trang not in(1,2)')
    					  ->where("dt.nam = ?",$nam)
    					  ->order('dt.id');
		
		if(!empty($ma_loai)){
			$statement->join(array('lv' => 'linh_vuc'),
							"lv.id = dt.ma_linh_vuc",
							null);
			$statement->where("lv.ma_loai = $ma_loai");
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getDSDTByHDDAndDV($ma_hd_duyet,$ma_don_vi)
    {
    	$cols = array('id','ma','ten','thoi_gian_bat_dau','thoi_gian_hoan_thanh','kinh_phi');
    	$tableInfo = array('de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols)
    					  ->where('ma_don_vi = ?', $ma_don_vi)
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->order('id');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getSLDTByHDD($ma_hd_duyet)
    {
    	$cols = array('count' => 'count(id)');
    	$tableInfo = array('de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols)
    					  ->where('ma_hd_duyet = ?', $ma_hd_duyet);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['count']; 
    }
    
    public function getSelectStatisticResult($nam, $conds, $ma_don_vi = null){
    	try{
			$name = $this->info('name');
			$cols = array("count" => "count(*)","kinh_phi" => "sum($name.kinh_phi)");
			$statement = $this->select()
							  ->from($name,$cols)
							  ->where("$name.nam = ?",$nam);
			if($conds != null){
				foreach ($conds as $k=>$v){
					if($k == 'loai_linh_vuc'){
						$lvName = Khcn_Api::_()->getDbTable('linh_vuc', 'default')->info('name');
						$loaiLVName = Khcn_Api::_()->getDbTable('loai_linh_vuc', 'default')->info('name');
						$statement->setIntegrityCheck(false)
								->join($lvName, "$lvName.id = $name.ma_linh_vuc", null)
								->join($loaiLVName, "$loaiLVName.id = $lvName.ma_loai and $loaiLVName.name = '{$v}'", null);
					}else{
						$statement->where($name . '.' . $k . ' = ?',$v);
					}
				}
			}
			if($ma_don_vi != null)
				$statement->where("$name.ma_don_vi = ?",$ma_don_vi);
			return $this->_db->fetchRow($statement);
    	}catch (Zend_Db_Exception $ex){
    		throw $ex;
    	}
    }
	
	public function thong_ke($from, $to, $ma_don_vi = NULL, $limit = 10)
    {
    	try{
	    	$result = array();
			$loaiLVs = Khcn_Api::_()->getDbTable('loai_linh_vuc', 'default')->fetchAll();
	    	for ($i = $to ; $i >= $from ; $i--){
	    		$arr_don_vi = array();
				$giangVienArr = array();
				$loaiLinhVucArr = array();
				// Giang Vien, Don Vi
	    		if($ma_don_vi == null){
		    		$arr_ma_don_vi = $this->getDSDV($i);
		    		foreach ($arr_ma_don_vi as $ma_dv){
						$don_vi = Khcn_Api::_()->getItem('default_don_vi', $ma_dv);
		    			$arr_don_vi[] = array(  
							'ten_don_vi' => $don_vi->getTitle(),
							'so_luong' => $this->getSelectStatisticResult($i,null,$ma_dv)
		    			);
		    		}
					$giangVienArr = Khcn_Api::_()->getDbTable('de_tai', 'default')->getThongKeGVByNam($i, $limit);
	    		}else{
					$giangVienArr = Khcn_Api::_()->getDbTable('de_tai', 'default')->getThongKeGVByNam($i, $limit, $ma_don_vi);
				}
				
				// Loai Linh Vuc
				foreach($loaiLVs as $loai_linh_vuc){
					$loaiLinhVucArr[] = array(
						'ten_loai_linh_vuc' => $loai_linh_vuc->getTitle(),
						'so_luong' => $this->getSelectStatisticResult($i,array('loai_linh_vuc' => $loai_linh_vuc->name),$ma_don_vi)
					);
				}
				
				$tong_so_dt = $this->getSelectStatisticResult($i,null,$ma_don_vi);
				if($tong_so_dt['count'] <= 0){
					continue;
				}
				
	    		$result[] = array(  
					'nam' => $i,
					'tong_so_dt' => $tong_so_dt,
					'cap_truong' => $this->getSelectStatisticResult($i,array('cap_quan_ly' => 2),$ma_don_vi),
					'cap_khoa' => $this->getSelectStatisticResult($i,array('cap_quan_ly' => 1),$ma_don_vi),
					'cac_cap_ngoai_truong' => $this->getSelectStatisticResult($i,array('cap_quan_ly' => 3),$ma_don_vi),
					'chua_duyet' => $this->getSelectStatisticResult($i,array('tinh_trang' => 1),$ma_don_vi),
					'khong_duyet' => $this->getSelectStatisticResult($i,array('tinh_trang' => 2),$ma_don_vi),
					'da_duyet' => $this->getSelectStatisticResult($i,array('tinh_trang' => 3),$ma_don_vi),
					'da_nghiem_thu' => $this->getSelectStatisticResult($i,array('tinh_trang' => 4),$ma_don_vi),
					'khong_nghiem_thu' => $this->getSelectStatisticResult($i,array('tinh_trang' => 5),$ma_don_vi),
					'trung_binh' => $this->getSelectStatisticResult($i,array('xep_loai' => 1),$ma_don_vi),
					'kha' => $this->getSelectStatisticResult($i,array('xep_loai' => 2),$ma_don_vi),
					'gioi' => $this->getSelectStatisticResult($i,array('xep_loai' => 3),$ma_don_vi),
					'xuat_sac' => $this->getSelectStatisticResult($i,array('xep_loai' => 4),$ma_don_vi),
					'khong_dat' => $this->getSelectStatisticResult($i,array('xep_loai' => 5),$ma_don_vi),
					'don_vi' => $arr_don_vi,
					'giang_vien_arr' => $giangVienArr,
					'loai_linh_vuc' => $loaiLinhVucArr
	    		);
	    	}   	
	    	return $result;
    	}catch (Zend_Db_Exception $ex){
    		throw $ex;
    	}
    }
    
	public function getEmailCNByDT($ma_de_tai)
    {
    	$cols = array();
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dk' => 'dang_ky'),
    					  		'dt.id = dk.ma_de_tai and dk.nhiem_vu = 1',null)
    					  ->join(array('gv' => 'giang_vien'),
    					  		'dk.ma_giang_vien = gv.id',
    					  		array('email' => 'gv.email'))
    					  ->where('dt.id = ?',$ma_de_tai);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
    	if($rows)
			return $rows[0]['email'];
		return null;
    }
    
	public function getDSDTSelect($conds)
    {
    	$cols = array('id','ma');
    	$tableInfo = array('dt' => 'de_tai');
    	$statement = $this->select()
    					  ->from($tableInfo,$cols)
    					  ->order('dt.id');
    	foreach ($conds as $k=>$v){
	    	if($k == 'nam')
    			$statement->where("dt.nam = ?",$v);
    		else
    			$statement->where($k . ' = ?',$v);
	    }
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
	
	public function getThongKeGVByNam($nam, $limit = 10, $ma_don_vi = null){
		$tableGV = Khcn_Api::_()->getDbTable('giang_vien', 'default');
    	$nameGV = $tableGV->info('name');
		
		$tableDT = Khcn_Api::_()->getDbTable('de_tai', 'default');
    	$nameDT = $tableDT->info('name');
    	
		$tableDK = Khcn_Api::_()->getDbTable('dang_ky', 'default');
    	$nameDK = $tableDK->info('name');
		
    	$select = $tableGV->select()
    					  ->setIntegrityCheck(false)
    					  ->from($nameGV, "$nameGV.*")
    					  ->join($nameDK,"$nameGV.id = $nameDK.ma_giang_vien", "count($nameDK.ma_de_tai) as count_dt")
						  ->join($nameDT,"$nameDK.ma_de_tai = $nameDT.id and $nameDT.nam = $nam",null)
    					  ->order("count_dt DESC")
						  ->group("$nameGV.id")
						  ->limit($limit);
		if(!empty($ma_don_vi)){
			$select->where("$nameGV.ma_don_vi = ?", $ma_don_vi);
		}					
		
		return $tableGV->fetchAll($select); 
	}
	
	public function getDeTais($params = array()){
		$name = $this->info('name');
		$select = $this->select()
						->from($name);
			
		if(!empty($params['loai_linh_vuc'])){
			$lvName = Khcn_Api::_()->getDbTable('linh_vuc', 'default')->info('name');
			$loaiLVName = Khcn_Api::_()->getDbTable('loai_linh_vuc', 'default')->info('name');
			$select->setIntegrityCheck(false)
					->join($lvName, "$lvName.id = $name.ma_linh_vuc", null)
					->join($loaiLVName, "$loaiLVName.id = $lvName.ma_loai and $loaiLVName.name = '{$params['loai_linh_vuc']}'", null);
		}
		if(!empty($params['ma_don_vi'])){
			$select->where("$name.ma_don_vi = ?",$params['ma_don_vi']);
		}
		if(!empty($params['tinh_trang'])){
			$select->where("$name.tinh_trang = ?",$params['tinh_trang']);
		}
		if(!empty($params["ma_linh_vuc"])){
			$select->where("$name.ma_linh_vuc = ?",$params['ma_linh_vuc']);
		}
		if(!empty($params["cap_quan_ly"])){
			$select->where("$name.cap_quan_ly = ?",$params["cap_quan_ly"]);
		}
		if(!empty($params["from"])){
			$select->where("$name.nam >= ?",$params["from"]);
		}
		if(!empty($params["to"])){
			$select->where("$name.nam <= ?",$params["to"]);
		}
		$direction = $params["direction"];
		if(!empty($params["order"])){
			if($params["order"] == "ma")
				$select->order("SUBSTRING($name.ma FROM 8) $direction");
			if($params["order"] == "nam")
				$select->order("$name.nam $direction");
		}else{
			$select->order("$name.nam $direction");
			$select->order("SUBSTRING($name.ma FROM 8) $direction");
		}
		
		return $this->fetchAll($select);
	}
}