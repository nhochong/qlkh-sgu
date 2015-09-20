<?php
class Admin_Model_Report_Page
{
    protected $_page;
    protected $_yPosition;
    protected $_leftMargin;
    protected $_pageWidth;
    protected $_pageHeight;
    protected $_normalFont;
    protected $_boldFont;
    protected $_year;
    protected $_headTitle;
    protected $_introText;
    protected $_graphData;
    public function __construct()
    {
        $this->_page = new Zend_Pdf_Page(         
                       Zend_Pdf_Page::SIZE_A4);
        $this->_yPosition = 40;     
        $this->_leftMargin = 20;  
        $this->_pageHeight = $this->_page->getHeight();//842 point
        $this->_pageWidth = $this->_page->getWidth();//595 point   
        $this->_normalFont = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/times.ttf');
        $this->_boldFont = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesbd.ttf');
    }
    
	public function setHeader()
	{
	    $this->_page->saveGS();    
	    $this->_page->setFont($this->_normalFont, 10);   
	    $this->_page->drawText('ỦY BAN NHÂN DÂN',     
	                           $this->_leftMargin + 52,             
	                           $this->_pageHeight - 22,
	                           'UTF-8')
	                ->drawText('THÀNH PHÔ HỒ CHÍ MINH',
	                		   $this->_leftMargin + 40, 
	                		   $this->_pageHeight - 34,
	                		   'UTF-8');  
	                		   
	    $this->_page->setFont($this->_boldFont, 11);   
	    $this->_page->drawText('TRƯỜNG ĐẠI HỌC SÀI GÒN',     
	                           $this->_leftMargin + 30,             
	                           $this->_pageHeight - 46,
	                           'UTF-8');        

	    $this->_page->setLineWidth(0.1);
	    $this->_page->drawLine($this->_leftMargin + 60,   
	                           $this->_pageHeight - 50,
	                           $this->_pageWidth - 437,
	                           $this->_pageHeight - 50);
	                           
	    $this->_page->setFont($this->_boldFont, 11);   
	    $this->_page->drawText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM',     
	                           $this->_leftMargin + 300,             
	                           $this->_pageHeight - 22,
	                           'UTF-8');
	                           
	    $this->_page->setFont($this->_normalFont, 11);   
	    $this->_page->drawText('Độc lập - Tự do - Hạnh phúc',     
	                           $this->_leftMargin + 340,             
	                           $this->_pageHeight - 34,
	                           'UTF-8');
	                           
	    //--------------drawImage(image, left, bottom, right, top)
	    $imagePath = Zend_Pdf_Image::imageWithPath(APPLICATION_PATH . '/templates/admin/images/symbol.png');  
	    $this->_page->drawImage($imagePath,     
	                            $this->_leftMargin + 380,             
	                            $this->_pageHeight - 49,
	                            $this->_leftMargin + 415,
	                            $this->_pageHeight - 39);  
	                                              
	    $this->_page->restoreGS();
	}
	
	/*
	 * wrapText
	 * 
	 * @param string	$text	doan text can wrap
	 * @param int		$x 		toa do x
	 * @param int 		$y		toa do y
	 * @param int		$width	do rong cua doan text
	 * @param int		$height	chieu cao cua 1 dong
	 */
	public function wrapText($text,$x,$y,$width,$height)
	{
	    $wrappedText = wordwrap($text, $width, "\n", false);  
	    $token = strtok($wrappedText, "\n");   
	    $this->_yPosition = $y;    
	    while ($token !== false) {      
	        $this->_page->drawText($token,           
	                               $x,    
	                               $this->_yPosition);    
	        $token = strtok("\n");    
	        $this->_yPosition -= $height;   
	    }
	}
	
	//$color = new Zend_Pdf_Color_Html ('#c3f2e2');
	
	public function setStyle()
	{
	    $style = new Zend_Pdf_Style();    
	    $style->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA), 10);         
	    $style->setFillColor(new Zend_Pdf_Color_Html('#333333'));         
	    $style->setLineColor(new Zend_Pdf_Color_Html('#990033'));         
	    $style->setLineWidth(1);                                  
	    $this->_page->setStyle($style);    
	}
	
	protected function getNotesSection()
	{
	    $this->_yPosition -= 20;                                  
	    $this->_page->drawText('Meeting Notes',            
	                  $this->_leftMargin,                          
	                  $this->_yPosition);                          
	    $this->_yPosition -= 10;                                  
	    $this->_page->drawLine($this->_leftMargin,       
	                           $this->_yPosition,                  
	                           $this->_pageWidth -                 
	                               $this->_leftMargin,                 
	                           $this->_yPosition);                 
	    $noteLineHeight = 30;      
	    $this->_yPosition -= $noteLineHeight;
	    $this->_page->saveGS();    
	    $this->_page->setLineColor(new Zend_Pdf_Color_Html('#999999'));        
	    $this->_page->setLineWidth(0.5);                           
	    $this->_page->setLineDashingPattern(array(2, 2));   
	    while($this->_yPosition > 70) {
	        $this->_page->drawLine($this->_leftMargin,     
	                               $this->_yPosition,                
	                               $this->_pageWidth -               
	                                   $this->_leftMargin,               
	                               $this->_yPosition);               
	        $this->_yPosition -= $noteLineHeight;
	    }
	    $this->_page->restoreGS();    
	}
	
	protected function getGraphSection()
	{
	    $this->_page->saveGS();     
	    $this->_page->setFont($this->_boldFont, 16);        
	    $this->_yPosition -= 20;                                     
	    $this->_page->drawText('Monthly statistics for '   
	                            . $this->_year,                         
	                            $this->_leftMargin,                   
	                            $this->_yPosition);                   
	    $this->_yPosition -= 10;                                     
	    $this->_page->drawLine($this->_leftMargin,          
	                           $this->_yPosition,                     
	                           $this->_pageWidth                      
	                               - $this->_leftMargin,             
	                           $this->_yPosition);                   
	    $this->_yPosition -= 40;                                    
	    $graphY = $this->_yPosition                
	                - max($this->_graphData);      
	    $graphX = $this->_leftMargin;             
	    $columnWidth = 40;     
	    $date = new Zend_Date();
	    foreach ($this->_graphData as $key => $value ) {    
	        $graphFill = $key % 2 == 1 ? '#FA9300' : '#990033';        
	        $this->_page->setFillColor(                   
	                        new Zend_Pdf_Color_Html(        
	                            $graphFill));
	        $this->_page->drawText($value,                     
	                        $graphX + ($columnWidth/3),          
	                        $graphY + $value);                       
	        $this->_page->drawRectangle($graphX, $graphY,     
	                        $graphX + $columnWidth,                     
	                        $graphY + $value,                              
	                        Zend_Pdf_Page::SHAPE_DRAW_FILL           
	                        );                                                    
	        $yPosition = $graphY - 20;      
	        $date->set($key + 1, Zend_Date::MONTH_SHORT);    
	        $this->_page->drawText($date->get(                  
	                        Zend_Date::MONTH_NAME_SHORT),         
	                        $graphX + ($columnWidth/8),             
	                        $yPosition);                                  
	        $graphX += $columnWidth;    
	    }
	    $this->_yPosition = $yPosition - 20;    
	    $this->_page->restoreGS();   
	}
	
	public function render()
	{
	    //$this->setStyle();
	    $this->setHeader();
	    //$this->wrapText($this->_introText);
	    //$this->getGraphSection();
	    //$this->getNotesSection();
	    //$this->setFooter();
	    return $this->_page;
	}
}