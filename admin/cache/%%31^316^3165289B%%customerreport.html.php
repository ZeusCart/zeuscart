<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:15:09
compiled from customerreport.html */ ?>
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
<td colspan="5" align="left" class="content_title">Export Customer</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr><td>
<table cellpadding='8' cellspacing='0' border='0'  class='content_list_bdr' width='100%'>
<tr><td  class='content_list_head' align="left">Export Customer</td></tr>
<tr><td align="left">
<form name="export" method="post" action="?do=excelreport">
<table border="0" cellpadding='5' cellspacing='0'>
<tr><td align="left" class="content_form" nowrap="nowrap" colspan="2"><b>Select Format</b></td></tr>
<tr><td align="left" class="content_form" colspan="2">Note: You can Export customers to the following format on your computer.</td></tr>
<tr><td align="left" class="content_form" colspan="2" style="padding-left:50px"><input type="radio" value="excel" id="excel" name="export" checked="checked">
<label for="excel">Excel</lable></input></td></tr>
<tr><td align="left" class="content_form" colspan="2" style="padding-left:50px">
<input type="radio" value="xml" id="xml" name="export"><label for="xml"> XML</lable></input></td></tr>
<tr><td align="left" class="content_form" colspan="2" style="padding-left:50px">
<input type="radio" value="csv" id="csv" name="export"><label for="csv"> CSV</lable></input></td></tr>
<tr><td align="left" class="content_form" colspan="2" style="padding-left:50px">
<input type="radio" value="tab" id="tab" name="export"><label for="tab"> TAB</lable></input></td></tr>
<tr><td colspan="2" style="padding-left:50px"><input type="submit" name="btnreport" value="Export" class="all_bttn"></td></tr>
<tr>
<td colspan="2" align="left">&nbsp;</td>
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