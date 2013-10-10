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
 * Payment gateway  related  class
 *
 * @package   		Display_DPaymentGateways
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
 class Display_DPaymentGateways
{
		
 	/**
	* This function is used to Display the form for zcheckout
	* @return string
 	*/
	function twoCheckOut()
	{
				$_SESSION['quantity'];
					$success="http://";
					$success    .= $_SERVER['SERVER_NAME'];
					$success.='/zeuscart_new/?do=paymentgateway&action=success';
					$failure="http://";
					$failure    .=$_SERVER['SERVER_NAME'];
					$failure.='/zeuscart_new//?do=paymentgateway&action=failure';
					$returnurl  =$_SERVER['SERVER_NAME'];$returnurl.='/?do=paymentgateway';
					$amount     =$_SESSION['grandtotal'];
					$amount=4000;
					$productid  =$_SESSION['product_id'];
					$quantity   =$_SESSION['quantity'];
				$amt        =number_format($amount,2);

					
		$twocheckout="<FORM Method='POST' Action='https://www.2checkout.com/2co/buyer/purchase'>
		<input type='hidden' name='sid' value='".$sid."'>
		<input name='quantity' type='hidden' class='ctl_input' value='".$quantity."'>
		<input name='product_id' type='hidden' class='ctl_input' value='".$productid."'>
		<input type='hidden' name='demo' value='Y'>
			<input type='image' src='images/payment/twocheckout.jpg' >
		</FORM>";
		//echo $twocheckout;
		return $twocheckout;
	}
		
 	/**
	* This function is used to Display the form for eGold
	* @return string
 	*/
	function eGold()
	{
	//global $success,$failure, $returnurl, $amount, $productid,$quantity;
					$success= $_SERVER['SERVER_NAME'];
					$success.='/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.='/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.='/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];
				$output='<form action="https://www.e-gold.com/sci_asp/payments.asp" method=post>
				<input type=hidden name="PAYMENT_AMOUNT" value="'.$amount.'">
				<input type=hidden name="SUGGESTED_MEMO" value = "Memo">
				<input type="hidden" name="PAYEE_ACCOUNT" value="'.$egoldno.'">
				<input type="hidden" name="PAYEE_NAME" value="'.$egoldname.'">
				<input type=hidden name="PAYMENT_UNITS" value=1>
				<input type=hidden name="PAYMENT_METAL_ID" value=1>
				<input type="hidden" name="STATUS_URL" value="mailto:'.$adminmail.'>">
				<input type="hidden" name="NOPAYMENT_URL" value="'.$failure.'">
				<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
				<input type="hidden" name="PAYMENT_URL"  value="'.$success.'">
				<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
				<input type="hidden" name="BAGGAGE_FIELDS" value="PROGL">
				<input type="hidden" name="PROGL" value="01">
				<input type=image src="'.$_SESSION['base_url'].'/images/payment/egold.jpg" alt="E-Gold">
				</form>	';
				return $output;
			
	}
	
