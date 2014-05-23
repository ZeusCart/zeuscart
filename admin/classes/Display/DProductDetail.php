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
 * This class contains functions to display the product details 
 *
 * @package  		Display_DProductDetail
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DProductDetail
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	 * Function  to display   the  products 
	 * @param array $arr
	 * @return string
	 */			
	function showProducts($arr)
	{
		$output .= '<table border="1" width="100%">';
		$output.='<th>S.no.</th><th width="100%">Product Name</th><th>Image</th>';
	
		for ($i=0;$i<count($arr);$i++)
		{
			$temp=$arr[$i]['thumb_image'];
			$img=explode('/',$temp);
			$output .= '<tr><td>'.($i+1).'</td><td ><a href=callid('.$arr[$i]['product_id'].') name="prodname"> '.$arr[$i]['title'].'</a></td>';
			$output .='<td ><img src="uploadedimages/thumb/thumb_'.$img[2].'" name="image1"  id="image1" /></td>';
			$output.='<td><input type="button" name="View"  title="view" value="View" onclick=callid('.$arr[$i]['product_id'].') /></td></tr>';
		}
			$output .= '</table>';
			return $output;	
	}
	/**
	 * Function  to display   the  products  detail page
	 * @param array $arr
	 * @param integer $rating
	 * @param integer $reviewCount
	 * @return string
	 */	
	function productDetail($arr,$rating,$reviewCount,$recordsAttri)
	{

		//$output .= '<table border="1" width="100%">';
		//$output.='<th>S.no.</th><th width="100%">Product Name</th><th>Image</th>';
		//print_r($arr[0]['price']);
		//print_r($arr[0]['quantity']);
		/*<link href="css/default/styles.css" rel="stylesheet" type="text/css" />
		<link href="css/default/anylinkvertical.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="css/default/anylinkvertical.js">*/
		//include('templates/header.html');
		//print_r($reviewCount['review']);
		if($reviewCount=='')
		{
			$reviewCount=0;
		}
		$cnt=count($arr);
		$saveprice= '<table border="1" width="100%">';
		$saveprice.='<th width="100%">Features</th>';	
		for($i=0;$i<$cnt;$i++)
		{
	
		if($arr[$i]['quantity']>0)
		{
			$qty=$arr[$i]['quantity'];
			$pmsrp=$arr[$i]['msrp'];
			$mprice=$arr[$i]['price'];
			$result=$qty*$mprice;
			$result1=$qty*$pmsrp;
			$diff=$result1-$result;
			//$temp=$result-$mprice."</br>";
			$final=number_format(($diff/$result1)*100,1)."% </br>";
			$saved= "Buy ".$qty." for ".$_SESSION['currency']['currency_tocken'].$mprice." each and <b>save</b> ".$final.'</b>';
		}
			$saveprice.='<tr><td>'.$saved.'</td>';
		}
		$saveprice.= '</table>';
		
		// 		$output.='<head><title>'.$arr[0]['title'].'</title>
		// <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		// <meta name="description" content="'.$arr[0]['meta_desc'].'" />
		// <meta name="keywords" content="'.$arr[0]['meta_keywords'].'" />
		// 
		// </script></head><body>';

		$output='<div class="row-fluid">

		<div class="span12">
		<div class="span6">';
		$filename="../".$arr[0]['image'];
				if(file_exists($filename))
					$output.=' <img border="0"  src='."../".$arr[0]['image'].'  />';
				else
					$output.=' <img border="0"  src="../images/noimage.jpg" />';	
				$output.='
		</div>
		<div class="span6">
		<p class="formSep"><h4>'.$arr[0]['title'].'</h4></p>
		
		<p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span class="label label-success">SKU : '.$arr[0]['sku'].'</span></td>
				
				</tr>
				</tbody></table> </p>

		<p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span>Price : <font color="red">'.$_SESSION['currency']['currency_tocken'] .number_format($arr[0]['price'],2).'</font></span></td>
				
				</tr>
				</tbody></table></p>
		<p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span>MSRP : <font color="red">'.$_SESSION['currency']['currency_tocken'] .number_format($arr[0]['msrp'],2).'</font></span></td>
				
				</tr>
				</tbody></table></p>';

			if($arr[0]['soh']>0)
			{
				$output.=' <p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span>Availability :  <span class="label label-info">In stock</span></span></td>
				
				</tr>
				</tbody></table></p>';
			}
			else
			{
				$output.=' <p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span>Availability : <span class="label">Out stock.</span></span></td>
				
				</tr>
				</tbody></table></p>';
			}

		
		$output.='<p class="formSep"><table width="100%" border="0">
				<tbody><tr>
				<td align="left" valign="top"><span>Tags : '.$arr[0]['tag'].'</span></td>
				
				</tr>
				</tbody></table></p>
		</div>
		</div>
		</div>';

		$output.='<div class="bs-docs-example">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#home">Product Overview</a></li>
              <li class=""><a data-toggle="tab" href="#profile">Additional Information</a></li>
              
            </ul>';
		
		$removal= array("rn");
		$desc= str_replace($removal, "", trim($arr[0]['description']));
            $output.='<div class="tab-content" id="myTabContent">
              <div id="home" class="tab-pane fade active in">
                <p>'.$desc.'</p>
              </div>
              <div id="profile" class="tab-pane fade">
                <p><tr>
		<td align="left"><table width="100%" align="center" cellspacing="0"  class="table table-striped">
		
		<tbody>
		
			<tr>
			<td width="23%" align="left" >Model</td>
			<td width="77%" >'.$arr[0]['model'].'</td>
			</tr>
			
					<tr >
			<td width="23%" align="left" >Dimensions</td>
			<td width="77%" >'.$arr[0]['dimension'].'</td>
					</tr>
			<tr >
			<td width="23%" align="left" >weight</td>
					
			<td >'.$arr[0]['weight'].'</td>
			</tr>';
			if(count($recordsAttri)>0)
			{
				for($k=0;$k<count($recordsAttri);$k++)
				{
					$output.='<tr >
					<td width="23%" align="left" >'.$recordsAttri[$k]['attrib_name'].'</td>
							
					<td >'.$recordsAttri[$k]['attrib_value'].'</td>
					</tr>';


				}	

			}
			
		$output.=' </table></td>
		</tr></p>
              </div>
             
          </div>
		  
		';
	 return $output;	
	 
	 //QTY <span class="qty-box"><label for="qty">Qty:</label>
//<input name="qty" class="input-text qty" id="qty" maxlength="12" value="" type="text"></span>
/*$output.='<div>

</div>

<div>
'.$saveprice.'</div>

</td>
</tr>


';*/

 	}

 	/**
	 * Function  to display   the  review rating
	 * @param array $arr
	 * @return string
	 */	
	function reviewRating($arr)
	{
		$cnt=count($arr);
	
		$rate = round($arr[0]['rating']+ $arr[0]['rating']/$cnt);
		if($rate>0)
			return '<img src="../images/star'.$rate.'.jpg"/>';
	}
	/**
	 * Function  to display   the  attribute list 
	 * @param array $arr
	 * @return string
	 */	
	function attributeList($arr)
	{
		$output .= '<table border="0" width="">';
		$output.=' <td colspan="2"><h4>Special Attributes</h4></td>';
		
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
			{
				$classval = 'class="even"';
				$classtd='align="right" class="content_list_txt2"';
				$classtd1='class="content_list_txt2"';
								
			}	
			else
			{
				$classval = ' class="odd first"';
				$classtd='width="23%" align="right" class="content_list_txt1"';
				$classtd1='width="77%" class="content_list_txt1"';
			}	
				
			$output .= '<tr '.$classval.'><td '.$classtd.'>'.$arr[$i]['attrib_name'].'</td><td '.$classtd1.'>'.$arr[$i]['attrib_value'].'</a></td></tr>';
		}
		
			$output .= '</tbody></table>';
			return $output;	
	}
	/**
	 * Function  to display   the  related product list 
	 * @param array $arr
	 * @return string
	 */	
	function relatedProducts($arr)
	{
	$i=0;
	if((count($arr)>0))
	{
			foreach($arr  as $row)
			{
						$product_id=$row['product_id'];
						$sku=$row['sku'];
						$title=$row['title'];
						$description=$row['description'];
						$brand=$row['brand'];
						$price=number_format($row['price'],2);
						$msrp=$row['msrp'];
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						$thumb_image=$row['thumb_image'];
						$image=$row['image'];
						$img=explode('/',$thumb_image);
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						
						
						
						if($i!=3)
						{
							$output.='<td width="15%" valign="top" style="border:1px solid #e0e0e0;"><table width="100%" align="center" cellspacing="7" cellpadding="6"  >
        <tr><td align="left"><a href="?do=prodetail&action=showprod&prodid='.$product_id.'">';
		
		$filename="../".''.$thumb_image;
				if(file_exists($filename))
					$output.=' <img border="0" src="'."../".''.$thumb_image.'" alt=""/>';
				else
					$output.=' <img border="0"  src="../images/noimage.jpg" />';	
		$output.='</a></td></tr>
		 <tr>
          <td class="text"><a href="?do=aprodetail&action=showprod&prodid='.$product_id.'">'.$title.'</a></td>
        </tr>
		<tr>
          <td align="left" class="rate_text">'.$msrp.'</td>
        </tr></table></td>
		
        
		';
			//<tr>
       // //  <td align="left" class="addtocompare"><a href="?do=wishlist&action=viewWishList&id='.$product_id.'">Delete</a></td>
      //  </tr>			
$output.="
               
      	";
						}
												
						elseif($i==3)
						{
							$output.='<td width="15%" cellspacing="2" class="product_tbbg1" valign="top"><table width="100%" align="center" cellspacing="2" class="content_list_bdr" id="product-attribute-specs-table">
        <tr><td align="center"><a href="?do=prodetail&action=showprod&id=$product_id">';
		
		$filename="../".''.$thumb_image;
				if(file_exists($filename))
					$output.=' <img border="0" src="'."../".''.$thumb_image.'" alt=""/>';
				else
					$output.=' <img border="0"  src="../images/noimage.jpg" />';	
		$output.='</td></tr>
		 <tr>
          <td class="text"><a href="?do=prodetail&action=showprod&prodid=$product_id">'.$title.'</a></td>
        </tr>
		<tr>
          <td align="left" class="rate_text">'.$msrp.'</td>
        </tr>
		
        <tr>
          <td align="left" class="addtocompare"><a href="?do=wishlist&action=viewWishList&id='.$product_id.'">Delete</a></td>
        </tr>
		'; 
			
$output.="
      </table></td>	";
						$i=0;
						}
	
						$i++;
			}
			//$output.="</table>";
			
			
			}
			else
			{
				// $output='No Records Found';
			}
			return $output;
	}
}	