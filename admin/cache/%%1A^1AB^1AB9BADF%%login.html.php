<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2008-12-30 07:55:22
compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zeuscart Admin Control Panel</title>
<link href="css/admin_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="main_table">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="49%" class="header_bg"><img src="images/logo.gif" alt="Zeuscart Logo" width="200" height="77" /></td>
<td width="51%" align="right" valign="top" class="header_bg">&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td align="center" valign="middle" class="content_part" style="border-top:1px solid #999999; padding-top:30px;">
<table width="35%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="left" valign="top"><img src="images/admin_txt.gif" alt="" width="220" height="30" /></td>
</tr>
<tr>
<td colspan="2" valign="top" style="border-top:3px solid #CCCCCC;">&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="left" valign="top" style="color:#999999; padding-left:12px;">Please Enter Your User Name and Password</td>
</tr>
<tr>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="left" valign="top">
<?php echo $this->_tpl_vars['logoutmsg']; ?>
<?php if ($this->_tpl_vars['msg']['username'] != ''): ?>
<div class="error_msgbox" style="width:85%">
<?php echo $this->_tpl_vars['msg']['username']; ?>
</div>
<?php endif; ?>
</td>
</tr><tr><td colspan="2" align="right" valign="top">&nbsp;</td></tr>
<form name="frmlogin" action="?do=adminlogin&action=validatelogin" method="post" >
<tr>
<td width="35%" align="right" valign="top">User Name:</td>
<td width="65%" align="left" valign="top" style="padding-left:10px;"><input name="username" type="text" class="login_txtbox" id="textfield" value="<?php echo $this->_tpl_vars['val']['username']; ?>
"  /></td>
</tr>
<!--<tr>
<td align="right" valign="top"></td>
<td align="left" valign="top" style="padding-left:10px;"><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['username']; ?>
</font></td>
</tr>-->
<tr>
<td colspan="2" align="right" valign="top">&nbsp;</td>
</tr>
<tr>
<td align="right" valign="top">Password:</td>
<td align="left" valign="top" style="padding-left:10px;"><input name="userpwd" type="password" class="login_txtbox" id="textfield2" value="<?php echo $this->_tpl_vars['val']['userpwd']; ?>
" /></td>
</tr>
<!-- <tr>
<td align="right" valign="top"></td>
<td align="left" valign="top" style="padding-left:10px;"><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['userpwd']; ?>
</font> </td>
</tr>-->
<tr>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td align="left" valign="top" style="padding-left:10px;"><input name="button" type="submit" id="button" value="Login" class="all_bttn" />
&nbsp;&nbsp;&nbsp;<a href="?do=adminlogin&action=showpage" class="forgot_link">Forgot Password?</a></td>
</tr>
<!-- <tr>
<td><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['username']; ?>
</font></td>
<td><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['password']; ?>
</font></td>
</tr>-->
</form>
<tr>
<td colspan="2" valign="top" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
</tr>
<tr>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="2" valign="top">&nbsp;<!--</td>
</tr>
</table></td>
</tr>
<tr>
<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="91%" align="left" class="footer_style">Powered by <a href="http://www.zeuscart.com/" class="footer_link">ZeusCart</a> </td>
<td width="9%" align="left" class="footer_style">Version 2.0</td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>-->
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