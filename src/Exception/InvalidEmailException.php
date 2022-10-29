<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class InvalidEmailException extends \ErrorException
{
    public function __construct(StatusCode|null $statusCode = null)
    {
        $statusCode = $statusCode ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);

        parent::__construct('Email with invalid format', $statusCode->code());
    }
}
