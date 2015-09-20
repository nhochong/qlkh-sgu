<?php
/** PHPExcel */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel.php';

/** PHPExcel_Cell_AdvancedValueBinder */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/Cell/AdvancedValueBinder.php';

/** PHPExcel_IOFactory */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/IOFactory.php';

class Admin_Model_PHPExcel extends PHPExcel
{
	protected $_cacheMethod = 'cache_in_memory';
	
	protected $_x;
	
	protected $_y;
	
    protected $_defaultProperties = array(
		'creator' => "Hung Nguyen K08",
		'modified_by' => "Hung Nguyen",
		'title' => "Report",
		'subject' => "Report",
		'description' => "Report",
		'keyword' => "report",
	);
	
	protected $_styleHeaderColumn = array(
		'font' => array(
			'bold' => true,
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		),
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				'rgb' => 'd1fef5',
			),
		),
	);
	
	protected $_styleAlignText = array(
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		),

	);
	
	protected $_styleTitleAlign = array(
		'font' => array(
			'bold' => true,
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);
	
	protected $_styleBoderTable = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => '000000'),
			),
		),
	);
		
	public function __construct($config = array()){
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
		if(isset($config['cacheMethod']))
			$this->_cacheMethod = $config['cacheMethod'];
		$this->_setCache();			
		parent::__construct();
	}
	
	protected function _setCache(){
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::$this->_cacheMethod;
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
	}
	
	public function getStyleHeaderColumn(){
		return $this->_styleHeaderColumn;
	}
	
	public function getStyleTitleAlign(){
		return $this->_styleTitleAlign;
	}
	
	public function getStyleBoderTable(){
		return $this->_styleBoderTable;
	}
	
	public function setHeader($params = array()){
		$this->getActiveSheet()->mergeCells('B2:D2');
		$this->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('B2')->setValue("ỦY BAN NHÂN DÂN");
		
		$this->getActiveSheet()->mergeCells('B3:D3');
		$this->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('B3')->setValue("THÀNH PHỐ HỒ CHÍ MINH");
		
		$this->getActiveSheet()->mergeCells('B4:D4');
		$this->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
		$this->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('B4')->setValue("TRƯỜNG ĐẠI HỌC SÀI GÒN");
		
		
		$this->getActiveSheet()->mergeCells('F2:H2');
		$this->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
		$this->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('F2')->setValue("CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM");
		
		$this->getActiveSheet()->mergeCells('F3:H3');
		$this->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('F3')->setValue("Độc lập - Tự do - Hạnh phúc");

	}
	
	public function setTitle($params, $start_row = 7){
		$this->getActiveSheet()->mergeCells('B'.$start_row.':H'.$start_row);
		$this->getActiveSheet()->getStyle('B'.$start_row)->getFont()->setBold(true);
		$this->getActiveSheet()->getStyle('B'.$start_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getCell('B'.$start_row)->setValue($params['title_1']);
		
		if(isset($params['title_2']) && !empty($params['title_2'])){
			$start_row++;
			$this->getActiveSheet()->mergeCells('B'.$start_row.':H'.$start_row);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getFont()->setBold(true);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->getActiveSheet()->getCell('B'.$start_row)->setValue($params['title_2']);
		}
		if(isset($params['year']) && !empty($params['year'])){
			$start_row++;
			$this->getActiveSheet()->mergeCells('B'.$start_row.':H'.$start_row);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getFont()->setBold(true);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->getActiveSheet()->getCell('B'.$start_row)->setValue($params['year']);
		}
		
		if(isset($params['description']) && !empty($params['description'])){
			$start_row++;
			$this->getActiveSheet()->mergeCells('B'.$start_row.':H'.$start_row);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getFont()->setItalic(true);
			$this->getActiveSheet()->getStyle('B'.$start_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->getActiveSheet()->getCell('B'.$start_row)->setValue($params['description']);
		}
	}

	public function setFileProperties($params = array()){
		$this->_defaultProperties = array_merge ($this->_defaultProperties, $params);	
		$this->getProperties()->setCreator($this->_defaultProperties['creator']);
		$this->getProperties()->setLastModifiedBy($this->_defaultProperties['modified_by']);
		$this->getProperties()->setTitle($this->_defaultProperties['title']);
		$this->getProperties()->setSubject($this->_defaultProperties['subject']);
		$this->getProperties()->setDescription($this->_defaultProperties['description']);
		$this->getProperties()->setKeywords($this->_defaultProperties['keyword']);
	}
	
	public function render($type = 'Excel5'){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="myfile.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($this, $type);
		$objWriter->save('php://output'); 
		exit('Finish');
	}
	
	public function setCellValue($cell, $value, $styleArray = array()){		
		$this->getActiveSheet()->getCell($cell)->setValue($value);
		if(!empty($styleArray))
			$this->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray);
	}
	
	public function setColumnWidth($column, $width){
		$this->getActiveSheet()->getColumnDimension($column)->setWidth($width);
	}
	
	public function setRowHeight($row, $height){
		$this->getActiveSheet()->getRowDimension($row)->setRowHeight($height);
	}
	
	public function getStyleAlignText(){
		return $this->_styleAlignText;
	}
}