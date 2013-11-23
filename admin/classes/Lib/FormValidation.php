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
		$this->formatmessage = "Invalid Format!";

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
		else if($form=='editattributes')
			$this->validateEditAttributes();		
		else if($form=='adminemail')
			$this->validateAdminEmail();			
		else if($form=='productupdate')
			$this->validateUpdateEntry();
		else if($form=='useraccregister')
			$this->validateUserRegister();
		else if($form=='useraccregisterlight')
			$this->validateUserRegisterLight();
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
		else if($form=='addsociallink')
			$this->validateAddSocialLink();
		else if($form=='updatesociallink')
			$this->validateUpdateSocialLink();
		else if($form=='addhomepageads')
			$this->validateAddHomePageAds();
		else if($form=='edithomepageads')
			$this->validateEditHomePageAds();
		else if($form=='dynamiccms')
			$this->validateDynamicCms();
		else if($form=='editdynamiccms')
			$this->validateEditDynamicCms();
		else if($form=='checkCse')
			$this->validateCse();
		else if($form=='digitalproductreg')
			$this->validateDigitalEntry();
		else if($form=='giftproductreg')
			$this->validateGiftEntry();
		else if($form=='customergrp')
			$this->validateCustomerGroup();	
		else if($form=='editcustomergrp')
			$this->validateEditCustomerGroup();
		else if($form=='useraccupdate')
			$this->validateUserUpdate();
		else if($form=='addattributevalues')
			$this->validateAddAttributeValues();
		else if($form=='editattributevalues')
			$this->validateEditAttributeValues();
		else if($form=='sitesettings')
			$this->validateSiteSettings();
		else if($form=='editcategory')
			$this->validateEditCategory();
		else if($form=='footercontent')
			$this->validateFooterConnect();
		else if($form=='addnews')
			$this->validateAddNews();
		else if($form=='editnews')
			$this->validateEditNews();
		else if($form=='adminprofile')
			$this->validateAdminProfile();
		else if($form=='editmailmessage')
			$this->validateEditMailMessage();
		else if($form=='livechat')
			$this->validateLiveChat();
		else if($form=='productinventory')
			$this->validateProductInventory();
		else if($form=='homepagecontent')
			$this->validateHomePageContent();
		
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
	function dateCheck($date)
	{
		if(preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/",$date,$parts))
		{
			if(!checkdate($parts[2],$parts[3],$parts[1]))
				return false;
			else
				return true;
		}
		else
			return false;
	}
	

	function validateHomePageContent()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("home_page_content",trim($_POST['home_page_content']),"noempty","Home Page Content - " .$message);

		$this->PerformValidation("?do=homepage&action=content");
		
	}

	function validateProductInventory()
	{
	
		$message = "Required Field Cannot be blank";
		$this->Assign("rol",trim($_POST['rol']),"noempty","Re Order List - " .$message);
		$this->Assign("soh",trim($_POST['soh']),"noempty","Stock on Hand - " .$message);

		if(trim($_POST['rol'])!='' && !is_numeric($_POST['rol']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("txtzipcode","","noempty","Re Order List - " .$message);
		}
		if(trim($_POST['soh'])!='' && !is_numeric($_POST['soh']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("soh","","noempty","Stock on Hand - " .$message);
		}
		
		$this->PerformValidation("?do=productinventory&action=edit&id=".$_POST['invid']);


	}

	function validateLiveChat()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("live_chat_script",trim($_REQUEST['live_chat_script']),"noempty","Live Chat API - " .$message);

		$this->PerformValidation("?do=livechat");

	}


	function validateEditMailMessage()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("mail_msg_subject",trim($_REQUEST['mail_msg_subject']),"noempty","Mail Subject - " .$message);

		$this->Assign("mailmessages",trim($_REQUEST['mailmessages']),"noempty","Mail Message - " .$message);

		$this->PerformValidation("?do=mailmessages&action=disp&id=".$_GET['id']);

	}
	function validateAdminProfile()
	{
		
		$message = "Required Field Cannot be blank";
		$this->Assign("admin_name",trim($_POST['admin_name']),"noempty","Admin Name- " .$message);

		$this->Assign("admin_email",trim($_POST['admin_email']),"noempty","Admin Email- " .$message);

		$this->Assign("admin_email",trim($_POST['admin_email']),"emailcheck","Email Address - Invalid Email" );

		$this->PerformValidation("?do=adminprofile");
	}
	function validateEditNews()
	{

		
		$message = "Required Field Cannot be blank";
		$this->Assign("newstitle",trim($_POST['newstitle']),"noempty","News Title- " .$message);

		$this->Assign("newsletter",trim($_POST['newsletter']),"noempty","News Content- " .$message);
		$this->PerformValidation("?do=news&action=disp&id=".$_GET['id']);
	}
	function validateAddNews()
	{

	
		$message = "Required Field Cannot be blank";
		$this->Assign("newstitle",trim($_POST['newstitle']),"noempty","News Title- " .$message);

		$this->Assign("newscontent",trim($_POST['newscontent']),"noempty","News Content- " .$message);
		$this->PerformValidation("?do=news");
	}

	function validateFooterConnect()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("free_shipping_cost",trim($_POST['free_shipping_cost']),"noempty","Free Shipping Cost- " .$message);


		if(trim($_POST['free_shipping_cost'])!='' && !is_numeric($_POST['free_shipping_cost']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("free_shipping_cost","","noempty","Free Shipping Cost - " .$message);
		}

		$this->Assign("callus",trim($_POST['callus']),"noempty","Call Us - " .$message);
	
		if(trim($_POST['callus'])!='' && (!(preg_match("([0-9-]+)", $_POST['callus']) )))
		{

			$message = "Invalid";
			$this->Assign("callus","","noempty","Call Us - " .$message);
		}
	
		
		$message = "Required Field Cannot be blank";
		$this->Assign("email",trim($_POST['email']),"noempty","Email - " .$message);

		$this->Assign("email",trim($_POST['email']),"emailcheck","Email Address - Invalid Email" );

		$this->Assign("fax",trim($_POST['fax']),"noempty","Fax  - " .$message);
		if(trim($_POST['fax'])!='' && (!(preg_match("([0-9-]+)", $_POST['fax']) )))
		{
			$message = "Invalid";
			$this->Assign("fax","","noempty","Fax- " .$message);
		}
		$message = "Required Field Cannot be blank";
		$this->Assign("location",trim($_POST['location']),"noempty","Location  - " .$message);
		$this->Assign("footercontent",trim($_POST['footercontent']),"noempty","Footer Content - " .$message);

		

		$this->PerformValidation("?do=footersettings&action=connect");
	}


	function validateEditCategory()
	{
		
		$message = "Required Field Cannot be blank/No Special Characters Allowed";
		$this->Assign("categoryname",trim($_POST['categoryname']),"noempty/nospecial' _'",$message);		
		
		$message = "Required Field Cannot be blank";
		$this->Assign("category_alias",trim($_POST['category_alias']),"noempty",'Category Alias - '.$message);


		if(trim($_POST['category_alias'])!='')
		{	
				//convert all special charactor into hyphens and lower case
				$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', trim($_POST['category_alias']));
				$sluggable = trim($sluggable, '-');
				if( function_exists('mb_strtolower') ) { 
					$sluggable = mb_strtolower( $sluggable );
				} else { 
					$sluggable = strtolower( $sluggable );
				}
				$category_alias = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

				$sql="SELECT * FROM category_table WHERE category_alias='".$category_alias."' AND  category_id!=".$_GET['id'];
				$obj=new Bin_Query();
				if($obj->executeQuery($sql))
				{
					$this->Assign("caticon","","noempty","Category Alias - already exists");

		    	}	
    	}

		if($_POST['category']=='all')	
		{	
			$message="Required Field Cannot be blank";
			$this->Assign("category","","noempty",$message);		
		}	
		if($_POST['category']!='')
		{	
			$sql="SELECT * FROM category_table WHERE category_parent_id='".$_POST['category']."' AND category_name='".$_POST['categoryname']."' AND category_id!='".$_GET['id']."' ";  
			$obj=new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$message = "Category name already exists";
					$this->Assign("category",'',"noempty",$message);
			}
		}	
		
		if(!empty($_FILES['caticon']))
		{			
			if($_FILES['caticon']['name']!='')
			{
				if(!$this->validateimages($_FILES['caticon']['type']))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG,BMP";
					$this->Assign("caticon",'',"noempty",$message);
				}
			}			
		}
		

		$this->PerformValidation("?do=showmain&action=disp&id=".$_GET['id']);


	}	

	function validateSiteSettings()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("site_moto",trim($_POST['site_moto']),"noempty","Site Title -".$message);
		if($_FILES['site_logo']['name']=='' && $_POST['site_logo']=='' )
		{
			$this->Assign("site_logo","","noempty","Site Logo -".$message);
		}
	
		if($_FILES['site_logo']['name'] != '')
		{
		
			//Image Validation
			$ext_array = array('.jpeg','.jpg','.gif','.png','.bmp');
			$ext = strchr($_FILES['site_logo']['name'],'.');
			if(!in_array(strtolower($ext),$ext_array))
				$this->Assign("site_logo","","noempty","Site Logo - ".$this->formatmessage);
			else
			{
				$img = getimagesize($_FILES['site_logo']['tmp_name']);
				$mime = array('image/jpeg','image/jpg','image/png','image/gif');
				
				if(!in_array($img['mime'],$mime))
					$this->Assign("site_logo","","noempty","Site Logo - ".$this->formatmessage);
				
			}
			
			
			
		}
		
		$this->PerformValidation("?do=site");


	}	
	function validateEditAttributeValues()
	{

		$message = "Required Field Cannot be blank";
		
		$this->Assign("attributevalues",trim($_POST['attributevalues']),"noempty","Attribute Values - ".$message);

		$this->PerformValidation("?do=attributevalues&action=edit&id=".(int)$_GET['id']);
	}
	function validateAddAttributeValues()
	{

		$message = "Required Field Cannot be blank";
		if($_POST['id']=='all')
		{
			$this->Assign("attribute","","noempty","Attribute  - Please Select the Attribute");	

		}
		$this->Assign("attributevalues",trim($_POST['attributevalues']),"noempty","Attribute Values - ".$message);
		

		$this->PerformValidation('?do=attributevalues&action=add');
	}

	function validateUserUpdate()
	{
	
		$message = "Required Field Cannot be blank";
		$message1="Alphanumeric not allowed";
		$this->Assign("txtfname",trim($_POST['txtfname']),"noempty","First Name - " .$message);
		$this->Assign("txtfname",trim($_POST['txtfname']),"nonumber","First Name - " .$message1);
	
		$this->Assign("txtlname",trim($_POST['txtlname']),"noempty","Last Name - " .$message);
		$this->Assign("txtlname",trim($_POST['txtlname']),"nonumber","Last Name - " .$message1);
	
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"noempty","Display Name - " .$message);
	  	$this->Assign("txtdisname",trim($_POST['txtdisname']),"nonumber","Display Name - " .$message1);
		/*if(empty($_POST['txtemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("txtemail",
			'',"noempty",$message);
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
		$message = "Required Field Cannot be blank";
		$message1 = "Invalid Email";
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty","Email Address - " .$message);
		$this->Assign("txtemail",trim($_POST['txtemail']),"emailcheck","Email Address - " .$message);

		if($_POST['txtemail']!='')
		{
			$sql = "select * from users_table where user_email='".trim($_POST['txtemail'])."' and user_id!='".$_GET['userid']."'"; 
			
			$getMail=new Bin_Query();
			$getMail->executeQuery($sql);
			$userRecords = $getMail->records;
			if(count($userRecords) > 0)
			{
				$message = "Email-ID Already Registered. Please Try Another One.";		
				$this->Assign("txtemail","","noempty",$message);	
			}						
			
		}	
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtaddr",trim($_POST['txtaddr']),"noempty","Address - " .$message);
		
		$message = "Required Field Cannot be blank";
		$message1 = "Alphanumeric not allowed";
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty","City - " .$message);
		$this->Assign("txtcity",trim($_POST['txtcity']),"nonumber","City - " .$message);

		$this->Assign("txtState",trim($_POST['txtState']),"noempty","State - " .$message);
		$this->Assign("txtState",trim($_POST['txtState']),"nonumber","State - " .$message);
		
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty","Zip Code -" .$message);

		if(trim($_POST['txtzipcode'])!='' && !is_numeric($_POST['txtzipcode']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("txtzipcode","","noempty","Zip Code - " .$message);
		}
		
		$message = "Required Field Cannot be blank";
		
		

		//and trim($_POST['txtlname']) != '' and trim($_POST['txtdisname'])!='')
		$fnamelength =strlen($_POST['txtfname']);
		$lnamelength =strlen($_POST['txtlname']);
		$dislength =strlen($_POST['txtdisname']);


		if(trim($_POST['txtfname']) != '' )
		{
			if($fnamelength<3 or $fnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtfname","","noempty","First Name - ".$message);
			}
		}
		
		if(trim($_POST['txtlname']) != '' )
		{
			if($lnamelength<3 or $lnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtlname","","noempty","Last Name - ".$message);
			}
		
		}
		
		if(trim($_POST['txtdisname']) != '' )	
		{
			if($dislength<3 or $dislength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtdisname","","noempty","Display Name - ".$message);
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
		
		
		$userid=$_GET['userid'];
		$this->PerformValidation('?do=editreg&action=edit&userid='.$userid);
	}
	/**
	 * Function validate the gift product
	 * 
	 *
	 * @return string 
	 */
	function validateGiftEntry()
	{

		$cat=trim($_POST['selcatgory']);
		$message = "Select the Main Category";
		$this->Assign("selcatgory",$cat,"noempty",$message);
		
		$message = "Select the Sub Category";
		$this->Assign("subcat",trim($_POST['subcat']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
  	 	$this->Assign("product_title",trim($_POST['product_title']),"noempty",$message);
		
		
				
		
		
		$message = "Required Field Cannot be blank";
		$this->Assign("sku",trim($_POST['sku']),"noempty",$message);


		if(trim($_POST['sku'])!='')
		{
			$getSKU = new Bin_Query();
			$sqlsku = "select count(*) as count from products_table where sku='".strtolower($_POST['sku'])."'"; 
			$getSKU->executeQuery($sqlsku);		
			if($getSKU->records[0]['count'] > 0)
			{
				$message = "SKU already available-Enter a Unique SKU ID";
				$this->Assign("sku","","noempty",$message);
			}		
		}
		
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
		
			

		
		$this->PerformValidation('?do=giftproductentry');
	}
	/**
	 * Function validate the digital product
	 * 
	 *
	 * @return string 
	 */
	function validateDigitalEntry()
	{

		$cat=trim($_POST['selcatgory']);
		$message = "Select the Main Category";
		$this->Assign("selcatgory",$cat,"noempty",$message);
		
		$message = "Select the Sub Category";
		$this->Assign("subcat",trim($_POST['subcat']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
  	 	$this->Assign("product_title",trim($_POST['product_title']),"noempty",$message);
		
		if($_FILES['digitalfile']['name']=='')
		{
			$message = "Required Field Cannot be blank";
  	 		$this->Assign("digitalfile",trim($_FILES['digitalfile']['name']),"noempty",$message);
		}
		else
		{ //echo 'name'.$_FILES['digitalfile']['name'];
			$file_ext=array();
			$file_ext=explode('.',$_FILES['digitalfile']['name']);
			
			/*if(count($file_ext)>1)
			{
				$message = "Invalid file";
  	 			$this->Assign("digitalfile",'',"noempty",$message);
			}
			else
			{*/
				if(strtolower($file_ext[count($file_ext)-1])!='zip' || count($file_ext) > 2)
				{
					$message = "Upload file should be zip format only";
					$this->Assign("digitalfile",'',"noempty",$message);
				}
				else
				{
					$file_size=$_FILES['digitalfile']['size'];
					if($file_size/1048576>8)
					{
						$message = "File size too large";
						$this->Assign("digitalfile",'',"noempty",$message);
					}
	
				}
			//}
			
		}

		
		$message = "Required Field Cannot be blank";
		$this->Assign("sku",trim($_POST['sku']),"noempty",$message);


		if(trim($_POST['sku'])!='')
		{
			$getSKU = new Bin_Query();
			$sqlsku = "select count(*) as count from products_table where sku='".strtolower($_POST['sku'])."'"; 
			$getSKU->executeQuery($sqlsku);		
			if($getSKU->records[0]['count'] > 0)
			{
				$message = "SKU already available-Enter a Unique SKU ID";
				$this->Assign("sku","","noempty",$message);
			}		
		}
		
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
		
			

		
		$this->PerformValidation('?do=digitproductentry');
	}
	/**
	 * Function validate the Edit dynamic cms
	 * 
	 *
	 * @return string 
	 */
	function validateEditDynamicCms()
	{

		$message = "Required Field Cannot be blank";

		$this->Assign("cms_page_alias",trim($_POST['cms_page_alias']),"noempty","Alias - ".$message);
		$this->Assign("cms_page_content",trim($_POST['cms_page_content']),"noempty","Content - ".$message);
		$this->Assign("cms_page_title",trim($_POST['cms_page_title']),"noempty","Title - ".$message);
		if($_POST['cms_page_alias']!='')
		{
		

			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $_POST['cms_page_alias']))
			{

				$message = "Page Alias should not contain special charactors";		
				$this->Assign("cms_page_alias",'',"noempty",$message);
			}
				$sql="SELECT * FROM cms_table WHERE  cms_id!='".$_GET['id']."'";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);
				$records=$obj->records;
				for($i=0;$i<count($records);$i++)
				{
					if($_POST['cms_page_alias']==$records[$i]['cms_page_alias'])
					{
						$message = "Page Alias already Exist!.Try again.";		
						$this->Assign("cms_page_alias",'',"noempty",$message);
					}
		
				}
			
		}
			

		$this->PerformValidation('?do=dynamiccms&action=edit&id='.$_GET['id']);
	}
	/**
	 * Function validate the dynamic cms
	 * 
	 *
	 * @return string 
	 */
	function validateDynamicCms()
	{

		$message = "Required Field Cannot be blank";

		$this->Assign("cms_page_alias",trim($_POST['cms_page_alias']),"noempty","Alias - ".$message);
		$this->Assign("cms_page_content",trim($_POST['cms_page_content']),"noempty","Content - ".$message);
		$this->Assign("cms_page_title",trim($_POST['cms_page_title']),"noempty","Title - ".$message);
		if($_POST['cms_page_alias']!='')
		{
		

			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $_POST['cms_page_alias']))
			{

				$message = "Page Alias should not contain special charactors";		
				$this->Assign("cms_page_alias",'',"noempty",$message);
			}
				$sql="SELECT * FROM cms_table ";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);
				$records=$obj->records;
				for($i=0;$i<count($records);$i++)
				{
					if($_POST['cms_page_alias']==$records[$i]['cms_page_alias'])
					{
						$message = "Page Alias already Exist!.Try again.";		
						$this->Assign("cms_page_alias",'',"noempty",$message);
					}
		
				}
			
		}
			

		$this->PerformValidation('?do=dynamiccms');
	}
	
	/**
	 * Function validate the add home page ads  
	 * 
	 *
	 * @return string 
	 */
	function validateAddHomePageAds()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("title",trim($_POST['title']),"noempty","Title - ".$message);
		$this->Assign("url",trim($_POST['url']),"noempty","Url - ".$message);

		$message = "Invalid URL!";		
		if($_POST['url']!='' && !$this->isValidURL(trim($_POST['url'])))
		{
			$this->Assign("url","","noempty",$message);
		}

		
		if($_FILES['logo']['name']=='')
		{
			$message = "Required Field Cannot be blank";
  	 		$this->Assign("logo",trim($_FILES['logo']['name']),"noempty","Logo - ".$message);
		}
		if(!empty($_FILES['logo']))
		{			
			if($_FILES['logo']['name']!='')
			{
				if(!$this->validateimages($_FILES['logo']['type']))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG,BMP";
					$this->Assign("logo",'',"noempty",$message);
				}
			}

			list($width,$height,$type,$attr) = getimagesize($_FILES['logo']['tmp_name']);
				$messages = "Logo - Home Page Add should be 570px * 139px";
				if(($width >'570')||($height > '139'))
					$this->Assign("logo","","noempty",$messages);
					
		}

		$this->PerformValidation('?do=homepageads&action=show');

	}
	/**
	 * Function validate the edit home page ads  
	 * 
	 *
	 * @return string 
	 */	
	function validateEditHomePageAds()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("home_page_ads_title",trim($_POST['home_page_ads_title']),"noempty","Title - ".$message);
		$this->Assign("home_page_ads_url",trim($_POST['home_page_ads_url']),"noempty","Url - ".$message);

		$message = "Invalid URL!";		
		if($_POST['home_page_ads_url']!='' && !$this->isValidURL(trim($_POST['home_page_ads_url'])))
		{
			$this->Assign("home_page_ads_url","","noempty",$message);
		}

		if($_POST['home_page_ads_logo']=='' && ($_FILES['home_page_ads_logo']['name']==''))
		{
			if($_FILES['home_page_ads_logo']['name']=='')
			{
				$message = "Logo - Required Field Cannot be blank";
				$this->Assign("home_page_ads_logo",trim($_FILES['logo']['name']),"noempty",$message);
			}
			
		}
		if($_POST['home_page_ads_logo']!='' && ($_FILES['home_page_ads_logo']['name']!=''))
		{	
					
			if($_FILES['home_page_ads_logo']['name']!='')
			{
				if(!$this->validateimages($_FILES['home_page_ads_logo']['type']))
				{
					$message = "Logo - Upload images only in the format JPEG,JPG,PNG,BMP";
					$this->Assign("home_page_ads_logo",'',"noempty",$message);
				}
			}			
		}
	
		$this->PerformValidation('?do=homepageads&action=edit&id='.$_GET['id']);
	}
	/**
	 * Function checks the social link for update 
	 * 
	 *
	 * @return string 
	 */	
	function validateUpdateSocialLink()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("social_link_title",trim($_POST['social_link_title']),"noempty","Title - ".$message);
		$this->Assign("social_link_url",trim($_POST['social_link_url']),"noempty","Url - ".$message);

		if($_POST['social_link_logo1']=='' && ($_FILES['social_link_logo']['name']==''))
		{
			if($_FILES['social_link_logo']['name']=='')
			{
				$message = "Logo - Required Field Cannot be blank";
				$this->Assign("social_link_logo",trim($_FILES['social_link_logo']['name']),"noempty",$message);
			}
			
		}
		if($_POST['social_link_logo1']!='' && ($_FILES['social_link_logo']['name']!=''))
		{	
					
			if($_FILES['social_link_logo']['name']!='')
			{
				if(!$this->validateimages($_FILES['social_link_logo']['type']))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG";
					$this->Assign("social_link_logo",'',"noempty",$message);
				}
			}			
		}
	
		$this->PerformValidation('?do=sociallink&action=edit&id='.$_POST['social_link_id']);

	}

	/**
	 * Function checks the social link for insertion 
	 * 
	 *
	 * @return string 
	 */	
	function validateAddSocialLink()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("social_link_title",trim($_POST['social_link_title']),"noempty","Title - ".$message);
		$this->Assign("social_link_url",trim($_POST['social_link_url']),"noempty","Url - ".$message);

		if($_FILES['social_link_logo']['name']=='')
		{
			$message = "Required Field Cannot be blank";
  	 		$this->Assign("social_link_logo",trim($_FILES['social_link_logo']['name']),"noempty","Logo - ".$message);
		}
		if(!empty($_FILES['social_link_logo']))
		{			
			if($_FILES['social_link_logo']['name']!='')
			{
				if(!$this->validateimages($_FILES['social_link_logo']['type']))
				{
					$message = "Upload images only in the format JPEG,JPG,PNG";
					$this->Assign("social_link_logo",'',"noempty",$message);
				}
			}
					
		}
		$this->PerformValidation('?do=sociallink&action=create');
	}
	/**
	 * Function checks the slide show  and assign an error
	 * 
	 *
	 * @return void 
	 */	

	function validateSlideShow()
	{

// echo "<pre>";
// print_r($_POST);
// exit;
// 		$message = "Required Field Cannot be blank";
// 		
// 		for($i=0;$i<count($_POST['slide_title']);$i++)
// 		{
// 			if($_POST['slide_title'][$i]!='' )
// 			{
// 				$j=$i+1;
// 				$this->Assign("slide_title".$j."","","noempty","Title -".$message);
// 			}
// 
// 			if($_POST['slide_caption'][$i]!='' )
// 			{
// 				$j=$i+1;
// 				$this->Assign("slide_caption".$j."","","noempty","Caption -".$message);
// 			}
// 
// 
// 			if($_POST['slide_content_image'][$i]!='' )
// 			{
// 				$j=$i+1;
// 				$this->Assign("slide_content_image".$j."","","noempty","Slide Image -".$message);
// 			}
// 
// 
// 
// 
// 
// 
// 		}	

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
		$this->Assign("txtname",trim($_POST['txtname']),"noempty","Name - ".$message);
		//	$this->Assign("txtcompany",trim($_POST['txtcompany']),"noempty",$message);		
		$this->Assign("txtstreet",trim($_POST['txtstreet']),"noempty","Address - ".$message);
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty","City - ".$message);
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty","Zipcode - ".$message);
		$this->Assign("selbillcountry",trim($_POST['selbillcountry']),"noempty","Country - ".$message);
		$this->Assign("txtstate",trim($_POST['txtstate']),"noempty","State - ".$message);
		
		$this->Assign("txtsname",trim($_POST['txtsname']),"noempty","Name - ".$message);
		//	$this->Assign("txtscompany",trim($_POST['txtscompany']),"noempty",$message);
		$this->Assign("txtsstreet",trim($_POST['txtsstreet']),"noempty","Address - ".$message);
		$this->Assign("txtscity",trim($_POST['txtscity']),"noempty","City - ".$message);
		$this->Assign("txtszipcode",trim($_POST['txtszipcode']),"noempty","Zipcode - ".$message);
		$this->Assign("selshipcountry",trim($_POST['selshipcountry']),"noempty","Country - ".$message);
		$this->Assign("txtsstate",trim($_POST['txtsstate']),"noempty","State - ".$message);
		

		if($_POST['selCustomer']=='0')	
		{
			$this->Assign("selCustomer",'',"noempty",$message);
		}

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
		$message = "Required Field Cannot be blank ";	
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"noempty","Display Name - ".$message);
		
		$this->Assign("txtfname",trim($_POST['txtfname']),"noempty","First Name - ".$message);
		
		$this->Assign("txtlname",trim($_POST['txtlname']),"noempty","Last Name - ".$message);
		

		$message = "Alphanumeric not allowed";
		
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"nonumber","Display Name - ".$message);
		$this->Assign("txtfname",trim($_POST['txtfname']),"nonumber","First Name - ".$message);
		
		$this->Assign("txtlname",trim($_POST['txtlname']),"nonumber","Last Name - ".$message);


	
	
		$message = "Email Id - Required Field Cannot be blank";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty",$message);
		
		$message = "Email Id - Invalid Email.";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"emailcheck",$message);	
	

		$message = "Address - Required Field Cannot be blank.";
		$this->Assign("txtaddr",trim($_POST['txtaddr']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty","City - ".$message);
		$this->Assign("txtState",trim($_POST['txtState']),"noempty","State - ".$message);
		

		$message = "Alphanumeric not allowed .";
		$this->Assign("txtcity",trim($_POST['txtcity']),"nonumber","City - ".$message);
		$this->Assign("txtState",trim($_POST['txtState']),"nonumber","State - ".$message);


		$message = "Zip Code - Required Field Cannot be blank.";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);

		$message = "Only numeric values allowed";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty","Zip Code -" .$message);

		if(trim($_POST['txtzipcode'])!='' && !is_numeric($_POST['txtzipcode']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("txtzipcode","","noempty","Zip Code - " .$message);
		}
		

		$message = "Password - Required Field Cannot be blank.";
		$this->Assign("txtpwd",trim($_POST['txtpwd']),"noempty",$message);
		$message = "Confirm Password - Required Field Cannot be blank.";
		$this->Assign("txtrepwd",trim($_POST['txtrepwd']),"noempty",$message);
		if(trim($_POST['txtpwd']) != '' and trim($_POST['txtrepwd']) != '')
		{
			$pwdlength =strlen($_POST['txtpwd']);
			if($pwdlength<6 or $pwdlength>20)
			{
				$message = "Password minimum length is 6 & maximum length is 20.";
				$this->Assign("txtpwd","","noempty",$message);
			}
			elseif(trim($_POST['txtpwd']) != trim($_POST['txtrepwd']))
			{
				$message = "Enter the Confirm Password correctly.";
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
				$message = "First Name - Minimum length is 3.";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($lnamelength<3 or $lnamelength>20)
			{
				$message = "Last Name - Minimum length is 3.";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($dislength<3 or $dislength>20)
			{
				$message = "Display Name - Minimum length is 3.";
				$this->Assign("txtdisname","","noempty",$message);
			}
		}
		
		

	
		if(trim($_POST['txtemail']) != '')
		{
			$sqlselect = "select * from users_table where user_email='".$_POST['txtemail']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty","Email Address - ".$message);
				}
			}
		}
		if(trim($_POST['txtdisname']) != '')
		{
			$sqlselect = "select * from users_table where user_display_name='".$_POST['txtdisname']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty","Display Name - ".$message);
				}
			}
		}
		
		$this->PerformValidation('?do=addUserAccount');
	}
	/**
	 * Function checks the whether the registration process parameter supplied has null values or not in light  * box 
	 * 		 
	 *
	 * @return void 
	 */	 
	function validateUserRegisterLight()
	{
		
		$message = "Required Field Cannot be blank ";	
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"noempty","Display Name - ".$message);
		
		$this->Assign("txtfname",trim($_POST['txtfname']),"noempty","First Name - ".$message);
		
		$this->Assign("txtlname",trim($_POST['txtlname']),"noempty","Last Name - ".$message);
		

		$message = "Alphanumeric not allowed";
		
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"nonumber","Display Name - ".$message);
		$this->Assign("txtfname",trim($_POST['txtfname']),"nonumber","First Name - ".$message);
		
		$this->Assign("txtlname",trim($_POST['txtlname']),"nonumber","Last Name - ".$message);


	
	
		$message = "Email Id - Required Field Cannot be blank";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty",$message);
		
		$message = "Email Id - Invalid Email.";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"emailcheck",$message);	
	

		$message = "Address - Required Field Cannot be blank.";
		$this->Assign("txtaddr",trim($_POST['txtaddr']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty","City - ".$message);
		$this->Assign("txtState",trim($_POST['txtState']),"noempty","State - ".$message);
		

		$message = "Alphanumeric not allowed .";
		$this->Assign("txtcity",trim($_POST['txtcity']),"nonumber","City - ".$message);
		$this->Assign("txtState",trim($_POST['txtState']),"nonumber","State - ".$message);


		$message = "Zip Code - Required Field Cannot be blank.";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);

		$message = "Only numeric values allowed";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty","Zip Code -" .$message);

		if(trim($_POST['txtzipcode'])!='' && !is_numeric($_POST['txtzipcode']))
		{

			$message = "Only numeric values allowed";
			$this->Assign("txtzipcode","","noempty","Zip Code - " .$message);
		}
		

		$message = "Password - Required Field Cannot be blank.";
		$this->Assign("txtpwd",trim($_POST['txtpwd']),"noempty",$message);
		$message = "Confirm Password - Required Field Cannot be blank.";
		$this->Assign("txtrepwd",trim($_POST['txtrepwd']),"noempty",$message);
		if(trim($_POST['txtpwd']) != '' and trim($_POST['txtrepwd']) != '')
		{
			$pwdlength =strlen($_POST['txtpwd']);
			if($pwdlength<6 or $pwdlength>20)
			{
				$message = "Password minimum length is 6 & maximum length is 20.";
				$this->Assign("txtpwd","","noempty",$message);
			}
			elseif(trim($_POST['txtpwd']) != trim($_POST['txtrepwd']))
			{
				$message = "Enter the Confirm Password correctly.";
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
				$message = "First Name - Minimum length is 3.";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($lnamelength<3 or $lnamelength>20)
			{
				$message = "Last Name - Minimum length is 3.";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($dislength<3 or $dislength>20)
			{
				$message = "Display Name - Minimum length is 3.";
				$this->Assign("txtdisname","","noempty",$message);
			}
		}
		
		

	
		if(trim($_POST['txtemail']) != '')
		{
			$sqlselect = "select * from users_table where user_email='".$_POST['txtemail']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Username already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty","Email Address - ".$message);
				}
			}
		}
		if(trim($_POST['txtdisname']) != '')
		{
			$sqlselect = "select * from users_table where user_display_name='".$_POST['txtdisname']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Username already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty","Display Name - ".$message);
				}
			}
		}
		$this->PerformValidation('?do=addUserAccountLight');
	}
	/**
	 * Function checks the whether the category value  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	 
	function validateCategory()
	{
	

		$message = "Required Field Cannot be blank";
		$this->Assign("categoryname",trim($_POST['categoryname']),"noempty",'Category Name - '.$message);
		$this->Assign("category_alias",trim($_POST['category_alias']),"noempty",'Category Alias - '.$message);

		if(trim($_POST['category_alias'])!='')
		{	
			//convert all special charactor into hyphens and lower case
			$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', trim($_POST['category_alias']));
			$sluggable = trim($sluggable, '-');
			if( function_exists('mb_strtolower') ) { 
				$sluggable = mb_strtolower( $sluggable );
			} else { 
				$sluggable = strtolower( $sluggable );
			}
			$category_alias = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

			$sql="SELECT * FROM category_table WHERE category_alias='".$category_alias."'";
			$obj=new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$this->Assign("caticon","","noempty","Category Alias - already exists");

	    	}	

    	}
		if($_FILES['caticon']['name'] != '')
		{
		
			//Image Validation
			$ext_array = array('.jpeg','.jpg','.gif','.png','.bmp');
			$ext = strchr($_FILES['caticon']['name'],'.');
			if(!in_array(strtolower($ext),$ext_array))
				$this->Assign("caticon","","noempty","Category Image- ".$this->formatmessage);
			else
			{
				$img = getimagesize($_FILES['caticon']['tmp_name']);
				$mime = array('image/jpeg','image/jpg','image/png','image/gif');
				
				if(!in_array($img['mime'],$mime))
					$this->Assign("caticon","","noempty","Category Image - ".$this->formatmessage);
				
			}
			
			
			
		}

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

	
		$message = "Required Field Cannot be blank";
		
		$this->Assign("attributes",$_POST['attributes'],"noempty","Attribute Name - ".$message);

	
		if($_POST['attributes']!='')
		{
			$sql = "SELECT * FROM attribute_table WHERE attrib_name ='".$_POST['attributes']."'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$this->Assign("attributes",'',"noempty","Attribute Name - Already this Attribute is Added");
			}

		}
		$this->PerformValidation('?do=attributes&action=add');
	}
	/**
	 * Function checks the whether the attributes value  supplied has null values or not 
	 * 		 
	 *
	 * @return void 
	 */	
	function validateEditAttributes()
	{

	
		$message = "Required Field Cannot be blank";
		
		$this->Assign("attributes",$_POST['attributes'],"noempty","Attribute Name - ".$message);

	
		if($_POST['attributes']!='')
		{
			$sql = "SELECT * FROM attribute_table WHERE attrib_name ='".$_POST['attributes']."' AND attrib_id !=".(int)$_GET['id'];
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$this->Assign("attributes",'',"noempty","Attribute Name - Already this Attribute is Added");
			}

		}
		$this->PerformValidation('?do=attributes&action=edit&id='.$_GET['id']);
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
		$pswd  = md5($pswd);
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
						//$div="<div class='exc_msgbox'>"
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
	 	
		    $message = "Currency Name - Required Field Cannot be blank.";
			$this->Assign("currency_name",$_POST['currency_name'],"noempty",$message);
		    $message = "Currency Code - Required Field Cannot be blank.";
			$this->Assign("currency_code",$_POST['currency_code'],"noempty",$message);
		    $message = "Currency Token - Required Field Cannot be blank.";
			$this->Assign("currency_tocken",$_POST['currency_tocken'],"noempty",$message);
					


	
			$curr_code=trim($_POST['currency_code']);
			$country_code=trim($_POST['taxratecountry']);
		
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
			
				$message = "Currency Name - Required Field Cannot be blank.";
				$this->Assign("currency_name",$_POST['currency_name'],"noempty",$message);
				$message = "Currency Code - Required Field Cannot be blank.";
				$this->Assign("currency_code",$_POST['currency_code'],"noempty",$message);
				$message = "Currency Token - Required Field Cannot be blank.";
				$this->Assign("currency_tocken",$_POST['currency_tocken'],"noempty",$message);
			
				$curr_code=trim($_POST['currency_code']);
				$country_code=trim($_POST['taxratecountry']);

				
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
		
		$this->PerformValidation('?do=editcurrency&cid='.$_POST['hidecurrencyid']);
	}


	/**
	 * Function checks the url 
	 * 
	 *
	 * @return string 
	 */	
	function validateCse()
	{ 		$message = "Pricerunner Affiliate ID - Required Field Cannot be blank.";
			$this->Assign("regid",$_POST['regid'],"noempty",$message);

			$this->PerformValidation('?do=cse');
	}

	function validateCustomerGroup()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("txtgrpname",trim($_POST['txtgrpname']),"noempty","Group Name -" .$message);

		$message = "Alphanumeric not allowed";
		$this->Assign("txtgrpname",trim($_POST['txtgrpname']),"nonumber","Group Name -" .$message);

		$message = "No special characters allowed";
		$this->Assign("txtgrpname",trim($_POST['txtgrpname']),"nospecial","Group Name -" .$message);

		$message = "Required Field Cannot be blank";
		$this->Assign("txtdiscount",trim($_POST['txtdiscount']),"noempty","Discount - ".$message);
		
		$message = "No special characters allowed";
		$this->Assign("txtdiscount",trim($_POST['txtdiscount']),"nospecial","Discount - ".$message);	
	
		if($_POST['txtgrpname'] != '')
		{
			$name=  $_POST['txtgrpname'];
		
			$sql="select count(*) as cnt from ".TBL_PREFIX."users_group_table where group_name='".$name."'";
			$obj1=new Bin_Query();
			$obj1->executeQuery($sql);		
		
			if ($obj1->records[0]['cnt'] > 0)
			{
				$message = "Customer Group Already Exists";
				$this->Assign("txtgrpname","","noempty",$message);
			
			}
		}
		$discount=trim($_POST['txtdiscount']);
		if($discount!='')
		{
			 if(!is_numeric($discount))
 		  	 {
				$message = "Numbers Only Allowed in Discount";
				$this->Assign("txtdiscount","","noempty",$message);
			 }
			 if(is_numeric($discount) && ($discount>=100 || $discount<0) )
 		  	 {
				$message = "Please Enter the Discount between 0 to 99";
				$this->Assign("txtdiscount","","noempty",$message);
			 }
		}
		$this->PerformValidation('?do=custgroup&action=add');
	}
	function validateEditCustomerGroup()
	{

		$id = $_POST['groupid'];

		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtgrpname",trim($_POST['txtgrpname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/ No special characters allowed";
		$this->Assign("txtdiscount",trim($_POST['txtdiscount']),"noempty/nospecial''",$message);
		
		if($_POST['txtgrpname']!='')
		{
			$getGrpName = new Bin_Query();
			$sqlGrpName = "select count(*) as count from users_group_table where group_name='".$_POST['txtgrpname']."' and group_id!='".$id."'";
			$getGrpName->executeQuery($sqlGrpName);
			if($getGrpName->records[0]['count']>0)
			{
				$message = "Customer Group Name Already Exists! Please Try Another One.";
				$this->Assign("txtgrpname","","noempty",$message);
			}				
		}		
		$discount=trim($_POST['txtdiscount']);
		if($discount!='')
		{
			 if(!is_numeric($discount))
 		  	 {
				$message = "Numbers Only Allowed in Discount";
				$this->Assign("txtdiscount","","noempty",$message);
			 }
			 if(is_numeric($discount) && ($discount>=100 || $discount<0) )
 		  	 {
				$message = "Please Enter the Discount between 0 to 99";
				$this->Assign("txtdiscount","","noempty",$message);
			 }
		}
		$this->PerformValidation('?do=custgroup&action=edit&id='.$id);


	}
	
	
}
?>