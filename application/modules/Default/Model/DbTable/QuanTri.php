<?php
class Default_Model_DbTable_QuanTri extends Khcn_Db_Table{
	
	protected $_name = 'quan_tri';
	
	public function getQuanTri($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getDSMod()
    {
    	$statement = $this->select()
    					  ->where('ma_quyen = 2')
    					  ->order('trang_thai DESC')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function updateLDNC($id)
    {
    	$data = array(
            'lan_dang_nhap_cuoi' => new Zend_Db_Expr("NOW()")
        );
        $this->update($data,'id = '.(int) $id);
    }
    
	public function sua($quan_tri)
    {
		$data = array(
    				 'ho' => $quan_tri->getHo(),
    				 'ten' => $quan_tri->getTen(),
    				 'ngay_sinh' => $quan_tri->getNgaySinh(),
    				 'email' => $quan_tri->getEmail(),
        );
        $this->update($data, 'id = '. (int)$quan_tri->getId());
        
    }
    
	public function change_pass($id,$mat_khau)
    {
    	$data = array(
	            'mat_khau' => $mat_khau,
	        );
	     $this->update($data, 'id = '. (int)$id);
    }
    
	public function kiem_tra_mod($ten_dang_nhap)
    {
    	$statement = $this->select()
    					  ->where('ten_dang_nhap = ?',$ten_dang_nhap)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function kiem_tra_email($email,$id)
    {
    	$statement = $this->select()
    					  ->where('email = ?',$email)
    					  ->limit(1,0);
    	if($id != null)
    		$statement->where('id != ?',$id);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
 	public function them($quan_tri)
    {
    	$data = array(
    				 'ten_dang_nhap' => $quan_tri->getTenDangNhap(),
    				 'mat_khau' => $quan_tri->getMatKhau(),
    				 'ho' => $quan_tri->getHo(),
    				 'ten' => $quan_tri->getTen(),
    				 'ngay_sinh' => $quan_tri->getNgaySinh(),
    				 'email' => $quan_tri->getEmail(),
    				 'ngay_tao' => $quan_tri->getNgayTao(),
    				 'trang_thai' => $quan_tri->getTrangThai(),
    				 'ma_quyen' => $quan_tri->getMaQuyen(),
    				 
        );
        return $this->insert($data);
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