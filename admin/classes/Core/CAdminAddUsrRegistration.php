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
 * This class contains functions to add a new user account and to update the cse into the database.
 *
 * @package  		Core_CAdminAddUsrRegsitration
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAdminAddUsrRegsitration
{
	
	/**
	 * Function adds a new user account into the users table.
	 * 
	 * 
	 * @return string
	 */
	function addAccount()
	{
		$displayname = $_POST['txtdisname'];
		$firstname = $_POST['txtfname'];
		$lastname = $_POST['txtlname'];
		$email = $_POST['txtemail'];
		$pswd = $_POST['txtpwd'];
		//$newsletter = $_POST['chknewsletter'];
		$date = date('Y-m-d');
		/*if($newsletter == '')
			$newsletter = 0;*/
			
		if(count($Err->messages) > 0)
		{
			 $output['val'] = $Err->values;
			 $output['msg'] = $Err->messages;
		}
		
		else
		{
			if( $displayname!= '' and $firstname  != '' and $lastname != '' and $email != '' and $pswd != '')
			{
				
				$sql = "insert into users_table 			(user_display_name,user_fname,user_lname,user_email,user_pwd,user_status,user_doj) values('".$displayname."','".$firstname."','".$lastname."','".$email."','".$pswd."',1,'".$date."')";
			$obj = new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
				$result = "Added Successfully";
				return $result;
			}
			else
			{
				$result = "Not Inserted";
				return $result;
			}
			}
		}
   }
   
   /**
	 * Function updates the cse affiliate id in to the admin_settings table.
	 * 
	 * 
	 * @return string
	 */
   
   
   function saveCse()
   {
   		$registerid = $_POST['regid'];
		$csestatus = $_POST['chkregid'];
		if($csestatus == '')
			$csestatus = 0;
		if(count($Err->messages) > 0)
		{
			 $output['val'] = $Err->values;
			 $output['msg'] = $Err->messages;
		}
		else
		{
			if( $registerid!= '' and $csestatus  != '')
			{
				
			$sql = "update admin_settings table set set_value='".$registerid."' where set_name='www.pricerunner.com Affiliate ID'";
			$obj = new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
				$result = "CSE settings Updated Successfully";
				return $result;
			}
			else
			{
				$result = "Error while updating CSE settings.";
				return $result;
			}
			}
		}
   } 
}
?>