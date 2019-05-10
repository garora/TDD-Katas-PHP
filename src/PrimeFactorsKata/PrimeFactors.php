<?php

namespace TDD\PrimeFactorsKata;

class PrimeFactors
{
    /**
     * @return int[]
     */
    public function generate(int $number): array
    {
        $ret = [];

        for ($candidate = 2; $number > 1; ++$candidate) {
            for (; 0 === $number%$candidate; $number /= $candidate) {
                $ret[] = $candidate;
            }
        }

        return $ret;
    }
}
