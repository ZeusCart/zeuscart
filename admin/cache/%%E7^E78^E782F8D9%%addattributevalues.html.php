<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:16:50
compiled from addattributevalues.html */ ?>
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
<form name="formattribval" action="?do=addattributevalues&action=add"  method="post" >
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="5" align="left" class="content_title">Attribute Values</td>
</tr>
<tr>
<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="left"><?php echo $this->_tpl_vars['msg']; ?>
</td>
</tr>
<tr>
<td colspan="2" align="right"><a href="?do=addattributes" class="add_link" >Add Attribute</a></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr><td>
<table class="content_list_bdr" width="100%" border="0" >
<tr>
<td class="content_form" width="24%" align="left" nowrap="nowrap" colspan="3">Add Attribute Values:</td>
<td width="21%" align="left">
<?php echo $this->_tpl_vars['allatt']; ?>
</td>
<td width="31%" align="center"><input type="text" name="attributevalues" class="txt_box200" id="attrib" value="" /></td>
<td width="50%" align="left"><input type="submit" name="btnsubmit" value="Add" id="submit" class="all_bttn"   />
</td>
</tr>
</table></td></tr>
<tr>
<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="left"><?php echo $this->_tpl_vars['showattributevalues']; ?>
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
function  callattribvalues(id)
{
//alert(id);
if(confirm("Are you sure want to Delete?"))
{
window.location = "?do=addattributevalues&action=delete&id="+id;
}
document.formmaincat.mainindex.value=id;
//document.formsubcat.submit();
}
function edit(id)
{
window.location= "?do=addattributevalues&action=disp&id="+id;
}
</script>
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