<?php
 /**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * This class contains functions related error methods
 *
 * @package  		Lib_Validation_Methods
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_Validation_Methods 
{
	/**
	 * Stores the file error
	 *
	 * @var array 
	 */	
	
	var $fileerror;
	/**
	 * Assign total validation
	 *
	 * @var integer 
	 */	
	var $totalvalidation=0;
   /** 
	* Function to check the string length  is empty or not
	* @param string $str
	* @return bool
	*/
	function IsEmpty($str)
	{
		if(strlen(trim($str)) == 0)
			return true;
		return false;	
			
	}	

  /**
	* Function to check the string special charactor  or not
	* @param string $str
	* @param string $exp
	* @return bool
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
	* Function to check the string is numeric charactor  or not
	* @param string $str
	* @return bool
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
	* Function to check the string is numeric start  or not
	* @param string $str
	* @return bool
	*/		
	function IsNumericStart($str)
	{
		$chr = ord(substr($str,0,1));
		if($chr > 47 && $chr < 58)
			return true;
	
	}
	
   /**
	* Function to check the string is minimum   or not
	* @param string $str
	* @param integer $con
	* @return bool
	*/	
	function IsMinimum($str,$con)
	{
		if(strlen(trim($str)) < $con)
			return true;
	}
	
  	/**
	* Function to check the string is equal with required output  or not
	* @param string $str
	* @param string $str1
	* @return bool
	*/		
	function IsEqual($str,$str1)
	{
		if(strcmp(strtolower(trim($str)),strtolower(trim($str1))) != 0)
			return true;	
	}
	
  	/**
	* Function to check the email
	* @param string $str
	* @return bool
	*/	
	function IsInvalidEmail($str)
	{
		if($this->IsThereSpecial($str,"@._"))
			return true;
		elseif(strpos($str,"@") === false || strpos($str,".") === false)
			return true;
		elseif(strpos($str,"@") == 0 || strpos($str,".") == 0)
			return true;
		//elseif(strpos($str,"@") > strpos($str,"."))
			//return true;
		elseif(strpos($str,"@")+1 == strpos($str,"."))
			return true;
		elseif(	strpos($str,".")+1 == strpos($str,"@"))
			return true;
		elseif(strpos($str,"@") == strlen($str) || strpos($str,".") == strlen($str))
			return true;
		elseif(strpos($str,".")+2 > strlen($str)-1)
			return true;
	}

  /**
	* Function to check the string
	* @param string $str
	* @return bool
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
	* Function to check the is invalid or not 
	* @param string $str
	* @param string $with
	* @return bool
	*/	
	function IsInvalidSelect($str,$with)
	{	
		if(trim($str)==$with)
			return true;
	}
   /**
	* Function to check the is invalidfile or not 
	* @param string $field
	* @param string $ext
	* @param integer $size   
	* @return bool
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
	 * function to check the date is valid or not
	 *
	 * @param array $dat
	 * @return bool
	 */
	function IsInvalidDate($dat)
	{
		return checkdate($dat[1],$dat[0],$dat[2]);		
	}
	
}
?>