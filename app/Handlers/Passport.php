<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Passport
{
    public function createToken($name, $password)
    {
        $http = new Client();
        $response = $http->post('http://127.0.0.1/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config("passport.client_id"),
                'client_secret' => config("passport.client_secret"),
                'username' => $name,
                'password' => $password,
            ],
        ]);

        return json_decode($response->getBody());
    }

    public function refreshToken($refresh_token)
    {
        $http = new Client();
        $response = $http->post('http://127.0.0.1/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => config("passport.client_id"),
                'client_secret' => config("passport.client_secret"),
            ],
        ]);

        return json_decode($response->getBody());
    }
}
