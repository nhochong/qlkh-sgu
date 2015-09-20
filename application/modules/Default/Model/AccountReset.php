<?php
class Default_Model_AccountReset extends Khcn_Model_Item_Abstract{
	
	private $_reset_id;
	private $_account_id;
	private $_new_pass;
	private $_expiration;
	protected $account_reset = null;
	
	public function init()
    {
    	$this->account_reset = new Default_Model_DbTable_AccountReset();	
    }
    
	public function setResetId($reset_id)
    {
        $this->_reset_id = $reset_id;
        return $this;
    }    
    public function getResetId()
    {
        return $this->_reset_id;
    }
    
	public function setAccountId($account_id)
    {
        $this->_account_id = $account_id;
        return $this;
    }    
    public function getAccountId()
    {
        return $this->_account_id;
    }
    
	public function setNewPass($new_pass)
    {
        $this->_new_pass = $new_pass;
        return $this;
    }    
    
    public function getNewPass()
    {
        return $this->_new_pass;
    }
    
	public function setExpiration($expiration)
    {
        $this->_expiration = $expiration;
        return $this;
    }    
    public function getExpiration()
    {
        return $this->_expiration;
    }
    
	public function them()
    {
    	return $this->account_reset->them($this);
    }
    
    public function getAccountReset($reset_id) 
    {
    	return $this->account_reset->getAccountReset($reset_id);
    }
    
    public function xoa($reset_id)
    {
    	return $this->account_reset->xoa($reset_id);
    }
    
    public function kiem_tra_yeu_cau($account_id)
    {
    	return $this->account_reset->kiem_tra_yeu_cau($account_id);
    }
}