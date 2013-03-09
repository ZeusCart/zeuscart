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
class Display_DUserAccount
{
 	/**
	* This function is used to Display the News Letter Subscription Page
	* @name showNewsLetter
	* @param mixed $arr
	* @return string
 	*/
	function showNewsLetter($arr)
	{
	include_once('classes/Core/CUserNewsLetter.php');
	$value=0;
	
		$value=$arr[0]['subsciption_id'];
		
	$status='';
	if($arr[0]['status']==1)
		$status='checked=checked';
		
	$output='<form name="frmNewsSub" method="post" action="?do=newsletter&action=add">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Newsletter Subscriptions </td>
            </tr>
          
          <tr>
            <td colspan="2" valign="top" class="checkout_title1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="checkout_title1">
            <div>
              <input type="checkbox" name="chkNewsSub" '.$status.' />
			  <input type="hidden" name="subId" value="'.$value.'" />
              <strong>General Subscription</strong></div>	</td>
          </tr>
          <tr>
            <td align="center" class="dot_line">
			<table width="80%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right"><span class="checkout_required"></span><br /><br />
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" class="button_left"></td>
                    <td><input type="submit" value="Save" class="button" /></td>
                    <td class="button_right"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          
        </table></form>';
		return $output;
	}

 	/**
	* This function is used to Display the User Dashboard
	* @name showDashboard
	* @param mixed $arr
	* @param mixed $arrUser	
	* @param int $status
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showDashboard($arr,$arrUser,$status,$paging,$prev,$next,$val)
	{
		$newsStatus='You are currently not subscribed to newsletter.';
		if($status[0]['status']==1)
			$newsStatus='You are currently subscribed to newsletter.';
		
		$output='
            <div class="title_fnt">
    	<h1>My Account</h1>
        </div>
            
   
           <div id="myaccount_div">
           <div class="myacc_detail">
           	<h4>Hello, revathi!</h4>
           <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
           	<p class="pull-right"><a href="#" class="btn btn-inverse">View All</a></p>
            <div class="clear"></div>
            <h4>Recent Order</h4>
           </div>
           <table class="rt cf" id="rt1">
		<thead class="cf">
			<tr>
				<th>Order</th>
				<th>Ship to</th>
				<th>Order Total</th>
				<th>Status</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#2</td>
				<td>Satheesh</td>
				<td>INR  500.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#3</td>
				<td>Vinith Kumar</td>
				<td>INR  300.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#4</td>
				<td>Mani Mala</td>
				<td>INR  15,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#5</td>
				<td>Seetha Lakshmi</td>
				<td>INR  3,300.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#6</td>
				<td>Bala</td>
				<td>INR  1,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
		</tbody>
	</table>
           </div>
      ';
		return $output;
	}
	/**
	* This function is used to Display the User Account Information
	* @name showAccountInfo
	* @param mixed $arr
	* @return string
 	*/
	function showAccountInfo($arr)
	{


		include("classes/Lib/HandleErrors.php");		
		
	
		include_once('classes/Core/CUserAccInfo.php');
		if(isset($_SESSION['errmsg']))
		{	
			$result=$_SESSION['errmsg'];
			unset($_SESSION['errmsg']);	
		}
		$usergroup=$arr[0]['groupname'];
		$groupdiscount=$arr[0]['groupdiscount'];
		Core_CUserAccInfo::Ulogin($Err);
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		

		if(count($output['val'])==0)	
		{
			$fname=$arr[0]['user_name'];
			$email=$arr[0]['user_email'];	
			$mobile=$arr[0]['user_mobile'];			
			$hidsubid=$arr[0]['subsciption_id'];;
		}
		else
		{
			$fname=$arr[0]['user_name'];;
			$email=$arr[0]['user_email'];	
			$mobile=$arr[0]['user_mobile'];	
			$cpwd=$output['val']['txtCPwd'];
			$npwd=$output['val']['txtNPwd'];
			$cnpwd=$output['val']['txtCNPwd'];
			//$hidcpwd=$output['val']['hidCPwd'];
			$hidsubid=$output['val']['hidsubid'];;
		}
		$out='
            <div class="title_fnt">
    	<h1>Edit Account Information</h1>
        </div>
            
            	<!--My Account-->
           <div id="myaccount_div">
	<form class="form-horizontal">

	<h3 class="accinfo_fnt">Account Information</h3>
            <div class="control-group">
              <label for="inputEmail" class="control-label">Name  <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="text" placeholder="Email" id="inputEmail">
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Email Address <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Mobile Number <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Mobile Number <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
	<h3 class="accinfo_fnt">Account Information</h3>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Mobile Number <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Mobile Number <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">Mobile Number <i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="password" placeholder="Password" id="inputPassword">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-danger" type="submit">Sign in</button>
              </div>
            </div>
          </form>           </div>
            
        ';


		return $out;
	}
	
