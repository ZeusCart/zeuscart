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
 * Product details related  class
 *
 * @package   		Display_DProductDetail
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
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
	* This function is used to Display the Products
	* @param mixed $arr
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
			$output .='<td ><img src="'.$_SESSION['base_url'].'/uploadedimages/thumb/thumb_'.$img[2].'" name="image1"  id="image1" /></td>';
			$output.='<td><input type="button" name="View"  title="Delete" value="View" onclick=callid('.$arr[$i]['product_id'].') /></td></tr>';
		}
			$output .= '</table>';
			return $output;	
	}
	
 	/**
	* This function is used to Display the Page Info
	* @param mixed $arr
	* @return string
 	*/
	function pageInfo($arr)
	{
		
		return $output.='<meta name="description" content='. $arr[0]['meta_desc'] .' /><meta name="keywords" content='.$meta_keywords.' />
		<title> '.$arr[0]['title'].' </title>';
		
			return $output;	
	}
	

 	/**
	* This function is used to Display the Product Detail Page
	* @param mixed $arr
	* @param string $diffrate
	* @param string $features
	* @param string $rating
	* @param string $breadCrumb
	* @param int $reviewCount
	* @param mixed $reviewArr
	* @param mixed $imgArr
	* @param mixed $tierArr
	* @param mixed $relArr
	* @return string
 	*/
	function productDetail($arr,$diffrate,$features,$rating,$breadCrumb,$reviewCount,$reviewArr,$imgArr,$tierArr,$relArr,$var_arr)
	{



		// category name selection
		$sql="SELECT * FROM category_table WHERE category_id ='".$arr[0]['category_id']."'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$categoryname=$obj->records[0]['category_name']; 

		$removal= array("rn");
		$desc= str_replace($removal, "", trim($arr[0]['description']));

		$result=$_SESSION['reviewResult'];
		
		$output=''.$result.'';
		

		$output.='<div class="title_fnt">
		<h1>'.$arr[0]['title'].'</h1>
		</div>
		<div id="gallery_div">
		<div class="row-fluid">';

		$output.='<span class="hidden-phone"><div class="span6">  

		 <div class="clearfix" id="content" >
			<div class="clearfix">
			<a href="'.$_SESSION['base_url'].'/'.$arr[0]['large_image_path'].'" class="jqzoom" rel="gal1"   title="'.$arr[0]['title'].'" >
			<img src="'.$_SESSION['base_url'].'/'.$arr[0]['image'].'"  title="'.$arr[0]['title'].'"  style="border: 0px solid #ccc;">
			</a>
			</div>
			<br/>
			<div class="clearfix" >
				<ul id="thumblist" class="clearfix" >
				<li><a class="zoomThumbActive" href=\'javascript:void(0);\' rel="{gallery: \'gal1\', smallimage: \''.$arr[0]['image'].'\',largeimage: \''.$_SESSION['base_url'].'/'.$arr[0]['large_image_path'].'\'}"><img src=\''.$_SESSION['base_url'].'/'.$arr[0]['thumb_image'].'\'></a></li>';
			
				for($l=0;$l<count($imgArr);$l++)
				{
				$output.=' <li><a href=\'javascript:void(0);\' rel="{gallery: \'gal1\', smallimage: \''.$_SESSION['base_url'].'/'.$imgArr[$l]['image_path'].'\',largeimage: \''.$_SESSION['base_url'].'/'.$imgArr[$l]['large_image_path'].'\'}" ><img src=\''.$_SESSION['base_url'].'/'.$imgArr[$l]['thumb_image_path'].'\'></a></li>';
				}
			
				$output.='</ul>
				</div>';		
		$output.='</div></div> 

		</span>';
		$output.='<span class="visible-phone"><div class="span6">   <div class="clearfix" id="content" >
			<div class="clearfix">
			
			<img src="'.$_SESSION['base_url'].'/'.$arr[0]['image'].'"  title="'.$arr[0]['title'].'"  style="border: 0px solid #ccc;">
			</a>
			</div>
			<br/>';			
		$output.='</div></div> </span>';

		$output.='<div class="span6">
				<div class="gallery_detail">';
				if($arr[0]['gift']=='1')
				{
				$output.='<form method="post"	action="javascript:showGiftVoucher();" name="frmcart">';
				}
				else
				{
				$output.='<form method="post"	action="'.$_SESSION['base_url'].'/index.php?do=addtocartfromproductdetail&prodid='.$arr[0]['product_id'].'" name="frmcart">';
				}

				
				$output.='<ul class="detaillist">
				<li>';
				if($arr[0]['product_status']==1)
				{
				$output.='<div class="productimg"><div class="ribbion_newtag_div"></div></div>';
				}
				elseif($arr[0]['product_status']==2)
				{
				$output.='<div class="ribbion_saletag_div"></div>';
				}

		
				$output.=''.$rating.'</li>';
					
				$output.='<li>'.Core_CLanguage::_('SKU').' : <span class="label">'.$arr[0]['sku'].'</span></li>
				<li><table width="100%" border="0">
				<tr>
				<td align="left" valign="top">';
		
				if($arr[0]['soh']>0)
				{
					$output.='<span>'.Core_CLanguage::_('AVALABILITY').' : '.Core_CLanguage::_('IN_STOCK').'</span>';
				}
				else
				{
					$output.='<span>'.Core_CLanguage::_('AVALABILITY').' :  '.Core_CLanguage::_('OUT_OF_STOCK').'</span>';
				}
		
				
				$output.='</td>
				
				<td align="left" valign="top"><h1>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[0]['msrp'].'</h1></td>
				</tr>';

// 				if($arr[0]['shipping_cost']!='0' && $arr[0]['digital']=='0' && $arr[0]['gift']=='0')
// 				{
// 				
// 				$output.='<tr><td align="left" valign="top"><span>Shipping Cost : <span class="red_fnt"> '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].' '.$arr[0]['shipping_cost'].'</span></span></td></tr>';
// 				}
// 				elseif($arr[0]['shipping_cost']=='0' && $arr[0]['digital']=='0' && $arr[0]['gift']=='0')
// 				{
// 					$output.='<tr><td align="left" valign="top"><span>Shipping Cost : <span class="red_fnt"> Free</td></tr>';
// 
// 				}

				$output.='
				</table></li>';

		//----------------variation----------------
	
			
		if (count($var_arr)>0)
		{
			
			$output.='<li style="padding-bottom:20px;">Size : ';
			
			$variation_id=(int)$_GET['varid'];
			
			
			$output.='<select name="variations" onchange="changeVariation('.$arr[0]['product_id'].',this.value);">';
	
			$output.='<option  value="'.$variations['variation_id'].'" '.(($variation_id==$variations['variation_id']) ? 'selected="selected"' : '').' >Default</option>';

			foreach($var_arr as $variations)
			{
				$output.='<option value="'.$variations['variation_id'].'" '.(($variation_id==$variations['variation_id']) ? 'selected="selected"' : '').' >'.$variations['variation_name'].'</option>';
			}
			$output.='</select></li>';
			
		}
	//----------------variation----------------
				$output.='<li>
				<tr>				

				<td align="left" valign="top"><span>'.Core_CLanguage::_('TAGS').' : ';
					$tags=explode(',',$arr[0]['tag']);
				foreach( $tags as $tag)
				$tagLinks[]='<a href="?do=search&search='.$tag.'">'.$tag.'</a>';
		
				$output.=implode(' | ',$tagLinks).'</span></td>';
				
			
				$output.='</tr>
				
				</li>
						<li><h2>'.Core_CLanguage::_('QUICK_OVERVIEW').':</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci

						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.</p></li>
				<li>
				<table width="100%" border="0">
		<tr>';
		if($arr[0]['gift']=='0' && $arr[0]['digital']=='0' )
		{

		$output.='<td>'.Core_CLanguage::_('QUANTITY').' <input type="text" name="qty[]" style="width:60px;" value="'.$_SESSION['error_quantity'].'"></td>';
			
		}
		if($_GET['varid']!='')
		{

		$output.='<td>'.Core_CLanguage::_('QUANTITY').' <input type="text" name="qty[]" style="width:60px;" value="'.$_SESSION['error_quantity'].'"></td>';
		
			
		}
		$output.='<input type="hidden" name="gift" value='.$arr[0]['gift'].'>';
		

		if($arr[0]['digital']=='1')
		{
		$output.='<td>'.Core_CLanguage::_('QUANTITY').' <input type="text" name="qty[]" style="width:60px;" value="1" readonly="true"></td>';

		}
		
		$output.='<td align="left" valign="top"><button type="submit" class="add_btn" title="'.Core_CLanguage::_('ADD_TO_CART').'"><p style="margin-left:38px;top:5px">'.Core_CLanguage::_('ADD_TO_CART').'</p></button>&nbsp;&nbsp;


		<a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr[0]['product_id'].'"><button type="button" class="wishlist_button" title="'.Core_CLanguage::_('ADD_TO_WISHLIST').'">'.Core_CLanguage::_('ADD_TO_WISHLIST').'</button></a>
		 </td>';
		
		 $mode='none';
		if(count($tierArr)>0)
		$mode='block';

		

		$output.='</tr>
		</table>
					
				</li>
			</ul>
		</form></div>
			
		</div> </div>

		
		<div id="giftvoucher"></div>
            	<div class="clear"></div><div class="buyauc_div" style="display:block;">
            	 <ul class="view_div">
                        <li ><a href="javascript:showAccnt(\'account_id\'); void(0)" class="acc_select" id="account_id1">'.Core_CLanguage::_('PRODUCT_DESCRIPTION').'</a></li>
                        <li ><a href="javascript:showAccnt(\'details_id\'); void(0)" class="acc_unselect" id="details_id1">'.Core_CLanguage::_('REVIEWS').'</a></li>
                        <li style="display:'.$mode.'"><a href="javascript:showAccnt(\'divTier\'); void(0)" class="acc_unselect" id="divTier1">'.Core_CLanguage::_('TIER_PRICE').'</a></li>
                </ul>

       
		<div style="display:block;" id="account_id" class="prd_desc">
		'.$desc.'
		</div>
           
            	 <div style="display:none;" id="details_id">';
		

             	$output.='<ul class="reviewcmd">';
		for($i=0;$i<count($reviewArr);$i++)
		{
			$img='';
			for($j=0;$j<5;$j++)
			if($j<round($reviewArr[$i]['rating']))
				$img.='<img src="assets/'.$_SESSION['template'].'/img/star.png" alt="star" />';
			else
				$img.='<img src="assets/'.$_SESSION['template'].'/img/star-gray.png"  alt="star" />';
                	$output.='<li><i class="icon-user"></i> Reviewed by :  '.$reviewArr[$i]['user_display_name'].'<span class="pull-right">'.$_SESSION['base_url'].'/'.$img.'</span>
                    <p>'.$reviewArr[$i]['review_caption'].'</p>
                    </li>';
             
		}
             	$output.='</ul>';

		if(isset($_SESSION['postvaluesreview']))
		{
			$postvalues=$_SESSION['postvaluesreview'];
			unset($_SESSION['postvaluesreview']);
		}
		else
		{
			$postvalues='';
			unset($_SESSION['postvaluesreview']);
		}
                 $output.='<form class="form-horizontal" name="frm" method=post action="">
		<div class="control-group" >
		<label class="control-label" for="inputEmail">'.Core_CLanguage::_('CAPTION').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input type="text" id="caption"  name="caption" value="'.$postvalues['caption'].'">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">'.Core_CLanguage::_('REVIEW').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<textarea rows="" cols="" name="review">'.$postvalues['review'].'</textarea>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">'.Core_CLanguage::_('RATE_THIS_PRODUCT').'</label>
		<div class="controls">
		<img name="img1" src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png" title="1 star out of 5" onmouseover="fun(1)" onmouseout="fun1(1)" onclick=fun2(1)>
		<img name="img2" src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png" title="2 stars out of 5" onmouseover="fun(2)" onmouseout="fun1(2)" onclick=fun2(2)>
		<img name="img3" src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png" title="3 stars out of 5" onmouseover="fun(3)" onmouseout="fun1(3)" onclick=fun2(3)>
		<img name="img4" src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png" title="4 stars out of 5" onmouseover="fun(4)" onmouseout="fun1(4)" onclick=fun2(4)>
		<img name="img5" src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png" title="5 stars out of 5" onmouseover="fun(5)" onmouseout="fun1(5)" onclick=fun2(5)>
		<input type=hidden name=hidRate>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail">'.Core_CLanguage::_('ENTER_THE_CODE_IN_THE_BOX_BELOW').'</label>
		<div class="controls">
		<input type="text" id="txtcaptcha" name="txtcaptcha" >
		</div>
		</div>
		<div class="control-group">
		&nbsp;
		<div class="controls">
		
		<img src="?do=captcha"  id="captcha" name="captcha" width="90" height="45"/><span class="featureTXT" style="padding:0px;font-size:11px"> <a href="#reg" onclick="javascript:shuffle();" >'.Core_CLanguage::_('TRY_ANOTHER_ONE').'</a></span></div>
		</div>
		<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-danger" name="reviewbutton" id="reviewbutton" >'.Core_CLanguage::_('SUBMIT_REVIEW').'</button>
		</div>
		</div>
		</form>
		</div>';

		$output.='<div id="divTier" style="display:none"><table class="table table-striped">';

			for($t=0;$t<count($tierArr);$t++)
			{

				$output.='<tr><td >Buy '.$tierArr[$t]['quantity'].' for '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($tierArr[$t]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' each.</td></tr>';
			
				

			}
			$output.='</table></div>
		</div>';

		return $output;	
	}
 	/**
	* This function is used to Display the Review Rating
	* @param mixed $arr
	* @return string
 	*/
	function reviewRating($arr)
	{
		
		$rating=ceil($arr);
		$ratepath='';
		for($r1=0;$r1<5;$r1++)
		{
			if($r1<$rating)
				$ratepath.='<img src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star.png">&nbsp;';
			else
				$ratepath.='<img src="'.$_SESSION['base_url'].'/assets/'.$_SESSION['template'].'/img/star-gray.png">&nbsp;';							
		}	
		return $ratepath;
	}
 	/**
	* This function is used to Display the breadCrumb
	* @param mixed $arr
	* @return string
 	*/
	function breadCrumb($arr)
	{	
		
		$bread='<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              <tr>
                  <td align="left" scope="col"><a href="'.$_SESSION['base_url'].'/index.php?do=indexpage">Home</a> > <a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[0]['maincatid'].'">'.$arr[0]['Category'].'</a> > <a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[0]['category_id'].'">'.$arr[0]['SubCategory'].'</a> > '.$arr[0]['title'].' </a></td>
              </tr>
          </table>';
		return $bread;
	}

 	/**
	* This function is used to Display the attribute List of Product
	* @param mixed $arr
	* @return string
 	*/
	function attributeList($arr,$recordsfeature)
	{
	
		if($arr!='' || $recordsfeature!='')
		{
			$output='<table id="rt1" class="rt cf">
				<thead class="cf">
				<tr>
				<th colspan="2">'.Core_CLanguage::_('ADDITIONAL_INFORMATION').'</th>
					
				</tr>
				</thead>';
	
// 			if($recordsfeature[0]['sku']!='')
// 				{$output.='<tr ><td  width="50%">SKU </td><td> '.$recordsfeature[0]['sku'].'</td></tr>';}
			if($recordsfeature[0]['brand']!='')
				{$output.='<tr ><td  width="50%">'.Core_CLanguage::_('BRAND').' </td><td> '.$recordsfeature[0]['brand'].'</td></tr>';}
			if($recordsfeature[0]['weight']!='')
				{$output.='<tr ><td  width="50%">'.Core_CLanguage::_('WEIGHT').' </td><td> '.$recordsfeature[0]['weight'].' (lbs)</td></tr>';}
			if($recordsfeature[0]['dimension']!='')
				{$output.='<tr ><td  width="50%">'.Core_CLanguage::_('DIMENSION').' </td><td> '.$recordsfeature[0]['dimension'].' (inches)</td></tr>';}

			if($arr!='')
			{
				for ($i=0;$i<count($arr);$i++)
				{
	
					$output.= '<tr ><td  width="50%">'.$arr[$i]['attrib_name'].' </td><td '.$classval.'>'.$arr[$i]['attrib_value'].'</a></td></tr>';
				}
			}
				$output.= '</tbody></table></td><tr><td width="3%" >&nbsp;</td></tr></table>';

		}

			return $output;	
	}
	
 	/**
	* This function is used to Display the related Products
	* @param mixed $arr
	* @param int $flag
	* @param array $r
	* @return string
 	*/
	function relatedProducts($arr,$flag,$r)
	{

		
		if($flag==1)
			$output='<br/><span class="head_text">Related Products </span><div id="middle_details"><div id="product_tbbg_details">
			<table width="100%" border="0" cellpadding="2" cellspacing="2">';
		$loop=0;$j=0;
		$cnt=count($arr);
		if(($cnt>0))
		{
			for($i=0;$i<$cnt;$i++)
			{
							$product_id=$arr[$i]['product_id'];
							$sku=$arr[$i]['sku'];
							$title=$arr[$i]['title'];
							$description=$arr[$i]['description'];
							$brand=$arr[$i]['brand'];
							$price=number_format($arr[$i]['price'],2);
							$msrp=number_format($arr[$i]['msrp'],2);
							$weight=$arr[$i]['weight'];
							$dimension=$arr[$i]['dimension'];
							$thumb_image=$arr[$i]['thumb_image'];
							$image=$arr[$i]['image'];
							$img=explode('/',$thumb_image);
							$shipping_cost=$arr[$i]['shipping_cost'];
							$status=$arr[$i]['status'];
							$tag=$arr[$i]['tag'];
							$pat="images/products/";
							
							if($loop==3)
							{
								$output.='</tr>';
								$loop=0;
							}		
							if($loop==0)
								$output.='<tr>';
							
							$output.="<td id='product_tbbg'><table width='95%' border='0' align='center' cellpadding='2' cellspacing='2'><tr><td><a href='".$_SESSION['base_url']."/index.php?do=prodetail&action=showprod&prodid=".$product_id."'>";
							if(file_exists($thumb_image))
							{
							$output.='<img src="'.$_SESSION['base_url'].'/'.$thumb_image.'" width="90" height="67"  border="0" />';
							}
							else
							{
								$output.='<img border="0" width="90" height="67" src="'.$_SESSION['base_url'].'/images/noimage.jpg"/>';
							} 
						
		$output.="</a></td>
		</tr>
			<tr>
		<td class='text'><a href='".$_SESSION['base_url']."/index.php?do=prodetail&action=showprod&prodid=".$product_id."'>$title</a></td>
		</tr>
			<tr>
		<td align='left' class='rate_text'>".$r[$j]['msrp']."</td>
		</tr>
			<tr>
		<td align='left' class='addtowishlist'><a href='".$_SESSION['base_url']."/index.php?do=wishlist&action=viewwishlist&id=".$product_id."'>Add to Wishlist</a> </td>
		</tr>
		<tr>
		<td align='left' class='addtocompare'><a href='".$_SESSION['base_url']."/index.php?do=compareproduct&action=addtocompareproduct&prodid=".$product_id."'>Add to Compare</a></td>
		</tr>
			";
			
			$output.="</table></td>	";
		
			$loop++;$j++;
			}
			$output.='</table></div>';
			
		}
		else
			$output='No Records Found';
		return $output;
	}
	
 	/**
	* This function is used to Display the Related Products
	* @param mixed $arr
	* @return string
 	*/
	function dispRelatedProduct($arr)
	{
// echo "<pre>";
// print_r($arr);
// exit;

// 		if(count($arr > 0))
// 		{
// 			$output='<table width="100%" border="0" cellspacing="0" cellpadding="0">
// 			      <tr>
// 				<td><div class="heading"><span class="headingTXT">Browse Similar Items</span></div></td>
// 			      </tr>
// 			      <tr>
// 				<td class="border1">
// 					<ul class="categoriesList">';
// 			for($i=0;$i<count($arr);$i++)
// 			{
// 				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></li>';
// 			}
// 			$output.='</ul>		</td>
// 			      </tr>
// 			      <tr>
// 				<td valign="top" class="roundbox1_bottom" ><!--<img src="images/bot.gif" alt="" width="189" height="4" />-->&nbsp;</td>
// 			      </tr>
// 			    </table>';
// 		}

		$output='  <div id="feature_event">
       			 <h4>Related Product </h4><div id="special_product">
     			 <ul class="eventlist">';


		if(count($arr > 0))
		{
			
			for($i=0;$i<count($arr);$i++)
			{
				$output.='<li><div id="eventlist"><table width="100%" border="0">
				<tr>
				<td align="left" valign="top"><div class="eventimg"><img src="'.$_SESSION['base_url'].'/'.$arr[$i]['thumb_image'].'" alt="01"></div></td>
				<td align="left" valign="top"><h5><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></h5><p></p>
				<b>$ '.$arr[$i]['msrp'].' </br><a href="?do=addtocart&prodid='.$arr[$i]['product_id'].'" class="btn btn-danger btn-mini">Add to Cart</a> 
				</td>
				</tr>
				</table></div></li>';
			}
		
		}

        	$output.='</ul></div></div>';



		return $output;
	}
	
 	/**
	* This function is used to Display the Product in Large View
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showLargeview($arr,$paging,$prev,$next,$val)
	{
	
		$output='
		<table width="100%" border="0" cellspacing="0" cellpadding="0" height=350px>
		<tr>
		<td valign="top" class="itemDETAIL" align=center>
		<ul>'.$arr['title'].'
		</ul></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td align=center>
		<img src="'.$_SESSION['base_url'].'/'.$arr['image_path'].'" border="1"  width="213" height="153" />
		</td></tr>
		<tr align="right"><td class="content_list_footer" >'.' '.$prev.' ';
					for($i=1;$i<=count($paging);$i++)
					 $pagingvalues .= $paging[$i]."  ";
							$output .= $pagingvalues.' '.$next.'</td></tr>
		</table>';
		 return $output;
	}

	/**
	 * This function is used to display the category list .
	 *
	  * @param   array  	$arr	array of items
	 * 
	 * @return string
	 */

	function showCategoryTree($arr)
	{
		
// 		$output='<ul id="tree" class="nicetree">';
// 
// 		for($i=0;$i<count($arr);$i++)
// 		{
// 
// 
// 			$output.='<li class="blue active withsubsections">
// 				<a  class="">'.$arr[$i]['category_name'].'</a>';
// 				$query = new Bin_Query(); 
// 				$sql = "SELECT * FROM `category_table` WHERE category_parent_id =".$arr[$i]['category_id']." AND  sub_category_parent_id =0 AND category_status =1 order by category_name limit 16";
// 				$query->executeQuery($sql);
// 				$count=count($query->records);
// 				if($count>0)
// 				{	
// 					$records=$query->records;
// 					$output.='<ul class="subsections" style="display: none;">';
// 					for($j=0;$j<$count;$j++)
// 					{
// 						$output.='<li><a href="#">'.$records[$j]['category_name'].'</a>';
// 
// 
// 							$sqlsub="SELECT * FROM category_table WHERE sub_category_parent_id='".$records[$j]['category_id']."'";
// 							$objsub=new Bin_Query();
// 							$objsub->executeQuery($sqlsub);
// 							$recordssub=$objsub->records;
// 							$output.='<ul class="subsections" style="display: none;">';
// 							for($k=0;$k<count($recordssub);$k++)
// 							{
// 
// 							$output.='<li>
// 								<a href="'.$_SESSION['base_url'].'/index.php?do=viewproducts&cat='.$arr[$i]['category_name'].'&subcat='.$records[$j]['category_name'].'&subundercat='.$recordssub[$k]['category_name'].'">'.$recordssub[$k]['category_name'].'</a>
// 								</li>';
// 										
// 							}
// 									$output.='</ul>
// 
// 
// 
// 
// 						</li>';
// 					}
// 					$output.='</ul>';
// 				}
// 						
// 				$output.='</li>';
// 						
// 
// 			}
// 
// 		$output.='</ul>';
		 $output='<div id="side"><ul class="accordion">';

		for($i=0;$i<count($arr);$i++)
		{
			
			 $sluggable = trim($arr[$i]['category_alias']);	
			
			$output.=' <li><a href="'.$_SESSION['base_url'].'/'.$sluggable.'.html">'.$arr[$i]['category_name'].'</a>';
			$output.=self::getSubFamilies(0,$arr[$i]['category_id'],0);

            	 	/*$output.=self::getCountSubFamilies($arr[$i]['category_id']);	*/			

		}
              $output.='</ul></div>';
		return $output;
		return $output;


	}
	/**
	 * Function generates an drop down list for the sub category  
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level,$id,$k) {
	
		$level++;
		
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id.""; 
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0 ) {
			
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies )) {
				$k=$k+10;
				$categoryname=self::getSubFamiliesPath($rowSubFamilies['subcat_path']);
				
				 $sluggable = trim($rowSubFamilies['category_alias']);	
			
				if($rowSubFamilies['category_id'])
				$output.='<ul class="innermenu">
				<li ><a href="'.$_SESSION['base_url'].'/'.$categoryname.'.html"> '.$rowSubFamilies['category_name'].'</a>';
				
				$output.=self::getSubFamilies($level, $rowSubFamilies['category_id'],$k);

				$output.='</li></ul>';
				}
		
				
		}
		
		return $output;
	} 

	/**
	 * Function gets the sub category name
	 * 
	 * 
	 * @return array
	 */
	function getSubFamiliesPath($cat)
	{
		$cat=explode(',',$cat);
		for($m=0;$m<count($cat);$m++)
		{
			$sql = "SELECT * from category_table WHERE  category_id = ".$cat[$m].""; 
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			
			$sluggable = trim($obj->records[0]['category_alias']);	
				
			if($m<(count($cat)-1))
			{
				$catname.=$sluggable. '/';
			}
			else
			{
				$catname.=$sluggable;
			}

		}
		return $catname;
	}
	
	/**
	 * Function gets the sub category count and generate the ul,li tag
	 * 
	 * 
	 * @return html
	 */
	function getCountSubFamilies($id)
	{
	
		$sql ="SELECT *  FROM  category_table WHERE FIND_IN_SET( ".$id.",subcat_path)"; 
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$total=count($obj->records);
		

		for($k=0;$k<=$total;$k++)
		{
			if($k<$total)
			{
				$output.='</li> </ul>';
			}
			elseif($k=$total)
			{
				$output.='</li>';
			}

		}
		return $output;
		
	}
	/**
	* This function is used to get the pop up  of image of product 
 	* @param array $arr
	* @param string $rating
 	* @return string
	*/
	function showPopupProducts($arr,$rating)
	{
		
		 $output='
			<button class="close" data-dismiss="modal" data-target="#myModal">×</button>
			<div class="container">
			<h2><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[0]['product_id'].'" target="_parent">'.$arr[0]['title'].'</h2></a>';
				$output.='<div>&nbsp;</div>
			<div class="row-fluid">
			
			<div class="span6"  style="width: 30%;">
			<img src="'.$_SESSION['base_url'].'/'.$arr[0]['image'].'"  title="'.$arr[0]['title'].'" ></div>';
			
			
				$output.='<div class="span6">
				<div class="gallery_detail" style="width: 85%;">
				
				<ul class="detaillist">';
				if($arr[0]['product_status']==1)
				{
				$output.='<div class="ribbion_newtag_div"></div>';
				}
				elseif($arr[0]['product_status']==2)
				{
				$output.='<div class="ribbion_saletag_div"></div>';
				}
				$output.='<li>'.$rating.'</li>
				<li><table width="100%" border="0">

		
		<tr>
		<td align="left" valign="top">';
		if($arr[0]['soh']>0)
		{
			$output.='<span>'.Core_CLanguage::_(AVALABILITY).': '.Core_CLanguage::_(IN_STOCK).'</span>';
		}
		else
		{
			$output.='<span>'.Core_CLanguage::_(AVALABILITY).' :  '.Core_CLanguage::_(OUT_OF_STOCK).'</span>';
		}

		$output.='</td>
		<td align="left" valign="top"><h1>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[0]['msrp'].'</h1></td>
		</tr>
		</table></li>
		<li><h2>'.Core_CLanguage::_(QUICK_OVERVIEW).'</h2><p>This midi dress has been made from stretch jersey. The details include: a scoop neckline and sleeveless styling with an open back and latticed deatiling. The dress has been cut with a bodycon fit.</p></li>
		<li><form method="post"	action="'.$_SESSION['base_url'].'/index.php?do=addtocartfromproductdetail&prodid='.$arr[0]['product_id'].'" name="frmcart" target="_parent">
		<table width="100%" border="0">
		<tr>
		<td align="left" valign="top"> '.Core_CLanguage::_(QUANTITY).' ';
		$output.='<select name="qty[]" style="width:60px;">';
		if($arr[0]['soh']==0)
			$output.='<option value="0">0</option>';
		
		for($s=1;$s<=$arr[0]['soh'];$s++)
			$output.='<option value="'.$s.'">'.$s.'</option>';
		$output.='</select></td>';
		
		$output.='<td align="left" valign="top"><button type="submit" class="add_btn" title="'.Core_CLanguage::_('ADD_TO_CART').'"><p style="margin-left:38px;top:5px">'.Core_CLanguage::_('ADD_TO_CART').'</p></button></td>';
		
		$output.='</tr>
		</table>
		</form>
		</li>
		</ul>
		</div>
		</div>
		
		</div>
		<div class="clear"></div>
		</div>';

		return $output;

		 

	return $output;

	}
	
}	
?>
