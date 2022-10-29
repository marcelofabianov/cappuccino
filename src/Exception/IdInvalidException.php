<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;
use ErrorException;

class IdInvalidException extends ErrorException
{
    public function __construct(StatusCode $statusCode)
    {
        parent::__construct('ID does not follow the defined pattern', $statusCode->code());
    }
}
