<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:16:37
compiled from news.html */ ?>
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
<td colspan="3" align="left" class="content_title">News List</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr><td></td>
<td class="" align="right" style="padding-top:10px; padding-left:400px;"><a href="?do=news"  class="add_link" >Create News</a>
<td class="" align="right" style="padding-top:10px;"><a href="#" onclick="deletenews()"  class="del_link" >Delete News</a>
</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left" style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['updatemsg']; ?>
<?php echo $this->_tpl_vars['addnewsmsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
<?php echo $this->_tpl_vars['sendmsg']; ?>
</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left">
<?php echo $this->_tpl_vars['shownews']; ?>
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
function  deletenews()
{
var total=""
for(var i=0; i < document.frmcontent.deletenews.length; i++)
{
if(document.frmcontent.deletenews[i].checked)
total +=total + 1
}
if(total==0)
{
alert("Select Atleast One News to Delete");
}
else
{
if(confirm('Are You Sure Want to Delete'))
{
document.frmcontent.action='?do=news&action=delete';
document.frmcontent.submit();
}
}
}
function view(id)
{
window.location= "?do=news&action=disp&id="+id;
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