 	/**
	* This function is used to Display the form for stormPay
	* @return string
 	*/
	function stromPay()
	{
					$success= $_SERVER['SERVER_NAME'];
					$success.='/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.='/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.='/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];
					$stormpayno='011';
				$output='<form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">
				<input type="hidden" name="generic" value="1">
				<input type="hidden" name="payee_email" value=\''.$stormpayno.'\' >
				<input type="hidden" name="product_name" value=\''.$productid.'\'">
				<input type="hidden" name="user_id" value=1>
				<input type="hidden" name="amount" value=\''.$amount.'\'>
				<input type="hidden" name="quantity" value=\''.$quantity.'\'>
				<input type="hidden" name="require_IPN" value="1">
				<input type="hidden" name="notify_URL" value="'.$yoursite.'/index.php">
				<input type="hidden" name="return_URL" value="'.$success.'">
				<input type="hidden" name="cancel_URL" value="'.$failure.'">
				<input type="hidden" name="subject_matter" value="CashCocktail Payment">
				<input type=image src="'.$_SESSION['base_url'].'/images/payment/strompay.jpg" value="Strom Pay">
				</form>';
				return $output;

	}
	
	
 	/**
	* This function is used to Display the form for money bookers
	* @return string
 	*/
	function moneyBookers()
	{
					$success= $_SERVER['SERVER_NAME'];
					$success.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];
				$output='<form action="https://www.moneybookers.com/app/payment.pl" target="_blank">
				<input type="hidden" name="pay_to_email" value="<?=$moneybooker?>">
				<input type="hidden" name="return_url" value="'.$success.'">
				<input type="hidden" name="cancel_url" value="'.$failure.'">
				<input type="hidden" name="language" value="EN">
				<input type="hidden" name="amount" value="'.$amount.'">
				<input type="hidden" name="currency" value="<?= $default_cur_code ?>">
				<input type="image" src="'.$_SESSION['base_url'].'/images/payment/moneybookers.jpg" value="MoneyBooker" name="Pay">
				</form>';
				return $output;
	}	
		
 	/**
	* This function is used to Display the form for eBullion
	* @return string
 	*/
	function eBullion()
	{
					$success= $_SERVER['SERVER_NAME'];
					$success.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];
			$bullion='<form name="atip" method="post" action="https://atip.e-bullion.com/process.php">
				<input type="hidden" name="ATIP_STATUS_URL" value="'.$yoursite.'">
				<input type="hidden" name="ATIP_STATUS_URL_METHOD" value="POST">
				<input type="hidden" name="ATIP_BAGGAGE_FIELDS" value="">
				<input type="hidden" name="ATIP_SUGGESTED_MEMO" value="">
				<input type="hidden" name="ATIP_FORCED_PAYER_ACCOUNT" value="">
				<input type="hidden" name="ATIP_PAYER_FEE_AMOUNT" value="">
				<input type="hidden" name="ATIP_PAYMENT_URL" value="'.$success.'">
				<input type="hidden" name="ATIP_PAYMENT_URL_METHOD" value="POST">
				<input type="hidden" name="ATIP_NOPAYMENT_URL" value="'.$failure.'">
				<input type="hidden" name="ATIP_NOPAYMENT_URL_METHOD" value="POST">
				<input type="hidden" name="ATIP_PAYMENT_FIXED" value="1">
				<input type="hidden" name="ATIP_PAYEE_ACCOUNT" value="<?=$ebull_no?>">
				<input type="hidden" name="ATIP_PAYEE_NAME" value="<?=$ebull_name?>">
				<input type="hidden" name="ATIP_BUTTON" value="1">
				<input type="hidden" name="ATIP_PAYMENT_AMOUNT" value="'.amount.'" size="10"><br></font></span>
				<input type="hidden" name="ATIP_PAYMENT_UNIT" value="1">
				<input type="hidden" name="ATIP_PAYMENT_METAL" value="1">
				<tr><td align=center><input type="image" name="pay" src="'.$_SESSION['base_url'].'/images/payment/ebullion.jpg" value="Money Bookers"></form>';
				return $bullion;
	
	}
		
 	/**
	* This function is used to Display the form for intGold
	* @return string
 	*/
	function intGold()
	{
				$success= $_SERVER['SERVER_NAME'];
				$success.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=success';
				$failure=$_SERVER['SERVER_NAME'];
				$failure.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=failure';
				$returnurl=$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway';
				$amount=$_SESSION['grandtotal'];
				$productid=$_SESSION['product_id'];
				$quantity=$_SESSION['quantity'];
				$intgoldno='101';
		$output='<form action="https://intgold.com/cgi-bin/webshoppingcart.cgi" target=_blank method="POST">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="SELLERACCOUNTID" value=\''.$intgoldno.'\'">
				<input type="hidden" name="RETURNURL"  value="'.$success.'">
				<input type="hidden" name="CANCEL_RETURN"  value="'.$failure.'">
				<input type="hidden" name="CUSTOM1" value="amount">
				<input type="hidden" name="CUSTOM2" value="status">
				<input type="hidden" name="ITEM_NUMBER" value="121">
				<input type="hidden" name="ITEM_NAME" value="<?=$intgoldname?>">
				<input type="hidden" name="METHOD" value="POST">
				<input type="hidden" name="RETURNPAGE" value="HTML">
				<input type="hidden" name="AMOUNT" value=\''.$amount.'\'>
				<input type="image" src="'.$_SESSION['base_url'].'/images/payment/intgold.jpg" name="submit" alt="Int Gold">
				</form>';
				return $output;
	}
		
 	/**
	* This function is used to Display the form for securepay
	* @return string
 	*/
	function securePay()
	{
				$success= $_SERVER['SERVER_NAME'];
					$success.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];
				
					
			$output='<FORM Method="POST" Action="https://secure.paymentclearing.com/cgi-bin/mas/split.cgi">
				<input type="hidden" name="home_page" value="http://www.aju.com">
				<input type="hidden" name="vendor_id" value="70571">
				<input type="hidden" name="mername" value="Kumar - TEST ACCOUNT">
				<input type="hidden" name="ret_addr" value="'.$success.'">
				<input type="hidden" name="1-qty" value="'.$quantity.'" />
				<input type="hidden" name="ret_mode" value="post">
				<input type="hidden" name="splitType" value="split" />
				<input type="hidden" name="1-cost" value="'.amount.'" />
				<input type="hidden" name="1-desc" value="Item" />
				<input type="hidden" name="first_name" value="Kumar"  />
				<input type="hidden" name="last_name" value="Test"/>
				<input type="hidden" name="address" value="Mdu"/>
				<input type="hidden" name="city" value="Mdu"/>
				<input type="hidden" name="country" value="USA"/>
				<input type="hidden" name="phone" value="000000"/>
				<input type="hidden" name="email" value="ranjithkumar.s@ajsquare.com"/>
				<input type="image" src="'.$_SESSION['base_url'].'/images/payment/securepay.jpg" name="submit" value="submit securely" />
				</FORM>';
				return $output;
	}
 	/**
	* This function is used to Display the form for Secure BluePay
	* @return string
 	*/
	function secureBluePay()
	{
					$success= $_SERVER['SERVER_NAME'];
					$success.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=success';
					$failure=$_SERVER['SERVER_NAME'];
					$failure.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway&action=failure';
					$returnurl=$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php/?do=paymentgateway';
					$amount=$_SESSION['grandtotal'];
					$productid=$_SESSION['product_id'];
					$quantity=$_SESSION['quantity'];

				$output='<form action="https://secure.bluepay.com/interfaces/bp10emu" method=POST>
				<input type="hidden" name=MERCHANT value='.$merchantvalue.'>
				<input type="hidden" name=TRANSACTION_TYPE value="AUTH">
				<input type="hidden" name=TAMPER_PROOF_SEAL value="394dd8d372bcd507dfa3596704a79fce">
				<input type="hidden" name=APPROVED_URL  value="'.$success.'">
				<input type="hidden" name=DECLINED_URL  value="'.$success.'">
				<input type="hidden" name=MISSING_URL   value="'.$failure.'">
				<input type="hidden" name=MODE         value="TEST">
				<input type="hidden" name=AUTOCAP      value="0">
				<input type="hidden" name=REBILLING    value="">
				<input type="hidden" name=REB_CYCLES   value="">
				<input type="hidden" name=REB_AMOUNT   value="">
				<input type="hidden" name=REB_EXPR     value="">
				<input type="hidden" name=REB_FIRST_DATE value="">
				<input type="hidden" name=AMOUNT value="'.$amount.'" >				  
				<input type="image" src="'.$_SESSION['base_url'].'/images/payment/bluepay.jpg" name="submit" value="submit securely" />
				</form>';
				return $output;
	}
	
 	/**
	* This function is used to Display the form for Google Pay
	* @return string
 	*/
	function googlePay()
	{
			$_SESSION['quantity'];
			$success="http://";
			$success    .= $_SERVER['SERVER_NAME'];
			$success.=''.$_SESSION['base_url'].'/index.php?do=paymentgateway&action=success';
			$failure="http://";
			$failure    .=$_SERVER['SERVER_NAME'];
			$failure.=''.$_SESSION['base_url'].'/index.php?do=paymentgateway&action=failure';
			$returnurl  =$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php?do=paymentgateway';
			$amount     =$_SESSION['grandtotal'];
			$productid  =$_SESSION['product_id'];
			$quantity   =$_SESSION['quantity'];
			$amt        =number_format($amount,2);
		
		$output="<form method='POST' action='https://sandbox.google.com/checkout/cws/v2/Merchant/1234567890/checkout'
		accept-charset='utf-8'>		
		<input type='hidden' name='".$product_title."' value='Product Title'/>
		<input type='hidden' name='".$productid."' value='Product Model Number'/>
		<input type='hidden' name='".$quantity."' value='Quantity'/>
		<input type='hidden' name='".$amount."' value='Price'/>
		<input type='hidden' name='USPS Priority' value='UPS Ground'/>
		<input type='hidden' name='".$shipping."' value='Shipping\"/>
		
		<input type='hidden' name='_charset_'/>
		<input type='image' name='Google Checkout' alt='Fast checkout through Google'
			src='http://sandbox.google.com/checkout/buttons/checkout.gif?merchant_id=1234567890&...' height='46' width='180' />
		height='36' width='100'/>
		</form>";
		return $output;
	}
	
 	/**
	* This function is used to Display the form for paypal
	* @param int $bussiness
	* @return string
 	*/
	function paypal($bussiness)
	 {
	           

		             $_SESSION['quantity'];
					 $success="http://";
					 $success .= $_SERVER['SERVER_NAME'];
					 $success .= ''.$_SESSION['base_url'].'/index.php?do=paymentgateway&action=success';
					 $failure="http://";
					 $failure .=$_SERVER['SERVER_NAME'];
					 $failure.= ''.$_SESSION['base_url'].'/index.php?do=paymentgateway&action=failure';
					 $returnurl  =$_SERVER['SERVER_NAME'];$returnurl.=''.$_SESSION['base_url'].'/index.php?do=paymentgateway';
					 $amount     =$_SESSION['grandtotal'];
					 $productid  =$_SESSION['product_id'];
					 $quantity   =$_SESSION['quantity'];
			         $amt        =number_format($amount,2);
									 
				   $output='<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="business" value="'.$bussiness.'" />
                    <input type="hidden" name="item_name" value="Zeus Cart Account" />
                    <input type="hidden" name="amount" value="'.$amt.'" />
                    <input type="hidden" name="no_note" value="once" />
                    <input type="hidden" name="currency_code" value="USD" />
                    <input type="hidden" name="rm" value="2" />
                    <input type="hidden" name="return" value="'.$success.'"/>
                    <input type="hidden" name="cancel_return"  value="'.$failure.'"/>
					<center><br>
					<input type="image" src="'.$_SESSION['base_url'].'/images/payment/paypal.jpg" border="0"  name="submit" alt="PayPal" /></center></form>';
				    return $output;
	  }
		
 	/**
	* This function is used to Display the Success URL
	* @return string
 	*/
	function success()
	{
		$output='<div>Your Payment Has been Successfully Inserted</div>';
		$output.='<div><a href="'.$_SESSION['base_url'].'/index.php?do=paymentgateway">Back</a></div>';
		return $output;
	}
		
 	/**
	* This function is used to Display the Failu
	* @return string
 	*/
	function failure()
	{
		$output='<div>Your Payment Has been failure</div>';
		$output.='<div><a href="'.$_SESSION['base_url'].'/index.php?do=paymentgateway">Back</a></div>';
		return $output;
	}
	function successmail($title,$logo,$resmail_username,$resmail_id,$admin_email,$orderid,$shipping_cost,$billingaddress,$shippingaddress)
	{

		$output=array();
		$orderamount = 	$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($_SESSION['checkout_amount'],2);	
		$output='';
		$getmailcontent=new Bin_Query();
		$getmailquery="select * from  mail_messages_table where mail_msg_id='4'";
		$getmailcontent->executeQuery($getmailquery);
		$message = $getmailcontent->records[0]['mail_msg'];
		$mailsubject= $getmailcontent->records[0]['mail_msg_subject'];

	
		$message = str_replace("[title]",$title,$message);
		$message = str_replace("[logo]",$logo,$message);
		$message = str_replace("[user_name]",$resmail_username,$message);
		$message = str_replace("[email]",$resmail_id,$message);
		$message = str_replace("[orderid]",$orderid,$message);
	
		$message = str_replace("[amount]",$orderamount,$message);	
		
		$message = str_replace("[billingaddress]",$billingaddress,$message);
		$message = str_replace("[shippingaddress]",$shippingaddress,$message);				$message = str_replace("[site_email]",$admin_email,$message);


		$output=array(0=>$message,1=>$mailsubject);			
						
		
		return $output;
	}

	function adminsuccessmail($title,$logo,$resmail_username,$resmail_id,$admin_email,$orderid,$shipping_cost,$billingaddress,$shippingaddress)
	{	
		
		

		$output=array();
		$orderamount = 	$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($_SESSION['checkout_amount'],2);	
		$output='';
		$getmailcontent=new Bin_Query();
		$getmailquery="select * from  mail_messages_table where mail_msg_id='5'";
		$getmailcontent->executeQuery($getmailquery);
		$message = $getmailcontent->records[0]['mail_msg'];
		$mailsubject= $getmailcontent->records[0]['mail_msg_subject'];

	
		$message = str_replace("[title]",$title,$message);
		$message = str_replace("[logo]",$logo,$message);
		$message = str_replace("[user_name]",$resmail_username,$message);
		$message = str_replace("[email]",$resmail_id,$message);
		$message = str_replace("[orderid]",$orderid,$message);
	
		$message = str_replace("[amount]",$orderamount,$message);	
		
		$message = str_replace("[billingaddress]",$billingaddress,$message);
		$message = str_replace("[shippingaddress]",$shippingaddress,$message);				$message = str_replace("[site_email]",$admin_email,$message);


		$output=array(0=>$message,1=>$mailsubject);		
						
	
		return $output;	
	}
	
}
?>