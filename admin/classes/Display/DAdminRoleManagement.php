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
 * This class contains functions to set the sub admin's limitation.
 *
 * @package  		Display_DAdminRoleManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



 class Display_DAdminRoleManagement
{
 	/**
	 * List out the sub admin roles. 
	 * @param array $pages
	 * @param array $rights
	 * @param string $subadmin
	 * @param integer $id
	 * @return string
	 */
	function displaySubAdminRole($pages,$rights,$subadmin,$id)
	{
		// $output="<table cellpadding='8' cellspacing='0' border='0'  class='' width='100%'>";
		// $output.=(isset($_GET['msg'])? '<tr><td><table border="0" width="98%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%" style="width:644px;" >'.$_GET['msg'].'</div></td></tr></table></td></tr>' : "" );
		
		$output.='<div class="row-fluid">
		<div class="span6"><b>Sub Admin Name:</b></div>
		<div class="span6"> <b>'.ucfirst($subadmin).'</b></div></div>';
		
		for($i=0;$i<count($pages);$i++)
		{
			for($j=0;$j<count($rights);$j++)
			{
				$val='';
				if(($rights[$j]['subadmin_page_id']==$pages[$i]['page_id']) && $rights[$j]['subadmin_rights']==1)
				{
					$val='checked';
					break;
				}	
			}	
			if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
			$output.='	<div class="row-fluid">
		<div class="span6">'.$pages[$i]['page_description'].'</div>
		<div class="span6">
		<input type="checkbox" '.$val.'  id="default" value="'.$pages[$i]['page_id'].'" name="chkStatus[]" class="sb_ch1 {labelOn: \'Excel\', labelOff: \'OFF\'}" />
	
			<input type="hidden" value="'.$id.'" name="subadminid"/></div></div>';		
		}
		
		$output.='';
	
		return $output;
	}
	
	/**
	 * List out the sub admin roles(old). 
	 * @param array $result
	 * @param array $dropdowndata
	 * @param array $cou
	 * @param integer $id
 	 * @param string $val4
	 * @return string
	 */
	function displaySubAdminRoleOld($result,$dropdowndata,$cou,$id,$val4)
	{
		  $subid=$id;
		  $co=$cou[0]['count'];
	 		 $out='';
		    $output=(isset($_GET['msg'])? '<table border="0" width="98%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%" style="width:644px;" >'.$_GET['msg'].'</div></td></tr></table>' : "" )."<table cellpadding='8' cellspacing='0' border='0'  class='content_list_bdr' width='100%'><tr><td  class='content_list_head'>S.No</td><td  class='content_list_head'>Sub Admin Name</td><td  class='content_list_head'>Page Description</td><td  class='content_list_head'>Sub Status</td><td class='content_list_head' colspan=2 align=center>Action</td></td></tr><!--<tr><td colspan='9' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>-->";
			$i=1;

		if(count($dropdowndata)>0)
		{
				$out.="<select name='selectpagename'>";
				  foreach($dropdowndata as $row)
					{
					    $desc=$row['page_description'];
					    $pageid=$row['page_id'];
						$pagename=$row['page_name'];
						$pageaction=$row['page_action'];
						$out.="<option value='".$pageid."'>".$desc."</option>";
					}
					$out.="</select>";
		}
		$out.='';
		
		if(count($result)>0)
		{
			$i=1;
	 	 	foreach($result as $row)
			{
				   $subroleid=$row['subadmin_role_id'];
			  	   $subadmin_name=$row['subadmin_name'];
				   $page_description= $row['page_description'];
				   $page_name=$row['page_name'];
		   		   $page_action= $row['page_action'];
		  		   $status= $row['subadmin_rights']; 
				   if($status)
				   {
					  $status="Checked='checked'";
				   }
				   else
				   {
					  $status='';
				   }
					if($i%2==0)
					{
						$output.="<tr  ><td  class='content_list_txt1'>$i</td><td  class='content_list_txt1'>$subadmin_name</td><td class='content_list_txt1'>$page_description</td><td  class='content_list_txt1'><input type='checkbox' ".$status."  disabled='disabled' /></td><td  class='content_list_txt1'><a href='?do=subadminrole&action=edit&id=$subroleid&subid=$subid' class='edit_bttn'>&nbsp;<!--Edit--></a></td><td  class='content_list_txt1'><a href='?do=subadminrole&action=delete&id=$subroleid&subid=$subid'  onclick='return confirm(\"Do you want to delete\");' class='delete_bttn'>&nbsp;<!--Delete--></a></td></tr>";
					 }
					 else
					 {
						 $output.="<tr  ><td  class='content_list_txt2'>$i</td><td  class='content_list_txt2'>$subadmin_name</td><td  class='content_list_txt2'>$page_description</td><td  class='content_list_txt2'><input type='checkbox' ".$status."  disabled='disabled' /></td><td  class='content_list_txt2'><a href='?do=subadminrole&action=edit&id=$subroleid&subid=$subid' class='edit_bttn'>&nbsp;<!--Edit--></a></td><td  class='content_list_txt2'><a href='?do=subadminrole&action=delete&id=$subroleid&subid=$subid' onclick='return confirm(\"Do you want to delete\");' class='delete_bttn'>&nbsp;<!--Delete--></a></td></tr>";
					 }
					 $i++;
			}
		}
			
			
		$output.="<tr class='content_list_txt1'><td class='content_list_txt1'></td><td class='content_list_txt1'><input type='hidden' value=".$id." name='subadminid'/><input type='hidden' value='".$subadmin_name."' name='adminname' />".$val4."</td><td class='content_list_txt1'>".$out."</td><td class='content_list_txt1'><input type='checkbox' name='status'/></td><td class='content_list_txt1' colspan=2 align=center><input type='submit' name='insertsub' value='Insert' class='all_bttn' /></td></tr>";
			$output.="<tr><td colspan='6'><a href='?do=subadminmgt'>Back To SubAdmin Management</a></td></tr>";
			$output.="</table>";
			return $output;
	}
	
