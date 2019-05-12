<?php

namespace TDD\CalcStatsKata;

use PHPUnit\Framework\TestCase;

class CalcStatsTest extends TestCase
{
    private const MIN = -10;

    private const MAX = 10;

    /** @var CalcStats */
    private $calcStats;

    /** @var array */
    private $input;

    protected function setUp(): void
    {
        $this->calcStats = new CalcStats();

        $this->input = range(self::MIN, self::MAX);
        shuffle($this->input);
    }

    protected function tearDown(): void
    {
        $this->calcStats = null;
        $this->input = null;
    }

    public function testCanFindMinimumValue(): void
    {
        $this->assertEquals(self::MIN, $this->calcStats->compute(...$this->input)->getMinimum());
    }

    public function testCanFindMaximumValue(): void
    {
        $this->assertEquals(self::MAX, $this->calcStats->compute(...$this->input)->getMaximum());
    }

    public function testCanFindCount(): void
    {
        $this->assertEquals(count($this->input), $this->calcStats->compute(...$this->input)->getCount());
    }

    public function testCanFindAverage(): void
    {
        $expected = array_sum($this->input) / count($this->input);

        $this->assertEquals($expected, $this->calcStats->compute(...$this->input)->getAverage());
    }

    public function testHandlesEmptyInput(): void
    {
        $response = $this->calcStats->compute();

        $this->assertEquals(0, $response->getCount());
        $this->assertEquals(0, $response->getMinimum());
        $this->assertEquals(0, $response->getMaximum());
        $this->assertEquals(0, $response->getAverage());
    }

    /**
     * @throws \Exception
     */
    public function testSingleton(): void
    {
        $number = random_int(PHP_INT_MIN, PHP_INT_MAX);

        $response = $this->calcStats->compute($number);

        $this->assertEquals(1, $response->getCount());
        $this->assertEquals($number, $response->getMinimum());
        $this->assertEquals($number, $response->getMaximum());
        $this->assertEquals($number, $response->getAverage());
    }
}
