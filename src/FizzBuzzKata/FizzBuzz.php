<?php

namespace TDD\FizzBuzzKata;

class FizzBuzz
{
    private const TRIGGER_FIZZ = 3;

    private const TRIGGER_BUZZ = 5;

    public function __invoke(int $number): string
    {
        if (1 > $number || $number > 100) {
            throw new \InvalidArgumentException("$number is not a valid number between 1 and 100.");
        }

        $ret = '';

        if (0 === $number%self::TRIGGER_FIZZ) {
            $ret .= 'Fizz';
        }

        if (0 === $number%self::TRIGGER_BUZZ) {
            $ret .= 'Buzz';
        }

        return $ret ?: $number;
    }
}
