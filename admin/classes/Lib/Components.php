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
 * This class contains functions related to create selet box
 *
 * @package  		Lib_Components
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_Components
{
	/**
	 * Function  to display   the  list of orders
	 * @param string $type
	 * @param array $values
	 * @param  string $att
	 * @param  integer $default
     	 * @return string
	 */	
	function createComponent($type,$values,$att,$default=0)
	{
		if($type=="combobox")
		{
			if(is_array($values))
				return $this->createComboBox($values,$att,$default);
			else
				return false;	
		}
	}
	/**
	 * Function  to display   the  list of orders
	 * @param array $values
	 * @param  string $att
	 * @param  integer $default
         * @return string
	 */	
	function createComboBox($values,$att,$default)
	{	
	
		$component = '<select '.$att.'>';
		foreach($values as $key=>$item)
		{		
			$component .= '<option value="'.$key.($key==$default  ? '"  selected' : '').'">'.$item.'</option>';
		}
		return $component .= '</select>';	
	}

}

?>