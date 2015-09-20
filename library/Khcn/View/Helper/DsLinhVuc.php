<?php
class Khcn_View_Helper_DsLinhVuc extends Zend_View_Helper_Abstract
{
	public function dsLinhVuc()
	{
		$bizLinhVuc = new Default_Model_LinhVuc();
		$result = array();
    	$result = $bizLinhVuc->getAll(); 
    	$link = new Zend_View_Helper_Url();
    	$str = '<ul>';
    	foreach ($result as $linh_vuc)
    	{
    		$url = $link->url(array(    
			            'controller' => 'de-tai',  
			            'action'     => 'danh-sach',  
			            'catid'   => $linh_vuc['id'],  
			        ),null,true);
    		$str .=  '<li><a class="Normal" href="' . $url . '" target="_self">' . $linh_vuc['ten'] . '</a></li>';
    	}
    	$str .= '</ul>';
    	return $str;
	}	
}