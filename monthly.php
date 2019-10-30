<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
$id = $_GET["month"];

$Metrics = new SuperMetrics();

var_dump($Metrics->getPosts()->postsOfMonth($id));

