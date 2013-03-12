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
	    $out=(isset($_GET['msg'])? '<table border="0" width="98%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%">'.$_GET['msg'].'</div></td></tr></table>' : "" ).(count($output['msg'])>0 || isset($_GET['errmsg'])?'<table border="0" width="98%" align="center" style="padding-right:10px;" ><tr><td colspan="2"><div class="error_msgbox"  width="100%">Error Adding Sub admin .'.$_GET['errmsg'].'</div></td></tr></table>' : "" )."<form method='post' name='frmadmin' action='?do=subadminmgt&action=insert'><table cellspacing='0' border='0'  class='content_list_bdr' width='98%'><tr><td  class='content_list_head'>S.No</td><td  class='content_list_head'>Sub Admin  Name</td><td  class='content_list_head'>Password</td><td  class='content_list_head'>Sub Admin Mail</td><td  class='content_list_head' align='center'>Status</td><td class='content_list_head' colspan=2 align=center>Operations</td><td  class='content_list_head' nowrap>Roles</td></tr><tr><td colspan='8' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
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
		   
		      $out.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);' ><td  class='content_list_txt1'>".($pgindex+$i)."</td><td  class='content_list_txt1'>$name</td><td  class='content_list_txt1'>Encrypted</td><td  class='content_list_txt1'><a href='mailto:$email'>$email</a></td><td align='center' class='content_list_txt1'><span class='$status' title='".$title."'></span></td><td class='content_list_txt1'><a href='?do=subadminmgt&action=edit&id=$id' class='edit_bttn'><!--Edit--></a></td><td class='content_list_txt1'><a href='?do=subadminmgt&action=delete&id=$id' onclick='return confirm(\"Do you want to delete\");' class='delete_bttn'><!--Delete--></a></td><td class='content_list_txt1'><a href='?do=subadminrole&id=$id'>Roles</a></td></tr>";
			  
			  else
			  $out.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'><td  class='content_list_txt2'>".($pgindex+$i)."</td><td  class='content_list_txt2'>$name</td><td  class='content_list_txt2'>Encrypted</td><td  class='content_list_txt2'><a href='mailto:$email'>$email</a></td><td align='center' class='content_list_txt2'><span class='$status' title='".$title."'></span></td><td  class='content_list_txt2'><a href='?do=subadminmgt&action=edit&id=$id' class='edit_bttn'><!--Edit--></a></td><td  class='content_list_txt2'><a href='?do=subadminmgt&action=delete&id=$id' onclick='return confirm(\"Do you want to delete\");' class='delete_bttn'><!--Delete--></a></td><td  class='content_list_txt2'><a href='?do=subadminrole&id=$id'>Roles</a></td></tr>";
		   $i++;
		}
		
		}
		$out.="<tr><td class='content_list_txt1' colspan=9>&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td valign=top><input type='text' name='subadminname' value='".$output['val']['subadminname']."' size=15 /><font color='red'>".$output['msg']['subadminname']."</font></td><td valign=top><input type='text' name='subadminpassword' value='".$output['val']['subadminpassword']."' size=15 /><font color='red'>".$output['msg']['subadminpassword']."</font></td><td valign=top><input type='text' name='subadminemail' value='".$output['val']['subadminemail']."' size='25'/><font color='red'>".$output['msg']['subadminemail']."</font></td><td align=center><input type='checkbox' name='subadminstatus' /></td><td colspan=3><input type='submit' name='insert' value='Add Sub Admin' class='all_bttn' /></td></tr>";
	//	$output.="</table>";
	    $out.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$out .= $pagingvalues.' '.$next.'</td></tr></table></form>';
						
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
   		   $password= $row[0]['subadmin_password'];
  		   $email= $row[0]['subadmin_email_id']; 
   		   $status= $row[0]['subadmin_status']; 
		   if($status)
		   {
		      $status="checked='checked'";
		   }
	   $output="<table cellpadding='8' cellspacing='0' border='0' class='content_list_bdr' width='98%'><tr  class='content_list_head'><td colspan='2'>Sub Admin Details</td></tr>";
	   $output.="<tr><td class='content_list_txt2'>SubAdmin Name</td><td class='content_list_txt2'><input type='hidden' value=".$id." name='id' /><input type='text' name='subadminname' value='".$name."' disabled='disabled'/></td></tr><tr><td class='content_list_txt2'>SubAdmin Password</td><td class='content_list_txt2'><input type='text' name='subadminpassword' value='".base64_decode($password)."'/></td></tr><tr><td class='content_list_txt2'>SubAdmin E-Mailid</td><td class='content_list_txt2'><input type='text' name='subadminemail' value='".$email."' /></td></tr><tr><td class='content_list_txt2'>SubAdmin Status</td><td class='content_list_txt2'><input type='Checkbox' name ='subadminstatus'".$status."/></td></tr><tr ><td colspan='2' align='center' class='content_list_txt2'><input type='submit' name='update' value='Update' class='all_bttn'/></td></tr>";
	   return $output;
	}
}
?>