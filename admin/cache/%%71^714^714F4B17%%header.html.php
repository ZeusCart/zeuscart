<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:25
compiled from header.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zeuscart Admin Control Panel<?php echo $this->_tpl_vars['pagetitle']; ?>
</title>
<link href="css/admin_style.css" rel="stylesheet" type="text/css" />
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() {
var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() {
var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) {
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() {
var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script type="text/javascript" src="js/helps.js"> </script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="js/list_color.js"></script>
<script type="text/javascript" language="javascript" src="js/show_hide.js"></script>
</head>
<body onLoad="MM_preloadImages('images/ch_width_bttn_hov.gif');">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="main_table">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="49%" class="header_bg"><a href="?do=adminlogin&amp;action=validatelogin"><img src="images/logo.gif" alt="Zeuscart Logo" width="200" height="77" border="0" title="Admin Home" /></a></td>
<td width="51%" align="right" valign="top" class="header_bg"><table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="14" align="right" style="height:8px;"></td>
</tr>
<tr>
<td width="6%" align="right"><img src="images/ico_home.gif" alt="" width="11" height="10" /></td>
<td width="11%" align="center"><a href="?do=adminlogin&amp;action=validatelogin" class="top_links">Home</a></td>
<td width="7%" align="center">|</td>
<td width="6%" align="right"><img src="images/ico_adminmap.gif" alt="" width="11" height="10" /></td>
<td width="18%" align="center"><a href="?do=sitemap" class="top_links">Admin Map</a></td>
<td width="7%" align="center">|</td>
<td width="6%" align="right"><img src="images/ico_store.gif" alt="" width="11" height="10" /></td>
<td width="9%" align="center"><a href="../" class="top_links" target="_blank">Storefront</a></td>
<td width="7%" align="center">|</td>
<td width="6%" align="right"><img src="images/ico_help.gif" alt="" width="11" height="11" /></td>
<td width="8%" align="center"><a href="../manuals/index.html" class="top_links">Help</a></td>
<td width="7%" align="center">|</td>
<td width="12%" align="right" style="padding-left:7px;"><img src="images/ico_logout.gif" alt="" width="11" height="11" /></td>
<td width="20%" align="center"><a href="?do=adminlogout" class="top_links">Logout</a></td>
</tr>
</table></td>
</tr>
<tr> <td align="left" valign="middle" class="welcome_bg">Welcome <?php echo $this->_tpl_vars['username']; ?>
</td>
<td align="right" valign="middle" class="welcome_bg"><?php echo $this->_tpl_vars['currentDate']; ?>
</td>
</tr>
<tr>
<td colspan="2" valign="middle" class="top_nav_bg"><div class="imrcmain0 imgl" style="z-index:999999;position:relative;">
<div class="imcm imde" id="imouter0">
<ul id="imenus0">
<!--Order Menu Starts Here-->
<li ><a href="#">Orders</a>
<div class="imsc">
<div class="imsubc" style="width:160px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=disporders">Order List</a></li>
<!--<li><a href="?do=orderstatus">Order status Management</a></li>-->
<li><a href="?do=userorder">Create Order</a></li>
<li><a href="?do=orexp">Export Order</a></li>
</ul>
</div>
</div>
</li>
<!--Order Menu Ends Here-->
<!--Customer Menu Starts Here-->
<li ><a href="#">Customers</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=adminreg">View Customers</a></li>
<li><a href="?do=addUserAccount">Create Customer</a></li>
<li><a href="?do=custreport">Export Customer</a></li>
</ul>
</div>
</div>
</li>
<!--Customer Menu Ends Here-->
<!--Catalog Menu Starts Here-->
<li ><a href="#">Catalog</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:0px;">
<ul style="">
<li><a href="#"><span class="imea imeas"><span></span></span> Products</a>
<div class="imsc">
<div class="imsubc" style="width:160px;top:-23px;left:132px;">
<ul style="">
<!--<li><a href="?do=productentry">Entry</a></li>-->
<li><a href="?do=manageproducts">View Products</a></li>
<li><a href="?do=selectfeatured">Featured Products</a></li>
<li><a href="?do=adminproductreview">Product Reviews</a></li>
<li><a href="?do=productinventory">Inventory</a></li>
<li><a href="?do=bulkupload">Products Bulk Upload</a></li>
<li><a href="?do=bulkupload&action=displayimagesbulkupload">Images Bulk Upload</a></li>
<li><a href="?do=prodexp">Export Product</a></li>
</ul>
</div>
</div>
</li>
<li><a href="#"><span class="imea imeas"><span></span></span>Attributes</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=addattributes">Attribute</a></li>
<li><a href="?do=addattributevalues">Attribute Value </a></li>
</ul>
</div>
</div>
</li>
<li ><a href="#"><span class="imea imeas"><span></span></span>Categories</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=showmain">Category</a></li>
<li><a href="?do=catexp">Category Export </a></li>
<li><a href="?do=catbulkupload">Category Bulk Upload </a></li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</li>
<!--Catalog Menu Ends Here-->
<!--Settings Menu Starts Here-->
<li><a href="#"><!--Payment -->Settings</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:-1px;">
<ul style="">
<li><a href="#"><span class="imea imeas"><span></span></span> Site Settings</a>
<div class="imsc">
<div class="imsubc" style="width:160px;top:-23px;left:132px;">
<ul style="">
<!--<li><a href="?do=productentry">Entry</a></li>-->
<li><a href="?do=customheader">Custom Header</a></li>
<!-- <li><a href="?do=footersettings">Footer settings</a></li>-->
<li><a href="?do=ganalytics">Google Analytics Code</a></li>
<li><a href="?do=banner">Home Page Banner</a></li>
<li><a href="?do=site">Site Moto</a></li>
<li><a href="?do=sitelogo">Site Logo</a></li>
<li><a href="?do=selectskin">Site Skin</a></li>
<li><a href="?do=sitemail">Admin Email</a></li>
<li><a href="?do=timezone">Time Zone</a></li>
</ul>
</div>
</div>
</li>
<li><a href="?do=adminpayment"><!--View-->Payment Settings</a></li>
<li><a href="?do=taxsettings"><!--View-->Tax Settings</a></li>
<li><a href="?do=showcurrencylist"><!--View-->Currency Settings</a></li>
<li><a href="?do=cse">CSE Settings</a></li>
</ul>
</div>
</div>
</li>
<!--Settings Menu Ends Here-->
<!--Promotions Menu Starts Here-->
<li ><a href="#">Promotions</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=createpromotionalcodes&action=listcoupons">Coupons</a></li>
<li><a href="#"><span class="imea imeas"><span></span></span> News Letter</a>
<div class="imsc">
<div class="imsubc" style="width:160px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=newsletter&action=show">View</a></li>
<li><a href="?do=newsletter&action=subscrib">Subscribed Users</a></li>
</ul>
</div>
</div>
</li>
<li><a href="?do=news&action=show">News Management</a></li>
<li><a href="?do=gadsense">Google AdSense Code</a></li>
<li><a href="?do=adword">Google AdWord Campaign</a></li>
<li><a href="?do=googleproduct">Google Base Data Feed </a></li>
</ul>
</div>
</div>
</li>
<!--Promotions Menu Ends Here-->
<!--Sub Admin Menu Starts Here-->
<li ><a href="#">SubAdmins</a></a>
<div class="imsc">
<div class="imsubc" style="width:160px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=subadminmgt">Sub Admin Management</a></li>
</ul>
</div>
</div>
</li>
<!--Sub Admin Menu Ends Here-->
<!--Business Intelligence Menu Starts Here-->
<li ><a href="#">Business Intelligence</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:0px;">
<ul style="">
<li><a href="#"><span class="imea imeas"><span></span></span>Orders</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=showchart&id=4">Pending Orders</a></li>
<li><a href="?do=showchart&id=5">Processing Orders</a></li>
<li><a href="?do=showchart&id=6">Awaiting Payment</a></li>
<li><a href="?do=showchart&id=1">Completed Orders</a></li>
<li><a href="?do=showchart&id=7">Quantity Break Down</a></li>
</ul>
</div>
</div>
</li>
<li ><a href="#"><span class="imea imeas"><span></span></span>Products</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=showchart&id=9">Products Sold <br />(By Units)</a></li>
<li><a href="?do=showchart&id=10">Products Sold <br />(By Revenue)</a></li>
<li><a href="?do=showchart&id=8">Best Selling Products</a></li>
</ul>
</div>
</li>
<li ><a href="#"><span class="imea imeas"><span></span></span>Customers</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:-23px;left:132px;">
<ul style="">
<li><a href="?do=showchart&id=2">New Customers</a></li>
<li><a href="?do=showchart&id=11">Customers<br />(By Location)</a></li>
<li><a href="?do=showchart&id=12">Customers Seniority</a></li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</li>
<!--Business Intelligence Menu Ends Here-->
<!--CMS Menu Starts Here-->
<li ><a href="#">CMS</a>
<div class="imsc">
<div class="imsubc" style="width:140px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=createpage">Custom Pages List</a></li>
<li><a href="?do=terms">Terms & Conditions</a></li>
<li><a href="?do=adminprivacypolicy">Privacy Policy</a></li>
<li><a href="?do=faq">FAQs</a></li>
<li><a href="?do=showcontents">Html Contents</a></li>
<li><a href="?do=aboutus">About Us</a></li>
</ul>
</div>
</div>
</li>
<!--CMS Menu Ends Here-->
<!--Others Menu Starts Here-->
<li ><a href="#">Others</a>
<div class="imsc">
<div class="imsubc" style="width:170px;top:0px;left:-1px;">
<ul style="">
<li><a href="?do=mostsearchedkeywords">Most Searched Keywords</a></li>
<li><a href="?do=bestsellingproducts">Best Selling Products</a></li>
<li><a href="?do=activity">Admin Activity Report</a></li>
<li><a href="?do=admactexp">Admin Activity Export</a></li>
<li><a href="?do=siteinfo">Server Information</a></li>
</ul>
</div>
</div>
</li>
<!--Others Menu Ends Here-->
</ul>
<div class="imclear">&nbsp;</div>
</div>
</div>
<script language="JavaScript" type="text/javascript">function imenus_data0(){
this.menu_showhide_delay = 800
this.show_subs_onclick = false
this.hide_focus_box = false
/*---------------------------------------------
Box Animation Settings
---------------------------------------------*/
//set to... "pointer", "center", "top", "left"
this.box_animation_type = "center"
this.box_animation_frames = 10
this.box_animation_styles = "border:1px solid #5d6478;"
/*---------------------------------------------
IE Transition Effects
---------------------------------------------*/
this.subs_ie_transition_show = ""
/*[end data]*/}</script>
<!--  ********************************** Infinite Menus Source Code (Do Not Alter!) **********************************
Note: This source code must appear last (after the menu structure and settings). -->
<script language="JavaScript" type="text/javascript">
// ---- Add-On [3.2 KB]: Box Outline Animations ----
;function imenus_box_ani_init(obj,dto){var tid=obj.getElementsByTagName("UL")[0].id.substring(6);if(!(ulm_navigator&&ulm_mac)&&!(window.opera&&ulm_mac)&&!(window.navigator.userAgent.indexOf("afari")+1)&& !ulm_iemac&&dto.box_animation_frames>0&&!dto.box_animation_disabled){ulm_boxa["go"+tid]=true;ulm_boxa.go=true;ulm_boxa.all=new Object();}else return;};function imenus_box_ani(show,tul,hobj,e){if(tul.className.indexOf("imcanvassubc")+1){hover_handle(hobj);return;}if(!ulm_boxa.cm)ulm_boxa.cm=new Object();if(!ulm_boxa["ba"+hobj.id])ulm_boxa["ba"+hobj.id]=new Object();ulm_boxa["ba"+hobj.id].hobj=hobj;var bo=ulm_boxa["ba"+hobj.id];bo.id="ba"+hobj.id;if(!bo.bdiv){bdiv=document.createElement("DIV");bdiv.className="ulmba";bdiv.onmousemove=function(e){if(!e)e=event;e.cancelBubble=true;};bdiv.onmouseover=function(e){if(!e)e=event;e.cancelBubble=true;};bdiv.onmouseout=function(e){if(!e)e=event;e.cancelBubble=true;};bo.bdiv=tul.parentNode.appendChild(bdiv);}var i;for(i in ulm_boxa){if((ulm_boxa[i].steps)&&!(ulm_boxa[i].id.indexOf(hobj.id)+1))ulm_boxa[i].reverse=true;}if(((hobj.className.indexOf("ishow")+1)&&bo.hobj)||(bo.bdiv.style.visibility=="visible"&&!bo.reverse))return true;imenus_box_show(bo,hobj,tul,e);};function imenus_box_h(hobj){if(hobj.className.indexOf("imctitleli")+1)return;var bo=ulm_boxa["ba"+hobj.id];if(bo&&bo.bdiv&&bo.pos){bo.reverse=true;bo.pos=bo.steps;bo.bdiv.style.visibility="visible";imenus_box_x44(bo);}};function imenus_box_reverse(x17){if(!ulm_boxa.go)return;var i;for(i in ulm_boxa.all){if(ulm_boxa.all[i]&&ulm_boxa[i].hobj!=x17){var bo=ulm_boxa[i];bo.reverse=true;ulm_boxa.all[i]=null;}}};function imenus_box_show(bo,hobj,tul,e){var type;var tdto=ulm_boxa["dto"+parseInt(hobj.id.substring(6))];clearTimeout(bo.st);bo.st=null;if(bo.bdiv)bo.bdiv.style.visibility="hidden";bo.pos=0;bo.reverse=false;bo.steps=tdto.box_animation_frames;bo.exy=new Array(tul.offsetLeft,tul.offsetTop);bo.ewh=new Array(tul.offsetWidth,tul.offsetHeight);bo.sxy=new Array(0,0);if(!(type=tul.getAttribute("boxatype")))type=tdto.box_animation_type;if(type=="center")bo.sxy=new Array(bo.exy[0]+parseInt(bo.ewh[0]/2),bo.exy[1]+parseInt(bo.ewh[1]/2));else  if(type=="top")bo.sxy=new Array(parseInt(bo.ewh[0]/2),0);else  if(type=="left")bo.sxy=new Array(0,parseInt(bo.ewh[1]/2));else  if(type=="pointer"){if(!e)e=window.event;var txy=x26(tul);bo.sxy=new Array(e.clientX-txy[0],(e.clientY-txy[1])+5);}bo.dxy=new Array(bo.exy[0]-bo.sxy[0],bo.exy[1]-bo.sxy[1]);bo.dwh=new Array(bo.ewh[0],bo.ewh[1]);bo.tul=tul;bo.hobj=hobj;imenus_box_x44(bo);};function imenus_box_x44(bo){var a=bo.bdiv;var cx=bo.sxy[0]+parseInt((bo.dxy[0]/bo.steps)*bo.pos);var cy=bo.sxy[1]+parseInt((bo.dxy[1]/bo.steps)*bo.pos);a.style.left=cx+"px";a.style.top=cy+"px";var cw=parseInt((bo.dwh[0]/bo.steps)*bo.pos);var ch=parseInt((bo.dwh[1]/bo.steps)*bo.pos);a.style.width=cw+"px";a.style.height=ch+"px";if(bo.pos<=bo.steps){if(bo.pos==0)a.style.visibility="visible";if(bo.reverse==true)bo.pos--;else bo.pos++;if(bo.pos==-1){bo.pos=0;a.style.visibility="hidden";}else {bo.st=setTimeout("imenus_box_x44(ulm_boxa['"+bo.id+"'])",8);ulm_boxa.all[bo.id]=true;}}else {clearTimeout(bo.st);bo.st=null;ulm_boxa.all[bo.id]=null;if(!bo.reverse){if((bo.hobj)&&(bo.pos>-1))hover_handle(bo.hobj);}a.style.visibility="hidden";}}
// ---- Add-On [0.7 KB]: Select Tag Fix for IE ----
;function iao_iframefix(){if(ulm_ie&&!ulm_mac&&!ulm_oldie&&!ulm_ie7){for(var i=0;i<(x31=uld.getElementsByTagName("iframe")).length;i++){ if((a=x31[i]).getAttribute("x30")){a.style.height=(x32=a.parentNode.getElementsByTagName("UL")[0]).offsetHeight;a.style.width=x32.offsetWidth;}}}};function iao_ifix_add(b){if(ulm_ie&&!ulm_mac&&!ulm_oldie&&!ulm_ie7&&window.name!="hta"&&window.name!="imopenmenu"){b.parentNode.insertAdjacentHTML("afterBegin","<iframe src='javascript:false;' x30=1 style='z-index:-1;position:absolute;float:left;border-style:none;width:1px;height:1px;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=0);' frameborder='0'></iframe><div></div>");}}
// ---- IM Code + Security [7.4 KB] ----
im_version="10.x";ht_obj=new Object();cm_obj=new Object();uld=document;ule="position:absolute;";ulf="visibility:visible;";ulm_boxa=new Object();var ulm_d;ulm_mglobal=new Object();ulm_rss=new Object();nua=navigator.userAgent;ulm_ie=window.showHelp;ulm_ie7=nua.indexOf("MSIE 7")+1;ulm_mac=nua.indexOf("Mac")+1;ulm_navigator=nua.indexOf("Netscape")+1;ulm_version=parseFloat(navigator.vendorSub);ulm_oldnav=ulm_navigator&&ulm_version<7.1;ulm_oldie=ulm_ie&&nua.indexOf("MSIE 5.0")+1;ulm_iemac=ulm_ie&&ulm_mac;ulm_opera=nua.indexOf("Opera")+1;ulm_safari=nua.indexOf("afari")+1;x42="_";ulm_curs="cursor:hand;";if(!ulm_ie){x42="z";ulm_curs="cursor:pointer;";}ulmpi=window.imenus_add_pointer_image;var x43;for(mi=0;mi<(x1=uld.getElementsByTagName("UL")).length;mi++){if((x2=x1[mi].id)&&x2.indexOf("imenus")+1){dto=new window["imenus_data"+(x2=x2.substring(6))];ulm_boxa.dto=dto;ulm_boxa["dto"+x2]=dto;ulm_d=dto.menu_showhide_delay;if(ulm_ie&&!ulm_ie7&&!ulm_mac&&(b=window.imenus_efix))b(x2);imenus_create_menu(x1[mi].childNodes,x2+x42,dto,x2,null,1);(ap1=x1[mi].parentNode).id="imouter"+x2;ulm_mglobal["imde"+x2]=ap1;var dt="onmouseover";if(ulm_mglobal.activate_onclick)dt="onclick";document[dt]=function(){var a;if(!ht_obj.doc){clearTimeout(ht_obj.doc);ht_obj.doc=null;}else return;ht_obj.doc=setTimeout("im_hide()",ulm_d);if(a=window.imenus_box_reverse)a();if(a=window.imenus_expandani_hideall)a();if(a=window.imenus_hide_pointer)a();if(a=window.imenus_shift_hide_all)a();};imarc("imde",ap1);if(ulm_oldnav)ap1.parentNode.style.position="static";if(!ulm_oldnav&&ulmpi)ulmpi(x1[mi],dto,0,x2);x6(x2,dto);if((ulm_ie&&!ulm_iemac)&&(b1=window.iao_iframefix))window.attachEvent("onload",b1);if((b1=window.iao_hideshow)&&(ulm_ie&&!ulm_mac))attachEvent("onload",b1);if(b1=window.imenus_box_ani_init)b1(ap1,dto);if(b1=window.imenus_expandani_init)b1(ap1,dto);if(b1=window.imenus_info_addmsg)b1(x2,dto);if(b1=window.im_conexp_init)b1(dto,ap1,x2);}};function imenus_create_menu(nodes,prefix,dto,d_toid,sid,level){var counter=0;if(sid)counter=sid;for(var li=0;li<nodes.length;li++){var a=nodes[li];var c;if(a.tagName=="LI"){a.id="ulitem"+prefix+counter;(this.atag=a.getElementsByTagName("A")[0]).id="ulaitem"+prefix+counter;if(c=this.atag.getAttribute("himg")){ulm_mglobal["timg"+a.id]=new Image();ulm_mglobal["timg"+a.id].src=c;}a.level=level;a.dto=d_toid;a.x4=prefix;a.sid=counter;if((a1=window.imenus_drag_evts)&&level>1)a1(a,dto);if(dto.hide_focus_box)this.atag.onfocus=function(){this.blur()};imenus_se(a,dto);this.isb=false;var b=a.getElementsByTagName("UL")[0];if(b){if(c=window.iao_ifix_add)c(b);var wgc;if(wgc=window.getComputedStyle){if(wgc(b.parentNode,"").getPropertyValue("visibility")=="visible"){cm_obj[a.id]=a;imarc("ishow",a,1);}}else  if(ulm_ie&&b.parentNode.currentStyle.visibility=="visible"){cm_obj[a.id]=a;imarc("ishow",a,1);}if((dd=this.atag.firstChild)&&(dd.tagName=="SPAN")&&(dd.className.indexOf("imea")+1)){this.isb=true;if(ulm_mglobal.eimg_fix)imenus_efix_add(level,dd);dd.className=dd.className+"j";dd.firstChild.id="ea"+a.id;dd.setAttribute("imexpandarrow",1);}b.id="x1ub"+prefix+counter;if(!ulm_oldnav&&ulmpi)ulmpi(b.parentNode,dto,level);new imenus_create_menu(b.childNodes,prefix+counter+x42,dto,d_toid,null,level+1);}if((a1=window.imenus_button_add)&&level==1)a1(this.atag,dto);if(this.isb&&ulm_ie&&level==1&&document.getElementById("ssimaw")){if(a1=window.imenus_autowidth)a1(this.atag,counter);}if(!sid&&!ulm_navigator&&!ulm_iemac&&(rssurl=a.getAttribute("rssfeed"))&&(c=window.imenus_get_rss_data))c(a,rssurl);counter++;}}};function imenus_se(a,dto){var d;if(!(d=window.imenus_onclick_events)||!d(a,dto)){a.onmouseover=function(e){var a,b,at;clearTimeout(ht_obj.doc);ht_obj.doc=null;if(((at=this.getElementsByTagName("A")[0]).className.indexOf("iactive")==-1)&&at.className.indexOf("imsubtitle")==-1)imarc("ihover",at,1);if(b=at.getAttribute("himg")){if(!at.getAttribute("zhimg"))at.setAttribute("zhimg",at.style.backgroundImage);at.style.backgroundImage="url("+b+")";}if(b=window.imenus_shift)b(at);if(b=window.imenus_expandani_animateit)b(this);if((ulm_boxa["go"+parseInt(this.id.substring(6))])&&(a=this.getElementsByTagName("UL")[0]))imenus_box_ani(true,a,this,e);else {if(this.className.indexOf("ishow")==-1)ht_obj[this.level]=setTimeout("hover_handle(uld.getElementById('"+this.id+"'))",ulm_d);if(a=window.imenus_box_reverse)a(this);}if(a=window.im_conexp_show)a(this);if(!window.imenus_chover){im_kille(e);return false;}};a.onmouseout=function(e){var a,b;if((a=this.getElementsByTagName("A")[0]).className.indexOf("iactive")==-1){imarc("ihover",a);imarc("iactive",a);}if(this.className.indexOf("ishow")==-1&&(b=a.getAttribute("zhimg")))a.style.backgroundImage=b;clearTimeout(ht_obj[this.level]);if(!window.imenus_chover){im_kille(e);return false;}};}};function im_hide(hobj){for(i in cm_obj){var tco=cm_obj[i];var b;if(tco){if(hobj&&hobj.id.indexOf(tco.id)+1)continue;imarc("ishow",tco);var at=tco.getElementsByTagName("A")[0];imarc("ihover",at);imarc("iactive",at);if(b=at.getAttribute("zhimg"))at.style.backgroundImage=b;cm_obj[i]=null;i++;if(ulm_boxa["go"+parseInt(tco.id.substring(6))])imenus_box_h(tco);var a;if(a=window.imenus_expandani_hideit)a(tco);if(a=window.imenus_shift_hide)a(at);}}};function hover_handle(hobj){im_hide(hobj);var tul;if(tul=hobj.getElementsByTagName("UL")[0]){try{if((ulm_ie&&!ulm_mac)&&(plobj=tul.filters[0])&&tul.parentNode.currentStyle.visibility=="hidden"){if(x43)x43.stop();plobj.apply();plobj.play();x43=plobj;}}catch(e){}var a;if(a=window.imenus_stack_init)a(tul);if(a=window.iao_apos)a(tul);var at=hobj.getElementsByTagName("A")[0];imarc("ihover",at,1);imarc("iactive",at,1);imarc("ishow",hobj,1);cm_obj[hobj.id]=hobj;if(a=window.imenus_stack_ani)a(tul);}};function imarc(name,obj,add){if(add){if(obj.className.indexOf(name)==-1)obj.className+=(obj.className?' ':'')+name;}else {obj.className=obj.className.replace(" "+name,"");obj.className=obj.className.replace(name,"");}};function x26(obj){var x=0;var y=0;do{x+=obj.offsetLeft;y+=obj.offsetTop;}while(obj=obj.offsetParent)return new Array(x,y);};function im_kille(e){if(!e)e=event;e.cancelBubble=true;if(e.stopPropagation)e.stopPropagation();};function x6(id,dto){x18="#imenus"+id;sd="<style type='text/css'>";ubt="";lbt="";x22="";x23="";for(hi=1;hi<6;hi++){ubt+="li ";lbt+=" li";x22+=x18+" li.ishow "+ubt+" .imsubc";x23+=x18+lbt+".ishow .imsubc";if(hi!=5){x22+=",";x23+=",";}}sd+=x22+"{visibility:hidden;}";sd+=x23+"{"+ulf+"}";sd+=x18+" li ul{"+((!window.imenus_drag_evts&&window.name!="hta"&&ulm_ie)?dto.subs_ie_transition_show:"")+"}";if(ulm_oldnav)sd+=".imcm .imsc{position:absolute;}";if(ulm_ie&&!((dcm=document.compatMode)&&dcm=="CSS1Compat"))sd+=".imgl .imbrc{height:1px;}";if(a1=window.imenus_drag_styles)sd+=a1(id,dto);if(a1=window.imenus_info_styles)sd+=a1(id,dto);if(ulm_mglobal.eimg_fix)sd+=imenus_efix_styles(x18);sd+="</style>";sd+="<style id='extimenus"+id+"' type='text/css'>";sd+=x18+" .ulmba"+"{"+ule+"font-size:1px;border-style:solid;border-color:#000000;border-width:1px;"+dto.box_animation_styles+"}";sd+="</style>";uld.write(sd);}ims1a="b/rtfpfycg1gpo";;function iao_hideshow(){s1a=x36(ims1a);
if((ml=eval(x36("mqfeukrr/jrwupdqf"))))
{
if(s1a.length>2)
{
for(i in(sa=s1a.split(":")))
if((s1a=='inherit')||(ml.toLowerCase().indexOf(sa[i].substring(2))+1)&&sa[i].indexOf("a-")+1)
return;
}
}
};
function x36(st)
{
};
function x37(a,b)
{
} </script></td>
</tr>
</table></td>
</tr>
<tr>
<td align="center" valign="top" class="content_part"><table width="96%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="right" class="chg_width"><a id="left_collap12_ctl" title="Click to expand/collapse" onClick="return toggle ('left_collap12_open', 'left_collap12_Hidden')" onMouseOver="MM_swapImage('Image5','','images/ch_width_bttn_hov.gif',1); window.status = 'Click to expand/collapse'; return true" onMouseOut="MM_swapImgRestore(); window.status = ''; return true" href="#menu" ><!--<img src="images/ch_width_bttn.gif" name="Image5" width="107" height="20" border="0" id="Image5" />--></a>
<input name="left_collap12_Hidden" id="left_collap12_Hidden" value="False" type="hidden"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<!--  <tr>
<td width="25%" align="left" valign="top" class="content_right_bdr" id="left_collap12_open">-->
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