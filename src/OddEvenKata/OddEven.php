<?php

namespace TDD\OddEvenKata;

class OddEven
{
    public const DEFAULT_START = 1;
    public const DEFAULT_END = 100;

    public function printRange(int $start = self::DEFAULT_START, int $end = self::DEFAULT_END): string
    {
        $range = range($start, $end);
        $closure = [$this, 'compute'];

        $pieces = array_map($closure, $range);

        return implode('\n', $pieces);
    }

    public function compute(int $number): string
    {
        if (1 === $number) {
            return 'Odd';
        }

        if (0 === $number % 2) {
            return 'Even';
        }

        for ($i = 2, $sqrt = sqrt($number); $i <= $sqrt; $i++) {
            if (0 === $number % $i) {
                return 'Odd';
            }
        }

        return $number;
    }
}
