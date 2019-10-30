<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
use SuperMetrics\HelperPosts;

$id = $_GET["month"];

$Metrics = new SuperMetrics();

$monthlyPosts = $Metrics->getPosts()->postsOfMonth($id);

$data = [
    'Average character length' => round(HelperPosts::avgPostLength($monthlyPosts),2),
    'Average number of posts per user' => round(HelperPosts::avgPostsPerUser($monthlyPosts),2),
    'Longest post by character length' => HelperPosts::longPost($monthlyPosts)
];

header('Content-Type: application/json');
echo json_encode($data);


