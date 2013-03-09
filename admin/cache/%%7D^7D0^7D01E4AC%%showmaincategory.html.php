<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:12:34
compiled from showmaincategory.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Main Category List<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcat', 'Category :', '&nbsp;&nbsp;List of categories in ZeuscartV2.3.')" onmouseout="HideHelp('dcat');">
<div id="dcat" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['updatemiancatmsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="right" colspan="2"><a  href="?do=managecategory" class="add_link" >Add Category</a></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td><?php echo $this->_tpl_vars['showmaincat']; ?>
<?php echo $this->_tpl_vars['search']; ?>
<!--<script language="javascript">
function change(val)
{
if(val=="Enter keyword")
{
document.search1.catname.value="";
document.search1.catdesc.value="";
}
}
</script>-->
</td>
</tr>
</table>
</td>
</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript">
var options = {
script:"?do=showmain&action=autoc&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('catname', options);
var options_xml = {
script: function (input) { return "?do=showmain&action=autoc&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('catname_xml', options_xml);
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