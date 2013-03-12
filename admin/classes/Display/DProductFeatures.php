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
 * This class contains functions to list out the featured product
 *
 * @package  		Display_DProductFeatures
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */ 
class Display_DProductFeatures
{

	/**
	 * Function  to find the    category id
	 * @param integer $productid
	 * @return string
	 */	
	function findCategoryid($productid)
	{
		$sql='select category_id from products_table where product_id='.$productid;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records[0]['category_id'];
		return $val;
	}
	/**
	 * Function  to display   the   product features
	 * @param array $dropdownattribname
	 * @param array $dropdownattribvalues
	 * @param array $res
	 * @param array $result	 	 
	 * @return string
	 */	
	function dispProductFeatures($dropdownattribname,$dropdownattribvalues,$res,$result)
	{
	
	  
	   $title= $res[1];
	   $productid=$res[0];
	   
	   if(count($dropdownattribname)>0)
	   {
	       $dropname="<input type='hidden' name='selection' value='attrib' /><select name='selattribname' onchange='document.frmattrib.selection.value=\"attrib\"; document.frmattrib.submit(); ' '><option value=''>Select</option>";
$mmcat=$_POST['selattribname'];
		   foreach($dropdownattribname as $row)
		   {
		       $attrib_id=$row['attrib_id'];
			   $attrib_name=$row['attrib_name'];
			   $dropname.=($mmcat==$attrib_id)?"<option value='$attrib_id' selected='selected'>$attrib_name</option>":"<option value='$attrib_id'>$attrib_name</option>";
		      // $dropname.="<option value=".$attrib_id.">".$attrib_name."</option>";
		   }
		   $dropname.='</select>';
		//   echo $dropname;exit;
	   }
	  /* else
	   {
	      $dropname="No Attribute Found for this Product";
	   }
	   */
	   if(count($dropdownattribvalues)>0)
	   {
	       $dropvalue="<select name='selattrib_value_id'><option value=''>Select</option>";
		   foreach($dropdownattribvalues as $row)
		   {
		       $valueid=$row['attrib_value_id'];
			   $attrib_value=$row['attrib_value'];
		       $dropvalue.="<option value=".$valueid.">".$attrib_value."</option>";
		   }
		   $dropvalue.='</select>';
	   }
	   /*else
	   {
	     $dropvalue="No Attribute Values Found for this Attribute";
	   }*/
	   
	   

	   $output=" <tr><td colspan='2'>Product Name: ".$title."</td>
          </tr><tr>
            <td align='left'>&nbsp;</td>
          </tr><tr><td><form method='post' name='frmattrib' ><table cellpadding='5' cellspacing='0' border='0' width='100%' class='content_list_bdr'><tr><td  class='content_list_head'>S.No</td><td class='content_list_head'>Attribute Name</td><td class='content_list_head'>Attribute Value</td><td class='content_list_head'>Options</td></tr><tr><td colspan='7' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
	   if(count($result)>0)
	   {
	    $i=1;
	     foreach($result as $r)
		 {
		    $attrib_value_id=$r['product_attrib_value_id'];
			$attribute_name=$r['attrib_name'];
			$attrib_value=$r['attrib_value'];
			$product_id=$r['product_id'];
			if($i%2==0)
			$output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'><td class='content_list_txt2'><input  name='product_id' type='hidden' value='".$product_id."' />".$i."</td><td class='content_list_txt2'>".$attribute_name."</td><td class='content_list_txt2'>".$attrib_value."</td><td class='content_list_txt2'><a href='?do=productfeatures&action=delete&id=".$attrib_value_id."&productid=".$product_id."' onclick='return confirm(\"Do you want to Delete\");'>Delete</a></td></tr>";
			else
			$output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'><td class='content_list_txt1'><input  name='product_id' type='hidden' value='".$product_id."' />".$i."</td><td class='content_list_txt1'>".$attribute_name."</td><td class='content_list_txt1'>".$attrib_value."</td><td class='content_list_txt1'><a href='?do=productfeatures&action=delete&id=".$attrib_value_id."&productid=".$product_id."' onclick='return confirm(\"Do you want to Delete\");'>Delete</a></td></tr>";
			$i++;
		 } 
	}
		  $output.="<tr><td></td><td>".$dropname."</td><td>".$dropvalue."<input type='hidden' value='".$product_id."' name='productid' /></td><td><input type='hidden' name='selection' value='Insert' /><input type='button' value='Insert' 
	onclick='document.frmattrib.selection.value=\"Insert\"; document.frmattrib.action=\"?do=productfeatures&action=insert\"; document.frmattrib.submit(); ' /></td></tr>";
		$output.="</table></form>";
		
	  return $output;
	 }
 	/* function dispProductFeatures($result,$dropdown,$res)
	{
	//print_r($dropdown);exit;
	  //print_r($result);exit;
	// print_r($res);exit;
	  
	   $title= $res[1];
	   $productid=$res[0];

	   $output=" <tr><td colspan='2'>Product Name: ".$result[0]['title']."</td>
          </tr><tr>
            <td align='left'>&nbsp;</td>
          </tr><tr><td><form method='post' action='?do=productfeatures&action=insert'><table cellpadding='5' cellspacing='0' border='0' width='100%' class='content_list_bdr'><tr><td  class='content_list_head'>S.No</td><td class='content_list_head'>Attribute Name</td><td class='content_list_head'>Attribute Value</td><td class='content_list_head'>Options</td></tr><tr><td colspan='7' class='cnt_list_bot_bdr' valign='top'><img src='images/list_bdr.gif' alt='' width='1' height='2' /></td></tr>";
	   if(count($result)>0)
	   {
	   $i=1;
	     foreach($result as $r)
		 {
		    $attrib_value_id=$r['product_attrib_value_id'];
			$attribute_name=$r['attrib_name'];
			$attrib_value=$r['attrib_value'];
			$product_id=$r['product_id'];
			if($i%2==0)
			$output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'><td class='content_list_txt2'><input  name='product_id' type='hidden' value='".$product_id."' />".$i."</td><td class='content_list_txt2'>".$attribute_name."</td><td class='content_list_txt2'>".$attrib_value."</td><td class='content_list_txt2'><a href='?do=productfeatures&action=delete&id=".$attrib_value_id."' onclick='return confirm(\"Do you want to Delete\");'>Delete</a></td></tr>";
			else
			$output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);'><td class='content_list_txt1'><input  name='product_id' type='hidden' value='".$product_id."' />".$i."</td><td class='content_list_txt1'>".$attribute_name."</td><td class='content_list_txt1'>".$attrib_value."</td><td class='content_list_txt1'><a href='?do=productfeatures&action=delete&id=".$attrib_value_id."' onclick='return confirm(\"Do you want to Delete\");'>Delete</a></td></tr>";
			$i++;
		 } 
		 
	   }
	   $output.="<tr><td></td><td></td><td><select name='selattrib_value_id'>";
	    if(count($dropdown)>0)
		{
		    foreach($dropdown as $row)
			{
			   $value_id=$row['attrib_value_id'];
			   $attrib_value=$row['attrib_value'];
			   $output.="<option value='".$value_id."'>".$attrib_value."</option>";			   
			   
			}
			
		}
		$output.="</select><input type='hidden' value='".$productid."' name='productid' /></td><td><input type='submit' value='Insert' name='insert' /></td></tr>";
		$output.="</table></form>";
		return $output;
	}*/
	
}
?>