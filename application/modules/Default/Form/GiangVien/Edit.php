<?php
class Default_Form_GiangVien_Edit extends Default_Form_GiangVien_Create
{
	public function init()
    {  	
		parent::init();
        $this->setAttrib('class', 'global_form form_giang_vien_create form_giang_vien_edit');
    }
}
