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
 * error handle  related  class
 *
 * @package   		Lib_HandleErrors
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 	    Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Lib_HandleErrors
{
	/**
	 * Stores the error  messages
	 *
	 * @var array 
	 */
	var $messages = array();

	/**
	 * Stores the error  values
	 *
	 * @var array 
	 */
	var $values = array();
	/**
	 * Function is used to handle the error 
	 *
	 * @return void 
	 */
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
	/**
	 * Function is used to display the error  values
	 * @param string $field
	 * @return string|void
	 */
	function DisplayValue($field)
	{
		if(count($this->values)>0)
			return $this->values[$field];
		else 
			return "";
	}
	/**
	 * Function is used to display the error  message
	 * @param string $field
	 * @return string|void
	 */
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