<?php

namespace Cappuccino\Exception;

class InvalidEmailException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('Email with invalid format', $code);
    }
}
