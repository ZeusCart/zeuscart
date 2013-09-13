<?php
/**
 * Parser
 *
 * This class contains functions to work with parser like xml to array,csv to array,tab to array,excel to array
 *
 * @package		Lib_Parser
 * @category	Library
 * @author		AJDF Development Team
 * @link		http://ajdf.ajsquare.com
 * @version 	1.0
 */

// ------------------------------------------------------------------------

define('NUM_BIG_BLOCK_DEPOT_BLOCKS_POS', 0x2c);
define('SMALL_BLOCK_DEPOT_BLOCK_POS', 0x3c);
define('ROOT_START_BLOCK_POS', 0x30);
define('BIG_BLOCK_SIZE', 0x200);
define('SMALL_BLOCK_SIZE', 0x40);
define('EXTENSION_BLOCK_POS', 0x44);
define('NUM_EXTENSION_BLOCK_POS', 0x48);
define('PROPERTY_STORAGE_BLOCK_SIZE', 0x80);
define('BIG_BLOCK_DEPOT_BLOCKS_POS', 0x4c);
define('SMALL_BLOCK_THRESHOLD', 0x1000);
define('SIZE_OF_NAME_POS', 0x40);
define('TYPE_POS', 0x42);
define('START_BLOCK_POS', 0x74);
define('SIZE_POS', 0x78);
define('IDENTIFIER_OLE', pack("CCCCCCCC",0xd0,0xcf,0x11,0xe0,0xa1,0xb1,0x1a,0xe1));
define('Spreadsheet_Excel_Reader_BIFF8', 0x600);
define('Spreadsheet_Excel_Reader_BIFF7', 0x500);
define('Spreadsheet_Excel_Reader_WorkbookGlobals', 0x5);
define('Spreadsheet_Excel_Reader_Worksheet', 0x10);
define('Spreadsheet_Excel_Reader_Type_BOF', 0x809);
define('Spreadsheet_Excel_Reader_Type_EOF', 0x0a);
define('Spreadsheet_Excel_Reader_Type_BOUNDSHEET', 0x85);
define('Spreadsheet_Excel_Reader_Type_DIMENSION', 0x200);
define('Spreadsheet_Excel_Reader_Type_ROW', 0x208);
define('Spreadsheet_Excel_Reader_Type_DBCELL', 0xd7);
define('Spreadsheet_Excel_Reader_Type_FILEPASS', 0x2f);
define('Spreadsheet_Excel_Reader_Type_NOTE', 0x1c);
define('Spreadsheet_Excel_Reader_Type_TXO', 0x1b6);
define('Spreadsheet_Excel_Reader_Type_RK', 0x7e);
define('Spreadsheet_Excel_Reader_Type_RK2', 0x27e);
define('Spreadsheet_Excel_Reader_Type_MULRK', 0xbd);
define('Spreadsheet_Excel_Reader_Type_MULBLANK', 0xbe);
define('Spreadsheet_Excel_Reader_Type_INDEX', 0x20b);
define('Spreadsheet_Excel_Reader_Type_SST', 0xfc);
define('Spreadsheet_Excel_Reader_Type_EXTSST', 0xff);
define('Spreadsheet_Excel_Reader_Type_CONTINUE', 0x3c);
define('Spreadsheet_Excel_Reader_Type_LABEL', 0x204);
define('Spreadsheet_Excel_Reader_Type_LABELSST', 0xfd);
define('Spreadsheet_Excel_Reader_Type_NUMBER', 0x203);
define('Spreadsheet_Excel_Reader_Type_NAME', 0x18);
define('Spreadsheet_Excel_Reader_Type_ARRAY', 0x221);
define('Spreadsheet_Excel_Reader_Type_STRING', 0x207);
define('Spreadsheet_Excel_Reader_Type_FORMULA', 0x406);
define('Spreadsheet_Excel_Reader_Type_FORMULA2', 0x6);
define('Spreadsheet_Excel_Reader_Type_FORMAT', 0x41e);
define('Spreadsheet_Excel_Reader_Type_XF', 0xe0);
define('Spreadsheet_Excel_Reader_Type_BOOLERR', 0x205);
define('Spreadsheet_Excel_Reader_Type_UNKNOWN', 0xffff);
define('Spreadsheet_Excel_Reader_Type_NINETEENFOUR', 0x22);
define('Spreadsheet_Excel_Reader_Type_MERGEDCELLS', 0xE5);
define('Spreadsheet_Excel_Reader_utcOffsetDays' , 25569);
define('Spreadsheet_Excel_Reader_utcOffsetDays1904', 24107);
define('Spreadsheet_Excel_Reader_msInADay', 24 * 60 * 60);

