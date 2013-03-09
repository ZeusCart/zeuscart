<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:13:31
compiled from contentmanagement.html */ ?>
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
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
// General options
mode : "textareas",
theme : "advanced",
plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
// Theme options
//theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
//theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,advhr,|,print,|,ltr,rtl,|",
//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
theme_advanced_buttons4 : "pagebreak",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
// Example content CSS (should be your site CSS)
content_css : "css/content.css",
// Drop lists for link/image/media/template dialogs
template_external_list_url : "lists/template_list.js",
external_link_list_url : "lists/link_list.js",
external_image_list_url : "lists/image_list.js",
media_external_list_url : "lists/media_list.js"
});
</script>
<form name="formcontents" action="?do=contents&action=add"  method="post" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Content Management</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<!--<tr>
<td colspan="3" align="right"><a href="?do=showcontents" class="tier_price" >View Content</a> </td>
</tr>-->
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Content Management</td>
</tr>
<tr>
<td align="center">
<?php echo $this->_tpl_vars['addcontent']; ?>
</td>
</tr>
<!--<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>-->
<tr style="padding-top:5px;">
<td width="" align="left" class="content_form">HTML Content Name:&nbsp;&nbsp;&nbsp;<input type="text" class="txt_box200" name="contentname" id="cat"  />
</td></tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left"  class="content_form">HTML Content:
<textarea name="htmlcontent" id="htmlcontent" cols="80" rows="20"><?php echo $this->_tpl_vars['htmlcontent']; ?>
</textarea>
</td></tr>
<tr>
<td class="" colspan="2" align="center" style="padding:10px;"><input type="submit" name="submit" id="sub" value="Add Content" class="all_bttn"  /></td>
</tr>
</table></td></tr></table>
</form>
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