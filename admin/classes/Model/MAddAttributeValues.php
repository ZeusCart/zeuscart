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


/**
 * MAddAttributeValues
 *
 * This class contains functions to display, Add, Edit and Delete Attributes Values.
 *
 * @package		Model_MAddAttributeValues
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Model_MAddAttributeValues
{	
	
	/**
	 * Function displays the Attribute Values    
	 * at the admin side
	 * 
	 * @return array
	 */
	
	function showAttributeValues()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
				
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributeValues.php");		
			$default = new Core_Settings_CAddAttributeValues();
			//$output['allatt']=$default->showAttrib();
			$output['allatt']=$default->getAttribListValues();
			$output['showattributevalues']=$default->showAttributeValues();
			 
			Bin_Template::createTemplate('addattributevalues.html',$output);	
			//include("templates/addattributevalues.html");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}		
		
	}
	
	
	/**
	 * Function used to add a New Attribute Value from    
	 * admin side
	 * 
	 * @return array
	 */
	
	
	function addAttributeValues()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
				
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributeValues.php");
		
			$default = new Core_Settings_CAddAttributeValues();
		
			$output['msg']=$default->addAttributeValues();
			//echo $output['id']=$_POST['id'];
			//$output['allatt']=$default->showAttrib();
			$output['allatt']=$default->getAttribListValues();
			$output['showattributevalues']=$default->showAttributeValues();
			
			Bin_Template::createTemplate('addattributevalues.html',$output);	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	
	
	
	/**
	 * Function used to display the list of Attribute values available     
	 * at admin side
	 * 
	 * @return array
	 */
	
	function displayAttributeValues()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
				
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributeValues.php");			
			
			$output['customers']=Core_CAdminHome::getCustomers();
			$default = new Core_Settings_CAddAttributeValues();			
			$output['dispattributevalues']=$default->displayAttributeValues();
			
			Bin_Template::createTemplate('editattributevalues.html',$output);	
			//header("Location:?do=addmaincategory");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	
	
	/**
	 * Function used to edit an Attribute value from       
	 * admin side
	 * 
	 * @return array
	 */
	
	function editAttributeValues()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
				
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributeValues.php");
			$default = new Core_Settings_CAddAttributeValues();
			
			$output['msg']=$default->editAttributeValues();
			$output['allatt']=$default->getAttribListValues();
			$output['showattributevalues']=$default->showAttributeValues($Err);
			
			Bin_Template::createTemplate('addattributevalues.html',$output);	
			//header("Location:?do=addattributevalues");<br />
	}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	 
	
	/**
	 * Function used to delete an Attribute value from       
	 * admin side
	 * 
	 * @return array
	 */
	
	function deleteAttributeValues()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddAttributeValues.php");
			$default = new Core_Settings_CAddAttributeValues();
			
			$output['msg']=$default->deleteAttributeValues();
			$output['allatt']=$default->getAttribListValues();
			$output['showattributevalues']=$default->showAttributeValues($Err);
			
			Bin_Template::createTemplate('addattributevalues.html',$output);	
		//header("Location:?do=addattributevalues");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
					
	}	
}
?>