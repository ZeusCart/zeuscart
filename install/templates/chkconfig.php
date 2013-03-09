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
<div class="scroll_txt">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" class="title">Check for Prerequisite</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="53%" align="left" class="text pad"><strong>PHP Settings</strong></td>
                <td width="4%" align="left" class="text">&nbsp;</td>
                <td width="43%" align="left" class="text">&nbsp;</td>
              </tr>
             
              <tr>
                <td align="left" class="text pad">PHP Version 5.2.0 or later [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['php'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">register_globals [optional]</td>
                <td align="left" class="text">:</td>
                <td align="left" class=""><?php echo $this->config['regglobals'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">GD Library Intallation [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['gd'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">CURL [required]</td>
                <td align="left" class="text">:</td>
                <td align="left"><?php echo $this->config['curl'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">Simple XML [required]</td>
                <td align="left" class="text">:</td>
                <td align="left"><?php echo $this->config['sxml'] ?></td>
              </tr>
              
              
              <tr>
                <td align="left" class="text pad"><strong>Data Base</strong></td>
                <td align="left" class="text">&nbsp;</td>
                <td align="left" class="text">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="text pad">MySQL [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['mysql'] ?></td>
              </tr>
              
              <tr>
                <td align="left" class="text pad"><strong>Write Permission</strong></td>
                <td align="left" class="text">&nbsp;</td>
                <td align="left" class="installed">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\images [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit1'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\images\banners [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit2'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\images\logo [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit3'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\images\products [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit4'] ?></td>
              </tr>
               <tr>
                <td align="left" class="text pad">root\images\products\thumb [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit5'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\Bin [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit6'] ?></td>
              </tr>
	 	<tr>
                <td align="left" class="text pad">root\Bin\Configuration.php [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit7'] ?></td>
              </tr>	
              <tr>
                <td align="left" class="text pad">root\Built [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit8'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\cache [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit9'] ?></td>
              </tr>
               <tr>
                <td align="left" class="text pad">root\uploadedimages [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit10'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\userpage [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit11'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\upload_bulk_products [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit12'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\admin\cache [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit13'] ?></td>
              </tr>
               <tr>
                <td align="left" class="text pad">root\admin\uploadedtsvfile [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit14'] ?></td>
              </tr>
              <tr>
                <td align="left" class="text pad">root\admin\uploadedbulkimages [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit15'] ?></td>
              </tr>
               <tr>
                <td align="left" class="text pad">root\includes\Charts [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit16'] ?></td>
              </tr>
               <tr>
                <td align="left" class="text pad">root\includes [required]</td>
                <td align="left" class="text">:</td>
                <td align="left" ><?php echo $this->config['filepermit17'] ?></td>
              </tr>
            </table>
		</td>
          </tr>
        </table></div>