<?php

declare(strict_types=1);

namespace Cappuccino;

final class Cnpj
{
    private string $value;

    public function __construct(string $value)
    {
        if (! self::isValid($value)) {
            throw new \InvalidArgumentException('Invalid CNPJ');
        }

        $this->value = self::getNumbers($value);
    }

    public static function isValidFormat(string $cnpj): bool
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $cnpj);
    }

    public static function isValid(string $cnpj): bool
    {
        $cnpj = self::getNumbers($cnpj);

        if (strlen($cnpj) !== 14) {
            return false;
        }

        if (str_starts_with($cnpj, '00')) {
            return false;
        }

        $digits = self::calculateDigits($cnpj);

        return substr($cnpj, 12, 2) === $digits;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getFormat(): string
    {
        return substr($this->value, 0, 2).'.'.
            substr($this->value, 2, 3).'.'.
            substr($this->value, 5, 3).'/'.
            substr($this->value, 8, 4).'-'.
            substr($this->value, 12, 2);
    }

    public static function random(): string
    {
        do {
            $number = (string) random_int(1000000000000, 9999999999999);
        } while (str_starts_with($number, '00'));

        $digits = self::calculateDigits($number);

        return $number.$digits;
    }

    private static function getNumbers(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }

    private static function calculateDigits(string $cnpj): string
    {
        $d1 = (5 * $cnpj[0] + 4 * $cnpj[1] + 3 * $cnpj[2] + 2 * $cnpj[3] + 9 * $cnpj[4] + 8 * $cnpj[5] + 7 * $cnpj[6] + 6 * $cnpj[7] + 5 * $cnpj[8] + 4 * $cnpj[9] + 3 * $cnpj[10] + 2 * $cnpj[11]) % 11;
        if ($d1 < 2) {
            $d1 = 0;
        } else {
            $d1 = 11 - $d1;
        }

        $d2 = (6 * $cnpj[0] + 5 * $cnpj[1] + 4 * $cnpj[2] + 3 * $cnpj[3] + 2 * $cnpj[4] + 9 * $cnpj[5] + 8 * $cnpj[6] + 7 * $cnpj[7] + 6 * $cnpj[8] + 5 * $cnpj[9] + 4 * $cnpj[10] + 3 * $cnpj[11] + 2 * $d1) % 11;
        if ($d2 < 2) {
            $d2 = 0;
        } else {
            $d2 = 11 - $d2;
        }

        return "{$d1}{$d2}";
    }
}
