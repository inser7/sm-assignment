<?php


namespace SuperMetrics;


use SuperMetrics\Cacher;
use SuperMetrics\Downloader;
use SuperMetrics\DownloaderInterface;
use SuperMetrics\ISMToken;

class SuperToken implements ISMToken
{

    private $downloader;

    public function __construct() {
        $this->downloader = new Downloader();
        $cacher = new Cacher();
        $this->downloader->setCacher($cacher);
    }

    public function getToken()
    {

        $clientId ="ju16a6m81mhid5ue1z3v2g0uh";
        $email = "sergey@kolsov.ru";
        $name = "Sergey Kolsov";

        $this->downloader->setUrl('https://api.supermetrics.com/assignment'."/register");
        $token = $this->downloader->post([
            'client_id' =>$clientId,
            'email' => $email,
            'name' => $name
        ]);

        return $token->sl_token;
    }
}
