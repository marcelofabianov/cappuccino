<?php

declare(strict_types=1);

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

    public static function capture(): self
    {
        $ipAddress = null;
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipAddress = 'UNKNOWN';
        }

        return self::create($ipAddress);
    }

    public static function create(string $value): self
    {
        if (! self::isValid($value)) {
            throw new InvalidIpAddress();
        }

        return new self($value);
    }
}
