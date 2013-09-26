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
 * This class contains functions to display, Add, Edit and Delete Attributes.
 * 
 * @package  		Model_MAddAttributes
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAddAttributes
{	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	
	/**
	 * Function displays the Attribute Names   
	 * at the admin side
	 * 
	 * @return array
	 */
	
	function showAttributes()
	{
			
		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CAddAttributes.php');
			include('classes/Model/MSiteStatistics.php');
			
			$default = new Core_Settings_CAddAttributes();
			
			$output=Model_MSiteStatistics::SiteStatistics();
			$output['showattributes']=$default->showAttributes($Err);
			$output['attribmsg']=$_SESSION['attribmsg'];
			Bin_Template::createTemplate('addattributes.html',$output);
			UNSET($_SESSION['attribmsg']);	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
	}
	
	/**
	 * Function used to add a New Attribute from    
	 * admin side
	 * 
	 * @return array
	 */
	
	function showAddAttributes()
	{
		include('classes/Core/CRoleChecking.php');
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributes.php");
			include('classes/Core/CAdminHome.php');
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$default = new Core_Settings_CAddAttributes();
			
			$output['showattributes']=$default->showAttributes($Err);
			
			Bin_Template::createTemplate('addAttributename.html',$output);	
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
	}	
	
	
	/**
	 * Function used to display the insert of Attribute     
	 * at admin side
	 * 
	 * @return array
	 */
	function insertAttributes()
	{

		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			include("classes/Core/Settings/CAddAttributes.php");
			include('classes/Lib/CheckInputs.php');
	
			$obj = new Lib_CheckInputs('attributes');
			$default = new Core_Settings_CAddAttributes();
			$default->addAttributes();

		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	


	}
	
	/**
	 * Function used to display the list of Attributes available     
	 * at admin side
	 * 
	 * @return array
	 */
	function showEditAttributes()
	{

		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
		
			include("classes/Lib/HandleErrors.php");
			include("classes/Core/Settings/CAddAttributes.php");		
			include('classes/Model/MSiteStatistics.php');
			
			$output=Model_MSiteStatistics::SiteStatistics();
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			
			$default = new Core_Settings_CAddAttributes();			
			$output['customers']=Core_CAdminHome::getCustomers();
			$output['dispattributes']=$default->displayAttributes($Err);
			
			Bin_Template::createTemplate('editattributes.html',$output);
					
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	
	
	/**
	 * Function used to edit an Attribute from       
	 * admin side
	 * 
	 * @return array
	 */
	
	
	function updateAttributes()
	{

		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::SiteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributes.php");
			include('classes/Lib/CheckInputs.php');
			$obj = new Lib_CheckInputs('editattributes');

			$default = new Core_Settings_CAddAttributes();
			$default->updateAttributes();
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	 
	
	/**
	 * Function used to delete an Attribute from       
	 * admin side
	 * 
	 * @return array
	 */
	
	function deleteAttributes()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::SiteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributes.php");
			$default = new Core_Settings_CAddAttributes();
			$output['attribmsg']=$default->deleteAttributes();
			$output['showattributes']=$default->showAttributes($Err);
			Bin_Template::createTemplate('addattributes.html',$output);	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}

	

}
?>