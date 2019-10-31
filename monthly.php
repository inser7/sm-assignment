<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\Response;
use SuperMetrics\SuperMetrics;
use SuperMetrics\Helpers\HelperPosts;

$id = $_GET["month"];

$Metrics = new SuperMetrics();

$monthlyPosts = $Metrics->getPosts()->postsOfMonth($id);

$data = [
    'Average character length' => round(HelperPosts::avgPostLength($monthlyPosts),2),
    'Average number of posts per user' => round(HelperPosts::avgPostsPerUser($monthlyPosts),2),
    'Longest post by character length' => HelperPosts::longPost($monthlyPosts)
];

echo new Response(false, $data);


