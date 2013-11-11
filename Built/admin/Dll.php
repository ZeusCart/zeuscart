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
  '' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'showIndexPage',
    'loadlib' => '1',
  ),
  'adword' => 
  array (
    'model' => 'MAdWord',
    'function' => 'showAdword',
    'loadlib' => '1',
  ),
  'adword:export' => 
  array (
    'model' => 'MAdWord',
    'function' => 'exportTSV',
    'loadlib' => '1',
  ),
  'adminlogin' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'showIndexPage',
    'loadlib' => '1',
  ),
  'adminlogin:showpage' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'forgetPasswordPage',
    'loadlib' => '1',
  ),
  'adminlogin:sendmail' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'forgetPassword',
    'loadlib' => '1',
  ),
  'adminlogin:validatelogin' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'showValidateLoginPage',
    'loadlib' => '1',
  ),
  'adminlogout' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'logoutStatus',
    'loadlib' => '1',
  ),
  'adminproductreview' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'showReviewPage',
    'loadlib' => '1',
  ),
  'adminproductreview:search' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'searchReviewDetails',
    'loadlib' => '1',
  ),
  'adminproductreview:accept' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'reviewAcceptStatus',
    'loadlib' => '1',
  ),
  'adminproductreview:deny' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'reviewDenyStatus',
    'loadlib' => '1',
  ),
  'adminproductreview:delete' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'deleteReview',
    'loadlib' => '1',
  ),
  'adminproductreview:autoc' => 
  array (
    'model' => 'MAdminProductReview',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'adminadduser:addreg' => 
  array (
    'model' => 'MAdminAddUsrRegistration',
    'function' => 'showValidateRegPage',
    'loadlib' => '1',
  ),
  'adminadduser' => 
  array (
    'model' => 'MAdminAddUsrRegistration',
    'function' => 'displayRegPage',
    'loadlib' => '1',
  ),
  'adminreg' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'showRegistrationPage',
    'loadlib' => '1',
  ),
  'deletereg:delete' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'deleteRegistration',
    'loadlib' => '1',
  ),
  'editreg:edit' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'editRegistration',
    'loadlib' => '1',
  ),
  'updatereg:update' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'updateRegistration',
    'loadlib' => '1',
  ),
  'adminreg:autoc' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'custreport' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'customerExportReport',
    'loadlib' => '1',
  ),
  'userdetail:search' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'searchUserDetails',
    'loadlib' => '1',
  ),
  'regstatus:accept' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'registrationAcceptStatus',
    'loadlib' => '1',
  ),
  'regstatus:deny' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'registrationDenyStatus',
    'loadlib' => '1',
  ),
  'excelreport' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'userReport',
    'loadlib' => '1',
  ),
  'showcse' => 
  array (
    'model' => 'MAdminAddUsrRegistration',
    'function' => 'showCse',
    'loadlib' => '1',
  ),
  'savecse' => 
  array (
    'model' => 'MAdminAddUsrRegistration',
    'function' => 'saveCse',
    'loadlib' => '1',
  ),
  'addUserAccountLight' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'displayRegPageLight',
    'loadlib' => '1',
  ),
  'addUserAccountLight:addreg' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'showValidateRegPageLight',
    'loadlib' => '1',
  ),
  'homepage' => 
  array (
    'model' => 'MHome',
    'function' => 'homePage',
    'loadlib' => '1',
  ),
  'home' => 
  array (
    'model' => 'MAdminHome',
    'function' => 'homePage',
    'loadlib' => '1',
  ),
  'site' => 
  array (
    'model' => 'MSiteSettings',
    'function' => 'siteSettings',
    'loadlib' => '1',
  ),
  'site:update' => 
  array (
    'model' => 'MSiteSettings',
    'function' => 'updatesiteSettings',
    'loadlib' => '1',
  ),
  'domainname' => 
  array (
    'model' => 'MDomainName',
    'function' => 'domainName',
    'loadlib' => '1',
  ),
  'domainname:update' => 
  array (
    'model' => 'MDomainName',
    'function' => 'updateDomainName',
    'loadlib' => '1',
  ),
  'sitemail' => 
  array (
    'model' => 'MAdminEmailSettings',
    'function' => 'siteEmail',
    'loadlib' => '1',
  ),
  'sitemail:update' => 
  array (
    'model' => 'MAdminEmailSettings',
    'function' => 'updateSiteEmail',
    'loadlib' => '1',
  ),
  'sitelogo' => 
  array (
    'model' => 'MSiteLogo',
    'function' => 'siteLogo',
    'loadlib' => '1',
  ),
  'sitelogo:update' => 
  array (
    'model' => 'MSiteLogo',
    'function' => 'updateSiteLogo',
    'loadlib' => '1',
  ),
  'banner' => 
  array (
    'model' => 'MHomePageBanner',
    'function' => 'homePageBanner',
    'loadlib' => '1',
  ),
  'banner:update' => 
  array (
    'model' => 'MHomePageBanner',
    'function' => 'updateHomePageBanner',
    'loadlib' => '1',
  ),
  'banner:delete' => 
  array (
    'model' => 'MHomePageBanner',
    'function' => 'deleteHomePageBanner',
    'loadlib' => '1',
  ),
  'timezone' => 
  array (
    'model' => 'MTimeZone',
    'function' => 'timeZone',
    'loadlib' => '1',
  ),
  'timezone:update' => 
  array (
    'model' => 'MTimeZone',
    'function' => 'updateTimeZone',
    'loadlib' => '1',
  ),
  'ganalytics' => 
  array (
    'model' => 'MGoogleAnalytics',
    'function' => 'googleAnalytics',
    'loadlib' => '1',
  ),
  'ganalytics:update' => 
  array (
    'model' => 'MGoogleAnalytics',
    'function' => 'updateGoogleAnalytics',
    'loadlib' => '1',
  ),
  'gadsense' => 
  array (
    'model' => 'MGoogleAdSense',
    'function' => 'googleAdSenseCode',
    'loadlib' => '1',
  ),
  'gadsense:update' => 
  array (
    'model' => 'MGoogleAdSense',
    'function' => 'updateGoogleAdSenseCode',
    'loadlib' => '1',
  ),
  'createpage' => 
  array (
    'model' => 'MCreatePage',
    'function' => 'displayCreatePageSettings',
    'loadlib' => '1',
  ),
  'createpage:createnewpage' => 
  array (
    'model' => 'MCreatePage',
    'function' => 'createNewPage',
    'loadlib' => '1',
  ),
  'createpage:deletepage' => 
  array (
    'model' => 'MCreatePage',
    'function' => 'deleteCustomPage',
    'loadlib' => '1',
  ),
  'createpage:add' => 
  array (
    'model' => 'MCreatePage',
    'function' => 'addPageSettings',
    'loadlib' => '1',
  ),
  'createpage:update' => 
  array (
    'model' => 'MCreatePage',
    'function' => 'updateStatus',
    'loadlib' => '1',
  ),
  'dynamiccms' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'createDymnaicPage',
    'loadlib' => '1',
  ),
  'dynamiccms:add' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'addDynamicPageSettings',
    'loadlib' => '1',
  ),
  'dynamiccms:show' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'showDynamicCmsList',
    'loadlib' => '1',
  ),
  'dynamiccms:edit' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'showEditDynamicCms',
    'loadlib' => '1',
  ),
  'dynamiccms:update' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'updateEditDynamicCms',
    'loadlib' => '1',
  ),
  'dynamiccms:delete' => 
  array (
    'model' => 'MDynamicCms',
    'function' => 'deleteDynamicCms',
    'loadlib' => '1',
  ),
  'sociallink' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'displaySocialLinks',
    'loadlib' => '1',
  ),
  'sociallink:create' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'createNewSocialLink',
    'loadlib' => '1',
  ),
  'sociallink:delete' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'deleteSocialLink',
    'loadlib' => '1',
  ),
  'sociallink:add' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'addSocialLink',
    'loadlib' => '1',
  ),
  'sociallink:edit' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'showEditSocialLink',
    'loadlib' => '1',
  ),
  'sociallink:update' => 
  array (
    'model' => 'MSocialLinks',
    'function' => 'updateSocialLink',
    'loadlib' => '1',
  ),
  'terms' => 
  array (
    'model' => 'MTermsCondition',
    'function' => 'selectTerms',
    'loadlib' => '1',
  ),
  'terms:updateterms' => 
  array (
    'model' => 'MTermsCondition',
    'function' => 'updateTerms',
    'loadlib' => '1',
  ),
  'adminprivacypolicy' => 
  array (
    'model' => 'MPrivacyPolicy',
    'function' => 'selectPrivacyPolicy',
    'loadlib' => '1',
  ),
  'adminprivacypolicy:updateprivacy' => 
  array (
    'model' => 'MPrivacyPolicy',
    'function' => 'updatePrivacyPolicy',
    'loadlib' => '1',
  ),
  'copyrights' => 
  array (
    'model' => 'MCopyrights',
    'function' => 'displayCopyrights',
    'loadlib' => '1',
  ),
  'copyrights:updatecopyrights' => 
  array (
    'model' => 'MCopyrights',
    'function' => 'updateCopyrights',
    'loadlib' => '1',
  ),
  'showcat' => 
  array (
    'model' => 'MCategory',
    'function' => 'showCat',
    'loadlib' => '1',
  ),
  'addcrossproduct' => 
  array (
    'model' => 'MAddCrossProducts',
    'function' => 'showCategory',
    'loadlib' => '1',
  ),
  'addcrossproduct:showsubcat' => 
  array (
    'model' => 'MAddCrossProducts',
    'function' => 'showSubCategory',
    'loadlib' => '1',
  ),
  'addcrossproduct:showproducts' => 
  array (
    'model' => 'MAddCrossProducts',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'addcrossproduct:updateProducts' => 
  array (
    'model' => 'MAddCrossProducts',
    'function' => 'updateProducts',
    'loadlib' => '1',
  ),
  'selectcategory' => 
  array (
    'model' => 'MCategorySelection',
    'function' => 'showCategory',
    'loadlib' => '1',
  ),
  'selectcategory:showsubcat' => 
  array (
    'model' => 'MCategorySelection',
    'function' => 'showSubCategory',
    'loadlib' => '1',
  ),
  'selectcategory:showproducts' => 
  array (
    'model' => 'MCategorySelection',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'selectcategory:updateProducts' => 
  array (
    'model' => 'MCategorySelection',
    'function' => 'updateProducts',
    'loadlib' => '1',
  ),
  'addmaincategory' => 
  array (
    'model' => 'MAddMainCategory',
    'function' => 'addMainCategory',
    'loadlib' => '1',
  ),
  'addmaincategory:disp' => 
  array (
    'model' => 'MAddMainCategory',
    'function' => 'displayMainCategory',
    'loadlib' => '1',
  ),
  'addmaincategory:edit' => 
  array (
    'model' => 'MAddMainCategory',
    'function' => 'editMainCategory',
    'loadlib' => '1',
  ),
  'addmaincategory:delete' => 
  array (
    'model' => 'MAddMainCategory',
    'function' => 'deleteMainCategory',
    'loadlib' => '1',
  ),
  'addsubcategory' => 
  array (
    'model' => 'MAddSubCategory',
    'function' => 'showCat',
    'loadlib' => '1',
  ),
  'addsubcategory:add' => 
  array (
    'model' => 'MAddSubCategory',
    'function' => 'addSubCategory',
    'loadlib' => '1',
  ),
  'addsubcategory:disp' => 
  array (
    'model' => 'MAddSubCategory',
    'function' => 'displaySubCategory',
    'loadlib' => '1',
  ),
  'addsubcategory:edit' => 
  array (
    'model' => 'MAddSubCategory',
    'function' => 'editSubCategory',
    'loadlib' => '1',
  ),
  'addsubcategory:delete' => 
  array (
    'model' => 'MAddSubCategory',
    'function' => 'deleteSubCategory',
    'loadlib' => '1',
  ),
  'attributes' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'showAttributes',
    'loadlib' => '1',
  ),
  'attributes:add' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'showAddAttributes',
    'loadlib' => '1',
  ),
  'attributes:insert' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'insertAttributes',
    'loadlib' => '1',
  ),
  'attributes:edit' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'showEditAttributes',
    'loadlib' => '1',
  ),
  'attributes:update' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'updateAttributes',
    'loadlib' => '1',
  ),
  'attributes:delete' => 
  array (
    'model' => 'MAddAttributes',
    'function' => 'deleteAttributes',
    'loadlib' => '1',
  ),
  'attributevalues' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'showAttributeValues',
    'loadlib' => '1',
  ),
  'attributevalues:add' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'showAddAttributeValues',
    'loadlib' => '1',
  ),
  'attributevalues:insert' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'insertAttributeValues',
    'loadlib' => '1',
  ),
  'attributevalues:edit' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'showEditAttributeValues',
    'loadlib' => '1',
  ),
  'attributevalues:update' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'updateAttributeValues',
    'loadlib' => '1',
  ),
  'attributevalues:delete' => 
  array (
    'model' => 'MAddAttributeValues',
    'function' => 'deleteAttributeValues',
    'loadlib' => '1',
  ),
  'skin' => 
  array (
    'model' => 'MSkin',
    'function' => 'showSkin',
    'loadlib' => '1',
  ),
  'skin:add' => 
  array (
    'model' => 'MSkin',
    'function' => 'addSkin',
    'loadlib' => '1',
  ),
  'skin:update' => 
  array (
    'model' => 'MSkin',
    'function' => 'updateSkin',
    'loadlib' => '1',
  ),
  'selectskin' => 
  array (
    'model' => 'MSelectSkin',
    'function' => 'showSkin',
    'loadlib' => '1',
  ),
  'selectskin:update' => 
  array (
    'model' => 'MSelectSkin',
    'function' => 'updateSkin',
    'loadlib' => '1',
  ),
  'footersettings' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'viewFooterLinks',
    'loadlib' => '1',
  ),
  'footersettings:createfooter' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'footersettings:add' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'addLinkSettings',
    'loadlib' => '1',
  ),
  'footersettings:edit' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'editFooterLinks',
    'loadlib' => '1',
  ),
  'footersettings:update' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'updateFooterLinks',
    'loadlib' => '1',
  ),
  'footersettings:delete' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'deleteFooterLinks',
    'loadlib' => '1',
  ),
  'updatefootersettings:connect' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'updateConnectWithUs',
    'loadlib' => '1',
  ),
  'footersettings:connect' => 
  array (
    'model' => 'MFooterSettings',
    'function' => 'viewConnectWithUs',
    'loadlib' => '1',
  ),
  'headersettings' => 
  array (
    'model' => 'MHeaderSettings',
    'function' => 'showHeaderLink',
    'loadlib' => '1',
  ),
  'contents:add' => 
  array (
    'model' => 'MContentManagement',
    'function' => 'addContent',
    'loadlib' => '1',
  ),
  'contents' => 
  array (
    'model' => 'MContentManagement',
    'function' => 'showContent',
    'loadlib' => '1',
  ),
  'customheader' => 
  array (
    'model' => 'MCustomHeader',
    'function' => 'showCustomHeader',
    'loadlib' => '1',
  ),
  'customheader:update' => 
  array (
    'model' => 'MCustomHeader',
    'function' => 'updateCustomHeader',
    'loadlib' => '1',
  ),
  'aboutus' => 
  array (
    'model' => 'MAboutUs',
    'function' => 'showAboutUs',
    'loadlib' => '1',
  ),
  'aboutus:update' => 
  array (
    'model' => 'MAboutUs',
    'function' => 'updateAboutUs',
    'loadlib' => '1',
  ),
  'showcontents' => 
  array (
    'model' => 'MShowContents',
    'function' => 'showContents',
    'loadlib' => '1',
  ),
  'showcontents:disp' => 
  array (
    'model' => 'MShowContents',
    'function' => 'displayContents',
    'loadlib' => '1',
  ),
  'showcontents:show' => 
  array (
    'model' => 'MShowContents',
    'function' => 'showContentsDetail',
    'loadlib' => '1',
  ),
  'showcontents:edit' => 
  array (
    'model' => 'MShowContents',
    'function' => 'editContents',
    'loadlib' => '1',
  ),
  'showcontents:delete' => 
  array (
    'model' => 'MShowContents',
    'function' => 'deleteContents',
    'loadlib' => '1',
  ),
  'mailmessages' => 
  array (
    'model' => 'MMailMessageSettings',
    'function' => 'showMailMessages',
    'loadlib' => '1',
  ),
  'mailmessages:disp' => 
  array (
    'model' => 'MMailMessageSettings',
    'function' => 'displayMessage',
    'loadlib' => '1',
  ),
  'mailmessages:edit' => 
  array (
    'model' => 'MMailMessageSettings',
    'function' => 'editMessage',
    'loadlib' => '1',
  ),
  'newsletter' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'newNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:show' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'showNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:add' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'addNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:disp' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'viewNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:edit' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'editNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:delete' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'deleteNewsletter',
    'loadlib' => '1',
  ),
  'newsletter:send' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'getEmailIds',
    'loadlib' => '1',
  ),
  'newsletter:subscrib' => 
  array (
    'model' => 'MNewsletterSettings',
    'function' => 'subscribedUsers',
    'loadlib' => '1',
  ),
  'managecategory' => 
  array (
    'model' => 'MCategoryManagement',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'managecategory:add' => 
  array (
    'model' => 'MCategoryManagement',
    'function' => 'addMainCategory',
    'loadlib' => '1',
  ),
  'managecategory:preview' => 
  array (
    'model' => 'MCategoryManagement',
    'function' => 'showPreview',
    'loadlib' => '1',
  ),
  'managecategory:selectsubchild' => 
  array (
    'model' => 'MCategoryManagement',
    'function' => 'selectSubChild',
    'loadlib' => '1',
  ),
  'showmain' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'showMainCategory',
    'loadlib' => '1',
  ),
  'showmain:disp' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'displayMainCategory',
    'loadlib' => '1',
  ),
  'showmain:edit' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'editMainCategory',
    'loadlib' => '1',
  ),
  'showmain:delete' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'deleteMainCategory',
    'loadlib' => '1',
  ),
  'showmain:search' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'searchMainCategory',
    'loadlib' => '1',
  ),
  'showmain:autoc' => 
  array (
    'model' => 'MShowMainCategory',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'showsub' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'showMainCategory',
    'loadlib' => '1',
  ),
  'showsub:show' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'showSubCategory',
    'loadlib' => '1',
  ),
  'showsub:disp' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'displaySubCategory',
    'loadlib' => '1',
  ),
  'showsub:edit' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'editSubCategory',
    'loadlib' => '1',
  ),
  'showsub:delete' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'deleteSubCategory',
    'loadlib' => '1',
  ),
  'showsub:search' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'searchSubCategory',
    'loadlib' => '1',
  ),
  'showsubundercat:show' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'showSubUnderSubCategory',
    'loadlib' => '1',
  ),
  'showsubundercat:edit' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'editSubUnderSubCategory',
    'loadlib' => '1',
  ),
  'showsubundercat:disp' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'displaySubUnderSubCategory',
    'loadlib' => '1',
  ),
  'showsubundercat:delete' => 
  array (
    'model' => 'MShowSubCategory',
    'function' => 'deleteSubUnderSubCategory',
    'loadlib' => '1',
  ),
  'manageproducts' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'showCategory',
    'loadlib' => '1',
  ),
  'manageproducts:showsubcat' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'showSubCategory',
    'loadlib' => '1',
  ),
  'manageproducts:showproducts' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'manageproducts:updateProducts' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'updateProducts',
    'loadlib' => '1',
  ),
  'manageproducts:delete' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'deleteProduct',
    'loadlib' => '1',
  ),
  'manageproducts:editprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'editProduct',
    'loadlib' => '1',
  ),
  'manageproducts:updateprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'updateProduct',
    'loadlib' => '1',
  ),
  'manageproducts:search' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'searchProductDetails',
    'loadlib' => '1',
  ),
  'manageproducts:gettitle' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'getTitle',
    'loadlib' => '1',
  ),
  'manageproducts:autoc' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'manageproducts:digiteditprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'editDigitalProduct',
    'loadlib' => '1',
  ),
  'manageproducts:updatedigitprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'updateDigitalProduct',
    'loadlib' => '1',
  ),
  'manageproducts:gifteditprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'editGiftProduct',
    'loadlib' => '1',
  ),
  'manageproducts:updategiftprod' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'updateGiftProduct',
    'loadlib' => '1',
  ),
  'manageproducts:productalias' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'checkProdcutAlias',
    'loadlib' => '1',
  ),
  'manageproducts:productsku' => 
  array (
    'model' => 'MManageProducts',
    'function' => 'checkProductSku',
    'loadlib' => '1',
  ),
  'selectfeatured' => 
  array (
    'model' => 'MSelectFeaturedItems',
    'function' => 'showCategory',
    'loadlib' => '1',
  ),
  'selectfeatured:showsubcat' => 
  array (
    'model' => 'MSelectFeaturedItems',
    'function' => 'showSubCategory',
    'loadlib' => '1',
  ),
  'selectfeatured:showproducts' => 
  array (
    'model' => 'MSelectFeaturedItems',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'selectfeatured:updateProducts' => 
  array (
    'model' => 'MSelectFeaturedItems',
    'function' => 'updateProducts',
    'loadlib' => '1',
  ),
  'aprodetail' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'showProducts',
    'loadlib' => '1',
  ),
  'aprodetail:showprod' => 
  array (
    'model' => 'MProductDetail',
    'function' => 'productDetail',
    'loadlib' => '1',
  ),
  'googleproduct' => 
  array (
    'model' => 'MGoogleBase',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'googleproduct:export' => 
  array (
    'model' => 'MGoogleBase',
    'function' => 'googleProduct',
    'loadlib' => '1',
  ),
  'cse' => 
  array (
    'model' => 'MCse',
    'function' => 'showCse',
    'loadlib' => '1',
  ),
  'cse:savecse' => 
  array (
    'model' => 'MCse',
    'function' => 'saveCse',
    'loadlib' => '1',
  ),
  'adminpayment' => 
  array (
    'model' => 'MAdminPaymentGateway',
    'function' => 'paymentSelection',
    'loadlib' => '1',
  ),
  'adminpayment:edit' => 
  array (
    'model' => 'MAdminPaymentGateway',
    'function' => 'editSelection',
    'loadlib' => '1',
  ),
  'adminpayment:update' => 
  array (
    'model' => 'MAdminPaymentGateway',
    'function' => 'updateSelection',
    'loadlib' => '1',
  ),
  'adminpayment:insert' => 
  array (
    'model' => 'MAdminPaymentGateway',
    'function' => 'insertPayment',
    'loadlib' => '1',
  ),
  'adminpayment:delete' => 
  array (
    'model' => 'MAdminPaymentGateway',
    'function' => 'deletePayment',
    'loadlib' => '1',
  ),
  'subadminmgt' => 
  array (
    'model' => 'MSubAdminManagement',
    'function' => 'dispSubAdmin',
    'loadlib' => '1',
  ),
  'subadminmgt:edit' => 
  array (
    'model' => 'MSubAdminManagement',
    'function' => 'editSubAdmin',
    'loadlib' => '1',
  ),
  'subadminmgt:update' => 
  array (
    'model' => 'MSubAdminManagement',
    'function' => 'updateSubAdmin',
    'loadlib' => '1',
  ),
  'subadminmgt:delete' => 
  array (
    'model' => 'MSubAdminManagement',
    'function' => 'deleteSubAdmin',
    'loadlib' => '1',
  ),
  'subadminmgt:insert' => 
  array (
    'model' => 'MSubAdminManagement',
    'function' => 'insertSubAdmin',
    'loadlib' => '1',
  ),
  'subadminrole' => 
  array (
    'model' => 'MAdminRoleManagement',
    'function' => 'displayAdminRole',
    'loadlib' => '1',
  ),
  'subadminrole:edit' => 
  array (
    'model' => 'MAdminRoleManagement',
    'function' => 'editSubAdminRole',
    'loadlib' => '1',
  ),
  'subadminrole:update' => 
  array (
    'model' => 'MAdminRoleManagement',
    'function' => 'updateSubAdminRole',
    'loadlib' => '1',
  ),
  'subadminrole:insert' => 
  array (
    'model' => 'MAdminRoleManagement',
    'function' => 'insertSubAdminRole',
    'loadlib' => '1',
  ),
  'subadminrole:delete' => 
  array (
    'model' => 'MAdminRoleManagement',
    'function' => 'deleteSubAdminRole',
    'loadlib' => '1',
  ),
  'dispcategory' => 
  array (
    'model' => 'MDisplayCategoryList',
    'function' => 'dispCategory',
    'loadlib' => '1',
  ),
  'orderstatus' => 
  array (
    'model' => 'MOrderStatusManagement',
    'function' => 'displayOrderStatus',
    'loadlib' => '1',
  ),
  'orderstatus:edit' => 
  array (
    'model' => 'MOrderStatusManagement',
    'function' => 'editOrderStatus',
    'loadlib' => '1',
  ),
  'orderstatus:update' => 
  array (
    'model' => 'MOrderStatusManagement',
    'function' => 'updateOrderStatus',
    'loadlib' => '1',
  ),
  'disporders' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'dispOrders',
    'loadlib' => '1',
  ),
  'disporders:insert' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'dispOrders',
    'loadlib' => '1',
  ),
  'disporders:detail' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'dispDetailOrders',
    'loadlib' => '1',
  ),
  'disporders:update' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'updateOrders',
    'loadlib' => '1',
  ),
  'disporders:cancel' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'cancelOrders',
    'loadlib' => '1',
  ),
  'disporders:print' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'printOrders',
    'loadlib' => '1',
  ),
  'disporders:mail' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'emailOrders',
    'loadlib' => '1',
  ),
  'disporders:delete' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'dispOrders',
    'loadlib' => '1',
  ),
  'disporders:autoc' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'disporders:viewdetail' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'viewOrderDetail',
    'loadlib' => '1',
  ),
  'disporders:calculateshipcost' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'calculateShipCost',
    'loadlib' => '1',
  ),
  'disporders:changeshipping' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'showChangeShipping',
    'loadlib' => '1',
  ),
  'displatestorders' => 
  array (
    'model' => 'MLatestOrders',
    'function' => 'dispLatestOrders',
    'loadlib' => '1',
  ),
  'productentry:productalias' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'checkProductAlias',
    'loadlib' => '1',
  ),
  'productentry:productsku' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'checkProductSku',
    'loadlib' => '1',
  ),
  'productentry' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displayEntry',
    'loadlib' => '1',
  ),
  'productentry:displaySubCategory' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displaySubCategory',
    'loadlib' => '1',
  ),
  'productentry:displaySubUnderCategory' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displaySubUnderCategory',
    'loadlib' => '1',
  ),
  'productentry:displayAttributes' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displayAttributes',
    'loadlib' => '1',
  ),
  'productentry:insert' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'insertProduct',
    'loadlib' => '1',
  ),
  'productentry:edit' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'editProductEntry',
    'loadlib' => '1',
  ),
  'productentry:search' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'searchProducts',
    'loadlib' => '1',
  ),
  'digitproductentry' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displayForDigitalEntry',
    'loadlib' => '1',
  ),
  'digitproductentry:insert' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'insertDigitalProduct',
    'loadlib' => '1',
  ),
  'giftproductentry' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'displayForGiftEntry',
    'loadlib' => '1',
  ),
  'giftproductentry:insert' => 
  array (
    'model' => 'MProductEntry',
    'function' => 'insertGiftProduct',
    'loadlib' => '1',
  ),
  'msrpmgt' => 
  array (
    'model' => 'MProductMsrpManagement',
    'function' => 'displayMsrpByQuantity',
    'loadlib' => '1',
  ),
  'msrpmgt:insert' => 
  array (
    'model' => 'MProductMsrpManagement',
    'function' => 'insertMsrpByQuantity',
    'loadlib' => '1',
  ),
  'msrpmgt:edit' => 
  array (
    'model' => 'MProductMsrpManagement',
    'function' => 'editMsrpByQuantity',
    'loadlib' => '1',
  ),
  'msrpmgt:update' => 
  array (
    'model' => 'MProductMsrpManagement',
    'function' => 'updateMsrpByQuantity',
    'loadlib' => '1',
  ),
  'msrpmgt:delete' => 
  array (
    'model' => 'MProductMsrpManagement',
    'function' => 'deleteMsrpByQuantity',
    'loadlib' => '1',
  ),
  'pagemgt' => 
  array (
    'model' => 'MPageManagement',
    'function' => 'dispPages',
    'loadlib' => '1',
  ),
  'pagemgt:delete' => 
  array (
    'model' => 'MPageManagement',
    'function' => 'deletePages',
    'loadlib' => '1',
  ),
  'pagemgt:edit' => 
  array (
    'model' => 'MPageManagement',
    'function' => 'editPages',
    'loadlib' => '1',
  ),
  'pagemgt:update' => 
  array (
    'model' => 'MPageManagement',
    'function' => 'updatePages',
    'loadlib' => '1',
  ),
  'pagemgt:insert' => 
  array (
    'model' => 'MPageManagement',
    'function' => 'insertPages',
    'loadlib' => '1',
  ),
  'productinventory' => 
  array (
    'model' => 'MProductInventoryManagement',
    'function' => 'dispInventory',
    'loadlib' => '1',
  ),
  'productinventory:insert' => 
  array (
    'model' => 'MProductInventoryManagement',
    'function' => 'insertInventory',
    'loadlib' => '1',
  ),
  'productinventory:update' => 
  array (
    'model' => 'MProductInventoryManagement',
    'function' => 'updateInventory',
    'loadlib' => '1',
  ),
  'productinventory:delete' => 
  array (
    'model' => 'MProductInventoryManagement',
    'function' => 'deleteInventory',
    'loadlib' => '1',
  ),
  'productinventory:edit' => 
  array (
    'model' => 'MProductInventoryManagement',
    'function' => 'editInventory',
    'loadlib' => '1',
  ),
  'hsbcpayment' => 
  array (
    'model' => 'MHsbcPayment',
    'function' => 'dispGetDetails',
    'loadlib' => '1',
  ),
  'productfeatures' => 
  array (
    'model' => 'MProductFeatures',
    'function' => 'dispProductFeatures',
    'loadlib' => '1',
  ),
  'productfeatures:insert' => 
  array (
    'model' => 'MProductFeatures',
    'function' => 'insertProductFeatures',
    'loadlib' => '1',
  ),
  'productfeatures:edit' => 
  array (
    'model' => 'MProductFeatures',
    'function' => 'editProductFeatures',
    'loadlib' => '1',
  ),
  'productfeatures:delete' => 
  array (
    'model' => 'MProductFeatures',
    'function' => 'deleteProductFeatures',
    'loadlib' => '1',
  ),
  'productfeatures:update' => 
  array (
    'model' => 'MProductFeatures',
    'function' => 'updateProductFeatures',
    'loadlib' => '1',
  ),
  'createpromotionalcodes' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'createPromotionalCodes',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:insert' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'insertPromotionalCodes',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:usersforcoupon' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'displayUsersForPromotionalCode',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:selectmethod' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'selectMethodToSendPromotionalCode',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:sendcoupon' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'sendCouponToSelectedUsers',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:listcoupons' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'displayPromotionalCodes',
    'loadlib' => '1',
  ),
  'createpromotionalcodes:changestatus' => 
  array (
    'model' => 'MPromotionalCodes',
    'function' => 'changeStatusForPromotionalCodes',
    'loadlib' => '1',
  ),
  'mostsearchedkeywords' => 
  array (
    'model' => 'MMostSearchedKeywords',
    'function' => 'showMostSearchedKeywords',
    'loadlib' => '1',
  ),
  'bulkupload' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'displayBulkUploader',
    'loadlib' => '1',
  ),
  'bulkupload:upload' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'uploadTsvFile',
    'loadlib' => '1',
  ),
  'bulkupload:download' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'downloadTSVSample',
    'loadlib' => '1',
  ),
  'bulkupload:imagesbulkupload' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'productImagesBulkUpload',
    'loadlib' => '1',
  ),
  'bulkupload:displayimagesbulkupload' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'displayImageBulkUploader',
    'loadlib' => '1',
  ),
  'bulkupload:downloadimagessample' => 
  array (
    'model' => 'MProductBulkUpload',
    'function' => 'downloadProductImageTSVSample',
    'loadlib' => '1',
  ),
  'catbulkupload' => 
  array (
    'model' => 'MCategoryBulkUpload',
    'function' => 'displayCatBulkUploader',
    'loadlib' => '1',
  ),
  'catbulkupload:upload' => 
  array (
    'model' => 'MCategoryBulkUpload',
    'function' => 'uploadTsvFile',
    'loadlib' => '1',
  ),
  'catbulkupload:download' => 
  array (
    'model' => 'MCategoryBulkUpload',
    'function' => 'downloadTSVSample',
    'loadlib' => '1',
  ),
  'faq' => 
  array (
    'model' => 'MFaq',
    'function' => 'showFaq',
    'loadlib' => '1',
  ),
  'faq:add' => 
  array (
    'model' => 'MFaq',
    'function' => 'addFaq',
    'loadlib' => '1',
  ),
  'faq:insert' => 
  array (
    'model' => 'MFaq',
    'function' => 'add',
    'loadlib' => '1',
  ),
  'faq:edit' => 
  array (
    'model' => 'MFaq',
    'function' => 'edit',
    'loadlib' => '1',
  ),
  'faq:delete' => 
  array (
    'model' => 'MFaq',
    'function' => 'delete',
    'loadlib' => '1',
  ),
  'activity' => 
  array (
    'model' => 'MAdminActivity',
    'function' => 'showReport',
    'loadlib' => '1',
  ),
  'deleteActivity' => 
  array (
    'model' => 'MAdminActivity',
    'function' => 'deleteActivity',
    'loadlib' => '1',
  ),
  'addUserAccount' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'displayRegPage',
    'loadlib' => '1',
  ),
  'addUserAccount:addreg' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'showValidateRegPage',
    'loadlib' => '1',
  ),
  'customerdetail:detail' => 
  array (
    'model' => 'MAdminUserRegistration',
    'function' => 'customerDetail',
    'loadlib' => '1',
  ),
  'userorder' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showOrder',
    'loadlib' => '1',
  ),
  'loadSubcat' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showSubcat',
    'loadlib' => '1',
  ),
  'loadSubUnder' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showSubUnderCat',
    'loadlib' => '1',
  ),
  'loadProduct' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showProduct',
    'loadlib' => '1',
  ),
  'loadQty' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showQty',
    'loadlib' => '1',
  ),
  'loadusermultibilladdress' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showUserMultiBillAddress',
    'loadlib' => '1',
  ),
  'loadusermultishipaddress' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showUserMultiShipAddress',
    'loadlib' => '1',
  ),
  'loaduseraddressdetails' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'showUserAddressDetails',
    'loadlib' => '1',
  ),
  'addUserProduct' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'addProduct',
    'loadlib' => '1',
  ),
  'addUserProduct:delete' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'delProduct',
    'loadlib' => '1',
  ),
  'addUserOrder:create' => 
  array (
    'model' => 'MUserOrder',
    'function' => 'createOrder',
    'loadlib' => '1',
  ),
  'auto' => 
  array (
    'model' => 'MAutoComplete',
    'function' => 'showComplete',
    'loadlib' => '1',
  ),
  'autoc' => 
  array (
    'model' => 'MAutoComplete',
    'function' => 'autoComplete',
    'loadlib' => '1',
  ),
  'orexp' => 
  array (
    'model' => 'MOrderDataExport',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'orexp:export' => 
  array (
    'model' => 'MOrderDataExport',
    'function' => 'orderDataExport',
    'loadlib' => '1',
  ),
  'prodexp' => 
  array (
    'model' => 'MProductDataExport',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'prodexp:export' => 
  array (
    'model' => 'MProductDataExport',
    'function' => 'productDataExport',
    'loadlib' => '1',
  ),
  'catexp' => 
  array (
    'model' => 'MCategoryDataExport',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'catexp:export' => 
  array (
    'model' => 'MCategoryDataExport',
    'function' => 'categoryDataExport',
    'loadlib' => '1',
  ),
  'admactexp' => 
  array (
    'model' => 'MAdminActivityDataExport',
    'function' => 'showTemplate',
    'loadlib' => '1',
  ),
  'admactexp:export' => 
  array (
    'model' => 'MAdminActivityDataExport',
    'function' => 'adminActivityDataExport',
    'loadlib' => '1',
  ),
  'taxsettings' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'showTaxSettings',
    'loadlib' => '1',
  ),
  'taxsettings:updatetaxsettings' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'updateTaxSettings',
    'loadlib' => '1',
  ),
  'taxsettings:showregionwisetaxlist' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'showCountrywiseTaxList',
    'loadlib' => '1',
  ),
  'taxsettings:addregionwisetax' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'addCountrywiseTax',
    'loadlib' => '1',
  ),
  'taxsettings:insertregionwisetax' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'insertCountrywiseTax',
    'loadlib' => '1',
  ),
  'taxsettings:editregionwisetax' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'editCountrywiseTax',
    'loadlib' => '1',
  ),
  'taxsettings:updateregionwisetax' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'updateCountrywiseTax',
    'loadlib' => '1',
  ),
  'taxsettings:deleteregionwisetax' => 
  array (
    'model' => 'MTaxSettings',
    'function' => 'deleteCountrywiseTax',
    'loadlib' => '1',
  ),
  'bestsellingproducts' => 
  array (
    'model' => 'MBestSellingProducts',
    'function' => 'showBestSellingProducts',
    'loadlib' => '1',
  ),
  'showchart' => 
  array (
    'model' => 'MChart',
    'function' => 'showChart',
    'loadlib' => '1',
  ),
  'showcurrencylist' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'showCurrencyList',
    'loadlib' => '1',
  ),
  'showaddcurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'showAddCurrency',
    'loadlib' => '1',
  ),
  'addcurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'addCurrency',
    'loadlib' => '1',
  ),
  'editcurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'showEditCurrency',
    'loadlib' => '1',
  ),
  'editcurrency:update' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'updateCurrency',
    'loadlib' => '1',
  ),
  'delcurrency' => 
  array (
    'model' => 'MCurrencySettings',
    'function' => 'deleteCurrency',
    'loadlib' => '1',
  ),
  'sitemap' => 
  array (
    'model' => 'MAdminmap',
    'function' => 'dispAdminmap',
    'loadlib' => '1',
  ),
  'getphpinfo' => 
  array (
    'model' => 'MAdminmap',
    'function' => 'getPHPInfo',
    'loadlib' => '1',
  ),
  'siteinfo' => 
  array (
    'model' => 'MAdminmap',
    'function' => 'displayPHPInfo',
    'loadlib' => '1',
  ),
  'news' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'newNews',
    'loadlib' => '1',
  ),
  'news:show' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'showNewsPage',
    'loadlib' => '1',
  ),
  'news:add' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'addNews',
    'loadlib' => '1',
  ),
  'news:disp' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'viewNews',
    'loadlib' => '1',
  ),
  'news:edit' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'editNews',
    'loadlib' => '1',
  ),
  'news:delete' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'deleteNews',
    'loadlib' => '1',
  ),
  'news:status' => 
  array (
    'model' => 'MNewsManagement',
    'function' => 'statusNews',
    'loadlib' => '1',
  ),
  'homepageads' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'showHomePageAdsList',
    'loadlib' => '1',
  ),
  'homepageads:show' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'showAddHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:add' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'insertHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:delete' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'deleteHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:edit' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'showEditHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:update' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'updateEditHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:accept' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'acceptHomePageAds',
    'loadlib' => '1',
  ),
  'homepageads:deny' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'denyEditHomePageAds',
    'loadlib' => '1',
  ),
  'homepage:content' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'showHomePageContent',
    'loadlib' => '1',
  ),
  'homepage:update' => 
  array (
    'model' => 'MHomePageAds',
    'function' => 'updateHomePageContent',
    'loadlib' => '1',
  ),
  'userinvoice:show' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'showAddnvoice',
    'loadlib' => '1',
  ),
  'userinvoice:add' => 
  array (
    'model' => 'MOrderManagement',
    'function' => 'insertInvoice',
    'loadlib' => '1',
  ),
  'menus' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'showMenuManagament',
    'loadlib' => '1',
  ),
  'menus:add' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'insertMenus',
    'loadlib' => '1',
  ),
  'menus:delete' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'deleteMenus',
    'loadlib' => '1',
  ),
  'menus:type' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'selectedMenuTypeList',
    'loadlib' => '1',
  ),
  'menus:navigation' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'insertNavigation',
    'loadlib' => '1',
  ),
  'menus:addcategory' => 
  array (
    'model' => 'MMenuManagement',
    'function' => 'addCategory',
    'loadlib' => '1',
  ),
  'custgroup' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'showCustomerGroup',
    'loadlib' => '1',
  ),
  'custgroup:search' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'ajaxCustomerGroup',
    'loadlib' => '1',
  ),
  'custgroup:add' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'displayCustGrpRegPage',
    'loadlib' => '1',
  ),
  'custgroup:insert' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'insertCustomerGroup',
    'loadlib' => '1',
  ),
  'custgroup:edit' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'editCustomerGroup',
    'loadlib' => '1',
  ),
  'custgroup:update' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'updateCustomerGroup',
    'loadlib' => '1',
  ),
  'custgroup:delete' => 
  array (
    'model' => 'MCustomerGroup',
    'function' => 'deleteCustomerGroup',
    'loadlib' => '1',
  ),
  'adminprofile' => 
  array (
    'model' => 'MAdminProfile',
    'function' => 'showAdminProfile',
    'loadlib' => '1',
  ),
  'adminprofile:update' => 
  array (
    'model' => 'MAdminProfile',
    'function' => 'updateAdminProfile',
    'loadlib' => '1',
  ),
  'livechat' => 
  array (
    'model' => 'MLiveChat',
    'function' => 'showLiveChat',
    'loadlib' => '1',
  ),
  'livechat:update' => 
  array (
    'model' => 'MLiveChat',
    'function' => 'updateLiveChat',
    'loadlib' => '1',
  ),
  'showshipmenttracker' => 
  array (
    'model' => 'MShippingTracker',
    'function' => 'displayShippingTrackerSetting',
    'loadlib' => '1',
  ),
  'showshipmenttracker:update' => 
  array (
    'model' => 'MShippingTracker',
    'function' => 'updateShippingTrackerSetting',
    'loadlib' => '1',
  ),
);
 

 $globalmapping = array (
  'invalidrequest' => 
  array (
    'model' => 'MAdminLogin',
    'function' => 'showIndexPage',
    'loadlib' => '1',
  ),
);
 ?>