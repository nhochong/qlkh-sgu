<?php
class Khcn_Model_Acl extends Zend_Acl {
    public function __construct() {
    	//khai bao phan quyen
	    $this->addRole(new Zend_Acl_Role('guest'));
	    $this->addRole(new Zend_Acl_Role('member'), 'guest');
		$this->addRole(new Zend_Acl_Role('teacher'), 'member');
	    $this->addRole(new Zend_Acl_Role('mod'), 'teacher');
	    $this->addRole(new Zend_Acl_Role('admin'),'mod');

	    //-----------------------------------------------------
	    $this->add(new Zend_Acl_Resource('default'));
	    $this->add(new Zend_Acl_Resource('default:index'),'default');
	    $this->add(new Zend_Acl_Resource('default:error'),'default');
	    $this->add(new Zend_Acl_Resource('default:de-tai'),'default');
	    $this->add(new Zend_Acl_Resource('default:hoi-thao'),'default');
	    $this->add(new Zend_Acl_Resource('default:lich-bieu'),'default');
	    $this->add(new Zend_Acl_Resource('default:lich-cong-tac'),'default');
	    $this->add(new Zend_Acl_Resource('default:qui-dinh'),'default');
	    $this->add(new Zend_Acl_Resource('default:thong-bao'),'default');
	    $this->add(new Zend_Acl_Resource('default:tin-tuc'),'default');
	    $this->add(new Zend_Acl_Resource('default:tuyen-sinh'),'default');
	    
	    $this->add(new Zend_Acl_Resource('admin'));
	    $this->add(new Zend_Acl_Resource('admin:index'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:error'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:de-tai'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:hoi-thao'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:lich-bieu'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:lich-cong-tac'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:qui-dinh'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:thong-bao'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:tin-tuc'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:tuyen-sinh'),'admin');
		$this->add(new Zend_Acl_Resource('admin:loai-bm'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:bieu-mau'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:cau-hinh'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:database'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:don-vi'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:giang-vien'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:hoc-vi'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:hoi-dong'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:import'),'admin');
		$this->add(new Zend_Acl_Resource('admin:loai-lv'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:linh-vuc'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:loai-dt'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:login'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:nguoi-dung'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:report'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:account-info'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:mod-manager'),'admin');
	    $this->add(new Zend_Acl_Resource('admin:lien-ket'),'admin');
		$this->add(new Zend_Acl_Resource('admin:thong-ke'),'admin');
	    
		//thiet lap cac quyen
	    $this->allow('guest','default');
	    
	    //$this->allow('member');
	    $this->allow('mod','admin');
	    $this->deny('mod', 'admin:cau-hinh');
	    $this->deny('mod', 'admin:mod-manager');
	    $this->deny('mod', 'admin:nguoi-dung');
	    //admin co toan quyen
	    $this->allow('admin');
	    $this->allow('admin', 'admin:cau-hinh');
	    $this->allow('admin', 'admin:mod-manager');
	    $this->allow('admin', 'admin:nguoi-dung');
    }
}