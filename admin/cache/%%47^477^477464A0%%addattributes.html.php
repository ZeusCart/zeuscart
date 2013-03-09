<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:14:41
compiled from addattributes.html */ ?>
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
<!--action="?do=catcreate&action=add"-->
<script type="text/javascript">
function selDeSel(a){
//var mark = a == 'sel' ? 'checked' : '';
var inputs = document.getElementsByName('chkattrib[]');
var checkboxes = [];
for (var i = 0; i < inputs.length; i++)
{
if (inputs[i].type == 'checkbox')
{
inputs[i].checked =true;
}
}
}
function selUnDeSel(a){
//var mark = a == 'sel' ? 'checked' : '';
var inputs = document.getElementsByName('chkattrib[]');
var checkboxes = [];
for (var i = 0; i < inputs.length; i++)
{
if (inputs[i].type == 'checkbox')
{
inputs[i].checked =false;
}
}
}
-->
</script>
<form name="formattrib" action="?do=addattributes&action=add"  method="post" >
<table width="97%" border="0" cellspacing="0" cellpadding="">
<tr>
<td colspan="5" align="left" class="content_title">Attributes <!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('datt', 'Attributes', 'Add here')" onmouseout="HideHelp('datt');">
<div id="datt" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td colspan="7" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="left"><?php echo $this->_tpl_vars['attribmsg']; ?>
</td>
</tr>
<tr>
<td height="41" colspan="5" align="right"><a href="?do=addattributevalues" class="add_link" >Add Attribute values</a></td>
</tr>
<tr><td>
<table class="content_list_bdr" width="100%" border="0" >
<tr>
<td width="17%" align="left" class="content_form">Add Attributes:</td>
<td width="26%" align="left">
<input type="text" name="attributes" id="attrib" class="txt_box200" maxlength="25"  value="<?php echo $this->_tpl_vars['val']['attributes']; ?>
"/></td>
<td width="7%" align="center"><input type="submit" name="btnsubmit" value="Add" id="submit" class="all_bttn"  /></td>
<td width="50%" colspan="2">&nbsp;</td>
</tr>
<tr><td></td><td colspan="3"><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['attributes']; ?>
</font></td></tr>
</table></td></tr>
<tr>
<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="5" align="left"><?php echo $this->_tpl_vars['showattributes']; ?>
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
function  callattribs(id)
{
if(confirm("Are you sure want to Delete?"))
{
window.location = "?do=addattributes&action=delete&id="+id;
}
document.formmaincat.mainindex.value=id;
}
function edit(id)
{
window.location= "?do=addattributes&action=disp&id="+id;
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