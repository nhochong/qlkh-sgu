<?php
class Khcn_View_Helper_DsLienKetTrong extends Zend_View_Helper_Abstract
{
	public function dsLienKetTrong()
	{
		$params = array();
		$params['is_sgu'] = 1;
		$result = Khcn_Api::_()->getDbTable('lien_ket', 'default')->getLienKets($params);
    	$str = '<ul>';
    	foreach ($result as $lien_ket)
    	{
    		$str .=  '<li><a class="Normal" href="' . $lien_ket['url'] .'" target="_blank">' . $lien_ket['ten'] . '</a></li>';
    	}
    	$str .= '</ul>';
    	return $str;
	}	
}