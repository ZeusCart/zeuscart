<?php
ob_start();
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Twitter Alerts</title>
<style type="text/css">
  #popup_div{width:460px; margin:0; padding:0;}
  #popup_div .heading{background:#1BE0EE; line-height:32px; color:#fff; margin:0; padding:0 10px; font-family:Tahoma, Geneva, sans-serif; font-size:14px;}
  #popup_div .content_div{border:#ccc solid 1px; border-top:0; margin:0; padding:0;}
  #popup_div .content{margin:0; padding:10px; line-height:18px; font-size:12px; font-family:Tahoma, Geneva, sans-serif;}
  #popup_div .bottom{margin:10px 0 0 0; border-top:#ccc solid 1px; padding:10px; text-align:right;}
  .accept_bg{background:none repeat scroll 0 0 #1BE0EE; top left repeat-x; padding:0 10px; border:#1BE0EE solid 1px; color:#fff; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .accept_bg:hover{color:#000;}
  .cancel_bg{background:url(../../../images/cancel_bg.gif) top left repeat-x; padding:0 10px; border:#999 solid 1px; color:#333333; margin:0 0 0 5px; display:inline-block; font-family:Tahoma, Geneva, sans-serif; font-size:12px; text-decoration:none; line-height:23px; height:23px;}
  .cancel_bg:hover{color:#1BE0EE;}
</style>
<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {

$('#fbAccept').click(function (){
var email = $('#twitter_email').val();
// alert(email);
    if (email == '') {
    erremail = 1;
    $('#erremail').html("Email Id cannot be blank");
    $('#erremail').parent().show();

    }
    else if(email !='')
    {
        erremail = 1;
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)){
         $('#erremail').html("Enter Valid E-mail Format");

        }
        else
        {
            erremail = 0;
            $('#erremail').hide();
        }

    }

if (erremail == 0) {
	
	$.post("../../../?do=twitterreg", { "email": email },function(data){

            if (data == '') {

               window.opener.parent.location = '../../index.php?do=dashboard';
				window.close();
            }

        });    
}

});

$('#fbemailCancel').click(function(){
	window.close();
});


});
</script>

</head>
<body style="background:none;">

<?php
    require("twitteroauth.php");  
    session_start();  

	$db = file_get_contents('../../../Bin/Configuration.php');
	$exp_db = array();
	$exp_db = explode('\'',$db);

	$hostname = $exp_db[1];
	$username = $exp_db[3];
	$password = $exp_db[5];
	$database = $exp_db[7];

	$connect = mysql_connect($hostname,$username,$password) or die(mysql_error());
	mysql_select_db($database,$connect) or die(mysql_error());



    // If everything goes well..  
      if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION ['oauth_token_secret'])){  
        // We've got everything we need  

		$twitteroauth = new TwitterOAuth('hI1yNpEvDfeNTr3jgUNQg', ' 	HMU6Pcb2tXXT2UAbpeaSBoMzkE3REv1DP30sSUXA4', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
		// Let's request the access token  
		$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']); 
		// Save it in a session var 
		$_SESSION['access_token'] = $access_token; 
		// Let's get the user's info 
		$user_info = $twitteroauth->get('account/verify_credentials'); 
		// Print user's info  
		// echo "<pre>";
		$_SESSION['twitter_user_info'] = $user_info;
		 // print_r($user_info); 

		?>
		  <div id="popup_div">
		      <p class="heading">Twitter Alert</p>
		        <div class="content_div">
		            <p class="content">
		            	Enter your Email-Id   <input type="text" id="twitter_email" name="twitter_email" > 
		            	<span id="erremail" style="color :red;"></span>
		      		</p>
		                <p class="bottom">
		               <a href="javascript:void(0);" class="accept_bg" id="fbAccept">Submit</a>
		                <a href="javascript:void(0);" class="cancel_bg" id="fbemailCancel">Cancel</a>
		            </p>
		        </div>
		    </div>
		    <?php
		
		
		
    }else{ 
	 
		// The TwitterOAuth instance   
		$twitteroauth = new TwitterOAuth('hI1yNpEvDfeNTr3jgUNQg', 'HMU6Pcb2tXXT2UAbpeaSBoMzkE3REv1DP30sSUXA4');  
		// Requesting authentication tokens, the parameter is the URL we will be redirected to  
		$request_token = $twitteroauth->getRequestToken('http://localhost.com/ajshop/zeuscart/classes/Lib/twitter/example1.php');  


		// Saving them into the session  
		$_SESSION['oauth_token'] = $request_token['oauth_token'];  
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];  
	


		if($twitteroauth->http_code==200){  
			// Let's generate the URL and redirect  
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);


		  $sqlTW = "SELECT * FROM social_link_content_table WHERE content_id = '2'";
		  $queryTW = mysql_query($sqlTW);
		  $recordTW = mysql_fetch_assoc($queryTW);
		?>

		  <div id="popup_div">
		      <p class="heading"><?php echo stripslashes($recordTW['content_title']); ?></p>
		        <div class="content_div">
		            <p class="content">
		            	<!-- Enter your Email-Id   <input type="text" id="twitter_email" name="twitter_email" > 
		            	<span id="erremail" style="color :red;"></span> -->
		      <?php 
		        $content = stripslashes($recordTW['content_desc']); 
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
			
			// header('Location: '. $url); 
		} else { 
			// It's a bad idea to kill the script, but we've got to know when there's an error.  
			die('Something wrong happened.');  
		}  
	}
?>
</body>
</html>

<script type="text/javascript">
function fbAccept()
{

  window.location.href = '<?php echo $url; ?>';
}
function fbCancel()
{
  window.location.href = 'twitter_cancel.php';
}
function fbemailCancel()
{
	window.close();
}
</script>

	