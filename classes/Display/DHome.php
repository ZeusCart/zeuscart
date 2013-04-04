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
 * Home page  related  class
 *
 * @package   		Display_DHome
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DHome
{
 	
	/**
	 * This function is used to get  the social link from  db
	 *  @param mixed $arr 
	 * 
	 * @return string
	 */
	function showSocialLinks($arr)
	{

		if(count($arr)>0)
		{
			$output=' <ul class="sociallist">';
			for($i=0;$i<count($arr);$i++)
			{
				$output.='<li><a target="_blank" href="'.$arr[$i]['social_link_url'].'" ><img src="'.$arr[$i]['social_link_logo'].'"></a></li>';
			}
			$output.='</ul>';
		}


		return $output;
	}

	/**
	* This function is used to Display the Footer links
	* @param mixed $arr
	* @return string
 	*/
	function footer($arr)
   	{
		$output = "";
		
		$output .= '<div id="btm_links"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
           `	<tr><td class="custom_footer">';
		for ($i=0;$i<count($arr);$i++)
		{
		
		$output.='<a href="userpage/'.$arr[$i]['link_url'].'" name="link" >'.$arr[$i]['link_name'].'</a>';
		
		}
		$output.='</td></tr> </table></div>';
		return $output;
	}

 	/**
	* This function is used to Display the Home Page Banner
	* @param mixed $arr
	* @return string
 	*/
	function getBanner($arr)
	{
		return '<div style="margin-bottom:14px">
				<a href="'.$arr['bannerUrl'].'">
					<img src="'.$arr['bannerImage'].'" width="464" height="174" border="0"/>
				</a>
			</div>';
	}
	/**
	* This function is used to Display the Brands
	* @param  array $records
	* @return string
 	*/
	function showBrands($records)
	{

		 $output='<div class="title_fnt">
		<h1>Find Your Favorite Brand </h1>
		</div>';

		$srhlist='';
		foreach(range('A', 'Z') as $letter) {
   		 $srhlist.='<a href="?do=brands&schltr='.$letter.'" class="btn_address">'.$letter.'</a>';
		}
		$srhlist.='&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="?do=brands&schltr=All"class="btn">All</a>';
		$output.='<div class="span12">
				
		<div>&nbsp;</div>';
		
		$output.='<div style="padding-left:100px;" class="btn-toolbar">
		<div class="btn">'.$srhlist.' 
		</div>
		</div>';
		
		$output.="<div>&nbsp;</div>";
		if( $_GET['schltr']!="" and  $_GET['schltr']!='All' )
		{
			if(count($records)>0)
			{
				$output.='<div><table><div class="title_fnt">
					<h1>'.$_GET['schltr'].'</h1>
					</div>';
				for($i=0;$i<count($records);$i++)
				{
		
					$output.='<div><h4><a href="?do=viewbrands&brand='.$records[$i]['brand'].'">'.$records[$i]['brand'].'</a></h4></div><br/>';	
		
				}
		
				$output.='</table></div>';
	
			}
			else
			{
				$output.='<div><table>
				<div class="title_fnt">
					<h1>'.$_GET['schltr'].'</h1>
					</div><div>&nbsp;</div></table></div><div><table><h4>No Products Found </h3></table></div>';
			}
		}
		elseif($_GET['schltr']=='All')
		{

			if(count($records)>0)
			{
				
				$output.='<div><table>
					<div class="title_fnt">
					<h1>'.$_GET['schltr'].' Favorite Brand </h1>
					</div></div><div>&nbsp;</div>';

				for($i=0;$i<count($records);$i++)
				{
					
						
					$output.='<div><h4><a href="?do=viewbrands&brand='.$records[$i]['brand'].'">'.$records[$i]['brand'].'</a></h4></div><br/>';	
		
				}
		
				$output.='</table></div>';
	
			}
		}
		
		
		$output.='<div>&nbsp;</div>';

		return $output;

	}
	/**
	* This function is used to list the product in  grid and noraml format based on brand
	* @param mixed $records
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function viewBrandsList($records,$paging,$prev,$next,$val)	
	{
		
		if($_GET['action']=='')
		{
			$output='<ul class="productlists">';

			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
					
					$output.='<li><form name="product" method="post" action="?do=addtocart&prodid='.$records[$i]['product_id'].'">
                    	
						<div id="listproduct">';

						if($records[$i]['product_status']==1)
						{
							$output.='<div class="ribbion_div"><img src="assets/img/ribbion/new.png" alt="new" /></div> ';
						}
						elseif($records[$i]['product_status']==2)
						{
							$output.='<div class="ribbion_div"><img src="assets/img/ribbion/sale.png" alt="sale" /> </div>';
						}
						$output.='<div class="productimg"><a href="?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'"><img src="assets/js/timthumb.php?src='.$records[$i]['large_image_path'].'&h=150&w=150&zc=0&s=1&f=4,11&q=100&ct=1" alt="'.$records[$i]['title'].'"> 
						</a></div>
						<div class="description_div"><h3><a href="?do=prodetail&action=showprod&prodid='.$records[$i]['product_id'].'">'.$records[$i]['title'].'</a></h3>
						'.trim($records[$i]['description']).'
						</div>
						<div class="dollar_div">
							<h1>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h1>
						<input type="hidden" name="addtocart">';

						$sql="SELECT * FROM product_inventory_table WHERE product_id='".$records[$i]['product_id']."'";
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
			else
			{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>No Products Found</strong> 
			</div>';
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
					$output.='<li class="bags"><form name="product" method="post" action="?do=addtocart&prodid='.$records[$i]['product_id'].'">
					';
				
					if($records[$i]['product_status']==1)
					{
						$output.='<div class="ribbion_div"> <img src="assets/img/ribbion/new.png" alt="new"></div>';
					}
					elseif($records[$i]['product_status']==2)
					{
						$output.='<div class="ribbion_div"> <img src="assets/img/ribbion/sale.png" alt="sale"/></div>';
					}
					$output.='<div class="galleryImage"><img src="assets/js/timthumb.php?src='.$records[$i]['image'].'&a=r&h=280&amp;w=235&zc=0&s=1&f=4,11&q=100&ct=1&a=tl" alt="'.$row['title'].'">

					<div class="info">  
					<h2>'.$records[$i]['title'].'</h2>
					
					'.trim($records[$i]['description']).'
					
					<h4>'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.$records[$i]['msrp'].'</h4>
					<input type="hidden" name="addtocart">';
	
					$sql="SELECT * FROM product_inventory_table WHERE product_id='".$records[$i]['product_id']."'";
					$obj=new Bin_Query();
					$obj->executeQuery($sql);
					$recordssoh=$obj->records;
					if($recordssoh[0]['soh']>0)
					{
						$output.='<button class="add_btn" type="submit" ></button>';
					}
					$output.='</div>
					</div>
					</form></li>';
					
				}

			$output.='</ul>	</div></div>';
			}
			else
			{
			$output.='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>No Products Found</strong> 
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
}	
?>