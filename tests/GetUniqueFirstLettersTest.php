<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    protected $airport;

    protected function setUp(): void
    {
        $this->airport = new web\AirportValidator();
    }

    /**
    * @dataProvider GetUniqueFirstLettersDataProvider
    */

    public function testAirport($input, $expected): void
    {
        $this->assertEquals($expected, $this->airport->getUniqueFirstLetters($input));
    }

    public function GetUniqueFirstLettersDataProvider(): array
    {
        return [
            'test1' => [[[
                "name" => "Dallas Love Field",
                "code" => "DAL",
                "city" => "Dallas Love Field",
                "state" => "Texas",
                "address" => "8008 Herb Kelleher Way, Dallas, TX 75235, USA",
                "timezone" => "America/Fort_Wayne",
                ]], [ 0 => 'D']],
            'test2' => [[[
                "name" => "Dallas Love Field",
                "code" => "DAL",
                "city" => "Dallas Love Field",
                "state" => "Texas",
                "address" => "8008 Herb Kelleher Way, Dallas, TX 75235, USA",
                "timezone" => "America/Fort_Wayne",
                ],
                [
                "name" => "Dallas Love Field",
                "code" => "DAL",
                "city" => "Dallas Love Field",
                "state" => "Texas",
                "address" => "8008 Herb Kelleher Way, Dallas, TX 75235, USA",
                "timezone" => "America/Fort_Wayne",
                ]], [ 0 => 'D']]    
            ];
    }
}
