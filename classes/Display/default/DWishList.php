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
 *Wish list related  class
 *
 * @package   		Display_DWishList
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
	

class Display_DWishList
{

	
//       	 $arr = array();
// 
//     
// 	$arr1 = array();
// 
// 		
// 	$output = array();
	
 	/**	
	* This function is used to Display the Wishlist Snapshot
	* @param mixed $arr
	* @param int $totalitem
	* @param mixed $r
	* @return  string
 	*/
	function wishlistSnapshot($arr,$totalitem,$r)
	{
		$limit = 0;
		$j=0;
		$output ='<div id="viewcart"><div id="compare_tit">My Wishlist - ('.$totalitem.')</div><table width="100%" border="0" cellspacing="0" cellpadding="0">';	
		$output.='<tr><td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">';
		$cnt =count($arr); 
		for ($i=0;$i<$cnt;$i++)
		{
			
			$output .='<tr>
			<td width="32%"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">';
			$filename=$arr[$i]['thumb_image'];
			if(file_exists($filename))
				$output.='<img src="'.$_SESSION['base_url'].'/'.$arr[$i]['thumb_image'].'" width=63 height=63 border="0"/>';
			else
				$output.=" <img border='0'  src='images/noimage.jpg' width='63' height='63' border='0' />";	
			$output.='</a></td>
			<td width="68%"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
			<tr>
			<td class="text"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" >'.$arr[$i]['title'].'</a></td>
			<td valign="top" class="text"><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=deletewishlist&prodid='.$arr[$i]['product_id'].'" ><img src="css/default/images/remove.jpg" width="12" height="11" border="0"/></a></td>
			</tr>
			<tr>
			<td align="left" class="rate_text">'.$r[$j]['msrp'].'</td>
			<td align="left" class="rate_text">&nbsp;</td>
			</tr>';
				
				if($arr[$i]['soh']>0)
					{
					$output.='
			<tr>
			<td width="81%" align="left" class="addtocart"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'"><img src="images/addtocart.jpg" border="0"></a></td>
			<td width="19%" align="left">&nbsp;</td>
			</tr>';
					}
					$output.='
			</table></td>
		</tr>';
	 	 $limit++;$j++;
		if($limit!=$cnt)
			$output .=' <tr><td colspan="2" class="line"></td></tr>';
		
		
		}
		$output .= '</table></td></tr><tr><td><div width="53%" class="text">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td align=right colspan=2 class="addtowishlist"><a href="?do=wishlist&action=showwishlist">Go to Wishlist </a></td>
		</tr>
		</table></div></td></tr></table>';
				$output.='</div>';
		return $output;
	}
	/**
	* This function is used to Display the Wishlist snapshot else part
	*
	* @return string
 	*/
	function wishlistSnapshotElse()
	{
		$output ='<div id="viewcart"><div id="compare_tit">MY WISHLIST</div><table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$output.='<tr><td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">';
			$output .='<tr><td width="32%"><font color="orange"><b>No item in wishlist</b></font></td></tr>';
			$output .= '</table></td></tr><tr><td><div width="53%" class="text">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>     
		<td align=right colspan=2 class="addtowishlist"><a href="?do=wishlist&action=showwishlist">Go to Wishlist </a></td>
		</tr>
		</table></div></td></tr></table></div>';
			
			return $output;
	}
		

