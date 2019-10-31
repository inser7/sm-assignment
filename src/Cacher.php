<?php

namespace SuperMetrics;

use SuperMetrics\CacherInterface;
use SuperMetrics\Cache\Cache;
/**
 * The implementation is responsible for putting/getting cached data.
 *
 */
class Cacher implements CacherInterface
{
    private $seconds;
    private $cacher;

    private static $_instance = null;

    public  function __construct ($seconds) {

        $this->seconds = $seconds;

        $this->cacher = new Cache();
    }

    function put($key, $value)
    {
        $this->cacher->store($key, $value, $this->seconds);
    }

    function get($key)
    {
        return $this->cacher->retrieve($key);
    }
}
