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

/**
 * DOrderManagement
 *
 * This class contains functions to list out the order details available.
 *
 * @package		Display_DOrderManagement
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Display_DOrderManagement
{
 	
	/**
	 * Function creates a template to display the orders available. 
	 * @param array $result
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	
	 * @param array $dropupdatedata
	 * @param integer $dropdown
	 * @return string
	 */
	
	
	function dispOrders($result,$paging,$prev,$next,$dropdown,$dropupdatedata)
	{
      $obj=new 	Display_DOrderManagement();
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
		
		
		
//	   print_r($paging);	   print_r($prev);	   print_r($next);exit;
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
  <script type="text/javascript">
            Calendar.setup({
              inputField    : "txtfromdate",
              button        : "cal-button-1",
              align         : "Tr"
            });
          </script><script type="text/javascript">
            Calendar.setup({
              inputField    : "txttodate",
              button        : "cal-button-2",
              align         : "Tr"
            });
          </script><td  valign=top><input type="text" name="billname" id="billname"  value="'.$_POST['billname'].'"/></td>
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
</tr>
';
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
	        $output.='<tr><td colspan="7" class="content_list_txt1" valign="top" align=center><input type=submit value="Save"></td></tr>';
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
	
	
	
	
	
	function displayOrders($result,$paging,$prev,$next,$dropdown,$dropupdatedata,$orderProduct)
	{
       $obj=new Display_DOrderManagement();
       $orderst=array('','Pending','Processing','Delivered','AwaitingPayment');
	   $orderstatuslist='<select name="selorderstatus" style="width:70px;"><option value="" >All</option>';
				for($i=1;$i<5;$i++)
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
		
		
		
//	   print_r($paging);	   print_r($prev);	   print_r($next);exit;
	    $output='<form name="frmorders" method="post"><table cellspacing="0" border="0" width="100%" class="content_list_bdr" align="center">
		<!--<tr >
		<td colspan=8 align=right valign=top><input type="hidden" name="selection" value="search" /><input type="button" value="Search"  class="all_bttn" onclick="document.frmorders.selection.value=\'Update\';/* document.frmorders.action=\'?do=disporders\'; */document.frmorders.submit(); "/></td>
		</tr>
		<tr><td colspan="2" align=left  valign=top><a href="#" onclick="return selDeSel(\'sel\');">Select</a>/<a href="#" onclick="return selUnDeSel(\'sel\');"> Unselect All</a> </td> <td>&nbsp;</td>
		<td colspan="2"  valign=top> Change order status to</td><td>'.$updrop.'</td>
	<td colspan=2 align=right  valign=top><input type="hidden" name="selection" value="Update" /><input type="button"  class="all_bttn" value="Update" 
	onclick="document.frmorders.selection.value=\'Update\'; document.frmorders.action=\'?do=disporders&action=update\'; document.frmorders.submit(); " /></td>
		</tr>-->'.(isset($_GET['msg'])? '<div align="center" style="padding:3px;"><font color="green"><b>'.$_GET['msg'].'</b></font></span>' : "" ).'
		
		<tr><td  class="content_list_head">Order Id</td><td  class="content_list_head">Name</td><td  class="content_list_head">Order Date</td><td  class="content_list_head" >Bill Name</td><td  class="content_list_head">Ship Name</td><td  class="content_list_head">Order total ('.$_SESSION['currency']['currency_tocken'].')</td><td  class="content_list_head">Status</td></tr><tr><td colspan="8" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td></tr>
		
		<tr class="list_search_bg">
  
  <td  valign=top><input type="text" name="orderid" id="orderid" size=10  value="'.$_POST['orderid'].'" /></td>
  <td  valign=top><input type="text" name="dispname" id="dispname" value="'.$_POST['dispname'].'"/></td>
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
  <script type="text/javascript">
            Calendar.setup({
              inputField    : "txtfromdate",
              button        : "cal-button-1",
              align         : "Tr"
            });
          </script><script type="text/javascript">
            Calendar.setup({
              inputField    : "txttodate",
              button        : "cal-button-2",
              align         : "Tr"
            });
          </script><td  valign=top><input type="text" name="billname" id="billname"  value="'.$_POST['billname'].'"/></td>
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
  <td  valign=top ><table border=0><tr><td>'.$orderstatuslist.'</td></tr><tr><td align="center"><input type="submit" value="Search"  class="all_bttn" onclick="document.frmorders.selection.value=\'Update\';/* document.frmorders.action=\'?do=disporders\'; */document.frmorders.submit(); " /></td></tr></table></td>
</tr>
';
		$i=1;
		$cnt=0;
		if((count($result))>0)
		{
		    
			foreach($result as $row)
			{
			    $id= $row['orders_id'];
			    $dispname= $row['Name'];
			   
			    $bilname = $row['billing_name'];
			    $shipname= $row['shipping_name'];
			  	$status  = $row['orders_status_name'];
				$statusid=$row['orders_status_id'];
				
			    $amount=$row['order_total'];
			    $dropdowndata=$obj->dropdownOrderStatus($dropdown,$statusid);
			    $purchaseddatetime=$row['date_purchased'];
			    $purchased_date_time = explode(" ",$purchaseddatetime);
			    $purchased_date = explode("-",$purchased_date_time[0]);
			    $purchased_time = explode(":",$purchased_date_time[1]);
			    $purchaseddate=date("l, M d, Y ",mktime(0,0,0,$purchased_date[1],$purchased_date[2],$purchased_date[0]));
				if($i%2==0)
				{
						$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"  class="content_list_txt2" id="order'.$i.'"><td align="left" class="content_list_txt2"><img src="images/plus.gif" onclick="showOrderDetail('.$i.')" id="quick'.$i.'" title="Click to Quick View">'.$id.'</td><td  class="content_list_txt2"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt2">'.$purchaseddate.'</td><td  class="content_list_txt2"">'.$bilname.'</td><td   class="content_list_txt2">'.$shipname.'</td><td   class="content_list_txt2" align="right">'.$amount.'</td><td   class="content_list_txt2">'.$dropdowndata.'</td><tr>';
						
				}
				else
				{
						$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);" class="content_list_txt1" id="order'.$i.'"><td  class="content_list_txt1" align="left"><img src="images/plus.gif" onclick="showOrderDetail('.$i.')" id="quick'.$i.'" title="Click to Quick View">'.$id.'</td><td  class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt1">'.$purchaseddate.'</td><td  class="content_list_txt1"">'.$bilname.'</td><td class="content_list_txt1">'.$shipname.'</td><td class="content_list_txt1" align="right">'.$amount.'</td><td class="content_list_txt1">'.$dropdowndata.'</td><tr>';
						
				}
	        $output.='<tr>
			<td colspan="7" valign="top" align=center class="">
			<div style="display:none;background-color:#DBF3FF;" id="orderDetail'.$i.'">'
			.Display_DOrderManagement::getOrderDesc($result[$cnt],$orderProduct).
			'</div>
			</td></tr>';				
				$i++;
				$cnt++;
		   }
	        $output.='<tr><td colspan="8" class="content_list_txt1" valign="top" align=center><!--<input type=submit value="Save">--></td></tr>';
		  }
		   else
		   {
		        $output.='<tr><td colspan="9" class="content_list_txt1" valign="top" width="100%"><div class="exc_msgbox"  width="100%" style="width:900px"> No Orders Present</div></td></tr>';
		   }
		   $output.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next.'</td><!--</tr></table>-->';
			$output.='</table></form>';
		
		return $output;
	}
	
	
	function dispDetailOrders($result)
	{
	  if((count($result))>0)
		{
		    foreach($result as $row)
			{
					  $orders_id=$row['orders_id'];
//					  $customers_id=$row['customers_id'];
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
					  
					$output='<table width="100%" align="center" cellspacing="0" class="content_list_bdr" id="product-attribute-specs-table2">
              <tbody>

                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td  align="right" class="content_list_title">Order ID :</td>
                  <td  class="content_list_txt2">#'.$orders_id.'</td>
                </tr>

                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td align="right" class="content_list_title">Customer</td>
                  <td class="content_list_txt2">'.$customers_id.'</td>
                </tr>
                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td align="right" class="content_list_title">Order Status :</td>
                  <td class="content_list_txt1">'.$orders_status.'</td>
                </tr>
                <tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                  <td align="right" class="content_list_title">Order Date :</td>
                  <td class="content_list_txt1">'.$date_purchased.'</td>
                </tr>
                <tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                  <td align="right" class="content_list_title">Close Date :</td>
                  <td class="content_list_txt1">'.$orders_date_closed.'</td>
                </tr>
              </tbody>
            </table>';
					
			}
			return $output;
		}
	}
	
	function displayDetailOrders($result,$cmbStr)
	{
	  if((count($result))>0)
		{
		    foreach($result as $row)
			{
					  $orders_id=$row['orders_id'];
//					  $customers_id=$row['customers_id'];
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
					  
					  //$prcssarray=array("Pending","Processing","Delivered","AwaitingPayment","AwaitingFulfillment","AwaitingShipment","AwaitingPickup","Completed","Shipped","Cancelled");
					  $prcssarray=array("Pending","Processing","Delivered","AwaitingPayment");
					  
					  $pur_date_time = explode(" ",$date_purchased);
					  $pur_date = explode("-",$pur_date_time[0]);
					  $pur_time = explode(":",$pur_date_time[1]);
					  $purchasedate=date("l, M d, Y H:i:s",mktime($pur_time[0],$pur_time[1],$pur_time[2],$pur_date[1],$pur_date[2],$pur_date[0]));
					  
					  $orderclosed_date_time = explode(" ",$orders_date_closed);
					  $orderclosed_date = explode("-",$orderclosed_date_time[0]);
					 // echo $orderclosed_date_time[0];
					  if($orderclosed_date_time[0]=='0000-00-00')
					  {
						   $ordercloseddate="";	  
					  }
					  else
					  {
						  $orderclose_time = explode(":",$orderclosed_date_time[1]);
						  $ordercloseddate=date("l, M d, Y H:i:s",mktime($orderclose_time[0],$orderclose_time[1],$orderclose_time[2],$orderclosed_date[1],$orderclosed_date[2],$orderclosed_date[0]));
					  }
					  $processComboStr='<select name="processCombo" id="processCombo" onchange="javascript: if (this.value==\'2\') document.getElementById(\'shipmentStatus\').style.display=\'\' ; else document.getElementById(\'shipmentStatus\').style.display=\'none\';">';
					  
					  for($iprc=0;$iprc<count($prcssarray);$iprc++)
					  {
					  	$tmpStr=($prcssarray[$iprc]==$orders_status) ? ' selected="selected" ':'';
					  	$processComboStr.='<option '.$tmpStr.' value="'.($iprc+1).'">'.$prcssarray[$iprc].'</option>';
					  }
					  $processComboStr.='</select>';
					  
					 
					  $selShipmentsComboStr='<select name="shipmentsCombo" id="shipmentsCombo">';
					  for($ssi=0;$ssi<count($cmbStr);$ssi++)
					  {
					  		$tmpStr2=($cmbStr[$ssi]['shipment_id']==$shipment_id) ? ' selected="selected" ':'';
							$selShipmentsComboStr.='<option '.$tmpStr2.' value="'.$cmbStr[$ssi]['shipment_id'].'">'.$cmbStr[$ssi]['shipment_name'].'</option>';
					  }
					  $selShipmentsComboStr.='</select>';
					  
					$tmpStr1= ($orders_status!='Processing') ? ' display: none " ':'';
					$output='<table cellpadding=0 cellspacing=0 border=0 width="100%"> <tr> 
					      <td align="left" class="content_title">Order Detail : #'.$orders_id.'</td>
						  </tr>
						   <tr><td align="left">&nbsp;</td></tr>
					<table align="center" border=0 width="100%"><tr>'.(isset($_GET['msg'])? '<td align="left"><div class="success_msgbox"  width="100%" style="width:915px;">'.$_GET['msg'].'</div></td>' : "" ).'</tr><tr><td style="padding-bottom:5px;" align="left" width="100%"><a href="?do=disporders">Back To Order List</a></td></tr></table><form name="processFrm" method="post" action="?do=disporders&action=update"><table width="100%" align="center" cellspacing="0" class="content_list_bdr" border=0 id="product-attribute-specs-table2">
              <tbody>
				
                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td  align="left" class="content_list_title" width="25%" >Order ID </td>
                  <td  class="content_list_txt2"><input type="hidden" name="orderId" value="'.$orders_id.'">#'.$orders_id.'</td>
                </tr>

                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td align="left" class="content_list_title">Customer</td>
                  <td class="content_list_txt2">'.$customers_id.'</td>
                </tr>
                <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                  <td align="left" class="content_list_title">Order Status </td>
                  <td class="content_list_txt1">'.$processComboStr.'</td>
                </tr>
				
				<tr style="'.$tmpStr1.'; background-color:#FFFFFF;" onmouseout="listbg(this, 0); " onmouseover="listbg(this, 1);" id="shipmentStatus">
                  <td align="left" class="content_list_title" >Shipment Name & Track Id </td>
                  <td class="content_list_txt1">'.$selShipmentsComboStr.'
				  		<input type="text" name="shippmentId" id="shippmentId"  value="'.$shipment_trackid.'"/>
						<!--<input type="submit" value="Submit"  class="all_bttn" />-->
				  </td>
                </tr>
				
				
                <tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                  <td align="left" class="content_list_title">Order Date </td>
                  <td class="content_list_txt1">'.$purchasedate.'</td>
                </tr>
                <tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                  <td align="left" class="content_list_title">Close Date </td>
                  <td class="content_list_txt1">'.$ordercloseddate.'</td>
                </tr>
				
				<tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                 <td></td> <td align="left" class="content_list_title" colspan="2"><input type="submit" value="Submit"  class="all_bttn" /></td>
                </tr>
				
              </tbody>
            </table><form>';
					//$output='<table width="100%" border="0" cellpadding="4" cellspacing="0"><tr><td class="content_list_txt2"  colspan="2"><h2><strong>Order Details</strong> </h2></td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2"  ><strong>Order Section</strong></td><td class="content_list_txt2"  >&nbsp;</td></tr><tr><td class="content_list_txt2"  >Order Id </td><td class="content_list_txt2"  >'.$orders_id.'</td></tr><tr><td class="content_list_txt2"  >Customers Name </td><td class="content_list_txt2"  >'.$customers_id.'</td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2"  ><strong>Shipping Section </strong></td><td class="content_list_txt2"  >&nbsp;</td></tr><tr><td class="content_list_txt2"  >Shipping Name</td><td class="content_list_txt2"  >'.$shipping_name.'</td></tr><tr><td class="content_list_txt2"  >Shipping_company</td><td class="content_list_txt2"  >'.$shipping_company.'</td></tr><tr><td class="content_list_txt2"  >Shipping_street_address</td><td class="content_list_txt2"  >'.$shipping_street_address.'</td></tr><tr>    <td class="content_list_txt2"  >Shipping_suburb</td><td class="content_list_txt2"  >'.$shipping_suburb.'</td></tr><tr><td class="content_list_txt2"  >Shipping_city</td><td class="content_list_txt2"  >'.$shipping_city.'</td></tr><tr><td class="content_list_txt2"  >Shipping_postcode</td><td class="content_list_txt2"  >'.$shipping_postcode.'</td></tr><tr><td class="content_list_txt2"  >Shipping_state</td><td class="content_list_txt2"  >'.$shipping_state.'</td></tr><tr><td class="content_list_txt2"  >Shipping_country</td><td class="content_list_txt2"  >'.$shipping_country.'</td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2"  ><strong>Billing Section </strong></td><td class="content_list_txt2"  >&nbsp;</td></tr><tr><td class="content_list_txt2"  >Billing_name</td><td class="content_list_txt2"  >'.$billing_name.'</td></tr><tr><td class="content_list_txt2"  >Billing_company</td><td class="content_list_txt2"  >'.$billing_company.'</td></tr><tr><td class="content_list_txt2"  >Billing_street_address</td><td class="content_list_txt2"  >'.$billing_street_address.'</td></tr><tr><td class="content_list_txt2"  >Billing_suburb</td><td class="content_list_txt2"  >'.$billing_suburb.'</td></tr><tr><td class="content_list_txt2"  >Billing_city</td><td class="content_list_txt2"  >'.$billing_city.'</td></tr><tr><td class="content_list_txt2"  >Billing_postcode</td><td class="content_list_txt2"  >'.$billing_postcode.'</td></tr><tr><td class="content_list_txt2"  >Billing_state</td><td class="content_list_txt2"  >'.$billing_state.'</td></tr><tr><td class="content_list_txt2"  >Billing_country</td><td class="content_list_txt2"  >'.$billing_country.'</td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2"  ><strong>Credit Card Section </strong></td><td class="content_list_txt2"  >&nbsp;</td></tr><tr><td class="content_list_txt2"  >Credit Card Type</td><td class="content_list_txt2"  >'.$cc_type.'</td></tr><tr><td class="content_list_txt2"  >Credit Card Owner</td><td class="content_list_txt2"  >'.$cc_owner.'</td></tr><tr><td class="content_list_txt2"  >Credit Card Number</td><td class="content_list_txt2"  >'.$cc_number.'</td></tr><tr><td class="content_list_txt2"  >Credit Card Expires</td><td class="content_list_txt2"  >'.$cc_expires.'</td></tr><tr><td class="content_list_txt2"  >Credit Card CVV</td><td class="content_list_txt2"  >'.$cc_cvv.'</td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2"  >Payment Method</td><td class="content_list_txt2"  >'.$payment_method.'</td></tr><tr><td class="content_list_txt2"  >Shipping Method</td><td class="content_list_txt2"  >'.$shipping_method.'</td></tr><tr><td class="content_list_txt2"  >Coupon Code</td><td class="content_list_txt2"  >'.$coupon_code.'</td></tr><tr><td class="content_list_txt2"  >Date Purchased</td><td class="content_list_txt2"  >'.$date_purchased.'</td></tr><tr><td class="content_list_txt2"  >Orders Date Closed</td><td class="content_list_txt2"  >'.$orders_date_closed.'</td></tr><tr><td class="content_list_txt2"  >Orders Status</td><td class="content_list_txt2"  >'.$orders_status.'</td></tr><tr><td class="content_list_txt2"  >Order Total</td><td class="content_list_txt2"  >'.$order_total.'</td></tr><tr><td class="content_list_txt2"  >Order Tax</td><td class="content_list_txt2"  >'.$order_tax.'</td></tr><tr><td class="content_list_txt2"  >Paypal IPN Id</td><td class="content_list_txt2"  >'.$paypal_ipn_id.'</td></tr><tr><td class="content_list_txt2"  >IP Address</td><td class="content_list_txt2"  >'.$ip_address.'</td></tr><tr><td class="content_list_txt2"  colspan="2"><hr/></td></tr><tr><td class="content_list_txt2" ></td><td class="content_list_txt2" ><a href="#" onclick="javascript:history.back();">Back</a></td></tr></table>';
			}
			return $output;
		}
	}
	
	function dispTransactionDetails($result)
	{
		//echo "<pre>";
		//print_r($result);
	     
		if($result['shipping_name']!='')
			 $shippingaddress=$result['shipping_name'];
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

	    if($result['billing_name']!='')
			 $billingaddress=$result['billing_name'];
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
                <tbody>
                  <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                    <td width="13%" align="left" class="content_list_title">Paid Through </td>
                    <td width="77%" class="content_list_txt2">'.$result['gateway_name'].'</td>
                  </tr>
                  <!--<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                    <td align="left" class="content_list_title">Transaction ID </td>
                    <td class="content_list_txt2">14098494194</td>
                  </tr>-->
                  <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
						<td align="left" class="content_list_title" valign=top>Billing Address </td>
                    <td class="content_list_txt1">'.$billingaddress.'</td>
                  </tr>
                  <tr style="background-color:#FFFFFF;" onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);">
                    <td align="left" class="content_list_title" valign=top>Shipping Address </td>
                    <td class="content_list_txt1">'.$shippingaddress.'</td>
                  </tr>
                </tbody>
            </table>';
			return $output;
	}
	
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
			   		$output=$orderstatusname;
			 }				 
		}

		return $output;
	}
	
	function updateDropDownOrderStatus($result)
	{
		
	
	}
	
	function getOrderDesc($arr,$orderProduct)
	{
	//print_r($arr);
	$shippingCost=0;
	for($i=0;$i<count($orderProduct);$i++)
	{
		if($orderProduct[$i]['order_id']==$arr['orders_id'])
		$shippingCost+=$orderProduct[$i]['shipping_cost'];
	}
	
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
	
	function displayProductsForOrder($result,$grandtotal)
	{

	   
	    if(count($result)>0)
		{
		     $output='<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr"> <tr>
                <td  class="content_list_head" >Product Name</td>
                <td  class="content_list_head" align="center">Price</td>
                <td  class="content_list_head" align="center">Quantity</td>
                <td  class="content_list_head" align="center">Shipping Charge</td>
                <td  class="content_list_head" align="center">Sub Total</td>
              </tr>
			  <tr>
                <td colspan="5" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		     foreach($result as $row)
			 {
			 
                 $title=$row['title'];
				 if(strlen($title)>25)
				     $title=substr($title,0,25). "..";
				 $price=number_format($row['product_unit_price'],2);
				 
				 $quantity=$row['product_qty'];
				 $shipcost=number_format($row['shipping_cost'],2);
				 $subtotal=number_format($row['subtotal'],2);    			 
			     $output.=' <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                <td class="content_list_txt1">'.$title.'</td>
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].$price.'</td>
                <td class="content_list_txt1" align="right">'.$quantity.'</td>
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].$shipcost.'</td>
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].$subtotal.'</td>
              </tr>';
			 }
			   $output.='<tr >
                <td colspan="4" align="right" class="order_footer"><strong>GRAND TOTAL :</strong></td>
                <td class="order_footer" align="right" style="padding-right:10px"><strong>'.$_SESSION['currency']['currency_tocken'].number_format($grandtotal,2).'</strong></td>
              </tr>
              
            </table>';
			
			return $output;
		}
	
	
	}
}
?>


