<?php 

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
    * @dataProvider testGetUniqueFirstLetters
    */
    
    public function testAdd(string $a, string $expected): void
    {
        $this->assertSame($expected, substr($a, 0, 1));
    }
    public function testGetUniqueFirstLetters(): array
    {
        return [
            ['aaaa', 'a'],
            ['vvf', 'v'],
            ['ddsd', 'd'],
            ['cdc', 'd']
        ];
    }

}