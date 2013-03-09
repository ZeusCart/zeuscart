<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:16:43
compiled from custompages.html */ ?>
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
<form name="frm" action="?do=createpage&action=update" method="post" >
<table width="97%" border="0" cellspacing="0" cellpadding="0"><tr>
<td class="content_title" align="left">
Custom Pages<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dchead', 'Custom Pages', 'Add here')" onmouseout="HideHelp('dchead');">
<div id="dchead" style="left: 50px; top: 50px;"></div>-->
</td>
</tr>
<tr >
<td align="left" style="padding-top:10px; padding-bottom:10px;"><?php echo $this->_tpl_vars['createpagemsg']; ?>
<?php echo $this->_tpl_vars['deletepage']; ?>
</td>
</tr>
<tr ><td colspan="2"  align="right" class="" style="padding-top:10px; padding-bottom:10px;"> <a href="?do=createpage&action=createnewpage" name="create page" class="add_link"> Create Page</a> </td></tr>
<tr><td>
</td></tr>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
<tr><td class="label_name" colspan="2">
</td></tr><tr><td> <?php echo $this->_tpl_vars['showpage']; ?>
</td></tr>
</table>
</td>
</tr>
</table>
</form>
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