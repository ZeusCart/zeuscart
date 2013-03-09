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
class Core_CUserNewsLetter
{
	function showNewsLetter()
	{
		include('classes/Display/DUserAccount.php');
		
		$sqlselect="SELECT user_id,b.status,b.subsciption_id FROM `users_table` a,newsletter_subscription_table b where a.user_email=b.email and a.user_status=1 and a.user_id=".$_SESSION['user_id'];
		
		$obj = new Bin_Query();

		if($obj->executeQuery($sqlselect))
		{
			 return Display_DUserAccount::showNewsLetter($obj->records);
			 //return $obj->records;
		}	
		
	}
	function addNewsLetter()
	{
		if(isset($_POST['subId']) && $_POST['subId']!='')
		{
			$stat=0;
			if(isset($_POST['chkNewsSub']))
				$stat=1;
			$sqlselect="update newsletter_subscription_table set status=".$stat." where  subsciption_id=".$_POST['subId'];
		
			$obj = new Bin_Query();

			if($obj->updateQuery($sqlselect))
				return "<div class='success_msgbox'>Updated!</div></br>";
			else
				return "<div class='exc_msgbox'>Could not Updated!!</div></br>";
		}
	}	

	
}
?>
