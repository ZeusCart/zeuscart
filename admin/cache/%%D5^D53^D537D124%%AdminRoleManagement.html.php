<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 16:23:37
compiled from AdminRoleManagement.html */ ?>
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
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Sub Admin Role Management</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><form method="post" action="?do=subadminrole&action=insert">
<?php echo $this->_tpl_vars['updatemsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
<?php echo $this->_tpl_vars['insertmsg']; ?>
<?php echo $this->_tpl_vars['subadminroles']; ?>
</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
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