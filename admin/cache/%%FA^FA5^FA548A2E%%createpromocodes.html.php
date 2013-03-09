<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:04
compiled from createpromocodes.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="js/calendar/calendar-en.js"></script>
<tr>
<td >
<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="8" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="content_title" width="80%">Coupon Codes Management</td>
<td class="content_title" width="30%" align="right"><!--<a href="javascript:history.back()" class="more_page">Back</a>--></td>
</tr>
</table></td>
</tr>
<!-- <tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left" style="padding-top:10px;"><?php echo $this->_tpl_vars['insertmsg']; ?>
<?php echo $this->_tpl_vars['display']; ?>
<?php echo $this->_tpl_vars['displaysearch']; ?>
<br />
<?php echo $this->_tpl_vars['displayusers']; ?>
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