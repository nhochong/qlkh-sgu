<?php
class Default_Model_HinhAnh extends Khcn_Model_Item_Abstract{

	protected function _postInsert(){
		parent::_postInsert();
		
		if($this->slideshow){
			$this->updateSlideshow();
		}
	}	
	
	protected function _postUpdate(){
		parent::_postUpdate();
		$this->updateSlideshow();
	}
	
	protected function _postDelete(){
		parent::_postDelete();
		$this->updateSlideshow();
	}
	
	private function updateSlideshow(){
		$hinhAnhs = Khcn_Api::_()->getDbTable('hinh_anh', 'default')->getSlideshow();
		$text = '<photos>';
		foreach ($hinhAnhs as $hinhAnh){
			$text .= '<photo image="images/' . $hinhAnh->ten_file . '" colorboxImage="images/' . $hinhAnh->ten_file . '" colorboxInfo="" colorboxClass="image" url="" target="_blank"><![CDATA[<head></head><body></body>]]></photo>';
		}
		$text .= '</photos>';
		$path = BASE_PATH . '/flash/image-scroller/images.xml';
		$fp = fopen($path, 'w');
		fwrite($fp, $text);
		fclose($fp);
    }
	
	public function getPhotoUrl($type = null){
		return Zend_Registry::get('Zend_View')->getBaseUrl() . '/flash/image-scroller/images/' . $this->ten_file;
	}
}