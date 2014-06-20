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
 * @package  		Display_DManageProducts
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Display_DManageProducts
{
	
	/**
	 * Function creates a template to display the product titles available. 
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function dispProductTitle($arr)
	{
		$output='<tr><td colspan="3" align="left">Adding Cross products for <span class="content_title">'.$arr[0]['title'].		'</span></td></tr>';
		return $output;	  
	}
	
	/**
	 * Function creates a template to display the product lists available. 
	 * @param array $arr
	 * 
	 * @return string
	 */	
	
	function productList($arr)
	{
		$output = "";
		$output.='
		<tr>
	        <td class="content_list_head">S.No</td>
			<td class="content_list_head">Select</td>
			<td class="content_list_head">Product Name</td>
			<td class="content_list_head">Brand</td>
			<td class="content_list_head">Model</td>
			<td class="content_list_head">Msrp </td>
                	<td colspan="2" align="center" class="content_list_head">Options</td>
                </tr>
              	<tr>
                	<td colspan="8" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              	</tr>';
		if(count($arr) > 0)
			$count=count($arr);
		for($i=0;$i<$count; $i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
				
			$temp=$arr[$i]['image'];
			$img=explode('/',$temp);
			$output.='<input type="hidden" name="mainindex" value="">';
			$output .='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.'">'.($i+1).'</td><td align="center" '.$classtd.'><input name="checkbox[]" type="checkbox" value="'.$arr[$i]['product_id'].'" /></td>';
			//$output .='<td '.$classtd.'><img src="uploadedimages/thumb/thumb_'.$img[2].'" name="image1"  id="image1"/></td>';
			$output .= '<td '.$classtd.' align="center">'.$arr[$i]['title'].'</td><td '.$classtd.'>'.$arr[$i]['brand'].'</td><td '.$classtd.'>'.$arr[$i]['model'].'</td><td '.$classtd.'>'.$arr[$i]['msrp'].'</td>';
			
			$output.='<td '.$classtd.'><a href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">View</a></td></tr>';
			$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
		}
		//$output.='<tr><td align="right"><input type="submit" name="btnSubmit" value="Submit" id="submit" onclick="" / ></td></tr>';
		//echo $output;
		
		return $output;



		

		
	}
	 
	/**
	 * Function creates a template to display all the products available in the database. 
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


		$output = '<form name="search" method="post" action="?do=manageproducts&action=search" >';
			
		$output.='  <div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		
		<th align="left">Name</th>
		<th align="left">Brand</th>
		<th align="left">SKU</th>
		<th align="left">MSRP</th>
		<th align="left">Price</th>
		<th align="left">Status</th>
	
		<th align="left">Type</th>
		<th align="left">Tag</th>
		<th align="left">Intro Date</th>
		<th align="left">Options</th>
		</tr>
		</thead>
		<tbody>';
		$cnt = count($arr);
		$output .= '<tr >
			   <td ><input type="text"  name="title" style="width:100px;" id="title" value="'.$_POST['title'].'"  /></td>
			   <td ><input type="text"  style="width:70px;" name="brand" value="'.$_POST['brand'].'"/></td>
			   <td ><input type="text"  name="sku" size="4" value="'.$_POST['sku'].'"/></td>



			   <td ><table style="margin-top:-5px;"><tr><td style="border:none">From</td><td style="border:none"><input type="text" name="frommsrp" id="frommsrp" size=3  value="'.$_POST['frommsrp'].'"  /></td></tr><tr><td style="border:none">To</td><td style="border:none"><input type="text" name="tomsrp" id="tomsrp" size=3   value="'.$_POST['tomsrp'].'"/></td></tr></table></td>
			    <td ><table style="margin-top:-5px;"><tr><td style="border:none">From</td><td style="border:none"><input type="text" name="fromprice" id="fromprice" size=3 value="'.$_POST['fromprice'].'"  /></td></tr><tr><td style="border:none">To</td><td style="border:none"><input type="text" name="toprice" id="toprice" size=3   value="'.$_POST['toprice'].'"/></td></tr></table></td>
			   <td ><select id="visibility" name="status" type="select" style="width:60px" >';

		$pstatus=array("All"=>"-1",'Enabled'=>1,'Disabled'=>0);
		if($_POST['status']=='')
		$stat=-1;
		else
		$stat=$_POST['status'];
		foreach($pstatus as $key=>$val)
		{
			$output .=  ($stat == $val)? '<option value="'.$val.'" selected="selected">'.$key.'</option>' : '<option value="'.$val.'" >'.$key.'</option>' ;
		}

		$output.='</select></td>';
//			    <td><select id="visibility1" name="cse" type="select" style="width:60px" >';
// 		$pcse=array("All"=>"-1",'Enabled'=>1,'Disabled'=>0);
// 		if($_POST['cse']=='')
// 		$cse=-1;
// 		else
// 		$cse=$_POST['cse'];
// 		foreach($pcse as $key=>$val)
// 		{
// 			$output .=  ($cse == $val)? '<option value="'.$val.'" selected="selected">'.$key.'</option>' : '<option value="'.$val.'" >'.$key.'</option>' ;
// 		}
// 	
// 		$output.='</select></td>
			
		$output.=' <td ><select id="producttype" name="producttype" type="select" style="width:60px" >';
		$ptype=array("All"=>"-1",'Physical'=>0,'Digital'=>1,'Gift'=>2);
		if($_POST['producttype']=='')
		$producttype=-1;
		else
		$producttype=$_POST['producttype'];
		foreach($ptype as $key=>$val)
		{
			$output .=  ($producttype == $val)? '<option value="'.$val.'" selected="selected">'.$key.'</option>' : '<option value="'.$val.'" >'.$key.'</option>' ;
		}
	
		$output.='</select></td>


			    <td ><input type="text"  name="tag" size="3" value="'.$_POST['tag'].'"/></td>
			   <td ><table style="margin-top:-5px;"><tr><td style="border:none">From</td><td style="border:none"><input type="text" name="fromdate" id="fromdate" size=3  value="'.$_POST['fromdate'].'"  /></td></tr><tr><td style="border:none">To</td><td style="border:none"><input type="text" name="todate" id="todate" size=3   value="'.$_POST['todate'].'"/></td></tr></table></td>
			   ';
		$output.='<td ><input class="clsBtn" type="submit" name="search" value="Search"/></td></tr>';
		//$output .='<tr><td colspan="8" align="right"><b>Search</b>&nbsp;&nbsp;<input type="text" name="search">
					//<input type="button" name="btnsearch" value="Search"></td></tr>';
		//$output.='<th>S.no.</th><th>Display Name</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Edit</th>
					//  <th>Delete</th><th>Status</th>';
		
		if($flag=='0')
			 $output.= '<tr><td align="center" colspan="10"><font color="orange"><b>No Products Matched</b></font></td></tr>';
		else
		{
			for($i=0;$i<$cnt; $i++)
			{
				$introdatetime=$arr[$i]['intro_date'];
				if($introdatetime!='0000-00-00')		
				{
					$intro_date_time = explode(" ",$introdatetime);
					$intro_date = explode("-",$intro_date_time[0]);
					$intro_time = explode(":",$intro_date_time[1]);
					$introdate=date("M d, Y",mktime(0,0,0,$intro_date[1],$intro_date[2],$intro_date[0]));
				}
				else
				{
					$introdate=$introdatetime;
				}
					
				$temp=$arr[$i]['image'];
				$img=explode('/',$temp);
				if($arr[$i]['digital']==0 && $arr[$i]['gift']==0)
				{	
					$ptypes="physical";
					$typetitle='Physical'; 
				}
				elseif($arr[$i]['digital']==1 && $arr[$i]['gift']==0)
				{	
					$ptypes="digital";	
					$typetitle='Digital'; 
				}
				elseif($arr[$i]['digital']==0 && $arr[$i]['gift']==1)
				{	
					$ptypes="gift";	
					$typetitle='Gift'; 
				}
				if($arr[$i]['status']==0)
				{	$status="badge badge-important";
					$stitle="Disabled"; 
				}
				else
				{	$status="badge badge-info";	
					$stitle='Enabled'; 
				}
				
				if($arr[$i]['cse_enabled']==0)
				{   $cse="inactive_link"; $cstitle='Inactive'; }
				else
				{	$cse="active_link";	 $cstitle='Active'; }
					
				$output.='<input type="hidden" name="mainindex" value="">';
				$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">';
				
				$title=(strlen($arr[$i]['title'])>20) ? substr($arr[$i]['title'],0,20).'...' : $arr[$i]['title'] ;
				$output .= '<td  align="left"><a  href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td>
				<td >'.$arr[$i]['brand'].'</td>
				<td '.$classtd.'>'.$arr[$i]['sku'].'</td>
				<td '.$classtd.' align="right">'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['msrp'],2).'</td>
				<td  align="right" >'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['price'],2).'</td>
				<td align="center"><span class="'.$status.'" title="'.$stitle.'">'.$stitle.'</span></td>';
// 				$output.='<td  align="center"><span class="'.$cse.'" title="'.$cstitle.'"></span></td>';
				$output.='<td  align="center">'.$typetitle.'</td>
				<td >'.$arr[$i]['tag'].'</td><td '.$classtd.'>'.$introdate.'</td>';
				if($arr[$i]['digital']==1 && $arr[$i]['gift']==0)
				{
					$editurl='digiteditprod';
				}
				elseif($arr[$i]['digital']==0 && $arr[$i]['gift']==1)
				{
					$editurl='gifteditprod';
				}	
				else
				{
					$editurl='editprod';
				}


				$output.='<td align=center><span><a href="?do=manageproducts&action='.$editurl.'&prodid='.$arr[$i]['product_id'].'"><i class="icon icon-edit"></i></a> </span>	&nbsp;&nbsp;				 
					<span><a href="?do=manageproducts&action=delete&prodid='.$arr[$i]['product_id'].'" onclick="return confirm(\'Are you sure want to Delete this Product?\')" ><i class="icon-trash"></i></a></span></td></tr>';
				$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
				$start++;
			}	
		}
		$output.='<tr>
		<td colspan="11" class="clsAlignRight">
		<div class="dt-row dt-bottom-row">
		<div class="row-fluid">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul>'.$prev.' ';
		
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.'</ul></div>
		</div>
		</div>
		</td>
		</tr>';
		

		$output .= '</tbody></table></form></div></div>';
		return $output;

	}
	
	/**
	 * Function creates a template to display the titles available. 
	 * @param array $arr
	 * @return void
	 */
	
	function getTitle($arr)
	{
		$cnt=count($arr);
		for($i=0;$i<$cnt;$i++)
		{      		
			$output.='<div style="cursor:pointer" onclick="call(\''.$arr[$i]['title'].'\')">'.$arr[$i]['title'].'</div><br/>';
		}	
		echo $output;
	}
	

	/**
	 * Function creates a template to display the product details available. 
	 * @param array $result
	 * @param string $category
	 * @param string $subcat
	 * @return string
	 */	
	
	function  editProduct($result,$category,$subcat)
	{   
		$row=$result;
		
		$product_id=$row[0]['product_id'];
		$category_id=$row[0]['category_id'];
		$sku=$row[0]['sku']; 
		$title=$row[0]['title'];
		$description=$row[0]['description'];
		$brand=$row[0]['brand'];
		$model=$row[0]['model']; 
		$msrp=$row[0]['msrp'];
		$price=number_format($row[0]['price'],2);
		$cse_enabled=$row[0]['cse_enabled'];
		$weight=$row[0]['weight'];
		$dimension=$row[0]['dimension'];
		$thumb_image=$row[0]['thumb_image'];
		$image=$row[0]['image']; 
		$shipping_cost=$row[0]['shipping_cost']; 
		$tag=$row[0]['tag'];
		$meta_desc=$row[0]['meta_desc'];
		$meta_keywords=$row[0]['meta_keywords'];
		$intro_date=$row[0]['intro_date']; 
		$is_featured=$row[0]['is_featured'];
		$status=$row[0]['status']; 
		
		if($status)
			$status="checked='checked'";
		else
			$status='';
		
		
		
		$output="
		<form name='productupdate' action='?do=manageproducts&action=updateprod&prodid=".$product_id."' method='post' enctype='multipart/form-data'>
		<table cellpadding='0' cellspacing='0' width='80%' border='0' align='center' bgcolor=''>
		<tr>
			<td colspan='8' align='left' class='content_title'>EDIT PRODUCT ENTRY</td>
			<td class='content_title' width='20%' align='right'><a href='javascript:history.back()' class='more_page' onclick=''>Back</a></td>
		</tr>
		<tr>
			<td colspan='9' align='left'>&nbsp;</td>
		</tr>
          	<tr>
            		<td colspan='9' align='left'></td>
          	</tr>
          	<tr>
            		<td colspan='9' align='left'>&nbsp;</td>
          	</tr>
		<tr>
			<td colspan='9'>
			<table cellpadding='0' cellspacing='0' width='107%' border='0' align='center'>
			<tr>
	 	 		<td>
					<table width='100%' height='55' border='0' cellpadding='5' cellspacing='0'>
			 		<!--<tr>
						<td colspan='4' class='label_name'><b>Product Details</b> </td>
			 		</tr>-->
					<tr>
						<td width='31%' class='label_name'> Product Name</td>
						<td colspan='3'><input name='title' id='title'  type='text' size='50' value='".$title."' /></td>
					</tr>
					<tr>
						<td colspan='4' class='label_name'> Product Description </td>
					</tr>
					<tr>
						<td colspan='4' class='label_name'><textarea name='desc' id='desc' rows='20'  cols='80'>".$description."</textarea></td>
					</tr>
					<tr>
						<td class='label_name'> Product Category </td>
						<td colspan='3' class='label_name'>".$category."</td>
					</tr>
			
					<tr>
						<td class='label_name'> Product Subcategory </td>
						<td colspan='3' id='subcats' class='label_name'>".$subcat."</td>
					</tr>
					<tr>
						  <td class='label_name'>Brand</td>
						  <td colspan='3' class='label_name' ><input name='brand' id='brand' value='".$brand."' type='text' /></td>
					</tr>
			  		<tr>
						  <td class='label_name'>SKU</td>
						  <td colspan='3' class='label_name' ><input name='sku' id='sku' value='".$sku."' type='text' /></td>
					</tr>
					<tr>
						  <td class='label_name'>Model</td>
						  <td colspan='3' class='label_name' ><input name='model' id='model'  type='text' value='".$model."'  /></td>
			  		</tr>
					<tr>
						<td colspan='4'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='4'><hr /></td>
					</tr>
					<tr>
						<td colspan='4' class='label_name'><b><span style='font-size:15px'>Price & Shipping Details</span></b> </td>
					</tr>
					<tr>
						<td class='label_name'> Product Price </td>
						<td  colspan='3' class='label_name'><input name='price' id='price' type='text' value='".$price."' /></td>
					</tr>
					<tr>
						<td class='label_name'> Product Msrp </td>
						<td colspan='3' class='label_name'><input name='msrp' id='msrp' type='text' value='".$msrp."' /></td>
					</tr>
					<tr>		
						<td class='label_name'> Product Shipping Cost </td>
						<td colspan='4' class='label_name'><input name='shipcost' id='shipcost' value='".$shipping_cost."' type='text' /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan='4'>&nbsp;</td>
					</tr>
					<tr>
					  	<td class='label_name'>Weight</td>
					  	<td colspan='4' class='label_name'><input name='weight' id='weight' value='".$weight."' type='text'  /></td>
			  		<tr>
						<td class='label_name'>Dimension</td>
					 	<td colspan='4' class='label_name'><input name='dimension' id='dimension' value='".$dimension."' type='text' /></td>
			  
			    
			    		<tr>
						<td class='label_name'>Image </td>
						<td colspan='2' class='label_name' ><input type='file' name='prodcutimage' /></td><td colspan='2'><img src='../".$image."' alt='' name='mainimage'/></td>
					</tr>
			    
					<tr>
						<td>&nbsp;</td>
						<td colspan='4'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='4'><hr /></td>
					</tr>
					<tr>
						<td colspan='4' class='label_name'><b><span style='font-size:15px'>Search Details</span></b> </td>
					</tr>
					<tr>
						<td class='label_name'> Product Tags </td>
						<td  colspan='4' class='label_name'><input name='tag' id='tag' value='".$tag."'  type='text'/>&nbsp;seperated by comma </td>
					</tr>
					<tr>
						<td class='label_name' colspan='3'><b>Meta Data Information</b> </td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class='label_name'> Product Meta Description </td>
						<td class='label_name' colspan='4'><input name='meta_desc'  type='text' value='".$meta_desc."'  id='meta_desc' size='80' /></td>
					</tr>
					<tr>
						<td class='label_name'>Product Meta Keywords </td>
						<td class='label_name' colspan='4'><input name='meta_keywords' type='text' id='meta_keywords' value='".$meta_keywords."' size='80' /></td>
			  		</tr>
					<tr>
						  <td class='label_name'>Intro Date </td>
						  <td class='label_name'  colspan='4'><input  type='text' id='intro_date' name='intro_date' value='".$intro_date."'  /><input type='image' src='images/calendar_img.gif' id='cal-button-1' value='cal'>
			 		 <script type='text/javascript'>
					    Calendar.setup({
					      inputField    : 'intro_date',
					      button        : 'cal-button-1',
					      align         : 'Tr'
					    });
					  </script></td>
					</tr>
					<tr>
						  <td class='label_name' >CSE Enabled </td>
						  <td class='label_name' colspan='4'> "; 
						if($cse_enabled=='0')
						{
						 	$output.="<input name='cse_enabled' type='checkbox' id='cse_enabled' />";
						} 
						else
						{
							$output.="<input name='cse_enabled' type='checkbox' id='cse_enabled' checked='checked'/>";
						}
						$output.="</td>
					</tr>
					<tr>
						<td class='label_name'>Is Featured </td>
						<td class='label_name' colspan='4'> "; 
						if($is_feautured=='0')
						{
							$output.="<input name='is_feautured' type='checkbox' />";
						}	 
						else
						{
							 $output.="<input name='is_feautured' type='checkbox' checked='checked'/>";
						}
						$output.="</td>
					</tr>
					<tr>	
						<td class='label_name'>Visibility </td>
						<td class='label_name' colspan='4'>"; 
						if($status=='0')
						{
						 	$output.="<input name='status' type='checkbox'  />";
						} 
						else
						{
					 		$output.="<input name='status' type='checkbox' checked='checked'/>";
						}	
				   		$output.=" </td>
					</tr>
					<tr>
						<td class='label_name' colspan='5'><div align='center'><input type='submit' name='submit' value='Update' /></div></td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				</td>
			</tr>	
			</table>
		</form>";

		return $output;

	}
	
	/**
	 * Function creates a template to display the product details available. 
	 * @param array $arr
	 * @param string $value
	 * @return string
	 */	
	
	
	function editRelated($arr,$value)
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
         	  <th width="2%" ></th>
		  <th >Product Name</th>
		  <th width="10%">Brand</th>
		  <th width="15%">MSRP</th>
		  <th width="17%">Price</th>		  
		  </TR>
		  </thead><tbody ID="search" >';
		
		$cnt = count($arr);
		
		$output .= '<tr>
		<td><input type="checkbox" name="chkMain" onClick="chkall();" value=1></td>
		<td><input type="text" id="title1"  name="title" style="width:130px;" value="'.$_POST['title'].'" /></td>
		<td><input type="text"  style="width:100px;" name="brand" id="brand1"  value="'.$_POST['brand'].'"/></td>
		<td><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text" name="frommsrp" id="frommsrp1" size="5" value="'.$_POST['frommsrp'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text" name="tomsrp" id="tomsrp1" size="5" value="'.$_POST['tomsrp'].'"/></td></tr></table></td>
		<td><table><tr><td  style="border:none">From:</td><td  style="border:none"><input type="text"  name="fromprice" id="fromprice1" size="5" value="'.$_POST['fromprice'].'"/></td></tr><tr><td  style="border:none">To:</td><td  style="border:none"> <input type="text"  name="toprice" id="toprice1" size="5" value="'.$_POST['toprice'].'"/></td></tr></table></td>';

		$output.='</tr>';
		//$output.='<tr><td ID="search" colspan="7"><table cellpadding="0" cellspacing="0" border="0" width="100%" >';	
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
				if(in_array($arr[$i]['product_id'],$value))
				{
				
					$check='checked="checked"';
				}
				else
				{
					$check='';
				}
				
				if($arr[$i]['status']==0)
					$status="Disabled";
				else
					$status="Enabled";	
				
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .='<tr ><td ><input name="chkSub[]" id="chkSub" type="checkbox" value="'.$arr[$i]['product_id'].'" '.$check.'></td>';
				
				$title=(strlen($arr[$i]['title'])>25) ? substr($arr[$i]['title'],0,25).'...' : $arr[$i]['title'] ;
				$output .= '<td ><a class="content_list_link" href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$title.'</a></td><td >'.$arr[$i]['brand'].'</td><td width="14%" align="right">'.$arr[$i]['msrp'].'</td><td>'.$arr[$i]['price'].'	</td>';
				
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
	 * Function displays a template for uploading the image. 
	 * @param array $sub
	 * @return string
	 */		
	
	function editImage($sub)
	{

		if($sub != 0)
		{
			for($i=1;$i<=count($sub);$i++)
			{
				
				$output.='

				<div class="row-fluid">
 		<div style="width:350px;" ><label>Sub Product Image <font color="#FF0000">*</font></label>
			<INPUT type="hidden" name="ufile_id['.$i.']" id="ufile_id['.$i.']" VALUE="'.$sub[$i-1]['product_images_id'].'">
		<div class="fileupload fileupload-new" data-provides="fileupload"><div style="float:right"></div>
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../'.$sub[$i-1]['image_path'].'" /></div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span> <INPUT NAME="ufile['.$i.']" ID="ufile['.$i.']"  type="file" /></span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div> </div>
                </div>';
			}
			
		}
		if($sub != 0) 
			$cnt=count($sub);
		else
			$cnt=0;
		
		for($j=$cnt;$j<4;$j++)
		{
			$output.='<div class="row-fluid">
 		<div class="span12"><label> Sub Product Image </label>
        	                <INPUT type="hidden" name="ufile_id['.($j+1).']" id="ufile_id['.($j+1).']" >

        	                   <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/noimage.gif" /></div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><INPUT NAME="ufile['.($j+1).']" ID="ufile['.($j+1).']"  type="file" /></span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div> </div>
                </div>

                        	
				';
		}
		return $output;
	}
	
	/**
	 * Function displays a template for uploading the image. 
	 * @param string $main
	 * @return string
	 */		
	
	
	function editMainImage($main)
	{


		if($main != 0)
		{
			$output='   <div class="row-fluid">
 		<div class="span12"><label> Main Product Image <font color="#FF0000">*</font></label>
			<INPUT type="hidden" name="ufile_id[0]" id="ufile_id[0]" VALUE="'.$main['product_images_id'].'">


						<div class="fileupload fileupload-new" data-provides="fileupload" style="width:350px;">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../'.$main['image_path'].'" /></div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span> <INPUT NAME="ufile[0]" ID="ufile[0]"  type="file" /></span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div> </div>
                </div>';
				
		}
		else
		{
			$output=' <div class="row-fluid">
 		<div class="span12"><label> Main Product Image <font color="#FF0000">*</font></label>
			<INPUT type="hidden" name="ufile_id[0]" id="ufile_id[0]" VALUE="'.$main['product_images_id'].'">


						<div class="fileupload fileupload-new" data-provides="fileupload"><div style="float:right"></div>
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/noimage.gif" /></div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span> <INPUT NAME="ufile[0]" ID="ufile[0]"  type="file" /></span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div> </div>
                </div>';
			
		}
		
		return $output;
	}
	
	/**
	 * Function creates a template for updating the available attributes. 
	 * @param array $result
	 * @param array $arr
	 * @return string
	 */		
	
	
	function editAttributes($result,$arr)
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
					if(in_array($result[$i][$j]['attrib_value_id'],$arr))
					{
						$output.='<option value="'.$result[$i][$j]['attrib_value_id'].'" selected="selected">'.$result[$i][$j]['attrib_value'].'</option>';
					}
					else
					{
					$output.='<option value="'.$result[$i][$j]['attrib_value_id'].'">'.$result[$i][$j]['attrib_value'].'</option>';
					}
				}
				$output.='</select></TD>		
	                	</TR>';
			}
		}
		else
		{
			$output.='             
	        	<tr>
        			<td colspan="2" align="center"><font color="orange"><b>No Attributes found</b></font></td>
	                </tr>';
		
		}
		$output.='             
	      
	        </table>';
		
		return $output;
	
	}
	
	/**
	 * Function creates a template for updating the tier price available. 
	 * @param array $arr
	 * @return string
	 */		
	
	
	function editTierPrice($arr)
	{

		if(count($arr) > 0)
		{
			for($i=1;$i<=count($arr);$i++)
			{
				$output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'>
			
			<td class='content_list_txt1' width='40%'><INPUT NAME='quantity[]' ID='quantity[]'  type='text'  class='span6'  value='".$arr[($i-1)]['quantity']."'/>&nbsp;and above</td><td width='31%' class='content_list_txt1'><INPUT NAME='msrp[]' ID='msrp[".$i."]'  type='text'   value='".$arr[($i-1)]['msrp']."'  class='span6' />&nbsp;<b>[".$_SESSION['currency']['currency_code']."]</b></td></tr>";
			}
			
		}
		for($j=count($arr);$j<5;$j++)
		{
			$output.="<tr>
			
			<td class='content_list_txt1' width='40%'><INPUT NAME='quantity[]' ID='quantity[]'  type='text' class='span6'  />&nbsp;	and above</td><td width='31%' class='content_list_txt1'><INPUT NAME='msrp[]' ID='msrp[".($j+1)."]'  type='text'  class='span6' />&nbsp;<b>[USD]</b></td></tr>";
		}
		return $output;
	
	}
	
	/**
	 * Function displays a template for the categories available. 
	 * @param array $result
	 * @param integer $catid
	 * @return string
	 */		
	function displayCategory($result,$catid)
	{

	    $displayCategory=explode(",", $catid);
		if((count($result))>0)
		{
		   	 $output='<select name="selcatgory[]" onclick="assignSubCat(this.value);" id="selcatgory" style="width: 292px;height:150px" multiple><option value="Choose Category">Choose Category</option>';	
		
			for($k=0;$k<count($result);$k++)
			{

				if(in_array($result[$k]['category_id'], $displayCategory))
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.='<option value='.$result[$k]['category_id'].' '.$selected.'>'.$result[$k]['category_name'].'</option>';
				$output.=self:: getSubFamilies(0,$result[$k]['category_id'],$catid);
	
			
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
	function getSubFamilies($level, $id,$catid) {

		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id." and category_status!='2'";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				$displayCategory=explode(",", $catid);
				if(in_array($rowSubFamilies['category_id'], $displayCategory))
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
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id'],$catid);
				
			}
		
		}
		
		return $output;
	}
	/**
	 * Function displays a template for the sub categories available. 
	 * @param array $result
	 * @param integer $subcatid
	 * @return string
	 */		
	
	
	function displaySubCategory($result,$subcatid)
	{

		$output='<select name="selsubcatgory" id="selsubcatgory" ><option value="">Select</option>';
		
		if((count($result))>0)
		{
		  
			foreach($result as $row)
			{
		
				$id=$row['category_id'];
			   	$name=$row['category_name'];
		
				if($subcatid==$row['category_id'])
			   	{

			   		$output.='<option value="'.$id.'" selected>'.$name.'</option>';
				}
				else
				{
					$output.='<option value="'.$id.'">'.$name.'</option>';
				}
			}
			
		}
		$output.='</select>';

		return $output;
	}

	/**
	 * Function displays a template for the sub categories available. 
	 * @param array $result
	 * @param integer $subcatid
	 * @return string
	 */		
	
	
	function displaySubUnderCategory($result,$subcatid)
	{

		$output='<select name="selsubundersubcatgory" id="selsubundersubcatgory"><option value="">Select</option>';
		
		if((count($result))>0)
		{
		  
			foreach($result as $row)
			{
			
				$id=$row['category_id'];
			   	$name=$row['category_name'];
							
				if($subcatid==$row['category_id'])
			   	{

			   		$output.='<option value="'.$id.'" selected>'.$name.'</option>';
				}
				else
				{
					$output.='<option value="'.$id.'">'.$name.'</option>';
				}
			}
			
		}
		$output.='</select>';

		return $output;
	}

	function editVariation($arr)
	{

		$output.='<table cellspacing="0" cellpadding="0" border="0"  class="variation_head" >
	
		<thead class="green_bg">
    										<tr>
    											<th width="15%">Variation Name</th>
    											<th width="5%">SKU</th>
											<th width="5%">Price</th>
											<th width="5%">MSRP</th>
    											<th width="15%">Image</th>
											<th width="5%">&nbsp;</th>
											<th width="25%">Dimensions(inches)<br/>Width&nbsp; &nbsp;&nbsp; &nbsp;  height&nbsp;&nbsp;  &nbsp;  Depth</th>
											<th width="5%">Weight </th>
											<th width="10%">Shipping Cost('.$_SESSION["currency"]["currency_code"].')</th>
											<th width="5%">SOH </th>
											<th width="5%">ROL </th>
											<th width="5%">Action </th>	
    										</tr>

    									</thead><tbody >
<tr>
			<td colspan="12" style="padding:0">	<div id="productVariationDiv" width="100%">';
		
				for($i=1;$i<=count($arr);$i++)
				{
				
				if(!empty($arr[$i-1]['dimension']))
				{
					$strdim=array();
					$strdim=explode('x',$arr[$i-1]['dimension']);
					$varwidth=trim($strdim[0]);
					$varheight=trim($strdim[1]);
					$vardepth=trim($strdim[2]);
				}

				
				
				$output.="<div id='productVariationDiv".$i."'>
					  <table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' class='variation_head'><tr >
					 <td width='15%' ><input type='hidden' id='varianid' name='varianid[]' value='".$arr[$i-1]['variation_id']."'  /><input id='varianname".$i."' name='varianname[]' type='text'  value='".$arr[$i-1]['variation_name']."'   class='span12' /></td>
					 <td width='5%' ><input id='prsku".$i."' name='prsku[]' type='text'  value='".$arr[$i-1]['sku']."' class='span12' /></td>
					 <td width='5%'  ><input id='prprice".$i."' name='prprice[]' type='text'  value='".$arr[$i-1]['price']."' class='span12' /></td>
					 <td width='5%' ><input id='prmsrp".$i."' name='prmsrp[]' type='text'  value='".$arr[$i-1]['msrp']."' class='span12' /></td>
					<td width='15%' ><input id='prvarimage".$i."' name='prvarimage[]' type='file' size='3' style='width: 173px ! important;' /></td><td width='5%' >";
					  if(file_exists('../'.$arr[$i-1]['thumb_image']))
					  {
						$output.="<img src='../".$arr[$i-1]['thumb_image']."' width='35' height='35'>";
					  }	
					  else
					  {
					  	$output.='<img width="35" height="35" src="../images/noimage.jpg"/>';
                                  	  } 	

					 $output.="</td><td  width='20%' ><input type='text'  name='prwidth[]' id='prwidth".$i."' value='".$varwidth."'     class='variation_date'/><input type='text'  name='prheight[]' id='prheight".$i."' value='".$varheight."'  class='variation_date'/><input type='text'  name='prdepth[]' id='prdepth".$i."'  value='".$vardepth."'  class='variation_date' /></td>
					<td width='5%' ><input id='prweight".$i."' name='prweight[]' type='text'  value='".$arr[$i-1]['weight']."' class='span12' /></td>
					<td width='10%' ><input id='prshipcost".$i."' name='prshipcost[]' type='text'  value='".$arr[$i-1]['shipping_cost']."' class='span12'/></td><td width='5%'   ><input id='prsoh".$i."' name='prsoh[]' type='text' value='".$arr[$i-1]['soh']."' class='span12'/></td><td width='5%' ><input id='prrol".$i."' name='prrol[]' type='text'  value='".$arr[$i-1]['rol']."' class='span12'/></td><td width='5%'  ><a href=\"javascript:;\"  onclick=\"removeVariation('productVariationDiv".$i."')\"><i class='icon-remove'></i></a></td></tr></table></div>";
				}
			
			$output.="</div>
				</td>
				</tr>
				</tbody>
				</table>";
					return $output;



	}
}	
