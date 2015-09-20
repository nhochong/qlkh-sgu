<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Default_HopThuController extends Khcn_Controller_Action_Standard
{    
    public function indexAction ()
    {     
    	
    }   

    public function gopYAction()
    {
		// Set up require's
		$this->view->viewer = $viewer = Khcn_Api::_()->getViewer();
		if( !$this->_helper->requireUser()->isValid() ) return;
			
		$table = Khcn_Api::_()->getDbTable('gop_y', 'default');
    	$this->view->form = $form = new Default_Form_HopThu_GopY();
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$values = $form->getValues();	
			$gop_y = $table->createRow();	
			$gop_y->nguoi_dung_id = $viewer->getIdentity();
			$gop_y->loai_id = $values['loai_id'];
			$gop_y->ten = $values['ten'];
			$gop_y->mo_ta = $values['mo_ta'];
			$gop_y->ngay_tao = date('Y-m-d H:i:s');
			$gop_y->save();
			
			$db->commit();
			return $this->_forward('thong-bao', 'index', 'default', array(
				'messages' => array(Zend_Registry::get('Zend_Translate') -> _("Thành công. Cảm ơn bạn đã góp ý cho chúng tôi.")),
			));
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
}
