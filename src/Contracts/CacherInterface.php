<?php

namespace SuperMetrics\Contracts;

/**
 * This interface is used to guarantee correct methods and arguments existing.
 *
 */
interface CacherInterface
{
    function put($key, $value);

    function get($key);
}
