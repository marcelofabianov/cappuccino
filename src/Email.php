<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Exception\InvalidEmailException;

class Email
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function isValid(string $value): bool
    {
        return filter_var(filter_var($value, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    }

    public static function create(string $value): self
    {
        if (! self::isValid($value)) {
            throw new InvalidEmailException();
        }

        return new self($value);
    }
}
