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
 * @package   		Core_CFooterLinks
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CFooterLinks
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	var $output=array();

	/**
	 * This function is used to get  the terms and conditions content  from db
	 * 
	 * 
	 * @return string
	 */
   	function termsCondition()
	{
		$sql = "SELECT termscontent from termsconditions_table where termsid=1 ";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
			$output =  Display_DFooterLinks::termsCondition($obj->records);
		else
			$output =  Display_DFooterLinks::termsConditionElse();
		return $output;
	}
	/**
	 * This function is used to get copy right content from db
	 * 
	 * 
	 * @return string
	 */
	function copyRights()
	{
		$sql = "SELECT set_value from admin_settings_table where set_name='Copy Rights'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
			$output = $obj->records[0]['set_value'];
		return $output;
	}
	/**
	 * This function is used to get privacy policy content from db
	 * 
	 * 
	 * @return string
	 */
	function privacyPolicy()
	{
		$sql = "SELECT privacypolicy from privacypolicy_table where id=1";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
			$output =  Display_DFooterLinks::privacyPolicy($obj->records);
		else
			$output =  Display_DFooterLinks::privacyPolicyElse();
		return $output;
	}
	
	/**
	 * This function is used to validate the contact us 
	 * 
	 * 
	 * @return string
	 */
	function validateContactUs()
	{
		$name=$_POST['txtname'];
		$from_mail = $_POST['email'];
		$mail_content = $_POST['comment'];
		$sql = "SELECT * from admin_settings_table where set_id =1";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$to_mail = $obj->records[0]['admin_email'];
			Core_CFooterLinks::sendingMail($from_mail,$to_mail,$mail_content);
			$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>
			
			'.Core_CLanguage::_(YOUR_COMMENTS_HAVE_BEEN_SUBMITTED).'

			</div>';


		}
		else


			$output = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(YOUR_COMMENTS_HAVE_NOT_BEEN_SUBMITTED).'
			</div>';
		return $output;
	}
	/**
	 * This function is used to send the mail for  contact us 
	 * @param string  $from_mail
	 * @param string  $to_mail
	 * @param string  $mail_content
	 * 
	 * @return string
	 */
	function sendingMail($from_mail,$to_mail,$mail_content)
	{
		include('classes/Lib/Mail.php');
		$mail = new Lib_Mail();
		$mail->From($from_mail); 
		$mail->ReplyTo('noreply@Zeuscart.com');
		$mail->To($to_mail); 
		$mail->Subject('contact');
		$mail->Body($mail_content);
		$mail->Send();
	}
	/**
	 * This function is used to get the content from about us
	 * 
	 * 
	 * @return string
	 */
	function aboutUs()
	{
		$sql = "SELECT * from aboutus_table ";
		$obj = new Bin_Query();
		$obj->executeQuery($sql);
		$output =  Display_DFooterLinks::aboutUs($obj->records);
		
		return $output;
	}
}
?>


