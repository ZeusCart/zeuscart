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
 * This class contains  promotional codes related process. 
 *
 * @package  		Display_DPromotionalCodes
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DPromotionalCodes
{
	/**
	 * Function  to  display the   promotional code
	 * 
	 * @return string
	 */	
	function selectMethodToSendPromotionalCode()
	{
		

		$output = '';
		$output .= '';	
		
		$output.='<div class="row-fluid">
  <div class="span12">

    <h2 class="box_head green_bg">Select Users</h2>
    <div class="toggle_container" >
      <div class="clsblock" style="border-bottom:none;">
        <div class="clearfix">';
		

		
		$output .= '<form method="post" action="?do=createpromotionalcodes&action=usersforcoupon">
		<div class="row-fluid">
  <div class="span3">Number Of Orders </div><div class="span3"><select name="order_condition"><option value="&gt">Greater Than</option><option value="&lt;">Less Than</option><option value="=">Equal To</option></select></div><div class="span3"> <input type="text" name="order_from" class="span8" size="9" value="'.$_POST['order_from'].'"></div><div class="span3"><input class="clsBtn" type="submit" name="b1" value="LIST"/><input type="hidden" name="type" value="ordercount"></form></div></div>';
		
		$output .= '<form method="post" action="?do=createpromotionalcodes&action=usersforcoupon"><div class="row-fluid">
  <div class="span3">Total Purchase </div><div class="span3"><select name="order_condition"><option value="&gt">Greater Than</option><option value="&lt;">Less Than</option><option value="=">Equal To</option></select></div><div class="span3"> <input type="text" name="purchase_from" class="span8" size="9" value="'.$_POST['purchase_from'].'"></div><div class="span3"><input class="clsBtn" type="submit" name="b1" value="LIST"/><input type="hidden" name="type" value="totalorder"></form></div></div>';
		
		$output .= '<form method="post" action="?do=createpromotionalcodes&action=usersforcoupon"><div class="row-fluid">
  <div class="span3">Date Of Join Between</div><div class="span3"><input class="span5" type="text" id="cal-field-1" name="fromdate" value="'.$_POST['fromdate'].'" readonly="true"/>&nbsp;</div><div class="span3"><input type="text" id="cal-field-2" name="todate"  value="'.$_POST['todate'].'" class="span5" readonly="true"/>&nbsp;</div><div class="span3"><input class="clsBtn" type="submit" name="b1" value="LIST"/><input type="hidden" name="type" value="user_doj"></form></div></div>';

$output .= '</div>
</div>
</div>
</div></div>';

return $output;

}

	/**
	 * Function  to  display the   promotional code for user
	 * @param array $arr
	 * @param integer $flag
	 * @param integer $couponcode
	 * @return string
	 */	
	function displayUsersForPromotionalCode($arr,$flag,$couponcode)
	{
		
		$output = '<form name="sendpromocodes" id="sendCouponform" method="post" action="?do=createpromotionalcodes&action=sendcoupon" >';

		
		if($flag!='0')
		{
			$output .= '<div class="row-fluid"><div class="toggle_container" ><div class="span12">
      <div class="clsblock" style="border-top:none;"> 
        <div class="clearfix"><div class="span3">Coupon </div><div class="span3"><input type="text" value="'.$couponcode.'" name="couponcode" readonly="true" size="15"></div></div></div></div></div></div><br/>';
    	}
    	

		$output.='<div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix">
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>

		<th align="left">&nbsp;</th>
		<th align="left" align="center">S.No</th>
		<th align="left" width="200">User Name</th>
		<th align="left">Date Of Join</th>
		<th align="left">Total Purchase ($)</th>
		<th align="left">Total Orders</th>
		</tr>
		</thead>
		<tbody>


		';
		$cnt = count($arr);

		if($flag=='0')
			$output .= '<div style="border-top:none;" class="clsblock"> 
			</div><div>&nbsp;</div><tr><td align="center" colspan="6"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				$user_doj_dt = explode(" ",$arr[$i]['user_doj']);
				$doj_date = explode("-",$user_doj_dt[0]);
				$doj_time = explode(":",$user_doj_dt[1]);
				$userdoj=date("l, M d, Y ",mktime(0,0,0,$doj_date[1],$doj_date[2],$doj_date[0]));
				
				
				$output.='';
				$output .= '<tr><td  ><input type="hidden" name="user_email[]" '.$tmpStr.' value="'.$arr[$i]['user_email'].'"/><input type="checkbox" name="user_id[]" value="'.$arr[$i]['user_id'].'"/>	</td><td  align="center" >'.($i+1).'</td><td >'.$arr[$i]['user_display_name'].'</td><td >'.$userdoj.'</td>';
				$output .='<td  align="right">'.($arr[$i]['totalorder']!='' ? $arr[$i]['totalorder'] : '0.00').'</td><td >'.$arr[$i]['ordercount'].'</td>';
				/*$output .='<td ><a href="?do=editreg&action=edit&id='.$arr[$i]['user_id'].'"><font color="blue">Edit</font></a></td>';*/
				
				
				$output .='</tr>';
			}
			
		}
		$output .= '</tbody></table></div></div></form>';
		return $output;


	}
	/**
	 * Function  to  create the   promotional code 
	 * @param array $arr
	 * @param integer $rstr
	 * @return string
	 */	
	function createPromotionalCodes($arr,$rstr)
	{
		$output ='<form name="fm" method="post" id="savePromotioncode" action="?do=createpromotionalcodes&action=insert" enctype="multipart/form-data">
		<div class="row-fluid">
		<div class="span12">

		<h2 class="box_head green_bg">Create Coupon Code</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">

		<div class="row-fluid">
		<div class="span6"><label>Coupon Code</label>

		<input type="text" class="span8" maxlength=25 name="cupon_code" id="cupon_code" value="'.$rstr.'" size="18" disabled /> 
		<input type="hidden" name="cupon_code"  value="'.$rstr.'"></div></div>
		<div class="row-fluid">
		<div class="span6"><label>Coupon Name</label>
		<input type="text" maxlength=50 class="span8" name="cupon_name" id="cupon_name" value="" />
		</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Discount</label>
		<input type="text" name="discount_amt" class="span3" id="discount_amt" size="9" value="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="clsselect" name="discount_type">
		<option value="percent">%</option>
		<option value="amt">'.$_SESSION['currency']['currency_tocken'].'</option>
		</select>
		</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Valid From</label>
		<input type="text" name="txtfromdate" class="span3" class="span8" id="txtfromdate" size=9  value="" / readonly="true" >
		</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Valid To</label>
		<input type="text" name="txttodate" class="span3" id="txttodate" size=9  value="" readonly="true"/>
		
</div></div>
<div class="row-fluid">
<div class="span6"><label>Minimum Purchase Amount&nbsp;'.$_SESSION['currency']['currency_tocken'].'</label>
<input type="text" class="span8" name="min_purchase" id="min_purchase" value="" size="9"/>
</div></div>
<div class="row-fluid">
<div class="span6"><label>Number of Uses</label>
<input type="text" class="span3" name="uses_count" id="uses_count" value="" size="9"/>
</div></div>
<div class="row-fluid">
<div class="span6"><label>Select Categories</label>
';
$output .= '<div id="catids" style=" border:solid 1px;overflow:auto;height: 156px; width: 253px; "  >';
$output .= '<ul style="list-style:none">';


for ($i=0;$i<count($arr);$i++)
{
	$output.='<li><input type=checkbox value="'.$arr[$i]['id'].'" name="maincategories['.$i.']" />'.$arr[$i]['catname'];
	$output.='<ul style="list-style:none">';
	foreach($arr[$i]['subcats'] as $subcat)
		$output.='<li><input type=checkbox value="'.$subcat['category_id'].'" name="subcategories[]" />'.$subcat['category_name'].'</li>';
	$output.='</ul>';
	$output.='</li>';

}
$output .= '</ul>';
$output .= '</div>';

$output .= '</div></div>

</div>
</div>
</div>
</div></div>
</form>';
return $output;	
}
	/**
	 * Function  to  create the   promotional code 
	 * @param array $result
	 * @param integer $paging
 	 * @param integer $prev
 	 * @param integer $next
	 * @return string
	 */	
	function displayPromotionalCodes($result,$paging,$prev,$next)
	{
		
		$output='<form name="frmorders" method="post">
		<div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix">
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>

		<th align="left">Coupon Code</th>
		<th align="left">Coupon Name</th>
		<th align="left">Discount</th>
		<th align="left">Valid Form</th>
		<th align="left">Valid To</th>
		<th align="left">Min Purchase</th>
		<th align="left">Uses</th>
		<th align="left">Status</th>
		<th align="left">Send</th>
		</tr>
		</thead>
		<tbody>';
		$i=1;
		if((count($result))>0)
		{

			foreach($result as $row)
			{
				$id= $row['id'];
				$coupon_code=$row['coupon_code'];
				$coupan_name= $row['coupan_name'];
				$created_date = $row['created_date'];
				$discount_amt = $row['discount_amt'];
				$discount_type= $row['discount_type'];
				
				if ($discount_type=='amt')
					$discount=$_SESSION['currency']['currency_tocken'].' '.$discount_amt;
				elseif ($discount_type=='percent')
					$discount=$discount_amt.' %';
				
				$valid_from  = $row['valid_from'];
				$valid_to=$row['valid_to'];
				$min_purchase=$row['min_purchase'];
				$no_of_uses=$row['no_of_uses'];
				$status=$row['status'];
				
				$validfrom_date_time = explode(" ",$valid_from);
				$validfrom_date = explode("-",$validfrom_date_time[0]);
				$validfrom_time = explode(":",$validfrom_date_time[1]);
				$validfromdatetime=date("l, M d, Y ",mktime(0,0,0,$validfrom_date[1],$validfrom_date[2],$validfrom_date[0]));
				
				$validto_date_time = explode(" ",$valid_to);
				$validto_date = explode("-",$validto_date_time[0]);
				$validto_time = explode(":",$validto_date_time[1]);
				$validtodatetime=date("l, M d, Y ",mktime(0,0,0,$validto_date[1],$validto_date[2],$validto_date[0]));

				//if($i%2==0)
				//{
						//$output.='<tr ><td ><a href="?do=disporders&action=detail&id='.$id.'">'.$coupon_code.'</a></td><td  >'.$coupan_name.'</td><td >'.$discount.'</td><td >'.$valid_from.'</td><td ">'.$valid_to.'</td><td  >$ '.$min_purchase.'</td><td  >'.$no_of_uses.'</td>';
				$output.='<tr ><td  >'.$coupon_code.'</td><td  >'. substr($coupan_name,0,12).'</td><td  align="right">'.$discount.'</td><td >'.$validfromdatetime.'</td><td ">'.$validtodatetime.'</td><td   align="right">'.$_SESSION['currency']['currency_tocken'].' '.$min_purchase.'</td><td  >'.$no_of_uses.'</td>';
				if($status==0)
				{
					$output .='<td   align="center"><a href="?do=createpromotionalcodes&action=changestatus&status=accept&id='.$id.'" class="inactive_link" title="Click To Enable"><span class="badge badge-important">In Active</span></a></td><td><img class="inactive_link" border="0"></td>';
				}
				else
				{
					$output .='<td   align="center"><a href="?do=createpromotionalcodes&action=changestatus&status=deny&id='.$id.'" class="active_link" title="Click To Disable"><span class="badge badge-info">Active</span></a></td><td><a href="?do=createpromotionalcodes&action=usersforcoupon&cid='.$id.'"><img src="images/icon_send1.gif" border="0" alt="Send"></a></td>';
				}

				$output.='<tr>';

				//}
				//else
				//{
				//		$output.='<tr  class="content_list_txt1"><td  class="content_list_txt1"><input type=checkbox name= "chkorder[]" id=chkorder value="'.$id.'"></td><td  class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt1">'.$id.'</td><td  class="content_list_txt1">'.$purdate.'</td><td  class="content_list_txt1"">'.$bilname.'</td><td   class="content_list_txt1">'.$shipname.'</td><td class="content_list_txt1">'.$amount.'</td><td class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dropdowndata.'</a> </td><tr>';

				//}
				$i++;
			}

			$output.='<tr>
			<td colspan="9" class="clsAlignRight">
			<div class="dt-row dt-bottom-row">
			<div class="row-fluid">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>'.' '.$prev.' ';
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		$output .= $pagingvalues.' '.$next.'</ul></div>
			</div>
			</div>
			</td>
			</tr>';
			
		}
		else
		{
			$output.='<tr><td colspan="9" class="content_list_txt1" valign="top" width="100%"> Not Present</td></tr>';
		}
		
		$output.='</tbody></table></div></div></form>';
		
		return $output;

	}
	
}	