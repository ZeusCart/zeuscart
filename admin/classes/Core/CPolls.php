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
 * CPolls
 *
 * This class contains functions to get the poll details from the database
 *
 * @package		Core_CPolls
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Core_CPolls
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */
	var $output = array();
	
	/**
	 * Function gets the category to be displayed
	 * 
	 * 
	 * @return string
	 */
	
	
	function showCategories()
	{
		/**
		*
		* Here database query comes
		*
		*/
		return Display_DPolls::showCatList();

	}
	
	
	/**
	 * Function gets the topics to be displayed
	 * 
	 * 
	 * @return string
	 */
	
	
	function showTopics()
	{
		
		return Display_DPolls::showTopicsList();
	
	}
	
	
	/**
	 * Function get the poll details 
	 * 
	 * 
	 * @return string
	 */
	
	
	
	function showPolls()
	{
	
		/*$sql = "SELECT * FROM users WHERE uid='1'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$obj->records
		
		}*/
		
		return  Display_DPolls::showPollsList($obj->records);
	
	}


}



?>