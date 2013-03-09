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
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" class="title">Store Setting</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          
         
               <tr>
                <td width="41%" align="left" class="text pad"><strong>Currency Settings</strong></td>
                <td width="9%" align="left" class="text">&nbsp;</td>
                <td width="50%" align="left" class="text">&nbsp;</td>
              </tr>
               
              <tr>
                <td align="left" class="text pad">Currency Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="currname" type="text" class="textbox" id="currname" value="<?php echo $Err->values['currname']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currname'] ?></span></td>
              </tr>
              <tr>
                <td align="left" class="text pad">Currency Token</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="currtoken" type="text" class="textbox" id="currtoken" value="<?php echo $Err->values['currtoken']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currtoken'] ?></span></td>
              </tr>
               <tr>
                <td align="left" class="text pad">Currency Code</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><?php echo $selcurrencycode; ?> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currcode'] ?></span></td>
              </tr>
               <tr>
                <td align="left" class="text pad">Rate Against US Dollar</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="currval" type="text" class="textbox" id="currval" value="1"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currval'] ?></span></td>
              </tr>
               <tr>
                <td align="left" class="text pad">Currency Country</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><?php echo $selcountrycode; ?>

				</td>
              </tr>
              
            </table></td>
          </tr>
        </table>