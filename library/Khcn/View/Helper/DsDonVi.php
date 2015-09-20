<?php
class Khcn_View_Helper_DsDonVi extends Zend_View_Helper_Abstract
{
	public function dsDonVi($laKhoa)
	{
		$bizDonVi = new Default_Model_DonVi();
		$result = array();
    	$result = $bizDonVi->getDSByLaKhoa($laKhoa); 
    	$link = new Zend_View_Helper_Url();
    	$str = '<ul class="ds_donvi">';
    	foreach ($result as $don_vi)
    	{
    		$url = $link->url(array(    
			            'controller' => 'de-tai',  
			            'dept'   => $don_vi['id'],  
			        ),null,true);
    		$str .=  '<li><a class="Normal" href="' . $url . '" target="_self">' . $don_vi['ten'] . '</a></li>';
    	}
    	$str .= '</ul>';
    	return $str;
	}	
}