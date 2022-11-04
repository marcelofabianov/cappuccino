<?php

namespace Cappuccino\Exception;

class PasswordIsNotSecureException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('The password to be secure must contain 10 characters
        including numbers, uppercase and lowercase letters and a symbol', $code);
    }
}
