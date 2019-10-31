<?php

namespace Tests\Unit;

use SuperMetrics\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testNegativeStatus()
    {
        $status = false;
        $data = md5(sprintf('%s%s', time(), $status));

        $r1 = new Response($status, $data);

        $r2 = new \stdClass();
        $r2->status = $status;
        $r2->data = $data;

        $this->assertEquals((string) $r1, json_encode($r2));
    }

    public function testPositiveStatus()
    {
        $status = true;
        $data = md5(sprintf('%s%s', time(), $status));

        $r = new Response($status, $data);

        $this->assertEquals((string) $r, $data);
    }
}
