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
 * Polls related  class
 *
 * @package   		Display_DPolls
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DPolls
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	var $output = array();
	
 	/**
	* This function is used to Display the Category List
	* @return string
 	*/
	function showCatList()
	{
		/**
		*
		* Here database results will be changed to dynamic 
		*
		*/
		
			$output = '<div class="catlist"><span class="list"></span>
                                                    <ul>
                                                      <li><a  href="#">Airlines</a></li>
                                                      <li><a  href="#">b schools</a></li>
                                                      <li><a  href="#">Bikes &amp; scooters</a> </li>
                                                      <li><a  href="#">Books</a></li>
                                                      <li><a  href="#">Cars</a></li>
                                                      <li><a  href="#">Credit cards</a>&nbsp;</li>
                                                      <li><a  href="#">Desktop</a>&nbsp; </li>
                                                      <li><a  href="#">Digital cameras</a> </li>
                                                      <li><a  href="#">DVD</a></li>
                                                      <li><a  href="#">laptop</a></li>
                                                      <li><a  href="#">mobile-operators</a></li>
                                                      <li><a  href="#">mobile phones</a></li>
                                                      <li><a  href="#">movies</a></li>
                                                      <li><a  href="#">TV shows</a></li>
                                                      <li><a  href="#">TVs</a></li>
                                                    </ul>
                                            </div>';
		
		
		return $output;
	}
	/**
	* This function is used to Display the topics List
	* @return string
 	*/
	function showTopicsList()
	{
		$output = '<div class="catlist"><span class="list"></span>
                                                    <ul>
                                                      <li><a  href="#">ameer </a><span class="grey_destext1">(6770 polls) </span></li>
                                                      <li><a  href="#">beautiful </a><span class="grey_destext1">(1111 polls)</span> </li>
                                                      <li><a  href="#">bollywood</a><span class="grey_destext1"> (645 polls)</span> </li>
                                                      <li><a  href="#">captain</a><span class="grey_destext1"> (235 polls)</span></li>
                                                      <li><a  href="#">cricket</a><span class="grey_destext1"> (6999 polls)</span></li>
                                                      <li><a  href="#">friendship</a><span class="grey_destext1"> (8776 polls)</span></li>
                                                      <li><a  href="#">goa</a> <span class="grey_destext1">(645 polls)</span></li>
                                                      <li><a  href="#">heart</a><span class="grey_destext1"> (656 polls)</span></li>
                                                      <li><a  href="#">love</a> <span class="grey_destext1">(6450 polls)</span></li>
                                                      <li><a  href="#">marriage</a> <span class="grey_destext1">(567 polls)</span></li>
                                                      <li><a  href="#">microsoft</a><span class="grey_destext1"> (545 polls)</span></li>
                                                      <li><a  href="#">mobile</a> <span class="grey_destext1">(644 polls)</span></li>
                                                      <li><a  href="#">money</a> <span class="grey_destext1">(698 polls)</span></li>
                                                      <li><a  href="#">mother</a> <span class="grey_destext1">(622 polls)</span></li>
                                                      <li><a  href="#">motorola</a><span class="grey_destext1"> (4555 polls)</span></li>
                                                      <li><a  href="#">pakistan</a> <span class="grey_destext1">(555 polls)</span></li>
                                                      <li><a  href="#">president</a><span class="grey_destext1"> (45 polls)</span></li>
                                                      <li><a  href="#">salman</a> <span class="grey_destext1">(455 polls)</span></li>
                                                      <li><a  href="#">sachin</a><span class="grey_destext1"> (6409 polls)</span></li>
                                                      <li><a  href="#">relationship</a><span class="grey_destext1">(645polls)</span></li>
                                                      <li><a  href="#">sony</a> <span class="grey_destext1">(645 polls)</span></li>
                                                      <li><a  href="#">tajmahal</a> <span class="grey_destext1">(645 polls)</span></li>
                                                      <li><a  href="#">wife</a> <span class="grey_destext1">(645 polls)</span></li>
                                                    </ul>
                                            </div>';
	
		return $output;
	}
	/**
	* This function is used to Display the polls list
	* @param array $arr
	* @return string
 	*/
	function showPollsList($arr='')
	{
		$output = '';
			for($i=1;$i<6;$i++)
			{
				$output .= '<tr><td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
												  <tr>
													<td rowspan="2" align="center" class="rings"><table width="90%" border="0" cellspacing="0" cellpadding="0">
														<tr>
														  <td width="12%">&nbsp;</td>
														  <td width="49%"><p class="ac_1">330</p>
															  <p class="ac_1">rings</p></td>
														  <td width="39%">&nbsp;</td>
														</tr>
													</table></td>
													<td colspan="9" class="links_my"><a href="#">This is Question '. $i .' </a></td>
												  </tr>
												  <tr>
													<td colspan="9"><a href="#"><img src="images/vote.jpg" width="62" height="23" border="0" /></a></td>
												  </tr>
												  <tr>
													<td colspan="10"><img src="images/spacer.gif" width="5" height="5" /></td>
												  </tr>
												  <tr>
													<td align="center"><a href="#"><img src="images/thumb_1.jpg" width="22" height="21" border="0" /></a><a href="#"><img src="images/thumb_2.jpg" width="24" height="21" border="0" /></a></td>
													<td width="22"><img src="images/qa_icon2.jpg" width="17" height="16" /></td>
													<td width="54" class="qa"><a href="#"></a> <a href="#">Share</a></td>
													<td width="27"><img src="images/qa_icon3.jpg" width="17" height="16" /></td>
													<td width="56" class="qa"><a href="#"><a href="#">Report</a></td>
													<td width="33"><img src="images/p_1.jpg" width="18" height="17" /></td>
													<td width="47" class="qa"><a href="#">zen53</a></td>
													<td width="18"><img src="images/qa_icon.jpg" width="24" height="22" /></td>
													<td width="131" class="qa"><a href="#">zen53s other polls </a></td>
													<td width="186" class="links_my">20 mts ago </td>
												  </tr>
												</table></td></tr>';
			
			
			}
			return $output;
		
	
	}


}



?>