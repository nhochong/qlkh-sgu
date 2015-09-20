<?php
class Default_Model_LienKet extends Khcn_Model_Item_Abstract{
	
	public function getLink(){
        if (empty($this->url)){
            return null;
        }
        
        if (strpos($this->url, 'http://') === false && strpos($this->url, 'https://') === false ){
            return 'http://' . $this->url;
        }
        
        return $this->url;
    }
}