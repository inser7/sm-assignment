<?php


namespace Tests\Unit;


use PHPUnit\Framework\TestCase;
use SuperMetrics\Helpers\HelperPosts;
use SuperMetrics\SuperMetrics;

class HelperPostsTest extends TestCase
{
    private $monthlyPosts;

    protected function setUp()
    {
        $metrics = new SuperMetrics();
        $this->monthlyPosts = $metrics->getPosts()->postsOfMonth(8);
    }

    public function test_avgPostLength()
    {
        $this->assertIsFloat(HelperPosts::avgPostLength($this->monthlyPosts));
        $this->assertLessThan(430, round(HelperPosts::avgPostLength($this->monthlyPosts),2));
    }

    public function test_avgPostsPerUser()
    {
        $this->assertIsFloat(HelperPosts::avgPostsPerUser($this->monthlyPosts));
        $this->assertLessThan(9, round(HelperPosts::avgPostsPerUser($this->monthlyPosts),2));
    }

    public function test_longPost()
    {
        $this->assertIsInt(HelperPosts::longPost($this->monthlyPosts));
        $this->assertLessThan(772, round(HelperPosts::longPost($this->monthlyPosts),2));
    }
}