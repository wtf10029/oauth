<?php

namespace Wtf10029\Oauth;

use EasyWeChat\Factory;

class WeChatApplets implements OauthInterFace
{

    private $app;

    public function __construct($config)
    {
        $this->app = Factory::miniProgram($config);
    }

    public function getOpenId($code)
    {
        return $this->app->auth->session($code);

    }

    public function decryptData($data)
    {
        return $this->app->encryptor->decryptData($data['session'], $data['iv'], $data['encryptedData']);
    }


    public function accessToken()
    {
        $accessToken = $this->app->access_token;
        return $accessToken->getToken(true);

    }


}