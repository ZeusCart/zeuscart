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
class Core_CTagClouds
{
	/**
	* This function is used to Display the search tag 
	
	* @return string
 	*/
	function displayTagClouds()
	{
		$sql='select search_tag as keyword,search_count as cnt from search_tags_table order by keyword asc' ;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
				
		$arr=array();
		if (!empty($val))
		{
			foreach($obj->records as $row)
				$arr[$row['keyword']]=$row['cnt'];
			
			$onClick='?do=search&search=';
						
			$odjCloud=new Lib_TagClouds();
			$res=$odjCloud->displayTagClouds($arr,$onClick);
		}
		return $res;
	}
	
	
	
	
}

?>