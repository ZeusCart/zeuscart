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
 * CPrivacyPolicy
 *
 * This class contains functions to get and update the privacy policy content.
 *
 * @package		Core_CPrivacyPolicy
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Core_CPrivacyPolicy
{

	
	/**
	 * Function gets the privacy policy from the database
	 * 
	 * 
	 * @return string
	 */

	function selectPrivacyPolicy()
	{
		$sql="SELECT privacypolicy,id FROM privacypolicy_table ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return $query->records[0]['privacypolicy'];
		}
		else
		{
			return "";
		}
	}
	
	
	/**
	 * Function updates the privacy policy content into the database
	 * 
	 * 
	 * @return string
	 */
	
	function updatePrivacyPolicy()
	{
		
		$sql = "UPDATE privacypolicy_table SET privacypolicy='".$_POST['privacypolicy']."' Where id=1" ;
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		{
			return '<div class="success_msgbox">Privacy Policy Updated Successfully</div>';
		}
		else
		{
				return '<div class="error_msgbox">Privacy Policy Not Updated </div>';
		}
	}
	
}
?>
