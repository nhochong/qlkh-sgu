<?php 
class Default_Form_Login extends Khcn_Form
{
    public function init()
    {
		$description = Zend_Registry::get('Zend_Translate')->_("Nếu chưa có tài khoản, vui lòng <a href='%s'>đăng ký</a> trước.");
		$description= sprintf($description, Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'index', 'action' => 'dang-ky'), 'default', true));
	
		$this->setTitle('Đăng nhập');
		$this->setDescription($description);
		$this->setAttrib('id', 'user_form_login');
		$this->loadDefaultDecorators();
		$this->getDecorator('Description')->setOption('escape', false);
		
		// Set default action
		$this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('module' => 'default', 'controller' => 'dang-nhap', 'action' => 'index'), 'default'));
	
        $Username = new Khcn_Form_Element_Text('Username');       
        $Username->setLabel('Tên đăng nhập : ')
        		 ->setOptions(array('size' => '36')) 
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty');
                 
        $Password = new Khcn_Form_Element_Password('Password');
        $Password->setLabel('Mật khẩu : ')
               ->setRequired(true)
               ->setOptions(array('size' => '36'))              
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');            

		$this->addElement('Hidden', 'return_url', array(
		));
		
		
		
		$submit = new Khcn_Form_Element_Submit('submit');
        $submit->setLabel('Đăng nhập');
        $submit->setAttribs(array('class' => 'art-button')); 

		$this->addElements(array($Username,$Password,$submit));		
			
		// Init remember me
		$this->addElement('Checkbox', 'remember', array(
			'label' => 'Remember',
			'tabindex' => 4,
		));
		
		$this->addDisplayGroup(array(
			'submit',
			'remember'
		), 'buttons');
    }
}
?>