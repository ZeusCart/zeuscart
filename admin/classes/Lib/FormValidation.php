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
 * This class contains functions related  to validation 
 *
 * @package  		Lib_FormValidation
 * @subpackage 		Lib_Validation_Handler
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_FormValidation extends Lib_Validation_Handler 
{

	/**
	 * Function checks and invokes the validation module  
	 * 
	 * @param string $form
	 *
	 * @return void 
	 */	 	
	
	function Lib_FormValidation($form)
	{
		if($form=='category')
			$this->validateCategory();
		else if($form=='register')
			$this->validateRegister();
		else if($form=='validatelogin')
			$this->validatelogin();
		else if($form=='subadminmail')
			$this->validateSubAdminEmail();
		else if($form=='subadminpass')
			$this->validateSubAdminPass();
		else if($form=='productreg')
			$this->validateEntry();
		else if($form=='attributes')
			$this->validateAttributes();	
		else if($form=='adminemail')
			$this->validateAdminEmail();			
		else if($form=='productupdate')
			$this->validateUpdateEntry();
		else if($form=='useraccregister')
			$this->validateUserRegister();
		else if($form=='frmship')
			$this->validateCheckout();
		else if($form=='regionwisetax')
			$this->validateRegionwisetaxEntry();
		else if($form=='regionwisetaxedit')
			$this->validateRegionwisetaxEdit();
		else if($form=='addnewcurrency')
			$this->validateCurrency();
		else if($form=='updatecurrency')
			$this->validateEditCurrency();
		else if($form=='updateslideshow')
			$this->validateSlideShow();
	}
	/**
	 * Function checks the url 
	 * 
	 *
	 * @return string 
	 */	
	function isValidURL($url)
	{
		$urlstart = substr($url,0,3);
		$url = ($urlstart == 'www')?'http://'.$url:$url;
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}

	
	/**
	 * Function checks the slide show  and assign an error
	 * 
	 *
	 * @return void 
	 */	

	function validateSlideShow()
	{

		$message = "Invalid URL!";

		for($i=0;$i<count($_POST['slide_url']);$i++)
		{
			if($_POST['slide_url'][$i]!='' && !$this->isValidURL(trim($_POST['slide_url'][$i])))
			{
				$j=$i+1;
				$this->Assign("slide_url".$j."","","noempty",$message);
			}

		}


		$this->PerformValidation('?do=banner');
	}
	/**
	 * Function checks the check out process add to cart address and assign an error
	 * 
	 *
	 * @return void 
	 */	 	
	function validateCheckout()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("txtname",trim($_POST['txtname']),"noempty",$message);
		//	$this->Assign("txtcompany",trim($_POST['txtcompany']),"noempty",$message);		
		$this->Assign("txtstreet",trim($_POST['txtstreet']),"noempty",$message);
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty",$message);
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);
		//$this->Assign("selbillcountry",trim($_POST['selbillcountry']),"noempty",$message);
		$this->Assign("txtstate",trim($_POST['txtstate']),"noempty",$message);
		
		$this->Assign("txtsname",trim($_POST['txtsname']),"noempty",$message);
		//	$this->Assign("txtscompany",trim($_POST['txtscompany']),"noempty",$message);
		$this->Assign("txtsstreet",trim($_POST['txtsstreet']),"noempty",$message);
		$this->Assign("txtscity",trim($_POST['txtscity']),"noempty",$message);
		$this->Assign("txtszipcode",trim($_POST['txtszipcode']),"noempty",$message);
		//$this->Assign("selshipcountry",trim($_POST['selshipcountry']),"noempty",$message);
		$this->Assign("txtsstate",trim($_POST['txtsstate']),"noempty",$message);
		$this->PerformValidation('?do=addUserProduct');
	}
	/**
	 * Function checks the whether the registration process parameter supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	 
	function validateUserRegister()
	{
		
		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtfname",trim($_POST['txtfname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/ Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtlname",trim($_POST['txtlname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/No special characters allowed";
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"noempty/nospecial''",$message);
		/*if(empty($_POST['txtemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("txtemail",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['txtemail']))
		{
				exit;
				
		}
		else
		{
			
			$message = "Invalid Emails";
 			$this->Assign("txtemail",'',"noempty",$message);
		}*/
		$message = "Required Field Cannot be blank/Invalid Email";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty/emailcheck",$message);
		
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtaddr",trim($_POST['txtaddr']),"noempty",$message);
		
		$message = "Required Field Cannot be blank/ Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty/nonumber/nospecial''",$message);
		$this->Assign("txtState",trim($_POST['txtState']),"noempty/nonumber/nospecial''",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);

	
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtpwd",trim($_POST['txtpwd']),"noempty",$message);
		$this->Assign("txtrepwd",trim($_POST['txtrepwd']),"noempty",$message);
		if(trim($_POST['txtpwd']) != '' and trim($_POST['txtrepwd']) != '')
		{
			$pwdlength =strlen($_POST['txtpwd']);
			if($pwdlength<6 or $pwdlength>20)
			{
				$message = "Password minimum length is 6 & maximum length is 20";
				$this->Assign("txtpwd","","noempty",$message);
			}
			elseif(trim($_POST['txtpwd']) != trim($_POST['txtrepwd']))
			{
				$message = "Enter the Confirm Password correctly";
				$this->Assign("txtrepwd","","noempty",$message);
				
			}
		}
		
		if(trim($_POST['txtfname']) != '' and trim($_POST['txtlname']) != '' and trim($_POST['txtdisname'])!='')
		{
			$fnamelength =strlen($_POST['txtfname']);
			$lnamelength =strlen($_POST['txtlname']);
			$dislength =strlen($_POST['txtdisname']);
			if($fnamelength<3 or $fnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($lnamelength<3 or $lnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($dislength<3 or $dislength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtdisname","","noempty",$message);
			}
		}
		
		
		
		
		/*if(trim($_POST['txtemail']) != '' and trim($_POST['txtremail']) != '')
		{
			if(trim($_POST['txtemail']) != trim($_POST['txtremail']))
			{
				$message = "Enter the Confirm Email id correctly";
				$this->Assign("txtremail","","noempty",$message);
				
			}
		}*/
		
		//$message = "Please select terms";
		//$this->Assign("chkterms",trim($_POST['chkterms']),"noempty",$message);
		
		if(trim($_POST['txtdisname']) != ''&&trim($_POST['txtemail']) != '')
		{
			//$sqlselect = "select * from users_table where user_display_name='".$_POST['txtdisname']."'";
			$sqlselect = "select * from users_table where user_email='".$_POST['txtemail']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Username already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty",$message);
				}
			}
		}
		
		$this->PerformValidation('?do=addUserAccount');
	}
	/**
	 * Function checks the whether the category value  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	 
	function validateCategory()
	{
		$message = "Required Field Cannot be blank/No Special Characters Allowed";
		$this->Assign("category",trim($_POST['category']),"noempty/nospecial' _'",$message);
		//$this->Assign("category",trim($_POST['group1']),"noempty/nonumber",$message);
		$this->PerformValidation('?do=managecategory');
	}
	/**
	 * Function checks the whether the attributes value  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateAttributes()
	{
		$attrib[] = explode(" ",$_POST['attributes']);
		
		$attributes=array_merge($attrib);
		
		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		
		$this->Assign("attributes",$attributes,"noempty/nonumber/nospecial''",$message);
			
		$this->PerformValidation('?do=addattributes');
	}
	/**
	 * Function checks the whether the login process  parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */		
	function validatelogin()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("username",trim($_POST['username']),"noempty",$message);
		$this->Assign("username",trim($_POST['userpwd']),"noempty",$message);
		
		$username = $_POST['username'];
		$pswd = $_POST['userpwd'];
		$pswd  = base64_encode($pswd);
		//echo $ps= base64_decode('YWRtaW4=');
		
		if(trim($username) != '' and trim($pswd) != '')
		{
			//echo $sqlselect = "select * from admin_table where admin_name='".$username."'";
			$obj1 = new Bin_Query();
			$obj2 = new Bin_Query();
			$obj3 = new Bin_Query();
				//echo $_POST['txtpass'];exit;
				$sql = "select count(*) as temp from admin_table where admin_name='".$username."' and admin_password='".$pswd."'";
				$obj2->executeQuery($sql);
				
				if($obj2->records[0]['temp']==0)
				{
					$sqlsub = "select count(*) as temp from subadmin_table where subadmin_name='".$username."' and subadmin_password='".$pswd."'";
					$obj3->executeQuery($sqlsub);
					if($obj3->records[0]['temp']==0)
					{
						///$div="<div class='exc_msgbox'>"
						$message = "Invalid Username or Password";
						//return "Invalid Username or Password";
						$this->Assign("username",'',"noempty",$message);
					}
					else
					{
						$sqlsub = "select * from subadmin_table where subadmin_name='".$username."' and subadmin_password='".$pswd."' and subadmin_status=1";
						$obj3->executeQuery($sqlsub);
						$_SESSION['subadminId'] = $obj3->records[0]['subadmin_id'];
						$_SESSION['subadminName'] = $obj3->records[0]['subadmin_name'];
					}
				}
				else
				{
					$sql = "select * from admin_table where admin_name='".$username."' and admin_password='".$pswd."'";
					$obj2->executeQuery($sql);
					$_SESSION['adminId'] = $obj2->records[0]['admin_id'];
					$_SESSION['adminName'] = $obj2->records[0]['admin_name'];
				
				}
					
		}
		
		$this->PerformValidation("?do=adminlogin");
	}
	/**
	 * Function checks the whether the sub admin email  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */		
	function validateSubAdminEmail()
	{
	 	
		if(empty($_POST['subadminemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("subadminemail",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['subadminemail']))
		{
				
		}
		else
		{
			$message = "Invalid Emails";
 			$this->Assign("subadminemail",'',"noempty",$message);
		}
		//		$this->Assign("subadminemail",trim($_POST['subadminemail']),"noempty/emailcheck",$message);
		$message = "Required Field Cannot be blank";
		$this->Assign("subadminpassword",trim($_POST['subadminpassword']),"noempty",$message);
		$message = "Required Field Cannot be blank/Numeric Value is Not Accepted";
		$this->Assign("subadminname",trim($_POST['subadminname']),"noempty/nonumber",$message);
		$this->PerformValidation('?do=subadminmgt');
		
	}
	/**
	 * Function checks the whether the  admin email  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateAdminEmail()
	{
	 	
		if(empty($_POST['adminemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("adminemail",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['adminemail']))
		{
				
		}
		else
		{
			$message = "Please Enter Valid Email ID";
 			$this->Assign("adminemail",'',"noempty",$message);
		}

		$message = "Required Field Cannot be blank";
		$this->Assign("subadminpassword",trim($_POST['adminemail']),"noempty",$message);
		$this->PerformValidation('?do=adminlogin&action=showpage');
		
	}
	/**
	 * Function checks the whether the product entry parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	
	function validateEntry()
	{
		$message = "Select the Main Category";
		$this->Assign("selcatgory",trim($_POST['selcatgory']),"noempty",$message);
		
		$message = "Select the Sub Category";
		$this->Assign("subcat",trim($_POST['subcat']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
  	 	$this->Assign("product_title",trim($_POST['product_title']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("sku",trim($_POST['sku']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("ufile",trim($_FILES['ufile']['name'][0]),"noempty",$message);
		
		if($_POST['cse_enabled']=='on')
			{
				$message = "CSE key Cannot be blank";
				$this->Assign("csekeyid",trim($_POST['csekeyid']),"noempty",$message);
			}
		
		$pweight=trim($_POST['txtweight']);
		$pwidth=trim($_POST['txtwidth']);
		$pheight=trim($_POST['txtheight']);
		$pdepth=trim($_POST['txtdepth']);
		
		if(!empty($pweight))
		 {
		 	$message = "Only numeric values allowed/Invalid Weight";
			$this->Assign("txtweight",$pweight,"nostring/nospecial'.'",$message);
		 }
		 if(!empty($pwidth))
		 {
		 	$message = "Only numeric values allowed/Invalid Width";
			$this->Assign("txtwidth",$pwidth,"nostring/nospecial'.'",$message);
		 }
		 if(!empty($pheight))
		 {
		 	$message = "Only numeric values allowed/Invalid height";
			$this->Assign("txtheight",$pheight,"nostring/nospecial'.'",$message);
		 }
		 if(!empty($pdepth))
		 {
		 	$message = "Only numeric values allowed/Invalid depth";
			$this->Assign("txtdepth",$pdepth,"nostring/nospecial'.'",$message);
		 }
		
		if($_FILES['ufile']['name'][0]!='')
		{
			$count=count($_FILES['ufile']['type']);
			for($i=0;$i<$count;$i++)
			{
				if(!$this->validateimages($_FILES['ufile']['type'][$i]))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG,BMP";
					$this->Assign("ufile_value",'',"noempty",$message);
				}
			}
		}
		
		$price=$_POST['price'];
		$msrp=$_POST['msrp'];
		
		$shipcost=(float)$_POST['shipcost'];
		$rol=$_POST['rol'];
		$soh=$_POST['soh'];
		
		if(strlen($price)>9)
		{
	 		$message = "Maximum Price exceed ";
	   	 	$this->Assign("price",'',"noempty",$message);
		}
		else if(empty($price))
		{
			$message = "Required Field Cannot be blank";
		   	 $this->Assign("price",trim($_POST['price']),"noempty",$message);
		}
		
		if(strlen($msrp)>9)
		{
	 		$message = "Maximum Msrp exceed";
	   	 	$this->Assign("msrp",'',"noempty",$message);
		}
		/*else if(empty($msrp))
		{
			$message = "Required Field Cannot be blank";
		   	$this->Assign("msrp",trim($_POST['msrp']),"noempty",$message);
		}*/
		 
		/*if($price>$msrp)
		{
			$message = "The Price should not exceed Msrp";
	   	 	$this->Assign("msrp",'',"noempty",$message);
		}*/

		if(!$this->validateFloat($shipcost))
		{
           		$message = "Shipping Cost is in Invalid format ";
	   	 	$this->Assign("shipcost",'',"noempty",$message);		 
		}
		if($rol!='')
		{
		 
			 if(!$this->validateFloat($rol))
			 {
					 $message = "ReOrder Level is in Invalid format ";
					 $this->Assign("rol",'',"noempty",$message);		 
			 }
		 }
 		 if($soh!='')
		 {   
		   	 if(!$this->validateFloat($soh))
			 {
					 $message = "Stock on hand is in Invalid format ";
					 $this->Assign("soh",'',"noempty",$message);		 
			 }
		 }

		$this->PerformValidation('?do=productentry');
	}
	/**
	 * Function checks the whether the update product entry parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateUpdateEntry()
	{
		$id=(int)$_GET['prodid'];
		$message = "Select the Main Category";
		$this->Assign("selcatgory",trim($_POST['selcatgory']),"noempty",$message);
		
		$message = "Select the Sub Category";
		$this->Assign("subcat",trim($_POST['subcat']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
  	 	$this->Assign("product_title",trim($_POST['product_title']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("sku",trim($_POST['sku']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("ufile",trim($_FILES['ufile']['name'][0]),"noempty",$message);
		
		if($_FILES['ufile']['name'][0]!='')
		{
			$count=count($_FILES['ufile']['type']);
			for($i=0;$i<$count;$i++)
			{
				if(!$this->validateimages($_FILES['ufile']['type'][$i]))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG,BMP";
					$this->Assign("ufile_value",'',"noempty",$message);
				}
			}
		}
		
		$price=$_POST['price'];
		$msrp=$_POST['msrp'];
		
		$shipcost=$_POST['shipcost'];
		$rol=$_POST['rol'];
		$soh=$_POST['soh'];
		
		if(strlen($price)>9)
		{
	 		$message = "Maximum Price exceed ";
	   	 	$this->Assign("price",'',"noempty",$message);
		}
		else if(empty($price))
		{
			$message = "Required Field Cannot be blank";
		   	 $this->Assign("price",trim($_POST['price']),"noempty",$message);
		}
		
		if(strlen($msrp)>9)
		{
	 		$message = "Maximum Msrp exceed";
	   	 	$this->Assign("msrp",'',"noempty",$message);
		}
		/*else if(empty($msrp))
		{
			$message = "Required Field Cannot be blank";
		   	$this->Assign("msrp",trim($_POST['msrp']),"noempty",$message);
		}*/
		 
		/*if($price>$msrp)
		{
			$message = "The Price should not exceed Msrp";
	   	 	$this->Assign("msrp",'',"noempty",$message);
		}*/

		if(!$this->validateFloat($shipcost))
		{
           		$message = "Shipping Cost is in Invalid format ";
	   	 	$this->Assign("shipcost",'',"noempty",$message);		 
		}
		if($rol!='')
		{
		 
			 if(!$this->validateFloat($rol))
			 {
					 $message = "ReOrder Level is in Invalid format ";
					 $this->Assign("rol",'',"noempty",$message);		 
			 }
		 }
 		 if($soh!='')
		 {   
		   	 if(!$this->validateFloat($soh))
			 {
					 $message = "Stock on hand is in Invalid format ";
					 $this->Assign("soh",'',"noempty",$message);		 
			 }
		 }

		$this->PerformValidation('?do=manageproducts&action=editprod&prodid='.$id);
	}
	/**
	 * Function checks the email
	 * @param string $email		 
	 *
	 * @return bool 
	 */	
	function validateEmailAddress($email) 
	{
		// First, we check that there's one @ symbol, and that the lengths are right
	    	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
		{
    		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			///echo 'it has more @values ';
			    return false;
		}
    		// Split it into sections to make life easier
	    	$email_array = explode("@", $email);
    		$local_array = explode(".", $email_array[0]);
	   	 for ($i = 0; $i < sizeof($local_array); $i++) 
		{
   			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
			{
			   return false;
   			}
			
			
   		}
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) 
			{
			return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) 
			{
				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
					return false;
					}
			}
	 	}
   		return true;
   	}
  	 /**
	 * Function checks the float values
	 * @param mixed $number	 
	 *
	 * @return bool 
	 */	
	function validateFloat($number)
	{
		$regex = "/^[0-9]+(?:\.[0-9]{2})?$/";
		if (preg_match($regex, $number)) {
			return true;
		}else{
			return false;
		}
	}  
 	/**
	 * Function checks the images 
	 * @param mixed $val		 
	 *
	 * @return bool 
	 */	
	function validateimages($val)
   	{
		if($val=='image/jpeg' || $val=='image/gif' || $val=='image/png' || $val=='image/x-png' || $val=='image/bmp' || $val=='image/pjpeg')
			return true;
		else
			return false;
   	 }
    /**
	 * Function checks the whether the region wise tax parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateRegionwisetaxEntry()
	{
	 	
		if(empty($_POST['taxratename']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratename",'',"noempty",$message);
		}
		if(empty($_POST['taxratebasedon']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratebasedon",'',"noempty",$message);
		}
		if(empty($_POST['taxratecountry']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratecountry",'',"noempty",$message);
		}
		if(empty($_POST['taxaddress']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxaddress",'',"noempty",$message);
		}
		if(empty($_POST['taxratepercent']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratepercent",'',"noempty",$message);
		}
		if(!empty($_POST['taxratepercent']))
		{
		    $message = "Numeric only";
			$this->Assign("taxratepercent",$_POST['taxratepercent'],"nostring",$message);
		}
		$this->PerformValidation('?do=taxsettings&action=addregionwisetax');
	}
	/**
	 * Function checks the whether the region wise edit tax parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateRegionwisetaxEdit()
	{
	 	
		if(empty($_POST['taxratename']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratename",'',"noempty",$message);
		}
		if(empty($_POST['taxratebasedon']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratebasedon",'',"noempty",$message);
		}
		if(empty($_POST['taxratecountry']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratecountry",'',"noempty",$message);
		}
		if(empty($_POST['taxaddress']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxaddress",'',"noempty",$message);
		}
		if(empty($_POST['taxratepercent']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("taxratepercent",'',"noempty",$message);
		}
		if(!empty($_POST['taxratepercent']))
		{
		    $message = "Numeric only";
			$this->Assign("taxratepercent",$_POST['taxratepercent'],"nostring",$message);
		}
		if(!empty($_POST['taxid'])&&$_POST['taxid']>0)
		{
		   unset($_SESSION['edittaxid']);
		   $_SESSION['edittaxid']=$_POST['taxid'];
		}
		$this->PerformValidation('?do=taxsettings&action=editregionwisetax');
	}
	/**
	 * Function checks the whether the  currency parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateCurrency()
	{
	 	
		    $message = "Required Field Cannot be blank";
			$this->Assign("currency_name",$_POST['currency_name'],"noempty",$message);
		    $message = "Required Field Cannot be blank";
			$this->Assign("currency_code",$_POST['currency_code'],"noempty",$message);
		    $message = "Required Field Cannot be blank";
			$this->Assign("currency_tocken",$_POST['currency_tocken'],"noempty",$message);
		   $message = "Required Field Cannot be blank";
			$this->Assign("conversion_rate",$_POST['conversion_rate'],"noempty",$message);
		    $curr_rate=trim($_POST['conversion_rate']);
			$curr_code=trim($_POST['currency_code']);
			$country_code=trim($_POST['taxratecountry']);
			if($curr_rate<=0&&is_numeric($curr_rate))
			{
				$message = "Conversion rate should be greater than 0";
				$this->Assign("conversion_rate",'',"noempty",$message);
			}
			$obj1 = new Bin_Query();
			$sql="select count(*)as numcurrency from currency_master_table where currency_code='$curr_code' and country_code='$country_code'";
			$obj1->executeQuery($sql);
			if($obj1->records[0]['numcurrency']>0)
			{
				$message = "Currency code and Country is already set.";
				$this->Assign("currency_code",'',"noempty",$message);		
			}
			/*$obj2 = new Bin_Query();
			$sql="select count(*)as numcountry from currency_master_table where country_code='$country_code'";
			$obj2->executeQuery($sql);
			if($obj2->records[0]['numcountry']>0)
			{
				$message = "Country code is already set.";
				$this->Assign("taxratecountry",'',"noempty",$message);		
			}*/
			
		$this->PerformValidation('?do=showaddcurrency');
	}
	/**
	 * Function checks the whether the edit currency parameter  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateEditCurrency()
	{
			$curr_rate=trim($_POST['conversion_rate']);
	 		$currid=trim($_POST['hidecurrencyid']);
			if($currid==1||$currid=='1')
			{
				$message = "Required Field Cannot be blank";
				$this->Assign("conversion_rate",$_POST['conversion_rate'],"noempty",$message);	
				if($curr_rate<=0&&is_numeric($curr_rate))
				{
					$message = "Conversion rate should be greater than 0";
					$this->Assign("conversion_rate",'',"noempty",$message);
				}
			}
			else
			{
				$message = "Required Field Cannot be blank";
				$this->Assign("currency_name",$_POST['currency_name'],"noempty",$message);
				$message = "Required Field Cannot be blank";
				$this->Assign("currency_code",$_POST['currency_code'],"noempty",$message);
				$message = "Required Field Cannot be blank";
				$this->Assign("currency_tocken",$_POST['currency_tocken'],"noempty",$message);
				$message = "Required Field Cannot be blank";
				$this->Assign("conversion_rate",$_POST['conversion_rate'],"noempty",$message);
				$curr_code=trim($_POST['currency_code']);
				$country_code=trim($_POST['taxratecountry']);
				if($curr_rate<=0&&is_numeric($curr_rate))
				{
					$message = "Conversion rate should be greater than 0";
					$this->Assign("conversion_rate",'',"noempty",$message);
				}
				$obj1 = new Bin_Query();
				$sql="select count(*)as numcurrency from currency_master_table where currency_code='$curr_code' and country_code='$country_code' and id<>$currid";
				$obj1->executeQuery($sql);
				if($obj1->records[0]['numcurrency']>0)
				{
					$message = "Currency code and Country is already set.";
					$this->Assign("currency_code",'',"noempty",$message);		
				}
				/*$obj2 = new Bin_Query();
				$sql="select count(*)as numcountry from currency_master_table where country_code='$country_code' and id<>$currid";
				$obj2->executeQuery($sql);
				if($obj2->records[0]['numcountry']>0)
				{
					$message = "Country code is already set.";
					$this->Assign("taxratecountry",'',"noempty",$message);		
				}*/
			}
		$this->PerformValidation('?do=editcurrency&cid='.$_POST['hidecurrencyid']);
	}
}
?>