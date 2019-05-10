<?php

namespace TDD\LCDDigitsKata;

use PHPUnit\Framework\TestCase;

class LCDDigitsTest extends TestCase
{
    /** @var LCDDigits */
    private $lcdDigits;

    protected function setUp(): void
    {
        $this->lcdDigits = new LCDDigits();
    }

    protected function tearDown(): void
    {
        $this->lcdDigits = null;
    }

    public function testSingleDigit(): void
    {
        $expected = <<<TXT
 _ 
| |
|_|
TXT;

        $this->assertEquals($expected, $this->lcdDigits->represent(0));
    }

    public function testDoubleDigit(): void
    {
        $expected = <<<TXT
    _ 
|_| _|
  ||_ 
TXT;

        $this->assertEquals($expected, $this->lcdDigits->represent(42));
    }

    public function testLongDigit(): void
    {
        $expected = <<<TXT
 _  _     _  _  _  _ 
|_||_|  ||_  _|  ||_ 
|_|  |  ||_| _|  | _|
TXT;

        $this->assertEquals($expected, $this->lcdDigits->represent(8916375));
    }
}
