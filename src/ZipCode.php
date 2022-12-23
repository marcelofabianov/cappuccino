<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Shared\ApplyMask;

class ZipCode
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function numbers(): string
    {
        return self::sanitize($this->value);
    }

    public function format(): string
    {
        return ApplyMask::custom($this->value, '#####-###');
    }

    public static function isValid(string $value): bool
    {
        return preg_match("/^(\d{8}|\d{2}\.?\d{3}\-\d{3})$/", $value);
    }

    public static function sanitize(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function random(): string
    {
        return random_int(11111111, 99999999);
    }

    public static function create(string $value): self
    {
        if (! self::isValid($value)) {
            throw new \Exception('Zipcode invalid!');
        }

        return new self(self::sanitize($value));
    }
}
