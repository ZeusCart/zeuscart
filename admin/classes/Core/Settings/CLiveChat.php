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
 * This class contains functions to get and update the live chat details 
 *
 * @package  		Core_CLiveChat
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 	Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CLiveChat
{
	
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();
	
	/**
	 * Stores the error messages
	 *
	 * @var array $errormessages
	 */	
	
	var $errormessages = array();
	
	/**
	 * Function gets the site settings details from the database 
	 * 
	 * 
	 * @return string
	 */	 	
		
	function showLiveChat($Err)
	{
		$sql = "SELECT * FROM live_chat_table ";  
		$query = new Bin_Query();
		$query->executeQuery($sql);
	
		return Display_DLiveChat::showLiveChat($query->records[0],$Err);
	}
	
	/**
	 * Function updates the changes made in the site moto details into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateLiveChat()
	{
	
		
		if($_REQUEST['live_chat_status']=='0')
		{
			$live_chat_status="0";
	
		}
		else
		{
			$live_chat_status="1";
		}
		 $sql = "UPDATE live_chat_table SET 
			live_chat_script ='".html_entity_decode($_REQUEST['live_chat_script'])."' ,
			live_chat_status ='".$live_chat_status."'			
			where id='1'"; 
		
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{	
					

				$_SESSION['msglivechat'] = '<div class="alert alert-success">
   				 <button type="button" class="close" data-dismiss="alert">×</button>Live chat has been updated successfully </div>';
		
			}
			else
			{
				$_SESSION['msglivechat'] = '<div class="alert alert-error">
    				<button type="button" class="close" data-dismiss="alert">×</button>Live chat has not been updated successfully</div>';

			}

			header('Location:?do=livechat');
			exit;
	}
}	
 ?>