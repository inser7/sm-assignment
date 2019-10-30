<?php

namespace SuperMetrics;

use SuperMetrics\CacherInterface;
use SuperMetrics\DownloaderInterface;

/**
 * The implementation is responsible for getting raw data from specified URL/path.
 *
 */
class Downloader implements DownloaderInterface
{
    private $url;

    private static $_instance = null;

    private function __clone () {}
    private function __wakeup () {}

    public static function getInstance()
    {
        if (self::$_instance != null) {
            return self::$_instance;
        }

        return new self;
    }


    public function setUrl($url) {
        $this->url = $this->escapeUrl($url);
    }


    private $cacher;

    public function setCacher(CacherInterface $c) {
        $this->cacher = $c;
    }


    /**
     * URL escaping
     *
     * @param string url
     *
     * @return string
     */
    private function escapeUrl($url) {
        return str_replace(' ', '%20', $url);
    }


    function get() {
        if ( ! $this->url) {
            throw new \Exception('Downloader: No path specified');
        }


        if ($this->cacher) {
            $key = sprintf('url_%s', $this->url);

            if ($this->cacher->get($key) !== null) {
                return $this->cacher->get($key);
            }
        }


        // TODO: check if '200 Ok' here
        $content = @file_get_contents($this->url);

        if ( ! $content) {
            throw new \Exception(sprintf('Downloader: No content at %s', $this->url));
        }


        if ($this->cacher) {
            $this->cacher->put($key, $content);
        }


        return $content;
    }

    /**
     * Downloading data.
     *
     * @return string
     * @throws \Exception
     */
    function post(array $data) {

        if ( ! $this->url) {
            throw new \Exception('Downloader: No path specified');
        }


        if ($this->cacher) {
            $key = sprintf('url_%s', $this->url);
            if ($this->cacher->get($key) !== null) {
                return $this->cacher->get($key);
            }
        }

        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', $this->url, [
            'form_params' => $data
        ]);
        $content = json_decode($res->getBody())->data;

        if ( ! $content) {
            throw new \Exception(sprintf('Downloader: No content at %s', $this->url));
        }

        if ($this->cacher) {
            $this->cacher->put($key, $content);
        }

        return $content;
    }

}
