<?php
class Admin_Model_Report_Document
{
    protected $_pdf;
    public function __construct()
    {
        $this->_pdf = new Zend_Pdf();   
        $this->_pdf->properties['Title'] =        
                      'Phòng Khoa học Công nghệ';    
        $this->_pdf->properties['Author'] =      
                     'Hung - Nguyen - K08';       
    }
    
    public function addPage(Admin_Model_Report_Page $page)
    {        
        $this->_pdf->pages[] = $page->render();    
    }
    
    public function getDocument()
    {
        return $this->_pdf;
    }
    
    public function save($filename)
    {
    	parent::save($filename);
    }
}