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
 * This class contains functions to display the site map for tha admin panel.
 *
 * @package  		Model_MAdminmap
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MAdminmap
{

	
	
	/**
	 * Function is displays the a site map at the admin side 
	 * 
	 * 
	 * @return array
	 */
	 
	function dispAdminmap()
	{	
		$output=array();
		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');		
		Bin_Template::createTemplate('sitemap.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
	}

	/**
	 * Function is to get the php information
	 * 
	 * 
	 * @return array
	 */
	function getPHPInfo()
	{	
		$output=array();
		$output['siteinfo']=phpinfo();
	}
	/**
	 * Function is displays the php information
	 * 
	 * 
	 * @return array
	 */
	function displayPHPInfo()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');		
		Bin_Template::createTemplate('siteinfo.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
	}
	
}
?>