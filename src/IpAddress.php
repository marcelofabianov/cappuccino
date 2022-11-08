<?php

namespace Cappuccino;

use Cappuccino\Exception\InvalidIpAddress;

class IpAddress
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function isValid(string $ipAddress): bool
    {
        return filter_var($ipAddress, FILTER_VALIDATE_IP);
    }

    public static function make(): string
    {
        return long2ip(mt_rand());
    }

    public function get(): string
    {
        return $this->value;
    }

    public static function create(string $value): self
    {
        if (!self::isValid($value)) {
            throw new InvalidIpAddress();
        }

        return new self($value);
    }
}
