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
 * This class contains functions to add, edit and delete the faqs
 * at the admin side.
 *
 * @package  		Model_MFaq
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MFaq
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of FAQs available at the admin side 
	 * @param string $msg
	 * 
	 * @return array
	 */
	
	function showFaq($msg='') 
	{
		include('classes/Core/CRoleChecking.php');
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
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include_once('classes/Core/CFaq.php');
			include_once('classes/Display/DFaq.php');			
			$default=new Core_CFaq();
			$output['message'] =$msg;
			$output['result'] = $default->listFaq();
			$output['faqmsg']=$_SESSION['msgfaqadded'];
			Bin_Template::createTemplate('faq.html',$output);
			unset($_SESSION['msgfaqadded']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
	}
	
	/**
	 * Function displays a template for adding a new FAQ 
	 * at the admin side   
	 * @param array $result 
	 * 
	 * @return array
	 */
	
	function addFaq($result='')
	{
		include('classes/Core/CRoleChecking.php');
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
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include_once('classes/Core/CFaq.php');
			include_once('classes/Display/DFaq.php');	
			$output['result']=Core_CFaq::show($result);	
			Bin_Template::createTemplate('faqadd.html',$output);

		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
	}
	
	/**
	 * Function adds the new FAQ 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function add()
	{
		include_once('classes/Core/CFaq.php');
		include_once('classes/Display/DFaq.php');	
		$result=Core_CFaq::add();		
		Model_MFaq::addFaq($result);
		$_SESSION['msgfaqadded']='Faq Added successfully!';
		header('Location:?do=faq');
		exit;

	}
	
	/**
	 * Function updates the changes made in the FAQ 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function edit()
	{
		include_once('classes/Core/CFaq.php');
		include_once('classes/Display/DFaq.php');	
		$result=Core_CFaq::edit();		
		Model_MFaq::addFaq($result);
		$_SESSION['msgfaqadded']='Faq Edited successfully!';
		header('Location:?do=faq');
		exit;
	}
	
	/**
	 * Function deletes the FAQ 
	 * 
	 * 
	 * @return array
	 */
	
	function delete()
	{ 
	
		include_once('classes/Core/CFaq.php');
		include_once('classes/Display/DFaq.php');	
		$result=Core_CFaq::delete();		
		Model_MFaq::showFaq($result);
		$_SESSION['msgfaqadded']='Faq Deleted successfully!';
		header('Location:?do=faq');
		exit;
	}
}
?>