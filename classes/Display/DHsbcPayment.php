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
 class Display_DHsbcPayment
{
 	/**
	* This function is used to Display the Payment Details
	* @name dispGetDetails
	* @return string
 	*/
 	 function dispGetDetails()
	{
	 	$output='<input  type="text" id="intro_date" name="intro_date"   /><input type="image" src="images/calendar_img.gif" id="cal-button-1" value="cal">';
	   $output="<table cellpadding='10' cellspacing='0' border='0' align='center'>
	   <tr><td>Card Name</td><td><input type='text' name='cardname' /></td><td></td></tr>
	   <tr><td>TotalCost</td><td></td><td></td></tr>
	   <tr><td>Card Type</td><td></td><td></td></tr>
	   <tr><td>Card Number</td><td><input type='text' name='cardno' /></td><td></td></tr>
	   <tr><td>Card valid From</td><td><input type='text' name='cardvalidfrom' id='cardvalidfrom' /><img src='images/calendar_img.gif' alt=''/></td><td><input type='text' name='cardvalidfrom' /><img src='images/calendar_img.gif' alt=''/></td>/tr>
	   <tr><td>Card Expiry Date</td><td><input type='text' name='cardvalidfrom' /><input type='image' src='images/calendar_img.gif' alt=''/></td> <script type='text/javascript'>
            Calendar.setup({
              inputField    : 'intro_date',
              button        : 'cal-button-1',
              align         : 'Tr'
            });
          </script><td><input type='text' name='cardvalidfrom' /><img src='images/calendar_img.gif' alt=''/></td></tr>
	   <tr><td>Card Issue Number</td><td><input type='text' name='issueNumber' /></td><td></td></tr>
	   <tr><td colspan='4' align='right'><input type='submit' value='Checkout' name='submit' /></td></tr>";
	   return $output;
	}
}
?>