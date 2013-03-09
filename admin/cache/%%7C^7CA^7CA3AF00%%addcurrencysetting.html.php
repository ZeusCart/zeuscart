<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-04 16:23:47
compiled from addcurrencysetting.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<tr>
<td>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Currency Settings<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dtax', 'Tax Setting', 'Add here')" onmouseout="HideHelp('dtax');">
<div id="dtax" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="center">
<!-------------------tax----------------------->
<!--	<form  name="sam" action="" method="post">-->
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<!--<<tr>
<td align="left">&nbsp;</td>
</tr>
tr>
<td align="left"></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="center" class="content_form_bdr">
<table cellpadding='8' cellspacing='0' border='0' class='content_list_bdr' width='100%'>
<tr><td  class='content_list_head' align="left">Currency Settings</td></tr>
<tr><td><?php echo $this->_tpl_vars['insmsg']; ?>
<?php echo $this->_tpl_vars['currencysettings']; ?>
</td></tr></table></td>
</tr>
</table>
<!--</form>-->
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