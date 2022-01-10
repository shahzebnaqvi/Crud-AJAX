<?php
include_once("includes/function.php");
include('includes/googleconfig.php');

$login_button = '';

//This $_GET["Googleauth"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["Googleauth"]))
{
 //It will Attempt to exchange a Googleauth for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthGoogleauth($_GET["Googleauth"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of Googleauth/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of Googleauth and make Googleauth for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><button type="button" class="btn btn-default col-lg-6">Google</button>
                           </a>';
}


if(isset($_SESSION['id']) && isset($_SESSION['e_mail']) &&  isset($_SESSION['usertype']))
{
    header("Location: home.php");
}
else{

    $conn = connect_db();
    $errorMessage='';

    if(isset($_REQUEST['submit'])){


        $email = $_REQUEST['email'];
        $password = $_REQUEST['pass'];
        $email_search = "SELECT * FROM user where email = '".$email."' ";
        // echo $email_search ;
        $query = mysqli_query($conn,$email_search);

        $emai_count = mysqli_num_rows($query);

        if($emai_count){
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass =  $email_pass['pass']; 

            if($db_pass==$password){

                $_SESSION['name'] = $email_pass['name'];
                $_SESSION['id'] = $email_pass['user_Id'];
                $_SESSION['e_mail'] = $email_pass['email'];
     
                echo'
                <script type="text/javascript">
                window.location.href ="home.php";
                </script>';
            }else{
                $errorMessage = "Password is incorrect";
    // echo '<script>
    // alert("Password is incorrect")
    // </script>';
            }
            
        }else{
            $errorMessage = "E-mail is incorrect";
// echo '<script>
//     alert("E-mail is incorrect")
//     </script>';
        }
    }
$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/project_php/index.php', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"> <button type="button" class="btn btn-primary col-lg-6">Facebook</button></a></div>';
}


    ?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utfN-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>Preadmin - Bootstrap Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title">Login</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href="index.php"><img src="assets/img/logo2.png" alt="Preadmin"></a>
                        </div>
                        <form action="index.php">
                            <div class="form-group form-focus">
                                <label class="control-label">email</label>
                                <input class="form-control floating" type="email"  name="email" value="<?php if(isset($_REQUEST['submit'])) {echo $_REQUEST['email'];} ?>">
                            </div>
                            <div class="form-group form-focus">
                                <label class="control-label">Password</label>
                                <input class="form-control floating" type="password"  name="pass" >
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-block account-btn" type="submit" value="Submit"  name="submit">Login</button>
                            </div>
                                                        <div class="form-group text-center">
                           
                            <?php 
                            echo $login_button ;
                            echo $facebook_login_url ;?>

                        </div>
                            <div class="text-center">
                                <a href="forgot-password.html">Forgot your password?</a>
                            </div><?php
   // if($login_button == '')
   // {
   //  echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
   //  echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
   //  echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
   //  echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
   //  echo '<h3><a href="logout.php">Logout</h3></div>';
   // }
   // else
   // {
   //  echo '<div align="center">'.$login_button . '</div>';
   // }
   ?>
                            <div class="text-center">
                                <a href="register.php">Donot have an account? Create it</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>

</html>

 <?php
}?>