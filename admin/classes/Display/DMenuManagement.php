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
 * This class contains functions related to menu management
 *
 * @package  		Display_DMenuManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DMenuManagement
{
	/**
	 * Function to show menu title list in drop down view 
	 * @param array $records
	 * @return string
	 */
	function showMenutitleList($records)
	{
		

	        $output='<div class="tab_new">
                 	 <ul>';
				if(count($records)>0)
				{
					for($i=0;$i<count($records);$i++)
					{
		
						$output.=' <li><a href="?do=menus&id='.$records[$i]['menu_id'].'">'.$records[$i]['menu_title'].'</a></li>';
					}
				}
                 $output.='  <li><a href="?do=menus&id=0">+</a></li></ul>
                 <div class="clear"></div>
                </div>';
		
// 		if(count($records)>0)
// 		{
// 			for($i=0;$i<count($records);$i++)
// 			{
// 
// 				$output.='<a href="?do=menus&id='.$records[$i]['menu_id'].'">'.
// 				$records[$i]['menu_title'].'</a>&nbsp;&nbsp;&nbsp;';
// 				$navigation=json_decode($records[$i]['menu_navigation'],true);
// 				
// 				if($records[$i]['menu_id']==$_GET['id'])
// 				{	
// 					$output.='<tr><td align="left" width="10%" class="content_form">';
// 					for($j=0;$j<count($navigation);$j++)
// 					{
// 						$output.='<select><option>'.$navigation[$_GET['id']][$j].'</option></select>
// 						';
// 					}
// 					$output.='</td></tr>';
// 				}
// 				
// 			}
// 		}

	 	
				

		return $output;
			
	}
	/**
	 * Function to show menu type list in drop down view 
	 * @param array $records
	 * @return string
	 */
	function showMenuTypeList($records)
	{
	
		$output='<table width="30%" cellspacing="0" cellpadding="8" border="0" class="content_list_bdr"><tbody><tr><td>Category</td></tr></tr><tr onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);">';
		
		$output='</tr>
		</tbody></table><table>&nbsp;</table>';
				
		
		

		return $output;
			
	}
	/**
	 * Function to show category   list in drop down view 
	 * @param array $arr
	 * @return string
	 */
	function showCategoryList($arr)
	{
		$output='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$cnt=count($arr);
		if($cnt>0)
		{
			
			for($i=0;$i<$cnt;$i++)
			{
				$output.=' <tr class="row_02">
				<td width="17%" align="left" valign="top"><input type="checkbox" name='.$arr[$i]['category_name'].' value='.$arr[$i]['category_name'].'  onclick="selectCategory(this.value);"/></td>
				<td width="83%" align="left" valign="middle"><a href="javascript:void(0);" onclick="selectCategory(this.value);">'.$arr[$i]['category_name'].'<a/></td>
				</tr>';
				$sqlsub="SELECT * FROM  category_table WHERE  category_parent_id='".$arr[$i]['category_id']."' AND sub_category_parent_id ='0'"; 
				$objsub=new Bin_Query();
				$objsub->executeQuery($sqlsub);
				$recordssub=$objsub->records;
				for($j=0;$j<count($recordssub);$j++)
				{
					$output.='<tr class="row_02" >
					<td width="17%" align="left" valign="top" ><input type="checkbox" name='.$recordssub[$j]['category_name'].' value='.$recordssub[$j]['category_name'].'  onclick="selectCategory(this.value);"/></td>
					<td width="83%" align="left" valign="middle"><a href="javascript:void(0);" onclick="selectCategory(this.value);">'.$recordssub[$j]['category_name'].'</a></td>
					</tr>';

					$query = new Bin_Query(); 
					$sql = "SELECT * FROM `category_table` WHERE sub_category_parent_id =".$recordssub[$j]['category_id']." AND category_status =1 order by category_name limit 16";
					$query->executeQuery($sql);
					$count=count($query->records);
					$records=$query->records;
					if($count>0)
					{
						for($k=0;$k<$count;$k++)
						{
							$output.='<tr class="row_02">
							<td width="17%" align="left" valign="top" ><input type="checkbox" name='.$records[$k]['category_name'].' value='.$records[$k]['category_name'].'  onclick="selectCategory(this.value);"/></td>
							<td width="83%" align="left" valign="middle"><a href="javascript:void(0);" onclick="selectCategory(this.value);">'.$records[$k]['category_name'].'</a></td>
							</tr>';

						}
					}
				}
			
			}

		}


		$output.=' </table>  </div>';

		return $output;
	}

	function selectedMenuNavigation()
	{

		for($i=0;$i<count($_SESSION['navigation']);$i++)
		{
			$output.='<select><option>'.$_SESSION['navigation'][$_GET['mid']][$i].'</option></select><br/>';
		}	
	
		
		return $output;
	}
	

}

?>