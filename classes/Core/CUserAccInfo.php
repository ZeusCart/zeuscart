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
 * User account information  related  class
 *
 * @package   		Core_CUserAccInfo
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserAccInfo
{
	/**
	* This function is used to assign  the errors in this->data 
	* @param array $Err 
	* @return array
 	*/
	function Ulogin($Err)
	{
		if(count($Err->values)==0)
		{
			$this->data = $Err->values;
			$this->data = $Err->messages;
		}
		else 
		{	
			$this->data = $Err->values;
			$this->errormessages = $Err->messages;
		}
	}
	/**
	 * This function is used to get  the   user account information
	 *
	 * .
	 * 
	 * @return string
	 */
	function showAccInfo()
	{
		include('classes/Display/DUserAccount.php');
		
		$sqlselect = "SELECT a.user_id,a.user_fname,a.user_lname,a.user_email,a.user_pwd,b.subsciption_id from users_table a,newsletter_subscription_table b where a.user_email=b.email and a.user_status=1 and a.user_id=".$_SESSION['user_id']; 
		
		$obj = new Bin_Query();

		if($obj->executeQuery($sqlselect))
		{

			 return Display_DUserAccount::showAccountInfo($obj->records);
		}	
		
	}
	/**
	 * This function is used to get  the   user account information
	 *
	 * .
	 * 
	 * @return string
	 */
	function showChangePassword()
	{
		include('classes/Display/DUserAccount.php');
		
	      return Display_DUserAccount::showChangePassword();
	
		
	}
	/**
	 * This function is used to update  the   user account information
	 *
	 * .
	 * 
	 * @return string
	 */
	function updateAcc()
	{ 
		if(isset($_POST['txtFName']) && $_POST['txtLName']!='')
		{
			$fname=$_POST['txtFName'];
			$lname=$_POST['txtLName'];
			$email=$_POST['txtEmail'];
			$pwd=$_POST['txtNPwd'];
			$subid=$_POST['hidsubid'];

			$obj = new Bin_Query();

			$sqlselect="update users_table set user_fname='".$fname."',user_lname='".$lname."',user_email='".$email."' where user_id=".$_SESSION['user_id']; 
			$obj->updateQuery($sqlselect);
			
			$sqlselect="update newsletter_subscription_table set email='".$email."' where subsciption_id=".$subid;
			
			if($obj->updateQuery($sqlselect))

				return '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(YOUR_ACCOUNT_SUCCESSFULLY_UPDATED).'
				</div>';
				else


				return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(YOUR_ACCOUNT_NOT_UPDATED).'
				</div>';
		}
	}
	/**
	 * This function is used to update  the   user change password
	 *
	 * .
	 * 
	 * @return string
	 */
	function updateChangePassword()
	{

		$pwd=$_POST['txtNPwd'];
		$obj = new Bin_Query();

		$sqlselect="update users_table set user_pwd='".md5($pwd)."' where user_id=".$_SESSION['user_id']; 
		$obj->updateQuery($sqlselect);
		
				
		if($obj->updateQuery($sqlselect))
		{

			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>
			'.Core_CLanguage::_(YOUR_PASSWORD_SUCCESSFULLY_UPDATED).'
			</div>';
		}
		else
		{

			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>
			'.Core_CLanguage::_(YOUR_PASSWORD_HAS_NOT_BEEN_UPDATED).'
			</div>';

		}

	}
}
?>
