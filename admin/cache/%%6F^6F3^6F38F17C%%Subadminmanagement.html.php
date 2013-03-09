<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:49
compiled from Subadminmanagement.html */ ?>
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
<table width="97%" border="0" cellspacing="0" style="padding-left:10px" cellpadding="0">
<tr>
<td align="left" class="content_title">Sub Admin Management</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"></td>
</tr>
<!--<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="left" style="padding-left:10px">
<?php echo $this->_tpl_vars['subadmin']; ?>
<tr><td class='content_list_txt1'></td><td><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['subadminname']; ?>
</font></td><td><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['subadminpassword']; ?>
</font></td><td><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['subadminemail']; ?>
</font></td><td align=center></td></tr>
</td>
</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script>
function insertSubadmin()
{
document.frmadmin.method="post";
document.frmadmin.action="?do=subadminmgt&action=insert";
document.frmadmin.submit();
}
</script>
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