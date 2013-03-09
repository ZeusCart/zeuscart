<?php 

/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
 class Display_DProductEntry
{
 	function displayCategory($result,$selected='')
	{
		
		if((count($result))>0)
		{
		    //echo $selected;
			$output='<select name="selcatgory" onchange="showSubCat(this.value);" id="selcatgory"><option value="">Select</option>';
			if(count($result)>0)
			//while(list($id,$name)=$row)
		    foreach($result as $row) 			
			{
			   $id=$row['category_id'];
			   $name=$row['category_name'];
			   $output.='<option value="'.$id.'"';
			   if ($selected==$id)
			   	$output.=' selected=selected ';
			   $output.='>'.$name.'</option>';
			}
			$output.='</select>';
		}
		
		return $output;
	}
	
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
	
	function addMoreMsrpLink($result)
	{
	   if((count($result))>0)
		{
		   $output='<a href="?do=msrpmgt&id='.$result.'" onc>Add More Msrp</a>&nbsp;&nbsp;<a href="?do=home">Add More Features</a>';
		}
		
		return $output;	  
	}
	
	function addMoreFeaturesLink($result)
	{
	   if((count($result))>0)
		{
		   $output='<a href="?do=msrpmgt&id='.$result.'">Add More Msrp</a>';
		}
		
		return $output;	  
	}
	
	function dispBrand($result,$selected='')
	{
	  // print_r($result);exit;
	   if((count($result))>0)
		{
		   $output="<select name='selbrand'><option value=''>Select</option>";
		   foreach($result as $row)
		      $output.="<option value='".$row['brand']."' ".(($selected==$row['brand']) ? " selected=selected " : " " )." >".$row['brand']."</option>";
		   $output.="</select>";
		   return $output;
		}
	}
	
	function corBrand($result,$val)
	{
	/*	echo "<pre>";
	  print_r($result);exit;*/
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
	
	function showAllProducts($arr,$flag,$paging,$prev,$next,$start)
	{	
		
			
		$output.='
		
		<div style="text-align:right; width:90%; padding-bottom:10px"><input class="all_bttn" type="button" name="search" value="Reset Filter"  onclick="searchProducts(\'all\');"/>&nbsp;&nbsp;&nbsp;<input class="all_bttn" type="button" name="search" value="Search"  onclick="searchProducts(\'sear\');"/></div>
		<table cellpadding="0" cellspacing="0" border="0" width="90%" class="content_list_bdr">
		<TR>
                  <td class="content_list_head" width="5%"></td>
		  <td class="content_list_head" width="21%">Product Name</td>
		  <td class="content_list_head" width="17%">Brand</td>
		  <td class="content_list_head" width="14%">MSRP</td>
		  <td class="content_list_head" width="14%">Price</td>		  
		  </TR>';
		
		$cnt = count($arr);
		
		$output .= '<tr class="list_search_bg" >
		<td class="content_list_txt1" align="center"><input type="checkbox" name="chkMain" onClick="chkall();" value=1></td>
		<td class="content_list_txt1" valign="top"><input type="text" id="title1"  name="title" style="width:130px;" value="'.$_POST['title'].'" /></td>
		<td class="content_list_txt1" valign="top"><input type="text"  style="width:100px;" name="brand" id="brand1"  value="'.$_POST['brand'].'"/></td>
		<td class="content_list_txt1" valign="top" style="padding-left:3px; padding-right:3px;">From:<input type="text" name="frommsrp" id="frommsrp1" size="4" value="'.$_POST['frommsrp'].'"/><br/><br/>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tomsrp" id="tomsrp1" size="4" value="'.$_POST['tomsrp'].'"/></td>
		<td class="content_list_txt1" valign="top" style="padding-left:3px; padding-right:3px;">From:<input type="text"  name="fromprice" id="fromprice1" size="4" value="'.$_POST['fromprice'].'"/><br/><br/>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="toprice" id="toprice1" size="4" value="'.$_POST['toprice'].'"/></td>';

		$output.='</tr>';
		$output.='<tr><td ID="search" colspan="7">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" >';	
		if(count($arr) > 0)
			$count=count($arr);
		if($flag=='0')
			return $output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Products Matched</b></font></td></tr>';
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
				$output .= '<td '.$classtd.' align="left" width="21%"><a class="content_list_link" href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td><td '.$classtd.' width="17%">'.$arr[$i]['brand'].'</td><td '.$classtd.' width="14%" align="right">'.$arr[$i]['msrp'].'</td><td '.$classtd.' width="14%" align="right">'.$arr[$i]['price'].'	</td>';
				
				$output.='</tr>';
				$start++;
			}
			
			/*$output.='<tr align="center"><td colspan="11"  class="content_list_footer" >'.' '.$prev.' ';
			
			for($i=1;$i<=count($paging);$i++)
				$pagingvalues .= $paging[$i]."  ";*/
			
			$output.= '</td></tr></table></td></tr></table>';
			
			//$output.= '</td></tr></table>';
			return $output;
		}
	
	}
	
	function searchProducts($arr,$flag,$paging,$prev,$next,$start)
	{
			
		
			
		$output.='<table cellpadding="0" cellspacing="0" border="0" width="100%" >';
		
		$cnt = count($arr);
		if(count($arr) > 0)
			$count=count($arr);
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
				$output .= '<td '.$classtd.' align="left" width="21%"><a class="content_list_link" href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td><td '.$classtd.' width="17%">'.$arr[$i]['brand'].'</td><td '.$classtd.' width="14%" align="right">'.$arr[$i]['msrp'].'</td><td '.$classtd.' width="14%" align="right">'.$arr[$i]['price'].'</td>';
				
				$output.='</tr>';
				//$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
				$start++;
			}
			
			$output.= '</td></tr>';
			
		}
		$output.='</table>';
		return $output;
	
	}
	
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
