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
 * MViewFeaturedItems
 *
 * 
 * 
 * @package		Model_MViewFeaturedItems
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Model_MViewFeaturedItems
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	function viewProducts()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CViewFeaturedItems.php');
		include('classes/Model/MSiteStatistics.php');
		include_once('classes/Display/DViewFeaturedItems.php');
		
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CViewFeaturedItems();
			
			$output['product']=$default->viewProducts();
			Bin_Template::createTemplate('viewfeatureditems.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
				
	}
	
	function updateProducts()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CViewFeaturedItems.php');
		include('classes/Model/MSiteStatistics.php');
		include_once('classes/Display/DViewFeaturedItems.php');

		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			
			$default = new Core_Settings_CViewFeaturedItems();
			
			$output['msg']=$default->updateProducts();
			$output['product']=$default->viewProducts();
			Bin_Template::createTemplate('viewfeatureditems.html',$output);	
			
		//header('Location:?do=selectfeatured');				
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
}	
?>