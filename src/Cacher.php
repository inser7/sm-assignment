<?php

namespace SuperMetrics;

use SuperMetrics\CacherInterface;
use Phpfastcache\CacheManager;
use Phpfastcache\Config\Config;
use Phpfastcache\Core\phpFastCache;
/**
 * The implementation is responsible for putting/getting cached data.
 *
 */
class Cacher implements CacherInterface
{
    private $minutes;
    private $cacher;

    private static $_instance = null;

    private function __construct () {

        $this->minutes = 60;
        CacheManager::setDefaultConfig(new Config([
            "path" => sys_get_temp_dir(),
            "itemDetailedDate" => false
        ]));

        $this->cacher = CacheManager::getInstance('files');
    }

    private function __clone () {}
    private function __wakeup () {}

    public static function getInstance()
    {
        if (self::$_instance != null) {
            return self::$_instance;
        }

        return new self;
    }

    function put($key, $value)
    {
        $CachedString =  $this->cacher->getItem($key);
        $CachedString->set($value)->expiresAfter($this->minutes);
        $this->cacher->save($CachedString);
    }

    function get($key)
    {
        $CachedString = $this->cacher->getItem($key);
        return $CachedString->get();
    }
}
