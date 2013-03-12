<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-07 16:37:09
compiled from sitelogo.html */ ?>
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
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Site Logo</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><?php echo $this->_tpl_vars['sitelogomsg']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left" class="content_form_bdr">
<form name="site" action="?do=sitelogo&action=update" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="content_list_head" colspan="2">Site Logo</td></tr>
<?php echo $this->_tpl_vars['sitelogo']; ?>
<tr>
<td align="left" class="content_form">Upload Logo</td>
<td class="content_form"><input type="file" name="logo" id="logo" value="<?php echo '<?'; ?>
echo $_POST['logo']; <?php echo '?>'; ?>
"/></td>
</tr>
<tr>
<td colspan="2" class="content_form" align="center"><input type="submit" name="button" id="button" value="Upload Logo" class="all_bttn"  /></td>
</tr>
</table>
</form>
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