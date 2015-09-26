<?php
class Default_Model_BaiBao extends Khcn_Model_Item_Abstract{
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'bai-bao',
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
	
	public function getGiangViens(){
		$tacGias = Khcn_Api::_()->getDbTable('bai_bao_tac_gia','default')->getTacGias($this->getIdentity());
		$giangViens = array();
		foreach($tacGias as $tac_gia){
			$giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $tac_gia->giang_vien_id);
			if($giang_vien){
				$giangViens[] = $giang_vien;
			}
		}
		return $giangViens;
	}
	
	public function getTacGia($giang_vien_id){
		$table = Khcn_Api::_()->getDbTable('tac_gia', 'default');
		$select = $table->select()
						->where('bai_bao_id = ?', $this->getIdentity())
						->where('giang_vien_id = ?', $giang_vien_id);
		return $table->fetchRow($select);
	}
	
	/**
	* Pre-delete hook. If overridden, should be called at end of function.
	*
	* @return void
	*/
	protected function _delete()
	{
		$tacGias = Khcn_Api::_()->getDbTable('tac_gia','default')->getTacGias($this->getIdentity());
		foreach($tacGias as $tac_gia){
			$tac_gia->delete();
		}
		parent::_delete();
	}
	
	public function getDonVi(){
		return Khcn_Api::_()->getItem('default_don_vi', $this->don_vi_id);
	}
	
}