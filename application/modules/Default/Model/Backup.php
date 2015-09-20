<?php
class Default_Model_Backup extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten_file;
	private $_loai;
	private $_ngay_tao;
	protected $backup = null;
	
	public function init()
	{
		$this->backup = new Default_Model_DbTable_Backup();
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
    
	public function setTenFile($ten_file)
    {
        $this->_ten_file = $ten_file;
        return $this;
    }    
    
    public function getTenFile()
    {
        return $this->_ten_file;
    }
    
	public function setLoai($loai)
    {
        $this->_loai = $loai;
        return $this;
    }    
    public function getLoai()
    {
        return $this->_loai;
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
    
    public function getAll()
    {   	
    	$result = $this->backup->getAll();
    	$dsBackups = array();
    	foreach ($result as $backup){
    		$dsBackups[] = array('id' => $backup['id'],
    							 'ten_file' => $backup['ten_file'],
    							 'loai' => $backup['loai'],
    							 'ngay_tao' => date('H:i d/m/Y',strtotime($backup['ngay_tao']))
    		);
    	}
    	return $dsBackups;
    }
    
	public function getBackup($id)
    {
    	return $this->backup->getBackup($id);
    }
    
    public function them()
    {
    	return $this->backup->them($this);
    }
    
    public function getFile($id)
    {
    	$file = $this->backup->getFile($id);
    	return $file[0]['ten_file'];
    }
    
    public function xoa($id)
    {
    	return $this->backup->xoa($id);
    }
}