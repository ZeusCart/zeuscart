<?php
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