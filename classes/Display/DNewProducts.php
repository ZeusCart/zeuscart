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
	var $output = array();	
	
 	/**
	* This function is used to Display the New all Products
	* @name newProducts
	* @param mixed $arr
	* @param int $r	
	* @return string
 	*/
	function newProducts($arr,$r)
	{

		if(count($arr)>0)
		{
			$output.='<div class="image_grid portfolio_4col">
				<ul style="margin-left:12px" id="list" class="portfolio_list da-thumbs">';
			for($i=0;$i<count($arr);$i++)
			{
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

				$output.='<li>';
				if($arr[$i]['product_status']==1)
				{
					$imagetag='<img src="assets/img/ribbion/new.png" alt="new">';
				}
				elseif($arr[$i]['product_status']==2)
				{
					$imagetag='<img src="assets/img/ribbion/sale.png" alt="sale">';
				}
				elseif($arr[$i]['product_status']==0)
				{	
					$imagetag='';
				}

				$output.='<span class="ribbion_div">'.$imagetag.'</span>
				<div class="product_box"><img src="'.$arr[$i]['image'].'" alt="img"></div>
				<article class="da-animate da-slideFromRight" style="display: block;">
					<h3>'.$arr[$i]['title'].'</h3>
					<em><b>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$arr[$i]['msrp'].'</b></em> <span class="link_post"><a href="?do=viewproducts&cat='.$cat.'&subcat='.$subcat.'&subundercat='.$subuncat.'"></a></span> <span class="zoom"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"></a></span>
					<a href="?do=addtocart&prodid='.$arr[$i]['product_id'].'" class="add_to_cart">Add to Cart</a>
					</article>
				</li>';
				
			}

		}
			$output.='</ul>
			</div>';

		return $output;	
	}

 	/**
	* This function is used When New Products is unavailable
	* @name newProductElse
	* @return string
 	*/
	function newProductsElse()
	{
		$output = '<div class="recent"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="36%" align="center"><font color="orange"><b>Products not yet viewed</b></font></td></tr></table></div>';
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

		
		if($_GET['action']=='')
		{
			$output='<ul class="productlists">';

			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
					
					$output.='<li>
                    	
						<div id="listproduct"><div class="ribbion_div">';

						if($records[$i]['product_status']==1)
						{
							$output.='<img src="assets/img/ribbion/new.png" alt="new">';
						}
						elseif($records[$i]['product_status']==2)
						{
							$output.='<img src="assets/img/ribbion/sale.png" alt="sale">';
						}
						$output.='</div>
						<div class="productimg"><a href="?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'"><img src='.$records[$i]['thumb_image'].' alt="'.$records[$i]['title'].'"></a></div>
						<div class="description_div"><h3><a href="?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'">'.$records[$i]['title'].'</a></h3>
						<p>'.trim($records[$i]['description']).'</p>
						</div>
						<div class="dollar_div">
							<h1>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h1>
						<a href="?do=addtocart&prodid='.$records[$i]['product_id'].'" class="add_btn"></a>
						</div>
						<div class="clear"></div>
							</div>
						</li>';



				}

			}
			

                $output.='</ul>';

		}
		elseif($_GET['action']=='grid')
		{
			$output='<ul class="nolist">';
	
			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{	
					$output.='
					<li class="bags">
					<div class="galleryImage"><div class="ribbion_div">';

					
					if($records[$i]['product_status']==1)
					{
						$output.='<img src="assets/img/ribbion/new.png" alt="new">';
					}
					elseif($records[$i]['product_status']==2)
					{
						$output.='<img src="assets/img/ribbion/sale.png" alt="sale">';
					}
					$output.='</div>
					<img src='.$records[$i]['image'].'></img>
					<div class="info">  
					<h2>'.$records[$i]['title'].'</h2>
					<p>
					'.trim($records[$i]['description']).'
					</p>
					<h4>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h4>
					<a href="?do=addtocart&prodid='.$records[$i]['product_id'].'" class="add_btn"></a>
					</div>
					</div>
					</li>';
					
				}

			$output.='</ul>	</div></div>';
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




}


	
?>