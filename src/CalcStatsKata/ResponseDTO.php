<?php

namespace TDD\CalcStatsKata;

class ResponseDTO
{
    /** @var int */
    private $minimum;

    /** @var int */
    private $maximum;

    /** @var int */
    private $count;

    /** @var float */
    private $average;

    public function __construct(int $minimum, int $maximum, int $count, float $average)
    {
        $this->minimum = $minimum;
        $this->maximum = $maximum;
        $this->count = $count;
        $this->average = $average;
    }

    public function getMinimum(): int
    {
        return $this->minimum;
    }

    public function getMaximum(): int
    {
        return $this->maximum;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getAverage(): float
    {
        return $this->average;
    }
}
