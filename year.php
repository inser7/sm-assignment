<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
use SuperMetrics\Helpers\HelperPosts;
use SuperMetrics\Response;

$Metrics = new SuperMetrics();

$poststByWeek = $Metrics->getPosts()->postsByWeek();

$groupByWeek = HelperPosts::groupByWeekCount($poststByWeek);

echo new Response(false, $groupByWeek);


