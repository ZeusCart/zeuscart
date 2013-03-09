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
            <td align="left" class="title">Admin Configuration</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="41%" align="left" class="text pad"><strong>Admin Information</strong></td>
                <td width="9%" align="left" class="text">&nbsp;</td>
                <td width="50%" align="left" class="text">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="text pad">Domain Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="domain" type="text" class="textbox" id="domain" value="<?php echo $Err->values['domain']  ?>"/>
                 <span style="color:#FF0000"> <?php echo $Err->messages['domain'] ?></span></td>
              </tr>
              <tr>
                <td align="left" class="text pad">Admin E-mail</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="email" type="text" class="textbox" id="email" value="<?php echo $Err->values['email']  ?>"/>
               <span style="color:#FF0000"> <?php echo $Err->messages['email'] ?></span> </td>
              </tr>
              <tr>
                <td align="left" class="text pad">Admin User Name</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="uname" type="text" class="textbox" id="uname" value="<?php echo $Err->values['uname']  ?>"/> 
			<span style="color:#FF0000"> <?php echo $Err->messages['uname'] ?></span></td>
              </tr>
              <tr>
                <td align="left" class="text pad">Admin Password</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="pass" type="password" class="textbox" id="pass" value="<?php echo $Err->values['pass']  ?>"/>
                 <span style="color:#FF0000"> <?php echo $Err->messages['pass'] ?></span></td>
              </tr>
              <tr>
                <td align="left" class="text pad">Confirm Admin Password</td>
                <td align="center" class="text">:</td>
                <td align="left" class="text"><input name="cpass" type="password" class="textbox" id="cpass" value="<?php echo $Err->values['cpass']  ?>"/>
               <span style="color:#FF0000"> <?php echo $Err->messages['cpass'] ?></span> </td>
              </tr>
              
              
            </table></td>
          </tr>
        </table>