<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
class Lib_HandleErrors
{
	var $messages = array();
	var $values = array();
	function Lib_HandleErrors()
	{
//		print_r($_SESSION);
//		exit();
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