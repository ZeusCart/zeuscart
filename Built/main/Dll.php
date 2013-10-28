<?php 

 $system = array (
  0 => 'Bin/Security.php',
  1 => 'Bin/Smarty.php',
  2 => 'Bin/Template.php',
  3 => 'Bin/SetConfiguration.php',
  4 => 'Bin/DbConnect.php',
  5 => 'Bin/Query.php',
);


 $libraries = array (
  0 => 'classes/Lib/Validation/ErrorHandler.php',
  1 => 'classes/Lib/Validation/Methods.php',
  2 => 'classes/Lib/Validation/Handler.php',
  3 => 'classes/Lib/Components.php',
);
 

 $domapping = array (
  'indexpage' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showIndexPage',
    'loadlib' => '1',
  ),
  'login' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showLoginPage',
    'loadlib' => '1',
  ),
  'login:validatelogin' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showValidateLoginPage',
    'loadlib' => '1',
  ),
  'captcha' => 
  array (
    'model' => 'MCaptcha',
    'function' => 'showCaptcha',
    'loadlib' => '0',
  ),
  'logout' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'logoutStatus',
    'loadlib' => '1',
  ),
  'brands' => 
  array (
    'model' => 'MHome',
    'function' => 'showBrands',
    'loadlib' => '1',
  ),
  'voucher' => 
  array (
    'model' => 'MHome',
    'function' => 'showVoucher',
    'loadlib' => '1',
  ),
  'viewbrands' => 
  array (
    'model' => 'MHome',
    'function' => 'viewBrandsList',
    'loadlib' => '1',
  ),
  'viewbrands:grid' => 
  array (
    'model' => 'MHome',
    'function' => 'viewBrandsList',
    'loadlib' => '1',
  ),
  'voucher:add' => 
  array (
    'model' => 'MHome',
    'function' => 'showAddVoucher',
    'loadlib' => '1',
  ),
  'voucher:showcart' => 
  array (
    'model' => 'MHome',
    'function' => 'showCart',
    'loadlib' => '1',
  ),
  'pricecompare:compareproductprice' => 
  array (
    'model' => 'MPriceCompare',
    'function' => 'showPriceComparePage',
    'loadlib' => '1',
  ),
  'userregistration' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'displayRegPage',
    'loadlib' => '1',
  ),
  'registerconfirm' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'registerConfirm',
    'loadlib' => '1',
  ),
  'userregistration:addreg' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showValidateRegPage',
    'loadlib' => '1',
  ),
  'myprofile' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showMyProfile',
    'loadlib' => '1',
  ),
  'myprofile:updatemyprofile' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'updateMyProfile',
    'loadlib' => '1',
  ),
  'forgetpwd' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'displayForgetpwdPage',
    'loadlib' => '1',
  ),
  'forgetpwd:retrivepwd' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'retrivePwdPage',
    'loadlib' => '1',
  ),
  'twitterreg' => 
  array (
    'model' => '',
    'function' => 'twitterRegister',
    'loadlib' => 'L_ALL',
  ),
  'wishlist:showwishlist' => 
  array (
    'model' => 'MWishList',
    'function' => 'viewWishList',
    'loadlib' => '1',
  ),
  'wishlist:viewwishlist' => 
  array (
    'model' => 'MWishList',
    'function' => 'addtoWishList',
    'loadlib' => '1',
  ),
  'wishlist:deletewishlist' => 
  array (
    'model' => 'MWishList',
    'function' => 'deletefromWishList',
    'loadlib' => '1',
  ),
  'wishlist:clearwishlist' => 
  array (
    'model' => 'MWishList',
    'function' => 'clearWishList',
    'loadlib' => '1',
  ),
  'wishlist:wishlistsnapshot' => 
  array (
    'model' => 'MWishList',
    'function' => 'wishlistSnapshot',
    'loadlib' => '1',
  ),
  'compareproduct:addtocompareproduct' => 
  array (
    'model' => 'MWishList',
    'function' => 'addtoCompareProduct',
    'loadlib' => '1',
  ),
  'compareproduct:viewcompareproduct' => 
  array (
    'model' => 'MWishList',
    'function' => 'viewCompareProduct',
    'loadlib' => '1',
  ),
  'compareproduct:deletecompareproduct' => 
  array (
    'model' => 'MWishList',
    'function' => 'deleteCompareProduct',
    'loadlib' => '1',
  ),
  'compareproduct:deletecompareproductfromhome' => 
  array (
    'model' => 'MWishList',
    'function' => 'deleteCompareProductFromHome',
    'loadlib' => '1',
  ),
  'compareproduct:deleteproduct' => 
  array (
    'model' => 'MWishList',
    'function' => 'deleteProduct',
    'loadlib' => '1',
  ),
  'compareproduct:deleteallitem' => 
  array (
    'model' => 'MWishList',
    'function' => 'deleteAllItem',
    'loadlib' => '1',
  ),
  'productreview:showproductreview' => 
  array (
    'model' => 'MProductReview',
    'function' => 'showProductReview',
    'loadlib' => '1',
  ),
  'productreview:addproductreview' => 
  array (
    'model' => 'MProductReview',
    'function' => 'addProductReview',
    'loadlib' => '1',
  ),
  'productreg' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showLoginPage',
    'loadlib' => '1',
  ),
  'headermenu' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showHeaderMenu',
    'loadlib' => '1',
  ),
  'subnewsletter' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'addNewsletterSubscription',
    'loadlib' => '1',
  ),
  'termsandcondition' => 
  array (
    'model' => 'MFooterLinks',
    'function' => 'termsCondition',
    'loadlib' => '1',
  ),
  'privacypolicy' => 
  array (
    'model' => 'MFooterLinks',
    'function' => 'privacyPolicy',
    'loadlib' => '1',
  ),
  'aboutus' => 
  array (
    'model' => 'MFooterLinks',
    'function' => 'aboutUs',
    'loadlib' => '1',
  ),
  'contactus' => 
  array (
    'model' => 'MFooterLinks',
    'function' => 'showContactUs',
    'loadlib' => '1',
  ),
  'contactus:validatecontactus' => 
  array (
    'model' => 'MFooterLinks',
    'function' => 'showValidateContactUs',
    'loadlib' => '1',
  ),
  'rssfeed:newproduct' => 
  array (
    'model' => 'MRssFeed',
    'function' => 'showRssFeed',
    'loadlib' => '1',
  ),
  'rssfeed:categoryproduct' => 
  array (
    'model' => 'MRssFeed',
    'function' => 'showCategoryRssFeed',
    'loadlib' => '1',
  ),
  'rssfeed:searchqueryproduct' => 
  array (
    'model' => 'MRssFeed',
    'function' => 'showSearchQueryRssFeed',
    'loadlib' => '1',
  ),
  'showcart' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showCart',
    'loadlib' => '1',
  ),
  'showcart:showquickregistration' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showQuickRegistration',
    'loadlib' => '1',
  ),
  'showcart:doquickregistration' => 
  array (
    'model' => 'MAddCart',
    'function' => 'doQuickRegistration',
    'loadlib' => '1',
  ),
  'showcart:recipientdetails' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showRecipientDetails',
    'loadlib' => '1',
  ),
  'showcart:getaddressdetails' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showBillingDetails',
    'loadlib' => '1',
  ),
  'showcart:validatebillingaddress' => 
  array (
    'model' => 'MAddCart',
    'function' => 'validateBillingAddress',
    'loadlib' => '1',
  ),
  'showcart:getshippingaddressdetails' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showShippingDetails',
    'loadlib' => '1',
  ),
  'showcart:validateshippingaddress' => 
  array (
    'model' => 'MAddCart',
    'function' => 'validateShippingAddress',
    'loadlib' => '1',
  ),
  'showcart:getshippingmethod' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showShippingMethod',
    'loadlib' => '1',
  ),
  'showcart:validateshippingmethod' => 
  array (
    'model' => 'MAddCart',
    'function' => 'validateShippingMethod',
    'loadlib' => '1',
  ),
  'showcart:addnewaddressfromshipping' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showAddNewAddressFromShipping',
    'loadlib' => '1',
  ),
  'showcart:showorderconfirmation' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showOrderConfirmation',
    'loadlib' => '1',
  ),
  'showcart:displaypaymentgateways' => 
  array (
    'model' => 'MAddCart',
    'function' => 'displayPaymentGateways',
    'loadlib' => '1',
  ),
  'showcart:validatecoupon' => 
  array (
    'model' => 'MAddCart',
    'function' => 'validateCoupon',
    'loadlib' => '1',
  ),
  'addtocart' => 
  array (
    'model' => 'MAddCart',
    'function' => 'addCart',
    'loadlib' => '1',
  ),
  'addtocartfromproductdetail' => 
  array (
    'model' => 'MAddCart',
    'function' => 'addCartFromProductDetail',
    'loadlib' => '1',
  ),
  'addtocart:delete' => 
  array (
    'model' => 'MAddCart',
    'function' => 'deleteCart',
    'loadlib' => '1',
  ),
  'addtocart:update' => 
  array (
    'model' => 'MAddCart',
    'function' => 'updateCart',
    'loadlib' => '1',
  ),
  'showcart:showauthorizenet' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showPaymentPageForAuthorizenet',
    'loadlib' => '1',
  ),
  'showcart:doauthorizenetpayment' => 
  array (
    'model' => 'MAddCart',
    'function' => 'doPaymentForAuthorizenet',
    'loadlib' => '1',
  ),
  'showcart:showworldpay' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showPaymentPageForWorldPay',
    'loadlib' => '1',
  ),
  'showcart:show2checkout' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showPaymentPageFor2Checkout',
    'loadlib' => '1',
  ),
  'showcart:showbluepay' => 
  array (
    'model' => 'MAddCart',
    'function' => 'showPaymentPageForBluepay',
    'loadlib' => '1',
  ),
  'featured' => 
  array (
    'model' => 'MFeaturedItems',
    'function' => 'showFeaturedItems',
    'loadlib' => '1',
  ),
  'featured:showfeaturedproduct' => 
  array (
    'model' => 'MFeaturedItems',
    'function' => 'showFeaturedProduct',
    'loadlib' => '1',
  ),
  'featured:showmaincatfeaturedproduct' => 
  array (
    'model' => 'MFeaturedItems',
    'function' => 'showMaincatFeaturedProduct',
    'loadlib' => '1',
  ),
  'featured:showmaincatlanding' => 
  array (
    'model' => 'MFeaturedItems',
    'function' => 'showMainCatLanding',
    'loadlib' => '1',
  ),
  'last' => 
  array (
    'model' => 'MLastViewedProducts',
    'function' => 'lastViewedProducts',
    'loadlib' => '1',
  ),
  'newproduct' => 
  array (
    'model' => 'MNewProducts',
    'function' => 'newProducts',
    'loadlib' => '1',
  ),
  'viewproducts' => 
  array (
    'model' => 'MNewProducts',
    'function' => 'viewProducts',
    'loadlib' => '1',
  ),
  'girdviewproducts' => 
  array (
    'model' => 'MNewProducts',
    'function' => 'girdViewProducts',
    'loadlib' => '1',
  ),
 'giftproducts' => 
  array (
    'model' => 'MNewProducts',
    'function' => 'giftProducts',
    'loadlib' => '1',
  ),
