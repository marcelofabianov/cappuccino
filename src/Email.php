<?php

namespace Marcelofabianov;

use Marcelofabianov\Exception\InvalidEmailException;

class Email
{
    private readonly string $value;
    private static StatusCode $statusCode;

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

        if(!preg_match('/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/', $email)){
            return false;
        }

        return true;
    }

    public static function create(string $value, StatusCode|null $statusCode = null): Email
    {
        if (!self::isValid($value)) {
            throw new InvalidEmailException(
                StatusCode::create(StatusCode::HTTP_BAD_REQUEST)
            );
        }

        return new Email($value);
    }
}
