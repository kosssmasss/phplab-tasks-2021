<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new web\AirportValidator();
    }

    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->arrays->getUniqueValue($input));
    }
}