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
 * This class contains functions to generate a drop down list for the existing categories.
 *
 * @package  		Core_Category_CCategory
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_Category_CCategory 
{
	
	/**
	 * Function generates an drop down list with the category details. 
	 * 
	 * 
	 * @return array
	 */		
	
	function showCat()
	{
	  include('classes/Lib/Components.php');
		//$components = new Lib_Components();
		$this->data['allcat'] = $this->createComponent('combobox',$this->getListValues('category'),'name=id class=category_box',$_GET['id']);
		$this->makeConstants($this->data,$prefix='');
	}

	/**
	 * Function generates an drop down list with the category details. 
	 * 
	 * 
	 * @return array
	 */		
	
	function showCategory()
	{
	  $obj=new Lib_Components();
	 
  $obj=new Core_Category_CCategory();
//	  $obj1->getListValues($c);
	  $this->data['category']=$this->createComponent('combobox',$this->getListValues('category'),'name=id class=category_box',$_GET['id']);
	  $this->makeConstants($this->data,$prefix='');
	}
	
	/**
	 * Function gets the details need for generating the drop down list. 
	 * 
	 * @param string $name
	 * @return array
	 */
	
	function getListValues($name)
	{
		if($name == 'category')
		{
			$sql = "SELECT * FROM category_table where category_parent_id=0 order by category_name";
			$cquery = new Bin_Query();
			if($cquery->executeQuery($sql))
				$records = $cquery->records;
			$category = array("category"=>"All Categories");
			for ($i=0;$i<count($records);$i++)
				$category[$records[$i]['category_id']] = $records[$i]['category_name'];
			return $category;
			
		}
	}
	
	/**
	 * Function generates an drop down list with the attribute details. 
	 * 
	 * 
	 * @return array
	 */
	
	function showAttrib()
	{
	
		$components = new Lib_Components();
		$this->data['allatt'] = $components->createComponent('combobox',$this->getAttribListValues('attrib'),'name=id 		class=attrib_box',$_GET['attid']);
		
		$this->makeConstants($this->data,$prefix='');
	}
	
	/**
	 * Function gets the attribute values from the attribute table. 
	 * 
	 * @param string $name
	 * @return array
	 */
	
	function getAttribListValues($name)
	{
		if($name == 'attrib')
		{
		
			$sql = "SELECT * FROM attribute_table ";
			$cquery = new Lib_Query();
			if($cquery->executeQuery($sql))
				$records = $cquery->records;
			$attrib = array("all"=>"All attributes");
			for ($i=0;$i<count($records);$i++)
				$attrib[$records[$i]['attrib_id']] = $records[$i]['attrib_name'];
			
			return $attrib;
			
		}
	}
	
	/**
	 * Function generates constants for the supplied field values.
	 * @param array $fields
	 * @param string $prefix
	 * @return array
	 */
	function makeConstants($fields,$prefix='')
	{ 
		
		foreach ($fields as $key=>$item)
		{
			define($prefix.strtoupper($key),$item);
		}
	}
	
}
?>

