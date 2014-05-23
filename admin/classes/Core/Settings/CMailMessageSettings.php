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
 * This class contains functions to get and update the mail message settings from the database
 *
 * @package  		Core_Settings_CMailMessageSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Settings_CMailMessageSettings
{
	/**
	 * Function gets all the mail messages from the database 
	 * 
	 * 
	 * @return string
	 */	 		
	function showMailMessages()
	{
		include("classes/Display/DMailMessageSettings.php");
		$sql = "SELECT * FROM mail_messages_table WHERE mail_user=0";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
		
			return Display_DMailMessageSettings::showMailMessages($query->records);
		}
		else
		{
			return "No Maill Messages Found";
		}
	}
	/**
	 * Function gets all the admin mail messages from the database 
	 * 
	 * 
	 * @return string
	 */
	function showAdminMailMessages()
	{
	
		$sql = "SELECT * FROM mail_messages_table WHERE mail_user=1";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
		
			return Display_DMailMessageSettings::showMailMessages($query->records);
		}
		else
		{
			return "No Maill Messages Found";
		}
		
	}	

	/**
	 * Function displays the selected mail message from the database for updation 
	 * 
	 * 
	 * @return string
	 */	 
	
	function displayMessage()
    	{
       		 include("classes/Display/DMailMessageSettings.php");
		
		$sql = "SELECT * FROM mail_messages_table where mail_msg_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DMailMessageSettings::displayMessage($query->records);
		}
		else
		{
			return "No Contents Found";
		}		
    }
	
	
	/**
	 * Function updates the changes in the selected mail message into the database
	 * 
	 * 
	 * @return array
	 */	 
	
	function editMessage()
	{

		$sql = "UPDATE mail_messages_table SET mail_msg_subject='".trim($_REQUEST['mail_msg_subject'])."',mail_msg = '".trim($_REQUEST['mailmessages'])."' WHERE mail_msg_id=".(int)$_GET['id']; 
		$query = new Bin_Query();		
		if($query->updateQuery($sql))		
		$_SESSION['successmsg']= "<div class='alert alert-success'>
 		 <button data-dismiss='alert' class='close' type='button'>×</button>Updated Successfully</div>";		
	}
}
?>