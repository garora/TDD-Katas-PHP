<?php

namespace TDD\BowlingGameKata;

class BowlingGame
{
    /** @var array int[] */
    private $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $score = $rollIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            $this->processFrame($rollIndex, $score);
        }

        return $score;
    }

    private function processFrame(int &$rollIndex, int &$score): void
    {
        if ($this->isStrike($rollIndex)) {
            $score += 10 + $this->strikeBonus($rollIndex);
            ++$rollIndex;

            return;
        }

        $ballsInFrameSum = $this->sumBallsInFrame($rollIndex);
        $score += $ballsInFrameSum;

        if ($this->isSpare($ballsInFrameSum)) {
            $score += $this->spareBonus($rollIndex);
        }

        $rollIndex += 2;
    }

    private function isStrike(int $rollIndex): bool
    {
        return 10 === $this->rolls[$rollIndex];
    }

    private function strikeBonus(int $rollIndex): int
    {
        return $this->rolls[$rollIndex + 1] + $this->rolls[$rollIndex + 2];
    }

    private function sumBallsInFrame(int $rollIndex): int
    {
        return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
    }

    private function isSpare(int $ballsInFrameSum): bool
    {
        return 10 === $ballsInFrameSum;
    }

    private function spareBonus(int $rollIndex): int
    {
        return $this->rolls[$rollIndex + 2];
    }
}
