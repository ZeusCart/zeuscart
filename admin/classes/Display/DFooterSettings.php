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
 * This class contains functions to list out the footer settings available.
 *
 * @package  		Display_DFooterSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DFooterSettings
{
 	
	
	/**
	 * Function lists out the footer link available. 
	 * @param array $arr	
	 * @return string
	 */
	function showFooterLink($arr)
	{
		$output = "";
		
		$output .= '<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td class="link_header" align="center">';
		for ($i=0;$i<count($arr);$i++)
		{
		
		$output.='<a href=../userpage/"'.$arr[$i]['link_url'].'"" name="link" >"'.$arr[$i]['link_name'].'"</a>';
		 //$output .='<td class="content_list_txt1" align="left"><a href=userpage/'.$arr[$i]['link_url'].' name="link" >'.$arr[$i]['link_name'].'</a> | </td>';
		}
		$output.='</td></tr>
               </table>';
		return $output;
	}
	
	/**
	 * Function lists out the custom pages available. 
	 * @param array $arr	
	 * @return string
	 */
	
	
	function showCustomPage($arr)
	{
		
		$output = "";
		$output .= '<form name="frmcustom" method="get">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <td width="18%" align="center" class="content_list_head">S.No</td>
                <td width="51%" class="content_list_head">Page Url</td>
                </tr>
              <tr>
                <td colspan="4" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		//$output.='<th>S.no.</th><th>Page Url</th>';
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
			$output.='<input type="hidden" name="mainindex" value="">';
			$output .= '<tr>
                <td '.$classtd.' align="center">'.($i+1).'</td><td '.$classtd.'>
				<div style="cursor:pointer" onclick=\'document.getElementById("link").value="'.$arr[$i]['page_name'].'";\'>'.$arr[$i]['page_name'].'</div></td></td></tr>';
		}
		$output .= '</table></form>';
		return $output;
	}
	
	/**
	 * Function displays the list of footer link available. 
	 * @param array $arr	
	 * @return string
	 */
	
	
	function viewFooterLink($arr)
	{
		$output = "";
		$output .= '
            <td colspan="" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>';
		
		for ($i=0;$i<count($arr);$i++)
		{
	
			
			//$output .= '<tr><td>'.($i+1).'</td><td>'.$arr[$i]['link_name'].'</td><td>'.$arr[$i]['link_url'].'</td>';
			$output .='<td width="" class="link_header" align="left" style="padding:5px" ><a href="../userpage/'.$arr[$i]['link_url'].'" name="link" >'.$arr[$i]['link_name'].'</a></td>';
			
			$output1.='<td  class="content_list_txt2"><input type="button" name="Edit" class="edit_bttn"  title="Edit Link" value="Edit" onclick=edit('.$arr[$i]['link_id'].') /></td>';
			$output2.='<td  class="content_list_txt1"><input type="button" name="Delete" class="delete_bttn" title="Delete Link" value="Delete" onclick=calldelete('.$arr[$i]['link_id'].') /></td>';
			$output.='<input type="hidden" name="mainindex" value="">';
		}
		//$output .= '</td></tr></table>';
		//$output.='If you want to Create Footer '.'<a href="?do=footersettings&action=createfooter" >Click here! </a>';
		return '<tr>'.$output.'</tr><tr>'.$output1.'</tr><tr>'.$output2.'</tr></table>';
		
	}
	
	
	/**
	 * Function displays the list of footer links available. 
	 * @param array $arr	
	 * @return string
	 */
	function viewFooterLinkByRows($arr)
	{
		$output = "";
		$output .= '
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr><td colspan="3" class="content_list_head">Modify Footer Settings</tr>';
		
		for ($i=0;$i<count($arr);$i++)
		{
			
			//$output .= '<tr><td>'.($i+1).'</td><td>'.$arr[$i]['link_name'].'</td><td>'.$arr[$i]['link_url'].'</td>';
			$output .='<tr><td width="" class="content_list_txt2" align="left" style="padding:5px" ><a href="../userpage/'.$arr[$i]['link_url'].'" name="link" >'.$arr[$i]['link_name'].'</a></td>';
			
			$output.='<td  class="content_list_txt2"><input type="button" name="Edit" class="edit_bttn"  title="Edit Link" value="Edit" onclick=edit('.$arr[$i]['link_id'].') /></td>';
			$output.='<td  class="content_list_txt1"><input type="button" name="Delete" class="delete_bttn" title="Delete Link" value="Delete" onclick=calldelete('.$arr[$i]['link_id'].') />';
			$output.='<input type="hidden" name="mainindex" value=""></td></tr>';
		}
		$output .= '</table>';
		//$output.='If you want to Create Footer '.'<a href="?do=footersettings&action=createfooter" >Click here! </a>';
		//return '<tr>'.$output.'</tr><tr>'.$output1.'</tr><tr>'.$output2.'</tr></table>';
		
		return $output;
	}
	
	/**
	 * Function generates a template for updating the available footer links. 
	 * @param array $arr	
	 * @return string
	 */
	
	function editFooterLinks($arr)
	{
		
		$output = "";
		$output .= '<form name="frm" action="?do=footersettings&action=update&id='.(int)$_GET['id'].'" method="post" >
		   
<table width="75%" border="0" cellspacing="0" cellpadding="0" class="content_form_bdr">
 <tr>
                <td width="34%" align="left" colspan="2" class="content_form_line">
    New Link in Footer
   </td>
   </tr>
              <tr>
                <td width="34%" align="left" class="content_form_line">
    Link Text:
   </td>
                <td width="66%" class="content_form_line">
        <input type="text" class="txt_box250" name="linkname" cols="45" rows="4" id="linkname" value="'.$arr[0]['link_name'].'" /></td>
  </tr>
    <tr>
    <td width="34%" align="left" class="content_form_line">
    Page Url:
    </td>
		<td width="66%" class="content_form_line">
        <input type="text" class="txt_box250" name="linkurl" id="link" value="'.$arr[0]['link_url'].'" ></input>
        </td>
    </tr>   
    
    <tr>
    <td class="content_form_line">&nbsp;</td>
    <td class="content_form_line">
    <input type="submit" name="submit" class="all_bttn" value="Update Footer"/>
    </td>
</tr></table>&nbsp;';
return $output;
	}
}
?>