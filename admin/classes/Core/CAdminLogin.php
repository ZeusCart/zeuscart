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
 * This class contains functions to check the login and logout status of the admin user.
 *
 * @package  		Core_CAdminLogin
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CAdminLogin
{
  
  	/**
	 * Function updates the admin name in the session for display. 
	 * 
	 * 
	 * @return array
	 */
  
	function loginStatus()
	{
		$default=new Core_CAdminLogin();
		$default->getDefaultCurrency();
		if($_SESSION['adminId']!='')
		{
			return $_SESSION['adminName'];
		}
		else if($_SESSION['subadminId']!='')
			return $_SESSION['subadminName'];
	}
	
	/**
	 * Function destroys the all the session variables in the page after the admin logged out. 
	 * 
	 * 
	 * @return string
	 */
	
	function logoutStatus()
	{
		session_destroy();
		return "<div class='success_msgbox' style='width:85%'>You Have been Successfully Logged out </div>";
		//header('location:?do=adminlogin');
		//exit;
	}   
	
	/**
	 * Function sends mail to the emailid specified by the admin which contains details about the password.
	 * 
	 * 
	 * @return string
	 */
	
	function forgetPassword()
	{
		
		$email=$_POST['adminemail'];
		$sql = "select subadmin_password,subadmin_name from subadmin_table where subadmin_email_id='".$email."'";
			
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$name=$obj->records[0]['subadmin_name'];
				$pass=$obj->records[0]['subadmin_password'];
				$password=base64_decode($pass);
			}
			$mail_content='Your username is <b>'.$name.'</b> and  Password is <b>'.$password.'</b> ';
			Core_CAdminLogin::sendingMail($email,$title,$mail_content);
			$result = "<div class='success_msgbox' style='width:85%'>User name and Password has been sent to <b>".$email."</b> successfully</div>";
		return $result;	
	}
	
	/**
	 * Sends a mail to the specified mail id with the use of the Lib_Mail(). 
	 * @param mixed $to_mail
	 * @param string $title
	 * @param string $mail_content	 	 
	 * 
	 */
	
	function sendingMail($to_mail,$title,$mail_content)
	{
		include('classes/Lib/Mail.php');
		$mail = new Lib_Mail();
		//$mail->From($fromemail); 
		$mail->ReplyTo('admin@zeuscart.com');
		$mail->To($to_mail); 
		$mail->Subject($title);
		$mail->Body($mail_content);
		$mail->Send();
	}
	
	/**
	 * Function updates the default currency in the session variable at the admin side.
	 * 
	 * 
	 * 
	 */
	
		
	function getDefaultCurrency()
	{
		$sql = "SELECT currency_tocken, currency_code, currency_name FROM currency_master_table WHERE default_currency=1";
			
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$_SESSION['currency']['currency_name']=$obj->records[0]['currency_name'];
			$_SESSION['currency']['currency_tocken']=$obj->records[0]['currency_tocken'];
			$_SESSION['currency']['currency_code']=$obj->records[0]['currency_code'];
		}
		else
		{
			$_SESSION['currency']['currency_name']='US Dollar';
			$_SESSION['currency']['currency_tocken']='$';
			$_SESSION['currency']['currency_code']='USD';
		}
	}
	
}
?>
