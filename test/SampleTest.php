<?php

use HAWMS\Sample;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testShouldIncreaseNum()
    {
        $sample = new Sample();
        $sample->increase();
        $this->assertEquals(1, $sample->getNum());
        $sample->increase();
        $this->assertEquals(2, $sample->getNum());
    }

    public function testShouldDecreaseNum()
    {
        $sample = new Sample();
        $sample->decrease();
        $this->assertEquals(-1, $sample->getNum());
        $sample->decrease();
        $this->assertEquals(-2, $sample->getNum());
    }
}
