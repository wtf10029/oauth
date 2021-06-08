<?php


namespace Wtf10029\Oauth;


class OauthFactory
{

    protected $drivers = [];

    protected $configs = [];

    public function __construct()
    {
        $this->configs = require dirname(__DIR__).'/config/oauth.php';

        foreach ($this->configs as $key => $item)
        {
            $driverClass = $item['driver'];

            if (!class_exists($driverClass))
            {
                throw new \Exception(sprintf('[Error] class %s is invalid.', $driverClass));
            }

            $driver = new $driverClass($item);
            if (!$driver instanceof OauthInterFace)
            {
                throw new \Exception(sprintf('[Error] class %s is not instanceof %s.', $driverClass, OauthInterFace::class));
            }

            $this->drivers[$key] = $driver;
        }
    }

    public function __get($name)
    {
        return $this->get($name);
    }


    public function get(string $name)
    {
        $driver = $this->drivers[$name] ?? null;
        if (!$driver || !$driver instanceof OauthInterFace)
        {
            throw new \Exception(sprintf('[Error]  %s is a invalid driver.', $name));
        }

        return $driver;
    }

    public function getConfig($name): array
    {
        return $this->configs[$name] ?? [];
    }

}