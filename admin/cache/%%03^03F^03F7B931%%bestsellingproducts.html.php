<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:12:01
compiled from bestsellingproducts.html */ ?>
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
<form name="frmcontent" method="post" action="" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Best Selling Products <!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dbsp', 'Best Selling Products', 'Add here')" onmouseout="HideHelp('dbsp');">
<div id="dbsp" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td align="left" style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['showcontent']; ?>
</td>
</tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
</body></html>
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