<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
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
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/scroll-pan.css" rel="stylesheet" type="text/css" />
<title>ZEUS CART</title>
<style type="text/css" id="page-css">
			/* Styles specific to this particular page */
			.scroll-pane
			{
				width: 100%;
				height: 200px;
				overflow: auto;
			}
			.horizontal-only
			{
				height: auto;
				max-height: 200px;
			}
		</style>

		<!-- latest jQuery direct from google's CDN -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- the mousewheel plugin -->
		<script type="text/javascript" src="js/mouse.wheel.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/scrollpanel.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane({showArrows: true});
			});
		</script>
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

<body onload="MM_preloadImages('images/back-btn-hov.png','images/cancel-btn-hov.png','images/next-btn-hov.png')">
	<div id="main">
 <form name="frm" method="post" action="<?php echo $next ?>">
    		<!--header start here-->
            <div class="header_div">
       	    <img src="images/header.jpg" alt="AJ SHOPPING CART" /></div>
            <!--body start here-->
            <div class="body_div">
            	 <?php echo $menus;?>

                	<div class="clear"></div>

		<?php include($template); ?>

                <div class="botton_div"><table><tr><TD><span style="color:#FF0000"> <?php echo $_SESSION['error'] ?></span></TD></tr></table> <h6>  
          <?php if($shownavigation==3) { ?>
	 <input type="image" src="images/next-btn.png" alt="Next" style="width:76px;height=32px;border-style: none;padding:1px;" border="0" />

	<?php } 
	   else if($shownavigation==1) { ?>
	<a href=" <?php echo $prv ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/back-btn-hov.png',1)"><img src="images/back-btn.png" alt="Back" name="Image2" width="76" height="32" border="0" id="Image2" /></a> <input type="image" src="images/next-btn.png" alt="Next" style="width:76px;height=32px;border-style: none;padding:1px;" border="0" />

	 <?php } 
	    else if($shownavigation==2)
	  {
	  ?>

		
	<a onmouseover="MM_swapImage('Image2','','images/go-to-store-btn-hov.png',1)" onmouseout="MM_swapImgRestore()" href="../" target="_blank"><img  border="0" id="Image2" name="Image2" alt="Back" src="images/go-to-store-btn.png"></a> <a onmouseover="MM_swapImage('Image3','','images/go-to-control-panel-btn-hov.png',1)" onmouseout="MM_swapImgRestore()" href="../admin" target="_blank"><img  border="0" id="Image3" name="Image3" alt="Cancel" src="images/go-to-control-panel-btn.png"></a>
 
          <?php }   else if($shownavigation==4){?>

		<a href=" <?php echo $prv ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/back-btn-hov.png',1)"><img src="images/back-btn.png" alt="Back" name="Image2" width="76" height="32" border="0" id="Image2" /></a>&nbsp;<a href="?do=complete" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/skip-btn-hov.png',1)"><img src="images/skip-btn.png" alt="Back" name="Image2" width="76" height="32" border="0" id="Image2" /></a> <input type="image" src="images/install-btn.png" alt="Next" style="width:76px;height=32px;border-style: none;padding:1px;" border="0" />
 
          <?php } ?>	
          </h6> </div>  
                <h5>© www.zeuscart.com 2013. All Rights Reserved</h5>
          </div>
            <!--footer start here-->
            <div class="bottom_div"></div>
</form>
</div>
</body>
</html>
