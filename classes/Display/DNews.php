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
 * @package   		Display_DNews
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DNews
{

	/**
	 * Stores the output records in array format
	 *
	 * @var array 
	 */	
	var $arr = array();
	/**
	 * Stores the output records in array format
	 *
	 * @var array 
	 */	
	var $arr1 = array();

        /**
	* This function is used to Display the News Menu
	* @param array $arr
	* @return string
 	*/
   	function showNewsTitle($arr)
	{
	 
	 	$title=$arr[0]['news_title'];
		$date=$arr[0]['date'];
		
		$output='<div >';
		 
		if(count($arr)>0)
		{
			for($i=0;$i<count($arr);$i++)
				{
				
					if(strlen($arr[$i]['news_title'])>30)
					$title=substr($arr[$i]['news_title'],0,30).'...';
					else 
					$title=substr($arr[$i]['news_title'],0,30); 
					
					
					
					
					$output.=' <div class="recentTXT" align="right" valign="bottom" >'.$arr[$i]['date'].'</div>
					<div class="newsletterTXT"  style="border-bottom:dotted 1px #999999;padding-bottom:13px">'.$title.'</div>';
						
				}			   
				$output.=' <div align="right" class="more"><a href="?do=morenews">More...</a> </div>';
			
		}
		else
		{
		$output.='<div class="recentTXT" align="right">No News Published</div>';           
		
		}  
		$output.='</div>' ; 
		 
		                  
		return $output;
	}

    /**
	* This function is used to Display the News page
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showNewsPage($arr,$paging,$prev,$next,$val)
	{
		

		$output ='<ul class="productlists">';
      
	 	 $i=0;
		
		if((count($arr)>0))
		{
			while($i<count($arr))
			{
			
					$output.='';
												
			    $output.='<li><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" ">
				<tr>
				  <td align="left"   >	<h1>'.$arr[$i]['news_title'].'</h1>
				 
				<font color="orange" size="2.9"> <small>'.$arr[$i]['date'].'</font> </span></td>
				 </tr>
				 
				 <tr> 
				  <td align="left" class="categoriesList"   >'.trim($arr[$i]['news_desc']).'  </td>
				  </tr>
				   </table></td>';
		
	
					$output.='<tr>
		<td colspan="2" class="dot_line">&nbsp;</td>
		</tr>';
		     $i++;
				
			}
		   $output.='</li><div class="pagination">
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
		
		}
		else
		{
			 $output.='<tr><td><b>No News Found</b></td></tr>';
		}
		
		
		
		
		$output.='</ul>';
		
		return $output;
	
	}
}
?>
