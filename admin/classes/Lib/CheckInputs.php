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
class Lib_CheckInputs
{
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
		else if($module=='adminemail')
			$this->validateAdminEmail();
		else if($module=='productupdate')
			$this->validateEntryUpdate();
		else if($module=='useraccregister')
			$this->validateUserRegister();
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
	}
	
	function validateCheckout()
	{
	
	   // print_r($_POST);exit;
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtname']=='' or $_POST['txtstreet']=='' or $_POST['txtsuburb']=='' or $_POST['txtzipcode']!='' or $_POST['txtcountry']!='' or $_POST['txtstate']!='' or $_POST['txtsname']!='' or $_POST['txtsstreet']!='' or $_POST['txtssuburb']!='' or $_POST['txtszipcode']!='' or $_POST['txtscountry']!=''  or $_POST['txtsstate']!='' or $_POST['selshipcountry']!='' or $_POST['selbillcountry']!='' or $_POST['txtzipcode']!='')
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
	
	function validateUserRegister()
	{
		include('classes/Lib/FormValidation.php');
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if($_POST['txtdisname']=='' or $_POST['txtlname']=='' or $_POST['txtfname']=='' or $_POST['txtemail']==''
			   or $_POST['txtpwd']=='' or $_POST['txtdisname']!='' or $_POST['txtlname']!='' or $_POST['txtfname']!='' 
			   or $_POST['txtemail']!='' or $_POST['txtpwd']!='')
			{
				//echo 'hi';exit;
				$obj = new Lib_FormValidation('useraccregister');
			}
			else 
			{
				header("Location:?do=addUserAccount");
				exit();
			}
		}
	}
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
	
	
	function validatelogin()
	{	
		include('classes/Lib/FormValidation.php');
		//print_r($_POST);
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
	
	function validateAttributes()
	{	
		include('classes/Lib/FormValidation.php');
		//print_r($_POST);
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
	
	function validateRegionwisetaxEntry()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$obj = new Lib_FormValidation('regionwisetax');
		}
	}
	function validateRegionwisetaxEdit()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$obj = new Lib_FormValidation('regionwisetaxedit');
		}
	}

	function validateCurrency()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if(isset($_POST['currency_name'])&&isset($_POST['currency_tocken'])&&isset($_POST['conversion_rate'])&&isset($_POST['currency_code']))
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
	function validateEditCurrency()
	{
		include('classes/Lib/FormValidation.php');
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			if(isset($_POST['conversion_rate']))
			{
				$obj = new Lib_FormValidation('updatecurrency');
			}
			else 
			{
				header("Location:?do=editcurrency&cid=".$_POST['hidecurrencyid']);
				exit();
			}
		}	
	}
	
	
}

?>