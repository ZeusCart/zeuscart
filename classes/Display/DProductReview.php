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
 * Product review related  class
 *
 * @package   		Display_DProductReview
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */


class Display_DProductReview
{

	/**
	 * Stores the output records
	 *
	 * @var array 
	 */	
	$arr = array();
		/**
	 * Stores the output 
	 *
	 * @var array 
	 */
	 $output = array();	
 	/**
	* This function is used to Display the Product Review Page
	* @param mixed $arr
	* @param mixed $Err	
	* @param int $totreview
	* @param string $breadcrumb
	* @return string
 	*/
	function showProductReview($arr,$Err,$totreview,$breadcrumb)
	{
		
		if($Err->messages>0)
		{
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		}
		$out='<form action="'.$_SESSION['base_url'].'/index.php?do=productreview&action=addproductreview&prodid='.$arr[0]['product_id'].'" method="post" name="frm">
		 <table>
		<tr>
		<td>'.$breadcrumb.'</td>
		</tr> <tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="100%" class="product_header">'.$arr[0]['title'].'<input type="hidden" name="prodid" value ="'.$arr[0]['product_id'].'"/></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
		</tr>
		<tr>
			<td ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td width="32%"><img src="'.$_SESSION['base_url'].'/'.$arr[0]['thumb_image'].'"/></td>
			<td width="37%"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
				<tr>
				<td class="text"><a href="?do=prodetail&action=showprod&prodid='.$arr[0]['product_id'].'">'.$arr[0]['title'].'</a></td>
				</tr>';
				
				if($arr[0]['rating']==1)
					  $out .= '<tr>
							<td align="left"><img src="'.$_SESSION['base_url'].'/images/star1.jpg" width="83" height="16" /></td>
						  </tr>';
				elseif($arr[0]['rating']==2)
				  	$out .= '<tr>
						<td align="left"><img src="'.$_SESSION['base_url'].'/images/star2.jpg" width="83" height="16" /></td>
					  </tr>';
				elseif($arr[0]['rating']==3)
					  $out .= '<tr>
							<td align="left"><img src="'.$_SESSION['base_url'].'/images/star3.jpg" width="83" height="16" /></td>
						  </tr>';
				elseif($arr[0]['rating']==4)
					  $out .= '<tr>
							<td align="left"><img src="'.$_SESSION['base_url'].'/images/star4.jpg" width="83" height="16" /></td>
						  </tr>';
				elseif($arr[0]['rating']==5)
					  $out .= '<tr>
							<td align="left"><img src="'.$_SESSION['base_url'].'/images/star5.jpg" width="83" height="16" /></td>
						  </tr>';
			$out .='<tr>
				<td align="left" class="text"><a href="'.$_SESSION['base_url'].'/index.php?do=productreview&action=showproductreview&prodid='.$arr[0]['product_id'].'">'.$totreview.' Reviews</a></td>
				</tr>
				<tr>
				<td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[0]['product_id'].'">
				<img src="'.$_SESSION['base_url'].'/images/addtocart.jpg" border="0"></a></td>
				</tr>
				<tr>
				<td align="left" class="addtowishlist"><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&id='.$arr[0]['product_id'].'">Add to Wishlist</a> </td>
				</tr>
				<tr>
				<td align="left" class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$arr[0]['product_id'].'">Add to Compare</a></td>
				</tr>
				</table></td>
			<td width="31%" align="center" class="addtocompare">&nbsp;</td>
			</tr>
			</table></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
		</tr>';
      
	  	$cnt = count($arr);
		if($totreview > 0)
		{
		  $out .= '<tr>
       		 <td ><div id="ad_text"><a href="#" class="ad_text"></a> </div></td></tr>
		<tr>
			<td class="product_header">Customer Review</td>
		  </tr>';
		  for($i=0;$i<$cnt;$i++)
		  {
			 $rate = $arr[$i]['rating'];
			  $out.='<tr>
				<td >&nbsp;</td>
			  </tr>
			  <tr>
				<td class="page_text" >'.$arr[$i]['review_txt'].'</td>
			  </tr>
			  <tr>
			  <td class="page_text"><b>'.' Review By '.$arr[$i]['user_display_name'].'</b></td></tr>';
			  	if($rate==0)
					 $out .='<tr>
						<td class="page_text" ><img src="images/star1.jpg" width="83" height="16" /></td>
					  </tr>';
			  	elseif($rate==1)
					  $out .='<tr>
						<td class="page_text" ><img src="images/star1.jpg" width="83" height="16" /></td>
					  </tr>';
			 	elseif($rate==2)
					  $out .='<tr>
						<td class="page_text" ><img src="images/star2.jpg" width="83" height="16" /></td>
					  </tr>';
				elseif($rate==3)
					  $out .='<tr>
						<td class="page_text" ><img src="images/star3.jpg" width="83" height="16" /></td>
					  </tr>';
			 	elseif($rate==4)
					  $out .='<tr>
						<td class="page_text" ><img src="images/star4.jpg" width="83" height="16" /></td>
					  </tr>';
			 	elseif($rate==5)
					  $out .='<tr>
						<td class="page_text" ><img src="images/star5.jpg" width="83" height="16" /></td>
					  </tr>';
				$out .='<tr>
				<td class="page_text" >'.$arr[$i]['review_caption'].'</td>
				 </tr>
				 <tr>
				<td class="page_text" >Posted on '.$arr[$i]['review_date'].'</td>
				 </tr>';
			  }
			}
			  $out .='<tr>
				<td class="product_header" ><strong>Write Your Own Review</strong></td>
			  </tr>
			  <tr>
				<td >&nbsp;</td>
			  </tr>
			  <tr>
				<td class="page_text" ><strong>You are reviewing : '.$arr[0]['title'].'</strong></td>
			  </tr>
			  <tr>
				<td >&nbsp;</td>
			  </tr>
			  <tr>
				<td class="page_text" ><strong>How do you Rate this Product? </strong><font color="red">'.$output['msg']['ratings'].'</font></td>
			  </tr>
			  <tr>
				<td >&nbsp;</td>
			  </tr>
			  <tr>
				<td  >
				
				<table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
					  <td align="center" class="product_header"><strong>Stars</strong></td>
					  <td align="center" class="product_header"><strong>1</strong></td>
					  <td align="center" class="product_header"><strong>2</strong></td>
					  <td align="center" class="product_header"><strong>3</strong></td>
					  <td align="center" class="product_header"><strong>4</strong></td>
					  <td align="center" class="product_header"><strong>5</strong></td>
					</tr>
					<tr>
					  <td align="center" class="shop_cart"><strong>Quality</strong></td>
					  <td align="center" class="shop_cart"><input type="radio" title="1star" name="ratings" id="Quality_1" value="1"/></td>
					  <td align="center" class="shop_cart"><input type="radio" title="2star" name="ratings" id="Quality_2" value="1"/></td>
					  <td align="center" class="shop_cart"><input type="radio" title="3star" name="ratings" id="Quality_3" value="1"/></td>
					  <td align="center" class="shop_cart"><input type="radio" title="4star" name="ratings" id="Quality_4" value="1"/></td>
					  <td align="center" class="shop_cart"><input type="radio" title="5star" name="ratings" id="Quality_5" value="1"/></td>
					
					</tr>
				  </table>
				
				 </td>
			  </tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr>
			 	<td class="page_text"><strong>Summary of your overview</strong><font color="red">*</font><font color="red">'.$output['msg']['reviewtxt'].'</font></td>
			  </tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="reviewtxt" size="70" value="'.$output['val']['reviewtxt'].'"></td>
			  </tr>	
			  <tr><td>&nbsp;</td></tr>
			  <tr>
			    <td class="page_text"><strong>Review</strong><font color="red">*</font>
				<font color="red">'.$output['msg']['detail'].'</font></td>
			  </tr>
			  <tr><td>&nbsp;</td></tr>
			   <tr>
			    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="detail" id="review_field" value="'.$output['val']['detail'].'" cols="53" rows="10" style="width: 450px;"></textarea></td>
			  </tr>
			  
			  <tr><td>&nbsp;</td></tr>
			    <tr>
				<td align="center">
				<input name="review" type="submit" class="form-button" value="Add Review"/>
				</td>
			  </tr>
			  <tr>
				<td >&nbsp;</td>
			  </tr>
			 </table></tr>
  			</table> </form> ';
		
		return $out;
	}
	
 	/**
	* This function is used to Display the Bread Crumb
	* @param mixed $arr
	* @return string
 	*/
	function breadCrumb($arr)
	{	
		
		$bread='<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              <tr>
                  <td align="left" scope="col"><a href="'.$_SESSION['base_url'].'/index.php?do=indexpage">Home</a> > <a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[0]['maincatid'].'">'.$arr[0]['Category'].'</a> > <a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[0]['category_id'].'">'.$arr[0]['SubCategory'].'</a> > '.$arr[0]['title'].' </td></tr></table>';
		return $bread;
	}
}
?>
