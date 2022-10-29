<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class ExternalCodeInvalidException extends \ErrorException
{
    public function __construct(StatusCode $statusCode)
    {
        parent::__construct('External code invalid', $statusCode->code());
    }
}
