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
 * New products  related  class
 *
 * @package   		Display_DNewProducts
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DNewProducts
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	var $output = array();	
	
 	/**
	* This function is used to Display the New all Products
	* @param mixed $arr
	* @param int $r	
	* @return string
 	*/
	function newProducts($arr,$r)
	{

		if(count($arr)>0)
		{
			$output=' <div class="row-fluid">';
			for($i=0;$i<count($arr);$i++)
			{		
				if($i%4==0&& $i!=0)
				{
					$output.=' </div><div class="row-fluid">';

				}

				//category name
				$sql="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['category_id']."'";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);
				$cat=$obj->records[0]['category_name'];

				//sub category
				$sqlsub="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['sub_category_id']."'";
				$objsub=new Bin_Query();
				$objsub->executeQuery($sqlsub);
				$subcat=$objsub->records[0]['category_name'];

				//sub under  category
				$sqlsubun="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['sub_under_category_id']."'";
				$objsubun=new Bin_Query();
				$objsubun->executeQuery($sqlsubun);
				$subuncat=$objsubun->records[0]['category_name'];
				if($arr[$i]['product_status']==1)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new">';
				}
				elseif($arr[$i]['product_status']==2)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale">';
				}
				elseif($arr[$i]['product_status']==0)
				{	
					$imagetag='';
				}
				$output.='
				<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'"><div class="view view-first">
				<span class="ribbion_div">'.$imagetag.'</span>
				<img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$arr[$i]['image'].'&h=250&w=250&zc=1&s=1&f=4,9&q=500" alt="'.$arr[$i]['title'].'">
				<div class="mask"><span class="visible-phone">
					<h2><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a> <br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				</span><span class="hidden-phone">
					<h2>'.$arr[$i]['title'].'<br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
					
					<p><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" class="list_icn"></a> <a  data-toggle="modal" href="#uploadReferenceDocuments" data-id="'.$arr[$i]['product_id'].'" class="search_icn"></a></p></span>';
				
				$output.='<button class="info" type="submit" >'.Core_CLanguage::_(ADD_TO_CART).'</button>';
			
				$output.='</div>
				</div><input type="hidden" name="addtocart"></form></div>';

				
			}
			$output.='</div>';

		}
		else
		{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</strong> 
			</div>';
		}
		
		return $output;	
	}
	/**
	* This function is used When New Products in home page 
	* @return string
 	*/
	function showAllNewProducts($arr)
	{
		if(count($arr)>0)
		{
			$output=' <div class="row-fluid">';
			for($i=0;$i<count($arr);$i++)
			{		
				if($i%4==0&& $i!=0)
				{
					$output.=' </div><div class="row-fluid">';

				}

				//category name
				$sql="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['category_id']."'";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);
				$cat=$obj->records[0]['category_name'];

				//sub category
				$sqlsub="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['sub_category_id']."'";
				$objsub=new Bin_Query();
				$objsub->executeQuery($sqlsub);
				$subcat=$objsub->records[0]['category_name'];

				//sub under  category
				$sqlsubun="SELECT * FROM  category_table WHERE  category_id='".$arr[$i]['sub_under_category_id']."'";
				$objsubun=new Bin_Query();
				$objsubun->executeQuery($sqlsubun);
				$subuncat=$objsubun->records[0]['category_name'];
				if($arr[$i]['product_status']==1)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new">';
				}
				elseif($arr[$i]['product_status']==2)
				{
					$imagetag='<img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale">';
				}
				elseif($arr[$i]['product_status']==0)
				{	
					$imagetag='';
				}
				$output.='
				<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$i]['product_id'].'"><div class="view view-first">
				<span class="ribbion_div">'.$imagetag.'</span>
				<img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$arr[$i]['image'].'&h=250&w=250&zc=1&s=1&f=4,9&q=500" alt="'.$arr[$i]['title'].'">
				<div class="mask"><span class="visible-phone">
					<h2><a href="'.$_SESSION['base_url'].'/detail/'.$records[$i]['alias'].'.html">'.$arr[$i]['title'].'</a> <br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
				</span><span class="hidden-phone">
					<h2>'.$arr[$i]['title'].' <br/>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</h2>
					
					<p><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" class="list_icn"></a> <a  data-toggle="modal" href="#uploadReferenceDocuments" data-id="'.$arr[$i]['product_id'].'" class="search_icn"></a></p></span>';
			
				$output.='<button class="info" type="submit" >'.Core_CLanguage::_(ADD_TO_CART).'</button>';
				
				$output.='</div>
				</div><input type="hidden" name="addtocart"></form></div>';

				
			}
			$output.='</div>';

		}
		else
		{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</strong> 
			</div>';
		}
		
		return $output;	


	}
 	/**
	* This function is used When New Products is unavailable
	* @return string
 	*/
	function newProductsElse()
	{
		$output = '<div class="recent"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="36%" align="center"><font color="orange"><b>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</b></font></td></tr></table></div>';
		return $output;
	}
	/**
	* This function is used When the product in list format 
	* @param mixed $records
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/

	function viewProducts($records,$paging,$prev,$next,$val)
	{


		if($_GET['do']=='viewproducts' || $_GET['do']=='giftproducts')
		{
			$output='<ul class="productlists">';

			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
				

					$removal= array("rn");
					$desc= str_replace($removal, "", trim($records[$i]['description']));


					$output.='<li>';
					if($records[$i]['gift']=='1')
					{
					$output.='<form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'">';
					}
					else
					{
					$output.='<form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$records[$i]['product_id'].'">';	
					}
			                   	
						$output.='<div class="span3"><div class="productimg">';

						if($records[$i]['product_status']==1)
						{
							$output.='<span class="ribbion_div"><img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new" /></span> ';
						}
						elseif($records[$i]['product_status']==2)
						{
							$output.='<span class="ribbion_div"><img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale" /> </span>';
						}
						$output.='<div class="productlisting"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$records[$i]['large_image_path'].'&h=235&w=235&zc=0&s=1&f=4,11&q=100&ct=1" alt="'.$records[$i]['title'].'"> 
						</a></div></div></div>
						<div class="span6"><div class="description_div"><h3><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'">'.$records[$i]['title'].'</a></h3>

						  <p>'.$desc.'</p>
						</div></div>
						 <div class="span3"><div class="dollar_div">
							<h1>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h1>
						<input type="hidden" name="addtocart">';
						
						$sql="SELECT * FROM product_inventory_table WHERE product_id='".$records[$i]['product_id']."'";
						$obj=new Bin_Query();
						$obj->executeQuery($sql);
						$recordssoh=$obj->records;
						
						$output.='<button class="add_btn" type="submit" ><p style="margin-left:25%">'.Core_CLanguage::_(ADD_TO_CART).'</p></button>';
						
						$output.='</div></div>
						<div class="clear"></div>
							
						</form></li>';

				}

			}
			else
			{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</strong> 
			</div>';
			}
		

                $output.='</ul>';

		}
		elseif($_GET['do']=='girdviewproducts' || $_GET['do']=='girdgiftproducts')
		{
		
			$output='  <span class="visible-desktop">
           			   <div class="selecter">			
				  <div class="selecterContent">	<ul class="nolist">';
	
			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{	

					$output.='<li class="bags">';	
					if($records[$i]['gift']=='1')
					{
					$output.='<form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'">';
					}
					else
					{
					$output.='<form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$records[$i]['product_id'].'">';	
					}
	
					$output.='<form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$records[$i]['product_id'].'">';
				
					if($records[$i]['product_status']==1)
					{
						$output.='<div class="ribbion_div"> <img src="'.$_SESSION['base_url'].'/assets/img/ribbion/new.png" alt="new"></div>';
					}
					elseif($records[$i]['product_status']==2)
					{
						$output.='<div class="ribbion_div"> <img src="'.$_SESSION['base_url'].'/assets/img/ribbion/sale.png" alt="sale"/></div>';
					}
					$output.='<div class="galleryImage"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$records[$i]['image'].'&a=r&h=280&amp;w=235&zc=0&s=1&f=4,11&q=100&ct=1&a=tl" alt="'.$row['title'].'"></a>

					<div class="info">  
					<h2>'.substr(trim($records[$i]['title']),'0','15').'</h2>
					
				
					
					<h4>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h4>
					<input type="hidden" name="addtocart">';
					
					$sql="SELECT * FROM product_inventory_table WHERE product_id='".$records[$i]['product_id']."'";
					$obj=new Bin_Query();
					$obj->executeQuery($sql);
					$recordssoh=$obj->records;
					
						$output.='<button class="add_btn" type="submit" ><p style="margin-left:25%">'.Core_CLanguage::_(ADD_TO_CART).'</p></button>';
					
					$output.='</div>
					</div>
					</form></li>';
					
				}

			$output.='</ul>	</div></div>   </span>';

			$output.='<span class="hidden-desktop">
        		<div class="row-fluid">';
			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
            				$output.='<div class="span3"><form name="product" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$records[$i]['product_id'].'"><div id="gallery_image">
   					<a href="?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'"><img src="'.$_SESSION['base_url'].'/timthumb/timthumb.php?src='.$_SESSION['base_url'].'/'.$records[$i]['image'].'&a=r&h=500&amp;w=500&zc=0&s=1&f=4,11&q=100&ct=1&a=tl" alt="'.$row['title'].'"></a>
					<div class="info">  
					<h2>'.$records[$i]['title'].'</h2>
					
					'.trim($records[$i]['description']).'
					
					<h4>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h4>';
					$sql="SELECT * FROM product_inventory_table WHERE product_id='".$records[$i]['product_id']."'";
					$obj=new Bin_Query();
					$obj->executeQuery($sql);
					$recordssoh=$obj->records;
					
						$output.='<button class="add_btn" type="submit" ><p style="margin-left:25%">'.Core_CLanguage::_(ADD_TO_CART).'</p></button>';
					
					$output.='</div><input type="hidden" name="addtocart">
					</div></form></div>';
				}
			}
							
						$output.='</div> </span>';
			}
			else
			{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>'.Core_CLanguage::_(NO_PRODUCT_FOUND).'</strong> 
			</div></div></div>';
			}

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
	 * This function is used to show  the category bread crumb
	 * 
	 * 
	 * @return HTML data
	 */
	function categoryBreadCrumb()
	{


		$categoryalias=explode('/',$_GET['cat']);
		$categorycount=count($categoryalias);
	
		
		if($categorycount>0)
		{

			for($i=0;$i<$categorycount;$i++)
			{
				$parentcatalias=$categoryalias[0];
				$parentcat=str_replace('-',' ',$parentcatalias);
				$sqlParent="SELECT * FROM category_table WHERE category_alias='".$parentcatalias."'";	
				$objParent=new Bin_Query();
				$objParent->executeQuery($sqlParent);	
				$parent_id=$objParent->records[0]['category_id']; 
				$parent_category=$objParent->records[0]['category_name']; 	

				$category_alias=$categoryalias[$i];
				$categoryname=str_replace('-',' ',$category_alias);		
			 	$sql="SELECT * FROM  category_table  WHERE category_alias='".$categoryname."' AND FIND_IN_SET($parent_id,subcat_path)";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);	
				$records=$obj->records[0];
				$subcategory=trim($obj->records[0]['category_name']);

		
				$url=array_slice($subcategory, 0, $i+1);
				$comma_separated = implode("/", $url);
				$pos=strpos($_SERVER['REQUEST_URI'],'grid');

				if($pos==true)
				{
					$comma_separated='grid/'.$comma_separated.'.html';
				}
				else
				{
					$comma_separated=$comma_separated.'.html';
				}
				
		
				if(($categorycount-1)==($i))
				{
					$linkcontent=trim($records['category_name']);
				}
				else
				{
					
					$linkcontent='<a href='.$_SESSION['base_url'].'/'.$comma_separated.'>'.trim($records['category_name']).'</a><span class="divider">/</span>';
				}

				$output.='<li>'.$linkcontent.'</li>';	
			}

			
		}

		return $output;
	}

