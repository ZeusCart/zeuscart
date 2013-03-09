<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-02 10:14:45
compiled from showsubcategory.html */ ?>
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
<script type="text/javascript">
var xmlHttp;
function showSub(subcatid)
{
window.location = "?do=showsub&action=show&id="+subcatid;
}
</script>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Sub Category List </td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left">
<?php echo $this->_tpl_vars['updatemaincat']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="right"><a href="?do=showmain" class="top_links" >View Main Category</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="?do=managecategory" class="add_link"  >Add Category</a></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr><td>
<table class="content_list_bdr" width="100%" border="0" >
<tr><td>
<?php echo $this->_tpl_vars['showmaincat']; ?>
</td></tr>
</table></td></tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left" ><?php echo $this->_tpl_vars['showsubcat']; ?>
<?php echo $this->_tpl_vars['updatemsg']; ?>
<?php echo $this->_tpl_vars['search']; ?>
<!--<div ><?php echo $this->_tpl_vars['products']; ?>
</div>-->
</td>
</tr>
</table>
<script type="text/javascript" language="javascript">
function  callid(id,pid,sub_child)
{
if(confirm("Are you sure want to Delete?"))
{
window.location = "?do=showsub&action=delete&id="+id+"&pid="+pid+"&subchild="+sub_child;
}
}
function edit(id,mid)
{
//alert(mid);
window.location= "?do=showsub&action=disp&id="+id+"&mid="+mid;
}
</script>
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