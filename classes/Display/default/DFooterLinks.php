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


class Display_DFooterLinks
{

	
 	/**
	* This function is used to Display the Terms and Condition
	* @param mixed $arr
	* @return string
 	*/
	function termsCondition($arr)
	{
	
		$output ='<div id="myaccount_div">
		<form class="form-horizontal"  >

            <div class="control-group">
             '.$arr[0]['termscontent'].'
             </div>
		</form></div>';
	  return $output;
	}
	
 	/**
	* This function is used When No Terms and Conditions Available
	* @return string
 	*/
	function termsConditionElse()
	{
	
		$output = '<div id="myaccount_div">
		<form class="form-horizontal"  >

            <div class="control-group">
              <div class="alert alert-info">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <strong>No Terms & Conditions Included</strong> 
            </div>
              </div>
            </div>
		</form></div>';
	  return $output;
	}
	
 	/**
	* This function is used to Display the Privacy Policy
	* @param mixed $arr
	* @return string
 	*/
	function privacyPolicy($arr)
	{
	
		$output = '<div id="myaccount_div">
		<form class="form-horizontal"  >

            <div class="control-group">
             '.$arr[0]['privacypolicy'].'
             </div>
		</form></div>';
	  return $output;
	}

 	/**
	* This function is used When No Privacy Policy is Available
	* @return string
 	*/
	function privacyPolicyElse()
	{
	
		$output = '<div id="myaccount_div">
		<form class="form-horizontal"  >

            <div class="control-group">
              <div class="alert alert-info">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <strong>No Privacy Policy Included</strong> 
            </div>
              </div>
            </div>
		</form></div>';
	  return $output;
	}
	
 	/**
	* This function is used to Display the Contact Us Form
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
		$out = '<div id="myaccount_div">
		<form class="form-horizontal"  name="contactus" action="'.$_SESSION['base_url'].'/index.php?do=contactus&action=validatecontactus" method="post">

            <div class="control-group">
              <label for="inputEmail" class="control-label">'.Core_CLanguage::_('NAME').'<i class="red_fnt">*</i></label>
              <div class="controls">
		<input type="text" name="txtname" maxlength="40"  value="'.$output['val']['txtname'].'"/>
		<font color="red">'.$output['msg']['txtname'].'</font>
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">'.Core_CLanguage::_('EMAIL_ADDRESS').'<i class="red_fnt">*</i></label>
              <div class="controls">
                <input type="text" name="email" maxlength="40"  value="'.$output['val']['email'].'"/>
		  <font color="red">'.$output['msg']['email'].'</font>
              </div>
            </div>
            <div class="control-group">
              <label for="inputPassword" class="control-label">'.Core_CLanguage::_('ENQUIRY').'</label>
              <div class="controls">
               <textarea rows="10" cols="35" name="comment" style="width: 211px; height: 93px;"></textarea>
              </div>
            </div>
       

          
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-danger" type="submit">'.Core_CLanguage::_('SUBMIT').'</button>
              </div>
            </div>
          </form>           </div>';
	  return $out;
	}
	
 	/**
	* This function is used to Display the About Us
	* @param mixed $arr
	* @return string
 	*/
	function aboutUs($arr)
	{
	
		$output ='<div id="myaccount_div">
		<form class="form-horizontal"  >
            <div class="control-group">
            '.$arr[0]['content'].'
             </div>
		</form></div>';
	  return $output;
	}
	
}
?>