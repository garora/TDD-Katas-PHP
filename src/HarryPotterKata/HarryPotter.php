<?php

namespace TDD\HarryPotterKata;

class HarryPotter
{
    private const BASE_PRICE = 8;

    private const RATIO = [
        0 => 0,
        1 => 1,
        2 => 0.95,
        3 => 0.9,
        4 => 0.8,
        5 => 0.75,
    ];

    /**
     * @param int[] $bookCounts
     */
    public function __invoke(array $bookCounts): float
    {
        $price = 0.0;

        do {
            $setCount = 0;

            $closure = $this->getClosure($setCount);
            $bookCounts = array_map($closure, $bookCounts);

            $price += $setCount * self::BASE_PRICE * self::RATIO[$setCount];
        } while ($setCount !== 0);

        return $price;
    }

    protected function getClosure(int &$setCount): \Closure
    {
        return static function (int $value) use (&$setCount) {
            $setCount += $value > 0 ? 1 : 0;

            return --$value;
        };
    }
}
