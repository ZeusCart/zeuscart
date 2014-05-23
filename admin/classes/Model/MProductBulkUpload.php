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
 * This class contains functions to display the bulk uploader
 *
 * @package  		Model_MProductBulkUpload
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Model_MProductBulkUpload
{
	
	/**
	 * Function displays a template for Product Bulk Uploading 
	 * 
	 * 
	 * @return array
	 */
	
	function displayBulkUploader()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
			include('classes/Core/CAdminHome.php');
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];				
			$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
			$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
			$output['totalorders']=(int)Core_CAdminHome::totalOrders();
			$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
			$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
			$output['totalusers']=(int)Core_CAdminHome::totalUsers();
			$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
			$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
			$output['totalincome']=Core_CAdminHome::totalIncome();
			$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
			$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
			$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
			$output['lowstock']=Core_CAdminHome::lowStock();
			$output['totalproducts']=Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			
			Bin_Template::createTemplate('bulkupload.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function displays a template for uplaoding the .tsv file 
	 * 
	 * 
	 * @return array
	 */
	
	function uploadTsvFile()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
			include('classes/Core/CAdminHome.php');
			include('classes/Core/CProductBulkUpload.php');
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');	
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
			$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
			$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
			$output['totalorders']=(int)Core_CAdminHome::totalOrders();
			$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
			$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
			$output['totalusers']=(int)Core_CAdminHome::totalUsers();
			$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
			$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
			$output['totalincome']=Core_CAdminHome::totalIncome();
			$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
			$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
			$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
			$output['lowstock']=Core_CAdminHome::lowStock();
			$output['totalproducts']=Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
			$output['processingorders']=(int)Core_CAdminHome::processingOrders();
			$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			$output['messages']=Core_CProductBulkUpload::uploadTSVFile();
			
			Bin_Template::createTemplate('bulkupload.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays a template for downloading a sample tsv file
	 * 
	 * 
	 * @return array
	 */
	
	
	function downloadTSVSample()
	{
		include('classes/Core/CProductBulkUpload.php');
		$default=new Core_CProductBulkUpload();
		$default->downloadTSVSample();
	}
	
	/**
	 * Function displays a template for downloading sample image tsv file
	 * 
	 * 
	 * @return array
	 */
	
	
	function downloadProductImageTSVSample()
	{
		include('classes/Core/CProductBulkUpload.php');
		$default=new Core_CProductBulkUpload();
		$default->downloadProductImageTSVSample();
	}
	
	
	/**
	 * Function displays a template for image bulk uploading
	 * 
	 * 
	 * @return array
	 */
	
	function displayImageBulkUploader()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');		
			include('classes/Lib/ThumbImage.php');		
			include('classes/Core/CAdminHome.php');
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];				
			$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
			$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
			$output['totalorders']=(int)Core_CAdminHome::totalOrders();
			$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
			$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
			$output['totalusers']=(int)Core_CAdminHome::totalUsers();
			$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
			$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
			$output['totalincome']=Core_CAdminHome::totalIncome();
			$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
			$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
			$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
			$output['lowstock']=Core_CAdminHome::lowStock();
			$output['totalproducts']=Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			
			Bin_Template::createTemplate('imagebulkupload.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function displays a template for products image bulk uploading
	 * 
	 * 
	 * @return array
	 */
	
	
	function productImagesBulkUpload()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			
			include('classes/Core/CAdminHome.php');
			include('classes/Core/CProductBulkUpload.php');
			include('classes/Lib/ThumbImage.php');	
			include('classes/Lib/FileOperations.php');		
			//$default=new Core_CProductBulkUpload();
			//$default->productImagesBulkUpload();
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');	
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
			$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
			$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
			$output['totalorders']=(int)Core_CAdminHome::totalOrders();
			$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
			$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
			$output['totalusers']=(int)Core_CAdminHome::totalUsers();
			$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
			$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
			$output['totalincome']=Core_CAdminHome::totalIncome();
			$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
			$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
			$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
			$output['lowstock']=Core_CAdminHome::lowStock();
			$output['totalproducts']=Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
			$output['processingorders']=(int)Core_CAdminHome::processingOrders();
			$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			$output['messages']=Core_CProductBulkUpload::productImagesBulkUpload();
			
			Bin_Template::createTemplate('imagebulkupload.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
}

?>