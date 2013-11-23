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
 * Currency settings related  class
 *
 * @package   		Core_CCurrencySettings
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CCurrencySettings
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	var $output = array();

	/**
	 * This function is used to get the default curreny    from db
	 * 
	 * 
	 * 
	 */
	function getDefaultCurrency()
	{
		$sql="SELECT currency_name,currency_code,currency_tocken FROM currency_master_table WHERE id=1 AND default_currency=1"; 
		$qry=new Bin_Query();
		$qry->executeQuery($sql);
		if($_SESSION['currencysetting']['selected_currency_id']=='')
		{

			$_SESSION['currencysetting']['default_currency']=$qry->records[0];
			$_SESSION['currencysetting']['selected_currency_id']=1;
			$_SESSION['currencysetting']['selected_currency_settings']=$qry->records[0]; 
			
		}
		
		
	}
	/**
	 * This function is used to change the  curreny  from all page and set in session value
	 * 
	 * 
	 * 
	 */
	function changeCurrency()
	{
		UNSET($_SESSION['currencysetting']);
		 $selcurrsql="SELECT currency_name,currency_code,currency_tocken FROM currency_master_table WHERE id=".(int)$_GET['id']; 
		$selcurrqry=new Bin_Query();
		if ($selcurrqry->executeQuery($selcurrsql))
		{
			$_SESSION['currencysetting']['selected_currency_id']=$_GET['id'];
			$_SESSION['currencysetting']['selected_currency_settings']=$selcurrqry->records[0];
		}
				
	}
	/**
	 * This function is used to show the currency
	 * 
	 * 
	 * @return string
	 */
	function displayEnabledCurrencies()
	{
		$sql="SELECT a.id,a.currency_name,a.currency_code,a.currency_tocken,a.default_currency,b.cou_name as country_name FROM currency_master_table a, country_table b WHERE a.status=1 AND a.country_code=b.cou_code";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DCurrencySettings::displayEnabledCurrencies($obj->records);
	}
	
}
?>