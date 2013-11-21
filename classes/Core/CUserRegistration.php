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
 * User registration  related  class
 *
 * @package   		Core_CUserRegistration
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserRegistration
{
	/**
	 * This function is used to insert  the  user account form registeration page 
	 *
	 * .
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
		$newsletter = $_POST['chknewsletter'];
		$date = date('Y-m-d');
		
		//address details
		$address= $_POST['txtaddr'];
		$city= $_POST['txtcity'];
		$state= $_POST['txtState'];
		$zipcode= $_POST['txtzipcode'];
		$country= $_POST['selCountry'];
		
		if($newsletter == '')
			$newsletter = 0;
			
		if(count($Err->messages) > 0)
		{
			 $output['val'] = $Err->values;
			 $output['msg'] = $Err->messages;
		}
		
		else
		{
			if( $displayname!= '' and $firstname  != '' and $lastname != '' and $email != '' and $pswd != '')
			{
				$characters='8';	
				$possible = '1234567890';
					$code = '';
					$i = 0;
					while ($i < $characters) {
						$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
						$i++;
			
					}

				$pswd=md5($pswd);
				$sql = "insert into users_table (user_display_name,user_fname,user_lname,user_email,user_pwd,user_status,user_doj,user_country,ipaddress,user_group,confirmation_code) values('".$displayname."','".$firstname."','".$lastname."','".$email."','".$pswd."',0,'".$date."','".$country."','".$_SERVER['REMOTE_ADDR']."','1','".$code."')";
				$obj = new Bin_Query();
				if($obj->updateQuery($sql))
				{
		
				
				//add address detail in address book
				$sq="select user_id from users_table where user_email='$email' and user_pwd='$pswd'";
				$qry1=new Bin_Query();
				$qry1->executeQuery($sq);
				if(count($qry1->records)>0)
				{
					$newuserid=$qry1->records[0]['user_id'];
					$adrsql="insert into addressbook_table(user_id,contact_name,first_name,last_name,company,email,address,city,suburb,state,country,zip,phone_no,fax) values($newuserid,'Primary','$firstname','$lastname','','$email','$address','$city','','$state','$country','$zipcode','','')";
					$qry1->updateQuery($adrsql);
				
					$sql = "insert into newsletter_subscription_table(email,status)values('".$email."',".$newsletter.")";
					if($obj->updateQuery($sql))
					{
	
						$result = '<div class="alert alert-success">
						<button data-dismiss="alert" class="close" type="button">×</button>
						'.Core_CLanguage::_(REGISTER_SUCCESS).'
						</div>';

						//admin details
						$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
						$objlogo=new Bin_Query();
						$objlogo->executeQuery($sqllogo);
						$site_logo=$objlogo->records[0]['site_logo'];			
						$site_title=$objlogo->records[0]['site_moto'];			
						$admin_email=$objlogo->records[0]['admin_email'];


						//select mail setting
						$sqlMail="SELECT * FROM mail_messages_table WHERE mail_msg_id=1 AND mail_user='0'";
						$objMail=new Bin_Query();
						$objMail->executeQuery($sqlMail);
						$message=$objMail->records[0]['mail_msg'];
						$title=$objMail->records[0]['mail_msg_title'];
						$subject=$objMail->records[0]['mail_msg_subject'];

						$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
						$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
						$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
						
						$site_logo=$site.'/'.$site_logo;
						$link = $site.'/?do=registerconfirm&confirm_code='.$code;
						$confirm_link = '<p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;">Click the following link to active your account</p><a href="'.$link.'">'.$link.'</a>';
						$site_logo	=$site_logo;

						$message = str_replace("[title]",$site_title,$message);
						$message = str_replace("[logo]",$site_logo,$message);
						$message = str_replace("[firstname]",$firstname,$message);
						$message = str_replace("[lastname]",$lastname,$message);
						$message = str_replace("[confirm_link]",$confirm_link,$message);
					
						$message = str_replace("[user_name]",$email,$message);		$message = str_replace("[password]",$_POST['txtpwd'],$message);	$message = str_replace("[site_email]",$admin_email,$message);	
				
			
						Core_CUserRegistration::sendingMail($email,$title,$message);
					}
					else
						$result ='<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.Core_CLanguage::_(ACCOUNT_NOT_CREATED).'
							</div>';


					
					
				}else
					$result = '<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.Core_CLanguage::_(ACCOUNT_NOT_CREATED).'
							</div>';
			}
			else
				$result = '<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.Core_CLanguage::_(ACCOUNT_NOT_CREATED).'
							</div>';
			}
		}
		return $result;
  	}


	/**
	* This function is used to confirm the user in db
 	*
 	* @return string
	*/
	function registerConfirm()
	{
		$sql="SELECT * FROM users_table WHERE confirmation_code='".$_GET['confirm_code']."' ";
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$user_id=$obj->records[0]['user_id'];
			$sqlupdate="UPDATE users_table SET user_status='1' WHERE user_id='".$user_id."'";
			$objupdate=new Bin_Query();
			if($objupdate->updateQuery($sqlupdate))
			{

				$_SESSION['success_msg']='<div class="alert alert-success">
							<button data-dismiss="alert" class="close" type="button">×</button>
							User has been confirmed
							</div>';


				//admin details
					$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
					$objlogo=new Bin_Query();
					$objlogo->executeQuery($sqllogo);
					$site_logo=$objlogo->records[0]['site_logo'];			
					$site_title=$objlogo->records[0]['site_moto'];			
					$email=$objlogo->records[0]['admin_email'];


					//select mail setting
					$sqlMail="SELECT * FROM mail_messages_table WHERE mail_msg_id=3 AND mail_user='0'";
					$objMail=new Bin_Query();
					$objMail->executeQuery($sqlMail);
					$message=$objMail->records[0]['mail_msg'];
					$title=$objMail->records[0]['mail_msg_title'];
					$subject=$objMail->records[0]['mail_msg_subject'];

					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
					$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
					$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
					
					$site_logo=$site.'/'.$site_logo;
					
					$site_logo	=$site_logo;

					$message = str_replace("[title]",$site_title,$message);
					$message = str_replace("[logo]",$site_logo,$message);
					$message = str_replace("[site_email]",$admin_email,$message);	
			

				Core_CUserRegistration::sendingMail($email,$title,$message);


				header('Location:?do=login');

			}
		}
		else
		{

			$_SESSION['success_msg']='<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Invalid User!
							</div>';
			header('Location:?do=login');
		}

			

	}
  	 /**
	 * This function is used to get  the  user inforamtion 
	 *
	 * .
	 * 
	 * @return array 
	 */
  	function showMyProfile()
   	{
   		$sqlselect = "SELECT b.user_id, b.user_fname, b.user_lname, b.user_email,b.user_display_name,b.user_pwd,a.subsciption_id 
		FROM users_table b inner join newsletter_subscription_table a on a.email = b.user_email WHERE b.user_id =".$_SESSION['user_id'];

		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		{
			$pwd = md5($obj->records[0]['user_pwd']);
			$output['displayname'] =$obj->records[0]['user_display_name'] ;
			$output['firstname'] =$obj->records[0]['user_fname'] ;
			$output['lastname'] =$obj->records[0]['user_lname'] ;
			$output['email'] = $obj->records[0]['user_email'];
			$output['passwd'] =$pwd;
			$output['cpasswd'] =$pwd;
			$output['newslettersubid'] = $obj->records[0]['subsciption_id'];
					
		}
		return $output;
  	}
      	/**
	 * This function is used to update  the  user inforamtion 
	 *
	 * .
	 * 
	 * @return string
	 */
   
  	function updateMyProfile()
   	{
   		$userid =$_SESSION['user_id'];
   		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$email=$_POST['email'];
		$pwd=$_POST['passwd'];
		$pwd = md5($pwd);
		$newsletter =$_POST['newsletterSubscribeY'];
		$newslettersubid =$_POST['newslettersubid'];
		
		$sql = "update users_table set user_fname='".$fname."',user_lname='".$lname."',user_email='".$email."',user_pwd='".$pwd."' where user_id=".$userid;
		$obj = new Bin_Query();	
		if($obj->updateQuery($sql))
		{
			$sql = "update newsletter_subscription_table set email='".$email."',status='".$newsletter."' where subsciption_id =".
			$newslettersubid;
			if($obj->updateQuery($sql))
				$output ='<div class="success_msgbox">User Profile Updated</div><br/>';
			else
				$output='<div class="exc_msgbox">User Profile Not Updated</div><br/>';
		}
		else
			$output='<div class="exc_msgbox">User Profile Not Updated</div><br/>';
		return $output;
	}
   
   	/**
	 * This function is used to get  the  user password
	 *
	 * .
	 * 
	 * @return string
	 */
  	function getPassword()
	{

		if($_POST['email']=='')
		{
			$result = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				
				'.Core_CLanguage::_(PLEASE_ENTER_EMAIL_ADDRESS).'
				</div>';
		}
		$email =$_POST['email'];
		if($email != '')
		{
			$sql = "select user_pwd from users_table where user_email ='".$email."'";
			
			$obj = new Bin_Query();
			
			if($obj->executeQuery($sql))
			{
				$user_id=$obj->records[0]['user_id'];
				$firstname=$obj->records[0]['user_fname'];
				$lastname=$obj->records[0]['user_lname'];
				$characters='8';	
				$possible = '1234567890';
					$password = '';
					$i = 0;
					while ($i < $characters) {
						$password .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
						$i++;
			
					}

			
				$sqlUpdate="UPDATE  users_table SET user_pwd='".md5($password)."' WHERE user_id='".$user_id."'";	
				$objUpdate=new Bin_Query();
				$objUpdate->updateQuery($sqlUpdate);	
				

				//admin details
					$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
					$objlogo=new Bin_Query();
					$objlogo->executeQuery($sqllogo);
					$site_logo=$objlogo->records[0]['site_logo'];			
					$site_title=$objlogo->records[0]['site_moto'];			
					$admin_email=$objlogo->records[0]['admin_email'];


					//select mail setting
					$sqlMail="SELECT * FROM mail_messages_table WHERE mail_msg_id=2 AND mail_user='0'";
					$objMail=new Bin_Query();
					$objMail->executeQuery($sqlMail);
					$message=$objMail->records[0]['mail_msg'];
					$title=$objMail->records[0]['mail_msg_title'];
					$subject=$objMail->records[0]['mail_msg_subject'];

					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
					$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
					$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
					

					 $logo=$site.'/'.$site_logo;
				


				$message = str_replace("[title]",$site_title,$message);
				$message = str_replace("[logo]",$logo,$message);
				$message = str_replace("[firstname]",$firstname,$message);
				$message = str_replace("[lastname]",$lastname,$message);
				$message = str_replace("[confirm_link]",$confirm_link,$message);
			
				$message = str_replace("[user_name]",$email,$message);		
				$message = str_replace("[password]",$password,$message);	
				$message = str_replace("[site_email]",$admin_email,$message);	

				
				Core_CUserRegistration::sendingMail($email,$title,$message);
				$result = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
					
				'.Core_CLanguage::_(PASSWORD_HAS_BEEN_SENT_TO_YOUR_MAIL_SUCCESSFULLY).'

				</div>';
				
			}
			else
			{
				$result = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(INVALID_USER).'

				</div>';
				
			}
		}
		return $result;
	}
	/**
	 * This function is used to send  the  user password recovery
	 * @param string  $to_mail
	 * @param string  $title
	 * @param string  $mail_content
	 * 
	 * @return string
	 */
	
	function sendingMail($to_mail,$title,$mail_content)
	{
		$sql = "select set_id,admin_email from admin_settings_table where set_id='1'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['admin_email']; 
			include('classes/Lib/Mail.php');
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo($from);
			$mail->To($to_mail); 
			$mail->Subject($title);
			$mail->Body($mail_content);
		
			$mail->Send();
		}
		else
			return 	Core_CLanguage::_(NO_MAIL_ID_PROVIDED);
	}
	/**
	 * This function is used to get  the  user login status
	 *
	 * .
	 * 
	 * @return string data
	 */
	function loginStatus()
	{
			//language	
		include_once('classes/Core/CLanguage.php');
		
		include_once('classes/Core/CHitCounter.php');
					
		$str='';  $salute='';
		if($_SESSION['user_id']!='')
		{
		
			$str=Core_CLanguage::_('LOGOUT');
			$output['logout']='<a href="'.$_SESSION['base_url'].'/logout.html">'.$str.'</a>';
			$output['username']=Core_CLanguage::_('WELCOME').$_SESSION['user_name'];
			$output['user']=$_SESSION['user_name'];			
		}
		else
		{
			$str=Core_CLanguage::_('LOGIN');
			$output['logout']='<a href="'.$_SESSION['base_url'].'/login.html">'.$str.'</a>';
			$output['username']=Core_CLanguage::_('WELCOME').Core_CLanguage::_('GUEST');
			$output['user']='Guest';						
		}
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['adSense'] = Core_CUserRegistration::adSense();
		$output['CustomHeader'] = Core_CUserRegistration::getCustomHeader();
		//Core_CRss::showRss();
		
		//set HitCounter
		Core_CHitCounter::setCount();
		
		
		$output['hitCounter'] = Core_CHitCounter::showCount();
		
		return $output;
	}
	/**
	 * This function is used to logout  
	 *
	 * .
	 * 
	 * @return  string
	 */
	function logoutStatus()
	{
		session_destroy();
		$output=Core_CUserRegistration::loginStatus();
		return $output;
	}
	/**
	 * This function is used to get header menu from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function showHeaderMenu()
	{
	
	    $query = new Bin_Query(); 
		
		$sql = "SELECT * FROM `category_table` WHERE category_parent_id =0 AND category_status =1 AND category_name!='Gift Voucher' ";
		if($query->executeQuery($sql))
		{
			$output = Display_DUserRegistration::showHeaderMenu($query->records);
		}
		else
			$output='';
		return $output;
	}
	/**
	 * This function is used to get header hidden  menu from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function showHeaderMenuHidden()
	{
		$query = new Bin_Query(); 
		
		$sql = "SELECT * FROM `category_table` WHERE category_parent_id =0 AND category_status =1 AND  category_name!='Gift Voucher'  ";
		if($query->executeQuery($sql))
		{
			$output = Display_DUserRegistration::showHeaderMenuHidden($query->records);
		}
		else
			$output='';
		return $output;

	}
	/**
	 * This function is used to get header text from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function showHeaderText()
	{
    		$query = new Bin_Query();		
		$sql="select set_value from admin_settings_table where set_name = 'Custom Header'";
		if($query->executeQuery($sql))
		{
			$output =Display_DUserRegistration::showHeaderText($query->records);
		}
		else
			$output='No Header Text';
		
		return $output;
	}
	/**
	 * This function is used to insert news letter subscription  
	 *
	 * .
	 * 
	 * @return string
	 */
	function addNewsletterSubscription()
	{
		$email = $_POST['email'];
		
		if($_POST['email']=='' || $_POST['email']=='Your Email')
		{
			$output='<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>
			'.Core_CLanguage::_(REQUIRED).'
			</div>';
			return $output;
		
		}			
		elseif($_POST['email']!='')
		{

			$query = new Bin_Query();
			$sql='select count(*) as count from newsletter_subscription_table where email="'.$email.'"';
			$query->executequery($sql);
			if($query->records[0]['count'] > 0)
			{
				$output='<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(SCBSCRIBE_NEWS_LETTER_ALREADY_EMAIL_EXISTS).'
				</div>';
	
				return $output;
				
			}
			$checkemail=Core_CUserRegistration::validateEmailAddress($email);
		
			if($checkemail)
			{
			
				$sql = "insert into newsletter_subscription_table(email,status) values('".$email."',1)";
				if($query->updateQuery($sql))
				{
					$output='<div class="alert alert-success">
					<button data-dismiss="alert" class="close" type="button">×</button>
					'.Core_CLanguage::_(YOUR_REQUEST_FOR_NEWLETTER_ADDED).'
					</div>';
					return $output;
	
				}			
				else
				{
					$output='<div class="alert alert-error">
					<button data-dismiss="alert" class="close" type="button">×</button>
					'.Core_CLanguage::_(INVALID_EMAIL_FOR_NEWSLETTER).'
					</div>';
					return $output;
	
				}
			
			}
			elseif(!$checkemail)
			{
					$output='<div class="alert alert-error">
					<button data-dismiss="alert" class="close" type="button">×</button>
					'.Core_CLanguage::_(INVALID_EMAIL_FOR_NEWSLETTER).'
					</div>'; 
					return $output;
			}
			
		}
	}
	/**
	 * This function is used for validate mail id
	 * @param string $email
	 * 
	 * @return string
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
	 * This function is used to get sub header menu from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function showSubHeaderMenu()
	{
		$id=$_GET['maincatid'];
	    	$query = new Bin_Query(); 
		$sql = "SELECT category_name, category_id FROM `category_table` WHERE category_parent_id ='$id' AND category_status =1 order by category_name limit 16";
		if($query->executeQuery($sql))
		{
		
			$output = Display_DUserRegistration::showSubHeaderMenu($query->records);
		}
		else
			$output='<ul class="categoriesList"><li>No Category Found</li></ul>';
		
		return $output;
	}
	/**
	 * This function is used to get  header main menu from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function showHeaderMainMenu()
	{
		if($_GET['do']=='dynamiccms')
		{
			$query = new Bin_Query(); 
			$sql = "SELECT * from cms_table WHERE cms_page_status=1";
			if($query->executeQuery($sql))
			{
				$output = Display_DUserRegistration::showDynamicCms($query->records);
			}			
			
		}
		else
		{	
			$query = new Bin_Query(); 
			$sql = "SELECT * from custompage_table where status=1";
			if($query->executeQuery($sql))
			{
				$output = Display_DUserRegistration::showHeaderMainMenu($query->records);
			}


		}

		return $output;
	}
	/**
	 * This function is used to get  google adsense code from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function adSense()
	{
		$query = new Bin_Query(); 
		$sql = "SELECT set_value from admin_settings_table where set_name='Google AdSense code'";
		$query->executeQuery($sql);
		$output = $query->records[0]['set_value'];
		return $output;
	}
	/**
	 * This function is used to get  custom header  from db  
	 *
	 * .
	 * 
	 * @return string
	 */
	function getCustomHeader()
	{
		$query = new Bin_Query(); 
		$sql = "SELECT set_id,customer_header from admin_settings_table where  set_id='1'";
		$query->executeQuery($sql);
		$output = $query->records[0]['customer_header'];
	
		if($output!='')
		return '<div class="flash_News">'.$output.'</div>';
	}
	/**
	 * This function is used to get  contry list from db  
	 * @param array $arr
	 * .
	 * 
	 * @return array
	 */
	function getCountry($arr)
	{
		$query = new Bin_Query(); 
		$sql = "SELECT * from country_table order by cou_name";
		$query->executeQuery($sql);
		include_once('classes/Display/DUserRegistration.php');
		$arr['selCountry']=Display_DUserRegistration::dispCountry($query->records);
		return $arr;
	}
	/**
	 * This function is used to select the slide show image from db
	 *
	 * 
	 * 
	 * @return string
	 */
	function viewSlideShow()
	{
		$obj=new Bin_Query();
		$sql="SELECT * FROM home_slide_show_table";
		$obj->executeQuery($sql);
		$records=$obj->records;

		return Display_DUserRegistration::viewSlideShow($records);
	}
	/**
	 * This function is used to select the slide show parameter from db
	 *
	 * 
	 * 
	 * @return array
	 */
	function getSlideShowParameter()
	{
		$obj=new Bin_Query();
		$sql="SELECT * FROM home_slide_parameter_table";
		$obj->executeQuery($sql);
		$records=$obj->records[0];

		$output=json_decode($records['parameter']);

		 return $output;

	}
	/**
	 * This function is used to select the  show curreny drop down  from db
	 *
	 * 
	 * 
	 * @return string
	 */
	function showCurrencySettings()
	{
		$sql="SELECT * FROM  currency_master_table WHERE status=1";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;
		return Display_DUserRegistration::showCurrencySettings($records);
	}
	/**
	 * This function is used to insert into db the user  from facebook
	 * @param array $me
	 * 
	 * 
	 * @return bool
	 */
	 function autoRegister($me)
    	 {

		$db = file_get_contents('../../../Bin/Configuration.php');
		$exp_db = array();
		$exp_db = explode('\'',$db);
	
		$hostname = $exp_db[1];
		$username = $exp_db[3];
		$password = $exp_db[5];
		$database = $exp_db[7];
	
		$connect = mysql_connect($hostname,$username,$password) or die(mysql_error());
		mysql_select_db($database,$connect) or die(mysql_error());
	
		// logo selection
		$sqlSite = "SELECT * FROM admin_settings_table WHERE set_id=3 ";
		$querySite = mysql_query($sqlSite);
		$recordSite = mysql_fetch_assoc($querySite);
		
		//domain selection
		$sqldomain= "SELECT * FROM admin_settings_table WHERE set_id=16 ";
		$querydomain = mysql_query($sqldomain);
		$recorddomain = mysql_fetch_assoc($querydomain);
	
		$domain = $recorddomain['set_name'];
		$logo = str_replace('index.php','',$domain).$recordSite['set_name'];


		//footer selection
		$sqlfoot="SELECT * FROM footer_settings_table WHERE id=1";
		$queryfoot = mysql_query($sqlfoot);
		$recordfoot = mysql_fetch_assoc($queryfoot);
		$footer = $recordfoot['footercontent'];
	
		//text message format for email
		$sqlMail = "SELECT * FROM mail_messages_table WHERE mail_msg_id='5'";
		$queryMail = mysql_query($sqlMail);
		$recordMail = mysql_fetch_assoc($queryMail);
		$messageFormat = $recordMail['text_facebookregister'];


		// admin email selection
		$sqladmin = "SELECT * FROM admin_settings_table WHERE set_id=14";
		$queryadmin = mysql_query($sqladmin);
		$recordadmin = mysql_fetch_assoc($queryadmin);
		$adminMail = $recordadmin['admin_mailid'];

	
		$fb_id = mysql_escape_string(trim($me['id']));
		$firstname = mysql_escape_string(trim($me['first_name']));
		$lastname = mysql_escape_string(trim($me['last_name']));
		$birthday = mysql_escape_string(trim($me['birthday']));
		$username= mysql_escape_string(trim($me['username']));
		$email = mysql_escape_string(trim($me['email']));
	
		/** AUTO PASSWORD GENERATION */
	
		$chars = "0123456789abcedefghijklmnopqrstuvwxyz";
		$i = 0;
		$password = '' ;
	
		while ($i <= 7) 
		{
		$num = rand() % 35;
		$tmp = substr($chars,$num,1);
		$password = $password . $tmp;
		$i++;
		}
		
		if($birthday != '')
		{
		$date_array = array();
		$date_array = explode("/",$birthday);
		$dob = $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
		}
		else
		$dob = '';
	
		
		if($email != '')
		{
			$sqlCheck = "SELECT * FROM users_table WHERE user_email = '".$email."'"; 
			$queryCheck = mysql_query($sqlCheck);
			$recordCheck = mysql_fetch_assoc($queryCheck);
			
			if($recordCheck['user_id'] == '')
			{
				
				 $sqlUser = "INSERT INTO users_table (user_fname,user_lname,user_display_name 	,user_email,user_pwd,ipaddress,user_doj,user_status,social_link_id,is_from_social_link) VALUES ('".$firstname."','".$lastname."','".$username."','".$email."','".base64_encode($password)."','".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d")."','1', '".$fb_id."','1')";
				$queryUser = mysql_query($sqlUser);
				
				$user_id = mysql_insert_id();
				
				//Mail for Registration using facebook
				
				$subject = "Your Account has been Registered successfully";
				$headers  = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:".$adminMail."";
				
				$arr1 = array("[firstname]","[lastname]","[domainname]");
				$arr2   = array($firstname,$lastname,$_SERVER['HTTP_HOST']);
				$mailContent = str_replace($arr1,$arr2,$messageFormat); 
				
				$content = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:10px solid #e8e8e8;">
				<tr>
					<td  style="border:1px solid #fff; background-color:#f6f6f6;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td style="border-bottom:2px solid #000; background-color:#869cc7; font-family:Tahoma, Arial, Verdana; font-size:20px; color:#FFFFFF; padding:15px;">You Are Successfully Registered</td>
					</tr>
					<tr>
					<td style="padding:15px; font-family:Tahoma, Arial,Verdana; font-size:12px;">'.$mailContent.'</td>
					</tr>
					<tr>
					<td style="background-color:#e8e8e8; border-top:1px solid #c5c5c5; padding:15px; font-family:Tahoma, Arial, Verdana; font-size:12px; color:#797979;">'.$footer.'</td>
					</tr>
					</table></td>
			
				</tr>
				</table></td>
				</tr>
				</table>'; 
				
				
				mail($email,$subject,$content,$headers);

				$_SESSION['user_id'] =$user_id;
				$_SESSION['user_name'] =$firstname;
				$_SESSION['user_email'] = $email;
				
			}
			else
			{
				$_SESSION['user_id'] =$recordCheck['user_id'];
				$_SESSION['user_name'] =$recordCheck['user_display_name'];
				$_SESSION['user_email'] = $recordCheck['user_email'];
						
			}
		}
	
	
		return true;
   	}
   	/**
	 * This function is used to insert into db the user  from facebook
	 * @param array $me
	 *  @param array $sess
	 * 
	 * @return bool
	 */
	 function twitterRegister($me,$sess)
    	 {

		// logo selection
		$sqlSite = "SELECT * FROM admin_settings_table WHERE set_id=3 ";
		$querySite = new Bin_Query($sqlSite);
		$querySite->executeQuery($sqlSite);
		$recordSite = $querySite->records[0];

		//domain selection
		$sqldomain= "SELECT * FROM admin_settings_table WHERE set_id=16 ";
		$querydomain = new Bin_Query();
		$querydomain->executeQuery($sqldomain);
		$recorddomain = $querydomain->records[0];
	
		$domain = $recorddomain['set_name'];
		$logo = str_replace('index.php','',$domain).$recordSite['set_name'];


		//footer selection
		$sqlfoot="SELECT * FROM footer_settings_table WHERE id=1";
		$queryfoot = new Bin_Query();
		$queryfoot->executeQuery($sqlfoot);
		$recordfoot = $queryfoot->records[0];
		$footer = $recordfoot['footercontent'];
	
		//text message format for email
		$sqlMail = "SELECT * FROM mail_messages_table WHERE mail_msg_id='5'";
		$queryMail =  new Bin_Query();
		$queryMail->executeQuery($sqlMail);
		$recordMail = $queryMail->records[0];
		$messageFormat = $recordMail['text_facebookregister'];


		// admin email selection
		$sqladmin = "SELECT * FROM admin_settings_table WHERE set_id=14";
		$queryadmin =new Bin_Query();
		$queryadmin->executeQuery($sqladmin);
		$recordadmin = $queryadmin->records[0];
		$adminMail = $recordadmin['admin_mailid'];

	
		$firstname = $sess;
          	$email = $me; 
	
		/** AUTO PASSWORD GENERATION */
	
		$chars = "0123456789abcedefghijklmnopqrstuvwxyz";
		$i = 0;
		$password = '' ;
	
		while ($i <= 7) 
		{
		$num = rand() % 35;
		$tmp = substr($chars,$num,1);
		$password = $password . $tmp;
		$i++;
		}
		
		if($birthday != '')
		{
		$date_array = array();
		$date_array = explode("/",$birthday);
		$dob = $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
		}
		else
		$dob = '';
	
		
		if($email != '')
		{
			$sqlCheck = "SELECT * FROM users_table WHERE user_email = '".$email."'";
			$queryCheck = new Bin_Query();
			$queryCheck->executeQuery($sqlCheck);
			$recordCheck = $queryCheck->records[0];
			
			if($recordCheck['user_id'] == '')
			{
				

				 $sqlUser ="INSERT INTO users_table(user_fname,user_lname,user_display_name,user_email,user_pwd,user_doj,user_status,is_from_social_link) VALUES('".$firstname."','".$firstname."','".$firstname."','".$email."','".base64_encode($password)."','".date("Y-m-d")."','1','2')"; 

				$queryUser = new Bin_Query();
				$queryUser->executeQuery($sqlUser);
				
				$user_id = mysql_insert_id();
				
				//Mail for Registration using facebook
				
				$subject = "Your Account has been Registered successfully";
				$headers  = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:".$adminMail."";
				
				$arr1 = array("[firstname]","[lastname]","[domainname]");
				$arr2   = array($firstname,$lastname,$_SERVER['HTTP_HOST']);
				$mailContent = str_replace($arr1,$arr2,$messageFormat); 
				
				$content = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:10px solid #e8e8e8;">
				<tr>
					<td  style="border:1px solid #fff; background-color:#f6f6f6;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td style="border-bottom:2px solid #000; background-color:#869cc7; font-family:Tahoma, Arial, Verdana; font-size:20px; color:#FFFFFF; padding:15px;">You Are Successfully Registered</td>
					</tr>
					<tr>
					<td style="padding:15px; font-family:Tahoma, Arial,Verdana; font-size:12px;">'.$mailContent.'</td>
					</tr>
					<tr>
					<td style="background-color:#e8e8e8; border-top:1px solid #c5c5c5; padding:15px; font-family:Tahoma, Arial, Verdana; font-size:12px; color:#797979;">'.$footer.'</td>
					</tr>
					</table></td>
			
				</tr>
				</table></td>
				</tr>
				</table>'; 
				
				
				mail($email,$subject,$content,$headers);

				$_SESSION['user_id'] =$user_id;
				$_SESSION['user_name'] =$firstname;
				$_SESSION['user_email'] = $email;
				
			}
			else
			{

				$_SESSION['user_id'] =$recordCheck['user_id'];
				$_SESSION['user_name'] =$recordCheck['user_display_name'];
				$_SESSION['user_email'] = $recordCheck['user_email'];
						
			}

		}
	
	
		return true;
   	}

	/**
	 * This function is used to insert into db the user  from google
	 * @param array $me
	 * 
	 * 
	 * @return bool
	 */
	 function googleautoRegister($me)
    	 {


		$db = file_get_contents('../../../../Bin/Configuration.php');
		$exp_db = array();
		$exp_db = explode('\'',$db);
	
		$hostname = $exp_db[1];
		$username = $exp_db[3];
		$password = $exp_db[5];
		$database = $exp_db[7];
	
		$connect = mysql_connect($hostname,$username,$password) or die(mysql_error());
		mysql_select_db($database,$connect) or die(mysql_error());
	
		// logo selection
		$sqlSite = "SELECT * FROM admin_settings_table WHERE set_id=3 ";
		$querySite = mysql_query($sqlSite);
		$recordSite = mysql_fetch_assoc($querySite);
		
		//domain selection
		$sqldomain= "SELECT * FROM admin_settings_table WHERE set_id=16 ";
		$querydomain = mysql_query($sqldomain);
		$recorddomain = mysql_fetch_assoc($querydomain);
	
		$domain = $recorddomain['set_name'];
		$logo = str_replace('index.php','',$domain).$recordSite['set_name'];


		//footer selection
		$sqlfoot="SELECT * FROM footer_settings_table WHERE id=1";
		$queryfoot = mysql_query($sqlfoot);
		$recordfoot = mysql_fetch_assoc($queryfoot);
		$footer = $recordfoot['footercontent'];
	
		//text message format for email
		$sqlMail = "SELECT * FROM mail_messages_table WHERE mail_msg_id='5'";
		$queryMail = mysql_query($sqlMail);
		$recordMail = mysql_fetch_assoc($queryMail);
		$messageFormat = $recordMail['text_facebookregister'];


		// admin email selection
		$sqladmin = "SELECT * FROM admin_settings_table WHERE set_id=14";
		$queryadmin = mysql_query($sqladmin);
		$recordadmin = mysql_fetch_assoc($queryadmin);
		$adminMail = $recordadmin['admin_mailid'];

	
		$google_id = mysql_escape_string(trim($me['id']));
		$firstname = mysql_escape_string(trim($me['name']));
		$lastname = mysql_escape_string(trim($me['name']));
		$email = mysql_escape_string(trim($me['email']));
	
		/** AUTO PASSWORD GENERATION */
	
		$chars = "0123456789abcedefghijklmnopqrstuvwxyz";
		$i = 0;
		$password = '' ;
	
		while ($i <= 7) 
		{
		$num = rand() % 35;
		$tmp = substr($chars,$num,1);
		$password = $password . $tmp;
		$i++;
		}
		
		if($birthday != '')
		{
		$date_array = array();
		$date_array = explode("/",$birthday);
		$dob = $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
		}
		else
		$dob = '';
	
		
		if($email != '')
		{
			$sqlCheck = "SELECT * FROM users_table WHERE user_email = '".$email."'"; 
			$queryCheck = mysql_query($sqlCheck);
			$recordCheck = mysql_fetch_assoc($queryCheck);
			
			if($recordCheck['user_id'] == '')
			{
				
				$sqlUser = "INSERT INTO users_table (user_fname,user_lname,user_display_name 	,user_email,user_pwd,ipaddress,user_doj,user_status,social_link_id,is_from_social_link) VALUES ('".$firstname."','".$lastname."','".$firstname."','".$email."','".base64_encode($password)."','".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d")."','1', '".$google_id."','3')";
				$queryUser = mysql_query($sqlUser);
				
				$user_id = mysql_insert_id();
				
				//Mail for Registration using facebook
				
				$subject = "Your Account has been Registered successfully";
				$headers  = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:".$adminMail."";
				
				$arr1 = array("[firstname]","[lastname]","[domainname]");
				$arr2   = array($firstname,$lastname,$_SERVER['HTTP_HOST']);
				$mailContent = str_replace($arr1,$arr2,$messageFormat); 
				
				$content = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:10px solid #e8e8e8;">
				<tr>
					<td  style="border:1px solid #fff; background-color:#f6f6f6;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td style="border-bottom:2px solid #000; background-color:#869cc7; font-family:Tahoma, Arial, Verdana; font-size:20px; color:#FFFFFF; padding:15px;">You Are Successfully Registered</td>
					</tr>
					<tr>
					<td style="padding:15px; font-family:Tahoma, Arial,Verdana; font-size:12px;">'.$mailContent.'</td>
					</tr>
					<tr>
					<td style="background-color:#e8e8e8; border-top:1px solid #c5c5c5; padding:15px; font-family:Tahoma, Arial, Verdana; font-size:12px; color:#797979;">'.$footer.'</td>
					</tr>
					</table></td>
			
				</tr>
				</table></td>
				</tr>
				</table>'; 
				
				
				mail($email,$subject,$content,$headers);

				$_SESSION['user_id'] =$user_id;
				$_SESSION['user_name'] =$firstname;
				$_SESSION['user_email'] = $email;
				
			}
			else
			{
				$_SESSION['user_id'] =$recordCheck['user_id'];
				$_SESSION['user_name'] =$recordCheck['user_display_name'];
				$_SESSION['user_email'] = $recordCheck['user_email'];
						
			}
		}
	
	
		return true;
   	}
}
?>
