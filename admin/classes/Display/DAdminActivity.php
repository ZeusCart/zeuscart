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
 * DAdminActivity
 *
 * This class contains functions to list the admin visited pages.
 *
 * @package		Display_DAdminActivity
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

 class Display_DAdminActivity
{
 	
	/**
	 * Function display the admin visited pages. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	function listActivity($arr,$paging,$prev,$next,$val)
	{
		
		$output = '<br><table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
                <td class="content_list_head" align="center" width=5%>S.No</td>
                <td class="content_list_head" width=10%>User</td>
                <td class="content_list_head" width=60%>URL</td>
                <td class="content_list_head" width=20%>Visited on</td>				
                </tr>
              <tr>
                <td colspan="4" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
			
	$URL = "http://".$_SERVER["SERVER_NAME"];		
	 if(count($arr)>0)
	 {
		for ($i=0;$i<count($arr);$i++)
		{
			/*$visiteddatetime=$arr[$i]['visited_on'];
			$visited_date_time = explode(" ",$visiteddatetime);
			$visited_date = explode("-",$visited_date_time[0]);
			$visited_time = explode(":",$visited_date_time[1]);

			$visiteddate=date("M d, Y H:i:s",mktime($visited_time[0],$visited_time[1],$visited_time[2],$visited_date[1],$visited_date[2],$visited_date[0]));*/
			$visiteddatetime=$arr[$i]['visited_on'];
			$visited_date_time = explode(" ",$visiteddatetime);
			$visited_date = explode("-",$visited_date_time[0]);
			$visited_time = explode(":",$visited_date_time[1]);
			$visiteddate=date("l, M d, Y H:i:s",mktime($visited_time[0],$visited_time[1],$visited_time[2],$visited_date[1],$visited_date[2],$visited_date[0]));
				
			if($i % 2 == 0)
				$classtd='content_list_txt1';
			else
				$classtd='content_list_txt2';
				
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
			<td align="center" class="'.$classtd.'">'.($val+1).'</td>
			<td align="" class="'.$classtd.'">'.$arr[$i]['user'].'</td>
			<td align="" class="'.$classtd.'">'.$URL.$arr[$i]['url'].'</td>
			<td align="" class="'.$classtd.'">'.$visiteddate.'</td>
			</tr>';
			$val++;
		}
		 $output.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next.'</td></tr>';
	}
	else
		$output.='<tr><td colspan=2 valign="bottom" align="center">No Activity Found!<br/>&nbsp;</td></tr>';
						
		$output .= '</table>';
		return $output;
		
	}
}
?>