 	/**
	* This function is used to Display the Wishlist Products
	* @param mixed $arr
	* @param mixed $r
	* @return  HTML data
 	*/
	function viewWishList($arr,$r)
	{
		
		$output ='<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
		<td colspan="4" class="product_header" >My Wish List </td>
		</tr>
		<tr>
		<td colspan="4" class="product_header" >
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td width="10%">Product</td>
			<td width="22%"><label></label></td>
			<td colspan="2" >Added on</td>
			
			<td width="14%">&nbsp;</td>
			</tr>
		</table></td>
		</tr>';
		$cnt =count($arr); 
		for ($i=0;$i<$cnt;$i++)
		{
			
			$output .='<tr>
							<td class="product_tbbg1">
				<table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
			<tr>
			  <td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">';
			$filename=$arr[$i]['thumb_image'];
			if(file_exists($filename))
				$output.='<img src="'.$_SESSION['base_url'].'/'.$arr[$i]['thumb_image'].'" width="90" height="67" border="0"/>';
			else
				$output.=" <img border='0'  src='".$_SESSION['base_url']."/images/noimage.jpg' width='90' height='67'/>";	
			$output.='</a></td>
			  </tr>
			<tr>
			  <td class="text"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></td>
			</tr>
			<tr>

			  <td align="left" class="rate_text" width="60%">'.$r['']['msrp'].'</td>

			
			</tr>
		  </table>
		  </td>
		  
		 <!-- <td align="center" class="product_tbbg1">
		   <textarea name="new" rows="3" cols="3" style="width: 90%; height: 150px; ">Please, enter your comments...</textarea>            </td>-->
		   
		  <td class="product_tbbg2" align="center" width="30%">&nbsp;&nbsp;&nbsp;&nbsp;'.$arr[$i]['date_added'].'</td>
		  <td align="center"  width="30%">';
		  
		  if($arr[$i]['soh']>0)
			{
			$output.='<span class="addtowishlist"><a href="?do=addtocart&prodid='.$arr[$i]['product_id'].'"><img src="images/addtocart.jpg" border="0"></a>';
			}
			$output.='
			<br />
			</span>
		
			<a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=deletewishlist&prodid='.$arr[$i]['product_id'].'" class="ad_text">Remove</a>          </td>
			</tr>
			<tr>
			<td colspan="4" class="line"></td>
			</tr>';
						
					}
					$output.='<table width="85%" border="0" align="right" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="2">&nbsp;</td>
			<td width="30%">&nbsp;</td>
			</tr>
			<tr>
			
			<td width="37%"><a href="'.$_SESSION['base_url'].'/index.php?do=indexpage" class="All_text_head">
				<button type="button" class="form-button"><span>Continue shopping </span></button>
				</a></td>
			<td width="33%"><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=clearwishlist" class="All_text_head"><button type="button" class="form-button"><span>Clear Wishlist</span></button></a></td>';
				
				
			$output .='</tr></table>';
				$output.='</table>';
		
		return $output;
	}
	/**
	* This function is used to Display the Wishlist snapshot else part
	* @return  HTML data
 	*/
	function viewWishListElse()
	{
		$result = "You have no items in your wishlist.";
				
				$output ='<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
		  <td colspan="4" class="product_header" >My Wish List </td>
		</tr>
		<tr>
		  <td colspan="4" class="product_header" >
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="10%">Product</td>
				<td width="22%"><label></label></td>
				<td width="35%">Comments</td>
				<td width="19%">Added on </td>
				<td width="14%">&nbsp;</td>
			  </tr>
			</table></td>
			</tr>';
					$output.='<tr><td class="product_tbbg1" colspan="4" height="50" align="center"><font color="orange"><b>'.$result.'</b></font></td>';
					$output.='<table width="85%" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2">&nbsp;</td>
			<td width="30%">&nbsp;</td>
		</tr>
		<tr>
		
			<td width="37%" colspan="3" align="center"><a href="?do=indexpage" class="All_text_head"><button type="button" class="form-button"><span>&lt;&lt; Continue Shopping </span></button></a></td>
			
			
		</tr>
		</table>';
			$output.='</table>';
			return $output;
	}
	/**
	* This function is used to Display the  add wishlist snapshot else part
	* @return  string
 	*/
	
	function addtoWishListElse()
	{
		$output ='<div id="compare_tit">MY WISHLIST-NO ITEM(S)</div><table width="100%" border="0" cellspacing="0"                       cellpadding="0">';
					$output.='<tr><td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">';
						$output .='<tr><td width="32%"><font color="orange"><b>No item in wishlist</b></font></td>';
						$output .= '</table></td></tr></table>';
						$output.='</div>
							<div id="compare_bar">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="47%">&nbsp;</td>
								  <td width="53%" class="addtowishlist"><a href="?do=wishlist&action=showwishlist">Go to Wishlist </a></td>
								</tr>
							  </table>
							</div>';
		return $output;
	}
	
 	/**
	* This function is used to Display Wishlist Products
	* @param mixed $arr
	* @return  string
 	*/
	function viewProduct($arr)
	{
		
		$cnt=count($arr); 
		if($cnt>0)
		{
			$output['a']=' <tr><td class="border1">';
			$output['a'] ='<ul class="compare">';
			for ($i=0;$i<$cnt;$i++)
			{
				$output['a'] .= '<li><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=deletecompareproductfromhome&prodid='.$arr[$i]['product_id'].'" style="padding-top:5px;"></a><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" style="padding-left:10px;">'.( (strlen($arr[$i]['title'])>20) ? substr($arr[$i]['title'],0,20).'...' : $arr[$i]['title'] ).'</a></li>';
						
		  	}
			$output['a'].='</ul></td></tr>';
		 
			if($cnt>0)
			{
				$output['a'] .='<tr>
				<td class="border1" align="center"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=deleteallitem"><img src="css/default/images/clearall.jpg" alt="Clear All" border="0" /></a>&nbsp;&nbsp;<a href="?do=compareproduct&action=viewcompareproduct"><img src="css/default/images/compare.jpg" alt="" width="76" height="22" border="0" /></a></td></tr>';
			}
			
			
		}
		
		
		 return $output;
	}
	/**
	* This function is used to Display the product else part
	* @return string
 	*/
	function viewProductElse()
	{
		$output['a'] .=' <tr><td class="border1" align="center">';
		$output['a'] .= '<font color="orange" size=1><b>You have no items to compare</b></font>';
		$output['a'] .=' </td></tr>';	
		
		  return $output;
	}
	

