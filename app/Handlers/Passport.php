<?php

namespace App\Handlers;

use GuzzleHttp\Client;

class Passport extends BaseHandler
{
    public function createToken($name, $password)
    {
        try {
            $http = new Client();

            $response = $http->post('http://127.0.0.1/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => config("passport.client_id"),
                    'client_secret' => config("passport.client_secret"),
                    'username'      => $name,
                    'password'      => $password,
                ],
            ]);
            return $this->returnArray(json_decode($response->getBody()));
        } catch (\Exception $exception) {
            return $this->returnArray([], "Token创建失败", 1);
        }
    }

    public function refreshToken($refresh_token)
    {
        try {
            $http = new Client();

            $response = $http->post('http://127.0.0.1/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id'     => config("passport.client_id"),
                    'client_secret' => config("passport.client_secret"),
                ],
            ]);
            return $this->returnArray(json_decode($response->getBody()));
        } catch (\Exception $exception) {
            return $this->returnArray([], "Token刷新失败", 1);
        }
    }
}
