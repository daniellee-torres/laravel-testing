<?php

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
class Prophecies extends TestCase {

    /**
     * @test
     */
    public function test_something()
    {
        $this->prophesize();
    }
}
