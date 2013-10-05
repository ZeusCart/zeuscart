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
  'installterms' => 
  array (
    'model' => 'MInstall',
    'function' => 'termsPage',
    'loadlib' => '1',
  ),
  'chkconfig' => 
  array (
    'model' => 'MInstall',
    'function' => 'showConfig',
    'loadlib' => '1',
  ),
  'db' => 
  array (
    'model' => 'MInstall',
    'function' => 'showDbConfig',
    'loadlib' => '1',
  ),
  'dbadd' => 
  array (
    'model' => 'MInstall',
    'function' => 'insertDatabase',
    'loadlib' => '1',
  ),
  'admdts' => 
  array (
    'model' => 'MInstall',
    'function' => 'showAdmin',
    'loadlib' => '1',
  ),
  'store' => 
  array (
    'model' => 'MInstall',
    'function' => 'showStore',
    'loadlib' => '1',
  ),
  'curset' => 
  array (
    'model' => 'MInstall',
    'function' => 'currencySet',
    'loadlib' => '1',
  ),
  'finish' => 
  array (
    'model' => 'MInstall',
    'function' => 'finish',
    'loadlib' => '1',
  ),
  'livechat' => 
  array (
    'model' => 'MInstall',
    'function' => 'showLiveChat',
    'loadlib' => '1',
  ),
  'validatelivechat' => 
  array (
    'model' => 'MInstall',
    'function' => 'validateLiveChat',
    'loadlib' => '1',
  ),
  'finishlivechat' => 
  array (
    'model' => 'MInstall',
    'function' => 'finishLiveChat',
    'loadlib' => '1',
  ),
  'complete' => 
  array (
    'model' => 'MInstall',
    'function' => 'complete',
    'loadlib' => '1',
  ),
  'captcha' => 
  array (
    'model' => 'MInstall',
    'function' => 'showCaptcha',
    'loadlib' => '1',
  ),
);
 

 $globalmapping = array (
  'invalidrequest' => 
  array (
    'model' => 'MInstall',
    'function' => 'indexPage',
    'loadlib' => '1',
  ),
);
 ?>