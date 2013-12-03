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
 * This class contains functions to list out the order details available.
 *
 * @package  		Display_DOrderManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DOrderManagement
{

	/**
	 * Function creates a template to display the orders available. 
	 * @param array $result
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	
	 * @param integer $dropdown
	 * @param array $dropupdatedata
	 * @return string
	 */
	function dispOrders($result,$paging,$prev,$next,$dropdown,$dropupdatedata)
	{


		$obj=new Display_DOrderManagement();
		$orderst=array('','Pending','Processing','Delivered');
		$orderstatuslist='<select name=selorderstatus><option value=""></option>';
		for($i=1;$i<4;$i++)
		{
			$orderstatuslist.=($_POST['selorderstatus']==$i)?'<option value='.$i.' selected="selected">'.$orderst[$i].'</option>':'<option value="'.$i.'">'.$orderst[$i].'</option>';
		}
		$orderstatuslist.='</select>';
		
		if(count($dropupdatedata)>0)
		{
			$mmcat=$_POST["selupdatedropdown"];
			$updrop="<select id='selupdatedropdown' name='selupdatedropdown'>";
			foreach($dropupdatedata as $row)
			{
				$orderstatusname=$row['orders_status_name'];
				$orderstatusid=$row['orders_status_id'];		
				$updrop.=($mmcat==$orderstatusid)?"<option value='$orderstatusid' selected='selected'>$orderstatusname</option>":"<option value='$orderstatusid'>$orderstatusname</option>";
			}
			$updrop.="</select>";			
		}

		$output='<form name="frmorders" method="post"><table cellspacing="0" border="0" width="100%" class="content_list_bdr">
		<tr >
		<td colspan=8 align=right valign=top><input type="hidden" name="selection" value="search" /><input type="button" value="Search"  class="all_bttn" onclick="document.frmorders.selection.value=\'Update\';/* document.frmorders.action=\'?do=disporders\'; */document.frmorders.submit(); "/></td>
		</tr>
		<tr><td colspan="2" align=left  valign=top><a href="#" onclick="return selDeSel(\'sel\');">Select</a>/<a href="#" onclick="return selUnDeSel(\'sel\');"> Unselect All</a> </td> <td>&nbsp;</td>
		<td colspan="2"  valign=top> Change order status to</td><td>'.$updrop.'</td>
		<td colspan=2 align=right  valign=top><input type="hidden" name="selection" value="Update" /><input type="button"  class="all_bttn" value="Update" 
		onclick="document.frmorders.selection.value=\'Update\'; document.frmorders.action=\'?do=disporders&action=update\'; document.frmorders.submit(); " /></td>
		</tr>
		
		<tr><td  class="content_list_head"></td><td  class="content_list_head">Order Id</td><td  class="content_list_head">Name</td><td  class="content_list_head">Order Date</td><td  class="content_list_head" >Bill Name</td><td  class="content_list_head">Ship Name</td><td  class="content_list_head">Order total ('.$_SESSION['currency']['currency_tocken'].')</td><td  class="content_list_head">Status</td></tr><tr><td colspan="8" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td></tr>
		
		<tr>
		<td></td>
		<td  valign=top><input type="text" name="dispname" id="dispname" value="'.$_POST['dispname'].'"/></td>
		<td  valign=top><input type="text" name="orderid" id="orderid" size=10  value="'.$_POST['orderid'].'" /></td>
		<td>
		<table border=0>
		<tr>
		<td>From</td>
		<td><input type="text" name="txtfromdate" id="txtfromdate" size=6  value="'.$_POST['txtfromdate'].'" /> 
		<img src="images/calendar_img.gif" id="cal-button-1"/></td>
		<tr >
		<td>To</td>
		<td><input type="text" name="txttodate" id="txttodate" size=6  value="'.$_POST['txttodate'].'" />
		<img src="images/calendar_img.gif" id="cal-button-2" /></td>
		</tr> 
		</table></td>
		<td  valign=top><input type="text" name="billname" id="billname"  value="'.$_POST['billname'].'"/></td>
		<td  valign=top><input type="text" name="shipname" id="shipname"  value="'.$_POST['shipname'].'"/></td>
		<td><table border=0>
		<tr>
		<td>From</td>
		<td><input type="text" name="ordertotalfrom" id="ordertotalfrom" size=6  value="'.$_POST['ordertotalfrom'].'" /> 
		</td>
		<tr>
		<td>To</td>
		<td><input type="text" name="ordertotalto" id="ordertotalto" size=6   value="'.$_POST['ordertotalto'].'"/>
		</td>
		</tr>
		
		</table></td>
		<td  valign=top>'.$orderstatuslist.'</td>
		</tr>';
		$i=1;
		if((count($result))>0)
		{
			foreach($result as $row)
			{
				$id= $row['orders_id'];
				$dispname= $row['Name'];
				$purdate = $row['date_purchased'];
				$bilname = $row['billing_name'];
				$shipname= $row['shipping_name'];
				$status  = $row['orders_status_name'];
				$statusid=$row['orders_status_id'];
				
				$amount=$row['order_total'];
				$dropdowndata=$obj->dropdownOrderStatus($dropdown,$statusid);
				if($i%2==0)
				{
					$output.='<tr  class="content_list_txt2"><td  class="content_list_txt2"><input type=checkbox name= "chkorder[]" id=chkorder value="'.$id.'"></td><td  class="content_list_txt2"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt2">'.$id.'</td><td  class="content_list_txt2">'.$purdate.'</td><td  class="content_list_txt2"">'.$bilname.'</td><td   class="content_list_txt2">'.$shipname.'</td><td   class="content_list_txt2">'.$amount.'</td><td   class="content_list_txt2">'.$dropdowndata.'</td><tr>';

				}
				else
				{
					$output.='<tr  class="content_list_txt1"><td  class="content_list_txt1"><input type=checkbox name= "chkorder[]" id=chkorder value="'.$id.'"></td><td  class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt1">'.$id.'</td><td  class="content_list_txt1">'.$purdate.'</td><td  class="content_list_txt1"">'.$bilname.'</td><td   class="content_list_txt1">'.$shipname.'</td><td   class="content_list_txt1">'.$amount.'</td><td   class="content_list_txt1">'.$dropdowndata.' </td><tr>';

				}
				$i++;
			}
			$output.='<tr><td colspan="8" class="content_list_txt1" valign="top" align=center><input type=submit value="Save"></td></tr>';
		}
		else
		{
			$output.='<tr><td colspan="9" class="content_list_txt1" valign="top" width="100%"><div class="exc_msgbox"  width="100%"> No Orders Present</div></td></tr>';
		}
		$output.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		$output .= $pagingvalues.' '.$next.'</td></tr></table>';
		$output.='</table></form>';
		
		return $output;
	}
	/**
	 * Function creates a template to display the orders available. 
	 * @param array $result
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	
	 * @param integer $dropdown
	 * @param array $dropupdatedata
	 * @param array  $orderProduct
	 * @return string
	 */
	
	function displayOrders($result,$paging,$prev,$next,$dropdown,$dropupdatedata,$orderProduct)
	{


		$obj=new Display_DOrderManagement();
		$orderst=array('','Pending','Processing','Delivered','AwaitingPayment','Cancel');
		$orderstatuslist='<select name="selorderstatus" style="width:70px;"><option value="" >All</option>';
		for($i=1;$i<6;$i++)
		{
			$orderstatuslist.=($_POST['selorderstatus']==$i)?'<option value='.$i.' selected="selected">'.$orderst[$i].'</option>':'<option value="'.$i.'">'.$orderst[$i].'</option>';
		}
		$orderstatuslist.='</select>';
		
		if(count($dropupdatedata)>0)
		{
			$mmcat=$_POST["selupdatedropdown"];
			$updrop="<select id='selupdatedropdown' name='selupdatedropdown'>";
			foreach($dropupdatedata as $row)
			{
				$orderstatusname=$row['orders_status_name'];
				$orderstatusid=$row['orders_status_id'];		
				$updrop.=($mmcat==$orderstatusid)?"<option value='$orderstatusid' selected='selected'>$orderstatusname</option>":"<option value='$orderstatusid'>$orderstatusname</option>";
			}
			$updrop.="</select>";			
		}

		$output='  <form name="frmorders" method="post"><div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">


		<!--<tr >
		<td colspan=8 align=right valign=top><input type="hidden" name="selection" value="search" /><input type="button" value="Search"  class="all_bttn" onclick="document.frmorders.selection.value=\'Update\';/* document.frmorders.action=\'?do=disporders\'; */document.frmorders.submit(); "/></td>
		</tr>
		<tr><td colspan="2" align=left  valign=top><a href="#" onclick="return selDeSel(\'sel\');">Select</a>/<a href="#" onclick="return selUnDeSel(\'sel\');"> Unselect All</a> </td> <td>&nbsp;</td>
		<td colspan="2"  valign=top> Change order status to</td><td>'.$updrop.'</td>
		<td colspan=2 align=right  valign=top><input type="hidden" name="selection" value="Update" /><input type="button"  class="all_bttn" value="Update" 
		onclick="document.frmorders.selection.value=\'Update\'; document.frmorders.action=\'?do=disporders&action=update\'; document.frmorders.submit(); " /></td>
		</tr>-->


		<!--'.(isset($_GET['msg'])? '<div align="center" style="padding:3px;"><font color="green"><b>'.$_GET['msg'].'</b></font></span>' : "" ).'-->
		
		<thead class="green_bg">
		<tr>
		<th  align="left">Order Id</th>
		<th  align="left">Name</th>
		<th  align="left">Order Date</th>
		<th  align="left" >Bill Name</th>
		<th  align="left">Ship Name</th>
		<th  align="left">Order total</th>
		<th  align="left">Status</th>
		<th  align="left">Options</th>
		</tr>
		</thead><tbody>

		
		
		<tr class="list_search_bg">

		<td  valign=top><input type="text" name="orderid" id="orderid" style="width:50px" value="'.$_POST['orderid'].'" /></td>
		<td  valign="top" ><input type="text" name="dispname" id="dispname" value="'.$_POST['dispname'].'" style="width:75px"/></td>
		<td><table style="margin-top:-5px;"><tr><td style="border:none">From</td><td style="border:none"><input type="text" name="txtfromdate" id="txtfromdate" size=6  value="'.$_POST['txtfromdate'].'" /> </td></tr><tr><td style="border:none">To</td><td style="border:none"><input type="text" name="txttodate" id="txttodate" size=6  value="'.$_POST['txttodate'].'" /></td></tr></table>

		</td>
		<td  valign=top><input type="text" name="billname" id="billname"  value="'.$_POST['billname'].'"  style="width:50px"/></td>
		<td  valign=top><input type="text" name="shipname" id="shipname"  value="'.$_POST['shipname'].'" style="width:50px"/></td>
		<td><table style="margin-top:-5px;"><tr><td style="border:none">From</td><td style="border:none"><input type="text" name="ordertotalfrom" id="ordertotalfrom" size=6  value="'.$_POST['ordertotalfrom'].'"  /></td></tr><tr><td style="border:none">To</td><td style="border:none"><input type="text" name="ordertotalto" id="ordertotalto" size=6   value="'.$_POST['ordertotalto'].'"/></td></tr></table>
		
		</td>
		<td align="left" class="product_search">'.$orderstatuslist.'</td>
		<td align="center"><input type="submit" value="Search"  class="clsBtn" onclick="document.frmorders.selection.value=\'Update\';/* document.frmorders.action=\'?do=disporders\'; */document.frmorders.submit(); " /></td>
		</tr>';
		$i=1;
		$cnt=0;
		if((count($result))>0)
		{

			foreach($result as $row)
			{
				$id= $row['orders_id'];
				$dispname= $row['Name'];
				$customerid= $row['customers_id'];	
				$bilname = $row['billing_name'];
				$shipname= $row['shipping_name'];
				$status  = $row['orders_status_name'];
				$statusid=$row['orders_status_id'];
				$currency_tocken=$row['currency_tocken'];				

				$amount=$row['order_total'];
				$dropdowndata=$obj->dropdownOrderStatus($dropdown,$statusid);
				$purchaseddatetime=$row['date_purchased'];
				$purchased_date_time = explode(" ",$purchaseddatetime);
				$purchased_date = explode("-",$purchased_date_time[0]);
				$purchased_time = explode(":",$purchased_date_time[1]);
				$purchaseddate=date("l, M d, Y ",mktime(0,0,0,$purchased_date[1],$purchased_date[2],$purchased_date[0]));
				if($i%2==0)
				{
					$output.='<tr   class="content_list_txt2" id="order'.$i.'"><td align="left" class="content_list_txt2"><img src="images/plus.gif" onclick="showOrderDetail('.$i.')" id="quick'.$i.'" title="Click to Quick View">'.$id.'</td><td  class="content_list_txt2"><a href="?do=customerdetail&action=detail&userid='.$customerid.'">'.$dispname.'</a></td><td  class="content_list_txt2">'.$purchaseddate.'</td><td  class="content_list_txt2"">'.$bilname.'</td><td   class="content_list_txt2">'.$shipname.'</td><td   class="content_list_txt2" align="right"><span class="badge badge-success">'.$currency_tocken.' '.''.$amount.'</span></td><td   class="content_list_txt2">'.$dropdowndata.'</td><td class="content_list_txt1"><a href="?do=disporders&action=viewdetail&id='.$id.'" title="View Order"><i class="icon icon-eye-open"></i></a>&nbsp;&nbsp;<a href="?do=disporders&action=detail&id='.$id.'"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;<a href="?do=disporders&action=cancel&id='.$id.'" onclick="return confirm(\'Are you sure you want to Cancel this Order?\')"><i class="icon-trash"></i></a>&nbsp;&nbsp;<a href="javascript:window.open (\'?do=disporders&action=print&id='.$id.'\',\'mywindow\',\'location=1,status=1,scrollbars=1,width=920,height=700\');void(0);"><i class="icon icon-print"></i> </a>&nbsp;&nbsp;<a href="?do=disporders&action=mail&id='.$id.'"><i class="icon icon-inbox"></i> </a></td><tr>';

				}
				else
				{
					$output.='<tr  class="content_list_txt1" id="order'.$i.'"><td  class="content_list_txt1" align="left"><img src="images/plus.gif" onclick="showOrderDetail('.$i.')" id="quick'.$i.'" title="Click to Quick View">'.$id.'</td><td  class="content_list_txt1"><a href="?do=customerdetail&action=detail&userid='.$customerid.'">'.$dispname.'</a></td><td  class="content_list_txt1">'.$purchaseddate.'</td><td  class="content_list_txt1"">'.$bilname.'</td><td class="content_list_txt1">'.$shipname.'</td><td class="content_list_txt1" align="right"><span class="badge badge-success">'.$currency_tocken.' '.''.$amount.'</span></td><td class="content_list_txt1">'.$dropdowndata.'</td><td class="content_list_txt1"><a href="?do=disporders&action=viewdetail&id='.$id.'"><i class="icon icon-eye-open"></i></a>&nbsp;&nbsp;<a href="?do=disporders&action=detail&id='.$id.'"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;<a href="?do=disporders&action=cancel&id='.$id.'" onclick="return confirm(\'Are you sure you want to Cancel this Order?\')"><i class="icon-trash"></i></a>&nbsp;&nbsp;<a href="javascript:window.open (\'?do=disporders&action=print&id='.$id.'\',\'mywindow\',\'location=1,status=1,scrollbars=1,width=920,height=700\');void(0);"><i class="icon icon-print"></i> </a>&nbsp;&nbsp;<a href="?do=disporders&action=mail&id='.$id.'"><i class="icon icon-inbox"></i> </a></td><tr>';

				}
				$output.='<tr class="clshiderow'.$i.' dlsrow" >
				<td colspan="8" valign="top" align="center">
				<div style="display:none;background-color:#DBF3FF;" id="orderDetail'.$i.'">'
				.Display_DOrderManagement::getOrderDesc($result[$cnt],$orderProduct).
				'</div>
				</td></tr>';				
				$i++;
				$cnt++;
			}
	       // $output.='<tr><td colspan="8" class="content_list_txt1" valign="top" align=center><!--<input type=submit value="Save">--></td></tr>';
		}
		else
		{
			$output.='<tr><td colspan="9" class="content_list_txt1" valign="top" width="100%"><div class="exc_msgbox"  width="100%" style="width:900px"> No Orders Present</div></td></tr>';
		}
		$output.='<tr>
		<td colspan="8" class="clsAlignRight">
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
		$output.='</tbody></table></div></div></form>';
		
		return $output;
	}
	
	/**
	 * Function creates a template to display the orders details 
	 * @param array $result
	 * @param array	 $cmbStr
	 * @return string
	 */
	function displayDetailOrders($result,$cmbStr,$recordsinv)
	{

		if($_GET['action']=='viewdetail')
		{
			if((count($result))>0)
			{
				foreach($result as $row)
				{
					$orders_id=$row['orders_id'];
					//$customers_id=$row['customers_id'];
					$customers_id=$row['user_display_name'];
					$shipping_name=$row['shipping_name'];
					$shipping_company=$row['shipping_company'];
					$shipping_street_address=$row['shipping_street_address'];
					$shipping_suburb=$row['shipping_suburb'];
					$shipping_city =$row['shipping_city'];
					$shipping_postcode=$row['shipping_postcode'];
					$shipping_state=$row['shipping_state'];
					$shipping_country=$row['shipping_country'];
					$billing_name =$row['billing_name'];
					$billing_company=$row['billing_company'];
					$billing_street_address=$row['billing_street_address'];
					$billing_suburb =$row['billing_suburb'];
					$billing_city=$row['billing_city'];
					$billing_postcode=$row['billing_postcode'];
					$billing_state =$row['billing_state'];
					$billing_country=$row['billing_country'];
					$payment_method=$row['payment_method'];
					$shipping_method=$row['shipping_method'];
					$coupon_code=$row['coupon_code'];
					$cc_type=$row['cc_type'];
					$cc_owner=$row['cc_owner'];
					$cc_number=$row['cc_number'];
					$cc_expires=$row['cc_expires'];
					$cc_cvv =$row['cc_cvv'];
					$date_purchased=$row['date_purchased'];
					$orders_date_closed=$row['orders_date_closed'];
					$orders_status=$row['orders_status_name'];
					$order_total=$row['order_total']; 
					$order_tax =$row['order_tax'];
					$paypal_ipn_id=$row['paypal_ipn_id'];
					$ip_address =$row['ip_address'];
					$shipment_id=$row['shipment_id_selected'];
					$shipment_trackid=$row['shipment_track_id'];
					$shipment_name=$row['shipment_name'];
					
					if($shipment_id!='1')
					{
						$shipdurationrecords=array("0"=>"Select","1D"=>"Next Day Air Early AM","1DA"=>"Next Day Ai","1DP"=>"Next Day Air Saver","2DM"=>"2nd Day Air AM","2DA"=>"2nd Day Air","3DS"=>"3 Day Select","GND"=>"Ground","STD"=>"Canada Standar","XPR"=>"Worldwide Express","XDM"=>"Worldwide Express Plus","XPD"=>"Worldwide Expedited","WXS"=>"Worldwide Save");
						foreach($shipdurationrecords as $key=>$value)	
						{
							if($key==$shipping_method)
							{		
								$ups_ship_duration=$value;
							}
						}
						$ups_ship_duration='<div class="row-fluid">
						<div class="span3">
						<label>
						Shipping Duration</label></div>  <div class="span6">'.$ups_ship_duration.'</div></div>';
					}
					
					$prcssarray=array("Pending","Processing","Delivered","AwaitingPayment","Cancel");
					
					$pur_date_time = explode(" ",$date_purchased);
					$pur_date = explode("-",$pur_date_time[0]);
					$pur_time = explode(":",$pur_date_time[1]);
					$purchasedate=date("l, M d, Y H:i:s",mktime($pur_time[0],$pur_time[1],$pur_time[2],$pur_date[1],$pur_date[2],$pur_date[0]));
					
					$orderclosed_date_time = explode(" ",$orders_date_closed);
					$orderclosed_date = explode("-",$orderclosed_date_time[0]);
					
					if($orderclosed_date_time[0]=='0000-00-00')
					{
						$ordercloseddate="";	  
					}
					else
					{
						$orderclose_time = explode(":",$orderclosed_date_time[1]);
						$ordercloseddate=date("l, M d, Y H:i:s",mktime($orderclose_time[0],$orderclose_time[1],$orderclose_time[2],$orderclosed_date[1],$orderclosed_date[2],$orderclosed_date[0]));
					}
					


					$output='
					<div class="menu_new clsBtm_20">
					<div class="row-fluid">
					<div class="span7"><h2>Order Detail </h2>
					</div>
					<div >

					<ul class="bttn_right">
					<li><a href="javascript:history.go(-1)" class="back_icon1"  ></a></li>

					</ul>

					</div>

					</div>
					</div>'.$_SESSION['errmsg'].'	

					<div class="row-fluid">
					<div class="span12">
					<h2 class="box_head green_bg">Order Detail : #'.$orders_id.'</h2>
					<div class="toggle_container">
					<div class="clsblock">
					<div class="clearfix"><div class="span6">
					<div class="row-fluid">
					<div class="span3">
					<label>Order ID</label></div>  <div class="span6">
					<input type="hidden" name="orderId" value="'.$orders_id.'">#'.$orders_id.'</div></div>
					

					<div class="row-fluid">
					<div class="span3">
					<label>Customer</label></div>  <div class="span6">'.$customers_id.'
					</div></div>
					

					<div class="row-fluid">
					<div class="span3">
					<label>Order Status</label></div>  <div class="span6"> <span class="label label-inverse">'.$orders_status.'</span></div></div>
					

					<div class="row-fluid">
					<div class="span3">
					<label>
					Order Date</label></div>  <div class="span6">'.$purchasedate.'</div></div>
					

					<div class="row-fluid">
					<div class="span3">
					<label>
					Close Date</label></div>  <div class="span6"> '.$ordercloseddate.'</div></div>


					<div class="row-fluid">
					<div class="span3">
					<label>
					Paid Through</label></div>  <div class="span6"> <span class="label">'.$row['gateway_name'].'</span></div></div>

					</div><div class="span6">
					<div class="row-fluid">
					<div class="span3">
					<label>
					Ship Through</label></div>  <div class="span6"> <span class="label label-info">'.$shipment_name.'</span></div></div>
					
					'.$ups_ship_duration.'';
					$output.='<div class="row-fluid">
					<div class="span3">
					<label>
					Shipment Track ID</label></div>  <div class="span6"> <span class="label label-important">'.$shipment_trackid.'</span></div></div>';
					$output.='</div></div></div></div></div></div><br/>';
				}
				return $output;
			}

		}
		elseif($_GET['action']=='detail')
		{
			if((count($result))>0)
			{
				foreach($result as $row)
				{
					$orders_id=$row['orders_id'];
					   //$customers_id=$row['customers_id'];
					$customers_id=$row['user_display_name'];
					$shipping_name=$row['shipping_name'];
					$shipping_company=$row['shipping_company'];
					$shipping_street_address=$row['shipping_street_address'];
					$shipping_suburb=$row['shipping_suburb'];
					$shipping_city =$row['shipping_city'];
					$shipping_postcode=$row['shipping_postcode'];
					$shipping_state=$row['shipping_state'];
					$shipping_country=$row['shipping_country'];
					$billing_name =$row['billing_name'];
					$billing_company=$row['billing_company'];
					$billing_street_address=$row['billing_street_address'];
					$billing_suburb =$row['billing_suburb'];
					$billing_city=$row['billing_city'];
					$billing_postcode=$row['billing_postcode'];
					$billing_state =$row['billing_state'];
					$billing_country=$row['billing_country'];
					$payment_method=$row['payment_method'];
					$shipping_method=$row['shipping_method'];
					$coupon_code=$row['coupon_code'];
					$cc_type=$row['cc_type'];
					$cc_owner=$row['cc_owner'];
					$cc_number=$row['cc_number'];
					$cc_expires=$row['cc_expires'];
					$cc_cvv =$row['cc_cvv'];
					$date_purchased=$row['date_purchased'];
					$orders_date_closed=$row['orders_date_closed'];
					$orders_status=$row['orders_status_name'];
					$order_total=$row['order_total']; 
					$order_tax =$row['order_tax'];						
					$paypal_ipn_id=$row['paypal_ipn_id'];
					$ip_address =$row['ip_address'];
					$shipment_id=$row['shipment_id_selected'];
					$shipment_trackid=$row['shipment_track_id'];
					$shipment_name=$row['shipment_name'];

					if($shipment_id!='1')
					{
						$shipdurationrecords=array("0"=>"Select","1D"=>"Next Day Air Early AM","1DA"=>"Next Day Ai","1DP"=>"Next Day Air Saver","2DM"=>"2nd Day Air AM","2DA"=>"2nd Day Air","3DS"=>"3 Day Select","GND"=>"Ground","STD"=>"Canada Standar","XPR"=>"Worldwide Express","XDM"=>"Worldwide Express Plus","XPD"=>"Worldwide Expedited","WXS"=>"Worldwide Save");
						foreach($shipdurationrecords as $key=>$value)	
						{
							if($key==$shipping_method)
							{		
								$ups_ship_duration=$value;
							}
						}
						$ups_ship_duration='<div class="row-fluid">
						<div class="span3">
						<label>
						Shipping Duration</label></div>  <div class="span6">'.$ups_ship_duration.'</div></div>';
					}
					
					$prcssarray=array("Pending","Processing","Delivered","AwaitingPayment","Cancel");

					$pur_date_time = explode(" ",$date_purchased);
					$pur_date = explode("-",$pur_date_time[0]);
					$pur_time = explode(":",$pur_date_time[1]);
					$purchasedate=date("l, M d, Y H:i:s",mktime($pur_time[0],$pur_time[1],$pur_time[2],$pur_date[1],$pur_date[2],$pur_date[0]));

					$orderclosed_date_time = explode(" ",$orders_date_closed);
					$orderclosed_date = explode("-",$orderclosed_date_time[0]);

					if($orderclosed_date_time[0]=='0000-00-00')
					{
						$ordercloseddate="";	  
					}
					else
					{
						$orderclose_time = explode(":",$orderclosed_date_time[1]);
						$ordercloseddate=date("l, M d, Y H:i:s",mktime($orderclose_time[0],$orderclose_time[1],$orderclose_time[2],$orderclosed_date[1],$orderclosed_date[2],$orderclosed_date[0]));
					}
					$processComboStr='<select name="processCombo" id="processCombo" >';

					for($iprc=0;$iprc<count($prcssarray);$iprc++)
					{
						$tmpStr=($prcssarray[$iprc]==trim($orders_status)) ? ' selected="selected" ':'';
						$processComboStr.='<option '.$tmpStr.' value="'.($iprc+1).'">'.$prcssarray[$iprc].'</option>';
					}
					$processComboStr.='</select>';
					
					$output='
					<div class="menu_new clsBtm_20">
					<div class="row-fluid">
					<div class="span9"><h2>Order Detail </h2>
					</div>
					<div class="span3" >

					<ul class="bttn_right">
					';
				
					if($orders_status!='Cancel')
					{
					$output.='<li><a href="javascript:void(0)" class="update_icon" id="updateOrderIcon" ></a></li>';
					}
					$output.='<li><a href="javascript:history.go(-1)" class="back_icon1"  ></a></li></ul>

					</div>
	
					</div>
					</div>
					'.$_SESSION['errmsg'].'	
					
					<div class="row-fluid">
					<div class="span12">
					<h2 class="box_head green_bg">Order Detail : #'.$orders_id.'</h2>
					<div class="toggle_container">
					<div class="clsblock">
					
					<div class="row-fluid">	
					<div class="span6">
					<div class="clearfix">


					<!-- <table align="center" border=0 width="100%"><tr>'.(isset($_GET['msg'])? '<td align="left"><div class="success_msgbox"  width="100%" style="width:915px;">'.$_GET['msg'].'</div></td>' : "" ).'</tr><tr><td style="padding-bottom:5px;" align="left" width="100%"><a href="?do=disporders">Back To Order List</a>&nbsp;<a target="_blank" href="../'.$recordsinv['invoice_path'].'"><img src="images/pdf_small.png"></a></td></tr></table> -->
					
					<form name="processFrm" method="post" id="orderDetailsupdate" action="?do=disporders&action=update">
					

					<div class="row-fluid">						
					<div class="span3">
					<label>Order ID </label></div><div class="span9"><input type="hidden" name="orderId" value="'.$orders_id.'">#'.$orders_id.'</div></div>
					<div class="row-fluid">
					<div class="span3">
					<label>Customer</label></div><div class="span9">'.$customers_id.'</div>
					</div>
					<div class="row-fluid">
					<div class="span3">
					<label>Order Status </label></div><div class="span9">'.$processComboStr.'</div>
					</div>				
					

					
					<div class="row-fluid">
					<div class="span3">
					<label>Order Date </label></div><div class="span9">'.$purchasedate.'</div>
					</div>
					<div class="row-fluid">
					<div class="span3">
					<label>Close Date </label></div><div class="span9">
					'.$ordercloseddate.'</div></div>
					<div class="row-fluid">
					<div class="span3">
					<label>
					Paid Through</label></div>  <div class="span6"> <span class="label">'.$row['gateway_name'].'</span></div></div>

					</div></div>
					<div class="span6">
	
							

					<div class="row-fluid" >
					<div class="span3">
					<label>Shipment Name </label></div>
					<div class="span6">'.$shipment_name.'

					</div><div class="span2"><a data-toggle="modal" class="edit_icon1" role="button" href="#myModal"></a></div></div>'.$ups_ship_duration.'
					<div class="row-fluid">
					<div class="span3">
					<label>
					Shipment Track ID</label></div>  <div class="span6"> '.$shipment_trackid.'</div></div>
					<div class="row-fluid">
					<div class="span3">
					<label>Order History </label></div><div class="span9">
					<textarea style="width: 209px; height: 107px;" name="orderhistory"></textarea></div>
					</div>
					</div></div>
					</form></div></div>
					</div>

					</div><div>&nbsp;</div>';
				
				}
				return $output;
			}


		}
	}
	/**
	 * Function creates a template to display the transaction details 
	 * @param array $result
	 * @return string
	 */
	function dispTransactionDetails($result)
	{

		$shippingaddress="<strong>Shipping Address</strong></br><br/>";
		if($result['shipping_name']!='')
			$shippingaddress.=$result['shipping_name'];
		if($result['shipping_company']!='')
			$shippingaddress.='<br>'.$result['shipping_company'];
		if($result['shipping_street_address']!='')
			$shippingaddress.='<br>'.	$result['shipping_street_address'];
		if($result['shipping_suburb']!='')
			$shippingaddress.='<br>'.$result['shipping_suburb'];
		if($result['shipping_city']!='')
			$shippingaddress.='<br>'.$result['shipping_city'];
		if($result['shipping_postcode']!='')
			$shippingaddress.='<br>'.$result['shipping_postcode'];
		if($result['shipping_state']!='')
			$shippingaddress.='<br>'.$result['shipping_state'];
		if($result['shipping_country']!='')
			$shippingaddress.='<br>'.$result['shipping_country'];


		$billingaddress="<strong>Billing Address</strong></br><br/>";
		if($result['billing_name']!='')
			$billingaddress.=$result['billing_name'];
		if($result['billing_company']!='')
			$billingaddress.='<br>'.$result['billing_company'];
		if($result['billing_street_address']!='')
			$billingaddress.='<br>'.	$result['billing_street_address'];
		if($result['billing_suburb']!='')
			$billingaddress.='<br>'.$result['billing_suburb'];
		if($result['billing_city']!='')
			$billingaddress.='<br>'.$result['billing_city'];
		if($result['billing_postcode']!='')
			$billingaddress.='<br>'.$result['billing_postcode'];
		if($result['billing_state']!='')
			$billingaddress.='<br>'.$result['billing_state'];
		if($result['billing_country']!='')
			$billingaddress.='<br>'.$result['billing_country'];	

		
		$output.='<table width="100%" align="center" cellspacing="0" class="content_list_bdr" id="product-attribute-specs-table">
		<tbody>';                	

		$output.=' <tr >

		<td>'.$billingaddress.'</td>


		<td>'.$shippingaddress.'</td>
		</tr>
		</tbody>
		</table>';


		return $output;
	}
	/**
	 * Function  to select the order status
	 * @param array $result
	 * @param  integer 	 $select
	 * @return string
	 */
	function dropdownOrderStatus($result,$select)
	{
		$output='';		
		if((count($result))>0)
		{
			foreach($result as $row)
			{
				$orderstatusname=$row['orders_status_name'];
				$orderstatusid=$row['orders_status_id'];			   
				if ($select==$orderstatusid)
				{

					if($orderstatusname=='Pending')
					{
						$output='<span class="badge badge-inverse">'.$orderstatusname.'</span>';
					}
					if($orderstatusname=='Processing')
					{
						$output='<span class="badge">'.$orderstatusname.'</span>';
					}
					if($orderstatusname=='Delivered')
					{
						$output='<span class="badge badge-success">'.$orderstatusname.'</span>';
					}
					if($orderstatusname=='AwaitingPayment')
					{
						$output='<span class="badge badge-info">'.$orderstatusname.'</span>';
					}
					if($orderstatusname=='Cancel')
					{
						$output='<span class="badge badge-important">'.$orderstatusname.'</span>';
					}
				}
			}				 
		}

		return $output;
	}
	
	/**
	 * Function  to get  the order description 
	 * @param array $arr
	 * @param 	array $orderProduct
	 * @return string
	 */
	function getOrderDesc($arr,$orderProduct)
	{

// 		$shippingCost=0;
// 		for($i=0;$i<count($orderProduct);$i++)
// 		{
// 			if($orderProduct[$i]['order_id']==$arr['orders_id'])
// 				$shippingCost+=$orderProduct[$i]['shipping_cost'];
// 		}
		$shippingCost=$arr['order_ship'];
		$result='<table border="0" cellpadding="0" cellspacing="0" width="90%" class="QuickViewPanel" style="padding:10px;">
		<tbody><tr>

		<td class="QuickViewPanel" valign="top" width="250"  style="border-right:#B8E6FF 2px solid" align="left">
		<span>Billing Details</span>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody><tr>
		<td class="text" valign="top" width="120">Customer Details:</td>
		<td class="text">'.
		$arr['billing_name']."<br>".$arr['billing_company']."<br>".$arr['billing_street_address'].",".$arr['billing_suburb']."<br>".$arr['billing_city'].",".$arr['billing_postcode']."<br>".$arr['billing_state']."<br>".$arr['billing_country']
		.'</td>
		</tr>
		<tr>
		<td class="text" valign="top">Date Ordered:</td>
		<td class="text">'.$arr['date_purchased'].'</td>
		</tr>

		<tr style="display: none;">
		<td class="text" valign="top">Vendor:</td>
		<td class="text"></td>

		</tr>
		<tr>
		<td class="text" valign="top">Payment Method:</td>
		<td class="text">'.$arr['gateway_name'].'</td>
		</tr>
		</tbody></table>


		</td>
		<td class="QuickViewPanel" style="padding-left: 15px; border-right:#B8E6FF 2px solid" valign="top" width="250" align="left">
		<span>Shipping Details</span>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody><tr>
		<td class="text" valign="top">Customer Details:</td>
		<td class="text">
		'.
		$arr['shipping_name']."<br>".$arr['shipping_company']."<br>".$arr['shipping_street_address'].",".$arr['shipping_suburb']."<br>".$arr['shipping_city'].",".$arr['shipping_postcode']."<br>".$arr['shipping_state'].",".$arr['shipping_country']
		.'
		</td>
		</tr>
		<tr>
		<td class="text" valign="top">Shipping Method:</td>
		<td class="text">'.$arr['shipment_name'].'</td>
		</tr>
		<tr>
		<td class="text" valign="top">Shipping Cost:</td>
		<td class="text">'.$_SESSION['currency']['currency_tocken'].number_format($shippingCost,2).'</td>

		</tr>
		<tr>
		<td class="text" valign="top">Shipping Date:</td>
		<td class="text">N/A</td>
		</tr>
		</tbody></table>
		</td>
		<td style="padding-left: 10px;" valign="top" width="250" align="left">

		<span>Order Details</span>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
		<tbody>';

		$subTotal=0;
		for($i=0;$i<count($orderProduct);$i++)
		{
			if($orderProduct[$i]['order_id']==$arr['orders_id'])
			{
				$result.='<tr>
				<td style="padding-left: 12px; padding-top: 5px;" class="QuickViewPanel" width="70%" >'.$orderProduct[$i]['product_qty'].' x <a href="?do=aprodetail&action=showprod&prodid='.$orderProduct[$i]['product_id'].'" target="_blank">'.$orderProduct[$i]['title'].'</a><br><em>'.$orderProduct[$i]['brand'].'</em></td>
				<td class="text" align="right" width="30%">'.$_SESSION['currency']['currency_tocken'].number_format($orderProduct[$i]['amt'],2).'</td>
				</tr>';
				$subTotal+=$orderProduct[$i]['amt'];
			}
		}


		$total=$subTotal+$shippingCost;	

		$result.='<tr><td colspan="2"><hr size="1" noshade="noshade"></td></tr><tr><td class="text" align="right" height="18">Sub Total:</td><td class="text" align="right">'.$_SESSION['currency']['currency_tocken'].number_format($subTotal,2).'</td></tr><tr><td class="text" align="right" height="18">Shipping:</td><td class="text" align="right">'.$_SESSION['currency']['currency_tocken'].number_format($shippingCost,2).'</td></tr><tr><td class="QuickTotal text" align="right" height="18"><div>Total:</div></td><td class="QuickTotal text" align="right"><div>'.$_SESSION['currency']['currency_tocken'].number_format($total,2).'</div></td></tr></tbody></table>

		<div style="display: none;">
		<h5 style="margin-top: 10px;">Order Comments</h5>
		<div style="margin-left: 20px;">

		</div>
		</div>
		</td>
		</tr>
		</tbody></table>';
		return $result;

	}
	/**
	 * Function  to display   the  order history  
	 * @param array $records
	 * @param 	
	 * @return string
	 */
	function displayOrderHistory($records)
	{

		$output.='  <div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th align="left">No</th>
		<th align="left">Time</th>
		<th align="left">Order History</th>

		</tr>
		</thead>
		<tbody>';
		if(count($records)>0)
		{
			for($i=0;$i<count($records);$i++) 
			{
				$output.='<tr >
				<td>'.($i+1).'</td>
				<td>'.$records[$i]['order_history_time'].'</td>
				<td>'.$records[$i]['order_history'].'</td>

				</tr>';
			}
		}
		else
		{
			$output.='<tr >
			<td colspan="3" style="padding:10px;">No Order History Found</td>



			</tr>';
		}

		$output.='</tbody></table></div></div>';
		return $output;

	}
	/**
	 * Function  to display   the  ordered product  
	 * @param array $result
	 * @param 	integer $grandtotal
	 * @return string
	 */
	function displayProductsForOrder($result,$grandtotal)
	{

		if(count($result)>0)
		{
			$output='  <div class="blocks" style="opacity: 1;">
			<div class="clsListing clearfix">	<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

			<thead class="green_bg">
			<tr>
			<th align="left" >Product Name</th>
			<th align="left" >Price</th>
			<th align="left" >Quantity</th>
			<th align="left" >Sub Total</th>
			</tr>
			</thead>
			<tbody>
			';
			$total=0;
		
			foreach($result as $row)
			{
				

				$variation='';
				//select variation size
				if(trim($row['has_variation'])!='0')
				{
					$sqlSize="SELECT * FROM  product_variation_table WHERE variation_id='".$row['variation_id']."' AND product_id='".$row['product_id']."'";
					$objSize=new Bin_Query();
					$objSize->executeQuery($sqlSize);
					$size=$objSize->records[0]['variation_name'];
					$variation='<span class="label">Size - '.''.$size.'</span>';
				}


				$title=$row['title'];
				if(strlen($title)>25)
					$title=substr($title,0,25). "..";
				$price=number_format($row['product_unit_price'],2);
				
				$quantity=$row['product_qty'];
				$shipcost=number_format($row['product_qty']*$row['shipping_cost'],2);
				$subtotal=number_format($row['product_qty']*$row['product_unit_price'],2);    			 
				$output.=' <tr >
				<td class="content_list_txt1">'.$title.' <br/>'.$variation.'</td>
				<td class="content_list_txt1" align="center"><span class="label label-info">'.$row['currency_tocken'] .$price.'</span></td>
				<td class="content_list_txt1" align="center">'.$quantity.'</td>
				
				<td class="content_list_txt1" align="center"><span class="label label-inverse">'.$row['currency_tocken'].$subtotal.'</span></td>
				</tr>';

				$total+=$row['product_qty']*$row['product_unit_price'];
			
				
			}
			$grandtotal=$row['order_total'];
			$shiptotal=$row['order_ship'];
			$output.='<tr >
			
			<td colspan="3" style="text-align:right" ><strong>SUB TOTAL :</strong></td>
			<td  align="center" style="padding-right:10px"><span class="label label-success"><strong>'.$row['currency_tocken'] .number_format($total,2).'</strong></span></td>
			</tr><tr >
			<td colspan="3" style="text-align:right" ><strong>SHIPPING COST :</strong></td>
			<td  align="center" style="padding-right:10px"><span class="label label-warning"><strong>'.$row['currency_tocken'] .number_format($shiptotal,2).'</strong></span></td>
			</tr><tr >
			<td colspan="3" style="text-align:right" ><strong>GRAND TOTAL :</strong></td>
			<td  align="center" style="padding-right:10px"><strong><span class="label label-important">'.$row['currency_tocken'] .number_format($grandtotal,2).'</strong></span></td>
			</tr>
			</tbody></table></div></div>';
			
			return $output;
		}


	}
	/**
	 * Function  to display   the  print order  
	 * @param array $arr
	 * @param array $orderProduct
	 * 	
	 * @return string
	 */
	function printOrders($arr,$orderProduct)
	{

		$printoutput='';
	
		
		$couponcode=$arr[0]['coupon_code'];	
		$order_total=$arr[0]['order_total'];			
		$shippingCost=$arr[0]['order_ship'];

		for($j=0;$j<count($orderProduct);$j++)
		{
			if($orderProduct[$j]['order_id']==$arr[0]['orders_id'])
				$shippingCost+=$orderProduct[$j]['shipping_cost'];
		}
		//Get logo
		$obj=new Bin_Query();
		$sql="select * from  admin_settings_table where  set_id='1'";	
		$obj->executeQuery($sql);

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
		$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
		$site = $protocol.$_SERVER['HTTP_HOST'].$dir;

		//Serveice check
		$site = str_replace("/service","",$site);
		$site=explode('admin',$site);

		$logo_path = $site[0].'/'.$obj->records[0]['site_logo'].'';
		$sitename=$obj->records[0]['site_moto'];

		$logo 	= '<a href="'.$site.'"><img src="'.$logo_path.'" alt='.$sitename.' style="border:0;" /></a>';	

		
		$printoutput.='<link rel="stylesheet" href="css/zs_cart_printorder.css" type="text/css">';

		for($i=0; $i<count($arr);$i++)
		{
			$printoutput.='<table class="MainTable" width="100%" cellspacing="5" cellpadding="5">
			<tr>
			<td colspan="2" >'.$logo.'</td>
			</tr>
			<tr>
			<td colspan="2" class="InvoiceTitle">Order #'.$arr[$i]['orders_id'].'</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading2">Order Status : '.$arr[$i]['orders_status_name'].'</td>
			</tr>';
			

			$printoutput.='<tr>
			<td colspan="2" class="Heading2">Payment Method : '.$arr[$i]['gateway_name'].' <br>(Cheque Details:'.$arr[$i]['transaction_id'].')</td>
			</tr>';
			

			if($couponcode!='')
			{	
				$printoutput.='<tr>
				<td colspan="2" class="Heading2">Coupon Code : '.$couponcode.'</td>
				</tr>';		
			}
			
			$printoutput.='<tr>
			<td colspan="2" class="Heading2">Date Ordered : '.$arr[$i]['date_purchased'].'</td>
			</tr>
			<tr>
			<td colspan="2"  class="Heading3">
			Customer Details
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<strong>'.ucwords($arr[$i]['Name']).'</strong><br />
			<span style="width: 55px; float:left;">Email:</span> '.$arr[$i]['user_email'].'<br />	</td>
			</tr>';

			
			$printoutput.='<tr>
			<td width="50%" class="Heading3">
			Delivery Details
			</td><tr>
			<td width="50%" class="Heading3">
			Billing Address
			</td>
			<td width="50%" class="Heading3">
			Shipping Address
			</td>
			</tr>
			<tr>
			<td width="50%" valign="top">'.$arr[$i]['billing_name'].'<br />
			'.$arr[$i]['billing_company'].'<br />
			'.$arr[$i]['billing_street_address'].'<br /> <br/>'.$arr[$i]['billing_suburb'].'<br />'.$arr[$i]['billing_city'].'<br /> '.$arr[$i]['billing_postcode'].'<br />
			'.$arr[$i]['billing_state'].' <br />'.$arr[$i]['billing_country'].'	
			</td>
			<td width="50%" valign="top">'.$arr[$i]['shipping_name'].'<br />
			'.$arr[$i]['shipping_company'].' <br/> '.$arr[$i]['shipping_street_address'].'<br /> <br/>'.$arr[$i]['shipping_suburb'].'<br />'.$arr[$i]['shipping_city'].'<br />'.$arr[$i]['shipping_postcode'].'<br />'.$arr[$i]['shipping_state'].'<br />      '.$arr[$i]['shipping_country'].'
			</td>
			</tr>
			<tr>
			
			<td width="50%" valign="top">
			<table cellspacing="0" cellpadding="0">
			<tr>
			<td style="padding-bottom: 3px; padding-right: 10px; font-weight: bold;">&nbsp;</td>
			<td style="padding-bottom: 3px;">&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3">
			<hr size="1" noshade>Order Items
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<table width="95%" border="0" align="right">
			<tr>

			<td class="Heading2">Product Name</td>
			<td class="Heading2">Quantity</td>
			<td class="Heading2">Unit Price</td>
			<td class="Heading2">Total</td>
			</tr>';


			$subTotal=0;
			
			for($j=0;$j<count($orderProduct);$j++)
			{
				if($orderProduct[$j]['order_id']==$arr[0]['orders_id'])
				{

					$printoutput.='<tr>						
					<td valign="top">'.$orderProduct[$j]['title'].'</td>';
					$ordertotal+=($orderProduct[$j]['product_qty']*$orderProduct[$j]['product_unit_price']);					

					$printoutput.='<td valign="top">'.$orderProduct[$j]['product_qty'].'</td>


					<td valign="top">'.$orderProduct[$j]['product_unit_price'].'</td>
					
					<td valign="top">'.$ordertotal.'</td>';				
					$printoutput.='</tr>';

					$subTotal=$ordertotal+$subtotal;
				}
			}

			$total=$order_total;	


			$printoutput.='
			</table>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3">
			<hr size="1" noshade>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3" align="right">
			<table width="300">
			<tr>
			<td align="right" style="padding-right:10px">Sub Total:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($subTotal,2).'</td>
			</tr>
			
			<tr>
			<td align="right" style="padding-right:10px">Shipping Cost:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($shippingCost,2).'</td>
			</tr>
			<tr>
			<td align="right" style="padding-right:10px">Tax:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($tax,2).'</td>
			</tr>				
			<tr>
			<td align="right" style="padding-right:10px"><strong>Total:</strong></td>
			<td><strong>'.$arr[0]['currency_tocken'].number_format($total,2).'</strong></td>
			</tr>			
			</table>
			</td>
			</tr>			
			<tr style="display: none">
			<td colspan="2">
			<blockquote></blockquote>
			</td>
			</tr>
			</table>';						
		}	
		
		$printoutput.='<p class="PageBreak">&nbsp;</p><script type="text/javascript">window.setTimeout("window.print();", 1000);</script>';	
		
		echo $printoutput;	
	}
	/**
	 * Function  to display   the  email order  
	 * @param array $arr
	 * @param array $orderProduct
	 * 	
	 * @return string
	 */
	function emailOrders($arr,$orderProduct)
	{

		$emailcontent='';
		
		$couponcode=$arr[0]['coupon_code'];	
		$order_total=$arr[0]['order_total'];			
		$shippingCost=$arr[0]['order_ship'];			
		
		for($j=0;$j<count($orderProduct);$j++)
		{
			if($orderProduct[$j]['order_id']==$arr[0]['orders_id'])
				$shippingCost+=$orderProduct[$j]['shipping_cost'];
		}
		//Get logo
		$obj=new Bin_Query();
		$sql="select * from  admin_settings_table where  set_id='1'";	
		$obj->executeQuery($sql);

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
		$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
		$site = $protocol.$_SERVER['HTTP_HOST'].$dir;

		//Serveice check
		$site = str_replace("/service","",$site);
		$site=explode('admin',$site);

		$logo_path = $site[0].'/'.$obj->records[0]['site_logo'].'';
		$site_moto=$obj->records[0]['site_moto'];

		$logo 	= '<a href="'.$site.'"><img src="'.$logo_path.'" alt='.$site_moto.' style="border:0;" /></a>';	

		

		for($i=0; $i<count($arr);$i++)
		{
			$emailcontent.='<table class="MainTable" width="100%" cellspacing="5" cellpadding="5">
			<tr>
			<td colspan="2" >'.$logo.'</td>
			</tr>
			<tr>
			<td colspan="2" class="InvoiceTitle">Order #'.$arr[$i]['orders_id'].'</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading2">Order Status : '.$arr[$i]['orders_status_name'].'</td>
			</tr>';
			

			$emailcontent.='<tr>
			<td colspan="2" class="Heading2">Payment Method : '.$arr[$i]['gateway_name'].' <br>(Cheque Details:'.$arr[$i]['transaction_id'].')</td>
			</tr>';
			

			if($couponcode!='')
			{	
				$printoutput.='<tr>
				<td colspan="2" class="Heading2">Coupon Code : '.$couponcode.'</td>
				</tr>';		
			}
			
			$emailcontent.='<tr>
			<td colspan="2" class="Heading2">Date Ordered : '.$arr[$i]['date_purchased'].'</td>
			</tr>
			<tr>
			<td colspan="2"  class="Heading3">
			Customer Details
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<strong>'.ucwords($arr[$i]['Name']).'</strong><br />
			<span style="width: 55px; float:left;">Email:</span> '.$arr[$i]['user_email'].'<br />	</td>
			</tr>';

			
			$emailcontent.='<tr>
			<td width="50%" class="Heading3">
			Delivery Details
			</td><tr>
			<td width="50%" class="Heading3">
			Billing Address
			</td>
			<td width="50%" class="Heading3">
			Shipping Address
			</td>
			</tr>
			<tr>
			<td width="50%" valign="top">'.$arr[$i]['billing_name'].'<br />
			'.$arr[$i]['billing_company'].'<br />
			'.$arr[$i]['billing_street_address'].'<br /> <br/>'.$arr[$i]['billing_suburb'].'<br />'.$arr[$i]['billing_city'].'<br /> '.$arr[$i]['billing_postcode'].'<br />
			'.$arr[$i]['billing_state'].' <br />'.$arr[$i]['billing_country'].'	
			</td>
			<td width="50%" valign="top">'.$arr[$i]['shipping_name'].'<br />
			'.$arr[$i]['shipping_company'].' <br/> '.$arr[$i]['shipping_street_address'].'<br /> <br/>'.$arr[$i]['shipping_suburb'].'<br />'.$arr[$i]['shipping_city'].'<br />'.$arr[$i]['shipping_postcode'].'<br />'.$arr[$i]['shipping_state'].'<br />      '.$arr[$i]['shipping_country'].'
			</td>
			</tr>
			<tr>
			
			<td width="50%" valign="top">
			<table cellspacing="0" cellpadding="0">
			<tr>
			<td style="padding-bottom: 3px; padding-right: 10px; font-weight: bold;">&nbsp;</td>
			<td style="padding-bottom: 3px;">&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3">
			<hr size="1" noshade>Order Items
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<table width="95%" border="0" align="right">
			<tr>

			<td class="Heading2">Product Name</td>
			<td class="Heading2">Quantity</td>
			<td class="Heading2">Unit Price</td>
			<td class="Heading2">Total</td>
			</tr>';


			$subTotal=0;
			
			for($j=0;$j<count($orderProduct);$j++)
			{
				if($orderProduct[$j]['order_id']==$arr[0]['orders_id'])
				{

					$emailcontent.='<tr>						
					<td valign="top">'.$orderProduct[$j]['title'].'</td>';
					$ordertotal+=($orderProduct[$j]['product_qty']*$orderProduct[$j]['product_unit_price']);					

					$emailcontent.='<td valign="top">'.$orderProduct[$j]['product_qty'].'</td>


					<td valign="top">'.$orderProduct[$j]['product_unit_price'].'</td>
					
					<td valign="top">'.$ordertotal.'</td>';				
					$emailcontent.='</tr>';

					$subTotal=$ordertotal+$subtotal;
				}
			}

			$total=$order_total;	


			$emailcontent.='</table>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3">
			<hr size="1" noshade>
			</td>
			</tr>
			<tr>
			<td colspan="2" class="Heading3" align="right">
			<table width="300">
			<tr>
			<td align="right" style="padding-right:10px">Sub Total:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($subTotal,2).'</td>
			</tr>
			
			<tr>
			<td align="right" style="padding-right:10px">Shipping Cost:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($shippingCost,2).'</td>
			</tr>
			<tr>
			<td align="right" style="padding-right:10px">Tax:</td>
			<td>'.$arr[0]['currency_tocken'].number_format($tax,2).'</td>
			</tr>				
			<tr>
			<td align="right" style="padding-right:10px"><strong>Total:</strong></td>
			<td><strong>'.$arr[0]['currency_tocken'].number_format($total,2).'</strong></td>
			</tr>			
			</table>
			</td>
			</tr>			
			<tr style="display: none">
			<td colspan="2">
			<blockquote></blockquote>
			</td>
			</tr>
			</table>';						
		}	
		

		return $emailcontent;
	}	

	function showChangeShipping($records,$shipment_id,$buyer_zipcode,$totalweight,$totalshipcost,$shipping_method,$shipment_track_id,$order_ship,$order_total)
	{


		if($shipment_id=='1')
		{
			$default="class=show";
		}
		else
		{
			$default="class=hide";
		}
		if($shipment_id=='2')
		{
			$ups="class=show";
		}
		else
		{
			$ups="class=hide";
		}
		$output='<div class="row-fluid">
			<div class="span3"><label>
			Shipping Method<label></div>  <div class="span6">';
			$output.='<select name="shipment_id" id="shipment_id" onchange="selectShippingType(this.value);" >';
			for($i=0;$i<count($records);$i++)
			{
				$tmpStr2=($records[$i]['shipment_id']==$shipment_id) ? ' selected="selected" ':'';
				$output.='<option '.$tmpStr2.' value="'.$records[$i]['shipment_id'].'">'.$records[$i]['shipment_name'].'</option>';
	
			}
			$output.='</select></div></div>';

		$shipdurationrecords=array("0"=>"Select","1D"=>"Next Day Air Early AM","1DA"=>"Next Day Ai","1DP"=>"Next Day Air Saver","2DM"=>"2nd Day Air AM","2DA"=>"2nd Day Air","3DS"=>"3 Day Select","GND"=>"Ground","STD"=>"Canada Standar","XPR"=>"Worldwide Express","XDM"=>"Worldwide Express Plus","XPD"=>"Worldwide Expedited","WXS"=>"Worldwide Save");

		$output.='<div id="duration_ups" '.$ups.'><div class="row-fluid">
		<div class="span3"><label>
		Shipping Duration<label></div>  <div class="span6">';
		$output.='<select name="shipdurid" id="shipdurid" onchange="shipDuration(this.value,'.$buyer_zipcode.','.$totalweight.');" >';
		foreach($shipdurationrecords as $key=>$vale)
		{
				
			if($shipping_method==$key)
			{
				$selected="selected='selected'";	
			}
			else
			{
				$selected="";
			}
			$output.='<option value='.$key.' '.$selected.'>'.$vale.'</option>';
		}
		$output.='</select>

		</div></div><div></div>';

			$output.='<div id="ship_cost" '.$ups.'><div class="control-group" >
					<label class="control-label" for="input01">Total Weight</label>
					<div class="controls">

					'.$totalweight.' <code>(lbs)</code>
					</div>
					</div><div class="control-group" >
					<label class="control-label" for="input01">Shipping Cost</label>
					<div class="controls"><font color="red" >'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.'<span id="var_ship">'.$order_ship.'</span></font>
					</div>
					</div></div></div>';

				$output.='<div id="default_ship_cost"  '.$default.'><div class="control-group" >
					<label class="control-label" for="input01">Shipping Cost</label>
					<div class="controls"><font color="red">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].''.''.$totalshipcost.'</font>
					</div>
					</div></div></div></div>';

			$output.='<div class="control-group" >
					<label class="control-label" for="input01">Track ID</label>
					<div class="controls"><input type="text" name="shipment_track_id" id="shipment_track_id" value='.$shipment_track_id.'>
					</div>
					</div></div></div></div>';	

		     $output.='<input type="hidden" name="default_shipping_cost" id="default_shipping_cost" value='.$totalshipcost.'><input type="hidden" name="order_total" id="order_total" value='.$order_total.'><input type="hidden" name="shipping_cost" id="shipping_cost" value='.$order_ship.'><input type="hidden" name="weight" value="'.$totalweight.'">';
		return $output;
	}
}
?>


