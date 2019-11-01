<?php
namespace SuperMetrics\Helpers;


class HelperPosts
{
    public static function groupBy($array, $key) {
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

    function prepareJsonForYear(array $groupCount):array
    {
        $result = array();

        array_walk($groupCount, function (&$value,$key) use (&$result){
            $result[] = ['week'=>$value, 'totalPosts'=>$key];
        });
        return $result;
    }

    public static function groupByWeekCount(array $posts):array
    {
        $grouped = self::groupBy($posts, 'week');

        $groupCount = array_map(function ($item) {
            return count($item);
        }, $grouped);

        return self::prepareJsonForYear($groupCount);
    }
}
