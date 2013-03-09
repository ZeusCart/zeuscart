<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 15:35:46
compiled from DisplayOrderManagement.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left"><?php echo $this->_tpl_vars['detailorder']; ?>
</td>
</tr>
<tr>
<td align="left" class="content_title">Products Ordered</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['productorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="content_title">Delivery Details</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['transdetails']; ?>
</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['editorderlist']; ?>
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