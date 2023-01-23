<?php
//initialize facebook sdk
require 'vendor/autoload.php';

session_start();


$fb = new Facebook\Facebook([
'app_id' => '1559443224560850',
'app_secret' => '63dfafd3501ac2e8bae0236cf97aaf08',
'default_graph_version' => 'v2.5',
]);


$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
if (isset($_SESSION['facebook_access_token'])) {
$accessToken = $_SESSION['facebook_access_token'];
} else {
$accessToken = $helper->getAccessToken();
}
} catch(Facebook\Exceptions\facebookResponseException $e) {


    // When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
if (isset($accessToken)) {
if (isset($_SESSION['facebook_access_token'])) {
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
} else {


    // getting short-lived access token
$_SESSION['facebook_access_token'] = (string) $accessToken;
// OAuth 2.0 client handler
$oAuth2Client = $fb->getOAuth2Client();


// Exchanges a short-lived access token for a long-lived one
$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;


// setting default access token to be used in script
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
}


// redirect the user to the profile page if it has "code" GET variable
if (isset($_GET['code'])) {
header('Location: home.php');
}



// getting basic info about user
try {
$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
$requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
$picture = $requestPicture->getGraphUser();
$profile = $profile_request->getGraphUser();
$fbid = $profile->getProperty('id');           // To Get Facebook ID
$fbfullname = $profile->getProperty('name');   // To Get Facebook full name
$fbemail = $profile->getProperty('email');    //  To Get Facebook email
$fbpic = "<img src='".$picture['url']."' class='img-rounded'/>";
# save the user nformation in session variable
$_SESSION['fb_id'] = $fbid.'</br>';
$_SESSION['fb_name'] = $fbfullname.'</br>';
$_SESSION['fb_email'] = $fbemail.'</br>';
$_SESSION['fb_pic'] = $fbpic.'</br>';
} catch(Facebook\Exceptions\FacebookResponseException $e) {


    // When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
session_destroy();


// redirecting user back to app login page
header("Location: ./");
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {


    // When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
} else {


    // replace  website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and used            
$loginUrl = $helper->getLoginUrl('http://localhost/WeddingPlan/home.php', $permissions);
echo '<a href="https://www.facebook.com/v2.5/dialog/oauth?client_id=1559443224560850&amp;state=8b43cd9ea36dba0f0b668ab7c21532a7&amp;response_type=code&amp;sdk=php-sdk-5.1.4&amp;redirect_uri=http%3A%2F%2Flocalhost%2FWeddingPlan%2Fhome.php&amp;scope=email" class="btn". $loginUrl . > <i class="fab fa-facebook-f"></i> Facebook </a>';
}
?>
