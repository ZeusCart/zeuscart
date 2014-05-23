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
 * This class contains functions related customer group management.
 *
 * @package  		Core_CCustomerGroup
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CCustomerGroup
{
 	
	/**
	 * Function gets and displays the customer group  details from the database
	 * @param array $Err
	 * 
	 * @return string
	 */
	  function displayCustomerGroup($Err)	 
	 {
	  	$sql='select * from users_group_table'; 
		$obj=new Bin_Query();
		$obj->executeQuery($sql);

	 	return Display_DCustomerGroup::displayCustomerGroup($obj->records,$paging,$prev,$next,$Err);
	 } 
	 
	/**
	 * Function gets and displays the customer group from the database
	 * @param array $Err
	 * 
	 * @return string
	 */
	 
	function displayAjaxCustGroup($Err)
	{


		$grpname = $_POST['grpname'];
		$discount = $_POST['discount'];
		 
;
		if(isset($_GET['pagesize']) && $_GET['pagesize'] =='25' )
		{
			$pagesize=25;
		}
		elseif(isset($_GET['pagesize']) && $_GET['pagesize'] =='50' )
		{
			$pagesize=50;
		}
		else
		{
			$pagesize=15;
		}

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
			 
		$sql='select * from users_group_table'; 
		$condition=array();

		if($grpname!='')
		{
			$condition []= "  group_name like '%".$grpname."%'";
		}
		if($discount!='')
		{
			 $condition[]= " group_discount='".$discount."'";
		}
		
		if(count($condition)>1)
			 $sql.= ' where '. implode(' and ', $condition);
		elseif(count($condition)>0)
			$sql.= ' where  '. implode('', $condition);
		elseif(count($condition)==0)
		{
			$sql.=' ';
		}	
		

		 $query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			if (empty($condition))
					 $sql1 =$sql." LIMIT ".$start.",".$end; 
				else
					  $sql1 =$sql;  
			$query1 = new Bin_Query(); 
			$query1->executeQuery($sql1);
		}
				
	
		return Display_DCustomerGroup::displayCustomerGroup($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$Err);
				

	}
	

	/**
	 * Function display the details for the selected Customer group
	 * @param array $Err
	 * 
	 * @return string
	 */
	function displaySelectedGroup($Err,$values)
	{
		 
		 
		 $id=mysql_escape_string(intval($_GET['id']));
		 
		 $sql='select  group_id,group_name,group_discount from  users_group_table where group_id='.$id;
         	 $obj1=new Bin_Query();
		 $obj1->executeQuery($sql);
		 return Display_DCustomerGroup::displaySelectedGroup($obj1->records,$Err,$values); 
	}
	
	
	/**
	 * Function updates the changes for the selected Customer group  
	 * 
	 * 
	 * @return string
	 */
	
	function updateCustomerGroup()
	{
  		$id= $_POST['groupid'];
		$name=$_POST['txtgrpname'];
	        $discount=$_POST['txtdiscount'];

			$obj=new Bin_Query();
        		$sql="update users_group_table set group_name='".$name."',group_discount='".$discount."' where group_id=".$id; 
 			
  		 	
	  		$obj->updateQuery($sql); 
	  		$_SESSION['addmsg']='<div class="alert alert-success">
   			 <button type="button" class="close" data-dismiss="alert">×</button>Customer Group Updated Successfully</div>'; 
			header("Location:?do=custgroup");
			exit;

		
	}
	
	/**
	 * Function deletes a selected customer group from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function deleteCustomerGroup()
	{
	     	 $id=mysql_escape_string(intval($_GET['id']));
		 $sql='delete from  users_group_table where group_id='.$id;
         	 $obj1=new Bin_Query();
		 $obj1->updateQuery($sql);
		 $_SESSION['addmsg']='<div class="alert alert-success">
   			 <button type="button" class="close" data-dismiss="alert">×</button>Customer Group Deleted Sucessfully!</div>'; 
		 header("Location:?do=custgroup");
		 exit;	 
	}
	
	/**
	 * Function adds a new Customer Group to the database
	 * 
	 * 
	 * @return string
	 */
	
	function insertCustomerGroup()
	{
	  	$name=  $_POST['txtgrpname'];
  	   	$discount= $_POST['txtdiscount'];

		$sql="insert into users_group_table (group_name,group_discount)values('".$name."','".$discount."')";
		$obj=new Bin_Query();
		$obj->updateQuery($sql);	
		$_SESSION['addmsg']='<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>Customer Group added Successfully</div>'; 
		header('Location:?do=custgroup');
		exit;

		
	}
	
	/**
	 * Function checks whether the Customer Group exists.
	 * 
	 * 
	 * @return bool
	 */
	
	function checkCustGroupExists()
	{
		$name=  $_POST['custGroupName'];
		
		$sql="select count(*) as cnt from ".TBL_PREFIX."users_group_table where group_name='".$name."'";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql);
		
		
		if ($obj1->records[0]['cnt'] > 0 )
			return true;
		else
			return false;
	}
}
?>