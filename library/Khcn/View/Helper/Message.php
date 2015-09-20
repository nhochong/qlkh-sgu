<?php
class Khcn_View_Helper_Message extends Zend_View_Helper_Abstract
{
	public function message()
	{
    	$str = '';
		if (isset($_SESSION['msg'])) {
			$str = '<div class="notification ' . $_SESSION['type_msg'] . ' png_bg">
					<a href="#" class="close"><img src="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/../application/templates/admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
					<div>'.$_SESSION['msg'].'</div>
				  </div>';
			unset($_SESSION['msg']);	
		}
    	return $str;
	}	
}