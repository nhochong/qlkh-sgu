<?php
class Default_Model_DbTable_MailTb extends Khcn_Db_Table{
	
	protected $_name = 'mail_thong_bao';
	
	public function getMailTB($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($mail_tb)
    {
    	$data = array(
    				 'tieu_de' => $mail_tb->getTieuDe(),
    				 'noi_dung' => Default_Model_Functions::strip_magic_slashes($mail_tb->getNoiDung()),
    				 'loai' => $mail_tb->getLoai(),
    				 'ngay_goi' => $mail_tb->getNgayGoi(),
    				 'noi_nhan' => $mail_tb->getNoiNhan()
        );
        return $this->insert($data);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}