<?php
class Default_Model_GiangVien extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ma;
	private $_ho;
	private $_ten;
	private $_email;
	private $_so_dien_thoai;
	private $_chuc_vu;
	private $_trang_thai;
	private $_ma_don_vi;
	private $_ma_hoc_vi;
	protected $giang_vien = null;
	
	public function init()
    {
    	$this->giang_vien = new Default_Model_DbTable_GiangVien();	
    }
    
	public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }    
    public function getId()
    {
        return $this->_id;
    }
    
	public function setMa($ma)
    {
        $this->_ma = $ma;
        return $this;
    }    
    public function getMa()
    {
        return $this->_ma;
    }
    
	public function setHo($ho)
    {
        $this->_ho = $ho;
        return $this;
    }    
    public function getHo()
    {
        return $this->_ho;
    }
    
	public function setTen($ten)
    {
        $this->_ten = $ten;
        return $this;
    }    
    public function getTen()
    {
        return $this->_ten;
    }
    
	public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }    
    public function getEmail()
    {
        return $this->_email;
    }
    
	public function setSoDienThoai($soDienThoai)
    {
        $this->_so_dien_thoai = $soDienThoai;
        return $this;
    }    
    
    public function getSoDienThoai()
    {
        return $this->_so_dien_thoai;
    }
    
	public function setChucVu($chucVu)
    {
        $this->_chuc_vu = $chucVu;
        return $this;
    }    
    public function getChucVu()
    {
        return $this->_chuc_vu;
    }
    
	public function setTrangThai($trangThai)
    {
        $this->_trang_thai = $trangThai;
        return $this;
    }    
    public function getTrangThai()
    {
        return $this->_trang_thai;
    }
    
	public function setMaDonVi($maDonVi)
    {
        $this->_ma_don_vi = $maDonVi;
        return $this;
    }    
    public function getMaDonVi()
    {
        return $this->_ma_don_vi;
    }
    
	public function setMaHocVi($maHocVi)
    {
        $this->_ma_hoc_vi = $maHocVi;
        return $this;
    }    
    public function getMaHocVi()
    {
        return $this->_ma_hoc_vi;
    }
    
    public function getAll()
    {
    	return $this->giang_vien->getAll();
    }
    
    public function getGiangVien($id)
    {
    	return $this->giang_vien->getGiangVien($id);
    }
    
    public function getGVById($id)
    {
    	return $this->giang_vien->getGVById($id);
    }
    
	public function getIdByMa($ma)
    {
    	return $this->giang_vien->getIdByMa($ma);	
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->giang_vien->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->giang_vien->kiem_tra_id_ma($id,$ma);
    }
    
	public function KiemTraHV($ma_hoc_vi)
    {
    	return $this->giang_vien->KiemTraHV($ma_hoc_vi);
    }
    
	public function KiemTraDV($ma_don_vi)
    {
    	return $this->giang_vien->KiemTraDV($ma_don_vi);
    }
    
	public function them()
    {
    	return $this->giang_vien->them($this);
    }
    
    public function GiangVienToArray($giang_vien)
    {
    	return array('id' => $giang_vien->id,
    				 'ma' => $giang_vien->ma,
    				 'ho' => $giang_vien->ho,
    				 'ten' => $giang_vien->ten,
    				 'email' => $giang_vien->email,
    				 'so_dien_thoai' => $giang_vien->so_dien_thoai,
    				 'chuc_vu' => $giang_vien->chuc_vu,
    				 'ma_don_vi' => $giang_vien->ma_don_vi,
    				 'ma_hoc_vi' => $giang_vien->ma_hoc_vi,
    	);
    } 
    
    public function sua()
    {
    	return $this->giang_vien->sua($this);
    }
    
	public function cap_nhat($id,$conds)
    {
    	return $this->giang_vien->cap_nhat($id,$conds);
    }
    
    public function xoa($id)
    {
    	return $this->giang_vien->xoa($id);
    }
    
    public function loc($params = array())
    {
    	return $this->giang_vien->loc($params);
    }
    
    public function getDSGVByDV($ma_don_vi)
    {
    	$giangViens = $this->giang_vien->getDSGVByDV($ma_don_vi);
    	$result = array();
    	foreach ($giangViens as $giang_vien)
    	{
    		$result[$giang_vien['id']] = ($giang_vien['ma'] == null ? '' : $giang_vien['ma'] . ' - ' ) . ($giang_vien['hoc_vi'] == '0' ? '' : $giang_vien['hoc_vi']) . $giang_vien['ho'] . ' ' . $giang_vien['ten'];
    	}
    	return $result;
    }
    
    public function kiem_tra_giang_vien($ho_ten,$ma_don_vi = null,$ma_hoc_vi = null)
    {
    	return $this->giang_vien->kiem_tra_giang_vien($ho_ten,$ma_don_vi,$ma_hoc_vi);
    }
    
    public function getGVNgoaiSGU()
    {
    	return $this->giang_vien->getGVNgoaiSGU();
    }
	
	public function getHocVi(){
		return Khcn_Api::_()->getItem('default_hoc_vi', $this->ma_hoc_vi);
	}
	
	public function getDonVi(){
		if(!empty($this->ma_don_vi)){
			return Khcn_Api::_()->getItem('default_don_vi', $this->ma_don_vi);
		}
		return null;
	}
	
	public function getHoTen($hv = true){
		if($hv)
			return $this->getHocVi()->ma . ' ' . $this->ho . ' ' . $this->ten;
		else
			return $this->ho . ' ' . $this->ten;
	}
	
	public function getSoLuongDT(){
		$table = Khcn_Api::_()->getDbTable('dang_ky', 'default');
		$name = $table->info('name');
		$select = $table->select()
						->from($name, 'COUNT(*) AS count')
						->where("ma_giang_vien = ?", $this->getIdentity());
		return $select->query()->fetchColumn(0);
	}
	
	public function getDSDeTaiByGiangVien($params = array()){
		$id_giang_vien = $this->getIdentity();
		$table = Khcn_Api::_()->getDbTable('de_tai', 'default');
    	$name = $table->info('name');
    	
		$tableDK = Khcn_Api::_()->getDbTable('dang_ky', 'default');
    	$nameDK = $tableDK->info('name');
		
    	$nameDK = $tableDK->info('name');
		
    	$select = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($name, "$name.*")
    					  ->join($nameDK,"$name.id = $nameDK.ma_de_tai and $nameDK.ma_giang_vien = $id_giang_vien",null)
    					  ->order("$name.thoi_gian_bat_dau DESC");
		if(!empty($params['from_year'])){
			$select->where("$name.nam >= ?", $params['from_year']);
		}
		if(!empty($params['to_year'])){
			$select->where("$name.nam <= ?", $params['to_year']);
		}
		if(!empty($params['limit'])){
			$select->limit($params['limit']);
		}
		return $table->fetchAll($select); 
	}
	
	public function getDisplayname(){
		$displayname = "";
		if(!empty($this->ma))
			$displayname .= $this->ma . ' - ';
		$hoc_vi = $this->getHocVi();
		if(!empty($hoc_vi->ma) && $hoc_vi->ma != '0')
			$displayname .= $hoc_vi->ma . ' ';
		$displayname .= $this->ho . ' ' . $this->ten;
		return $displayname;
	}
}