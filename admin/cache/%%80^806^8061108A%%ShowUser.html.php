<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:39
compiled from ShowUser.html */ ?>
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
<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left:10px;">
<!--<tr>
<td colspan="3" align="left" >&nbsp;
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr>
<td colspan="3" align="left" class="content_title">Show Customer Details</td>
</tr>
<tr>
<td colspan="3" align="left" >&nbsp;
</td>
</tr>
<tr>
<td colspan="3" align="center" ><?php echo $this->_tpl_vars['adminregmsg']; ?>
<?php echo $this->_tpl_vars['editmsg']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left" >&nbsp;
</td>
</tr>
<tr>
<td colspan="3" align="left" align="center">
<?php echo $this->_tpl_vars['adminreg']; ?>
<?php echo $this->_tpl_vars['searchuser']; ?>
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
script:"?do=adminreg&action=autoc&ids=1&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('displayname', options);
var options_xml = {
script: function (input) { return "?do=adminreg&action=autoc&ids=1&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('displayname_xml', options_xml);
</script>
<script type="text/javascript">
var options = {
script:"?do=adminreg&action=autoc&ids=2&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('firstname', options);
var options_xml = {
script: function (input) { return "?do=adminreg&action=autoc&ids=2&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('firstname_xml', options_xml);
</script>
<script type="text/javascript">
var options = {
script:"?do=adminreg&action=autoc&ids=3&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('lastnname', options);
var options_xml = {
script: function (input) { return "?do=adminreg&action=autoc&ids=3&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('lastnname_xml', options_xml);
</script>
<script type="text/javascript">
var options = {
script:"?do=adminreg&action=autoc&ids=4&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('email', options);
var options_xml = {
script: function (input) { return "?do=adminreg&action=autoc&ids=4&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('email_xml', options_xml);
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