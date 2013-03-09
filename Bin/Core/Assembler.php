<?php

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