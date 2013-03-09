<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
class Core_CUserAccInfo
{
	/**
	* This function is used to assign  the errors in this->data 
	* @param array $Err contain both error values and error message
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
	 * @return HTML data
	 */
	function showAccInfo()
	{
		include('classes/Display/DUserAccount.php');
		
		$sqlselect = "SELECT user_id,user_fname,user_lname,user_email,user_pwd  from users_table a where  a.user_status=1 and user_id=".$_SESSION['user_id'];		
		
		$obj = new Bin_Query();

		if($obj->executeQuery($sqlselect))
		{

			 return Display_DUserAccount::showAccountInfo($obj->records);
		}	
		
	}
	/**
	 * This function is used to update  the   user account information
	 *
	 * .
	 * 
	 * @return HTML data
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

			$sqlselect="update users_table set user_fname='".$fname."',user_lname='".$lname."',user_email='".$email."',user_pwd='".base64_encode($pwd)."' where user_id=".$_SESSION['user_id'];
			$obj->updateQuery($sqlselect);
			
			$sqlselect="update newsletter_subscription_table set email='".$email."' where subsciption_id=".$subid;
			
			if($obj->updateQuery($sqlselect))
				return "<div class='success_msgbox'>Updated!</div></br>";
			else
				return "<div class='exc_msgbox'>Could not Updated!!</div></br>";
		}
	}
}
?>
