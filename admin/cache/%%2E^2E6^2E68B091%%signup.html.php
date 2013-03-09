<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:59
compiled from signup.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<TABLE WIDTH="97%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
<TR>
<TD VALIGN="top">
<form name="reg" method="post" action="?do=addUserAccount&action=addreg">
<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
<tr>
<td colspan="5" align="left" class="content_title">Customer Account</td>
</tr>
<TR>
<TD><?php echo $this->_tpl_vars['account']; ?>
</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
</TR>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Create Customer</td>
</tr>
<TR>
<TD ALIGN="left" class="content_form_bdr" style="padding-left:5px">
<TABLE WIDTH="80%" BORDER="0" CELLSPACING="0" CELLPADDING="0" CLASS="checkout_rigistration">
<tr><td align="right" colspan="3"><font color="red" size="-1"> * Required Fields</font></td></tr>
<TR>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD WIDTH="20%" class="content_form">Display Name <font color="red">*</font></TD>
<TD WIDTH="6%" class="content_form">:</TD>
<TD WIDTH="56%" class=""><input name="txtdisname" type="text" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtdisname']; ?>
" /><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtdisname']; ?>
</font></TD>
</TR>
<TR>
<TD class="content_form">First Name <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD class=""><input name="txtfname" type="text" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtfname']; ?>
"/><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtfname']; ?>
</font> </TD>
</TR>
<TR>
<TD class="content_form">Last Name <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD class=""><input name="txtlname" type="text" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtlname']; ?>
"/> <br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtlname']; ?>
</font></TD>
</TR>
<TR>
<TD class="content_form">Email Address <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD class=""><input name="txtemail" type="text" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtemail']; ?>
"/> <br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtemail']; ?>
</font></TD>
</TR>
<TR>
<TD class="content_form">Password <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD class=""><input name="txtpwd" type="password" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtpwd']; ?>
"/><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtpwd']; ?>
</font></TD>
</TR>
<TR>
<TD class="content_form">Confirm Password <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD class="" ><input name="txtrepwd" type="password" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtrepwd']; ?>
"/>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dpwd2', 'Confirm Password', 'Enter password once again for confirmation.')" onmouseout="HideHelp('dpwd2');">
<div id="dpwd2" style="position:fixed" ></div><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtrepwd']; ?>
</font></TD>
</TR>
<TR>
<TD class="content_form">Address <font color="red">*</font></TD>
<TD class="content_form">:</TD>
<TD><input name="txtaddr" type="text" class="txt_box250" value="<?php echo $this->_tpl_vars['val']['txtaddr']; ?>
"/><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtaddr']; ?>
</font></TD>
</TR>
<tr>
<td class="content_form">City <font color="red">*</font></td>
<td class="content_form">:</td>
<td><input name="txtcity" type="text" class="txt_box250" id="textfield8" value="<?php echo $this->_tpl_vars['val']['txtcity']; ?>
" /><br /><font color="#FF0000" size="-2">
<?php echo $this->_tpl_vars['msg']['txtcity']; ?>
</font></td>
</tr>
<tr>
<td class="content_form">State/Province <font color="red">*</font></td>
<td class="content_form">:</td>
<td><input name="txtState" type="text" class="txt_box250" id="textfield8" value="<?php echo $this->_tpl_vars['val']['txtState']; ?>
"/><br><font color="#FF0000" size="-2"><?php echo $this->_tpl_vars['msg']['txtState']; ?>
</font>
</td>
</tr>
<tr>
<td class="content_form">Zip/Postal Code <font color="red">*</font></td>
<td class="content_form">:</td>
<td><input name="txtzipcode" type="text" class="txt_box250" id="textfield82" value="<?php echo $this->_tpl_vars['val']['txtzipcode']; ?>
" /><br><font color="#FF0000" size="-2"><?php echo $this->_tpl_vars['msg']['txtzipcode']; ?>
</font></td>
</tr>
<tr>
<td class="content_form">Country <font color="red">*</font></td>
<td class="content_form">:</td>
<td><?php echo $this->_tpl_vars['val']['selCountry']; ?>
<!--<br><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['txtState']; ?>
</font>--></td>
</tr>
<!--<TR><TD class="label_name">&nbsp;</TD><TD class="label_name"><input type="checkbox" name="chknewsletter" value="1" /></TD>
<TD class="label_name">Subscribe newsletter</TD></TR>-->
<TR>
<TD COLSPAN="3" STYLE="padding-top:10px;" class="label_name">&nbsp;</TD>
</TR>
<TR>
<TD ALIGN="center" colspan="3">
<INPUT TYPE="submit" NAME="Submit2" VALUE="Create Account" class="all_bttn"/></TD>
</TD>
</TR>
</TABLE></TD>
</TR></table></td></tr>
</TABLE>
</form>
</TD>
</TR>
</TABLE>
<!--Body Part Ends-->
<!--Footer-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php 
   $op=explode("\n", ob_get_contents());
   ob_clean();
    foreach($op as $p)		
	{
		if(trim($p)!="")
			echo trim($p)."\n"; 
		ob_flush();
	}
?>