 	/**
	* This function is used to Display the User Product's Review
	* @name showProductReview
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showProductReview($arr,$paging,$prev,$next,$val)
	{

		$output='<div class="title_fnt">
    	<h1>My Account</h1>
        </div>
            
   
           <div id="myaccount_div">
           <div class="myacc_detail">
           	<h4>Hello, revathi!</h4>
           <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
           	<p class="pull-right"><a href="#" class="btn btn-inverse">View All</a></p>
            <div class="clear"></div>
            <h4>Recent Order</h4>
           </div>
           <table class="rt cf" id="rt1">
		<thead class="cf">
			<tr>
				<th>Order</th>
				<th>Ship to</th>
				<th>Order Total</th>
				<th>Status</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#2</td>
				<td>Satheesh</td>
				<td>INR  500.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#3</td>
				<td>Vinith Kumar</td>
				<td>INR  300.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#4</td>
				<td>Mani Mala</td>
				<td>INR  15,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#5</td>
				<td>Seetha Lakshmi</td>
				<td>INR  3,300.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
			<tr>
				<td>#6</td>
				<td>Bala</td>
				<td>INR  1,100.00</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
			</tr>
		</tbody>
	</table>
           </div>';
			
			return $output;
	}
 	/**
	* This function is used to Display the User Wishlist
	* @name showWishlist
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @param mixed $result
	* @return string
 	*/
	function showWishList($arr,$paging,$prev,$next,$val,$result)
	{
		$output.=$result.'<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#cac7c7">
			<tr>
			  <td width="71%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:15px;">Product Name</td>
			  <td width="15%" align="center" bgcolor="#FFFFFF" class="viewcartTITLE" >Added On </td>
			  <td width="14%" align="center" bgcolor="#FFFFFF" class="viewcartTITLE" >&nbsp;</td>
			 </tr>';

		if(count($arr)>0)
		{
			 for($i=0;$i<count($arr);$i++)
			  {
			  if(file_exists($arr[$i]['image']))
			  	$img=$arr[$i]['image'];
			  else
			  	$img="images/noimage.jpg";	
				
				$output.='<tr>
				  <td colspan="5" align="center" bgcolor="#FFFFFF" style="padding:15px 0px">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="43" align="left" style="padding-left:10px;"><a href="?do=wishlist&action=deletewishlist&prodid='.$arr[$i]['product_id'].'"><img src="images/bullet.jpg" alt="remove" width="14" height="14" style="border:none"/></a></td>
						<td width="52" align="left"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">
							<img src="'.$img.'" alt="" width="52" height="52" style="border:none" /></a></td>
						<td width="350" align="center" class="viewcartTXT1"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'<br /><!--$-->
						  '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$i]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</a></td>
						<td width="93" align="center" class="viewcart_price">'.$arr[$i]['adate'].'</td>
						<td width="86" align="center" class="viewcart_price"><a href="?do=addtocart&prodid='.$arr[$i]['product_id'].'">Add to Cart </a></td>
						</tr>
				  </table></td>
				</tr>';
			 }
		}	 
		else
		{
			 $output.='<tr><td bgcolor="#FFFFFF" class="account_tableTXT" style="padding-left:15px;" colspan=3>No Products Found</td></tr>';
		}	 
		 $output.='</table>';
		  /*$output.='<tr align="center"><td class="content_list_footer" >'.' '.$prev.' ';
			for($i=1;$i<=count($paging);$i++)
			 $pagingvalues .= $paging[$i]."  ";
					$output .= $pagingvalues.' '.$next.'</td></tr>';*/
		
		$_SESSION['wishList']=$output;			
		return $output;
	}	

 	/**
	* This function is used to get the User wishlist to send to the friend
	* @name getWishList
	* @param mixed $arr
	* @return string
 	*/
	function getWishList($arr)
	{
		$output.='<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#cac7c7">
			<tr>
			  <td width="71%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:15px;">Product Name</td>
			  <td width="15%" align="center" bgcolor="#FFFFFF" class="viewcartTITLE" >Added On </td>
			 </tr>';


		 for($i=0;$i<count($arr);$i++)
		  {
			$output.='<tr>
			  <td colspan="5" align="center" bgcolor="#FFFFFF" style="padding:15px 0px">
			  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="52" align="left"><a href="http://'.$_SERVER['SERVER_NAME'].'/?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="http://'.$_SERVER['SERVER_NAME'].'/'.$arr[$i]['image'].'" alt="" width="52" height="52" style="border:none" /></a></td>
					<td width="350" align="center" class="viewcartTXT1"><a href="http://'.$_SERVER['SERVER_NAME'].'/?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'<br />$
					  '.number_format($arr[$i]['msrp'],2).'</a></td>
					<td width="93" align="center" class="viewcart_price">'.$arr[$i]['adate'].'</td>
					</tr>
			  </table></td>
			</tr>';
		 }
		 $output.='</table>';
		return $output;
	}
	
