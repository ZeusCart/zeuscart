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
 * Currency settings  related  class
 *
 * @package   		Display_DCurrencySettings
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DCurrencySettings
{
 	/**
	* This function is used to Display All Enabled Currencies
	* @param mixed $arr
	* @return string
 	*/
 	function displayEnabledCurrencies($arr)
	{
		
		$output='<ul>
         	 <h2>Choose a currency below to display product price in the selected currency.</h2>';
		  
       		 foreach($arr as $row)
		{
			if ($_SESSION['currencysetting']['selected_currency_settings']['country_code']==$row['country_code'])
				$output.='<li>'.'<h1><img src="'.$_SESSION['base_url'].'/images/flags/'.$row['country_code'].'.gif" alt="'.$row['country_code'].'" border="0" /><span>'.$row['country_name'].'</span></h1></li>';
			else
				$output.='<li>'.'<a href="'.$_SESSION['base_url'].'/index.php?do=changecurrency&currency='.$row['id'].'"><img src="images/flags/'.$row['country_code'].'.gif" alt="'.$row['country_code'].'" border="0"/><span>'.$row['country_name'].'</span></a></li>';
		}
	
		$output.='</ul>';
		return $output;
	}
}
?>
