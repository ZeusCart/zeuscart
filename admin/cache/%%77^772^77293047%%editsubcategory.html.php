<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-28 18:24:27
compiled from editsubcategory.html */ ?>
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
<script type="text/javascript" language="javascript">
function callContent(value)
{
//var x= document.getElementById("allcont");
//alert(x.selectedIndex);
//alert('hi');
//alert(dropdownValue);
var url= "?do=managecategory&action=preview&id="+value;
ajax(url,'htmlPreview');
}
</script>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Edit Sub under Sub Category </td>
<td class="content_title" width="137" align="right"><a href="javascript:history.back()" class="more_page" onclick="">Back</a></td>
</tr>
<tr>
<td align="left" colspan="3">&nbsp;</td>
</tr>
<tr>
<td align="left" class="content_form_bdr" colspan="3">
<?php echo $this->_tpl_vars['editsubcat']; ?>
</td>
</tr>
<tr id="landingContent" >
<td align="left" class="content_form" >Select Landing Content : </td>
<td class=""  colspan="4">
<?php echo $this->_tpl_vars['content']; ?>
&nbsp;
<a href="?do=contents" name="content" >Add new Html Contents</a> </td>
<td ></td>
</tr>
<tr>
<td align="left" class="content_form" >Preview :</td>
<td class="content_form" colspan="3" id='htmlPreview'></td>
</tr>
<tr>
<td  align="left" class="content_form" valign="top">Select Attributes:</td>
<td align="left" colspan="3"><?php echo $this->_tpl_vars['attrib']; ?>
</td>
</tr>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td class="">&nbsp;</td>
<td class="">
<input type="submit" name="btnsubmit" class="all_bttn" align="right"  value="Update Sub Category" id="submit"  />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
</table></form>
</td></tr>
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