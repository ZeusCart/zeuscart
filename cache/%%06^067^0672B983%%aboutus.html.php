<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 15:22:15
compiled from aboutus.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<div id="body_container">
<div id="main">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<div id="detail">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="roundbox_top" ></td>
</tr>
<tr>
<td valign="top" class="detailBG">
<?php echo $this->_tpl_vars['aboutus']; ?>
</td>
</tr>
<tr>
<td class="roundbox_bottom" ></td>
</tr>
</table>
</div>
</div>
<div id="curve">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top" class="round_left" ><!--<img src="images/curve_L.gif" alt="" width="8" height="9" />--></td>
<td></td>
<td align="right" valign="top" class="round_right" ><!--<img src="images/curve_R.gif" alt="" width="7" height="9" />--></td>
</tr>
</table>
</div>
</div>
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