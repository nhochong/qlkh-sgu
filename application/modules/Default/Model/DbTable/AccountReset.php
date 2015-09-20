<?php
class Default_Model_DbTable_AccountReset extends Khcn_Db_Table{
	
	protected $_name = 'account_reset';
	
	protected $_rowClass = 'Default_Model_AccountReset';
	
	public function getAccountReset($reset_id) 
    {
        $row = $this->fetchRow('reset_id = "' . $reset_id . '"');
        return $row;
    }
    
    public function them($account_reset)
    {
    	$data = array(
            'reset_id' => $account_reset->getResetId(),
            'account_id' => $account_reset->getAccountId(),
    		'new_pass' => $account_reset->getNewPass(),
    		'expiration' => $account_reset->getExpiration()
        );
        return $this->insert($data);
    }

    public function xoa($reset_id)
    {
    	return $this->delete('reset_id = "' . $reset_id . '"');
    }
    
	public function kiem_tra_yeu_cau($account_id)
    {
    	$cols = array('reset_id');
    	$statement = $this->select()
    					  ->from('account_reset',$cols)
    					  ->where('account_id = ?',$account_id)
    					  ->where('expiration > ?',date('Y-m-d H:i:s'));
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	if($row)
    		return true;
    	return false;
    }
}