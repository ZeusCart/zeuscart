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
 * This class contains functions related check inputs
 *
 * @package  		Lib_CheckInputs
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
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
		
		if($module=='category')
			$this->checkAddCategory();
		else if($module=='register')
			$this->register();
		else if($module=='validatelogin')
			$this->validatelogin();
		else if($module=='subadminmail')
			$this->validatSubAdminEmail();
		else if($module=='productreg')
			$this->validateEntry();
		else if($module=='attributes')
			$this->validateAttributes();
		else if($module=='editattributes')
			$this->validateEditAttributes();
		else if($module=='adminemail')
			$this->validateAdminEmail();
		else if($module=='productupdate')
			$this->validateEntryUpdate();
		else if($module=='useraccregister')
			$this->validateUserRegister();
		else if($module=='useraccregisterlight')
			$this->validateUserRegisterLight();
		else if($module=='frmship')
			$this->validateCheckout();
		else if($module=='regionwisetax')
			$this->validateRegionwisetaxEntry();
		else if($module=='regionwisetaxedit')
			$this->validateRegionwisetaxEdit();
		else if($module=='addnewcurrency')
			$this->validateCurrency();
		else if($module=='updatecurrency')
			$this->validateEditCurrency();
		else if($module=='updateslideshow')
			$this->validateSlideShow();
		else if($module=='addsociallink')
			$this->validateAddSocialLink();
		else if($module=='updatesociallink')
			$this->validateUpdateSocialLink();
		else if($module=='addhomepageads')
			$this->validateAddHomePageAds();
		else if($module=='edithomepageads')
			$this->validateEditHomePageAds();
		else if($module=='dynamiccms')
			$this->validateDynamicCms();
		else if($module=='editdynamiccms')
			$this->validateEditDynamicCms();
		else if($module=='csevalidation')
			$this->validateCsevalidation();
		else if($module=='digitalproductreg')
			$this->validateDigitalEntry();
		else if($module=='giftproductreg')
			$this->validateGiftEntry();
		else if($module=='customergroup')
			$this->validateCustomerGroup();	
		else if($module=='editcustomergroup')
			$this->validateEditCustomerGroup();
		else if($module=='useraccupdate')
			$this->validateUserUpdate();
		else if($module=='addattributevalues')
			$this->validateAddAttributeValues();
		else if($module=='editattributevalues')
			$this->validateEditAttributeValues();
		else if($module=='sitesettings')
			$this->validateSiteSettings();
		else if($module=='editcategory')
			$this->validateEditCategory();
		else if($module=='footercontent')
			$this->validateFooterConnect();
		else if($module=='addnews')
			$this->validateAddNews();
		else if($module=='editnews')
			$this->validateEditNews();
		else if($module=='adminprofile')
			$this->validateAdminProfile();		
		else if($module=='editmailmessage')
			$this->validateEditMailMessage();
		else if($module=='livechat')
			$this->validateLiveChat();
		else if($module=='productinventory')
			$this->validateProductInventory();
		else if($module=='homepagecontent')
			$this->validateHomePageContent();
		

	}


	function validateHomePageContent()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['home_page_content']!='' or $_POST['home_page_content']=='') 
			{

				$obj = new Lib_FormValidation('homepagecontent');
			}
			else 
			{
				header("Location:?do=homepage&action=content");
				exit();
			}
		}

	}
	function validateProductInventory()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['rol']!='' or $_POST['rol']=='' or $_POST['soh']!='' or $_POST['soh']=='') 
			{

				$obj = new Lib_FormValidation('productinventory');
			}
			else 
			{
				header("Location:?do=productinventory");
				exit();
			}
		}

	}

	function validateLiveChat()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_REQUEST['live_chat_script']!='' or $_REQUEST['live_chat_script']=='')
			{

				$obj = new Lib_FormValidation('livechat');
			}
			else 
			{
				header("Location:?do=livechat");
				exit();
			}
		}


	}

	function validateEditMailMessage()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['mail_msg_subject']!='' or $_POST['mail_msg_subject']=='' or $_POST['mailmessages']!='' or $_POST['mailmessages']=='' )
			{

				$obj = new Lib_FormValidation('editmailmessage');
			}
			else 
			{
				header("Location:?do=mailmessages&action=disp&id=".$_GET['id']);
				exit();
			}
		}

	}

	function validateAdminProfile()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['admin_name']!='' or $_POST['admin_name']=='' or $_POST['admin_email']!='' or $_POST['admin_email']==''  or $_POST['admin_password']!='' or $_POST['admin_password']=='')
			{

				$obj = new Lib_FormValidation('adminprofile');
			}
			else 
			{
				header("Location:?do=adminprofile");
				exit();
			}
		}
	
	}

	function validateEditNews()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['newstitle']!='' or $_POST['newstitle']=='' or $_POST['newscontent']!='' or $_POST['newscontent']=='' )
			{

				$obj = new Lib_FormValidation('editnews');
			}
			else 
			{
				header("Location:?do=news&action=disp&id=".$_GET['id']);
				exit();
			}
		}
	}
	
	function validateAddNews()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['newstitle']!='' or $_POST['newstitle']=='' or $_POST['newscontent']!='' or $_POST['newscontent']=='' )
			{

				$obj = new Lib_FormValidation('addnews');
			}
			else 
			{
				header("Location:?do=news");
				exit();
			}
		}
	}
	


	function validateFooterConnect()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['callus']!='' or $_POST['callus']=='' or $_POST['email']!='' or $_POST['email']==''  or $_POST['fax']!='' or $_POST['fax']==''  or $_POST['location']!='' or $_POST['location']==''  or $_POST['footercontent']!='' or $_POST['footercontent']=='' or $_POST['free_shipping_cost']!='' or $_POST['free_shipping_cost']=='')
			{

				$obj = new Lib_FormValidation('footercontent');
			}
			else 
			{
				header("Location:?do=footersettings&action=connect");
				exit();
			}
		}

	}

	function validateEditCategory()
	{	

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['category']!='' or $_POST['category']=='')
			{

				$obj = new Lib_FormValidation('editcategory');
			}
			else 
			{
				header("Location:?do=showmain&action=disp&id=".$_GET['id']);
				exit();
			}
		}

	}
	function validateSiteSettings()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
			if($_POST['site_moto']=='' || $_POST['attributevalues']!='' || $_POST['admin_email']=='' || $_POST['admin_email']!='')
			{
				
				$obj = new Lib_FormValidation('sitesettings');
			}
			else 
			{
				header("Location:?do=site");
				exit();
			}


		}

	}

	function validateEditAttributeValues()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
			if($_POST['attributevalues']=='' || $_POST['attributevalues']!='')
			{
				
				$obj = new Lib_FormValidation('editattributevalues');
			}
			else 
			{
				header("Location:?do=addattributevalues&action=disp&id=".(int)$_GET['id']);
				exit();
			}


		}

	}
	function validateAddAttributeValues()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
			if($_POST['attributevalues']=='' || $_POST['attributevalues']!='')
			{
				
				$obj = new Lib_FormValidation('addattributevalues');
			}
			else 
			{
				header("Location:?do=attributevalues&action=add");
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
	function validateUserUpdate()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtdisname']=='' or $_POST['txtlname']=='' or $_POST['txtfname']=='' or $_POST['txtemail']==''
			or $_POST['txtpwd']=='' or $_POST['txtdisname']!='' or $_POST['txtlname']!='' or $_POST['txtfname']!='' 
			or $_POST['txtemail']!='' or $_POST['txtpwd']!='')
			{
				
				$obj = new Lib_FormValidation('useraccupdate');
			}
			else 
			{	
				$userid=$_GET['userid'];
				header('?do=editreg&action=edit&userid='.$userid);
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
	function validateGiftEntry()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
			if($_POST['price']==''||$_POST['price']!='')
			{
				
				$obj = new Lib_FormValidation('giftproductreg');
			}
			else 
			{
				header("Location:?do=giftproductentry");
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
	function validateDigitalEntry()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
			if($_POST['price']==''||$_POST['price']!='')
			{
				
				$obj = new Lib_FormValidation('digitalproductreg');
			}
			else 
			{
				header("Location:?do=digitproductentry");
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
	function validateCsevalidation()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['regid']=='' or $_POST['regid']!='' )
			{
			

				$obj = new Lib_FormValidation('checkCse');
			}
			else 
			{
				header('Location:?do=cse');
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
	function validateEditDynamicCms()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['cms_page_alias']=='' or $_POST['cms_page_alias']!='' )
			{
			

				$obj = new Lib_FormValidation('editdynamiccms');
			}
			else 
			{
				header('Location:?do=dynamiccms&action=edit&id='.$_GET['id']);
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
	function validateDynamicCms()
	{

		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{

			if($_POST['cms_page_alias']=='' or $_POST['cms_page_alias']!='' )
			{
			

				$obj = new Lib_FormValidation('dynamiccms');
			}
			else 
			{
				header('Location:?do=dynamiccms');
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
	function validateAddHomePageAds()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['title']==''or $_POST['title']!='' or $_POST['url']=='' or $_POST['url']!='' or $_FILES['logo']['name']=='' or $_FILES['logo']['name']!='' )
			{
			
				$obj = new Lib_FormValidation('addhomepageads');
			}
			else 
			{
				header('Location:?do=homepageads&action=show');
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
	function validateEditHomePageAds()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['home_page_ads_title']==''or $_POST['home_page_ads_title']!='' or $_POST['home_page_ads_url']=='' or $_POST['home_page_ads_url']!='' or $_FILES['home_page_ads_logo']['name']=='' or $_FILES['home_page_ads_logo']['name']!='' )
			{
			
				$obj = new Lib_FormValidation('edithomepageads');
			}
			else 
			{
				header('Location:?do=homepageads&action=edit&id='.$_GET['id']);
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
	function validateUpdateSocialLink()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['social_link_title']!='' or $_POST['social_link_title']=='' or $_POST['social_link_url']=='' or $_POST['social_link_url']!='' )
			{
			
				$obj = new Lib_FormValidation('updatesociallink');
			}
			else 
			{
				header("Location:?do=sociallink");
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
	function validateAddSocialLink()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['social_link_title']!='' or $_POST['social_link_title']=='' or $_POST['social_link_url']=='' or $_POST['social_link_url']!='' )
			{
			
				$obj = new Lib_FormValidation('addsociallink');
			}
			else 
			{
				header("Location:?do=sociallink");
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
	function validateSlideShow()
	{
	
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$obj = new Lib_FormValidation('updateslideshow');

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
			if($_POST['txtname']=='' or $_POST['txtstreet']=='' or $_POST['txtsuburb']=='' or $_POST['txtzipcode']!='' or $_POST['txtcountry']!='' or $_POST['txtstate']!='' or $_POST['txtsname']!='' or $_POST['txtsstreet']!='' or $_POST['txtssuburb']!='' or $_POST['txtszipcode']!='' or $_POST['txtscountry']!=''  or $_POST['txtsstate']!='' or $_POST['selshipcountry']!='' or $_POST['selbillcountry']!='' or $_POST['txtzipcode']!='' or $_POST['selCustomer']!=''  or $_POST['selCustomer']=='')
			{
			
				$obj = new Lib_FormValidation('frmship');
			}
			else 
			{
				header("Location:?do=addUserProduct");
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
	function validateUserRegister()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtdisname']=='' or $_POST['txtlname']=='' or $_POST['txtfname']=='' or $_POST['txtemail']==''
			   or $_POST['txtpwd']=='' or $_POST['txtdisname']!='' or $_POST['txtlname']!='' or $_POST['txtfname']!='' 
			   or $_POST['txtemail']!='' or $_POST['txtpwd']!='')
			{
				
				$obj = new Lib_FormValidation('useraccregister');
			}
			else 
			{
				header("Location:?do=addUserAccount");
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
	function validateUserRegisterLight()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtdisname']=='' or $_POST['txtlname']=='' or $_POST['txtfname']=='' or $_POST['txtemail']==''
			   or $_POST['txtpwd']=='' or $_POST['txtdisname']!='' or $_POST['txtlname']!='' or $_POST['txtfname']!='' 
			   or $_POST['txtemail']!='' or $_POST['txtpwd']!='')
			{
				
				$obj = new Lib_FormValidation('useraccregisterlight');
			}
			else 
			{
				header("Location:?do=addUserAccountLight");
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
	function checkAddCategory()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['category']!='' or $_POST['category']=='')
			{
				$obj = new Lib_FormValidation('category');
			}
			else 
			{
				header("Location:?do=managecategory");
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
			if($_POST['username']!='' or $_POST['password']!='' or $_POST['username']=='' or $_POST['password']=='')
			{
				$obj = new Lib_FormValidation('validatelogin');
			}
			else 
			{
				header("Location:?do=adminlogin");
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
	function validateAttributes()
	{	
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['attributes']!='' or $_POST['attributes']=='')
			{

				$obj = new Lib_FormValidation('attributes');
			}
			else 
			{
				header("Location:?do=adminlogin");
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
	function validateEditAttributes()
	{	
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['attributes']!='' or $_POST['attributes']=='')
			{

				$obj = new Lib_FormValidation('editattributes');
			}
			else 
			{
				header("Location:?do=adminlogin");
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
	function validatSubAdminEmail()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['subadminemail']!='' or $_POST['subadminemail']=='' or $_POST['subadminname']!='' or $_POST['subadminname']=='' or $_POST['subadminpassword']!='' or $_POST['subadminpassword']=='')
			{
				$obj = new Lib_FormValidation('subadminmail');
			}
			else 
			{
				header("Location:?do=subadminmgt");
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
	function validateAdminEmail()
	{
		
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['adminemail']!='' or $_POST['adminemail']=='')
			{
				$obj = new Lib_FormValidation('adminemail');
			}
			else 
			{
				header("Location:?do=adminlogin&action=showpage");
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
	function validateEntry()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['title']=='' or $_POST['price']=='' or $_POST['msrp']=='' or $_POST['title']!='' or $_POST['price']!='' or $_POST['msrp']!='' or count($_POST['shipcost'])>0  or count($_POST['rol'])>0 or count($_POST['soh'])>0 or count($_POST['sku'])>0)
			{
			
				$obj = new Lib_FormValidation('productreg');
			}
			else 
			{
				header("Location:?do=productentry");
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
	
	function validateEntryUpdate()
	{
		$id=$_GET['prodid'];
		
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['title']=='' or $_POST['price']=='' or $_POST['msrp']=='' or $_POST['title']!='' or $_POST['price']!='' or $_POST['msrp']!='' or count($_POST['shipcost'])>0  or count($_POST['rol'])>0 or count($_POST['soh'])>0 or count($_POST['sku'])>0)
			{
			
				$obj = new Lib_FormValidation('productupdate');
			}
			else 
			{
				header("Location:?do=manageproducts&action=editprod&prodid=".$id."");
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
	
	function validateRegionwisetaxEntry()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$obj = new Lib_FormValidation('regionwisetax');
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateRegionwisetaxEdit()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$obj = new Lib_FormValidation('regionwisetaxedit');
		}
	}
	/**
	 * Function checks whether the request method is post and invokes the validation module  
	 * 
	 * 
	 *
	 * @return void 
	 */	 
	function validateCurrency()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if(isset($_POST['currency_name'])&&isset($_POST['currency_tocken'])&&isset($_POST['currency_code']))
			{
				$obj = new Lib_FormValidation('addnewcurrency');
			}
			else 
			{
				header("Location:?do=showaddcurrency");
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
	function validateEditCurrency()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			
				$obj = new Lib_FormValidation('updatecurrency');
			
			
		}	
	}
	function validateCustomerGroup()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if(isset($_POST))
			{
				$obj = new Lib_FormValidation('customergrp');
			}
			else 
			{
				header("Location:?do=custgroup&action=add");
				exit();
			}
		}


	}
	function validateEditCustomerGroup()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if(isset($_POST))
			{
				$obj = new Lib_FormValidation('editcustomergrp');
			}
			else 
			{
				$id = $_POST['groupid'];
				header("Location:?do=custgroup&action=edit&id=".$id);
				exit();
			}
		}

	}		

}

?>