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
 * Quick information related  class
 *
 * @package   		Display_DQuickInfo
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DQuickInfo
{
 	/**
	* This function is used to Display the Product Quick Info Page
	* @param mixed $arr
	* @param array $r
	* @return string
 	*/
	function showInfo($arr,$r)
	{	
		if($arr['rating']>0)
			$rating='<img src="'.$_SESSION['base_url'].'/images/star'.$arr['rating'].'.jpg"/>';
		else
			$rating='No Rating';
		if($arr['image']!='' && file_exists($arr['image']))
			$imgPath= '<img src="'.$_SESSION['base_url'].'/'.$arr['image'].'" alt="'.addslashes($arr['title']).'" width="'.IMAGE1_WIDTH.'" />';
		else
			$imgPath='<img src="'.$_SESSION['base_url'].'/images/noimage1.jpg" alt="'.addslashes($arr['title']).'"  />';
			
			$output='<div style="padding-top:2px;"><div class="quickview_border">
					<div class="heading1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><span class="headingTXT">'.$arr['title'].'</span></td>
					<td align="right" style="padding:2px;"><!--<a href="#" class="lbAction" rel="deactivate">-->
					<!--<input type="button" class="close_button" style="cursor:pointer" onClick="Lightbox.hideBox()" /> -->
					<!--<img src="images/close.gif" alt="close" width="17" height="17" border="0" onClick="Lightbox.hideBox()" style="cursor:pointer" />--><!--</a>--></td>
				</tr>
				</table>
				</div>
				<div style="padding:15px 0 5px 0;background-color:#FFFFFF">
				<div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="48%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-left:5px" height=156>
					<tr>
						<td width="100" colspan="3" align="center">'.$imgPath.'</td>
					</tr>
					</table></td>
					<td valign="top" class="itemDETAIL">
					<ul>'.$arr['title'].'
					<li><div>'.$r[0]['msrp'].' &nbsp;&nbsp;';
					
					
					
					if($arr['cse_enabled']==1)
					{
					$output.='<a href=\''.$_SESSION['base_url'].'/index.php?do=pricecompare&action=compareproductprice&keyword='.$arr['sku'].'\';window.close();" style="text-decoration:none" >
					<input type="button" name="compareprice" value="Compare Price" class="compareprice" />
					<!--<img src="'.$_SESSION['base_url'].'/images/compare_price.gif" alt="compare price" border="0" />--></a>';
					}
					
					
					
					$output.='</div> 
					</li>
					<li>User Rating  : '.$rating.'</li>
					<li>Availability : <span>'.$arr['status'].'</span></li>
					<li>Shipping Cost : <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr['shipping_cost']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</li>
					</ul></td>
				</tr>
				
				<tr>
					<td colspan="2" align="center" valign="top" style="padding:10px 0;">
			<table width="100%" border="0" cellspacing="5" cellpadding="0" style="background-color:#f8f8f8; border:#ececec 1px solid">
					<tr>
						<td width="36%" align="right">
					<form name="addtocart" id="addtocart" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr['product_id'].'" method="post" >
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="right" valign="top" class="button_left"></td>
							<td><input type="submit" name="Submit222" value="Add to Cart" class="button" /></td>
							<td valign="top" class="button_right" ></td>
						</tr>
						</table>
						</form>
						</td>
						<td width="26%" align="left">
						<form name="addtowishlist" id="addtowishlist" action="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr['product_id'].'" method="post">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="right" class="button_left"></td>
							<td><input type="submit" name="Submit23222" value="Add to Wishlist" class="button" /></td>
							<td class="button_right" ></td>
						</tr>
						</table>
						</form>
						</td>
						<!--<td width="38%" align="left"><table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="right" class="button_left"> </td>
							<td><a href=\''.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$arr['product_id'].'\';window.close();" style="text-decoration:none;"><input type="button" name="Submit23232" value="Add to Compare" class="button" /></a></td>
							<td class="button_right"></td>
						</tr>
						</table></td>-->
					</tr>
					</table></td>
					</tr>
				<tr>
					<td colspan="2" valign="top">
					<div style="padding:5px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
										<td><table id="Table_" width="100%" border="0" cellpadding="0" cellspacing="0" height="33">
											<tbody>
												<tr>
												<td width="86" valign="bottom"><img src="'.$_SESSION['base_url'].'/images/description1.gif" alt="" width="86" border="0" height="28"></td>
												<td valign="bottom" style="border-bottom:#bfbebe 1px solid" >&nbsp;</td>
												</tr>
											</tbody>
										</table></td>
										</tr>
										<tr>
										<td class="tabBG">
												<ul>'.$arr['title'];
												$desc=substr($arr['description'],0,200);
													$output.='<li>'.$desc.'...</li>';
												$output.='</ul>
											</td>	  
										</tr>
									</tbody>
								</table>
				</div>	</td>
				</tr>
				<tr>
					<td colspan="2" align="right" valign="top" style="padding-right:5px;"><a href=\''.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr['product_id'].'\';window.close();"><img src="images/viewfulldetail.gif" alt="view" width="125" height="23" border="0" /></a></td>
				</tr>
				</table>
				</div>
				</div>
				</div></div>';
				
		return $output;
	}
}