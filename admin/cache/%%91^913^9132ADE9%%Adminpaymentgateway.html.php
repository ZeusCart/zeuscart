<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:16:11
compiled from Adminpaymentgateway.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="js/helps.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Payment Gateways Management<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dpay', 'Payment Gateway:', 'List of payment gateways are use in ZeuscartV2.3. Select What you want?')" onmouseout="HideHelp('dpay');">
<div id="dpay" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['updatepaymentmessage']; ?>
</td>
</tr>
<tr>
<td align="left" >&nbsp;</td>
</tr>
<tr>
<td align="left"> <?php echo $this->_tpl_vars['adminpaymentgateways']; ?>
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