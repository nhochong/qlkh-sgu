<?php
class Default_Model_LichThi extends Khcn_Model_Item_Abstract{
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'lich-thi',
			'action' => 'chi-tiet',
			'reset' => true,
			'id' => $this->getIdentity()
		), $params);
		$route = $params['route'];
		$reset = $params['reset'];
		unset($params['route']);
		unset($params['reset']);
		return Zend_Controller_Front::getInstance()->getRouter()
		  ->assemble($params, $route, $reset);
	}
	
	public function getTenLoai(){
		$loais = Khcn_Api::_()->getDbTable('he_cao_hoc', 'default')->getListAssoc();
		return $loais[$this->he_cao_hoc];
	}
	
	public function isNew(){
		$thong_bao_moi = Khcn_Api::_()->getApi('settings', 'default')->getSetting('thong_bao_moi', 10);
		if(strtotime($this->ngay_tao) > strtotime("-$thong_bao_moi days"))
			return true;
		return false;
	}
	
	public function getPhotoUrl($type = null){
		if(empty($this->file))
			return Zend_Registry::get('Zend_View')->getBaseUrl() . '/images/no_photo_thumb.jpg';
		return parent::getPhotoUrl();
	}
}