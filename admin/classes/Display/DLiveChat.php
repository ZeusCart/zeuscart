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
 * This class contains functions to display the live chat process
 *
 * @package  		Display_DLiveChat
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DLiveChat
{
	/**
	 * Function  to  display the live chat
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function showLiveChat($arr,$Err)
	{
		if(!empty($Err->messages))
		{
			$arr=$Err->values;
			
		}
		else
		{
			$arr=$arr;
			
		}
		if($arr['live_chat_status']=='0')
		{
			$checked="checked";
	
		}
		else
		{
			$checked="";
		}
		$output.='<div class="row-fluid">
   		 <div class="span12">
	       <img src="images/live_chat.jpg"></div></div>

		<div class="row-fluid">
   		 <div class="span6">
	        <label> Live Chat API  <font color="red">*</font>  </label>
		<textarea name="live_chat_script"  style="width: 407px; height: 131px;" id="live_chat_script">'.$arr['live_chat_script'].'</textarea>
		</div></div>
		
		<div class="row-fluid">
   		 <div class="span6">
	        <label>Show Live Chat</label>
		<input type="checkbox" name="live_chat_status" value="0" '.$checked.'>
		</div></div>	
		

		<div class="row-fluid">
   		 <div class="span6">
	        <label>&nbsp;</label>
		<a href="http://www.onetoonetext.com/index.php?do=startdwnld" target="_blank"><img src="images/download.png"></a>
		</div></div>';
		return $output;
	}
}
?>