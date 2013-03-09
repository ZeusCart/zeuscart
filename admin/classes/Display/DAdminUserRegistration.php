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
 * DAdminUserRegistration
 *
 * This class contains functions to show and edit admin informations.
 *
 * @package		Display_DAdminUserRegistration
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

$arr = array();
$output = array();
class Display_DAdminUserRegistration
{
	/**
	 * Function to show admin detail. 
	 * @param array $arr
	 * @param integer $flag	 
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @return string
	 */
	function showUserDetail($arr,$flag,$paging,$prev,$next)
	{
	$output = '<form name="search" method="post" action="?do=userdetail&action=search" >';
		$output .= '<script language="JavaScript">
					function condelete()
					{
						var confrm;
						confrm=window.confirm("Are You sure to delete this record");
						return confrm;
					}</script>';	
		
		$output.='<table width="97%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr" align="center">
              <tr>
                <td  class="content_list_head">S.No</td>
                <td class="content_list_head">Display Name</td>
				<td class="content_list_head">First Name</td>
				<td class="content_list_head">Last Name</td>
				<td class="content_list_head">Email</td>
				<td class="content_list_head">Status</td>
				<td class="content_list_head">Options</td>
                
                </tr>
              <tr>
                <td colspan="9" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		$cnt = count($arr);
			  $output .= '<tr class="list_search_bg" ><td class="content_list_txt1"></td><td class="content_list_txt1"><input type="text"  name="displayname" id="displayname" size="30"  style="width:75px;"  value="'.$_POST['displayname'].'"/></td><td class="content_list_txt1"><input type="text" size="30"  style="width:75px;" name="firstname" id="firstname" value="'.$_POST['firstname'].'"/></td>
<td class="content_list_txt1"><input type="text"  name="lastnname" id="lastnname" size="30" style="width:75px;" value="'.$_POST['lastnname'].'"/></td><td class="content_list_txt1"><input type="text" name="email" id="email" style="width:155px;" size="30" value="'.$_POST['email'].'"/></td><td class="content_list_txt1">
<select id="visibility" name="status" type="select" style="width:36px" >';
	if($_POST['status']=="") 
	{
		$output.='<option value="" selected="selected" ></option>
		<option value="1" >Active</option>
		<option value="0" >Inactive</option>';
		
	}
	elseif($_POST['status']==1)
	{
		$output.='<option value="" ></option>
		<option value="1" selected="selected" ><!--Active--></option>
		<option value="0" >Inactive</option>';
	}	
	else
	{
		$output.='
		<option value="" ></option>
		<option value="1" >Active</option>
		<option value="0" selected="selected" ><!--Inactive--></option>';
	}
			$output.='<td class="content_list_txt1"><input class="all_bttn" type="submit" name="search" value="Search"/></td></tr></form>';
		//$output .='<tr><td colspan="8" align="right"><b>Search</b>&nbsp;&nbsp;<input type="text" name="search">
					//<input type="button" name="btnsearch" value="Search"></td></tr>';
		//$output.='<th>S.no.</th><th>Display Name</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Edit</th>
					//  <th>Delete</th><th>Status</th>';
		if($flag=='0')
			$output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				$output.='';
				$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td '.$classtd.' >'.($i+1).'</td><td '.$classtd.'>'.$arr[$i]['user_display_name'].'</td><td '.$classtd.'>'.$arr[$i]['user_fname'].'</td>';
				$output .='<td '.$classtd.'>'.$arr[$i]['user_lname'].'</td>
				<td '.$classtd.'><a href=mailto:'.$arr[$i]['user_email'].'">'.$arr[$i]['user_email'].'</a></td>';
				/*$output .='<td '.$classtd.'><a href="?do=editreg&action=edit&id='.$arr[$i]['user_id'].'"><font color="blue">Edit</font></a></td>';*/
				
				if($arr[$i]['user_status']==0)
				{
					$output .='<td '.$classtd.' align="center"><a href="?do=regstatus&action=accept&id='.$arr[$i]['user_id'].'" class="inactive_link" title="Click to active">&nbsp;<!--Inactive--></a></td>';
				}
				else
				{
					$output .='<td '.$classtd.' align="center"><a href="?do=regstatus&action=deny&id='.$arr[$i]['user_id'].'" class="active_link" title="Click to In Active">&nbsp;<!--Active--></a></td>';
				}
				$output .='<td '.$classtd.' align="center"><a href="?do=deletereg&action=delete&id='.$arr[$i]['user_id'].'" onclick="javascript:return condelete()" class="delete_bttn"> &nbsp;<!--Delete--> </a></td></tr>';
			}
		}
			$output .='<tr><td colspan="9" align="right" class="content_list_txt1">'.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
			$output .= $pagingvalues.' '.$next.'</td></tr>';

			$output .= '</table>';
			return $output;
			
	}
	
	/**
	 * Function to edit the admin information. 
	 * @param array $arr
	 * @return string
	 */
	function editUserDetail($arr)
	{
		$output = "";
		$output .='<form name="edituser" method="post" action="?do=updatereg&action=update&id='.(int)$_GET['id'].'">
		           <table border="1" width="27%">';
		
			
			$output .= '<tr><td><b>Display Name</b></td><td><input type="text" size="22" name="disname" value="'.$arr['val']['user_display_name'].'">		                        </td></tr><tr><td><b>FirstName</b></td><td><input type="text" size="22" name="fname" size="22" value="'.$arr['user_fname'].'">                        </td></tr>';
			$output .='<tr><td><b>LastName</b></td><td><input size="22" type="text" name="lname" value="'.$arr['user_lname'].'"></td></tr><tr><td><b>Email</b></td><td><input size="22" type="text" name="txtemail" value="'.$arr['user_email'].'"></td></tr><tr>
					   <td colspan="2" align="center"><input type="submit" name="submit" value="Update" /></td></tr>';
			$output .= '</table></form>';
			return $output;		
	}
	function dispCountry($arrCountry)
	{
		$output1='<select name="selCountry" id="select3" class="listbox1 w4a TxtC1">';
		if(count($arrCountry)>0)
		{		
		 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
		}
			 $output1.='</select>';
		return $output1;
	}
}

?>