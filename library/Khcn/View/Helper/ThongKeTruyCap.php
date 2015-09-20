<?php
class Khcn_View_Helper_ThongKeTruyCap extends Zend_View_Helper_Abstract
{
	public function thongKeTruyCap()
	{
		$bo_dem = new Default_Model_BoDem();
		//Tong so lan truy cap
		$so_luong = $bo_dem->tong_luot_truy_cap();
		$str_soluong = strval($so_luong);
		$n_soluong = strlen($str_soluong);
		$temp = '0000000';
		$str_cut = substr($temp,0,7 - $n_soluong);
		$str_soluong = $str_cut . $str_soluong;
		
		$html = '<p style="text-align: center;">';
		for($i = 0 ; $i < 7 ; $i++){													
			$html .= '<img src="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/images/counter/mechanical/' . $str_soluong[$i] . '.gif" alt="">';
		}
		$html .= '</p>';
		$html .= '<table><body>';
		$html .= '<tr>';
		$html .= 	'<td class="now">Hôm nay</td>';
		$html .= 	'<td class="r">' . $bo_dem->so_luong_hom_nay() . '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= 	'<td class="week">Tuần này</td>';
		$html .= 	'<td class="r">' . $bo_dem->so_luong_tuan_nay() . '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= 	'<td class="month">Tháng này</td>';
		$html .= 	'<td class="r">' . $bo_dem->so_luong_thang_nay() . '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= 	'<td class="all">Tất cả</td>';
		$html .= 	'<td class="r">' . $bo_dem->tong_luot_truy_cap() . '</td>';
		$html .= '</tr>';
		$html .= '</body></table>';
		
		return $html;
	}	
}