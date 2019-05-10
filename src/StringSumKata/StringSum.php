<?php

namespace TDD\StringSumKata;

class StringSum
{
    public function __invoke(string $s1, string $s2): string
    {
        $n1 = $this->toNatural($s1);
        $n2 = $this->toNatural($s2);

        return $this->add($n1, $n2);

    }

    private function toNatural(string $input): int
    {
        if (0 === preg_match('/^[\d]+$/', $input)) {
            return 0;
        }

        return (int) $input;
    }

    private function add(int $n1, int $n2): string
    {
        $sum = $n1 + $n2;

        return (string)$sum;
    }
}
