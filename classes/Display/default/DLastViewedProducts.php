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
 * Last viewed products related  class
 *
 * @package   		Display_DLastViewedProducts
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DLastViewedProducts
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	
	var $output = array();	
		
 	/**
	* This function is used to Display the Recently Viewed Product
	* @param mixed $arr
	* @param int $r	
	* @return string
 	*/
	function lastViewedProducts($arr,$r)
	{
		
		$cnt =count($arr);
		$limit = 0;$j=0;
		
		for ($i=0;$i<$cnt;$i++)
		{
			
			$rating=ceil($arr[$i]['rating']);
			$ratepath='';
			for($r1=0;$r1<5;$r1++)
			{
				if($r1<$rating)
					$ratepath.='<img src="images/starf.png">';
				else
					$ratepath.='<img src="images/stare.png">';							
			}
		
			$temp=$arr[$i]['thumb_image'];
			$img=explode('/',$temp);
			$output.='<div class="recent">';
			$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$output .='<tr>
   		 <td width="36%" align="center"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">';
			$filename=$arr[$i]['thumb_image'];
			if(file_exists($filename))
				$output.='<img src="'.$_SESSION['base_url'].'/'.$arr[$i]['thumb_image'].'" alt="'.addslashes($arr[$i]['title']).'"  width="63"  border="0"/>';
			else
				$output.='<img alt="No item" width="63"  border="0" src="images/noimage.jpg" />';	
			$output.='</a></td>';
			$output.='<td width="64%" valign="top" class="recentTXT" align="right" style="padding-left:5px"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">';
			if(strlen($arr[$i]['title'])>25) 
			$output.=substr($arr[$i]['title'],0,25).'...'; 
			else
			$output.=$arr[$i]['title'];
			
			$output.='</a><br/>'.$ratepath.'</td>';
			$output.='</tr>';
			$output.='<tr>
                   <td align="left" style="padding-top:10px">			   
				   <input title="<b>Quick Information</b>" alt="'.$_SESSION['base_url'].'/index.php?do=quickinfo&prodid='.$arr[$i]['product_id'].'?inlineId=myOnPageContent&amp;height=500&amp;width=500" class="thickbox button4" type="button" value="Quick Info" />  
				   <!--<a href="#" onClick="Lightbox.showBoxByAJAX(\'?do=quickinfo&prodid='.$arr[$i]['product_id'].'\', 478, 478);return false;">-->
				   <!--<a href="#" onclick=window.open("?do=quickinfo&prodid='.$arr[$i]['product_id'].'","a","height=480,width=490,menubar=0,status=0,toolbar=0,scrollbars=0,location=0,minimize=0,resizable=0")>	
		<input type="submit" value="Quik Info" class="button4" />--></td>
						
		</a></td>
                   <td class="recentTXT"><div style="padding-left:10px;"><!--<b>Price : </b><br/>--><span>'.$r[$j]['msrp'].'</span></div></td>
                  </tr>';
			$output.='</table>';
   	 
			$limit++;
			$j++;
			$output.='</div>';
		}
		return $output;	
	}
	
 	/**
	* This function is used When Recently Viewed Product is Not Available
	* @return string
 	*/
	function lastViewedProductsElse()
	{
		$output = '<div class="recent"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="36%" align="center"><font color="orange" size=2><b>Products not yet viewed</b></font></td></tr></table></div>';
		return $output;
	}
	
	
	
}	

?>