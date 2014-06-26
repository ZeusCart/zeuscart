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
 * Featured items  related  class
 *
 * @package   		Display_DFeaturedItems
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DFeaturedItems
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();	
	/**
	 * Stores the output records in array format
	 *
	 * @var array 
	 */	
	var $arr = array();
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $arr1 = array();

 	/**
	* This function is used to Display the Landing Content of Main Category
	* 
	* @param mixed $arr
	* @return string
 	*/
	function landContent($arr)
	{ 
		$output='';
		if($arr[0]['html_content']!='')
			$output='<div id="product_tbbg" style="padding:2px;border: 1px solid rgb(201, 73, 51); margin-top: 14px;">'.$arr[0]['html_content'].'</div>';
		return $output;
	}

 	/**
	* This function is used to Display the Landing Content of Sub Category
	* @param mixed $arr
	* @return string
 	*/
	function showMainCatLanding($arr)
	{
		$output='<div class="quickview_border" style="margin-top:14px;">
		<div class="heading1"><span class="headingTXT">Sub Categories</span></div>
		<div style="padding:15px 0 5px 0">
   			<table width="100%" border="0" cellpadding="2" cellspacing="2">';
		$loop=0;
		$cnt= count($arr);
		for($i=0;$i<$cnt;$i++)
		{
			if($loop==3)
			{
				$output.='</tr>';
				$loop=0;
			}		
			if($loop==0)
				$output.='<tr>';
			
			

			if(trim($arr[$i]['image'])!='')
			{
				$img=explode('/',$arr[$i]['image']);
				$thumb=''.$_SESSION['base_url'].'/uploadedimages/caticons/'.$img[2];
				$img=(file_exists($thumb)) ? '<img src="'.$thumb.'" width="'.THUMB_WIDTH.'"   border="0" />' :
					'<img src="'.$_SESSION['base_url'].'/images/noimage1.jpg" width="'.THUMB_WIDTH.'" border="0" />';
			}
			else
				$img='<img src="'.$_SESSION['base_url'].'/images/noimage1.jpg" width="'.THUMB_WIDTH.'" border="0" />';
			
			$output.='<td id="product_tbbg">
			<table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">
				<tr><td align="center">
						<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[$i]['subcatid'].'">'.$img.'</a>
				</td></tr>
				<tr><td  class="featureTXT">
					<div  align="center"><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[$i]['subcatid'].'" class=categoriesList>'.$arr[$i]['SubCategory'].'</a>
							</div>
				</td></tr>
			</table>';
			$loop++;
		}
		return $output.='</table></div></div>';	
	}

 	/**
	* This function is used to Display the Main Category
	* @param mixed $arr
	* @return string
 	*/
	function showMainCategory($arr)
	{
		
		$output='<br /><div class="head_text" id="head_text">Browse Categories</div><div id="product_tbbg" >
		<table width="100%" border="0" cellpadding="0" cellspacing="2">';
		$loop=0;
		$cnt= count($arr);
		
		for($i=0;$i<$cnt;$i++)
		{				
			if($loop==3)
			{
				$output.='</tr>';
				$loop=0;
			}		
			if($loop==0)
				$output.='<tr>';
				
			$temp=$arr[$i]['category_image'];
			$img=explode('/',$temp);	
				
				$output.='<td id="product_tbbg"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="2"><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">';
				$thumb=''.$_SESSION['base_url'].'/uploadedimages/caticons/'.$img[2];
				if(file_exists($thumb))
				{
					$output.='<img src="'.$thumb.'"   border="0" />';
				}
				else
				{
					$output.=" <img border='0' width='95'  src='".$_SESSION['base_url']."/images/noimage1.jpg' />";
				}	
				$output.='</a></td></tr>
                <tr><td class="text" align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></td></tr></table></td>';

			$loop++;			
		}
		
		return $output.='</table></div>';	
	}
	
	

 	/**
	* This function is used to Display the Sub Category
	* @param mixed $arr
	* @return string
 	*/
	function showSubCategory($arr)
	{
		$output ='<div id="9" class="anylinkcss" style="width: 160px; background-color: #f7f7f5">';
		$cnt=count($arr);
		for($i=0;$i<$cnt;$i++)
			$output .='<a href="#">'.$arr[$i]['SubCategory'].'</a>';
		$output.='</div>';
		return $output;
	}
	
 	/**
	* This function is used to Display the Featured Product
	* @param mixed $arr
	* @param integer $flag
	* @param array $r
	* @return string
 	*/
	function showFeaturedItems($arr,$flag,$r)
	{

		$output='<div class="image_grid portfolio_4col">
		<div id="horz_scroll_id">';

		$output.='<div class="scroller_div">
       		 <div class="row-fluid">';

		if((count($arr)>0))
		{
			for($i=0;$i<count($arr);$i++)
			{
				if( $i!=0 && $i%4==0 )
				{

					$output.='</div></div><div class="scroller_div"><div class="row-fluid">';
				}
				if($i%4==0 && $i!=0 )
				{

					$output.=' </div> <div class="row-fluid">';
				}

				if($arr[$i]['product_status']==1)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/images/img/ribbion/new.png" alt="new">';
				}
				elseif($arr[$i]['product_status']==2)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/images/img/ribbion/sale.png" alt="sale">';
				}
				elseif($arr[$i]['product_status']==0)
				{	
					$imagetag='';
				}

					//get prduct detals sef url
				$comma_separated=Display_DNewProducts::getProductSefUrl($arr[$i]['category_id'],$arr[$i]['alias']);	
			
			
				if(trim($arr[$i]['has_variation'])=='1')
					{
						 $get_lowest_price=Display_DNewProducts::getLowestvariationPrice($arr[$i]['product_id']);


						$msrp=$get_lowest_price[0];
					}	
					else
					{

						$msrp=$arr[$i]['msrp'];
					}

			
		
        			$output.='<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'" /><div class="view view-first">
				<img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$arr[$i]['image'].'&h=250&w=250&zc=1&s=1&f=4,9&q=100" alt="'.$arr[$i]['title'].'">
				<div class="mask">
				<h2>'.substr(trim($arr[$i]['title']),'0','10').'<br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				<p><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'" class="list_icn"></a> <a  data-toggle="modal" href="#uploadReferenceDocuments" data-id="'.$arr[$i]['product_id'].'" class="search_icn"></a></p>';
				
			if($arr[$i]['has_variation']==1)
				   {

                  		 $output.='<div class="span6"><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'"><p style="padding-left:55px"><input type="button" value="Add to cart" class="info" /></p></a></div>';
                   }
                   else
                   {
                   	    $output.='<div class="span6"><p style="padding-left:55px"><input type="submit" value="Add to cart" class="info" /></p></div>';

                   } 	
				$output.='</div>
				</div><input type="hidden" name="addtocart" value="'.$arr[$i]['product_id'].'"></form></div>';
				
			}
			$output.='</div></div>';
		}
    


	  $output.='</div>
		</div>';	
		return $output;
	}

	/**
	* This function is used to Display the new Product
	* @param mixed $arr
	* @param integer $flag
	* @param array $r
	* @return string
 	*/
	function newArrivalProducts($arr,$flag,$r)
	{


		$output='<div class="image_grid portfolio_4col">
		<div id="new_product">';

		$output.='<div class="scroller_div">
       		 <div class="row-fluid">';

		if((count($arr)>0))
		{
			for($i=0;$i<count($arr);$i++)
			{
				if( $i!=0 && $i%4==0 )
				{

					$output.='</div></div><div class="scroller_div"><div class="row-fluid">';
				}
				if($i%4==0 && $i!=0 )
				{

					$output.=' </div> <div class="row-fluid">';
				}

				if($arr[$i]['product_status']==1)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/images/ribbion/new.png" alt="new">';
				}
				

				//get prduct detals sef url
				$comma_separated=Display_DNewProducts::getProductSefUrl($arr[$i]['category_id'],$arr[$i]['alias']);	
			
		
				if(trim($arr[$i]['has_variation'])=='1')
					{
						 $get_lowest_price=Display_DNewProducts::getLowestvariationPrice($arr[$i]['product_id']);


						$msrp=$get_lowest_price[0];
					}	
					else
					{

						$msrp=$arr[$i]['msrp'];
					}



        			$output.='<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'" /><div class="view view-first">
				<span class="ribbion_div">'.$imagetag.'</span>
				<img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$arr[$i]['image'].'&h=250&w=250&zc=1&s=1&f=4,9&q=100" alt="'.$arr[$i]['title'].'">
				<div class="mask">
				<h2>'.substr(trim($arr[$i]['title']),'0','10').'<br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				<p><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'" class="list_icn"></a> <a  data-toggle="modal" href="#uploadReferenceDocuments" data-id="'.$arr[$i]['product_id'].'" class="search_icn"></a></p>';
				
			
                    if($arr[$i]['has_variation']==1)
				   {

                  		 $output.='<div class="span6"><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'"><p style="padding-left:55px"><input type="button" value="Add to cart" class="info" /></p></a></div>';
                   }
                   else
                   {
                   	    $output.='<div class="span6"><p style="padding-left:55px"><input type="submit" value="Add to cart" class="info" /></p></div>';

                   } 
                   
				$output.='</div>
				</div><input type="hidden" name="addtocart" value="'.$arr[$i]['product_id'].'"></form></div>';
				
			}
			$output.='</div></div>';
		}
    


	  $output.='</div>
		</div>';	
		return $output;
	}
	
	/**
	* This function is used to Display the Featured Product Hidden Desktop
	* @param mixed $arr
	* @param integer $flag
	* @param array $r
	* @return string
 	*/
	function featuredProductsHidden($arr,$flag,$r)
	{

		$output='<div class="image_grid portfolio_4col">
		<div id="horz_scroll_id">';

		$output.='
       		 <div class="row-fluid">';

		if((count($arr)>0))
		{
			for($i=0;$i<count($arr);$i++)
			{
				
				if($i%4==0 )
				{

					$output.=' </div> <div class="row-fluid">';
				}

				if($arr[$i]['product_status']==1)
				{
					$imagetag='<div class="ribbion_new_div"></div>';
				}
				elseif($arr[$i]['product_status']==2)
				{
					$imagetag='<div class="ribbion_sale_div"></div>';
				}
				elseif($arr[$i]['product_status']==0)
				{	
					$imagetag='';
				}

				if(trim($arr[$i]['has_variation'])=='1')
					{
						 $get_lowest_price=Display_DNewProducts::getLowestvariationPrice($arr[$i]['product_id']);


						$msrp=$get_lowest_price[0];
					}	
					else
					{

						$msrp=$arr[$i]['msrp'];
					}

				//get prduct detals sef url
				$comma_separated=Display_DNewProducts::getProductSefUrl($arr[$i]['category_id'],$arr[$i]['alias']);	
		

		
        			$output.='<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'" /><div class="view view-first">
				<img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$arr[$i]['image'].'&h=800&w=800&zc=1&s=1&f=4,9&q=100" alt="'.$arr[$i]['title'].'">
				<div class="mask"><span class="visible-phone">
					<h2><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'">'.$arr[$i]['title'].'</a> <br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				</span>
				<span class="hidden-phone"><h2>'.substr(trim($arr[$i]['title']),'0','10').' <br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				<p><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'" class="list_icn"></a> <a  data-toggle="modal" href="#uploadReferenceDocuments" data-id="'.$arr[$i]['product_id'].'" class="search_icn"></a></p></span>';
			 if($arr[$i]['has_variation']==1)
				   {

                  		 $output.='<div class="cart-icn_div"><a href="'.$_SESSION['base_url'].'/index.php/'.$comma_separated.'"><input type="button" value="Add to cart" class="addcart" /></a></div>';
                   }
                   else
                   {
                   	    $output.='<div class="cart-icn_div"><input type="submit" value="Add to cart" class="btn" /></div>';

                   } 
				$output.='</div>
				</div><input type="hidden" name="addtocart" value="'.$arr[$i]['product_id'].'"></form></div>';
				
			}
			$output.='</div>';
		}
    


	  $output.='</div>
		</div>';
		
		return $output;


	}
	
 	/**
	* This function is used to When No Featured Product is available
	* @return string
 	*/
	function showFeaturedItemsElse()
	{
		 $output='<div><table width="100%" border="0" cellpadding="0" cellspacing="0">
		 <tr><td><div class="heading1"><span class="headingTXT">Our Featured Products</span></div></td></tr>
		 		<tr><td>&nbsp;</td></tr>
			 <tr><td width="32%" align=center><font color="orange"><b>No featured product found for this category</b></font></td></tr>
			   <tr><td>&nbsp;</td></tr></table></div>';
		return $output;
			 
	}
	
	
 	/**
	* This function is used to Display the Featured Product of Sub Category
	* @param mixed $arr
	* @param string $skin
	* @param integer $flag
	* @param array $r
	* @return string
 	*/
	function showSubCatFeaturedItems($arr,$skin,$flag,$r)
	{
		if($flag==0)
			$output ='<div class="head_text" id="head_text">Our Featured Products</div>
 			<div id="product_tbbg"><table width="100%" border="0" cellpadding="2" cellspacing="2">';
		else
			$output ='<div class="head_text" id="head_text">Products</div>
 			<div id="product_tbbg"><table width="100%" border="0" cellpadding="2" cellspacing="2">';
		
	
		$i=0;$j=0;
		if((count($arr)>0))
		{
		
			foreach($arr as $row)
			{	
				$product_id=$row['product_id'];
				$sku=$row['sku'];
				$title=$row['title'];
				$description=$row['description'];
				$brand=$row['brand'];
				$price=number_format($row['price'],2);
				$msrp=number_format($row['msrp'],2);
				$weight=$row['weight'];
				$dimension=$row['dimension'];
				$thumb_image=$row['thumb_image'];
				
				$image=$row['image'];
				$img=explode('/',$thumb_image);
				$shipping_cost=$row['shipping_cost'];
				$status=$row['status'];
				$tag=$row['tag'];
				$pat="".$_SESSION['base_url']."/images/products/";
				
				if($i==3)
				{
					$output.='</tr>';
					$i==0;
				}
				if($i==0)
					$output.='<tr>';
				$output.='<td  id="product_tbbg">
					<table width="95%" border="0" align="left" cellpadding="2" cellspacing="2"> 
				<tr>
				<td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'">';
				if(file_exists($thumb_image))
				{
				$output.='<img src="'.$_SESSION['base_url'].'/'.$thumb_image.'" width="90"   border="0" />';
				}
				else
				{
					$output.='<img border="0" width="90" src="'.$_SESSION['base_url'].'/images/noimage.jpg" />';
				} 
				$output.='</a></td>
				</tr>
				<tr>
				<td class="text"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'">'.$title.'</a></td>
				</tr>
				<tr>
			
				<td align="left" class="rate_text">'.$r[$j]['msrp'].'</td>
			
				
			
				</tr>
				<tr>
				<td align="left" class="addtocart"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'"><img src="'.$_SESSION['base_url'].'/images/addtocart.jpg" border="0"></a></td>
				</tr>
				<tr>
				<td align="left" class="addtowishlist"><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$product_id.'">Add to Wishlist</a>		  </td>
				</tr>
				<tr>
				<td align="left" class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">Add to Compare</a></td>
				</tr>';
				if($arr[0]['cse_enabled']==1)
				{
					$output.='<tr>
					<td class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=pricecompare&action=compareproductprice&keyword=450D">Compare Price</a></td></tr>';
				}
				$output.='<tr>
				<td class="addtocompare"></td>
				</tr></table></td>';
				$i++;
				$j++;
						
			}
		}
		else
		{
			$output='<div class="head_text" id="head_text">Products</div>
			<div id="product_tbbg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td class="product_tbbg1"><font color="orange"><b>No featured product found for this category</b></font></td></tr>';
		}
		$output.='</table></div>';
			
			return $output;
	}
	
 	/**
	* This function is used When No Featured Product of Sub Category is Available
	* @return string
 	*/
	function showSubCatFeaturedItemsElse()
	{
		 $output='<div class="head_text" id="head_text">Products</div>
 		<div id="product_tbbg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		 		<tr><td>&nbsp;</td></tr>
			 <tr><td class="product_tbbg1"><font color="orange"><b>No featured product found for this category</b></font></td></tr>
			   <tr><td>&nbsp;</td></tr></table></div>';
		return $output;
			 
	}
	
 	/**
	* This function is used to Display the Main Category Bread Crumb
	* @param mixed $arr
	* @return string
 	*/
	function maincatBreadCrumb($arr)
	{	
		return '<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              <tr>
                  <td align="left" scope="col"><a href="?do=indexpage">Home</a> <b>&gt;&gt;</b> '.$arr[0]['Category'].'</td></tr></table>';
	}
	
 	/**
	* This function is used to Display the Sub Category Bread Crumb
	* @param mixed $arr
	* @return string
 	*/
	function subcatBreadCrumb($arr)
	{	
		return  '
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              <tr>
                  <td align="left" scope="col"><a href="?do=indexpage">Home</a> <b>&gt;&gt;</b> <a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[0]['maincatid'].'">'.$arr[0]['Category'].'</a> <b>&gt;&gt;</b> '.$arr[0]['SubCategory'].'</td></tr></table>';
	}
	
 	/**
	* This function is used to Display the Best Selling Product
	* @param mixed $arr
	* @return string
 	*/
	function showBestSellingProducts($arr)
	{
		
		$output ='
		<div class="quickview_border" style="margin-top:14px;" >
		<div class="heading1"><span class="headingTXT">Best Selling Products</span></div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-left:10px;padding-top:10px;padding-bottom:10px;padding-right:10px;">';
		$i=0;
		if((count($arr)>0))
		{
			while($i<count($arr))
			{
				if(($i%2)==0)
					$output.='<tr>';
				
				$style[0]='background:url(images/bg_line1.gif) repeat-y right';
				$style[1]='';
				$style[2]='background:url(images/bg_line1.gif) repeat-y right';
								
			    $output.='<td  style="'.$style[1].'"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td width="43%" valign=top><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="'.(file_exists($arr[$i]['thumb_image']) ? $arr[$i]['thumb_image'] : 'images/noimage1.jpg').'" alt="'.addslashes($arr[$i]['title']).'" width="'.THUMB_WIDTH.'" border=0/></a></td>
				  <td width="57%" valign="top" class="bestsellingTXT"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.((strlen($arr[$i]['title'])>15) ? substr( $arr[$i]['title'],0,15).'...' : $arr[$i]['title']).'</a><br><br /><span class="featurePRICE">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($_SESSION['currencysetting']['selected_currency_settings']['conversion_rate']*$arr[$i]['msrp'],2).'</span>
					<br /><br>
					See all <span><!--<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a>-->
					<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></span></td>
				</tr>
				
				  </table></td>';
			  	
				if(($i%2)!=0 || empty($arr[$i+1]['product_id']))
				{
					if (empty($arr[$i+1]['product_id']))
						 $output.='<td>&nbsp;</td>';
				    $output.='</tr> ';
				}
				if ($i==1)
					$output.='<tr>
				<td colspan="2" class="dot_line">&nbsp;</td>
				</tr>';
				$i++;
			}
		}
		else
		{
			 $output='<tr><td><b>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</b></td></tr>';
		}
		$output.=' </table></div>';
		
		return $output;
	}
	
 	/**
	* This function is used to Display the Narrow Search Result
	* @param mixed $arr
	* @return string
 	*/
	function displayNarrow($arr)
	{
		
		if((count($arr))>0)
		{
			$id=(int)$_GET['subcatid'];
			$cnt=count($arr);
			for($i=0;$i<$cnt;$i++)
			{
				$val=count($arr[$i]);
				if(!array_key_exists($arr[$i][0]['attrib_name'],$_SESSION['search_option']))
				{
					$output.='<ul><span>'.$arr[$i][0]['attrib_name'].'</span>';
					for($j=0;$j<$val;$j++)
					{
					if($arr[$i][$j]['products_count'] > 0 ) 
						$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&type='.$arr[$i][0]['attrib_name'].'&val='.$arr[$i][$j]['attrib_value_id'].'">'.$arr[$i][$j]['attrib_value'].' ('.$arr[$i][$j]['products_count'].')</a></li>';
				}
					$output.='</ul>';
				}
			}
		
      		}
      		return $output;
	}
	
 	/**
	* This function is used to Display the Narrow Search Result by Price
	* @param mixed $arr
	* @param mixed @range
	* @return string
 	*/
	function displayPriceNarrow($arr,$range)
	{
			
			
		if((count($arr))>0)
		{
			$id=(int)$_GET['subcatid'];
			$cnt=count($arr);
			if(!array_key_exists("Price",$_SESSION['search_option']))
			{
				$output.='<ul><span>Price</span>';
				for($i=0;$i<$cnt;$i++)
				{
					$val=count($arr[$i]);
					for($j=0;$j<$val;$j++)
					{
						if($arr[$i][$j]['count'] > 0 )
						{
							$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&type=Price&val='.$arr[$i][$j]['msrp'].'&range='.$range[$i].'">'.$range[$i].' ('.$arr[$i][$j]['count'].')</a></li>';
						}
					}
				}
				$output.='</ul>';
			}
			
		
      		}
      		return $output;
	}
	
 	/**
	* This function is used to Display the Narrow Search Result by Brand
	* @param mixed $arr
	* @return string
 	*/
	function displayBrandNarrow($arr)
	{
		if((count($arr))>0)
		{
			$id=(int)$_GET['subcatid'];
			$cnt=count($arr);
			if(!array_key_exists("Brand",$_SESSION['search_option']))
			{
				$output.='<ul><span>Brand</span>';
				for($i=0;$i<$cnt;$i++)
				{
					if($arr[$i]['count'] > 0 )
					{
		 				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&type=Brand&val='.$arr[$i]['brand'].'">'.(($arr[$i]['brand'])!='' ? $arr[$i]['brand'] : 'Unbranded Items').' ('.$arr[$i]['count'].')</a></li>';
					}
				}
				$output.='</ul>';
			}
			
		
      		}
      		return $output;
	}
	
 	/**
	* This function is used to Display the Searched Product
	* @param mixed $arr
	* @return string
 	*/
	function viewProducts($arr)
	{
		
		$output='<div style="width:466px;">
			<div class="resultBOX" style="width:465px;">
			<div class="resultTOP">';
			
		$cnt=count($arr);
		$output.='<div class="resultTOPTXT">'.$cnt.' Item(s) Found</div></div>';
		if($cnt > 0)
		{
			for($i=0;$i<$cnt;$i++)
			{
				$imgPath=$arr[$i]['thumb_image']; 
				if(!file_exists($imgPath))
					$imgPath='images/noimage.jpg';

				$proDesc=$arr[$i]['description'];
				if(strlen($proDesc) > 20 )
					$proDesc=substr($proDesc,0,20).'...';					
				
			$class = ($i<$cnt-1) ? 'resultITEM linebg' : 'resultITEM';
			
			$output.='<div class="'.$class.'" style="width:455px;">					
			<table width="100%" border="0" cellspacing="2" cellpadding="0">
			<tr>
			<td class="resultIMG" width="13%"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/'.$imgPath.'" alt="'.addslashes($arr[$i]['title']).'" width="60"  border=0 title="'.addslashes($arr[$i]['title']).'" /></a>
				</td>
			<td valign="top" class="resultDETAILS" width="35%"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a><br />
			<span>'.$proDesc.'</span> 
			</td>
			<td  valign="top" class="resultPRICE" width="25%">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$i]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'
			</td>
			<td width="23%" valign=top> 
			<form name="addtocart" id="addtocart" action="?do=addtocart&prodid='.$arr[$i]['product_id'].'" method="post" >
			<table border="0" cellspacing="0" cellpadding="0" class="featureBUTTON" style="padding-top: 1px">		  
				<tr>
					<td align="right" class="button_left" style="padding-top:2px" ></td>
					<td valign=top><input type="submit" value="Add to Cart" class="button" /></td>
					<td class="button_right"></td>
				</tr>
				</table>
				</form>
			
			<form name="addtowishlist" id="addtowishlist" action="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr[$i]['product_id'].'" method="post">
			<table border="0" cellspacing="0" cellpadding="0" class="featureBUTTON">
					<tr>
						<td align="right" class="button_left" ></td>
						<td valign=top><input type="submit" value="Add to Wishlist" class="button" /></td>
						<td class="button_right" ></td>
					</tr>
					</table>
					</form>
			<form name="addtocompare" id="addtocompare" action="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$arr[$i]['product_id'].'" method="post" >
			<table border="0" cellspacing="0" cellpadding="0" class="featureBUTTON">
					<tr>
						<td align="right" class="button_left" ></td>
						<td valign=top><input type="submit" value="Add to Compare" class="button" /></td>
						<td class="button_right" ></td>
					</tr>
					</table>
					</form>
			</td>
			</tr>
			</table>
			</div>';
			
			}
			$output.='</div><div>
			<div class="pagination" style="line-height:20px;"><span class="disabled"><!--<img src="css/default/images/arrow1.gif" alt="arrow" /><span class="current">1</span></span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a>&#8230;<a href="#">199</a><a href="#">200</a><a href="#" style="margin-right:none; color:#a81f1f"><img src="css/default/images/arrow2.gif" alt="arrow" border="0" /></a>--></div>
			</div>
			</div>';
		}
		
		return $output;
	}
	
 	/**
	* This function is used to Display the Searched Criterias
	* @param mixed $arr
	* @param string $brand
	* @param integer $price		
	* @return string
 	*/
	function dispSearch($arr,$brand,$price)
	{
		$id=(int)$_GET['subcatid'];
		$cnt=count($arr);
		$output='<div class="resultTITLE borderBOT">Search Criteria :';
		if($brand!='')
		{
			$output.='<div class="resultTITLE ">Brand : <span>'.$brand.'</span>&nbsp;<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&rtype=Brand" ><img src="'.$_SESSION['base_url'].'/images/bullet.jpg" alt="Remove" border="0"></a></div>';
		}
		if($price!='')
		{
			$output.='<div class="resultTITLE "><!--Price :--> <span>'.$_SESSION['range'].'</span>&nbsp;<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&rtype=Price" ><img src="'.$_SESSION['base_url'].'/images/bullet.jpg" alt="Remove" border="0"></a></div>';
		}
		if($cnt > 0 )
		{
			for($i=0;$i<$cnt;$i++)
			{
				$output.='
				<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              			<tr>
                 		 <td align="left" scope="col">
				<div class="resultTITLE ">'.$arr[$i][0]['attrib_name'].' : <span>'.$arr[$i][0]['attrib_value'].'</span>&nbsp;<a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$id.'&rtype='.$arr[$i][0]['attrib_name'].'" ><img src="images/bullet.jpg" alt="Remove" border="0"></a></div></td></tr></table>';
			}
			
			
			
		}
		$output.='</div>';
		return $output;
	}
		
}
