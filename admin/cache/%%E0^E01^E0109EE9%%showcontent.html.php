<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:12:10
compiled from showcontent.html */ ?>
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
<form name="frmcontent" method="post" action="" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Show Contents<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcont', 'Html Content', 'Add here')" onmouseout="HideHelp('dcont');">
<div id="dcont" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td align="center"><?php echo $this->_tpl_vars['editcontentmsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="right"><a href="?do=contents" class="add_link">Add HTML Content</a></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td align="left" ><?php echo $this->_tpl_vars['showcontent']; ?>
</td>
</tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" language="javascript">
function  callcontent(id)
{
if(confirm("Are you sure want to Delete?"))
{
window.location = "?do=showcontents&action=delete&id="+id;
}
document.formmaincat.mainindex.value=id;
//document.formsubcat.submit();
}
function edit(id)
{
window.location= "?do=showcontents&action=disp&id="+id;
}
</script>
</body></html>
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