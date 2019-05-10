<?php

namespace TDD\OddEvenKata;

use PHPUnit\Framework\TestCase;

class OddEvenTest extends TestCase
{
    private const ODD_THAT_ARE_NOT_PRIME = [1, 9, 15, 21, 25, 27, 33, 35, 39, 45, 49, 51, 55, 57, 63, 65, 69, 75, 77, 81, 85, 87, 91, 93, 95, 99];

    /** @var OddEven */
    private $oddEven;

    protected function setUp(): void
    {
        $this->oddEven = new OddEven();
    }

    protected function tearDown(): void
    {
        $this->oddEven = null;
    }

    public function testChangesEvenNumbers(): void
    {
        $result = $this->oddEven->printRange();
        $arrayResult = explode('\n', $result);

        for ($i = 3, $count = count($arrayResult); $i < $count; $i += 2) {
            $this->assertEquals('Even', $arrayResult[$i]);
        }
    }

    public function testChangesOddNumbersThatAreNotPrime(): void
    {
        $result = $this->oddEven->printRange();
        $arrayResult = explode('\n', $result);

        foreach (self::ODD_THAT_ARE_NOT_PRIME as $key) {
            $this->assertEquals('Odd', $arrayResult[$key - 1]);
        }
    }

    /**
     * @dataProvider computeDataProvider
     */
    public function testCompute(int $input, string $expectedOutput): void
    {
        $this->assertEquals($expectedOutput, $this->oddEven->compute($input));
    }

    public function computeDataProvider(): array
    {
        return [
            'one' => [1, 'Odd'],
            'two' => [2, 'Even'],
            'three' => [3, '3'],
            'even number' => [4, 'Even'],
            'odd number which is prime' => [5, '5'],
            'odd number which is not prime' => [9, 'Odd'],
        ];
    }

    /**
     * @dataProvider rangeRequestDataProvider
     */
    public function testPrintsTheRequestedRangeLength(int $start, int $end, int $expectedLength): void
    {
        $result = $this->oddEven->printRange($start, $end);

        $this->assertEquals($expectedLength, substr_count($result, '\n') + 1);
    }

    public function rangeRequestDataProvider(): array
    {
        return [
            [1, 1, 1],
            [1, 50, 50],
            [51, 100, 50],
            [1, 100, 100],
        ];
    }
}
