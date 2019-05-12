<?php

namespace TDD\CalcStatsKata;

class CalcStats
{
    public function compute(int ...$numberList): ResponseDTO
    {
        $count = count($numberList);
        $minimum = $maximum = $average = 0;

        if ($count > 0) {
            $minimum = min($numberList);
            $maximum = max($numberList);
            $average = array_sum($numberList) / $count;
        }

        return new ResponseDTO($minimum, $maximum, $count, $average);
    }
}
