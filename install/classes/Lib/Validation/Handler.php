<?php
class Lib_Validation_Handler extends Lib_Validation_Methods 
{
var $mCheckArray = array();
var $mMessageArray = array();
var $mValueArray = array();
var $mErrors = array();
var $mFields = array();
var $mErrorValues = array();
var $mValidations = array();

	function Lib_Validation_Handler()
	{
	}	
	/**
	 * Stores Fieldnames, Values, Validationlist, Errormessages
	 *
	 * @param string $field
	 * @param string $value
	 * @param string $check_for
	 * @param string $message
	 */
	function Assign($field,$value,$check_for,$message)
	{
		$errhandler = new Lib_Validation_ErrorHandler(++$this->totalvalidation);		
		$errhandler->CheckError($field,$value,$check_for,$message);
		$this->mCheckArray = array_merge($this->mCheckArray,array("$check_for"));
		$this->mValueArray = array_merge($this->mValueArray,array("$value"));
		$this->mMessageArray = array_merge($this->mMessageArray,array("$message"));
		$this->mFields  = array_merge($this->mFields,array("$field"));
	}
	
	function MultiAssign($field,$value,$check_for,$message)
	{
		
	}	
	/**
	 * Perform all assigned validations
	 *
	 * @param string $location
	 */
	function PerformValidation($location)
	{
		$findmessage = 0;
		for($i=0;$i<count($this->mValueArray);$i++)
		{
			$ErrFound=0;
			//$tmparray = array_combine(split("/",$this->mCheckArray[$i]),split("/",$this->mMessageArray[$i]));
			
			$tmpcheck = split("/",$this->mCheckArray[$i]);
			$tmpmessage = split("/",$this->mMessageArray[$i]);
			$tmparray = array();
			for($j=0;$j<count($tmpcheck);$j++)
				$tmparray = array_merge($tmparray,array($tmpcheck[$j]=>$tmpmessage[$j]));

			if(strpos($this->mCheckArray[$i],"noempty") !== false)
			{
				if($this->IsEmpty($this->mValueArray[$i]))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["noempty"]));
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));
					$ErrFound=1;
				}
			}
			if(!$ErrFound && strpos($this->mCheckArray[$i],"nospecial") !== false)
			{
				$exceptions="";
				for($j=strpos($this->mCheckArray[$i],"nospecial")+10;$j<strlen($this->mCheckArray[$i]);$j++)
				{
					if(substr($this->mCheckArray[$i],$j,1)!="'" && substr($this->mCheckArray[$i],$j,1)!="/")
						$exceptions .= substr($this->mCheckArray[$i],$j,1);
					else
						$j=strlen($this->mCheckArray[$i]);
				}				
				if($this->IsThereSpecial($this->mValueArray[$i],$exceptions))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["nospecial'".$exceptions."'"]));			
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));	
					$ErrFound=1;					
				}
			}	
			if(!$ErrFound && strpos($this->mCheckArray[$i],"nonumber") !== false)
			{
				if($this->IsNumeric($this->mValueArray[$i]))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["nonumber"]));			
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));	
					$ErrFound=1;					
				}
			}						
			if(!$ErrFound && strpos($this->mCheckArray[$i],"nonumericstart") !== false)
			{
				if($this->IsNumericStart($this->mValueArray[$i]))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["nonumericstart"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));
					$ErrFound=1;
				}					
			}						
			if(!$ErrFound && strlen(trim($this->mValueArray[$i])) > 0 && strpos($this->mCheckArray[$i],"nostring") !== false)
			{
				if($this->IsString($this->mValueArray[$i]))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["nostring"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));
					$ErrFound=1;
				}					
			}
			if(!$ErrFound && strpos($this->mCheckArray[$i],"minchar:") !== false)
			{
				for($k=1;$k<strlen($this->mCheckArray[$i]);$k++)
				{
					if(substr($this->mCheckArray[$i],strpos($this->mCheckArray[$i],"minchar")+8,$k)!="/")
						$value=$k;				
					else
						$k=strlen($this->mCheckArray[$i]);					
				}
				$contain = substr($this->mCheckArray[$i],strpos($this->mCheckArray[$i],"minchar")+8,$value);
				if(strlen(trim($this->mValueArray[$i])) > 0 && $this->IsMinimum($this->mValueArray[$i],$contain))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["minchar:$contain"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));	
					$ErrFound=1;				
				}
			}
			if(!$ErrFound && strpos($this->mCheckArray[$i],"match") !== false)
			{
				$matchwith="";
				for($j=strpos($this->mCheckArray[$i],"match")+6;$j<strlen($this->mCheckArray[$i]);$j++)
				{
					if(substr($this->mCheckArray[$i],$j,1)!="/")
						$matchwith .= substr($this->mCheckArray[$i],$j,1);
					else
						$j=strlen($this->mCheckArray[$i]);						
				}
				if(strlen(trim($this->mValueArray[$i])) > 0 && $this->IsEqual($this->mValueArray[$i],$matchwith))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["match:$matchwith"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));	
					$ErrFound=1;			
				}
			}			
			if(!$ErrFound && strlen(trim($this->mValueArray[$i])) > 0 && strpos($this->mCheckArray[$i],"emailcheck") !== false)
			{
				if($this->IsInvalidEmail($this->mValueArray[$i]))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["emailcheck"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));		
					$ErrFound=1;			
				}			
			}	
					
			if(!$ErrFound && strpos($this->mCheckArray[$i],"ifselected") !== false)
			{
				$checkwith="";
				for($j=strpos($this->mCheckArray[$i],"ifselected")+11;$j<strlen($this->mCheckArray[$i]);$j++)
				{
					if(substr($this->mCheckArray[$i],$j,1)!="/")
						$checkwith .= substr($this->mCheckArray[$i],$j,1);
					else
						$j=strlen($this->mCheckArray[$i]);						
				}			
				if($this->IsInvalidSelect($this->mValueArray[$i],$checkwith))
				{
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$tmparray["dontmatch:$checkwith"]));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));
					$ErrFound=1;					
				}
			}
			
			if(!$ErrFound && strpos($this->mCheckArray[$i],"checkfile") !== false)	
			{
				$extension="";
				$att="";
				$size="";
				for($j=strpos($this->mCheckArray[$i],"checkfile")+10;$j<strlen($this->mCheckArray[$i]);$j++)
				{
					if(substr($this->mCheckArray[$i],$j,1)!="/")
						$att.= substr($this->mCheckArray[$i],$j,1);
					else
						$j=strlen($this->mCheckArray[$i]);						
				}						
				$att = split("-",$att);
				$extension = $att[0];
				$size = $att[1];
				if($opt = isset($att[2]))
				
				if($this->IsInvalidFile($this->mFields[$i],$extension,$size))
				{
					$selecterrormsg = split("-",$tmparray["checkfile:$extension-$size"]);
					$disperror = $selecterrormsg[$this->fileerror];
					$this->mErrors = array_merge($this->mErrors,array($this->mFields[$i]=>$disperror));				
					$this->mErrorValues = array_merge($this->mErrorValues,array($this->mFields[$i]));
					$ErrFound=1;					
				}				
			}
			
			if(!$ErrFound && strpos($this->mCheckArray[$i],"datecheck") !== false)
			{
				$dat="";
				for($j=strpos($this->mCheckArray[$i],"datecheck")+10;$j<strlen($this->mCheckArray[$i]);$j++)
				{
					if(substr($this->mCheckArray[$i],$j,1)!="/")
						$dat .= substr($this->mCheckArray[$i],$j,1);
				}
				if($this->IsInvalidDate(split("-",$dat)))
				{
					
				}
			}
		}
		
		if(count($this->mErrors)>0)
		{
			$_SESSION["Errors"] = $this->mErrors;
			$_SESSION["ErrorValues"] = $this->mErrorValues;
			if(isset($_POST) && count($_POST)>0)
				$_SESSION["PreValues"] = $_POST;
			else
				$_SESSION["PreValues"] = $_GET;
			header("Location:".trim($location));
			exit();
		}		
	}	
}

?>