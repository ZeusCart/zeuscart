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
 * Check inputs  related  class
 *
 * @package   		Lib_CheckInputs
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_CheckInputs
{

	/**
	 * Function checks and invokes the validation module  
	 * 
	 * @param string $module
	 *
	 * @return void 
	 */	
	function Lib_CheckInputs($module)
	{
		if($module=='register')
			$this->register();
		else if($module=='validatelogin')
			$this->validatelogin();
		else if($module=='validatemyprofile')
			$this->validatemyprofile();
		else if($module=='validatemail')
			$this->validatemail();
		else if($module=='productReview')
			$this->validateproductReview();
		else if($module=='contactus')
			$this->contactUs();
		else if($module=='frmship')
			$this->validateCheckout();
		else if($module=='frmAcc')
			$this->validateUserAccount();
		else if($module=='changepassword')
			$this->validateChangePassword();
		else if($module=='frmWishSend')
			$this->validateWishlist();
		else if($module=='frmAddAddress')
			$this->validateAddress();
		else if($module=='quickregister')
			$this->validateQuickregister();		
		else if($module=='billingaddress')
			$this->validateBillingAddress();
		else if($module=='shippingaddress')
			$this->validateShippingAddress();	
		else if($module=='shippingmethod')
			$this->validateShippingMethod();
		else if($module=='giftvoucher')
			$this->validateGiftVoucher();		

	}

	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */
	function validateGiftVoucher()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['rname']!='' or $_POST['rname']=='' or $_POST['remail']!='' or $_POST['remail']=='' or $_POST['name']=='' or $_POST['name']!='' or $_POST['email']=='' or $_POST['email']!=''  )
			{
				
				$obj = new Lib_FormValidation('giftvoucher');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=index");
				exit();
			}
		}


	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */
	function validateShippingMethod()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['shipment_id']!='' or $_POST['shipment_id']=='')
			{
				
				$obj = new Lib_FormValidation('shippingmethod');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=showcart&action=validateShippingMethod");
				exit();
			}
		}


	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateShippingAddress()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['txtname']!='' or $_POST['txtstate']!='' or $_POST['txtname']=='' or $_POST['txtstate']=='' or $_POST['txtstreet']!='' or $_POST['txtstreet']=='' or $_POST['txtcity']!='' or $_POST['txtcity']=='' or $_POST['selbillcountry']!='' or $_POST['selshipcountry']=='' or $_POST['txtzipcode']!='' or $_POST['txtzipcode']=='')
			{
				
				$obj = new Lib_FormValidation('shippingaddress');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=showcart&action=validateShippingAddress");
				exit();
			}
		}


	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateBillingAddress()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['txtname']!='' or $_POST['txtstate']!='' or $_POST['txtname']=='' or $_POST['txtstate']=='' or $_POST['txtstreet']!='' or $_POST['txtstreet']=='' or $_POST['txtcity']!='' or $_POST['txtcity']=='' or $_POST['selbillcountry']!='' or $_POST['selbillcountry']=='' or $_POST['txtzipcode']!='' or $_POST['txtzipcode']=='' or $_POST['txtphone']!='' or $_POST['txtphone']=='')
			{
				
				$obj = new Lib_FormValidation('billingaddress');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=showcart&action=validatebillingaddress");
				exit();
			}
		}


	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function register()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtdisname']=='' or $_POST['txtlname']=='' or $_POST['txtfname']=='' or $_POST['txtemail']==''
			   or $_POST['txtpwd']=='' or $_POST['txtdisname']!='' or $_POST['txtlname']!='' or $_POST['txtfname']!='' 
			   or $_POST['txtemail']!='' or $_POST['txtpwd']!=''||$_POST['txtaddr']!=''||$_POST['txtcity']!=''||$_POST['txtState']!=''||$_POST['txtzipcode']!='')
			{
				//echo 'hi';exit;
				$obj = new Lib_FormValidation('register');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=userregistration");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function contactUs()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
			if($_POST['txtname']=='' or $_POST['email']=='' or $_POST['txtname']!='' or $_POST['email']!='')
			{
				$obj = new Lib_FormValidation('contactUs');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=contactus");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validatelogin()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtemail']!='' or $_POST['txtpass']!='' or $_POST['txtemail']=='' or $_POST['txtpass']=='')
			{
				//echo $_POST['txtuname'];exit;
				$obj = new Lib_FormValidation('validatelogin');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=login");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validatemyprofile()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['lastname']=='' or $_POST['firstname']=='' or $_POST['email']==''
			or $_POST['passwd']=='' or $_POST['cpasswd']=='' or $_POST['lastname']!='' or $_POST['firstname']!='' 
			or $_POST['email']!='' or $_POST['passwd']!='' or $_POST['cpasswd']!='')
			{
				$obj = new Lib_FormValidation('validatemyprofile');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=myprofile");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	
	function validatemail()
	{
	
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['email']!='' or $_POST['email']=='')
			{
				$obj = new Lib_FormValidation('validatemail');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=forgetpwd");
				exit();
			}
		}
	}
	
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateproductReview()
	{	
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['ratings']=='' or $_POST['detail']=='' or $_POST['reviewtxt']=='' or 
			$_POST['ratings']!='' or $_POST['detail']!='' or $_POST['reviewtxt']!='')
			{
				$obj = new Lib_FormValidation('productReview');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=productreview&action=showproductreview&prodid=".$_REQUEST['prodid']);
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	
	function validateCheckout()
	{
	
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtname']=='' or $_POST['txtstreet']=='' or $_POST['txtsuburb']=='' or $_POST['txtzipcode']!='' or $_POST['txtcountry']!='' or $_POST['txtstate']!='' or $_POST['txtsname']!='' or $_POST['txtsstreet']!='' or $_POST['txtssuburb']!='' or $_POST['txtszipcode']!='' or $_POST['txtscountry']!=''  or $_POST['txtsstate']!='' or $_POST['selshipcountry']!='' or $_POST['selbillcountry']!='' or $_POST['txtzipcode']!='')
			{
			
				$obj = new Lib_FormValidation('frmship');
			}
			else 
			{
				header("Location:".$_SESSION['base_url']."/index.php?do=addtocart");
				exit();
			}


		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateWishlist()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtEmail']!='' or $_POST['txtEmail']=='' )
			{
				$obj = new Lib_FormValidation('frmWishSend');
			}
			else 
			{	
				header("Location:".$_SESSION['base_url']."/index.php?do=wishlist");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateUserAccount()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtFName']!='')
			{
				$obj = new Lib_FormValidation('frmAcc');
			}
			else 
			{	
				header("Location:".$_SESSION['base_url']."/index.php?do=accountinfo");
				exit();
			}
		}

	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateChangePassword()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtCPwd']!='' || $_POST['txtCPwd']=='')
			{
				$obj = new Lib_FormValidation('changepassword');
			}
			else 
			{	
				header("Location:".$_SESSION['base_url']."/index.php?do=changepassword");
				exit();
			}
		}

	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateAddress()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST)
			{
				$obj = new Lib_FormValidation('frmAddAddress');
			}
			else 
			{	
				header("Location:".$_SESSION['base_url']."/index.php?do=addaddress");
				exit();
			}
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateQuickregister()
	{
	
	
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST)
			{	
			
				$obj = new Lib_FormValidation('checkQuickregister');
			}
			else 
			{	
				header("Location:".$_SESSION['base_url']."/index.php?do=showcart&action=showquickregistration");
				exit();
			}
		}

	}
	
	
}

?>