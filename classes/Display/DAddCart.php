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

class Display_DAddCart 
{
	/**
	 * This function is used to show the cart item.
	 *
	 * @param   array  	$arr	    array of items
	 * @param   array  	$result      array of country
	 * 
	 *
	 * @return HTML data
	 */	
	function showCart($arr,$result)
	{

	  if (!(empty($arr)))
	  {
		   if($Err->messages>0)
			{
				$output['val']=$Err->values;
				$output['msg']=$Err->messages;
			}
			$obj=new Display_DAddCart();
			$res=$obj->loadCountryDropDown($result,'selbillcountry');
			$resship=$obj->loadCountryDropDown($result,'selshipcountry');
			
			$out = '<input  type="hidden" name="prodid" value="'.(int)$_GET['prodid'].'">';
			$out.='<div id="myaccount_div">
           		       <table class="rt cf" id="rt1">
		               <thead class="cf">
				<tr>
					<th>Gallery View</th>
					<th>Product Name</th>
					<th>Qty</th>
					<th>Sub Total</th>
					
				</tr>
				</thead>
				<tbody>';

				if(isset($_SESSION['prowishlist']))
				{
					unset($_SESSION['prowishlist']);	
					$proid='';
				}

				$cnt=count($arr);
				for ($i=0;$i<$cnt;$i++)
				{
					$proid.=$arr[$i]['product_id'].',';
					$prqty=$arr[$i]['product_qty'];
					
					if ($arr[$i]['soh']<=0)
						$prqty=0;
						
								
					$original_price=$arr[$i]['product_unit_price'];
					
					if($arr[$i]['product_unit_price']!=0.00)
						$msrp=$arr[$i]['product_unit_price']; 
					elseif($arr[$i]['msrp1']!=0.00)
						$msrp=$arr[$i]['msrp1']; //$msrp calculated unitpirce
					else
						$msrp=$arr[$i]['msrp'];
						
					$subtotal[]=$prqty*$msrp;
					
					$total=array_sum($subtotal);
								
					$shippingcost[]=$arr[$i]['shipingamount'];
					$shipping=array_sum($shippingcost);
							
					$_SESSION['total']=$total;
					$thumbimage=$arr[$i]['thumb_image'];
					$temp=$arr[$i]['thumb_image'];
					$img=explode('/',$temp);
					
					
					$out.='<tr>
						<td><a href="?do=addtocart&action=delete&prodid='.$arr[$i]['product_id'].'&cartid='.$arr[$i]['cart_id'].'"><img src="assets/img/close_button.gif" alt="close">	</a>		  <div class="showcart_box"><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">';
						if(file_exists($thumbimage))

						$out.='<img src="'.$thumbimage.'" alt='.$arr[$i]['title'].'  />';
						else
						$out.='<img src="images/noimage.jpg"  alt='.$arr[$i]['title'].' />';


						$out.='</a></div></td>
						<td ><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></td>
						<td>'.$arr[$i]['product_qty'].'</td>
						<td><span class="label label-inverse">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].'&nbsp;'.number_format($arr[$i]['msrp']*$arr[$i]['product_qty']).'</span></td>
						</tr>';
				}
			
				$_SESSION['prowishlist']=$proid;
				$grandtotal=$total+$shipping;
				$_SESSION['grandtotal']=$grandtotal;
			
			
			$out.='<tr>
				<td colspan="2" rowspan="3">&nbsp;</td>
			 	 <td><strong>Sub Total</strong></td>
				<td><span class="label label-success">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].'&nbsp;'.$total.'</span></td>
				</tr>
				<tr>
				<td><strong>Shipping Amount</strong></td>
					<td><span class="label label-warning">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].'&nbsp;'.$shipping.'</span></td>
				</tr>
				
				
				<tr>
				<td><strong>Grand Total</strong></td>
					<td><span class="label label-important">'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].'&nbsp;'.$grandtotal.'</span></td>
				</tr>
				<tr>
				<td colspan="2"><a href="javascript:void(0);" onclick="call();"><input type="submit" class="btn btn-danger" value="Continue Shopping" name="Submit" ></a></td>
				<td colspan="2" align="center"><a href="?do=showcart&action=showquickregistration" ><input type="button" name="Submit22" value="Proceed To Checkout" class="btn btn-inverse" onclick=""></a></td>
				</tr>
				</tbody>
				</table>
				</div>';
		}
		else
			$out='<table class="product_header" width="78%" align="center"><tr><td class="msg" align="center"><div class="exc_msgbox" >No Prodcuts Available in Your Shopping Cart</div></td></tr></table>';
		
		return $out;	
	
	}
	
	/**
	 * This function is used to show the cart snap shot
	 *
	 * @param   int  	$grandtotal	   total amount
	 * @param   int  	$cnt              count of item
	 * 
	 *
	 * @return HTML data
	 */
	
	function cartSnapShot($grandtotal,$cnt)
	{
		$output='<div class="viewcartTXT"><span>'.$cnt.'</span> items in the Cart<br />
		Sub Total : <span><!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($grandtotal*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'</span></div>
		
		<div style="padding-top:7px;"> <a href="?do=showcart"><input type="submit" name="Submit52" value="View Cart" class="button5" style="float:left; clear:right " /></a><a href="?do=showcart&action=getaddressdetails"><input type="submit" name="Submit5" value="Check Out" class="button6" style="float:left; clear:right" /></a></div>';
			return $output;
		
	}
	/**
	 * This function is used to show the country drop down
	 *
	 * @param   array  	$result	      array of country
	 * @param   string  	$name         name of the select box
	 * @param    string     $selected      selected country code
	 *
	 * @return HTML data
	 */
	
	function loadCountryDropDown($result,$name,$selected='')
	{
		if(count($result)>0)
		{
				$output='<select name="'.$name.'" style="width:280px;"><option value="">Select</option>';
				foreach($result as $row)
				{			 
				$cou_name=$row['cou_name'];
				$cou_code=$row['cou_code'];
				
				$output.=($selected==$cou_code)? "<option value='$cou_code' selected='selected'>$cou_name</option>" : "<option value='$cou_code'>$cou_name</option>";			  
				}				 
		}
			$output.='</select>';	

		return $output;	
	}

	/**
	 * This function is used to show the cart snap shot if no item found
	 *
	 
	 *
	 * @return HTML data
	 */
	
	function cartSnapShotElse()
	{
		$output='<div class="viewcartTXT"><font color="orange"><b>There is no item in your cart.</b></font></div>';
		return $output;
		
	}
	/**
	 * This function is used to show the quick registration
	 *
	 * @param   array  	$result	
	 * @param   object    $err    contains both error messages and values 
	 *
	 * @return HTML data
	 */
	
	function showQuickRegistration($result,$err)
	{		
	
	
	 $output='<div class="row-fluid">
        	<ul class="steps">

			<li class="act"><a href="#"><span>1. Email Login</span></a></li>		
					<li class="inact"><a href="#"><span>2. Billing Address</span></a></li>
				<li class="inact"><a href="#"><span>3. Shipping Address</span></a></li>
				<li class="inact"><a href="#"><span>4. Shipping Method</span></a></li>
				<li class="inact"><a href="#"><span>5. Order Confirmation</span></a></li>
				<li class="inact"><a href="#"><span>6. Payment Details</span></a></li>
				        
			</ul>
       			 </div><div class="row-fluid">
                    <div class="span6">
			<form name="f1" method="post" action="?do=showcart&action=doquickregistration">
                    	<div id="loginfrm">
                        		<ul class="loginfourm">
                                	<li><b>E-mail Address</b></li>
                                	<li><input type="text" class="input-large" name="txtregemail"><br />
	 				 <font color="#FF0000"><AJDF:output>'.$err['txtregemail'].'</AJDF:output></font></li>
                                    	<li><b>Password</b></li>
                                	<li><input type="password" name="txtregpass" class="input-large"><br />
	   				<font color="#FF0000"><AJDF:output>'.$err['txtregpass'].'</AJDF:output></font></li>
                                	<li><input type="checkbox"> Remember me?</li>
                                	<li><input type="submit" value="Login" class="btn btn-danger"> </li>
                                    <li><a href="#"> Forgot password? </a> <span>OR</span> <a href="#">Need help?</a> </li>
                                </ul>
                        </div>
			</form>	
                        </div>
                    	<div class="span6">
                         <div class="followus_div"><a class="facebook_btn" href="#"></a><a class="twitter_btn" href="#"></a><a class="google_btn" href="#"></a></div>
                    <p class="userlogin_fnt"><span>or log in using your username and Password</span></p>
                        	<div id="signin_acc">
                        	<ul class="signin-account">
                            	<li> <h5>SIGN UP FOR AN ACCOUNT</h5></li>
                                <li> <p>Registration is fast and FREE! </p></li>
                                <li><a href="?do=userregistration"> <input type="button" value="Register Here" class="btn btn-inverse"></a></li>
                            </ul>
                            <b>Account Protection Tips </b>
                            <ul class="acctips">
                            	<li>Choose a strong password and change it often.</li>
                                <li>Avoid using the same password for other accounts.</li>
                                <li>Create a unique password by using a combination of letters and numbers that are not easily guessed.</li>
                            </ul>
                            </div>
                    </div>
                        
                    </div>';

		return $output;

	}
	/**
	 * This function is used to show the PaymentPageForAuthorizenet
	 *
	 *
	 * @return HTML data
	 */
	function showPaymentPageForAuthorizenet()
	{
		
				$output='<div id="detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="roundbox_top" ></td>
		</tr>
		<tr>
		<td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="100%" colspan="2" class="serachresult">Your Shopping Cart</td>
		</tr>
		<tr>
		<td width="100%" colspan="2" class="" align="center"></td>
		</tr>
		<tr>
		<td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
			<td valign="top" style="border:#CCCCCC 1px solid; padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="100%" valign="top" style=""><div class="checkout_rigisterBox" style="width:100%">
			<form name="f1" method="post" action="?do=showcart&action=doauthorizenetpayment">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="checkout_title">Authorize.net Payment Information</td>
		</tr>
		<tr>
		<td align="left" class="checkout_text1">Credit Card Information</td>
		</tr>
		<tr>
		<td align="left" class="checkout_title1">Please enter details below:</td>
		</tr>
		<tr>
		<td align="center">
			
				<table width="75%" border="0">
					<tr>
						<td width="32%">Credit Card Number</td>
						<td width="68%"><input type="text" name="txtCardNumber" class="txtbox1 TxtC1" size="18"/></td>
					</tr>
					<tr>
						<td>Expiration Date</td><td>
						<select name="txt_cem" style="border:#99600c solid 1px;"> 
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>  <option value="06">06</option>  <option value="07">07</option>  <option value="08">08</option>  <option value="09">09</option>  <option value="10">10</option>  <option value="11">11</option>  <option value="12">12</option>  </select>  	
			&nbsp;&nbsp;&nbsp;&nbsp;<select name="txt_cey" style="border:#99600c solid 1px;">  <option value="07">2007</option>  <option value="08">2008</option>  <option value="09">2009</option>  <option value="10">2010</option>  <option value="11">2011</option>  <option value="12">2012</option>  <option value="13">2013</option>  <option value="14">2014</option>  <option value="15">2015</option>  <option value="16">2016</option>  <option value="17">2017</option>  <option value="18">2018</option>  <option value="19">2019</option>  <option value="20">2020</option>  <option value="21">2021</option>  <option value="22">2022</option>  <option value="23">2023</option>  <option value="24">2024</option>  <option value="25">2025</option>  <option value="26">2026</option>  <option value="27">2027</option>  <option value="28">2028</option>  <option value="29">2029</option>  <option value="30">2030</option>  </select>
		</td>
					</tr>
				</table>
				
			</td>
		</tr>
		<tr>
		<td style="padding:8px 0;"><table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="left" class="button_left" ></td>
			<td><input type="submit" name="Submit2" value="Continue" class="button" /></td>
			<td class="button_right"></td>
		</tr>
		</table></td>
		</tr>
		</table>
			</form>
			</div></td>
			
			</tr>
			</table></td>
		</tr>
		</table></td>
		</tr>
		
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</div>
			</td>
		</tr>
		<tr>
		<td class="roundbox_bottom" ></td>
		</tr>
		</table>
		</div>';

		return $output;

	}
	/**
	 * This function is used to showPaymentPageForBluepay
	 *
	 *
	 * @return HTML data
	 */
	function showPaymentPageForBluepay()
	{
				
		$bluepaydetails = explode("|",$_SESSION['bluepaydetails']);				
		$merchantid=$bluepaydetails[0];
		$sucess_url = $bluepaydetails[1];
		$cancel_url = $bluepaydetails[2];
		unset($_SESSION['bluepaydetails']);	
		

		
				$output='<div id="detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="roundbox_top" ></td>
		</tr>
		<tr>
		<td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="100%" colspan="2" class="serachresult">Your Shopping Cart</td>
		</tr>
		<tr>
		<td width="100%" colspan="2" class="" align="center"></td>
		</tr>
		<tr>
		<td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
			<td valign="top" style="border:#CCCCCC 1px solid; padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="100%" valign="top" style=""><div class="checkout_rigisterBox" style="width:100%">
			<form action="https://secure.bluepay.com/interfaces/bp10emu" method=POST>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="checkout_title"> Blue Pay Payment Information</td>
		</tr>
		<tr>
		<td align="left" class="checkout_text1">Credit Card Information</td>
		</tr>
		<tr>
		<td align="left" class="checkout_title1">Please enter details below:</td>
		</tr>
		<tr>
		<td align="center">		
				
				<table width="75%" border="0">
		
					<tr>
						<td width="32%">Name On the Card</td>
						<td width="68%"><input type="text" name="NAME" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					
					<tr>
						<td width="32%">Credit Card Number</td>
						<td width="68%"><input type="text" name="CC_NUM" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					
					<tr>
						<td width="32%">Expiration Date (mm/yy)</td>
						<td width="68%"><input type="text" name="CC_EXPIRES" class="txtbox1 TxtC1" size="25"/></td>
					</tr>		
					
					
					<tr>
						<td width="32%">CVV2</td>
						<td width="68%"><input type="text" name="CVCCVV2" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					
					<!--<tr>
						<td width="32%">Address</td>
						<td width="68%"><input type="text" name="ADDR1" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					<tr>
						<td width="32%">City</td>
						<td width="68%"><input type="text" name="CITY" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					<tr>
						<td width="32%">State</td>
						<td width="68%"><input type="text" name="STATE" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					<tr>
						<td width="32%">ZipCode</td>
						<td width="68%"><input type="text" name="ZIPCODE" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					<tr>
						<td width="32%">Phone</td>
						<td width="68%"><input type="text" name="PHONE" class="txtbox1 TxtC1" size="25"/></td>
					</tr>
					<tr>
						<td width="32%">Email</td>
						<td width="68%"><input type="text" name="EMAIL" class="txtbox1 TxtC1" size="25"/></td>
					</tr>-->
					
					<input type=hidden name=MERCHANT value="'.$merchantid.'">
					<input type=hidden name=TRANSACTION_TYPE value="AUTH">
					<input type=hidden name=TAMPER_PROOF_SEAL value="adfc2d7799ffa98fc18c301bd4476ab9">
					<input type=hidden name=APPROVED_URL value="'.$sucess_url.'&pay_type=17">
					<input type=hidden name=DECLINED_URL value="'.$cancel_url.'">
					<input type=hidden name=MISSING_URL  value="'.$sucess_url.'&pay_type=17">
					<input type=hidden name=MODE         value="TEST">
					<input type=hidden name=AUTOCAP      value="0">
					<input type=hidden name=REBILLING    value="">
					<input type=hidden name=REB_CYCLES   value="">
					<input type=hidden name=REB_AMOUNT   value="">
					<input type=hidden name=REB_EXPR     value="">
					<input type=hidden name=REB_FIRST_DATE value="">   
					<input type=hidden name=AMOUNT value="'.round($_SESSION['checkout_amount']).'">				   		
				</table>		
			</td>
		</tr>
		<tr>
		<td style="padding:8px 0;"><table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="left" class="button_left" ></td>
			<td><input type="submit" name="Submit2" value="Continue" class="button" /></td>
			<td class="button_right"></td>
		</tr>
		</table></td>
		</tr>
		</table>
			</form>
			</div></td>
			
			</tr>
			</table></td>
		</tr>
		</table></td>
		</tr>
		
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</div>
			</td>
		</tr>
		<tr>
		<td class="roundbox_bottom" ></td>
		</tr>
		</table>
		</div>';

		return $output;

	}
	/**
	 * This function is used to showPaymentPageForWorldPay
	 *
	 *
	 * @return HTML data
	 */
	
	function showPaymentPageForWorldPay($arr)
	{
		
				$output='<div id="detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="roundbox_top" ></td>
		</tr>
		<tr>
		<td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="100%" colspan="2" class="serachresult">Your Shopping Cart</td>
		</tr>
		<tr>
		<td width="100%" colspan="2" class="" align="center"></td>
		</tr>
		<tr>
		<td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
			<td valign="top" style="border:#CCCCCC 1px solid; padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="100%" valign="top" style=""><div class="checkout_rigisterBox" style="width:100%">
			<form action="https://select.worldpay.com/wcc/purchase" method=POST>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="checkout_title">WorldPay Payment Confirmation</td>
		</tr>
		<tr>
		<td align="left" class="checkout_title1">Please enter details below:</td>
		</tr>
		<tr>
		<td align="center">
			
				<table width="75%" border="0">
					<tr>
						<td width="68%">Your Checkout Amount is $ '.$arr['amount'].'</td>
						<td width="32%"></td>
					</tr>
					
				</table>
				
			</td>
		</tr>
		<tr>
		<td style="padding:8px 0;"><table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="left" class="button_left" ></td>
			<td>
							<input type=hidden name="instId" value="'.$arr['instId'].'">
							<input type=hidden name="cartId" value=" 122 "> 
							<input type=hidden name="amount" value="'.$arr['amount'].'">
							<input type=hidden name="currency" value="USD">
							<input type=hidden name="desc" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'">
							<input type=hidden name="testMode" value="100"> 
							<input type="hidden" name="MC_callback" value="'.$arr['MC_callback'].'" />
							
									
				<input type="submit" name="Submit2" value="Continue" class="button" /></td>
			<td class="button_right"></td>
		</tr>
		</table></td>
		</tr>
		</table>
			</form>
			</div></td>
			
			</tr>
			</table></td>
		</tr>
		</table></td>
		</tr>
		
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</div>
			</td>
		</tr>
		<tr>
		<td class="roundbox_bottom" ></td>
		</tr>
		</table>
		</div>';

		return $output;

	}
	/**
	 * This function is used to showPaymentPageFor2Checkout
	 *
	 *
	 * @return HTML data
	 */
	function showPaymentPageFor2Checkout($arr)
	{
				$output='<div id="detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="roundbox_top" ></td>
		</tr>
		<tr>
		<td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="100%" colspan="2" class="serachresult">Your Shopping Cart</td>
		</tr>
		<tr>
		<td width="100%" colspan="2" class="" align="center"></td>
		</tr>
		<tr>
		<td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
			<td valign="top" style="border:#CCCCCC 1px solid; padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="100%" valign="top" style=""><div class="checkout_rigisterBox" style="width:100%">
			<form id="form2co" name="form2co" method="post" 		
							action="https://www.2checkout.com/2co/buyer/purchase">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="checkout_title">2Checkout Payment Confirmation</td>
		</tr>
		
		<tr>
		<td align="center">
			
				<table width="75%" border="0">
					<tr>
						<td width="68%">Your Checkout Amount is $ '.$arr['total'].'</td>
						<td width="32%"></td>
					</tr>
					
				</table>
				
			</td>
		</tr>
		<tr>
		<td style="padding:8px 0;"><table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="left" class="button_left" ></td>
			<td>
							
				<input type="hidden" name="sid" value="'.$arr['sid'].'" />
				<input type="hidden" name="cart_order_id" value="100" />
				<input type="hidden" name="total" value="'.$arr['total'].'" /><input type="hidden" name="demo" value="Y" />
				<input type="hidden" name="fixed" value="Y" /><input type="hidden" name="return_url" value="'.$arr['return_url'].'" />
				<input type="hidden" name="lang" value="en" />
				<input type="hidden" name="card_holder_name" value="" />			
									
				<input type="submit" name="Submit2" value="Continue" class="button" /></td>
			<td class="button_right"></td>
		</tr>
		</table></td>
		</tr>
		</table>
			</form>
			</div></td>
			
			</tr>
			</table></td>
		</tr>
		</table></td>
		</tr>
		
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</div>
			</td>
		</tr>
		<tr>
		<td class="roundbox_bottom" ></td>
		</tr>
		</table>
		</div>';

		return $output;

	}
	/**
	 * This function is used to show the Billing address.
	 *
	 * @param   array  	$records	array of address
	 * @param   array  	$result	        array of country 
	 * @param   object  Err   contains both error messages and values
	 *
	 * @return HTML data
	 */	
	function showBillingDetails($records,$result,$Err)
	{

		$obj=new Display_DAddCart();
		$res=$obj->loadCountryDropDown($result,'selbillcountry',$Err->values['selbillcountry']);
			

		$output='<div class="row-fluid">
        		<ul class="steps">
			<li class="inact"><a href="#"><span>1. Email Login</span></a></li>		
			<li class="act"><a href="#"><span>2. Billing Address</span></a></li>
			<li class="inact"><a href="#"><span>3. Shipping Address</span></a></li>
			<li class="inact"><a href="#"><span>4. Shipping Method</span></a></li>
			<li class="inact"><a href="#"><span>5. Order Confirmation</span></a></li>
			<li class="inact"><a href="#"><span>6. Payment Details</span></a></li>
				        
			</ul>
        		</div><div class="row-fluid">
                       <div class="span4">
                         
                      <p class="billing_title">Select from previous address</p>
                      
                      <ul class="addresslist">';

			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
                      			$output.='<li><address>
                                    	<h5>'.$records[$i]['contact_name'].'</h5>
                                        <p>'.$records[$i]['address'].'</p>
                                        <p>'.$records[$i]['city'].'</p>
					 <p>'.$records[$i]['state'].'</p>
					 <p>'.$records[$i]['zip'].'</p>	
                                        <a href="#"><img src="assets/img/click-btn-hov.gif" alt="click"></a>
                                    	</address></li>';
				}

			}
	
                      $output.='</ul>

         `		 </div>	
                    <div class="span8">

                    <div id="myaccount_div">
                    <div class="or_ribbion"><img src="assets/img/or.png" width="38" height="300" alt="or"></div>
                    <p class="billing_title">Enter a new billing address</p>
                    	<form method="POST" action="?do=showcart&action=validatebillingaddress" name="billingaddress" class="form-horizontal">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <p class="info_fnt">
                         Fields marked with an <span class="red_fnt">*</span> are required 
                      </p>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Name <span class="red_fnt">*</span></label>
                    <div class="controls">
                      <input type="text"  class="input-xlarge" name="txtname" id="txtname" value='.$Err->values['txtname'].'><br /><font color="#FF0000">'.$Err->messages['txtname'].'</font>

                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Company</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtcompany" id="txtcompany" value="'.$Err->values['txtcompany'].'">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Address<span class="red_fnt">*</span></label>
                    <div class="controls">
                     <textarea rows="3" style="width: 273px; height: 75px;" name="txtstreet"  id="txtstreet">'.$Err->values['txtstreet'].'</textarea>
		<br /> <font color="#FF0000">'.$Err->messages['txtstreet'].'</font>
                    </div>
                  </div>
		
		<div class="control-group">
                    <label class="control-label" for="input01"> City <span class="red_fnt">*</span></label>
                    <div class="controls">
                     <input type="text" class="input-xlarge"  name="txtcity" id="txtcity"  value='.$Err->values['txtcity'].'><br /><font color="#FF0000">'.$Err->messages['txtcity'].'</font>
                    </div>
                  </div>

	  <div class="control-group">
                    <label class="control-label" for="input01">SubUrb
			</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtsuburb" id="txtsuburb" value="'.$Err->values['txtsuburb'].'">
                    </div>
                  </div>

  		<div class="control-group">
                    <label class="control-label" for="input01">State/Province<span class="red_fnt">*</span></label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtstate" id="txtstate" value="'.$Err->values['txtstate'].'"><br /><font color="#FF0000">'.$Err->messages['txtstate'].'</font>
                    </div>
                  </div>
  		<div class="control-group">
                    <label class="control-label" for="input01">Country<span class="red_fnt">*</span></label>
                    <div class="controls">
                     '.$res.'<br /><font color="#FF0000">'.$Err->messages['selbillcountry'].'</font>
                    </div>
                  </div>

 		  <div class="control-group">
                    <label class="control-label" for="input01">Zip/Postal Code <span class="red_fnt">*</span></label>
                    <div class="controls">
                     <div id="txtHint"><input type="text"  class="input-xlarge" id="txtzipcode" name="txtzipcode" value="'.$Err->values['txtzipcode'].'"><br /><font color="#FF0000">'.$Err->messages['txtzipcode'].'</font></div>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="input01">Phone <span class="red_fnt">*</span> </label>
                    <div class="controls">
                      <input type="text"  class="input-xlarge" id="txtphone" name="txtphone" value="'.$Err->values['txtphone'].'"><br /><font color="#FF0000">'.$Err->messages['txtphone'].'</font>
                    </div>
                  </div>
   		
		
                  <div class="form-actions">
                    <button type="submit" class="btn btn-large btn-inverse">Submit</button>
                  </div>
                </fieldset>
              </form>
		</div>
                        </div>
          </div>';
		
		return $output;
	}
	/**
	 * This function is used to show the shipping address.
	 *
	 * @param   array  	$records	array of address
	 * @param   array  	$result	        array of country 
	 * @param   object  Err   contains both error messages and values
	 *
	 * @return HTML data
	 */	
	function showShippingDetails($records,$result,$Err)
	{

		$obj=new Display_DAddCart();
		$resship=$obj->loadCountryDropDown($result,'selshipcountry',$Err->values['selshipcountry']);

		$output='<div class="row-fluid">
        	<ul class="steps">

			<li class="inact"><a href="#"><span>1. Email Login</span></a></li>		
					<li class="inact"><a href="?do=showcart&action=getaddressdetails"><span>2. Billing Address</span></a></li>
				<li class="act"><a href="#"><span>3. Shipping Address</span></a></li>
				<li class="inact"><a href="#"><span>4. Shipping Method</span></a></li>
				<li class="inact"><a href="#"><span>5. Order Confirmation</span></a></li>
				<li class="inact"><a href="#"><span>6. Payment Details</span></a></li>
				        
	</ul>
        </div><div class="row-fluid">
                    <div class="span4">
                         
                      <p class="billing_title">Select from previous address</p>
                      
                      <ul class="addresslist">';
                      	
			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
                      			$output.='<li><address>
                                    	<h5>'.$records[$i]['contact_name'].'</h5>
                                        <p>'.$records[$i]['address'].'</p>
                                        <p>'.$records[$i]['city'].'</p>
					 <p>'.$records[$i]['state'].'</p>
					 <p>'.$records[$i]['zip'].'</p>	
                                        <a href="#"><img src="assets/img/click-btn-hov.gif" alt="click"></a>
                                    	</address></li>';
				}

			}
                     $output.='</ul>

          </div>	
                    <div class="span8">

                    <div id="myaccount_div">
                    <div class="or_ribbion"><img src="assets/img/or.png" width="38" height="300" alt="or"></div>
                    <p class="billing_title">Enter a new shipping address</p>
                    	<form method="POST" action="?do=showcart&action=validateshippingaddress" name="register_form" class="form-horizontal">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <p class="info_fnt">
                         Fields marked with an <span class="red_fnt">*</span> are required 
                      </p>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Name <span class="red_fnt">*</span></label>
                    <div class="controls">
                      <input type="text"  class="input-xlarge" name="txtname" id="txtname" value='.$Err->values['txtname'].'><br /><font color="#FF0000">'.$Err->messages['txtname'].'</font>

                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Company</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtcompany" id="txtcompany" value="'.$Err->values['txtcompany'].'">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Address<span class="red_fnt">*</span></label>
                    <div class="controls">
                     <textarea rows="3" style="width: 273px; height: 75px;"  name="txtstreet"  id="txtstreet">'.$Err->values['txtstreet'].'</textarea>
		<br /> <font color="#FF0000">'.$Err->messages['txtstreet'].'</font>
                    </div>
                  </div>
		
		<div class="control-group">
                    <label class="control-label" for="input01"> City <span class="red_fnt">*</span></label>
                    <div class="controls">
                     <input type="text" class="input-xlarge"  name="txtcity" id="txtcity"  value='.$Err->values['txtcity'].'><br /><font color="#FF0000">'.$Err->messages['txtcity'].'</font>
                    </div>
                  </div>

	  <div class="control-group">
                    <label class="control-label" for="input01">SubUrb
			</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtsuburb" id="txtsuburb" value="'.$Err->values['txtsuburb'].'">
                    </div>
                  </div>

  		<div class="control-group">
                    <label class="control-label" for="input01">State/Province<span class="red_fnt">*</span></label>
                    <div class="controls">
                      <input type="text" class="input-xlarge"  name="txtstate" id="txtstate" value="'.$Err->values['txtstate'].'"><br /><font color="#FF0000">'.$Err->messages['txtstate'].'</font>
                    </div>
                  </div>
  		<div class="control-group">
                    <label class="control-label" for="input01">Country<span class="red_fnt">*</span></label>
                    <div class="controls">
                     '.$resship.'<br /><font color="#FF0000">'.$Err->messages['selshipcountry'].'</font>
                    </div>
                  </div>

 		  <div class="control-group">
                    <label class="control-label" for="input01">Zip/Postal Code <span class="red_fnt">*</span></label>
                    <div class="controls">
                     <div id="txtHint"><input type="text"  class="input-xlarge" id="txtzipcode" name="txtzipcode" value="'.$Err->values['txtzipcode'].'"><br /><font color="#FF0000">'.$Err->messages['txtzipcode'].'</font></div>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="input01">Phone <span class="red_fnt">*</span> </label>
                    <div class="controls">
                      <input type="text"  class="input-xlarge" id="txtphone" name="txtphone" value="'.$Err->values['txtphone'].'"><br /><font color="#FF0000">'.$Err->messages['txtphone'].'</font>
                    </div>
                  </div>
   		
		
                  <div class="form-actions">
                    <button type="submit" class="btn btn-large btn-inverse">Submit</button>
                  </div>
                </fieldset>
              </form>
		</div>
                        </div>
          </div>';
		
		return $output;
	}
	function showShippingMethod()
	{
		$output='<div class="row-fluid">
        	<ul class="steps">

			<li class="inact"><a href="#"><span>1. Email Login</span></a></li>		
					<li class="inact"><a href="?do=showcart&action=getaddressdetails"><span>2. Billing Address</span></a></li>
				<li class="inact"><a href="?do=showcart&action=getshippingaddressdetails&chk=0"><span>3. Shipping Address</span></a></li>
				<li class="act"><a href="#"><span>4. Shipping Method</span></a></li>
				<li class="inact"><a href="#"><span>5. Order Confirmation</span></a></li>
				<li class="inact"><a href="#"><span>6. Payment Details</span></a></li>
				        
	</ul>
        </div><div class="row-fluid">
                    <div class="span4">
                         
                      <p class="billing_title">Select from previous address</p>
                      
                      <ul class="addresslist">
                      	<li><address>
                                    	<h5>Karthik Kumar</h5>
                                        <p>132, Annamalai Street, Madurai - 20.</p>
                                        <p>Tamil Nadu.</p>
                                        <a href="#"><img src="assets/img/click-btn-hov.gif" alt="click"></a>
                                    </address></li>
                      	<li><address>
                                    	<h5>Karthik Kumar</h5>
                                        <p>132, Annamalai Street, Madurai - 20.</p>
                                        <p>Tamil Nadu.</p>
                                        <a href="#"><img src="assets/img/close-icn.gif" alt="click"></a>
                                    </address></li>
                      	<li><address>
                                    	<h5>Karthik Kumar</h5>
                                        <p>132, Annamalai Street, Madurai - 20.</p>
                                        <p>Tamil Nadu.</p>
                                        <a href="#"><img src="assets/img/click-btn-hov.gif" alt="click"></a>
                                    </address></li>
                      	<li><address>
                                    	<h5>Karthik Kumar</h5>
                                        <p>132, Annamalai Street, Madurai - 20.</p>
                                        <p>Tamil Nadu.</p>
                                        <a href="#"><img src="assets/img/close-icn.gif" alt="click"></a>
                                    </address></li>
                      </ul>
                                	
                                    
          </div>	
                    <div class="span8">
                     
                    
                    <div id="myaccount_div">
                    <div class="or_ribbion"><img src="assets/img/or.png" width="38" height="300" alt="or"></div>
                    <p class="billing_title">Enter a new shipping address</p>
                    	<form method="POST" action="?do=showcart&action=showorderconfirmation" name="register_form" class="form-horizontal">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <p class="info_fnt">
                         Fields marked with an <span class="error_fnt">*</span> are required 
                      </p>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">First Name <span class="error_fnt">*</span></label>
                    <div class="controls">
                      <input type="text" value="" class="input-xlarge" name="first_name" id="first_name">

                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Last Name</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" value="" name="last_name" id="last_name">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="input01">Email Address <span class="error_fnt">*</span></label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" value="" name="email" id="email">
                    </div>
                  </div>
		
		<div class="control-group">
                    <label class="control-label" for="input01"> </label>
                    <div class="controls">
                    <p class="info_txt">Note:A Valid email address is required to complete registration <br>
                  Example: demo@example.com</p>
                    </div>
                  </div>

	  <div class="control-group">
                    <label class="control-label" for="input01">Re-enter Email <span class="error_fnt">*</span></label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" value="" name="remail" id="remail">
                    </div>
                  </div>

  		<div class="control-group">
                    <label class="control-label" for="input01">Password <span class="error_fnt">*</span></label>
                    <div class="controls">
                      <input type="password" class="input-xlarge" value="" name="pwd" id="pwd">
                    </div>
                  </div>
  		<div class="control-group">
                    <label class="control-label" for="input01">Confirm Password <span class="error_fnt">*</span></label>
                    <div class="controls">
                      <input type="password" class="input-xlarge" value="" name="cpwd" id="cpwd">
                    </div>
                  </div>
	

                  

                   

 		  <div class="control-group">
                    <label class="control-label" for="input01">State </label>
                    <div class="controls">
                     <div id="txtHint"><input type="text" value="" class="input-xlarge" id="state" name="state"></div>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="input01">City </label>
                    <div class="controls">
                      <input type="text" value="" class="input-xlarge" id="city" name="city">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="textarea">Address 1</label>
                    <div class="controls">
 			<input type="text" class="input-xlarge" value="" id="address" name="address">
                    </div>
                  </div>

		<div class="control-group">
                    <label class="control-label" for="textarea">Address 2</label>
                    <div class="controls">
			<input type="text" class="input-xlarge" value="" id="address2" name="address2">
                      </div>
                  </div>

    		<div class="control-group">
                    <label class="control-label" for="input01">Zipcode </label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" value="" id="zcode" name="zcode">
                    </div>
                  </div>
    		<div class="control-group">
                    <label class="control-label" for="input01">Phone Number </label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" value="" id="pnumber" name="pnumber">
                    </div>
                  </div>

   		
		
                  <div class="form-actions">
                    <button type="submit" class="btn btn-large btn-inverse">Submit</button>
                  </div>
                </fieldset>
              </form>
		</div>
                        </div>
          </div>';

		return $output;

	}
	function showShippingDetails_new($result,$output,$addrbook,$addrbookshipping)
	{
		
		
		
		if($Err->messages>0)
		{
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		}
		//print_r($output['val']);
				
		

		$obj=new Display_DAddCart();
		$res=$obj->loadCountryDropDown($result,'selbillcountry',$output['val']['selbillcountry']);
		$resship=$obj->loadCountryDropDown($result,'selshipcountry',$output['val']['selshipcountry']);

		$output='<div id="detail"><form name="frmship" method="post" action="?do=showcart&action=showorderconfirmation">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="roundbox_top" ></td>
  </tr>
  <tr>
    <td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" colspan="2" class="serachresult">Your Shopping Cart</td>
    </tr>
  
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		<div class="checkout_tab2">Account Details</div>
		<div class="checkout_tab1">Address Details</div>
		<div class="checkout_tab2">Order Confirmation</div>

		<div class="checkout_tab2">Payment Details</div>
		</td>
      </tr>
	  
      <tr>
        <td valign="top" style="border:#CCCCCC 1px solid; padding:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr><td class="checkout_rigistration"><table class="checkout_rigistration"><tr><td>Billing Address</td></tr></table></td></tr>
          <tr><td class="checkout_rigistration"><table class="checkout_rigistration" border=0 width="100%"><tr><td><input type="radio" name="addressbook" onClick="document.getElementById(\'addressbook\').style.display=\'block\';document.getElementById(\'billingentry\').style.display=\'none\';"></td><td><div>Use Address From Address Book</div></td><td><input type="radio" name="addressbook" onClick=" window.open(\'?do=showcart&action=addnewaddressfromshipping\',\'a\',\'height=529,width=490,menubar=0,status=0,toolbar=0,scrollbars=0,location=0,minimize=0,resizable=0\');document.getElementById(\'addressbook\').style.display=\'none\';document.getElementById(\'billingentry\').style.display=\'block\';clearBillingValues();"></td><td><div>Use A New Address</div></td></tr></table></td></tr>
		  <tr>
            <td align="left" valign="top">
			<table width="80%"  border="0" cellspacing="0" cellpadding="0" class="" id="addressbook" style="display:none">
                <tr>
                  <td colspan="3">
				  	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    	<!--<tr>
                		  <td><table class="checkout_rigistration"><tr><td>Billing Address</td></tr></table></td>
               			</tr>-->
						<tr>
                      		<td valign="top"><div>'.$addrbook.'</div></td>
						</tr>
					</table>
				  </td>
                </tr>
             	 <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration">
                   <!-- <tr>
                      <td valign="top"><div>
                          <input type="checkbox" name="chkall2" id="chkall2" value="checkbox" onClick="javascript:getValues();" />
                        Use Billing Address as Shipping Address </div></td>
                    </tr>-->
            </table></td>
                </tr>
            </table>
			
			<table width="80%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration" id="billingentry" style="display:block">
                <tr>
                  <td><!--Billing Address--></td>
                  <td>&nbsp;</td>
                  <td><span class="checkout_required" style="padding-left:200px;">* Required Fields</span></td>
                </tr>
                <tr>
                  <td width="26%">Name <span>*</span></td>
                  <td width="4%">:</td>
                  <td width="70%"><input name="txtname" type="text" class="txtbox1 w4 TxtC1" id="txtname" value="'.$output["val"]["txtname"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtname"].'</span></td>
                </tr>
                
                <tr>
                  <td>Company</td>
                  <td>:</td>
                  <td><input name="txtcompany" type="text" class="txtbox1 w4 TxtC1" id="txtcompany" value="'.$output["val"]["txtcompany"].'" /></td>
                </tr>
                <tr>
                  <td>Address <span>*</span></td>
                  <td>:</td>
                  <td><input name="txtstreet" type="text" class="txtbox1 w4 TxtC1" id="txtstreet" value="'.$output["val"]["txtstreet"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtstreet"].'</span></td>
                </tr>
                <tr>
                  <td>City <span>*</span></td>
                  <td>:</td>
                  <td><input name="txtcity" type="text" class="txtbox1 w4 TxtC1" id="txtcity" value="'.$output["val"]["txtcity"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtcity"].'</span></td>
                </tr>
				 <tr>
                  <td>SubUrb <span><!--*--></span></td>
                  <td>:</td>
                  <td><input name="txtsuburb" type="text" class="txtbox1 w4 TxtC1" id="txtsuburb" value="'.$output["val"]["txtsuburb"].'"/></td>
                </tr>
                <tr>
                  <td>State/Province <span>*</span></td>
                  <td>:</td>
                  <td><input name="txtstate" type="text" class="txtbox1 w4 TxtC1" id="txtstate" value="'.$output["val"]["txtstate"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtstate"].'</span></td>
                </tr>
				<tr>
                  <td>Country <span>*</span></td>
                  <td>:</td>
                  <td>'.$res.'<!--<select name="selbillcountry" id="selbillcountry" class="listbox1 w4a TxtC1">
                      <option>State / Province</option>
                  </select>--><span style="color:#FF0000"> '.$output["msg"]["selbillcountry"].'</span></td>
                </tr>
                <tr>
                  <td>Zip/Postal Code <span>*</span></td>
                  <td>:</td>
                  <td><input name="txtzipcode" type="text" class="txtbox1 w4 TxtC1" id="txtzipcode" value="'.$output["val"]["txtzipcode"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtzipcode"].'</span></td>
                </tr>
                
               
               <!-- <tr>
                  <td colspan="3" style="padding-top:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="top"><div>
                          <input type="radio" name="chkall1" id="chkall1" value="checkbox" onClick="javascript:getValues();" />
                        Use Billing Address as Shipping Address </div></td>
                    </tr>
                  </table></td>
                </tr>-->

            </table>			</td>
          </tr>
		  <tr><td align="left"><table class="checkout_rigistration"><tr><td>Shipping Address</td></tr></table></td></tr>
		  <tr>
		  	<td align="left"><table class="checkout_rigistration" border=0 width="100%"><tr><td><input type="radio" name="ship_addressbook" onClick="document.getElementById(\'shipaddressbook\').style.display=\'none\';document.getElementById(\'shippingentry\').style.display=\'block\';getSameAddress()" value=""></td><td><div>Use Billing Address as Shipping Address</div></td><td><input type="radio" name="ship_addressbook" onClick="document.getElementById(\'shipaddressbook\').style.display=\'block\';document.getElementById(\'shippingentry\').style.display=\'none\';document.frmship.ship_addressbook[0].value=\'\';" value="fromaddressbook"></td><td><div>Use Address From Address Book</div></td><td><input type="radio" name="ship_addressbook" onClick="document.getElementById(\'shipaddressbook\').style.display=\'none\';document.getElementById(\'shippingentry\').style.display=\'block\';document.frmship.ship_addressbook[0].value=\'\';clearShippingValues();" value="new" checked="checked"></td><td><div>Use A New Address</div></td></tr></table>
			</td>
		  </tr>
          <tr>
            <td align="left"><table width="80%"  border="0" cellspacing="0" cellpadding="0" class="" id="shipaddressbook" style="display:none">
                <tr>
                  <td colspan="3">
				  	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    	<!--<tr>
                		  <td><table class="checkout_rigistration"><tr><td>Billing Address</td></tr></table></td>
               			</tr>-->
						<tr>
                      		<td valign="top"><div>'.$addrbookshipping.'</div></td>
						</tr>
					</table>
				  </td>
                </tr>
             	 <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration">
                   <!-- <tr>
                      <td valign="top"><div>
                          <input type="checkbox" name="chkall2" id="chkall2" value="checkbox" onClick="javascript:getValues();" />
                        Use Billing Address as Shipping Address </div></td>
                    </tr>-->
            </table></td>
                </tr>
            </table><table width="80%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration" id="shippingentry">
              <tr>
                <td><!--Shipping Address--></td>
                <td>&nbsp;</td>
                <td style="padding-left:200px;"><span class="checkout_required">* Required Fields</span></td>
              </tr>
              <tr>
                <td width="26%">Name <span>*</span></td>
                <td width="4%">:</td>
                <td width="70%"><input name="txtsname" type="text" class="txtbox1 w4 TxtC1" id="txtsname" value="'.$output["val"]["txtsname"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtsname"].'</span></td>
              </tr>
              
              <tr>
                <td>Company</td>
                <td>:</td>
                <td><input name="txtscompany" type="text" class="txtbox1 w4 TxtC1" id="txtscompany" value="'.$output["val"]["txtscompany"].'"/></td>
              </tr>
              <tr>
                <td>Address <span>*</span></td>
                <td>:</td>
                <td><input name="txtsstreet" type="text" class="txtbox1 w4 TxtC1" id="txtsstreet" value="'.$output["val"]["txtsstreet"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtsstreet"].'</span></td>
              </tr>
              <tr>
                <td>City <span>*</span></td>
                <td>:</td>
                <td><input name="txtscity" type="text" class="txtbox1 w4 TxtC1" id="txtscity" value="'.$output["val"]["txtscity"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtscity"].'</span></td>
              </tr>
			   <tr>
                <td>SubUrb <span><!--*--></span></td>
                <td>:</td>
                <td><input name="txtssuburb" type="text" class="txtbox1 w4 TxtC1" id="txtssuburb" value="'.$output["val"]["txtssuburb"].'"/></td>
              </tr>
              <tr>
                <td>State/Province <span>*</span></td>
                <td>:</td>
                <td><input name="txtsstate" type="text" class="txtbox1 w4 TxtC1" id="txtsstate" value="'.$output["val"]["txtsstate"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtsstate"].'</span></td>
              </tr>
              
              <tr>
                <td>Country <span>*</span></td>
                <td>:</td>
                <td>'.$resship.'<!--<select name="selshipcountry" id="selshipcountry" class="listbox1 w4a TxtC1">
                    <option>State / Province</option>
                </select>--><span style="color:#FF0000"> '.$output["msg"]["selshipcountry"].'</span></td>
              </tr>
             <tr>
                <td>Zip/Postal Code <span>*</span></td>
                <td>:</td>
                <td><input name="txtszipcode" type="text" class="txtbox1 w4 TxtC1" id="txtszipcode" value="'.$output["val"]["txtszipcode"].'"/><span style="color:#FF0000"> '.$output["msg"]["txtszipcode"].'</span></td>
              </tr>

            </table>
			
			</td>
          </tr>
          <tr>
            <td align="center" class="dot_line"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="right"><!--<span class="checkout_required">* Required Fields</span>--><br />
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="right" class="button_left" ></td>
                          <td><input type="submit" name="Submit2" value="Continue" class="button" /></td>
                          <td class="button_right" ></td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    </tr>
  
</table>
</div>
	</td>
  </tr>
  <tr>
    <td class="roundbox_bottom" ></td>
  </tr>
</table></form>
</div><script> 
			function getValues()
			{
			  var bname=document.frmship.txtname;
			  var bcompany=document.frmship.txtcompany;
			  var bstreet=document.frmship.txtstreet;
			  var bcity=document.frmship.txtcity;
			  var bsuburb=document.frmship.txtsuburb;
  			  var bzipcode=document.frmship.txtzipcode;	
   			  
			  document.frmship.selshipcountry.selectedIndex=document.frmship.selbillcountry.selectedIndex;

			  		  		  
   			  var bstate=document.frmship.txtstate;			  		  
			  
			  
			  var  sname=document.frmship.txtsname;
			  var scompany= document.frmship.txtscompany;
			  var sstreet= document.frmship.txtsstreet;
			  var scity=document.frmship.txtscity;
			  var ssuburb=document.frmship.txtssuburb;
   			  var szipcode=document.frmship.txtszipcode;
  			  var scountry=document.frmship.selshipcountry;

   			  
   			  var sstate=document.frmship.txtsstate;			  		  		  
			  
			  var chkstatus1=document.frmship.chkall1;
			  var chkstatus2=document.frmship.chkall2;
			  //alert(chkstatus1.checked+chkstatus2.checked);
			  if(chkstatus1.checked || chkstatus2.checked)
			  {
				  sname.value=bname.value;
				  scompany.value=bcompany.value;
				  sstreet.value=bstreet.value;
				  scity.value=bcity.value;
				  ssuburb.value=bsuburb.value;
				  szipcode.value=bzipcode.value;
				
				  sstate.value=bstate.value;
			  }
			  else
			  {
			      sname.value="";
				  scompany.value="";
				  sstreet.value="";
				  scity.value="";
				  ssuburb.value="";
				  szipcode.value="";
				  scountry.value="";
				  sstate.value="";
			  }
	 
			}
			
			function getSameAddress()
			{
			  document.frmship.ship_addressbook[0].value="same";
			  var bname=document.frmship.txtname;
			  var bcompany=document.frmship.txtcompany;
			  var bstreet=document.frmship.txtstreet;
			  var bcity=document.frmship.txtcity;
			  var bsuburb=document.frmship.txtsuburb;
  			  var bzipcode=document.frmship.txtzipcode;	
   			  
			  document.frmship.selshipcountry.selectedIndex=document.frmship.selbillcountry.selectedIndex;

			  		  		  
   			  var bstate=document.frmship.txtstate;			  		  
			  
			  
			  var  sname=document.frmship.txtsname;
			  var scompany= document.frmship.txtscompany;
			  var sstreet= document.frmship.txtsstreet;
			  var scity=document.frmship.txtscity;
			  var ssuburb=document.frmship.txtssuburb;
   			  var szipcode=document.frmship.txtszipcode;
  			  var scountry=document.frmship.selshipcountry;

   			  
   			  var sstate=document.frmship.txtsstate;			  		  		  
			  
			  sname.value=bname.value;
			  scompany.value=bcompany.value;
			  sstreet.value=bstreet.value;
			  scity.value=bcity.value;
			  ssuburb.value=bsuburb.value;
			  szipcode.value=bzipcode.value;
			
			  sstate.value=bstate.value;
			  
	 
			}
			
			function clearShippingValues()
			{
			  var bname=document.frmship.txtname;
			  var bcompany=document.frmship.txtcompany;
			  var bstreet=document.frmship.txtstreet;
			  var bcity=document.frmship.txtcity;
			  var bsuburb=document.frmship.txtsuburb;
  			  var bzipcode=document.frmship.txtzipcode;	
   			  
			  document.frmship.selshipcountry.selectedIndex=document.frmship.selbillcountry.selectedIndex;

			  		  		  
   			  var bstate=document.frmship.txtstate;			  		  
			  
			  
			  var  sname=document.frmship.txtsname;
			  var scompany= document.frmship.txtscompany;
			  var sstreet= document.frmship.txtsstreet;
			  var scity=document.frmship.txtscity;
			  var ssuburb=document.frmship.txtssuburb;
   			  var szipcode=document.frmship.txtszipcode;
  			  var scountry=document.frmship.selshipcountry;

   			  
   			  var sstate=document.frmship.txtsstate;			  		  		  
			  
			  
			  sname.value="";
			  scompany.value="";
			  sstreet.value="";
			  scity.value="";
			  ssuburb.value="";
			  szipcode.value="";
			  scountry.value="";
			  sstate.value="";
			  
	 
			}
			
			function clearBillingValues()
			{
			 
			  document.frmship.txtname.value="";
			  document.frmship.txtcompany.value="";
			  document.frmship.txtstreet.value="";
			  document.frmship.txtcity.value="";
			  document.frmship.txtsuburb.value="";
  			  document.frmship.txtzipcode.value="";	
   			  document.frmship.selbillcountry.value="";
	  		  document.frmship.txtstate.value="";
			  //alert(document.frmship.ship_addressbook[0].value);
			  if (document.frmship.ship_addressbook[0].value=="same")
			  	getSameAddress();			
			}
			
			function getValuesFormAddressBook(str)
			{
			  arr=str.split("~");
			  //alert(arr[0]);
			  document.frmship.txtname.value=arr[2]+" "+arr[3];
			  document.frmship.txtcompany.value=arr[4];
			  document.frmship.txtstreet.value=arr[6];
			  document.frmship.txtcity.value=arr[7];
			  document.frmship.txtsuburb.value=arr[8];
  			  document.frmship.txtzipcode.value=arr[11];	
   			  document.frmship.selbillcountry.value=arr[10];
	  		  document.frmship.txtstate.value=arr[9];
			  //alert(document.frmship.ship_addressbook[0].value);
			  if (document.frmship.ship_addressbook[0].value=="same")
			  	getSameAddress();			
			}
			function getValuesFormAddressBookForShipping(str)
			{
			  arr=str.split("~");
			  //alert(arr[0]);
			  document.frmship.txtsname.value=arr[2]+" "+arr[3];
			  document.frmship.txtscompany.value=arr[4];
			  document.frmship.txtsstreet.value=arr[6];
			  document.frmship.txtscity.value=arr[7];
			  document.frmship.txtssuburb.value=arr[8];
  			  document.frmship.txtszipcode.value=arr[11];	
   			  document.frmship.selshipcountry.value=arr[10];
	  		  document.frmship.txtsstate.value=arr[9];	
			  
			 				
			}
			</script>';
		return $output;
	}
	function showOrderConfirmation($arr,$result,$taxarray,$message='')
	{
		//echo "<pre>";
		//print_r($arr);
		//exit();
	 		 
	  $out='<div class="row-fluid">
        	<ul class="steps">

			<li class="inact"><a href="#"><span>1. Email Login</span></a></li>		
				<li class="inact"><a href="?do=showcart&action=getaddressdetails"><span>2. Billing Address</span></a></li>
				<li class="inact"><a href="?do=showcart&action=getshippingaddressdetails&chk=0"><span>3. Shipping Address</span></a></li>
				<li class="inact"><a href="?do=showcart&action=getshippingmethod&chk=0"><span>4. Shipping Method</span></a></li>
				<li class="act"><a href="?do=showcart&action=showorderconfirmation"><span>5. Order Confirmation</span></a></li>
				<li class="inact"><a href="#"><span>6. Payment Details</span></a></li>
				        
		</ul>
		</div><div id="myaccount_div">
            <table class="rt cf" id="rt1">
		<thead class="cf">
			<tr>
				<th>Gallery View</th>
				<th>Product Name</th>
				<th>Qty</th>
				<th>Sub Total</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><a href="#"><img src="assets/img/close_button.gif" alt="close">	</a>			  <div class="showcart_box"><img src="assets/img/products/012.jpg" alt="01"></div></td>
			  <td ><a href="#">ORGANIC SEAWEED EXTRACT FERTILIZER</a></td>
				<td>1</td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
				<td><a href="#"><img src="assets/img/close_button.gif" alt="close">	</a>			  <div class="showcart_box"><img src="assets/img/products/012.jpg" alt="01"></div></td>
			  <td ><a href="#">ORGANIC SEAWEED EXTRACT FERTILIZER</a></td>
				<td>1</td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
				<td><a href="#"><img src="assets/img/close_button.gif" alt="close">	</a>			  <div class="showcart_box"><img src="assets/img/products/012.jpg" alt="01"></div></td>
			  <td ><a href="#">ORGANIC SEAWEED EXTRACT FERTILIZER</a></td>
				<td>1</td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
				<td><a href="#"><img src="assets/img/close_button.gif" alt="close">	</a>			  <div class="showcart_box"><img src="assets/img/products/012.jpg" alt="01"></div></td>
			  <td ><a href="#">ORGANIC SEAWEED EXTRACT FERTILIZER</a></td>
				<td>1</td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
				<td><a href="#"><img src="assets/img/close_button.gif" alt="close">	</a>			  <div class="showcart_box"><img src="assets/img/products/012.jpg" alt="01"></div></td>
			  <td ><a href="#">ORGANIC SEAWEED EXTRACT FERTILIZER</a></td>
				<td>1</td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
				<td colspan="2" rowspan="5">&nbsp;</td>
			  <td><strong>Sub Total</strong></td>
				<td><span class="label label-success">INR  1,500.00</span></td>
			</tr>
			<tr>
			  <td><strong>Shipping Amount</strong></td>
				<td><span class="label label-inverse">INR  1,500.00</span></td>
			</tr>
			<tr>
			  <td><strong>Tax Applied</strong></td>
				<td><span class="label label-important">INR  1,500.00</span></td>
			</tr>
			<tr>
			  <td><strong>Sub Total</strong></td>
				<td><span class="label label-info">INR  1,500.00</span></td>
			</tr>
			<tr>
			  <td><strong>Grand Total</strong></td>
				<td><span class="label label-warning">INR  1,500.00</span></td>
			</tr>
			<tr>
			  <td colspan="2">
              <h4>Coupon Code</h4>
              <p>If you have a coupon code enter it in the box below and click \'Go\'.</p>
             <p> <input type="text"></p>
              <a href="#" class="btn btn-danger">Go</a></td>
			  <td colspan="2" align="center" valign="middle"><a href="?do=showcart&action=displaypaymentgateways" class="btn btn-inverse">Proceed Checkout</a></td>
		  </tr>
		</tbody>
	</table>
        </div>';
			return $out;	
	
	
	}
	
	function displayPaymentGateways($arr,$domain)
	{
	
		
	
		$output='<div class="row-fluid">
        	<ul class="steps">

			<li class="inact"><a href="#"><span>1. Email Login</span></a></li>		
				<li class="inact"><a href="?do=showcart&action=getaddressdetails"><span>2. Billing Address</span></a></li>
				<li class="inact"><a href="?do=showcart&action=getshippingaddressdetails&chk=0"><span>3. Shipping Address</span></a></li>
				<li class="inact"><a href="?do=showcart&action=getshippingmethod&chk=0"><span>4. Shipping Method</span></a></li>
				<li class="inact"><a href="?do=showcart&action=showorderconfirmation"><span>5. Order Confirmation</span></a></li>
				<li class="act"><a href="#"><span>6. Payment Details</span></a></li>
				        
		</ul>
		</div><div class="row-fluid">
                    <div class="span12">
                         
                      <p class="billing_title">Choose your mode of payment</p>
                      
                      <div id="myaccount_div">
                      <span class="label label-info">Your Checkout Amount is    INR &nbsp;105.00</span>
                       <ul id="paymentlist">
                        	<li><h6 onClick="showFaq(\'faq_id1\');">Online Payment Gateways</h6>
                            <p style="display:block;" id="faq_id1">
                            <a href="#"><img src="assets/img/payment/gc.gif"  alt="google"></a> <a href="#"><img src="assets/img/payment/pp.gif" alt="paypal"></a> <a href="#"><img src="assets/img/payment/lb.gif" alt="liberty"></a> <a href="#"><img src="assets/img/payment/pz.gif" alt="epayza"></a></p></li>
                        	<li><h6 onClick="showFaq(\'faq_id2\');">Offline Payment Gateway</h6>
                            <p style="display:block;" id="faq_id2">
                            <a href="#"><img src="assets/img/payment/cash-dep.gif" alt="cash deposit"></a>
                            <a href="#"><img src="assets/img/payment/che-dep.gif" alt="check Deposit"></a>
                            <a href="#"><img src="assets/img/payment/neft.gif" alt="neft"></a>
                            <a href="#"><img src="assets/img/payment/rtgs.gif" alt="rtgs"></a>
                            </p></li></ul>
                      </div>
                                	
                                    
          </div>	
                    
          </div>';
		return $output;
	}
	
	function getPaymentGatewayForms($arr,$domain)
	{
		
		//$sucess_url='http://'.$_SERVER['SERVER_NAME'].'/zeuscartv21/?do=paymentgateway&action=success';
		//$cancel_url='http://'.$_SERVER['SERVER_NAME'].'/zeuscartv21/?do=paymentgateway&action=failure';
		
		
		$sucess_url=$domain.'?do=paymentgateway&action=success';
		$cancel_url=$domain.'?do=paymentgateway&action=failure';				
		
		
		$getMerchantId = new Core_CAddCart();
		$recordSet = $getMerchantId->getPaymentGatewaySettings($arr['gateway_id']);				
		for($i=0;$i<count($recordSet);$i++)
		{
			if($recordSet[$i]['setting_name']=='Merchant ID')
			{
				$merchantid = base64_decode($recordSet[$i]['setting_values']);
			}
		}				
		
		
		//$amount=$_SESSION['checkout_amount'];
		$amount=$_SESSION['checkout_amount']*$_SESSION['currencysetting']['default_currency']['conversion_rate']; //to covert into equivalent dollar values
		
		$payment_html['PayPal']='<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">-->
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input name="cmd" value="_xclick" type="hidden">
                    <input name="business" value="'.$merchantid.'" type="hidden">
                    <input name="item_name" value="'.$_SERVER['SERVER_NAME'].' Check out" type="hidden">
                    <input name="amount" value="'.$amount.'" type="hidden">
                    <input name="no_note" value="once" type="hidden">
                    <input name="currency_code" value="USD" type="hidden">
                    <input name="rm" value="2" type="hidden">

                    <input name="return" value="'.$sucess_url.'&pay_type=1" type="hidden">
                    <input name="cancel_return" value="'.$cancel_url.'" type="hidden">
					<input src="images/payment/paypal.jpg" name="submit" alt="PayPal" type="image" border="0" style="height:30;width:100px;"></form>';

			$payment_html['e-bullion']='<form name="atip" method="post" action="https://atip.e-bullion.com/process.php">
					<input type="hidden" name="ATIP_STATUS_URL" value="'.$_SERVER['SERVER_NAME'].'">
					<input type="hidden" name="ATIP_STATUS_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_BAGGAGE_FIELDS" value="">
					<input type="hidden" name="ATIP_SUGGESTED_MEMO" value="">
					<input type="hidden" name="ATIP_FORCED_PAYER_ACCOUNT" value="">
					<input type="hidden" name="ATIP_PAYER_FEE_AMOUNT" value="">
					<input type="hidden" name="ATIP_PAYMENT_URL" value="'.$sucess_url.'&pay_type=2">
					<input type="hidden" name="ATIP_PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_NOPAYMENT_URL" value="'.$cancel_url.'">
					<input type="hidden" name="ATIP_NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_PAYMENT_FIXED" value="1">
					<input type="hidden" name="ATIP_PAYEE_ACCOUNT" value="'.$merchantid.'">
					<input type="hidden" name="ATIP_PAYEE_NAME" value="'.$merchantid.'">
					<input type="hidden" name="ATIP_BUTTON" value="1">
					<input type="hidden" name="ATIP_PAYMENT_AMOUNT" value="'.$amount.'" size="10">
					<input type="hidden" name="ATIP_PAYMENT_UNIT" value="1">
					<input type="hidden" name="ATIP_PAYMENT_METAL" value="3">
					<input type="image" name="pay" src="images/payment/ebullion.jpg" style="height:30;width:100px;"></form>';
					
			$payment_html['e-gold']='<form action="https://www.e-gold.com/sci_asp/payments.asp" method=post>
					<input type=hidden name="PAYMENT_AMOUNT" value="'.$amount.'">
					<input type=hidden name="SUGGESTED_MEMO" value = "'.$_SERVER['SERVER_NAME'].' Check out">
					<input type="hidden" name="PAYEE_ACCOUNT" value="'.$merchantid.'">
					<input type="hidden" name="PAYEE_NAME" value="'.$_SERVER['SERVER_NAME'].'">
					<input type=hidden name="PAYMENT_UNITS" value=1>
					<input type=hidden name="PAYMENT_METAL_ID" value=1>
					<input type="hidden" name="STATUS_URL" value="mailto:'.$_SERVER['SERVER_NAME'].'">
					<input type="hidden" name="NOPAYMENT_URL" value="'.$cancel_url.'">
					<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="PAYMENT_URL" value="'.$sucess_url.'&pay_type=3">
					<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="BAGGAGE_FIELDS" value="PROGL">
					<input type="hidden" name="PROGL" value="01">
					<input type=image src="images/payment/egold.jpg" style="height:40">
					</form>	';
				
					
					$payment_html['google-checkout']=' <!--<form method="POST" 		
					action="https://sandbox.google.com/checkout/cws/v2/Merchant/'.$merchantid.'/checkoutForm"
     				 accept-charset="utf-8">--><form method="POST" 		
					action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/'.$arr['merchant_id'].'"
     				 accept-charset="utf-8">

					  <input type="hidden" name="item_name_1" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'"/>
					  <input type="hidden" name="item_description_1" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'"/>
					  <input type="hidden" name="item_quantity_1" value="1"/>
					  <input type="hidden" name="item_price_1" value="'.$amount.'"/>
					  <input type="hidden" name="item_currency_1" value="USD"/>
					
					  <input type="hidden" name="ship_method_name_1" value="UPS Ground"/>
					  <input type="hidden" name="ship_method_price_1" value="0.00"/>
					
					  <input type="hidden" name="tax_rate" value="0.00"/>
					  <input type="hidden" name="tax_us_state" value="NY"/>
					
					  <input type="hidden" name="_charset_" value=""/>
					<input type="hidden" name="checkout-flow-support.merchant-checkout-flow-support.continue-shopping-url" value="'.$sucess_url.'&pay_type=4">
					
					  <input type="image" name="Google Checkout" alt="Fast checkout through Google"
					src="http://checkout.google.com/buttons/checkout.gif?merchant_id='.$merchantid.'&w=180&h=46&style=white&variant=text&loc=en_US"
					height="46" width="180"/>
					
					</form>';
					
					/*$payment_html['2checkout']=' <form id="form2co" name="form2co" method="post" 		
					action="https://www.2checkout.com/2co/buyer/purchase">
					<input type="hidden" name="sid" value="'.$arr['merchant_id'].'" />
					<input type="hidden" name="cart_order_id" value="100" />
					<input type="hidden" name="total" value="'.$amount.'" /><input type="hidden" name="demo" value="Y" />
					<input type="hidden" name="fixed" value="Y" /><input type="hidden" name="return_url" value="'.$sucess_url.'" 
					/>
					<input type="hidden" name="lang" value="en" />
					<input type="hidden" name="card_holder_name" value="" /><input type="image" src="../logo_2co.gif" 
					name="submit" alt="2checkout" />
					</form>';*/
					
					$payment_html['2checkout']=' <form id="form2co" name="form2co" method="post" 		
					action="?do=showcart&action=show2checkout">
					<input type="hidden" name="sid" value="'.$merchantid.'" />
					<input type="hidden" name="cart_order_id" value="100" />
					<input type="hidden" name="total" value="'.$amount.'" /><!--<input type="hidden" name="demo" value="Y" />-->
					<input type="hidden" name="fixed" value="Y" /><input type="hidden" name="return_url" value="'.$sucess_url.'" 
					/>
					<input type="hidden" name="lang" value="en" />
					<input type="hidden" name="card_holder_name" value="" /><input type="image" src="images/payment/2checkout.gif" 
					name="submit" alt="2checkout" />
					</form>';
					
					$payment_html['Authorize.net']=' <form id="form2co" name="form2co" method="post" 		
					action="?do=showcart&action=showauthorizenet">
					<input type="image" src="images/payment/authorize.gif" 
					name="submit" alt="Authorize.net" />
					</form>';
					
					$payment_html['worldpay']=' <form id="worldpay" name="worldpay" method="post" 		
					action="?do=showcart&action=showworldpay">
					<input type=hidden name="instId" value="'.$merchantid.'">
					<input type=hidden name="cartId" value=" 122 "> 
					<input type=hidden name="amount" value="'.$amount.'">
					<input type=hidden name="currency" value="USD">
					<input type=hidden name="desc" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'">
					<!--<input type=hidden name="testMode" value="100"> -->
					<input type="hidden" name="MC_callback" value="'.$sucess_url.'" />
					
					<input type="image" src="images/payment/worldpay.gif" name="submit" alt="WorldPay">
					</form>';
					
					/*$payment_html['worldpay']=' <form action="https://select.worldpay.com/wcc/purchase" method=POST>
					<input type=hidden name="instId" value="'.$arr['merchant_id'].'">
					<input type=hidden name="cartId" value=" 122 "> 
					<input type=hidden name="amount" value="'.$amount.'">
					<input type=hidden name="currency" value="USD">
					<input type=hidden name="desc" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'">
					<input type=hidden name="testMode" value="100"> 
					<input type="hidden" name="MC_callback" value="'.$sucess_url.'" />
					
					<input type="image" src="../worldpay.gif" name="submit" alt="WorldPay">
					</form>
					';*/
					
					$payment_html['Pay in Store']=' <form action="'.$sucess_url.'&pay_type=8" method=POST>
					
					<input type=hidden name="amount" value="'.$amount.'">
					<input type=hidden name="currency" value="USD">
					<input type=hidden name="desc" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'">
					<input type="image" src="images/payment/payinstore.gif" name="submit" alt="Pay in Store">
					</form>
					';
					$payment_html['Cash on Delivery']=' <form action="'.$sucess_url.'&pay_type=9" method=POST>
					
					<input type=hidden name="amount" value="'.$amount.'">
					<input type=hidden name="currency" value="USD">
					<input type=hidden name="desc" value="Payment For Shopping In '.$_SERVER['SERVER_NAME'].'">
					<input type="image" src="images/payment/cashondelivery.gif" name="submit" alt="Cash On Delivery">
					</form>
					';
					
					$payment_html['Paymate'] = '
					<form action="https://www.paymate.com/PayMate/ExpressPayment?mid='.$merchantid.'" method="post">
					<input type="hidden"  name="amt" value="'.$amount.'">
					<input type="hidden"  name="amt_editable" value="N">
					<input type="hidden"  name="currency" value="USD">
					<input type="hidden"  name="ref" value="'.$_SERVER['SERVER_NAME'].' Check out">			
					<input type="hidden"  name="return" value="'.$sucess_url.'&pay_type=10">
					<input type="hidden"  name="popup" value="'.$cancel_url.'">
					<input type="image" src="images/payment/paymate.gif" name="submit" alt="Pay with Paymate Express">
					</form>';
					
					
					$payment_html['Moneybookers']='<form action="https://www.moneybookers.com/app/payment.pl" target="_blank" method="post" >
					<input type="hidden" name="pay_to_email" value="'.$merchantid.'">
					<input type="hidden" name="merchant_id" value="'.$arr['merchant_id'].'">					
					<input type="hidden" name="return_url" value="'.$sucess_url.'&pay_type=11">
					<input type="hidden" name="cancel_url" value="'.$cancel_url.'">
					<input type="hidden" name="language" value="EN">
					<input type="hidden" name="amount" value="'.$amount.'">
					<input type="hidden" name="currency" value="USD">
					<input type="image" src="images/payment/moneybookers.jpg" name="submit" alt="Money Bookers">
					</form>';
						
					
					$payment_html['PSIGate']='<!--<FORM ACTION="https://devcheckout.psigate.com/HTMLPost/HTMLMessenger" METHOD=post>--><FORM ACTION="https://checkout.psigate.com/HTMLPost/HTMLMessenger" METHOD=post>
					<INPUT TYPE=hidden NAME="MerchantID" VALUE="'.$merchantid.'">
					<INPUT TYPE=hidden NAME="ThanksURL" VALUE="'.$sucess_url.'&pay_type=12">
					<INPUT TYPE=hidden NAME="NoThanksURL" VALUE="'.$cancel_url.'">
					<INPUT TYPE=hidden NAME="PaymentType" VALUE="CC">
					<!--<INPUT TYPE=hidden NAME="TestResult" VALUE="1">-->					
					<INPUT TYPE=hidden NAME="OrderID" VALUE="">
					<INPUT TYPE=hidden NAME="SubTotal" VALUE="'.$amount.'">
					<input type="image" src="images/payment/psigate.gif" name="submit" alt="PSI Gate">
					</FORM>';	
					
					$payment_html['Strompay']='<form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">
					<input type="hidden" name="generic" value="1">
					<input type="hidden" name="payee_email" value="'.$merchantid.'" >
					<input type="hidden" name="product_name" value="Cart">
					<input type="hidden" name="user_id" value=1>
					<input type="hidden" name="amount" value="'.$amount.'">
					<input type="hidden" name="quantity" value="1">
					<input type="hidden" name="require_IPN" value="1">
					<input type="hidden" name="notify_URL" value="'.$domain.'">
					<input type="hidden" name="return_URL" value="'.$sucess_url.'&pay_type=13">
					<input type="hidden" name="cancel_URL" value="'.$cancel_url.'">
					<input type="hidden" name="subject_matter" value="Cart Payment">
					<input type=image src="images/payment/strompay.jpg"  alt="Strompay" style="width:75;height:30">
					</form>';
					
					/*$payment_html['Alertpay']='<form action="https://www.alertpay.com/PayProcess.aspx" method="post">
					<input type="hidden" name="ap_purchasetype" value="Item">
					<input type="hidden" name="ap_merchant" value="'.$arr['merchant_id'].'">
					<input type="hidden"  name="ap_itemname" value="PTYW">
					<input type="hidden"  name="ap_currency" value="USD">
					<input type="hidden"  name="ap_returnurl" value="'.$sucess_url.'&pay_type=14">
					<input type="hidden"  name="ap_quantity" value="1">
					<input type="hidden" name="ap_description" value="PTYW">
					<input type="hidden"  name="ap_amount" value="0.26">
					<input type="hidden"  name="ap_cancelurl" value="'.$cancel_url.'">
					<input type="image" src="images/payment/alertpay.jpeg" alt="Alertpay">
					</form>';
					*/
					$payment_html['Alertpay']="<form action='https://www.alertpay.com/PayProcess.aspx' method='post'>
					<input type='hidden' name='ap_purchasetype' value='Item'>
					<input type='hidden' name='ap_merchant' value='".$merchantid."'>
					<input type='hidden'  name='ap_itemname' value='PTYW'>
					<input type='hidden'  name='ap_currency' value='USD'>
					<input type='hidden'  name='ap_returnurl' value='".$sucess_url."&pay_type=14'>
					<input type='image' src='images/payment/alertpay.jpeg' >
					<input type='hidden'  name='ap_quantity' value='1'>
					<input type='hidden' name='ap_description' value='PTYW'>
					<input type='hidden'  name='ap_amount' value='".$amount."'>
					<input type='hidden'  name='ap_cancelurl' value='".$cancel_url."'>
					</form>";
					/**
					* Yourpay connect settings:
					* 1. You need to log into Yourpay.
   					* 2. After you login, click on Customization at the top.
  					* 3. Then click on "Configure your Yourpay Connect."
   					* 4. Enter the URL address for the order page on your web site or the very last page during checkout for your shopping cart.
      				* You can enter multiple address but they need to be separated by a space.
      				* The Order Submission Form field has a limit of 250 characters.
					* By default Yourpay Connect will display the customer a confirmation page that they can print out for their records.
    				* If you do not create your own thank you and sorry pages then you can enter the address for your web site.
     					 For example: http://www.yourdomain.com
    				* You only need to enable "URL is a CGI script" if you want Yourpay to post the data back to your website so you can collect the information using a scripting language like PHP or ASP.
   					* If you do not want customers to see the Yourpay confirmaiton page then you need to enable the auto forwarding option.
					*/
					$payment_html['Yourpay']='<!--<form action="https://www.staging.linkpointcentral.com/lpcentral/servlet/lppay" method="post">--><form action="https://secure.linkpt.net/lpcentral/servlet/lppay" method="post">
					<input type="hidden" name="mode" value="fullpay">
					<input type="hidden" name="chargetotal" value="'.$amount.'">
					<input type="hidden" name="storename" value="'.$merchantid.'">
					<input type="hidden" name="txntype" value="sale">
					<input type="hidden" name="comments" value="'.$domain.'-Buy cart">
					<input type="image" src="images/payment/yourpay.jpeg" alt="Yourpay">
					<!--<input type="submit" name="btnup" value="Yourpay">-->
					</form>';
					
					
					$payment_html['iTransact'] = '<form method="post" 	
					action="https://secure.paymentclearing.com/cgi-bin/mas/split.cgi" >
					<input type="hidden" name="home_page" value="'.$domain.'">
					<input type="hidden" name="vendor_id" value="'.$merchantid.'">
					<input type="hidden" name="mername" value="Buy Cart">
					<input type="hidden" name="ret_addr" value="'.$sucess_url.'&pay_type=16">
					<input type="hidden" name="1-qty" value="1" />
					<input type="hidden" name="ret_mode" value="post">
					<input type="hidden" name="splitType" value="split" />
					<input type="hidden" name="1-cost" value="'.round($amount).'" />
					<input type="hidden" name="1-desc" value="Item" />
					<input type="hidden" name="first_name" value="venkat" />
					<input type="hidden" name="last_name" value="venkat"/>
					<input type="hidden" name="address" value="vilacheri"/>
					<input type="hidden" name="city" value="madurai"/>					
					<input type="hidden" name="phone" value="34343434"/>
					<input type="hidden" name="country" value="USA"/>
					<input type="hidden" name="email" value="'.$merchantid.'"/>
					<input type="image" src="images/payment/itransact.gif" alt="submit securely" />
					</form>';							
					
					
					
					$payment_html['Bluepay']=' <form id="formbluepay" name="formbluepay" method="post" 		
					action="?do=showcart&action=showbluepay">					
					<input type="image" src="images/payment/bluepay.jpeg" name="submit" alt="BluePay" />
					</form>';			
					if($arr['gateway_id'] == '17')
					$_SESSION['bluepaydetails'] = $merchantid.'|'.$sucess_url.'|'.$cancel_url;	
					
					$payment_html['Safepay'] = '<form action="https://www.safepaysolutions.com/index.php" method="post">
             		<input type="hidden" name="_ipn_act" value="_ipn_payment">
		            <input type="hidden" name="fid" value="'.$merchantid.'">
		            <input type="hidden" name="itestmode" value="off">
              		<input type="hidden" name="notifyURL" value="'.$sucess_url.'&pay_type=18">
		            <input type="hidden" name="returnURL" value="'.$sucess_url.'&pay_type=18" >
	                <input type="hidden" name="cancelURL" value="'.$cancel_url.'" >
 				    <input type="hidden" name="notifyEml" value="">
                    <input type="hidden" name="iowner" value="">
                    <input type="hidden" name="ireceiver" value="">
                    <input type="hidden" name="iamount" value="'.round($amount).'">
 		            <input type="hidden" name="itemName" value="Deposit Amount">
              		<input type="hidden" name="itemNum" value="">
              		<input type="hidden" name="idescr" value="">
             	 	<input type="hidden" name="idelivery" value="">
              		<input type="hidden" name="iquantity" value="">
             		<input type="hidden" name="imultiplyPurchase" value="y">
              		<input type="hidden" name="colortheme" value="LightBlueYellow">
              		<input type="image" src="images/payment/safepay.gif" alt="Pay through SafePay Solutions">
		            </form>';							
					
					
			return $payment_html[$arr['gateway_name']];
	}
	
	
	
	
	
	
}	
?>
