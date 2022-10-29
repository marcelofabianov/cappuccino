<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class PasswordIsNotSecureException extends \ErrorException
{
    public function __construct(StatusCode|null $statusCode = null)
    {
        $statusCode = $statusCode ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);

        parent::__construct('The password to be secure must contain 10 characters
        including numbers, uppercase and lowercase letters and a symbol', $statusCode->code());
    }
}
