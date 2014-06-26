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
 * This class contains functions related error hander
 *
 * @package  		Bin_Core_Assembler
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 */
class Bin_Core_Assembler
{
	
	private $do;
		
	public function __construct()
	{

		Bin_Core_Assembler::PowerSecurity();
		include(ROOT_FOLDER.'Built/'.CURRENT_FOLDER."/Dll.php");	
		if(isset($_GET['action']) && isset($_GET['action']{1}))
			$this->do = trim($_GET['do']).':'.trim($_GET['action']);
		else
			$this->do = trim($_GET['do']);


                if (isset($_POST['prodid'])) {
                    if (is_array($_POST['prodid'])) { 
                        foreach ($_POST['prodid'] as $key => $value) {
                            $_POST['prodid'][$key] = abs((int)$value);
                        }
                    } else {
                        $_POST['prodid'] = abs((int)$_GET['prodid']);
                    } 
                }

                
                if (isset($_POST['qty'])) {
                    if (is_array($_POST['qty'])) { 
                        foreach ($_POST['qty'] as $key => $value) {
                            $_POST['qty'][$key] = abs((int)$value);
                        }
                    } else {
                        $_POST['qty'] = abs((int)$_GET['prodid']);
                    } 
                }
 
                if (isset($_POST['variations'])) $_POST['variations'] = abs((int)$_POST['variations']);
                if (isset($_GET['prodid']))      $_GET['prodid']      = abs((int)$_GET['prodid']);
                if (isset($_POST['subId']))      $_POST['subId']      = abs((int)$_POST['subId']);
                                
		
		if(array_key_exists($this->do,$domapping))
		{
			if(!(int)$domapping[$this->do]['loadlib'])
			{
				$this->loadModelFiles($domapping, $globalmapping);			
			}
			else
			{
				$this->loadSystemFiles($system);	
				$this->loadLibrayFiles($libraries);				
				$this->loadModelFiles($domapping, $globalmapping);			
			}
		}
		else
		{
			if(!(int)$globalmapping['invalidrequest']['loadlib'])
			{
				$this->loadModelFiles($domapping, $globalmapping);			
				
			}
			else
			{
				$this->loadSystemFiles($system);	
				$this->loadLibrayFiles($libraries);				
				$this->loadModelFiles($domapping, $globalmapping);			
			}		
		}
	}
	
	
	private function loadSystemFiles($system)
	{
		foreach($system as $key=>$item)	
			include(ROOT_FOLDER.$item);	
	}
	
	
	
	private function loadLibrayFiles($library)
	{
		foreach($library as $key=>$item)	
			include(ROOT_FOLDER.$item);	
	}
	
	private function loadModelFiles($domapping,$globalmapping)
	{
		if(array_key_exists($this->do,$domapping))
		{
			include_once('classes/Model/'.$domapping[$this->do]['model'].'.php');
			$class = "Model_".$domapping[$this->do]['model'];			
			$function = $domapping[$this->do]['function'];
			$obj = new $class;
			$obj->$function();			
		}
		else 
		{
			include_once('classes/Model/'.$globalmapping['invalidrequest']['model'].'.php');
			$class = "Model_".$globalmapping['invalidrequest']['model'];					
			$function = $globalmapping['invalidrequest']['function'];		
			$obj = new $class;	
			$obj->$function();
		}
	}	
	
	function PowerSecurity()
	{
		//	Power security in $_POST single value and array values
		//	******************************************************
		
		foreach($_POST as $key=>$itemm)
		{
	
			if($key != "google_script")
			{
				if(!is_array($itemm))
				{
					if(!strstr($itemm,"<script"))
					{
						$_POST[$key] = mysql_escape_string(stripslashes(substr($itemm,strpos($itemm,"</script>"),strlen($itemm))));
					}
					else
					{
						$_POST[$key] = "";
					}
				}
				else
				{
					$_POST[$key] = Bin_Core_Assembler::recuresiveArray($itemm);
				}
			}
		}	
		
		//	Power security in $_GET single value and array values
		//	*****************************************************
		foreach($_GET as $key=>$itemm)
		{
			if(!is_array($itemm))
			{
				if(!strstr($itemm,"<script"))
				{
					$_GET[$key] = mysql_escape_string(stripslashes(substr($itemm,strpos($itemm,"</script>"),strlen($itemm))));
				}
				else
				{
					$_GET[$key] = "";
				}
				
			}
			else
			{
				$_GET[$key] = Bin_Core_Assembler::recuresiveArray($itemm);
			}
		}
		
	}
	
	function recuresiveArray($itemm)
	{
 
		foreach($itemm as $key=>$item)
		{
			if(!is_array($item))
			{
				if(!strstr($item,"<script"))
				{
					$itemm[$key] = mysql_escape_string(stripslashes(substr($item,strpos($item,"</script>"),strlen($item))));
				}
				else
				{
					$itemm[$key] = "";
				}
				 
			}
			else
			{
				return Bin_Core_Assembler::recuresiveArray($item);
			}
		}
		return $itemm;
	}
	
	function PHPPowerSecurity()
	{
		//	Power security in $_POST single value and array values
		//	******************************************************
		
		foreach($_POST as $key=>$itemm)
		{
	
			if(!is_array($itemm))
			{
				$_POST[$key] = mysql_escape_string(stripslashes($itemm));
			}
			else
			{
				$_POST[$key] = Bin_Core_Assembler::PHPrecuresiveArray($itemm);
			}
		}	
		
		//	Power security in $_GET single value and array values
		//	*****************************************************
		foreach($_GET as $key=>$itemm)
		{
			if(!is_array($itemm))
			{
				$_GET[$key] = mysql_escape_string(stripslashes($itemm));
			}
			else
			{
				$_GET[$key] = Bin_Core_Assembler::PHPrecuresiveArray($itemm);
			}
		}
		
	}
	
	function PHPrecuresiveArray($itemm)
	{
 
		foreach($itemm as $key=>$item)
		{
			if(!is_array($item))
			{
				$itemm[$key] = mysql_escape_string(stripslashes($item));				 
			}
			else
			{
				return Bin_Core_Assembler::PHPrecuresiveArray($item);
			}
		}
		return $itemm;
	}
}
?>
