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
class Display_DHome
{
 	/**
	* This function is used to Display the Footer links
	* @name footer
	* @param mixed $arr
	* @return string
 	*/
	function footer($arr)
   	{
		$output = "";
		
		$output .= '<div id="btm_links"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td class="custom_footer">';
		for ($i=0;$i<count($arr);$i++)
		{
		
		$output.='<a href="userpage/'.$arr[$i]['link_url'].'" name="link" >'.$arr[$i]['link_name'].'</a>';
		
		}
		$output.='</td></tr> </table></div>';
		return $output;
	}

 	/**
	* This function is used to Display the Home Page Banner
	* @name getBanner
	* @param mixed $arr
	* @return string
 	*/
	function getBanner($arr)
	{
		return '<div style="margin-bottom:14px">
				<a href="'.$arr['bannerUrl'].'">
					<img src="'.$arr['bannerImage'].'" width="464" height="174" border="0"/>
				</a>
			</div>';
	}
}	
?>