class Lib_Parser
{
	/**
	 * Stores function type's name
	 *
	 * @var string $type
	 */
	private $type;	
	/**
	 * Flag for error
	 *
	 * @var boolean $error
	 */
	private $error;
	/**
	 * Stores error numbers and description
	 *
	 * @var array $debug
	 */	
	public $debug = array();	
	/**
	 * Stores the output
	 *
	 * @var array $result
	 */	
	public $result;	
	/**
	 * Stores input file path
	 *
	 * @var string $filePath
	 */
	private $filePath;
	/**
	 * Stores xml to array attributes type 0 or 1
	 *
	 * @var integer $getAttributes
	 */
	private $getAttributes;
	/**
	 * Stores cell delimiter value
	 *
	 * @var string $cellDelimiter
	 */	
	private $cellDelimiter=',';
	/**
	 * Stores value delimiter value
	 *
	 * @var string $valueEnclosure
	 */
	private $valueEnclosure='"';
	/**
	 * Stores row delimiter value
	 *
	 * @var string $rowDelimiter
	 */
	private $rowDelimiter="\r\n";
	/**
	 * Stores the input data
	 *
	 * @var string $readData
	 */
	private $readData = '';
	/**
	 * Stores the sheets values
	 *
	 * @var array $boundsheets
	 */
	private $boundsheets = array();
	/**
	 * Stores the format records value
	 *
	 * @var array $formatRecords
	 */
    private $formatRecords = array();
	/**
	 * Stores the cell value
	 *
	 * @var array $sst
	 */
    private $sst = array();
	/**
	 * Stores the sheet value
	 *
	 * @var array $sheets
	 */
    private $sheets = array();
	/**
	 * Stores the input data
	 *
	 * @var string $data
	 */
    private $data;
	/**
	 * Stores the postion
	 *
	 * @var integer $pos
	 */
    private $pos;
	/**
	 * Stores the default encoding
	 *
	 * @var integer $defaultEncoding
	 */   
    private $defaultEncoding; 
	/**
	 * Stores the default format
	 *
	 * @var string $defaultFormat
	 */
    private $defaultFormat = "%s";
	/**
	 * Stores the columns format
	 *
	 * @var array $columnsFormat
	 */
    private $columnsFormat = array();
	/**
	 * Stores the row offset value
	 *
	 * @var integer $rowoffset
	 */ 
    private $rowoffset = 1;
	/**
	 * Stores the column offset value
	 *
	 * @var integer $coloffset
	 */ 
    private $coloffset = 1;
    /**
	 * Stores the date format
	 *
	 * @var array $dateFormats
	 */
    private $dateFormats = array (
        0xe => "d/m/Y",
        0xf => "d-M-Y",
        0x10 => "d-M",
        0x11 => "M-Y",
        0x12 => "h:i a",
        0x13 => "h:i:s a",
        0x14 => "H:i",
        0x15 => "H:i:s",
        0x16 => "d/m/Y H:i",
        0x2d => "i:s",
        0x2e => "H:i:s",
        0x2f => "i:s.S");
	/**
	 * Stores the number format
	 *
	 * @var array $numberFormats
	 */
    private $numberFormats = array(
        0x1 => "%1.0f", // "0"
        0x2 => "%1.2f", // "0.00",
        0x3 => "%1.0f", //"#,##0",
        0x4 => "%1.2f", //"#,##0.00",
        0x5 => "%1.0f", /*"$#,##0;($#,##0)",*/
        0x6 => '$%1.0f', /*"$#,##0;($#,##0)",*/
        0x7 => '$%1.2f', //"$#,##0.00;($#,##0.00)",
        0x8 => '$%1.2f', //"$#,##0.00;($#,##0.00)",
        0x9 => '%1.0f%%', // "0%"
        0xa => '%1.2f%%', // "0.00%"
        0xb => '%1.2f', // 0.00E00",
        0x25 => '%1.0f', // "#,##0;(#,##0)",
        0x26 => '%1.0f', //"#,##0;(#,##0)",
        0x27 => '%1.2f', //"#,##0.00;(#,##0.00)",
        0x28 => '%1.2f', //"#,##0.00;(#,##0.00)",
        0x29 => '%1.0f', //"#,##0;(#,##0)",
        0x2a => '$%1.0f', //"$#,##0;($#,##0)",
        0x2b => '%1.2f', //"#,##0.00;(#,##0.00)",
        0x2c => '$%1.2f', //"$#,##0.00;($#,##0.00)",
        0x30 => '%1.0f'); //"##0.0E0";
		
	/**
	 * Constructs a Lib_Parser object with given parameters
	 * also it will invoke xmltoarray process
	 * 
	 * @param string $type
	 * @param array $data
	 * @param integer $getAttributes	 
	 * @return Lib_Parser  
	 */
	 
	public function Lib_Parser($type,$filePath, $getAttributes=1)
	{
		$this->type = $type;
		$this->filePath = $filePath;
		$this->getAttributes = $getAttributes;		
		
		if($this->isValidCall())
		{
			if(strtolower($type)=='xmlparser')
				$this->xmlToArray();
			if(strtolower($type)=='csvparser')
				$this->csvToArray();
			if(strtolower($type)=='tabparser')
				$this->tabToArray();
			if(strtolower($type)=='excelparser')
				$this->excelToArray();
							
		}		
	}
	
	/**
	 * Check whether the function call is valid or not
	 *
	 * @return bool
	 */

	private function isValidCall()
	{
		if(strtolower($this->type)!='xmlparser' && strtolower($this->type)!='csvparser' && strtolower($this->type)!='tabparser' && strtolower($this->type)!='excelparser')
		{
			echo '<b>Component Error!<b> Invalid argument <i>type</i> - xmlparser or csvparser or tabparser or excelparser expected';
			exit();
		}		
		elseif(!file_exists($this->filePath))
		{
			echo '<b>Component Error!<b> Path Not Found  <i>'.$this->filePath.'</i> - file path not found';
			exit();	
		}
		elseif(!is_readable($this->filePath))
		{
			echo '<b>Component Error!<b> Access Denied  <i>'.$this->filePath.'</i> - file not readable';
			exit();	
		}		
		elseif(!is_numeric($this->getAttributes))
		{
			echo '<b>Component Error!<b> Invalid argument data type <i>getAttributes</i> - numeric expected';
			exit();	
		}				
		return true;		
	}
	
	/**
	 * This function convert xml file to array
	 *	
	 * @return array $result
	 */
	
