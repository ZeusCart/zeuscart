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
 * This class contains functions to display admin home page details.
 *
 * @package  		Display_DAdminHome
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DAdminHome
{
	/**
	 * Get latest users list. 
	 * @param array $arr
	 * @return string
	 */
	function getLatestCustomers($arr)
	{
		$output = "";
		
			$output=' <ul class="stats">';

	
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
				$class='odd';
			else
				$class='even';
			$usr_date = explode("-",$arr[$i]['user_doj']);
			$doj=date("l, M d, Y",mktime(0,0,0,$usr_date[1],$usr_date[2],$usr_date[0]));
			
			// $output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.' >'.($i+1).'</td><td '.$classtd.'>'.$arr[$i]['user_display_name'].'</td>';
			// $output .='<td '.$classtd.'><a href="mailto:'.$arr[$i]['user_email'].'">'.$arr[$i]['user_email'].'</a></td><td '.$classtd.'>'.$doj.'</td>
			// </tr>';

			$output.='<li class="'.$class.'"><a href="?do=customerdetail&action=detail&userid='.$arr[$i]['user_id'].'">'.$arr[$i]['user_email'].'</a> - '.$doj.'</li>';
			
		}
			$output .= '</ul>';
			return $output;
	}
	
	/**
	 * Display the ordered products list. 
	 * @param array $result
	 * @param integer $grandtotal
	 * @return string
	 */
	function productsInOrderTable($result,$grandtotal)
	{

	   
	    if(count($result)>0)
		{
		     $output='<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr"> <tr>
                <td  class="content_list_head" >Product Name</td>
                <td  class="content_list_head" align="center">Unit Price</td>
                <td  class="content_list_head" align="center">Quantity</td>
                <td  class="content_list_head" align="center">Shipping Cost</td>
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
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].' '.$price.'</td>
                <td class="content_list_txt1" align="right">'.$quantity.'</td>
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].' '.$shipcost.'</td>
                <td class="content_list_txt1" align="right">'.$_SESSION['currency']['currency_tocken'].' '.$subtotal.'</td>
              </tr>';
			 }
			   $output.='<tr >
                <td colspan="4" align="right" class="order_footer"><strong>GRAND TOTAL :</strong></td>
                <td class="order_footer" align="right" style="padding-right:10px"><strong>'.$_SESSION['currency']['currency_tocken'].' '.number_format($grandtotal,2).'</strong></td>
              </tr>
              
            </table>';
			
			return $output;
		}
	
	
	}
	
	/**
	 * Display the latest orders list. 
	 * @param array $result
	 * @param integer $subtotal
	 * @return string
	 */	
	function latestOrders($result,$subtotal)
	{
	      if(count($result)>0)
		{
		   //   $output='<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr"> <tr>
     //            <td  class="content_list_head" >Order ID</td>
     //            <td  class="content_list_head" align="center">Customers</td>
     //            <td  class="content_list_head" align="center">Status</td>
     //            <td  class="content_list_head" align="center">Date Added</td>
     //            <td  class="content_list_head" align="center">Total</td>
     //          </tr>
			  // <tr>
     //            <td colspan="5" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
     //          </tr>';

				$output=' <ul class="stats">';

				$i=1;
		     foreach($result as $row)
			 {
			 	if($i%2=='0'){

			 		$class='odd';

			 	}else{
			 		$class='even';
			 	}

			   $orders_id=$row['orders_id'];
			   $userdisplayname=$row['user_display_name'];
				 if(strlen($userdisplayname)>25)
				     $userdisplayname=substr($userdisplayname,0,25). "..";

				$status=Core_CAdminHome::orderstatus($row['orders_status']);

			
				if($row['orders_status']=='1'){
					$statusclass="badge badge-important";
				}elseif($row['orders_status']=='2'){
					$statusclass="badge badge-warning";
				}elseif($row['orders_status']=='3'){
					$statusclass="badge badge-success";
				}else{
					$statusclass="badge badge-info";
				}
				
				$ord_date_time = explode(" ",$row['date_purchased']);
			    $ord_date = explode("-",$ord_date_time[0]);
			    $ord_time = explode(":",$ord_date_time[1]);
			    $dateadded=date("l, M d, Y H:i:s",mktime($ord_time[0],$ord_time[1],$ord_time[2],$ord_date[1],$ord_date[2],$ord_date[0]));
				//$dateadded=$row['date_purchased'];
				$total=number_format($row['order_total'],2);
				 
				
			     $output.=' <li class="'.$class.'">

			     <table width="100%" cellpadding="0" cellspacing="0" border="0">
			     <tr>
			     <td width="5%">
               <a href="?do=disporders&action=detail&id='.$orders_id.'" style="color:#000;font-weight:bold;">#'.$orders_id.'</a> 
               </td>
               <td  width="20%"  align="left" >
               <a class="clsanchor" href="?do=disporders&action=detail&id='.$orders_id.'">'.$userdisplayname.'</a>
               </td>
               <td  width="25%"  align="left" >
               <span class="clsstatus '.$statusclass.'"  style="font-weight:normal;">'.$status.'</span> 
               </td>
               <td  width="35%"  align="left" >
               <span class="clsdate" style="font-weight:normal;">'.$dateadded.'</span>
               </td>
               <td   width="15%" align="right">
               <span class="clscurrency" style="font-weight:normal">'.$_SESSION['currency']['currency_tocken'].' '.$total.'</span>
               </td>
               </tr></table></li>';


               $i++;
			 }


			 $output.='</ul>';
			   

			   // $output.='<tr >
      //           <td colspan="4" align="right" class="order_footer"><strong>GRAND TOTAL :</strong></td>
      //           <td class="order_footer" align="right" style="padding-right:10px"><strong>'.$_SESSION['currency']['currency_tocken'].' '.number_format($subtotal,2).'</strong></td>
      //         </tr>
              
      //       </table>';
			}
			return $output;
	}
	
	/**
	 * Display new customer details. 
	 * @param array $result
	 * @return string
	 */	
	function newCustomers($result)
	{
	
	 if(count($result)>0)
		{
		     $output='<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr"> <tr>
                <td  class="content_list_head" >Customer Name</td>
                <td  class="content_list_head" align="center">E-Mail</td>
                <td  class="content_list_head" align="center">Join Date</td>
                <td  class="content_list_head" align="center">Order Amount</td>
              </tr>
			  <tr>
                <td colspan="4" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		     foreach($result as $row)
			 {
			 
                 $username=$row['user_display_name'];
				 if(strlen($username)>25)
				     $username=substr($username,0,25). "..";
					 
				  $email=$row['user_email'];
				  $doj=$row['user_doj'];
				  
				 //$orderamount=number_format($row['product_unit_price'],2);
				 
				 
			     $output.=' <tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
                <td class="content_list_txt1">'.$username.'</td>
                <td class="content_list_txt1" align="right">$ '.$email.'</td>
                <td class="content_list_txt1" align="right">'.$doj.'</td>
                <td class="content_list_txt1" align="right">$ '.$orderamount.'</td>
              </tr>';
			 }
			   $output.='<tr >
                <td colspan="4" align="right" class="order_footer"><strong>GRAND TOTAL :</strong></td>
                <td class="order_footer" align="right" style="padding-right:10px"><strong>$ '.number_format($grandtotal,2).'</strong></td>
              </tr>
              
            </table>';
			
			return $output;
		}
	}
	
}
?>	