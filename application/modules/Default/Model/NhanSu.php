<?php
class Default_Model_NhanSu extends Khcn_Model_Item_Abstract{
	public function getWebsiteUrl(){
		if (empty($this->website)){
            return null;
        }
        
        if (strpos($this->website, 'http://') === false && strpos($this->website, 'https://') === false ){
            return 'http://' . $this->website;
        }
        
        return $this->website;
	}
	
	public function getPhotoUrl($type = null){
		if(empty($this->ten_file))
			return Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/images/nophoto_user.png';
		return parent::getPhotoUrl($type);
	}
}