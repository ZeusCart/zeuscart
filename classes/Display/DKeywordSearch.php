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
 * Keyword search related  class
 *
 * @package   		Display_DKeywordSearch
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DKeywordSearch
{
 	
 	/**
	* This function is used to Display the Searched Result
	* @param mixed $result
	* @param int $mode	
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @return string
 	*/
	function displaySearch($result,$mode,$paging,$prev,$next)
	{



		if($_GET['action']=='')	
		{

			$output='<ul class="productlists">';
	
			$i=0;
			if((count($result)>0))
			{
				
				for($i=0;$i<count($result);$i++)
				{
					$row=$result[$i];
					$product_id=$row['product_id'];
					$sku=$row['sku'];
					$title=$row['title'];
					if(strlen($title)>25)
					{
						$title=substr($title,0,25)."..";
					}
					$description=$row['description'];
					$brand=$row['brand'];
					if(strlen($brand)>15)
					{
						$brand=substr($brand,0,15)."..";
					}
					$msrp=trim($row['msrp']);
					$weight=$row['weight'];
					$dimension=$row['dimension'];
					
					$thumb_image=$row['thumb_image'];
					if(!file_exists($thumb_image))
						$thumb_image=''.$_SESSION['base_url'].'/images/noimage1.jpg';
					$image=$row['image'];
					if(!file_exists($image))
						$image=''.$_SESSION['base_url'].'/images/noimage1.jpg';
					$shipping_cost=$row['shipping_cost'];
					$status=$row['status'];
					$tag=$row['tag'];
					$pat="".$_SESSION['base_url']."/images/products/";
					$rcount=$row['rcount'];
					
					$rating=ceil($row['rating']);
					$ratepath='';
					for($r1=0;$r1<5;$r1++)
					{
						if($r1<$rating)
							$ratepath.='<img src="'.$_SESSION['base_url'].'/assets/img/star.png">&nbsp;';
						else
							$ratepath.='<img src="'.$_SESSION['base_url'].'/assets/img/star-gray.png">&nbsp;';							
					}		
					$output.='<li><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$row['product_id'].'">
		
					<div id="listproduct">
					<div class="ribbion_div">';
					if($result[$i]['product_status']==1)
					{
						$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new">';
					}
					elseif($result[$i]['product_status']==2)
					{
						$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale">';
					}
					elseif($result[$i]['product_status']==0)
					{	
						$imagetag='';
					}

					$output.=''.$imagetag.'</div>
					<div class="productimg"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$row['product_id'].'"><img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$row['large_image_path'].'&h=150&w=150&zc=0&s=1&f=4,11&q=100&ct=1" alt="'.$row['title'].'"> </a>
					
					</div>
						<div class="description_div"><h3><a href="#">'.$title.'</a></h3>
					<p> Reviews ('.$rcount.')<br/>
				  	'.$ratepath.'</p>
					</div>
					<div class="dollar_div">
						<h2>'.$msrp.'</h2><input type="hidden" name="addtocart">';

						$sql="SELECT * FROM product_inventory_table WHERE product_id='".$row['product_id']."'";
						$obj=new Bin_Query();
						$obj->executeQuery($sql);
						$recordssoh=$obj->records;
						if($recordssoh[0]['soh']>0)
						{
						$output.='<button class="add_btn" type="submit" ></button>';
						}
					
					$output.='</div>
					<div class="clear"></div>
					</div>
					</form></li>';
				}
                	}
	
             		 $output.=' </ul>';
			
		}
		elseif($_GET['action']=='grid')
		{
			$output='<div class="selecter">
				<div class="selecterContent">
				<ul class="nolist">';

				
			$i=0;
			if((count($result)>0))
			{
				
				for($i=0;$i<count($result);$i++)
				{
					$row=$result[$i];
					$product_id=$row['product_id'];
					$sku=$row['sku'];
					$title=$row['title'];
					if(strlen($title)>25)
					{
						$title=substr($title,0,25)."..";
					}
					$description=$row['description'];
					$brand=$row['brand'];
					if(strlen($brand)>15)
					{
						$brand=substr($brand,0,15)."..";
					}
					$msrp=trim($row['msrp']);
					$weight=$row['weight'];
					$dimension=$row['dimension'];
					
					$thumb_image=$row['thumb_image'];
					if(!file_exists($thumb_image))
						$thumb_image='images/noimage1.jpg';
					$image=$row['image'];
					if(!file_exists($image))
						$image='images/noimage1.jpg';
					$shipping_cost=$row['shipping_cost'];
					$status=$row['status'];
					$tag=$row['tag'];
					$pat="images/products/";
					$rcount=$row['rcount'];
					
					$rating=ceil($row['rating']);
					$ratepath='';
					for($r1=0;$r1<5;$r1++)
					{
						if($r1<$rating)
							$ratepath.='<img src="assets/img/star.png">';
						else
							$ratepath.='<img src="assets/img/star-gray.png">';							
					}	
					$output.='
					<li class="bags"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$row['product_id'].'">
					
					<div class="ribbion_div">';

					if($row['product_status']==1)
					{
						$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new">';
					}
					elseif($row['product_status']==2)
					{
						$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale">';
					}
					elseif($row['product_status']==0)
					{	
						$imagetag='';
					}


					$output.=''.$imagetag.'</div>
					<div class="galleryImage"><img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$row['image'].'&a=r&h=280&amp;w=235&zc=0&s=1&f=4,11&q=100&ct=1&a=tl" alt="'.$row['title'].'"> 
					<div class="info">  
					<h2>'.$title.'</h2>
					<p>
					 Reviews ('.$rcount.')<br/>
				  	'.$ratepath.'
					</p>
					<h4>'.$msrp.'</h4>
					<input type="hidden" name="addtocart">';
	
					$sql="SELECT * FROM product_inventory_table WHERE product_id='".$row['product_id']."'";
					$obj=new Bin_Query();
					$obj->executeQuery($sql);
					$recordssoh=$obj->records;
					if($recordssoh[0]['soh']>0)
					{
						$output.='<button class="add_btn" type="submit" ></button>';
					}
					$output.='
					</div>
					</div>
					</form></li>';

				}

			}
					$output.='</ul>	
					</div>
					</div>';

		}

		$output.='<div class="pagination">
			<ul>';
			if($prev!='')
			{
				$output .='<li> '.$prev.' </li>';
			}
			for($i=1;$i<=count($paging);$i++)
			{
				$output .='<li>'.$paging[$i].'</li>';
			}
			if($next!='')
			{
				$output .='<li>'.$next.'</li>';
			}
				
			$output .='</ul>
			</div>';		 
			
			
			return $output;
	}
	
 	/**
	* This function is used to Display the Searched Item Count
	* @param mixed $result
	* @return string
 	*/
	function displayCountSearch($result)
	{
		    $output=$result.' '. Core_CLanguage::_('ITEMS_FOUND');
			return $output;
	}

 	/**
	* This function is used to Display the Paging Size
	* @return string
 	*/
	function displayPageSize()
	{
	   $psize=array(10,20,30,40);	   
	   $res="<select name='selpage' onchange='document.frmpage.submit();'>";
	   foreach($psize as $val)
			$res.= ($val==$_POST['selpage']) ?  "<option value='$val' selected='selected'>$val</option>" : 
					"<option value='$val'>$val</option>";
	   return $res.='</select>';
	}
	
 	/**
	* This function is used to Display the Sort by Mode(0-9,9-0,A-Z,Z-A)
	* @return string
 	*/
	function sortBy()
	{
		$sortby=array('Price 0-9', 'Price 9-0', 'Name A-Z' , 'Name Z-A');		
	    $res='<select name="selsort" onchange="document.frmpage.submit()">';
		for($i=0;$i<4;$i++)
			$res.= ($_POST['selsort']==$i) ?  "<option value='$i' selected='selected'>$sortby[$i]</option>" : 
					"<option value='$i'>$sortby[$i]</option>";		
	   return $res.'</select>';
	}
	
	
 	/**
	* This function is used to Display the Searched Result Caption
	* @param mixed $search
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
	* This function is used to Display the Searched Result session
	* @param mixed $search
	* @return string
 	*/
	function searchSession($search)
	{
	   return $search;
	}
	
 	/**
	* This function is used to Display the Mode of Display(Grid,List)
	* @return string
 	*/
	function linkMode()
	{
         
		 $output='<input type="hidden" name="viewMode" /><td width="72" class="ad_text">View as  :</td>
      <td width="19" class="ad_text"><img src="css/default/images/list_view.jpg" width="12" height="13" /></td>
      <td width="45" class="ad_text"><a href="#" onclick="document.frmpage.viewMode.value=\'list\'; document.frmpage.submit();">List</a></td>
      <td width="18" class="ad_text"><img src="css/default/images/gal_view.jpg" width="12" height="13" /></td>
      <td width="50" class="ad_text"><a href="#" onclick="document.frmpage.viewMode.value=\'grid\'; document.frmpage.submit();">Gallery</a></td>';
		 return $output;
		 
	}
	
 	/**
	* This function is used to Display the Price Range
	* @return string
 	*/
	function priceRange()
	{
		 $output='<form name="pricerange" action="'.$_SESSION['base_url'].'/index.php?do=search&action=pricerange" method="post">
	<table cellpadding="0" cellspacing="0"  border="0" width="100%">
	<tr>
	<td colspan="4"><ul>
	<span> Price Range </span>
	</ul></td>
	</tr>
	<tr>
	<td style="padding-left:5px;padding-top:10px"><input type="text" name="txtminmsrp" size="5"></td>
	<td style="padding-top:10px" align="left"><ul>To</ul></td>
	<td style="padding-top:10px"><input type="text" size="5" name="txtmaxmsrp"></td>
	<td style="padding-top:10px;" align=center><input type="submit" class="gobutton" name="pricerange" value="Go" onclick="checkTextBox();" style="cursor:pointer" /></td></tr> 
	<tr><td style="padding-bottom:10px" colspan=4></td></tr>
	</table>
	</form>
	<script>function checkTextBox(){var minval=document.getElementById(\'txtminmsrp\'); var maxval=document.getElementById(\'txtmaxmsrp\'); if(minval>maxval) alert(\'The values are not correct\');}</script>';
		 return $output;
		 
	}
	
	
 	/**
	* This function is used to Display the Brand with Count in Searched Page
	* @param mixed $result
	* @param int $id	
	* @return string
 	*/
	function dispBrandWithCount($result, $id)
	{
		if((count($result))>0)
		{
			$output='<ul><span>Brand</span>';
			foreach($result as $row)
			{
				$brand=$row['brand'];
				$cnt=(int)$row['cnt'];
					
				$output.='<li><input type="hidden" name="mycategory" value='.$id.' /><a href="'.$_SESSION['base_url'].'/index.php?do=search&action=narrowsearch&brand='.$brand.'&category='.$id.'">';
				if($brand=='') $brand="UnBranded Items";
				$output.=$brand;
				$output.='('.$cnt.')</a></li>';
			}
			$outpu.='</ul>';
		}
		return $output;
	}
	
 	/**
	* This function is used to Display the Brand if it is unavailable
	* @param mixed $result
	* @return string
 	*/
	function dispBrandWithCountElsePart($result)
	{
	    
	    if((count($result))>0)
		{
		     $output='<table cellpadding="3" cellspacing="0" border="0" width="100%">';
			 
			 foreach($result as $row)
			 {
			    $brand=$row['brand'];
				$cnt=(int)$row['cnt'];
				if($cnt>0)				  
			     $output.='<tr><td><a href="'.$_SESSION['base_url'].'/index.php?do=search&action=narrowsearch&brand='.$brand.'">'.$brand.'('.$cnt.')</a></td></tr>';
			 }
			 $output.='</table>';
			 return $output;
		}	
	}

 	/**
	* This function is used to Display the Featured List
	* @param mixed $head
	* @param int $cnt	
	* @param mixed $att
	* @param int $id
	* @return string
 	*/
	function featureList($head,$cnt,$att,$id)
	{
	 
		$output="<table cellpadding='0' cellspacing='0' border=1'>";
		for($i=0;$i<=count($head);$i++)
		{
	      $arr=$_SESSION['arr']	;
		  if($arr['head']!=$head[$i])
		  {
			   $output.="<tr><td><span class='All_text_head'>".$head[$i]."</span></td></tr>";
			   for($j=0;$j<=count($att);$j++)
			   {
				   $output.="<tr><td class='All_text'><input type='hidden' value=".$id." name='mycategory' /><a href='".$_SESSION['base_url']."/index.php?do=search&action=extendedsearch&attrib_value_id=".$att[$i][$j]."&head=".$head[$i]."&category=".$id."'>".$cnt[$i][$j]."</a><input type='hidden' name='attribute_id' value='".$att[$i][$j]."'/></td></tr>";			   		   
			   }
		   }
		}	  
		$output.="</table>";
     		return $output;

	}

 	/**
	* This function is used to Display the Narrow Searched Result
	* @param mixed $result
	* @param int $mode	
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @return string
 	*/
	function narrowSearch($result,$mode,$paging,$prev,$next)
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
		
	
	
	$i=0;
	if((count($result)>0))
	{
	$output="<table cellpadding='0' cellspacing='2' border='0' width='100%'>";
			$output.='<tr><td align="right" class="content_list_footer">';
			$output.=''.' '.$prev.' ';
			for($im=1;$im<=count($paging);$im++)
			$pagingvalues1 .= $paging[$im]."  ";
			$output .= $pagingvalues1.' '.$next.'';
			$output.='</td></tr>';
			
			foreach($result  as $row)
			{
						$product_id=$row['product_id'];
						$sku=$row['sku'];
						$title=$row['title'];
						if(strlen($title)>25)
						{
						   $title=substr($title,0,25)."..";
						}
						$description=$row['description'];
						$brand=$row['brand'];
						if(strlen($brand)>15)
						{
						   $brand=substr($brand,0,15)."..";
						}
						$msrp=$row['msrp'];
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						
						$thumb_image=$row['thumb_image'];
						if(!file_exists($thumb_image))
						   $thumb_image='images/noimage1.jpg';
						$image=$row['image'];
						if(!file_exists($image))
						   $image='images/noimage1.jpg';
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						$rcount=$row['rcount'];
						
						$rating=ceil($row['rating']);
						$ratepath='';
						for($r1=0;$r1<5;$r1++)
						{
							if($r1<$rating)
								$ratepath.='<img src="images/starf.png">';
							else
								$ratepath.='<img src="images/stare.png">';							
						}

						
						$output='';
						
						$output.='<TR><TD> <div class="linebg resultITEM" style="width:610px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td width="9%" style="padding-right:10px" valign="top"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'"><img src="'.$_SESSION['base_url'].'/'.$thumb_image.'" alt="'.addslashes($title).'" border=0 width=95 /></a></td>
					
					<td width="33%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
					<tr>
						<td align="left" scope="col"><a href="?do=prodetail&action=showprod&prodid='.$product_id.'">'.$title.'</a>
								<br>Reviews ('.$rcount.')<br/>
								'.$_SESSION['base_url'].'/'.$ratepath.'
								</td>
					</tr>
					</table>	  </td>
					
					<td width="40%" valign="top" style="color:maroon"><b>'.$msrp.'</b></td>
					
					<td width="20%"><div class="resultButton"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'">
						<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px" >
							<tr>
								<td align="right" class="button_left"></td>
								<td valign=top><input type="submit" value="Add to Cart" class="button" /></td>
								<td class="button_right" ></td>
							</tr>
							</table></a><!--<br />-->
				<a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewWishList&id='.$product_id.'">
					<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px" >
							<tr>
								<td align="right" class="button_left"></td>
								<td valign=top><input type="submit" value="Add to Wishlist" class="button" ></td>
								<td class="button_right" ></td>
							</tr>
							</table>
					</a><!--<br />-->
				<a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">
					<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px" >
							<tr>
								<td align="right" class="button_left" ></td>
								<td valign=top><input type="submit" value="Add to Compare" class="button" /></td>
								<td class="button_right" ></td>
							</tr>
							</table>
					</a></div></td>
				
					</tr>
				</table>
					</div></td></tr>';
			}
			
			
			$output.='<tr><td align="right" class="content_list_footer">';
			$output.=''.' '.$prev.' ';
			for($im=1;$im<=count($paging);$im++)
			$pagingvalues .= $paging[$im]."  ";
			$output .= $pagingvalues.' '.$next.'';
			$output.='</td></tr></table>';
			
			}
			else
			{
				$output.='<div class="linebg resultITEM" style="width:610px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td width="9%" style="padding-right:10px" valign="top"><div class="exc_msgbox">No Records Found</div></td>
				
					</tr>
					</table>
					</div>';
				 
			}
			
			return $output;
	
			
	}
	/**
	* This function is used to store the session msrp
	*/
	function selectedSearchList()
	{
			$_SESSION['msrp']=$val;
	}
	
 	/**
	* This function is used to Display the Extended Searched Result
	* @param mixed $result
	* @param int $mode	
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @return string
 	*/
	 function extendedSearch($result,$mode,$paging,$prev,$next)
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
		
	$output="<table cellpadding='0' cellspacing='2' border='0' width='100%'><tr>";
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
						if(strlen($brand)>15)
						{
						   $brand=substr($brand,0,15)."..";
						}
						$msrp=$row['msrp'];
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						$thumb_image=$row['thumb_image'];
						if(!file_exists($thumb_image))
						   $thumb_image='images/noimage1.jpg';
						$image=$row['image'];
						if(!file_exists($image))
						   $image='images/noimage1.jpg';
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						$rcount=$row['rcount'];
						
						$rating=ceil($row['rating']);
						$ratepath='';
						for($r1=0;$r1<5;$r1++)
						{
							if($r1<$rating)
								$ratepath.='<img src="images/starf.png">';
							else
								$ratepath.='<img src="images/stare.png">';							
						}

						if($i!=3)
						{
						
						
							
							$output.='<td  id=product_tbbg><table width="95%" border="0" align="left" cellpadding="2" cellspacing="2"><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'" border="0"><img src="'.$thumb_image.'" width="90"  border="0"/></td></tr><tr><td class="text" align="left"><a href="?do=prodetail&action=showprod&prodid='.$product_id.'" border="0">'.$title.'<br />Brand : '.$brand.'<br />Model : '.$model.'</a></td></tr><tr><td align="left" class="rate_text">  '.$msrp.'</td></tr><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'"><img src="images/addtocart.jpg" border="0" /></a></td></tr><tr><td align="left" class="addtowishlist" ><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewWishList&id='.$product_id.'">Add to Wishlist</a> </td></tr><tr><td align="left" class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">Add to Compare</a></td></tr><tr><td align="left" class="addtocompare"><img src="css/themes/default/compareprice.jpg" /></td></tr></table><td>';
						}
						elseif($i==3)
						{
							
							$output.='</tr><tr><td><table width="95%" border="0" align="left" cellpadding="2" cellspacing="2"><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'" border="0"><img src="'.$thumb_image.'" width="90"  border="0"/></td></tr><tr><td class="text"><a href="?do=prodetail&action=showprod&prodid='.$product_id.'" border="0">'.$title.'<br />Brand : '.$brand.'<br />Model : '.$model.'</a></td></tr><tr><td align="left" class="rate_text">  '.$msrp.'</td></tr><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'"><img src="images/addtocart.jpg" border="0" /></a></td></tr><tr><td align="left" class="addtowishlist" style="padding-left:40px" ><a href="?do=wishlist&action=viewWishList&id='.$product_id.'">Add to Wishlist</a> </td></tr><tr><td align="left" class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">Add to Compare</a></td></tr><tr><td align="left" class="addtocompare"><img src="css/themes/default/compareprice.jpg" /></td></tr></table><td>';
						$i=0;
						}
	
						$i++;
			}
			$output.="</table>";
			$output.="<table cellpadding='3' cellspacing='0' border='0' width='100%'>";
			$output.='<tr><td align="right" class="content_list_footer" >'.' '.$prev.' ';
		    for($im=1;$im<=count($paging);$im++)
			$pagingvalues .= $paging[$im]."  ";
			$output .= $pagingvalues.' '.$next.'</td></tr></table>';
			
			}
			else
			{
				 $output='<div class="exe_msgbox">'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</div>';
			}
			return $output;
		}
		else  // if mode == 'list';
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
						if(strlen($title)>25)
						{
						   $title=substr($title,0,25)."..";
						}
						$description=$row['description'];
						$brand=$row['brand'];
						if(strlen($brand)>25)
						{
						   $brand=substr($brand,0,25)."..";
						}
						$msrp=$row['msrp'];
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						$thumb_image=$row['thumb_image'];
						if(!file_exists($thumb_image))
						   $thumb_image='images/noimage.jpg';
						$image=$row['image'];
						if(!file_exists($image))
						   $image='images/noimage.jpg';
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						$output.='<tr><td><table width="95%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="17%"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'" border="0"><img src="'.$thumb_image.'" width="90" border="0"/></td><td width="30%"><table width="95%" border="0"   style="padding-left:40px"  align="left" cellpadding="2" cellspacing="2"><tr><td class="text"><a href="#">'.$title.'<br /></a></td></tr><tr><td align="left" class="rate_text">  '.$msrp.'</td></tr><tr><td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'"><img src="images/addtocart.jpg" border="0" /></a></td></tr></table></td><td width="33%"><table width="95%" border="0" align="left" cellpadding="2" cellspacing="2"><tr><td class="text"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'" border="0">'.$title.'<br />Brand : '.$brand.' <br />Model : '.$model.'</a></td></tr></table></td><td width="20%" ><img src="css/themes/default/compareprice.jpg" />	</td></tr><tr><td></td><td class="addtowishlist" style="padding-left:40px" ><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewWishList&id='.$product_id.'">Add to Wishlist</a></td><td class="addtocompare"><a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">Add to Compare</a></td><td></td></tr></table></td></tr> <tr><td class="line"></td></tr>';
		}
			$output.="</table>";
			$output.="<table cellpadding='3' cellspacing='0' border='0' width='100%'>";
			$output.='<tr align="center"><td   class="content_list_footer" >'.' '.$prev.' ';
		    	for($im=1;$im<=count($paging);$im++)
			$pagingvalues .= $paging[$im]."  ";
			$output .= $pagingvalues.' '.$next.'</td></tr></table>'	;	
			}
			else
			{
				 $output='<div class="exc_msgbox">'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</div>';
			}
			return $output;    
		}
			
	}
	
 	/**
	* This function is used to Display the Searched Result within Price Range
	* @param mixed $result
	* @param int $mode	
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @return string
 	*/
	 function priceRangeSearch($result,$mode,$paging,$prev,$next)
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
		//if($mode=='grid')
		//{
		

	$i=0;
	if((count($result)>0))
	{
			$output="<table cellpadding='0' cellspacing='2' border='0' width='100%'>";
			$output.='<tr><td class="content_list_footer" align=right>';
			$output.=''.' '.$prev.' ';
			for($im=1;$im<=count($paging);$im++)
			$pagingvalues1 .= $paging[$im]."  ";
			$output .= $pagingvalues1.' '.$next.'';
			$output.='</td></tr>';
			
			$i=0;
			foreach($result  as $row)
			{
						$i++;
						$product_id=$row['product_id'];
						$sku=$row['sku'];
						$title=$row['title'];
						if(strlen($title)>25)
						{
						   $title=substr($title,0,25)."..";
						}
						$description=$row['description'];
						$brand=$row['brand'];
						if(strlen($brand)>15)
						{
						   $brand=substr($brand,0,15)."..";
						}
						$msrp=$row['msrp'];
						$weight=$row['weight'];
						$dimension=$row['dimension'];
						
						$thumb_image=$row['thumb_image'];
						if(!file_exists($thumb_image))
						   $thumb_image='images/noimage1.jpg';
						$image=$row['image'];
						if(!file_exists($image))
						   $image='images/noimage1.jpg';
						$shipping_cost=$row['shipping_cost'];
						$status=$row['status'];
						$tag=$row['tag'];
						$pat="images/products/";
						$rcount=$row['rcount'];
						
						$rating=ceil($row['rating']);
						$ratepath='';
						for($r1=0;$r1<5;$r1++)
						{
							if($r1<$rating)
								$ratepath.='<img src="images/starf.png">';
							else
								$ratepath.='<img src="images/stare.png">';							
						}
						
						$output.='';
						$line='';
						if($i<=9)
							$line='linebg';
						$output.='<tr><td> <div class="'.$line.' resultITEM" style="width:610px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="9%" style="padding-right:10px" valign="top"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$product_id.'"><img src="'.$_SESSION['base_url'].'/'.$thumb_image.'" alt="'.addslashes($title).'"  border=0 width=95 hwight=60 /></a></td>
	  
          <td width="33%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="resultDETAILS">
              <tr>
                  <td align="left" scope="col"><a href="?do=prodetail&action=showprod&prodid='.$product_id.'">'.$title.'</a>
				 <br/> Reviews ('.$rcount.')<br/>
				 '.$_SESSION['base_url'].'/'.$ratepath.'
				  </td>
              </tr>
          </table>	  </td>
          
	  <td width="40%" valign="top" style="color:maroon"><b>'.$msrp.'</b></td>
	  
          <td width="20%"><div class="resultButton"><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$product_id.'">
		  <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px" >
			  <tr>
				<td align="right" class="button_left"></td>
				<td valign=top><input type="submit" value="Add to Cart" class="button" /></td>
				<td class="button_right" ></td>
			  </tr>
			</table>
		  </a><!--<br />-->
      <a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewWishList&id='.$product_id.'" >
	  <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px"  >
		  <tr>
			<td align="right" class="button_left"></td>
			<td valign=top><input type="submit" value="Add to Wishlist" class="button" /></td>
			<td class="button_right"></td>
		  </tr>
		</table>
	  </a><!--<br />-->
      <a href="'.$_SESSION['base_url'].'/index.php?do=compareproduct&action=addtocompareproduct&prodid='.$product_id.'">
	  <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px"  >
		  <tr>
			<td align="right" class="button_left"></td>
			<td valign=top><input type="submit" value="Add to Compare" class="button" /></td>
			<td class="button_right"></td>
		  </tr>
		</table>
	  </a></div></td>
      
        </tr>
      </table>
	</div></td></tr>';
			}
			 
			
			$output.='<tr><td class="content_list_footer" align=right>';
			$output.=''.' '.$prev.' ';
			for($im=1;$im<=count($paging);$im++)
			$pagingvalues .= $paging[$im]."  ";
			$output .= $pagingvalues.' '.$next.'';
			$output.='</td></tr></table>';
			
			}
			else
			{
				$output.='<div class="linebg resultITEM" style="width:610px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="9%" style="padding-right:10px" valign="top"><div class="exc_msgbox">No Records Found</div></td>
      
        </tr>
      </table>
	</div>';
				 
			}
			
			return $output;
	 
			
	}
	
 	/**
	* This function is used to Clear all Search Session
 	*/
	function removeAllSearchSession()
	{
	  session_destroy();	   
	}
	
 	/**
	* This function is used to Display the Narrow Searched Result with Session
	* @return string
 	*/
	function narrowSearchSession()
	{
	     $r=$_GET['head'];
         $result=$_SESSION['arr'];
		$tot=array_count_values($result);
		 $brand=$_GET['brand'];
		
		 if(count($result)>0)
		 {
			  $output="<table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td colspan='2' width='100%'> Narrow Search</td></tr>";
			
			 $i=0;
		      foreach($result as $row)
			  {
			      $head=$row['head'];
				  $val=$row['val'];
				  
				  $output.="<tr><td>".$head." ".$val."</td><td><a href='".$_SESSION['base_url']."/index.php?do=search&action=removesession&removesession=".$i."'>[Remove]</a></td></tr>";
				  $i++;

			  }
			  
			  $output.="<tr><td><a href='#' onclick=' '>Delete All</a></td></tr>";
			  if(count($brand)>0)
			 	 $output.="<tr style='color:maroon'><td>".$brand."</td><td></td></tr>";
			  $output.="</table>";
			  return $output;
		 }
	}
	
 	/**
	* This function is used to Display the Main Category Dropdown
	* @param mixed $result
	* @return string
 	*/
	function categoryDropDown($result)
	{
	     $output='<span style="height:20px;"><select name="catsel" class="txtbox1 w2 TxtC1"><option value=-1>All Categories</option>';		
		 if((count($result))>0)
		{
              if(empty($_SESSION['category']))
			   $mmcat=$_POST['catsel'];
			  else
			   $mmcat=$_SESSION['category'];
		     foreach($result as $row)
			 {
			 
			   $categoryname=$row['category_name'];
			   $catid=$row['category_id'];
			  
			   $output.=($mmcat==$catid)?"<option value='$catid' selected='selected'>$categoryname</option>":"<option value='$catid'>$categoryname</option>";
			   //			   $output.='<option value='.$catid.'>'.$categoryname.'</option>';
			 }
				 
		}
		$output.='</select></span>';		
		return $output;
	
	}
	
 	/**
	* This function is used to Display the Sub Category Dropdown
	* @param mixed $result
	* @return string
 	*/
	function dispSubCategory($result)
	{
		$output='<form name="frmsubcatselection" method="post" action="'.$_SESSION['base_url'].'/index.php?do=search"><select name="subcatsel" onchange="document.frmsubcatselection.submit();"><option value="">Sub Category</option>';		
		 if((count($result))>0)
		{ 
		    if(empty($_SESSION['subcategory']))
			   $mmcat=$_POST['subcatsel'];
			  else
			   $mmcat=$_SESSION['subcategory'];
			   
			 if($_SESSION['category']==-1)
			    session_unregister('subcategory');
            		foreach($result as $row)
			 {
					   
			   $categoryname=$row['category_name'];
			   if(strlen($categoryname)>15)
			     $categoryname=substr($categoryname,0,15).'..';
			   $catid=$row['category_id'];
			   if(((int)$_SESSION['category'])>0)
			     $output.=($mmcat==$catid)?"<option value='$catid' selected='selected'>$categoryname</option>":"<option value='$catid'>$categoryname</option>";
			 
			 }
				 
		}
		$output.='</select></form>';		
		return $output;
	   
	}
	
 	/**
	* This function is used to Display the Selected Brand
	* @return string
 	*/
	function displaySelection()
	{
	  if($_SESSION['selectedbrand']!="")
	  {
	     $val=$_SESSION['selectedbrand'];
	      $output="<div>".$val."</div>";
	  }
	  return $output;
	}
}
?>
