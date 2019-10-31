<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use SuperMetrics\Config;
use SuperMetrics\Downloader;

class DownloaderTest extends TestCase
{
    public function testUnavailableGet()
    {
        $this->expectException(\Exception::class);

        $d = new Downloader();
        $d->setUrl(sprintf('http://unexisting-domain-%s.ru', md5(time() . rand(0, 100))));
        $d->get();
    }

    public function testUnavailablePost()
    {
        $this->expectException(\Exception::class);

        $d = new Downloader();
        $d->setUrl(sprintf('http://unexisting-domain-%s.ru', md5(time() . rand(0, 100))));
        $d->post([
            'client_id' =>Config::getInstance()->clientId,
            'email' => Config::getInstance()->email,
            'name' => Config::getInstance()->name
        ]);
    }
}
