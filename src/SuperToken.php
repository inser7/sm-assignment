<?php


namespace SuperMetrics;


use SuperMetrics\Cacher;
use SuperMetrics\Downloader;
use SuperMetrics\Contracts\DownloaderInterface;
use SuperMetrics\Contracts\SuperTokenInterface;

class SuperToken implements SuperTokenInterface
{

    private $downloader;

    public function __construct() {
        $this->downloader = new Downloader();
        $cacher = new Cacher(Config::getInstance()->cacheTime);
        $this->downloader->setCacher($cacher);
    }

    public function getToken()
    {

        $this->downloader->setUrl(Config::getInstance()->API_BASE_URL."/register");
        $token = $this->downloader->post([
            'client_id' =>Config::getInstance()->clientId,
            'email' => Config::getInstance()->email,
            'name' => Config::getInstance()->name
        ]);

        return $token->sl_token;
    }
}
