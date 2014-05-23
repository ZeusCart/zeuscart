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
 * This class contains functions to display the sub admin management process
 *
 * @package  		Display_DSubAdminManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DSubAdminManagement
{

	/**
	 * Function  to  display the sub admin
	 * @param array $result
	 * @param array $Err
	 * @param integer $paging
	 * @param integer $prev
	 * @param integer $next
	 * @return string
	 */	
 	function displaySubAdmin($result,$Err,$paging,$prev,$next)
	{
		
		if(isset($_GET['page']))
		{
			$pgindex= ($_GET['page']-1)*10;
		}
		else
			$pgindex=0;
			   
		if($Err->messages>0)
		{
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			
		}
	    // $out=(isset($_GET['msg'])? '<table border="0" width="98%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%">'.$_GET['msg'].'</div></td></tr></table>' : "" ).(count($output['msg'])>0 || isset($_GET['errmsg'])?'<table border="0" width="98%" align="center" style="padding-right:10px;" ><tr><td colspan="2"><div class="error_msgbox"  width="100%">Error Adding Sub admin .'.$_GET['errmsg'].'</div></td></tr></table>' : "" )."<form method='post' name='frmadmin' action='?do=subadminmgt&action=insert'><table cellspacing='0' border='0'  class='content_list_bdr' width='98%'>
	    // 	<tr><td  class='content_list_head'>S.No</td><td  class='content_list_head'>Sub Admin  Name</td><td  class='content_list_head'>Password</td><td  class='content_list_head'>Sub Admin Mail</td><td  class='content_list_head' align='center'>Status</td><td class='content_list_head' colspan=2 align=center>Operations</td><td  class='content_list_head' nowrap>Roles</td></tr><tr><td colspan='8' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
	    $out='<form method="post" name="frmadmin" id="deleteSubadminForm" action="?do=subadminmgt&action=delete"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
	
		<thead class="green_bg">
		<tr>
		<th width="5%" align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="subAdmincheckall"></th>
		<th width="5%" align="left">S.No</th>
		<th align="left" >Sub Admin Name</th>
		<th align="left" >Password</th>
		<th align="left" >Sub Admin Mail</th>
		<th align="left" >Status</th>
		<th align="left" >Roles</th>
		
		</tr>
		</thead>
		<tbody>';
		$i=1;
		if((count($result)>0))
		{
	
		foreach($result as $row)
		{


	  	   $id=$row['subadmin_id'];
		   $name= $row['subadmin_name'];
   		   $password= base64_decode($row['subadmin_password']);
  		   $email= $row['subadmin_email_id']; 
   		   $status= $row['subadmin_status']; 
		   if($status)
		   {
		      $status='active_link';
			  $title='Active';
		   }
		   else
		   {	
		      $status='inactive_link';
			  $title='Inactive';
		   }
		   if($i%2==0)
		   
		      $out.='<tr><td ><input type="checkbox" name="subAdmincheck[]" class="chkbox" value="'.$row['subadmin_id'].'"></td><td >'.($pgindex+$i).'</td><td  ><a href="?do=subadminmgt&action=edit&id='.$id.'">'.$name.'</a></td><td  >Encrypted</td><td  ><a href="mailto:'.$email.'">'.$email.'</a></td><td align="center" >'.$title.'</td>
		  <td ><a href="?do=subadminrole&id='.$id.'">Roles</a></td></tr>';
			  
			  else
			  $out.='<tr ><td ><input type="checkbox" name="subAdmincheck[]" class="chkbox" value="'.$row['subadmin_id'].'"></td><td >'.($pgindex+$i).'</td><td ><a href="?do=subadminmgt&action=edit&id='.$id.'">'.$name.'</a></td><td >Encrypted</td><td ><a href="mailto:'.$email.'">'.$email.'</a></td><td align="center">'.$title.'</td>
			<td ><a href="?do=subadminrole&id='.$id.'">Roles</a></td></tr>';
		   $i++;
		}

		$out.='<tr>
			<td colspan="7" class="clsAlignRight">
			<div class="dt-row dt-bottom-row">
			<div class="row-fluid">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$out .= $pagingvalues.' '.$next.'</ul></div>
			</div>
			</div>
			</td>
			</tr>';

		
		}
		else
		{
			$out.='<tr>
			<td colspan="7">No Records Found!</td></tr>';
		}
		// $out.="<tr><td  colspan=7>&nbsp;</td></tr>
		// <tr><td>&nbsp;</td><td valign=top><input type='text' name='subadminname' value='".$output['val']['subadminname']."' size=15 /><font color='red'>".$output['msg']['subadminname']."</font></td><td valign=top><input type='text' name='subadminpassword' value='".$output['val']['subadminpassword']."' size=15 /><font color='red'>".$output['msg']['subadminpassword']."</font></td><td valign=top><input type='text' name='subadminemail' value='".$output['val']['subadminemail']."' size='25'/><font color='red'>".$output['msg']['subadminemail']."</font></td><td align=center><input type='checkbox' name='subadminstatus' /></td><td colspan=3><input type='submit' name='insert' value='Add Sub Admin' class='all_bttn' /></td></tr>";
	//	$output.="</table>";
	    	$out.='</tbody></table></form>';
						
		return $out;
	}
	/**
	 * Function  to  display the selected sub admin
	 * @param array $row
	 * @return string
	 */	
	function displaySelectedSubAdmin($row)
	{
	       $id=$row[0]['subadmin_id'];
		   $name= $row[0]['subadmin_name'];
   		   $password= base64_decode($row[0]['subadmin_password']);
  		   $email= $row[0]['subadmin_email_id']; 
   		   $status= $row[0]['subadmin_status']; 
		   if($status)
		   {
		      $status="checked='checked'";
		   }
	
	   $output.='<div class="row-fluid">
		<div class="span6"><label>SubAdmin Name</label>
	   <input type="hidden" value='.$id.' name="id" />
	   <input type="text" name="subadminname"  class="span8" value='.$name.' disabled="disabled"/></div></div>
	  <div class="row-fluid">
		<div class="span6"><label>SubAdmin Password</label><input type="text" class="span8" name="subadminpassword" value="'.$password.'"/></div></div><div class="row-fluid">
		<div class="span6"><label>SubAdmin E-Mailid</label><input class="span8" type="text" name="subadminemail" value='.$email.' /></div></div><div class="row-fluid">
		<div class="span6"><label>
	  SubAdmin Status</label><input type="checkbox" '.$status.'  id="default" value="1" name="subadminstatus" class="sb_ch1 {labelOn: \'Excel\', labelOff: \'OFF\'}" />
												
											</div></div></div></div>
	  ';
	   return $output;
	}
}
?>