	/**
	 * List out the selected sub admin roles. 
	 * @param array $row
	 * @param integer $id
	 * @return string
	 */
	function displaySelectedSubAdminRole($row,$id)
	{
	       $subroleid=$row[0]['subadmin_role_id'];
	  	   $subadmin_name=$row[0]['subadmin_name'];
		   $page_description= $row[0]['page_description'];
		   $page_name=$row[0]['page_name'];
   		   $page_action= $row[0]['page_action'];
		   $status= $row[0]['subadmin_rights']; 
		   $subid=$_GET['subid'];

		   if($status)
		   {
		      $status=" checked='checked' ";
		   }
	   $output="<form method='post' action='?do=subadminrole&action=update' ><table cellpadding='8' cellspacing='0' border='0' class='content_list_bdr' width='100%'><tr  class='content_list_head'><td colspan='2'>Sub Admin Previlage</td></tr>";
	  
	  $output.="<tr><td class='content_list_txt2'>SubAdmin Name</td><td  class='content_list_txt2'><input type='hidden' value='".$subid."' name='subid'   /><input type='hidden' value=".$subroleid." name='subroleid'   />".$subadmin_name."</td></tr><tr  ><td  class='content_list_txt2'>Page Description</td><td  class='content_list_txt2'>".$page_description."</td></tr><tr  ><td class='content_list_txt2'>Page Name</td><td class='content_list_txt2'>".$page_name."</td></tr><tr  ><td class='content_list_txt2'>Page Action </td><td class='content_list_txt2'>".$page_action."</td></tr><tr><td class='content_list_txt2'>SubAdmin Status</td><td class='content_list_txt2'><input type='Checkbox' name ='subadminstatus'".$status."/></td></tr><tr ><td colspan='2'  class='content_list_txt2' align='center' ><input type='submit' name='update' value='Update' class='all_bttn'/></td></tr></table></form>";
	   return $output;
	}
	
	
}
?>
