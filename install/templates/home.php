<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZeusCart Version 2.3 - Installation Wizard</title>
<link href="css/install.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onload="MM_preloadImages('images/cancel_bttn_hov.gif')">
<center>
  <div id="main">
    <div id="left">
      <div class="menu"> <?php echo $menus;?> </div>
    </div>
    <div id="right">
      <form name="frm" method="post" action="<?php echo $next ?>">
        <div id="display">
          <?php include($template); ?>
        </div>
        <div id="button">
          <?php if($shownavigation==3) { ?>
          &nbsp;
          <input type="image" src="images/next_bttn.gif"/>
          <?php } 
	   else if($shownavigation==1) { ?>
          &nbsp;<a href=" <?php echo $prv ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/previous_bttn_hov.gif',1)" style="text-decoration:none"><img src="images/previous_bttn.gif" alt="previous" name="Image4" width="73" height="23" border="0" id="Image4" /></a>&nbsp;
          <input type="image" src="images/next_bttn.gif" />
          <?php } 
	    else if($shownavigation==2)
	  {
	  ?>
          &nbsp;&nbsp;&nbsp;<a href="../" target="_blank"><img src="images/go_store.gif" alt="Go to Store" width="150" height="23" border="0" /></a> &nbsp;&nbsp; <a href="../admin" target="_blank"><img src="images/admin_area.gif" alt="Go to Control Panel" width="176" height="23" border="0" /></a>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</center>
</body>
</html>
