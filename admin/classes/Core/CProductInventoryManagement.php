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
 * This class contains functions to get and update the inventory details 
 *
 * @package  		Core_CProductInventoryManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CProductInventoryManagement
{
	
	 /**
	 * Function gets the inventory details from the database
	 * 
	 * 
	 * @return string
	 */
	 
	 
	 function dispInventory()
	 {
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
	 	
	 	
	 	$sql='select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id';
	 	
	 	$query = new Bin_Query();
	 	if($query->executeQuery($sql))
	 	{	
	 		$total = ceil($query->totrows/ $pagesize);
	 		include_once('classes/Lib/Paging.php');
	 		$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
	 		$this->data['paging'] = $tmp->output;
	 		$this->data['prev'] =$tmp->prev;
	 		$this->data['next'] = $tmp->next;
	 		
	 		$sql1 = "select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id  LIMIT $start,$end";
	 		$query1 = new Bin_Query();
	 		
	 		$query1->executeQuery($sql1);
	 	}
	 	return Display_DProductInventoryManagement::dispInventory($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
	 	
	 	
		// $obj=new Bin_Query();
		//$obj->executeQuery($sql);
		// return Display_DProductInventoryManagement::dispInventory($obj->records);
	 }
	 
	/**
	 * Function gets the inventory details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function editInventory($Err)
	{
		$id=$_GET['id']; 
		$sql='select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id where a.inventory_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DProductInventoryManagement::editInventory($obj->records,$Err);
	}
	
	/**
	 * Function deletes the selected inventory from the database
	 * 
	 * 
	 * @return string
	 */
	function deleteInventory()
	{
		$id=$_GET['id'];
		$sql='delete from product_inventory_table where inventory_id='.$id;
		$obj=new Bin_Query();
		$obj->updateQuery($sql);
	}
	
	/**
	 * Function updates the inventory details to the database
	 * 
	 * 
	 * @return string
	 */
	
	function updateInventory()
	{

		$id=(int)$_POST['invid'];
		$rol=(int)$_POST['rol'];
		$soh=(int)$_POST['soh'];
		
		$sql="update product_inventory_table set rol=".$rol.", soh=".$soh." where inventory_id=".$id;
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
		{	
			$_SESSION['siteinventorymsg'] = '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button> Product stock on hands has been updated successfully </div>';
	
			//select mail setting
			$sqlMail="SELECT * FROM mail_messages_table WHERE mail_msg_id='8' AND mail_user='0'";
			$objMail=new Bin_Query();
			$objMail->executeQuery($sqlMail);
			$message=$objMail->records[0]['mail_msg'];
			$title=$objMail->records[0]['mail_msg_title'];
			$subject=$objMail->records[0]['mail_msg_subject'];

			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
			$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
			$site = $protocol.$_SERVER['HTTP_HOST'].$dir;


			$message = str_replace("[product_id]",$id,$message);
			$message = str_replace("[product_name]",$_POST['title'],$message);

			self::sendingMail($email,$title,$message);
		
		}
		else
		{	
			$_SESSION['siteinventorymsg'] = '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button> Product stock on hands has not been  updated successfully </div>';

		}
		
	}


	/**
	 * Function sends a mail to the mail id supplied using the Lib_Mail()
	 * 
	 * 
	 * @param array $to_mail
	 * @param string $title
	 * @param string $mail_content	 
	 * @return string
	 */
	function sendingMail($to_mail,$title,$mail_content)
	{
		
		$sql = "select set_id,admin_email from admin_settings_table where set_id='1'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['admin_email']; 
			$to_mail=$obj->records[0]['admin_email'];
			include('classes/Lib/Mail.php');
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo($from);
			$mail->To($to_mail); 
			$mail->Subject($title);
			$mail->Body($mail_content);
			$mail->Send();
		}
		else
			return 'No mail id provided';
	}
	
}
?>