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
 * This class contains functions to get the dynamic cms details from the database 
 *
 * @package  		Core_Settings_DynamicCms
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_DynamicCms
{
	
	/**
	 * Function gets the dynamic  cms from the db. 
	 * 
	 * 
	 * @return string
	 */	
	function showDynamicCmsList()
	{

		$pagesize=20;
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
			
		$sqlselect = "select * from cms_table ";
			
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select * from cms_table  LIMIT $start,$end";
			$query1 = new Bin_Query();
			if($query1->executeQuery($sql1))
			{
				return Display_DDynamicCms::showDynamicCmsList($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "<div class='clsListing clearfix'><div class='alert alert-info'>            
           			No dynamic cms page found
          			</div>
				</div>";
		}	

	
	}	
	/**
	 * Function  is used to add the  dynamic cms page into db
 	 * 
	 * 
	 * @return void
	 */
	function addDynamicPageSettings()
	{

		//writing the do name into dll main file
		include('../Built/main/Dll.php');
		$mapping= $domapping;
		$joining =array($_POST['cms_page_alias']=>array('model' => 'MHome','function' => 'showDynamicContent','loadlib' => '1',));
		
		$newarray= array_merge($mapping,$joining);


		$content = "<?php \n\n".' $system = '.var_export($system, true) . ";\n";
		$content .= "\n\n".' $libraries = '.var_export($libraries, true) . ";\n ";
		$content .= "\n\n".' $domapping = '.var_export($newarray, true) . ";\n ";
		$content .= "\n\n".' $globalmapping = '.var_export($globalmapping, true) . ";\n ?>";

		//@chmod('../Built/main/Dll.php',0777);
		
		//if ($fp = @fopen('../Built/main/Dll.php', 'wb'))
		//{
		//	@flock($fp, LOCK_EX);
			//"\n\$expired = (time() > " . (time() + $ttl) . ") ? true : false;\nif (\$expired) { return; }\n\n\$data = " .
		//	fwrite($fp, $content);
		//	@flock($fp, LOCK_UN);
		//	fclose($fp);
		//	@chmod('Built/main/Dll.php', 0666);
		//}


		$obj=new Bin_Query();
		$sql="INSERT INTO cms_table (cms_page_title,cms_page_content,cms_page_alias,cms_create_date,cms_meta_content,cms_meta_keyword) VALUES('".$_POST['cms_page_title']."','".$_POST['cms_page_content']."','".$_POST['cms_page_alias']."',NOW(),'".$_POST['cms_meta_content']."','".$_POST['cms_meta_keyword']."')";
		if($obj->updateQuery($sql))
		{

			$output='<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>  Page '. $_POST['cms_page_title']  .' Created Successfully</div>';
		}

		return $output;
	}
	/**
	 * Function is used to delete the dynamic cms in db 
	 * 
	 * 
	 * @return string
	 */	
	function deleteDynamicCms()
	{
		foreach ($_POST['dynaminPagecheck'] as $key => $value) {
		
			
			$sql="delete from  cms_table where cms_id ='".$value."' "; 
			$qry=new Bin_Query();
			if($qry->updateQuery($sql))
			{
			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Deleted Successfully</div>';
					
			}
			else
			{
			
				$result ='<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Deletion Failed. Try Again Later</div>';	
				  
			}	
			
		}
		

		return $result;  

	}
	/**
	 * Function is used to get the dynamic cms  from db 
	 * 
	 * 
	 * @return string
	 */
	function getdynamiccms()
	{
		
		$sql="select * from  cms_table where cms_id='".$_GET['id']."'"; 
		$qry = new Bin_Query();
		$qry->executeQuery($sql);
		$output=$qry->records[0];

		return $output;

	}
	/**
	 * Function is used to update the dynamic cms in db 
	 * 
	 * 
	 * @return string
	 */
	function updateEditDynamicCms()
	{

			
		$sql="update cms_table  set cms_page_title='".$_POST['cms_page_title']."',cms_page_alias 	='".$_POST['cms_page_alias']."',cms_page_content='".trim($_POST['cms_page_content'])."',cms_page_status='".$_POST['cms_page_status']."',cms_meta_content='".trim($_POST['cms_meta_content'])."',cms_meta_keyword='".trim($_POST['cms_meta_keyword'])."' where  	cms_id='".$_GET['id']."'"; 
		$qry=new Bin_Query();
		if($qry->updateQuery($sql))
		{
			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Updated Successfully</div>';
			
		}
		else
		{

			$result = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Updated</div>';		
						 
		}	
		return $result;
	}
}
?>