<?php
class Default_Model_SinhHoatChuyenDe extends Khcn_Model_Item_Abstract{
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'sinh-hoat-chuyen-de',
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
	
	/**
	* Pre-delete hook. If overridden, should be called at end of function.
	*
	* @return void
	*/
	protected function _delete()
	{
		$hinhAnhs = Khcn_Api::_()->getDbTable('hinh_anh_chuyen_de', 'default')->getHinhAnhByChuyenDe($this->getIdentity());
		foreach($hinhAnhs as $hinh_anh){
			$hinh_anh->delete();
		}
		parent::_delete();
	}
}