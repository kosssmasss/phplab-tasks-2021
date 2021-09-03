<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testCountArgumentsWrapper(): void
    {
        $this->functions->countArguments('111', '222', 333);
    }

}