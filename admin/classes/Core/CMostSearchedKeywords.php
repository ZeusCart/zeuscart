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
 * This class contains functions to get the most searched keywords frequency
 *
 * @package  		Core_CMostSearchedKeywords
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CMostSearchedKeywords
{
	
	/**
	 * Function gets the most search keyword frequency from the database
	 * 
	 * 
	 * @return string
	 */
	

	function showMostSearchedKeywords()
	{
		
	   $pagesize=25;
	   if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;
		
		
		$sql = "select search_tag as keyword,search_count as cnt from search_tags_table order by search_count desc ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select search_tag as keyword,search_count as cnt from search_tags_table order by search_count desc LIMIT $start,$end";
			$query1 = new Bin_Query();
			
			if($query1->executeQuery($sql1))
			{
				return Display_DMostSearchedKeywords::showMostSearchedKeywords($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No Contents Found";
		}
	}
	
}
?>