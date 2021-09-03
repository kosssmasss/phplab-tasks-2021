<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testSayHello(){
        $this->assertEquals('Hello', $this->functions->sayHello());
    }

}