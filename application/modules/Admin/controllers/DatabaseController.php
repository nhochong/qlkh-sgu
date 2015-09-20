<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DatabaseController extends Khcn_Controller_Action_Admin
{
	protected $backup = null;
	
	public function init ()
    {
        $this->backup = new Default_Model_Backup();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $backups = $this->backup->getAll();
        $paginator = Zend_Paginator::factory($backups);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
        $this->view->loais = Default_Model_Constraints::backup_loai();
    }
    
    public function backupAction()
    {
    	$form = new Admin_Form_Backup();
        $form->submit->setLabel('Backup');
        $form->cancel->setLabel('Thoát');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
	            $config = Zend_Registry::get('configDB');
	            $dbUsername = $config['username'];
		        $dbPassword = $config['password'];
		        $dbName = $config['dbname'];
		        $dbHost = $config['host'];
		        
		        $save = $form->getValue('save');
		        $loai = $form->getValue('loai');
		        
				if($loai != '2')
					$file_name = date('Y_m_d_H_i_s') . '.sql';
    			else
    				$file_name = date('Y_m_d_H_i_s') . '.xml';
    				
		        $file = APPLICATION_PATH . '/data/backup/' . $file_name;
		        
		        $result = $this->backup($file,$save,$loai);
		        if($result != false){
		        	if($save == '1'){
		        		$this->_helper->layout->disableLayout();
    					$this->_helper->viewRenderer->setNoRender();
    					if($loai != '2'){
			        		header('Content-Type: application/x-sql');
			    			header('Content-Disposition: attachment; filename=khcn.sql');
    					}else{
			        		header('Content-Type: application/xml');
			    			header('Content-Disposition: attachment; filename=khcn.xml');
    					}
			    		header("Cache-Control: no-cache, must-revalidate");   		
			    		echo $result;			    		
		        	}else{
			        	$backup = new Default_Model_Backup();
				        $backup->setTenFile($file_name)
				        	   ->setLoai($loai)
				        	   ->setNgayTao(new Zend_Db_Expr('NOW()'));
				        $kq = $backup->them();
				        if(kq){			    		
							$_SESSION['msg'] = 'Thành công !. Bản backup đã được lưu trữ trên host.';
							$_SESSION['type_msg'] = 'success';
							$this->_redirect('/admin/database/index');
		                }
		        	}		        	
		        }else{
			        $_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/database/backup');
		        }
			}
		}	
    }
    
    protected function backup($file,$save,$loai)
    {
    	try{
	        //echo 'Post thanh cong';
	        $db = Zend_Registry::get('connectDB');
	        $db->setFetchMode(Zend_Db::FETCH_NUM);
	        $kq = 0;
	        //$link = mysql_connect('localhost','root','');
	        //mysql_select_db('qlttbth',$link);
	        $sqlTable = 'SHOW TABLES';
	        $tableALL = $db->fetchAll($sqlTable);
	        $return = '';
	        //neu backup theo Full,Shema
	        if($loai != '2'){
		        foreach ($tableALL as $table){
		            // lay ra tat ca cac bang trong co so du lieu
		            $ketqua = $db->fetchAssoc('SELECT * FROM ' . $table[0]);
		            //Tao cau truc phuc hoi
		            $return .= 'DROP TABLE IF EXISTS ' . $table[0] . ' CASCADE;';
		            $select = $db->select()->from($table[0]);
		            $stmt = $db->query($select);
		            $num_fields = $stmt->columnCount();
		            //lay table
		            $sqlSelectTable = 'SHOW CREATE TABLE ' . $table[0];
		            $resultSelectTable = $db->fetchAll($sqlSelectTable);
		            foreach ($resultSelectTable as $kqSelectTable){
		                $return .= "\n\n" . $kqSelectTable[1] . ";\n\n";
		            }
		            //colunm table
		            $sqlSelectColunmTable = 'SHOW COLUMNS FROM ' . $table[0];
			        $resultSelectColunmTable = $db->fetchAssoc($sqlSelectColunmTable);
				  	$columns = array();
		        	foreach ($resultSelectColunmTable as $kqSelectColunmTable){
		        		$columns[$kqSelectColunmTable['Field']] = $kqSelectColunmTable;
		            }
		            //neu backup full
		            if($loai == '0'){
			            // lap lay du lieu tưng dong cua tưng ban         
			            foreach ($ketqua as $kqInsert){
			                $return .= 'INSERT INTO ' . $table[0] . ' VALUES(';
			            	$fields = array();  
		    				foreach ($kqInsert as $field => $data) {
		                        if (strpos(strtolower($columns[$field]['Type']), 'int') !== false ||
		                         	strpos(strtolower($columns[$field]['Type']), 'float') !== false ||
		                         	strpos(strtolower($columns[$field]['Type']), 'tinyint') !== false) {
		                            if (strlen($data) > 0) {
		                                $fields[] = $data;
		                            } else {
		                                if (strtolower($columns[$field]['Null']) == 'no') {
		                                    $fields[] = 0;
		                                } else {
		                                    $fields[] = "NULL";
		                                }
		                            }
		                        } elseif (strpos(strtolower($columns[$field]['Type']), 'datetime') !== false) {
		                            if (strlen($data) > 0) {
		                                $fields[] = "'" . $data . "'";
		                            } else {
		                                if (strtolower($columns[$field]['Null']) == 'no') {
		                                    $fields[] = "''";
		                                } else {
		                                    $fields[] = "NULL";
		                                }
		                            }
		                        } elseif (strpos(strtolower($columns[$field]['Type']), 'time') !== false) {
		                            if (strlen($data) > 0) {
		                                $fields[] = "'" . $data . "'";
		                            } else {
		                                if (strtolower($columns[$field]['Null']) == 'no') {
		                                    $fields[] = "''";
		                                } else {
		                                    $fields[] = "NULL";
		                                }
		                            }
		                        } elseif (strpos(strtolower($columns[$field]['Type']), 'varchar') !== false ||
		                         strpos(strtolower($columns[$field]['Type']), 'text') !== false ||
		                         strpos(strtolower($columns[$field]['Type']), 'longtext') !== false ||
		                         strpos(strtolower($columns[$field]['Type']), 'mediumtext') !== false) {
		                            $data = addslashes($data);
		                            //$data = trim(preg_replace("/\n/", "/\\n/", $data));                            
		                            if (strlen($data) > 0) {
		                                $fields[] = "'" . $data . "'";
		                            } else {
		                                if (strtolower($columns[$field]['Null']) == 'no') {
		                                    $fields[] = "''";
		                                } else {
		                                    $fields[] = "NULL";
		                                }
		                            }
		                        } else {
		                            // $columns[$field]['Type'] will contain the datatype
		                            if (strlen($data) > 0) {
		                                $fields[] = "'" . $data . "'";
		                            } else {
		                                if (strtolower($columns[$field]['Null']) == 'no') {
		                                    $fields[] = "''";
		                                } else {
		                                    $fields[] = "NULL";
		                                }
		                            }
		                        }
		                    }
		                    $return .= implode(',', $fields);
			                $return .= ");\n";
			            }
		            }
		        }
	            $return .= "\n\n\n";
	            $kq = 1;
	        }else{
	        	$return .= "<root>\n";
	        	foreach ($tableALL as $table){
	        		$return .= "\t<" . $table[0] . ">\n";	        		
	        		$ketqua = $db->fetchAssoc('SELECT * FROM ' . $table[0]);
	        		foreach ($ketqua as $kqInsert){
	        			$return .= "\t\t<item>\n";
	        			foreach ($kqInsert as $field => $data) {
	        				$return .= "\t\t\t<" . $field . ">" . $data . "</" . $field . ">\n";
	        			}
	        			$return .= "\t\t</item>\n";
	        		}
	        		$return .= "\t</" . $table[0] . ">\n";
	        	}
	        	$return .= "</root>";
	        }
	        //save file
	        if($save == '0'){
	        	$handle = fopen($file, 'w+');
		        fwrite($handle, $return);
		        fclose($handle);
        		return true;
	        }else{
	        	return $return;
	        }  		
    	} catch (Zend_Exception $ex){
    		return false;
    	}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/database/index');
		}	
    	$str = '';
		foreach($_POST['item'] as $id){			
			$backup = $this->backup->getBackup($id);
			if($backup != NULL)
			{						
				if($backup['ten_file'] != '' && file_exists( APPLICATION_PATH . '/data/backup/' . $backup['ten_file']))
						unlink(APPLICATION_PATH . '/data/backup/' . $backup['ten_file']);
				$kq = $this->backup->xoa($id);
				if(!$kq){
					$str .= $backup['ten_file'] . ', ';
				}
			}	
		}
		
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các bản backup sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/database/index');
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/database/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$backup = $this->backup->getBackup($id);
    		if($backup != null){	   			
				$oldFile = $backup['ten_file'];
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/data/backup/' . $oldFile))
					unlink(APPLICATION_PATH . '/data/backup/' . $oldFile);		
    			$kq = $this->backup->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/database/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/database/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã backup không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/database/index');
    		}
    	}else{
    		$this->_redirect('/admin/database/index');
    	}
    }
}
