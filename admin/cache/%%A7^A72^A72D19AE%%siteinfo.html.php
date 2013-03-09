<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 15:19:56
compiled from siteinfo.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  class="content_title" align="left" >Server Information</td>
</tr><tr><td>
<br/><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"  class="">
<tr>
<td><iframe name="f1" src="?do=getphpinfo" width="100%" style="height:485px; border-width:1px;  border-color:#999"></iframe></td>
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