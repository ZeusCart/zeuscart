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
 * @package  		Lib_Validation_ErrorHandler
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_Validation_ErrorHandler
{
	/**
	 * Stores the output
	 *
	 * @var integer 
	 */
	var $totalvalidation;
	/**
	 * Stores the validation array
	 *
	 * @var array 
	 */
	var $mValidations=array();
	/**
	 * Function to form error handler array
	 * @param integer  $tot
	 * @return void 
	 */
	function Lib_Validation_ErrorHandler($tot)
	{
		$this->totalvalidation=$tot;
		$this->mValidations = array("noempty","nospecial","nonumber",
									"nonumericstart","minchar:","nostring",
									"match:","emailcheck","ifselected",
									"checkfile:","datecheck");		
	}
	/**
	 * Function to check  error 
	 * @param integer  $field
	 * @param  integer  @value
	 * @param  string  @check_for
	 * @param  string  @message
	 * @return void 
	 */
	function CheckError($field,$value,$check_for,$message)
	{
		for($s=0;$s<count($tmp=split("/",$check_for));$s++)
		{
			for($m=0;$m<count($this->mValidations);$m++)
			{
				if(strstr($tmp[$s],$this->mValidations[$m]))
					$m=count($this->mValidations)+1;
			}
			if($m==count($this->mValidations))
				$this->DisplayError($field,$value,$check_for,$message,0);
		}
		if(strlen(trim($field))==0)
			$this->DisplayError($field,$value,$check_for,$message,1);
		elseif (strlen(trim($check_for))==0)
			$this->DisplayError($field,$value,$check_for,$message,2);
		elseif (strlen(trim($message))==0)
			$this->DisplayError($field,$value,$check_for,$message,3);
		elseif (count(split("/",$check_for))>count(split("/",$message))) 
			$this->DisplayError($field,$value,$check_for,$message,4);
		elseif (count(split("/",$check_for))<count(split("/",$message))) 
			$this->DisplayError($field,$value,$check_for,$message,5);
		elseif (strpos($check_for,"minchar:") !== false)
			{
				$tmp="";
				for($k=1;$k<strlen($check_for);$k++)
				{
					if(substr($check_for,strpos($check_for,"minchar")+8,$k)!="/")
							$tmp=$k;
					$contain = substr($check_for,strpos($check_for,"minchar")+8,$tmp);				
				}
				if(strlen(trim($contain))==0)
					$this->DisplayError($field,$value,$check_for,$message,6);
				elseif (!Validation_Methods::IsNumeric($contain))							
					$this->DisplayError($field,$value,$check_for,$message,7);
			}
		elseif (strpos($check_for,"match") !== false)
			{
				$matchwith="";
				for($j=strpos($check_for,"match")+6;$j<strlen($check_for);$j++)
				{
					if(substr($check_for,$j,1)!="/")
						$matchwith .= substr($check_for,$j,1);
				}
				//if(strlen(trim($matchwith))==0)
					//$this->DisplayError($field,$value,$check_for,$message,8);					
			}		
		elseif (strpos($check_for,"ifselected") !== false)
			{
				$checkwith="";
				for($j=strpos($check_for,"ifselected")+11;$j<strlen($check_for);$j++)
				{
					if(substr($check_for,$j,1)!="/")
						$checkwith .= substr($check_for,$j,1);
				}		
				if(strlen(trim($checkwith))==0)
					$this->DisplayError($field,$value,$check_for,$message,9);				
			}	
		elseif (strpos($check_for,"checkfile:") !== false)	
			{
				$extension="";
				$att="";
				$size="";
				for($j=strpos($check_for,"checkfile")+10;$j<strlen($check_for);$j++)
						$att.= substr($check_for,$j,1);
				if(count($att = split("-",$att))==2)
				{
					$extension = $att[0];
					$size = $att[1];
					if(strlen(trim($extension))==0)			
						$this->DisplayError($field,$value,$check_for,$message,10);
					elseif (strlen(trim($size))==0)					
						$this->DisplayError($field,$value,$check_for,$message,11);
					elseif (!Validation_Methods::IsNumeric($size) || $size==0)
						$this->DisplayError($field,$value,$check_for,$message,12);
				}
				else 
					$this->DisplayError($field,$value,$check_for,$message,13);
				$selecterrormsg = split("-",$message);					
				if(count($selecterrormsg)!=2)
					$this->DisplayError($field,$value,$check_for,$message,14);
				if(!isset($_FILES["$field"]))
					$this->DisplayError($field,$value,$check_for,$message,15);
			}
	}
	/**
	 * Function to display  error 
	 * @param integer  $field
	 * @param  integer  @value
	 * @param  string  @check_for
	 * @param  string  @message
     * @param integer $id
	 * @return void 
	 */
	function DisplayError($field,$value,$check_for,$message,$id)
	{
		if($id==0)
			$errormsg = "Unknown Validation Request - <i>$check_for</i>";
		if($id==1)
			$errormsg = "Field Name Required To Perform Validation";
		elseif ($id==2)
			$errormsg = "Specify Needed Validation";
		elseif ($id==3)
			$errormsg = "Specify Error Message";
		elseif ($id==4)
			$errormsg = "Requested ". count(split("/",$check_for))." Validation(s). Only ".count(split("/",$message))." Error Message(s) Provided";
		elseif ($id==5)
			$errormsg = "Requested Only ". count(split("/",$check_for))." Validation(s). But ".count(split("/",$message))." Error Message(s) Provided";
		elseif ($id==6)
			$errormsg = "Requested <i>minchar</i> Validation. But Value not Provided";
		elseif ($id==7)
			$errormsg = "Requested <i>minchar</i> Validation. But Provided Value is not a number";
		elseif ($id==8)
			$errormsg = "Requested <i>match</i> Validation. But Value not Provided";
		elseif ($id==9)
			$errormsg = "Requested <i>ifselected</i> Validation. But Value not Provided";
		elseif ($id==10)
			$errormsg = "Requested <i>checkfile</i> Validation. But extension(s) not Provided";
		elseif ($id==11)
			$errormsg = "Requested <i>checkfile</i> Validation. But size not Provided";
		elseif ($id==12)
			$errormsg = "Requested <i>checkfile</i> Validation. But Provided size Value is not a number or Zero";
		elseif ($id==13)
			$errormsg = "Requested <i>checkfile</i> Validation. But extension(s) and size not Provided";
		elseif ($id==14)
			$errormsg = "Requested <i>checkfile</i> Validation. 1 error message found it need two error messages";
		elseif ($id==15)
			$errormsg = "Requested <i>checkfile</i> Validation. But Invalid field name given";
		
		
		$chk = split("/",$check_for);
		$chkmsg = split("/",$message);
			
		if($chk>$chkmsg)	
			array_push($chkmsg,"<font color=red> ? </font>");
		elseif ($chkmsg>$chk)
			array_push($chk,"<font color=red> ? </font>");
			
		$tmp="";
		for($mj=0;$mj<count($chk);$mj++)
		{
			$tmp .= ' <tr>
    <td bgcolor="">&nbsp;</td>
    <td bgcolor=""><font face="Verdana, Arial, Helvetica, sans-serif" size="2">'.$chk[$mj].' </font></td>
    <td colspan="2" bgcolor="#FFFBE8"><font color=red face="Verdana, Arial, Helvetica, sans-serif" size="2"> '.$chkmsg[$mj].' </font></td>
  </tr>';
			
		}
		
		echo $elist = '<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%" bgcolor="#FFCC00">&nbsp;</td>
    <td width="3%" bgcolor="#FFFBE8">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFBE8"><font color="#990000" size="+3">ERROR</font></td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFCC00">&nbsp;</td>
    <td bgcolor="#FFFBE8">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFBE8"><font color="#FF0000" size="+1" face="Verdana, Arial, Helvetica, sans-serif"> '.$errormsg.' </font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00">&nbsp;</td>
    <td bgcolor="#FFFBE8">&nbsp;</td>
    <td width="15%" bgcolor="#FFFBE8"><font face="Arial, Helvetica, sans-serif" size="2"><strong>Assignment Number</strong></font></td>
    <td width="78%" bgcolor="#FFFBE8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> '.$this->totalvalidation.' </font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00">&nbsp;</td>
    <td bgcolor="#FFFBE8">&nbsp;</td>
    <td bgcolor="#FFFBE8"><font face="Arial, Helvetica, sans-serif" size="2"><strong>Field Name</strong></font> </td>
    <td bgcolor="#FFFBE8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> '.$field.' </font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00">&nbsp;</td>
    <td bgcolor="#FFFBE8">&nbsp;</td>
    <td bgcolor="#FFFBE8"><font face="Arial, Helvetica, sans-serif" size="2"><strong>Field Value</strong></font> </td>
    <td bgcolor="#FFFBE8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> '.$value.' </font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00">&nbsp;</td>
    <td bgcolor="#FFFBE8">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFBE8"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%">&nbsp;</td>
        <td width="27%"><font face="Arial, Helvetica, sans-serif" size="2"><strong>Requested Validation(s)</strong></font> </td>
        <td width="57%"><font face="Arial, Helvetica, sans-serif" size="2"><strong>Error Message(s )</strong></font> </td>
      </tr>'.$tmp.'
    </table></td>
  </tr></table>';
		
		exit();
	}
	
}


?>