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
 * AJDF
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package 		AJDF
 * @author   	 	AJ Square Inc Dev Team
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @link    		http://www.ajsquare.com/ajhome.php
 * @version   		Version 4.0
 * @created   		January 15 2013
 */

/**
 * error handle  related  class
 *
 * @package   		Classes
 * @subpackage  	Library
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 */
class Lib_HandleErrors
{
	var $messages = array();
	var $values = array();
	function Lib_HandleErrors()
	{
		if(isset($_SESSION["Errors"]))
		{
			$this->messages = array_merge($this->messages,$_SESSION["Errors"]);
			$this->values = array_merge($this->values,$_SESSION["PreValues"]);
			unset($_SESSION["Errors"]);
			unset($_SESSION["PreValues"]);
			unset($_SESSION["ErrorValues"]);					
		}
	}
	
	function DisplayValue($field)
	{
		if(count($this->values)>0)
			return $this->values[$field];
		else 
			return "";
	}
	
	function DisplayMessage($field)
	{
		if(count($this->messages)>0)
		{
			if(isset($this->messages[$field]))
				return $this->messages[$field];
			else 
				return "";
		}
		else 
			return "";
	}
}

$Err = new Lib_HandleErrors();
?>