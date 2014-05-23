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
 * This class contains functions to get, add, edit and delete FAQs .
 *
 * @package  		Core_CFaq
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CFaq 
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	

	var $output = array();	
	
	/**
	 * Stores the resultset
	 *
	 * @var array $arr
	 */	
	
    var $arr = array();	
	
	/**
	 * Function gets the list of FAQs available in the database
	 * 
	 * 
	 * @return string
	 */
		

	function listFaq()
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

		$sql="select * from faq_table";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
		}
		$sql="select * from faq_table LIMIT $start,$end";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		{		
			return  Display_DFaq::listFaq($query->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		}
	}
	
	/**
	 * Function insert a new FAQ into the table 
	 * 
	 * 
	 * @return string
	 */
		
	
	function add()
	{
		$qn=$_POST['qn'];
		$ans=$_POST['ans'];
		if ( ($qn!='') && ($ans!='') )
		{
			$sql="insert into faq_table (faq_qn,faq_ans) values('".$qn."','".$ans."')";
			$query = new Bin_Query();
			$query->executeQuery($sql);
			return "<div class='success_msgbox'>FAQ Added Successfully!</div>";
		}
		else
			return "<div class='exc_msgbox'>Empty Values Cannot Be Added</div>";
	}
	
	/**
	 * Function updates the changes in the FAQ 
	 * 
	 * 
	 * @return string
	 */
	
	function edit()
	{
		$qn=$_POST['qn'];
		$ans=$_POST['ans'];
		$id=$_POST['hidid'];
		if ( ($qn!='') && ($ans!='') )
		{
			$sql="update faq_table set faq_qn='".$qn."',faq_ans='".$ans."' where faq_id=".$id;
			$query = new Bin_Query();
			$query->executeQuery($sql);
			return "<div class='success_msgbox'>Updated Successfully!</div>";
		}
		else
			return "<div class='exc_msgbox'>Empty Values Cannot Be Added</div>";
	}
	
	/**
	 * Function deletes FAQ 
	 * 
	 * 
	 * @return string
	 */
	
	
	function delete()
	{
		$id=$_POST['faqcheck'];
		foreach ($id as $key => $value) {
		$sql="delete from faq_table where faq_id=".$value;;
		$query = new Bin_Query();
		$query->executeQuery($sql);
		}
		
		return "<div class='success_msgbox'>Deleted Successfully!</div>";
	}
	
	/**
	 * Function get the details for the selected FAQ 
	 * @param array $result
	 * 
	 * @return string
	 */
	
	function show($result='')
	{
		$id=(int)$_GET['id'];
		if($id!='')
		{
			$sql="select * from faq_table where faq_id=".$id;
			$query = new Bin_Query();
			$query->executeQuery($sql);
			return Display_DFaq::show($result,$query->records[0]);
		}
		else
			return Display_DFaq::show($result);
	}
}
?>