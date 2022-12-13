<?php

namespace Cappuccino;

use Cappuccino\Shared\ApplyMask;

class ZipCode
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function numbers(): int
    {
        return self::sanitize($this->value);
    }

    public function format(): string
    {
        return ApplyMask::custom($this->value, '#####-###');
    }

    public static function isValid(string $value): bool
    {
        return preg_match($value, "/^[0-9]{5}-[0-9]{3}$/") or preg_match($value, "/^[0-9]{8}$/");
    }

    public static function sanitize(string $value): string
    {
        return preg_replace("/[^0-9]/", "", $value);
    }

    public static function create(string $value): self
    {
        if (!self::isValid($value)) {
            throw new \Exception('Zipcode invalid!');
        }

        return new ZipCode($value);
    }
}
