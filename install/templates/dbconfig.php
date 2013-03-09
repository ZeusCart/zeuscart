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
            <td align="left" class="title">Database Configuration</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="41%" align="left" class="text pad"><strong>Database Information</strong></td>
                <td width="9%" align="left" class="text">&nbsp;</td>
                <td width="50%" align="left" class="text">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="text pad" valign="top">Database Server Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text" valign="middle"><input name="host" id="host" type="text" class="textbox" value="<?php echo $Err->values['host'] ?>" />
                <span style="color:#FF0000"> <?php echo $Err->messages['host'] ?></span></td>
              </tr>
              <tr>
                <td align="left" class="text pad" valign="top">Database Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text" valign="middle"><input name="dbname" type="text" class="textbox" id="dbname" value="<?php echo $Err->values['dbname'] ?>"/>
                 <span style="color:#FF0000"> <?php echo $Err->messages['dbname'] ?></span>  </td>
              </tr>
              <tr>
                <td align="left" class="text pad" valign="top">Database User Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text" valign="middle"><input name="uname" id="uname" type="text" class="textbox" value="<?php echo $Err->values['uname'] ?>"/>
                 <span style="color:#FF0000"> <?php echo $Err->messages['uname'] ?></span>   </td>
              </tr>
              <tr>
                <td align="left" class="text pad" valign="top">Database Password</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text" valign="middle"><input name="pass" type="password" class="textbox" id="password" value="<?php echo $Err->values['pass'] ?>" />
                <span style="color:#FF0000"> <?php echo $Err->messages['pass'] ?></span>   </td>
              </tr>
            </table></td>
          </tr>
        </table>