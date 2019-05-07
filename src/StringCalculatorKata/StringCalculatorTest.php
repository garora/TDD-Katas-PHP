<?php

namespace TDD\StringCalculatorKata;

use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    public function testEmptyString(): void
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(0, $stringCalculator->add(''));
    }

    /**
     * @throws \Exception
     */
    public function testSingleNumber(): void
    {
        $input = random_int(1, 9);
        $stringCalculator = new StringCalculator();

        $this->assertEquals($input, $stringCalculator->add($input));
    }

    /**
     * @throws \Exception
     */
    public function testMultipleNumbers(): void
    {
        $stringCalculator = new StringCalculator();

        $set = range(1, 10);
        shuffle($set);

        $inputRange = array_slice($set, random_int(0, 8));
        $expected = array_sum($inputRange);

        $this->assertEquals($expected, $stringCalculator->add(implode("\n", $inputRange)));
        $this->assertEquals($expected, $stringCalculator->add(implode(',', $inputRange)));
    }

    /**
     * @depends testMultipleNumbers
     */
    public function testMultipleDelimiters(): void
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(6, $stringCalculator->add("1\n2,3"));
    }

    /**
     * @dataProvider customDelimiterDataProvider
     * @depends testMultipleNumbers
     *
     * @throws \Exception
     */
    public function testCustomDelimiter(string $delimiter): void
    {
        $stringCalculator = new StringCalculator();

        $set = range(1, 10);
        shuffle($set);

        $inputRange = array_slice($set, random_int(0, 8));

        $expected = array_sum($inputRange);
        $input = "$delimiter\n".implode($delimiter, $inputRange);

        $this->assertEquals($expected, $stringCalculator->add($input));
    }

    public function customDelimiterDataProvider(): array
    {
        return [
            'regex-friendly character' => [';'],
            'escape backslash' => ['\\'],
            'question mark' => ['?'],
            'asterisk' => ['*'],
            'dot' => ['.'],
        ];
    }

    /**
     * @dataProvider negativeNumberDataProvider
     */
    public function testNegativeThrowsException(string $input): void
    {
        $stringCalculator = new StringCalculator();

        $this->expectException(NegativeNumberException::class);
        $stringCalculator->add($input);
    }

    public function negativeNumberDataProvider(): array
    {
        return [
            'single number' => ['-1'],
            'start of string' => ['-1,2'],
            'middle of string' => ['1,-2,3'],
            'end of string' => ['1,-2'],
        ];
    }
}
