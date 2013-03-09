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
 * MShowSubCategory
 *
 * This class contains functions to edit and delete the available sub categories 
 * at the admin side.
 * @package		Model_MShowSubCategory
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Model_MShowSubCategory
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	/**
	 * Function displays a the list of main categories available 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function showMainCategory()
	{
		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Display/DShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include('classes/Core/CRoleChecking.php');
			
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$subcat= new Core_Category_CShowSubCategory();
			
			$output=Model_MSiteStatistics::siteStatistics();	
			$output['showmaincat']=$subcat->showMainCategory();
			$output['showsubcat']=$subcat->showSubCategory();
			
			Bin_Template::createTemplate('showsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function displays a the list of subcateogries available
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function showSubCategory()
	{
		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include("classes/Display/DShowSubCategory.php");
		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output=Model_MSiteStatistics::siteStatistics();
			$subcat= new Core_Category_CShowSubCategory();
			
			$output['showmaincat']=$subcat->showMainCategory();
			$output['showsubcat']=$subcat->showSubCategory();
			Bin_Template::createTemplate('showsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	/**
	 * Function displays a the list of subcateogries available
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function showSubUnderSubCategory()
	{
		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include("classes/Display/DShowSubCategory.php");
		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output=Model_MSiteStatistics::siteStatistics();
			$subcat= new Core_Category_CShowSubCategory();
			
			$output['showmaincat']=$subcat->showMainCategory();
			$output['showsubcatunder']=$subcat->showSubUnderSubCategory();
			Bin_Template::createTemplate('showsubundersubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	/**
	 * Function displays a template for updating the changes in the sub category 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function displaySubCategory()
	{
     		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Core/Settings/CCategoryManagement.php");
		include("classes/Model/MSiteStatistics.php");
		include("classes/Display/DShowSubCategory.php");
		include_once('classes/Display/DCategoryManagement.php');
			include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$default = new Core_Category_CShowSubCategory();
			$content= new Core_Settings_CCategoryManagement();
	
			
			$output=Model_MSiteStatistics::siteStatistics();
			$output['editsubcat']=$default->displaySubCategory();
			$output['attrib']=$content->getAttributes();
			$output['content']=$content->showContent();
			
			Bin_Template::createTemplate('editsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
					
	}	
	
	/**
	 * Function updates the changes made in the sub categories 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function editSubCategory()
	{

   		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Display/DShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include('classes/Core/CRoleChecking.php');

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$default = new Core_Category_CShowSubCategory();
			$subcat= new Core_Category_CShowSubCategory();
			
			$output=Model_MSiteStatistics::siteStatistics();
			
			$output['showmaincat']=$default->showMainCategory();
			$output['updatemaincat']=$default->editSubCategory();
			$output['showsubcat']=$subcat->showSubCategory();
	
			
			Bin_Template::createTemplate('showsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
			
	}
	/**
	 * Function displays a template for updating the changes in the sub under sub category 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function displaySubUnderSubCategory()
	{
     		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Core/Settings/CCategoryManagement.php");
		include("classes/Model/MSiteStatistics.php");
		include("classes/Display/DShowSubCategory.php");
		include_once('classes/Display/DCategoryManagement.php');
			include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$default = new Core_Category_CShowSubCategory();
			$content= new Core_Settings_CCategoryManagement();
	
			
			$output=Model_MSiteStatistics::siteStatistics();
			$output['editsubundercat']=$default->displaySubUnderSubCategory();
			$output['attrib']=$content->getAttributes();
			$output['content']=$content->showContent();
			
			Bin_Template::createTemplate('editsubundercategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
					
	}	
	
	/**
	 * Function updates the changes made in the sub under sub categories 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function editSubUnderSubCategory()
	{
		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Display/DShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include('classes/Core/CRoleChecking.php');

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$default = new Core_Category_CShowSubCategory();
			$subcat= new Core_Category_CShowSubCategory();
			
			$output=Model_MSiteStatistics::siteStatistics();
			
			
			$output['showmaincat']=$subcat->showMainCategory();
			$output['updatemaincat']=$default->editSubUnderSubCategory();
			$output['showsubcatunder']=$subcat->showSubUnderSubCategory();
			Bin_Template::createTemplate('showsubundersubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	
	/**
	 * Function deletes the selected sub category 
	 * 
	 * 
	 * @return array
	 */
	
	function deleteSubCategory()
	{
     		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Display/DShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include('classes/Core/CRoleChecking.php');

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$default = new Core_Category_CShowSubCategory();
			$subcat= new Core_Category_CShowSubCategory();
	
			$output=Model_MSiteStatistics::siteStatistics();		
			$output['deletemsg']=$default->deleteSubCategory();
			$output['showmaincat']=$default->showMainCategory();
			$output['showsubcat']=$subcat->showSubCategory();
			

			header('Location:?do=showsub&action=show&id='.$_GET['pid']);
			//Bin_Template::createTemplate('showsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}	
	
	/**
	 * Function displays the search results for the entered keywords 
	 * 
	 * 
	 * @return array
	 */
	
	function searchSubCategory()
	{
		include("classes/Core/Category/CShowSubCategory.php");
		include("classes/Model/MSiteStatistics.php");
		include("classes/Display/DShowSubCategory.php");
		include('classes/Core/CRoleChecking.php');
		
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$default = new Core_Category_CShowSubCategory();
			$output['showmaincat']=$default->showMainCategory();
			
			
			$output['search']=$default->searchSubCategory();
			Bin_Template::createTemplate('showsubcategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}	
}
?>