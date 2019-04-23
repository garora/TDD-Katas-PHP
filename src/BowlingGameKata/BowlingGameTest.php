<?php

namespace TDD\BowlingGameKata;

use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    /** @var BowlingGame */
    private $game;

    protected function setUp(): void
    {
        $this->game = new BowlingGame();
    }

    protected function tearDown(): void
    {
        $this->game = null;
    }

    public function testGutterGame(): void
    {
        $this->rollMany(20, 0);

        $this->assertEquals(0, $this->game->score());
    }

    public function testAllOnes(): void
    {
        $this->rollMany(20, 1);

        $this->assertEquals(20, $this->game->score());
    }

    public function testOneSpare(): void
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->rollMany(17, 0);

        $this->assertEquals(16, $this->game->score());
    }

    public function testOneStrike(): void
    {
        $this->rollStrike();
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(16, 0);

        $this->assertEquals(24, $this->game->score());
    }

    public function testPerfectGame(): void
    {
        $this->rollMany(12, 10);

        $this->assertEquals(300, $this->game->score());
    }

    private function rollMany(int $count, int $pins): void
    {
        for ($i = 0; $i < $count; ++$i) {
            $this->game->roll($pins);
        }
    }

    private function rollSpare(): void
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    private function rollStrike(): void
    {
        $this->game->roll(10);
    }
}
