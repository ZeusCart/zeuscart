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

		$output.='<form action="?do=dynamiccms&action=delete" method="post"  id="dynamicPagedeleteForm">
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>

		<th align="left">S.No</th>
		<th align="left">Title</th>
		<th align="left">Subject</th>
		<th align="left" width="8%">Options</th>
		</tr>
		</thead>
		<tbody>';

		$cnt = count($arr);

		if($flag=='0')
			$output .= '<tr><td align="center" colspan="6"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				
				$message=$arr[$i]['mail_msg'];
				$msg=str_replace('==',' ',$message);
				$msg=substr($msg,0,30).'..';
	
				$output .= '<tr ><td >'.($i+1).'</td><td>'.$arr[$i]['mail_msg_title'].'</td><td>'.$arr[$i]['mail_msg_subject'].'</td>';				
								
				$output .='<td align="center"><a  href="?do=mailmessages&amp;action=disp&amp;id='.
				$arr[$i]['mail_msg_id'].'"><i class="icon icon-edit"></i></a></td></tr>';
				$output .='</tr>';
			}
		

		}
		$output .= '</tbody></table>';
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
	
		$output.='
			<div class="row-fluid">
			<div class="span6"><label> '.$arr[0]['mail_msg_title'].' </label>
				<input type="text" name="mail_msg_subject" value="'.$arr[0]['mail_msg_subject'].'" class="span12"></div><div class="span6"><label> &nbsp;</label>Subject</div></div>
			<div class="row-fluid">
			<div class="span6">
			<label>Mail Message <font color="red">*</font> </label>
				<textarea  style="width: 428px; height: 200px;" name="mailmessages" >'.$arr[0]['mail_msg'].'</textarea>
				</div><div class="span6">
			<label>&nbsp;</label>Message Body<br/><br/>Short Code : <br/>'.$arr[0]['mail_short_code'].'</div></div>

			</div>';
		return $output;
	}	
	
	
}
?>