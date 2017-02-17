<?php

/**
 * Created by PhpStorm.
 * User: adamh
 * Date: 2/15/17
 * Time: 12:08 PM
 */
use Faker\Factory as Faker;

abstract class ApiTester extends BrowserKitTestCase
{
    protected $fake;

    /**
     * ApiTester constructor.
     */
    function __construct()
    {
        $this->fake = Faker::create();
    }

    function getAuthHeader()
    {
        $params = [
            'form_params' => [
                'scope' => 'openid',
                'response_type' => 'token',
                'connection' => 'Username-Password-Authentication',
                'username' => 'adam@heged.us',
                'password' => 'asdfasdf',
                'sso' => true,
                'client_id' => '8tq5oi8oqMfFr9o4Mgz25ta1slAUd3Ua',
                'redirect_uri' => 'http%3A%2F%2Flocalhost%3A8800'
        ]];

        $client = new GuzzleHttp\Client();
        $response = $client->post('https://energycap.auth0.com/oauth/ro', $params);
        $json = json_decode($response->getBody(), true);

        return ['Authorization' => 'Bearer ' . $json['id_token']];
    }



}