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
 class Display_DPageManagement
{
 	 function dispPages($result)
	{
	    $output="<form name='frminspage' action='?do=pagemgt&action=insert' method='post'><table  cellspacing='0' width='100%' border='0'  class='content_list_bdr'><tr><td  class='content_list_head'>S.No</td><td class='content_list_head'>Role Id</td><td  class='content_list_head'>Page Name</td><td  class='content_list_head'>Page Action</td><td  class='content_list_head'>Page Description</td><td class='content_list_head'></td></tr><tr><td colspan='6' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
	    if(count($result)>0)
		{
			$i=1;
		    foreach($result as $row)
			{
			     $page_id=$row['page_id'];
				 $page_name=$row['page_name'];
				 $page_action=$row['page_action'];
				 $page_description=$row['page_description'];
				 if($i%2==0)
					 $output.="<tr><td  class='content_list_txt1'>".$i."</td><td class='content_list_txt1'>".$page_id."</td><td  class='content_list_txt1'>".$page_name."</td><td class='content_list_txt1'>".$page_action."</td><td class='content_list_txt1'>".$page_description."</td><td  class='content_list_txt1'><a href='?do=pagemgt&action=edit&id=".$page_id."'>Edit</a>&nbsp;&nbsp;<a href='?do=pagemgt&action=delete&id=".$page_id."' onclick='return confirm(\"Do you want to delete\");'>Delete</a></td></tr>";
				 else
 				 $output.="<tr><td  class='content_list_txt2'>".$i."</td><td class='content_list_txt2'>".$page_id."</td><td  class='content_list_txt2'>".$page_name."</td><td class='content_list_txt2'>".$page_action."</td><td class='content_list_txt2'>".$page_description."</td><td class='content_list_txt2'><a href='?do=pagemgt&action=edit&id=".$page_id."'>Edit</a>&nbsp;&nbsp;<a href='?do=pagemgt&action=delete&id=".$page_id."' onclick='return confirm(\"Do you want to delete\");'>Delete</a></td></tr>";
				 $i++;
			}
				 $output.="<tr><td  class='content_list_footer'></td><td class='content_list_footer'></td><td  class='content_list_footer'><input type='text' name='pagename' /></td><td class='content_list_footer'><input type='text' name='pageaction' /></td><td class='content_list_footer'><input type='text' name='pagedesc'/></td><td><input type='submit' value='Insert' name='insert' /></td></tr>";
			$output.="<table></form>";
		}
		else
		{
		     $output.="<tr><td colspan='4'> No Records Found</td></tr>";
		}
		return $output;
	}
	
	function editPages($result)
	{
	 	  if(count($result)>0)
		{
			$i=1;
			$output="<form name='frmupdatepage' method='post' action='?do=pagemgt&action=update'><table  cellspacing='0' width='100%' border='0'  class='content_list_bdr'><tr><td  class='content_list_head'>S.No</td><td class='content_list_head'>Role Id</td><td  class='content_list_head'>Page Name</td><td  class='content_list_head'>Page Action</td><td  class='content_list_head'>Page Description</td><td class='content_list_head'></td></tr><tr><td colspan='6' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
		    foreach($result as $row)
			{
			     $page_id=$row['page_id'];
				 $page_name=$row['page_name'];
				 $page_action=$row['page_action'];
				 $page_description=$row['page_description'];
				$output.=" <tr><td  class='content_list_footer'><input type='hidden' value='".$page_id."' name='page_id' /></td><td class='content_list_footer'></td><td  class='content_list_footer'><input type='text' name='pagename' value='".$page_name."' /></td><td class='content_list_footer'><input type='text' name='pageaction' value='".$page_action."' /></td><td class='content_list_footer'><input type='text' name='pagedesc' value='".$page_description."'/></td><td><input type='submit' value='Update' name='update' /></td></tr>";
			}
			$output.="</table></form>";			
		}
		return $output;
	}
	
}
?>