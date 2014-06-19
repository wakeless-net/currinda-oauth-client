<?php

namespace League\OAuth2\Client\Provider;

class CurrindaProvider extends IdentityProvider {
  var $url_authorize= "" , $url_access_token="", $url_user_details="";
    public function urlAuthorize()
    {
      return $this->url_authorize;
    }

    public function urlAccessToken()
    {
      return $this->url_access_token;
    }

    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
      return $this->url_user_details."?access_token=$token";
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)  {
      print_r($response);
      return $response;
    }
}
