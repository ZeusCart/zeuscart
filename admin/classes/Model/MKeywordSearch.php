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
 * MKeywordSearch
 *
 * 
 * 
 * @package		Model_MKeywordSearch
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Model_MKeywordSearch
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	
	function keywordsearch()
	{
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CCategoryList.php');
		include('classes/Display/DCategoryList.php');		
		$output['categorylist'] =   Core_CCategoryList::showCategory();			
		$search=$_POST['search'];
	    $sort=$_POST['selsort'];
		$txtsearch=$_POST['searchtxt'];
		if($txtsearch.length>0)
		   $search=$txtsearch;
		$mode=$_POST['selmode'];
		$output['keywordsearch'] =  Core_CKeywordSearch::searchKeyWord($search,$sort,$mode);
		$output['countrecords']=Core_CKeywordSearch::countSearch($search);
		$output['disppagesize']=Display_DKeywordSearch::displayPageSize();
		$output['searchresultfor']=Display_DKeywordSearch::searchResultFor($search);
		$output['searchsession']=Display_DKeywordSearch::searchSession($search);
		$output['pagination']=Core_CKeywordSearch::pagination($search);
  	    $output['disppricerange']=Core_CKeywordSearch::priceRange();
  	    $output['features']=Core_CKeywordSearch::featureList();
		
		$output['brandwithcount']=Core_CKeywordSearch::dispBrandWithCount();
		

		$output['mylink']=Core_CKeywordSearch::linkMode();
//		echo ($txtsearch);
		$output['sortby']=Display_DKeywordSearch::sortBy();
	    Bin_Template::createTemplate('products.html',$output);

	}	
}
?>