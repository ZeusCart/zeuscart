<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-06 11:28:34
compiled from footer.html */ ?>
<!--Footer-->
<footer>
<div id="order_div">
<div class="container">
<div class="row-fluid">
<div class="span7"><h3>Free Shipping on orders over <span>$99</span></h3></div>
<div class="span5"><form class="form-inline" style="float:right">
<label class="checkbox">
Sign up for our Newsletter
</label>
<input type="text" class="input-small" placeholder="Enter Email Address">
<button type="submit" class="btn btn-danger">Submit</button>
</form></div>
</div></div>
</div>
<div class="ftr_cnt_area">
<div class="container">
<div class="row-fluid">
<div class="span3">
<h3>My account</h3>
<ul class="ftrlist">
<li><a href="#">My account</a></li>
<li><a href="#">Secure Shopping</a></li>
<li><a href="#">Contact us</a></li>
<li><a href="#">Advanced Search</a></li>
<li><a href="#">Addresses</a></li>
<li><a href="#">Secure Shopping</a></li>
</ul>
</div>
<div class="span3">
<h3>Extras</h3>
<ul class="ftrlist">
<li><a href="#">Brands</a></li>
<li><a href="#">Gift Vouchers</a></li>
<li><a href="#">Affiliates</a></li>
<li><a href="#">Specials</a></li>
<li><a href="#">Feature Sale</a></li>
<li><a href="#">Latest Sale</a></li>
</ul>
</div>
<div class="span3">
<h3>Information</h3>
<ul class="ftrlist">
<li><a href="#">Press Room</a></li>
<li><a href="#">Help</a></li>
<li><a href="#">Terms & Conditions</a></li>
<li><a href="#">Personal information</a></li>
<li><a href="#">Addresses</a></li>
<li><a href="#">Manufacturers</a></li>
</ul>
</div>
<div class="span3">
<h3>Connect with us</h3>
<ul class="cntwithus">
<li><img src="assets/img/phone-icn.png" alt="phone"> Call Us +001 555 801</li>
<li><img src="assets/img/mail-icn.png" alt="phone"> email@example.com</li>
<li><img src="assets/img/print-icn.png" alt="phone"> Fax +001 555 802</li>
<li><img src="assets/img/skype-icn.png" alt="phone"> Your Skype name here</li>
<li><img src="assets/img/map-icn.png" alt="phone"> Location : Bangalore</li>
</ul>
</div>
</div>
</div>
</div>
<div class="footer_inbx1" id="cpy_div">
<div class="container">
<div class="row-fluid">
<div class="span6"><p>Copyright © 2013. All rights reserved.    <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a></p></div>
<div class="span4"><img src="assets/img/payment.png" alt="payment"></div>
<div class="span2">
<ul class="sociallist">
<li><a href="#" class="in_btn"></a></li>
<li><a href="#" class="yt_btn"></a></li>
<li><a href="#" class="fb_btn"></a></li>
<li><a href="#" class="tw_btn"></a></li>
</ul>
</div>
</div>
</div>
</div>
</footer>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script src="assets/js/google-code-prettify/prettify.js"></script>
<script src="assets/js/transition.js"></script>
<script src="assets/js/alert.js"></script>
<script src="assets/js/modal.js"></script>
<script src="assets/js/dropdown.js"></script>
<script src="assets/js/scrollspy.js"></script>
<script src="assets/js/tab.js"></script>
<script src="assets/js/tooltip.js"></script>
<script src="assets/js/popover.js"></script>
<script src="assets/js/button.js"></script>
<script src="assets/js/collapse.js"></script>
<script src="assets/js/carousel.js"></script>
<script src="assets/js/typeahead.js"></script>
<script src="assets/js/application.js"></script>
<?php if ($_GET['do'] != 'index'): ?>
<script type="text/javascript">
var arr3=["account_id","details_id"];
function showAccnt(divid)
{
if(document.getElementById(divid).style.display=="none")
{
for(var i=0;i<arr3.length;i++)
{
document.getElementById(arr3[i]).style.display="none";
document.getElementById(arr3[i]+"1").className="acc_unselect";
}
viewAccnt(divid);
}
}
function viewAccnt(div_id)
{
$("#"+ div_id).fadeIn('slow');
document.getElementById(div_id+"1").className="acc_select";
}
</script>
<?php endif; ?>
<script type="text/javascript">
function selectCurrency(id)
{
$.ajax({
type: "GET",
url: "?do=changecurrency",
data: "id="+id,
success: function(result){
window.location.href=window.location.href;
}
});
}
</script>
<?php if ($_GET['do'] == 'addtocartfromproductdetail' || $_GET['do'] == 'addtocart'): ?>
<script type="text/javascript" language="javascript">
function call()
{
window.location= "?do=indexpage";
}
</script>
<?php endif; ?>
</body>
</html>
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