<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-09 10:42:20
compiled from editproduct.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="js/calendar/calendar-en.js"></script>
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
<script type="text/javascript" language="javascript">
function showProducts(subcatid)
{
if(subcatid!='')
{
var url ="?do=productreg&action=showproducts&name=" + subcatid;
ajax(url, 'productlist');
}
}
function showSubCat(id)
{
if(id!='')
{
var url='?do=productentry&action=displaySubCategory&id='+ id;
ajax(url,'subcats');
}
}
function assignSubCat(id)
{
if(id!='')
{
document.getElementById('subcat').value=id;
var url='?do=productentry&action=displayAttributes&id='+ id;
ajax(url,'attributes');
var url1='?do=productentry&action=displaySubUnderCategory&id='+ id;
ajax(url1,'subcatsunder');
}
}
/*Validation*/
</script>
<script language="javascript">
function addEvent()
{
var ni = document.getElementById('myDiv');
var numi = document.getElementById('theValue');
var num = (document.getElementById("theValue").value -1)+ 2;
if(num < 5)
{
numi.value = num;
var divIdName = "my"+num+"Div";
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
//alert(num);
newdiv.innerHTML = "<table border='0' cellspacing='3' cellpadding='3' width='100%'><tr><td width='31%'>Sub Product Image</td><td><input type=file name=ufile[] id=ufile[]>&nbsp;&nbsp;&nbsp;<a href=\"javascript:;\" onclick=\"removeEvent(\'"+divIdName+"\')\">Remove</a><br></td></tr></table>";
ni.appendChild(newdiv);
}
}
function cseshow()
{
if(document.getElementById('cse_enabled').checked==true)
document.getElementById('divcsekey').style.display = 'block';
else if(document.getElementById('cse_enabled').checked==false)
document.getElementById('divcsekey').style.display = 'none';
}
function removeEvent(divNum)
{
var d = document.getElementById('myDiv');
var olddiv = document.getElementById(divNum);
var num=(document.getElementById("theValue").value -1);
document.getElementById("theValue").value=num;
d.removeChild(olddiv);
}
function clk(id,source,no)
{
document.getElementById('tabs_det').innerHTML=no;
document.getElementById('Image51').src='images/tab_images/category.jpg';
document.getElementById('Image52').src='images/tab_images/general.jpg';
document.getElementById('Image54').src='images/tab_images/images.jpg';
document.getElementById('Image55').src='images/tab_images/attributes.jpg';
document.getElementById('Image56').src='images/tab_images/price.jpg';
document.getElementById('Image57').src='images/tab_images/inventory.jpg';
//document.getElementById('Image58').src='images/tab_images/May_tab1_08.jpg';
//document.getElementById('Image59').src='images/tab_images/May_tab1_09.jpg';
document.getElementById('Image60').src='images/tab_images/meta.jpg';
document.getElementById('Image61').src='images/tab_images/related.jpg';
document.getElementById(id).src=source;
for(i=4;i<=13;i++)
{
tg='tab'+i;
if(i==no)
document.getElementById(tg).style.display='block';
else
document.getElementById(tg).style.display='none';
}
}
function searchProducts(view)
{
var title=document.getElementById('title1').value;
var brand=document.getElementById('brand1').value;
var frommsrp=document.getElementById('frommsrp1').value;
var tomsrp=document.getElementById('tomsrp1').value;
var fromprice=document.getElementById('fromprice1').value;
var toprice=document.getElementById('toprice1').value;
/*	alert(title);
alert(brand);
alert(frommsrp);
alert(tomsrp);
alert(fromprice);
alert(toprice);
*/
var url ="?do=productentry&action=search&title="+title+"&brand="+brand+"&frommsrp="+frommsrp+"&tomsrp="+tomsrp+"&fromprice="+fromprice+"&toprice="+toprice+"&view="+view;
ajax(url, 'search');
}
function chkall()
{
len=document.productupdate.chkSub.length;
//alert(len);
if(len > 1)
{
for(i=0;i<len;i++)
{
if(document.productupdate.chkMain.checked==true)
{
document.productupdate.chkSub[i].checked=true;
}
else
{
document.productupdate.chkSub[i].checked=false;
}
}
}
else
{
if(document.productupdate.chkMain.checked==true)
{
document.productupdate.chkSub.checked=true;
}
else
{
document.productupdate.chkSub.checked=false;
}
}
}
/*function addTier()
{
var ni = document.getElementById('myTier');
var numi = document.getElementById('msrp1');
var num = (document.getElementById("msrp1").value -1)+ 2;
if(num < 5)
{
numi.value = num;
var divIdName = "my"+num+"Tier";
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
//alert(num);
newdiv.innerHTML = "<table border='0' width='100%'><tr><td width='42%'><INPUT NAME='quantity[]' ID='quantity[]'  type='text'  size='3' />&nbsp;	and above</td><td width='31%'><INPUT NAME='msrp[]' ID='msrp[0]'  type='text'  size='5' />&nbsp;<b>[USD]</b></td><td >&nbsp;<a href=\"javascript:;\" onclick=\"removeTier(\'"+divIdName+"\')\">Remove</a></td></tr><table>";
ni.appendChild(newdiv);
}
}
function removeTier(divNum)
{
var d = document.getElementById('myTier');
var olddiv = document.getElementById(divNum);
var num=(document.getElementById("msrp1").value -1);
document.getElementById("msrp1").value=num;
d.removeChild(olddiv);
}*/
function addTier(cursym)
{
var ni = document.getElementById('myTier');
var numi = document.getElementById('msrp1');
var num = (document.getElementById("msrp1").value -1)+ 2;
if(num < 5)
{
numi.value = num;
var divIdName = "my"+num+"Tier";
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
//alert(num);
newdiv.innerHTML = "<table border='0' width='100%'><tr><td width='42%'><INPUT NAME='quantity[]' ID='quantity[]'  type='text'  size='3' onblur=\"if (this.value!='') if (parseFloat(this.value)<=1) {  alert('Enter Quantity Greater Than 1');this.focus(); this.value=''; } \"/>&nbsp;	and above</td><td width='31%'><INPUT NAME='msrp[]' ID='msrp[0]'  type='text'  size='5' onblur=\"if (this.value!='') {if ((parseFloat(document.productreg.msrp_org.value) < parseFloat(this.value))||(parseFloat(this.value)<parseFloat(document.productreg.price.value))) {  alert('Tier Price Should Be Greater Then The Product Price And Less Than Product MSRP ');this.focus(); this.value=''; } }\" />&nbsp;<b>["+cursym+"]</b></td><td >&nbsp;<a href=\"javascript:;\" onclick=\"removeTier(\'"+divIdName+"\')\">Remove</a></td></tr><table>";
ni.appendChild(newdiv);
}
}
function removeTier(divNum)
{
var d = document.getElementById('myTier');
var olddiv = document.getElementById(divNum);
var num=(document.getElementById("msrp1").value -1);
document.getElementById("msrp1").value=num;
d.removeChild(olddiv);
}
function checkInputs()
{
if ((document.getElementById('selcatgory').value=='') || (document.productupdate.selsubcatgory.value==''))
{
alert("Please enter the mandatory fields In Category");
clk('Image51','images/tab_images/category_1.jpg',4);
return false;
}
else
{
if ((document.productupdate.product_title.value=='') || (document.productupdate.sku.value=='')||(document.productupdate.cse_enabled.checked==true&&document.productupdate.csekeyid.value==''))
{
alert('Please enter the mandatory fields In General');
clk('Image52','images/tab_images/general_1.jpg',5);
return false;
}
else
{
flg=0;
for(i=1;i<=5;i++)
{
if(parseFloat(document.getElementById('msrp['+i+']').value)>0)
{
if ((parseFloat(document.productupdate.msrp_org.value) < parseFloat(document.getElementById('msrp['+i+']').value))||(parseFloat(document.getElementById('msrp['+i+']').value)<parseFloat(document.productupdate.price.value)))
{
flg=1;
}
}
}
if(flg==1)
{
alert('Tier Price Should Be Greater Then The Product Price And Less Than Product MSRP ');
return false;
}
else
{
if ((document.productupdate.price.value=='')|| (document.productupdate.msrp_org.value==''))
{
alert('Please enter the mandatory fields In Price');
clk('Image56','images/tab_images/price_1.jpg',8);
return false;
}
else if ( isNaN(document.productupdate.price.value)|| isNaN(document.productupdate.msrp_org.value)|| isNaN(document.productupdate.shipcost.value))
{
alert('Invalid Inputs In Price');
clk('Image56','images/tab_images/price_1.jpg',8);
return false;
}
}
}
}
if (parseFloat(document.productupdate.msrp_org.value)<parseFloat(document.productupdate.price.value))
{
alert('Product MSRP Should Be Greater Than Product Price');
clk('Image56','images/tab_images/price_1.jpg',8);
return false;
}
if ( isNaN(document.productupdate.rol.value)|| isNaN(document.productupdate.soh.value))
{
alert('Invalid Inputs In Inventory');
clk('Image57','images/tab_images/inventory_1.jpg',9);
return false;
}
return true;
}
</script>
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<tr><td>
<form name="productupdate" action="?do=manageproducts&action=updateprod&prodid=<?php echo $this->_tpl_vars['id']; ?>
" method="post" enctype="multipart/form-data" onsubmit="return checkInputs()">
<table cellpadding="0" cellspacing="0" width="90%" border="0" align="center">
<tr>
<td colspan="8" align="left" class="content_title">Edit Products<input type="hidden" name="subcat" id="subcat"  /></td>
</tr>
<tr>
<td colspan="3" align="right"><font color="#FF0000">*</font> Mandatory Inputs </td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left"><?php echo $this->_tpl_vars['message']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td align="center" >
<table cellpadding="0" cellspacing="0" border="0" width="70%">
<tr>
<td align="center"><!--<img src="images/tab_images/ico_error_msg.gif"  alt="" border="0" width="14" height="14">--></td>
</tr>
<tr>
<td align="left"><img name="Image51" id="Image51" src="images/tab_images/category_1.jpg"  alt="" border="0" onClick="clk('Image51','images/tab_images/category_1.jpg',4)"></td>
<td><img src="images/tab_images/general.jpg" id="Image52" name="Image52" border="0" onClick="clk('Image52','images/tab_images/general_1.jpg',5)" ></td>
<td><img src="images/tab_images/images.jpg" name="Image54" id="Image54" border="0" onClick="clk('Image54','images/tab_images/images_1.jpg',6)" ></td>
<td><img src="images/tab_images/attributes.jpg" name="Image55" id="Image55" border="0" onClick="clk('Image55','images/tab_images/attributes_1.jpg',7)"  ></td>
<td><img src="images/tab_images/price.jpg" name="Image56" id="Image56" border="0" onClick="clk('Image56','images/tab_images/price_1.jpg',8)"></td>
<td><img src="images/tab_images/inventory.jpg" name="Image57" id="Image57" border="0" onClick="clk('Image57','images/tab_images/inventory_1.jpg',9)"></td>
<!--<td><img src="images/tab_images/May_tab1_08.jpg" name="Image58" id="Image58" border="0" onClick="clk('Image58','images/tab_images/May_tab1_roll_08.jpg',10)"></td>
<td><img src="images/tab_images/May_tab1_09.jpg" name="Image59" id="Image59" border="0" onClick="clk('Image59','images/tab_images/May_tab1_roll_09.jpg',11)"></td>-->
<td><img src="images/tab_images/meta.jpg" name="Image60" id="Image60" border="0" onClick="clk('Image60','images/tab_images/meta_1.jpg',12)"></td>
<td><img src="images/tab_images/related.jpg" name="Image61" id="Image61" border="0" onClick="clk('Image61','images/tab_images/related_1.jpg',13)"></td>
</tr>
</table>
<span id="tabs_det" style="display:none"></span>
<!-- Category-->
<div id="tab4" >
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Category Details</b> </td>
</tr>
<tr>
<td><table border="0" width="60%" cellpadding="4" cellspacing="4" align="left">
<tr>
<td width="40%" valign="top" class="content_form" align="left"> Select Main Category <font color="#FF0000">*</font></td>
<td align="left"><?php echo $this->_tpl_vars['editMainCategory']; ?>
&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dct', 'Main Category', 'Select product main category')" onmouseout="HideHelp('dct');">
<div id="dct" style="left: 50px; top: 50px;"></div><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['selcatgory']; ?>
</div></td>
</tr>
<tr>
<td width="31%" class="content_form" align="left"> Select Sub Category <font color="#FF0000">*</font></td>
<td ID="subcats" align="left"><?php echo $this->_tpl_vars['editSubCategory']; ?>
&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dct1', 'Sub Category', 'Select product sub category')" onmouseout="HideHelp('dct1');">
<div id="dct1" style="left: 50px; top: 50px;"></div><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['subcat']; ?>
</div></td>
</tr>
<tr>
<td width="31%" class="content_form"> Select Sub Under SubCategory <font color="#FF0000">*</font></td>
<td ID="subcatsunder" align="left"><?php echo $this->_tpl_vars['editSubUnderCategory']; ?>
&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dct2', 'Sub Under SubCategory', 'Select product sub under sub category')" onmouseout="HideHelp('dct2');">
<div id="dct2" style="left: 50px; top: 50px;"></div><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['subcatunder']; ?>
</div></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image52','images/tab_images/general_1.jpg',5)"/></td>
</tr>
</table></td>
</tr>
</table>
</div>
<!-- General-->
<div id="tab5" style="display:none" >
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product General Information</b> </td>
</tr>
<tr>
<td><table border="0" width="60%" cellpadding="4" cellspacing="4" align="left">
<tr>
<td width="18%" class="content_form" nowrap="nowrap" align="left"> Product Name <font color="#FF0000">*</font></td>
<td colspan="3" align="left"><input name="product_title" id="product_title"
value="<?php echo $this->_tpl_vars['product_title']; ?>
"  type="text" size="50" />
<div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['product_title']; ?>
</div></td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"> Product Description </td>
</tr>
<tr>
<td colspan="4" style="padding-left:140px"><textarea name="desc" id="desc" rows="20"  cols="80"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td>
</tr>
<tr>
<td class="content_form" align="left">SKU <font color="#FF0000">*</font></td>
<td colspan="3" id="sku" align="left"><input name="sku" id="sku" type="text" value="<?php echo $this->_tpl_vars['sku']; ?>
"/>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dsku', 'SKU', 'Stock Keeping Unit for a product')" onmouseout="HideHelp('dsku');">
<div id="dsku" style="left: 50px; top: 50px;">
<div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['sku']; ?>
</div></td>
</tr>
<tr>
<td class="content_form" align="left">Brand</td>
<td  colspan="2" align="left"><table>
<!--<tr>
<td id='spanbrandcbo'><?php echo $this->_tpl_vars['corbrand']; ?>
</td>
<td><a href="javascript:toggle('spanbrand'); toggle('spanbrandcbo');void (0);">Others</a> &nbsp;<span id='spanbrand' style="display:none">
<input name="brand" id="brand" type="text" value="<?php echo $this->_tpl_vars['val']['brand']; ?>
" />
</span></td>
</tr>-->
<tr>
<td><div id="select" name="select" style="visibility:visible; display:block"><?php echo $this->_tpl_vars['corbrand']; ?>
</div><div id="select_new" name="select_new" style="visibility:hidden; display:none"><input type="text" name="new_brand"  /></div></td><td><div id="select1" name="select1" style="visibility:visible; display:block"><a href="javascript:change();">Others</a></div><div id="select_new1" name="select_new1" style="visibility:hidden; display:none"><a href="javascript:change1();">Others</a></div></td><td>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dbnd', 'Brand', 'Select brand from list or click and enter new brand.')" onmouseout="HideHelp('dbnd');">
<div id="dbnd" style="left: 50px; top: 50px;"></div></td>
<!--<td id='spanbrandcbo'><?php echo $this->_tpl_vars['dispbrand']; ?>
</td>
<td><a href="javascript:toggle('spanbrand'); toggle('spanbrandcbo');void (0);">Others</a> &nbsp;<span id='spanbrand' style="display:none">
<input name="brand" id="brand" type="text"/>
</span></td>-->
</tr>
</table></td>
</tr>
<tr>
<td class="content_form" align="left">Model</td>
<td colspan="3" align="left"><input name="model" id="model"  type="text" value="<?php echo $this->_tpl_vars['model']; ?>
" /></td>
</tr>
<tr>
<td class="content_form" align="left">Weight</td>
<td colspan="3" align="left"><input name="txtweight" id="txtweight"  type="text" value="<?php echo $this->_tpl_vars['txtweight']; ?>
" />(lbs) <div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['txtweight']; ?>
</div></td>
</tr>
<tr>
<td class="content_form" valign="top" align="left">Dimension</td>
<td colspan="3" align="left">
<table>
<tr>
<td class="content_form" valign="top">Width</td>
<td class="content_form" valign="top">Height</td>
<td class="content_form" valign="top">Depth</td>
</tr>
<tr>
<td><input name="txtwidth" type="text" id="txtwidth" value="<?php echo $this->_tpl_vars['txtwidth']; ?>
" size="4" /><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['txtwidth']; ?>
</div></td>
<td><input name="txtheight" id="txtheight"  type="text" value="<?php echo $this->_tpl_vars['txtheight']; ?>
" size="4"/><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['txtheight']; ?>
</div></td>
<td><input name="txtdepth" id="txtdepth"  type="text" value="<?php echo $this->_tpl_vars['txtdepth']; ?>
" size="4"/> (inches)<div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['txtdepth']; ?>
</div></td>
</tr>
</table>
</td>
</tr>
<TR>
<TD class="content_form" align="left"> Product Tags </TD>
<TD align="left"><INPUT NAME="tag"  type="text" ID="tag" VALUE="<?php echo $this->_tpl_vars['tag']; ?>
" SIZE="80"/>
<div><font size="-2">(Ex: tag1, tag2,etc..)</div></TD>
</TR>
<TR>
<TD class="content_form" align="left">Introduction Date </TD>
<TD align="left"><INPUT  type="text" ID="intro_date" NAME="intro_date" VALUE="<?php echo $this->_tpl_vars['intro_date']; ?>
"  />
<INPUT TYPE="image" SRC="images/calendar_img.gif" ID="cal-button-1" VALUE="cal">
<SCRIPT TYPE="text/javascript">
Calendar.setup({
inputField    : "intro_date",
button        : "cal-button-1",
align         : "Tr"
});
</SCRIPT>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dindt', 'Introduction Date', 'Select the date in which you need to schedule the product to be displayed in site. The date can be selected from scheduled calendar displayed.')" onmouseout="HideHelp('dindt');">
<div id="dindt" style=" position:fixed"></div></TD>
</TR>
<TR>
<TD class="content_form" nowrap="nowrap" valign="top" align="left">Is CSE Enabled </TD>
<TD class="content_form" align="left"><INPUT NAME="cse_enabled" TYPE="checkbox" ID="cse_enabled" onclick="cseshow()"  <?php echo $this->_tpl_vars['cse_enabled']; ?>
/>
(Check if the product is eligible for price comparison)&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dcse','Comparison Shopping Engine(CSE)','If you have registered with the www.pricerunner.com, you may get the pricerunner id to compare the prices of products added in your website with the other websites. When you enable the check box, your product will be compared with the other products.')" onmouseout="HideHelp('dcse');">
<div id="dcse" style=" position:fixed"></div><div id="divcsekey" style="display:none" >CSE Keyword&nbsp;:&nbsp;<input type="text" id="csekeyid" name="csekeyid" value="<?php echo $this->_tpl_vars['csekeyid']; ?>
" /></div> </TD>
</TR>
<TR>
<TD class="content_form" align="left">Is Featured</TD>
<TD class="content_form" align="left"><INPUT NAME="is_feautured" TYPE="checkbox" <?php echo $this->_tpl_vars['is_featured']; ?>
/>
(Check if the product is Featured product)&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dftr','Featured Product','Enable the check box to display the product in featured products list provided in home page of site.')" onmouseout="HideHelp('dftr');">
<div id="dftr" style=" position:fixed"></div> </TD>
</TR>
<TR>
<TD class="content_form" align="left">Is New Product</TD>
<TD class="content_form" align="left"><INPUT NAME="is__product_status" TYPE="radio" <?php echo $this->_tpl_vars['is_new_product']; ?>
value='1'/>
(enable if the product is new product)&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dftrnew','New Product','Enable the radio button to display the product in featured new products list provided in home page of site.')" onmouseout="HideHelp('dftrnew');">
<div id="dftrnew" style=" position:fixed"></div>Is Discount Product<INPUT NAME="is__product_status" TYPE="radio" <?php echo $this->_tpl_vars['is_discount_product']; ?>
value='2'/>
(enable if the product is discount  product)&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dftrdiscount','Featured Product','Enable the radio button to display the product in featured discount products list provided in home page of site.')" onmouseout="HideHelp('dftrdiscount');">
<div id="dftrdiscount" style=" position:fixed"></div></TD>
</TR>
<TR>
<TD class="content_form" nowrap="nowrap" align="left">Visibility at Store Front </TD>
<TD class="content_form" align="left"><INPUT NAME="status" TYPE="checkbox" <?php echo $this->_tpl_vars['status']; ?>
/>
(Check if you want to show the product at Store Front)&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dstrfrnt','Store Front','Enable the check box to make activate of product in site.')" onmouseout="HideHelp('dstrfrnt');">
<div id="dstrfrnt" style=" position:fixed"></div> </TD>
</TR>
<tr>
<td colspan="2" align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image51','images/tab_images/category_1.jpg',4)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image54','images/tab_images/images_1.jpg',6)"/></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
<br>
</div>
<!-- Images-->
<div id="tab6" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product Image Details</b> </td>
</tr>
<tr>
<td align="left">
<table border="0" width="80%" cellpadding="4" cellspacing="4" align="left">
<tr><td colspan="2" align="center"><div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['ufile_value']; ?>
</div></td></tr>
<!--<tr>
<td width="31%" valign="top"> Main Product Image <font color="#FF0000">*</font></td>
<td colspan="2" valign="top"><INPUT type="hidden" name="ufile_id[0]" id="ufile_id[0]" VALUE="<?php echo $this->_tpl_vars['product_images_id']; ?>
">
<INPUT NAME="ufile[0]" ID="ufile[0]"  type="file" />
&nbsp;
<div style="color:#FF0000">
<?php echo $this->_tpl_vars['msg']['ufile']; ?>
</div>
</td>
<td> <img src="../<?php echo $this->_tpl_vars['thumb_image_path']; ?>
" alt="Image" /></td>
</tr>-->
<?php echo $this->_tpl_vars['editMainImage']; ?>
<?php echo $this->_tpl_vars['editImage']; ?>
<tr>
<td colspan="4" align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image52','images/tab_images/general_1.jpg',5)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image55','images/tab_images/attributes_1.jpg',7)"/></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
</div>
<!-- Attributes-->
<div id="tab7" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product Attributes</b> </td>
</tr>
<tr>
<td ID="attributes" align="left">
<?php echo $this->_tpl_vars['editAttributes']; ?>
<!--<table border="0" width="80%" cellpadding="4" cellspacing="4" align="center">
<tr>
<td colspan="2" align="center"><font color="orange"><b>No Attributes found</b></font></td>
</tr>
</table>-->
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image54','images/tab_images/images_1.jpg',6)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image56','images/tab_images/price_1.jpg',8)"/></td>
</tr>
</table>
<br />
</div>
<!-- Price-->
<div id="tab8" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product Prices</b> </td>
</tr>
<tr>
<td>
<table border="0" width="90%" cellpadding="4" cellspacing="4" align="left">
<TR>
<TD width="20%" class="content_form" align="left">Purchase Price <font color="#FF0000">*</font> </TD>
<TD  colspan="3" class="content_form" align="left"><INPUT NAME="price" TYPE="text" ID="price" VALUE="<?php echo $this->_tpl_vars['price']; ?>
" MAXLENGTH="16" />&nbsp;<b>[<?php echo $this->_tpl_vars['currencycode']; ?>
]</b>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dprice','Purchased Price','Enter product purchased price')" onmouseout="HideHelp('dprice');">
<div id="dprice" style="left: 50px; top: 50px;"></div>
<DIV STYLE="color:#FF0000"> <?php echo $this->_tpl_vars['msg']['price']; ?>
</DIV></TD>
</TR>
<TR>
<TD class="content_form" align="left"> Product MSRP <font color="#FF0000">*</font> </TD>
<TD COLSPAN="3" class="content_form" align="left"><INPUT NAME="msrp_org" TYPE="text" ID="msrp" MAXLENGTH="16" VALUE="<?php echo $this->_tpl_vars['msrp_org']; ?>
" />&nbsp;<b>[<?php echo $this->_tpl_vars['currencycode']; ?>
]</b>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dmsrp', 'MSRP', 'Manufacturer&acute;s Suggested Retail Price')" onmouseout="HideHelp('dmsrp');">
<div id="dmsrp" style="left: 50px; top: 50px;"></div>
<DIV STYLE="color:#FF0000"><?php echo $this->_tpl_vars['msg']['msrp_org']; ?>
</DIV>         </TD>
</TR>
<TR>
<TD valign="top" class="content_form" align="left"> Tier Price </TD>
<TD COLSPAN="3" align="left">
<!--<div align="right" style="padding-bottom:10px; width:90%"><input type="button" name="insert" class="all_bttn"  value="Add" onClick="addTier();"/><INPUT VALUE="-1" ID="msrp1" TYPE="hidden"></div>-->
<table cellpadding="4" cellspacing="0" border="0" width="90%"  class="content_list_bdr">
<tr>
<td class="content_list_head" width="40%">Quantity</td>
<td  class="content_list_head" width="30%">Msrp Per Unit</td>
</tr>
<?php echo $this->_tpl_vars['editTierPrice']; ?>
<!--<tr>
<td class="content_list_txt1" width="40%">
<INPUT VALUE="0" ID="quantity1" TYPE="hidden">
<INPUT NAME="quantity[0]" ID="quantity[0]"  type="text"  size="3" />and above
</td>
<td class="content_list_txt1">
<INPUT VALUE="0" ID="msrp1" TYPE="hidden">
<INPUT NAME="msrp[0]" ID="msrp[0]"  type="text"  size="5" />&nbsp;<b>[USD]</b>
</td>
<td class="content_list_txt1" align="center"></td>
</tr>-->
<tr>
<td colspan="3"><DIV ID="myTier"></DIV>
<A HREF="javascript:;" onClick="addEvent();"></A></TD>
</TR>
</table>
</TD>
</TR>
<TR>
<TD class="content_form" nowrap="nowrap" align="left"> Product Shipping Cost</TD>
<TD COLSPAN="4" class="content_form" align="left"><INPUT NAME="shipcost" ID="shipcost"  type="text" VALUE="<?php echo $this->_tpl_vars['shipcost']; ?>
"  />&nbsp;<b>[<?php echo $this->_tpl_vars['currencycode']; ?>
]</b>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dshipping', 'Shipping Cost', 'Enter the amount to be collected while sending the product to customers.')" onmouseout="HideHelp('dshipping');">
<div id="dshipping" style="left: 50px; top: 50px;"></div>  <DIV STYLE="color:#FF0000"><?php echo $this->_tpl_vars['msg']['shipcost']; ?>
</DIV>                  </TD></TR>
<tr>
<td colspan="2" align="right"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image55','images/tab_images/attributes_1.jpg',7)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image57','images/tab_images/inventory_1.jpg',9)"/></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
</div>
<!-- Inventory-->
<div id="tab9" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product Inventory Details</b> </td>
</tr>
<tr>
<td>
<table border="0" width="60%" cellpadding="4" cellspacing="4" align="left">
<TR>
<TD class="content_form" width="35%" align="left"> Re-Order Level Quantity </TD>
<TD align="left"><INPUT NAME="rol"  type="text" ID="rol" SIZE="10" MAXLENGTH="5" VALUE="<?php echo $this->_tpl_vars['rol']; ?>
" />&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dreodr','Reorder Level','Enter product repurchase limit')" onmouseout="HideHelp('dreodr');">
<div id="dreodr" style="left: 50px; top: 50px;"></div><DIV STYLE="color:#FF0000"><?php echo $this->_tpl_vars['msg']['rol']; ?>
</DIV></TD>
</TR>
<TR>
<TD class="content_form" align="left"> Stock on Hand Quantity </TD>
<TD align="left"><INPUT NAME="soh"  type="text" ID="soh" SIZE="10" VALUE="<?php echo $this->_tpl_vars['soh']; ?>
" MAXLENGTH="5"/>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dsth','Stock in Hand','Enter the number of products available with you currently.')" onmouseout="HideHelp('dsth');">
<div id="dsth" style="left: 50px; top: 50px;"></div><DIV STYLE="color:#FF0000"><?php echo $this->_tpl_vars['msg']['soh']; ?>
</DIV></TD>
</TR>
<tr>
<td colspan="2" align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image56','images/tab_images/price_1.jpg',8)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image60','images/tab_images/meta_1.jpg',12)"/></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
</div>
<div id="tab10" style="display:none">Test8</div>
<div id="tab11" style="display:none">Test8</div>
<!-- Meta Information-->
<div id="tab12" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Product Meta Information</b> </td>
</tr>
<tr>
<td align="left">
<table border="0" width="80%" cellpadding="4" cellspacing="4" align="left">
<TR>
<TD class="content_form" width="20%" align="left">Meta Keywords </TD>
<TD align="left">
<INPUT NAME="meta_keywords" wrap="off" TYPE="text" ID="meta_keywords" VALUE="<?php echo $this->_tpl_vars['meta_keywords']; ?>
"/>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dmeteaky', 'Meta Keyword', 'This entry is essential as it provides meta-information about your page, such as descriptions and keywords for search engines and refreshes rates. Create effective well formatted Meta tags for your website with this Meta tag generator. Enter the essential keywords to be used for product.')" onmouseout="HideHelp('dmeteaky');">
<div id="dmeteaky" style="left: 50px; top: 50px;"></div></TD>
</TR>
<TR>
<TD class="content_form" align="left">Meta Description </TD>
<TD align="left"><INPUT NAME="meta_desc"  type="text"  id="meta_desc" VALUE="<?php echo $this->_tpl_vars['meta_desc']; ?>
" />&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dmetadesc', 'Meta Content', 'Enter the brand name for product i.e., the name allotted by manufacturer for product.')" onmouseout="HideHelp('dmetadesc');">
<div id="dmetadesc" style="left: 50px; top: 50px;"></div>
<!--<textarea name="prodmetadesc" id="prodmetadesc" rows="3" cols="36"/></textarea>    -->                  </TD>
</TR>
<tr>
<td colspan="2" align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image57','images/tab_images/inventory_1.jpg',9)"/>&nbsp;&nbsp;&nbsp;<input type="button" name="category" class="all_bttn" value="Continue" onClick="clk('Image61','images/tab_images/related_1.jpg',13)"/></td>
</tr>
</table>
</td>
</tr>
</table><br />
</div>
<!-- Related Products-->
<div id="tab13" style="display:none">
<table style="border-left: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204);" border="0" cellpadding="0" cellspacing="5" width="742">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" class="content_form" align="left"><b>Select Your Related Products</b> </td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['editRelated']; ?>
</td>
</tr>
<tr>
<td align="center"><input type="button" name="category" class="all_bttn" value="Back" onClick="clk('Image60','images/tab_images/meta_1.jpg',12)"/>&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="all_bttn" value="Finish" /></td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
function change()
{
document.getElementById("select").style.visibility="hidden";
document.getElementById("select").style.display="none";
document.getElementById("select1").style.visibility="hidden";
document.getElementById("select1").style.display="none";
document.getElementById("select_new").style.visibility="visible";
document.getElementById("select_new").style.display="block";
document.getElementById("select_new1").style.visibility="visible";
document.getElementById("select_new1").style.display="block";
}
function change1()
{
document.getElementById("select").style.visibility="visible";
document.getElementById("select").style.display="block";
document.getElementById("select1").style.visibility="visible";
document.getElementById("select1").style.display="block";
document.getElementById("select_new").style.visibility="hidden";
document.getElementById("select_new").style.display="none";
document.getElementById("select_new1").style.visibility="hidden";
document.getElementById("select_new1").style.display="none";
}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!--</body>
</html>-->
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