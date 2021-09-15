<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    // /**
    // * @dataProvider countDataProvider
    // */

    public function testCountArguments(): void
    {
        $this->assertEquals(['argument_count' => 0, 'argument_values' => Array()], $this->functions->countArguments());
        $this->assertEquals(['argument_count' => 1, 'argument_values' => [0 => '111']], $this->functions->countArguments('111'));
        $this->assertEquals(['argument_count' => 2, 'argument_values' => [0 => '111', 1 => '222']], $this->functions->countArguments('111', '222'));
    }

    // public function testCountArguments($input, $expected): void
    // {
    //     $this->assertEquals($expected, $this->functions->countArguments($input));
    // }

    // public function countDataProvider(): array
    // {
    //     return [
    //         'Test 1' => [ null,  ['argument_count' => 0, 'argument_values' => Array()]],
    //         'Test 2' => ['111', ['argument_count' => 1, 'argument_values' => [0 => '111']]],
    //         'Test 3' => ['111', '222', ['argument_count' => 2, 'argument_values' => [0 => '111', 11 => '222']]]
    //         ];
    // }

}