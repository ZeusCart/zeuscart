<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-04 16:23:45
compiled from currencysettings.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<tr>
<td>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">List of Currency</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="center">
<!-------------------tax----------------------->
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<!--<<tr>
<td align="left">&nbsp;</td>
</tr>
tr>
<td align="left"></td>
</tr>-->
<tr>
<td align="left"><?php echo $this->_tpl_vars['insmsg']; ?>
<table cellspacing="0" border="0" width="100%" style="padding-left:780px; padding-bottom:10px; padding-top:5px;">
<tr><td colspan="6" align="right"><a class="add_link" href="?do=showaddcurrency">Add Currency</a></td></tr>
</table>
</td>
</tr>
<tr>
<td align="center" class="content_form_bdr">
<?php echo $this->_tpl_vars['taxsettings']; ?>
</td>
</tr>
</table>
<!-------------------tax----------------------->
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