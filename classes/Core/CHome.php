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
 * Home page related  class
 *
 * @package   		Core_CHome
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CHome
{

	/**
	 * This function is used to get  the home page ads from  db
	 * 
	 * 
	 * @return string
	 */
	function showHomePageAds()
   	{
		$sqlselect = "SELECT * FROM home_page_ads_table WHERE status ='1'"; 
		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		$records=$obj->records;
		return $records;
   	}
	/**
	 * This function is used to get  the home page content from  db
	 * 
	 * 
	 * @return string
	 */
	function showHomePageContent()
	{
		$sqlselect = "SELECT * FROM home_page_content_table WHERE status ='0'";  
		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		$records=$obj->records[0]['home_page_content'];
		return $records;

	}

	/**
	 * This function is used to get  the site logo from  db
	 * 
	 * 
	 * @return string
	 */
	function getLogo()
   	{
		$sqlselect = "SELECT *  FROM admin_settings_table WHERE set_id='1'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		{
			if(!file_exists($obj->records[0]['site_logo']))
			{
			$output =  "images/logo/logo.gif";	
			}
			else
			{
			$output =  $obj->records[0]['site_logo'];	
			}			
		}
		else
		{
			$output = "images/logo/logo.gif";
		}
		return $output;
   	}
	/**
	 * This function is used to get  the site banner from  db
	 * 
	 * 
	 * @return string
	 */
	function getBanner()
   	{
		include_once('classes/Display/DHome.php');   		
		$sql= "SELECT set_value FROM admin_settings_table WHERE set_name='Homepage Banner Image'";
		$obj = new Bin_Query();
		$obj->executeQuery($sql);
		if(file_exists($obj->records[0]['set_value']))
		{
			$output['bannerImage'] =  $obj->records[0]['set_value'];
			$sql= "SELECT set_value FROM admin_settings_table WHERE set_name='Homepage Banner URL'";
			if($obj->executeQuery($sql))		
				$output['bannerUrl'] =  $obj->records[0]['set_value'];	
		}
		else
			$output['bannerImage'] = "images/banner/banner.jpg";
		
		return  Display_DHome::getBanner($output);
   	}
	
	/**
	 * This function is used to get  the site title from  db
	 * 
	 * 
	 * @return string
	 */
	function pageTitle()
	{
	
   		include_once('classes/Display/DHome.php');
		if($_GET['prodid']!='')
		{
			$sql= "SELECT product_id,title,meta_desc,meta_keywords FROM products_table where  	product_id= '".$_GET['prodid']."' and status=1"; 
			$query = new Bin_Query();
			$query->executeQuery($sql);		
			return  Display_DHome::pageTitle($query->records);
		}
		elseif($_GET['id']!='' && $_GET['do']=='category')
		{
			$catid=explode('-',$_GET['id']);
			$catid=$catid[1];
			$sql= "SELECT * FROM category_table where category_id= '".$catid."' ";
			$query = new Bin_Query();
			$query->executeQuery($sql);		
			return  Display_DHome::pageCategory($query->records);
		}
		else
		{
			$sql= "SELECT * FROM admin_settings_table where set_id= '1'";
			$query = new Bin_Query();
			$query->executeQuery($sql);		
			return  Display_DHome::siteMetaInformation($query->records);
		}
		
     	}
	/**
	 * This function is used to get  the skin name from  db
	 * 
	 * 
	 * @return string
	 */
	function skinName()
	{
			
			$sqlselect = "SELECT set_id,site_skin  FROM admin_settings_table WHERE set_id ='1'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['site_skin'];
			}
			else
			{
				$output = "default";
			}
			return $output;
	}
   	/**
	 * This function is used to Set the time zone assigned in the admin settings 
	 * 
	 * 
	 * @return string
	 */
	function  setTimeZone()
	{
			$sql = "SELECT set_value FROM admin_settings_table WHERE set_name='Time Zone'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
				date_default_timezone_set($obj->records[0]['set_value']); 		
	}
	/**
	 * This function is used to get  the google analytic code from  db
	 * 
	 * 
	 * @return string
	 */
	function getGoogleAnalyticsCode()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Google Analytics Code'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "";
			}
			return $output;
	}
	/**
	 * This function is used to get  the google ad  from  db
	 * 
	 * 
	 * @return string
	 */
	function getGoogleAd()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Google AdSense code'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "";
			}
			return $output;
	}
	/**
	 * This function is used to get  the social link from  db
	 * 
	 * 
	 * @return string
	 */
	function showSocialLinks()
	{
		include_once('classes/Display/DHome.php');
		$sql = "SELECT *  FROM social_links_table WHERE status ='1'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return Display_DHome::showSocialLinks($query->records);
		}	
	}
	/**
	 * This function is used to get  the footer content from  db
	 * 
	 * 
	 * @return string
	 */
	function footer()
	{
			include_once('classes/Display/DHome.php');
			$sql = "SELECT link_name,link_url FROM footer_link_table ";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				return Display_DHome::footer($query->records);
			}	
	}
   	/**
	 * This function is used to get  the footer connect with us from  db
	 * 
	 * 
	 * @return string
	 */
	function getfooterconnect()
	{
		$sql = "SELECT * FROM footer_settings_table WHERE id='1'";
		$query = new Bin_Query();
		$query->executeQuery($sql);	
		$records=$query->records[0];
	
		return $records;	
	}
   	/**
	 * This function is used to get  the brands from  db
	 * 
	 * 
	 * @return string
	 */
	function showBrands()
	{

		
		if(isset($_GET['schltr']))
		{
			$searchletter=trim($_GET['schltr']);
			if(strtolower($searchletter)!='all')
			{
				$sql ="SELECT * FROM  products_table   WHERE brand  like '".$searchletter."%' GROUP BY  brand";
			}
			else
			{
				$sql ="SELECT * FROM  products_table   WHERE brand !=''  GROUP BY  brand"; 
			}
		}
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;
		
 		return Display_DHome::showBrands($records);	
	}

	/**
	 * This function is used to get  the brands from  db for list and grid view
	 * 
	 * 
	 * @return string
	 */
	function viewBrandsList()
	{
		$pagesize=9;
  	    	if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;

		if(($_GET['brand']!='')  )
		{
			//product selection				
			if($_GET['brand']!='all')
			{
			$sqlpro="SELECT * FROM products_table WHERE brand='".$_GET['brand']."'";
			}
			else
			{
			$sqlpro="SELECT * FROM products_table WHERE brand!=''";
			}

		}
		

		$objpro=new Bin_Query();
		if($objpro->executeQuery($sqlpro))
		{	

			$sql1=$sqlpro.' LIMIT '.$start.','.$end;
			$total = ceil($objpro->totrows/ $pagesize);
			$recordSet=$objpro->records;
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>5),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			$query1 = new Bin_Query();
			$query1->executeQuery($sql1);	
		}
		
		
		return Display_DHome::viewBrandsList($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		


	}
	/**
	 * This function is used to get  the brands from  db
	 * 
	 * 
	 * @return string
	 */
	function sendGiftvoucher()
	{

		/*Generate the gift Code */
		$characters='4';	
		$possible = '1234567890';
			$code = '';
			$i = 0;
			while ($i < $characters) { 
				$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
				$i++;
	
			}
		
		$code="AJGC".$code;

		$sql="INSERT INTO  gift_voucher_table(recipient_name,recipient_email,name,email, 	certificate_theme,message,amount,gift_code)VALUES('".$_POST['rname']."','".$_POST['remail']."','".$_POST['name']."','".$_POST['email']."','".$_POST['gctheme']."','".$_POST['message']."','".$_POST['amount']."','".$code."')"; 
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
		{
			$_SESSION['giftvoucheropen']=1;
			$_SESSION['gift']=$_POST;
			//Core_CHome::sendingMail($_POST['email'],$_POST['remail'],$_POST['message']);
			$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>
			Thank you for purchasing a gift certificate! Once you have completed your order your gift voucher recipient will be sent an email with details how to redeem their gift voucher.
			</div>';


		}
		else
		{	$output = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>
			Gift Voucher  Not Send
			</div>';
		}
		return $output;
		
	}

	/**
	 * This function is used to send the mail for  contact us 
	 * @param string  $from_mail
	 * @param string  $to_mail
	 * @param string  $mail_content
	 * 
	 * @return string
	 */
	function sendingMail($from_mail,$to_mail,$mail_content)
	{
		include('classes/Lib/Mail.php');
		$mail = new Lib_Mail();
		$mail->From($from_mail); 
		$mail->ReplyTo('noreply@Zeuscart.com');
		$mail->To($to_mail); 
		$mail->Subject('contact');
		$mail->Body($mail_content);
		$mail->Send();
	}
	/**
	 * This function is used to get  the dynamic content page from db
	 * 
	 * @return array
	 */
	function showDynamicContent()
	{
		$query = new Bin_Query(); 
		$sql = "SELECT * from cms_table WHERE  	cms_id ='".trim($_GET['id'])."'";
		$query->executeQuery($sql);
		$records=$query->records[0];
		
		return $records;

	}
}
?>	