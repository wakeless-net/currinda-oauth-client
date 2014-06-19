<?php

require_once "vendor/autoload.php";
require_once "currinda_provider.php";

$provider = new League\OAuth2\Client\Provider\CurrindaProvider(array(
    'clientId'  =>  CLIENT_ID,
    'clientSecret'  =>  CLIENT_SECRET,
    "scopes" => ["org-19"],
    'redirectUri'   =>  'http://oauth-client.localhost/',
    'url_authorize' => "http://acme.currinda.com/api/authorize",
    "url_access_token"=> "http://acme.currinda.com/api/token",
    "url_user_details" => "http://acme.currinda.com/api/organisation/19"
));

if ( ! isset($_GET['code'])) {
    // If we don't have an authorization code then get one
    header('Location: '.$provider->getAuthorizationUrl());
    exit;

} else {
  
    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $userDetails = $provider->getUserDetails($token);

        // Use these details to create a new profile
        printf('Hello %s!', $userDetails->FirstName);

    } catch (Exception $e) {
      throw $e;
        // Failed to get user details
        exit('Oh dear...');
    }

    print_r($token);

    echo "<br />";

    // Use this to interact with an API on the users behalf
    echo $token->accessToken;
    echo "<br />";

    // Use this to get a new access token if the old one expires
    echo $token->refreshToken;

    echo "<br />";
    // Number of seconds until the access token will expire, and need refreshing
    echo $token->expires;
}
