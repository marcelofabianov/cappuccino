<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Exception\PasswordIsNotSecureException;

class Password
{
    private readonly string $value;

    private static int $min = 10;

    private static int $maxRangeMake = 33;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    public function hash(): string
    {
        return Hash::make($this->value)->get();
    }

    public static function isValid(string $value): bool
    {
        return preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{10,255}$/', $value);
    }

    public static function make(): self
    {
        $digits = array_flip(range('0', '9'));
        $lowercase = array_flip(range('a', 'z'));
        $uppercase = array_flip(range('A', 'Z'));
        $special = array_flip(str_split('!@#$%^&*-'));
        $combined = array_merge($digits, $lowercase, $uppercase, $special);

        $value = str_shuffle(array_rand($digits)
            .array_rand($lowercase).array_rand($uppercase)
            .array_rand($special)
            .implode(array_rand($combined, random_int(self::$min, random_int(self::$min + 1, self::$maxRangeMake)))));

        return self::create($value);
    }

    public static function create(string $value): self
    {
        if (! self::isValid($value)) {
            throw new PasswordIsNotSecureException();
        }

        return new self($value);
    }
}
