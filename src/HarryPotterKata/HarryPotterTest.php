<?php

namespace TDD\HarryPotterKata;

use PHPUnit\Framework\TestCase;

class HarryPotterTest extends TestCase
{
    public function testOneBook(): void
    {
        $this->assertEquals(8, $this->getHarryPotter()([1]));
    }

    public function testTwiceTheSameBook(): void
    {
        $this->assertEquals(8*2, $this->getHarryPotter()([2]));
    }

    public function testTwoDifferentBooks(): void
    {
        $this->assertEquals(8*2*0.95, $this->getHarryPotter()([1, 1]));
    }

    public function testThreeDifferentBooks(): void
    {
        $this->assertEquals(8*3*0.9, $this->getHarryPotter()([1, 1, 1]));
    }

    public function testFourDifferentBooks(): void
    {
        $this->assertEquals(8*4*0.8, $this->getHarryPotter()([1, 1, 1, 1]));
    }

    public function testFiveDifferentBooks(): void
    {
        $this->assertEquals(8*5*0.75, $this->getHarryPotter()([1, 1, 1, 1, 1]));
    }

    public function testSeparatesSets(): void
    {
        $this->assertEquals(8*(2*0.95+1), $this->getHarryPotter()([2, 1]));
    }

    public function testExample(): void
    {
        $this->assertEquals(51.6, $this->getHarryPotter()([2, 2, 2, 1, 1]));
    }

    public function testComplex(): void
    {
        $this->assertEquals(8*(5*0.75+4*0.8+3*0.9+2*0.95+1), $this->getHarryPotter()([5, 1, 3, 4, 2]));
    }

    private function getHarryPotter(): HarryPotter
    {
        return new HarryPotter();
    }
}
