<?php

namespace Cappuccino;

use Cappuccino\Exception\InvalidEmailException;

class Email
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    public static function isValid(string $value): bool
    {
        $email = filter_var($value, FILTER_SANITIZE_EMAIL);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }

    public static function create(string $value): Email
    {
        if (!self::isValid($value)) {
            throw new InvalidEmailException();
        }

        return new Email($value);
    }
}
