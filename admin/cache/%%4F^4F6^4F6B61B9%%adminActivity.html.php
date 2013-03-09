<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:12:03
compiled from adminActivity.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="script/ajax.js"></script>
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<table width="97%" border="0" cellspacing="0" cellpadding="">
<tr>
<td colspan="5" align="left" class="content_title">Admin Activity Report</td>
</tr>
<tr>
<td colspan="3" align="left"><?php echo $this->_tpl_vars['message']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="right" style="padding-top:10px"><a href="#" class="add_link" onclick="if(confirm('Deleting the records will not be available anymore.Are you sure to delete the Admin Activity Records?')) window.location='?do=deleteActivity';">Delete Reports</a></td>
</tr>
<tr>
<td colspan="3" align="left" style="padding-top:5px;"><?php echo $this->_tpl_vars['result']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
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