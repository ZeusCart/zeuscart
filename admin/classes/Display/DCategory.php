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
 * DCategory
 *
 * This class contains functions to list out the category and subcategory details.
 *
 * @package		Display_DCategory
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Display_DCategory
{
	
	/**
	 * Function returns the category details.
	 * @param array $arr	
	 * 
	 * @return string
	 */
	function allCat($arr)
	{
	include 'admin/cache/sitesettings.php';
	$path='classes/Lib/Local/'.$sitesettings['language'].'/localization.php';
	include $path;
		$output="";
		$cont=count($arr);
		for($i=0; $i<$cont; $i++)
		{
		 $output .='<a href="?do=allcat&id='.$arr[$i]['cat_id'].'">'.$arr[$i]['cat_name'].'</a>';
		}
		
		return $output;
		
	}
	
	
	/**
	 * Function returns the sub category details.
	 * @param array $arr	
	 * 
	 * @return string
	 */
	
	function showSub($arr)
	{
	include 'admin/cache/sitesettings.php';
	$path='classes/Lib/Local/'.$sitesettings['language'].'/localization.php';
	include $path;		 
		$obj=new Core_Category_CCategory();
	 	$output="";
		$cont=count($arr);
		for($i=0;$i<$cont;$i++)
		{	//echo"<pre>";		
			$sub=$obj->showSubCat($arr[$i]['subcat_id']);
			$count = count($sub);
			if($count > 0)
				$link = "?do=allcat&id=".($arr[$i]['subcat_id']);
			else
				$link = "?do=search&id=".($arr[$i]['subcat_id']);
			
				$output .='<td width=20% align="left" class="buy_txt" valign="top"><a href="'.$link.'" class="buy_head_link">'.$arr[$i]['subcat_name'].'</a><br>';
				if(count($sub) > 3)
					$count = 3;
				else
					$count = count($sub);
				for($j=0;$j<$count;$j++)
				{
					//$output .='<li><a href="?do=search&pid='.($arr[$i]['subcat_id']).'&id='.$sub[$j]['subcat_id'].'" class="list_style_link">'.$sub[$j]['subcat_name'].'</a></li>  ';	
					$sub1=$obj->showSubCat($sub[$j]['subcat_id']);
					
					$count_sub = count($sub1);
					
//					if($count_sub > 0 )
//						$sub_link = "?do=allcat&id=".$sub[$j]['subcat_id'];
//					else
						$sub_link = "?do=search&pid=".($arr[$i]['subcat_id'])."&id=".$sub[$j]['subcat_id'];
					
					$output .='<a href="'.$sub_link.'" class="list_style_link">'.$sub[$j]['subcat_name'].'</a> | ';
				}
				if(count($sub) > 0)
					$output .=' <a href="'.$link.'" class="list_style_link">'.$localization['ENG1512'].' ...</a>';
			$output .='</td>';
			if($i%3==0 && $i>0)
				$output .='</tr>
							<tr>
								<td colspan=3 height=10></td>
							</tr>
						  <tr>';
		}
		return $output;
		
	}
	 
	
	
}



?>