<?php


namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use SuperMetrics\Cacher;
use SuperMetrics\Config;
use SuperMetrics\Downloader;

class SuperTokenTest extends TestCase
{

    protected $client;
    private $downloader;

    protected function setUp()
    {
        $this->downloader = new Downloader();
        $cacher = new Cacher(Config::getInstance()->cacheTime);
        $this->downloader->setCacher($cacher);
    }

    public function testGet_ValidYToken()
    {
        $this->downloader->setUrl(Config::getInstance()->API_BASE_URL."/register");
        $token = $this->downloader->post([
            'client_id' =>Config::getInstance()->clientId,
            'email' => Config::getInstance()->email,
            'name' => Config::getInstance()->name
        ]);

       $token= $token->sl_token;

       $this->assertIsString($token);
       $this->assertStringMatchesFormat('%s_%s_%s', $token); //smslt_020c8e25a2fbbff_d6d0fbe6f164
    }
}