function getProductSefUrl($category_id,$alias)
	{

		$sql="SELECT * FROM  category_table  WHERE category_id='".$category_id."' AND category_status =1";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);	
		$records=$obj->records[0];
	  	$cat_subcat_path=trim($obj->records[0]['subcat_path']);
		$category_alias=trim($obj->records[0]['category_alias']);
		$category_name=trim($obj->records[0]['category_name']);


		$subcat_path=explode(',',$cat_subcat_path);
		$categorycount=count($subcat_path);


	
		if($categorycount>0)
		{

			for($j=0;$j<$categorycount;$j++)
			{
				
				
			 	$sql="SELECT * FROM  category_table  WHERE category_id='".$subcat_path[$j]."' AND category_status =1 ";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);	
				$records=$obj->records[0];
			 	$cat_subcat_path=trim($obj->records[0]['subcat_path']);
				$category_alias=trim($obj->records[0]['category_alias']);
				$category_name=trim($obj->records[0]['category_name']);

				if($cat_subcat_path==$subcat_path[$j])
				{
					$subcategory=$category_alias;
					 $comma_separated=$subcategory.'/'.$alias.'.html';
				}
				else
				{
				   $subcategory=Display_DNewProducts::getSubCatPath($subcat_path[$j]);

				   $comma_separated=$subcategory.'/'.$alias.'.html';
				}
			}
		}

		return $comma_separated;

	}

	function getLowestvariationPrice($pid)
	{

	  $sql="SELECT MIN(msrp) AS msrp,variation_id,product_id FROM  product_variation_table WHERE product_id='".$pid."'";
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   $msrp=$obj->records[0]['msrp'];

	   $sql_var="SELECT msrp,variation_id,product_id FROM  product_variation_table WHERE msrp='".$msrp."'";
	   $obj_var=new Bin_Query();
	   $obj_var->executeQuery($sql_var);
	   $variation_id=$obj_var->records[0]['variation_id'];

	   
	   $output=array('0'=>$msrp,'1'=>$variation_id);

	   return $output;


	}

function getSubCatPath($cat_id)
	{


		$sqlParent="SELECT * FROM category_table WHERE category_id='".$cat_id."' AND category_status =1";	
		$objParent=new Bin_Query();
		$objParent->executeQuery($sqlParent);	
		
		$subcat_path=$objParent->records[0]['subcat_path']; 	
		$subcat_path=explode(',',$subcat_path);
		$categorycount=count($subcat_path);
		
		if($categorycount>0)
		{

			for($i=0;$i<$categorycount;$i++)
			{				
				
			 	$sql="SELECT * FROM  category_table  WHERE category_id='".$subcat_path[$i]."' AND category_status =1";
				$obj=new Bin_Query();
				$obj->executeQuery($sql);	
				$records=$obj->records[0];
				$subcategory=trim($obj->records[0]['category_alias']);
				$cat_subcat_path=trim($obj->records[0]['subcat_path']);
				$category_alias=trim($obj->records[0]['category_alias']);

				if($i!=($categorycount-1))
				{
					$link_category_alias.=$category_alias.'/';
				}
				else
				{
					$link_category_alias.=$category_alias;

				}
		
			}

		
		}	

		return $link_category_alias;


	}

}


?>
