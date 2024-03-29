<?php

namespace SuperMetrics;

use SuperMetrics\Config;
use SuperMetrics\Downloader;
use SuperMetrics\Contracts\SuperMetricsInterface;
use SuperMetrics\SuperToken;
use Carbon\Carbon;
use SuperMetrics\Cacher;

class SuperMetrics implements SuperMetricsInterface
{
    private $downloader;
    private $posts;

    public function __construct() {
        $this->downloader = new Downloader();
        $cacher = new Cacher(Config::getInstance()->cacheTime);
        $this->downloader->setCacher($cacher);
    }

    public function getPosts()
    {
        $this->posts = $this->getAllPosts();
        return $this;
    }

    public function postsByWeek()
    {
        $postsByWeek = [];

        foreach($this->posts as $post){
            $weekOfYear = Carbon::parse($post['created_time'])->weekOfYear;

            $postsByWeek[] = ['week' => $weekOfYear, 'message' => $post['message']];
        }

        return $postsByWeek;
    }

    public function getMonth()
    {
        $monthArray = [];

        foreach($this->posts as $post){
            $monthArray[] = ['month' => Carbon::parse($post['created_time'])->month];
        }

        return $monthArray;
    }

    public function postsOfMonth(int $month)
    {
        $postOfMonth = [];

        foreach($this->posts as $post){
            $postMonth = Carbon::parse($post['created_time'])->month;
            if($postMonth == $month){
                $postOfMonth[] = $post;
            }
        }

        return $postOfMonth;
    }

    private function getAllPosts()
    {
        $arr = [];
        $totalPage = 10;

        for($i = 1; $i <= $totalPage; $i++){
            $posts = json_decode($this->getPost($i))->data->posts;
            foreach ($posts as $post)
            {
                $arr[] = (array) $post;
            }
        }
        return $arr;
    }

    private function getPost(int $page)
    {
        $token = new SuperToken();
        $this->downloader->setUrl(sprintf(Config::getInstance()->api_url_mask, Config::getInstance()->API_BASE_URL."/posts", $page, $token->getToken()));

        return $this->downloader->get();
    }
}
