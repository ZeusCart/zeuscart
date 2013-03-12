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
 * This class contains functions to display the search results.
 *
 * @package  		Display_DNarrowSearch
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DNarrowSearch
{
 		
	/**
	 * Function creates a template to display the search results. 
	 * @param array $result
	 * 
	 * @return void
	 */
	function displayNarrowSearch($result)
	{
	   print_r($result);
	   
	   exit;
	   
	}
	
	/**
	 * Function creates a template to display the brand count available. 
	 * @param array $result
	 * 
	 * @return string
	 */
	
	function dispBrandWithCount($result)
	{
	    
	    if((count($result))>0)
		{
		
		     $output='<table cellpadding="3" cellspacing="0" border="0"><th>Brand</th>';
		     foreach($result as $row)
			 {
			    $brand=$row['brand'];
				$cnt=$row['cnt'];
			     $output.='<tr><td><a href="#">'.$brand.'('.$cnt.')</a></td></tr>';
			 }
			 $output.='</table>';
			 
		}
		return $output;
		
	}
}
?>