<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 9072 2011-07-21 01:09:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/IOFactory.php';

class Admin_Api_Core extends Khcn_Api_Abstract
{
	public function getDataImport($file, $extension = null){
		try{
			if(empty($extension)){
				$info = pathinfo($file->getFileName(null,false));
				$extension = $info['extension']? $info['extension'] : null; 
			}
			
			if(empty($extension)){
				throw('Invalid File.');
			}
			
			$inputFileType = $this->getInputFileType($extension);
			
			if(empty($inputFileType)){
				throw('Invalid File.');
			}
			
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file);
			return $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    	}catch (Zend_Exception $ex){
    		throw $ex;
    	}
	}
	
	public function getInputFileType($extension){
		$extensionType = '';
		switch (strtolower($extension)) {
			case 'xlsx':			//	Excel (OfficeOpenXML) Spreadsheet
			case 'xlsm':			//	Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
			case 'xltx':			//	Excel (OfficeOpenXML) Template
			case 'xltm':			//	Excel (OfficeOpenXML) Macro Template (macros will be discarded)
				$extensionType = 'Excel2007';
				break;
			case 'xls':				//	Excel (BIFF) Spreadsheet
			case 'xlt':				//	Excel (BIFF) Template
				$extensionType = 'Excel5';
				break;
			case 'ods':				//	Open/Libre Offic Calc
			case 'ots':				//	Open/Libre Offic Calc Template
				$extensionType = 'OOCalc';
				break;
			case 'slk':
				$extensionType = 'SYLK';
				break;
			case 'xml':				//	Excel 2003 SpreadSheetML
				$extensionType = 'Excel2003XML';
				break;
			case 'gnumeric':
				$extensionType = 'Gnumeric';
				break;
			case 'htm':
			case 'html':
				$extensionType = 'HTML';
				break;
			case 'csv':
				// Do nothing
				// We must not try to use CSV reader since it loads
				// all files including Excel files etc.
				break;
			default:
				break;
		}
		return $extensionType;
	}
}