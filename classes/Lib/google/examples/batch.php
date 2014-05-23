<?php
/*
 * Copyright (c) 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Google Alerts</title>
<style type="text/css">
  #popup_div{width:460px; margin:0; padding:0;}
  #popup_div .heading{background:#FF0000; line-height:32px; color:#fff; margin:0; padding:0 10px; font-family:Tahoma, Geneva, sans-serif; font-size:14px;}
  #popup_div .content_div{border:#ccc solid 1px; border-top:0; margin:0; padding:0;}
  #popup_div .content{margin:0; padding:10px; line-height:18px; font-size:12px; font-family:Tahoma, Geneva, sans-serif;}
  #popup_div .bottom{margin:10px 0 0 0; border-top:#ccc solid 1px; padding:10px; text-align:right;}
  .accept_bg{background:none repeat scroll 0 0 #FF0000; top left repeat-x; padding:0 10px; border:#FF0000 solid 1px; color:#fff; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .accept_bg:hover{color:#000;}
  .cancel_bg{background:url(../../../images/cancel_bg.gif) top left repeat-x; padding:0 10px; border:#999 solid 1px; color:#333333; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .cancel_bg:hover{color:#FF0000;}
</style>
</head>
<body style="background:none;">

<?php


require_once '../src/Google_Client.php';
require_once '../src/contrib/Google_PlusService.php';
require_once '../src/contrib/Google_Oauth2Service.php';

session_start();

$db = file_get_contents('../../../../Bin/Configuration.php');
$exp_db = array();
$exp_db = explode('\'',$db);

$hostname = $exp_db[1];
$username = $exp_db[3];
$password = $exp_db[5];
$database = $exp_db[7];

$connect = mysql_connect($hostname,$username,$password) or die(mysql_error());
mysql_select_db($database,$connect) or die(mysql_error());

$sqlgoo = "SELECT * FROM social_link_content_table WHERE content_id = '3'";
$querygoo = mysql_query($sqlgoo);
$recordgoo= mysql_fetch_assoc($querygoo);


$client = new Google_Client();
$client->setApplicationName("Google+ PHP Starter Application");
$plus = new Google_PlusService($client);

// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_oauth2_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');

if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $client->setUseBatch(true);

  $batch = new Google_BatchRequest();

  $batch->add($plus->people->get('me'), 'key1');
  $batch->add($plus->people->get('me'), 'key2');

  $result = $batch->execute();

  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  print "<pre>" . print_r($result, true) . "</pre>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();

// echo $authUrl; exit;

if($authUrl)
{
  $sqlgoo = "SELECT * FROM social_link_content_table WHERE content_id = '3'";
$querygoo = mysql_query($sqlgoo);
$recordgoo= mysql_fetch_assoc($querygoo);
?>
  <div id="popup_div">
      <p class="heading"><?php echo stripslashes($recordgoo['content_title']); ?></p>
        <div class="content_div">
            <p class="content">
      <?php 
        $content = stripslashes($recordgoo['content_desc']); 
        $content = str_replace('<p>','<p class="content">',$content);
        $content = str_replace('<li>','<li class="content">',$content);
        echo $content;
      ?></p>
                <p class="bottom">
              <a href="javascript:void(0);" class="accept_bg" onClick="gpAccept();">Accept</a>
                <a href="javascript:void(0);" class="cancel_bg" onClick="gpCancel();">Cancel</a>
            </p>
        </div>
    </div>

<?php
}

 // print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

// -----------------------------------------------------------------------------------------

$client1 = new Google_Client();
$client1->setApplicationName("Google UserInfo PHP Starter Application");

$oauth2 = new Google_Oauth2Service($client1);

if (isset($_GET['code'])) {
  $client1->authenticate($_GET['code']);
  $_SESSION['token'] = $client1->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client1->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client1->revokeToken();
}

if ($client1->getAccessToken()) {
  $user = $oauth2->userinfo->get();
// echo $user; exit;
  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client1->getAccessToken();
} else {
  $authUrl = $client1->createAuthUrl();
}
?>
<?php //if(isset($personMarkup)): ?>
<?php //print $personMarkup ?>
<?php //endif ?>
<?php
  // if(isset($authUrl)) {
  //   print "<a class='login' href='$authUrl'>Connect Me!</a>";
  // } else {
  //  print "<a class='logout' href='?logout'>Logout</a>";
  // }
?>
</body></html>

<script type="text/javascript">
function gpAccept()
{
    
  window.location.href = '<?php echo $authUrl; ?>';
}
function gpCancel()
{
  window.location.href = 'google_cancel.php';
}
</script>
