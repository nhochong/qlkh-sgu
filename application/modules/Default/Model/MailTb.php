<?php
class Default_Model_MailTb extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_tieu_de;
	private $_noi_dung;
	private $_ngay_goi;
	private $_noi_nhan;
	private $_loai;
	protected  $mail_tb = null;
	
	public function init()
	{
		$this->mail_tb = new Default_Model_DbTable_MailTb();
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
    
	public function setTieuDe($tieuDe)
    {
        $this->_tieu_de = $tieuDe;
        return $this;
    }    
    public function getTieuDe()
    {
        return $this->_tieu_de;
    }
    
	public function setNoiDung($noi_dung)
    {
        $this->_noi_dung = $noi_dung;
        return $this;
    }    
    
    public function getNoiDung()
    {
        return $this->_noi_dung;
    }
    
	public function setNgayGoi($ngay_goi)
    {
        $this->_ngay_goi = $ngay_goi;
        return $this;
    }    
    public function getNgayGoi()
    {
        return $this->_ngay_goi;
    }
    
	public function setNoiNhan($noi_nhan)
    {
        $this->_noi_nhan = $noi_nhan;
        return $this;
    }    
    public function getNoiNhan()
    {
        return $this->_noi_nhan;
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
    
    public function getMailTB($id)
    {
    	return $this->mail_tb->getMailTB($id);
    }
    /*
     * loai = 1 : thong bao duyet
     * loai = 2 : thong bao nghiem thu
     * noi_nhan sẽ lưu các giá trị sau :
     * 	+ =0 nếu send cho tất cả các đề tài sắp duyệt
     * 	+ id hội đồng
     * 	+ id mã đề tài
     * Cách lưu nơi nhận :
     * 	+ Nếu loai = 1 && noi_nhan = 0 : send cho tất cả các đề tài sắp đc duyệt
     * 	+ Nếu loai = 1 && noi_nhan != 0 : send cho tất cả các đề tài trong hội đồng duyệt đó dựa vào nơi nhận
     *  + Nếu loai = 2 && noi_nhan != 0 : send cho 1 đề tài dựa vào nơi nhận.
     * 
     */
	public function getAll()
    {
    	$mailTBs = $this->mail_tb->getAll();	
    	$dsMailTBs = array();
    	foreach ($mailTBs as $mail_tb){
    		if($mail_tb['noi_nhan'] == '0')
    			$noi_nhan = 'Đề tài sắp duyệt';
    		else{
    			$bizDeTai = new Default_Model_DeTai();
    			$bizHDD = new Default_Model_Hdd();
    			if($mail_tb['loai'] == '1'){    	
    				$hdd = $bizHDD->getHDD($mail_tb['noi_nhan']);
    				$noi_nhan = $hdd['ma'];			
    			}else if($mail_tb['loai'] == '2'){  				
    				$de_tai = $bizDeTai->getDeTai($mail_tb['noi_nhan']);
    				$noi_nhan = $de_tai['ma'];
    			}
    		}  
    		$dsMailTBs[] = array( 'id' => $mail_tb['id'],
    							  'tieu_de' => $mail_tb['tieu_de'],
    							  'ngay_goi' => date('H:i d/m/Y',strtotime($mail_tb['ngay_goi'])),
    							  'loai' => $mail_tb['loai'],
    							  'noi_nhan' => $noi_nhan
    		);
    	}
    	return $dsMailTBs;
    }
    
	public function them()
    {
    	return $this->mail_tb->them($this);
    }
    
    public function MailTBToArray($mail_tb)
    {
    	return array('id' => $mail_tb->id,
    				 'tieu_de' => $mail_tb->tieu_de,
    				 'noi_dung' => $mail_tb->noi_dung,
    				 'loai' => $mail_tb->loai,
    				 'ngay_goi' => $mail_tb->ngay_goi,
    				 'noi_nhan' => $mail_tb->noi_nhan,
    	);
    } 
    
    public function xoa($id)
    {
    	return $this->mail_tb->xoa($id);
    }
    
    public function send_mail_hdd($arr_hdd,$subject,$emailMessage)
    {
    	$de_tai = new Default_Model_DeTai();
    	$arr_email = array();
    	foreach ($arr_hdd as $hdd){
    		$arr_de_tai = $de_tai->getDSDTByHDD($hdd);
    		foreach ($arr_de_tai as $ma_de_tai){
    			$email = $de_tai->getEmailCNByDT($ma_de_tai['id']);
    			if($email != null)
    				$arr_email[] = $email; 
    		}
    	}  
		Khcn_Api::_()->getApi('mail', 'default')->sendSystemRaw($arr_email, array(
			'subject' => $subject,
			'body' => $emailMessage
		));
    }
}