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
 * @package  		Core_Validation_CheckInputs
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Validation_CheckInputs
{
	
	
	/**
	 * Function checks and invokes the validation module  
	 * 
	 * @param string $module
	 *
	 * @return void 
	 */	 	
	function Core_Validation_CheckInputs($module)
	{
		
		if($module=="addattribute")	
			$this->chkAddAttribute();
		if($module=="addattributevalues")	
			$this->chkAddAttributevalues();	
	}
	
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 	
		
	function chkAddAttribute()
	{	
		include("classes/Core/Validation/Validation.php");
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{	
		    if(isset($_POST['attributes']))
			{				
				new Core_Validation_Validation('addattribute');
			}	
			else
			{	
				header("Location:?do=addattributes");	
				exit();
			}
		}	
	}
	
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	
	function chkAddAttributevalues()
	{	
		include("classes/Core/Validation/Validation.php");
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{	
		    if(isset($_POST['attributevalues']))
			{
				new Core_Validation_Validation('addattributevalues');
			}	
			else
			{	
				header("Location:?do=addattributevalues");	
				exit();
			}
		}	
	}
}
?>