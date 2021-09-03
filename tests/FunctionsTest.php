<?php

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function SayHelloTest(){
        $this->assertEquals('Hello', $this->functions->sayHello());
    }
}