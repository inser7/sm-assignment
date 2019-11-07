<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\Response;
use SuperMetrics\SuperMetrics;
use SuperMetrics\Helpers\HelperPosts;

$id = $_GET["month"];

$metrics = new SuperMetrics();

$monthlyPosts = $metrics->getPosts()->postsOfMonth($id);

$data = [
    'Average_character_length' => round(HelperPosts::avgPostLength($monthlyPosts),2),
    'Average_number_of_posts_per_user' => round(HelperPosts::avgPostsPerUser($monthlyPosts),2),
    'Longest_post_by_character_length' => HelperPosts::longPost($monthlyPosts)
];
header('Content-Type: application/json');
echo new Response(false, $data);


