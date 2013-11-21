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
 * User Wishlist related  class
 *
 * @package   		Core_CUserWishList
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserWishList
{
	/**
	* This function is used to assign  the errors in this->data 
	* @param array $Err contain both error values and error message
	* @return array
 	*/
	function Ulogin($Err)
	{
		if(count($Err->values)==0)
		{
			$this->data = $Err->values;
			$this->data = $Err->messages;
		}
		else 
		{	
			$this->data = $Err->values;
			$this->errormessages = $Err->messages;
		}
	}
	/**
	 * This function is used to get wishlist 
	 * @param array $result
	 * .
	 * 
	 * @return string
	 */
	function showWishList($result='')
	{
		include_once('classes/Display/DUserAccount.php');
		
		$userid=$_SESSION['user_id'];
		
		$pagesize=10;
  	   	if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;
		
		$sqlselect="SELECT a.product_id,image,title,msrp,date_format(date_added,'%e/%c/%Y') as adate FROM `wishlist_table` a, products_table b where a.product_id=b.product_id and a.user_id=".$userid." order by date_added desc";
		
		$query = new Bin_Query();
		$query->executeQuery($sqlselect);
		
		$total = ceil($query->totrows/ $pagesize);
		include('classes/Lib/Paging.php');
		$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
		$this->data['paging'] = $tmp->output;
		$this->data['prev'] =$tmp->prev;
		$this->data['next'] = $tmp->next;	
		
		$sqlselect="SELECT a.product_id,image,title,msrp,date_format(date_added,'%e/%c/%Y') as adate FROM `wishlist_table` a, products_table b where a.product_id=b.product_id and a.user_id=".$userid." order by date_added desc LIMIT $start,$end";
		
		$obj = new Bin_Query();
		$obj->executeQuery($sqlselect);
		return Display_DUserAccount::showWishList($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start,$result);
	}
	/**
	 * This function is used to send wishlist 
	 *
	 * .
	 * 
	 * @return string
	 */
	
	function sendWishlist()
	{

		include_once('classes/Core/CHome.php');
		include_once('classes/Display/DUserAccount.php');
		$skin = Core_CHome::skinName();
		
		$userid=$_SESSION['user_id'];
		$sqlselect="SELECT a.product_id,image,title,msrp,date_format(date_added,'%e/%c/%Y') as adate FROM `wishlist_table` a, products_table b where a.product_id=b.product_id and a.user_id=".$userid." order by date_added desc";
		
		$obj = new Bin_Query();
		$obj->executeQuery($sqlselect);
		$content =Display_DUserAccount::getWishList($obj->records);
		
		$fileName="css/".$skin."/styles.css";
		$data= '<style type="text/css">'.implode('',file($fileName))."</style>";
		$result=$data.$content;

		//Get User Mail Address
		$sqlselect="SELECT b.email FROM `users_table` a,newsletter_subscription_table b where  a.user_status=1 and a.user_id=".$_SESSION['user_id'];
		$obj->executeQuery($sqlselect);

		$from=$obj->records[0]['email']; 
		
		$to_addr=$_POST['txtEmail'];
		$title=$_SESSION['user']."Wishlsit";
		$mail_content=$result;

		include('classes/Lib/Mail.php');
		$mail = new Lib_Mail();
		$mail->From($from); 
		$mail->ReplyTo($from);
		$mail->To($to_addr); 
		$mail->Subject($title);
		$mail->Body($mail_content);


		$mail->Send();

		return '<div class="alert alert-success">
		<button data-dismiss="alert" class="close" type="button">×</button>
		'.Core_CLanguage::_(MAIL_HAS_BEEN_SENT).'
		</div>';
	}
	/**
	 * This function is used to get status for wishlist 
	 *
	 * .
	 * 
	 * @return string
	 */
	function getStatus()
	{
		if($_POST['hidWishStat']==1)
			return 'block';	
		else
			return 'none';		
	}
}
?>
