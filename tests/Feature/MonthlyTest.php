<?php


namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use SuperMetrics\Cacher;
use SuperMetrics\Config;
use SuperMetrics\Downloader;

class MonthlyTest extends TestCase
{
    protected $client;
    private $downloader;
    private $posts;

    protected function setUp()
    {
        $this->downloader = new Downloader();
        $cacher = new Cacher(Config::getInstance()->cacheTime);
        $this->downloader->setCacher($cacher);
    }

    public function testGet_ValidYear_Data()
    {
        $response = $this->client->get('/books', [
            'query' => [
                'bookId' => 'hitchhikers-guide-to-the-galaxy'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('bookId', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('author', $data);
        $this->assertEquals(42, $data['price']);
    }

}