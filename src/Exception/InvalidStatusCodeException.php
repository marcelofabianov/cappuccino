<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class InvalidStatusCodeException extends \ErrorException
{
    public function __construct(StatusCode $statusCode)
    {
        parent::__construct('Invalid format StatusCode Http', $statusCode->code());
    }
}
