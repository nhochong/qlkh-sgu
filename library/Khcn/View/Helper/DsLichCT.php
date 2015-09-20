<?php
class Khcn_View_Helper_DsLichCT extends Zend_View_Helper_Abstract{
	
	public function dsLichCT(){
		$lichCTs = Khcn_Api::_()->getDbTable('lich_cong_tac', 'default')->getLichCTs(array('trang_thai' => 1, 'limit' => 5));
    	$link = new Zend_View_Helper_Url();
    	$str = '<ul>';
    	foreach ($lichCTs as $lichCT)
    	{
    		$url = $link->url(array(    
			            'controller' => 'lich-cong-tac',  
			            'action'     => 'chi-tiet',  
			            'id'   => $lichCT['id'],  
			        ),null,true);
    		$str .=  '<li><a class="Normal" href="' . $url .'">Tuần ' . $lichCT['tuan'] . ' tháng ' . $lichCT['thang'] . ' (' . date('d/m/Y', strtotime($lichCT['ngay_bat_dau'])) .' - ' . date('d/m/Y', strtotime($lichCT['ngay_ket_thuc'])) .')</a></li>';
    	}
    	$str .= '</ul>';
    	return $str;
	}
}