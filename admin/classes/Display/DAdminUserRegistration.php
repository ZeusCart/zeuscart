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
 * This class contains functions to show and edit admin informations.
 *
 * @package  		Display_DAdminUserRegistration
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DAdminUserRegistration
{
	/**
	 * Stores the value
	 *
	 * @var array 
	 */	
	//$val = array();
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	//$output = array();

	/**
	 * Function to show user detail. 
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
		$output .= '';	
		
		$output.='  <div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		
		<th align="left">S.No</th>
		<th align="left">Display Name</th>
		<th align="left">First Name</th>
		<th align="left">Last Name</th>
		<th align="left">Email</th>
		<th align="left">Status</th>
		<th align="left">Options</th>

		</tr>
		</thead>
		<tbody>';
		$cnt = count($arr);
		$output .= '<tr class="list_search_bg" ><td class="content_list_txt1"></td><td class="content_list_txt1"><input type="text"  name="displayname" id="displayname" size="30"  style="width:75px;"  value="'.$_POST['displayname'].'"/></td><td class="content_list_txt1"><input type="text" size="30"  style="width:75px;" name="firstname" id="firstname" value="'.$_POST['firstname'].'"/></td>
		<td class="content_list_txt1"><input type="text"  name="lastnname" id="lastnname" size="30" style="width:75px;" value="'.$_POST['lastnname'].'"/></td><td class="content_list_txt1"><input type="text" name="email" id="email" style="width:155px;" size="30" value="'.$_POST['email'].'"/></td>';

		$output.='<td ><select id="visibility" name="status" type="select" style="width:60px" >';

		$pstatus=array("All"=>"-1",'Active'=>1,'Inactive'=>0);
		if($_POST['status']=='')
		$stat=-1;
		else
		$stat=$_POST['status'];
		foreach($pstatus as $key=>$val)
		{
			$output .=  ($stat == $val)? '<option value="'.$val.'" selected="selected">'.$key.'</option>' : '<option value="'.$val.'" >'.$key.'</option>' ;
		}

		$output.='</select></td>';

		$output.='<td class="content_list_txt1"><input class="clsBtn" type="submit" name="search" value="Search"/></td></tr></form>';
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
				
				$output.='';
				$output .= '<tr><td  >'.($i+1).'</td><td ><a href="?do=customerdetail&action=detail&userid='.$arr[$i]['user_id'].'">'.$arr[$i]['user_display_name'].'</a></td><td >'.$arr[$i]['user_fname'].'</td>';
				$output .='<td >'.$arr[$i]['user_lname'].'</td>
				<td ><a href="mailto:'.$arr[$i]['user_email'].'">'.$arr[$i]['user_email'].'</a></td>';
								
				if($arr[$i]['user_status']==0)
				{
					$output .='<td  align="center"><a href="?do=regstatus&action=accept&id='.$arr[$i]['user_id'].'" class="inactive_link" title="Click to active"><span class="badge badge-important">Inactive</span></a></td>';
				}
				else
				{
					$output .='<td  align="center"><a href="?do=regstatus&action=deny&id='.$arr[$i]['user_id'].'" class="active_link" title="Click to In inactive"><span class="badge badge-info">Active</span></a></td>';
				}
				$output .='<td  align="center"> <a title="Edit"  href="index.php?do=editreg&action=edit&userid='.$arr[$i]['user_id'].'"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;
				
					<a onclick="return confirm(\'Are you sure want to delete this user?\')" id="delete_admin_user" title="Delete"  href="?do=deletereg&action=delete&id='.$arr[$i]['user_id'].'"><i class="icon-trash"></i></a></td></tr>';
			}
			$output .='<tr>
			<td colspan="7" class="clsAlignRight">
			<div class="dt-row dt-bottom-row">
			<div class="row-fluid">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>'.$prev.' ';
			
			for($i=1;$i<=count($paging);$i++)
				$pagingvalues .= $paging[$i]."  ";
			
			$output .= $pagingvalues.' '.$next.'</ul></div>
			</div>
			</div>
			</td>
			</tr>';

		}
		
		

		$output .= '</tbody></table></div></div>';
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
	/**
	 * Function to display the country. 
	 * @param array $arrCountry
	 * @return string
	 */
	function dispCountry($arrCountry)
	{
		$output1='<select name="selCountry" id="select3" class="listbox1 w4a TxtC1" style="width:290px;">';
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

	function editGroup($arrGroup,$groupid)
	{
		
		$group='<select name="editGroup" id="select3" class="listbox1 w4a TxtC1" style="width:290px;" >';
		if(count($arrGroup)>0)
		{
			for($i=0;$i<count($arrGroup);$i++)
			{
				$sel='';
				if($groupid==$arrGroup[$i]['group_id'] ){
				
				$sel='selected';
				
				}
				
				$group.='<option value="'.$arrGroup[$i]['group_id'].'" '.$sel.'>'.$arrGroup[$i]['group_name'].'</option>';
			}
		}
		else
		{
				$group.='<option value="1" '.$sel.'>Default</option>';
		}
		$group.='</select>';
		return $group;
		
	}
	function getGroup($arrGroup,$groupid)
	{
		
		$group='<select name="getGroup" id="select3" class="listbox1 w4a TxtC1" style="width:290px;" >';
		if(count($arrGroup)>0)
		{
			for($i=0;$i<count($arrGroup);$i++)
			{
				$sel='';
				if($groupid==$arrGroup[$i]['group_id'] ){
				
				$sel='selected';
				
				}
				
				$group.='<option value="'.$arrGroup[$i]['group_id'].'" '.$sel.'>'.$arrGroup[$i]['group_name'].'</option>';
			}
		}
		else
		{
				$group.='<option value="1" '.$sel.'>Default</option>';
		}
		$group.='</select>';
		return $group;
		
	}
	function editCountry($arrCountry,$cntcode)
	{
	 
		$output1='<select name="editCountry" id="select3" class="listbox1 w4a TxtC1" style="width:290px;">';
		if(count($arrCountry)>0)
		{		
		 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($cntcode==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
		}
			 $output1.='</select>';
		return $output1;
	}
	/**
	 * Function to display the customer detail with multi address
	 * @param array    $recordsuser
	 * @param  array   $records	
	 * @return string
	 */
	function customerDetail($recordsuser,$records)
	{
		$output='<div class="menu_new clsBtm_20">
		<div class="row-fluid">
		<div class="span9"><h2>Customer Details</h2>
		</div>
		<div class="span3" >

		<ul class="bttn_right">
		<li><a href="javascript:history.go(-1)" class="back_icon1" ></a></li>

		</ul>

		</div>

		</div>
		</div>

		<div class="row-fluid">
		<div class="span12">

		<h2 class="box_head green_bg">Profile</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">

		<div class="row-fluid">

		<div class="span12">
		<p class="formSep"><small class="muted">Display Name :</small> <span class="label label-success">'.$recordsuser['user_display_name'].'</span></p>
		<p class="formSep"><small class="muted">First Name:</small> '.$recordsuser['user_fname'].'</p>
		<p class="formSep"><small class="muted">Last Name :</small> '.$recordsuser['user_lname'].' </p>
		<p class="formSep"><small class="muted">Email Address :</small> '.$recordsuser['user_email'].'</p>

		</div>
		</div>
		</div>
				</div></div>
				</div></div><br/>

		';
		if(count($records)>0)
		{	$output.='<div class="row-fluid">
				<div class="span12">

				<h2 class="box_head green_bg">Address Details</h2>
				<div class="toggle_container">
				<div class="clsblock">
				<div class="clearfix">';
			
			for($i=0;$i<count($records);$i++)
			{

				
				$objcou=new Bin_Query();
				$sqlcou="SELECT * FROM country_table WHERE cou_code='".$records[$i]['country']."'";
				$objcou->executeQuery($sqlcou);
				$country=$objcou->records[0]['cou_name'];					
				$output.='

				

				<div class="row-fluid">
				<h5>Address '.($i+1).'</h5>

				<p class="formSep"><small class="muted">Customer Name :</small> <span class="label label-success">'.$records[$i]['contact_name'].'</span></p>
				<p class="formSep"><small class="muted">Address:</small> '.$records[$i]['address'].'</p>
				<p class="formSep"><small class="muted">City :</small> '.$records[$i]['city'].'</p>
				<p class="formSep"><small class="muted">State:</small> '.$records[$i]['state'].'</p>
				<p class="formSep"><small class="muted">Country:</small> '.$country.'</p>
				<p class="formSep"><small class="muted">Zip code:</small> '.$records[$i]['zip'].'</p>

				</div>';

				
			}

		}

		$output.='</div>
				</div></div>
				</div></div><br/>';

		return $output;

	}

}

?>