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
 * User news letter  related  class
 *
 * @package   		Core_CUserNewsLetter
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserNewsLetter
{

	/**
	 * This function is used to get  the  news letter
	 *
	 * .
	 * 
	 * @return string
	 */
	function showNewsLetter()
	{
		include('classes/Display/DUserAccount.php');
		
		$sqlselect="SELECT user_id,b.status,b.subsciption_id FROM `users_table` a,newsletter_subscription_table b where  a.user_status=1 and a.user_id=".$_SESSION['user_id']; 
		
		$obj = new Bin_Query();

		if($obj->executeQuery($sqlselect))
		{
			 return Display_DUserAccount::showNewsLetter($obj->records);
		}	
		
	}
	
	/**
	 * This function is used to add  the  news letter
	 *
	 * .
	 * 
	 * @return string
	 */
	function addNewsLetter()
	{
		if(isset($_POST['subId']) && $_POST['subId']!='')
		{
			$stat=0;
			if(isset($_POST['chkNewsSub']))
				$stat=1;
			$sqlselect="update newsletter_subscription_table set status=".$stat." where  subsciption_id=".$_POST['subId'];
		
			$obj = new Bin_Query();

			if($obj->updateQuery($sqlselect))


				return '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(REQUEST_NEWS_UPDATED).'
				</div>';
			else
	
				return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				'.Core_CLanguage::_(REQUEST_NEWS_NOT_UPDATED).'
				</div>';
		}
	}	

	
}
?>
