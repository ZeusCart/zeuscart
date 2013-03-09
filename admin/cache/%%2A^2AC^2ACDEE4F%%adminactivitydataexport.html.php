<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 16:22:07
compiled from adminactivitydataexport.html */ ?>
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
<table width="97%" border="0" cellspacing="0" cellpadding="">
<tr>
<td colspan="5" align="left" class="content_title">Export Admin Activity</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr><td>
<table cellpadding='8' cellspacing='0' border='0'  class='content_list_bdr' width='100%'>
<tr><td  class='content_list_head'>Export Admin Activity</td></tr>
<tr><td>
<form name="export" method="post" action="?do=admactexp&action=export">
<table border="0">
<tr><td align="left" class="content_form" nowrap="nowrap"><b>Select Format</b></td></tr>
<tr><td align="left" class="content_form" colspan="2">Note: You can Export Admin Activity for the following format on your computer.</td></tr>
<tr><td width="10px"></td><td align="left" class="content_form"><input type="radio" value="excel" id="excel" name="export" checked="checked">
<label for="excel">Excel</lable></input></td></tr>
<tr><td></td><td align="left" class="content_form">
<input type="radio" value="xml" id="xml" name="export"><label for="xml"> XML</lable></input></td></tr>
<tr><td></td><td align="left" class="content_form">
<input type="radio" value="csv" id="csv" name="export"><label for="csv"> CSV</lable></input></td></tr>
<tr><td></td><td align="left" class="content_form">
<input type="radio" value="tab" id="tab" name="export"><label for="tab"> TAB</lable></input></td></tr>
<tr><td></td><td><input type="submit" name="btnreport" value="Export" class="all_bttn"></td></tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
</table></form></td></tr>
</table></td></tr>
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