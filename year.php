<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
use SuperMetrics\Helpers\HelperPosts;
use SuperMetrics\Response;

$metrics = new SuperMetrics();

$poststByWeek = $metrics->getPosts()->postsByWeek();

$groupByWeek = HelperPosts::groupByWeekCount($poststByWeek);

header('Content-Type: application/json');
echo new Response(false, $groupByWeek);


