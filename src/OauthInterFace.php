<?php

namespace Wtf10029\Oauth;

interface OauthInterFace
{
    public function getOpenId($code);

    public function decryptData($data);

    public function accessToken();
}