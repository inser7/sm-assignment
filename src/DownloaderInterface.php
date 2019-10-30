<?php

namespace SuperMetrics;

/**
 * This interface is used to guarantee correct method and it's argument existing.
 *
 * @author igronus
 */
interface DownloaderInterface
{
    function post(array $data);
    function get();
}
