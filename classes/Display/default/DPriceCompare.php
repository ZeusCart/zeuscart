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
 * Price comparison related  class
 *
 * @package   		Display_DPriceCompare
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DPriceCompare
{
	/**
	 * Stores the output records
	 *
	 * @var array 
	 */	
	var $arr = array();
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();
	
 	/**
	* This function is used to Display the Price Compare Page
	* @param int $pricerunnerid
	* @return string
 	*/
	function showPriceComparePage($pricerunnerid)
	{
		$keyword=$_GET[keyword]; 
		$server_ip=$_SERVER['SERVER_ADDR'];
		$pr_error=0; // pricerunner error flag
		
		
		$fname='http://cgi.vcss.search123.uk.com/cgi-bin/prfeed.cgi?aid="'.$pricerunnerid .'"&amp;cp1=query&amp;co=us&amp;query="'.$keyword.'"&amp;ip='.$server_ip;

		$data=@file($fname);
		if(is_array($data) and count($data)>0)
		{
			$content= implode('', $data);
			
			$products=Display_DPriceCompare::readCSEContent($content);
			
	    	$products=$products[0]; 
			
			for($i=0;$i<5;$i++)
				if($i<round($products[product_num_ratings]))
					$img.='<img src="images/starf.png" />';
				else
					$img.='<img src="images/stare.png" />';
				
			
		 
			
			$noof_retailers=$products[product_number_of_retailers];	
			$output['priceList'] ='';
			
			$output['priceList']='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="100%" colspan="2" class="serachresult">Compare Price </td>
				</tr>
			  
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2"><div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="33%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td><img src="'.$_SESSION['base_url'].'/'.$products['product_image_url0'].'" alt="camera" width="213" height="153" /></td>
				  </tr>
				</table></td>
				<td width="67%" valign="top" class="itemDETAIL">
				<ul>'.$products['product_name'].'
				<li><div>$ '.$products['product_lowest_price'].' &nbsp;&nbsp;<a href="#"></a></div> 
				</li>
				<li>User Rating  : '.$img.'</li>
				<li>Manufaturer  : '.$products['product_manufacturer'].'</li>
				</ul></td>
			  </tr>
			</table>
			</div></td>
			  </tr>
			  <tr>
				<td colspan="2" class="line">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2" class="compare_txt">'.$noof_retailers.' Store(s) Found</td>
				</tr>
			  <tr>
				<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
				  <tr>
					<td width="26%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:10px;">Retailer</td>
					<td width="39%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:10px;">Availability</td>
					<td width="17%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:10px;">Price</td>
					<td width="18%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:10px;">Store Link</td>
					</tr>';
				  
				
				for($i=0;$i<$noof_retailers;$i++)
				{  
					$output['priceList'].='<tr><td bgcolor="#FFFFFF" class="compare_txt2">';
					
					$link='Not Available';
					if($products['retailer'.$i]['link']!='')
					{
						$link='<a href="'.str_replace('"','&quot;',$products['retailer'.$i]['link']).'">Go to Store</a>';
						$output['priceList'].='<a href="'.str_replace('"','&quot;',$products['retailer'.$i]['link']).'"><img src="'.$products['retailer'.$i]['logo'].'" alt="'.$products['retailer'.$i]['name'].'" width="110" height="28" border=0/></a>';
					}
					else
						$output['priceList'].='<img src="'.$products['retailer'.$i]['logo'].'" alt="'.$products['retailer'.$i]['name'].'" width="110" height="28" border=0/>';
						
					$output['priceList'].='</td>
					<td bgcolor="#FFFFFF" class="compare_txt">'.$products['retailer'.$i]['stock-info'].' </td>
					<td bgcolor="#FFFFFF" class="compare_txt">$ '.$products['retailer'.$i]['price'].' </td>
					<td align="right" valign="middle" bgcolor="#FFFFFF" class="go_store">'.$link.'&nbsp;</td>
				</tr>';
				 }
				  
				  
				$output['priceList'].='</table></td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			</table>
			</div>';

		}
		else
		{
			$output['priceList']='Price comparison service is not available now';
		}
		
		
		return $output['priceList'];		
	}
	
 	/**
	* This function is used to parse the XML Content
	* @param mixed $data
	* @return string
 	*/
	function readCSEContent($data)
	{
		
		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $data, $values, $tags);
		xml_parser_free($parser);
			
		$product_img_url = array();
		$main = array();
		$complete = array();
		$inc=0;
		$tmp_inc=0;
		$retailer_started=0;
		
		foreach($values as $skey=>$sval)
		{
			
			if($sval["type"]=="complete" && $sval["tag"]=="id")
				$main = array_merge($main,array("product_id"=>$sval["value"]));
			elseif($sval["type"]=="complete" && $sval["tag"]=="name")
			{
				if(!array_key_exists("product_name",$main))
					$main = array_merge($main,array("product_name"=>$sval["value"]));
			}			
			elseif($sval["type"]=="complete" && $sval["tag"]=="manufacturer")
				$main = array_merge($main,array("product_manufacturer"=>$sval["value"]));
						
			elseif($sval["type"]=="complete" && $sval["tag"]=="description")
				$main = array_merge($main,array("product_description"=>$sval["value"]));		
				
			elseif($sval["type"]=="complete" && $sval["tag"]=="category")
				$main = array_merge($main,array("product_category"=>$sval["value"]));		
				
			elseif($sval["type"]=="complete" && $sval["tag"]=="number-of-retailers")
				$main = array_merge($main,array("product_number_of_retailers"=>$sval["value"]));
				
			elseif($sval["type"]=="complete" && $sval["tag"]=="image-url")
				$main = array_merge($main,array("product_image_url".$inc++=>$sval["value"]));
				
			elseif($sval["type"]=="complete" && $sval["tag"]=="prices-url")
					$main = array_merge($main,array("product_price_url"=>$sval["value"]));				
					
			elseif($sval["type"]=="complete" && $sval["tag"]=="details-url")
					$main = array_merge($main,array("product_details_url"=>$sval["value"]));	
					
			elseif($sval["type"]=="open" && $sval["tag"]=="rating")		
					$main = array_merge($main,array("product_rating_type"=>$sval["attributes"]["type"]));
					
			elseif($sval["type"]=="complete" && $sval["tag"]=="average")
					$main = array_merge($main,array("product_rating_value"=>$sval["value"]));	
					
			elseif($sval["type"]=="complete" && $sval["tag"]=="num-ratings")
					$main = array_merge($main,array("product_num_ratings"=>$sval["value"]));	
					
			elseif($sval["type"]=="complete" && $sval["tag"]=="lowest-price")
			{
					$main = array_merge($main,array("product_lowest_price"=>$sval["value"]));
					$main = array_merge($main,array("product_lowest_currency"=>$sval["attributes"]["currency"]));
			}
			elseif($sval["type"]=="open" && $sval["tag"]=="retailer")
			{
				$tmp = "retailer".$tmp_inc++;
				$main = array_merge($main,array($tmp=>array()));
				$retailer_started = 1;
			}
			elseif($sval["type"]=="closed" && $sval["tag"]=="retailer")
				$retailer_started=0;	
				
			if($sval["type"]!="open" && $sval["type"]!="close" && $sval["tag"]!="retailer" && $retailer_started)
				$main[$tmp] = array_merge($main[$tmp],array($sval["tag"]=>$sval["value"]));
				
			if($sval["type"]=="close" && $sval["tag"]=="product")
			{
				$complete = array_merge($complete,array($main));
				$main = array();	
				$retailer_started=0;
				$tmp_inc=0;
			}
		}		
		return $complete; 
	} 

}
?>