	private function xmlToArray() 
	{	
		if(function_exists('xml_parser_create')) 
		{	
			$contentspath=$this->filePath;
			$contents=file_get_contents($contentspath);		
			
			if($contents) 
			{									
				$parser = xml_parser_create();
				xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
				xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
				xml_parse_into_struct( $parser, $contents, $xml_values );
				xml_parser_free( $parser );
			
				if($xml_values) 
				{						
					//Initializations
					$xmlArray = array();
					$parents = array();			
					$arr = array();
						
					$current = &$xmlArray;		
							
					foreach($xml_values as $data) 
					{
						unset($attributes,$value);//Remove existing values	
								
						// tag(string), type(string), level(int), attributes(array).
						extract($data);
						
						$result = '';
						if($this->getAttributes) 
						{//The second argument of the function decides this.
							$result = array();
							if(isset($value)) 
								$result['value'] = $value;
						
							if(isset($attributes)) 
							{
								foreach($attributes as $attr => $val) 
								{
									if($this->getAttributes == 1) 
										$result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'	
															
								}
							}
						} 
						elseif(isset($value)) 
						{
							$result = $value;
						}		
								
						if($type == "open") 
						{
							$parent[$level-1] = &$current;
							if(!is_array($current) or (!in_array($tag, array_keys($current)))) 
							{ //Insert New tag
								$current[$tag] = $result;								
								$current = &$current[$tag];
							} 
							else 
							{ //There was another element with the same tag name
								if(isset($current[$tag][0])) 
								{
									array_push($current[$tag], $result);
								} 
								else 
								{
									$current[$tag] = array($current[$tag],$result);
								}
								$last = count($current[$tag]) - 1;
								$current = &$current[$tag][$last];
								
							}			
						} 
						elseif($type == "complete") 
						{ 				
							if(!isset($current[$tag])) 
							{
								$current[$tag] = $result;
								
							} 
							else 
							{ 
								if((is_array($current[$tag]) and $this->getAttributes == 0)
										or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $this->getAttributes == 1)) 
								{
									array_push($current[$tag],$result); //push the new element into that array.
								} 
								else 
								{ 
									$current[$tag] = array($current[$tag],$result); //If it is not an array Make it an array
								}
							}			
						} 
						elseif($type == 'close') 
						{ 
							$current = &$parent[$level-1];							
						}
					}
					
					$this->result=$xmlArray;
					return true;
				}
				else
				{
					$this->error = 1;
					$this->debug['errinfo'] = array(1003=>"xml values not found");
					return false;
				}
			}
			else
			{
				$this->error = 1;
				$this->debug['errinfo'] = array(1002=>"file contents not found");
				return false;
			}
		}
		else
		{
			$this->error = 1;
			$this->debug['errinfo'] = array(1001=>"xml_parser_create() function not found");
			return false;
		}				
	} 
	
	/**
	 * This function convert csv file to array
	 *	
	 * @return array $result
	 */
	 
	private function csvToArray()
	{		
		$contentspath=$this->filePath;
		$contents=file_get_contents($contentspath);			
		if($contents) 
		{	
			$output = array();
			if(!strlen($contents))
				return true;
			if(!(($rowLen = strlen($row = $this->rowDelimiter)) && ($cellLen = strlen($cell = $this->cellDelimiter)) && ($valueLen = strlen($value = $this->valueEnclosure))))
				return false;
			for($output = array(array('')), $output = &$output, $ele = $rows = $columns = 0, $i = -1, $l = strlen($contents); ++$i < $l;)
			{
				if(!$ele && substr($contents, $i, $rowLen) == $row)
				{
					$output[++$rows][$columns = 0] = '';
					$i += $rowLen - 1;
				}
				elseif(substr($contents, $i, $valueLen) == $value)
				{
					$ele ? (substr($contents, $i + $valueLen, $valueLen) == $value ?
					$output[$rows][$columns] .= substr($contents, $i += $valueLen, $valueLen) : $ele = 0)
					: (strlen($output[$rows][$columns]) == 0 ? $ele = 1 : $output[$rows][$columns] .= substr($contents, $i, $valueLen));
					$i += $valueLen - 1;
				}
				elseif(!$ele && substr($contents, $i, $cellLen) == $cell)
				{
					$output[$rows][++$columns] = '';
					$i += $cellLen - 1;
				}
				else
					$output[$rows][$columns] .= $contents[$i];
			}
			$this->result=$output;
			return true;
		}
		else
		{
			$this->error = 1;
			$this->debug['errinfo'] = array(1004=>'file content not found');
			return false;
		}			
	}  
	
	/**
	 * This function convert tab file to array
	 *	
	 * @return array $result
	 */
	 
	private function tabToArray()
	{		
		$filepath=$this->filePath;				
		$array = array();		
		$content = file($filepath);
		if($content) 
		{	 
			for ($x=0; $x < count($content); $x++)
			{
				if (trim($content[$x]) != '')
				{
					$line = explode("\t", trim($content[$x]));
					$array[] = $line;            
				}
			}	
			$this->result=$array;
			return true;
		}
		else
		{
			$this->error = 1;
			$this->debug['errinfo'] = array(1005=>'file content not found');
			return false;
		}					
	}
	
	/**
	 * This function convert excel file to array
	 *	
	 * @return array $result
	 */
	 
	private function excelToArray()
	{	
		if (function_exists('file_get_contents'))
		{
			$this->spreadsheetExcelReader();
			$this->setOutputEncoding('CP1251');
		
			$value = $this->read($this->filePath);
					
			
			if($value == 'Uploaded file is not readable'){
					return $value;
					
			}else{
				for ($i = 1; $i <= $this->sheets[0]['numRows']; $i++) 
				{
					for ($j = 1; $j <= $this->sheets[0]['numCols']; $j++) 
					{
						$product[$i-1][$j-1]=$this->sheets[0]['cells'][$i][$j];			
					}
				}
				$this->result=$product;
				return true;
			}
		}
		else
		{
			$this->error = 1;
			$this->debug['errinfo'] = array(1006=>"file_get_contents function not found");
			return false;
		}	
	}
	
	/**
	 * This function return ascii value of character
	 *	
	 * @return integer 
	 */
	 
	private function getInt4d($readData, $pos) 
	{
        return ord($readData[$pos]) | (ord($readData[$pos+1]) << 8) | (ord($readData[$pos+2]) << 16) | (ord($readData[$pos+3]) << 24); 
	}
	
	/**
	 * This function check the input file
	 *	
	 * @return bool 
	 */
	 
	private function readChk($sFileName)
	{
    	if(!is_readable($sFileName)) 
		{
    		$this->error = 1;
    		return false;
    	}
    	
    	$this->data = @file_get_contents($sFileName);
		
	
    	if (!$this->data) 
		{ 
    		$this->error = 1; 
    		return false; 
   		}   		
   		if (substr($this->data, 0, 8) != IDENTIFIER_OLE) 
		{
    		$this->error = 1; 
    		return false; 
   		}
        $this->numBigBlockDepotBlocks = $this->getInt4d($this->data, NUM_BIG_BLOCK_DEPOT_BLOCKS_POS);
        $this->sbdStartBlock = $this->getInt4d($this->data, SMALL_BLOCK_DEPOT_BLOCK_POS);
        $this->rootStartBlock = $this->getInt4d($this->data, ROOT_START_BLOCK_POS);
        $this->extensionBlock = $this->getInt4d($this->data, EXTENSION_BLOCK_POS);
        $this->numExtensionBlocks = $this->getInt4d($this->data, NUM_EXTENSION_BLOCK_POS);        
	
        $bigBlockDepotBlocks = array();
        $pos = BIG_BLOCK_DEPOT_BLOCKS_POS;      
		$bbdBlocks = $this->numBigBlockDepotBlocks;
        
        if ($this->numExtensionBlocks != 0) 
		{
             $bbdBlocks = (BIG_BLOCK_SIZE - BIG_BLOCK_DEPOT_BLOCKS_POS)/4; 
        }
        
        for ($i = 0; $i < $bbdBlocks; $i++) 
		{
              $bigBlockDepotBlocks[$i] = $this->getInt4d($this->data, $pos);
              $pos += 4;
        }        
        
        for ($j = 0; $j < $this->numExtensionBlocks; $j++) 
		{
            $pos = ($this->extensionBlock + 1) * BIG_BLOCK_SIZE;
            $blocksToRead = min($this->numBigBlockDepotBlocks - $bbdBlocks, BIG_BLOCK_SIZE / 4 - 1);

            for ($i = $bbdBlocks; $i < $bbdBlocks + $blocksToRead; $i++) 
			{
                $bigBlockDepotBlocks[$i] = $this->getInt4d($this->data, $pos);
                $pos += 4;
            }   

            $bbdBlocks += $blocksToRead;
            if ($bbdBlocks < $this->numBigBlockDepotBlocks) 
			{
                $this->extensionBlock = getInt4d($this->data, $pos);
            }
        }
        $pos = 0;
        $index = 0;
        $this->bigBlockChain = array();
        
        for ($i = 0; $i < $this->numBigBlockDepotBlocks; $i++) 
		{
            $pos = ($bigBlockDepotBlocks[$i] + 1) * BIG_BLOCK_SIZE;           
            for ($j = 0 ; $j < BIG_BLOCK_SIZE / 4; $j++) 
			{
                $this->bigBlockChain[$index] = $this->getInt4d($this->data, $pos);
                $pos += 4 ;
                $index++;
            }
        }
        $pos = 0;
	    $index = 0;
	    $sbdBlock = $this->sbdStartBlock;
	    $this->smallBlockChain = array();
	
	    while ($sbdBlock != -2) 
		{
	
	      $pos = ($sbdBlock + 1) * BIG_BLOCK_SIZE;
	
	      for ($j = 0; $j < BIG_BLOCK_SIZE / 4; $j++) 
		  {
	        $this->smallBlockChain[$index] = $this->getInt4d($this->data, $pos);
	        $pos += 4;
	        $index++;
	      }
	
	      $sbdBlock = $this->bigBlockChain[$sbdBlock];
	    }
        $block = $this->rootStartBlock;
        $pos = 0;
        $this->entry = $this->readData($block);        
        $this->readPropertySets();
    }
	
    /**
	 * This function read the input file
	 *	
	 * @return string 
	 */
	 
     private function readData($bl) 
	 {
        $block = $bl;
        $pos = 0;
        $readData = '';
        
        while ($block != -2)  
		{
            $pos = ($block + 1) * BIG_BLOCK_SIZE;
            $readData = $readData.substr($this->data, $pos, BIG_BLOCK_SIZE);
           
	    $block = $this->bigBlockChain[$block];
        }		
		return $readData;
     }
      
	 /**
	 * This function determine the storage block size
	 *		
	 */ 
	  
    private function readPropertySets()
	{
        $offset = 0;
       
        while ($offset < strlen($this->entry)) 
		{
              $d = substr($this->entry, $offset, PROPERTY_STORAGE_BLOCK_SIZE);
            
              $nameSize = ord($d[SIZE_OF_NAME_POS]) | (ord($d[SIZE_OF_NAME_POS+1]) << 8);
              
              $type = ord($d[TYPE_POS]);
              
              $startBlock = $this->getInt4d($d, START_BLOCK_POS);
              $size = $this->getInt4d($d, SIZE_POS);
        
            $name = '';
            for ($i = 0; $i < $nameSize ; $i++) 
			{
              $name .= $d[$i];
            }
            
            $name = str_replace("\x00", "", $name);            
            $this->props[] = array (
                'name' => $name, 
                'type' => $type,
                'startBlock' => $startBlock,
                'size' => $size);

            if (($name == "Workbook") || ($name == "Book")) 
			{
                $this->wrkbook = count($this->props) - 1;
            }

            if ($name == "Root Entry") 
			{
                $this->rootentry = count($this->props) - 1;
            }
            $offset += PROPERTY_STORAGE_BLOCK_SIZE;			
        }        
    }
    
    /**
	 * This function return the stream data
	 *		
	 * @return string 
	 */
	 
    private function getWorkBook()
	{
    	if ($this->props[$this->wrkbook]['size'] < SMALL_BLOCK_THRESHOLD)
		{
			$rootdata = $this->readData($this->props[$this->rootentry]['startBlock']);	        
			$streamData = '';
	        $block = $this->props[$this->wrkbook]['startBlock'];	       
	        $pos = 0;

		    while ($block != -2) 
			{
      	          $pos = $block * SMALL_BLOCK_SIZE;
		          $streamData .= substr($rootdata, $pos, SMALL_BLOCK_SIZE);

			      $block = $this->smallBlockChain[$block];
		    }				
		    return $streamData;
    	}
		else
		{    	
	        $numBlocks = $this->props[$this->wrkbook]['size'] / BIG_BLOCK_SIZE;
	        if ($this->props[$this->wrkbook]['size'] % BIG_BLOCK_SIZE != 0) 
			{
	            $numBlocks++;
	        }
	        
	        if ($numBlocks == 0) return '';	        
	        $streamData = '';
	        $block = $this->props[$this->wrkbook]['startBlock'];	       
	        $pos = 0;	        
	        while ($block != -2) 
			{
	          $pos = ($block + 1) * BIG_BLOCK_SIZE;
	          $streamData .= substr($this->data, $pos, BIG_BLOCK_SIZE);
	          $block = $this->bigBlockChain[$block];
	        }				      
	        return $streamData;
    	}
    }
	
	/**
	 * This function set utf encode
	 *	 
	 */
	 
	private function spreadsheetExcelReader()
	{        
        	$this->setUTFEncoder('iconv');
    	}

	/**
	 * This function set output encode
	 *		 
	 */
	 
    private function setOutputEncoding($Encoding)
	{
        $this->defaultEncoding = $Encoding;
    }

    /**
    *  set mb if you would like use 'mb_convert_encoding' for encode UTF-16LE to your encoding
    * 
    */
	
    private function setUTFEncoder($encoder = 'iconv')
	{
    	$this->encoderFunction = '';
    	if ($encoder == 'iconv')
		{
        	$this->encoderFunction = function_exists('iconv') ? 'iconv' : '';
        }
		elseif ($encoder == 'mb') 
		{
        	$this->encoderFunction = function_exists('mb_convert_encoding') ? 'mb_convert_encoding' : '';
    	}
    }

	/**
	 * This function set row column offset
	 *		 
	 */
	 
    private function setRowColOffset($iOffset)
	{
        $this->rowoffset = $iOffset;
		$this->coloffset = $iOffset;
    }

	/**
	 * This function set the default format
	 *		 
	 */
	 
    private function setDefaultFormat($sFormat)
	{
        $this->defaultFormat = $sFormat;
    }

	/**
	 * This function set the column format
	 *		 
	 */
	 
    private function setColumnFormat($column, $sFormat)
	{
        $this->columnsFormat[$column] = $sFormat;
    }

	/**
	 * This function check the input file
	 *		 
	 */
	 
    private function read($sFileName) 
	{
       $errlevel = error_reporting();
       $res = $this->readChk($sFileName);        
       
        if($res == false) 
		{        	
        	if($this->error == 1) 
			{        				
        		return 'Uploaded file is not readable';	
        	}        	
        }

        $this->data = $this->getWorkBook();	
        $this->pos = 0;       
        $this->parse();
    	error_reporting($errlevel);
	}

	/**
	 * This function parse the each excel record
	 *		 
	 * @return bool
	 */
	 
    private function parse()
	{
        $pos = 0;

        $code = ord($this->data[$pos]) | ord($this->data[$pos+1])<<8;
        $length = ord($this->data[$pos+2]) | ord($this->data[$pos+3])<<8;

        $version = ord($this->data[$pos + 4]) | ord($this->data[$pos + 5])<<8;
        $substreamType = ord($this->data[$pos + 6]) | ord($this->data[$pos + 7])<<8;
       
        if (($version != Spreadsheet_Excel_Reader_BIFF8) && ($version != Spreadsheet_Excel_Reader_BIFF7)) 
		{
            return false;
        }

        if ($substreamType != Spreadsheet_Excel_Reader_WorkbookGlobals)
		{
            return false;
        }
        $pos += $length + 4;

        $code = ord($this->data[$pos]) | ord($this->data[$pos+1])<<8;
        $length = ord($this->data[$pos+2]) | ord($this->data[$pos+3])<<8;

        while ($code != Spreadsheet_Excel_Reader_Type_EOF)
		{
            switch ($code) 
			{
                case Spreadsheet_Excel_Reader_Type_SST:                    
                     $spos = $pos + 4;
                     $limitpos = $spos + $length;
                     $uniqueStrings = $this->getNewInt4d($this->data, $spos+4);
                                                $spos += 8;
                                       for ($i = 0; $i < $uniqueStrings; $i++) 
									   {
                                           if ($spos == $limitpos) 
											{
                                                $opcode = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                                                $conlength = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                                                        if ($opcode != 0x3c) 
														{
                                                                return -1;
                                                        }
                                                $spos += 4;
                                                $limitpos = $spos + $conlength;
                                                }
                                                $numChars = ord($this->data[$spos]) | (ord($this->data[$spos+1]) << 8);
                                                $spos += 2;
                                                $optionFlags = ord($this->data[$spos]);
                                                $spos++;
                                        $asciiEncoding = (($optionFlags & 0x01) == 0) ;
                                                $extendedString = ( ($optionFlags & 0x04) != 0);
                                                $richString = ( ($optionFlags & 0x08) != 0);

                                                if ($richString) 
												{                                       
                                                        $formattingRuns = ord($this->data[$spos]) | (ord($this->data[$spos+1]) << 8);
                                                        $spos += 2;
                                                }

                                                if ($extendedString) 
												{  
                                                  $extendedRunLength = $this->getNewInt4d($this->data, $spos);
                                                  $spos += 4;
                                                }

                                                $len = ($asciiEncoding)? $numChars : $numChars*2;
                                                if ($spos + $len < $limitpos)
												 {
                                                                $retstr = substr($this->data, $spos, $len);
                                                                $spos += $len;
                                                }
												else
												{                                                       
                                                        $retstr = substr($this->data, $spos, $limitpos - $spos);
                                                        $bytesRead = $limitpos - $spos;
                                                        $charsLeft = $numChars - (($asciiEncoding) ? $bytesRead : ($bytesRead / 2));
                                                        $spos = $limitpos;

                                                         while ($charsLeft > 0)
														 {
                                                                $opcode = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                                                                $conlength = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                                                                        if ($opcode != 0x3c) 
																		{
                                                                                return -1;
                                                                        }
                                                                $spos += 4;
                                                                $limitpos = $spos + $conlength;
                                                                $option = ord($this->data[$spos]);
                                                                $spos += 1;
                                                                  if ($asciiEncoding && ($option == 0)) 
																  {
                                                                                $len = min($charsLeft, $limitpos - $spos); 
                                                                    $retstr .= substr($this->data, $spos, $len);
                                                                    $charsLeft -= $len;
                                                                    $asciiEncoding = true;
                                                                  }
																  elseif (!$asciiEncoding && ($option != 0))
																  {
                                                                                $len = min($charsLeft * 2, $limitpos - $spos); 
                                                                    $retstr .= substr($this->data, $spos, $len);
                                                                    $charsLeft -= $len/2;
                                                                    $asciiEncoding = false;
                                                                  }
																  elseif (!$asciiEncoding && ($option == 0)) 
																  {
                                                                                $len = min($charsLeft, $limitpos - $spos); 
                                                                        for ($j = 0; $j < $len; $j++) 
																		{
                                                                 $retstr .= $this->data[$spos + $j].chr(0);
                                                                }
                                                            $charsLeft -= $len;
                                                                $asciiEncoding = false;
                                                                  }
																  else
																  {
                                                            $newstr = '';
                                                                    for ($j = 0; $j < strlen($retstr); $j++) 
																	{
                                                                      $newstr = $retstr[$j].chr(0);
                                                                    }
                                                                    $retstr = $newstr;
                                                                                $len = min($charsLeft * 2, $limitpos - $spos); 
                                                                    $retstr .= substr($this->data, $spos, $len);
                                                                    $charsLeft -= $len/2;
                                                                    $asciiEncoding = false;                                                                     
                                                                  }
                                                          $spos += $len;

                                                         }
                                                }
                                                $retstr = ($asciiEncoding) ? $retstr : $this->encodeUTF16($retstr);
//                                            
                                        if ($richString){
                                                  $spos += 4 * $formattingRuns;
                                                }
                                                if ($extendedString) 
												{
                                                  $spos += $extendedRunLength;
                                                }                                                        
                                                $this->sst[]=$retstr;
                                       }
                    
                    break;

                case Spreadsheet_Excel_Reader_Type_FILEPASS:
                    return false;
                    break;
                case Spreadsheet_Excel_Reader_Type_NAME:                    
                    break;
                case Spreadsheet_Excel_Reader_Type_FORMAT:
                        $indexCode = ord($this->data[$pos+4]) | ord($this->data[$pos+5]) << 8;

                        if ($version == Spreadsheet_Excel_Reader_BIFF8) 
						{
                            $numchars = ord($this->data[$pos+6]) | ord($this->data[$pos+7]) << 8;
                            if (ord($this->data[$pos+8]) == 0)
							{
                                $formatString = substr($this->data, $pos+9, $numchars);
                            } 
							else 
							{
                                $formatString = substr($this->data, $pos+9, $numchars*2);
                            }
                        } 
						else 
						{
                            $numchars = ord($this->data[$pos+6]);
                            $formatString = substr($this->data, $pos+7, $numchars*2);
                        }

                    $this->formatRecords[$indexCode] = $formatString;                  
                    break;
                case Spreadsheet_Excel_Reader_Type_XF:                       
                        $indexCode = ord($this->data[$pos+6]) | ord($this->data[$pos+7]) << 8;                        
                        if (array_key_exists($indexCode, $this->dateFormats)) 
						{                            
                            $this->formatRecords['xfrecords'][] = array(
                                    'type' => 'date',
                                    'format' => $this->dateFormats[$indexCode]
                                    );
                        }
						elseif (array_key_exists($indexCode, $this->numberFormats)) 
						{                       
                            $this->formatRecords['xfrecords'][] = array(
                                    'type' => 'number',
                                    'format' => $this->numberFormats[$indexCode]
                                    );
                        }
						else
						{
                            $isdate = FALSE;
                            if ($indexCode > 0)
							{
                            	if (isset($this->formatRecords[$indexCode]))
                                	$formatstr = $this->formatRecords[$indexCode];                                
                                if ($formatstr)
                                if (preg_match("/[^hmsday\/\-:\s]/i", $formatstr) == 0) 
								{ 
                                    $isdate = TRUE;
                                    $formatstr = str_replace('mm', 'i', $formatstr);
                                    $formatstr = str_replace('h', 'H', $formatstr);                                   
                                }
                            }

                            if ($isdate)
							{
                                $this->formatRecords['xfrecords'][] = array(
                                        'type' => 'date',
                                        'format' => $formatstr,
                                        );
                            }
							else
							{
                                $this->formatRecords['xfrecords'][] = array(
                                        'type' => 'other',
                                        'format' => '',
                                        'code' => $indexCode
                                        );
                            }
                        }                        
                    break;
                case Spreadsheet_Excel_Reader_Type_NINETEENFOUR:                   
                    $this->nineteenFour = (ord($this->data[$pos+4]) == 1);
                    break;
                case Spreadsheet_Excel_Reader_Type_BOUNDSHEET:                   
                        $rec_offset = $this->getNewInt4d($this->data, $pos+4);
                        $rec_typeFlag = ord($this->data[$pos+8]);
                        $rec_visibilityFlag = ord($this->data[$pos+9]);
                        $rec_length = ord($this->data[$pos+10]);

                        if ($version == Spreadsheet_Excel_Reader_BIFF8)
						{
                            $chartype =  ord($this->data[$pos+11]);
                            if ($chartype == 0)
							{
                                $rec_name    = substr($this->data, $pos+12, $rec_length);
                            } 
							else 
							{
                                $rec_name    = $this->encodeUTF16(substr($this->data, $pos+12, $rec_length*2));
                            }
                        }elseif ($version == Spreadsheet_Excel_Reader_BIFF7)
						{
                                $rec_name    = substr($this->data, $pos+11, $rec_length);
                        }
                    $this->boundsheets[] = array('name'=>$rec_name,
                                                 'offset'=>$rec_offset);

                    break;

            }           
            $pos += $length + 4;
            $code = ord($this->data[$pos]) | ord($this->data[$pos+1])<<8;
            $length = ord($this->data[$pos+2]) | ord($this->data[$pos+3])<<8;
        }

        foreach ($this->boundsheets as $key=>$val)
		{
            $this->sn = $key;
            $this->parseSheet($val['offset']);
        }
        return true;
    }

	/**
	 * This function parse the each sheet
	 *		 
	 */
	 
    private function parseSheet($spos)
	{
        $cont = true;       
        $code = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
        $length = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;

        $version = ord($this->data[$spos + 4]) | ord($this->data[$spos + 5])<<8;
        $substreamType = ord($this->data[$spos + 6]) | ord($this->data[$spos + 7])<<8;

        if (($version != Spreadsheet_Excel_Reader_BIFF8) && ($version != Spreadsheet_Excel_Reader_BIFF7)) 
		{
            return -1;
        }

        if ($substreamType != Spreadsheet_Excel_Reader_Worksheet)
		{
            return -2;
        }
       
        $spos += $length + 4;       
        while($cont) 
		{           
            $lowcode = ord($this->data[$spos]);
            if ($lowcode == Spreadsheet_Excel_Reader_Type_EOF) break;
            $code = $lowcode | ord($this->data[$spos+1])<<8;
            $length = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
            $spos += 4;
            $this->sheets[$this->sn]['maxrow'] = $this->rowoffset - 1;
            $this->sheets[$this->sn]['maxcol'] = $this->coloffset - 1;           
            unset($this->rectype);
            $this->multiplier = 1; 
            switch ($code) {
                case Spreadsheet_Excel_Reader_Type_DIMENSION:                   
                    if (!isset($this->numRows)) 
					{
                        if (($length == 10) ||  ($version == Spreadsheet_Excel_Reader_BIFF7))
						{
                            $this->sheets[$this->sn]['numRows'] = ord($this->data[$spos+2]) | ord($this->data[$spos+3]) << 8;
                            $this->sheets[$this->sn]['numCols'] = ord($this->data[$spos+6]) | ord($this->data[$spos+7]) << 8;
                        } 
						else 
						{
                            $this->sheets[$this->sn]['numRows'] = ord($this->data[$spos+4]) | ord($this->data[$spos+5]) << 8;
                            $this->sheets[$this->sn]['numCols'] = ord($this->data[$spos+10]) | ord($this->data[$spos+11]) << 8;
                        }
                    }                    
                    break;
                case Spreadsheet_Excel_Reader_Type_MERGEDCELLS:
                    $cellRanges = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    for ($i = 0; $i < $cellRanges; $i++) 
					{
                        $fr =  ord($this->data[$spos + 8*$i + 2]) | ord($this->data[$spos + 8*$i + 3])<<8;
                        $lr =  ord($this->data[$spos + 8*$i + 4]) | ord($this->data[$spos + 8*$i + 5])<<8;
                        $fc =  ord($this->data[$spos + 8*$i + 6]) | ord($this->data[$spos + 8*$i + 7])<<8;
                        $lc =  ord($this->data[$spos + 8*$i + 8]) | ord($this->data[$spos + 8*$i + 9])<<8;                        
                        if ($lr - $fr > 0) 
						{
                            $this->sheets[$this->sn]['cellsInfo'][$fr+1][$fc+1]['rowspan'] = $lr - $fr + 1;
                        }
                        if ($lc - $fc > 0) 
						{
                            $this->sheets[$this->sn]['cellsInfo'][$fr+1][$fc+1]['colspan'] = $lc - $fc + 1;
                        }
                    }                   
                    break;
                case Spreadsheet_Excel_Reader_Type_RK:
                case Spreadsheet_Excel_Reader_Type_RK2:                   
                    $row = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $column = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                    $rknum = $this->getNewInt4d($this->data, $spos + 6);
                    $numValue = $this->getIEEE754($rknum);                   
                    if ($this->isDate($spos)) 
					{
                        list($string, $raw) = $this->createDate($numValue);
                    }
					else
					{
                        $raw = $numValue;
                        if (isset($this->columnsFormat[$column + 1]))
						{
                                $this->curformat = $this->columnsFormat[$column + 1];
                        }
                        $string = sprintf($this->curformat, $numValue * $this->multiplier);                       
                    }
                    $this->addCell($row, $column, $string, $raw);                   
                    break;
                case Spreadsheet_Excel_Reader_Type_LABELSST:
                        $row        = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                        $column     = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                        $xfindex    = ord($this->data[$spos+4]) | ord($this->data[$spos+5])<<8;
                        $index  = $this->getNewInt4d($this->data, $spos + 6);
			           $this->addCell($row, $column, $this->sst[$index]);                        
                    break;
                case Spreadsheet_Excel_Reader_Type_MULRK:
                    $row        = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $colFirst   = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                    $colLast    = ord($this->data[$spos + $length - 2]) | ord($this->data[$spos + $length - 1])<<8;
                    $columns    = $colLast - $colFirst + 1;
                    $tmppos = $spos+4;
                    for ($i = 0; $i < $columns; $i++) 
					{
                        $numValue = $this->getIEEE754($this->getNewInt4d($this->data, $tmppos + 2));
                        if ($this->isDate($tmppos-4)) 
						{
                            list($string, $raw) = $this->createDate($numValue);
                        }
						else
						{
                            $raw = $numValue;
                            if (isset($this->columnsFormat[$colFirst + $i + 1]))
							{
                                        $this->curformat = $this->columnsFormat[$colFirst + $i + 1];
                                }
                            $string = sprintf($this->curformat, $numValue * $this->multiplier);
                        }                      
                      $tmppos += 6;
                      $this->addCell($row, $colFirst + $i, $string, $raw);
                      
                    }
                     
                    break;
                case Spreadsheet_Excel_Reader_Type_NUMBER:
                    $row    = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $column = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                    $tmp = unpack("ddouble", substr($this->data, $spos + 6, 8)); 
                    if ($this->isDate($spos)) 
					{
                        list($string, $raw) = $this->createDate($tmp['double']);                     
                    }
					else
					{
                     
                        if (isset($this->columnsFormat[$column + 1]))
						{
                                $this->curformat = $this->columnsFormat[$column + 1];
                        }
                        $raw = $this->createNumber($spos);
                        $string = sprintf($this->curformat, $raw * $this->multiplier);                    
                    }
                    $this->addCell($row, $column, $string, $raw);                   
                    break;
                case Spreadsheet_Excel_Reader_Type_FORMULA:
                case Spreadsheet_Excel_Reader_Type_FORMULA2:
                    $row    = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $column = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
					if ((ord($this->data[$spos+6])==0) && (ord($this->data[$spos+12])==255) && (ord($this->data[$spos+13])==255)) {
						
					} 
					elseif ((ord($this->data[$spos+6])==1) && (ord($this->data[$spos+12])==255) && (ord($this->data[$spos+13])==255)) {
						
					} 
					elseif ((ord($this->data[$spos+6])==2) && (ord($this->data[$spos+12])==255) && (ord($this->data[$spos+13])==255)) {
						
					} 
					elseif ((ord($this->data[$spos+6])==3) && (ord($this->data[$spos+12])==255) && (ord($this->data[$spos+13])==255)) {
						
					} 
					else 
					{						
	                    $tmp = unpack("ddouble", substr($this->data, $spos + 6, 8)); // It machine machine dependent
	                    if ($this->isDate($spos)) 
						{
	                        list($string, $raw) = $this->createDate($tmp['double']);	                     
	                    }
						else
						{	                        
	                        if (isset($this->columnsFormat[$column + 1])){
	                                $this->curformat = $this->columnsFormat[$column + 1];
	                        }
	                        $raw = $this->createNumber($spos);
							$string = sprintf($this->curformat, $raw * $this->multiplier);	
	                     
	                    }
	                    $this->addCell($row, $column, $string, $raw);	                    
					}
					break;                    
                case Spreadsheet_Excel_Reader_Type_BOOLERR:
                    $row    = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $column = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                    $string = ord($this->data[$spos+6]);
                    $this->addCell($row, $column, $string);                    
                    break;
                case Spreadsheet_Excel_Reader_Type_ROW:
                case Spreadsheet_Excel_Reader_Type_DBCELL:
                case Spreadsheet_Excel_Reader_Type_MULBLANK:
                    break;
                case Spreadsheet_Excel_Reader_Type_LABEL:
                    $row    = ord($this->data[$spos]) | ord($this->data[$spos+1])<<8;
                    $column = ord($this->data[$spos+2]) | ord($this->data[$spos+3])<<8;
                    $this->addCell($row, $column, substr($this->data, $spos + 8, ord($this->data[$spos + 6]) | ord($this->data[$spos + 7])<<8));
                  
                    break;

                case Spreadsheet_Excel_Reader_Type_EOF:
                    $cont = false;
                    break;
                default:                   
                    break;

            }
            $spos += $length;
        }

        if (!isset($this->sheets[$this->sn]['numRows']))
        	 $this->sheets[$this->sn]['numRows'] = $this->sheets[$this->sn]['maxrow'];
        if (!isset($this->sheets[$this->sn]['numCols']))
        	 $this->sheets[$this->sn]['numCols'] = $this->sheets[$this->sn]['maxcol'];

    }

	/**
	 * This function check the date format
	 *	
	 * @return bool	 
	 */
	 
    private function isDate($spos)
	{       
        $xfindex = ord($this->data[$spos+4]) | ord($this->data[$spos+5]) << 8;        
        if ($this->formatRecords['xfrecords'][$xfindex]['type'] == 'date') 
		{
            $this->curformat = $this->formatRecords['xfrecords'][$xfindex]['format'];
            $this->rectype = 'date';
            return true;
        } 
		else 
		{
            if ($this->formatRecords['xfrecords'][$xfindex]['type'] == 'number') 
			{
                $this->curformat = $this->formatRecords['xfrecords'][$xfindex]['format'];
                $this->rectype = 'number';
                if (($xfindex == 0x9) || ($xfindex == 0xa))
				{
                    $this->multiplier = 100;
                }
            }
			else
			{
                $this->curformat = $this->defaultFormat;
                $this->rectype = 'unknown';
            }
            return false;
        }
    }

	/**
	 * This function create the date
	 *	
	 * @return array	 
	 */
	 
    private function createDate($numValue)
	{
        if ($numValue > 1)
		{
            $utcDays = $numValue - ($this->nineteenFour ? Spreadsheet_Excel_Reader_utcOffsetDays1904 : Spreadsheet_Excel_Reader_utcOffsetDays);
            $utcValue = round($utcDays * Spreadsheet_Excel_Reader_msInADay);
            $string = date ($this->curformat, $utcValue);
            $raw = $utcValue;
        }
		else
		{
            $raw = $numValue;
            $hours = floor($numValue * 24);
            $mins = floor($numValue * 24 * 60) - $hours * 60;
            $secs = floor($numValue * Spreadsheet_Excel_Reader_msInADay) - $hours * 60 * 60 - $mins * 60;
            $string = date ($this->curformat, mktime($hours, $mins, $secs));
        }		
        return array($string, $raw);
    }

	/**
	 * This function create the number
	 *	
	 * @return integer	 
	 */
	 
    private function createNumber($spos)
	{
		$rknumhigh = $this->getNewInt4d($this->data, $spos + 10);
		$rknumlow = $this->getNewInt4d($this->data, $spos + 6);		
		$sign = ($rknumhigh & 0x80000000) >> 31;
		$exp =  ($rknumhigh & 0x7ff00000) >> 20;
		$mantissa = (0x100000 | ($rknumhigh & 0x000fffff));
		$mantissalow1 = ($rknumlow & 0x80000000) >> 31;
		$mantissalow2 = ($rknumlow & 0x7fffffff);
		$value = $mantissa / pow( 2 , (20- ($exp - 1023)));
		if ($mantissalow1 != 0) $value += 1 / pow (2 , (21 - ($exp - 1023)));
		$value += $mantissalow2 / pow (2 , (52 - ($exp - 1023)));		
		if ($sign) 
		{
			$value = -1 * $value;
		}		
		return  $value;
    }

	/**
	 * This function add the cells
	 *		 
	 */
	 
    private function addCell($row, $col, $string, $raw = '')
	{        
        $this->sheets[$this->sn]['maxrow'] = max($this->sheets[$this->sn]['maxrow'], $row + $this->rowoffset);
        $this->sheets[$this->sn]['maxcol'] = max($this->sheets[$this->sn]['maxcol'], $col + $this->coloffset);
        $this->sheets[$this->sn]['cells'][$row + $this->rowoffset][$col + $this->coloffset] = $string;
        if ($raw)
            $this->sheets[$this->sn]['cellsInfo'][$row + $this->rowoffset][$col + $this->coloffset]['raw'] = $raw;
        if (isset($this->rectype))
            $this->sheets[$this->sn]['cellsInfo'][$row + $this->rowoffset][$col + $this->coloffset]['type'] = $this->rectype;

    }

	/**
	 * This function get the number from the id column
	 *	
	 * @return integer	 
	 */
	 
    private function getIEEE754($rknum)
	{
        if (($rknum & 0x02) != 0) 
		{
                $value = $rknum >> 2;
        } 
		else 
		{
			$sign = ($rknum & 0x80000000) >> 31;
			$exp = ($rknum & 0x7ff00000) >> 20;
			$mantissa = (0x100000 | ($rknum & 0x000ffffc));
			$value = $mantissa / pow( 2 , (20- ($exp - 1023)));
			if ($sign) 
			{
				$value = -1 * $value;
			}
        }

        if (($rknum & 0x01) != 0) 
		{

            $value /= 100;
        }		
        return $value;
    }

	/**
	 * This function return the encode
	 *	
	 * @return integer	 
	 */
	 
    private function encodeUTF16($string)
	{
    	$result = $string;
        if ($this->defaultEncoding)
		{
        	switch ($this->encoderFunction)
			{
        		case 'iconv' : 	$result = iconv('UTF-16LE', $this->defaultEncoding, $string);
        						break;
        		case 'mb_convert_encoding' : 	$result = mb_convert_encoding($string, $this->defaultEncoding, 'UTF-16LE' );
        						break;
        	}
        }		
        return $result;
    }

	/**
	 * This function return ascii value of character
	 *	
	 * @return integer 
	 */
	 
    private function getNewInt4d($data, $pos) 
	{
        return ord($data[$pos]) | (ord($data[$pos+1]) << 8) | (ord($data[$pos+2]) << 16) | (ord($data[$pos+3]) << 24);
    }
	
}
?>