 	/**
	* This function is used to Display the Compared Product
	* @param mixed $arr
	* @param mixed $arr1
	* @param int $product_ids
	* @return  string
 	*/
	function viewCompareProduct($arr,$arr1,$product_ids)
	{
	
		$cnt= count($arr);

		$output ='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="100%" colspan="2" class="serachresult">Compare Products </td>
				</tr>
			  
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2" valign="top">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
				  <tr>
					<td bgcolor="#FFFFFF" width="20%">&nbsp;</td>';
					
					for($i=0;$i<$cnt;$i++)
					{

						if($arr[$i]['thumb_image']!='' && file_exists($arr[$i]['thumb_image']))
							$imgPath=$arr[$i]['thumb_image'];
						else
							$imgPath='images/noimage1.jpg';
					
						$rating=ceil($arr[$i]['rating']);
						$ratepath='';
						for($j=0;$j<5;$j++)
						{
							if($j<$rating)
								$ratepath.='<img src="images/starf.png">';
							else
								$ratepath.='<img src="images/stare.png">';							
						}

					$output .='<td align="left" bgcolor="#FFFFFF" style="padding:10px 0px" valign="top" width="20%">
						<table width="90%" height="100%" border="0" cellspacing="0" cellpadding="0" align=left>
						  <tr>
							<td class="compare_remove"><a href="?do=compareproduct&action=deletecompareproduct&prodid='.$arr[$i]['product_id'].'">Remove</a></td>
						  </tr>
						  <tr>
							<td align="center"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/'.$imgPath.'" alt="'.addslashes($arr[$i]['title']).'" width="'.THUMB_WIDTH.'" border=0 /></a></td>
						  </tr>
						  <tr>
							<td class="compare_title" align="center"><div class="featureTXT"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></div></td>
						  </tr>
						  <tr>
							<td class="compare_title" align="center"><div class="featureTXT"><span><!--$--> '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$i]['price']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</span></div></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" style="padding:5px 0px 0px 10px">'.$_SESSION['base_url'].'/'.$ratepath.'</td>
						  </tr>
						</table>
					</td>';
					}
					$output.='</tr>
					  <tr>
						<td bgcolor="#FFFFFF" class="compare_txt1"></td>';
					for($i=0;$i<$cnt;$i++)
					{
						$output.='
							<td align="center" bgcolor="#FFFFFF" class="compare_txt">
							<table border="0" cellspacing="0" cellpadding="0" align=center>
							
						  <tr>
						  
							<td align="right" valign="top"><input type="button" class="button button_left " /></td>
							<td><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'">
							<input type="submit" name="Submit222" value="Add to Cart" class="button" /></a></td>
							<td valign="top"> <input type="button" class="button button_right"> </td>
						  
						  </tr>
						</table></td>';
				    }	
				  $output.='</tr>
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">Model</td>';
					for($i=0;$i<$cnt;$i++)
					{
					$output .='<td bgcolor="#FFFFFF" class="compare_txt" >'.$arr[$i]['model'].'</td>';
					}
				  $output .='</tr> 
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">MSRP</td>';
					for($i=0;$i<$cnt;$i++)
						$output .='<td bgcolor="#FFFFFF" class="compare_txt"> <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$i]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</td>';
				  $output .='</tr>
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">Manufacturer</td>';
					for($i=0;$i<$cnt;$i++)
						$output .='<td bgcolor="#FFFFFF" class="compare_txt">'.$arr[$i]['brand'].'</td>';
				  $output .='</tr>
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">SKU</td>';
					for($i=0;$i<$cnt;$i++)
						$output .='<td bgcolor="#FFFFFF" class="compare_txt">'.$arr[$i]['sku'].'</td>';
					$output .='</tr>
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">Weight</td>';
					for($i=0;$i<$cnt;$i++)
						$output .='<td bgcolor="#FFFFFF" class="compare_txt">'.$arr[$i]['weight'].'</td>';
					$output .='</tr>
				  <tr>
					<td bgcolor="#FFFFFF" class="compare_txt1">Dimension</td>';
					for($i=0;$i<$cnt;$i++)
						$output .='<td bgcolor="#FFFFFF" class="compare_txt">'.$arr[$i]['dimension'].'</td>';
					$output .='</tr>
				  <tr>
					<td bgcolor="#F5F5F5">&nbsp;</td>';
					for($i=0;$i<$cnt;$i++)
					{
					$rating=ceil($arr[$i]['rating']);
					$ratepath='';
					for($j=0;$j<5;$j++)
					{
						if($j<$rating)
							$ratepath.='<img src="images/starf.png">';
						else
							$ratepath.='<img src="images/stare.png">';							
					}
					$output .='	<td align="center" bgcolor="#F5F5F5" style="padding:10px 0px">
					<table width="90%" border="0" cellspacing="0" cellpadding="0">
					  
					  <tr>
						<td class="compare_title"><div class="featureTXT"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></div></td>
					  </tr>
					 <tr>
						<td class="compare_title"><div class="featureTXT"><span><!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].' '.number_format($arr[$i]['price']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</span>
						</div></td>
					  </tr>					  
					  <tr>
						<td align="left" valign="top" style="padding:5px 0px 0px 10px">'.$_SESSION['base_url'].'/'.$ratepath.'</td>
					  </tr>
					  <tr></tr>
					</table></td>';
					}
				  $output .='</tr>
				  
				  <tr>
				   <td bgcolor="#f0f0f0" style="height:40px;">&nbsp;</td>';
				  for($i=0;$i<$cnt;$i++)
					$output .='<td align="center" bgcolor="#f0f0f0" class="compare_remove"><a href="?do=compareproduct&action=deletecompareproduct&prodid='.$arr[$i]['product_id'].'">Remove</a></td>';
				 
				
			  $output .='</tr>
				</table></td>
				</tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			</table>
			</div>';
			
		return $output;
	}
	/**
	* This function is used to Display the Compared Product
	* @param mixed $arr
	* @param array $totalitem
	* @param int $r
	* @return  string
 	*/
	function snapshotForHome($arr,$totalitem,$r)
	{
		$limit = 0;
		$j=0;
		
		$output='<div style="margin-top:14px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
		<td><div class="heading"><span class="headingTXT">My Wishlist</span></div></td>
		</tr>
		<tr>
		<td class="border1" style="padding:7px">';
      
	 	 $cnt =count($arr); 
		for ($i=0;$i<$cnt;$i++)
		{
			$filename=$arr[$i]['thumb_image'];
			if(file_exists($filename))
				$imgfile=$arr[$i]['thumb_image'];
			else
				$imgfile='images/noimage.jpg';
				
		  $output.=' <table width="100%" border="0" cellspacing="2" cellpadding="0" class="recent">
  			<tr>
                  <td width="40%" rowspan="2"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/'.$imgfile.'" alt="'.addslashes($arr[$i]['title']).'" width="63" height="63" border="0"/></a></td>
                  <td width="60%" valign="top" class="recentTXT"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'<br />
                  </a><span>'.$r[$j]['msrp'].'</span></td>
                </tr>
		<tr><td align="right" valign="bottom" colspan="2"><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=deletewishlist&prodid='.$arr[$i]['product_id'].'"><img src="images/close_button.gif" border="0" title="Remove from my Wishlist" /></a></td></tr>                 </table>';
		}

		$output.='</td>
		</tr>
		<tr>
		<td valign="top" class="seePRODUCT border1"><a href="?do=wishlist">Go To Wishlist </a></td>
		</tr>
		<tr>
		<td class="roundbox1_bottom"></td>
		</tr>
		</table>
		</div>';
		return $output;
	}
	/**
	* This function is used to Display the snap shot in page 
	* 
	* @return HTML data
 	*/
	function snapshotElseForHome()
	{
		$output='<div style="margin-top:14px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td><div class="heading"><span class="headingTXT">My Wishlist</span></div></td>
			</tr><tr>
			<td class="border1" style="padding:7px">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="recent">
						<tr>
				<td width="32%"><font color="orange"><b>No item in wishlist</b></font></td></tr></table></td>
			</tr>
						<tr>
			<td valign="top" class="seePRODUCT border1"><a href="?do=wishlist">Go To Wishlist </a></td>
			</tr>
			<tr>
			<td class="roundbox1_bottom"></td>
			</tr>
		</table>
		</div>';
		return $output;
	}
		

}
?>