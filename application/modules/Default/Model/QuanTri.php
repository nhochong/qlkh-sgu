<?php
class Default_Model_QuanTri extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten_dang_nhap;
	private $_mat_khau;
	private $_ho;
	private $_ten;
	private $_ngay_sinh;
	private $_email;
	private $_trang_thai;
	private $_ma_quyen;
	private $_ngay_tao;
	private $_lan_dang_nhap_cuoi;
	
	protected $quan_tri = null;
	
	public function init()
    {
    	$this->quan_tri = new Default_Model_DbTable_QuanTri();	
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
    
	public function setTenDangNhap($tenDangNhap)
    {
        $this->_ten_dang_nhap = $tenDangNhap;
        return $this;
    }    
    public function getTenDangNhap()
    {
        return $this->_ten_dang_nhap;
    }
    
	public function setMatKhau($mat_khau)
    {
        $this->_mat_khau = $mat_khau;
        return $this;
    }    
    public function getMatKhau()
    {
        return $this->_mat_khau;
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
    
	public function setNgaySinh($ngaySinh)
    {
        $this->_ngay_sinh = $ngaySinh;
        return $this;
    }    
    
    public function getNgaySinh()
    {
        return $this->_ngay_sinh;
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
    
	public function setNgayTao($ngayTao)
    {
        $this->_ngay_tao = $ngayTao;
        return $this;
    }    
    public function getNgayTao()
    {
        return $this->_ngay_tao;
    }
    
	public function setLanDangNhapCuoi($lanDangNhapCuoi)
    {
        $this->_lan_dang_nhap_cuoi = $lanDangNhapCuoi;
        return $this;
    }    
    public function getLanDangNhapCuoi()
    {
        return $this->_lan_dang_nhap_cuoi;
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
    
	public function setMaQuyen($maQuyen)
    {
        $this->_ma_quyen = $maQuyen;
        return $this;
    }    
    public function getMaQuyen()
    {
        return $this->_ma_quyen;
    }
    
    public function getQuanTri($id)
    {
    	return $this->quan_tri->getQuanTri($id);
    }
    
    public function updateLDNC($id)
    {
    	$this->quan_tri->updateLDNC($id);
    }
    
	public function getDSMod()
    {
    	$mods = $this->quan_tri->getDSMod();
    	$result = array();
    	foreach ($mods as $mod){
    		$result[] = array('id' => $mod['id'],
    						  'ten_dang_nhap' => $mod['ten_dang_nhap'],
    						  'ho_ten' => $mod['ho'] . ' ' . $mod['ten'],
    						  'ngay_sinh' => date('d-m-Y',strtotime($mod['ngay_sinh'])),
    						  'email' => $mod['email'],
    						  'ngay_tao' => date('H:i d/m/Y',strtotime($mod['ngay_tao'])),
    						  'trang_thai' => $mod['trang_thai']
    		);
    	}
    	return $result;
    }
    
	public function them()
    {
    	return $this->quan_tri->them($this);
    }
    
	public function sua()
    {
    	$this->quan_tri->sua($this);
    }
    
	public function change_pass($id,$mat_khau)
    {
    	$this->quan_tri->change_pass($id,$mat_khau);
    }
    
	public function CapNhatTT($id,$status)
    {
    	return $this->quan_tri->CapNhatTT($id,$status);
    }
    
	public function xoa($id)
    {
    	return $this->quan_tri->xoa($id);
    }
    
    public function kiem_tra_mod($ten_dang_nhap)
    {
    	return $this->quan_tri->kiem_tra_mod($ten_dang_nhap);
    }
    
	public function kiem_tra_email($email,$id = null)
    {
    	return $this->quan_tri->kiem_tra_email($email,$id);
    }
}