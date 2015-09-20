<?php
class Khcn_View_Helper_DsThongBaoMoi extends Zend_View_Helper_Abstract
{
	public function dsThongBaoMoi()
	{
		$bizThongBao = new Default_Model_ThongBao();
		$result = array();
    	$result = $bizThongBao->getTBMoi(); 
    	$link = new Zend_View_Helper_Url();
    	$str = '<ul id="scroller">';
    	foreach ($result as $thong_bao)
    	{
    		$url = $link->url(array(    
			            'controller' => 'thong-bao',  
			            'action'     => 'chi-tiet',  
			            'id'   => $thong_bao['id'],  
			        ),null,true);
    		$str .=  '<li><a class="Normal" href="' . $url . '" target="_self">' . $thong_bao['tieu_de'] . '</a>' . ' (' . $thong_bao['ngay_tao'] . ')</li>';
    	}
    	$str .= '</ul>';
    	return $str;
	}	
}