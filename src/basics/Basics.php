<?php

namespace basics;

class Basics extends BasicsValidator implements BasicsInterface
{
    public function getMinuteQuarter(int $minute): string
    {
        $this->isMinutesException($minute);

        if ($minute > 0 && $minute <= 15) {
            return 'first';
        }
        if ($minute > 15 && $minute <= 30) {
            return 'second';
        }
        if ($minute > 30 && $minute <= 45) {
            return 'third';
        } else {
            return 'fourth';
        }
    }
    public function isLeapYear(int $year): bool
    {
        $this->isYearException($year);

        if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
            return true;
        }
        return false;
    }

    public function isSumEqual(string $input): bool
    {
        $this->isValidStringException($input);
        $left = 0;
        $right = 0;
        for ($i = 0;$i < (strlen($input) / 2);$i++) {
            $left += $input[$i];
        }
        for ($i = (strlen($input) / 2);$i < strlen($input);$i++) {
            $right += $input[$i];
        }
        if ($left == $right) {
            return true;
        }
        return false;
    }
}