<?php

namespace TDD\StringCalculatorKata;

class StringCalculator
{
    private const DEFAULT_DELIMITER = ',';

    private const REGEX_NEGATIVE_NUMBER = '/-[\d]/';
    private const REGEX_CUSTOM_DELIMITER = '/^([\D])\n[\d]/';
    private const REGEX_ONE_OR_MORE_NUMBERS = '/^([\d]+[\n,])*[\d]+$/';

    public function add(string $input): int
    {
        if ('' === $input) {
            return 0;
        }

        if ($this->inputHasNegativeNumber($input)) {
            throw new NegativeNumberException('Negatives are not allowed.');
        }

        $customDelimiterResult = preg_match(self::REGEX_CUSTOM_DELIMITER, $input, $matches);
        if ($this->inputIsSettingCustomDelimiter($customDelimiterResult)) {
            $input = $this->replaceCustomDelimiterWithDefault($input, $matches);
        }

        if ($this->inputIsAValidListOfNumbers($input)) {
            return $this->computeSum($input);
        }

        throw new \InvalidArgumentException('The input does not match any expected pattern.');
    }

    private function inputHasNegativeNumber(string $input): bool
    {
        return 1 === preg_match(self::REGEX_NEGATIVE_NUMBER, $input);
    }

    private function inputIsAValidListOfNumbers(string $input): bool
    {
        return 1 === preg_match(self::REGEX_ONE_OR_MORE_NUMBERS, $input);
    }

    private function inputIsSettingCustomDelimiter(int $customDelimiterResult): bool
    {
        return 1 === $customDelimiterResult;
    }

    private function replaceCustomDelimiterWithDefault(string $input, array $matches): string
    {
        $delimiter = array_pop($matches);

        $input = substr($input, strlen("$delimiter\n"));
        $input = str_replace($delimiter, self::DEFAULT_DELIMITER, $input);

        return $input;
    }

    private function computeSum(string $input): int
    {
        $input = $this->unifyDelimiter($input);

        return array_sum(explode(self::DEFAULT_DELIMITER, $input));
    }

    private function unifyDelimiter(string $input): string
    {
        return str_replace("\n", self::DEFAULT_DELIMITER, $input);
    }
}
