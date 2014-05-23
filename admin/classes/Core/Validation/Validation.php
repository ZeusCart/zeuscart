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
 * This class contains functions to check the inputs given by the user 
 *
 * @package  		Core_Validation_Validation
 * @subpackage 		Lib_Validation_Handler
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Validation_Validation extends Lib_Validation_Handler 
{
	
	/**
	 * Function checks and invokes the validation module  
	 * 
	 * @param string $form
	 *
	 * @return void 
	 */	 	
	
	function Core_Validation_Validation($form)
	{
		if($form=="addattribute" )
			$this->valAddAttribute();
		if($form=="addattributevalues" )
			$this->valAddAttributeValues();		
	}
	
	
	/**
	 * Function checks the max length of the given string and assign an error
	 * 
	 * @param string $name
	 * @param string $val
	 * @param integer $maxlen
	 * @param string $msg	 
	 *
	 * @return void 
	 */	 	
	
	function check_maxlength($name,$val,$maxlen,$msg='')
	{
		if(strlen($val)>$maxlen)
		{
			if(empty($msg))
				$message = "This value cannot exceed ".$maxlen." characters";
			else 	
				$message=$msg;	
			$this->Assign($name,"","noempty",$message);
		}
	}
	
	/**
	 * Function checks the whether the attributes supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	 	
	
	function valAddAttribute()
	{
		$message ="Required Field cannot be Blank";
		$this->Assign("attributes",$_POST['attributes'],"noempty",$message);
		/*if($_POST['mon'] == '' || $_POST['mon'] == 0)
		{
			$message ="Required Field cannot be Blank";
			$this->Assign("mon",'',"noempty",$message);
		}*/
		
		$this->PerformValidation("?do=addattributes");
	}	
	
	/**
	 * Function checks the whether the attribute value supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	 
	
	function valAddAttributeValues()
	{
		$message ="Required Field cannot be Blank";
		$this->Assign("attributevalues",$_POST['attributevalues'],"noempty",$message);
		$this->PerformValidation("?do=addattributevalues");
	}	
	
 
}
?>