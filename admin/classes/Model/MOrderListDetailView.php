<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * MOrderListDetailView
 *
 * 
 * @package		Model_MOrderListDetailView
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------



class Model_MOrderListDetailView
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	function func()
	{
		include('classes/Core/COrderListDetailView.php');
		include('classes/Display/DOrderListDetailView.php');		
		
		$output['area1'] =   Core_COrderListDetailView::func1();				

		Bin_Template::createTemplate(CURRENT_TEMPLATE_DIR.'/OrderListDetailView.html',$output);
	}	
}
?>