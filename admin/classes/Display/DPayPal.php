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
 class Display_DPaymentForms
{
 	function showPaypalForm($shoppingcart)
	  {
			$returnUrl='http://www.mysite.com/payment/index.php?do=getPaymentInfo';
			
			$prin="
			        <form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
					<input type='hidden' name='cmd' value='_xclick' />
                    <input type='hidden' name='business' value='<?php echo $rowpayment[pref_value]?>' />
                    <input type='hidden' name='item_name' value='Recharge Account' />
                    <input type='hidden' name='amount' value='<?php echo number_format($total,2);?>' />
                    <input type='hidden' name='no_note' value='once' />
                    <input type='hidden' name='currency_code' value='EUR' />
                    <input type='hidden' name='rm' value='2' />
                    <input type='hidden' name='return' value='<?=$yoursite?>/prepaid_success.php' />
                    <input type='hidden' name='cancel_return' value='<?=$yoursite?>/prepaid_failure.php' />
					<center><br>
					<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-but6.gif' border='0'  name='submit' alt='Make payments with PayPal - it's fast, free and secure!' />
					</center>
					</form>";
					echo ($prin);
	  }
	  function showEbuillionFormm
}
?>

<a href='http://www.mydomim.com/?do=showPaypalform'><img src='img'></a>