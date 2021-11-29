<?php

namespace Wtf10029\Oauth;

use EasyWeChat\Factory;
use GuzzleHttp\Client;

class WeChatOpenPlatform implements OauthInterFace
{

    private $app;
    private $config;

    public function __construct($config)
    {
        $this->app = Factory::openPlatform($config);  //getAuthorization
        $this->config = $config;

    }

    public function getOpenId($code)
    {
        return $this->getToken($code);

    }

    public function decryptData($data)
    {
        return $this->getUserinfo($data['access_token'], $data['open_id']);
    }


    public function accessToken()
    {
        $accessToken = $this->app->access_token;
        return $accessToken->getToken(true);

    }


    public function getToken($code)
    {
        $result = $this->start_get_request('https://api.weixin.qq.com/sns/oauth2/access_token', [
            'appid'      => $this->config['app_id'],
            'secret'     => $this->config['app_secret'],
            'code'       => $code,
            'grant_type' => 'authorization_code'
        ]);
        if (false == $result) {
            return false;
        }
        return $result;
    }


    public function getUserinfo($access_token, $openid)
    {
        $result = $this->start_get_request('https://api.weixin.qq.com/sns/userinfo', [
            'access_token' => $access_token,
            'openid'       => $openid
        ]);
        if (false == $result) {
            return false;
        }
        return $result;
    }


    /**
     * @param $uri
     * @param $query
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function start_get_request($uri, $query)
    {
        $body = (new Client())->request('GET', $uri, [
            'query'   => $query,
            'timeout' => 5
        ]);
        if ($body->getStatusCode() != 200) {
            return false;
        }
        return json_decode($body->getBody(), true, 512, JSON_BIGINT_AS_STRING);

    }


}