'girdgiftproducts' => 
  array (
    'model' => 'MNewProducts',
    'function' => 'gridGiftProducts',
    'loadlib' => '1',
  ),
  'prodetail' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'prodetail:showprod' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'productDetail',
    'loadlib' => '1',
  ),
  'prodetail:sendproduct' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'sendProduct',
    'loadlib' => '1',
  ),
  'prodetail:largeview' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'showLargeview',
    'loadlib' => '1',
  ),
  'prodetail:showpopupprod' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'showPopupProducts',
    'loadlib' => '1',
  ),
  'search' => 
  array (
    'model' => 'MKeywordSearch',
    'function' => 'keywordsearch',
    'loadlib' => '1',
  ),
  'search:grid' => 
  array (
    'model' => 'MKeywordSearch',
    'function' => 'keywordsearch',
    'loadlib' => '1',
  ),
  'search:narrowsearch' => 
  array (
    'model' => 'MKeywordSearch',
    'function' => 'narrowSearch',
    'loadlib' => '1',
  ),
  'search:pricerange' => 
  array (
    'model' => 'MKeywordSearch',
    'function' => 'priceRangeSearch',
    'loadlib' => '1',
  ),
  'search:extendedsearch' => 
  array (
    'model' => 'MKeywordSearch',
    'function' => 'extendedSearch',
    'loadlib' => '1',
  ),
  'narrowsearch' => 
  array (
    'model' => 'MNarrowSearch',
    'function' => 'narrowSearch',
    'loadlib' => '1',
  ),
  'categorylist' => 
  array (
    'model' => 'MCategoryList',
    'function' => 'catagoryList',
    'loadlib' => '1',
  ),
  'paymentgateway' => 
  array (
    'model' => 'MPaymentGateways',
    'function' => 'optPaymentMode',
    'loadlib' => '1',
  ),
  'paymentgateway:success' => 
  array (
    'model' => 'MPaymentGateways',
    'function' => 'success',
    'loadlib' => '1',
  ),
  'paymentgateway:failure' => 
  array (
    'model' => 'MPaymentGateways',
    'function' => 'failure',
    'loadlib' => '1',
  ),
  'newsletter' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showNewsLetter',
    'loadlib' => '1',
  ),
  'newsletter:add' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'addNewsLetter',
    'loadlib' => '1',
  ),
  'dashboard' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showDashBoard',
    'loadlib' => '1',
  ),
  'accountinfo' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showAccountInfo',
    'loadlib' => '1',
  ),
  'accountinfo:add' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'editAccountInfo',
    'loadlib' => '1',
  ),
  'changepassword' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showChangePassword',
    'loadlib' => '1',
  ),
  'changepassword:update' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'editChangePassword',
    'loadlib' => '1',
  ),
  'orders' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showProductReview',
    'loadlib' => '1',
  ),
  'wishlist' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showWishList',
    'loadlib' => '1',
  ),
  'wishlist:send' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'sendWishList',
    'loadlib' => '1',
  ),
  'myorder' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showMyOrder',
    'loadlib' => '1',
  ),
  'addressbook' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showMyAddressBook',
    'loadlib' => '1',
  ),
  'addressbook:view' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showAddress',
    'loadlib' => '1',
  ),
  'addaddress' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showAddAddress',
    'loadlib' => '1',
  ),
  'addaddress:add' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'addAddress',
    'loadlib' => '1',
  ),
  'addaddress:edit' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'editAddress',
    'loadlib' => '1',
  ),
  'deladdress' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'delAddress',
    'loadlib' => '1',
  ),
  'digitdown' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showDigitalProduct',
    'loadlib' => '1',
  ),
  'prodown' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'CheckDigitalProduct',
    'loadlib' => '1',
  ),
  'quickinfo' => 
  array (
    'model' => 'MQuickInfo',
    'function' => 'showQuickInfo',
    'loadlib' => '1',
  ),
  'allNew' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showAllNew',
    'loadlib' => '1',
  ),
  'orderdetail' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showOrderDetails',
    'loadlib' => '1',
  ),
  'orderdetail:print' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'printOrderDetails',
    'loadlib' => '1',
  ),
  'faq' => 
  array (
    'model' => 'MFaq',
    'function' => 'showFaq',
    'loadlib' => '1',
  ),
  'allFeatured' => 
  array (
    'model' => 'MUserAccount',
    'function' => 'showAllFeatured',
    'loadlib' => '1',
  ),
  'sitemap' => 
  array (
    'model' => 'MSiteMap',
    'function' => 'showMap',
    'loadlib' => '1',
  ),
  'rss' => 
  array (
    'model' => 'MRss',
    'function' => 'showRss',
    'loadlib' => '1',
  ),
  'getdefaultcurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'getDefaultCurrency',
    'loadlib' => '1',
  ),
  'changecurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'changeCurrency',
    'loadlib' => '1',
  ),
  'morenews' => 
  array (
    'model' => 'MNews',
    'function' => 'showNewsPage',
    'loadlib' => '1',
  ),
  'test' => 
  array (
    'model' => 'MHome',
    'function' => 'showTest',
    'loadlib' => '1',
  ),
 'showcart:calculateshipcost' => 
  array (
    'model' => 'MAddCart',
    'function' => 'calculateshipcost',
    'loadlib' => '1',
  ),
);
 

 $globalmapping = array (
  'invalidrequest' => 
  array (
    'model' => 'MUserRegistration',
    'function' => 'showIndexPage',
    'loadlib' => '1',
  ),
);
 ?>