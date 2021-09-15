<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testSayHelloArgumentWrapper()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->functions->sayHelloArgumentWrapper('string');
    }

}