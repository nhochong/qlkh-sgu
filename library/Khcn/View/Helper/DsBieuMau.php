<?php
class Khcn_View_Helper_DsBieuMau extends Zend_View_Helper_Abstract{
	
	public function dsBieuMau(){
    	$results = Khcn_Api::_()->getDbTable('loai_bieu_mau', 'default')->getAll();
    	$str = '<div id="ds_bieu_mau">';
    	foreach ($results as $loai_bm){
			$bieuMaus = $loai_bm->getDanhSachBieuMau();
			$str .= "<h3>" . $loai_bm->getTitle() . "</h3>";
			$str .= "<div><ul>";
			foreach($bieuMaus as $bieu_mau){
				$str .=  '<li><a class="Normal" href="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/bieu_mau/' . $bieu_mau->ten_file .'">' . $bieu_mau->getTitle() . '</a></li>';
			}
    		$str .= "</ul></div>";
    	}
    	$str .= '</div>';
    	return $str;
	}
}