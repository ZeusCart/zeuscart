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
 * This class contains functions to list out the search results.
 *
 * @package  		Display_DKeywordSearch
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DKeywordSearch
{
 	/**
	 * Function creates a template to display the search results. 
	 * @param array $result
	 * @param string $mode
	 * @return string
	 */
	function displaySearch($result,$mode)
	{
		$mode=$_POST['viewMode'];
		
		if(!empty($mode))
			$_SESSION['mode']=$mode;
		elseif(empty($_SESSION['mode']))
		{
		    $mode='grid';
		}
		else
		{
		   $mode='list';
		}
		if($mode=='grid')
		{
		
	$output="<table cellpadding='3' cellspacing='0' border='0' width='100%'><tr>";
	$i=0;
	if((count($result)>0))
	{
			foreach($result  as $row)
			{
						$product_id=$row['product_id'];
						$sku=$row['sku'];
						$title=$row['title'];
						$description=$row['description'];
						$brand=$row['brand'];
						$msrp=number_format($row['msrp'],2);
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						$thumb_image=$row['thumb_image'];
						$image=$row['image'];
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						//	$output .="<tr align='left'><td>$product_id</td><td>$sku </td><td>$title </td><td>$description </td><td>$brand </td><td> $msrp</td><td>$weight</td><td>$dimension </td><td>$thumb_image </td><td>$image </td><td>$shipping_cost </td><td>$status </td><td>$tag </td></tr>";
						if($i!=3)
						{
							//$output.="<td ><p><a href='?do=search&id=$product_id'><img src='$pat$image' height='135' width='135' alt=''/></a></p><h4><b><a href='?do=search&id=$product_id'>$title</a></h4></b>$msrp<br/><a href='?do=wishlist&id=$product_id'>Add to WishList</a><br/><a href='#'>Add To Compare</a><br/><input type='button' name='addtocart' value='Add To Cart' /></td>";
							$output.='<td><table width="95%" border="0"  cellpadding="2" cellspacing="2"><tr><td ><img src="'.$thumb_image.'" width="90" height="67" /></td></tr><tr><td class="text"><a href="#">'.$title.'<br />Brand : '.$brand.'<br />Model : '.$model.'</a></td></tr><tr><td  class="rate_text">MRP  '.$msrp.'</td></tr><tr><td ><img src="css/themes/default/addtocart.jpg" /></td></tr><tr><td  class="addtowishlist"><a href="#">Add to Wishlist</a> </td></tr><tr><td  class="addtocompare"><a href="#">Add to Compare</a></td></tr><tr><td  class="addtocompare"><img src="css/themes/default/compareprice.jpg" /></td></tr></table><td>';
						}
						elseif($i==3)
						{
							//$output.="</tr><tr><td ><p><a href='?do=search&id=$product_id'><img src='$pat$image' height='135' width='135' alt='' /></a></p><h4><b><a href='?do=search&id=$product_id'>$title</a></b></h4>$msrp<br/><a href='?do=wishlist&id=$product_id'>Add to WishList</a><br/><a href='#'>Add To Compare</a><br/><input type='button' name='addtocart' value='Add To Cart' /></td>";
							$output.='</tr><tr><td><table width="95%" border="0"  cellpadding="2" cellspacing="2"><tr><td ><img src="'.$thumb_image.'" width="90" height="67" /></td></tr><tr><td class="text"><a href="#">'.$title.'<br />Brand : '.$brand.'<br />Model : '.$model.'</a></td></tr><tr><td  class="rate_text">MRP  '.$msrp.'</td></tr><tr><td ><img src="css/themes/default/addtocart.jpg" /></td></tr><tr><td  class="addtowishlist"><a href="#">Add to Wishlist</a> </td></tr><tr><td  class="addtocompare"><a href="#">Add to Compare</a></td></tr><tr><td  class="addtocompare"><img src="css/themes/default/compareprice.jpg" /></td></tr></table><td>';
						$i=0;
						}
	
						$i++;
			}
			$output.="</table>";
			
			}
			else
			{
				 $output='No Records Found';
			}
			return $output;
		}
		else  // if mode == 'list';
		{
		       $output="<table cellpadding='3' cellspacing='0' border='0' width='100%' >";
	$i=0;
	if((count($result)>0))
	{
			foreach($result  as $row)
			{
						$product_id=$row['product_id'];
						$sku=$row['sku'];
						$title=$row['title'];
						$description=$row['description'];
						$brand=$row['brand'];
						$msrp=number_format($row['msrp'],2);
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						$thumb_image=$row['thumb_image'];
						$image=$row['image'];
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						//$output.="<tr><td ><p><a href='?do=search&id=$product_id'><img src='$pat$image' height='135' width='135' alt=''/></a></p></td><td><h4><b><a href='?do=search&id=$product_id'>$title</a></h4></b>$msrp<br/><a href='#'>Add to WishList</a><br/><a href='#'>Add To Compare</a><br/><input type='button' name='addtocart' value='Add To Cart' /></td><tr>";
						$output='<tr>
<td class="product_tbbg1">
		<table width="95%" border="1"  cellpadding="0" cellspacing="0"  class="product_tbbg1">
		<tr>
			<td width="17%"><img src="'.$thumb_image.'" width="90" height="67" /></td>
			<td width="30%">
				<table width="95%" border="1"  cellpadding="2" cellspacing="2">
				  <tr>
				     <td class="text"><a href="#">'.$title.'<br /></a></td>
				  </tr>
				  <tr>
				  <td  class="rate_text">MRP  '.$msrp.'</td>
				  </tr>
				  <tr>
				  <td ><img src="css/themes/default/addtocart.jpg" /></td>
				  </tr>
				</table>
			</td>
			<td width="33%">
				<table width="95%" border="1"  cellpadding="2" cellspacing="2">
				<tr>
				<td class="text"><a href="#">'.$title.'<br />Brand : '.$brand.' <br />Model : '.$model.'</a></td>
				</tr>
				</table>
			</td>
			<td width="20%">
				<img src="css/themes/default/compareprice.jpg" />	
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td class="addtowishlist"><a href="#">Add to Wishlist</a></td>
			<td class="addtocompare"><a href="#">Add to Compare</a></td>
			<td></td>
		</tr>
		</table>
			</td>
			</tr> 
			';
			}
			$output.="</table>";
			
			}
			else
			{
				 $output='No Product Found';
			}
			return $output;    
		}
			
	}
	
	/**
	 * Function returns the count of the search. 
	 * @param array   $result
	 * @return string
	 */
	
	function displayCountSearch($result)
	{
	   $res=$result[0]['count'];
	   if($res>0)
	   {
		    $output=$res.' Item(s) Found';
			return $output;
		}
	}
	
	/**
	 * Function returns the drop down list of the page sizes.  
	 * @return string
	 */

	function displayPageSize()
	{
	   $psize=array(10,20,30,40);	   
	   $res="<select name='selpage' onchange='document.frmSearch.submit();'>";
	   foreach($psize as $val)
			$res.= ($val==$_POST['selpage']) ?  "<option value='$val' selected='selected'>$val</option>" : 
					"<option value='$val'>$val</option>";
	   return $res.='</select>';
	}
	
	/**
	 * Function returns the drop down list of the sort by values.  
	 * @return string
	 */
	
	
	function sortBy()
	{
		$sortby=array('Price 0-9', 'Price 9-0', 'Name A-Z' , 'Name Z-A');		
	    $res='<select name="selsort" onchange="document.frmSearch.submit()">';
		for($i=0;$i<4;$i++)
			$res.= ($_POST['selsort']==$i) ?  "<option value='$i' selected='selected'>$sortby[$i]</option>" : 
					"<option value='$i'>$sortby[$i]</option>";		
	   return $res.'</select>';
	}
	
	
	/**
	 * Function returns the a search result string. 
	 * @param string $search
	 * @return string
	 */
	
   function searchResultFor($search)
	{
	   if($search!='')
	   {
		   $res="Search Result for <b>'$search'</b>";
		   return $res;
	   }
	}
	
	/**
	 * Function returns the a search of the result string. 
	 * @param string $search
	 * @return string
	 */	
	
	function searchSession($search)
	{
	   return $search;
	}
	
	/**
	 * Function returns the a pagination for the search result. 
	 * @param integer $result
	 * @param integer $limitstart
	 * @param integer $limitend
	 * @return string
	 */		
	
	function pagination($result,$limitstart,$limitend)
	{
	
	    $total_pages=$result;
		$max=$recperpage;
		for ($i = 1; $i <= $total_pages; $i++) 
		   {
					$output.="<input type='hidden' name='strec' value='".$limitstart."'/><input type='hidden' name='stend' value='".$limitend."'/><input type='hidden' name='page' value='".$i."'/><a href='#' onclick='document.frmSearch.submit();'>".$i."</a>  ";
		   }
		return $output;
	}
	
	/**
	 * Function returns the a view mode template for the search results. 	 
	 * @return string
	 */		
	 
	function linkMode()
	{
         //$output="<input type='hidden' name='viewMode' value='".$search."'/><a href='#' onclick=\"document.frmSearch.viewMode.value='grid'; document.frmSearch.submit();\">Grid</a> | <a href='#' onclick=\"document.frmSearch.viewMode.value='list'; document.frmSearch.submit();\">List</a>";
		 $output='<input type="hidden" name="viewMode" /><td width="72" class="ad_text">View as  :</td>
      <td width="19" class="ad_text"><img src="css/themes/default/list_view.jpg" width="12" height="13" /></td>
      <td width="45" class="ad_text"><a href="#" onclick="document.frmSearch.viewMode.value=\'list\'; document.frmSearch.submit();">List</a></td>
      <td width="18" class="ad_text"><img src="css/themes/default/gal_view.jpg" width="12" height="13" /></td>
      <td width="50" class="ad_text"><a href="#" onclick="document.frmSearch.viewMode.value=\'grid\'; document.frmSearch.submit();">Gallery</a></td>';
		 return $output;
		 
	}
	
	/**
	 * Function returns the a price range for the search result. 	
	 * @return string
	 */		
	
	function priceRange()
	{
	     $output='<form name="pricesrange" method="post"><table cellpadding="3" cellspacing="0"  border="0"><tr><td colspan="2">Price Range</td></tr><tr><td><input type="text" name="txtminmsrp" size="5"></td><td>to</td><td><input type="text" size="5" name="txtmaxmsrp"></td></td><tr><td colspan="2"><input type="submit" name="pricerange" value="submit"></td></tr></form>';
		 return $output;
		 
	}
	
	
	/**
	 * Function returns a template for brand with count. 	
	 * @param array $result
	 * @return string
	 */	
	
	function dispBrandWithCount($result)
	{
	    
	    if((count($result))>0)
		{
		
		     $output='<table cellpadding="3" cellspacing="0" border="0"><th>Brand</th>';
		     foreach($result as $row)
			 {
			    $brand=$row['brand'];
				$cnt=$row['cnt'];
				if($cnt==0 or $cnt=='')
				   $cnt=0;
			     $output.='<tr><td><a href="#">'.$brand.'('.$cnt.')</a></td></tr>';
			 }
			 $output.='</table>';
			 
		}
		return $output;
		
	}
	
	/**
	 * Function returns a template for feature list of products. 	
	 * @param array $head
	 * @param array $cnt
	 * @param array $att	 
	 * @return void
	 */	
	
	function featureList($head,$cnt,$att)
	{
		$output="<table cellpadding='0' cellspacing='0' border=0'>";
		for($i=0;$i<=count($head);$i++)
		{
		   $output.="<tr><td>".$head[$i]."</td></tr>";
		   for($j=0;$j<=count($att);$j++)
		   {
		       $output.="<tr><td>".$cnt[$j]."</td></tr>";			   
			   $output.="<tr><td>".$att[$j]."</td></tr>";			   
		   }
		}	  
     echo $output;
	 exit; 
	    
	  /* 
	    if((count($result))>0)
		{
		     $output='<table cellpadding="3" cellspacing="0" border="0"><th>Features</th>';			 
			 foreach($head as $h)
			 {
			     $attid=$h['attrib_id'];
				 $attname=$h['attrib_name'];
				 $output.='<tr><td><h3>'.$attname.'</h3></td></tr>';
			 	   foreach($result as $row)
					 {
					    $atid=$row['attrib_id'];
						$attribvalue=$row['attrib_value'];
						$attvalid=$row['attrib_value_id'];
//						if($attid==$atid)
						$cnt=$row['cnt'];
						if($cnt==0 or $cnt=='')
						   $cnt=0;
  /*                   	$output.='<tr><td><a href="#">'.$attribvalue;
                        foreach($valcou as $v)
						{
						   $atvalid=$v['attrib_value_id'];
						   if($attvalid==$atvalid)
						       $mo=$v['cnt'];   
						} 
	////					if($attid==$atid)
						$output.='<tr><td><a href="#">'.$attribvalue.' '.'( )</a></td></tr>';
//						 $output.="(".$mo.")";

						
					 }
			 }
			 $output.='</table>';			 
		}
		return $output;		
	*/}
	
	/**
	 * Function returns a dropdown list for all the categories available. 	
	 * @param array $result		 
	 * @return void
	 */	
	
	
	function categoryDropDown($result)
	{
	    if((count($result))>0)
		{
              $output='<select name="catsel"><option value=-1>All Categories</option>';		
		     foreach($result as $row)
			 {
			   $categoryname=$row['category_name'];
			   $catid=$row['category_id'];
			   $output.='<option value='.$catid.'>'.$categoryname.'</option>';
			 }
			 $output.='</select>';
			 
		}
		return $output;
	
	}
	
}
?>