 	/**
	* This function is used to Display the User's Order info
	* @name showMyOrder
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showMyOrder($arr,$paging,$prev,$next,$val)
	{
	//print_r($arr);
		$output='
            <div class="title_fnt">
    	<h1>My Orders</h1>
        </div>
            
            	<!--My Account-->
           <div id="myaccount_div">
           <ul class="listviews">
                	<li><span class="label label-success">10</span> items By <select style="width:100px;"><option>2012-2013</option><option>2012-2011</option></select></li>
                    <li style="float:right" >Show <select style="width:50px;"><option>10</option></select></li>
                    <li></li>
             </ul>
             <div class="clear"></div>
           <table class="rt cf" id="rt1">
		<thead class="cf">
			<tr>
				<th>Order</th>
				<th>Ship to</th>
				<th>Order Total</th>
                <th>Track Id</th>
				<th>Invoice</th>
				<th>Status</th>
				<th>Detail</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
			<tr>
				<td>#1</td>
				<td>Karthik Kumar</td>
				<td>INR  1,100.00</td>
                <td>#12</td>
				<td>dfd</td>
				<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
				<td><a href="#" class="btn btn-mini">View Order</a></td>
				
			</tr>
		</tbody>
	</table>
           </div>
                <div class="pagination">
    <ul>
    <li><a href="#">Prev</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">Next</a></li>
    </ul>
    </div>
        ';
		return $output;
	}
	
 	/**
	* This function is used to Display the Order info
	* @name showOrderDetails
	* @param mixed $arr
	* @return string
 	*/
	function showOrderDetails($arr)
	{
		$output='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="serachresult">Order Details </td>
				</tr>
			  
			  <tr>
				<td align="left" valign="top">
				<div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td colspan="2" class="account_title">Order #'.$arr[0]['orders_id'].'</td>
				  </tr>
				  <tr>
					<td width="18%" valign="top" class="checkout_text">Order Status<br />
					  Order Recipient<br />
					  Order Total<br />
					  Order Date<br />
					  Close Date </td>
					<td width="82%" valign="top" class="checkout_text">: '.$arr[0]['orders_status_name'].'<br />
					  : '.$arr[0]['shipping_name'].'<br />
					  : $'.$arr[0]['order_total'].' USD<br />
					  : '.$arr[0]['purDate'].'<br />
					  : '.$arr[0]['closeDate'].'</td>
				  </tr>
				  
				  <tr>
					<td colspan="2" class="account_title">Payment Details</td>
				  </tr>
				  <tr>
					<td valign="top" class="checkout_text">Paid Through<br />
					  Paypal</td>
					<td valign="top" class="checkout_text">: '.$arr[0]['gateway_name'].'<br />
					  : '.$arr[0]['merchant_id'].'</td>
				  </tr>
				  
				  <tr>
					<td colspan="2" class="line">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="2"><div>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="50%" valign="top" class="account_address"><strong style="color:#333333">Primary Billing Address</strong><br />
							  '.$arr[0]['billing_name'].'<br />
							  '.$arr[0]['billing_company'].'<br />
							  '.$arr[0]['billing_street_address'].'<br />
							  '.$arr[0]['billing_city'].' '.$arr[0]['billing_postcode'].' '.$arr[0]['billing_state'].'<br />
							  '.$arr[0]['billcountry'].'<br />
							  </td>
							<td width="50%" class="account_address"><strong style="color:#333333">Primary Shipping Address</strong><br />
							  '.$arr[0]['shipping_name'].'<br />
							  '.$arr[0]['shipping_company'].'<br />
							  '.$arr[0]['shipping_street_address'].'<br />
							  '.$arr[0]['shipping_city'].' '.$arr[0]['shipping_postcode'].' '.$arr[0]['shipping_state'].'<br />
							  '.$arr[0]['shipcountry'].'</td>
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
					<td colspan="2" class="account_title">Order #'.$arr[0]['orders_id'].' Contains the Following Items:</td>
				  </tr>
				  <tr>
					<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
						<tr>
						  <td width="37%" bgcolor="#cccccc" class="viewcartTITLE" style="padding-left:10px;">Item Details</td>
						  <td width="15%" align="left" bgcolor="#cccccc" class="viewcartTITLE" style="padding-left:10px;">Price</td>
						  <td width="12%" align="left" bgcolor="#cccccc" class="viewcartTITLE" style="padding-left:10px;">Quantity</td>
						  <td width="18%" align="left" bgcolor="#cccccc" class="viewcartTITLE" style="padding-left:10px;">Shipping Charge </td>
						  <td width="18%" align="left" bgcolor="#cccccc" class="viewcartTITLE" style="padding-left:10px;">Total</td>
						</tr>';
						$grand=0;
						for($i=0;$i<count($arr);$i++)
						{
							$total=($arr[$i]['product_unit_price']*$arr[$i]['product_qty'])+$arr[$i]['shipping_cost'];
							$output.='<tr>
							  <td align="left" bgcolor="#FFFFFF" class="order_TXT">'.$arr[$i]['title'].'</td>
							  <td align="right" bgcolor="#FFFFFF" class="order_Price1">$'.number_format($arr[$i]['product_unit_price'],2).'</td>
							  <td align="right" bgcolor="#FFFFFF" class="order_Price1">'.$arr[$i]['product_qty'].'</td>
							  <td align="right" bgcolor="#FFFFFF" class="order_Price1">$'.number_format($arr[$i]['shipping_cost'],2).'</td>
							  <td align="right" bgcolor="#FFFFFF" class="order_Price">$'.number_format($total,2).'</td>
							</tr>';
							$grand+=$total;
						}
						$output.='<tr>
						  <td colspan="4" align="right" style="background:url(images/viewcart_bg.jpg) repeat-x top #FFFFFF" class="viewcartTXT2">Grand Total </td>
						  <td align="left" style="background:url(images/viewcart_bg.jpg) repeat-x top #FFFFFF" class="viewcart_total">$'.number_format($grand,2).'</td>
						</tr>
						
					</table></td>
				  </tr>
				</table>
				</div>
				</td>
			  </tr>
			  
			  
			</table>
			</div>';
		return $output;	
	}
 	/**
	* This function is used to Display the All New Products
	* @name showAllNew
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showAllNew($arr,$paging,$prev,$next,$val)
	{
	//print_r($arr);
	//print_r($val);
	$output.='
	<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="serachresult">All New Products </td>
    </tr>
  
  <tr>
    <td align="left" valign="top">
	<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr align="right"><td class="content_list_footer" colspan=2 ><div>'.' '.$prev.' ';
					for($i=1;$i<=count($paging);$i++)
					 $pagingvalues .= $paging[$i]."  ";
							$output .= $pagingvalues.' '.$next.'</div></td></tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="800%" colspan="2">';
		
		$k=0;
		for($i=0;$i<count($arr)/4;$i++)
		{
			$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>';
			  for($j=0;$j<4;$j++)
			  {

			  	$rating=ceil($arr[$k]['rating']);
				$ratepath='';
				for($r=0;$r<5;$r++)
				{
					if($r<$rating)
						$ratepath.='<img src="images/starf.png">';
					else
						$ratepath.='<img src="images/stare.png">';							
				}
			  
				  if($arr[$k]['thumb_image']!='' && file_exists($arr[$k]['thumb_image']))
						$imgPath=$arr[$k]['thumb_image'];
				  else
						$imgPath='images/noimage1.jpg';
					
				$mode='none';		
				if($arr[$k]['product_id']!='')	
					$mode='block';
				//{	
					
					$output.='<td width="25%" align="center" style="';
					if($j<3 && $mode=='block')
						$output.='background:url(images/bg_line1.gif) repeat-y right';
					$output.='"><div class="featureITEM" style="display:'.$mode.'"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><img src="'.$imgPath.'" alt="'.addslashes($arr[$k]['title']).'"  width="'.THUMB_WIDTH.'" border=0 /></a>
							<div class="featureTXT"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'">'.((strlen($arr[$k]['title'])>15) ? substr( $arr[$k]['title'],0,15).'...' : $arr[$k]['title']).'</a></div>
					  <div class="featurePRICE"><!--Price :--> <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$k]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'<br />
								'.$ratepath.'</div>
					  <!--<div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"> </td>
								  <td><a href="?do=addtocart&prodid="><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit23222" value="       Buy Now      " class="button" /></a></td>
								  <td class="button_right" ></td>
								</tr>
							  </table>
						<a href="#"></a></div>-->
					  <div class="featureBUTTON">
					  <form name="addtowishlist" id="addtowishlist" action="?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'" method="post">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left" style="cursor:pointer" ></td>
								  <td><input type="submit" name="Submit232222" value="Add to Wishlist" class="button" style="cursor:pointer" /></td>
								  <td class="button_right" style="cursor:pointer" ></td>
								</tr>
							  </table>
							  </form>
						</div>
					</div></td>';
				//}	
				$k++;
			}
			  $output.='</tr>
			  <tr>
				<td align="center" colspan=4>&nbsp;</td>
			  </tr>
			</table>';
			
		}
		$output.='</td>
			  </tr>
			  
			  <tr>
				<td colspan="2" valign="top">&nbsp;</td>
			  </tr>
			   <tr><td class="content_list_footer" ><a href="?do=rss" style="text-decoration:none" target="_blank"><img src="images/rss.gif" border=0/></a></td><td class="content_list_footer" align="right">'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							 $pagingvalues1 .= $paging[$i]."  ";
									$output .= $pagingvalues1.' '.$next.'</td></tr>
			</table>
			</div>
			</td>
		  </tr>
		  
		  
		</table>
		</div>';
		return $output;
	}
	
 	/**
	* This function is used to Display the All Featured product
	* @name showAllFeatured
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showAllFeatured($arr,$paging,$prev,$next,$val)
	{
	
	$output.='
	<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="serachresult">All Featured Products </td>
    </tr>
  
  <tr>
    <td align="left" valign="top">
	<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr align="right"><td class="content_list_footer" >'.' '.$prev.' ';
					for($i=1;$i<=count($paging);$i++)
					 $pagingvalues .= $paging[$i]."  ";
							$output .= $pagingvalues.' '.$next.'</td></tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="800%" colspan="2">';
		
		$k=0;
		for($i=0;$i<count($arr)/4;$i++)
		{
			$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>';
			  for($j=0;$j<4;$j++)
			  {

			  	$rating=ceil($arr[$k]['rating']);
				$ratepath='';
				for($r=0;$r<5;$r++)
				{
					if($r<$rating)
						$ratepath.='<img src="images/starf.png">';
					else
						$ratepath.='<img src="images/stare.png">';							
				}
			  
				  if($arr[$k]['thumb_image']!='' && file_exists($arr[$k]['thumb_image']))
						$imgPath=$arr[$k]['thumb_image'];
				  else
						$imgPath='images/noimage1.jpg';
					
				$mode='none';		
				if($arr[$k]['product_id']!='')	
					$mode='block';
				//{	
					
					$output.='<td width="25%" align="center" style="';
					if($j<3 && $mode=='block')
						$output.='background:url(images/bg_line1.gif) repeat-y right';
					$output.='"><div class="featureITEM" style="display:'.$mode.'"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><img src="'.$imgPath.'" alt="'.addslashes($arr[$k]['title']).'" width="'.THUMB_WIDTH.'" border=0 /></a>
							<div class="featureTXT"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'">'.((strlen($arr[$k]['title'])>15) ? substr( $arr[$k]['title'],0,15).'...' : $arr[$k]['title']).'</a></div>
					  <div class="featurePRICE"><!--Price :--> <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$k]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'<br />
								'.$ratepath.'</div>
					  <!--<div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"></td>
								  <td><a href="?do=addtocart&prodid='.$arr[$k]['product_id'].'"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit23222" value="       Buy Now      " class="button" /></a></td>
								  <td class="button_right"></td>
								</tr>
							  </table>
						<a href="#"></a></div>-->
					  <div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"></td>
								  <td><a href="?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'" style="text-decoration:none;"><form method="post" action="?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit232222" value="Add to Wishlist" class="button" /></form></a></td>
								  <td class="button_right"></td>
								</tr>
							  </table>
						<a href="#"></a></div>
					</div></td>';
				//}	
				$k++;
			}
			  $output.='</tr>
			  <tr>
				<td align="center" colspan=4>&nbsp;</td>
			  </tr>
			</table>';
			
		}
		$output.='</td>
			  </tr>
			  
			  <tr>
				<td colspan="2" valign="top">&nbsp;</td>
			  </tr>
			   <tr align="right"><td class="content_list_footer" >'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							 $pagingvalues1 .= $paging[$i]."  ";
									$output .= $pagingvalues1.' '.$next.'</td></tr>
			</table>
			</div>
			</td>
		  </tr>
		  
		  
		</table>
		</div>';
		return $output;
	}
	/**
	* This function is used to Display the  Address
	* @name showAddress
	
	* @return string
 	*/
	function showAddress($arr)
	{
	$output.='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="serachresult">Address Book </td><td align="right" class="account_address">
			<a href="?do=addressbook" class="categoryList">View Contact</a>|
			<a href="?do=addaddress" class="categoryList">Add Contact</a>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" colspan=2>
			<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			  $k=0;	
			  $output.='<tr>';
			  $output.='<td width="50%" valign="top" class="account_address">';
				if($arr[$k]['contact_name']!='')
				{
					$output.='<strong style="color:#333333">'.$arr[$k]['contact_name'].' Address details</strong><br /><h1>'.$arr[$k]['first_name'].' '.$arr[$k]['last_name'].'</h1>
					  '.$arr[$k]['company'].'<br />
					  '.$arr[$k]['address'].'<br />
					  '.$arr[$k]['city'].', '.$arr[$k]['zip'].', '.$arr[$k]['state'].'<br />
					  <h2>'.$arr[$k]['cou_name'].'</h2>
					  Phone No : '.$arr[$k]['phone_no'].'<br />
					  Fax : '.$arr[$k]['fax'].'<br />
					  Email :<span><a href="mailto:'.$arr[$k]['email'].'">'.$arr[$k]['email'].'</a></span><br />
					  <a href="?do=addaddress&id='.$arr[$k]['contact_name'].'">Edit Address</a>|
					  <a href="?do=deladdress&id='.$arr[$k]['contact_name'].'" onclick="return confirm(\'Are you Sure to delete?\');">Delete Address</a>';
				}	  
			  $output.='</tr>';
			$output.='</table>
			</div>
			</td>
		  </tr>
		   <tr align="right"><td class="content_list_footer" colspan=2>'.' '.$prev.' ';
				for($i=1;$i<=count($paging);$i++)
				 $pagingvalues1 .= $paging[$i]."  ";
						$output .= $pagingvalues1.' '.$next.'</td></tr>
		</table>
	</div>';
		return $output;
	}
	/**
	* This function is used to Display the All Address
	* @name showAddressBook
	
	* @return string
 	*/
	function showAddressBook($arr,$paging,$prev,$next,$val)
	{
	$output.='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="serachresult">Address Book  </td><td align="right" class="account_address"><a href="?do=addaddress" class="categoryList">Add Contact</a>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" colspan=2>
			<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$k=0;
			for($i=0;$i<5;$i++)
			{
			  $output.='<tr>';
			  	for($j=0;$j<2;$j++)
				{
					$output.='<td width="50%" valign="top" class="account_address">';
					if($arr[$k]['contact_name']!='')
					{
						$output.='
						<div class="addressbook address_left">
						<h1>'.$arr[$k]['contact_name'].'</h1>
						<h4>'.$arr[$k]['first_name'].' '.$arr[$k]['last_name'].'</h4>
						<h2><a href="mailto:'.$arr[$k]['email'].'">&nbsp;'.$arr[$k]['email'].'</a></h2>
						'.$arr[$k]['city'].', '.$arr[$k]['state'].'
						<h3><a href="?do=addressbook&action=view&id='.$arr[$k]['contact_name'].'">View Contact</a></h3>
						</div>';
					}	  
  				    $output.='</td>';
					  $k++; 
				}	  
			  $output.='</tr>';
			} 
			
			$output.='</table>
			</div>
			</td>
		  </tr>
		   <tr align="right"><td class="content_list_footer" colspan=2>'.' '.$prev.' ';
				for($i=1;$i<=count($paging);$i++)
				 $pagingvalues1 .= $paging[$i]."  ";
						$output .= $pagingvalues1.' '.$next.'</td></tr>
		</table>
	</div>';
		return $output;
	}
	/**
	* This function is used to Display the Add Address
	* @name showAddAddress
	* @param  array $arrCountry
	* @param  array $arrAdd
	* @return string
 	*/
	function showAddAddress($arrCountry,$arrAdd=array())
	{
	
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CUserAddressBook.php');
		Core_CUserAddressBook::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		

		if(count($arrAdd)>0 && count($output['val'])==0)	
		{
			$gName=$arrAdd[0]['contact_name'];
			$fName=$arrAdd[0]['first_name'];
			$lName=$arrAdd[0]['last_name'];
			$company=$arrAdd[0]['company'];
			$eMail=$arrAdd[0]['email'];
			$address=$arrAdd[0]['address'];
			$city=$arrAdd[0]['city'];
			$suburb=$arrAdd[0]['suburb'];
			$state=$arrAdd[0]['state'];
			$country=$arrAdd[0]['country'];
			$zip=$arrAdd[0]['zip'];
			$telephone=$arrAdd[0]['phone_no'];
			$fax=$arrAdd[0]['fax'];
			$status=(isset($_GET['id'])?1:0);
			$group=$_GET['id'];
		}
		else
		{
			$gName=$output['val']['txtGName'];
			$fName=$output['val']['txtFName'];
			$lName=$output['val']['txtLName'];
			$company=$output['val']['txtCompany'];
			$eMail=$output['val']['txtEMail'];
			$address=$output['val']['txtAddress'];
			$city=$output['val']['txtCity'];
			$suburb=$output['val']['txtSuburb'];
			$state=$output['val']['txtState'];
			$country=$output['val']['selCountry'];
			$zip=$output['val']['txtZip'];
			$telephone=$output['val']['txtPhone'];
			$fax=$output['val']['txtFax'];
			$status=$output['val']['hidStatus'];		
			$group=$output['val']['hidGroup'];		
		}

		if($status==1)
		{
			$buttonCaption='Update';
			$action="edit";
			$readonly="readonly";
		}
		else
		{
			$buttonCaption='Create';			
			$action="add";	
			$readonly="";			
		}


	$output1.='
	    <form name="frmAddress" method="post" action="?do=addaddress&action='.$action.'">
		<input type="hidden" name="hidStatus" value="'.$status.'">
		<input type="hidden" name="hidGroup" value="'.$group.'">
		<div align="center">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration" align="center">
		 	<tr>
			<td class="serachresult">Address Book</td>
			<td colspan=2></td>
			<td align="right" class="account_address" nowrap><a href="?do=addressbook" class="categoryList">View Contacts</a>
			</td>
			</tr>
		   <tr>
			 <td width="26%"><b>Group Name</b> <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtGName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$gName.'" /><h1><AJDF:output>'.$output['msg']['txtGName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td width="26%" align="top">First Name <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtFName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$fName.'" /><h1><AJDF:output>'.$output['msg']['txtFName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td valign="top">Last Name <span>*</span></td>
			 <td valign=top>:</td>
			 <td><input name="txtLName" type="text" class="txtbox1 w4 TxtC1" id="textfield2" value="'.$lName.'"/><h1><AJDF:output>'.$output['msg']['txtLName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Company</td>
			 <td>:</td>
			 <td><input name="txtCompany" type="text" class="txtbox1 w4 TxtC1" id="textfield3" value="'.$company.'"/></td>
		   </tr>
		   <tr>
			 <td>Email Address</td>
			 <td>:</td>
			 <td><input name="txtEMail" type="text" class="txtbox1 w4 TxtC1" id="textfield4" value="'.$eMail.'"/><h1><AJDF:output>'.$output['msg']['txtEMail'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Address <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtAddress" type="text" class="txtbox1 w4 TxtC1" id="textfield7" value="'.$address.'"/><h1><AJDF:output>'.$output['msg']['txtAddress'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>City <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtCity" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$city.'"/><h1><AJDF:output>'.$output['msg']['txtCity'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Sub Urb </td>
			 <td>:</td>
			 <td><input name="txtSuburb" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$suburb.'"/></td>
		   </tr>
		   <tr>
			 <td>State/Province <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtState" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$state.'"/><br><h1><AJDF:output>'.$output['msg']['txtState'].'</AJDF:output></h1>
			 </td>
		   </tr>
		   <tr>
			 <td>Country <span>*</span></td>
			 <td>:</td>
			 <td><select name="selCountry" id="select3" class="listbox1 w4a TxtC1">';
				 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
			 $output1.='</select></td>
		   </tr>
		   <tr>
			 <td>Zip/Postal Code <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtZip" type="text" class="txtbox1 w4 TxtC1" id="textfield82" value="'.$zip.'"/><h1><AJDF:output>'.$output['msg']['txtZip'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Telephone </td>
			 <td>:</td>
			 <td><input name="txtPhone" type="text" class="txtbox1 w4 TxtC1" id="textfield822" value="'.$telephone.'"/></td>
		   </tr>
		   <tr>
			 <td>Fax</td>
			 <td>:</td>
			 <td><input name="txtFax" type="text" class="txtbox1 w4 TxtC1" id="textfield823" value="'.$fax.'"/></td>
		   </tr>
		   <tr>
			 <td colspan=2></td><td style="padding-top:10px;" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
				   <td valign="top"><div>
					   <table border="0" cellspacing="0" cellpadding="0">
						 <tr>
						   <td align="right" class="button_left"> </td>
						   <td><input type="submit" name="Submit2" value="'.$buttonCaption.'" class="button" /></td>
						   <td class="button_right" ></td>
						 </tr>
					   </table>
				   </div></td>
				 </tr>
			 </table></td>
		   </tr>
		 </table>
	   </div>
	   </form>';
	   return $output1;
	}
	/**
	* This function is used to Display the Add Address from check out
	* @name showAddAddressFromCheckout
	* @param  array $arrCountry
	* @param  array $arrAdd
	* @return string
 	*/
	function showAddAddressFromCheckout($arrCountry,$arrAdd=array())
	{
	
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CUserAddressBook.php');
		Core_CUserAddressBook::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		

		if(count($arrAdd)>0 && count($output['val'])==0)	
		{
			$gName=$arrAdd[0]['contact_name'];
			$fName=$arrAdd[0]['first_name'];
			$lName=$arrAdd[0]['last_name'];
			$company=$arrAdd[0]['company'];
			$eMail=$arrAdd[0]['email'];
			$address=$arrAdd[0]['address'];
			$city=$arrAdd[0]['city'];
			$suburb=$arrAdd[0]['suburb'];
			$state=$arrAdd[0]['state'];
			$country=$arrAdd[0]['country'];
			$zip=$arrAdd[0]['zip'];
			$telephone=$arrAdd[0]['phone_no'];
			$fax=$arrAdd[0]['fax'];
			$status=(isset($_GET['id'])?1:0);
			$group=$_GET['id'];
		}
		else
		{
			$gName=$output['val']['txtGName'];
			$fName=$output['val']['txtFName'];
			$lName=$output['val']['txtLName'];
			$company=$output['val']['txtCompany'];
			$eMail=$output['val']['txtEMail'];
			$address=$output['val']['txtAddress'];
			$city=$output['val']['txtCity'];
			$suburb=$output['val']['txtSuburb'];
			$state=$output['val']['txtState'];
			$country=$output['val']['selCountry'];
			$zip=$output['val']['txtZip'];
			$telephone=$output['val']['txtPhone'];
			$fax=$output['val']['txtFax'];
			$status=$output['val']['hidStatus'];		
			$group=$output['val']['hidGroup'];		
		}

		if($status==1)
		{
			$buttonCaption='Update';
			$action="edit";
			$readonly="readonly";
		}
		else
		{
			$buttonCaption='Create';			
			$action="add";	
			$readonly="";			
		}


	$output1.='
	    <form name="frmAddress" method="post" action="?do=addaddress&action='.$action.'">
		<input type="hidden" name="hidStatus" value="'.$status.'">
		<input type="hidden" name="hidGroup" value="'.$group.'">
		<div align="center">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration" align="center">
		 	<tr>
			<td class="serachresult">Address Book</td>
			<td colspan=2></td>
			<td align="right" class="account_address" nowrap><!--<a href="?do=addressbook" class="categoryList">View Contacts</a>-->
			</td>
			</tr>
		   <tr>
			 <td width="26%"><b>Group Name</b> <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtGName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$gName.'" /><h1><AJDF:output>'.$output['msg']['txtGName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td width="26%" align="top">First Name <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtFName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$fName.'" /><h1><AJDF:output>'.$output['msg']['txtFName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td valign="top">Last Name <span>*</span></td>
			 <td valign=top>:</td>
			 <td><input name="txtLName" type="text" class="txtbox1 w4 TxtC1" id="textfield2" value="'.$lName.'"/><h1><AJDF:output>'.$output['msg']['txtLName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Company</td>
			 <td>:</td>
			 <td><input name="txtCompany" type="text" class="txtbox1 w4 TxtC1" id="textfield3" value="'.$company.'"/></td>
		   </tr>
		   <tr>
			 <td>Email Address</td>
			 <td>:</td>
			 <td><input name="txtEMail" type="text" class="txtbox1 w4 TxtC1" id="textfield4" value="'.$eMail.'"/><h1><AJDF:output>'.$output['msg']['txtEMail'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Address <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtAddress" type="text" class="txtbox1 w4 TxtC1" id="textfield7" value="'.$address.'"/><h1><AJDF:output>'.$output['msg']['txtAddress'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>City <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtCity" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$city.'"/><h1><AJDF:output>'.$output['msg']['txtCity'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Sub Urb </td>
			 <td>:</td>
			 <td><input name="txtSuburb" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$suburb.'"/></td>
		   </tr>
		   <tr>
			 <td>State/Province <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtState" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$state.'"/><br><h1><AJDF:output>'.$output['msg']['txtState'].'</AJDF:output></h1>
			 </td>
		   </tr>
		   <tr>
			 <td>Country <span>*</span></td>
			 <td>:</td>
			 <td><select name="selCountry" id="select3" class="listbox1 w4a TxtC1">';
				 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
			 $output1.='</select></td>
		   </tr>
		   <tr>
			 <td>Zip/Postal Code <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtZip" type="text" class="txtbox1 w4 TxtC1" id="textfield82" value="'.$zip.'"/><h1><AJDF:output>'.$output['msg']['txtZip'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Telephone </td>
			 <td>:</td>
			 <td><input name="txtPhone" type="text" class="txtbox1 w4 TxtC1" id="textfield822" value="'.$telephone.'"/></td>
		   </tr>
		   <tr>
			 <td>Fax</td>
			 <td>:</td>
			 <td><input name="txtFax" type="text" class="txtbox1 w4 TxtC1" id="textfield823" value="'.$fax.'"/></td>
		   </tr>
		   <tr>
			 <td colspan=2></td><td style="padding-top:10px;" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
				   <td valign="top"><div>
					   <table border="0" cellspacing="0" cellpadding="0">
						 <tr>
						   <td align="right" class="button_left"></td>
						   <td><input type="submit" name="Submit2" value="'.$buttonCaption.'" class="button" /></td>
						   <td class="button_right"></td>
						 </tr>
					   </table>
				   </div></td>
				 </tr>
			 </table></td>
		   </tr>
		 </table>
	   </div>
	   </form>';
	   return $output1;
	}
}
?>
