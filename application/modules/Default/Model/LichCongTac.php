<?php
class Default_Model_LichCongTac extends Khcn_Model_Item_Abstract{
	
	public function getNDCTs($params = array()){
		$table = Khcn_Api::_()->getDbTable('noi_dung_cong_tac','default');
		$select = $table->select()
						->where('ma_cong_tac = ?', $this->id);
		if(isset($params['quan_trong'])){
			$select->where('quan_trong = ?', $params['quan_trong']);
		}
		if(!empty($params['limit'])){
			$select->limit($params['limit']);
		}
		if(!empty($params['order'])){
			$direction = isset($params['direction']) ? $params['direction'] : 'DESC';
			$select->order($params['order'] . ' ' . $direction);
		}
		return $table->fetchAll($select);
	}
	
	public function getFullNDCTs(){
		$table = Khcn_Api::_()->getDbTable('noi_dung_cong_tac','default');
		$num_of_days = (strtotime($this->ngay_ket_thuc) - strtotime($this->ngay_bat_dau)) / (3600 * 24);
		$data = array();
		for($i = 0 ; $i<=$num_of_days ; $i++){
			$day = date('Y-m-d', strtotime($this->ngay_bat_dau . " +$i day"));
			$data[$day] = array();
			$nds = $table->getNDCTByDate($day);
			foreach($nds as $nd){
				if($nd->buoi == 1){
					$data[$day]['sang'][] = $nd;
				}elseif($nd->buoi == 2){
					$data[$day]['chieu'][] = $nd;
				}
			}
		}
		return $data;
	}
	
    protected function _delete(){
		$ndcts = $this->getNDCTs();
		foreach($ndcts as $ndct){
			$ndct->delete();
		}
		parent::_delete();
	}
}