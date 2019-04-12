<?php

namespace TDD\FizzBuzzKata;

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    public function testReturnsFizzForMultiplesOfThree(): void
    {
        $fizzBuzz = new FizzBuzz();

        foreach ([3, 6, 9, 12, 18, 21, 24, 27] as $number) {
            $this->assertEquals('Fizz', $fizzBuzz($number));
        }
    }

    public function testReturnsBuzzForMultiplesOfFive(): void
    {
        $fizzBuzz = new FizzBuzz();

        foreach ([5, 10, 20, 25] as $number) {
            $this->assertEquals('Buzz', $fizzBuzz($number));
        }
    }
    
    public function testReturnsFizzBuzzForMultiplesOfThreeAndFive(): void
    {
        $fizzBuzz = new FizzBuzz();

        foreach ([15, 30] as $number) {
            $this->assertEquals('FizzBuzz', $fizzBuzz($number));
        }
    }

    public function testReturnsNumberForNonMultiples(): void
    {
        $fizzBuzz = new FizzBuzz();

        foreach (range(1, 100) as $i) {
            if (0 === $i%5) {
                continue;
            }

            if (0 === $i%3) {
                continue;
            }

            $this->assertEquals($i, $fizzBuzz($i));
        }
    }

    /**
     * @dataProvider invalidInputProvider
     */
    public function testThrowsExceptionOnInvalidInput(int $invalidInput): void
    {
        $fizzBuzz = new FizzBuzz();

        $this->expectException(\InvalidArgumentException::class);
        $fizzBuzz($invalidInput);
    }


    public function invalidInputProvider(): array
    {
        return [
            [0],
            [-1],
            [101]
        ];
    }
}