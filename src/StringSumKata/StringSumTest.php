<?php

namespace TDD\StringSumKata;

use PHPUnit\Framework\TestCase;

class StringSumTest extends TestCase
{
    public function testSumOfZeroReturnsZero(): void
    {
        $stringSum = new StringSum();

        $this->assertEquals('0', $stringSum('0', '0'));
    }

    public function testSumWithZeroReturnsInput(): void
    {
        $stringSum = new StringSum();

        $this->assertEquals('1', $stringSum('1', '0'));
    }

    /**
     * @throws \Exception
     */
    public function testIsCommutative(): void
    {
        $stringSum = new StringSum();
        $s1 = (string) random_int(1, 9);
        $s2 = (string) random_int(10, 99);

        $this->assertEquals($stringSum($s1, $s2), $stringSum($s2, $s1));
    }

    /**
     * @dataProvider nonNaturalDataProvider
     * @depends testSumWithZeroReturnsInput
     */
    public function testConvertsNonNatural(string $input): void
    {
        $stringSum = new StringSum();

        $this->assertEquals('0', $stringSum($input, '0'));
    }

    public function nonNaturalDataProvider(): array
    {
        return [
            'integer' => ['-1'],
            'rational' => ['1.5'],
            'not a number' => ['NaN'],
        ];
    }
}
