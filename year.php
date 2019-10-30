<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
use SuperMetrics\HelperPosts;

$Metrics = new SuperMetrics();

$poststByWeek = $Metrics->getPosts()->postsByWeek();

header('Content-Type: application/json');
echo json_encode(HelperPosts::groupByWeekCount($poststByWeek));


