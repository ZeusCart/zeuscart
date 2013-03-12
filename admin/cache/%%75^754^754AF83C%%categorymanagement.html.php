<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-09 09:51:13
compiled from categorymanagement.html */ ?>
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
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
function callContent(value)
{
var url= "?do=managecategory&action=preview&id="+value;
ajax(url,'htmlPreview');
document.getElementById('prev').style.display='block';
}
</script>
<form  name="sam" action="?do=managecategory&action=add" method="post" enctype="multipart/form-data" >
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Add Category</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['insmsg']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left" class="content_form_bdr">
<table cellpadding='8' cellspacing='0' border='0' class='content_list_bdr' width='100%'>
<tr><td  class='content_list_head'>Add Category</td></tr>
<tr><td>
<table width="100%" class="" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="27%" align="left" class="content_form">Category Name :</td>
<td width="66%" class="content_form" ><input type="text" name="categoryname" id="categoryname" value="<?php echo $this->_tpl_vars['val']['category']; ?>
" class="txt_box250" />
<br />
<font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['category']; ?>
</font></td>
</tr>
<tr>
<td align="left" class="content_form">Category Level :</td>
<td class="content_form"><span>
<input type="radio" name="group1" value="1" id="parent" onClick="callParent()"  checked="checked" >
<label for="parent">  Parent</label> &nbsp;&nbsp;
<input type="radio" name="group1" value="0" id="child" onClick="callChild();" />
<label for="child"> Child</label></span>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcat1', 'Category Level', 'Select whether the category use as Main/Sub in ZeuscartV2.3.')" onmouseout="HideHelp('dcat1');">
<div id="dcat1" style="left: 50px; top: 50px;"></div>
<input type="radio" name="group1" value="2" id="parentChild" onClick="callsubChildParent();" />
<label for="child">Sub Child</label></span>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcat2', 'Category Level', 'Select whether the category use as Main/Sub in ZeuscartV2.3.')" onmouseout="HideHelp('dcat2');">
<div id="dcat2" style="left: 50px; top: 50px;"></div></td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="67%" border="0" style="display:none" id='ParentContainer'>
<tr>
<td width="25%" align="left" nowrap="nowrap">Select Parent : </td>
<td width="75%" style="padding-left:110px"><?php echo $this->_tpl_vars['allcat']; ?>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="67%" border="0" style="display:none" id='subParent'>
<tr>
<td width="25%" align="left" nowrap="nowrap">Select Parent : </td>
<td width="75%" style="padding-left:110px"><?php echo $this->_tpl_vars['subcatparent']; ?>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="67%" border="0" style="display:none" id='subChild'>
<tr>
<td width="25%" align="left" nowrap="nowrap">Select Child : </td>
<td width="75%" style="padding-left:115px"><span id="subchildcontent"></span></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form">Category Description :</td>
<td class="content_form"><textarea name="categorydesc"  cols="30" rows="4" class="" id="catdesc" ></textarea>
</td>
</tr>
<tr >
<td align="left" class="content_form" colspan="2" >
<table width="95%" border="0" style="display:block" id='lcontents'>
<tr>
<td align="left" >If any Category Landing Content : </td>
<td align="left"><div style="display:block" id=''>
<table  border="0">
<tr>
<td style="padding-left:8px"></td>
<td align="left"><a href="javascript: callLanding(); " class="conent_u_link" onClick="" id="" >Click Here</a></td>
</tr>
</table></div>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="95%" border="0" style="display:none" id='landingContent'>
<tr>
<td align="left" >Select Landing Content : </td>
<td ><div style="display:" id='contentContainer'>
<table width="100%" border="0">
<tr>
<td></td>
<td style="padding-left:50px"><?php echo $this->_tpl_vars['content']; ?>
</td>
<td width="95%"><a href="?do=contents" name="content" class="add_link" >Add Html Contents</a> </td>
</tr>
</table></div>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="95%" border="0" style="display:none" id='prev'>
<tr>
<td align="left" >Preview : </td>
<td ><div style="" id=''>
<table width="100%" border="0">
<tr>
<td style="padding-left:135px"> <span id='htmlPreview'></span></td>
</tr>
</table></div>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2" >
<table width="67%" border="0" style="display:block" id='ImageContainer'>
<tr>
<td width="25%" align="left" nowrap="nowrap">Categroy Image : </td>
<td width="75%" style="padding-left:80px"><input type="file" name="caticon" id="caticon" /></td>
</tr>
</table>
</td>
<!-- <td align="left" class="content_form">Categroy Image :</td>
<td class="content_form"><input type="file" name="caticon" id="caticon" />
</td>-->
</tr>
<tr>
<td align="left"  colspan="2" ><table width="100%" border="0" class="content_form" style="display:none" id='attribContainer'>
<tr>
<td colspan="2" align="left"> Sub category Special Attributes: </td>
</tr>
<tr>
<td align="left" style="padding-left:188px"><?php echo $this->_tpl_vars['attrib']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" class="content_form">Visibility Status :</td>
<td class="content_form"><span>
<input type="radio" name="status" value="1">
Show &nbsp;&nbsp;
<input type="radio" name="status" value="0"  checked="checked">
Hide</span>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcat2', 'Category', 'Show/Hide a particular category in ZeuscartV2.3.')" onmouseout="HideHelp('dcat2');">
<div id="dcat2" style="left: 50px; top: 50px;"></div></td>
</tr>
<tr>
<td class="content_form">&nbsp;</td>
<td class="content_form"><input type="submit" name="submit" value="Save" class="all_bttn"   />
</td>
</tr>
<!-- <tr>
<td><?php echo $this->_tpl_vars['msg']; ?>
</td>
</tr>-->
</table></td></tr></table></td>
</tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script>
flv=0;
function callLanding()
{
//toggle ('landingContent', 'landingContent');
var cont = document.getElementById("landingContent");
if(flv == 0)
{
$(cont).slideDown(1000);
flv=1;
}
else
{
$(cont).slideUp(1000);
flv=0;
}
}
function callChild()
{
//toggle('ParentContainer', 'ParentContainer');
var contd = document.getElementById("ParentContainer");
$(contd).slideDown(1000);
document.getElementById('attribContainer').style.display='';
document.getElementById('ImageContainer').style.display='';
document.getElementById('subchildcontent').innerHTML='';
document.getElementById('subParent').style.display='none';
document.getElementById('lcontents').style.display='none'
}
function callParent()
{
var conts = document.getElementById("ParentContainer");
$(conts).slideUp(1000);
//document.getElementById('ParentContainer').style.display='none';
document.getElementById('attribContainer').style.display='none';
document.getElementById('ImageContainer').style.display='none';
document.getElementById('subParent').style.display='none';
document.getElementById('subchildcontent').innerHTML='';
document.getElementById('lcontents').style.display='block'
}
function callsubChildParent()
{
var contd = document.getElementById("subParent");
$(contd).slideDown(1000);
document.getElementById('attribContainer').style.display='';
document.getElementById('ImageContainer').style.display='';
document.getElementById('lcontents').style.display='none';
document.getElementById('ParentContainer').style.display='none';
}
function callsubChild(parentid)
{
document.getElementById('subchildcontent').innerHTML='';
var contd = document.getElementById("subChild");
$(contd).slideDown(1000);
$.ajax({
type: "GET",
url: "?do=managecategory&action=selectsubchild",
data: "parentid="+parentid,
success: function(result){
document.getElementById('ParentContainer').style.display='none';
document.getElementById('subchildcontent').innerHTML=result;
document.getElementById('subchildcontent').style.display='block';
}
});
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