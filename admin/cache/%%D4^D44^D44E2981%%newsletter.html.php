<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 15:19:47
compiled from newsletter.html */ ?>
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
<form name="frmcontent" method="post" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Newsletter List</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr><td></td>
<td class="" align="right" style="padding-top:10px;"><a href="?do=newsletter"  class="add_link" >Create Newsletter</a>
</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left" style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['updatemsg']; ?>
<?php echo $this->_tpl_vars['addnewslettersmsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
<?php echo $this->_tpl_vars['sendmsg']; ?>
</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left">
<?php echo $this->_tpl_vars['shownewsletters']; ?>
<!--</div>
<div align="center" style="color:red"><strong><?php echo $this->_tpl_vars['msg']; ?>
</strong>
</div>
</div>
<div align="center" style="color:red"><strong><?php echo $this->_tpl_vars['msg']; ?>
</strong>
</div>-->
</td>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" language="javascript">
function  deletenews(id)
{
if(confirm("Are you sure want to Delete?"))
{
window.location = "?do=newsletter&action=delete&id="+id;
}
document.formmaincat.mainindex.value=id;
}
function view(id)
{
window.location= "?do=newsletter&action=disp&id="+id;
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