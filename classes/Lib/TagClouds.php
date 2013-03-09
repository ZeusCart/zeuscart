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
 * TagClouds
 *
 * This class contains functions to handle tag clouds.
 *
 * @package		Lib_TagClouds
 * @category	Library
 * @author		AJDF Development Team
 * @link		http://ajdf.ajsquare.com
 * @version 	1.0
 */

// ------------------------------------------------------------------------
 
class Lib_TagClouds
{
	function displayTagClouds($tags,$onClick='')
	{
		$res='';
		
		if(!(empty($tags)))
		{
			//ksort($tags);
			
			$max_size = 30; // max font size in pixels
			$min_size = 10; // min font size in pixels
			
			// largest and smallest array values
			$max_qty = max(array_values($tags));
			$min_qty = min(array_values($tags));
			
			// find the range of values
			$spread = $max_qty - $min_qty;
			if ($spread == 0) { // we don't want to divide by zero
					$spread = 1;
			}
			
			// set the font-size increment
			$step = ($max_size - $min_size) / ($spread);
			
			// loop through the tag array
			
				foreach ($tags as $key => $value) {
						// calculate font-size
						// find the $value in excess of $min_qty
						// multiply by the font-size increment ($size)
						// and add the $min_size set above
						$size = round($min_size + (($value - $min_qty) * $step));
				
						$res.= '<a href="'.$onClick.$key.'" style="text-decoration:none; font-size: ' . $size . 'px" title="' . $value . ' things tagged with ' . $key . '" >' . $key . '</a> ';
				}
		}
		
		return $res;
	}
}
?>