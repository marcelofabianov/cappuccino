<?php

declare(strict_types=1);

namespace Cappuccino;

final class Cpf
{
    private string $value;

    public function __construct(string $value)
    {
        if (! self::isValid($value)) {
            throw new \InvalidArgumentException('Invalid CPF');
        }

        $this->value = self::getNumbers($value);
    }

    public static function isValidFormat(string $value): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value);
    }

    public static function isValid(string $cpf): bool
    {
        $cpf = self::getNumbers($cpf);

        if (strlen($cpf) !== 11) {
            return false;
        }

        if (str_starts_with($cpf, '000')) {
            return false;
        }

        $digits = self::calculateDigits($cpf);

        return substr($cpf, 9, 2) === $digits;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function getNumbers(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }

    public function getFormat(): string
    {
        return substr($this->value, 0, 3).'.'.
            substr($this->value, 3, 3).'.'.
            substr($this->value, 6, 3).'-'.
            substr($this->value, 9, 2);
    }

    public static function random(): string
    {
        $cpf = '';
        for ($i = 0; $i < 9; $i++) {
            $cpf .= random_int(0, 9);
        }

        $cpf .= self::calculateDigits($cpf);

        return $cpf;
    }

    private static function calculateDigits(string $cpf): string
    {
        $d1 = (10 * $cpf[0] + 9 * $cpf[1] + 8 * $cpf[2] + 7 * $cpf[3] + 6 * $cpf[4] + 5 * $cpf[5] + 4 * $cpf[6] + 3 * $cpf[7] + 2 * $cpf[8]) % 11;
        if ($d1 < 2) {
            $d1 = 0;
        } else {
            $d1 = 11 - $d1;
        }

        $d2 = (11 * $cpf[0] + 10 * $cpf[1] + 9 * $cpf[2] + 8 * $cpf[3] + 7 * $cpf[4] + 6 * $cpf[5] + 5 * $cpf[6] + 4 * $cpf[7] + 3 * $cpf[8] + 2 * $d1) % 11;
        if ($d2 < 2) {
            $d2 = 0;
        } else {
            $d2 = 11 - $d2;
        }

        return "{$d1}{$d2}";
    }
}
