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
 * CCategory
 *
 * This class contains functions to get the category list values and attributes 
 *
 * @package		Core_Category_CCategory
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------



class Core_Category_CCategory 
{
	
	/**
	 * Function generates a dropdown list for the categories available in the database
	 * 
	 * 
	 * @return string
	 */
	function showCat()
	{
		
		$components = new Lib_Components();

		return $this->data['allcat'] = $components->createComponent('combobox',$this->getListValues('category'),'name="catid" 		class="txt_box250", onchange="callContent(this.value);"', $_GET['id']);
		//$this->makeConstants($this->data);
		
	}
	
	
	/**
	 * Function generates a dropdown list for the categories available in the database
	 * 
	 * @param string $name
	 * @return string
	 */
	 
	function getListValues($name)
	{
		if($name == 'category')
		{
			$sql = "SELECT * FROM category_table where category_parent_id=0 order by category_name ";
			$cquery = new Bin_Query();
			if($cquery->executeQuery($sql))
				$records = $cquery->records;
			$category = array("all"=>"All Categories");
			for ($i=0;$i<count($records);$i++)
				$category[$records[$i]['category_id']] = $records[$i]['category_name'];
			
			return $category;
			
		}
	}
	
	/**
	 * Function generates a dropdown list for the attribute values available in the database 
	 * 
	 * 
	 * @return array
	 */
	
	
	function showAttrib()
	{
	
		$components = new Lib_Components();
		$this->data['allatt'] = $components->createComponent('combobox',$this->getAttribListValues('attrib'),'name=id 		class=attrib_box',$_GET['attid']);
		
		$this->makeConstants($this->data);
	}
	
	
	/**
	 * Function gets the attribute list values from the database
	 * @param string $name
	 * 
	 * @return array
	 */
	
	function getAttribListValues($name)
	{
		if($name == 'attrib')
		{
		
			$sql = "SELECT * FROM `attribute_table` order by attrib_name asc ";
			$cquery = new Bin_Query();
			if($cquery->executeQuery($sql))
				$records = $cquery->records;
			$attrib = array("all"=>"All attributes");
			for ($i=0;$i<count($records);$i++)
				$attrib[$records[$i]['attrib_id']] = $records[$i]['attrib_name'];
			
			return $attrib;
			
		}
	}
	
	/**
	 * Function generates constants for the fields supplied
	 * @param array $fields
	 * @param string $prefix
	 * @return string
	 */
	
	function makeConstants($fields,$prefix='')
	{ 
		//print_r($fields);
		foreach ($fields as $key=>$item)
		{
			define($prefix.strtoupper($key),$item);
		}
	}
	
}
?>
