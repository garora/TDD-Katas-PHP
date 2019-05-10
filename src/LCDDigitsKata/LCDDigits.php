<?php

namespace TDD\LCDDigitsKata;

class LCDDigits
{
    private const LCD_STRING = [
        [' _ ', '   ', ' _ ', ' _ ', '   ', ' _ ', ' _ ', ' _ ', ' _ ', ' _ ',],
        ['| |', '  |', ' _|', ' _|', '|_|', '|_ ', '|_ ', '  |', '|_|', '|_|',],
        ['|_|', '  |', '|_ ', ' _|', '  |', ' _|', '|_|', '  |', '|_|', '  |',],
    ];

    public function represent(int $input): string
    {
        $output = ['', '', ''];

        foreach (str_split($input) as $digit) {
            for ($i = 0; $i < 3; ++$i) {
                $output[$i] .= self::LCD_STRING[$i][$digit];
            }
        }

        return implode(PHP_EOL, $output);
    }
}
