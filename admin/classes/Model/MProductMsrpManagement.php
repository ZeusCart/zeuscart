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
 * This class contains functions to add, edit and delete the MSRP details for a product
 * at the admin side.
 *
 * @package  		Model_MProductMsrpManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MProductMsrpManagement
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	/**
	 * Function displays a template for updating the msrp details with respect to quantity 
	 * 
	 * 
	 * @return array
	 */
	
	
	function displayMsrpByQuantity()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductMsrpManagement.php');
		include('classes/Model/MSiteStatistics.php');
		include('classes/Display/DProductMsrpManagement.php');		
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['dispmsrp'] =Core_CProductMsrpManagement::displayMsrpByQuantity();	
		
			Bin_Template::createTemplate('ProductMsrpManagement.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function adds a new msrp price for the selected product 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function insertMsrpByQuantity()
	{
		include('classes/Core/CProductMsrpManagement.php');
		include('classes/Model/MSiteStatistics.php');	
		include('classes/Display/DProductMsrpManagement.php');	
				 
		$output=Model_MSiteStatistics::siteStatistics();
		$output['insertmsrp'] =Core_CProductMsrpManagement::insertMsrpByQuantity();				
		$output['dispmsrp'] =Core_CProductMsrpManagement::displayMsrpByQuantity();
		
		Bin_Template::createTemplate('ProductMsrpManagement.html',$output);
	}
	
	/**
	 * Function displays a template for updating the changes in the msrp price 
	 * 
	 * 
	 * @return array
	 */
	
	
	function editMsrpByQuantity()
	{
		include('classes/Core/CProductMsrpManagement.php');
		include('classes/Model/MSiteStatistics.php');	
		include('classes/Display/DProductMsrpManagement.php');	
		
		$output=Model_MSiteStatistics::siteStatistics();
		$output['dispmsrp'] =Core_CProductMsrpManagement::editMsrpByQuantity();						
		
		Bin_Template::createTemplate('EditProductMsrpManagement.html',$output);
	}	
	
	/**
	 * Function updates the msrp price for a selected product   
	 * at the admin side 
	 * 
	 * @return array
	 */
	
	
	function updateMsrpByQuantity()
	{
		include('classes/Core/CProductMsrpManagement.php');
		include('classes/Model/MSiteStatistics.php');	
		include('classes/Display/DProductMsrpManagement.php');	
		
		$output=Model_MSiteStatistics::siteStatistics();
		$output['updateproduct']=Core_CProductMsrpManagement::updateMsrpByQuantity();					
		$output['dispmsrp'] =Core_CProductMsrpManagement::displayMsrpByQuantity();
		
		Bin_Template::createTemplate('ProductMsrpManagement.html',$output);
		
	}
	
	/**
	 * Function deletes a msrp price for a selected product 
	 * at the admin side
	 * 
	 * @return array
	 */
	
	
	function deleteMsrpByQuantity()
	{
		include('classes/Core/CProductMsrpManagement.php');
		include('classes/Display/DProductMsrpManagement.php');	
		
		$output['deletemsg']=Core_CProductMsrpManagement::deleteMsrpByQuantity();				
		$output['dispmsrp'] =Core_CProductMsrpManagement::displayMsrpByQuantity();	
		
		Bin_Template::createTemplate('ProductMsrpManagement.html',$output);
		
	}
}
?>