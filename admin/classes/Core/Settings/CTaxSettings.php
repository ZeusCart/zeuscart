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
 * This class contains functions to get and update the tax settings from the database 
 *
 * @package  		Core_Settings_CTaxSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CTaxSettings
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();
	
	/**
	 * Function gets the tax details from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showTaxSettings()
	{
		$sqlselect = "SELECT * FROM tax_master_table ORDER BY id ASC";
			
		$query = new Bin_Query();
		$query->executeQuery($sqlselect);
		
		$sqlunique="SELECT * FROM uniquetax_settings_table";
		$queryunique = new Bin_Query();
		$queryunique->executeQuery($sqlunique);
		
	
		return Display_DTaxSettings::showTaxSettings($query->records,$queryunique->records);
	
	}
	
	/**
	 * Function updates the changes made in the tax details into the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateTaxSettings()
	{

	
		if(is_numeric($_POST['SingleTaxRate']))
		{
		if((int)$_POST['TaxSetting']==3)
		{
			$updatesql="UPDATE uniquetax_settings_table SET tax_name='".$_POST['SingleTaxRateName']."',based_on_amount='".$_POST['SingleTaxRateBasedOn']."',tax_rate_percent=".$_POST['SingleTaxRate'];
			$updatequery= new Bin_Query();
			$updatequery->updateQuery($updatesql);
		}
		
		for($i=1;$i<=3;$i++)
		{
		  $sql="UPDATE tax_master_table SET status = ".(((int)$_POST['TaxSetting']==$i) ? '1' : '0' )." WHERE id =".$i; 
			$query = new Bin_Query();
			$query->updateQuery($sql);
		}
		return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Settings Changed Successfully.</div>';
		}
		else
		{
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Settings failed(Tax rate - Numeric Only).</div>';
		}
			
	}
	
	/**
	 * Function gets the country wise tax list from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showCountrywiseTaxList()
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
					
		$sql='SELECT a.id,a.tax_name,a.based_on_amount,a.country_code,a.based_on_address,a.tax_rate_percent,a.status,b.cou_name FROM countrywisetax_settings_table a LEFT JOIN country_table b ON a.country_code=b.cou_code';
						
			
		
	
	  
	  
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
			
				$query = new Bin_Query();
				//$sql1="select orders_status_id,orders_status_name from orders_status_table";
				$obj1=new Bin_Query();
				$obj1->executeQuery($sql1);
				
				
		}
		
			return Display_DTaxSettings::showCountrywiseTaxList($obj1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
		
	
	}
	
	/**
	 * Function gets the country details from the table for updating the tax list 
	 * 
	 * @param array $Err
	 * @return string
	 */	 	
	
	function addCountrywiseTax($Err)
	{
	
		
		$sqlCat="SELECT * FROM country_table ORDER BY cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);		
		return Display_DTaxSettings::addCountrywiseTax($queryCat->records,$Err);	
	}
	
	
	/**
	 * Function gets the country wise tax details from the table 
	 * 
	 * @param array $Err
	 * @return string
	 */	 
	function editCountrywiseTax($Err)
	{
	
		
		$sqlCat="SELECT * FROM country_table ORDER BY cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);
		
		$taxid=(int)$_GET['taxid'];
		
		$sqltax="SELECT id,tax_name AS taxratename, based_on_amount AS taxratebasedon,country_code AS taxratecountry,based_on_address AS taxaddress,tax_rate_percent AS taxratepercent,status AS taxratestatus FROM countrywisetax_settings_table WHERE id=".$taxid; 
		$querytax = new Bin_Query();
		$querytax->executeQuery($sqltax);
		
		return Display_DTaxSettings::editCountrywiseTax($querytax->records,$queryCat->records,$Err);
	
	}
	
	/**
	 * Function adds a new country wise tax details into the table 
	 * 
	 * 
	 * @return string
	 */	 
	
	function insertCountrywiseTax()
	{
		
		$taxname=$_POST['taxratename'];
		$basedonamt=$_POST['taxratebasedon'];
		$countrycode=$_POST['taxratecountry'];
		$basedonaddr=$_POST['taxaddress'];
		$taxrate=$_POST['taxratepercent'];
		$status=(int)$_POST['taxratestatus'];
		
		$chksql="SELECT COUNT(*) AS count FROM countrywisetax_settings_table WHERE country_code='".$countrycode."'";
		$chquery=new Bin_Query();
		$chquery->executeQuery($chksql);
		
		if ($chquery->records[0]['count']==0)
		{
			$sql="INSERT INTO countrywisetax_settings_table (tax_name,based_on_amount,country_code,based_on_address,tax_rate_percent,status) VALUES ('".$taxname."','".$basedonamt."','".$countrycode."','".$basedonaddr."',".$taxrate.",".$status.")";
			
			$query=new Bin_Query();
			if ($query->updateQuery($sql))
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Rate Added Successfully.</div>';
		}
		else
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Rate Is Already Added For Selected Country. </div>';
		
	}
	
	/**
	 * Function updates the changes made in the country wise tax into the table 
	 * 
	 * 
	 * @return string
	 */	 
	
	function updateCountrywiseTax()
	{
		
		//$taxid=(int)$_POST['taxid'];
		if(isset( $_SESSION['edittaxid']))
			$taxid=$_SESSION['edittaxid'];
		$taxname=$_POST['taxratename'];
		$basedonamt=$_POST['taxratebasedon'];
		$countrycode=$_POST['taxratecountry'];
		$basedonaddr=$_POST['taxaddress'];
		$taxrate=$_POST['taxratepercent'];
		$status=(int)$_POST['taxratestatus'];
		
		$chksql="SELECT COUNT(*) AS count FROM countrywisetax_settings_table WHERE country_code='".$countrycode."' AND id <>".$taxid;		
		//$chksql="SELECT COUNT(*) AS count FROM countrywisetax_settings_table WHERE country_code='".$countrycode."'";
		$chquery=new Bin_Query();
		$chquery->executeQuery($chksql);
		if ($chquery->records[0]['count']==0)
		{
			$sql="UPDATE countrywisetax_settings_table SET  tax_name='".$taxname."', based_on_amount='".$basedonamt."',country_code='".$countrycode."',based_on_address='".$basedonaddr."',tax_rate_percent=".$taxrate.",status=".$status." WHERE id=".$taxid;
			$query=new Bin_Query();
			if ($query->updateQuery($sql))
			{
				 unset($_SESSION['edittaxid']);
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Rate Modified Successfully.</div>';
			}
		}
		else
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Rate Is Already Added For Selected Country .</div>';
		
	}
	
	/**
	 * Function deletes the country wise tax settings for the selected id
	 * 
	 * 
	 * @return string
	 */	 
	
	function deleteCountrywiseTax()
	{
		$taxid=(int)$_GET['taxid'];
		
		$sql="DELETE FROM countrywisetax_settings_table WHERE id =".$taxid;
		
		$query=new Bin_Query();
		
		if ($query->updateQuery($sql))
			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Tax Rate Deleted Successfully.</div>';
		else
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Cannot Delete Tax. </div>';
		
	}
}
?>