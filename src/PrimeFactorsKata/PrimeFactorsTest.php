<?php

namespace TDD\PrimeFactorsKata;

use PHPUnit\Framework\TestCase;

class PrimeFactorsTest extends TestCase
{
    /** @var PrimeFactors */
    private $primeFactors;

    protected function setUp(): void
    {
        $this->primeFactors = new PrimeFactors();
    }

    protected function tearDown(): void
    {
        $this->primeFactors = null;
    }

    /**
     * @dataProvider globalDataProvider
     */
    public function testBehaviour(array $expected, int $number): void
    {
        $this->assertEquals($expected, $this->primeFactors->generate($number));
    }

    public function globalDataProvider(): array
    {
        return [
            'one' => [[], 1],
            'two' => [[2], 2],
            'three' => [[3], 3],
            'four' => [[2, 2], 4],
            'six' => [[2, 3], 6],
            'height' => [[2, 2, 2], 8],
            'nine' => [[3, 3], 9],
            'complex' => [[2, 43], 86],
            'complexer' => [[17, 23], 391],
            'complexest' => [[5, 7, 7, 13, 59], 187915],
        ];
    }
}
