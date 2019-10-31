<?php
namespace SuperMetrics\Helpers;


class HelperPosts
{
    function groupBy($array, $key) {
        $resultArr = array();
        foreach($array as $val) {
            $resultArr[$val[$key]][] = $val;
        }
        return $resultArr;
    }

    public static function avgPostLength(array $posts):float
    {
        $newCol = array();
        foreach ($posts as $post){
            $newCol[] = strlen($post['message']);
        }

        $avg = array_sum($newCol)/count($newCol);

        return $avg;
    }

    public static function avgPostsPerUser(array $posts):float
    {
        $grouped = self::groupBy($posts, 'from_id');

        $groupCount = array_map(function ($item) {
            return count($item);
        }, $grouped);

        return array_sum($groupCount)/count($groupCount);
    }

    public static function longPost(array $posts):int
    {
        $newCol = array();
        foreach ($posts as $post){
            $newCol[] = strlen($post['message']);
        }

        return max($newCol);
    }

    public static function groupByWeekCount(array $posts)
    {
        $grouped = self::groupBy($posts, 'week');

        $groupCount = array_map(function ($item) {
            return count($item);
        }, $grouped);

        return $groupCount;
    }
}
