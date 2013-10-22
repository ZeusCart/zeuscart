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
 * This class contains functions to get the details for the news letter settings 
 *
 * @package  		Core_Settings_CNewsletterSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CNewsletterSettings
{

	/**
	 * Function adds a new newsletter details into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	function addNewsletter()
	{		
		if(trim($_POST['newslettertitle'])!='')		
		{
			$sql = "INSERT INTO newsletter_table (newsletter_title,newsletter_content,newsletter_date_added,newsletter_status) VALUES ('".$_POST['newslettertitle']."','".$_POST['newslettercontent']."','".date("Y.m.d")."',0)"; 
			$query = new Bin_Query();
		
			if($query->updateQuery($sql))
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Newsletter <b>'.$_POST['newslettertitle'].'</b> Created successfully.</div> ';
			else
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Error while creating Newsletter.</div> ';
		}
		else
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Error while creating Newsletter.</div> ';

	}
	
	
	/**
	 * Function gets all the news letter available from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showNewsletter()
	{
		include("classes/Display/DNewsletterSettings.php");
		$sql = "SELECT * FROM newsletter_table";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
		
			return Display_DNewsletterSettings::showNewsletter($query->records);
		}
		else
		{
			return '<div class="exc_msgbox">Newsletter Not Found.&nbsp;Do u want to create new Newsletter <a href="?do=newsletter">Click Here.</a></div> ';
		}
	}
	
	/**
	 * Function gets the selected news letter for display.
	 * 
	 * 
	 * @return string
	 */	 	
	
	function viewNewsletter()
    {
        include("classes/Display/DNewsletterSettings.php");
		
		$sql = "SELECT * FROM newsletter_table where newsletter_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DNewsletterSettings::viewNewsletter($query->records);
		}
		else
		{
			return '<div class="success_msgbox">No Newsletter Found.</div>';
		}
		
		
    }
	
	/**
	 * Function updates the changes made in the selected news letter 
	 * 
	 * 
	 * @return string
	 */	 		
	
	function editNewsletter()
	{
		
		$sql = "UPDATE newsletter_table SET newsletter_title='".$_POST['newslettertitle']."',newsletter_content = '".$_POST['newsletter']."' WHERE newsletter_id=".(int)$_GET['id']; 

		$query = new Bin_Query();
		
		if($query->updateQuery($sql))
			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Newsletter Updated successfully.</div> ';
			//$_SESSION['msg']= "Updated Successfully";
			
	}
	
	/**
	 * Function deletes the selected news letter from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteNewsletter()
	{

		if(empty($_POST))
		{
			$sql = "DELETE FROM newsletter_table WHERE newsletter_id='".$_GET['id']."'";  	
			$query = new Bin_Query();
			
			if($query->updateQuery($sql))
				$result ='<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>  News Letter Deleted Successfully.</div>';

		}
		else
		{	
			foreach ($_POST['newslettercheck'] as $key => $value) {
	
			$sql = "DELETE FROM newsletter_table WHERE newsletter_id='".$value."'"; 
	
			$query = new Bin_Query();
			
			if($query->updateQuery($sql))
				$result ='<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>  News Letter Deleted Successfully.</div>';
			
			}
		}
		
		return $result;
			
	}
	
	/**
	 * Function gets the list of email ids available in the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function getEmailIds()
	{

		$sqlNews="SELECT * FROM newsletter_table WHERE newsletter_status=1";
		$objNews=new Bin_Query();
		$objNews->executeQuery($sqlNews);
		if(!$objNews->executeQuery($sqlNews))
		{
			include('classes/Lib/Mail.php');
			if($_POST != '')
			{
		
				$sql = "select email from newsletter_subscription_table where status=1";
				
				$obj = new Bin_Query();
				
				if($obj->executeQuery($sql))
				{
					$cnt=count($obj->records);
					for($i=0;$i<$cnt;$i++)
					{
				
						$removal= array("rn");
						$desc= str_replace($removal, "", trim($_POST['newsletter']));
			
						$email = $obj->records[0]['email'];
						
						$title = $_POST['newslettertitle'];
						$mail_content = $desc;
						$this->sendingMail($email,$title,$mail_content);
					}	
					$sql="UPDATE newsletter_table SET newsletter_status=1 where newsletter_id=".(int)$_GET['newsid'];
					$query = new Bin_Query();
			
					if($query->updateQuery($sql))
					{
						$result = '<div class="alert alert-success">
						<button data-dismiss="alert" class="close" type="button">×</button> Newsletter has been sent successfully.</div>';
					}
				}
				else
				{
					$result = '	<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Invalid User.</div> ';
					
				}
			}
			else
			{
				$sql = "select email from newsletter_subscription_table where status=1";
				
				$obj = new Bin_Query();
				
				if($obj->executeQuery($sql))
				{
					$cnt=count($obj->records);
					for($i=0;$i<$cnt;$i++)
					{
				
						$removal= array("rn");
						$desc= str_replace($removal, "", trim($_POST['newsletter']));
			
						$email = $obj->records[0]['email'];
						
						$title = $_POST['newslettertitle'];
						$mail_content = $desc;
						$this->sendingMail($email,$title,$mail_content);
					}	
					$sql="UPDATE newsletter_table SET newsletter_status=1 where newsletter_id=".(int)$_GET['newsid'];
					$query = new Bin_Query();
			
					if($query->updateQuery($sql))
					{
						$result = '<div class="alert alert-success">
						<button data-dismiss="alert" class="close" type="button">×</button> Newsletter has been sent successfully.</div>';
					}
				}
				else
				{
					$result = '	<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Invalid User.</div> ';
					
				}
			}	

		}
		else
		{
			$result = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>This News letter has been sent to all users</div>';

		}
		return $result;
	}

	
	/**
	 * Function sends the mail to all the ids in the $to_mail array using the Lib_Mail  
	 * 
	 * 
	 * @param array $to_mail
	 * @param string $title
 	 * @param string $mail_content
 	 * 
	 * 
	 * @return void
	 */	
	
	function sendingMail($to_mail,$title,$mail_content)
	{
		
		$sql = "SELECT admin_email,set_id FROM `admin_settings_table` where set_id ='1'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
				$fromemail=$query->records[0]['admin_email']; 
		
		$mail = new Lib_Mail();
		$mail->From($fromemail); 
		$mail->ReplyTo($fromemail);
		$mail->To($to_mail); 
		$mail->Subject($title);
		$mail->Body($mail_content);
		$mail->Send();
	}
	
	/**
	 * Function gets the list of subscribed users from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function subscribedUsers()
    	{
       		 include("classes/Display/DNewsletterSettings.php");
		
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
		
		$sqlselect = "select email,status from newsletter_subscription_table order by email asc";
			
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select email,status from newsletter_subscription_table order by email asc LIMIT $start,$end";
			$query1 = new Bin_Query();
			
			if($query1->executeQuery($sql1))
			{
				return Display_DNewsletterSettings::subscribedUsers($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No Users Found";
		}		
    }
	
}
?>