<?php
class Default_Model_NguoiDung extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten_dang_nhap;
	private $_mat_khau;
	private $_ho;
	private $_ten;
	private $_ngay_sinh;
	private $_email;
	private $_ngay_tao;
	private $_ma_quyen;
	private $_enabled;
	
	protected $nguoi_dung = null;
	
	public function init()
    {
    	$this->nguoi_dung = new Default_Model_DbTable_NguoiDung();	
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
    
	public function setMaQuyen($maQuyen)
    {
        $this->_ma_quyen = $maQuyen;
        return $this;
    }    
    public function getMaQuyen()
    {
        return $this->_ma_quyen;
    }
    
    public function getAll()
    {
		return $this->nguoi_dung->getAll();
    }
    
	public function getDSViPham()
    {
    	return $this->nguoi_dung->getDSViPham();
    }
    
	public function register()
    {
    	return $this->nguoi_dung->register($this);
    }
    
    //lấy người dùng theo kiểu đối tượng
    public function getNguoiDung($id)
    {
    	return $this->nguoi_dung->getNguoiDung($id);	
    }
    
    //tạo người dùng như là một object
    public function NguoiDungToObject($nguoi_dung)
    {
    	
    	$data = new stdClass();//khoi tao
    	$data->id = $nguoi_dung['id']; 
    	$data->ten_dang_nhap = $nguoi_dung['ten_dang_nhap'];
        $data->ho = $nguoi_dung['ho']; 
        $data->ten = $nguoi_dung['ten']; 
        $data->ngay_sinh = $nguoi_dung['ngay_sinh']; 
        $data->email = $nguoi_dung['email']; 
        $data->ngay_tao = $nguoi_dung['ngay_tao'];
        $data->enabled = $nguoi_dung['enabled'];
        return $data;
    }
   
	public function sua()
    {
    	$this->nguoi_dung->sua($this);
    }
    
 	public function change_pass($id,$mat_khau)
    {
    	$this->nguoi_dung->change_pass($id,$mat_khau);
    }
    
	public function CapNhatTT($id,$status)
    {
    	return $this->nguoi_dung->CapNhatTT($id,$status);
    }
    
	public function xoa($id)
    {
    	return $this->nguoi_dung->xoa($id);
    }
    
    public function kiem_tra_user($user)
    {
    	return $this->nguoi_dung->kiem_tra_user($user);
    }
    
	public function kiem_tra_email($email,$id = null)
    {
    	return $this->nguoi_dung->kiem_tra_email($email,$id);
    }
    
	public function getNDByTDN($ten_dang_nhap)
    {
    	return $this->nguoi_dung->getNDByTDN($ten_dang_nhap);
    }
	
	public function setObjectData($data){
		$this->_id = $data['id'];
		$this->_ten_dang_nhap = $data['ten_dang_nhap'];
		$this->_mat_khau = $data['mat_khau'];
		$this->_ho = $data['ho'];
		$this->_ten = $data['ten'];
		$this->_ngay_sinh = $data['ngay_sinh'];
		$this->_email = $data['email'];
		$this->_enabled = $data['enabled'];
		$this->_ma_quyen = $data['ma_quyen'];
	}
	
	public function isAdmin()
	{
		// Not logged in, not an admin
		if( !$this->getIdentity() || empty($this->ma_quyen) ) {
		  return false;
		}
		
		// Check level
		//return (bool) Engine_Registry::get('database-default')
		// return (bool) Zend_Registry::get('Zend_Db')
		return $this->getTable()->getAdapter()
			->select()
			->from('quyen', new Zend_Db_Expr('TRUE'))
			->where('id = ?', $this->ma_quyen)
			->where('loai IN(?)', array('admin', 'moderator'))
			->limit(1)
			->query()
			->fetchColumn();
	}
  
	public function isAdminOnly()
	{
		// Not logged in, not an admin
		if( !$this->getIdentity() || empty($this->ma_quyen) ) {
		  return false;
		}
		
		// Check level
		//return (bool) Engine_Registry::get('database-default')
		// return (bool) Zend_Registry::get('Zend_Db')
		return $this->getTable()->getAdapter()
			->select()
			->from('quyen', new Zend_Db_Expr('TRUE'))
			->where('id = ?', $this->ma_quyen)
			->where('loai IN(?)', array('admin'))
			->limit(1)
			->query()
			->fetchColumn();
	}
	
	public function setTenHienThi($displayName){
		if( is_string($displayName) )
		{
			$this->ten_hien_thi = $displayName;
		}

		else if( is_array($displayName) )
		{
			// Has both names
			if( !empty($displayName['ho']) && !empty($displayName['ten']) )
			{
				$displayName = $displayName['ho'].' '.$displayName['ten'];
			}
			// Has full name
			else if( !empty($displayName['ho_ten']) )
			{
				$displayName = $displayName['ho_ten'];
			}
			// Has only first
			else if( !empty($displayName['ho']) )
			{
				$displayName = $displayName['ho'];
			}
			// Has only last
			else if( !empty($displayName['ten']) )
			{
				$displayName = $displayName['ten'];
			}
			// Has neither (use username)
			else
			{
				$displayName = $this->ten_dang_nhap;
			}
		  
			$this->ten_hien_thi = $displayName;
		}
	}
	
	/**
	* Pre-update hook. If overridden, should be called at end of function.
	*
	* @return void
	*/
	protected function _postUpdate()
	{
		if(!empty($this->ma_giang_vien) && ($giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $this->ma_giang_vien))){
			$giang_vien->ho = $this->ho;
			$giang_vien->ten = $this->ten;
			$giang_vien->save();
		}
		parent::_postUpdate();
	}
	
	/**
	* Pre-update hook. If overridden, should be called at end of function.
	*
	* @return void
	*/
	protected function _update()
	{
		if(!empty($this->ma_giang_vien) && ($giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $this->ma_giang_vien))){
			$giang_vien->ho = $this->ho;
			$giang_vien->ten = $this->ten;
			$giang_vien->save();
		}
		parent::_update();
	}
	
	public function getGiangVien(){
		if(empty($this->giang_vien_id))
			return null;
		return Khcn_Api::_()->getItem('default_giang_vien', $this->giang_vien_id);
	}
	
	public function isGiangVien(){
		$giang_vien = $this->getGiangVien();
		if($giang_vien)
			return true;
		return false;
	}
	
	public function canViewCesti(){
		return Khcn_Api::_()->getApi('authorization','default')->isAllowed('cong_thong_tin', null, 'view');
	}
	
	public function getDisplayname(){
		$displayname = '';
		if(!empty($this->ho))
			$displayname = $this->ho . ' ';
		if(!empty($this->ten))
			$displayname .= $this->ten;
		if(empty($displayname))
			return $this->ten_dang_nhap;
		return $displayname;
	}
}
    
  
    