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
 * DFaq
 *
 * This class contains functions to list out the FAQs.
 *
 * @package		Display_DFaq
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

 class Display_DFaq
{
 	
	/**
	 * Function returns a template that list out the FAQs available. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	
	function listFaq($arr,$paging,$prev,$next,$val)
	{
		$output = '
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td align=right><a href="?do=faq&action=add" class="add_link" >Add FAQ</a></td></tr>
		</table><br>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">

                <td class="content_list_head" width=5% align="center">S.No</td>
                <td class="content_list_head" width=60%>Question & Answer</td>
                <td colspan="2" align="center" class="content_list_head" width=8%>Actions</td>
                </tr>
              <tr>
                <td colspan="4" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
	 if(count($arr)>0)
	 {
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
				
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
			<td align="center" '.$classtd.'>'.($val+1).'</td>
			<td align="" '.$classtd.'><b>'.$arr[$i]['faq_qn'].'</b><br>
			'.$arr[$i]['faq_ans'].'
			</td>';
			
			
			$output.='<td align="center" '.$classtd.'>
			<a href="?do=faq&action=add&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;">
			<form method="post" action="?do=faq&action=add&id='.$arr[$i]['faq_id'].'">
			<input type="submit" class="edit_bttn" name="Edit"  title="Edit" value=""/>&nbsp;</form></a></td>';
			$output.='<td align="center" '.$classtd.'>
			<a href="?do=faq&action=delete&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;"><form method="post" action="?do=faq&action=delete&id='.$arr[$i]['faq_id'].'">
			<input type="submit" name="Delete" class="delete_bttn" onclick="return confirm(\'Are you sure to delete?\')" title="Delete" value=""/>&nbsp;</form></a></td></tr>';
			$val++;
		}
		 $output.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next.'</td></tr>';
	}
	else
		$output.='<tr><td colspan=2 valign="bottom" align="center">No Faqs Found!<br/>&nbsp;</td></tr>';
						
		$output .= '</table>';
		return $output;
		
	}
	
	/**
	 * Function display the list of FAQs. 
	 * @param string $result
	 * @param array $arr
	 *
	 *	 
	 * @return string
	 */
	
	function show($result='',$arr=array())
	{
		$qn='';
		$ans='';
		$btnCaption='Add FAQ';
		$action='insert';
		if(!empty($arr))
		{
			$qn=$arr['faq_qn'];
			$ans=$arr['faq_ans'];
			$btnCaption='Update FAQ';
			$action='edit';
		}	
		$output='<form action="?do=faq&action='.$action.'" method="post">
		<table width="97%" border="0" cellspacing="0" cellpadding="" class="">
		  <tr>
			<td colspan="5" align="left" class="content_title" style="padding-bottom:5px;">Faqs<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'dfaq\', \'Meta Key\', \'Add here\')" onmouseout="HideHelp(\'dfaq\');">
			<div id="dfaq" style="left: 50px; top: 50px;"></div>--></td>
		  </tr>
		 
		  <tr>
		  <tr>
			<td colspan="4" align="right"><a href="?do=faq" class="add_link" >List Faq</a></td>
		  </tr>
		  <tr>
		  <tr>
			<td colspan="4" align="left">'.$result.'</td>
		  </tr>
		  <tr><td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
      <tr>
        <td  align="left" class="content_list_head" valign="top">Create Page</td>
	  </tr>
	  <tr><td>
	  <table>
		  <tr>
			<td colspan="3" align="left" style="padding-top:5px;" class="content_form">
			<input type=hidden name=hidid value="'.(int)$_GET['id'].'">
			Question</td><td class="content_form"><input type="text" size="87" name="qn" value="'.$qn.'"/></td>
		  </tr>
		  <tr>
			<td colspan="3" align="left" class="content_form">Answer</td><td class="content_form"><textarea rows="5" cols="66" name="ans" >'.$ans.'</textarea></td>
		  </tr>
		  <tr>
			<td colspan="4" align="center"><input type="submit" value="'.$btnCaption.'" class="all_bttn" /></td>
		  </tr>
		  <tr>
			<td colspan="3" align="left">&nbsp;</td>
		  </tr>
		  </table></td></tr>
		</table></td></tr></table>
		</form>';
		return $output;
	}
	
}
?>
