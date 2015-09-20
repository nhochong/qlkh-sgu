<?php
class Default_Model_Functions{
	
	/**
     * Convert utf-8 to en
     * @param string $str String need convert
     * @return string String was converted
     */
	public static function convert_vi_to_en($str, $replace_spacebar = true) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		if($replace_spacebar){
			$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		}
		$str = strtolower($str);
		return $str;
	}
	
	/**
     * Split FullName to FirstName and LastName
     * @param string $str FullName need split
     * @return string array Array of FirstName and LastName 
     */
	public static function tach_ho_ten($str)
    {
    	$arr = explode(' ',$str);
    	$len = count($arr);
    	$ten = $arr[$len - 1];
    	$ho = '';
    	for($i = 0 ; $i < $len - 1 ; $i++){
    		if($i != $len - 2)
    			$ho .= $arr[$i] . ' ';
    		else 
    			$ho .= $arr[$i];
    	}
    	return array('ho' => $ho,
    				 'ten' => trim($ten)
    	);
    }
    
    public static function strip_magic_slashes($str) {    
    	return get_magic_quotes_gpc() ? stripslashes($str) : $str; 
    }
    
    /**
     * Encode base64_encode
     * @param string $data Data need encode
     * @return string $data Data was encoded
     */
    public static function encode_64($data)
    {
    	for ($i = 0 ; $i<5 ; $i++)
    		$data = base64_encode($data);
    	return $data;
    }
    
    /**
     * 
     * Decode base64_decode
     * @param string $data Data need decode
     * @return string $data Data was decoded
     */
	public static function decode_64($data)
    {
    	for ($i = 0 ; $i<5 ; $i++)
    		$data = base64_decode($data);
    	return $data;
    }
    
    /**
     * Check code is right format
     * @param string $code code need check
     * @param string $prefix prefix of code
     * @param bool $year if code exist year
     * @param int $len_pre if $prefix null,this field used
     * @return bool true if code is right format 
     */
    public static function kiem_tra_ma($code,$prefix = NULL,$year = FALSE,$len_pre = 0)
    {
    	$code = strtolower($code);
    	if($prefix != null){
	    	$prefix = strtolower($prefix);
	    	$len_pre = strlen($prefix);
	    	$pre_code = substr($code, 0,$len_pre);
	    	if($pre_code != $prefix)
	    		return false;
    	}
    	if($year == true){
    		$year_code = substr($code, $len_pre,4);
    		if(strlen($year_code) != 4)
    			return false;
    		if(!is_numeric($year_code))
    			return false;
    	}
    	return true;
    }
	
	public static function filterParams($params,$filter_params = array()){
		$default_params = array('module','controller','action');
		$filter_params = array_merge($default_params,$filter_params);
		foreach($filter_params as $param){
			unset($params[$param]);
		}
		return $params;
	}
}