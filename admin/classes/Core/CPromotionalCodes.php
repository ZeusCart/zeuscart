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
 * This class contains functions to creates and sends promotional codes for the selected users.
 *
 * @package  		Core_CPromotionalCodes
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CPromotionalCodes
{
	/**
	 * Function selects a method to send the promotional codes.
	 * 
	 * 
	 * @return string
	 */
	function selectMethodToSendPromotionalCode()
	{
		$output =  Display_DPromotionalCodes::selectMethodToSendPromotionalCode();
		
		return $output;
		
	}	
	
	/**
	 * Function selects the list of users from whom the coupon codes to be send. 
	 * 
	 * 
	 * @return string
	 */
	
	function sendCouponToSelectedUsers()
	{
	
		
		$coupon_code=$_POST['couponcode'];
		$user_ids=$_POST['user_id'];
		
		if (count($user_ids)>0)
		{
		
			for($i=0;$i < count($user_ids);$i++)
			{
				
				$sql = "select user_email from users_table where user_id=".$user_ids[$i];
				$obj = new Bin_Query();
				if($obj->executeQuery($sql))
				{
					$mailids =$obj->records[0]['user_email']; 
				
					//echo $mailids.'-'.$user_ids[$i];
					$title='Coupons';
					$mail_content='Dear Customer , <br> You Have Received a Coupon. <br> Coupon code - '.$coupon_code;
					$default=new Core_CPromotionalCodes();
					$default->sendingMail($mailids,$title,$mail_content);
					
					$sql="INSERT INTO  coupon_user_relation_table(coupon_code, user_id, no_of_uses) VALUES ('".$coupon_code."',".$user_ids[$i].",0)";		
		
					$obj=new Bin_Query();
					if($obj->updateQuery($sql))
					{
						
					}
					
				}
				
			}
			$_SESSION['coupon_id']='';
			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Coupon Code Send To Selected Users Successfullly.</div>';
		}
		else
		{
			$_SESSION['coupon_id']='';
			if($_GET['page']=='')
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Select Atleast One User.</div>';	
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
		
		$sql = "select set_value from admin_settings_table where set_name='Admin Email'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['set_value']; 
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo($from);
			$mail->To($to_mail); 
			$mail->Subject($title);
			$mail->Body($mail_content);
			$mail->Send();
		}
		else
			return 'No mail id provided In Admin';
	}
	
	/**
	 * Function displays the users who are eliglble for promotional codes
	 * 
	 * 
	 * @return string
	 */
	
	
	
	function displayUsersForPromotionalCode()
	{

		
		if(isset($_POST['b1']))
		{
			$type=$_POST['type'];
			
			
			$order_condition=$_POST['order_condition'];
			if($type=='ordercount')
				$str=' HAVING ordercount '.$order_condition.(int)$_POST['order_from'];
			elseif($type=='totalorder')
				$str=' HAVING totalorder '.$order_condition.(int)$_POST['purchase_from'];
			elseif($type=='user_doj')
				$str1=" AND user_doj BETWEEN  date_format('".$_POST['fromdate']."','') AND '".$_POST['todate']."'"; 
				
		}
		if (isset($_GET['cid']))
			$cid=$_SESSION['coupon_id']=(int)$_GET['cid'];
		else
			$cid=$_SESSION['coupon_id'];
			
		if ($cid!='')
		{
			$sqlcoupon="SELECT coupon_code FROM coupons_table where id=".(int)$cid;
			$objcoupon = new Bin_Query();
			$objcoupon->executeQuery($sqlcoupon);
			$promocode=$objcoupon->records[0]['coupon_code'];
			if ($promocode!='')
			{
				
				if ($type=='' || $type=='user_doj')
				{
					$sqlselect ="SELECT a.user_id,a.user_display_name,a.user_email,a.user_doj,sum(b.order_total) AS totalorder,count(b.orders_id) AS ordercount FROM users_table a left join orders_table b on a.user_id=b.customers_id WHERE a.user_status=1  ".$str1." GROUP BY a.user_id ORDER BY a.user_display_name ASC";
				}
				else
				{
					$sqlselect = "SELECT a.user_id,a.user_display_name,a.user_email,a.user_doj,sum(b.order_total) AS totalorder,count(b.orders_id) AS ordercount FROM users_table a, orders_table b WHERE a.user_status=1 AND a.user_id=b.customers_id ".$str1." GROUP BY a.user_id ".$str." ORDER BY a.user_display_name ASC";
				}
					
			$obj = new Bin_Query();
				
				if($obj->executeQuery($sqlselect))
				{
					$output =  Display_DPromotionalCodes::displayUsersForPromotionalCode($obj->records,'1',$promocode);
				}
				else
				{
					$output = Display_DPromotionalCodes::displayUsersForPromotionalCode($obj->records,'0',$promocode);
				}
				return $output;
			}
			else
			{
			}
			
		}
		
		
		return $output;
		
	}	
	
	
	/**
	 * Function updates the status for the promotional codes. 
	 * 
	 * 
	 * @return string
	 */
	
	function changeStatusForPromotionalCodes()
	{
		
		if ($_GET['status']=='deny' )
		{
			$str=' status=0 ';
		}
		elseif ($_GET['status']=='accept')
		{
			$str=' status=1 ';
		}
		if (isset($_GET['id']))
		{
			$sql='UPDATE coupons_table SET '.$str.' where id='.(int)$_GET['id'];
			$obj=new Bin_Query();
		
			if($obj->updateQuery($sql))
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Coupon Status Updated Successfullly.</div>';	
			else
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Unable To Update Coupon Status.</div>';	
		}
				
	}
	
	/**
	 * Function adds the new promotional codes into the database.
	 * 
	 * 
	 * @return string
	 */
	
	function createPromotionalCodes()
	{
		
		/*$sql="SELECT  b.category_name as parentcatname ,b.category_id as parentid, a.category_name as subcatname, a.category_id FROM category_table a,category_table b  WHERE a.category_parent_id <> 0 AND a.category_parent_id=b.category_id ORDER BY parentcatname";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$arr=$obj->records;*/
		
		
		$sql="SELECT  category_name as parentcatname ,category_id as parentid FROM category_table WHERE category_parent_id = 0 ORDER BY parentcatname";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);		
		$rows =$obj->records;			

		$i=0;
		foreach ($rows as $row)
		{
			$sql="SELECT  category_id , category_name FROM category_table WHERE category_parent_id = ".$row['parentid']." ORDER BY category_name";
			$obj1=new Bin_Query();
			$obj1->executeQuery($sql);
			$subcats=$obj1->records;

			if(count($subcats) > 0)
			{
				$list[$i]['id']=$row['parentid'];
				$list[$i]['catname']=$row['parentcatname'];
				foreach($subcats as $subcat)
				{
					$list[$i]['subcats'][]=$subcat;
				}
				$i++;
			}

		}
		
		$default=new Core_CPromotionalCodes();
	
		return Display_DPromotionalCodes::createPromotionalCodes($list,$default->getRandString(11));
	}
	
	/**
	 * Function displays the users list who are eligble for promotional codes
	 * 
	 * 
	 * @return string
	 */
	
	function displayPromotionalCodes()
	{
		
		$pagesize=10;
		$_SESSION['coupon_id']='';
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
					
		$sql='SELECT id,coupon_code,coupan_name,created_date,discount_amt,discount_type, valid_from,valid_to,min_purchase, 			
			  no_of_uses,status FROM coupons_table ';
						
			
		
	
	  
	  
		$obj=new Bin_Query();
  		if($obj->executeQuery($sql))
		{
				$total = ceil($obj->totrows/ $pagesize);
				include('classes/Lib/Paging.php');
				$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
				$this->data['paging'] = $tmp->output;
				$this->data['prev'] =$tmp->prev;
				$this->data['next'] = $tmp->next;
				$sql1 =$sql." LIMIT ".$start.",".$end;
				//	echo $sql1;exit;
				$query = new Bin_Query();
				//$sql1="select orders_status_id,orders_status_name from orders_status_table";
				$obj1=new Bin_Query();
				$obj1->executeQuery($sql1);
				
				
		}
		
			return Display_DPromotionalCodes::displayPromotionalCodes($obj1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
		/*else
		{
			return "No Orders Found";
		}
		return Display_DOrderManagement::dispOrders($obj1->records); */
	
	}
	/**
	 * Function adds the new promotional codes into the database.
	 * 
	 * 
	 * @return string
	 */
	
	function insertPromotionalCode()
	{

	   $cupon_code=$_POST['cupon_code'];
	   $cupon_name=$_POST['cupon_name'];
	   $discount_amt=$_POST['discount_amt'];
	   $discount_type=$_POST['discount_type'];
	   $txtfromdate=$_POST['txtfromdate'];
	   $txttodate=$_POST['txttodate'];
	   $min_purchase=$_POST['min_purchase'];
	   $uses_count=$_POST['uses_count'];
	   $maincategories=$_POST['maincategories'];
	   $subcategories=$_POST['subcategories'];
	
	   $created_date=date('Y-m-d H:i:s');
	   //subtraction for date range checking 
	   $datediff=strtotime($txttodate) - strtotime($txtfromdate);
	   //subtraction for calculate the number of days
	   $difference = abs(strtotime($txttodate) - strtotime($txtfromdate));
	   
		//calculate the number of days
		$days = round(((($difference/60)/60)/24), 0);
		
		if (!(empty($maincategories)))
		{
			foreach($maincategories as $maincat)
			{
				$sql_maincat="SELECT  category_id , category_name FROM category_table WHERE category_parent_id = ".$maincat." ORDER BY category_name";
				$obj_mc=new Bin_Query();
				$obj_mc->executeQuery($sql_maincat);
				
				foreach($obj_mc->records as $catrecords)
					 $maincatid_array[]=$catrecords['category_id'];
			
			}
		
		}
		
		if (!(empty($subcategories)))
		{
		foreach($subcategories as $subcat)
			$subcatid_array[]=$subcat;
		}
		
	
		if ( (!(empty($maincategories))) && (!(empty($subcategories))) )
			$catid_array=array_unique(array_merge($maincatid_array,$subcatid_array));
		elseif (!(empty($subcategories)))
			$catid_array=$subcatid_array;
		elseif (!(empty($maincategories)))
			$catid_array=$maincatid_array;
	
		if($txtfromdate!='')
		{
			$txtfromdate=$txtfromdate;
			$txtfromdate=date("Y-m-d", strtotime($txtfromdate));
		}
		else
		{
			$txtfromdate= date('Y-m-d');

		}
		if($txttodate!='')
		{
			$txttodate=$txttodate;
			$txttodate=date("Y-m-d", strtotime($txttodate));
		}
		else
		{
			$txttodate= date('Y-m-d');

		}
		 if($days>=0&&$datediff>=0)
	  	{
	
		 $sql="INSERT INTO  coupons_table(coupon_code, coupan_name, created_date ,discount_amt ,discount_type ,valid_from ,valid_to ,min_purchase ,no_of_uses,applies_to,status) VALUES ('".$cupon_code."','".$cupon_name."','".$created_date."',".$discount_amt.",'".$discount_type."','".$txtfromdate."','".$txttodate."',". $min_purchase.",".$uses_count.",'".$categories."',1)";  
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
		{
			if (!(empty($catid_array)))
			{
		   		foreach($catid_array as $catid)
		   		{
 		   			$sql_rel="INSERT INTO coupon_category_table(coupon_code, category_id) VALUES ('".$cupon_code."',".$catid.")";						
					$obj_rel=new Bin_Query();	
					$obj_rel->updateQuery($sql_rel);
				}
			}
			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Coupon Code Generated Successfullly.</div>';	
				
		}
		
		else
		 {
			if($_GET['page']=='')
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Unable To Create Coupon Code.</div>';	
		 }
	   }
	   else
	   {
		  return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Unable To Create Coupon Code(Invalid Date Selection- Valid To Date Should Be Greater than Valid From Date).</div>';	
	   }
	}
	
	/**
	 * Function gets the random type for random number generation 
	 * @param integer $lenght
	 * 
	 * @return array
	 */
	
	function getRandType($lenght){
			  $a = array();
			  for($i=0;$i<$lenght;$i++){
					$a[] = rand(1,3);
			  }
			  return $a;
		}
		
		
	/**
	 * Function generates a random value for random number generation 
	 *
	 * @param array $array
	 * @param string $arrayType
	 * @param bool $tolower
	 * @return string
	 */
	function getRandValue($array,$arrayType,$tolower=false){
			if($arrayType<3){
				$rand = rand(0,25);
			}else{
				$rand = rand(0,9);
			}
	
			$retval = $array[$rand];
	
			if($tolower===true){
				$retval = strtolower($retval);
			}
	
			return $retval;
	}
		
	/**
	 * Function generates a random string for random number generation 
	 *
	 *
	 * @param integer $lenght
	 * 
	 * @return string
	 */
	function getRandString($lenght){
	
			$randTypes = $this->getRandType($lenght);
	
			$alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	
			$nums = array("1","2","3","4","5","6","7","8","9","0");
	
			$randString="";
	
			foreach($randTypes as $type){
				if($type==1){
						$randString .= $this->getRandValue($alphabet,1);
				}elseif($type==2){
						$randString .= $this->getRandValue($alphabet,2,true);
				}else{
						$randString .= $this->getRandValue($nums,3);
				}
			}
		
				
	
	
			return strtoupper($randString);
	}
	
}
?>