
<?php

// session_start();

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1015949508253-rbs0vqt22t361pfnsjaea3b1jeu6bh5p.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://phpstack-704365-2349566.cloudwaysapps.com/mytest/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>

<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '921130358246916',
  'app_secret'     => '8d382dc63a190925664594ef090b8a78',
  'default_graph_version'  => 'v2.10'
]);

?>