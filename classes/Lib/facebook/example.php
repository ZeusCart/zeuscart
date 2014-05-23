<?php
ob_start();
session_start();
?>
<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Facebook Alerts</title>
<style type="text/css">
  #popup_div{width:460px; margin:0; padding:0;}
  #popup_div .heading{background:#6d84b4; line-height:32px; color:#fff; margin:0; padding:0 10px; font-family:Tahoma, Geneva, sans-serif; font-size:14px;}
  #popup_div .content_div{border:#ccc solid 1px; border-top:0; margin:0; padding:0;}
  #popup_div .content{margin:0; padding:10px; line-height:18px; font-size:12px; font-family:Tahoma, Geneva, sans-serif;}
  #popup_div .bottom{margin:10px 0 0 0; border-top:#ccc solid 1px; padding:10px; text-align:right;}
  .accept_bg{background:url(../../images/accept_bg.gif) top left repeat-x; padding:0 10px; border:#29447e solid 1px; color:#fff; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .accept_bg:hover{color:#000;}
  .cancel_bg{background:url(../../images/cancel_bg.gif) top left repeat-x; padding:0 10px; border:#999 solid 1px; color:#333333; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .cancel_bg:hover{color:#3b5998;}
</style>
</head>
<body style="background:none;">

<?php
require 'src/facebook.php';
$db = file_get_contents('../../../Bin/Configuration.php');
$exp_db = array();
$exp_db = explode('\'',$db);

$hostname = $exp_db[1];
$username = $exp_db[3];
$password = $exp_db[5];
$database = $exp_db[7];

$connect = mysql_connect($hostname,$username,$password) or die(mysql_error());
mysql_select_db($database,$connect) or die(mysql_error());

// $sqlFB = "SELECT fb_application_id,fb_application_secret FROM site_settings WHERE setting_id = '1'";
// $queryFB = mysql_query($sqlFB);
// $recordFB = mysql_fetch_assoc($queryFB);

$facebook = new Facebook(array(
  // 'appId'  => $recordFB['fb_application_id'],
  // 'secret' => $recordFB['fb_application_secret'],
  'appId'  => '635108059837932',
  'secret' => 'e68de21792f84e4fc9e655731df64e88',

  'cookie' => true,
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
//$naitik = $facebook->api('/naitik');

?>
<?php
if(!$user)
{
  $sqlFB = "SELECT * FROM social_link_content_table WHERE content_id = '1'";
  $queryFB = mysql_query($sqlFB);
  $recordFB = mysql_fetch_assoc($queryFB);
?>
  <div id="popup_div">
      <p class="heading"><?php echo stripslashes($recordFB['content_title']); ?></p>
        <div class="content_div">
            <p class="content">
      <?php 
        $content = stripslashes($recordFB['content_desc']); 
        $content = str_replace('<p>','<p class="content">',$content);
        $content = str_replace('<li>','<li class="content">',$content);
        echo $content;
      ?></p>
                <p class="bottom">
              <a href="javascript:void(0);" class="accept_bg" onClick="fbAccept();">Accept</a>
                <a href="javascript:void(0);" class="cancel_bg" onClick="fbCancel();">Cancel</a>
            </p>
        </div>
    </div>

<?php
}else {


  include("../../../classes/Model/MUserRegistration.php");
  $obj = new Model_MUserRegistration();
  $obj->autoRegister($user_profile);

   header("Location:facebook_success.php");  

}
?>

</body>
</html>

<script type="text/javascript">
function fbAccept()
{
   window.location.href = '<?php echo $loginUrl; ?>';
}
function fbCancel()
{
  window.location.href = 'facebook_cancel.php';
}
</script>
