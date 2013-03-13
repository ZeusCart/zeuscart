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
				
				$pswd=base64_encode($pswd);
				$sql = "insert into users_table (user_display_name,user_fname,user_lname,user_email,user_pwd,user_status,user_doj,user_country) values('".$displayname."','".$firstname."','".$lastname."','".$email."','".$pswd."',1,'".$date."','".$country."')";
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
						Account has been CreatedSuccessfully
						</div>';
						$pwd = $_POST['txtpwd'];
						$title="Zeuscart";
						$mail_content="Thank you for registering with us. Your Login Details are given below<br>
						UserName :".$email."<br>Password:".$pwd;
						Core_CUserRegistration::sendingMail($email,$title,$mail_content);
					}
					else
						$result ='<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Account Not Created
							</div>';


					
					
				}else
					$result = '<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Account Not Created
							</div>';
			}
			else
				$result = '<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Account Not Created
							</div>';
		}
	}
	return $result;
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
			$pwd = base64_decode($obj->records[0]['user_pwd']);
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
		$pwd = base64_encode($pwd);
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
				Please enter email address
				</div>';
		}
		$email =$_POST['email'];
		if($email != '')
		{
			$sql = "select user_pwd from users_table where user_email ='".$email."'";
			
			$obj = new Bin_Query();
			
			if($obj->executeQuery($sql))
			{
	        	
				$password = $obj->records[0]['user_pwd'];
				$password = base64_decode($password);
				$title = 'Login Password';
				$mail_content = 'Your Password is '.$password;
				
				Core_CUserRegistration::sendingMail($email,$title,$mail_content);
				$result = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				Password has been sent to your mail successfully
				</div>';
				
			}
			else
			{
				$result = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				Invalid User
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
		
		$sql = "select set_value from admin_settings_table where set_name='Admin Email'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['set_value']; 
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
			return 'No mail id provided';
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
		include_once('classes/Core/CHitCounter.php');
					
		$str='';  $salute='';
		if($_SESSION['user_id']!='')
		{
			$str='Logout';
			$output['logout']='<a href="?do=logout">'.$str.'</a>';
			$output['username']='Welcome '.$_SESSION['user_name'];
			$output['user']=$_SESSION['user_name'];			
		}
		else
		{
			$str='Login';
			$output['logout']='<a href="?do=login">'.$str.'</a>';
			$output['username']='Welcome Guest';
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
		
		$sql = "SELECT * FROM `category_table` WHERE category_parent_id =0 AND category_status =1 ";
		if($query->executeQuery($sql))
		{
			$output = Display_DUserRegistration::showHeaderMenu($query->records);
		}
		else
			$output='No Category Found';
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
		$query = new Bin_Query();
		if($_POST['email']!='' and $_POST['email']!='Your Email')
		{
			$sql = "insert into newsletter_subscription_table (email,status) values('".$email."',1)";
			if($query->updateQuery($sql))
				$output='<div class="success_msgbox">Newsletter subscription added for your account</div><br/>'; 
			else
				$output='<div class="error_msgbox">Newsletter subscription Not added for your account</div><br/>'; 
		}
		else
			$output='<div class="error_msgbox">Please enter your email id </div><br/>'; 
		return $output;
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
		$query = new Bin_Query(); 
		$sql = "SELECT * from custompage_table where status=1";
		if($query->executeQuery($sql))
		{
			$output = Display_DUserRegistration::showHeaderMainMenu($query->records);
		}
		else
			$output = '<div id="chromemenu"><ul><li><a href="?do=indexpage">Home</a></li></ul></div>';
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
		$sql = "SELECT set_value from admin_settings_table where set_name='Custom Header'";
		$query->executeQuery($sql);
		$output = $query->records[0]['set_value'];
	
		if($output!='')
		return '<div style="height:10px;"></div>
		<div style="padding-left:14px;">
		<div class="flash_News">'.$output.'</div>
		</div>';
	}
	/**
	 * This function is used to get  contry list from db  
	 *  @param array $arr
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
   
}
?>
