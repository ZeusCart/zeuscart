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
 * Footer links  related  class
 *
 * @package   		Display_DFooterLinks
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
$out = array();
$output = array();
$arr = array();

class Display_DFooterLinks
{
 	/**
	* This function is used to Display the Terms and Condition
	* @name termsCondition
	* @param mixed $arr
	* @return string
 	*/
	function termsCondition($arr)
	{
	
		$output ='
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Terms & Conditions</td>
            </tr>
			<tr><td>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left">                
				  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				   <tr>
						<td></td>
				   </tr>
				  </table><table width="78%" border="0" align="center" cellpadding="2" cellspacing="2" >
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2">'.$arr[0]['termscontent'].'</td>
                    </tr>
		             <tr>
                      <td colspan="2">&nbsp;</td>
                     </tr>
					<tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	              <td></td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
                  </table></td></tr></table>';
	  return $output;
	}
	
 	/**
	* This function is used When No Terms and Conditions Available
	* @name termsConditionElse
	* @return string
 	*/
	function termsConditionElse()
	{
	
		$output = '
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Terms & Conditions</td>
            </tr>
			<tr><td>
		<table width="" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left"               
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
   		<td></td>
   </tr>
  </table><table width="78%" border="0" align="center" cellpadding="2" cellspacing="2">
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><div class="success_msgbox">No Terms & Conditions Included</div></td>
                    </tr>
		             <tr>
                      <td colspan="2">&nbsp;</td>
                     </tr>
					<tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	              <td></td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
                  </table></td></tr></table>';
	  return $output;
	}
	
 	/**
	* This function is used to Display the Privacy Policy
	* @name privacyPolicy
	* @param mixed $arr
	* @return string
 	*/
	function privacyPolicy($arr)
	{
	
		$output = '
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Privacy Policy</td>
            </tr>
			<tr><td>
		<table width="" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left">
               
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
   		<td></td>
   </tr>
  </table><table width="78%" border="0" align="center" cellpadding="2" cellspacing="2">
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2">'.$arr[0]['privacypolicy'].'</td>
                    </tr>
		             <tr>
                      <td colspan="2">&nbsp;</td>
                     </tr>
					<tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	              <td></td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
                  </table></td></tr></table>';
	  return $output;
	}

 	/**
	* This function is used When No Privacy Policy is Available
	* @name privacyPolicyElse
	* @return string
 	*/
	function privacyPolicyElse()
	{
	
		$output = '
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Privacy Policy</td>
            </tr>
			<tr><td>
		<table width="" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left">
                 <!-- <p class="link_header" style="margin-left:100px;">&nbsp;</p>-->
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
   		<td></td>
   </tr>
  </table><table width="78%" border="0" align="center" cellpadding="2" cellspacing="2" class="cart_info">
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><div class="success_msgbox">No Privacy Policy Included</div></td>
                    </tr>
		             <tr>
                      <td colspan="2">&nbsp;</td>
                     </tr>
					<tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	              <td></td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
                  </table></td></tr></table>';
	  return $output;
	}
	
 	/**
	* This function is used to Display the Contact Us Form
	* @name showContactUs
	* @param mixed $Err
	* @return string
 	*/
	function showContactUs($Err)
	{
		if($Err->messages>0)
		{
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		}
		$out = '
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">Contact Us</td>
            </tr>
			<tr><td>
		<form name="contactus" action="?do=contactus&action=validatecontactus" method="post">
		<table width="" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left">
                 
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
   		<td></td>
   </tr>
  </table>
  <table width="78%" border="0" align="center" cellpadding="2" cellspacing="2" class="cart_info"  style="font-size:12px;">
                    <tr>
                      <td>Name <font color="red">*</font></td>
					  <td nowrap><input type="text" name="txtname" maxlength="40" width="40" value="'.$output['val']['txtname'].'"/>
					  <font color="red">'.$output['msg']['txtname'].'</font></td>
					   
                    </tr>
                    <tr>
                      <td>Email <font color="red">*</font></td>
					  <td nowrap><input type="text" name="email" maxlength="40" width="40" value="'.$output['val']['email'].'"/>
					  <font color="red">'.$output['msg']['email'].'</font></td>
					  <td></td>
                    </tr>
		             <tr>
                      <td>Comment</td>
					  <td><textarea rows="10" cols="35" name="comment"></textarea></td>
                     </tr>
					
					 <tr>
        	              <td></td>
						  <td align="right">
						<button type="submit" class="gobutton"><span>&nbsp;Post&nbsp;</span></button>
				  	</td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
				 
                  </table></form></td></tr></table>';
	  return $out;
	}
	
 	/**
	* This function is used to Display the About Us
	* @name aboutUs
	* @param mixed $arr
	* @return string
 	*/
	function aboutUs($arr)
	{
	
		$output ='
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" colspan="2" class="serachresult">About Us</td>
            </tr>
			<tr><td>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td align="left">                
				  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				   <tr>
						<td></td>
				   </tr>
				  </table><table width="78%" border="0" align="center" cellpadding="2" cellspacing="2" >
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2">'.$arr[0]['set_value'].'</td>
                    </tr>
		             <tr>
                      <td colspan="2">&nbsp;</td>
                     </tr>
					<tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	             <td colspan="2">&nbsp;</td>
					 </tr>
					  <tr>
        	              <td></td>
					 </tr>
					 
                   </table>
                  </td>
                  </tr>
                  </table></td></tr></table>';
	  return $output;
	}
	
}
?>