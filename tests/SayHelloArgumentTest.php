<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testSayHelloArgument(){
        
        $this->assertEquals('Hello Koss', $this->functions->sayHelloArgument("Koss"));
    }
}