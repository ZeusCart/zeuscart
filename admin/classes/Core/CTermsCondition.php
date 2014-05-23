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
 * This class contains functions to get and update the terms and conditions conten
 *
 * @package  		Core_CTermsCondition
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CTermsCondition
{
	
	/**
	 * Function gets  the terms and conditions content from the database 
	 * 
	 * 
	 * @return string
	 */
	function selectTerms()
	{
		$sql="SELECT termscontent,termsid FROM termsconditions_table ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return $query->records[0]['termscontent'];
		}
		else
		{
			return "";
		}
	}
	
	/**
	 * Function updates the terms and conditions content to the database 
	 * 
	 * 
	 * @return string
	 */
	function updateTerms()
	{
		
		$sql = "UPDATE termsconditions_table SET termscontent='".$_POST['termscontent']."' Where termsid=1" ;
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		{
			return '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Well done!</strong> Content Updated Successfully</div>';
		}
		else
		{
				return '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button> Content Not Updated </div>';
		}
	}
	
}
?>
