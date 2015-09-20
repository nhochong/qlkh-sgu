<?php
class Khcn_View_Helper_DfMessage extends Zend_View_Helper_Abstract
{
	public function dfMessage()
	{
		$session = new Zend_Session_Namespace('message');
    	$str = '';
		if (isset($session->msg)) {
			$str = '<div class="message ' . $session->type_msg . '">
					<div>'.$session->msg.'</div>
				  </div>';
			unset($session->msg);	
		}
    	return $str;
	}	
}