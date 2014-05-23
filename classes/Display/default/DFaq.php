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
 * Faq  related  class
 *
 * @package   		Display_DFaq
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DFaq
{
 	/**
	* This function is used to Display All FAQs
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next
	* @param int $val				
	* @return string
 	*/
 	function listFaq($arr,$paging,$prev,$next,$val)
	{
	 $output = '<table border=0 width=100% cellpadding=0 cellspacing=0><tr><td colspan=2 class="serachresult"><div class="title_fnt">
	<h1>'.Core_CLanguage::_('FREQUENTLY_ASKED_QUESTIONS').'</h1>
	</div></td></tr>
	 			<tr><td colspan=2>
					<table width=100%>
					<tr>
					<td align="center"  class="dot_line">
					</tr>
					</table>
				</td></tr>	
				<tr><td>
				<div style="padding:15px 0 5px 0" class="review1">
				<ol>';
				 if(count($arr)>0)
				 {
					$cnt=1;
					for ($i=0;$i<count($arr);$i++)
					{
						$output .= '<li><a href="#div'.$i.'" style="color:#878585;text-decoration:none;padding-top:10px;">'.$arr[$i]['faq_qn'].'</a></li>';
						$cnt++;
					}
		

				}
				else
					$output.='<span>No Faqs Found!</span>';
						
		$output .= '</ol><div></td></tr></table>
		
		<div style="padding:15px 0 5px 0" class="review">
			<ol>';
		$cnt=1;
		for ($i=0;$i<count($arr);$i++)
		{
			$output .= '<li><div id="div'.$i.'"><b>'.$arr[$i]['faq_qn'].'</b><br/>'.$arr[$i]['faq_ans'].'</div></li>';
			$cnt++;
		}
		
		$output.='</ol>
		</div>';
		return $output;
		
	}
}
?>
