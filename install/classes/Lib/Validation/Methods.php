<?php
class Lib_Validation_Methods 
{
	var $fileerror;
	var $totalvalidation=0;
   /**
    * @param string $str
    * @return boolean
    */	
	function IsEmpty($str)
	{
		if(strlen(trim($str)) == 0)
			return true;
		return false;	
			
	}	

   /**
    * @param string $str
    * @param string $exp
    * @return boolean
    */		
	function IsThereSpecial($str,$exp)
	{
		for($i=0;$i<strlen(trim($str));$i++)
		{
			if(!strstr($exp,substr($str,$i,1)))
			{
				$chr = ord(substr($str,$i,1));
				if($chr < 48 || $chr > 57 && $chr < 65 || $chr > 90 && $chr <  96 || $chr > 122)
					return true;
			}		
		}	
	}
	
   /**
    * @param string $str
    * @return boolean
    */			
	function IsNumeric($str)
	{
		for($i=0;$i<strlen(trim($str));$i++)
		{
			$chr = ord(substr($str,$i,1));
			if($chr > 47 && $chr < 58)
				return true;
		
		}		
	}

   /**
    * @param string $str
    * @return boolean
    */			
	function IsNumericStart($str)
	{
		$chr = ord(substr($str,0,1));
		if($chr > 47 && $chr < 58)
			return true;
	
	}
	
   /**
    * @param string $str
    * @param integer $con
    * @return boolean
    */	
	function IsMinimum($str,$con)
	{
		if(strlen(trim($str)) < $con)
			return true;
	}
	
   /**
    * @param string $str
    * @param string $str1
    * @return boolean
    */			
	function IsEqual($str,$str1)
	{
		if(strcmp(strtolower(trim($str)),strtolower(trim($str1))) != 0)
			return true;	
	}
	
   /**
    * @param string $str
    * @return boolean
    */			
	function IsInvalidEmail($email)
	{
		if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
			return true;			
		else		
			return false;
		
	}

   /**
    * @param string $str
    * @return boolean
    */			
	function IsString($str)
	{
		for($i=0;$i<strlen($str);$i++)
		{
			$chr = ord(substr($str,i,1));
			if($chr < 46 || $chr > 57)
				return true;		
		}
	}

   /**
    * @param string $str
    * @param string $with
    * @return boolean
    */			
	function IsInvalidSelect($str,$with)
	{	
		if(trim($str)==$with)
			return true;
	}
   /**
    * @param string $field
    * @param string $ext
    * @param integer $size   
    * @return boolean
    */
   	function IsInvalidFile($field,$ext,$size)
	{
		if($_FILES[$field]["size"]>0)
		{
			$tmp = substr($_FILES[$field]["name"],strpos($_FILES[$field]["name"],".")+1,strlen($_FILES[$field]["name"]));	
			if(strlen($tmp)>0)
			{				
				$size = pow(2,20) * $size;				
				$filesize = $_FILES[$field]["size"];
				if(strstr($ext,$tmp)===false)
				{
					$this->fileerror=0;
					return true;
				}
				elseif($filesize > $size) 
				{
					$this->fileerror=1;
					return true;					
				}
			}
			else 
				return true;			
		}
		else
		{
			$this->fileerror=0;
			return true;	
		}
		
		return false;	
	}	

	/**
	 * Enter description here...
	 *
	 * @param array $dat
	 * @return boolean
	 */
	function IsInvalidDate($dat)
	{
		return checkdate($dat[1],$dat[0],$dat[2]);		
	}
	
}
?>