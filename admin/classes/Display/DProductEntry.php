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
 * This class contains functions to list out the product
 *
 * @package  		Display_DProductEntry
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
 class Display_DProductEntry
{

	/**
	 * Function  to display   the  category 
	 * @param array $result
	 * @param integer $selected
	 * @return string
	 */		
 	function displayCategory($result,$selected='')
	{
	
		if((count($result))>0)
		{
		   	 $output='<select name="selcatgory[]" id="selcatgory"  style="width: 292px;height:150px" multiple onclick="assignSubCat(this.value);"><option value="Choose Category">Choose Category</option>';	
		
			for($k=0;$k<count($result);$k++)
			{
				if($catid==$result[$k]['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.='<option value='.$result[$k]['category_id'].' '.$selected.'>'.$result[$k]['category_name'].'</option>';
				$output.=self:: getSubFamilies(0,$result[$k]['category_id'] );
	
			
			}

		$output.='</select>';
		}

		return $output;
	}
	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level, $id) {

		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id." and category_status!='2'";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				
				if($catid==$rowSubFamilies['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.= "<option value=".$rowSubFamilies['category_id']."  ".$selected.">";

				for($a=1;$a<$level+1;$a++)
				{
				$output.='- &nbsp;';
					
				}
				$output.=$rowSubFamilies['category_name']."</option>";
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id']);
				
			}
		
		}
		
		return $output;
	}
	/**
	 * Function  to display   the  sub category 
	 * @param array $result
	 * @return string
	 */		
	function displaySubCategory($result)
	{
	     if((count($result))>0)
		{
		   
		    $output='<select name="selsubcatgory" onchange="assignSubCat(this.value);"><option value="">Select</option>';
		    foreach($result as $row)
			{
			   $id=$row['category_id'];
			   $name=$row['category_name'];
			   $output.='<option value="'.$id.'">'.$name.'</option>';
			}
			$output.='</select>';
		}
		else
			 $output='<select name="selsubcatgory" onchange="assignSubCat(this.value);"><option value="">Select</option></select>';
		return $output;
	}
	/**
	 * Function  to display   the  sub under sub category 
	 * @param array $result
	 * @return string
	 */		
	function displaySubUnderCategory($result)
	{
	     if((count($result))>0)
		{
		   
		    $output='<select name="selsubundersubcatgory" onchange="assignSubUnderCat(this.value);"><option value="">Select</option>';
		    foreach($result as $row)
			{
			   $id=$row['category_id'];
			   $name=$row['category_name'];
			   $output.='<option value="'.$id.'">'.$name.'</option>';
			}
			$output.='</select>';
		}
		else
			 $output='<select name="selsubundersubcatgory" onchange="assignSubUnderCat(this.value);"><option value="">Select</option></select>';
		return $output;
	}
	/**
	 * Function  to display   the  add more msrp link
	 * @param array $result
	 * @return string
	 */	
	function addMoreMsrpLink($result)
	{
	   if((count($result))>0)
		{
		   $output='<a href="?do=msrpmgt&id='.$result.'" onc>Add More Msrp</a>&nbsp;&nbsp;<a href="?do=home">Add More Features</a>';
		}
		
		return $output;	  
	}
	/**
	 * Function  to display   the  add more features link
	 * @param array $result
	 * @return string
	 */	
	
	function addMoreFeaturesLink($result)
	{
	   if((count($result))>0)
		{
		   $output='<a href="?do=msrpmgt&id='.$result.'">Add More Msrp</a>';
		}
		
		return $output;	  
	}
	/**
	 * Function  to display   the  product brand
	 * @param array $result
	 * @param integer $selected	
	 * @return string
	 */	
	function dispBrand($result,$selected='')
	{
		if((count($result))>0)
		{
		   $output="<select name='selbrand' style='width:160px'><option value=''>Select</option>";
		  	 foreach($result as $row)
			{
				if($row['brand']!='')
				{
					if($selected==$row['brand'])
					{
						$select='selected=selected';
					}
					else
					{
						$select='';	
					}
					$output.="<option value='".$row['brand']."' ".$select.">".trim($row['brand'])."</option>";
				}
			}
		   $output.="</select>";
		   return $output;
		}
	}
	/**
	 * Function  to display   the  product brand
	 * @param array $result
	 * @param integer $val	
	 * @return string
	 */	
	function corBrand($result,$val)
	{
	
	   if((count($result))>0)
		{
		   $output="<select name='selbrand'><option value=''>Select</option>";
		   for($i=0;$i<count($result);$i++)
		   {
		   	if($result[$i]['brand']==$val)
			{
			    	$output.='<option value="'.$result[$i][brand].'" selected="selected">'.$result[$i][brand].'</option>';
			}
			else
			{
				$output.="<option value='".$result[$i][brand]."'>".$result[$i][brand]."</option>";
			}
		}
				
		   $output.="</select>";
		   return $output;
		}
	}
	/**
	 * Function  to display   the  all product 
	 * @param array $arr
	 * @param integer $flag
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next
	 * @param integer $start	 	 
	 * @return string
	 */	
	function showAllProducts($arr,$flag,$paging,$prev,$next,$start)
	{	
		
			
		$output.='
		
		<div style="text-align:right;"><p>
              <button class="btn btn-mini btn-primary" type="button"  onclick="searchProducts(\'all\');">Reset Filter</button>
              <button class="btn btn-mini" type="button" onclick="searchProducts(\'sear\');">Search</button>
            </p></div>
		  <div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix">
			<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
	
		<thead class="green_bg">
		<TR>
           <th ></th>
		  <th>Product Name</th>
		  <th>Brand</th>
		  <th width="15%">MSRP</th>
		  <th width="15%">Price</th>		  
		  </TR>
		  </thead><tbody  id="search">';
		
		$cnt = count($arr);
		
		$output .= '<tr>
		<td  ><input type="checkbox" name="chkMain" onClick="chkall();" value=1></td>
		<td ><input type="text" id="title1"  name="title"  value="'.$_POST['title'].'" /></td>
		<td  ><input type="text"   name="brand" id="brand1"  value="'.$_POST['brand'].'"/></td>
		<td ><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text" name="frommsrp" id="frommsrp1" size="5" value="'.$_POST['frommsrp'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text" name="tomsrp" id="tomsrp1" size="5" value="'.$_POST['tomsrp'].'"/></td></tr></table></td>
		<td  valign="top" ><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text"  name="fromprice" id="fromprice1" size="5" value="'.$_POST['fromprice'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text"  name="toprice" id="toprice1" size="5" value="'.$_POST['toprice'].'"/></td></tr></table>
		 </td>';

		$output.='</tr>';

	

		
		if(count($arr) > 0)
			$count=count($arr);
		if($flag=='0')
			 $output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Products Matched</b></font></td></tr>';
		else
		{
			for($i=0;$i<$count; $i++)
			{
				
					
				$temp=$arr[$i]['image'];
				$img=explode('/',$temp);
				
				if($arr[$i]['status']==0)
					$status="Disabled";
				else
					$status="Enabled";	
				
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .='<tr ><td align="center" '.$classtd.' width="5%"><input name="chkSub[]" id="chkSub" type="checkbox" value="'.$arr[$i]['product_id'].'"></td>';
				
				$title=(strlen($arr[$i]['title'])>25) ? substr($arr[$i]['title'],0,25).'...' : $arr[$i]['title'] ;
				$output .= '<td ><a class="content_list_link" href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td><td>'.$arr[$i]['brand'].'</td><td>'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['msrp'],2).'</td><td>'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['price'],2).'</td>';
				
				$output.='</tr>';
				$start++;
			}
			

			/*$output.='<tr align="center"><td colspan="11"  class="content_list_footer" >'.' '.$prev.' ';
			
			for($i=1;$i<=count($paging);$i++)
				$pagingvalues .= $paging[$i]."  ";*/
			
			$output.= '</td></tr></tbody></table></div></div>';
			
			//$output.= '</td></tr></table>';
			return $output;
		}
	
	}
	/**
	 * Function  to display   the  search product 
	 * @param array $arr
	 * @param integer $flag
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next
	 * @param integer $start	 	 
	 * @return string
	 */	
	function searchProducts($arr,$flag,$paging,$prev,$next,$start)
	{
			
		
		$output.='<table cellpadding="0" cellspacing="0" border="0" width="100%" >';
		
		$cnt = count($arr);
		if(count($arr) > 0)
			$count=count($arr);
		$output .= '<tr>
		<td  ><input type="checkbox" name="chkMain" onClick="chkall();" value=1></td>
		<td ><input type="text" id="title1"  name="title"  value="'.$_GET['title'].'" /></td>
		<td  ><input type="text"   name="brand" id="brand1"  value="'.$_GET['brand'].'"/></td>
		<td ><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text" name="frommsrp" id="frommsrp1" size="5" value="'.$_GET['frommsrp'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text" name="tomsrp" id="tomsrp1" size="5" value="'.$_GET['tomsrp'].'"/></td></tr></table></td>
		<td  valign="top" ><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text"  name="fromprice" id="fromprice1" size="5" value="'.$_GET['fromprice'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text"  name="toprice" id="toprice1" size="5" value="'.$_GET['toprice'].'"/></td></tr></table>
		 </td>';

		$output.='</tr>';
		if($flag=='0')
			$output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Products Matched</b></font></td></tr>';
		else
		{
			for($i=0;$i<$count; $i++)
			{
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
					
				$temp=$arr[$i]['image'];
				$img=explode('/',$temp);
				
				if($arr[$i]['status']==0)
					$status="Disabled";
				else
					$status="Enabled";	
				
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.' width="5%"><input name="chkSub[]" id="chkSub" type="checkbox" value="'.$arr[$i]['product_id'].'"></td>';
				
				$title=(strlen($arr[$i]['title'])>25) ? substr($arr[$i]['title'],0,25).'...' : $arr[$i]['title'] ;
				$output .= '<td '.$classtd.' align="left" width="21%"><a class="content_list_link" href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td><td '.$classtd.' width="17%">'.$arr[$i]['brand'].'</td><td '.$classtd.' width="14%" align="right">'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['msrp'],2).'</td><td '.$classtd.' width="14%" align="right">'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['price'],2).'</td>';
				
				$output.='</tr>';
				//$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
				$start++;
			}
			
			$output.= '</td></tr>';
			
		}
		$output.='</table>';
		return $output;
	
	}
	/**
	 * Function  to  display the attributed
	 * @param array $result
	 * @return string
	 */	
	function displayAttributes($result)
	{

		$cnt=count($result);
		
		$output='<table border="0" width="80%" cellpadding="4" cellspacing="4" align="center">';
		
		if((count($result))>0)
		{
			$cnt=count($result);
			for($i=0;$i<$cnt;$i++)
			{
				$val=count($result[$i]);
				$output.='
				<TR>
        		          <TD width="35%"> '.$result[$i][0]['attrib_name'].' </TD>';
				  $output.='<TD  colspan="3"><select name="attribute[]" style="width:160px"><option value="0">-None-</option>';
				  
				for($j=0;$j<$val;$j++)
				{
				  	$output.='<option value="'.$result[$i][$j]['attrib_value_id'].'">'.$result[$i][$j]['attrib_value'].'</option>';
				}
				$output.='</select></TD>		
	                	</TR>';
			}
		}
		else
		{
			$output.='             
	        	<tr>
        			<td colspan="2" align="center"><font color="orange"><b>No Attributes found</b</font></td>
	                </tr>';
		
		}
		$output.='             
	      
	        </table>';
		
		return $output;
	}
	
}
?>
