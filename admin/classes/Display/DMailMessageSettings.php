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
 * This class contains functions to list out the mail message settings available.
 *
 * @package  		Display_DMailMessageSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DMailMessageSettings
{
	
	/**
	 * Function creates a template to display the mail messages available. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	function showMailMessages($arr)
	{
	
		$output = "";
		
		$output .= '<table border="1">';
		$output.='<th>S.no.</th><th>Mail Subject</th><th>Mail Message</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
	
			$message=$arr[$i]['mail_msg'];
			$msg=str_replace('==',' ',$message);
			$msg=substr($msg,0,30).'..';
			
			$output .= '<tr><td>'.($i+1).'</td><td>'.$arr[$i]['mail_msg_subject'].'</td>';
			$output .= '<td>'.$msg.'</td>';			
			$output.='<td><input type="button" name="Edit"  title="Edit" value="Edit" onclick=edit('.$arr[$i]['mail_msg_id'].') /></td>';
		}
		$output .= '</td></tr></table>';
		return $output;
			
	}
	
	/**
	 * Function creates a template to show  the mail messages available. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	
	function displayMessage($arr)
	{
	
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output.='<form name="formeditmessages" action="?do=mailmessages&action=edit&id='.(int)$_GET['id'].'" method="post" >';
		$output .= '<table border="1"><tr><td>';
		
		$output.='<div> Mail Subject: '.$arr[0]['mail_msg_subject'].' </div>&nbsp;';
		$output.='<div>Mail Message: </div> 
<div><textarea name="mailmessages" id="mailmessages" cols="80" rows="20" >'.$arr[0]['mail_msg'].'</textarea>
</div>
<div  style="text-align:right"><input type="submit" name="submit1" id="sub1" value="Update" /></div>';
		
		$output .= '</td></tr></table></form>';
		return $output;
	}	
	
	
}
?>